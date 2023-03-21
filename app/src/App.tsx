import React from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import {
  Outlet,
  RootRoute,
  Route,
  Router,
  RouterProvider,
} from '@tanstack/react-router';
import Profile from './components/Profile';
import Homepage from './components/Homepage';
import NavBar from './components/UI/NavBar';
import Login from './components/UI/Login';
import NewGame from './components/Game/NewGame';
import AddUser from './components/User/AddUser';
import TestGame from './components/Game/TestGame';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <>
        <NavBar />
        <Outlet />
      </>
    );
  },
});

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: () => {
    return <Homepage />;
  },
});

const testGameRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/test',
  component: () => {
    return <TestGame />;
  },
  errorComponent: () => 'Could not load test page.',
});

const loginRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: () => {
    return <Login />;
  },
  errorComponent: () => 'Could not load login page.',
});

const profileRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/profile',
  component: () => {
    // return <Profile />;
  },
  errorComponent: () => 'Could not find user.',
});

const newGameRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/newGame',
  component: () => {
    return <NewGame />;
  },
  errorComponent: () => 'Cannot load page New Game.',
});

const createUserRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/createUser',
  component: () => {
    return <AddUser />;
  },
  errorComponent: () => 'Could not find user.',
});

const routeTree = rootRoute.addChildren([
  indexRoute,
  loginRoute,
  profileRoute,
  newGameRoute,
  createUserRoute,
  testGameRoute,
]);

// Set up a Router instance
const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});

declare module '@tanstack/react-router' {
  interface Register {
    router: typeof router;
  }
}

const queryClient = new QueryClient();

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <RouterProvider router={router} />
    </QueryClientProvider>
  );
}

export default App;
