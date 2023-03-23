import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Login from '../components/UI/Login';

const loginRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: Login,
});

export default loginRoute;
