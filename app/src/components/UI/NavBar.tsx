import React, { useState } from 'react';
import Card from './Card';
import { Bars3Icon } from '@heroicons/react/20/solid';
import movieLogo from '../../assets/movielogo.jpg';
import MenuItems from './MenuItems';

const NavBar = () => {
  const [showMenuItems, setShowMenuItems] = useState(false);
  const toggleMenu = () => {
    setShowMenuItems(!showMenuItems);
  };

  return (
    <Card>
      <div className="justify-content: space-between h-24 w-full flex-1 items-center bg-red-100 px-6 py-6">
        <img
          className="absolute inset-0 h-24 w-24"
          src={movieLogo}
          alt="the movie trivia logo"
        />
        <div className="pb-2 text-center text-3xl font-bold">
          M O V I E . T R I V I A
        </div>
        <div className="float-right text-xl text-black" onClick={toggleMenu}>
          <button>MENU</button>
        </div>
        <div className="text-center">
          {showMenuItems ? (
            <MenuItems
              items={[
                { route: '/', name: 'Home' },
                { route: '/games', name: 'Games' },
                { route: '/profile', name: 'Profile' },
                { route: '/admin', name: 'Admin' },
              ]}
            />
          ) : (
            ''
          )}
        </div>
      </div>
    </Card>
  );
};

export default NavBar;
