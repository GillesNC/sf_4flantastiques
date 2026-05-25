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
            $queryBuilder->andWhere('f.city = :ville')
                ->setParameter('ville', $filters['ville']);
        }

        if (!empty($filters['prix_max'])) {
            $queryBuilder->andWhere('f.price <= :prix_max')
                ->setParameter('prix_max', $filters['prix_max']);
        }

        if (!empty($filters['note_min'])) {
            $queryBuilder->andWhere('f.avgScore >= :note_min')
                ->setParameter('note_min', $filters['note_min']);
        }

        if (!empty($filters['tri']) && $filters['tri'] === 'nouveaute') {
            $queryBuilder->orderBy('f.createdAt', 'DESC');
        }

        $queryBuilder->andWhere('f.status = :status')
            ->setParameter('status', 'published');

        return $queryBuilder->getQuery()->getResult();
    }
}
