<?php

namespace App\Services;

use App\DTO\BrandDto;
use App\DTO\BrandModelDto;
use App\DTO\CarDto;
use App\DTO\CarDtoItems;
use App\Entity\Car;
use App\Exception\CarNotFoundException;
use App\Repository\CarRepository;

class CarServices
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function getCars(): CarDtoItems
    {
        return new CarDtoItems(array_map(
            [$this, 'mapCarToDTO'],
            $this->carRepository->findAll()
        ));
    }

    public function getCarById(int $id): CarDto
    {
        if (null == $id) {
            throw new CarNotFoundException();
        }

        $car = $this->carRepository->find($id);
        if (!$car) {
            throw new CarNotFoundException();
        }

        return $this->mapCarToDTO($car);
    }

    private function mapCarToDTO(Car $car): CarDto
    {
        return new CarDto(
            $car->getId(),
            new BrandModelDto(
                $car->getBrandModel()->getId(),
                new BrandDto($car->getBrandModel()->getBrand()->getId(), $car->getBrandModel()->getBrand()->getName()),
                $car->getBrandModel()->getName()
            ),
            $car->getPrice(),
            $car->getPhotoLink(),
        );
    }
}