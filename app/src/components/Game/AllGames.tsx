import React, { useEffect } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getUserGames } from '../../services/UserApi';
import Card from '../UI/Card';

const AllGames = (props: { userId: number }) => {
  const {
    isLoading,
    error,
    data: userGameData,
    refetch,
  } = useQuery({
    queryKey: [`games`],
    queryFn: () => getUserGames(1),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;

  if (userGameData) {
    return (
      <ul>
        {userGameData.map((game, index) => (
          <div className="grid grid-cols-4 pl-10 pr-10">
            <div className="bg-dark flex-1 pt-10 pb-10 text-black">
              <li key={index}>
                <h2>{game.game_id}</h2>
              </li>
            </div>
            <div className="bg-dark flex-1 pt-10 pb-10 text-black">
              <li key={index}>
                <h2>{game.total_questions}</h2>
              </li>
            </div>
            <div className="bg-dark flex-1 pt-10 pb-10 text-black">
              <li key={index}>
                <h2>{game.score}</h2>
              </li>
            </div>
            <div className="bg-dark flex-1 pt-10 pb-10 text-black">
              <li key={index}>
                <h2>{game.date}</h2>
              </li>
            </div>
          </div>
        ))}
      </ul>
    );
  }

  return <div></div>;
};
export default AllGames;
