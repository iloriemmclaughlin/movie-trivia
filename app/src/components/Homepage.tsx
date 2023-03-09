import React from 'react';
import Button from '../components/UI/Button';
import User from './User';

const Homepage = () => {
  const users = [
    { id: 1, username: 'imclaughlin', gamesPlayed: 10, highScore: 25 },
    { id: 2, username: 'jsmith', gamesPlayed: 5, highScore: 16 },
    { id: 3, username: 'trobbins', gamesPlayed: 8, highScore: 12 },
  ];
  return (
    <div>
      <div className="grid grid-cols-2 pt-10">
        <div className="text-center">
          <Button type="submit">Games</Button>
        </div>
        <div className="text-center">
          <Button type="submit">Profile</Button>
        </div>
      </div>

      <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
        <div className="flex-1 rounded-md bg-red-200 pt-4 pb-4 text-black">
          <h2 className="text-center text-3xl font-bold">LEADERBOARD</h2>
        </div>
        <div className="grid grid-cols-3 pl-10 pr-10">
          <div id="user" className="flex-1 bg-red-200 pt-10 pb-10 text-black">
            <h2 className="text-center text-2xl">USER</h2>
          </div>
          <div
            id="gamesPlayed"
            className="flex-1 bg-red-200 pt-10 pb-10 text-black"
          >
            <h2 className="text-center text-2xl">GAMES PLAYED</h2>
          </div>
          <div
            id="highScore"
            className="flex-1 bg-red-200 pt-10 pb-10 text-black"
          >
            <h2 className="text-center text-2xl">HIGH SCORE</h2>
          </div>
        </div>
        <User
          username={users[0].username}
          gamesPlayed={users[0].gamesPlayed}
          highScore={users[0].highScore}
        />
        <User
          username={users[1].username}
          gamesPlayed={users[1].gamesPlayed}
          highScore={users[1].highScore}
        />
        <User
          username={users[2].username}
          gamesPlayed={users[2].gamesPlayed}
          highScore={users[2].highScore}
        />
        <div className="text-center">
          <Button type="submit">New Game</Button>
        </div>
      </div>
    </div>
  );
};

export default Homepage;
