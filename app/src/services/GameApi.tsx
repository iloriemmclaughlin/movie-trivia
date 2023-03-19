import { game } from './DTOs';

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

export async function checkAnswer(
  gameId: number,
  questionId: number,
): Promise<boolean> {
  return await fetch(
    `http://localhost:8000/api/games/${gameId}/${questionId}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'PUT',
    },
  )
    .then(response => response.json())
    .then((data: boolean) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}
