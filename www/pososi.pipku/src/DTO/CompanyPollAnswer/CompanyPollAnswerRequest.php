<?php
declare(strict_types=1);
namespace App\DTO\CompanyPollAnswer;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CompanyPollAnswerRequest
{
    /**
     * 
     * @OA\Property(
     *   type="array",
     *   @OA\Items(ref=@Model(type=CompanyPollAnswer::class))
     * )
     */
    private array $answers;

    /**
     * 
     * @OA\Property(property="company_id")
     */
    private int $companyId;

    /**
     * 
     * @OA\Property(property="poll_id")
     */
    private int $pollId;

    /**
     * 
     * @OA\Property(property="question_id")
     */
    private int $questionId;

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(CompanyPollAnswer ...$answers): void
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