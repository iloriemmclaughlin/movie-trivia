<?php

namespace App\Dto\Outgoing;

class QuestionDto
{
    private int $questionId;
    private string $questionType;
    private string $questionText;
    private string $questionAnswer;
    private int $questionOptionId;
    private array $questionOption;

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * @return string
     */
    public function getQuestionType(): string
    {
        return $this->questionType;
    }

    /**
     * @return string
     */
    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    /**
     * @return string
     */
    public function getQuestionAnswer(): string
    {
        return $this->questionAnswer;
    }

    /**
     * @return int
     */
    public function getQuestionOptionId(): int
    {
        return $this->questionOptionId;
    }

    /**
     * @return array
     */
    public function getQuestionOption(): array
    {
        return $this->questionOption;
    }

    /**
     * @param int $questionId
     */
    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    /**
     * @param string $questionType
     */
    public function setQuestionType(string $questionType): void
    {
        $this->questionType = $questionType;
    }

    /**
     * @param string $questionText
     */
    public function setQuestionText(string $questionText): void
    {
        $this->questionText = $questionText;
    }

    /**
     * @param string $questionAnswer
     */
    public function setQuestionAnswer(string $questionAnswer): void
    {
        $this->questionAnswer = $questionAnswer;
    }

    /**
     * @param int $questionOptionId
     */
    public function setQuestionOptionId(int $questionOptionId): void
    {
        $this->questionOptionId = $questionOptionId;
    }

    /**
     * @param array $questionOption
     */
    public function setQuestionOption(array $questionOption): void
    {
        $this->questionOption = $questionOption;
    }


}