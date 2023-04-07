import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Homepage from '../components/UI/Homepage';

const homeRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: Homepage,
});

export default homeRoute;
