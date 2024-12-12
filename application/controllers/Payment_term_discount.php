<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_term_discount extends PS_Controller
{
	public $menu_code = 'PMTDISC';
	public $menu_group_code = 'ADMIN';
	public $title = 'Payment Term Discount';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'payment_term_discount';
		$this->load->model('payment_term_discount_model');
		$this->load->helper('orders');
  }


	public function index()
	{
		$filter = array(
			'payment_term' => get_filter('payment_term', 'payment_term', 'all'),
			'name' => get_filter('name', 'payment_name', ''),
			'status' => get_filter('status', 'payment_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->payment_term_discount_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$result = $this->payment_term_discount_model->get_list($filter, $perpage, $this->uri->segment($segment));

		$filter['data'] = $result;

		$this->pagination->initialize($init);
		$this->load->view('payment_term_discount/payment_term_discount_list', $filter);
	}


	public function add_new()
	{
		if($this->pm->can_add)
		{
			$this->load->view('payment_term_discount/payment_term_discount_add');
		}
		else
		{
			$this->deny_page();
		}
	}


	public function add()
	{
		$sc = TRUE;

		if($this->pm->can_add)
		{
			$ds = json_decode($this->input->post('data'));

			if( ! empty($ds))
			{
				if( ! $this->payment_term_discount_model->is_exists_name($ds->name))
				{
					$arr = array(
						'name' => $ds->name,
						'GroupNum' => $ds->GroupNum,
						'PymntGroup' => $ds->PymntGroup,
						'DiscPrcnt' => $ds->DiscPrcnt,
						'canChange' => $ds->canChange,
						'active' => $ds->active,
						'position' => $ds->position,
						'add_by' => $this->_user->id,
						'date_add' => now()
					);

					if( ! $this->payment_term_discount_model->add($arr))
					{
						$sc = FALSE;
						$this->error = get_error_message('insert');
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = get_error_message('exists', $ds->name);
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = get_error_message('required');
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = get_error_message('permission');
		}

		$this->_response($sc);
	}


	public function edit($id)
	{
		if($this->pm->can_edit)
		{
			$doc = $this->payment_term_discount_model->get($id);

			if( ! empty($doc))
			{
				$data['doc'] = $doc;
				$this->load->view('payment_term_discount/payment_term_discount_edit', $data);
			}
			else
			{
				$this->error_page();
			}
		}
		else
		{
			$this->deny_page();
		}
	}


	public function update()
	{
		$sc = TRUE;

		if($this->pm->can_edit)
		{
			$ds = json_decode($this->input->post('data'));

			if( ! empty($ds))
			{
				if( ! $this->payment_term_discount_model->is_exists_name($ds->name, $ds->id))
				{
					$arr = array(
						'name' => $ds->name,
						'GroupNum' => $ds->GroupNum,
						'PymntGroup' => $ds->PymntGroup,
						'DiscPrcnt' => $ds->DiscPrcnt,
						'canChange' => $ds->canChange,
						'active' => $ds->active,
						'position' => $ds->position,
						'update_by' => $this->_user->id,
						'date_upd' => now()
					);

					if( ! $this->payment_term_discount_model->update($ds->id, $arr))
					{
						$sc = FALSE;
						$this->error = get_error_message('update');
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = get_error_message('exists', $ds->name);
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = get_error_message('required');
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = get_error_message('permission');
		}

		$this->_response($sc);
	}


	public function delete()
	{
		$sc = TRUE;
		$id = $this->input->post('id');

		if( ! empty($id))
		{
			if($this->pm->can_delete)
			{
				if( ! $this->payment_term_discount_model->delete($id))
				{
					$sc = FALSE;
					$this->error = "Failed to delete payment term List";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = get_error_message('permission');
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = get_error_message('required');
		}

		$this->_response($sc);
	}


  public function clear_filter()
	{
		$filter = array(
			'payment_term',
			'payment_name',
			'payment_status'
		);

		return clear_filter($filter);
	}

}//--- end class


 ?>
