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
     * Recherche les rôles selon des critères facultatifs de nom et de camp.
     *
     * Cette méthode utilise un QueryBuilder modulable pour permettre une recherche
     * flexible :
     * - Si le paramètre $search est renseigné, elle effectue une recherche partielle
     *   sur le nom du rôle (`LIKE`).
     * - Si le paramètre $camp est renseigné, elle filtre les rôles appartenant à ce camp.
     * - Si aucun des deux paramètres n'est renseigné, elle retourne tous les rôles.
     *
     * Les résultats sont toujours triés par nombre minimum de joueurs (minPlayer) de façon croissante.
     *
     * @param string|null $search Une chaîne partielle à rechercher dans le nom du rôle (ou null pour ignorer)
     * @param string|null $camp   Le nom exact du camp à filtrer (ou null pour ignorer)
     *
     * @return Role[] Un tableau d'entités Role correspondant aux critères de recherche
     */
    public function findWithSearch(?string $search = null, ?string $camp = null): array
    {
        $qb = $this->createQueryBuilder('r');

        if ($search) {
            $qb->andWhere('r.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }
        if ($camp) {
            $qb->andWhere('r.camp = :camp')
                ->setParameter('camp', $camp);
        }
        return $qb->orderBy('r.minPlayer', 'ASC')
            ->getQuery()
            ->getResult();
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
    // Ancienne commande non utilisée

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
    // Ancienne commande non utilisée

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
