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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $question_option_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option_one = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option_two = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option_three = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option_four = null;

    #[ORM\OneToOne(inversedBy: 'questionOption', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionOptionId(): ?int
    {
        return $this->question_option_id;
    }

    public function setQuestionOptionId(int $question_option_id): self
    {
        $this->question_option_id = $question_option_id;

        return $this;
    }

    public function getOptionOne(): ?string
    {
        return $this->option_one;
    }

    public function setOptionOne(string $option_one): self
    {
        $this->option_one = $option_one;

        return $this;
    }

    public function getOptionTwo(): ?string
    {
        return $this->option_two;
    }

    public function setOptionTwo(string $option_two): self
    {
        $this->option_two = $option_two;

        return $this;
    }

    public function getOptionThree(): ?string
    {
        return $this->option_three;
    }

    public function setOptionThree(string $option_three): self
    {
        $this->option_three = $option_three;

        return $this;
    }

    public function getOptionFour(): ?string
    {
        return $this->option_four;
    }

    public function setOptionFour(string $option_four): self
    {
        $this->option_four = $option_four;

        return $this;
    }

    public function getQuestionId(): ?Question
    {
        return $this->question_id;
    }

    public function setQuestionId(Question $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

}
