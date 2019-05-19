<?php

namespace App\Repository;

use App\Entity\QuestionsExternes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuestionsExternes|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionsExternes|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionsExternes[]    findAll()
 * @method QuestionsExternes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsExternesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuestionsExternes::class);
    }

    // /**
    //  * @return QuestionsExternes[] Returns an array of QuestionsExternes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionsExternes
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByEmpresaId($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.empresa = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCentroId($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.centro = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCorporacionId($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.corporacion = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}
