<?php

namespace App\Repository;

use App\Entity\PhotosQuiSommesNous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotosQuiSommesNous|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotosQuiSommesNous|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotosQuiSommesNous[]    findAll()
 * @method PhotosQuiSommesNous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotosQuiSommesNousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotosQuiSommesNous::class);
    }

    // /**
    //  * @return PhotosQuiSommesNous[] Returns an array of PhotosQuiSommesNous objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhotosQuiSommesNous
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
