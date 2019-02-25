<?php

namespace App\Repository;

use App\Entity\PurchaseEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PurchaseEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PurchaseEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PurchaseEvent[]    findAll()
 * @method PurchaseEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchaseEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PurchaseEvent::class);
    }

    // /**
    //  * @return PurchaseEvent[] Returns an array of PurchaseEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PurchaseEvent
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
