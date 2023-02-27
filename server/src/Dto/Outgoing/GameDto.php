<?php

namespace App\Dto\Outgoing;

use DateTime;

class GameDto
{
    private int $gameId;
    private UserDto $user;
    private int $totalQuestions;
    private int $score;
    private DateTime $date;

    /**
     * @param int $gameId
     * @param UserDto $user
     * @param int $totalQuestions
     * @param int $score
     * @param DateTime $date
     */
    public function __construct(int $gameId, UserDto $user, int $totalQuestions, int $score, DateTime $date)
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
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }




}