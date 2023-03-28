import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Login from '../components/Login/Login';

const loginRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: Login,
});

export default loginRoute;
