import { Router } from '@tanstack/react-router';

import rootRoute from './rootRoute';
import indexRoute from './indexRoute';
import createUserRoute from './createUserRoute';
import newGameRoute from './newGameRoute';
import userGamesRoute from './userGamesRoute';
import profileRoute from './profileRoute';
import adminRoute from './adminRoute';
import homeRoute from './homeRoute';
import logoutRoute from './logoutRoute';

const routeTree = rootRoute.addChildren([
  indexRoute,
  createUserRoute,
  homeRoute,
  newGameRoute,
  userGamesRoute,
  profileRoute,
  adminRoute,
  logoutRoute,
]);

export const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});
