<?php

function get_checkbox($id, $status = 'P', $can_approve = FALSE, $no = "")
{

  $sc = "";

  if($status == 'P')
  {
    if($can_approve)
    {
      $sc = '<label>
        <input type="checkbox" class="check-item" id="check-item-'.$id.'" value="'.$id.'" onchange="toggleApprove()" checked>
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

 ?>
