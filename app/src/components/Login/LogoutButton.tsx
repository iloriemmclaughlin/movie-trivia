import React from 'react';
import { useAuth0 } from '@auth0/auth0-react';
import Card from '../UI/Card';

const LogoutButton = () => {
  const { logout } = useAuth0();
  const logoutHandler = () => {
    logout({ logoutParams: { returnTo: window.location.origin } });
    window.location.assign('/login');
  };

  return (
    <Card>
      <button onClick={() => logoutHandler()}>LOGOUT</button>
    </Card>
  );
};

export default LogoutButton;
