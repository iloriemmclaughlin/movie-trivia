import React, { useEffect, useState } from 'react';
import { createNewUser, updateUser } from '../../services/UserApi';
import useInput from '../../hooks/use-input';
import { useMutation } from '@tanstack/react-query';
import Card from '../UI/Card';
import { useAuth0 } from '@auth0/auth0-react';
// @ts-ignore
import { ChromePicker } from 'react-color';
import useUserStore from '../../store/userStore';
import Loading from '../UI/Loading';

function Profile() {
  const { isAuthenticated, isLoading, user } = useAuth0();
  const currentUser = useUserStore(state => state.user);
  // @ts-ignore
  const backgroundColor = useUserStore(state => state.backgroundColor);
  // @ts-ignore
  const foregroundColor = useUserStore(state => state.foregroundColor);

  const [bgColor, setBgColor] = useState(backgroundColor);
  const [fgColor, setFgColor] = useState(foregroundColor);

  const {
    value: firstName,
    isValid: firstNameValid,
    hasError: firstNameError,
    valueChangeHandler: firstNameChangeHandler,
    inputBlurHandler: firstNameBlurHandler,
    reset: firstNameReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: lastName,
    isValid: lastNameValid,
    hasError: lastNameError,
    valueChangeHandler: lastNameChangeHandler,
    inputBlurHandler: lastNameBlurHandler,
    reset: lastNameReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: email,
    isValid: emailValid,
    hasError: emailError,
    valueChangeHandler: emailChangeHandler,
    inputBlurHandler: emailBlurHandler,
    reset: emailReset,
  } = useInput((value: string) => value.includes('@'));

  const {
    value: username,
    isValid: usernameValid,
    hasError: usernameError,
    valueChangeHandler: usernameChangeHandler,
    inputBlurHandler: usernameBlurHandler,
    reset: usernameReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    isValid: bgColorValid,
    hasError: bgColorError,
    valueChangeHandler: bgColorChangeHandler,
    inputBlurHandler: bgColorBlurHandler,
    reset: bgColorReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    isValid: fgColorValid,
    hasError: fgColorError,
    valueChangeHandler: fgColorChangeHandler,
    inputBlurHandler: fgColorBlurHandler,
    reset: fgColorReset,
  } = useInput((value: string) => value.trim() !== '');

  const saveChangesHandler = () => {
    window.location.assign('/');
  };

  const newUser: any = useMutation({
    mutationFn: () =>
      createNewUser({
        firstName: '',
        lastName: '',
        email: '',
        username: '',
        password: '',
        // @ts-ignore
        auth0: user.sub,
      }),
  });

  const updateUserCall: any = useMutation({
    mutationFn: () =>
      //@ts-ignore
      updateUser(currentUser.auth0, {
        firstName: firstName,
        lastName: lastName,
        email: email,
        username: username,
        backgroundColor: bgColor,
        foregroundColor: fgColor,
      }),
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      newUser.mutate();
    }
    if (currentUser) {
      setBgColor(backgroundColor);
      setFgColor(foregroundColor);
    }
  }, [user, currentUser]);

  if (isLoading || !currentUser) {
    return <Loading />;
  }

  let formIsValid = false;

  if (
    firstNameValid &&
    lastNameValid &&
    emailValid &&
    usernameValid &&
    bgColorValid &&
    fgColorValid
  ) {
    formIsValid = true;
  }

  // @ts-ignore
  const submitHandler = event => {
    event.preventDefault();

    if (!formIsValid) {
      return;
    }

    firstNameReset();
    lastNameReset();
    emailReset();
    usernameReset();
    bgColorReset();
    fgColorReset();
  };

  if (currentUser) {
    return (
      <Card>
        <body
          style={{ backgroundColor: bgColor }}
          className="flex min-h-screen justify-center"
        >
          <form>
            <div className="mt-6 mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
                <label
                  htmlFor="firstName"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  First Name
                </label>
              </div>
              <input
                type="text"
                id="firstName"
                className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.firstName}
                onChange={firstNameChangeHandler}
                onBlur={firstNameBlurHandler}
                value={firstName}
              />
              {/*{firstNameError && <p>First Name cannot be empty.</p>}*/}
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
                <label
                  htmlFor="lastName"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Last Name
                </label>
              </div>
              <input
                type="text"
                id="lastName"
                className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.lastName}
                onChange={lastNameChangeHandler}
                onBlur={lastNameBlurHandler}
                value={lastName}
              />
              {/*{lastNameError && <p>Last Name cannot be empty.</p>}*/}
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
                <label
                  htmlFor="email"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Email Address
                </label>
              </div>
              <input
                type="text"
                id="email"
                className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.email}
                onChange={emailChangeHandler}
                onBlur={emailBlurHandler}
                value={email}
              />
              {/*{emailError && <p>Email Address cannot be empty.</p>}*/}
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
                <label
                  htmlFor="username"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Username
                </label>
              </div>
              <input
                type="text"
                id="username"
                className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.username}
                onChange={usernameChangeHandler}
                onBlur={usernameBlurHandler}
                value={username}
              />
              {/*{usernameError && <p>Username cannot be empty.</p>}*/}
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/2">
                <label
                  htmlFor="bgColor"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Background Color ({backgroundColor})
                </label>
              </div>
              <input
                type="text"
                id="bgColor"
                className="x ml-12 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.backgroundColor}
                onChange={bgColorChangeHandler}
                onBlur={bgColorBlurHandler}
                value={bgColor}
              />
              {/*{bgColorError && <p>Background Color cannot be empty.</p>}*/}
              <div className="ml-6">
                <ChromePicker
                  className="flex"
                  color={bgColor}
                  // @ts-ignore
                  onChange={e => setBgColor(e.hex)}
                />
              </div>
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/2">
                <label
                  htmlFor="fgColor"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Foreground Color ({foregroundColor})
                </label>
              </div>
              <input
                type="text"
                id="fgColor"
                className="x ml-12 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
                placeholder={currentUser.foregroundColor}
                onChange={fgColorChangeHandler}
                onBlur={fgColorBlurHandler}
                value={fgColor}
              />
              {/*{fgColorError && <p>Foreground Color cannot be empty.</p>}*/}
              <div className="ml-6">
                <ChromePicker
                  className="flex"
                  color={fgColor}
                  // @ts-ignore
                  onChange={e => setFgColor(e.hex)}
                />
              </div>
            </div>
            <div className="flex justify-center">
              <button
                type="submit"
                style={{ backgroundColor: fgColor }}
                className="mr-1 mb-1 rounded px-6 py-3 text-sm font-bold uppercase text-black shadow outline-none transition-all duration-150 ease-linear hover:shadow-lg focus:outline-none"
                onClick={e => {
                  submitHandler(e);
                  updateUserCall.mutate();
                  saveChangesHandler();
                }}
              >
                Save Profile
              </button>
            </div>
          </form>
        </body>
      </Card>
    );
  }
}

export default Profile;
