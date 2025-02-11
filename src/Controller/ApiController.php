<?php

namespace App\Controller;

use App\Services\CarServices;
use App\Services\PaymentProgramChoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1')]
class ApiController extends AbstractController
{
    public function __construct(private CarServices $carServices, private PaymentProgramChoiceService $programChoiceService)
    {
    }

    #[Route(path: '/cars', methods: ['GET'])]
    public function getCars(): Response
    {
        $cars = $this->carServices->getCars()->getItems();
        $result = [];
        foreach ($cars as $car) {
            $result[] = [
                'id' => $car->getId(),
                'brand' => [
                    'id' => $car->getBrandModel()->getBrand()->getId(),
                    'name' => $car->getBrandModel()->getBrand()->getName()
                ],
                'model' => [
                    'id' => $car->getBrandModel()->getId(),
                    'name' => $car->getBrandModel()->getName(),
                ],
                'photo' => $car->getPhotoLink(),
                'price' => $car->getPrice()
            ];
        }

        return $this->json($result);
    }

    #[Route(path: '/car/{id}', methods: ['GET'])]
    public function getCar(int $id): Response
    {
        $car = $this->carServices->getCarById($id);

        return $this->json([
            'id' => $car->getId(),
            'brand' => [
                'id' => $car->getBrandModel()->getBrand()->getId(),
                'name' => $car->getBrandModel()->getBrand()->getName()
            ],
            'model' => [
                'id' => $car->getBrandModel()->getId(),
                'name' => $car->getBrandModel()->getName(),
            ],
            'photo' => $car->getPhotoLink(),
            'price' => $car->getPrice()
        ]);
    }

    #[Route(path: '/credit/calculate', methods: ['GET'])]
    public function creditCalculate(): Response
    {
        $request = Request::createFromGlobals();
        $errors = [];

        if (!$request->query->has('price')) {
            $errors[] = 'Price is required';
        }

        if (!$request->query->has('loan_term')) {
            $errors[] = 'Loan term is required';
        }

        if (!$request->query->has('initial_payment')) {
            $errors[] = 'Initial payment is required';
        }

        if (count($errors) > 0) {
            return $this->json($errors);
        }

        $price = $request->query->get('price', 0);
        $initialPayment = $request->query->get('initial_payment', 0);
        $loanTerm = $request->query->get('loan_term', 0);

        $paymentProgram = $this->programChoiceService->getProgramByParams($price, $initialPayment, $loanTerm);

        return $this->json([
            'id' => $paymentProgram->getId(),
            'interestRate' => $paymentProgram->getInterestRate(),
            'monthlyPayment' => $paymentProgram->getMonthlyPayment(),
            'title' => $paymentProgram->getTitle()
        ]);
    }
}