<?php

namespace App\Repository;

use App\Entity\Centro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Centro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Centro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Centro[]    findAll()
 * @method Centro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentroRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Centro::class);
    }

    // /**
    //  * @return Centro[] Returns an array of Centro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

  /**
      * @return Centro[] Returns an array of Centro objects
      */

      public function findLikeNom($value)
      {
          return $this->createQueryBuilder('s')
              ->andWhere('s.nombre like :val')
              ->setParameter('val', '%'.$value.'%')
              ->orderBy('s.id', 'ASC')
              ->setMaxResults(1000)
              ->getQuery()
              ->getResult()
          ;
      }
    

    /*
    public function findOneBySomeField($value): ?Centro
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
