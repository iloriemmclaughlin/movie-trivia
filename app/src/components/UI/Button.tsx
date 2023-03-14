import React from 'react';

const Button = props => {
  return (
    <button
      className="rounded-full bg-red-300 py-1 px-3 font-bold text-black hover:bg-red-100"
      type={props.type || 'button'}
      onClick={props.onClick}
    >
      {props.children}
    </button>
  );
};

export default Button;
