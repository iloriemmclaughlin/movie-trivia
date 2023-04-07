import React, { PropsWithChildren, useEffect, useState } from 'react';
import Card from './Card';
import movieLogo from '../../assets/movielogo.jpg';
import MenuItems from './MenuItems';
import LogoutButton from '../Login/LogoutButton';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';
import useUserStore from '../../store/userStore';

const NavBar = (props: PropsWithChildren) => {
  const { isAuthenticated, user } = useAuth0();
  const [loginPage, setLoginPage] = useState(true);
  const currentUser = useUserStore(state => state.user);
  // @ts-ignore
  const backgroundColor = useUserStore(state => state.backgroundColor);
  // @ts-ignore
  const foregroundColor = useUserStore(state => state.foregroundColor);
  const [adminUser, setAdminUser] = useState(false);

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

  const [fgColor, setFgColor] = useState('#f3f4f6');

  useEffect(() => {
    if (isAuthenticated && user) {
      refetchUser();
      setLoginPage(false);
    }
    if (currentUser && currentUser.userType.userTypeId === 1) {
      setAdminUser(true);
    }
  }, [refetchUser, user, currentUser]);

  const menuItems = adminUser ? (
    <MenuItems
      items={[
        { route: '/', name: 'Home' },
        { route: '/games', name: 'Games' },
        { route: '/profile', name: 'Profile' },
        { route: '/admin', name: 'Admin' },
      ]}
    />
  ) : (
    <MenuItems
      items={[
        { route: '/', name: 'Home' },
        { route: '/games', name: 'Games' },
        { route: '/profile', name: 'Profile' },
      ]}
    />
  );

  return (
    <Card>
      <div
        style={{ backgroundColor: fgColor }}
        className="justify-content: space-between h-24 w-full flex-1 items-center px-6 py-6"
      >
        <img
          className="absolute inset-0 h-24 w-24"
          src={movieLogo}
          alt="the movie trivia logo"
        />
        <div className="pb-2 text-center text-3xl font-bold">
          M O V I E . T R I V I A
        </div>
        <div className="float-right text-xl text-black">
          <button className="float-right pl-3">
            {!loginPage ? <LogoutButton /> : ''}
          </button>
          <button
            onClick={toggleMenu}
            disabled={loginPage}
            className="float-right"
          >
            MENU
          </button>
        </div>
        <div className="ml-20">{showMenuItems ? <>{menuItems}</> : ''}</div>
      </div>
    </Card>
  );
};

export default NavBar;
