<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class DefaultController extends AbstractController
{
    #[Route('/api/default', name: 'app_default')]
    public function index(): JsonResponse
    {
        return $this->json(['message' => 'coucou']);
    }
}
