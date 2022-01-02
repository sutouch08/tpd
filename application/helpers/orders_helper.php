<?php

function get_checkbox($id, $status = 'P', $can_approve = FALSE, $no = "")
{

  $sc = "";

  if($status == 'P')
  {
    if($can_approve)
    {
      $sc = '<label>
        <input type="checkbox" class="check-item" id="check-item-'.$id.'" value="'.$id.'" onchange="toggleApprove()">
        <span class="lbl"></span>
      </label>';
    }
    else
    {
      $sc = $no;
    }
  }

  if($status == 'R')
  {
    $sc = '<i class="fa fa-times red"></i>';
  }

  if($status == 'A')
  {
    $sc = '<i class="fa fa-check green"></i>';
  }

  return $sc;
}



function get_rejectbox($id, $status = 'P', $can_approve = FALSE, $no = "")
{
  $sc = "";

  if($status = 'P')
  {
    if($can_approve)
    {
      $sc = '<input type="text" class="form-control input-sm reject-box" id="reject-item-'.$id.'" value="" />';
    }
  }

  return $sc;
}
 ?>
