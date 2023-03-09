<?php

namespace App\Dto\Incoming;


class CreateUserDto
{
    private int $userTypeId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $username;
    private string $password;
    private string $backgroundColor;
    private string $foregroundColor;

    /**
     * @return int
     */
    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }

    /**
     * @param int $userTypeId
     */
    public function setUserTypeId(int $userTypeId): void
    {
        $this->userTypeId = $userTypeId;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string
     */
    public function getForegroundColor(): string
    {
        return $this->foregroundColor;
    }

    /**
     * @param string $foregroundColor
     */
    public function setForegroundColor(string $foregroundColor): void
    {
        $this->foregroundColor = $foregroundColor;
    }


}