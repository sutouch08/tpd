<?php 
class Po_search_model extends CI_Model
{

  private $tb = "orders";
  
  public function __construct()
  {
    parent::__construct();
  }

  public function count_rows(array $ds = array())
  {
    $this->db->where('NumAtCard IS NOT NULL', NULL, FALSE)->where('NumAtCard !=', '');

    if( ! empty($ds['code']))
    {
      $this->db->like('code', $ds['code']);
    }

    if( ! empty($ds['po']))
    {
      $this->db->like('NumAtCard', $ds['po']);
    }

    if( ! empty($ds['customer']))
    {
      $this->db->group_start();
      $this->db->like('CardCode', $ds['customer']);
      $this->db->or_like('CardName', $ds['customer']);
      $this->db->group_end();
    }

    if($ds['user_id'] !== 'all')
    {
      $this->db->where('user_id', $ds['user_id']);
    }

    if($ds['has_file'] !== 'all')
    {
      $this->db->where('has_file', $ds['has_file']);
    }

    if( ! empty($ds['fromDate']))
    {
      $this->db->where('date_add >=', from_date($ds['fromDate']));
    }

    if( ! empty($ds['toDate']))
    {
      $this->db->where('date_add <=', to_date($ds['toDate']));
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    $this->db->select('code, NumAtCard, CardCode, CardName, user_id, uname, date_add, has_file, file_name, file_type');
    $this->db->where('NumAtCard IS NOT NULL', NULL, FALSE)->where('NumAtCard !=', '');

    if( ! empty($ds['code']))
    {
      $this->db->like('code', $ds['code']);
    }

    if( ! empty($ds['po']))
    {
      $this->db->like('NumAtCard', $ds['po']);
    }

    if( ! empty($ds['customer']))
    {
      $this->db->group_start();
      $this->db->like('CardCode', $ds['customer']);
      $this->db->or_like('CardName', $ds['customer']);
      $this->db->group_end();
    }

    if($ds['user_id'] !== 'all')
    {
      $this->db->where('user_id', $ds['user_id']);
    }

    if($ds['has_file'] !== 'all')
    {
      $this->db->where('has_file', $ds['has_file']);
    }

    if( ! empty($ds['fromDate']))
    {
      $this->db->where('date_add >=', from_date($ds['fromDate']));
    }

    if( ! empty($ds['toDate']))
    {
      $this->db->where('date_add <=', to_date($ds['toDate']));
    }

    $this->db->order_by('date_add', 'DESC');
    $this->db->limit($perpage, $offset);
    $rs = $this->db->get($this->tb);
    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

}// end class