<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\GameQuestionResponseDto;
use App\Entity\GameQuestion;

class GameQuestionResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private GameResponseDtoTransformer $gameResponseDtoTransformer;
    private QuestionResponseDtoTransformer $questionResponseDtoTransformer;

    public function __construct(GameResponseDtoTransformer $gameResponseDtoTransformer, QuestionResponseDtoTransformer $questionResponseDtoTransformer)
    {
        $this->gameResponseDtoTransformer = $gameResponseDtoTransformer;
        $this->questionResponseDtoTransformer = $questionResponseDtoTransformer;
    }

    /**]
     * @param GameQuestion $gameQuestion
     *
     * @return GameQuestionResponseDto
     */
    public function transformFromObject($gameQuestion): GameQuestionResponseDto
    {
        $dto = new GameQuestionResponseDto();
        $dto->gameQuestionId = $gameQuestion->getId();
        $dto->gameId = $this->gameResponseDtoTransformer->transformFromObject($gameQuestion->getGameId());
        $dto->questionId = $this->questionResponseDtoTransformer->transformFromObject($gameQuestion->getQuestionId());
        $dto->userAnswer = $gameQuestion->getUserAnswer();

        return $dto;
    }


}