import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import NewGame from '../components/Game/NewGame';

const newGameRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/newGame',
  component: NewGame,
});

export default newGameRoute;
