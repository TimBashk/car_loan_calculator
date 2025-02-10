<?php

namespace App\DTO;

class PaymentProgramResponseDto
{
    private array $items;
    private int $monthlyPayment;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setMonthlyPayment(int $monthlyPayment): self
    {
        $this->monthlyPayment = $monthlyPayment;
        return $this;
    }
}