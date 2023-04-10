<?php

namespace App\Service;

use App\Dto\Incoming\CreateGameDto;
use App\Dto\Outgoing\GameDto;
use App\Dto\Incoming\CreateGameQuestionDto;
use App\Dto\Outgoing\GameQuestionDto;
use App\Entity\Game;
use App\Entity\GameQuestion;
use App\Entity\Stats;
use App\Repository\GameQuestionRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class GameService
{
    private GameRepository $gameRepository;
    private UserRepository $userRepository;
    private UserService $userService;
    private QuestionRepository $questionRepository;
    private GameQuestionRepository $gameQuestionRepository;
    private QuestionService $questionService;
    private ManagerRegistry $managerRegistry;
    private EntityManagerInterface $entityManager;


    public function __construct(
        GameRepository $gameRepository,
        UserRepository $userRepository,
        UserService $userService,
        QuestionRepository $questionRepository,
        GameQuestionRepository $gameQuestionRepository,
        QuestionService $questionService,
        ManagerRegistry $managerRegistry,
        EntityManagerInterface $entityManager,
    )
    {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->questionRepository = $questionRepository;
        $this->gameQuestionRepository = $gameQuestionRepository;
        $this->questionService = $questionService;
        $this->entityManager = $entityManager;
        $this->managerRegistry = $managerRegistry;
    }

    public function returnAllGames()
    {
        $games = $this->gameRepository->findAll();
        $dto = [];

        foreach ($games as $game) {
            $dto[] = $this->transformToDto($game);
        }

        return $dto;
    }

    public function createUpdateGame(CreateGameDto $dto, $userId, Request $request): ?GameDto
    {
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));

        $game = new Game();
        $game->setUserId($user);
        $game->setTotalQuestions(0);
        $game->setScore(0);
        $game->setDate($dto->getDate());

        $this->entityManager->persist($game);
        $this->entityManager->flush($game);

        $userInput = json_decode($request->getContent(), true);

        $game->setTotalQuestions($userInput['totalQuestions']);
        $game->setScore($userInput['score']);

        $this->entityManager->persist($game);
        $this->entityManager->flush($game);

        $this->createUpdateStats($request, $userId);

        return $this->transformToDto($game);
    }

    private function createUpdateStats(Request $request, $userId): ?Stats
    {
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));
        $userInput = json_decode($request->getContent(), true);

        $userStats = $user->getStats();
        $stats = new Stats();

        if (is_null($userStats)) {
            $stats->setUserId($user);
            $stats->setGamesPlayed(1);
            $stats->setHighScore($userInput['score']);

            $this->entityManager->persist($stats);
            $this->entityManager->flush($stats);

        } else if ($userStats->getHighScore() < $userInput['score']) {
            $stats = $userStats;
            $currentGames = $user->getStats()->getGamesPlayed();

            $stats->setHighScore($userInput['score']);
            $stats->setGamesPlayed($currentGames + 1);
        } else {
            $stats = $userStats;
            $currentGames = $user->getStats()->getGamesPlayed();
            $stats->setGamesPlayed($currentGames + 1);
        }

        $this->entityManager->persist($stats);
        $this->entityManager->flush($stats);

        return $stats;
    }

    public function deleteGame($gameId): string
    {
        $game = $this->gameRepository->find($gameId);

        if (!$game) {
            return ('No game found for id' . $gameId);
        }

        $this->managerRegistry->getManager()->remove($game);
        $this->managerRegistry->getManager()->flush();

        return ('Game has been successfully deleted!');
    }

    public function transformToDto(Game $game): GameDto
    {
        return new GameDto(
            $game->getId(),
            $this->userService->transformToDto($game->getUserId()),
            $game->getScore(),
            $game->getTotalQuestions(),
            $game->getDate()
        );
    }

    public function addGameQuestion(CreateGameQuestionDto $dto, $gameId, $questionId)
    {
        $gameQuestion = new GameQuestion();
        $gameQuestion->setGameId($gameId);
        $gameQuestion->setQuestionId($questionId);
        $gameQuestion->setUserAnswer($dto->getUserResponse());

        $this->gameQuestionRepository->save($gameQuestion);

        return $this->transformGameQuestionDto($gameQuestion);

    }

    public function transformGameQuestionDto(GameQuestion $gameQuestion): GameQuestionDto
    {
        $gameId = $gameQuestion->getGameId();
        $game = $this->gameRepository->find($gameId);
        $questionId = $gameQuestion->getQuestionId();
        $question = $this->questionRepository->find($questionId);

        return new GameQuestionDto(
            $gameQuestion->getId(),
            $this->transformToDto($game),
            $this->questionService->transformToDto($question),
            $gameQuestion->getUserAnswer()
        );
    }

}