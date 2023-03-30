import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import DeleteUserModal from '../components/Admin/DeleteUserModal';
import TestPage from '../components/TestPage';

const testRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/test',
  component: TestPage,
});

export default testRoute;
