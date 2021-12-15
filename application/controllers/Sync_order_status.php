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
        if($ds->Cancelled === 'Y')
        {
          if($ds->Type === 'DO')
          {
            $arr = array(
              'DO_Status' => NULL
            );
          }
          else if($ds->Type === 'INV')
          {
            $arr = array(
              'INV_Status' => NULL
            );
          }
        }

        if(!$this->update($ds->U_WEB_ORNO, $arr))
        {
          $arr = array(
            'F_Web' => 'N',
            'F_Message' => "Update failed",
            'F_WebDate' => now()
          );
        }
        else
        {
          $arr = array(
            'F_Web' => 'Y',
            'F_Message' => NULL,
            'F_WebDate' => now()
          );
        }

        $this->update_temp($ds->DocEntry, $arr);

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
    ->where('DocNum >', 0)
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
    return $this->db->where('code', $code)->update('code', $ds);
  }


  private function update_temp($docEntry, array $ds = array())
  {
    return $this->mc->where('DocEntry', $docEntry)->update('Status', $ds);
  }

} //--- end class

 ?>
