<?php

namespace App\Repository;

use App\Entity\CarOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarOption>
 *
 * @method CarOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarOption[]    findAll()
 * @method CarOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarOption::class);
    }

//    /**
//     * @return Option[] Returns an array of Option objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Option
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
