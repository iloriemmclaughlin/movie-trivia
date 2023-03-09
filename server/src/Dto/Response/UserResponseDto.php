<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class UserResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    public int $userId;

    /**
     * @Serialization\Type("App\Dto\Response\UserTypeResponseDto")
     */
    public UserTypeResponseDto $userType;

    /**
     * @Serialization\Type("string")
     */
    public string $firstName;

    /**
     * @Serialization\Type("string")
     */
    public string $lastName;

    /**
     * @Serialization\Type("string")
     */
    public string $email;

    /**
     * @Serialization\Type("string")
     */
    public string $username;

    /**
     * @Serialization\Type("string")
     */
    public string $password;
}