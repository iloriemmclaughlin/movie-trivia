import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import UserGames from '../components/Game/UserGames';

const userGamesRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/games',
  component: UserGames,
});

export default userGamesRoute;
