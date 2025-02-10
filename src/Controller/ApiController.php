<?php

namespace App\Controller;

use App\Services\CarServices;
use App\Services\PaymentProgramChoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1')]
class ApiController extends AbstractController
{
    public function __construct(private CarServices $carServices, PaymentProgramChoiceService $programChoiceService)
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

    #[Route(path: '/credit/calculate', methods: ['GET'])]
    public function creditCalculate(): Response
    {
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

        $price = $request->query->get('price', 0);
        $initialPayment = $request->query->get('initial_payment', 0);
        $loanTerm = $request->query->get('loan_term', 0);

        return $this->json([
            'price' => $price,
            'initialPayment' => $initialPayment,
            'loanTerm' => $loanTerm
        ]);
    }
}