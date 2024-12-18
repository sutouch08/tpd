<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step_rule_check extends PS_Controller
{
	public $menu_code = 'PRICECHECK';
	public $menu_group_code = 'ORDER';
	public $title = 'ตรวจสอบ Step ราคา';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'step_rule_check';
		$this->load->model('step_rule_model');
		$this->load->model('item_model');
		$this->load->helper('orders');
  }


	public function index()
	{
		$ds['items'] = $this->item_model->get_item_list();
		$this->load->view('step_rule_check/check_list', $ds);
	}


	public function get_data()
	{
		$sc = TRUE;
		$ds = array();
		$code = trim($this->input->post('itemCode'));
		$PriceList = $this->input->post('priceList');

		// print_r($this->input->post());

		if( ! empty($PriceList) && ! empty($code))
		{
			$item = $this->item_model->get($code, $PriceList);

			$step = $this->step_rule_model->get_active_details($PriceList);

			if( ! empty($item))
			{
				$price = round($item->price, 2);

				$no = 1;

				if( ! empty($step))
				{
					foreach($step as $rs)
					{
						$allQty = ($rs->stepQty + $rs->freeQty);
						$amount = $rs->stepQty * $price;
						$allAmount = $allQty * $price;
						$diffAmount = $allAmount - $amount;
						$discPrcnt = $diffAmount > 0 ? $diffAmount/$allAmount : 0;

						$ds[] = array(
							'no' => $no,
							'ItemCode' => $item->code,
							'ItemName' => $item->name,
							'Price' => number($price, 2),
							'Qty' => $rs->stepQty,
							'freeQty' => $rs->freeQty,
							'avgPrice' => number(round($amount/$allQty, 2),2),
							'discPrcnt' => round($discPrcnt, 2) * 100
						);

						$no++;
					}
				}
				else
				{
					$ds[] = array('nodata' => 'ไม่พบ step ราคา');
				}
			}
			else
			{
				$ds[] = array('nodata' => 'ไม่พบรายการสินค้า');
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
			'data' => $ds
		);

		echo json_encode($arr);
	}

}//--- end class


 ?>
