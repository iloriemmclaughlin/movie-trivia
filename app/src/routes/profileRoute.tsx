import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Profile from '../components/Profile';
import CreateUpdateUser from '../components/User/CreateUpdateUser';

const profileRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/profile',
  component: CreateUpdateUser,
});

export default profileRoute;
