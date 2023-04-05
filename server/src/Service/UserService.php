<?php

namespace App\Service;

use App\Dto\Incoming\CreateUserDto;
use App\Dto\Outgoing\UserDto;
use App\Dto\Outgoing\GameDto;
use App\Entity\Game;
use App\Entity\User;
use App\Repository\GameRepository;
use App\Repository\StatsRepository;
use App\Repository\UserRepository;
use App\Repository\UserTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use function PHPUnit\Framework\isNull;


class UserService
{
    private UserRepository $userRepository;
    private UserTypeRepository $userTypeRepository;
    private StatsRepository $statsRepository;
    private GameRepository $gameRepository;
    private UserTypeService $userTypeService;
    private EntityManagerInterface $entityManager;
    private GameService $gameService;
    private StatsService $statsService;
    private ManagerRegistry $managerRegistry;


    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        StatsRepository $statsRepository,
        GameRepository $gameRepository,
        UserTypeService $userTypeService,
        EntityManagerInterface $entityManager,
//        GameService $gameService,
//        StatsService $statsService,
        ManagerRegistry $managerRegistry)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->statsRepository = $statsRepository;
        $this->gameRepository = $gameRepository;
        $this->userTypeService = $userTypeService;
        $this->entityManager = $entityManager;
//        $this->gameService = $gameService;
//        $this->statsService = $statsService;
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
        $games = $this->gameRepository->findBy(['user_id' => $user->getId()]);

        $dto = [];

        foreach($games as $game) {
//            $dto[] = $this->transformGameDto($game);
            $dto[] = [
                'gameId' => $game->getId(),
                'totalQuestions' => $game->getTotalQuestions(),
                'score' => $game->getScore(),
                'date' => $game->getDate(),
            ];

        }

        return $dto;
    }


    public function createUser(CreateUserDto $dto, $auth0): ?UserDto
    {
        $user = $this->userRepository->findOneBy(['auth0' => $auth0]);
        if ($user === null) {
            $userType = $this->userTypeRepository->findOneBy(array('user_type_id' => 2));

            $user = new User();
            $user->setUserType($userType);
            $user->setFirstName($dto->getFirstName());
            $user->setLastName($dto->getLastName());
            $user->setEmail($dto->getEmail());
            $user->setUsername($dto->getUsername());
            $user->setPassword($dto->getPassword());
            $user->setBackgroundColor('#7dd3fc');
            $user->setForegroundColor('#e0f2fe');
            $user->setAuth0($dto->getAuth0());
            $this->userRepository->save($user, true);

            return $this->transformToDto($user);
        }

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

//    public function updateUser(Request $request, string $auth0): ?UserDto
//    {
//        $userInput = json_decode($request->getContent(), true);
//
//        $user = $this->userRepository->find($auth0);
//
//        $user->setFirstName($userInput['firstName']);
//        $user->setLastName($userInput['lastName']);
//        $user->setEmail($userInput['email']);
//        $user->setUsername($userInput['username']);
//        $user->setPassword($userInput['password']);
//        $user->setBackgroundColor($userInput['backgroundColor']);
//        $user->setForegroundColor($userInput['foregroundColor']);
//
//        $this->entityManager->persist($user);
//        $this->entityManager->flush($user);
//
//        return $this->transformToDto($user);
//    }

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

        return ('Leaderboard have been successfully updated!');
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
            $user->getForegroundColor(),
            $user->getAuth0(),
        );
    }

    public function transformGameDto(Game $game): GameDto
    {
        $userId = $game->getUserId();
        $user = $this->userRepository->find($userId);

        return new GameDto(
            $game->getId(),
            $this->transformToDto($user),
            $game->getScore(),
            $game->getTotalQuestions(),
            $game->getDate()
        );
    }

    public function updateUser($auth0, Request $request): UserDto
    {
        $user = $this->userRepository->findOneBy(['auth0' => $auth0]);
        $userInput = json_decode($request->getContent(), true);

            if ($userInput['firstName'] === '') {
                $user->setFirstName($user->getFirstName());
            } else {
                $user->setFirstName($userInput['firstName']);
            }

            if ($userInput['lastName'] === '') {
                $user->setLastName($user->getLastName());
            } else {
                $user->setLastName($userInput['lastName']);
            }

            if ($userInput['email'] === '') {
                $user->setEmail($user->getEmail());
            } else {
                $user->setEmail($userInput['email']);
            }

            if ($userInput['username'] === '') {
                $user->setUsername($user->getUsername());
            } else {
                $user->setUsername($userInput['username']);
            }


            if ($userInput['backgroundColor'] === '') {
                $user->setBackgroundColor($user->getBackgroundColor());
            } else {
                $user->setBackgroundColor($userInput['backgroundColor']);
            }

            if ($userInput['foregroundColor'] === '') {
                $user->setForegroundColor($user->getForegroundColor());
            } else {
                $user->setForegroundColor($userInput['foregroundColor']);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush($user);


        return $this->transformToDto($user);
    }

    public function getUserByAuth0(string $auth0): UserDto
    {
        $user = $this->userRepository->findOneBy(['auth0' => $auth0]);

        return $this->transformToDto($user);
    }

}