import { Router } from '@tanstack/react-router';

import rootRoute from './rootRoute';
import indexRoute from './indexRoute';
import createUserRoute from './createUserRoute';
import loginRoute from './loginRoute';
import newGameRoute from './newGameRoute';
import userGamesRoute from './userGamesRoute';
import profileRoute from './profileRoute';
import adminRoute from './adminRoute';

const routeTree = rootRoute.addChildren([
  indexRoute,
  createUserRoute,
  loginRoute,
  newGameRoute,
  userGamesRoute,
  profileRoute,
  adminRoute,
]);

export const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});
