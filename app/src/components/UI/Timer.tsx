import React, { useState, useEffect } from 'react';
import Card from './Card';

const Timer = props => {
  const { initMinute = 2, initSeconds = 0 } = props;
  const [minutes, setMinutes] = React.useState(initMinute);
  const [seconds, setSeconds] = React.useState(initSeconds);

  useEffect(() => {
    let myInterval = setInterval(() => {
      if (seconds > 0) {
        setSeconds(seconds - 1);
      }
      if (seconds === 0) {
        if (minutes === 0) {
          clearInterval(myInterval);
        } else {
          setMinutes(minutes - 1);
          setSeconds(59);
        }
      }
    }, 1000);
    return () => {
      clearInterval(myInterval);
    };
  });

  return (
    <Card>
      <div>
        {minutes === 0 && seconds === 0 ? (
          <div className="bg-black pt-2 pb-2 text-center text-xl font-bold text-white">
            TIME'S UP!!!
          </div>
        ) : (
          <h1 className="bg-black pt-2 pb-2 text-center text-xl font-bold text-white">
            {minutes < 10 ? `0${minutes}` : minutes}:
            {seconds < 10 ? `0${seconds}` : seconds}
          </h1>
        )}
      </div>
    </Card>
  );
};

export default Timer;
