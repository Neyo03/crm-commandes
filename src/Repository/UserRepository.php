<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\Abstract\AbstractRepository;
use App\Repository\Interface\PaginationRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class UserRepository extends AbstractRepository implements PaginationRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        PaginatorInterface $paginator
    )
    {
        parent::__construct(
            $registry,
            User::class,
            $paginator);
    }
}
