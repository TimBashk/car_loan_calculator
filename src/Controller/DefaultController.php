<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1')]
class DefaultController extends AbstractController
{
    public function __construct(private CarRepository $carRepository, private EntityManagerInterface $em)
    {
    }

    #[Route(path: '/cars', methods: ['GET'])]
    public function getCars(): Response
    {
        $cars = $this->carRepository->findAll();
        return $this->json($cars);
    }
}