import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Homepage from '../components/Homepage';

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: Homepage,
  errorComponent: () => 'Unable to load index',
});

export default indexRoute;
