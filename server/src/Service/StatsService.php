<?php

namespace App\Service;

use App\Dto\Outgoing\StatsDto;
use App\Entity\Stats;
use App\Repository\StatsRepository;

class StatsService
{
    private StatsRepository $statsRepository;

    public function __construct(
        StatsRepository $statsRepository,
    )
    {
        $this->statsRepository = $statsRepository;
    }

    public function returnAllStats(): array
    {
        $stats = $this->statsRepository->findAll();
        $allStats = [];

        foreach($stats as $stat) {
            $allStats[] = [
                'username' => $stat->getUserId()->getUsername(),
                'games_played' => $stat->getGamesPlayed(),
                'high_score' => $stat->getHighScore(),
                'name' => $stat->getUserId()->getFirstName() . ' ' . $stat->getUserId()->getLastName(),
                'background_color' => $stat->getUserId()->getBackgroundColor(),
                'foreground_color' => $stat->getUserId()->getForegroundColor(),
            ];
        }

        return $allStats;
    }

    public function transformToDto(Stats $stats): StatsDto
    {
        return new StatsDto(
            $stats->$this->userService->transformToDto($stats->getUserId()->getUsername()),
            $stats->getGamesPlayed(),
            $stats->getHighScore()
        );
    }


}