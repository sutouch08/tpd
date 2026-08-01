<?php
class Customer_status_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  public function get_customer_list()
  {
    $date = date('Y-m-d', strtotime("-3 month"));

    $rs = $this->ms
    ->select('CardCode, CardName, CreateDate')
    ->where('CardType', 'C')
    ->where('U_TPD_FirstCus', 'Y')
    ->where('CreateDate <=', $date)
    ->get('OCRD');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function count_customer_invoice($cardCode)
  {
    return $this->ms->where('CardCode', $cardCode)->where('CANCELED', 'N')->count_all_results('OINV');
  }

} //--- end class

