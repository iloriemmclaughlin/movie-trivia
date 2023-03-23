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
}

export interface createUserParams {
  username: string;
  firstName: string;
  lastName: string;
  email: string;
  password: string;
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

export interface newGameParams {
  userId: number;
  totalQuestions: number;
  score: number;
  date: string;
}

export interface updateGameParams {
  gameId: number;
  totalQuestions: number;
  score: number;
}
