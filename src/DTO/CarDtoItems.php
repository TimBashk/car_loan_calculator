<?php

namespace App\DTO;

class CarDtoItems
{
    private array $items;
    private string $color;

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

    public function getFirst(): CarDto
    {
        return $this->items[0];
    }
}