<?php

namespace App\Repository;

use App\Entity\OneProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OneProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method OneProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method OneProduct[]    findAll()
 * @method OneProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OneProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OneProduct::class);
    }


    public function FindLastId()
    {
        return $this->createQueryBuilder('o')

            ->orderBy('o.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }




    // /**
    //  * @return OneProduct[] Returns an array of OneProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OneProduct
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
