<?php

function select_currency($code = 'THB')
{
  $sc = "";
  $arr = array("THB", "AUB", "EUB", "GBS", "GBB", "USB", "USS");

  foreach($arr as $rs)
  {
    $sc .= '<option value="'.$rs.'" '.is_selected($code, $rs).'>'.$rs.'</option>';
  }

  return $sc;
}


function select_country($code = NULL)
{
  $sc = '';
  $CI =& get_instance();
  $CI->load->model('tool_model');
  $options = $CI->tool_model->get_country_list();

  if(!empty($options))
  {
    $df = getConfig('COUNTRY');
    foreach($options as $rs)
    {
      if($code === NULL)
      {
        $sc .= '<option value="'.$rs->code.'" '.is_selected($df, $rs->code).'>'.$rs->name.'</option>';
      }
      else
      {
        $sc .= '<option value="'.$rs->code.'" '.is_selected($code, $rs->code).'>'.$rs->name.'</option>';
      }
    }
  }

  return $sc;
}


 ?>
