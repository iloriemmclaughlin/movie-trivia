import React, { useEffect } from 'react';
import { create } from 'zustand';
import { createUser } from '../../services/UserApi';
import { useQuery } from '@tanstack/react-query';

const newUser = create((set) => ({
  firstName: '',
  lastName: '',
  email: '',
  username: '',
  password: '',
  bgColor: '',
  fgColor: '',
}));

  const submitHandler = event => {
    event.preventDefault();

    const user = () => {
      const firstName = newUser((state) => state.firstName);
      const lastName = newUser((state) => state.lastName);
      const email = newUser((state) => state.email);
      const username= newUser((state) => state.username);
      const password = newUser((state) => state.password);
      const bgColor = newUser((state) => state.bgColor);
      const fgColor = newUser((state) => state.fgColor);
    };

  };

  return (
    <form onSubmit={submitHandler}>
      <div className="mb-6">
        <label
          htmlFor="firstName"
          className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
          First Name
        </label>
        <input type="text" id="firstName" ref={firstName} />
      </div>
      6
      <div className="mb-6">
        <label
          htmlFor="lastName"
          className="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
          Last Name
        </label>
        <textarea rows="5" id="opening-text" ref={lastName}></textarea>
      </div>
      <div className="mb-6">
        <label htmlFor="date">Release Date</label>
        <input type="text" id="date" ref={releaseDateRef} />
      </div>
      <button>Create User</button>
    </form>
  );
}

const AddUser = () => {
  const {
    isLoading,
    error,
    data: userData,
    refetch,
  } = useQuery({
    queryKey: [`newUser`],
    queryFn: () => createUser(user),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;
};
