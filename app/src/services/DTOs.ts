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
  game_id: number;
  total_questions: number;
  score: number;
  date: Date;
  user_id: number;
}

export interface question {
  questionId: number;
  questionText: string;
  questionAnswer: string;
  questionType: string;
  questionOption: Array<string>;
}

// export interface questionOption {
//   questionOptionId: number;
//   questionId: number;
//   questionOption: string;
// }
