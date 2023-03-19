import React, { useEffect, useState } from 'react';
import { getQuestionOptions } from '../../services/QuestionApi';
import { useQuery } from '@tanstack/react-query';

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
  const [userAnswer, setUserAnswer] = useState('');
  const [toggled, isToggled] = useState(true);
  const userResponses = [];

  const clicked = event => {
    event.preventDefault();
    setUserAnswer(event.target.value);
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
      <form className="grid grid-cols-2 gap-4">
        <button onClick={clicked} className={selected}>
          {options[0]}
        </button>
        <button className="rounded-full bg-red-300">{options[1]}</button>
        <button className="rounded-full bg-red-300">{options[2]}</button>
        <button className="rounded-full bg-red-300">{options[3]}</button>
      </form>
      // <div className="grid grid-cols-2 gap-4">
      //   <button
      //     onClick={e => {
      //       clicked(e);
      //       isToggled(!toggled);
      //     }}
      //     className={selected}
      //   >
      //     {options[0]}
      //   </button>
      //   <button
      //     onClick={event => event.preventDefault()}
      //     className="rounded-full bg-red-300"
      //   >
      //     {options[1]}
      //   </button>
      //   <button
      //     onClick={event => event.preventDefault()}
      //     className="rounded-full bg-red-300"
      //   >
      //     {options[2]}
      //   </button>
      //   <button
      //     onClick={event => event.preventDefault()}
      //     className="rounded-full bg-red-300"
      //   >
      //     {options[3]}
      //   </button>
      // </div>
    );
  }
  return <div></div>;
};

export default QuestionOptions;
