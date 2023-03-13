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

export interface stats {
  user_id: number;
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
  question_id: number;
  question_text: string;
  question_answer: string;
  question_type_id: number;
}
