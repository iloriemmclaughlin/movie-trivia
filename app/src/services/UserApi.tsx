import { user, game, createUserParams, updateUserParams } from './DTOs';

export async function getAllUsers(): Promise<user[]> {
  return await fetch(`http://localhost:8000/api/users`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: user[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getUserByAuth(auth0: string): Promise<user> {
  console.log(`http://localhost:8000/api/users/${auth0}/user`);
  return await fetch(`http://localhost:8000/api/users/${auth0}/user`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: user) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getUserGames(userId: number): Promise<game[]> {
  return await fetch(`http://localhost:8000/api/users/${userId}/games`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: game[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function createUpdateUser(
  auth0: string,
  params: createUserParams,
): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${auth0}/createUpdate`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: user) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function updateUser(
  auth0: string,
  params: updateUserParams,
): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${auth0}/settings`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'PUT',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: user) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
