<?php

namespace App\Repository;

use App\Entity\FactorCriticoDeExito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FactorCriticoDeExito|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactorCriticoDeExito|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactorCriticoDeExito[]    findAll()
 * @method FactorCriticoDeExito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactorCriticoDeExitoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FactorCriticoDeExito::class);
    }

    // /**
    //  * @return FactorCriticoDeExito[] Returns an array of FactorCriticoDeExito objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FactorCriticoDeExito
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByBinomioId($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.binomio = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
