<?php

namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

}