<?php

namespace App\Service;

use App\Dto\Outgoing\StatsDto;
use App\Entity\Stats;
use App\Repository\StatsRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatsService
{
    private StatsRepository $statsRepository;
    private ManagerRegistry $managerRegistry;
    private UserService $userService;

    public function __construct(
        StatsRepository $statsRepository,
        ManagerRegistry $managerRegistry,
        UserService $userService,
    )
    {
        $this->statsRepository = $statsRepository;
        $this->managerRegistry = $managerRegistry;
        $this->userService = $userService;
    }

    public function returnAllStats(): array
    {
        $stats = $this->statsRepository->findAll();
        $allStats = [];

        foreach($stats as $stat) {
            $allStats[] = [
                'user_id' => $stat->getUserId()->getId(),
                'games_played' => $stat->getGamesPlayed(),
                'high_score' => $stat->getHighScore()
            ];
        }

        return $allStats;
    }

    public function transformToDto(Stats $stats): StatsDto
    {
        return new StatsDto(
            $stats->$this->userService->transformToDto($stats->getUserId()),
            $stats->getGamesPlayed(),
            $stats->getHighScore()
        );
    }


}