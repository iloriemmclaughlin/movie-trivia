<?php

namespace App\Service;

use App\Entity\Question;
use App\Repository\QuestionOptionRepository;
use App\Repository\QuestionRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\Outgoing\QuestionDto;

class QuestionService
{
    private QuestionRepository $questionRepository;
    private QuestionOptionRepository $questionOptionRepository;
    private ManagerRegistry $managerRegistry;

    public function __construct(QuestionRepository $questionRepository, QuestionOptionRepository $questionOptionRepository, ManagerRegistry $managerRegistry)
    {
        $this->questionRepository = $questionRepository;
        $this->questionOptionRepository = $questionOptionRepository;
        $this->managerRegistry = $managerRegistry;
    }

    public function returnAllQuestions()
    {
        $questions = $this->questionRepository->findAll();
        $dto = [];

        foreach($questions as $question) {
            $dto[] = $this->transformToDto($question);
        }

        return $dto;
    }

    public function transformToDto(Question $question): QuestionDto
    {
        return new QuestionDto(
            $question->getId(),
            $question->getQuestionTypeId()->getQuestionType(),
            $question->getQuestionText(),
            $question->getQuestionAnswer()
        );
    }

    public function getRandomQuestion()
    {
        $questions = $this->returnAllQuestions();
        $question = $questions[array_rand($questions)];

        $text = $question->getQuestionText();

        return $text;
    }

    public function getQuestionOptions($questionId)
    {
        $question = $this->questionRepository->find($questionId);
        $answer = $question->getQuestionAnswer();
        $questionOptions = $question->getQuestionOptions();
        $options = [$answer];

        foreach($questionOptions as $option) {
            $options[] = $option->getOption();
        }


        return $options;
    }


}