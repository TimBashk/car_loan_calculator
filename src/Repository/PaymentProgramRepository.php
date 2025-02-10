<?php

namespace App\Repository;

use App\Entity\Car;
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

    /**
     * @param int $id
     * @return PaymentProgram[]
     */
    public function getProgramById(int $id): array
    {
        $query = $this->_em->createQuery('SELECT program FROM App\Entity\PaymentProgram program WHERE program.id = :id');
        $query->setParameter('id', $id);

        return $query->getResult();
    }

    public function findByAlias(string $alias): array
    {
        $query = $this->_em->createQuery('SELECT program FROM App\Entity\PaymentProgram program WHERE program.alias = :alias');
        $query->setParameter('alias', $alias);

        return $query->getResult();
    }
}
