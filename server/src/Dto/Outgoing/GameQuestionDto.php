<?php

namespace App\Dto\Outgoing;

class GameQuestionDto
{
    private int $gameQuestionId;
    private GameDto $game;
    private QuestionDto $question;
    private string $userAnswer;

    /**
     * @param int $gameQuestionId
     * @param GameDto $game
     * @param QuestionDto $question
     * @param string $userAnswer
     */
    public function __construct(int $gameQuestionId, GameDto $game, QuestionDto $question, string $userAnswer)
    {
        $this->gameQuestionId = $gameQuestionId;
        $this->game = $game;
        $this->question = $question;
        $this->userAnswer = $userAnswer;
    }

    /**
     * @return int
     */
    public function getGameQuestionId(): int
    {
        return $this->gameQuestionId;
    }

    /**
     * @return GameDto
     */
    public function getGame(): GameDto
    {
        return $this->game;
    }

    /**
     * @return QuestionDto
     */
    public function getQuestion(): QuestionDto
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getUserAnswer(): string
    {
        return $this->userAnswer;
    }




}