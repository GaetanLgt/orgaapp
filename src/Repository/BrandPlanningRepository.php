<?php

namespace App\Repository;

use App\Entity\BrandPlanning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BrandPlanning>
 *
 * @method BrandPlanning|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandPlanning|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandPlanning[]    findAll()
 * @method BrandPlanning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandPlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandPlanning::class);
    }

    public function add(BrandPlanning $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BrandPlanning $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BrandPlanning[] Returns an array of BrandPlanning objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BrandPlanning
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
