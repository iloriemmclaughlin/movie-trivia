<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $stats_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $games_played = null;

    #[ORM\Column(nullable: true)]
    private ?int $high_score = null;

    #[ORM\OneToOne(inversedBy: 'stats', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatsId(): ?int
    {
        return $this->stats_id;
    }

    public function setStatsId(int $stats_id): self
    {
        $this->stats_id = $stats_id;

        return $this;
    }

    public function getGamesPlayed(): ?int
    {
        return $this->games_played;
    }

    public function setGamesPlayed(int $games_played): self
    {
        $this->games_played = $games_played;

        return $this;
    }

    public function getHighScore(): ?int
    {
        return $this->high_score;
    }

    public function setHighScore(?int $high_score): self
    {
        $this->high_score = $high_score;

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
