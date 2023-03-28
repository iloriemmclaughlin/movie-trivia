import React from 'react';
import useInput from '../../hooks/use-input';

const UserInput = props => {
  const {
    value: updatedValue,
    isValid: isUpdatedValueValid,
    hasError: updatedValueError,
    valueChangeHandler: updatedValueChangeHandler,
    inputBlurHandler: updatedValueBlurHandler,
    reset: updatedValueReset,
  } = useInput((value: string) => value.trim() !== '');
};

export default UserInput;
