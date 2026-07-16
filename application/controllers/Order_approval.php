<?php
class Order_approval extends PS_Controller
{
  public $menu_code = 'ORDER_APPROVAL';
  public $menu_group_code = 'APPROVAL';
  public $menu_sub_group_code = '';
  public $title = 'Order Approval';
  public $segment = 3;
  public $disSale = FALSE;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'order_approval';    
    $this->load->model('order_approval_model');    
    $this->load->helper('sales_team_condition');

    $this->disSale = getConfig('USE_DISCSALE') == 1 ? TRUE : FALSE;
  }

  public function index()
  {
    $this->title = "Order Approval - List";
    $filter = array(
      'con_id' => get_filter('con_id', 'ap_con_id', 'all'),
      'code' => get_filter('code', 'ap_code', ''),     
      'po' => get_filter('po', 'ap_po', ''),
      'customer' => get_filter('customer', 'ap_customer', ''),
      'user_id' => get_filter('user_id', 'ap_user_id', 'all'),            
      'fromDate' => get_filter('fromDate', 'ap_fromDate', ''),
      'toDate' => get_filter('toDate', 'ap_toDate', ''),
      'is_discount_sales' => get_filter('is_discount_sales', 'is_discount_sales', 'all'),
      'min_amount_filter' => get_filter('min_amount_filter', 'ap_min_amount', 'Y')
    );    

    if ($this->input->post('search'))
    {
      redirect($this->home);
    }
    else
    {
      $perpage = get_rows();
      $apv = $this->order_approval_model->get_approver_by_user_id($this->_user->id);
      $condition = empty($apv) ? [0] : $this->order_approval_model->get_approver_conditions($this->_user->id);
      $filter['conditions'] = $condition;
      $filter['min_amount'] = empty($apv) ? 0 : $apv->min_amount;
      $filter['max_amount'] = empty($apv) ? 0 : $apv->amount;
      $rows = empty($apv) ? 0 : $this->order_approval_model->count_rows($filter);
      $filter['data'] = empty($apv) ? NULL : $this->order_approval_model->get_list($filter, $perpage, $this->uri->segment($this->segment));
      $init  = pagination_config($this->home . '/index/', $rows, $perpage, $this->segment);
      $this->pagination->initialize($init);
      $this->load->view('order_approval/order_approval_list', $filter);
    }
  }


  public function clear_filter()
  {
    $filter = array('ap_con_id', 'ap_code', 'ap_po', 'ap_customer', 'ap_user_id', 'ap_fromDate', 'ap_toDate', 'is_discount_sales', 'ap_min_amount');
    clear_filter($filter);
  }  

} // end class 
