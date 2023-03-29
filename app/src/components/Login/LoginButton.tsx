import React from 'react';
import { useAuth0 } from '@auth0/auth0-react';

const LoginButton = () => {
  const { loginWithRedirect } = useAuth0();

  return (
    <button
      className="btn btn-primary mx-5 my-5 rounded-full bg-blue-300 px-4"
      onClick={() => loginWithRedirect()}
    >
      LOGIN
    </button>
  );
};

export default LoginButton;
