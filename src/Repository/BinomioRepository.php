<?php

namespace App\Repository;

use App\Entity\Binomio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Binomio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Binomio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Binomio[]    findAll()
 * @method Binomio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BinomioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Binomio::class);
    }

    // /**
    //  * @return Binomio[] Returns an array of Binomio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Binomio
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findBySelected()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.selected = 1')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
