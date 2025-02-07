<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1')]
class DefaultController extends AbstractController
{
    #[Route(path: '/test', methods: ['GET'])]
    public function test(): Response
    {
        return $this->json(['test' => 12345]);
    }
}