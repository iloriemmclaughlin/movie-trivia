<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\GameResponseDto;
use App\Entity\Game;

class GameResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private UserResponseDtoTransformer $userResponseDtoTransformer;

    public function __construct(UserResponseDtoTransformer $userResponseDtoTransformer)
    {
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
    }

    /**
     * @param Game $game
     *
     * @return GameResponseDto
     */
    public function transformFromObject($game): GameResponseDto
    {
        $dto = new GameResponseDto();
        $dto->gameId = $game->getId();
        $dto->userId = $this->userResponseDtoTransformer->transformFromObject($game->getUserId());
        $dto->totalQuestions = $game->getTotalQuestions();
        $dto->score = $game->getScore();
        $dto->date = $game->getDate();

        return $dto;
    }


}