<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approver extends PS_Controller{
	public $menu_code = 'APPROVER';
	public $menu_group_code = 'ADMIN';
	public $title = 'Approver';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'approver';
		$this->load->model('approver_model');
		$this->load->helper('approve');
  }



  public function index()
  {
		$this->title = "Approver - List";

		$filter = array(
			'uname' => get_filter('uname', 'ap_uname', ''),
			'emp_name' => get_filter('emp_name', 'ap_emp_name', ''),
			'conditions' => get_filter('conditions', 'ap_conditions', 'all'),
			'amount' => get_filter('amount', 'ap_amount', ''),
			'status' => get_filter('status', 'ap_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->approver_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$rs = $this->approver_model->get_list($filter, $perpage, $this->uri->segment($segment));

		$filter['data'] = $rs;

		$this->pagination->initialize($init);

    $this->load->view('approver/approver_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Approver - Add";

		if($this->pm->can_add)
		{
			$this->load->view('approver/approver_add');
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
			if($this->input->post('uname'))
			{
				$uname = trim($this->input->post('uname'));
				$conditions = $this->input->post('conditions');
				$amount = $this->input->post('amount');
				$status = $this->input->post('status') == 1 ? 1 : 0;

				$user = $this->user_model->get_user_by_uname($uname);

				if(!empty($user))
				{
					//--- check exists approver
					if(!$this->approver_model->is_exists($user->id))
					{
						$arr = array(
							'user_id' => $user->id,
							'uname' => $user->uname,
							'emp_name' => $user->emp_name,
							'conditions' => $conditions,
							'amount' => $amount,
							'status' => $status,
							'date_add' => now(),
							'add_by' => $this->_user->id
						);

						if(! $this->approver_model->add($arr))
						{
							$sc = FALSE;
							$this->error = "Add new Approver failed";
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "Approver already exists";
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Invalid username";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing Required Parameter";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing permission";
		}

		$this->_response($sc);
	}


	public function edit($id)
	{
		$this->title = "Approver - Edit";
		if($this->pm->can_edit)
		{
			$rs = $this->approver_model->get($id);
			if(!empty($rs))
			{
				$ds['data'] = $rs;
				$this->load->view('approver/approver_edit', $ds);
			}
			else
			{
				$this->load->view('page_error');
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
			if($this->input->post('id'))
			{
				$id = $this->input->post('id');
				$conditions = $this->input->post('conditions');
				$amount = $this->input->post('amount');
				$status = $this->input->post('status') == 1 ? 1 : 0;

				$arr = array(
					'conditions' => $conditions,
					'amount' => $amount,
					'status' => $status,
					'date_upd' => now(),
					'update_by' => $this->_user->id
				);

				if(! $this->approver_model->update($id, $arr))
				{
					$sc = FALSE;
					$this->error = "Update failed";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing required parameter";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing Permission";
		}

		$this->_response($sc);
	}


	public function delete()
	{
		$sc = TRUE;
		if($this->pm->can_delete)
		{
			if($this->input->post('id'))
			{
				$id = $this->input->post('id');

				if(! $this->approver_model->delete($id))
				{
					$sc = FALSE;
					$this->error = "Delete failed";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing required parameter";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing Permission";
		}

		$this->_response($sc);
	}


	public function clear_filter()
	{
		$filter = array(
			'ap_uname',
			'ap_emp_name',
			'ap_status',
			'ap_conditions',
			'ap_amount'
		);

		clear_filter($filter);
		echo 'done';
	}

}//--- end class


 ?>
