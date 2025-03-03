<?php

namespace App\Repository;

use App\Entity\Region;
use App\Repository\Abstract\AbstractRepository;
use App\Repository\Interface\PaginationRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class RegionRepository extends AbstractRepository implements PaginationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct(
            $registry,
            Region::class,
            $paginator,
        );
    }
}
