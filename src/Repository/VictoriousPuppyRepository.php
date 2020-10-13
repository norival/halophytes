<?php

namespace App\Repository;

use App\Entity\VictoriousPuppy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VictoriousPuppy|null find($id, $lockMode = null, $lockVersion = null)
 * @method VictoriousPuppy|null findOneBy(array $criteria, array $orderBy = null)
 * @method VictoriousPuppy[]    findAll()
 * @method VictoriousPuppy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VictoriousPuppyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VictoriousPuppy::class);
    }

    // /**
    //  * @return VictoriousPuppy[] Returns an array of VictoriousPuppy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VictoriousPuppy
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
