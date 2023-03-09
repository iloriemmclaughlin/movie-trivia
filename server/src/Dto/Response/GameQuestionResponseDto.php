<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class GameQuestionResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    public int $gameQuestionId;

    /**
     * @Serialization\Type("App\Dto\Response\GameResponseDto")
     */
    public GameResponseDto $gameId;

    /**
     * @Serialization\Type("App\Dto\Response\QuestionResponseDto")
     */
    public QuestionResponseDto $questionId;

    /**
     * @Serialization\Type("string")
     */
    public string $userAnswer;

}