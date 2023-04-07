import React from 'react';
import { useAuth0 } from '@auth0/auth0-react';

const LoginButton = () => {
  const { loginWithRedirect } = useAuth0();

  return (
    <button
      className="mr-1 mb-1 mt-6 rounded bg-blue-300 px-6 py-3 text-sm font-bold uppercase text-black shadow outline-none transition-all duration-150 ease-linear hover:shadow-lg focus:outline-none"
      onClick={() => loginWithRedirect()}
    >
      LOGIN
    </button>
  );
};

export default LoginButton;
