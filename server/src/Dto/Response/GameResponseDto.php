<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class GameResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    public int $gameId;

    /**
     * @Serialization\Type("App\Dto\Response\UserResponseDto")
     */
    public UserResponseDto $userId;

    /**
     * @Serialization\Type("int")
     */
    public int $totalQuestions;

    /**
     * @Serialization\Type("int")
     */
    public int $score;

    /**
     * @Serialization\Type("DateTime<Y-m-d\TH:i:s>")
     */
    public \DateTime $date;

}