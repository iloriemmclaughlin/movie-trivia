import React, { PropsWithChildren } from 'react';

interface CardProps {
  backgroundColor?: string | null | undefined;
}

const Card = (props: PropsWithChildren<CardProps>) => {
  const colors: { [s: string]: string } = {};
  if (props.backgroundColor) {
    colors['background'] = props.backgroundColor;
  }

  return <div style={colors}>{props.children}</div>;
};

export default Card;
