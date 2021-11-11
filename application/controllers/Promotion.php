<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends PS_Controller
{
	public $menu_code = 'PROMOTION';
	public $menu_group_code = 'ADMIN';
	public $title = 'Promotion';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'promotion';
		$this->load->model('promotion_model');
		$this->load->model('item_model');
  }



  public function index()
  {
		$this->title = "Promotion - List";

		$filter = array(
			'code' => get_filter('code', 'pro_code', ''),
			'name' => get_filter('name', 'pro_name', ''),
			'start_date' => get_filter('start_date', 'start_date', ''),
			'end_date' => get_filter('end_date', 'end_date', ''),
			'status' => get_filter('status', 'pro_status', 'all')
		);

				//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->promotion_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$result = $this->promotion_model->get_list($filter, $perpage, $this->uri->segment($segment));

    $filter['data'] = $result;

		$this->pagination->initialize($init);
    $this->load->view('promotion/promotion_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Promotion - Add";

		if($this->pm->can_add)
		{
			$ds['code'] = $this->get_new_code();
			$ds['items'] = $this->item_model->get_item_list();

			$this->load->view('promotion/promotion_add', $ds);
		}
		else
		{
			$this->deny_page();
		}
	}


	public function add()
	{
		$sc = TRUE;
		$name = trim($this->input->post('name'));

		if(!empty($name))
		{
			if($this->pm->can_add)
			{
				//--- check duplicate name
				if(! $this->promotion_model->is_exists_name($name))
				{
					$arr = array(
						'name' => $name,
						'add_by' => $this->_user->uname
					);

					if(!$this->promotion_model->add($arr))
					{
						$sc = FALSE;
						$this->error = "Insert data failed";
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Duplicated Group name. Please user another name";
				}

			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing permission";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter : Group Name";
		}


		$this->_response($sc);
	}


	public function edit($id)
	{
		$this->title = "Users Group - Edit";

		if($this->pm->can_edit)
		{
			$rs = $this->promotion_model->get($id);

			if(!empty($rs))
			{
				$data['data'] = $rs;
				$this->load->view('user_group/user_group_edit', $data);
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




	public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $prefix = "PM";
    $run_digit = 4;
    $pre = $prefix .'-'.$Y;
    $code = $this->promotion_model->get_max_code($pre);
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
			'pro_code',
			'pro_name',
			'start_date',
			'end_date',
			'pro_status'
		);

		clear_filter($filter);
		echo 'done';
	}

}//--- end class


 ?>
