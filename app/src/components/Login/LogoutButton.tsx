import React from 'react';
import { useAuth0 } from '@auth0/auth0-react';
import Card from '../UI/Card';
import LoginProfile from './LoginProfile';

const LogoutButton = () => {
  const { logout } = useAuth0();

  return (
    <Card>
      <button
        onClick={() =>
          logout({ logoutParams: { returnTo: window.location.origin } })
        }
      >
        LOGOUT
      </button>
    </Card>
  );
};

export default LogoutButton;
