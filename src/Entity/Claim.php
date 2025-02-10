<?php

namespace App\Entity;

use App\Repository\ClaimRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClaimRepository::class)]
class Claim
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PaymentProgram::class)]
    private PaymentProgram $paymentProgram;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    private Car $car;

    #[ORM\Column]
    private ?int $initialPayment = null;

    #[ORM\Column]
    private ?int $loanTerm = null;

    #[ORM\Column]
    private ?int $monthlyPayment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentProgram(): PaymentProgram
    {
        return $this->paymentProgram;
    }

    public function setPaymentProgram(PaymentProgram $paymentProgram): static
    {
        $this->paymentProgram = $paymentProgram;

        return $this;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getInitialPayment(): ?int
    {
        return $this->initialPayment;
    }

    public function setInitialPayment(int $initialPayment): static
    {
        $this->initialPayment = $initialPayment;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loanTerm;
    }

    public function setLoanTerm(int $loanTerm): static
    {
        $this->loanTerm = $loanTerm;

        return $this;
    }
}
