<?php

namespace App\DTO;

use App\Entity\Brand;

class BrandModelDto
{
    private int $id;
    private string $name;
    private BrandDto $brandDto;

    public function __construct(int $id, BrandDto $brandDto, string $name)
    {
        $this->id = $id;
        $this->brandDto = $brandDto;
        $this->name = $name;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setId(int $id):self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name):self
    {
        $this->name = $name;
        return $this;
    }

    public function getBrand(): BrandDto
    {
        return $this->brandDto;
    }
}