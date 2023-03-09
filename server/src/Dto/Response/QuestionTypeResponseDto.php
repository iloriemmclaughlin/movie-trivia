<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class QuestionTypeResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    public int $questionTypeId;

    /**
     * @Serialization\Type("string")
     */
    public string $questionType;

}