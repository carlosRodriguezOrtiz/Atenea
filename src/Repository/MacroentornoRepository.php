<?php

namespace App\Repository;

use App\Entity\Macroentorno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Macroentorno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Macroentorno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Macroentorno[]    findAll()
 * @method Macroentorno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MacroentornoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Macroentorno::class);
    }

    // /**
    //  * @return Macroentorno[] Returns an array of Macroentorno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Macroentorno
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
