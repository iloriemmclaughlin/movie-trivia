<?php

namespace App\Controller;

use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GameController extends AbstractController
{

    #[Route('/api/games', methods: ['GET'])]
    public function getAllGames(GameService $gameService): Response
    {
        return $this->json($gameService->returnAllGames());
    }

    #[Route('/api/games/{gameId}/questions', methods: ['GET'])]
    public function getGameQuestions(int $gameId, GameService $gameService): Response
    {
        return $this->json($gameService->returnGameQuestions());
    }

    #[Route('/api/games/{userId}', methods: ['POST'])]
    public function createNewGame(int $userId, GameService $gameService): Response
    {
        return $this->json($gameService->createNewGame($userId));
    }

    #[Route('/api/games/{gameId}', methods: ['PUT'])]
    public function updateGame(Request $request, int $gameId, GameService $gameService): Response
    {
        return $this->json($gameService->updateGame($request, $gameId));
    }

    #[Route('/api/games/{gameId}', methods: ['DELETE'])]
    public function removeGame(int $gameId, GameService $gameService): Response
    {
        return $this->json($gameService->deleteGame($gameId));
    }
}
