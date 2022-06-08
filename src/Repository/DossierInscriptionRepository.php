<?php

namespace App\Repository;

use App\Entity\DossierInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DossierInscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierInscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierInscription[]    findAll()
 * @method DossierInscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierInscription::class);
    }

    // /**
    //  * @return DossierInscription[] Returns an array of DossierInscription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DossierInscription
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
