<?php

namespace App\Dto\Outgoing;

class QuestionDto
{
    private int $questionId;
    private string $questionType;
    private string $questionText;
    private string $questionAnswer;

    /**
     * @param int $questionId
     * @param string $questionType
     * @param string $questionText
     * @param string $questionAnswer
     */
    public function __construct(int $questionId, string $questionType, string $questionText, string $questionAnswer)
    {
        $this->questionId = $questionId;
        $this->questionType = $questionType;
        $this->questionText = $questionText;
        $this->questionAnswer = $questionAnswer;
    }

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




}