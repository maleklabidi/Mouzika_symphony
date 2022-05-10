<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function trierprenom1()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function trierprenom2()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.prenom', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function triernom1()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function triernom2()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.nom', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function trieremail1()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.email', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function trieremail2()
    {
        return $this->createQueryBuilder('User')
            ->orderBy('User.email', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function finduserbynom($nom)
    {
        return $this->createQueryBuilder('User')
            ->where('User.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }
    public function getmdp($id)
    {
        return $this->createQueryBuilder('User')
            ->where('User.id_user =:id')
            ->setParameter('id', '$id')
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
