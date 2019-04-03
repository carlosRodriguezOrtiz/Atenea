<?php

namespace App\Repository;

use App\Entity\TipusQE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipusQE|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipusQE|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipusQE[]    findAll()
 * @method TipusQE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipusQERepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipusQE::class);
    }

    // /**
    //  * @return TipusQE[] Returns an array of TipusQE objects
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
    public function findOneBySomeField($value): ?TipusQE
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
