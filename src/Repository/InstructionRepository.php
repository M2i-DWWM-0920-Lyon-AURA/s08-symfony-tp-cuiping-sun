<?php

namespace App\Repository;

use App\Entity\Instruction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Instruction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instruction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instruction[]    findAll()
 * @method Instruction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstructionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instruction::class);
    }

    // /**
    //  * @return Instruction[] Returns an array of Instruction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instruction
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
