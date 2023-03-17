import React, { useEffect, useState } from 'react';
import { getQuestionOptions } from '../../services/QuestionApi';
import { useQuery } from '@tanstack/react-query';
import { Simulate } from 'react-dom/test-utils';
import click = Simulate.click;

const QuestionOptions = () => {
  const {
    isLoading,
    error,
    data: options,
    refetch,
  } = useQuery({
    queryKey: [`options`],
    queryFn: () => getQuestionOptions(11),
    enabled: false,
  });

  const [selected, setSelected] = useState('rounded-full border bg-red-300');
  const [toggled, isToggled] = useState(true);

  const clicked = event => {
    event.preventDefault();

    setSelected('border-4 border-black');
  };

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading)
    return <div className="text-center">Loading question options...</div>;

  if (error)
    return <div className="text-center">OPE. NO QUESTION OPTIONS.</div>;

  if (options) {
    // const buttonSelected = clicked
    //   ? 'rounded-full border bg-red-300'
    //   : 'border-4 border-black';

    return (
      <div className="grid grid-cols-2 gap-4">
        <button
          onClick={() => {
            clicked;
            isToggled(!toggled);
          }}
          className={selected}
        >
          {options[0]}
        </button>
        <button
          onClick={event => event.preventDefault()}
          className="rounded-full bg-red-300"
        >
          {options[1]}
        </button>
        <button
          onClick={event => event.preventDefault()}
          className="rounded-full bg-red-300"
        >
          {options[2]}
        </button>
        <button
          onClick={event => event.preventDefault()}
          className="rounded-full bg-red-300"
        >
          {options[3]}
        </button>
      </div>
    );
  }
  return <div></div>;
};

export default QuestionOptions;
