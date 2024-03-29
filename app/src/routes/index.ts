import { Router } from '@tanstack/react-router';

import rootRoute from './rootRoute';
import indexRoute from './indexRoute';
import createUserRoute from './createUserRoute';
import newGameRoute from './newGameRoute';
import userGamesRoute from './userGamesRoute';
import profileRoute from './profileRoute';
import adminRoute from './adminRoute';
import homeRoute from './homeRoute';

const routeTree = rootRoute.addChildren([
  indexRoute,
  createUserRoute,
  homeRoute,
  newGameRoute,
  userGamesRoute,
  profileRoute,
  adminRoute,
]);

export const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});
