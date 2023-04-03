import React, { useEffect, useState } from 'react';
import { stats } from '../services/DTOs';
import Card from './UI/Card';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth } from '../services/UserApi';
import { getAllStats } from '../services/StatsApi';
import { useAuth0 } from '@auth0/auth0-react';

const Leaderboard = () => {
  const { isAuthenticated, user } = useAuth0();

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

  const bgColor = { backgroundColor: userData?.backgroundColor };
  const fgColor = { backgroundColor: userData?.foregroundColor };

  if (statsData) {
    return (
      <ul>
        {statsData.map((stat, index: number) => (
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div
              style={fgColor}
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <li key={index}>
                <h2 className="text-center">{stat.username}</h2>
              </li>
            </div>
            <div
              style={fgColor}
              className="flex-1 bg-white pt-10 pb-10 text-black"
            >
              <li key={index}>
                <h2 className="text-center">{stat.games_played}</h2>
              </li>
            </div>
            <div
              style={fgColor}
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
