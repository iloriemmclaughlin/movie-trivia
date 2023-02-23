<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Entity\User;
use JMS\Serializer\Annotation as Serialization;

class StatsResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    public int $statsId;

    /**
     * @Serialization\Type("App\Dto\Response\UserResponseDto")
     */
    public User $user;

    /**
     * @Serialization\Type("int")
     */
    public int $gamesPlayed;

    /**
     * @Serialization\Type("int")
     */
    public int $highScore;

}