import { useMutation, useQuery } from '@tanstack/react-query';
import { getUser, updateUser } from '../services/UserApi';
import Card from './UI/Card';
import { useEffect } from 'react';
import useInput from '../hooks/use-input';
import user from './User/User';

function Profile() {
  const {
    isLoading,
    error,
    data: userData,
    refetch,
  } = useQuery({
    queryKey: [`user`],
    queryFn: () => getUser(1),
    enabled: false,
  });

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;

  if (!userData) return <div>No user data.</div>;

  const {
    firstName,
    lastName,
    email,
    username,
    password,
    backgroundColor,
    foregroundColor,
  } = userData;

  const {
    value: uFirstName,
    isValid: uFirstNameValid,
    hasError: uFirstNameError,
    valueChangeHandler: uFirstNameChangeHandler,
    inputBlurHandler: uFirstNameBlurHandler,
    reset: uFirstNameReset,
  } = useInput((value: string) => value.trim() !== '', firstName);

  const { value: uLastName } = useInput(
    (value: string) => value.trim() !== '',
    lastName,
  );

  const { value: uEmail } = useInput(
    (value: string) => value.trim() !== '',
    email,
  );

  const { value: uUsername } = useInput(
    (value: string) => value.trim() !== '',
    username,
  );

  const { value: uPassword } = useInput(
    (value: string) => value.trim() !== '',
    password,
  );

  const { value: uBgColor } = useInput(
    (value: string) => value.trim() !== '',
    backgroundColor,
  );

  const { value: uFgColor } = useInput(
    (value: string) => value.trim() !== '',
    foregroundColor,
  );

  useEffect(() => {
    refetch();
  }, []);

  if (userData) {
    const userId = 1;

    const update: any = useMutation({
      mutationFn: () =>
        updateUser(userId, {
          firstName: uFirstName,
          lastName: uLastName,
          email: uEmail,
          username: uUsername,
          password: uPassword,
          backgroundColor: uBgColor,
          foregroundColor: uFgColor,
        }),
    });

    let formIsValid = false;

    if (uFirstNameValid) {
      formIsValid = true;
    }

    const submitHandler = event => {
      event.preventDefault();

      if (!formIsValid) {
        return;
      }

      uFirstNameReset();
    };

    return (
      <Card>
        <body className="flex items-center justify-center bg-red-300">
          <form className="w-full max-w-xl">
            <div className="mb-6 md:flex md:items-center">
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
                id="uFirstName"
                className="x block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-black dark:text-black dark:focus:border-blue-500 dark:focus:ring-blue-500"
                onChange={uFirstNameChangeHandler}
                onBlur={uFirstNameBlurHandler}
                value={uFirstName}
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
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={lastName}
                value={uLastName || lastName}
                required
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
                type="email"
                id="email"
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={email}
                value={uEmail || email}
                required
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
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={username}
                value={uUsername || username}
                required
              />
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
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={password}
                value={uPassword || password}
                required
              />
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
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
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={backgroundColor}
                value={uBgColor || backgroundColor}
                required
              />
            </div>
            <div className="mb-6 md:flex md:items-center">
              <div className="md:w-1/3">
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
                className="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder={foregroundColor}
                value={uFgColor || foregroundColor}
                required
              />
            </div>
            <button
              type="submit"
              className="float-right w-full rounded-full bg-red-100 px-5 py-2.5 text-center text-sm font-medium text-black hover:bg-white focus:outline-none focus:ring-4 focus:ring-white dark:bg-white dark:hover:bg-white dark:focus:ring-white sm:w-auto"
              onClick={e => {
                submitHandler(e);
                update.mutate();
              }}
            >
              Save Changes
            </button>
          </form>
        </body>
      </Card>
    );
  }
}

export default Profile;
