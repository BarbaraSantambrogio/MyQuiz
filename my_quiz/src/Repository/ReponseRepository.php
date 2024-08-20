<?php

namespace App\Repository;

use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reponse>
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function findByQuestion($id_question): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_question = :id_question')
            ->setParameter('id_question', $id_question)
            ->getQuery()
            ->getResult()
        ;
    }

    

    public function findAllWithQuestion($id_question): array
    {
        return $this->createQueryBuilder('r')
         //    ->join('q.id_categorie', 'c')
            ->andWhere('r.id_question = :id_question')
            ->setParameter('id_question', $id_question)
            ->getQuery()
            ->getResult();
    }



    //    /**
    //     * @return Reponse[] Returns an array of Reponse objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reponse
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
