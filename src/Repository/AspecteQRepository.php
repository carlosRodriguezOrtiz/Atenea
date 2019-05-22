<?php

namespace App\Repository;

use App\Entity\AspecteQ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AspecteQ|null find($id, $lockMode = null, $lockVersion = null)
 * @method AspecteQ|null findOneBy(array $criteria, array $orderBy = null)
 * @method AspecteQ[]    findAll()
 * @method AspecteQ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AspecteQRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AspecteQ::class);
    }

    // /**
    //  * @return AspecteQ[] Returns an array of AspecteQ objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AspecteQ
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByQEId($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.CuestionesExternas = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByQIId($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.CuestionesInternas = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
}
