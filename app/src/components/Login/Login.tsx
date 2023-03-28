import React from 'react';
import Card from '../UI/Card';
import LoginButton from './LoginButton';
import LogoutButton from './LogoutButton';
import { Auth0Provider, useAuth0 } from '@auth0/auth0-react';

const Login = () => {
  const newUserHandler = () => {
    window.location.assign('/createUser');
  };

  // @ts-ignore
  return (
    <Card>
      <LoginButton />
    </Card>

    // <Card>
    //   <div className="w-full max-w-xs">
    //     <form className="mb-4 rounded bg-white px-8 pt-6 pb-8 shadow-md">
    //       <div className="mb-4">
    //         <label
    //           className="mb-2 block text-sm font-bold text-gray-700"
    //           htmlFor="username"
    //         >
    //           Username
    //         </label>
    //         <input
    //           className="focus:shadow-outline w-full appearance-none rounded border py-2 px-3 leading-tight text-gray-700 shadow focus:outline-none"
    //           id="username"
    //           type="text"
    //           placeholder="Username"
    //         />
    //       </div>
    //       <div className="mb-6">
    //         <label
    //           className="mb-2 block text-sm font-bold text-gray-700"
    //           htmlFor="password"
    //         >
    //           Password
    //         </label>
    //         <input
    //           className="focus:shadow-outline mb-3 w-full appearance-none rounded border border-red-500 py-2 px-3 leading-tight text-gray-700 shadow focus:outline-none"
    //           id="password"
    //           type="password"
    //           placeholder="*********"
    //         />
    //         <p className="text-xs italic text-red-500">
    //           Please choose a password.
    //         </p>
    //       </div>
    //       <div className="flex items-center justify-between">
    //         <button
    //           className="focus:shadow-outline rounded bg-red-200 py-2 px-4 font-bold text-white hover:bg-red-500 focus:outline-none"
    //           type="button"
    //         >
    //           Sign In
    //         </button>
    //         <button
    //           className="focus:shadow-outline rounded bg-red-200 py-2 px-4 font-bold text-white hover:bg-red-500 focus:outline-none"
    //           type="button"
    //           onClick={newUserHandler}
    //         >
    //           New User
    //         </button>
    //
    //         <LoginButton />
    //         <LogoutButton />
    //       </div>
    //     </form>
    //   </div>
    // </Card>
  );
};

export default Login;
