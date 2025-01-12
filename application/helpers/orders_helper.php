<?php

function select_price_list($id = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $ci->load->model('user_model');

  $list = $ci->user_model->get_all_price_list();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" '.is_selected($id, $rs->id).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}


function select_payment_term_discount($id = NULL)
{
  $ds = "<option value=\"-10\" data-groupnum=\"x\" data-disc=\"0\" data-change=\"0\"".is_selected($id, '-10').">Customer default</option>";
  $ci =& get_instance();
  $ci->load->model('payment_term_discount_model');

  $list = $ci->payment_term_discount_model->get_active_term_list();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds .= "<option value=\"{$rs->id}\" data-groupnum=\"{$rs->GroupNum}\" data-disc=\"{$rs->DiscPrcnt}\" data-change=\"{$rs->canChange}\"".is_selected($id, $rs->id).">{$rs->name}</option>";
    }
  }

  return $ds;
}


function select_payment_term($id = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $ci->load->model('orders_model');

  $list = $ci->orders_model->get_payment_term_list();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" data-days="'.$rs->ExtraDays.'" '.is_selected($id, $rs->id).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}



function get_checkbox($id, $status = 'P', $can_approve = FALSE, $no = "")
{

  $sc = "";

  if($status == 'P')
  {
    if($can_approve)
    {
      $sc = '<label>
        <input type="checkbox" class=" ace check-item" id="check-item-'.$id.'" value="'.$id.'" onchange="toggleApprove()">
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
