import React, { PropsWithChildren, useEffect } from 'react';
import { useAuth0 } from '@auth0/auth0-react';
import useUserStore from '../../store/userStore';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../../services/UserApi';
import Loading from './Loading';

const UserState = (props: PropsWithChildren) => {
  const { isAuthenticated, user } = useAuth0();
  const currentUser = useUserStore(state => state.updateUser);

  const { refetch: refetchUser } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
    onSuccess: userData => {
      currentUser(userData);
      console.log(userData);
    },
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      refetchUser();
    }
  }, [user]);

  return <div></div>;
};

export default UserState;
