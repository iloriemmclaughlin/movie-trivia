import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';
import Timer from '../UI/Timer';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getQuestions } from '../../services/QuestionApi';
import { createGame, updateGame } from '../../services/GameApi';

function NewGame() {
  const [activeQuestion, setActiveQuestion] = useState(0);
  const [selectedAnswer, setSelectedAnswer] = useState('');
  const [selectedAnswerIndex, setSelectedAnswerIndex] = useState(null);
  const [gameFinish, setGameFinish] = useState(false);
  const [test, setTest] = useState(true);
  const [result, setResult] = useState({
    score: 0,
    correctAnswers: 0,
    wrongAnswers: 0,
  });
  const totalQuestions = result.correctAnswers + result.wrongAnswers;
  const [timeExpired, setTimeExpired] = useState(false);
  const onTimeExpired = () => {
    setTimeExpired(true);
  };

  const userId = 1;
  const date = new Date().toLocaleDateString();

  const addNewGame: any = useMutation({
    mutationFn: () =>
      createGame({
        userId: userId,
        totalQuestions: 0,
        score: 0,
        date: date,
      }),
  });

  const gameId = 4;

  const {
    isLoading,
    error,
    data: allQuestions,
    refetch,
  } = useQuery({
    queryKey: [`allQuestions`],
    queryFn: () => getQuestions(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
    // addNewGame.mutate();
  }, []);

  const newGameUpdate: any = useMutation({
    mutationFn: () =>
      updateGame({
        gameId: gameId,
        totalQuestions: totalQuestions,
        score: result.score,
      }),
  });

  useEffect(() => {
    refetch();
    if (test) {
      addNewGame.mutate();
      newGameUpdate.mutate();
    }
  }, []);

  if (isLoading) return <div className="text-center">GET READY TO PLAY!!!</div>;

  if (error)
    return <div className="text-center">OPE. NO GAME FOR YOU TODAY.</div>;

  if (!allQuestions) {
    return <div className="text-center">OPE. UNABLE TO LOAD QUESTIONS.</div>;
  }

  // @ts-ignore
  const { questionId, questionText, questionAnswer, questionOption } =
    allQuestions;

  const onClickNext = () => {
    setSelectedAnswerIndex(null);
    setResult(prev =>
      selectedAnswer
        ? {
            ...prev,
            score: prev.score + 1,
            correctAnswers: prev.correctAnswers + 1,
          }
        : { ...prev, wrongAnswers: prev.wrongAnswers + 1 },
    );
    if (activeQuestion !== allQuestions.length - 1) {
      setActiveQuestion(prev => prev + 1);
    } else {
      setActiveQuestion(0);
      setTimeExpired(true);
      setGameFinish(true);
    }
  };

  const onAnswerSelected = (answer, index) => {
    setSelectedAnswerIndex(index);
    if (answer === allQuestions[activeQuestion].questionAnswer) {
      setSelectedAnswer(true);
      console.log('right');
    } else {
      setSelectedAnswer(false);
      console.log('wrong');
    }
  };

  const questionNum = number => (number > 100 ? number : `${number}`);

  if (allQuestions) {
    // const shuffle = array => {
    //   array.sort(() => Math.random() - 0.5);
    // };

    // shuffle(allQuestions);

    const array = allQuestions[activeQuestion].questionOption;
    const answer = allQuestions[activeQuestion].questionAnswer;
    const totalOptions = array.concat(answer);

    // shuffle(totalOptions);
    const randomNum = Math.floor(Math.random() * allQuestions.length);
    const randomQ = allQuestions[randomNum];

    return (
      <Card>
        <Timer initMinute={0} initSeconds={30} onTimeExpired={onTimeExpired} />
        <body className="flex aspect-auto items-center justify-center bg-red-300">
          {!timeExpired ? (
            <div className="w-full max-w-xl">
              <div className="flex-3 my-3 rounded-full bg-red-100 pt-4 pb-4 text-black">
                <h2 className="text-center text-3xl font-bold">
                  QUESTION #{questionNum(activeQuestion + 1)}
                </h2>
              </div>
              <div className="my-2 flex-1 rounded-lg bg-red-100 pt-20 pb-20 pr-20 pl-20 text-black">
                <div className="text-center">
                  <h2 className="text-md mb-10 block">
                    {allQuestions[activeQuestion].questionText}
                  </h2>
                </div>
                <ul>
                  {totalOptions.map((answer, index) => (
                    <li
                      className={
                        selectedAnswerIndex === index
                          ? 'my-4 rounded-lg bg-blue-300'
                          : 'my-4 rounded-lg bg-red-300'
                      }
                      onClick={() => onAnswerSelected(answer, index)}
                      key={answer}
                    >
                      {answer}
                    </li>
                  ))}
                </ul>
              </div>
              <button
                onClick={onClickNext}
                disabled={selectedAnswerIndex === null}
                className="float-right my-3 rounded-full bg-red-100 py-1 px-3 font-bold text-black hover:bg-red-300"
              >
                Next Question
              </button>
            </div>
          ) : (
            <div>
              <h3>Results</h3>
              <p>
                Total Questions: <span>{totalQuestions}</span>
              </p>
              <p>
                Total Score: <span>{result.score}</span>
              </p>
              <p>
                Total Correct: <span>{result.correctAnswers}</span>
              </p>
              <p>
                Total Wrong: <span>{result.wrongAnswers}</span>
              </p>
            </div>
          )}
        </body>
      </Card>
    );
  }
}

export default NewGame;
