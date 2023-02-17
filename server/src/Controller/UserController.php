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

    #[Route('/api/users', methods: ['GET'])]
    public function getAllUsers(UserService $userService): Response
    {
        return $this->json($userService->returnAllUsers());
    }

    #[Route('/api/users/{userId}', methods: ['GET'])]
    public function getUserById(int $userId, UserService $userService): Response
    {
        return $this->json($userService->returnUserById($userId));
    }

    #[Route('/api/users/{userId}/games', methods: ['GET'])]
    public function getUserGames(int $userId, UserService $userService): Response
    {
        return $this->json($userService->returnUserGames($userId));
    }

    #[Route('/api/users/{userId}/stats', methods: ['GET'])]
    public function getUserStats(int $userId, UserService $userService): Response
    {
        return $this->json($userService->returnUserStats($userId));
    }

    #[Route('/api/users/{userId}/settings', methods: ['GET'])]
    public function getUserSettings(int $userId, UserService $userService): Response
    {
        return $this->json($userService->returnUserSettings($userId));
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createNewUser(Request $request, UserService $userService): Response
    {
        return $this->json($userService->returnNewUser($request));
    }

    #[Route('/api/users/{userId}/games', methods: ['PUT'])]
    public function updateUserGame(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response
    {
    // FIGURE OUT LATER?

        return new JsonResponse();
    }

    #[Route('/api/users/{userId}/settings', methods: ['PUT'])]
    public function editUser(Request $request, int $userId, UserService $userService): Response
    {
        return $this->json($userService->updateUser($request, $userId));
    }

    #[Route('/api/users/{userId}/stats', methods: ['PUT'])]
    public function updateUserStats(Request $request, int $userId, UserService $userService): Response
    {
        return $this->json($userService->updateUserStats($request, $userId));
    }

    #[Route('/api/users/{userId}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $userId, UserService $userService): Response
    {
        return $this->json($userService->deleteUser($userId));
    }

}
