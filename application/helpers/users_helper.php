<?php
function _check_login()
{
  $CI =& get_instance();
  $uid = get_cookie('uid');
  if($uid === NULL OR $CI->user_model->verify_uid($uid) === FALSE)
  {
    redirect(base_url().'authentication');
    exit;
  }
}

function get_permission($menu)
{
  $ci =& get_instance();

  if(empty($ci->_user))
  {
    return reject_permission();
  }

  //--- If super admin
  if($ci->_user->ugroup_id == -987654321)
  {
    $pm = new stdClass();
    $pm->can_view = 1;
    $pm->can_add = 1;
    $pm->can_edit = 1;
    $pm->can_delete = 1;
  }
  else
  {
    $pm = $ci->user_model->get_permission($menu, $ci->_user->uid, $ci->_user->ugroup_id);

    if(empty($pm))
    {
      return reject_permission();
    }
    else
    {
      if(getConfig('CLOSE_SYSTEM') == 2)
      {
        $pm->can_view = 0;
        $pm->can_add = 0;
        $pm->can_edit = 0;
        $pm->can_delete = 0;
      }
    }
  }

  return $pm;
}

function reject_permission()
{
  $pm = new stdClass();
  $pm->can_view = 0;
  $pm->can_add = 0;
  $pm->can_edit = 0;
  $pm->can_delete = 0;
  return $pm;
}


function select_user_group($id = NULL)
{
  $ds = '';
  $CI =& get_instance();
  $qs = $CI->user_model->get_all_user_group();
  if(!empty($qs))
  {
    foreach($qs as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $id).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}


function select_user_role($code = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $qs = $ci->user_model->get_all_role();

  if(!empty($qs))
  {
    foreach($qs as $rs)
    {
      $ds .= '<option value="'.$rs->code.'" '.is_selected($rs->code, $code).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}



function select_saleman($sale_id = '')
{
  $ds = '';
  $CI =& get_instance();
  $qs = $CI->user_model->get_all_slp();
  if(!empty($qs))
  {
    foreach($qs as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $sale_id).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}


function get_sale_name($sale_id)
{
  $CI =& get_instance();
  return $CI->get_sale_name($sale_id);
}


 ?>
