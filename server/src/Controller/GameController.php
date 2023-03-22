<?php

namespace App\Controller;

use App\Dto\Incoming\CreateGameDto;
use App\Dto\Incoming\CreateGameQuestionDto;
use App\Service\GameService;
use App\Serialization\SerializationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GameController extends ApiController
{
    private GameService $gameService;

    public function __construct(
        GameService $gameService,
        SerializationService $serializationService
    )
    {
        $this->gameService = $gameService;
        parent::__construct($serializationService);
    }


    #[Route('/api/games', methods: ['GET'])]
    public function getAllGames(): Response
    {
        return $this->json($this->gameService->returnAllGames());
    }

    #[Route('/api/games/{gameId}/questions', methods: ['GET'])]
    public function getGameQuestions(int $gameId): Response
    {
        return $this->json($this->gameService->returnGameQuestions($gameId));
    }

    #[Route('/api/games/{userId}', methods: ['POST'])]
    public function createNewGame(Request $request, $userId): Response
    {
        $dto = $this->getValidatedDto($request, CreateGameDto::class);
        return $this->json($this->gameService->createNewGame($dto, $userId));
    }

    #[Route('/api/games/{gameId}/update', methods: ['PUT'])]
    public function updateGame(Request $request, int $gameId): Response
    {
        return $this->json($this->gameService->updateGame($request, $gameId));
    }

    #[Route('/api/games/{gameId}', methods: ['DELETE'])]
    public function removeGame(int $gameId): Response
    {
        return $this->json($this->gameService->deleteGame($gameId));
    }

    #[Route('/api/games/addGameQuestion', methods: ['POST'])]
    public function addGameQuestion(Request $request, int $gameId, int $questionId): Response
    {
        $dto = $this->getValidatedDto($request, CreateGameQuestionDto::class);
        return $this->json($this->gameService->addGameQuestion($dto, $gameId, $questionId));
    }

    #[Route('/api/games/{gameId}/{questionId}', methods: ['PUT'])]
    public function checkAnswer(int $gameId, int $questionId): Response
    {
        return $this->json($this->gameService->checkAnswer($gameId, $questionId));
    }

}
