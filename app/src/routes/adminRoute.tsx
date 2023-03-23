import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Admin from '../components/Admin/Admin';

const adminRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/admin',
  component: Admin,
});

export default adminRoute;
