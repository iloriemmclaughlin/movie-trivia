<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class SettingsResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    public int $settingsId;

    /**
     * @Serialization\Type("App\Dto\Response\UserResponseDto")
     */
    public UserResponseDto $user;

    /**
     * @Serialization\Type("string")
     */
    public string $backgroundColor;

    /**
     * @Serialization\Type("string")
     */
    public string $foregroundColor;

}