<?php

namespace App\Dto\Outgoing;

class GameDto
{
    private int $gameId;
    private UserDto $user;
    private int $totalQuestions;
    private int $score;
    private string $date;

    /**
     * @param int $gameId
     * @param UserDto $user
     * @param int $totalQuestions
     * @param int $score
     * @param string $date
     */
    public function __construct(int $gameId, UserDto $user, int $totalQuestions, int $score, string $date)
    {
        $this->gameId = $gameId;
        $this->user = $user;
        $this->totalQuestions = $totalQuestions;
        $this->score = $score;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @return UserDto
     */
    public function getUser(): UserDto
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getTotalQuestions(): int
    {
        return $this->totalQuestions;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }




}