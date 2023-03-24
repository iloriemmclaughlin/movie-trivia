import React from 'react';
import Card from '../UI/Card';

const Admin = () => {
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
                  <tbody>
                    <tr>
                      <td>Example User ID</td>
                      <td>Example Username</td>
                      <td>Example Email</td>
                      <td>Edit Button Here</td>
                      <td>Delete Button Here</td>
                    </tr>
                  </tbody>
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
