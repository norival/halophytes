<?php

namespace App\Repository;

use App\Entity\SpeciesFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpeciesFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpeciesFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpeciesFeature[]    findAll()
 * @method SpeciesFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpeciesFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpeciesFeature::class);
    }

    // /**
    //  * @return SpeciesFeature[] Returns an array of SpeciesFeature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpeciesFeature
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
