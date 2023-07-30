<?php

// src/Controller/AuthController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
    /**
     * @Route("/login_check", name="api_login_check", methods={"POST"})
     */
    public function login(Request $request, JWTTokenManagerInterface $JWTManager)
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            throw new BadCredentialsException();
        }

        $token = $JWTManager->create($user);

        return new JsonResponse(['token' => $token]);
    }
}
