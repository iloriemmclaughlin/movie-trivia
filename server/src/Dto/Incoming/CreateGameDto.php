<?php

namespace App\Dto\Incoming;

use DateTime;

class CreateGameDto
{
    private int $userId;
    private int $totalQuestions;
    private int $score;
    private DateTime $date;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTotalQuestions(): int
    {
        return $this->totalQuestions;
    }

    /**
     * @param int $totalQuestions
     */
    public function setTotalQuestions(int $totalQuestions): void
    {
        $this->totalQuestions = $totalQuestions;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }


}