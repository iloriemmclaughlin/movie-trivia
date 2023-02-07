<?php

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $settings_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $background_color = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $foreground_color = null;

    #[ORM\OneToOne(inversedBy: 'settings', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSettingsId(): ?int
    {
        return $this->settings_id;
    }

    public function setSettingsId(int $settings_id): self
    {
        $this->settings_id = $settings_id;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getForegroundColor(): ?string
    {
        return $this->foreground_color;
    }

    public function setForegroundColor(string $foreground_color): self
    {
        $this->foreground_color = $foreground_color;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
