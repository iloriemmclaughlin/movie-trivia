import { game, newGameParams, updateGameParams } from './DTOs';

export async function getAllGames(): Promise<game[]> {
  return await fetch(`http://localhost:8000/api/games/`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: game[]) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}

export async function createGame(params: newGameParams): Promise<game> {
  return await fetch(`http://localhost:8000/api/games/${params.userId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: game) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}

export async function updateGame(params: updateGameParams): Promise<game> {
  return await fetch(
    `http://localhost:8000/api/games/${params.gameId}/update`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'PUT',
      body: JSON.stringify(params),
    },
  )
    .then(response => response.json())
    .then((data: game) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}
