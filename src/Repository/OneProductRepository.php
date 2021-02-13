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

    public function FindLastFourID()
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }

        //$pcstuff = id 1 2 3 4  de la catégorie
    public function FindStuff($pcstuff){
       // On selectionne tout les champs de la table one_product
       // Select * FROM OneProduct
        $qb = $this->createQueryBuilder('op') // op = one_product
        //On joint la table one_product à la table pcstuff
                    ->innerJoin('op.pcstuff', 'ps')
                    ->andWhere('ps = :pcstuff')
                    ->setParameter('pcstuff', $pcstuff);

       // dump($qb->getQuery()->getResult());
        return $qb->getQuery()->getResult();

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
