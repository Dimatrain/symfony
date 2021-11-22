<?php

namespace App\Pagination;

use Ifedko\DoctrineDbalPagination\ListBuilder;
use Ifedko\DoctrineDbalPagination\ListPagination;

class Paginator
{
    public const PAGE_SIZE = 5;

    /**
     * @var ListBuilder
     */
    private $listBuilder;
    private $currentPage;
    private $pageSize;
    private $results;
    private $numResults;

    public function __construct(ListBuilder $listBuilder, int $pageSize = self::PAGE_SIZE)
    {
        $this->listBuilder = $listBuilder;
        $this->pageSize = $pageSize;
    }

    public function paginate(int $page = 1): self
    {
        $listPagination = new ListPagination($this->listBuilder);
        $listPage = $listPagination->get($this->pageSize, $page);

        $this->currentPage = max(1, $page);

        $this->results = $listPage['items'] ?? [];
        $this->numResults = $listPage['total'] ?? 0;

        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getLastPage(): int
    {
        return (int) ceil($this->numResults / $this->pageSize);
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function getPreviousPage(): int
    {
        return max(1, $this->currentPage - 1);
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->getLastPage();
    }

    public function getNextPage(): int
    {
        return min($this->getLastPage(), $this->currentPage + 1);
    }

    public function hasToPaginate(): bool
    {
        return $this->numResults > $this->pageSize;
    }

    public function getNumResults(): int
    {
        return $this->numResults;
    }

    public function getResults()
    {
        return $this->results;
    }
}
