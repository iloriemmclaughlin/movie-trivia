import { user, game, updateUserParams, newUser } from './DTOs';

export async function getAllUsers(): Promise<user[]> {
  return await fetch(`http://localhost:8000/api/users`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: user[]) => {
      return data;
    })
    .catch(error => {
      throw error;
    });
}

export async function getUserByAuth(auth0: string): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${auth0}/user`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: user) => {
      return data;
    })
    .catch(error => {
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
      return data;
    })
    .catch(error => {
      throw error;
    });
}

export async function createNewUser(params: newUser): Promise<user> {
  return await fetch(
    `http://localhost:8000/api/users/createNew/${params.auth0}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'POST',
      body: JSON.stringify(params),
    },
  )
    .then(response => response.json())
    .then((data: user) => {
      return data;
    })
    .catch(error => {
      throw error;
    });
}

export async function updateUser(
  auth0: string,
  params: updateUserParams,
): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${auth0}/update`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'PUT',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: user) => {
      return data;
    })
    .catch(error => {
      throw error;
    });
}

export async function deleteUser(userId: number): Promise<user> {
  return await fetch(`http://localhost:8000/api/users/${userId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'DELETE',
  })
    .then(response => response.json())
    .then((data: user) => {
      return data;
    })
    .catch(error => {
      throw error;
    });
}
