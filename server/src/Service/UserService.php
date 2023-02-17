<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\UserTypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserService
{
    private UserRepository $userRepository;
    private UserTypeRepository $userTypeRepository;
    private ManagerRegistry $managerRegistry;

    public function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository, ManagerRegistry $managerRegistry)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->managerRegistry = $managerRegistry;
    }

    public function returnAllUsers(): array
    {
        $allUsers = [];
        $users = $this->userRepository->findAll();


        foreach($users as $user) {
            $allUsers[] = [
                'user_id' => $user->getId(),
                'user_type' => $user->getUserType()->getUserType(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'password' => $user->getPassword()
            ];
        }

        return $allUsers;
    }

    public function returnUserById($userId): array
    {
        $user = $this->userRepository->find($userId);

        $userType = $user->getUserType()->getUserType();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $userInfo = [
            'user_id' => $userId,
            'user_type' => $userType,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];

        return $userInfo;
    }

    public function returnUserGames($userId): array
    {
        $user = $this->userRepository->find($userId);
        $userGames = $user->getGames();
        $userGamesArray = [];

        foreach($userGames as $game) {
            $userGamesArray[] = [
                'game_id' => $game->getId(),
                'user_id' => $game->getUserId()->getId(),
                'score' => $game->getScore(),
                'total_questions' => $game->getTotalQuestions(),
                'date' => $game->getDate()
            ];
        }

        return $userGamesArray;
    }

    public function returnUserStats($userId): array
    {
        $user = $this->userRepository->find($userId);

        $userStats = [
            'user_id' => $user->getId(),
            'games_played' => $user->getStats()->getGamesPlayed(),
            'high_score' => $user->getStats()->getHighScore()
        ];

        return $userStats;
    }

    public function returnUserSettings($userId): array
    {
        $user = $this->userRepository->find($userId);

        $userSettings = [
            'user_id' => $user->getId(),
            'background_color' => $user->getSettings()->getBackgroundColor(),
            'foreground_color' => $user->getSettings()->getForegroundColor()
        ];

        return $userSettings;
    }

    public function returnNewUser($request): array
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

        $createdUser = [
            'user_id' => $newUser->getId(),
            'user_type' => $newUser->getUserType()->getUserType(),
            'first_name' => $newUser->getFirstName(),
            'last_name' => $newUser->getLastName(),
            'email' => $newUser->getLastName(),
            'username' => $newUser->getUsername(),
            'password' => $newUser->getPassword()
        ];

        $this->managerRegistry->getManager()->persist($newUser);
        $this->managerRegistry->getManager()->flush();

        return $createdUser;
    }

    public function updateUser($request, $userId): array
    {
        $userInput = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($userId);

        $user->setFirstName($userInput['firstName']);
        $user->setLastName($userInput['lastName']);
        $user->setEmail($userInput['email']);
        $user->setUsername($userInput['username']);
        $user->setPassword($userInput['password']);
        $user->getSettings()->setBackgroundColor($userInput['backgroundColor']);
        $user->getSettings()->setForegroundColor($userInput['foregroundColor']);
        $this->managerRegistry->getManager()->flush();

        $updatedUser = [
            'user_id' => $user->getId(),
            'user_type' => $user->getUserType()->getUserType(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getLastName(),
            'username' => $user->getUsername(),
            'password' => $user->getPassword()
        ];

        return $updatedUser;
    }

    public function updateUserStats($request, $userId): string
    {
        $updatedStats = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($userId);

        if (!$userId) {
            return ('No user found for id' . $userId);
        }

        $user->getStats()->setGamesPlayed($updatedStats['gamesPlayed']);
        $user->getStats()->setHighScore($updatedStats['highScore']);
        $this->managerRegistry->getManager()->flush();

        return ('Stats have been successfully updated!');
    }

    public function deleteUser($userId): string
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            return ('No user found for id' . $userId);
        }

        $this->managerRegistry->getManager()->remove($user);
        $this->managerRegistry->getManager()->flush();

        return ('User has been successfully deleted!');
    }

}