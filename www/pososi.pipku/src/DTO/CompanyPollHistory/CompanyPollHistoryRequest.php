<?php

namespace App\DTO\CompanyPollHistory;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CompanyPollHistoryRequest
{
    /**
     * 
     * @OA\Property(property="poll_id")
     */
    public int $companyPollId;

    /**
     * 
     * @OA\Property(property="company_id")
     */
    public int $companyId;

    public function __construct(int $companyPollId, int $companyId)
    {
        $this->companyId = $companyId;
        $this->companyPollId = $companyPollId;
    }
}