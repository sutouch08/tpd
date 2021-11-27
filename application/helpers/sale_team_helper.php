<?php

function select_sale_team($id = NULL)
{
  $sc = "";
  $ci =& get_instance();
  $ci->load->model('sale_team_model');

  $teams = $ci->sale_team_model->get_all_team();

  if(!empty($teams))
  {
    foreach($teams as $rs)
    {
      $sc .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $id).'>'.$rs->name.'</option>';
    }
  }

  return $sc;
}


function select_sale_person($id = NULL)
{
  $sc = "";
  $ci =& get_instance();
  $ci->load->model('sale_person_model');

  $list = $ci->sale_person_model->get_all();

  if(!empty($list))
  {
    foreach($list as $rs)
    {
      $sc .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $id).'>'.$rs->name.'</option>';
    }
  }

  return $sc;
}


function sale_person_name($id)
{
  $ci =& get_instance();
  $ci->load->model('sale_person_model');

  $rs = $ci->sale_person_model->get($id);

  if(!empty($rs))
  {
    return $rs->name;
  }

  return NULL;
}

?>
