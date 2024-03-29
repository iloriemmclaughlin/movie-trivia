import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Profile from '../components/User/Profile';

const profileRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/profile',
  component: Profile,
});

export default profileRoute;
