<?php

namespace App\DTO\CompanyPollHistory;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\DTO\Answer;
use App\DTO\CompanyPollAnswer\CompanyPollAnswer;
use App\DTO\Question;

class CompanyPollHistoryResponse
{
    /** 
     * @OA\Property(
     *   type="array",
     *   @OA\Items(ref=@Model(type=Answer::class))
     * )
     */
    public array $answers;

        /** 
     * @OA\Property(
     *   property="company_answers",
     *   type="array",
     *   @OA\Items(ref=@Model(type=CompanyPollAnswer::class))
     * )
     */
    public array $companyAnswers;

    public Question $question;
}