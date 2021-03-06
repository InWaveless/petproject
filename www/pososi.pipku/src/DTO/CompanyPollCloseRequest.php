<?php
declare(strict_types=1);
namespace App\DTO;

use OpenApi\Annotations as OA;

class CompanyPollCloseRequest
{
    /**
     * 
     * @OA\Property(property="company_id")
     */
    public int $companyId;

    /**
     * 
     * @OA\Property(property="poll_id")
     */
    public int $pollId;

    public function __construct(int $companyId, int $pollId)
    {
        $this->companyId = $companyId;
        $this->pollId = $pollId;
    }
}