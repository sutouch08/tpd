<?php

function select_conditions($cond = NULL)
{
  $sc  = '<option value="Less Than" '.is_selected("Less Than", $cond).'>Less Than</option>';
  $sc .= '<option value="Less or Equal" '.is_selected("Less or Equal", $cond).'>Less or Equal</option>';
  $sc .= '<option value="Greater Than" '.is_selected("Greater Than", $cond).'>Greater Than</option>';
  $sc .= '<option value="Greater or Equal" '.is_selected("Greater or Equal", $cond).'>Greater or Equal</option>';

  return $sc;
}



function select_approver($user_id = NULL)
{
  $sc = '';

  $ci =& get_instance();
  $ci->load->model('approver_model');
  $approver = $ci->approver_model->get_all_active_approver();

  if(!empty($approver))
  {
    foreach($approver as $rs)
    {
      $sc .= '<option value="'.$rs->user_id.'" '.is_selected($user_id, $rs->user_id).'>'.$rs->uname.' | '.$rs->emp_name.'</option>';
    }
  }

  return $sc;
}



function approver_name_list($ds)
{
  if(!empty($ds))
  {
    $sc = "";

    foreach($ds as $rs)
    {
      $sc .= $rs->uname.' | '.$rs->emp_name.'<br/>';
    }

    return $sc;
  }

  return NULL;
}




function get_condition_sign($condition)
{
  $sign = "";

  switch($condition)
  {
    case "Less Than" :
      $sign = "<";
      break;
    case "Less or Equal" :
      $sign = "<=";
      break;
    case "Greater Than" :
      $sign = ">";
      break;
    case "Greater or Equal" :
      $sign = ">=";
      break;
    default :
      $sign = "";
      break;
  }

  return $sign;
}


?>
