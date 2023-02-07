<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $question_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question_text = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question_answer = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionType $question_type_id = null;

    #[ORM\OneToOne(mappedBy: 'question_id', cascade: ['persist', 'remove'])]
    private ?QuestionOption $questionOption = null;

    #[ORM\OneToMany(mappedBy: 'question_id', targetEntity: GameQuestion::class)]
    private Collection $gameQuestions;

    public function __construct()
    {
        $this->gameQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getQuestionText(): ?string
    {
        return $this->question_text;
    }

    public function setQuestionText(string $question_text): self
    {
        $this->question_text = $question_text;

        return $this;
    }

    public function getQuestionAnswer(): ?string
    {
        return $this->question_answer;
    }

    public function setQuestionAnswer(string $question_answer): self
    {
        $this->question_answer = $question_answer;

        return $this;
    }

    public function getQuestionTypeId(): ?QuestionType
    {
        return $this->question_type_id;
    }

    public function setQuestionTypeId(?QuestionType $question_type_id): self
    {
        $this->question_type_id = $question_type_id;

        return $this;
    }

    public function getQuestionOption(): ?QuestionOption
    {
        return $this->questionOption;
    }

    public function setQuestionOption(QuestionOption $questionOption): self
    {
        // set the owning side of the relation if necessary
        if ($questionOption->getQuestionId() !== $this) {
            $questionOption->setQuestionId($this);
        }

        $this->questionOption = $questionOption;

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
            $gameQuestion->setQuestionId($this);
        }

        return $this;
    }

    public function removeGameQuestion(GameQuestion $gameQuestion): self
    {
        if ($this->gameQuestions->removeElement($gameQuestion)) {
            // set the owning side to null (unless already changed)
            if ($gameQuestion->getQuestionId() === $this) {
                $gameQuestion->setQuestionId(null);
            }
        }

        return $this;
    }
}
