<?php

function select_conditions($cond = NULL)
{
  $sc  = '<option value="Less Than" '.is_selected("Less Than", $cond).'>Less Than <</option>';
  $sc .= '<option value="Less or Equal" '.is_selected("Less or Equal", $cond).'>Less or Equal <= </option>';
  $sc .= '<option value="Greater Than" '.is_selected("Greater Than", $cond).'>Greater Than ></option>';
  $sc .= '<option value="Greater or Equal" '.is_selected("Greater or Equal", $cond).'>Greater or Equal >=</option>';

  return $sc;
}

?>
