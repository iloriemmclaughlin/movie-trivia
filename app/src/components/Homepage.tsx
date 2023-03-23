import React, { useState } from 'react';
import Button from '../components/UI/Button';
import User from './User/User';
import Leaderboard from './Leaderboard';
import { Link } from '@tanstack/react-router';

const Homepage = () => {
  const newGameHandler = () => {
    console.log('clicked');
    return window.location.assign('/newGame');
  };

  return (
    <div>
      <body className="bg-red-300">
        <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
          <div className="flex-1 rounded-full bg-red-100 pt-4 pb-4 text-black">
            <h2 className="text-center text-3xl font-bold">LEADERBOARD</h2>
          </div>
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div id="user" className="flex-1 bg-red-100 pt-10 pb-10 text-black">
              <h2 className="text-center text-2xl">USER</h2>
            </div>
            <div
              id="gamesPlayed"
              className="flex-1 bg-red-100 pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">GAMES PLAYED</h2>
            </div>
            <div
              id="highScore"
              className="flex-1 bg-red-100 pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">HIGH SCORE</h2>
            </div>
          </div>
          <Leaderboard />
          <div className="text-center">
            <button
              onClick={newGameHandler}
              className="rounded-full bg-red-100 py-1 px-3 font-bold text-black hover:bg-red-300"
            >
              New Game
            </button>
          </div>
        </div>
      </body>
    </div>
  );
};

export default Homepage;
