<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photoLink = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(targetEntity: BrandModel::class, inversedBy: 'cars')]
    private BrandModel $brandModel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoLink(): ?string
    {
        return $this->photoLink;
    }

    public function setPhotoLink(string $photoLink): static
    {
        $this->photoLink = $photoLink;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBrandModel(): ?BrandModel
    {
        return $this->brandModel;
    }

    public function setBrandModel(BrandModel $brandModel): static
    {
        $this->brandModel = $brandModel;

        return $this;
    }
}
