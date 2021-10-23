<?php
declare(strict_types=1);
namespace App\Model;

class CompanyPollGetRequest
{
    public int $companyId;
    
    public int $pollId;

    public function __construct(int $companyId, int $pollId)
    {
        $this->companyId = $companyId;
        $this->pollId = $pollId;
    }
}