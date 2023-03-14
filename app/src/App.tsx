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

const loginRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: () => {
    return <Login />;
  },
  errorComponent: () => 'Could not find user.',
});

const profileRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/profile',
  component: () => {
    return <Profile userId={1} />;
  },
  errorComponent: () => 'Could not find user.',
});

const routeTree = rootRoute.addChildren([indexRoute, loginRoute, profileRoute]);

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
