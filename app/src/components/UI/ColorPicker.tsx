import React, { useState, useEffect } from 'react';
import { SketchPicker, ChromePicker } from 'react-color';
import reactCSS from 'reactcss';
import Card from './Card';

const ColorPicker = props => {
  return (
    <ChromePicker
      color={props.value || false}
      // @ts-ignore
      value={props.value}
      onChange={color => {
        props.onChange(color);
      }}
    />
  );

  // const { chosenColor = '#ffe4e6' } = props;
  // const [background, setBackground] = useState(chosenColor);
  // const [foreground, setForeground] = useState('#ffffff');
  // const [showPicker, setShowPicker] = useState(false);
  //
  // const onClick = () => {
  //   setShowPicker(!showPicker);
  // };
  //
  // const onClose = () => {
  //   setShowPicker(false);
  // };
  //
  // const onChange = color => {
  //   setBackground(color.hex);
  // };
  //
  // const onChangeComplete = e => {
  //   setBackground(e.target.value);
  // };
  //
  // const styles = reactCSS({
  //   default: {
  //     color: {
  //       width: '40px',
  //       height: '15px',
  //       borderRadius: '3px',
  //       background: `${background}`,
  //     },
  //     popover: {
  //       position: 'absolute',
  //       zIndex: '3',
  //     },
  //     cover: {
  //       position: 'fixed',
  //       top: '0px',
  //       right: '0px',
  //       bottom: '0px',
  //       left: '0px',
  //     },
  //     swatch: {
  //       padding: '6px',
  //       background: '#ffffff',
  //       borderRadius: '2px',
  //       cursor: 'pointer',
  //       display: 'inline-block',
  //       boxShadow: '0 0 0 1px rgba(0,0,0,.2)',
  //     },
  //   },
  // });
  //
  // return (
  //   <Card>
  //     <div style={styles.swatch} onClick={onClick}>
  //       <div style={styles.color}></div>
  //     </div>
  //     {showPicker ? (
  //       <div style={styles.popover}>
  //         <div style={styles.cover} onClick={onClose} />
  //         <SketchPicker
  //           color={background}
  //           onChange={onChange}
  //           onChangeComplete={onChangeComplete}
  //         />
  //       </div>
  //     ) : null}
  //     <input type="color" value={background} onChange={onChangeComplete} />
  //   </Card>
  // );
};

export default ColorPicker;
