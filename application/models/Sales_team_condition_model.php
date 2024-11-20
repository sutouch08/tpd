<?php
class Sales_team_condition_model extends CI_Model
{
  private $tb = 'sales_team_condition';
  private $ta = 'approver_condition';
  private $tu = 'user_condition';

  public function __construct()
  {
    parent::__construct();
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if( ! empty($ds['name']))
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['sale_id']) && $ds['sale_id'] != 'all')
    {
      $this->db->where('sale_person_id', $ds['sale_id']);
    }

    if( isset($ds['dep_id']) && $ds['dep_id'] != 'all')
    {
      $this->db->where('department_id', $ds['dep_id']);
    }

    if( isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('sales_team_id', $ds['team_id']);
    }

    $rs = $this->db
    ->order_by('id', 'DESC')
    ->limit($perpage, $offset)
    ->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function count_rows(array $ds = array())
  {
    if( ! empty($ds['name']))
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['sale_id']) && $ds['sale_id'] != 'all')
    {
      $this->db->where('sale_person_id', $ds['sale_id']);
    }

    if( isset($ds['dep_id']) && $ds['dep_id'] != 'all')
    {
      $this->db->where('department_id', $ds['dep_id']);
    }

    if( isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('sales_team_id', $ds['team_id']);
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_all()
  {
    $rs = $this->db->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_condition_approver($condition_id)
  {
    $rs = $this->db
    ->select('ac.*')
    ->select('ap.uname, ap.emp_name, ap.amount')
    ->from('approver_condition AS ac')
    ->join('approver AS ap', 'ac.user_id = ap.user_id', 'left')
    ->where('ac.condition_id', $condition_id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function add_approver(array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->insert($this->ta, $ds);
    }

    return FALSE;
  }


  public function drop_condition_approver($con_id)
  {
    return $this->db->where('condition_id', $con_id)->delete($this->ta);
  }


  public function get_approver($con_id, $user_id)
  {
    $rs = $this->db
    ->select('ac.*, ap.uname, ap.emp_name, ap.amount')
    ->from('approver_condition AS ac')
    ->join('approver AS ap', 'ac.user_id = ap.id', 'left')
    ->where('ac.condition_id', $con_id)
    ->where('ac.user_id', $user_id)
    ->where('ap.status', 1)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      if($this->db->insert($this->tb, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  public function update($id, array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function drop_user_condition($id)
  {
    return $this->db->where('condition_id', $id)->delete($this->tu);
  }


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }


  public function count_members($id)
  {
    return $this->db->where('condition_id', $id)->count_all_results($this->tu);
  }


  public function get_members($condition_id)
  {
    $rs = $this->db
    ->select('u.uname, u.emp_name, uc.user_role')
    ->from('user_condition AS uc')
    ->join('user AS u', 'uc.user_id = u.id', 'left')
    ->where('uc.condition_id', $condition_id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function is_exists_name($name, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $count = $this->db->where('name', $name)->count_all_results($this->tb);

    return $count > 0 ? TRUE : FALSE;
  }

} //--- end class
 ?>
