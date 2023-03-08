import { User } from './DTOs';

export async function getUser(userId: number): Promise<User> {
  return await fetch(`http://localhost:8000/api/users/${userId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: User) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
