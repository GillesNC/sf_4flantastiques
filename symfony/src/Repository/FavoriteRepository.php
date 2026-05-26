<?php

namespace App\Repository;

use App\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favorite>
 */
class FavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorite::class);
    }
    public function findOneByUserAndFlan(User $user, Flan $flan): ?Favorite
    {
        return $this->findOneBy([
            'user' => $user,
            'flan' => $flan,
        ]);
    }
}
