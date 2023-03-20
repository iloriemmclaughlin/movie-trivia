<?php

namespace App\Dto\Outgoing;

class QuestionOptionDto
{
    private int $questionOptionId;
    private int $questionId;
    private string $questionOption;

    /**
     * @param int $questionOptionId
     * @param int $questionId
     * @param string $questionOption
     */
    public function __construct(int $questionOptionId, int $questionId, string $questionOption)
    {
        $this->questionOptionId = $questionOptionId;
        $this->questionId = $questionId;
        $this->questionOption = $questionOption;
    }

    /**
     * @return int
     */
    public function getQuestionOptionId(): int
    {
        return $this->questionOptionId;
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
    public function getQuestionOption(): string
    {
        return $this->questionOption;
    }



}