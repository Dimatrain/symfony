<?php

namespace App\Repository;

use App\Entity\Advert;
use App\Pagination\ListBuilder\AdvertsListBuilder;
use App\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    /**
     * @var AdvertsListBuilder
     */
    private $advertsList;

    public function __construct(Connection $connection, ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
        $this->advertsList = new AdvertsListBuilder($connection);
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function findPaginateAdverts(int $page = 1): Paginator
    {
        return (new Paginator($this->advertsList))->paginate($page);
    }
}
