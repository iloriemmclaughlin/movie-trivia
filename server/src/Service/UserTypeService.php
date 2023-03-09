<?php

namespace App\Service;

use App\Entity\UserType;
use App\Dto\Outgoing\UserTypeDto;
use App\Repository\UserTypeRepository;

class UserTypeService
{

    private UserTypeRepository $userTypeRepository;

    public function __construct(UserTypeRepository $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }

    public function getUserType(int $userTypeId): ?UserType
    {
        return $this->userTypeRepository->find($userTypeId);
    }

    public function transformToDto(UserType $userType): UserTypeDto
    {
        return new UserTypeDto(
            $userType->getId(),
            $userType->getUserType()
        );
    }

}