<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\QuestionOptionResponseDto;
use App\Entity\QuestionOption;

class QuestionOptionResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    /**
     * @param QuestionOption $questionOption
     *
     * @return QuestionOptionResponseDto
     */
    public function transformFromObject($questionOption): QuestionOptionResponseDto
    {
        $dto = new QuestionOptionResponseDto();
        $dto->questionOptionId = $questionOption->getId();
        $dto->option = $questionOption->getOption();

        return $dto;
    }

}