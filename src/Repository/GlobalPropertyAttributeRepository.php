<?php

namespace App\Repository;

use App\Entity\GlobalPropertyAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GlobalPropertyAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalPropertyAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalPropertyAttribute[]    findAll()
 * @method GlobalPropertyAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalPropertyAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalPropertyAttribute::class);
    }

    // /**
    //  * @return GlobalPropertyAttribute[] Returns an array of GlobalPropertyAttribute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GlobalPropertyAttribute
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
