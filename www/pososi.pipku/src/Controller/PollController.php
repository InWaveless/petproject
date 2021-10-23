<?php

namespace App\Controller;

use App\Model\Answer;
use App\Model\CompanyPollAnswer;
use App\Model\CompanyPollCloseRequest;
use App\Model\CompanyPollCreateRequest;
use App\Model\CompanyPollGetRequest;
use App\Model\CompanyPollHistoryRequest;
use App\Service\PollService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PollController extends AbstractController
{
    private $pollService;

    public function __construct(PollService $pollService)
    {
        $this->pollService = $pollService;
    }

    public function companyPollCreate(Request $request): Response
    {
        $request = $request->toArray();
        $companyIds = $request['company_ids'];
        $pollId = $request['poll_id'];
        $actualBefore = new DateTimeImmutable($request['actual_before']);
        $data = new CompanyPollCreateRequest;
        $data->setCompanyIds(...$companyIds);
        $data->setPollId($pollId);
        $data->setActualBefore($actualBefore);
        $this->pollService->createPoll($data);
        
        return $this->json(['result' => true]);
    }

    public function companyPollClose(Request $request): Response
    {
        $request = $request->toArray();
        $companyId = $request['company_id'];
        $pollId = $request['poll_id'];
        $data = new CompanyPollCloseRequest($companyId, $pollId);
        $this->pollService->closePoll($data);
        return $this->json(['result' => true]);
    }

    public function companyPollGet(Request $request): Response
    {
        $request = $request->toArray();
        $companyId = $request['company_id'];
        $pollId = $request['poll_id'];
        $data = new CompanyPollGetRequest($companyId, $pollId);
        $questionWithAnswers = $this->pollService->getPoll($data);
        return $this->json(['result' => [
            'question' => $questionWithAnswers->getQuestion(),
            'answers' => $questionWithAnswers->getAnswers() 
        ],
        ]);
    }

    public function companyPollAnswer(Request $request): Response
    {
        $request = $request->toArray();
        $companyId = $request['company_id'];
        $pollId = $request['poll_id'];
        $questionId = $request['question_id'];
        foreach ($request['answers'] as $answer) {
            $answerObj = new Answer($answer['id'], $answer['data']);
            $answers[] = $answerObj;
        }
        $data = new CompanyPollAnswer;
        $data->setCompanyId($companyId);
        $data->setPollId($pollId);
        $data->setQuestionId($questionId);
        $data->setAnswers(...$answers);
        $this->pollService->answerQuestion($data);
        return $this->json(['result' => true]);
    }

    public function companyPollHistory(Request $request): Response
    {
        $request = $request->toArray();
        $companyId = $request['company_id'];
        $pollId = $request['poll_id'];
        $data = new CompanyPollHistoryRequest($pollId, $companyId);
        $companyQuestions = $this->pollService->getAnsweredCompanyQuestions($data);
        if (count($companyQuestions) === 0) {
            return $this->json(['result' => []]);
        };
        $questions = $this->pollService->getQuestionsByAnswers($companyQuestions);
        $companyAnswers = $this->pollService->getCompanyAnswers($data->companyPollId, $questions);
        foreach ($questions as $question) {
            foreach ($question->getAnswers() as $answer) {
                $answers[] = ['id' => $answer->getId(), 'title' => $answer->getTitle(), 'type' => $answer->getType()];
            };
            foreach ($companyAnswers as $companyAnswer) {
                if ($companyAnswer->getQuestion()->getId() === $question->getId()) {
                    $mappedCompanyAnswers[] = ['id' => $companyAnswer->getAnswer()->getId(), 'data' => $companyAnswer->getMeta()];
                };
            };
            $result[] = ['answers' => $answers, 'company_answers' => $mappedCompanyAnswers , 'question' => ['id' => $question->getId(), 'title' => $question->getTitle()]];
        };
        
        return $this->json(['result' => $result]);
    }
}
