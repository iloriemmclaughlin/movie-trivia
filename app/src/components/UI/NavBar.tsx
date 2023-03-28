import React, { useEffect, useState } from 'react';
import Card from './Card';
import movieLogo from '../../assets/movielogo.jpg';
import MenuItems from './MenuItems';
import LogoutButton from '../Login/LogoutButton';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';

const NavBar = props => {
  const { isAuthenticated, user } = useAuth0();

  const [showMenuItems, setShowMenuItems] = useState(false);
  const toggleMenu = () => {
    setShowMenuItems(!showMenuItems);
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
    <Card backgroundColor={userData?.foregroundColor}>
      <div className="justify-content: space-between h-24 w-full flex-1 items-center px-6 py-6">
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
            <>
              <MenuItems
                items={[
                  { route: '/', name: 'Home' },
                  { route: '/games', name: 'Games' },
                  { route: '/profile', name: 'Profile' },
                  // { route: '/admin', name: 'Admin' },
                ]}
              />
              <LogoutButton />
            </>
          ) : (
            ''
          )}
        </div>
      </div>
    </Card>
  );
};

export default NavBar;
