<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class QuestionResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    public int $questionId;

    /**
     * @Serialization\Type("App\Dto\Response\QuestionTypeResponseDto")
     */
    public QuestionTypeResponseDto $questionType;

    /**
     * @Serialization\Type("string")
     */
    public string $questionText;

    /**
     * @Serialization\Type("string")
     */
    public string $questionAnswer;

}