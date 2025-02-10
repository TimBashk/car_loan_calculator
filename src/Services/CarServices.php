<?php

namespace App\Services;

use App\DTO\BrandModelDto;
use App\DTO\CarDto;
use App\DTO\CarDtoResponse;
use App\Entity\Car;
use App\Exception\CarNotFoundException;
use App\Repository\CarRepository;

class CarServices
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function getCars(): CarDtoResponse
    {
        return new CarDtoResponse(array_map(
            [$this, 'mapCarToDTO'],
            $this->carRepository->findAll()
        ));
    }

    public function getCarById(int $id): CarDtoResponse
    {
        if (null == $id) {
            throw new CarNotFoundException();
        }

        return new CarDtoResponse(array_map(
            [$this, 'mapCarToDTO'],
            $this->carRepository->getcarById($id)
            ));
    }

    private function mapCarToDTO(Car $car): CarDto
    {
        return new CarDto(
            $car->getId(),
            new BrandModelDto(
                $car->getBrandModel()->getId(),
                $car->getBrandModel()->getBrand()->getName() . ' ' . $car->getBrandModel()->getName(),
            ),
            $car->getPrice(),
            $car->getPhotoLink(),
        );
    }
}