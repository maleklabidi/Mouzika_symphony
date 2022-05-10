<?php

namespace App\Repository;

use App\Entity\Nouveautes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nouveautes>
 *
 * @method Nouveautes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nouveautes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nouveautes[]    findAll()
 * @method Nouveautes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NouveautesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nouveautes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Nouveautes $entity, bool $flush = true): void
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
    public function remove(Nouveautes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Nouveautes[] Returns an array of Nouveautes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nouveautes
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
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
