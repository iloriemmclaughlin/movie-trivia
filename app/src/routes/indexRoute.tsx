import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Homepage from '../components/UI/Homepage';
import Login from '../components/Login/Login';

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: Login,
  errorComponent: () => 'Unable to load index',
});

export default indexRoute;
