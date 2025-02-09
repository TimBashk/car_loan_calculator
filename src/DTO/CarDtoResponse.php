<?php

namespace App\DTO;

class CarDtoResponse
{
    private array $items;

    /**
     * @param CarDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return CarDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}