<?php

namespace App\Repository;

use App\Entity\QuestionsInternes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuestionsInternes|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionsInternes|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionsInternes[]    findAll()
 * @method QuestionsInternes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsInternesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuestionsInternes::class);
    }

    // /**
    //  * @return QuestionsInternes[] Returns an array of QuestionsInternes objects
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
    public function findOneBySomeField($value): ?QuestionsInternes
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
