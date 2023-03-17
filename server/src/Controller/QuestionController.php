<?php

namespace App\Controller;

use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    private QuestionService $questionService;

    /**
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }


    #[Route('/api/questions', methods: ['GET'])]
    public function getAllQuestions(): Response
    {
        return $this->json($this->questionService->returnAllQuestions());
    }

    #[Route('/api/questions/random', methods: ['GET'])]
    public function getRandomQuestion(): Response
    {
        return $this->json($this->questionService->getRandomQuestion());
    }

    #[Route('/api/questions/{questionId}', methods: ['GET'])]
    public function getQuestionOptions($questionId): Response
    {
        return $this->json($this->questionService->getQuestionOptions($questionId));
    }

}
