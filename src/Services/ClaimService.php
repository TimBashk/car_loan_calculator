<?php

namespace App\Services;

use App\Entity\Claim;
use App\Exception\CarNotFoundException;
use App\Exception\ProgramNotFoundException;
use App\Repository\CarRepository;
use App\Repository\PaymentProgramRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClaimService
{
    public function __construct(
        private EntityManagerInterface $em,
        private CarRepository $carRepository,
        private PaymentProgramRepository $programRepository
    )
    {
    }

    public function saveClaim(int $carId, int $programId, int $initialPayment, int $loanTerm): bool
    {
        $car = $this->carRepository->find($carId);
        $program = $this->programRepository->find($programId);

        if (!$car) {
            throw new CarNotFoundException();
        }

        if (!$program) {
            throw new ProgramNotFoundException();
        }

        $claim = new Claim();
        $claim->setCar($car)
            ->setInitialPayment($initialPayment)
            ->setLoanTerm($loanTerm);

        try {
            $this->em->persist($claim);
            $this->em->flush();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}