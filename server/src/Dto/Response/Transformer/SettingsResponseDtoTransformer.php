<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\SettingsResponseDto;
use App\Entity\Settings;

class SettingsResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private UserResponseDtoTransformer $userResponseDtoTransformer;

    public function __construct(UserResponseDtoTransformer $userResponseDtoTransformer)
    {
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
    }

    /**
     * @param Settings $settings
     *
     * @return SettingsResponseDto
     */
    public function transformFromObject($settings): SettingsResponseDto
    {
        $dto = new SettingsResponseDto();
        $dto->settingsId = $settings->getId();
        $dto->userId = $this->userResponseDtoTransformer->transformFromObject($settings->getUserId());
        $dto->backgroundColor = $settings->getBackgroundColor();
        $dto->foregroundColor = $settings->getForegroundColor();

        return $dto;
    }


}