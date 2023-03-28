import React, { useEffect, useState } from 'react';
import Button from '../components/UI/Button';
import User from './User/User';
import Leaderboard from './Leaderboard';
import { Link } from '@tanstack/react-router';
import { useAuth0 } from '@auth0/auth0-react';
import Card from './UI/Card';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../services/UserApi';

const Homepage = () => {
  const { isAuthenticated, user } = useAuth0();

  const newGameHandler = () => {
    console.log('clicked');
    return window.location.assign('/newGame');
  };

  const {
    isLoading,
    error,
    data: userData,
    refetch: refetchUser,
  } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      refetchUser();
    }
  }, [refetchUser, user]);

  return (
    <Card
      backgroundColor={userData?.backgroundColor}
      textColor={userData?.backgroundColor}
    >
      <body>
        <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
          <div className="flex-1 rounded-full bg-white pt-4 pb-4 text-black">
            <h2 className="text-center text-3xl font-bold">LEADERBOARD</h2>
          </div>
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div id="user" className="flex-1 bg-white pt-10 pb-10 text-black">
              <h2 className="text-center text-2xl">USER</h2>
            </div>
            <div
              id="gamesPlayed"
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">GAMES PLAYED</h2>
            </div>
            <div
              id="highScore"
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">HIGH SCORE</h2>
            </div>
          </div>
          <Leaderboard />
          <div className="text-center">
            <button
              onClick={newGameHandler}
              className="rounded-full bg-white py-1 px-3 font-bold text-black hover:border-black"
            >
              New Game
            </button>
          </div>
        </div>
      </body>
    </Card>
  );
};

export default Homepage;
