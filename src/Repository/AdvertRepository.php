<?php

namespace App\Repository;

use App\Entity\Advert;
use App\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function findPaginateAdverts(int $page = 1): Paginator
    {
        $qb = $this->createQueryBuilder('adv')
            ->orderBy('adv.id', 'ASC');

        return (new Paginator($qb))->paginate($page);
    }
}
