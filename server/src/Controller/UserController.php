<?php

namespace App\Controller;

use App\Repository\UserTypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\UserService;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends AbstractController
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
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

    #[Route('/api/users/{userId}/settings', methods: ['GET'])]
    public function getUserSettings(int $userId): Response
    {
        return $this->json($this->userService->getUserSettings($userId));
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createNewUser(Request $request): Response
    {
        return $this->json($this->userService->createNewUser($request));
    }

    #[Route('/api/users/{userId}/games', methods: ['PUT'])]
    public function updateUserGame(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response
    {
    // FIGURE OUT LATER?

        return new JsonResponse();
    }

    #[Route('/api/users/{userId}/settings', methods: ['PUT'])]
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
