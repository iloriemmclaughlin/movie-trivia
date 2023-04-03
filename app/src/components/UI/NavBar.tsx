import React, { useEffect, useState } from 'react';
import Card from './Card';
import movieLogo from '../../assets/movielogo.jpg';
import MenuItems from './MenuItems';
import LogoutButton from '../Login/LogoutButton';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';

const NavBar = () => {
  const { isAuthenticated, user } = useAuth0();
  const [styleB, setStyleB] = useState({ backgroundColor: '#7dd3fc' });
  const [styleF, setStyleF] = useState({ backgroundColor: '#e0f2fe' });
  const [loginPage, setLoginPage] = useState(true);

  const [showMenuItems, setShowMenuItems] = useState(false);
  const [adminItems, setAdminItems] = useState(false);
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
      setLoginPage(false);
    }
  }, [refetchUser, user]);

  const userTypeId = userData?.userType.userTypeId;
  console.log(userTypeId);
  const itemsUser = [
    { route: '/', name: 'Home' },
    { route: '/games', name: 'Games' },
    { route: '/profile', name: 'Profile' },
  ];
  const itemsAdmin = [
    { route: '/', name: 'Home' },
    { route: '/games', name: 'Games' },
    { route: '/profile', name: 'Profile' },
    { route: '/admin', name: 'Admin' },
  ];

  // if (userTypeId === 1) {
  //   setAdminItems(true);
  // }

  // const displayMenuItems = () => {
  //   if (userTypeId === 1) {
  //     setAdminItems(true);
  //     return itemsAdmin;
  //   } else {
  //     return itemsUser;
  //   }
  // };

  return (
    <Card>
      <div
        style={styleF}
        // style={{ backgroundColor: userData?.foregroundColor }}
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
        <div className="text-center">
          {showMenuItems ? (
            <>
              <MenuItems
                items={[
                  { route: '/', name: 'Home' },
                  { route: '/games', name: 'Games' },
                  { route: '/profile', name: 'Profile' },
                  { route: '/admin', name: 'Admin' },
                ]}
              />
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
