<?php
class Sync_order_status extends CI_Controller
{
  public $mc;
  public $limit = 50;

  public function __construct()
  {
    parent::__construct();
    $this->mc = $this->load->database('mc', TRUE); //--- Temp Database
  }


  public function index()
  {
    $list = $this->getUpdateList();

    if(!empty($list))
    {
      foreach($list as $ds)
      {
        if($ds->CancelledSO === 'Y')
        {
          $arr = array(
            'SO_Status' => 'D',
            'DO_Status' => NULL,
            'INV_Status' => NULL
          );
        }
        else
        {
          $arr = array();

          if($ds->CancelledSO === 'C')
          {
            $arr['SO_Status'] = 'C';
          }
          else
          {
            $arr['SO_Status'] = 'O';
          }

          if($ds->CancelledDO === 'Y')
          {
            $arr['DO_Status'] = NULL;
            $arr['DeliveryNo'] = NULL;
          }

          if($ds->CancelledIV === 'Y')
          {
            $arr['INV_Status'] = NULL;
            $arr['InvoiceNo'] = NULL;
          }
        }

        if(!$this->update($ds->U_WEB_ORNO, $arr))
        {
          $upd = array(
            'F_Web' => 'N',
            'F_Message' => "Update failed",
            'F_WebDate' => now()
          );
        }
        else
        {
          $upd = array(
            'F_Web' => 'Y',
            'F_Message' => NULL,
            'F_WebDate' => now()
          );
        }

        $this->update_temp($ds->DocEntry, $upd);

      } //--- endforeach
    }
  }



  private function getUpdateList()
  {
    $rs = $this->mc
    ->group_start()
    ->where('F_Web IS NULL', NULL, FALSE)
    ->or_where('F_Web', 'N')
    ->group_end()
    ->where('DocNumSO >', 0)
    ->limit($this->limit)
    ->get('Status');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  private function update($code, array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->where('code', $code)->update('orders', $ds);
    }

    return TRUE;
  }


  private function update_temp($docEntry, array $ds = array())
  {

    if(!empty($ds))
    {
      return $this->mc->where('DocEntry', $docEntry)->update('Status', $ds);
    }

    return TRUE;
  }

} //--- end class

 ?>
