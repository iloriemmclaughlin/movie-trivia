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

    #[Route('/api/users/{userId}/stats', methods: ['GET'])]
    public function getUserStats(int $userId): Response
    {
        return $this->json($this->userService->getUserStats($userId));
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createNewUser(Request $request): Response
    {
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        return $this->json($this->userService->createUser($dto));
    }

    #[Route('/api/users/{userId}/games', methods: ['PUT'])]
    public function updateUserGame(Request $request, int $userId): Response
    {
    // FIGURE OUT LATER?

        return new JsonResponse();
    }

    #[Route('/api/users/{userId}/settings', methods: ['PATCH'])]
    public function editUser(Request $request, int $userId): Response
    {
        return $this->json($this->userService->updateUser($request, $userId));
    }

    #[Route('/api/users/{userId}/stats', methods: ['PUT'])]
    public function updateUserStats(Request $request, int $userId): Response
    {
        return $this->json($this->userService->updateUserStats($request, $userId));
    }

    #[Route('/api/users/{userId}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $userId): Response
    {
        return $this->json($this->userService->deleteUser($userId));
    }

}
