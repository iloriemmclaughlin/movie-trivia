import React, { useEffect, useState } from 'react';
import { stats } from '../services/DTOs';
import Card from './UI/Card';
import { useQuery } from '@tanstack/react-query';
import { getUser } from '../services/UserApi';
import { getAllStats } from '../services/StatsApi';

const Leaderboard = () => {
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

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;

  if (statsData) {
    return (
      <ul>
        {statsData.map((stat, index: number) => (
          <div className="grid grid-cols-3 pl-10 pr-10">
            <div className="flex-1 bg-white pt-10 pb-10 text-black">
              <li key={index}>
                <h2 className="text-center">{stat.username}</h2>
              </li>
            </div>
            <div className="flex-1 bg-white pt-10 pb-10 text-black">
              <li key={index}>
                <h2 className="text-center">{stat.games_played}</h2>
              </li>
            </div>
            <div className="flex-1 bg-white pt-10 pb-10 text-black">
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
