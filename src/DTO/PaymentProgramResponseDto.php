<?php

namespace App\DTO;

class PaymentProgramResponseDto
{
    private array $items;

    /**
     * @param PaymentProgramDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getFirst(): PaymentProgramDto
    {
        return $this->items[0];
    }
}