<?php

namespace App\Entity;

use App\Repository\GameQuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameQuestionRepository::class)]
class GameQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $game_question_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $user_answer = null;

    #[ORM\ManyToOne(inversedBy: 'gameQuestions')]
    #[ORM\JoinColumn(name: "game_id", referencedColumnName: "game_id", nullable: false)]
    private ?game $game_id = null;

    #[ORM\ManyToOne(inversedBy: 'gameQuestions')]
    #[ORM\JoinColumn(name: "question_id", referencedColumnName: "question_id", nullable: false)]
    private ?Question $question_id = null;

    public function getId(): ?int
    {
        return $this->game_question_id;
    }

    public function getUserAnswer(): ?string
    {
        return $this->user_answer;
    }

    public function setUserAnswer(?string $user_answer): self
    {
        $this->user_answer = $user_answer;

        return $this;
    }

    public function getGameId(): ?game
    {
        return $this->game_id;
    }

    public function setGameId(?game $game_id): self
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getQuestionId(): ?Question
    {
        return $this->question_id;
    }

    public function setQuestionId(?Question $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }
}
