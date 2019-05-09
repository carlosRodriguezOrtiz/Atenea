<?php

namespace App\Repository;

use App\Entity\Dafo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dafo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dafo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dafo[]    findAll()
 * @method Dafo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DafoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dafo::class);
    }

    // /**
    //  * @return Dafo[] Returns an array of Dafo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dafo
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
