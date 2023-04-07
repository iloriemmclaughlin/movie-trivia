import React from 'react';
import Card from '../UI/Card';
import LoginButton from './LoginButton';
import { Auth0Provider, useAuth0 } from '@auth0/auth0-react';

const Login = () => {
  const newUserHandler = () => {
    window.location.assign('/createUser');
  };

  // @ts-ignore
  return (
    <Card>
      <div className="text-center">
        <h1 className="text-xl uppercase">Login to play!</h1>
        <LoginButton />
      </div>
    </Card>
  );
};

export default Login;
