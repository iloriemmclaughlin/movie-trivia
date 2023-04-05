export interface UserType {
  userTypeId: number;
  userType: string;
}

export interface user {
  userId: number;
  userType: UserType;
  username: string;
  firstName: string;
  lastName: string;
  email: string;
  password: string;
  backgroundColor: string;
  foregroundColor: string;
  auth0: string;
}

export interface newUser {
  username: string;
  firstName: string;
  lastName: string;
  email: string;
  password: string;
  auth0: string;
}

export interface updateUserParams {
  username: string;
  firstName: string;
  lastName: string;
  email: string;
  backgroundColor: string;
  foregroundColor: string;
}

export interface stats {
  username: string;
  games_played: number;
  high_score: number;
}

export interface game {
  gameId: number;
  totalQuestions: number;
  score: number;
  date: string;
}

export interface question {
  questionId: number;
  questionText: string;
  questionAnswer: string;
  questionType: string;
  questionOption: Array<string>;
}

export interface createUpdateParams {
  userId: number;
  date: string;
  totalQuestions: number;
  score: number;
}
