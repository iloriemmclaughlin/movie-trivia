import { question } from './DTOs';

export async function getQuestions(): Promise<question[]> {
  return await fetch(`http://localhost:8000/api/questions/all`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: question[]) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}
