<?php

namespace App\Entity;

use App\Repository\QuestionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionTypeRepository::class)]
class QuestionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $question_type_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question_type = null;

    #[ORM\OneToMany(mappedBy: 'question_type_id', targetEntity: Question::class, orphanRemoval: true)]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionTypeId(): ?int
    {
        return $this->question_type_id;
    }

    public function setQuestionTypeId(int $question_type_id): self
    {
        $this->question_type_id = $question_type_id;

        return $this;
    }

    public function getQuestionType(): ?string
    {
        return $this->question_type;
    }

    public function setQuestionType(string $question_type): self
    {
        $this->question_type = $question_type;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuestionTypeId($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuestionTypeId() === $this) {
                $question->setQuestionTypeId(null);
            }
        }

        return $this;
    }
}
