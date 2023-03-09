<?php

namespace App\Dto\Outgoing;


class UserDto
{
    private int $userId;
    private UserTypeDto $userType;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $username;
    private string $password;
    private string $backgroundColor;
    private string $foregroundColor;

    /**
     * @param int $userId
     * @param UserTypeDto $userType
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $backgroundColor
     * @param string $foregroundColor
     */
    public function __construct(int $userId, UserTypeDto $userType, string $firstName, string $lastName, string $email, string $username, string $password, string $backgroundColor, string $foregroundColor)
    {
        $this->userId = $userId;
        $this->userType = $userType;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->backgroundColor = $backgroundColor;
        $this->foregroundColor = $foregroundColor;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return UserTypeDto
     */
    public function getUserType(): UserTypeDto
    {
        return $this->userType;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @return string
     */
    public function getForegroundColor(): string
    {
        return $this->foregroundColor;
    }


}