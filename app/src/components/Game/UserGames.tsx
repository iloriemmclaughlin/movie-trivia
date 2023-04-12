import React, { useEffect } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getUserByAuth, getUserGames } from '../../services/UserApi';
import Card from '../UI/Card';
import { useAuth0 } from '@auth0/auth0-react';
import useUserStore from '../../store/userStore';
import Loading from '../UI/Loading';
import Error from '../UI/Error';

// Returns the list of played games for the logged in user
const UserGames = () => {
  const { isAuthenticated, user } = useAuth0();
  const currentUser = useUserStore(state => state.user);
  const backgroundColor = useUserStore(state => state.backgroundColor);
  const foregroundColor = useUserStore(state => state.foregroundColor);

  const { data: userData, refetch: refetchUser } = useQuery({
    queryKey: [`user`],
    //@ts-ignore
    queryFn: () => getUserByAuth(user.sub),
    enabled: false,
  });

  // const userId = currentUser?.userId;
  const userId = userData?.userId;

  const {
    isLoading,
    error,
    data: userGameData,
    refetch,
  } = useQuery({
    queryKey: [`games`],
    // @ts-ignore
    queryFn: () => getUserGames(userId),
    enabled: false,
  });

  useEffect(() => {
    refetch();
    if (isAuthenticated && user) {
      refetchUser();
    }
  }, [refetchUser, user, currentUser]);

  if (isLoading || !currentUser) return <Loading />;

  if (error) return <Error />;

  if (userGameData && currentUser) {
    return (
      <Card>
        <div
          style={{ backgroundColor: backgroundColor }}
          className="min-h-screen"
        >
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 pt-10 pb-2 pl-10 pr-10">
            <div
              style={{ backgroundColor: foregroundColor }}
              className="flex-1 rounded-full pt-4 pb-4 text-black"
            >
              <h2 className="text-center text-3xl font-bold">GAMES</h2>
            </div>
            <div className="grid grid-cols-4 pl-10 pr-10">
              <div
                id="gameId"
                style={{ backgroundColor: foregroundColor }}
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">GAME ID</h2>
              </div>
              <div
                id="totalQuestions"
                style={{ backgroundColor: foregroundColor }}
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">TOTAL QUESTIONS</h2>
              </div>
              <div
                id="score"
                style={{ backgroundColor: foregroundColor }}
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">SCORE</h2>
              </div>
              <div
                id="date"
                style={{ backgroundColor: foregroundColor }}
                className="flex-1 pt-10 pb-10 text-black"
              >
                <h2 className="text-center text-2xl">DATE</h2>
              </div>
            </div>
            <ul
              style={{ backgroundColor: foregroundColor }}
              className="mr-10 ml-10 grid pb-5 text-center text-black"
            >
              {userGameData.map((game, index) => (
                <div className="grid grid-cols-4 border-b border-black pl-10 pr-10">
                  <div className="flex-1  pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.gameId}</h2>
                    </li>
                  </div>
                  <div className="flex-1 pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.totalQuestions}</h2>
                    </li>
                  </div>
                  <div className="flex-1 pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.score}</h2>
                    </li>
                  </div>
                  <div className="flex-1 pt-10 pb-10 text-black">
                    <li key={index}>
                      <h2>{game.date}</h2>
                    </li>
                  </div>
                </div>
              ))}
            </ul>
          </div>
        </div>
      </Card>
    );
  }

  return <div></div>;
};
export default UserGames;
