import React from 'react';
import Leaderboard from './Leaderboard';
import { useAuth0 } from '@auth0/auth0-react';
import Card from './Card';
import LoginButton from '../Login/LoginButton';
import useUserStore from '../../store/userStore';
import Loading from './Loading';
import Error from './Error';

// Returns the homepage containing the leaderboard component; allows user to start new game
const Homepage = () => {
  const { isAuthenticated, user, isLoading, error } = useAuth0();
  const currentUser = useUserStore(state => state.user);
  // @ts-ignore
  const backgroundColor = useUserStore(state => state.backgroundColor);
  // @ts-ignore
  const foregroundColor = useUserStore(state => state.foregroundColor);

  const newGameHandler = () => {
    return window.location.assign('/newGame');
  };

  if (isLoading) {
    return <Loading />;
  } else if (!isAuthenticated && !user) {
    return (
      <Card>
        <div className="text-center">
          <h1 className="text-xl">LOGIN TO PLAY!</h1>
          <LoginButton />
        </div>
      </Card>
    );
  }

  if (error) {
    return <Error />;
  }

  if (currentUser) {
    return (
      <Card>
        <div
          style={{ backgroundColor: backgroundColor }}
          className="min-h-screen"
        >
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
            <div
              style={{ backgroundColor: foregroundColor }}
              className="flex-1 rounded-full bg-white pt-4 pb-4 text-black"
            >
              <h2 className="text-center text-3xl font-bold">LEADERBOARD</h2>
            </div>
            <div className="grid grid-cols-3 pl-10 pr-10">
              <div
                style={{ backgroundColor: foregroundColor }}
                id="user"
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">USER</h2>
              </div>
              <div
                style={{ backgroundColor: foregroundColor }}
                id="gamesPlayed"
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">GAMES PLAYED</h2>
              </div>
              <div
                style={{ backgroundColor: foregroundColor }}
                id="highScore"
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">HIGH SCORE</h2>
              </div>
            </div>
            <Leaderboard />
            <div className="text-center">
              <button
                onClick={newGameHandler}
                style={{ backgroundColor: foregroundColor }}
                className="mr-1 mb-1 rounded px-6 py-3 text-sm font-bold uppercase text-black shadow outline-none transition-all duration-150 ease-linear hover:shadow-lg focus:outline-none"
              >
                New Game
              </button>
            </div>
          </div>
        </div>
      </Card>
    );
  }
};

export default Homepage;
