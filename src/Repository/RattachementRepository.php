<?php

namespace App\Repository;

use App\Entity\Rattachement;
use App\Repository\Abstract\AbstractRepository;
use App\Repository\Interface\PaginationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class RattachementRepository extends AbstractRepository implements PaginationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct(
            $registry,
            Rattachement::class,
            $paginator);
    }
}
