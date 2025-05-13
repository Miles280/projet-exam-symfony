<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Role>
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    /**
     * Récupère tous les rôles dont le nom correspond exactement à la valeur donnée,
     * triés par nombre minimum de joueurs croissant.
     *
     * @param string $value Le nom du rôle à rechercher
     *
     * @return Role[] Un tableau d'entités Role correspondant au nom donné
     */
    public function findByName($value): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.name LIKE :val')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('r.minPlayer', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Récupère tous les rôles appartenant à un camp donné,
     * triés par nombre minimum de joueurs croissant.
     *
     * @param Camp|string $camp Le camp (objet Enum ou string) à filtrer (ex: 'villageois', 'sorciere', etc.)
     *
     * @return Role[] Un tableau d'entités Role correspondant au camp donné
     */
    public function findByCamp($camp): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.camp = :val')
            ->setParameter('val', $camp)
            ->orderBy('r.minPlayer', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //    public function findOneBySomeField($value): ?Role
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
