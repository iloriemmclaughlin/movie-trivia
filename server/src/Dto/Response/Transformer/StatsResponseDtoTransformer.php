<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\StatsResponseDto;
use App\Entity\Stats;

class StatsResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private UserResponseDtoTransformer $userResponseDtoTransformer;

    public function __construct(UserResponseDtoTransformer $userResponseDtoTransformer)
    {
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
    }

    /**
     * @param Stats $stats
     *
     * @return StatsResponseDto
     */
    public function transformFromObject($stats): StatsResponseDto
    {
        $dto = new StatsResponseDto();
        $dto->statsId = $stats->getId();
        $dto->userId = $this->userResponseDtoTransformer->transformFromObject($stats->getUserId());
        $dto->gamesPlayed = $stats->getGamesPlayed();
        $dto->highScore = $stats->getHighScore();

        return $dto;
    }


}