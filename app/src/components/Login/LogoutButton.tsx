import React from 'react';
import { useAuth0 } from '@auth0/auth0-react';
import Card from '../UI/Card';
import LoginProfile from './LoginProfile';

const LogoutButton = () => {
  const { logout } = useAuth0();

  return (
    <Card>
      <button
        className="btn btn-primary mx-5 my-5 px-4"
        onClick={() =>
          logout({ logoutParams: { returnTo: window.location.origin } })
        }
      >
        Log Out
      </button>
    </Card>
  );
};

export default LogoutButton;
