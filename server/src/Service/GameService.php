<?php

namespace App\Service;

use App\Dto\Incoming\CreateGameDto;
use App\Dto\Outgoing\GameDto;
use App\Dto\Response\Transformer\GameQuestionResponseDtoTransformer;
use App\Dto\Response\Transformer\GameResponseDtoTransformer;
use App\Dto\Response\Transformer\QuestionResponseDtoTransformer;
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
    private UserService $userService;
    private QuestionRepository $questionRepository;
    private QuestionService $questionService;
    private ManagerRegistry $managerRegistry;
    private GameResponseDtoTransformer $gameResponseDtoTransformer;
    private QuestionResponseDtoTransformer $questionResponseDtoTransformer;
    private GameQuestionResponseDtoTransformer $gameQuestionResponseDtoTransformer;

    public function __construct(
        GameRepository $gameRepository,
        UserRepository $userRepository,
        UserService $userService,
        QuestionRepository $questionRepository,
        QuestionService $questionService,
        ManagerRegistry $managerRegistry,
        GameResponseDtoTransformer $gameResponseDtoTransformer,
        QuestionResponseDtoTransformer $questionResponseDtoTransformer,
        GameQuestionResponseDtoTransformer $gameQuestionResponseDtoTransformer)
    {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->questionRepository = $questionRepository;
        $this->questionService = $questionService;
        $this->managerRegistry = $managerRegistry;
        $this->gameResponseDtoTransformer = $gameResponseDtoTransformer;
        $this->questionResponseDtoTransformer = $questionResponseDtoTransformer;
        $this->gameQuestionResponseDtoTransformer = $gameQuestionResponseDtoTransformer;
    }

    public function returnAllGames()
    {
        $games = $this->gameRepository->findAll();

        $dto = $this->gameResponseDtoTransformer->transformFromObjects($games);

        return $dto;
    }

    public function returnGameQuestions($gameId)
    {
        $game = $this->gameRepository->find($gameId);
        $gameQuestions = $game->getGameQuestions();

        $dto = $this->gameQuestionResponseDtoTransformer->transformFromObjects($gameQuestions);

        return $dto;
    }

    public function createNewGame(CreateGameDto $dto, $userId): ?GameDto
    {
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));

        $game = new Game();
        $game->setUserId($user);
        $game->setScore(0);
        $game->setTotalQuestions(0);
        $date = new DateTime();
        $game->setDate($date);
        $this->gameRepository->save($game, true);

        return $this->transformToDto($game);
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

    private function addQuestionToGame($gameId): void
    {
        $game = $this->gameRepository->find($gameId);

        // ADD QUESTION TO GAME FROM BELOW FUNCTION

    }

//    private function getRandomQuestion(): Question
//    {
//        $questions = $this->questionService->returnAllQuestions();
//
//        $question = array_rand($questions);
//
//        return $question;
//    }

//    private function questionCheck($gameId, $userResponse): void //bool
//    {
//
//    }

}