<?php
class Product_lot_check extends PS_Controller
{
  public $menu_code = 'PDLOTCHK';
  public $menu_group_code = 'ORDER';
  public $title = 'ตรวจสอบ Lot. สินค้า';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('product_lot_check_model');
    $this->load->model('item_model');
  }

  public function index()
  {
    $ds = array(
      'items' => NULL,
      'priceList' => $this->user_model->get_user_price_list($this->_user->id)
    );

    $this->load->view('product_lot_check/product_lot_check', $ds);
  }


  public function get_item_template()
  {
    $sc = TRUE;
    $ds = '<option value="">Select Items</option>';
    $PriceList = $this->input->post('priceList');   

    if (! is_null($PriceList))
    {
      $items = $this->item_model->get_items_by_price_list($PriceList);

      if (! empty($items))
      {
        $ds = '<option value="">Select items (' . count($items) . ')</option>';

        foreach ($items as $rs)
        {
          $ds .= '<option value="' . $rs->code . '" data-name="' . $rs->name . '">' . $rs->name . '</option>';
        }
      }
      else
      {
        $ds = '<option value="">No Items</option>';
      }      
    }
    else
    {
      $sc = FALSE;
      $this->error = get_error_message('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'template' => $sc === TRUE ? $ds : NULL
    );

    echo json_encode($arr);
  }


  public function get_data()
  {
    $sc = TRUE;
    $priceList = $this->input->post('priceList');
    $itemCode = $this->input->post('item');
    $ds = [];

    if (! empty($itemCode))
    {
      $item = $this->item_model->get($itemCode, $priceList);

      if( ! empty($item))
      {
        $limit = getConfig('LIMIT_LOT_CHECK');
        $data = $this->product_lot_check_model->get_data($itemCode, $limit);

        if( ! empty($data))
        {
          $no = 1;

          foreach($data as $rs)
          {
            $ds[] = array(
              'no' => $no,
              'description' => $rs->ItemName,
              'lotNo' => $rs->BatchNum,
              'expDate' => thai_date($rs->ExpDate),
              'mfdDate' => thai_date($rs->PrdDate),
              'qty' => number($rs->qty, 2)
            );

            $no++;
          }          
        }
        else
        {
          $ds[] = array('nodata' => 'No data found');
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = 'Invalid item code';
      }      
    }
    else
    {
      $sc = FALSE;
      $this->error = get_error_message('required');
    }

    echo json_encode(array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? '' : $this->error,
      'data' => ! empty($ds) ? $ds : NULL
    ));
  }


} //--- end class
	