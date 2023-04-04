import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import { Auth0Provider } from '@auth0/auth0-react';
import './index.css';

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <Auth0Provider
      domain="dev-2djp1pcfa0rgsnov.us.auth0.com"
      clientId="Wuje0PTi67JmeWyxHlq6wuOWBgrdS4tT"
      authorizationParams={{
        redirect_uri: 'http://localhost:5173/profile',
        audience: 'https://dev-2djp1pcfa0rgsnov.us.auth0.com/api/v2/',
        scope: 'read:current_user update:current_user_metadata',
      }}
    >
      <App />
    </Auth0Provider>
  </React.StrictMode>,
);
