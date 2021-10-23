<?php
declare(strict_types=1);
namespace App\Service;

use App\Entity\Answer;
use App\Entity\Company;
use App\Entity\CompanyPoll;
use App\Entity\CompanyPollAnswer;
use App\Entity\CompanyPollQuestion;
use App\Entity\Poll;
use App\Model\CompanyPollAnswer as ModelCompanyPollAnswer;
use App\Model\CompanyPollCloseRequest;
use App\Model\CompanyPollCreateRequest;
use App\Model\CompanyPollGetRequest;
use App\Model\QuestionWithAnswers;
use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class PollService
{   
    public const POLL_RETRY_INTERVAL = '5M';
    public const POLL_MAX_TRIES = '3';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPoll(CompanyPollCreateRequest $pollCreateRequest): void
    {
        $now = new DateTimeImmutable();
        foreach ($pollCreateRequest->getCompanyIds() as $companyId) {
            $company = $this->entityManager->getRepository(Company::class)->find($companyId);
            $poll = $this->entityManager->getRepository(Poll::class)->find($pollCreateRequest->getPollId());
            $companyPoll = new CompanyPoll;
            $companyPoll->setCompany($company);
            $companyPoll->setPoll($poll);
            $companyPoll->setActualBefore($pollCreateRequest->getActualBefore());
            $companyPoll->setCreatedAt($now);
            $companyPoll->setUpdatedAt($now);
            $companyPoll->setFinished(false);
            $companyPoll->setShowAfter($now);
            $companyPoll->setTryCount(0);
            $this->entityManager->persist($companyPoll);
            
            $companyPollQuestion = new CompanyPollQuestion;
            $companyPollQuestion->setQuestion($poll->getFirstQuestion());
            $companyPollQuestion->setCompanyPoll($companyPoll);
            $companyPollQuestion->setAnswered(false);
            $companyPollQuestion->setCreatedAt($now);
            $companyPollQuestion->setUpdatedAt($now);
            $this->entityManager->persist($companyPollQuestion);
        }
        $this->entityManager->flush();
    }

    public function closePoll(CompanyPollCloseRequest $pollCloseRequest): void
    {
        $companyPoll = $this->entityManager->getRepository(CompanyPoll::class)->findOneBy(['id' => $pollCloseRequest->pollId, 'company' => $pollCloseRequest->companyId]);
        $now = new DateTimeImmutable();
        if ($companyPoll->getFinished() || $companyPoll->getActualBefore() < $now) {
            throw new Exception('poll is outdated or finished');
        }
        if ($companyPoll->getShowAfter() < $now) {
            throw new Exception("poll is not available yet");
        }
        $companyPollAnswers = $this->entityManager->getRepository(CompanyPollAnswer::class)->findBy(['companyPoll' => $companyPoll->getId()]);
        if (count($companyPollAnswers) == 0 ) {
            $this->retryCompanyPollLater($companyPoll);
            return;
        }
        $companyPoll->setFinished(true);
        $this->entityManager->persist($companyPoll);
        $this->entityManager->flush();
    }

    public function getPoll(CompanyPollGetRequest $pollGetRequest): ?QuestionWithAnswers
    {
        $companyPoll = $this->entityManager->getRepository(CompanyPoll::class)->findOneBy(['id' => $pollGetRequest->pollId, 'company' => $pollGetRequest->companyId]);
        $now = new DateTimeImmutable();
        if ($companyPoll->getFinished() || $companyPoll->getActualBefore() < $now || $companyPoll->getShowAfter() > $now) {
            return null;
        }
        $companyPollQuestion = $this->currentCompanyPollQuestion($companyPoll);
        $questionWithAnswers = new QuestionWithAnswers;
        $questionWithAnswers->question = $companyPollQuestion->getQuestion();
        $questionWithAnswers->answers = $companyPollQuestion->getQuestion()->getAnswers();
        return $questionWithAnswers;
    }

    public function answerQuestion(ModelCompanyPollAnswer $companyPollAnswer): void
    {
        $companyPoll = $this->entityManager->getRepository(CompanyPoll::class)->findOneBy(['id' => $companyPollAnswer->getPollId(), 'company' => $companyPollAnswer->getCompanyId()]);
        $now = new DateTimeImmutable();
        if ($companyPoll->getFinished() || $companyPoll->getActualBefore() < $now) {
            throw new Exception('poll is outdated or finished');
        }
        $companyPollQuestion = $this->currentCompanyPollQuestion($companyPoll);
        if ($companyPollQuestion->getQuestion()->getId() !== $companyPollAnswer->getQuestionId()) {
            throw new Exception('question is incorrect');
        }
        foreach ($companyPollAnswer->getAnswers() as $answer) {
            $answersMap[(string)$answer->id] = $answer->data ?? '';
        }
        if (count($answersMap) === 0) {
            throw new Exception('no answers');
        }
        $answers = $this->getAnswersByIds(array_keys($answersMap));
        $nextQuestions = [];
        foreach ($answers as $answer) {
            if ($answer->getQuestion()->getId() !== $companyPollAnswer->getQuestionId()) {
                throw new Exception('answer do not belongs to questions');
            }
            if ($answer->getQuestionNext() !== null) {
                $nextQuestions[] = $answer->getQuestionNext();
            }
            $companyPollAnswerEntity = new CompanyPollAnswer;
            $companyPollAnswerEntity->setCompanyPoll($companyPoll);
            $companyPollAnswerEntity->setAnswer($answer);
            $companyPollAnswerEntity->setQuestion($companyPollQuestion->getQuestion());
            if ($answersMap[$answer->getId()] !== '') {
                $companyPollAnswerEntity->setMeta($answersMap[$answer->getId()]);
            }
            $companyPollAnswerEntity->setCreatedAt($now);
            $companyPollAnswers[] = $companyPollAnswerEntity;
        }
        $this->saveAnswers($companyPollAnswers, $companyPollQuestion, $nextQuestions);
    }

    private function retryCompanyPollLater(CompanyPoll $companyPoll): void {
        $companyPoll->setShowAfter($companyPoll->getShowAfter()->add(new DateInterval('PT' . self::POLL_RETRY_INTERVAL)));
        $companyPoll->setTryCount($companyPoll->getTryCount() + 1);
        if ($companyPoll->getTryCount() >= self::POLL_MAX_TRIES) {
            $companyPoll->setFinished(true);
        }
        $this->entityManager->persist($companyPoll);
        $this->entityManager->flush();
    }

    private function currentCompanyPollQuestion(CompanyPoll $companyPoll): ?CompanyPollQuestion
    {
        $companyPollQuestion = $this->entityManager->getRepository(CompanyPollQuestion::class)->findCurrentQuestion($companyPoll);
        if ($companyPollQuestion === null) {
            throw new Exception("company poll not found");
        }

        return $companyPollQuestion;
    }

    private function getAnswersByIds($answersIds): array
    {
        return $this->entityManager->getRepository(Answer::class)->findBy(['id' => $answersIds]);
    }

    private function saveAnswers(array $companyPollAnswers, CompanyPollQuestion $companyPollQuestion, array $nextQuestions): void
    {
        foreach ($companyPollAnswers as $companyPollAnswer) {
            $this->entityManager->persist($companyPollAnswer);
        }

        $companyPollQuestion->setAnswered(true);
        $companyPoll = $companyPollAnswer->getCompanyPoll();
        if (count($nextQuestions) === 0) {
           $companyPoll->setFinished(true);
           $this->entityManager->persist($companyPoll);
        } else {
            $now = new DateTimeImmutable();
            foreach ($nextQuestions as $question) {
                $companyPollQuestion = new CompanyPollQuestion;
                $companyPollQuestion->setCompanyPoll($companyPoll);
                $companyPollQuestion->setQuestion($question);
                $companyPollQuestion->setAnswered(false);
                $companyPollQuestion->setCreatedAt($now);
                $companyPollQuestion->setUpdatedAt($now);
                $this->entityManager->persist($companyPollQuestion);
            }
        }

        $this->entityManager->flush();
    }
}