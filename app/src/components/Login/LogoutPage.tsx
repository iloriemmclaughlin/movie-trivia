import React from 'react';
import Card from '../UI/Card';
import LoginButton from './LoginButton';

const LogoutPage = () => {
  // @ts-ignore
  return (
    <Card>
      <div className="text-center">
        <h1 className="text-xl">THANKS FOR PLAYING!</h1>
        <h2>Login to play again :) </h2>
        <LoginButton />
      </div>
    </Card>
  );
};

export default LogoutPage;
