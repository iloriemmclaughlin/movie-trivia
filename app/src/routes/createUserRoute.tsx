import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Profile from '../components/User/Profile';

const createUserRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/createUser',
  component: Profile,
});

export default createUserRoute;
