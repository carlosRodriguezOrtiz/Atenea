<?php

namespace App\Repository;

use App\Entity\DafoTipusQI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DafoTipusQI|null find($id, $lockMode = null, $lockVersion = null)
 * @method DafoTipusQI|null findOneBy(array $criteria, array $orderBy = null)
 * @method DafoTipusQI[]    findAll()
 * @method DafoTipusQI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DafoTipusQIRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DafoTipusQI::class);
    }

    // /**
    //  * @return DafoTipusQI[] Returns an array of DafoTipusQI objects
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
    public function findOneBySomeField($value): ?DafoTipusQI
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
