<?php

namespace App\DTO\CompanyPollHistory;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class CompanyPollHistoryResult 
{
    /** 
     * @OA\Property(
     *   type="array",
     *   @OA\Items(ref=@Model(type=CompanyPollHistoryResponse::class))
     * )
     */
    public array $result;
}