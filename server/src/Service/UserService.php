<?php

namespace App\Service;

use App\Dto\Incoming\CreateUserDto;
use App\Dto\Outgoing\UserDto;
use App\Entity\User;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\UserTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class UserService
{
    private UserRepository $userRepository;
    private UserTypeRepository $userTypeRepository;
    private GameRepository $gameRepository;
    private UserTypeService $userTypeService;
    private EntityManagerInterface $entityManager;


    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        GameRepository $gameRepository,
        UserTypeService $userTypeService,
        EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->gameRepository = $gameRepository;
        $this->userTypeService = $userTypeService;
        $this->entityManager = $entityManager;
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
            $user->setBackgroundColor($dto->getBackgroundColor());
            $user->setForegroundColor($dto->getForegroundColor());
            $user->setAuth0($dto->getAuth0());
            $this->userRepository->save($user, true);

            return $this->transformToDto($user);
        } else {
            return $this->transformToDto($user);
        }

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

    public function deleteUser(int $userId): string
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            return ('No user found for id' . $userId);
        }

        $this->userRepository->remove($user, true);
        $users = $this->userRepository->findAll();
        $this->entityManager->flush($users);

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



}