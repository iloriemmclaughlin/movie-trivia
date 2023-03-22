<?php

namespace App\Service;

use App\Dto\Incoming\CreateGameDto;
use App\Dto\Outgoing\GameDto;
use App\Dto\Incoming\CreateGameQuestionDto;
use App\Dto\Outgoing\QuestionDto;
use App\Dto\Outgoing\GameQuestionDto;
use App\Dto\Response\Transformer\GameQuestionResponseDtoTransformer;
use App\Dto\Response\Transformer\GameResponseDtoTransformer;
use App\Dto\Response\Transformer\QuestionResponseDtoTransformer;
use App\Entity\Game;
use App\Entity\GameQuestion;
use App\Entity\Question;
use App\Repository\GameQuestionRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\QuestionRepository;
use App\Service\QuestionService;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use phpDocumentor\Reflection\Types\Boolean;

class GameService
{
    private GameRepository $gameRepository;
    private UserRepository $userRepository;
    private UserService $userService;
    private QuestionRepository $questionRepository;
    private GameQuestionRepository $gameQuestionRepository;
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
        GameQuestionRepository $gameQuestionRepository,
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
        $this->gameQuestionRepository = $gameQuestionRepository;
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

//    public function returnGameQuestions($gameId)
//    {
//        $game = $this->gameRepository->find($gameId);
//        $gameQuestions = $game->getGameQuestions();
//
//        $dto = $this->gameQuestionResponseDtoTransformer->transformFromObjects($gameQuestions);
//
//        return $dto;
//    }

    public function createNewGame(CreateGameDto $dto, $userId): ?GameDto
    {
        $user = $this->userRepository->findOneBy(array('user_id' => $userId));

        $game = new Game();
        $game->setUserId($user);
        $game->setScore($dto->getScore());
        $game->setTotalQuestions($dto->getTotalQuestions());
        $game->setDate($dto->getDate());
        $this->gameRepository->save($game, true);

        return $this->transformToDto($game);
    }

    public function updateGame(Request $request, int $gameId): ?GameDto
    {
        $userInput = json_decode($request->getContent(), true);

        $game = $this->gameRepository->find($gameId);

        $game->setScore($userInput['score']);
        $game->setTotalQuestions($userInput['totalQuestions']);

        $this->gameRepository->save($game);

        return $this->transformToDto($game);
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

    public function addGameQuestion(CreateGameQuestionDto $dto, $gameId, $questionId)
    {
        $gameQuestion = new GameQuestion();
        $gameQuestion->setGameId($gameId);
        $gameQuestion->setQuestionId($questionId);
        $gameQuestion->setUserAnswer($dto->getUserResponse());

        $this->gameQuestionRepository->save($gameQuestion);

        return $this->transformGameQuestionDto($gameQuestion);

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


    public function checkAnswer($gameId, $questionId): Boolean
    {
        $question = $this->questionRepository->find($questionId);
        $answer = $question->getQuestionAnswer();
        $gameQuestion = $this->gameQuestionRepository->find($gameId);
        $userResponse = $gameQuestion->getUserAnswer();

        if ($answer === $userResponse) {
            return true;
        } else {
            return false;
        }
    }

}