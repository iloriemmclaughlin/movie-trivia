<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class GameController extends AbstractController
{

    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/api/games/{userId}', methods: ['POST'])]
    public function createNewGame(int $userId, ManagerRegistry $doctrine): Response {

        $newGame = new Game();
        $newGame->setScore(0);
        $newGame->setTotalQuestions(0);
        $date = new DateTime();
        $newGame->setDate($date);
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));
        $newGame->setUserId($user);

        $doctrine->getManager()->persist($newGame);
        $doctrine->getManager()->flush();

        return new JsonResponse(['status' => 'Game created!'], Response::HTTP_CREATED);

    }

    #[Route('/api/games', methods: ['GET'])]
    public function getAllGames(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();
        $data = [];

        foreach($games as $game) {
            $data[] = [
                'game_id' => $game->getId(),
                'user_id' => $game->getUserId()->getId(),
                'score' => $game->getScore(),
                'total_questions' => $game->getTotalQuestions(),
                'date' => $game->getDate()
            ];
        }

        return new JsonResponse($data);

    }

    #[Route('/api/games/{gameId}/questions', methods: ['GET'])]
    public function getGameQuestions(int $gameId, GameRepository $gameRepository): Response
    {
        $game = $gameRepository->find($gameId);

        $gameQuestions = [
            'game_id' => $game->getId(),
            'questions' => $game->getGameQuestions()->getValues(),
        ];

        return new JsonResponse($gameQuestions);

    }

    #[Route('/api/games/{gameId}', methods: ['DELETE'])]
    public function removeGame(): Response {

        return new JsonResponse();

    }
}
