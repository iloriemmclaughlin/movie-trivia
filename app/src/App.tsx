import React, { useEffect } from 'react';
import {
  QueryClient,
  QueryClientProvider,
  useMutation,
  useQuery,
} from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import { RouterProvider } from '@tanstack/react-router';

import { router } from './routes';
import { useAuth0 } from '@auth0/auth0-react';
import { getUserByAuth, updateUser } from './services/UserApi';
import useUserStore from './store/userStore';

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
      {/*<ReactQueryDevtools />*/}
    </QueryClientProvider>
  );
}

export default App;
