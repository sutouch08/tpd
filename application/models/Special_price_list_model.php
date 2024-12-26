<?php
class Special_price_list_model extends CI_Model
{
  private $tb = "special_price_list";
  private $td = "special_price_item";
  private $tr = "special_price_item_detail";

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


  //--- special price item
  public function get_item_by_id($id)
  {
    $rs = $this->db
    ->select('i.*, p.name AS price_list_name')
    ->from('special_price_item AS i')
    ->join('special_price_list AS p', 'i.price_list_id = p.id', 'left')
    ->where('i.id', $id)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_item_by_code($ItemCode, $price_list_id)
  {
    $rs = $this->db
    ->where('ItemCode', $ItemCode)
    ->where('price_list_id', $price_list_id)
    ->get($this->td);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_item_details($id)
  {
    $rs = $this->db->where('step_id', $id)->get($this->tr);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_item_detail($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tr);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_details($id)
  {
    $rs = $this->db
    ->where('price_list_id', $id)
    ->order_by('ItemName', 'ASC')
    ->get($this->td);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  //--- add price list
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


  //--- add item to priced list
  public function add_item(array $ds = array())
  {
    if( ! empty($ds))
    {
      if($this->db->insert($this->td, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  //--- add step to item
  public function add_item_detail(array $ds = array())
  {
    if(!empty($ds))
    {
      if($this->db->insert($this->tr, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  //--- update price list
  public function update($id, array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  //--- update item in price list
  public function update_item($id, array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->where('id', $id)->update($this->td, $ds);
    }

    return FALSE;
  }


  //--- delete price list
  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }


  //--- delete item
  public function delete_item($id)
  {
    return $this->db->where('id', $id)->delete($this->td);
  }


  //--- delete all step in item
  public function delete_details($step_id)
  {
    return $this->db->where('step_id', $step_id)->delete($this->tr);
  }


  public function count_step($step_id)
  {
    $count = $this->db->where('step_id', $step_id)->count_all_results($this->tr);

    return $count;
  }


  public function count_items($id)
  {
    $count = $this->db->where('price_list_id', $id)->count_all_results($this->td);

    return $count;
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if( ! empty($ds['name']))
    {
      $this->db->like('name', $ds['name']);
    }

    if(isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('active', $ds['status']);
    }

    $this->db->limit($limit, $offset);

    $rs = $this->db->get($this->tb);

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

    if(isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('active', $ds['status']);
    }

    return $this->db->count_all_results($this->tb);
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


  public function is_exists_item($itemCode, $price_list_id)
  {
    $count = $this->db->where('price_list_id', $price_list_id)->where('ItemCode', $itemCode)->count_all_results($this->td);

    return $count > 0 ? TRUE : FALSE;
  }

}
?>
