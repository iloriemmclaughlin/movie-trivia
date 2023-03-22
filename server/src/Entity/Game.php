<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $game_id = null;

    #[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
    private ?int $total_questions = null;

    #[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
    private ?int $score = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "user_id", nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'game_id', targetEntity: GameQuestion::class, orphanRemoval: true)]
    private Collection $gameQuestions;

    public function __construct()
    {
        $this->gameQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->game_id;
    }

    public function getTotalQuestions(): ?int
    {
        return $this->total_questions;
    }

    public function setTotalQuestions(int $total_questions): self
    {
        $this->total_questions = $total_questions;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, GameQuestion>
     */
    public function getGameQuestions(): Collection
    {
        return $this->gameQuestions;
    }

    public function addGameQuestion(GameQuestion $gameQuestion): self
    {
        if (!$this->gameQuestions->contains($gameQuestion)) {
            $this->gameQuestions->add($gameQuestion);
            $gameQuestion->setGameId($this);
        }

        return $this;
    }

    public function removeGameQuestion(GameQuestion $gameQuestion): self
    {
        if ($this->gameQuestions->removeElement($gameQuestion)) {
            // set the owning side to null (unless already changed)
            if ($gameQuestion->getGameId() === $this) {
                $gameQuestion->setGameId(null);
            }
        }

        return $this;
    }
}