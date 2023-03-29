import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';
import Timer from '../UI/Timer';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getQuestions } from '../../services/QuestionApi';
import { createUpdateGame } from '../../services/GameApi';
import { getUserByAuth } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';

function NewGame() {
  const { isAuthenticated, user } = useAuth0();

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
  const [timeExpired, setTimeExpired] = useState(false);
  const onTimeExpired = () => {
    setTimeExpired(true);
  };

  const finishGameHandler = () => {
    return window.location.assign('/');
  };

  const playAgainHandler = () => {
    return window.location.assign('/newGame');
  };

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

  const { data: userData, refetch: refetchUser } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  const userId = userData?.userId;
  const date = new Date().toLocaleDateString();

  const addNewGame: any = useMutation({
    mutationFn: () =>
      createUpdateGame({
        userId: userId,
        date: date,
        totalQuestions: result.correctAnswers + result.wrongAnswers,
        score: result.score,
      }),
  });

  useEffect(() => {
    refetch();
    if (isAuthenticated && user) {
      refetchUser();
    }
    if (timeExpired) {
      addNewGame.mutate();
    }
  }, [refetchUser, user, timeExpired]);

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
    } else {
      setSelectedAnswer(false);
    }
  };

  const questionNum = number => (number > 100 ? number : `${number}`);
  const styleB = { backgroundColor: userData?.backgroundColor };
  const styleF = { backgroundColor: userData?.foregroundColor };

  if (allQuestions) {
    return (
      <Card>
        <Timer onTimeExpired={onTimeExpired} />
        <body
          style={styleB}
          className="flex aspect-auto items-center justify-center"
        >
          {!timeExpired ? (
            <div className="w-full max-w-xl">
              <div
                style={styleF}
                className="flex-3 my-3 rounded-full pt-4 pb-4 text-black"
              >
                <h2 className="text-center text-3xl font-bold">
                  QUESTION #{questionNum(activeQuestion + 1)}
                </h2>
              </div>
              <div
                style={styleF}
                className="my-2 flex-1 rounded-lg pt-20 pb-20 pr-20 pl-20 text-black"
              >
                <div className="text-center">
                  <h2 className="text-md mb-10 block">
                    {allQuestions[activeQuestion].questionText}
                  </h2>
                </div>
                <ul>
                  {allQuestions[activeQuestion].questionOption.map(
                    (answer, index) => (
                      <li
                        style={styleB}
                        className={
                          selectedAnswerIndex === index
                            ? 'my-4 rounded-lg border-4 border-black'
                            : 'my-4 rounded-lg'
                        }
                        onClick={() => onAnswerSelected(answer, index)}
                        key={answer}
                      >
                        {answer}
                      </li>
                    ),
                  )}
                </ul>
              </div>
              <button
                onClick={finishGameHandler}
                style={styleF}
                className="float-left my-3 rounded-full py-1 px-3 font-bold text-black hover:bg-red-300"
              >
                I GIVE UP!
              </button>
              <button
                onClick={onClickNext}
                disabled={selectedAnswerIndex === null}
                style={styleF}
                className="float-right my-3 rounded-full py-1 px-3 font-bold text-black hover:bg-red-300"
              >
                Next Question
              </button>
            </div>
          ) : (
            <div>
              <h3>Results</h3>
              <p>
                Total Questions:{' '}
                <span>{result.correctAnswers + result.wrongAnswers}</span>
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
              <button
                onClick={finishGameHandler}
                style={styleF}
                className="float-left rounded-full border-4 py-1 px-3 font-bold text-black hover:border-black"
              >
                Finish
              </button>
              <button
                onClick={playAgainHandler}
                style={styleF}
                className="float-right rounded-full border-4 py-1 px-3 font-bold text-black hover:border-black"
              >
                Play Again
              </button>
            </div>
          )}
        </body>
      </Card>
    );
  }
}

export default NewGame;
