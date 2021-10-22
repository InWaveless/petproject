<?php
declare(strict_types=1);
namespace App\Model;

class PollCreateRequest
{
    private $companyIds;

    private int $pollId;

    private \DateTimeImmutable $actualBefore;

    public function getCompanyIds(): array {
        return $this->companyIds;
    }

    public function setCompanyIds(int ...$companyIds): void
    {
        $this->companyIds = $companyIds;
    }

    public function getPollId(): int {
        return $this->pollId;
    }

    public function setPollId(int $pollId): void {
        $this->pollId = $pollId;
    }

    public function getActualBefore(): \DateTimeImmutable {
        return $this->actualBefore;
    }

    public function setActualBefore(\DateTimeImmutable $actualBefore): void {
        $this->actualBefore = $actualBefore;
    }
}