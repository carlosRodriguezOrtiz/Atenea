<?php

namespace App\Repository;

use App\Entity\Corporacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Corporacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Corporacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Corporacion[]    findAll()
 * @method Corporacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorporacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Corporacion::class);
    }

    // /**
    //  * @return Corporacion[] Returns an array of Corporacion objects
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

    /*
    public function findOneBySomeField($value): ?Corporacion
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findByNombre($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.nombre = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}

