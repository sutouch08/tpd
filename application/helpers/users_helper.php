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


function user_team_label($user_id)
{
  $ds = "";

  $ci =& get_instance();
  $team = $ci->user_model->get_user_team($user_id);

  if(!empty($team))
  {
    $i = 1;
    foreach($team as $rs)
    {
      $ds .= $i == 1 ? $rs->team_name : ", {$rs->team_name}";
      $i++;
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
  $ci =& get_instance();

  return $ci->user_model->get_saleman_name($sale_id);

}


 ?>
