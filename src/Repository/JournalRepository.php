<?php

namespace App\Repository;

use App\Entity\Journal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Journal>
 */
class JournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Journal::class);
    }

//    /**
//     * @return Journal[] Returns an array of Journal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Journal
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getTotalMontantParType(){
        return $this->createQueryBuilder('j')
        ->select('j.typeJournal AS typeJournal, SUM(j.montant) AS totalMontant')
        ->where('j.typeJournal != 2')
        ->groupBy('j.typeJournal')
        ->getQuery()
        ->getResult();
    }
    public function getSoldeParMois()
    {
        return $this->createQueryBuilder('j')
            ->select('YEAR(j.dateJournal) AS annee')
            ->addSelect('MONTH(j.dateJournal) AS mois')
            ->addSelect('SUM(CASE WHEN j.typeJournal = 0 THEN j.montant ELSE 0 END) AS totalTypeNiditra')
            ->addSelect('SUM(CASE WHEN j.typeJournal = 1 THEN j.montant ELSE 0 END) AS totalTypeNivoaka')
            ->where('j.typeJournal IN (0,1)')
            ->groupBy('annee')
            ->addGroupBy('mois')
            ->orderBy('annee', 'ASC')
            ->addOrderBy('mois', 'ASC')
            ->getQuery()
            ->getResult();
    }


}
