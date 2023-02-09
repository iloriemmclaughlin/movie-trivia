<?php

namespace App\Entity;

use App\Repository\QuestionOptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionOptionRepository::class)]
class QuestionOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $question_option_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option = null;

    #[ORM\ManyToOne(inversedBy: 'questionOptions')]
    #[ORM\JoinColumn(name: "question_id", referencedColumnName: "question_id", nullable: false)]
    private ?Question $question_id = null;

    public function getId(): ?int
    {
        return $this->question_option_id;
    }

    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): self
    {
        $this->option = $option;

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
