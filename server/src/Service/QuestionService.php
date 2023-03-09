<?php

namespace App\Service;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestionService
{
    private QuestionRepository $questionRepository;
    private ManagerRegistry $managerRegistry;

    public function __construct(QuestionRepository $questionRepository, ManagerRegistry $managerRegistry)
    {
        $this->questionRepository = $questionRepository;
        $this->managerRegistry = $managerRegistry;
    }

    public function returnAllQuestions(): array
    {
        $questions = $this->questionRepository->findAll();
        $allQuestions = [];

        foreach($questions as $question) {
            $allQuestions[] = [
                'question_id' => $question->getId(),
                'question_type' => $question->getQuestionTypeId()->getQuestionType(),
                'question_text' => $question->getQuestionText(),
                'question_answer' => $question->getQuestionAnswer()
            ];
        }

        return $allQuestions;
    }


}