<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync_data extends CI_Controller
{
  public $title = 'Sync Data';
	public $menu_code = '';
	public $menu_group_code = '';
	public $pm;
  public $limit = 100;
  public $date;

  public function __construct()
  {
    parent::__construct();
    $this->ms = $this->load->database('ms', TRUE); //--- SAP database
    $this->mc = $this->load->database('mc', TRUE); //--- Temp Database
    $this->load->model('sync_data_model');
    $this->load->model('orders_model');
    $this->date = date('Y-d-m H:i:s');
  }


  public function index()
  {
    $this->load->view('sync_data_view');
  }


  public function clear_logs($days = 7)
  {
    $this->load->view('clear_old_logs_view', array('days' => $days));
  }


  public function clear_old_logs($days)
  {
    $sc = $this->sync_data_model->clear_old_logs($days);

    if($sc)
    {
      echo 'done';
    }
    else
    {
      echo 'error';
    }
  }



  public function syncSOCode()
  {
    $ds = $this->orders_model->get_non_so_code($this->limit);
    $count = 0;
    $update = 0;
    $message = 'done';
    if(!empty($ds))
    {
      foreach($ds as $rs)
      {
        $count++;

        $temp = $this->orders_model->get_temp_status($rs->code);

        if(!empty($temp))
        {
          if($temp->F_Sap === 'Y')
          {
            $sap = $this->orders_model->get_sap_order($rs->code);

            if(!empty($sap))
            {
              $arr = array(
                'DocNum' => $sap->DocNum,
                'sap_date' => $temp->F_SapDate,
                'Status' => 2, //--- เข้า SAP แล้ว
                'Message' => NULL
              );

              $this->orders_model->update($rs->code, $arr);
              $update++;
            }
          }
          else
          {
            if($temp->F_Sap === 'N')
            {
              $arr = array(
                'Status' => 3,
                'Message' => $temp->Message
              );

              $this->orders_model->update($rs->code, $arr);
            }
          }
        }
      }
    }
    else
    {
      $message = 'not found';
    }


    $logs = array(
      'sync_item' => 'SO',
      'get_item' => $count,
      'update_item' => $update
    );

    //--- add logs
    $this->sync_data_model->add_logs($logs);

    echo $count.' | '.$update.' | '.$message;
  }



  public function syncDoCode()
  {
    $ds = $this->orders_model->get_non_do_code($this->limit);
    $count = 0;
    $update = 0;
    $message = 'done';
    if(!empty($ds))
    {
      foreach($ds as $rs)
      {
        $count++;

        $do = $this->orders_model->get_delivery_order($rs->code);

        if(!empty($do))
        {
          $doNo = "";
          $i = 1;
          foreach($do as $ds)
          {
            $doNo .= $i === 1 ? $ds->DocNum : ", ".$ds->DocNum;
          }

          $arr = array(
            'DeliveryNo' => $doNo
          );

          $this->orders_model->update($rs->code, $arr);
          $update++;
        }
      }
    }
    else
    {
      $message = 'not found';
    }

    $logs = array(
      'sync_item' => 'DO',
      'get_item' => $count,
      'update_item' => $update
    );

    //--- add logs
    $this->sync_data_model->add_logs($logs);

    echo $count.' | '.$update.' | '.$message;
  }


  public function syncInvCode()
  {
    $ds = $this->orders_model->get_non_inv_code($this->limit);
    $count = 0;
    $update = 0;
    $message = 'done';
    if(!empty($ds))
    {
      foreach($ds as $rs)
      {
        $count++;

        $do = $this->orders_model->get_invoice_order($rs->code);

        if(!empty($do))
        {
          $doNo = "";
          $i = 1;
          foreach($do as $ds)
          {
            $doNo .= $i === 1 ? $ds->DocNum : ", ".$ds->DocNum;
          }

          $arr = array(
            'InvoiceNo' => $doNo
          );

          $this->orders_model->update($rs->code, $arr);
          $update++;
        }
      }
    }
    else
    {
      $message = 'not found';
    }

    $logs = array(
      'sync_item' => 'INV',
      'get_item' => $count,
      'update_item' => $update
    );

    //--- add logs
    $this->sync_data_model->add_logs($logs);

    echo $count.' | '.$update.' | '.$message;
  }



  public function syncSaleName()
  {
    $list = $this->db->select('id, sale_id')->where('id >', 0)->where('sale_id IS NOT NULL', NULL, FALSE)->get('user');

    if($list->num_rows() > 0)
    {
      foreach($list->result() as $rs)
      {
        $name = $this->user_model->get_saleman_name($rs->sale_id);

        if(! empty($name))
        {
          $arr = array(
            'sale_name' => $name
          );

          $this->user_model->update($rs->id, $arr);
        }
      }
    }
  }



} //--- end class

 ?>
