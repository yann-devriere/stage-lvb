<?php

namespace App\Repository;

use App\Entity\SlideAccueil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SlideAccueil|null find($id, $lockMode = null, $lockVersion = null)
 * @method SlideAccueil|null findOneBy(array $criteria, array $orderBy = null)
 * @method SlideAccueil[]    findAll()
 * @method SlideAccueil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlideAccueilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlideAccueil::class);
    }

    // /**
    //  * @return SlideAccueil[] Returns an array of SlideAccueil objects
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
    public function findOneBySomeField($value): ?SlideAccueil
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
