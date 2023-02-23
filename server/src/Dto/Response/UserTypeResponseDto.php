<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class UserTypeResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    public int $userTypeId;

    /**
     * @Serialization\Type("string")
     */
    public string $userType;

}