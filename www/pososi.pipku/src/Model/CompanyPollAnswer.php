<?php
declare(strict_types=1);
namespace App\Model;

class CompanyPollAnswer
{
    private array $answers;

    private int $companyId;

    private int $pollId;

    private int $questionId;

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(Answer ...$answers): void
    {
        $this->answers = $answers;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function getPollId(): int
    {
        return $this->pollId;
    }

    public function setPollId(int $pollId): void
    {
        $this->pollId = $pollId;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }
}