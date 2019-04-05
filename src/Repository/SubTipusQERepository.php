<?php

namespace App\Repository;

use App\Entity\SubTipusQE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubTipusQE|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubTipusQE|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubTipusQE[]    findAll()
 * @method SubTipusQE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubTipusQERepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubTipusQE::class);
    }

    // /**
    //  * @return SubTipusQE[] Returns an array of SubTipusQE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubTipusQE
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
