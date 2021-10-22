<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\CompanyPoll;
use App\Entity\Poll;
use App\Model\PollCreateRequest;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class PollService
{   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPoll(PollCreateRequest $pollCreateRequest): void
    {
        foreach ($pollCreateRequest->getCompanyIds() as $companyId) {
            $company = $this->entityManager->getRepository(Company::class)->find($companyId);
            $poll = $this->entityManager->getRepository(Poll::class)->find($pollCreateRequest->getPollId());
            $companyPoll = new CompanyPoll;
            $companyPoll->setCompany($company);
            $companyPoll->setPoll($poll);
            $companyPoll->setActualBefore($pollCreateRequest->getActualBefore());
            $companyPoll->setCreatedAt(new DateTimeImmutable());
            $companyPoll->setUpdatedAt(new DateTimeImmutable());
            $companyPoll->setFinished(false);
            $companyPoll->setShowAfter(new DateTimeImmutable());
            $companyPoll->setTryCount(0);
            $this->entityManager->persist($companyPoll);
        }
        $this->entityManager->flush();
    }
}