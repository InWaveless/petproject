<?php

namespace App\Repository;

use App\Entity\CompanyPollQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyPollQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyPollQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyPollQuestion[]    findAll()
 * @method CompanyPollQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyPollQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyPollQuestion::class);
    }

    // /**
    //  * @return CompanyPollQuestion[] Returns an array of CompanyPollQuestion objects
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
    public function findOneBySomeField($value): ?CompanyPollQuestion
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
