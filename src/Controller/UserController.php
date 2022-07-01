<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    // #[Route('/api/login_check', name: 'login_check', methods: "POST")]
    // public function api_login(): JsonResponse
    // {
    //     $user = $this->getUser();

    //     return new JsonResponse([
    //         // 'email' => $user->getEmail(),
    //         'roles' => $user->getRoles(),
    //     ]);
    // }
}
