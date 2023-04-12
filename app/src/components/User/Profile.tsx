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
import Error from '../UI/Error';

// Returns profile of logged in user; updates changes made to profile onClick
function Profile() {
  const { isAuthenticated, isLoading, error, user } = useAuth0();
  const currentUser = useUserStore(state => state.user);
  const backgroundColor = useUserStore(state => state.backgroundColor);
  const foregroundColor = useUserStore(state => state.foregroundColor);

  const [bgColor, setBgColor] = useState(backgroundColor);
  const [fgColor, setFgColor] = useState(foregroundColor);

  const {
    value: firstName,
    isValid: firstNameValid,
    valueChangeHandler: firstNameChangeHandler,
    inputBlurHandler: firstNameBlurHandler,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: lastName,
    isValid: lastNameValid,
    valueChangeHandler: lastNameChangeHandler,
    inputBlurHandler: lastNameBlurHandler,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: email,
    isValid: emailValid,
    valueChangeHandler: emailChangeHandler,
    inputBlurHandler: emailBlurHandler,
  } = useInput((value: string) => value.includes('@'));

  const {
    value: username,
    isValid: usernameValid,
    valueChangeHandler: usernameChangeHandler,
    inputBlurHandler: usernameBlurHandler,
  } = useInput((value: string) => value.trim() !== '');

  const {
    isValid: bgColorValid,
    valueChangeHandler: bgColorChangeHandler,
    inputBlurHandler: bgColorBlurHandler,
  } = useInput((value: string) => value.trim() !== '');

  const {
    isValid: fgColorValid,
    valueChangeHandler: fgColorChangeHandler,
    inputBlurHandler: fgColorBlurHandler,
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
        backgroundColor: backgroundColor,
        foregroundColor: foregroundColor,
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
    onSuccess: data => saveChangesHandler(),
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

  if (error) {
    return <Error />;
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
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/2">
                <label
                  htmlFor="bgColor"
                  className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                  Background Color
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
                  Foreground Color
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
