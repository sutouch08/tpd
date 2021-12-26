<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends PS_Controller{
	public $menu_code = 'USER';
	public $menu_group_code = 'ADMIN';
	public $title = 'Users';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'users';
  }



  public function index()
  {
		$this->load->helper('sale_team');

		$filter = array(
			'uname' => get_filter('uname', 'username', ''),
			'emp_name' => get_filter('emp_name', 'emp_name', ''),
			'sale_id' => get_filter('sale_id', 'sale_id', 'all'),
			'user_group' => get_filter('user_group', 'user_group', 'all'),
			'sale_team' => get_filter('sale_team', 'sale_team', 'all'),
			'role' => get_filter('role', 'role', 'all'),
			'status' => get_filter('status', 'user_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->user_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$rs = $this->user_model->get_list($filter, $perpage, $this->uri->segment($segment));

		if(!empty($rs))
		{
			foreach($rs as $ds)
			{
				$ds->team_name = user_team_label($ds->id);
			}
		}

		$filter['data'] = $rs;

		$this->pagination->initialize($init);

    $this->load->view('users/users_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Users - Add";
		if($this->pm->can_add)
		{
			$this->load->helper('sale_team');

			$ds['strong_pwd'] = getConfig('USE_STRONG_PWD');
			$ds['emp_list'] = $this->user_model->get_all_employee();
			$ds['sale_list'] = $this->user_model->get_all_slp();
			$ds['price_list'] = $this->user_model->get_all_price_list();

			$this->load->view('users/user_add', $ds);
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
			$uname = trim($this->input->post('uname'));
			$emp_name = trim($this->input->post('emp_name'));
			$sale_id = $this->input->post('sale_id');
			$sale_name = empty($sale_id) ? NULL : $this->input->post('sale_name');
			$ugroup_id = $this->input->post('ugroup');

			if($uname != "" && $uname !== NULL)
			{
				if(empty($emp_name))
				{
					$sc = FALSE;
					$this->error = "Missing required parameter: Employee";
				}

				if(empty($ugroup_id))
				{
					$sc = FALSE;
					$this->error = "Missing required parameter: User Group";
				}


				if($sc === TRUE)
				{
					if($this->user_model->is_exists_uname($uname))
					{
						$sc = FALSE;
						$this->error = "Username already exists";
					}
				}

				if($sc === TRUE)
				{
					$arr = array(
						'uname' => $uname,
						'pwd' => password_hash(trim($this->input->post('pwd')), PASSWORD_DEFAULT),
						'uid' => md5(uniqid()),
						'emp_name' => $emp_name,
						'emp_id' => get_null(trim($this->input->post('emp_id'))),
						'sale_id' => get_null($sale_id),
						'sale_name' => get_null($sale_name),
						'ugroup_id' => $ugroup_id,
						'role' => $this->input->post('role'),
						'status' => $this->input->post('status') == 1 ? 1 : 0,
						'bi_link' => $this->input->post('bi') == 1 ? 1 : 0,
						'date_add' => now(),
						'add_by' => $this->_user->id
					);

					$user_id = $this->user_model->add($arr);

					if($user_id !== FALSE)
					{
						//--- insert user_customer_group
						if(!empty($this->input->post('user_team')))
						{
							$user_team = json_decode($this->input->post('user_team'));

							if(!empty($user_team))
							{
								foreach($user_team as $rs)
								{
									$arr = array(
										'user_id' => $user_id,
										'team_id' => $rs->team_id,
										'user_role' => $rs->user_role
									);

									$this->user_model->add_user_team($arr);
								}
							}
						}

						if(!empty($this->input->post('price_list')))
						{
							$priceList = json_decode($this->input->post('price_list'));

							if(!empty($priceList))
							{
								foreach($priceList as $pl)
								{
									$arr = array(
										'user_id' => $user_id,
										'list_id' => $pl->id,
										'list_name' => $pl->name
									);

									$this->user_model->add_user_price_list($arr);
								}
							}
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "Insert user failed";
					}
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing Required Parameter : Username";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing permission";
		}

		$this->_response($sc);
	}


  public function is_exists_uname()
	{
		$sc = TRUE;
		$uname = trim($this->input->post('uname'));
		$old_uname = trim($this->input->post('old_uname'));

		if($this->user_model->is_exists_uname($uname, $old_uname))
		{
			$sc = FALSE;
			$this->error = "Username already exists";
		}

		$this->_response($sc);
	}




	public function edit($id)
	{
		$this->title = "Users - Edit";

		if($this->pm->can_edit)
		{
			$this->load->helper('sale_team');

			$rs = $this->user_model->get($id);

			if(!empty($rs))
			{
				$rs->user_team = $this->user_model->get_user_team($id);
				$user_price_list = $this->user_model->get_user_price_list($id);
				$pl = array();
				if(!empty($user_price_list))
				{
					foreach($user_price_list as $ps)
					{
						$pl[$ps->list_id] = $ps->list_id;
					}
				}

				$rs->priceList = $pl;
				$ds['user'] = $rs;
				$ds['strong_pwd'] = getConfig('USE_STRONG_PWD');
				$ds['emp_list'] = $this->user_model->get_all_employee();
				$ds['sale_list'] = $this->user_model->get_all_slp();
				$ds['price_list'] = $this->user_model->get_all_price_list();

				$this->load->view('users/user_edit', $ds);
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
			if($this->input->post('user_id'))
			{
				$id = $this->input->post('user_id');
				$emp_name = trim($this->input->post('emp_name'));
				$sale_id = $this->input->post('sale_id');
				$sale_name = empty($sale_id) ? NULL : $this->input->post('sale_name');
				$ugroup_id = $this->input->post('ugroup');


				if(empty($emp_name))
				{
					$sc = FALSE;
					$this->error = "Missing required parameter: Employee";
				}

				if(empty($ugroup_id))
				{
					$sc = FALSE;
					$this->error = "Missing required parameter: User Group";
				}

				if($sc === TRUE)
				{
					$arr = array(
						'emp_name' => $emp_name,
						'emp_id' => get_null(trim($this->input->post('emp_id'))),
						'sale_id' => get_null($sale_id),
						'sale_name' => get_null($sale_name),
						'ugroup_id' => $ugroup_id,
						'status' => $this->input->post('status') == 1 ? 1 : 0,
						'bi_link' => $this->input->post('bi') == 1 ? 1 : 0,
						'role' => $this->input->post('role'),
						'update_by' => $this->_user->id
					);

					if(!$this->user_model->update($id, $arr))
					{
						$sc = FALSE;
						$this->error = "Update failed";
					}
					else
					{
						//--- drop exists user_team
						$this->user_model->drop_user_team($id);

						//--- insert new user_team
						if(!empty($this->input->post('user_team')))
						{
							$user_team = json_decode($this->input->post('user_team'));

							if(!empty($user_team))
							{
								foreach($user_team as $rs)
								{
									$arr = array(
										'user_id' => $id,
										'team_id' => $rs->team_id,
										'user_role' => $rs->user_role
									);

									$this->user_model->add_user_team($arr);
								}
							}
						}

						$this->user_model->drop_user_price_list($id);

						if(!empty($this->input->post('price_list')))
						{
							$priceList = json_decode($this->input->post('price_list'));

							if(!empty($priceList))
							{
								foreach($priceList as $pl)
								{
									$arr = array(
										'user_id' => $id,
										'list_id' => $pl->id,
										'list_name' => $pl->name
									);

									$this->user_model->add_user_price_list($arr);
								}
							}
						}
					}
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
			
			$id = $this->input->post('id');

			$user = $this->user_model->get($id);

			if(!empty($user))
			{
				//--- check transection
				if($this->user_model->isApprover($user->id))
				{
					$sc = FALSE;
					$this->error = "Delete Failed : User is approver";
				}

				if($sc === TRUE && $this->user_model->has_order_transection($user->id))
				{
					$sc = FALSE;
					$this->error = "Delete Failed : User has sales order transections";
				}

				if($sc === TRUE)
				{
					if(! $this->user_model->delete($user->id))
					{
						$sc = FALSE;
						$this->error = "Delete Failed";
					}
				}

			}
			else
			{
				$sc = FALSE;
				$this->error = "Invalid User ID";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing Permission";
		}

		$this->_response($sc);
	}


	//---- Reset password by Administrator
	public function reset_password($id)
	{
		$pm = get_permission('PWDRESET');
		if($pm->can_add OR $pm->can_edit OR $pm->can_delete)
		{
			$this->title = 'Reset Password';
			$rs = $this->user_model->get($id);
			if(!empty($rs))
			{
				$data['data'] = $rs;
				$data['use_strong_pwd'] = getConfig('USE_STRONG_PWD');
				$this->load->view('users/user_reset_pwd', $data);
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



	public function change_password()
	{
		$sc = TRUE;

		$pm = get_permission('PWDRESET');

		if($pm->can_add OR $pm->can_edit OR $pm->can_delete)
		{
			if(!empty($this->input->post('id')) && !empty($this->input->post('pwd')))
			{
				$pwd = trim($this->input->post('pwd'));

				if(!empty($pwd))
				{
					$id = $this->input->post('id');
					$pwd = password_hash($pwd, PASSWORD_DEFAULT);

					$arr = array(
						'pwd' => $pwd
					);

					if( ! $this->user_model->update($id, $arr))
					{
						$sc = FALSE;
						$this->error = "Update Failed";
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Password Can not be empty";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing required parameter !";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing Permission";
		}

		$this->_response($sc);
	}



	public function get_sale_name($id)
	{
		$name = $this->user_model->get_saleman_name($id);
		return $name;
	}



	public function clear_filter()
	{

		$filter = array(
			'username',
			'emp_name',
			'sale_id',
			'sale_team',
			'user_group',
			'user_status',
			'role'
		);

		clear_filter($filter);
		echo 'done';
	}

}//--- end class


 ?>
