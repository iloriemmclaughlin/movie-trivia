import React, { useState, useEffect } from 'react';
import Card from './Card';

// @ts-ignore
const Timer = props => {
  const timeInMilliseconds = 61200;
  const intervalInMilliseconds = 100;

  const [time, setTime] = useState(timeInMilliseconds);
  const [referenceTime, setReferenceTime] = useState(Date.now());

  useEffect(() => {
    const countdownToZero = () => {
      setTime(prevTime => {
        if (prevTime <= 0) return 0;

        const now = Date.now();
        const interval = now - referenceTime;
        setReferenceTime(now);
        return prevTime - interval;
      });
    };

    setTimeout(countdownToZero, intervalInMilliseconds);
    if (time === 0) {
      props.onTimeExpired();
    }
  });

  const minutes = Math.floor((time / 1000 / 60) << 0);
  const seconds = Math.floor((time / 1000) % 60);
  const formatted = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

  return (
    <Card>
      <div>
        {time === 0 ? (
          <div className="bg-black pt-2 pb-2 text-center text-xl font-bold text-white">
            TIME'S UP!!!
          </div>
        ) : (
          <h1 className="bg-black pt-2 pb-2 text-center text-xl font-bold text-white">
            {formatted}
          </h1>
        )}
      </div>
    </Card>
  );
};

export default Timer;
