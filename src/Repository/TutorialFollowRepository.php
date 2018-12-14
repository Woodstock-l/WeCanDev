<?php

namespace App\Repository;

use App\Entity\TutorialFollow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TutorialFollow|null find($id, $lockMode = null, $lockVersion = null)
 * @method TutorialFollow|null findOneBy(array $criteria, array $orderBy = null)
 * @method TutorialFollow[]    findAll()
 * @method TutorialFollow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorialFollowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TutorialFollow::class);
    }

    /**
     * @return TutorialFollow[] Returns an array of TutorialFollow objects
     */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($value): ?TutorialFollow
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
