<?php

namespace App\Repository;

use App\Entity\CompanyPollAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyPollAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyPollAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyPollAnswer[]    findAll()
 * @method CompanyPollAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyPollAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyPollAnswer::class);
    }

    // /**
    //  * @return CompanyPollAnswer[] Returns an array of CompanyPollAnswer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanyPollAnswer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
