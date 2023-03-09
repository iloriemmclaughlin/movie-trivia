<?php

namespace App\Dto\Outgoing;

class UserTypeDto
{
    private int $userTypeId;
    private string $userType;

    public function __construct(int $userTypeId, string $userType)
    {
        $this->userTypeId = $userTypeId;
        $this->userType = $userType;
    }

    /**
     * @return int
     */
    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }




}