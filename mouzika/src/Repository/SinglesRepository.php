<?php

namespace App\Repository;

use App\data\searchData;
use App\Entity\Singles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Singles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Singles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Singles[]    findAll()
 * @method Singles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SinglesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Singles::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Singles $entity, bool $flush = true): void
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
    public function remove(Singles $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Singles[] Returns an array of Singles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Singles
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     *@return Singles[]
     */
    public function findSearch(searchData $search ) : array
    {
        $query = $this->createQueryBuilder('u')->select('u');



        if ($search->q){
            $query =
                $query
                    ->where('u.artist LIKE :q OR u.singleName LIKE :q')
                    ->setParameter('q','%' .$search->q .'%');
                    //->andWhere('u.singleName LIKE :p')
                    //->setParameter('p','%' .$search->p .'%');
        }




        return $query->getQuery()->getResult();
    }

}
