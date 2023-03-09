<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
    #[Route('/api/questions', methods: ['GET'])]
    public function getAllQuestions(QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findAll();
        $data = [];

        foreach($questions as $question) {
            $data[] = [
                'question_id' => $question->getId(),
                'question_type' => $question->getQuestionTypeId()->getQuestionType(),
                'question_text' => $question->getQuestionText(),
                'question_answer' => $question->getQuestionAnswer()
            ];
        }

        return new JsonResponse($data);
    }

}
