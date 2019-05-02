<?php

namespace App\Repository;

use App\Entity\Emergente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Emergente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emergente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emergente[]    findAll()
 * @method Emergente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmergenteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Emergente::class);
    }

    // /**
    //  * @return Emergente[] Returns an array of Emergente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emergente
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
