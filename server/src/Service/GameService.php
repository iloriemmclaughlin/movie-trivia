<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Question;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\QuestionRepository;
use App\Service\QuestionService;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

class GameService
{
    private GameRepository $gameRepository;
    private UserRepository $userRepository;
    private QuestionRepository $questionRepository;
    private QuestionService $questionService;
    private ManagerRegistry $managerRegistry;

    public function __construct(GameRepository $gameRepository, UserRepository $userRepository, QuestionRepository $questionRepository, QuestionService $questionService, ManagerRegistry $managerRegistry)
    {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
        $this->questionRepository = $questionRepository;
        $this->questionService = $questionService;
        $this->managerRegistry = $managerRegistry;
    }

    public function returnAllGames(): array
    {
        $games = $this->gameRepository->findAll();
        $allGames = [];

        foreach($games as $game) {
            $allGames[] = [
                'game_id' => $game->getId(),
                'user_id' => $game->getUserId()->getId(),
                'score' => $game->getScore(),
                'total_questions' => $game->getTotalQuestions(),
                'date' => $game->getDate()
            ];
        }
        return $allGames;
    }

    public function returnGameQuestions($gameId): array
    {
        $game = $this->gameRepository->find($gameId);

        $gameQuestions = [
            'game_id' => $game->getId(),
            'questions' => $game->getGameQuestions()->getValues(),
        ];

        return $gameQuestions;
    }

    public function createNewGame($userId): array
    {
        $newGame = new Game();
        $newGame->setScore(0);
        $newGame->setTotalQuestions(0);
        $date = new DateTime();
        $newGame->setDate($date);
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));
        $newGame->setUserId($user);

        $this->managerRegistry->getManager()->persist($newGame);
        $this->managerRegistry->getManager()->flush();

        $createdGame = [
            'game_id' => $newGame->getId(),
            'user_id' => $newGame->getUserId()->getId(),
            'score' => $newGame->getScore(),
            'total_questions' => $newGame->getTotalQuestions(),
            'date' => $newGame->getDate()
        ];

        return $createdGame;
    }

    public function updateGame($request, $gameId): array
    {
        $userInput = json_decode($request->getContent(), true);

        $game = $this->gameRepository->find($gameId);

        $game->setScore($userInput['score']);
        $game->setTotalQuestions($userInput['total_questions']);

        $updatedGame = [
            'score' => $game->getScore(),
            'total_questions' => $game->getTotalQuestions(),
        ];

        return $updatedGame;
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

    private function addQuestionToGame($gameId): void
    {
        $game = $this->gameRepository->find($gameId);

        // ADD QUESTION TO GAME FROM BELOW FUNCTION

    }

    private function getRandomQuestion(): Question
    {
        $questions = $this->questionService->returnAllQuestions();

        $question = array_rand($questions);

        return $question;
    }

    private function questionCheck($gameId, $userResponse): void //bool
    {

    }

}