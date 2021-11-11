<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approve_rule extends PS_Controller{
	public $menu_code = 'APPROVE_RULE';
	public $menu_group_code = 'ADMIN';
	public $title = 'Approval rule';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'approve_rule';
		$this->load->model('approve_rule_model');
		$this->load->helper('approve');
		$this->load->helper('sale_team');
  }



  public function index()
  {
		$this->title = "Approval rule - List";

		$filter = array(
			'code' => get_filter('code', 'ar_code', ''),
			'conditions' => get_filter('conditions', 'ar_conditions', 'all'),
			'amount' => get_filter('amount', 'ar_amount', ''),
			'sale_team' => get_filter('sale_team', 'ar_sale_team', 'all'),
			'is_price_list' => get_filter('is_price_list', 'ar_is_price_list', 'all'),
			'status' => get_filter('status', 'ar_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->approve_rule_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$rs = $this->approve_rule_model->get_list($filter, $perpage, $this->uri->segment($segment));

		if(!empty($rs))
		{
			foreach($rs as $ra)
			{
				$ra->approver = $this->approve_rule_model->get_rule_approver($ra->id);
			}
		}

		$filter['data'] = $rs;

		$this->pagination->initialize($init);

    $this->load->view('approve_rule/approve_rule_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Approval rule - Add";

		if($this->pm->can_add)
		{
			$ds['code'] = $this->get_new_code();
			$this->load->view('approve_rule/approve_rule_add', $ds);
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
			if($this->input->post('conditions') && $this->input->post('amount'))
			{
				$code = $this->get_new_code();
				$conditions = $this->input->post('conditions');
				$amount = $this->input->post('amount');
				$sale_team = $this->input->post('sale_team');
				$is_price_list = $this->input->post('is_price_list') == 1 ? 1 : 0;
				$status = $this->input->post('status') == 1 ? 1 : 0;
				$approver = json_decode($this->input->post('approver'));

				if(!empty($approver))
				{
					$arr = array(
						'code' => $code,
						'conditions' => $conditions,
						'amount' => $amount,
						'sale_team' => $sale_team,
						'is_price_list' => $is_price_list,
						'status' => $status,
						'add_by' => $this->_user->id,
						'date_add' => now()
					);

					$id = $this->approve_rule_model->add($arr);
					if($id === FALSE)
					{
						$sc = FALSE;
						$this->error = "Insert approve rule failed";
					}
					else
					{
						if(!empty($approver))
						{
							foreach($approver as $user_id)
							{
								$arr = array(
									'rule_id' => $id,
									'user_id' => $user_id
								);

								if(! $this->approve_rule_model->is_exists_approver($id, $user_id))
								{
									$this->approve_rule_model->add_rule_approver($arr);
								}
							}
						}
					}

				}
				else
				{
					$sc = FALSE;
					$this->error = "Required at least 1 Authorizer(s)";
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
		$this->title = "Approve rule - Edit";
		if($this->pm->can_edit)
		{
			$rs = $this->approve_rule_model->get($id);

			if(!empty($rs))
			{
				if(!empty($rs))
				{
					$rs->approver = $this->approve_rule_model->get_rule_approver($id);
				}

				$ds['data'] = $rs;
				$this->load->view('approve_rule/approve_rule_edit', $ds);
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
			if($this->input->post('rule_id') && $this->input->post('conditions') && $this->input->post('amount'))
			{
				$id = $this->input->post('rule_id');
				$conditions = $this->input->post('conditions');
				$amount = $this->input->post('amount');
				$sale_team = $this->input->post('sale_team');
				$is_price_list = $this->input->post('is_price_list') == 1 ? 1 : 0;
				$status = $this->input->post('status') == 1 ? 1 : 0;
				$approver = json_decode($this->input->post('approver'));

				if(!empty($approver))
				{
					$arr = array(
						'conditions' => $conditions,
						'amount' => $amount,
						'sale_team' => $sale_team,
						'is_price_list' => $is_price_list,
						'status' => $status,
						'update_by' => $this->_user->id,
						'date_upd' => now()
					);

					$rs = $this->approve_rule_model->update($id, $arr);

					if($rs === FALSE)
					{
						$sc = FALSE;
						$this->error = "Update failed";
					}
					else
					{
						if(!empty($approver))
						{
							//--- drop current approver
							if(! $this->approve_rule_model->drop_rule_approver($id))
							{
								$sc = FALSE;
								$this->error = "Update Authorizer failed : Drop current authorizer failed";
							}
							else
							{
								foreach($approver as $user_id)
								{
									$arr = array(
										'rule_id' => $id,
										'user_id' => $user_id
									);

									if(! $this->approve_rule_model->is_exists_approver($id, $user_id))
									{
										$this->approve_rule_model->add_rule_approver($arr);
									}
								}
							}

						}
					}

				}
				else
				{
					$sc = FALSE;
					$this->error = "Required at least 1 Authorizer(s)";
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


	public function delete()
	{
		$sc = TRUE;
		if($this->pm->can_delete)
		{
			if($this->input->post('id'))
			{
				$id = $this->input->post('id');

				if(! $this->approve_rule_model->delete($id))
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



	public function get_rule_approver_list($rule_id)
	{
		$list = $this->approve_rule_model->get_rule_approver($rule_id);

		$ds = array();

		if(!empty($list))
		{
			foreach($list as $rs)
			{
				$arr = array(
					'uname' => $rs->uname,
					'emp_name' => $rs->emp_name
				);

				array_push($ds, $arr);
			}
		}

		echo count($ds) > 0 ? json_encode($ds) : NULL;
	}



	public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $prefix = "RL";
    $run_digit = 3;
    $pre = $prefix .'-'.$Y;
    $code = $this->approve_rule_model->get_max_code($pre);
    if(! empty($code))
    {
      $run_no = mb_substr($code, ($run_digit*-1), NULL, 'UTF-8') + 1;
      $new_code = $prefix . '-' . $Y . sprintf('%0'.$run_digit.'d', $run_no);
    }
    else
    {
      $new_code = $prefix . '-' . $Y . sprintf('%0'.$run_digit.'d', '001');
    }

    return $new_code;
  }


	public function clear_filter()
	{
		$filter = array(
			'ar_code',
			'ar_conditions',
			'ar_amount',
			'ar_is_price_list',
			'ar_sale_team',
			'ar_status'
		);

		clear_filter($filter);
		echo 'done';
	}

}//--- end class


 ?>
