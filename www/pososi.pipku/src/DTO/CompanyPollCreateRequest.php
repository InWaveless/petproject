<?php
declare(strict_types=1);
namespace App\DTO;

use OpenApi\Annotations as OA;

class CompanyPollCreateRequest
{
    /**
    * @OA\Property(property="company_ids",
    *   type="array",
    *   @OA\Items(type="integer")
    * )
    */
    private $companyIds;

    /**
    * @OA\Property(property="poll_id")
    */
    private int $pollId;

    /**
    * @OA\Property(property="actual_before")
    */
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