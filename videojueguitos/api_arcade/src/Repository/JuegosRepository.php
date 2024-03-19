<?php

namespace App\Repository;

use App\Entity\Juegos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Juegos>
 *
 * @method Juegos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Juegos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Juegos[]    findAll()
 * @method Juegos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Juegos::class);
    }

        
            /**
             * @return Juegos[] Returns an array of Juegos objects
             */
            public function findByGeneros($genero): array
            {
                return $this->createQueryBuilder('j')
                ->from('App\Entity\Juego', 'j')
                ->join('App\Entity\JuegoGenero', 'jg', 'WITH', 'j.id = jg.juego')
                ->join('App\Entity\Genero', 'g', 'WITH', 'jg.genero = g.id')
                ->where('g.id = :generoId')
                ->setParameter('generoId', $genero)
                ->orderBy('j.id', 'ASC')
                ->getQuery()
                ->getResult();
            }

    //    public function findOneBySomeField($value): ?Juegos
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
