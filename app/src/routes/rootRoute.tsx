import React from 'react';
import { Outlet, RootRoute } from '@tanstack/react-router';
import NavBar from '../components/UI/NavBar';
import Card from '../components/UI/Card';
import UserState from '../components/UI/UserState';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <Card>
        <UserState />
        <NavBar />
        <Outlet />
      </Card>
    );
  },
});

export default rootRoute;
