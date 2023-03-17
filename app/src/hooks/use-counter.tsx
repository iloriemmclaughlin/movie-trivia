import React, { useEffect, useRef, useState } from 'react';

const useCounter = () => {
  const [counter, setCounter] = useState(120);

  useEffect(() => {
    counter > 0 && setTimeout(() => setCounter(counter - 1), 1000);
  }, [counter]);

  return counter;
};

export default useCounter;
