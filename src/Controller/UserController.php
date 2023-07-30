<?php

// src/Controller/UserController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\User;

class UserController extends AbstractController
{
    private $passwordEncoder;
    private $jwtManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, JWTTokenManagerInterface $jwtManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtManager = $jwtManager;
    }

    /**
     * @Route("/api/register", methods={"POST"})
     */
    public function register(Request $request, ValidatorInterface $validator): JsonResponse
    {
        // Get the request data
        $data = json_decode($request->getContent(), true);

        // Validate the request data (name, email, password)
        $constraints = new Assert\Collection([
            'name' => [new Assert\NotBlank(), new Assert\Length(['max' => 255])],
            'email' => [new Assert\NotBlank(), new Assert\Email()],
            'password' => [new Assert\NotBlank(), new Assert\Length(['min' => 6])]
        ]);

        $violations = $validator->validate($data, $constraints);
        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Check if the user with the provided email already exists
        $existingUser = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existingUser) {
            return new JsonResponse(['message' => 'User with this email already exists'], JsonResponse::HTTP_CONFLICT);
        }

        // Create a new User entity and save it to the database
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $data['password']));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User registration successful'], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/api/login", methods={"POST"})
     */
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Find the user by email
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $data['email']]);

        // Check if the user exists and verify the password
        if (!$user || !$this->passwordEncoder->isPasswordValid($user, $data['password'])) {
            return new JsonResponse(['message' => 'Invalid credentials'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Generate the JWT token using LexikJWTAuthenticationBundle
        $token = $this->jwtManager->create($user);

        return new JsonResponse(['token' => $token], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/api/user/update", methods={"PATCH"})
     */
    public function update(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Authenticate the user based on the JWT token (you may use a middleware for this in production)
        $user = $this->getUser();

        // Update the user information
        if (isset($data['name'])) {
            $user->setName($data['name']);
        }
        if (isset($data['address'])) {
            $user->setAddress($data['address']);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new JsonResponse(['message' => 'User update successful'], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/api/user/info", methods={"GET"})
     */
    public function getUserInfo(): JsonResponse
    {
        // Authenticate the user based on the JWT token (you may use a middleware for this in production)
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Retrieve user information
        $userData = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'address' => $user->getAddress(),
        ];

        return new JsonResponse(['user' => $userData], JsonResponse::HTTP_OK);
    }
}
