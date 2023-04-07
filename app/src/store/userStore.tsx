import create from 'zustand';
import { useAuth0 } from '@auth0/auth0-react';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getAllUsers, getUserByAuth } from '../services/UserApi';
import { user } from '../services/DTOs';

interface IUserDefault {
  user?: user | null | undefined;
  backgroundColor: string;
  foregroundColor: string;
  updateUser: (updatedUser: user) => void;
  updateBgColor: (newBgColor: string) => void;
  updateFgColor: (newFgColor: string) => void;
}

const useUserStore = create<IUserDefault>(set => ({
  user: null,
  backgroundColor: '#fca5a5',
  foregroundColor: '#fee2e2',
  updateUser: (updatedUser: user) =>
    set({
      user: updatedUser,
      backgroundColor: updatedUser.backgroundColor,
      foregroundColor: updatedUser.foregroundColor,
    }),
  updateBgColor: (newBgColor: string) => set({ backgroundColor: newBgColor }),
  updateFgColor: (newFgColor: string) => set({ foregroundColor: newFgColor }),
}));

export default useUserStore;
