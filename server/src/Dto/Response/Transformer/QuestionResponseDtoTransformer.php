<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\QuestionResponseDto;
use App\Entity\Question;

class QuestionResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private QuestionTypeResponseDtoTransformer $questionTypeResponseDtoTransformer;

    public function __construct(QuestionTypeResponseDtoTransformer $questionTypeResponseDtoTransformer)
    {
        $this->questionTypeResponseDtoTransformer = $questionTypeResponseDtoTransformer;
    }

    /**
     * @param Question $question
     *
     * @return QuestionResponseDto
     */
    public function transformFromObject($question): QuestionResponseDto
    {
        $dto = new QuestionResponseDto();
        $dto->questionId = $question->getId();
        $dto->questionTypeId = $this->questionTypeResponseDtoTransformer->transformFromObject($question->getQuestionTypeId());
        $dto->questionText = $question->getQuestionText();
        $dto->questionAnswer = $question->getQuestionAnswer();

        return $dto;
    }


}