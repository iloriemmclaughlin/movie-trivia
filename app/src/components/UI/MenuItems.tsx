import React, { PropsWithChildren } from 'react';
import { Link } from '@tanstack/react-router';

interface MenuItemProps {
  items: { route: string; name: string }[];
}

const MenuItems = (props: PropsWithChildren<MenuItemProps>): JSX.Element => {
  return (
    <>
      {props.items.map(item => (
        // @ts-ignore
        <Link
          key={item.name}
          className="p-5"
          to={item.route}
          activeProps={{ className: 'font-bold underline' }}
          activeOptions={{ exact: false }}
        >
          {item.name}
        </Link>
      ))}
    </>
  );
};

export default MenuItems;
