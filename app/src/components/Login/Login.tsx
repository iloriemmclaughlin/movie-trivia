import React from 'react';
import Card from '../UI/Card';
import LoginButton from './LoginButton';

const Login = () => {
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
