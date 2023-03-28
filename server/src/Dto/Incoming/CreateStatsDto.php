<?php

namespace App\Dto\Incoming;

class CreateStatsDto
{
    private int $userId;
    private int $gamesPlayed;
    private int $highScore;

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
    public function getGamesPlayed(): int
    {
        return $this->gamesPlayed;
    }

    /**
     * @param int $gamesPlayed
     */
    public function setGamesPlayed(int $gamesPlayed): void
    {
        $this->gamesPlayed = $gamesPlayed;
    }

    /**
     * @return int
     */
    public function getHighScore(): int
    {
        return $this->highScore;
    }

    /**
     * @param int $highScore
     */
    public function setHighScore(int $highScore): void
    {
        $this->highScore = $highScore;
    }


}