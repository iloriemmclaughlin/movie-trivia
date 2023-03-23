import React from 'react';
import { Outlet, RootRoute } from '@tanstack/react-router';
import NavBar from '../components/UI/NavBar';
import Card from '../components/UI/Card';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <Card>
        <NavBar />
        <Outlet />
      </Card>
    );
  },
});

export default rootRoute;
