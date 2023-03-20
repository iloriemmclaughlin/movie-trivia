import React, { useEffect, useState } from 'react';
import {
  getAllQuestions,
  getQuestionOptions,
} from '../../services/QuestionApi';
import { useQuery } from '@tanstack/react-query';

const QuestionOptions = (props: { questionId: number }) => {
  console.log(props.questionId);
  const {
    isLoading,
    error,
    data: options,
    refetch,
  } = useQuery({
    queryKey: [`options`],
    queryFn: () => getQuestionOptions(props.questionId),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading)
    return <div className="text-center">Loading question options...</div>;

  if (error)
    return <div className="text-center">OPE. NO QUESTION OPTIONS.</div>;

  if (!options)
    return <div className="text-center">OPE. UNABLE TO LOAD QUESTIONS.</div>;

  return (
    <ul>
      {options.map(item => (
        <li>{item}</li>
      ))}
    </ul>
  );
};

export default QuestionOptions;
