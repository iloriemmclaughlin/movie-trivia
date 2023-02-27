<?php

namespace App\Service;

use App\Dto\Incoming\CreateUserDto;
use App\Dto\Outgoing\UserDto;
use App\Entity\User;
use App\Repository\StatsRepository;
use App\Repository\UserRepository;
use App\Repository\UserTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class UserService
{
    private UserRepository $userRepository;
    private UserTypeRepository $userTypeRepository;
    private StatsRepository $statsRepository;
    private UserTypeService $userTypeService;
    private GameService $gameService;
    private StatsService $statsService;
    private ManagerRegistry $managerRegistry;


    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        StatsRepository $statsRepository,
        UserTypeService $userTypeService,
        GameService $gameService,
        StatsService $statsService,
        ManagerRegistry $managerRegistry)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->statsRepository = $statsRepository;
        $this->userTypeService = $userTypeService;
        $this->gameService = $gameService;
        $this->statsService = $statsService;
        $this->managerRegistry = $managerRegistry;
    }

    public function getAllUsers()
    {
        $users = $this->userRepository->findAll();
        $dto = [];

        foreach($users as $user) {
            $dto[] = $this->transformToDto($user);
        }

        return $dto;
    }

    public function getUserById($userId)
    {
        $user = $this->userRepository->find($userId);

        return $this->transformToDto($user);
    }

    public function getUserGames($userId)
    {

        $user = $this->userRepository->find($userId);
        $userGames = $user->getGames();

        $dto = [];

        foreach($userGames as $game) {
            $dto[] = $this->gameService->transformToDto($game);
        }

        return $dto;
//
////        $user = $this->userRepository->find($userId);
////        $userGames = $user->getGames();
////
////        $dto = $this->gameResponseDtoTransformer->transformFromObjects($userGames);
////
////        return $dto;
    }

    public function getUserStats($userId)
    {
        $user = $this->userRepository->find($userId);
        $userStats = $user->getStats();

        $dto = $this->statsService->transformToDto($userStats);

        return $dto;

//        $user = $this->userRepository->find($userId);
//        $userStats = $user->getStats();
//
//        $dto = $this->statsResponseDtoTransformer->transformFromObject($userStats);
//
//        return $dto;
    }

    public function createUser(CreateUserDto $dto): ?UserDto
    {
        $userType = $this->userTypeRepository->findOneBy(array('user_type_id' => 2));

        $user = new User();
        $user->setUserType($userType);
        $user->setFirstName($dto->getFirstName());
        $user->setLastName($dto->getLastName());
        $user->setEmail($dto->getEmail());
        $user->setUsername($dto->getUsername());
        $user->setPassword($dto->getPassword());
        $user->setBackgroundColor($dto->getBackgroundColor());
        $user->setForegroundColor($dto->getForegroundColor());
        $this->userRepository->save($user, true);

        $this->createUserStats($user->getId());

        return $this->transformToDto($user);
    }

    private function createUserStats($userId): void
    {
        $user = $this->userRepository->find($userId);
        $newStats = $user->getStats();
        $newStats->setGamesPlayed(0);
        $newStats->setHighScore(0);

        $this->statsRepository->save($newStats, true);

    }

    public function updateUser(Request $request, int $userId): ?UserDto
    {
        $userInput = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($userId);

        $user->setFirstName($userInput['firstName']);
        $user->setLastName($userInput['lastName']);
        $user->setEmail($userInput['email']);
        $user->setUsername($userInput['username']);
        $user->setPassword($userInput['password']);
        $user->setBackgroundColor($userInput['backgroundColor']);
        $user->setForegroundColor($userInput['foregroundColor']);

        $this->userRepository->save($user);

        return $this->transformToDto($user);
    }

    public function updateUserStats(Request $request, int $userId): string
    {
        $updatedStats = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($userId);

        if (!$userId) {
            return ('No user found for id' . $userId);
        }

        $user->getStats()->setGamesPlayed($updatedStats['gamesPlayed']);
        $user->getStats()->setHighScore($updatedStats['highScore']);
        $this->userRepository->save($user);
        $this->statsRepository->save($updatedStats);

        return ('Stats have been successfully updated!');
    }

    public function deleteUser(int $userId): string
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            return ('No user found for id' . $userId);
        }

        $this->userRepository->remove($user, true);

        return ('User has been successfully deleted!');
    }

    public function transformToDto(User $user): UserDto
    {
        return new UserDto(
            $user->getId(),
            $this->userTypeService->transformToDto($user->getUserType()),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getUsername(),
            $user->getPassword(),
            $user->getBackgroundColor(),
            $user->getForegroundColor()
        );
    }

}