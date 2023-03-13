import React from 'react';

const Button = props => {
  return (
    <button
      className="rounded-full bg-red-400 py-1 px-3 font-bold text-white hover:bg-gray-300"
      type={props.type || 'button'}
      onClick={props.onClick}
    >
      {props.children}
    </button>
  );
};

export default Button;
