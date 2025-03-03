<?php

namespace App\Repository\Abstract;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


abstract class AbstractRepository extends ServiceEntityRepository
{
    protected PaginatorInterface $paginator;
    protected string $entityClass;

    public function __construct(ManagerRegistry $registry, string $entityClass, PaginatorInterface $paginator)
    {
        parent::__construct($registry, $entityClass);
        $this->paginator = $paginator;
        $this->entityClass = $entityClass;
    }

    /**
     * Méthode générique pour la pagination de n'importe quelle entité.
     *
     * @param $page
     * @param array $criteria
     * @param array $orderBy
     *
     * @return PaginationInterface
     */
    public function paginate($page, array $criteria = [], array $orderBy = []): PaginationInterface
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
            ->from($this->entityClass, 'e');

        if (!empty($criteria)) {
            foreach ($criteria as $field => $value) {
                $qb->andWhere("e.$field = :$field")
                    ->setParameter($field, $value);
            }
        }

        if (!empty($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $qb->addOrderBy("e.$field", $direction);
            }
        }

        $query = $qb->getQuery();

        return $this->paginator->paginate(
            $query,
            $page,
            10
        );
    }
}