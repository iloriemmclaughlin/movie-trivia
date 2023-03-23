import React, { useEffect } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getUserGames } from '../../services/UserApi';
import Card from '../UI/Card';

const UserGames = () => {
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
      <Card>
        <body className="bg-red-300">
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
            <div className="flex-1 rounded-full bg-red-100 pt-4 pb-4 text-black">
              <h2 className="text-center text-3xl font-bold">GAMES</h2>
            </div>
            <div className="grid grid-cols-4 pl-10 pr-10">
              <div
                id="gameId"
                className="flex-1 bg-red-100 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">GAME ID</h2>
              </div>
              <div
                id="totalQuestions"
                className="flex-1 bg-red-100 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">TOTAL QUESTIONS</h2>
              </div>
              <div
                id="score"
                className="flex-1 bg-red-100 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">SCORE</h2>
              </div>
              <div
                id="date"
                className="flex-1 bg-red-100 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">DATE</h2>
              </div>
            </div>
            <ul className="grid bg-red-100 pt-10 pb-10 text-center text-black">
              {userGameData.map((game, index) => (
                <div className="grid grid-cols-4 pl-10 pr-10">
                  <div className="bg-dark flex-1 pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.gameId}</h2>
                    </li>
                  </div>
                  <div className="bg-dark flex-1 pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.totalQuestions}</h2>
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
          </div>
        </body>
      </Card>
    );
  }

  return <div></div>;
};
export default UserGames;
