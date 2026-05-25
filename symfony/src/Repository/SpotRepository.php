<?php

namespace App\Repository;

use App\Entity\Spot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Spot>
 */
class SpotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spot::class);
    }

    //    /**
    //     * @return Spot[] Returns an array of Spot objects
    //     */

    public function findBySearch($value): array
    {
        $value = '%' . $value . '%';

        return $this->createQueryBuilder('s')
            ->join('s.city', 'c')
            ->andWhere('s.name LIKE :search')
            ->orWhere('c.name LIKE :search')
            ->orWhere('s.postalCode LIKE :search')
            ->setParameter('search', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Spot
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
