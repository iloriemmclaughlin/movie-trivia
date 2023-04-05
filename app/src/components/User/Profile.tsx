import React, { useEffect, useState } from 'react';
import {
  createNewUser,
  createUpdateUser,
  getUserByAuth,
} from '../../services/UserApi';
import useInput from '../../hooks/use-input';
import { useQuery, useMutation } from '@tanstack/react-query';
import Card from '../UI/Card';
import { useAuth0 } from '@auth0/auth0-react';
import { ChromePicker } from 'react-color';

function Profile() {
  const { isAuthenticated, user } = useAuth0();
  const [showBgColorPicker, setShowBgColorPicker] = useState(false);
  const [showFgColorPicker, setShowFgColorPicker] = useState(false);
  const bgClickHandler = () => {
    setShowBgColorPicker(!showBgColorPicker);
  };
  const fgClickHandler = () => {
    setShowFgColorPicker(!showFgColorPicker);
  };

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
    value: password,
    isValid: passwordValid,
    hasError: passwordError,
    valueChangeHandler: passwordChangeHandler,
    inputBlurHandler: passwordBlurHandler,
    reset: passwordReset,
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

  const {
    isLoading,
    error,
    data: userData,
    refetch: refetchUser,
  } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  const [bgColor, setBgColor] = useState('#7dd3fc');
  const [fgColor, setFgColor] = useState('#e0f2fe');

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

  const addUpdateUser: any = useMutation({
    mutationFn: () =>
      //@ts-ignore
      createUpdateUser(userData.auth0, {
        firstName: firstName,
        lastName: lastName,
        email: email,
        username: username,
        password: password,
        backgroundColor: bgColor,
        foregroundColor: fgColor,
      }),
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      newUser.mutate();
    }
    if (userData) {
      setBgColor(userData.backgroundColor);
      setFgColor(userData.foregroundColor);
    }
  }, [refetchUser, user]);

  if (isLoading)
    return <div className="text-center">Loading your profile!</div>;

  if (error) return <div>An error has occurred.</div>;

  let formIsValid = false;

  if (
    firstNameValid &&
    lastNameValid &&
    emailValid &&
    usernameValid &&
    passwordValid &&
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
    passwordReset();
    bgColorReset();
    fgColorReset();
  };

  // const styleB = { backgroundColor: userData?.backgroundColor };
  // if (userData) {
  //   setColor({ backgroundColor: userData?.backgroundColor });
  // }
  // const styleF = { backgroundColor: userData?.foregroundColor };

  return (
    <Card>
      <body
        style={{ backgroundColor: bgColor }}
        className="flex items-center justify-center"
      >
        <form className="w-full max-w-xl">
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
              placeholder={userData?.firstName}
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
              placeholder={userData?.lastName}
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
              placeholder={userData?.email}
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
              placeholder={userData?.username}
              onChange={usernameChangeHandler}
              onBlur={usernameBlurHandler}
              value={username}
            />
            {/*{usernameError && <p>Username cannot be empty.</p>}*/}
          </div>
          <div className="mb-6 md:flex md:items-center">
            <div className="md:w-1/3">
              <label
                htmlFor="password"
                className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
              >
                Password
              </label>
            </div>
            <input
              type="text"
              id="password"
              className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
              placeholder={userData?.password}
              onChange={passwordChangeHandler}
              onBlur={passwordBlurHandler}
              value={password}
            />
            {/*{passwordError && <p>Password cannot be empty.</p>}*/}
          </div>
          <div className="mb-6 md:flex md:items-center">
            <div className="md:w-1/2">
              <label
                htmlFor="bgColor"
                className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
              >
                Background Color ({userData?.backgroundColor})
              </label>
            </div>
            <input
              type="text"
              id="bgColor"
              className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
              placeholder={userData?.backgroundColor}
              onChange={bgColorChangeHandler}
              onBlur={bgColorBlurHandler}
              value={bgColor}
            />
            {/*{bgColorError && <p>Background Color cannot be empty.</p>}*/}
            <div className="ml-6">
              <ChromePicker
                className="flex"
                color={bgColor}
                onChange={e => setBgColor(e.hex)}
              />
              {/*<button onClick={bgClickHandler}>Choose Color</button>*/}
              {/*{showBgColorPicker ? (*/}
              {/*  <SketchPicker*/}
              {/*    color={bgColor}*/}
              {/*    onChangeComplete={e => setBgColor(e.hex)}*/}
              {/*  />*/}
              {/*) : (*/}
              {/*  ''*/}
              {/*)}*/}
            </div>
          </div>
          <div className="mb-6 md:flex md:items-center">
            <div className="md:w-1/2">
              <label
                htmlFor="fgColor"
                className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
              >
                Foreground Color ({userData?.foregroundColor})
              </label>
            </div>
            <input
              type="text"
              id="fgColor"
              className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:ring-blue-500"
              placeholder={userData?.foregroundColor}
              onChange={fgColorChangeHandler}
              onBlur={fgColorBlurHandler}
              value={fgColor}
            />
            {/*{fgColorError && <p>Foreground Color cannot be empty.</p>}*/}
            <div className="ml-6">
              <ChromePicker
                className="flex"
                color={fgColor}
                onChange={e => setFgColor(e.hex)}
              />
            </div>
          </div>
          <button
            type="submit"
            style={{ backgroundColor: fgColor }}
            className="float-right mb-6 rounded-full px-5 py-2.5 text-center text-sm"
            onClick={e => {
              submitHandler(e);
              addUpdateUser.mutate();
              saveChangesHandler();
            }}
          >
            Save Profile
          </button>
        </form>
      </body>
    </Card>
  );
}

export default Profile;
