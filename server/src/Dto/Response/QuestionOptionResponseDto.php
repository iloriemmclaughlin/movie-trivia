<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class QuestionOptionResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    public int $questionOptionId;

    /**
     * @Serialization\Type("string")
     */
    public string $option;

}