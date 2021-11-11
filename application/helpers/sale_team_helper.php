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

?>
