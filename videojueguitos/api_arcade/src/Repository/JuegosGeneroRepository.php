<?php

namespace App\Repository;

use App\Entity\JuegosGenero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JuegosGenero>
 *
 * @method JuegosGenero|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuegosGenero|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuegosGenero[]    findAll()
 * @method JuegosGenero[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegosGeneroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegosGenero::class);
    }
        
            /**
             * @return JuegosGenero[] Returns an array of JuegosGenero objects
             */
            public function findByGeneroID($value): array
            {
                return $this->createQueryBuilder('jg')
                ->andWhere('jg.genero_id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult();
            }

    //    public function findOneBySomeField($value): ?JuegosGenero
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
