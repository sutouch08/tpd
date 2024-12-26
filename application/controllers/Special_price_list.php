<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Special_price_list extends PS_Controller
{
	public $menu_code = 'PDSPPL';
	public $menu_group_code = 'ADMIN';
	public $title = 'Special Price List';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'special_price_list';
		$this->load->model('special_price_list_model');
		$this->load->model('item_model');
  }


	public function index()
	{
		$filter = array(
			'name' => get_filter('name', 'sp_name', ''),
			'status' => get_filter('status', 'sp_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->special_price_list_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$result = $this->special_price_list_model->get_list($filter, $perpage, $this->uri->segment($segment));

		$filter['data'] = $result;

		$this->pagination->initialize($init);
		$this->load->view('special_price_list/special_price_list', $filter);
	}


	public function add_new()
	{
		if($this->pm->can_add)
		{
			$this->load->view('special_price_list/special_price_add');
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
				if( ! $this->special_price_list_model->is_exists_name($ds->name))
				{
					$arr = array(
						'name' => $ds->name,
						'active' => $ds->active,
						'date_add' => now(),
						'add_by' => $this->_user->id
					);

					$id = $this->special_price_list_model->add($arr);

					if( ! $id)
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

		$arr = array(
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'id' => $sc === TRUE ? $id : NULL
		);

		echo json_encode($arr);
	}


	public function edit($id)
	{
		if($this->pm->can_add OR $this->pm->can_edit)
		{
			$doc = $this->special_price_list_model->get($id);

			if( ! empty($doc))
			{
				$data['doc'] = $doc;
				$data['details'] = $this->special_price_list_model->get_details($id);
				$data['items'] = $this->item_model->get_item_list();
				$this->load->view('special_price_list/special_price_edit', $data);
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

		if($this->pm->can_add OR $this->pm->can_edit)
		{
			$ds = json_decode($this->input->post('data'));

			if( ! empty($ds))
			{
				$doc = $this->special_price_list_model->get($ds->id);

				if( ! empty($doc))
				{
					if( ! $this->special_price_list_model->is_exists_name($ds->name, $ds->id))
					{
						$arr = array(
							'name' => trim($ds->name),
							'active' => $ds->active,
							'date_upd' => now(),
							'update_by' => $this->_user->id
						);

						if( ! $this->special_price_list_model->update($ds->id, $arr))
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
					$this->error = get_error_message('notfound');
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


	public function add_item()
	{
		$sc = TRUE;

		if($this->pm->can_add OR $this->pm->can_eidt)
		{
			$price_list_id = $this->input->post('id');
			$itemCode = $this->input->post('itemCode');
			$itemName = $this->input->post('itemName');

			if( ! empty($itemCode))
			{
				$doc = $this->special_price_list_model->get($price_list_id);

				if( ! empty($doc))
				{
					if( ! $this->special_price_list_model->is_exists_item($itemCode, $price_list_id))
					{
						$item = $this->item_model->get_item($itemCode);

						$arr = array(
							'price_list_id' => $price_list_id,
							'ItemCode' => $item->code,
							'ItemName' => $item->name,
							'UomCode' => $item->uom,
							'isControl' => $item->U_BEX_Controll == 'Controlled' ? 'Y' : 'N',
							'add_by' => $this->_user->id,
							'date_add' => now()
						);

						$id = $this->special_price_list_model->add_item($arr);

						if( ! $id)
						{
							$sc = FALSE;
							$this->error = get_error_message('insert');
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = get_error_message('exists', $itemName);
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = get_error_message('notfound');
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

		$arr = array(
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'id' => $sc === TRUE ? $id : NULL
		);

		echo json_encode($arr);
	}



	public function edit_item($id)
	{
		if($this->pm->can_add OR $this->pm->can_edit)
		{
			$item = $this->special_price_list_model->get_item_by_id($id);

			if( ! empty($item))
			{
				$this->title = $this->title ." - ".$item->price_list_name;
				$data['item'] = $item;
				$data['details'] = $this->special_price_list_model->get_item_details($id);

				$this->load->view('special_price_list/special_price_item_edit', $data);
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


	public function save_item()
	{
		$sc = TRUE;

		if($this->pm->can_add OR $this->pm->can_edit)
		{
			$ds = json_decode($this->input->post('data'));

			if( ! empty($ds))
			{
				$item = $this->special_price_list_model->get_item_by_id($ds->id);

				if( ! empty($item))
				{
					$this->db->trans_begin();

					$arr = array(
						'active' => $ds->active == 1 ? 1 : 0,
						'update_by' => $this->_user->id,
						'date_upd' => now()
					);

					if( ! $this->special_price_list_model->update_item($ds->id, $arr))
					{
						$sc = FALSE;
						$this->error = get_error_message('update');
					}

					//--- delete previous rows
					if($sc === TRUE)
					{
						if( ! $this->special_price_list_model->delete_details($ds->id))
						{
							$sc = FALSE;
							$this->error = "Failed to delete rows";
						}
					}

					//---- add row
					if($sc === TRUE && ! empty($ds->rows))
					{
						foreach($ds->rows as $rs)
						{
							$arr = array(
								'step_id' => $item->id,
								'name' => $rs->name,
								'ItemCode' => $item->ItemCode,
								'ItemName' => $item->ItemName,
								'Qty' => $rs->Qty,
								'SellPrice' => $rs->SellPrice,
								'freeQty' => $rs->freeQty,
								'position' => $rs->position,
								'UomCode' => $item->UomCode,
								'update_by' => $this->_user->id
							);

							if( ! $this->special_price_list_model->add_item_detail($arr))
							{
								$sc = FALSE;
								$this->error = "Failed to update row";
							}

							if($sc === FALSE)
							{
								break;
							}
						} //-- end foreach
					} //-- end add row

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
					$this->error = get_error_message('notfound');
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


	public function view_item($id)
	{
		$item = $this->special_price_list_model->get_item_by_id($id);

		if( ! empty($item))
		{
			$this->title = $this->title ." - ".$item->price_list_name;
			$data['item'] = $item;
			$data['details'] = $this->special_price_list_model->get_item_details($id);

			$this->load->view('special_price_list/special_price_item_detail', $data);
		}
		else
		{
			$this->error_page();
		}
	}


	public function view_detail($id)
	{
		$doc = $this->special_price_list_model->get($id);

		if( ! empty($doc))
		{
			$data['doc'] = $doc;
			$data['details'] = $this->special_price_list_model->get_details($id);
			$this->load->view('special_price_list/special_price_view_detail', $data);
		}
		else
		{
			$this->error_page();
		}
	}


	public function delete_item()
	{
		$sc = TRUE;
		$id = $this->input->post('id');

		if( ! empty($id))
		{
			if($this->pm->can_delete)
			{
				$this->db->trans_begin();

				if( ! $this->special_price_list_model->delete_details($id))
				{
					$sc = FALSE;
					$this->error = "Failed to delete item steps";
				}

				if($sc === TRUE)
				{
					if( ! $this->special_price_list_model->delete_item($id))
					{
						$sc = FALSE;
						$this->error = "Failed to delete item";
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


	public function delete()
	{
		$sc = TRUE;
		$id = $this->input->post('id');

		if( ! empty($id))
		{
			if($this->pm->can_delete)
			{
				$this->db->trans_begin();

				$items = $this->special_price_list_model->get_details($id);

				if( ! empty($items))
				{
					foreach($items as $rs)
					{
						if($sc === FALSE)
						{
							break;
						}

						if( ! $this->special_price_list_model->delete_details($rs->id))
						{
							$sc = FALSE;
							$this->error = "Failed to delete item steps";
						}

						if($sc === TRUE)
						{
							if( ! $this->special_price_list_model->delete_item($rs->id))
							{
								$sc = FALSE;
								$this->error = "Failed to delete item";
							}
						}
					}
				}

				if($sc === TRUE)
				{
					if( ! $this->special_price_list_model->delete($id))
					{
						$sc = FALSE;
						$this->error = "Failed to delete Price List";
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
			'sp_name',
			'sp_status'
		);

		return clear_filter($filter);
	}

}//--- end class


 ?>
