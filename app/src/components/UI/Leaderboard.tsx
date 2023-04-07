import React, { useEffect } from 'react';
import { stats } from '../../services/DTOs';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../../services/UserApi';
import { getAllStats } from '../../services/StatsApi';
import { useAuth0 } from '@auth0/auth0-react';
import useUserStore from '../../store/userStore';
import Avatar from 'react-avatar';

const Leaderboard = () => {
  const { isAuthenticated, user } = useAuth0();
  const currentUser = useUserStore(state => state.user);
  // @ts-ignore
  const backgroundColor = useUserStore(state => state.backgroundColor);
  // @ts-ignore
  const foregroundColor = useUserStore(state => state.foregroundColor);

  const {
    isLoading,
    error,
    data: statsData,
    refetch,
  } = useQuery({
    queryKey: [`stats`],
    queryFn: () => getAllStats(),
    enabled: false,
  });

  const { data: userData, refetch: refetchUser } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  useEffect(() => {
    refetch();
    if (isAuthenticated && user) {
      refetchUser();
    }
  }, [refetchUser, user]);

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;

  if (statsData) {
    return (
      <ul>
        {statsData.map((stat, index: number) => (
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div
              style={{ backgroundColor: foregroundColor }}
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <li key={index}>
                <h2 className="text-center">{stat.username}</h2>
              </li>
            </div>
            <div
              style={{ backgroundColor: foregroundColor }}
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <li key={index}>
                <h2 className="text-center">{stat.games_played}</h2>
              </li>
            </div>
            <div
              style={{ backgroundColor: foregroundColor }}
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <li key={index}>
                <h2 className="text-center">{stat.high_score}</h2>
              </li>
            </div>
          </div>
        ))}
      </ul>
    );
  }

  return <div></div>;
};

export default Leaderboard;
