<?php

namespace App\Repository\Interface;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\Request;

interface PaginationRepositoryInterface
{
    /**
     * @param $page
     * @param array $criteria
     * @param array $orderBy
     * @return PaginationInterface
     */
    public function paginate($page, array $criteria = [], array $orderBy = []): PaginationInterface;
}