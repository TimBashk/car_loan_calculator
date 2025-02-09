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
        $cars = $this->carRepository->findAll();

        $items = array_map(
            fn(Car $car) => new CarDto(
                $car->getId(), new BrandModelDto(
                    $car->getBrandModel()->getId(),
                    $car->getBrandModel()->getBrand()->getName() . ' ' . $car->getBrandModel()->getName(),
                ),
                $car->getPrice(),
                $car->getPhotoLink()
            ),
            $cars
        );

        return new CarDtoResponse($items);
    }

    public function getCarById(int $id): CarDtoResponse
    {
        if (null == $id) {
            throw new CarNotFoundException();
        }

        $car = $this->carRepository->getcarById($id);

        $item = array_map(
            fn(Car $car) => new CarDto(
                $car->getId(), new BrandModelDto(
                $car->getBrandModel()->getId(),
                $car->getBrandModel()->getBrand()->getName() . ' ' . $car->getBrandModel()->getName(),
            ),
                $car->getPrice(),
                $car->getPhotoLink()
            ),
            $car
        );

        return new CarDtoResponse($item);
    }
}