<?php
class User_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function get($id)
  {
    $rs = $this->db->where('id', $id)->get('user');
    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_user_customer_group($id)
  {
    $rs = $this->db->where('user_id', $id)->get('user_customer_group');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function add(array $ds = array())
  {
    if($this->db->insert('user', $ds))
    {
      return $this->db->insert_id();
    }

    return FALSE;
  }


  public function add_user_customer_group(array $ds = array())
  {
    return $this->db->insert('user_customer_group', $ds);
  }


  public function update($id, array $ds = array())
  {
    if(!empty($ds))
    {
      $this->db->where('id', $id);

      return $this->db->update('user', $ds);
    }

    return FALSE;
  }


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete('user');
  }


  public function drop_user_customer_group($id)
  {
    return $this->db->where('user_id', $id)->delete('user_customer_group');
  }



  function count_rows(array $ds = array())
  {
    $this->db
    ->from('user AS u')
    ->join('user_group AS g', 'u.ugroup_id = g.id', 'left')
    ->join('user_role AS r', 'u.user_role = r.code', 'left')
    ->where('u.ugroup_id >', 0);

    if(!empty($ds['uname']))
    {
      $this->db->like('u.uname', $ds['uname']);
    }

    if(!empty($ds['emp_name']))
    {
      $this->db->like('u.emp_name', $ds['emp_name']);
    }

    if(!empty($ds['sale_id']) && $ds['sale_id'] !== 'all')
    {
      $this->db->where('u.sale_id', $ds['sale_id']);
    }

    if(!empty($ds['user_group']) && $ds['user_group'] !== 'all')
    {
      $this->db->where('u.ugroup_id', $ds['user_group']);
    }

    if(!empty($ds['user_role']) && $ds['user_role'] !== 'all')
    {
      $this->db->where('u.user_role', $ds['user_role']);
    }

    if($ds['status'] !== 'all')
    {
      $this->db->where('u.status', $ds['status']);
    }

    return $this->db->count_all_results();
  }





  function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    $this->db
    ->select('u.*, g.name AS group_name, r.name AS role_name')
    ->from('user AS u')
    ->join('user_group AS g', 'u.ugroup_id = g.id', 'left')
    ->join('user_role AS r', 'u.user_role = r.code', 'left')
    ->where('u.ugroup_id >', 0);

    if(!empty($ds['uname']))
    {
      $this->db->like('u.uname', $ds['uname']);
    }

    if(!empty($ds['emp_name']))
    {
      $this->db->like('u.emp_name', $ds['emp_name']);
    }

    if(!empty($ds['sale_id']) && $ds['sale_id'] !== 'all')
    {
      $this->db->where('u.sale_id', $ds['sale_id']);
    }

    if(!empty($ds['user_group']) && $ds['user_group'] !== 'all')
    {
      $this->db->where('u.ugroup_id', $ds['user_group']);
    }


    if(!empty($ds['user_role']) && $ds['user_role'] !== 'all')
    {
      $this->db->where('u.user_role', $ds['user_role']);
    }

    if($ds['status'] !== 'all')
    {
      $this->db->where('u.status', $ds['status']);
    }

    $this->db->order_by('u.id', 'DESC')->limit($perpage, $offset);

    $rs = $this->db->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function get_user_by_uid($uid)
  {
    $rs = $this->db->where('uid', $uid)->get('user');
    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return FALSE;
  }


  public function get_user_by_uname($uname)
  {
    $rs = $this->db->where('uname', $uname)->get('user');
    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_user_group($uid)
  {
    $rs = $this->db->select('ugroup')->where('uid', $uid)->get('user');
    if($rs->num_rows() === 1)
    {
      return $rs->row()->ugroup;
    }

    return NULL;
  }


  public function get_all_user_group()
  {
    $rs = $this->db->where('id >',0)->order_by('name', 'ASC')->get('user_group');
    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_all_role()
  {
    $rs = $this->db->order_by('position', 'ASC')->get('user_role');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function get_customer_group_list()
  {
    $rs = $this->ms
    ->select('GroupCode, GroupName')
    ->where('GroupCode >=', 5)
    ->where('GroupCode <=', 16)
    ->get('OCQG');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_user_credentials($uname)
  {
    $this->db->where('uname', $uname);
    $rs = $this->db->get('user');

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return FALSE;
  }


  public function verify_uid($uid)
  {
    $rs = $this->db
    ->select('uid')
    ->where('uid', $uid)
    ->where('status', 1)
    ->get('user');

    return $rs->num_rows() === 1 ? TRUE : FALSE;
  }


  public function is_exists_uname($uname, $old_uname = NULL)
  {
    $this->db->where('uname', $uname);

    if(!empty($old_uname))
    {
      $this->db->where('uname !=', $old_uname);
    }

    $rs = $this->db->get('user');

    if($rs->num_rows() > 0)
    {
      return TRUE;
    }

    return FALSE;
  }




  public function get_permission($menu, $uid, $ugroup_id)
  {
    if(!empty($menu))
    {
      $rs = $this->db->where('code', $menu)->get('menu');
      if($rs->num_rows() === 1)
      {
        if($rs->row()->valid == 1)
        {
          return $this->get_group_permission($menu, $ugroup_id);
        }
        else
        {
          $ds = new stdClass();
          $ds->can_view = 1;
          $ds->can_add = 1;
          $ds->can_edit = 1;
          $ds->can_delete = 1;
          return $ds;
        }
      }

    }

    return FALSE;
  }



  private function get_group_permission($menu, $ugroup_id)
  {
    $rs = $this->db->where('menu', $menu)->where('ugroup_id', $ugroup_id)->get('permission');
    return $rs->num_rows() == 1 ? $rs->row() : FALSE;
  }


  public function change_password($id, $pwd)
  {
    $this->db->set('pwd', $pwd);
    $this->db->where('id', $id);
    return $this->db->update('user');
  }


  public function get_all_employee()
  {
    $rs = $this->ms->select('empID,firstName, lastName')->where('Active', 'Y')->get('OHEM');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_all_slp()
  {
    $rs = $this->ms
    ->select('SlpCode AS id, SlpName AS name')
    ->where('SlpCode >', 0)
    ->where('Active', 'Y')
    ->order_by('SlpName', 'ASC')
    ->get('OSLP');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_saleman_name($id)
  {
    $rs = $this->ms->select('SlpName')->where('SlpCode', $id)->get('OSLP');
    if($rs->num_rows() === 1)
    {
      return $rs->row()->SlpName;
    }

    return NULL;
  }


  public function get_emp_name($id)
  {
    $rs = $this->ms->select('empID,firstName, lastName')->where('empId', $id)->get('OHEM');

    if($rs->num_rows() > 0)
    {
      return $rs->row()->firstName.' '.$rs->row()->lastName;
    }

    return NULL;
  }



  public function get_name($uname)
  {
    $rs = $this->db->select('emp_name AS name')->where('uname', $uname)->get('user');
    if($rs->num_rows() === 1)
    {
      return $rs->row()->name;
    }

    return NULL;
  }

  public function has_quotation_transection($user_id)
  {
    $rs = $this->db->where('user_id', $user_id)->count_all_results('quotation');
    if($rs > 0 )
    {
      return TRUE;
    }

    return FALSE;
  }

  public function has_customer_transection($user_id)
  {
    $rs = $this->db->where('user_id', $user_id)->count_all_results('customer');
    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }

  public function isApprover($uname)
  {
    $rs = $this->db->where('uname', $uname)->count_all_results('quotation_approver');
    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function get_sale_in()
	{
		if($this->isLead)
		{
			$rs = $this->db
			->select('sale_id')
			->where('sale_team', $this->user->sale_team)
			->get('user');

			if($rs->num_rows() > 0)
			{
				$sale_in = "";
				$i = 1;
				foreach($rs->result() as $rd)
				{
          if(!empty($rd->sale_id))
          {
            $sale_in .= $i == 1? $rd->sale_id : ", {$rd->sale_id}";
  					$i++;
          }
				}

				return $sale_in;
			}

			return NULL;
		}

		return NULL;
	}


  public function get_sale_data($sale_id)
  {
    $rs = $this->db->where('sale_id', $sale_id)->get('user');
    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


} //---- End class

 ?>
