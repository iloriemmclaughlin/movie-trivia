<?php

namespace App\Dto\Outgoing;

class StatsDto
{
    private UserDto $user;
    private int $gamesPlayed;
    private int $highScore;

    /**
     * @param UserDto $user
     * @param int $gamesPlayed
     * @param int $highScore
     */
    public function __construct(UserDto $user, int $gamesPlayed, int $highScore)
    {
        $this->user = $user;
        $this->gamesPlayed = $gamesPlayed;
        $this->highScore = $highScore;
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
    public function getGamesPlayed(): int
    {
        return $this->gamesPlayed;
    }

    /**
     * @return int
     */
    public function getHighScore(): int
    {
        return $this->highScore;
    }




}