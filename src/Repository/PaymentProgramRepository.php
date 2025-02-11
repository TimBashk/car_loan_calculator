<?php

namespace App\Repository;

use App\Entity\PaymentProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaymentProgram>
 *
 * @method PaymentProgram|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentProgram|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentProgram[]    findAll()
 * @method PaymentProgram[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentProgram::class);
    }
}
