<?php

namespace App\Repository;

use App\Entity\CompanyPoll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyPoll|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyPoll|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyPoll[]    findAll()
 * @method CompanyPoll[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyPollRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyPoll::class);
    }

    // /**
    //  * @return CompanyPoll[] Returns an array of CompanyPoll objects
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
    public function findOneBySomeField($value): ?CompanyPoll
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
