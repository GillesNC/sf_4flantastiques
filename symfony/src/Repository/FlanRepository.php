<?php

namespace App\Repository;

use App\Entity\Flan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flan>
 */
class FlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flan::class);
    }

    //Fonction filtre flan
    public function findbyFilters(array $filters): array
    {
        $queryBuilder = $this->createQueryBuilder('f');

        if (!empty($filters['ville'])) {
            $queryBuilder->join('f.spot', 's')
                ->join('s.city', 'c')
                ->andWhere('c.id = :ville')
                ->setParameter('ville', $filters['ville']);
        }

        if (!empty($filters['prix_max']) && $filters['prix_max'] < 10) {
            $queryBuilder->andWhere('f.price <= :prix_max')
                ->setParameter('prix_max', $filters['prix_max']);
        }

        if (!empty($filters['note'])) {
            $queryBuilder->andWhere('f.avgScore = :note')
                ->setParameter('note', $filters['note']);
        }

        if (!empty($filters['tri']) && $filters['tri'] === 'nouveaute') {
            $queryBuilder->orderBy('f.createdAt', 'DESC');
        }

        $queryBuilder->andWhere('f.status = :status')
            ->setParameter('status', 'Publié');

        return $queryBuilder->getQuery()->getResult();
    }
}
