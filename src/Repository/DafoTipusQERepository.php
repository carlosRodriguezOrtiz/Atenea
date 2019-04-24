<?php

namespace App\Repository;

use App\Entity\DafoTipusQE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DafoTipusQE|null find($id, $lockMode = null, $lockVersion = null)
 * @method DafoTipusQE|null findOneBy(array $criteria, array $orderBy = null)
 * @method DafoTipusQE[]    findAll()
 * @method DafoTipusQE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DafoTipusQERepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DafoTipusQE::class);
    }

    // /**
    //  * @return DafoTipusQE[] Returns an array of DafoTipusQE objects
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
    public function findOneBySomeField($value): ?DafoTipusQE
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
