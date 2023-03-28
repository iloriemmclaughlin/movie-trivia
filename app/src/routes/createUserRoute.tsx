import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import CreateUpdateUser from '../components/User/CreateUpdateUser';

const createUserRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/createUser',
  component: CreateUpdateUser,
});

export default createUserRoute;
