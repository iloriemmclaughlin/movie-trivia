<?php

namespace App\Controller;

use App\Entity\Stats;
use App\Repository\StatsRepository;
use App\Service\StatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatsController extends AbstractController
{
    #[Route('/api/stats', methods: ['GET'])]
    public function getAllStats(StatsService $statsService): Response
    {
        return $this->json($statsService->returnAllStats());
    }

}
