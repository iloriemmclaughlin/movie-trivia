import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';
import useCounter from '../../hooks/use-counter';
import Timer from '../UI/Timer';
import { useQuery } from '@tanstack/react-query';
import {
  getAllQuestions,
  getQuestion,
  getQuestions,
} from '../../services/QuestionApi';

const NewGame = () => {
  const [activeQuestion, setActiveQuestion] = useState(0);
  const [selectedAnswer, setSelectedAnswer] = useState('');
  const [showResult, setShowResult] = useState(false);
  const [selectedAnswerIndex, setSelectedAnswerIndex] = useState(null);
  const [result, setResult] = useState({
    score: 0,
    correctAnswers: 0,
    wrongAnswers: 0,
  });

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
      setShowResult(true);
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

  const questionNum = number => (number > 9 ? number : `${number}`);

  if (allQuestions) {
    const array = allQuestions[activeQuestion].questionOption;
    const answer = allQuestions[activeQuestion].questionAnswer;
    const totalOptions = array.concat(answer);

    return (
      <Card>
        <Timer />
        <body className="flex aspect-auto items-center justify-center bg-red-300">
          {!showResult ? (
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
                Total Questions: <span>{allQuestions.length}</span>
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

  // return (
  //   <Card>
  //     {/*<Timer />*/}
  //     <body className="flex aspect-auto items-center justify-center bg-red-300">
  //       <form className="w-full max-w-xl">
  //         <div className="flex-3 my-3 rounded-full bg-red-100 pt-4 pb-4 text-black">
  //           <h2 className="text-center text-3xl font-bold">QUESTION #1</h2>
  //         </div>
  //         <div className="my-2 flex-1 rounded-lg bg-red-100 pt-20 pb-20 pr-20 pl-20 text-black">
  //           <div className="text-center">
  //             <label className="text-md mb-10 block">
  //               {questions[10].questionText}
  //             </label>
  //             {/*<input*/}
  //             {/*  type="text"*/}
  //             {/*  id="userResponse"*/}
  //             {/*  className="x mb-10 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"*/}
  //             {/*  placeholder="YOUR ANSWER HERE"*/}
  //             {/*  required*/}
  //             {/*/>*/}
  //           </div>
  //           <QuestionOptions questionId={questions[].questionId}/>
  //         </div>
  //         <button
  //           onClick={onClickNext}
  //           className="float-right my-3 rounded-full bg-red-100 py-1 px-3 font-bold text-black hover:bg-red-300"
  //         >
  //           Next Question
  //         </button>
  //       </form>
  //     </body>
  //   </Card>
  // );
};

export default NewGame;
