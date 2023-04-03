import React from 'react';

// @ts-ignore
const User = props => {
  return (
    <div className="grid grid-cols-3 pl-10 pr-10">
      <div id="username" className="flex-1 bg-red-200 pt-10 pb-10 text-black">
        <h2 className="text-center">{props.username}</h2>
      </div>
      <div
        id="gamesPlayed"
        className="flex-1 bg-red-200 pt-10 pb-10 text-black"
      >
        <h2 className="text-center">{props.gamesPlayed}</h2>
      </div>
      <div id="highScore" className="flex-1 bg-red-200 pt-10 pb-10 text-black">
        <h2 className="text-center">{props.highScore}</h2>
      </div>
    </div>
  );
};

export default User;
