<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function paginationQuery($page, $limit, $filters = null)
    {
        $query = $this->createQueryBuilder('c');
            //->where('c.active = 1');
         //    ->setParameter('val', $value)
         if($filters != null){
            $query->andWhere('c.cars IN(:cars)')
                  ->setParameter(':cars', array_values($filters));
            $query->orderBy('c.id', 'ASC')
                  ->getQuery()
                  ->setMaxResults($limit);
         }
         
         
         return $query->getQuery()->getResult();
    }
    public function findAllCars($filters = null){
        $query = $this->createQueryBuilder('c')
               ->select('COUNT(c)');
               if($filters != null){
                $query->andWhere('c.cars IN(:cars)')
                      ->setParameter(':cars', array_values($filters));
                $query->orderBy('c.id', 'ASC')
                      ->getQuery();
                    //   ->setMaxResults($limit);
             }
             
    }
    
    // public function getCustomInformations()
    // {
    //     $sql = "SELECT * FROM car  WHERE year = :year";
    
    //     $query = $this->getEntityManager()->getConnection()->prepare($sql);
    //     $query->execute([]);
    
    //     return $query->fetchAll();
    // }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.color = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
//       /**
//      * Show cars
//      * @param integer $carYear
//      * @return array
//      */
//     public function findCarByYear() : array {
//         return  $this->createQueryBuilder('c')
//                 ->where('c.year LIKE :year')
//                 ->setParameter('year', '%year%')
//                 ->orderBy('c.title', 'ASC')
//                 ->getQuery()
//                 ->getResult();
// } 


//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
