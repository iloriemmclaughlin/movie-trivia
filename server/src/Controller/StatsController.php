<?php

namespace App\Controller;

use App\Entity\Stats;
use App\Repository\StatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatsController extends AbstractController
{
    #[Route('/api/stats/{userId}', methods: ['POST'])]
    public function createNewStats(int $userId, ManagerRegistry $doctrine): Response {

        $newStats = new Stats();
        $newStats->setUserId($userId);
        $newStats->setGamesPlayed(0);
        $newStats->setHighScore(0);

        $doctrine->getManager()->persist($newStats);
        $doctrine->getManager()->flush();

        return new JsonResponse(['status' => 'Stats created!'], Response::HTTP_CREATED);

    }

    #[Route('/api/stats', methods: ['GET'])]
    public function getAllStats(StatsRepository $statsRepository): Response
    {
        $stats = $statsRepository->findAll();
        $data = [];

        foreach($stats as $stat) {
            $data[] = [
                'user_id' => $stat->getUserId()->getId(),
                'games_played' => $stat->getGamesPlayed(),
                'high_score' => $stat->getHighScore()
            ];
        }

        return new JsonResponse($data);
    }



}
