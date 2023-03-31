import create from 'zustand';

interface IUser {
  userId: number;
}

const useUserStore = create<IUser>(() => ({
  userId: 1,
}));

export default useUserStore;
