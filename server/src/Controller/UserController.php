<?php

namespace App\Controller;

use App\Dto\Incoming\CreateUserDto;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\UserService;
use App\Serialization\SerializationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends ApiController
{
    private UserService $userService;

    public function __construct(
        SerializationService $serializationService,
        UserService $userService
    ) {
        parent::__construct($serializationService);
        $this->userService = $userService;
    }

    #[Route('/api/users', methods: ['GET'])]
    public function getAllUsers(): Response
    {
        return $this->json($this->userService->getAllUsers());
    }

    #[Route('/api/users/{userId}', methods: ['GET'])]
    public function getUserById(int $userId): Response
    {
        return $this->json($this->userService->getUserById($userId));
    }

    #[Route('/api/users/{userId}/games', methods: ['GET'])]
    public function getUserGames(int $userId): Response
    {
        return $this->json($this->userService->getUserGames($userId));
    }

    #[Route('/api/users/{auth0}/user', methods: ['GET'])]
    public function getUserByAuth(string $auth0): Response
    {
        return $this->json($this->userService->getUserByAuth0($auth0));
    }

    #[Route('/api/users/createNew/{auth0}', methods: ['POST'])]
    public function createNewUser(Request $request, string $auth0): Response
    {
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        return $this->json($this->userService->createUser($dto, $auth0));
    }

    #[Route('/api/users/{auth0}/createUpdate', methods: ['POST'])]
    public function createUpdateUser(Request $request, string $auth0): Response
    {
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        return $this->json($this->userService->createUpdateUser($dto, $auth0, $request));
    }

    #[Route('/api/users/{auth0}/settings', methods: ['PUT'])]
    public function editUser(Request $request, string $auth0): Response
    {
        return $this->json($this->userService->updateUser($request, $auth0));
    }

    #[Route('/api/users/{userId}/stats', methods: ['PUT'])]
    public function updateUserStats(Request $request, int $userId): Response
    {
        return $this->json($this->userService->updateUserStats($request, $userId));
    }

    #[Route('/api/users/{userId}', methods: ['DELETE'])]
    public function deleteUser(int $userId): Response
    {
        return $this->json($this->userService->deleteUser($userId));
    }

}
