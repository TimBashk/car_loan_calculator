<?php

namespace App\DTO;

class PaymentProgramDto
{
    private int $id;
    private float $interestRate;
    private string $title;

    public function __construct(int $id, float $interestRate, string $title)
    {
        $this->id = $id;
        $this->interestRate = $interestRate;
        $this->title = $title;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): self
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

}