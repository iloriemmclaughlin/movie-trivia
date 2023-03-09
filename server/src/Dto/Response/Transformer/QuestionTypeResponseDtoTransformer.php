<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\QuestionTypeResponseDto;
use App\Entity\QuestionType;

class QuestionTypeResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    /**
     * @param QuestionType $questionType
     *
     * @return QuestionTypeResponseDto
     */
    public function transformFromObject($questionType): QuestionTypeResponseDto
    {
        $dto = new QuestionTypeResponseDto();
        $dto->questionTypeId = $questionType->getId();
        $dto->questionType = $questionType->getQuestionType();

        return $dto;
    }

}