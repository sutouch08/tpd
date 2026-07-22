<?php
class Product_lot_check_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_data($ItemCode, $limit = 0)
  {
    $this->ms
    ->select('ItemCode, ItemName, BatchNum, ExpDate, PrdDate')
    ->select_sum('Quantity', 'qty')
    ->where('ItemCode', $ItemCode)
    ->where('Quantity >', 0)
    ->group_by('ItemCode, ItemName, BatchNum, ExpDate, PrdDate')
    ->order_by('BatchNum', 'ASC');

    if($limit > 0)
    {
      $this->ms->limit($limit);
    }

    $rs = $this->ms->get('OIBT');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


} //-- end class