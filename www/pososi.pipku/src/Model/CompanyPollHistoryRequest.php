<?php

namespace App\Model;

class CompanyPollHistoryRequest
{
    public $companyPollId;

    public $companyId;

    public function __construct(int $companyPollId, int $companyId)
    {
        $this->companyId = $companyId;
        $this->companyPollId = $companyPollId;
    }
}