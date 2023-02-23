<?php

namespace App\Service;

use App\Dto\Response\Transformer\GameResponseDtoTransformer;
use App\Dto\Response\Transformer\SettingsResponseDtoTransformer;
use App\Dto\Response\Transformer\StatsResponseDtoTransformer;
use App\Dto\Response\Transformer\UserResponseDtoTransformer;
use App\Entity\Stats;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\UserTypeRepository;
use Doctrine\Persistence\ManagerRegistry;


class UserService
{
    private UserRepository $userRepository;
    private UserTypeRepository $userTypeRepository;
    private ManagerRegistry $managerRegistry;
    private UserResponseDtoTransformer $userResponseDtoTransformer;
    private GameResponseDtoTransformer $gameResponseDtoTransformer;
    private StatsResponseDtoTransformer $statsResponseDtoTransformer;
    private SettingsResponseDtoTransformer $settingsResponseDtoTransformer;


    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        ManagerRegistry $managerRegistry,
        UserResponseDtoTransformer $userResponseDtoTransformer,
        GameResponseDtoTransformer $gameResponseDtoTransformer,
        StatsResponseDtoTransformer $statsResponseDtoTransformer,
        SettingsResponseDtoTransformer $settingsResponseDtoTransformer)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->managerRegistry = $managerRegistry;
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
        $this->gameResponseDtoTransformer = $gameResponseDtoTransformer;
        $this->statsResponseDtoTransformer = $statsResponseDtoTransformer;
        $this->settingsResponseDtoTransformer = $settingsResponseDtoTransformer;
    }

    public function getAllUsers()
    {
        $users = $this->userRepository->findAll();

        $dto = $this->userResponseDtoTransformer->transformFromObjects($users);

        return $dto;
    }

    public function getUserById($userId)
    {
        $user = $this->userRepository->find($userId);

        $dto = $this->userResponseDtoTransformer->transformFromObject($user);

        return $dto;
    }

    public function getUserGames($userId)
    {
        $user = $this->userRepository->find($userId);
        $userGames = $user->getGames();

        $dto = $this->gameResponseDtoTransformer->transformFromObjects($userGames);

        return $dto;
    }

    public function getUserStats($userId)
    {
        $user = $this->userRepository->find($userId);
        $userStats = $user->getStats();

        $dto = $this->statsResponseDtoTransformer->transformFromObject($userStats);

        return $dto;
    }

    public function getUserSettings($userId)
    {
        $user = $this->userRepository->find($userId);
        $userSettings = $user->getSettings();

        $dto = $this->settingsResponseDtoTransformer->transformFromObject($userSettings);

        return $dto;
    }

    public function createNewUser($request)
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

        $id = $newUser->getId();
        $this->createUserStats($id);

        $this->managerRegistry->getManager()->persist($newUser);
        $this->managerRegistry->getManager()->flush();


        $createdUser = $this->userResponseDtoTransformer->transformFromObject($newUser);

//        $createdUser = [
//            'user_id' => $newUser->getId(),
//            'user_type' => $newUser->getUserType()->getUserType(),
//            'first_name' => $newUser->getFirstName(),
//            'last_name' => $newUser->getLastName(),
//            'email' => $newUser->getLastName(),
//            'username' => $newUser->getUsername(),
//            'password' => $newUser->getPassword()
//        ];

        return $createdUser;
    }

    private function createUserStats($userId): void
    {
        $user = $this->userRepository->find($userId);
        $newStats = $user->getStats();
        $newStats->setGamesPlayed(0);
        $newStats->setHighScore(0);

        $this->managerRegistry->getManager()->persist($newStats);
        $this->managerRegistry->getManager()->flush();

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