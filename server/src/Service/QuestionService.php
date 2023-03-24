<?php

namespace App\Service;

use App\Dto\Outgoing\QuestionOptionDto;
use App\Entity\Question;
use App\Entity\QuestionOption;
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
            $question->getQuestionAnswer(),
        );
    }

    public function getRandomQuestion()
    {
        $questions = $this->questionRepository->find(1);
        $options = $this->questionOptionRepository->findBy(['question_id' => $questions->getId()]);

        $dto = new QuestionDto();

        $dto->setQuestionId($questions->getId());
        $dto->setQuestionType($questions->getQuestionTypeId()->getQuestionType());
        $dto->setQuestionText($questions->getQuestionText());
        $dto->setQuestionAnswer($questions->getQuestionAnswer());

        $array = [];

        foreach($options as $option) {
            $array[] = $option->getOption();
        }

        $dto->setQuestionOption($array);

        return $dto;
    }

    public function getAllQuestions()
    {
        $questions = $this->questionRepository->findAll();
        shuffle($questions);

        $dtos = [];

        foreach ($questions as $question) {
            $options = $this->questionOptionRepository->findBy(['question_id' => $question->getId()]);

            $dto = new QuestionDto();

            $dto->setQuestionId($question->getId());
            $dto->setQuestionType($question->getQuestionTypeId()->getQuestionType());
            $dto->setQuestionText($question->getQuestionText());
            $dto->setQuestionAnswer($question->getQuestionAnswer());

            $optionArray = [];
            $optionArray[] = $question->getQuestionAnswer();

            foreach($options as $option) {
                $optionArray[] = $option->getOption();
            }

            shuffle($optionArray);

            $dto->setQuestionOption($optionArray);

            $dtos[] = $dto;
        }

        return $dtos;
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

    public function getAllQuestionOptions()
    {
        $questionOptions = $this->questionOptionRepository->findAll();
        $dto = [];

        foreach($questionOptions as $option) {
            $dto[] = $this->transformQuestionOptionDto($option);
        }

        return $dto;
    }

    public function transformQuestionOptionDto(QuestionOption $questionOption): QuestionOptionDto
    {
        return new QuestionOptionDto(
            $questionOption->getId(),
            $questionOption->getQuestionId()->getId(),
            $questionOption->getOption(),
        );

    }


}