<?php

namespace App\DTO;

class CarDto
{
    private int $id;
    private BrandModelDto $brandModelDto;
    private int $price;
    private string $photoLink;

    public function __construct(int $id, BrandModelDto $brandModelDto, int $price, string $photoLink)
    {
        $this->id = $id;
        $this->brandModelDto = $brandModelDto;
        $this->price = $price;
        $this->photoLink = $photoLink;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrandModel(): BrandModelDto
    {
        return $this->brandModelDto;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getPhotoLink(): string
    {
        return $this->photoLink;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setBrandModel(BrandModelDto $brandModelDto): self
    {
        $this->brandModelDto = $brandModelDto;
        return $this;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function setPhotoLink(string $photoLink): self
    {
        $this->photoLink = $photoLink;
        return $this;
    }

}