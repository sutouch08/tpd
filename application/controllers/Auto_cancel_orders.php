<?php
class Auto_cancel_orders extends CI_Controller
{
  private $limit = 100;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('orders_model');
  }

  public function index()
  {   
    $list = $this->get_cancel_list($this->limit);

    if(!empty($list))
    {
      $orders = [];

      foreach($list as $rs)
      {        
        $orders[] = $rs->code;
      }

      if( ! empty($orders))
      {
        $arr = array(
          'Status' => -1,
          'DocNum' => NULL,
          'Message' => NULL,
          'sap_date' => NULL,
          'temp_date' => NULL,
          'isCancel' => 1,
          'cancel_by' => 'system',
          'cancel_date' => date('Y-m-d H:i:s')
        );

        $cancelled = $this->db->where_in('code', $orders)->update('orders', $arr);

        if($cancelled)
        {
          $log = array(
            'orders_code' => json_encode($orders),
            'status' => 'success'
          );

          $this->db->insert('order_cancel_logs', $log);
        }
        else 
        {
          $log = array(
            'orders_code' => json_encode($orders),
            'status' => 'failed'
          );

          $this->db->insert('order_cancel_logs', $log);
        }        
      }
    }
    else 
    {
      $log = array(
        'orders_code' => NULL,
        'status' => 'no orders to cancel'
      );

      $this->db->insert('order_cancel_logs', $log);
    }
  }


  private function get_cancel_list($limit = 100)
  {
    $days = getConfig('ORDER_EXPIRATION');
    $date = date('Y-m-d 00:00:00', strtotime("-{$days} days"));      

    $qr  = "SELECT o.code FROM orders AS o ";
    $qr .= "LEFT JOIN payment_request_order AS r ON o.code = r.code ";
    $qr .= "WHERE o.status = 0 ";
    $qr .= "AND o.credit_issue = 1 ";
    $qr .= "AND o.is_over_due = 1 ";
    $qr .= "AND o.credit_case_id IS NOT NULL ";
    $qr .= "AND ((o.credit_approval = 'R' OR r.status = 'R') OR (r.status = 'O' AND r.reply_status = 'N' AND r.date_upd < '{$date}')) ";
    $qr .= "ORDER BY o.date_add ASC ";
    $qr .= "LIMIT {$limit}";

    $rs = $this->db->query($qr);

    if ($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }
}