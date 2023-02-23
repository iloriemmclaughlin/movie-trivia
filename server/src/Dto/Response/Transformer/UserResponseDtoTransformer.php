<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Entity\User;
use App\Dto\Response\UserResponseDto;

class UserResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private UserTypeResponseDtoTransformer $userTypeResponseDtoTransformer;

    public function __construct(UserTypeResponseDtoTransformer $userTypeResponseDtoTransformer)
    {
        $this->userTypeResponseDtoTransformer = $userTypeResponseDtoTransformer;
    }

    /**
     * @param User $user
     *
     * @return UserResponseDto
     */
    public function transformFromObject($user): UserResponseDto
    {
        $dto = new UserResponseDto();
        $dto->userId = $user->getId();
        $dto->userType = $this->userTypeResponseDtoTransformer->transformFromObject($user->getUserType());
        $dto->firstName = $user->getFirstName();
        $dto->lastName = $user->getLastName();
        $dto->email = $user->getEmail();
        $dto->password = $user->getPassword();

        return $dto;
    }

}