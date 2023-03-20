import { question, questionOption } from './DTOs';
import questionOptions from '../components/Question/QuestionOptions';

export async function getAllQuestions(): Promise<question[]> {
  return await fetch(`http://localhost:8000/api/questions/`, {
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

export async function getAllQuestionOptions(): Promise<questionOption[]> {
  return await fetch(`http://localhost:8000/api/questions/options/`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: questionOption[]) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}

export async function getQuestion(): Promise<string> {
  return await fetch(`http://localhost:8000/api/questions/random`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: string) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}

export async function getQuestionOptions(
  questionId: number,
): Promise<string[]> {
  return await fetch(`http://localhost:8000/api/questions/${questionId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: string[]) => {
      console.log('Success', data);
      return data;
    })
    .catch(error => {
      console.error('Error', error);
      throw error;
    });
}
