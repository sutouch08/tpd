<?php
class Payment_term_discount_model extends CI_Model
{
  private $tb = "payment_term_discount";

  public function __construct()
  {
    parent::__construct();
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


  public function get_by_group_num($groupNum)
  {
    $rs = $this->db->where('GroupNum', $groupNum)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_active_term_list()
  {
    $rs = $this->db
    ->where('active', 1)
    ->order_by('position', 'ASC')
    ->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function add(array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->insert($this->tb, $ds);
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


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
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


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if(isset($ds['payment_term']) && $ds['payment_term'] != 'all')
    {
      $this->db->where('GroupNum', $ds['payment_term']);
    }

    if(isset($ds['name']) && $ds['name'] != "")
    {
      $this->db->like('name', $ds['name']);
    }

    if(isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('active', $ds['status']);
    }

    $this->db->order_by('position', 'ASC')->limit($limit, $offset);

    $rs = $this->db->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function count_rows(array $ds = array())
  {
    if(isset($ds['payment_term']) && $ds['payment_term'] != 'all')
    {
      $this->db->where('GroupNum', $ds['payment_term']);
    }

    if(isset($ds['name']) && $ds['name'] != "")
    {
      $this->db->like('name', $ds['name']);
    }

    if(isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('active', $ds['status']);
    }

    return $this->db->count_all_results($this->tb);
  }

  public function get_name($id)
  {
    $rs = $this->db->select('name')->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->name;
    }

    return NULL;
  }

}
?>
