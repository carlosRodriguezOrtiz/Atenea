<?php

namespace App\Repository;

use App\Entity\TipusQI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipusQI|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipusQI|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipusQI[]    findAll()
 * @method TipusQI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipusQIRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipusQI::class);
    }

    // /**
    //  * @return TipusQI[] Returns an array of TipusQI objects
    //  */
    /*
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
    */

    /*
    public function findOneBySomeField($value): ?TipusQI
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
