import create from 'zustand';
import { useAuth0 } from '@auth0/auth0-react';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getAllUsers, getUserByAuth } from '../services/UserApi';

interface IUserDefault {
  backgroundColor: string;
  foregroundColor: string;
  updateBgColor: (newBgColor: string) => void;
  updateFgColor: (newFgColor: string) => void;
}

const useUserStore = create<IUserDefault>(set => ({
  backgroundColor: '#fca5a5',
  foregroundColor: '#fee2e2',
  updateBgColor: (newBgColor: string) => set({ backgroundColor: newBgColor }),
  updateFgColor: (newFgColor: string) => set({ foregroundColor: newFgColor }),
}));

export default useUserStore;
