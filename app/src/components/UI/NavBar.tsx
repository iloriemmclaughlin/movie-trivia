import React, { useState } from 'react';
import Card from './Card';
import Button from './Button';
import Profile from '../Profile';
import movieLogo from '../../assets/movielogo.jpg';
import Games from '../Game/Games';

const NavBar = () => {
  const [showProfile, setShowProfile] = useState(false);
  const toggleProfile = () => setShowProfile(wasClicked => !wasClicked);

  const [showGames, setShowGames] = useState(false);
  const toggleGames = () => setShowGames(wasClicked => !wasClicked);

  return (
    <Card>
      <div className="justify-content: space-between h-24 w-full flex-1 items-center bg-red-200 px-6 py-6">
        <img
          className="absolute inset-0 h-24 w-24"
          src={movieLogo}
          alt="the movie trivia logo"
        />
        <div className="text-center font-sans text-lg font-bold">
          Movie Trivia
        </div>
        <div className="flex flex-row-reverse text-center">
          <Button onClick={toggleGames}>
            {showGames && <Games userId={1} />}
            Games
          </Button>
          <Button onClick={toggleProfile}>
            {showProfile && <Profile userId={1} />}
            Profile
          </Button>
        </div>
      </div>
    </Card>
  );
};

export default NavBar;
