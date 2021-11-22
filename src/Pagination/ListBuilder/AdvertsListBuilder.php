<?php

namespace App\Pagination\ListBuilder;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Ifedko\DoctrineDbalPagination\ListBuilder;

class AdvertsListBuilder extends ListBuilder
{
    /**
     * @param Connection $dbConnection
     */
    public function __construct(Connection $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    /**
     * @return QueryBuilder
     */
    protected function baseQuery()
    {
        return $this->dbConnection->createQueryBuilder()
            ->select('*')
            ->from('advert')
            ->orderBy('id', 'ASC');
    }
}
