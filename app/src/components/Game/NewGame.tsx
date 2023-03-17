import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';
import useCounter from '../../hooks/use-counter';
import Timer from '../UI/Timer';
import useInput from '../../hooks/use-input';
import QuestionOptions from '../Question/QuestionOptions';
import { useQuery } from '@tanstack/react-query';
import { getAllQuestions, getQuestion } from '../../services/QuestionApi';

const NewGame = () => {
  const counter = useCounter();
  const [currentQuestion, setCurrentQuestion] = useState(0);

  const {
    isLoading,
    error,
    data: questions,
    refetch,
  } = useQuery({
    queryKey: [`question`],
    queryFn: () => getAllQuestions(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading) return <div className="text-center">GET READY TO PLAY!!!</div>;

  if (error)
    return <div className="text-center">OPE. NO GAME FOR YOU TODAY.</div>;

  const randomQuestion = e => {
    const x = questions.length;
    setCurrentQuestion(Math.floor(Math.random() * x));
  };

  return (
    <Card>
      {/*<Timer />*/}
      <body className="flex aspect-auto items-center justify-center bg-red-300">
        <form className="w-full max-w-xl">
          <div className="flex-3 my-3 rounded-full bg-red-100 pt-4 pb-4 text-black">
            <h2 className="text-center text-3xl font-bold">QUESTION #1</h2>
          </div>
          <div className="my-2 flex-1 rounded-lg bg-red-100 pt-20 pb-20 pr-20 pl-20 text-black">
            <div className="text-center">
              <label className="text-md mb-10 block">
                {questions[10].questionText}
              </label>
              {/*<input*/}
              {/*  type="text"*/}
              {/*  id="userResponse"*/}
              {/*  className="x mb-10 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"*/}
              {/*  placeholder="YOUR ANSWER HERE"*/}
              {/*  required*/}
              {/*/>*/}
            </div>
            <QuestionOptions />
          </div>
          <button
            onClick={randomQuestion}
            className="float-right my-3 rounded-full bg-red-100 py-1 px-3 font-bold text-black hover:bg-red-300"
          >
            Next Question
          </button>
        </form>
      </body>
    </Card>
  );
};

export default NewGame;
