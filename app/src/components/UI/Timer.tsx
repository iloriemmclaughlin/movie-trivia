import React, { useState, useEffect } from 'react';

const millisecondTime = 60 * 10 * 1000;
const intervalMillisecond = 100;

const Timer = () => {
  // const [days, setDays] = useState(0);
  // const [hours, setHours] = useState(0);
  // const [minutes, setMinutes] = useState(0);
  // const [seconds, setSeconds] = useState(0);
  //
  // const endTime = 'March, 16, 2024 00:02:00';
  // // const otherTime = 'March, 16, 2024 00:00:00';
  // const getTime = () => {
  //   const time = Date.parse(endTime) - Date.now();
  //
  //   setDays(Math.floor(time / (1000 * 60 * 60 * 24)));
  //   setHours(Math.floor((time / (1000 * 60 * 60)) % 24));
  //   setMinutes(Math.floor(time / 1000 / 60) % 60);
  //   setSeconds(Math.floor(time / 1000) % 60);
  // };
  //
  // useEffect(() => {
  //   const interval = setInterval(() => getTime(endTime), 1000);
  //   return () => clearInterval(interval);
  // }, []);

  // return (
  // <div>
  //   <h2>DAYS: {days}</h2>
  //   <h2>HOURS: {hours}</h2>
  //   <h2>MINUTES: {minutes}</h2>
  //   <h2>SECONDS: {seconds}</h2>
  // </div>
  // );

  const [time, setTime] = useState(millisecondTime);
  const [referenceTime, setReferenceTime] = useState(Date.now());

  useEffect(() => {
    const countDown = () => {
      setTime(prevTime => {
        if (prevTime <= 0) return 0;

        const now = Date.now();
        const interval = now - referenceTime;
        setReferenceTime(now);
        return prevTime - interval;
      });
    };
    setTimeout(countDown, intervalMillisecond);
  }, [time]);

  return <>{(time / 1000).toFixed(1)}s</>;
};

export default Timer;
