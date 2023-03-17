<?php

namespace App\Dto\Incoming;

class CreateGameQuestionDto
{
    private int $gameId;
    private int $questionId;
    private string $userResponse;

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @param int $gameId
     */
    public function setGameId(int $gameId): void
    {
        $this->gameId = $gameId;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * @param int $questionId
     */
    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    /**
     * @return string
     */
    public function getUserResponse(): string
    {
        return $this->userResponse;
    }

    /**
     * @param string $userResponse
     */
    public function setUserResponse(string $userResponse): void
    {
        $this->userResponse = $userResponse;
    }



}