<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_team_condition extends PS_Controller
{
	public $menu_code = 'SALE_CON';
	public $menu_group_code = 'ADMIN';
	public $title = 'Sales Team Condition';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'sales_team_condition';
		$this->load->model('sales_team_condition_model');
		$this->load->helper('sales_team_condition');
		$this->load->helper('approve');
  }


	public function index()
	{
		$filter = array(
			'name' => get_filter('name', 'con_name', ''),
			'sale_id' => get_filter('sale_id', 'con_sale_id', 'all'),
			'dep_id' => get_filter('dep_id', 'con_dep_id', 'all'),
			'team_id' => get_filter('team_id', 'con_team_id', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->sales_team_condition_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$result = $this->sales_team_condition_model->get_list($filter, $perpage, $this->uri->segment($segment));

		if( ! empty($result))
		{
			foreach($result as $rs)
			{
				$rs->member = $this->sales_team_condition_model->count_members($rs->id);

				$apv = "";

				$approver = $this->sales_team_condition_model->get_condition_approver($rs->id);

				if( ! empty($approver))
				{
					$i = 1;

					foreach($approver as $ap)
					{
						$apv .= $i === 1 ? $ap->emp_name : ", ".$ap->emp_name;
						$i++;
					}
				}

				$rs->approver_list = $apv;
			}
		}


		$filter['data'] = $result;

		$this->pagination->initialize($init);
		$this->load->view('sales_team_condition/sales_team_condition_list', $filter);
	}


	public function add_new()
	{
		if($this->pm->can_add)
		{
			$this->load->view('sales_team_condition/sales_team_condition_add');
		}
		else
		{
			$this->deny_page();
		}
	}


	public function add()
	{
		$sc = TRUE;

		$ds = json_decode($this->input->post('data'));

		if( ! empty($ds))
		{
			if($this->pm->can_add)
			{
				//--- check duplicate name
				if( ! $this->sales_team_condition_model->is_exists_name($ds->name))
				{
					$this->db->trans_begin();

					$arr = array(
						'name' => $ds->name,
						'sale_id' => $ds->sale_id,
						'dep_id' => $ds->dep_id,
						'team_id' => $ds->team_id,
						'date_add' => now(),
						'add_by' => $this->_user->id
					);

					$id = $this->sales_team_condition_model->add($arr);

					if($id)
					{
						if( ! empty($ds->approver))
						{
							foreach($ds->approver as $user_id)
							{
								$arr = array(
									'condition_id' => $id,
									'user_id' => $user_id
								);

								if( ! $this->sales_team_condition_model->add_approver($arr))
								{
									$sc = FALSE;
									$this->error = "Failed to make link to approver";
									break;
								}
							}
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = get_error_message('insert');
					}

					if($sc === TRUE)
					{
						$this->db->trans_commit();
					}
					else
					{
						$this->db->trans_rollback();
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Duplicated Condition Name. Please use another name";
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


	public function edit($id)
	{
		if($this->pm->can_edit)
		{
			$rs = $this->sales_team_condition_model->get($id);

			if( ! empty($rs))
			{
				$rs->approver = $this->sales_team_condition_model->get_condition_approver($id);

				$data['data'] = $rs;
				$this->load->view('sales_team_condition/sales_team_condition_edit', $data);
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
				//--- check duplication
				if( ! $this->sales_team_condition_model->is_exists_name($ds->name, $ds->id))
				{
					$this->db->trans_begin();

					$arr = array(
						'name' => $ds->name,
						'sale_id' => $ds->sale_id,
						'dep_id' => $ds->dep_id,
						'team_id' => $ds->team_id,
						'date_upd' => now(),
						'update_by' => $this->_user->id
					);

					if($this->sales_team_condition_model->update($ds->id, $arr))
					{
						if( $this->sales_team_condition_model->drop_condition_approver($ds->id))
						{
							if( ! empty($ds->approver))
							{
								foreach($ds->approver as $user_id)
								{
									$arr = array(
										'condition_id' => $ds->id,
										'user_id' => $user_id
									);

									if( ! $this->sales_team_condition_model->add_approver($arr))
									{
										$sc = FALSE;
										$this->error = "Failed to make link to approver";
										break;
									}
								}
							}
						}
						else
						{
							$sc = FALSE;
							$this->error = "Failed to delete previous approver link";
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "Update data failed";
					}

					if($sc === TRUE)
					{
						$this->db->trans_commit();
					}
					else
					{
						$this->db->trans_rollback();
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Duplicated Condition Name. Please use another name";
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


	public function get_member($id)
	{
		$members = $this->sales_team_condition_model->get_members($id);

		if(!empty($members))
		{
			$ds = array();

			foreach($members as $rs)
			{
				$arr = array(
					'uname' => $rs->uname,
					'emp_name' => $rs->emp_name,
					'role' => $rs->user_role
				);

				array_push($ds, $arr);
			}

			echo json_encode($ds);
		}
		else
		{
			echo "No member";
		}
	}


	public function delete()
	{
		$sc = TRUE;

		$id = $this->input->post('id');

		if($this->pm->can_delete)
		{
			if( ! empty($id))
			{
				$this->db->trans_begin();

				//--- delete approver
				if( ! $this->sales_team_condition_model->drop_condition_approver($id))
				{
					$sc = FALSE;
					$this->error = "Delete team approver failed";
				}

				//--- delete user conditon
				if($sc === TRUE && ! $this->sales_team_condition_model->drop_user_condition($id))
				{
					$sc = FALSE;
					$this->error = "Failed to unlink user";
				}

				if($sc === TRUE)
				{
					if(! $this->sales_team_condition_model->delete($id))
					{
						$sc = FALSE;
						$this->error = "Failed to delete condition";
					}
				}

				if($sc === TRUE)
				{
					$this->db->trans_commit();
				}
				else
				{
					$this->db->trans_rollback();
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "required";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = get_error_message('permission');
		}

		$this->_response($sc);
	}


  public function clear_filter()
	{
		$filter = array(
			'con_name',
			'con_sale_id',
			'con_dep_id',
			'con_team_id'
		);

		clear_filter($filter);
		echo 'done';
	}

}//--- end class


 ?>
