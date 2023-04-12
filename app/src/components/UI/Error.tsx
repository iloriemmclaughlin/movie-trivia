import React from 'react';
import Card from './Card';

const Error = () => {
  return (
    <Card>
      <div className="min-h-screen bg-black text-center">
        <h1 className="text-xl text-white">Houston, we have a problem.</h1>
      </div>
    </Card>
  );
};

export default Error;
