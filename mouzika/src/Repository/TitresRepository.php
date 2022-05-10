<?php

namespace App\Repository;

use App\Entity\Titres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Titres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Titres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Titres[]    findAll()
 * @method Titres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TitresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Titres::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Titres $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Titres $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Titres[] Returns an array of Titres objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Titres
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function calcul($rating)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.rating = :val')
            ->setParameter('val', $rating)
            ->getQuery()
            ->getResult()
            ;

    }
}
