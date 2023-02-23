<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\UserTypeResponseDto;
use App\Entity\UserType;

class UserTypeResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    /**
     * @param UserType $userType
     *
     * @return UserTypeResponseDto
     */
    public function transformFromObject($userType): UserTypeResponseDto
    {
        $dto = new UserTypeResponseDto();
        $dto->userTypeId = $userType->getId();
        $dto->userType = $userType->getUserType();

        return $dto;
    }

}