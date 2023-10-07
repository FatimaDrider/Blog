<?php

namespace App\Repository;

use App\Entity\MyUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MyUser>
 *
 * @method MyUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyUser[]    findAll()
 * @method MyUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyUser::class);
    }

//    /**
//     * @return MyUser[] Returns an array of MyUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MyUser
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
