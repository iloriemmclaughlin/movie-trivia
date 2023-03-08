import React from 'react';

const Button = props => {
  return (
    <button
      className="rounded-full bg-red-200 py-2 px-4 font-bold text-white hover:bg-red-400"
      type={props.type || 'button'}
      onClick={props.onClick}
    >
      {props.children}
    </button>
  );
};

export default Button;
