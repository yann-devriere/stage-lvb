<?php

namespace App\Repository;

use App\Entity\SlideSalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SlideSalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method SlideSalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method SlideSalle[]    findAll()
 * @method SlideSalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlideSalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlideSalle::class);
    }

    // /**
    //  * @return SlideSalle[] Returns an array of SlideSalle objects
    //  */
    
    public function findVisible()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.visible = TRUE')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?SlideSalle
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
