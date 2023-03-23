import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import AddUser from '../components/User/AddUser';

const createUserRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/createUser',
  component: AddUser,
});

export default createUserRoute;
