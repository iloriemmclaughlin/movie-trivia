<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/api/questions', methods: ['GET'])]
    public function getAllQuestions(): Response
    {
        return new JsonResponse('');
    }

}
