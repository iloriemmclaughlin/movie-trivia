import create from 'zustand';
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
