<?php

namespace App\Controller;

use App\Repository\GameRepository;
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

    private UserTypeRepository $userTypeRepository;

    /**
     * @param UserTypeRepository $userTypeRepository
     */
    public function __construct(UserTypeRepository $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }


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
    public function createNewUser(Request $request, ManagerRegistry $doctrine): Response
    {

        $userInput = json_decode($request->getContent(), true);

        $newUser = new User();
        $userType = $this->userTypeRepository->findOneBy(array('user_type_id' => 2));
        $newUser->setUserType($userType);
        $newUser->setFirstName($userInput['firstName']);
        $newUser->setLastName($userInput['lastName']);
        $newUser->setEmail($userInput['email']);
        $newUser->setUsername($userInput['username']);
        $newUser->setPassword($userInput['password']);

        $doctrine->getManager()->persist($newUser);
        $doctrine->getManager()->flush();

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);

    }

    #[Route('/api/users/{userId}/games', methods: ['PUT'])]
    public function updateUserGame(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response
    {


        return new JsonResponse();
    }

    #[Route('/api/users/{userId}/settings', methods: ['PUT'])]
    public function editUser(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response {

        $updatedUser = json_decode($request->getContent(), true);

        $user = $userRepository->find($userId);

        if (!$userId) {
            return $this->json('No user found for id' . $userId, 404);
        }

        $user->setFirstName($updatedUser['firstName']);
        $user->setLastName($updatedUser['lastName']);
        $user->setEmail($updatedUser['email']);
        $user->setUsername($updatedUser['username']);
        $user->setPassword($updatedUser['password']);
        $user->getSettings()->setBackgroundColor($updatedUser['backgroundColor']);
        $user->getSettings()->setForegroundColor($updatedUser['foregroundColor']);
        $doctrine->getManager()->flush();

        return new JsonResponse('User ID ' . $userId . ' was successfully updated.');

    }

    #[Route('/api/users/{userId}/stats', methods: ['PUT'])]
    public function updateUserStats(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response {

        $updatedStats = json_decode($request->getContent(), true);

        $user = $userRepository->find($userId);

        if (!$userId) {
            return $this->json('No user found for id' . $userId, 404);
        }

        $user->getStats()->setGamesPlayed($updatedStats['gamesPlayed']);
        $user->getStats()->setHighScore($updatedStats['highScore']);
        $doctrine->getManager()->flush();

        return new JsonResponse('User ID ' . $userId . ' was successfully updated.');

    }

    #[Route('/api/users/{userId}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response {

        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse('No user found for id' . $userId, 404);
        }

        $doctrine->getManager()->remove($user);
        $doctrine->getManager()->flush();

        return new JsonResponse('User ID ' . $userId . ' was successfully deleted.');

    }

}
