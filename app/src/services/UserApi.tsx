import { user, game, createUserParams } from './DTOs';

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

export async function getUser(userId: number): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${userId}`, {
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

export async function createUser(params: createUserParams): Promise<user> {
  return await fetch(`http://localhost:8000/api/users`, {
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
  userId: number,
  params: createUserParams,
): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${userId}/settings`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'PATCH',
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
