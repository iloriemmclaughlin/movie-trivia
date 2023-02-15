<?php

namespace App\Controller;

use App\Repository\UserTypeRepository;
use Doctrine\Persistence\ManagerRegistry;
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
    public function getAllUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        $data = [];

        foreach($users as $user) {
            $data[] = [
                'user_id' => $user->getId(),
                'user_type_id' => $user->getUserTypeId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'password' => $user->getPassword()
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/users/{userId}', methods: ['GET'])]
    public function getUserById(int $userId, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($userId);
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();

        return new JsonResponse([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'username' => $username,
            'password' => $password,
        ]);
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createNewUser(Request $request, ManagerRegistry $doctrine): Response
    {

        $userInput = json_decode($request->getContent(), true);

        $newUser = new User();
        $userType = $this->userTypeRepository->findOneBy(array('user_type_id' => $userInput['userType']));
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

    #[Route('/users/{id}/settings', name: 'edit_user', methods: ['PUT'])]
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
        $doctrine->getManager()->flush();

        return new JsonResponse('User ID ' . $userId . 'was successfully updated.');

    }

    #[Route('/users/{id}/settings', name: 'edit_user_settings', methods: ['PUT'])]
    public function editUserSettings(Request $request, int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response {

        $newColors = json_decode($request->getContent(), true);

        $user = $userRepository->find($userId);

        if (!$userId) {
            return $this->json('No user found for id' . $userId, 404);
        }

        $user->setBackgroundColor($newColors['backgroundColor']);
        $user->setForegroundColor($newColors['foregroundColor']);
        $doctrine->getManager()->flush();

        return new JsonResponse('Your profile was successfully updated.');

    }

    #[Route('/users/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $userId, UserRepository $userRepository, ManagerRegistry $doctrine): Response {

        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse('No user found for id' . $userId, 404);
        }

        $doctrine->getManager()->remove($user);
        $doctrine->getManager()->flush();

        return new JsonResponse('User ID ' . $userId . 'was successfully deleted.');

    }

}
