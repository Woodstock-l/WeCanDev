<?php

namespace App\Repository;

use App\Entity\Tutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TutorialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tutorial::class);
    }

    public function findByPage($page = 1, $count = 5, $published = null) {
        $offset = ($page - 1) * $count; 
        $queryBuilder = $this->createQueryBuilder('a')
            ->select('a')
            ->setFirstResult($offset)
            ->setMaxResults($count)
            ->orderBy('a.id', 'DESC')
        ;

        if(!is_null($published)) {
            $queryBuilder->where('a.published = :published')
                ->setParameter(':published', $published);
        }

        return new Paginator($queryBuilder);
    }

    public function findBySearch($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.title LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}
