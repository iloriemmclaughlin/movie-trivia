import React from 'react';
import Card from '../UI/Card';

const Admin = () => {
  return (
    <Card>
      <body className="bg-red-300">
        <div className="">
          <table className="table-auto border-spacing-2">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
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
      </body>
    </Card>
  );
};

export default Admin;
