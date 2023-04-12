import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';
import { useMutation, useQuery } from '@tanstack/react-query';
import { deleteUser, getAllUsers, getUserByAuth } from '../../services/UserApi';
import DeleteUserModal from './DeleteUserModal';
import useUserStore from '../../store/userStore';
import Loading from '../UI/Loading';
import Error from '../UI/Error';

// Returns Admin page with list of users; allows for deletion of users
const Admin = () => {
  const currentUser = useUserStore(state => state.user);
  const backgroundColor = useUserStore(state => state.backgroundColor);
  const [clicked, setClicked] = useState(false);
  const [selectedUser, setSelectedUser] = useState(0);
  const [disableButton, setDisableButton] = useState(false);

  const {
    isLoading,
    error,
    data: users,
    refetch,
  } = useQuery({
    queryKey: [`users`],
    queryFn: () => getAllUsers(),
    enabled: false,
  });

  const userDelete: any = useMutation({
    mutationFn: () => deleteUser(selectedUser),
    onSuccess: data => {
      refetch();
    },
  });

  useEffect(() => {
    refetch();
  }, [users]);

  if (isLoading || !currentUser) return <Loading />;

  if (error) return <Error />;

  if (!users) {
    return <div className="text-center">OPE. UNABLE TO LOAD USERS.</div>;
  }

  // @ts-ignore
  const onClickDelete = (info: user) => {
    setSelectedUser(info.userId);
    if (selectedUser === currentUser?.userId) {
      setDisableButton(true);
    }
    setClicked(true);
  };

  const deleteUserCall = () => {
    userDelete.mutate();
  };

  if (currentUser) {
    return (
      <Card>
        <div
          style={{ backgroundColor: backgroundColor }}
          className="min-h-screen"
        >
          <div className="flex flex-col">
            <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div className="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div className="overflow-hidden">
                  <table className="min-w-full text-left text-sm font-light">
                    <thead className="border-b border-black font-medium dark:border-neutral-500">
                      <tr>
                        <th scope="col" className="px-6 py-4">
                          User ID
                        </th>
                        <th scope="col" className="px-6 py-4">
                          Username
                        </th>
                        <th scope="col" className="px-6 py-4">
                          Email
                        </th>
                        <th scope="col" className="px-6 py-4">
                          Delete
                        </th>
                      </tr>
                    </thead>
                    {users.map((user, index: number) => (
                      <tbody>
                        <tr
                          onClick={() => onClickDelete(user)}
                          className="border-b border-black transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600"
                        >
                          <td className="whitespace-nowrap px-6 py-4 font-medium">
                            {user.userId}
                          </td>
                          <td className="whitespace-nowrap px-6 py-4 font-medium">
                            {user.username}
                          </td>
                          <td className="whitespace-nowrap px-6 py-4 font-medium">
                            {user.email}
                          </td>
                          <td className="whitespace-nowrap px-6 py-4 font-medium">
                            <DeleteUserModal deleteUserCall={deleteUserCall} />
                          </td>
                        </tr>
                      </tbody>
                    ))}
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Card>
    );
  }
};

export default Admin;
