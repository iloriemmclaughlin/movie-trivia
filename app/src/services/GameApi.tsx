import { createUpdateParams, game } from './DTOs';

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

export async function createUpdateGame(
  params: createUpdateParams,
): Promise<game> {
  return await fetch(
    `http://localhost:8000/api/games/${params.userId}/createGame`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'POST',
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
