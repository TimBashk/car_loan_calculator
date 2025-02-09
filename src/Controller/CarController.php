<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\BrandModel;
use App\Entity\Car;
use App\Repository\CarRepository;
use App\Services\CarServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1')]
class CarController extends AbstractController
{
    public function __construct(private CarServices $carServices)
    {
    }

    #[Route(path: '/cars', methods: ['GET'])]
    public function getCars(): Response
    {
        $cars = $this->carServices->getCars();

        return $this->json($cars);
    }

    #[Route(path: '/car/{id}', methods: ['GET'])]
    public function getCar(int $id): Response
    {
        $car = $this->carServices->getCarById($id);

        return $this->json($car);
    }
}