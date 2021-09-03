<?php

namespace App\Repository;

use App\Entity\Provincias;
use App\Entity\Restaurante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Provincias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provincias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provincias[]    findAll()
 * @method Provincias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvinciasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provincias::class);
    }

    // /**
    //  * @return Restaurante[] Returns an array of Restaurante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Restaurante
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
