import { stats } from './DTOs';

export async function getAllStats(): Promise<stats[]> {
  return await fetch(`http://localhost:8000/api/stats/`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: stats[]) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}
