<?php

namespace App\Service;

use App\Entity\Stats;
use App\Repository\StatsRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatsService
{
    private StatsRepository $statsRepository;
    private ManagerRegistry $managerRegistry;

    public function __construct(StatsRepository $statsRepository, ManagerRegistry $managerRegistry)
    {
        $this->statsRepository = $statsRepository;
        $this->managerRegistry = $managerRegistry;
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


}