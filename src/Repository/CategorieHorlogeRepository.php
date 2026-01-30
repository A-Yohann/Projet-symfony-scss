<?php

namespace App\Repository;

use App\Entity\CategorieHorloge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategorieHorlogeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieHorloge::class);
    }

    public function findByMecanismes(array $mecanismes): array
    {
        // Si une horloge a UN seul mécanisme (relation ManyToOne)
        return $this->createQueryBuilder('h')
            ->where('h.mecanisme IN (:mecanismes)')
            ->setParameter('mecanismes', $mecanismes)
            ->getQuery()
            ->getResult();
    }
}
    //    /**
    //     * @return CategorieHorloge[] Returns an array of CategorieHorloge objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CategorieHorloge
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

