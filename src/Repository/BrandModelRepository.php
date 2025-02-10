<?php

namespace App\Repository;

use App\Entity\BrandModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BrandModel>
 *
 * @method BrandModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandModel[]    findAll()
 * @method BrandModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandModel::class);
    }
}
