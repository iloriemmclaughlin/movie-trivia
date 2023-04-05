import React, { useEffect, useState } from 'react';
import Leaderboard from './Leaderboard';
import { useAuth0 } from '@auth0/auth0-react';
import Card from './UI/Card';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../services/UserApi';
import LoginButton from './Login/LoginButton';
import useUserStore from '../store/userStore';

const Homepage = () => {
  const { isAuthenticated, user } = useAuth0();
  const backgroundColor = useUserStore(state => state.backgroundColor);
  const foregroundColor = useUserStore(state => state.foregroundColor);
  const [bgColorValid, setBgColorValid] = useState(true);
  const [fgColorValid, setFgColorValid] = useState(true);

  const newGameHandler = () => {
    console.log('clicked');
    return window.location.assign('/newGame');
  };

  const { data: userData, refetch: refetchUser } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      refetchUser();
    }
  }, [user]);

  if (!isAuthenticated) {
    return (
      <Card>
        <div className="text-center">
          <h1 className="text-xl">LOGIN TO PLAY!</h1>
          <LoginButton />
        </div>
      </Card>
    );
  }

  // @ts-ignore
  // if (userData?.backgroundColor === '') {
  //   setBgColorValid(false);
  // }

  // @ts-ignore
  const bgColor = {
    backgroundColor: bgColorValid ? userData?.backgroundColor : backgroundColor,
  };
  const fgColor = {
    backgroundColor: fgColorValid ? userData?.foregroundColor : foregroundColor,
  };

  return (
    <Card>
      <body
        style={bgColor}
        // style={{
        //   backgroundColor: bgColorValid
        //     ? userData?.backgroundColor
        //     : backgroundColor,
        // }}
        className="w-auto"
      >
        <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
          <div
            style={fgColor}
            className="flex-1 rounded-full bg-white pt-4 pb-4 text-black"
          >
            <h2 className="text-center text-3xl font-bold">LEADERBOARD</h2>
          </div>
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div
              style={fgColor}
              id="user"
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">USER</h2>
            </div>
            <div
              style={fgColor}
              id="gamesPlayed"
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <h2 className="text-center text-2xl">GAMES PLAYED</h2>
            </div>
            <div
              style={fgColor}
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
              style={fgColor}
              className="rounded-full border-black bg-white py-1 px-3 font-bold text-black hover:border-2"
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
