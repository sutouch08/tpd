<?php
class Auto_cancel_orders extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('orders_model');
  }

  public function index()
  {
   
    $list = $this->get_cancel_list();
  }

  private function get_cancel_list()
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
    $qr .= "ORDER BY o.date_add ASC";

    $rs = $this->db->query($qr);

    if ($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

}