import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import LogoutPage from '../components/Login/LogoutPage';

const logoutRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/logout',
  component: LogoutPage,
});

export default logoutRoute;
