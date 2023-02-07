<?php

namespace App\Entity;

use App\Repository\GameQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameQuestionRepository::class)]
class GameQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $game_question_id = null;

    #[ORM\ManyToOne(inversedBy: 'gameQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\ManyToOne(inversedBy: 'gameQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameQuestionId(): ?int
    {
        return $this->game_question_id;
    }

    public function setGameQuestionId(int $game_question_id): self
    {
        $this->game_question_id = $game_question_id;

        return $this;
    }

    public function getGameId(): ?Game
    {
        return $this->game_id;
    }

    public function setGameId(?Game $game_id): self
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
