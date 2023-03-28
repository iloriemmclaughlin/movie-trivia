import React, { useEffect } from 'react';
import Card from '../UI/Card';
import { useQuery } from '@tanstack/react-query';
import { getQuestions } from '../../services/QuestionApi';
import { getAllUsers } from '../../services/UserApi';

const Admin = () => {
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

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading) return <div className="text-center">Loading Users...</div>;

  if (error)
    return <div className="text-center">OPE. No users available :(</div>;

  if (!users) {
    return <div className="text-center">OPE. UNABLE TO LOAD USERS.</div>;
  }

  return (
    <Card>
      <body className="bg-red-300">
        <div className="flex flex-col">
          <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div className="inline-block min-w-full py-2 sm:px-6 lg:px-8">
              <div className="overflow-hidden">
                <table className="min-w-full text-left text-sm font-light">
                  <thead className="border-b font-medium dark:border-neutral-500">
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
                        Edit
                      </th>
                      <th scope="col" className="px-6 py-4">
                        Delete
                      </th>
                    </tr>
                  </thead>
                  {users.map((user, index: number) => (
                    <tbody>
                      <tr className="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
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
                          <button className="my-3 rounded-lg bg-red-100 py-1 px-3 text-black hover:bg-red-300">
                            Edit
                          </button>
                        </td>
                        <td className="whitespace-nowrap px-6 py-4 font-medium">
                          <button className="my-3 rounded-lg bg-red-100 py-1 px-3 text-black hover:bg-red-300">
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  ))}
                </table>
              </div>
            </div>
          </div>
        </div>
      </body>
    </Card>
  );
};

export default Admin;
