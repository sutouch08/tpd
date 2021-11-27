<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_promotion extends PS_Controller
{
	public $menu_code = 'ORDERPRO';
	public $menu_group_code = 'ORDER';
	public $title = 'Orders Promotion';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'order_promotion';
		$this->load->model('orders_model');
		$this->load->model('item_model');
		$this->load->model('customer_model');
    $this->load->model('promotion_model');
		$this->load->model('sale_team_model');
		$this->load->helper('orders');
		$this->load->helper('sale_team');

  }



	public function index()
  {
		$filter = array(
			'is_promotion' => 1,
			'WebCode' => get_filter('WebCode', 'so_WebCode', ''),
			'DocNum' => get_filter('DocNum', 'so_DocNum', ''),
			'DeliveryNo' => get_filter('DeliveryNo', 'so_DeliveryNo', ''),
			'InvoiceNo' => get_filter('InvoiceNo', 'so_InvoiceNo', ''),
			'PoNo' => get_filter('PoNo', 'so_PoNo', ''),
			'CardCode' => get_filter('CardCode', 'so_CardCode', ''),
			'UserName' => get_filter('UserName', 'so_UserName', ''),
			'Approved' => get_filter('Approved', 'so_Approved', 'all'),
			'Status' => get_filter('Status', 'so_Status', 'all'),
			'fromDate' => get_filter('fromDate', 'so_fromDate', ''),
			'toDate' => get_filter('toDate', 'so_toDate', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_filter('set_rows', 'rows', 20);
		//--- หาก user กำหนดการแสดงผลมามากเกินไป จำกัดไว้แค่ 300
		if($perpage > 300)
		{
			$perpage = get_filter('rows', 'rows', 300);
		}

		$segment = 3; //-- url segment
		$rows = $this->orders_model->count_rows($filter);

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $segment);

		$rs = $this->orders_model->get_list($filter, $perpage, $this->uri->segment($segment));

    $filter['data'] = $rs;

		$this->pagination->initialize($init);
    $this->load->view('order_promotion/order_promotion_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Orders Promotion - Add";
		$this->load->helper('promotion');

		if($this->pm->can_add)
		{
			$this->load->helper('currency');

			$ds['code'] = $this->get_new_code();

			if($this->isAdmin)
			{
				$ds['customer'] = $this->customer_model->get_all_user_customer_list("V");
			}
			else
			{
				$customer_group = array();
				$sale_person = array();

				$sale_team = $this->user_model->get_user_team($this->_user->id);

				if(!empty($sale_team))
				{
					foreach($sale_team as $rs)
					{
						$groups = $this->user_model->get_team_customer_group($rs->team_id);

						if(!empty($groups))
						{
							foreach($groups as $group)
							{
								if(!isset($customer_group[$group->group_id]))
								{
									$customer_group[$group->group_id] = $group->group_id;
								}
							}
						}

						if(!empty($rs->sale_person))
						{
							$sale_person[] = $rs->sale_person;
						}
					}
				}

				$ds['customer'] = $this->customer_model->get_user_customer_list($this->_user->sale_id, "V", $customer_group, $sale_person);
			}

			$ds['priceList'] = $this->user_model->get_user_price_list($this->_user->id);
			$this->load->view('order_promotion/order_promotion_add', $ds);
		}
		else
		{
			$this->deny_page();
		}
	}



	public function get_currency_rate($code)
	{
		$date = date('Y-m-d 00:00:00');
		//$date = "2021-10-31 00:00:00";
		$rate = $this->orders_model->get_currency_rate($code, $date);

		if(!empty($rate))
		{
			echo $rate;
		}
		else
		{
			echo "notfound";
		}
	}


	public function get_user_customer_list($type = 'V')
	{
		if($this->isAdmin)
		{
			$list = $this->customer_model->get_all_user_customer_list($type);
		}
		else
		{
			$customer_group = array();
			$sale_person = array();

			$sale_team = $this->user_model->get_user_team($this->_user->id);

			if(!empty($sale_team))
			{
				foreach($sale_team as $rs)
				{
					$groups = $this->user_model->get_team_customer_group($rs->team_id);

					if(!empty($groups))
					{
						foreach($groups as $group)
						{
							if(!isset($customer_group[$group->group_id]))
							{
								$customer_group[$group->group_id] = $group->group_id;
							}
						}
					}

					if(!empty($rs->sale_person))
					{
						$sale_person[] = $rs->sale_person;
					}
				}
			}

			$list = $this->customer_model->get_user_customer_list($this->_user->sale_id, $type, $customer_group, $sale_person);
		}

		if(!empty($list))
		{
			$ds = array();

			foreach($list as $rs)
			{
				$arr = array(
					'CardCode' => $rs->CardCode,
					'CardName' => $rs->CardName,
					'ECVatGroup' => $rs->ECVatGroup,
					'Rate' => $rs->Rate
				);

				array_push($ds, $arr);
			}

			echo json_encode($ds);
		}
		else
		{
			echo "Customer relate {$type} not found";
		}
	}


	public function get_address_ship_to_code()
	{
		$code = trim($this->input->get('CardCode'));
		$ds = array();

		if(!empty($code))
		{
			$addr = $this->customer_model->get_address_ship_to_code($code);

			if(!empty($addr))
			{
				$ds = array();
				foreach($addr as $adr)
				{
					$arr = array(
						'code' => get_empty_text($adr->Address)
					);

					array_push($ds, $arr);
				}
			}
			else
			{
				$arr = array(
					'code' => ""
				);

				array_push($ds, $arr);
			}
		}

		echo json_encode($ds);
	}



	public function get_address_ship_to()
	{
		$code = trim($this->input->get('CardCode'));
		$adr_code = trim($this->input->get('Address'));
		if(!empty($code))
		{
			$adr = $this->customer_model->get_address_ship_to($code, $adr_code);

			if(!empty($adr))
			{
				$arr = array(
					'code' => get_empty_text($adr->Address),
					'address' => get_empty_text($adr->Street),
					'street' => get_empty_text($adr->StreetNo),
					'sub_district' => get_empty_text($adr->Block),
					'district' => get_empty_text($adr->County),
					'province' => get_empty_text($adr->City),
					'country' => get_empty_text($adr->Country),
					'countryName' => get_empty_text($adr->countryName),
					'postcode' => get_empty_text($adr->ZipCode)
				);
			}
			else
			{
				$arr = array(
					'code' => "",
					'address' => "",
					'street' => "",
					'sub_district' => "",
					'district' => "",
					'province' => "",
					'country' => "",
					'countryName' => "",
					'postcode' => ""
				);
			}

			echo json_encode($arr);
		}
	}



	public function get_address_bill_to_code()
	{
		$code = trim($this->input->get('CardCode'));
		$ds = array();

		if(!empty($code))
		{
			$addr = $this->customer_model->get_address_bill_to_code($code);

			if(!empty($addr))
			{
				$ds = array();
				foreach($addr as $adr)
				{
					$arr = array(
						'code' => get_empty_text($adr->Address)
					);

					array_push($ds, $arr);
				}
			}
			else
			{
				$arr = array(
					'code' => ""
				);

				array_push($ds, $arr);
			}
		}

		echo json_encode($ds);
	}


	public function get_address_bill_to()
	{
		$code = trim($this->input->get('CardCode'));
		$adr_code = trim($this->input->get('Address'));
		if(!empty($code))
		{
			$adr = $this->customer_model->get_address_bill_to($code, $adr_code);

			if(!empty($adr))
			{
				$arr = array(
					'code' => get_empty_text($adr->Address),
					'address' => get_empty_text($adr->Street),
					'street' => get_empty_text($adr->StreetNo),
					'sub_district' => get_empty_text($adr->Block),
					'district' => get_empty_text($adr->County),
					'province' => get_empty_text($adr->City),
					'country' => get_empty_text($adr->Country),
					'countryName' => get_empty_text($adr->countryName),
					'postcode' => get_empty_text($adr->ZipCode)
				);
			}
			else
			{
				$arr = array(
					'code' => "",
					'address' => "",
					'street' => "",
					'sub_district' => "",
					'district' => "",
					'province' => "",
					'country' => "",
					'countryName' => "",
					'postcode' => ""
				);
			}

			echo json_encode($arr);
		}
	}




	public function get_promotion_item_code_and_name($promotion_id)
	{
		if($promotion_id == 'nopromotion')
		{
			echo json_encode(array('Please select promotion'));
		}
		else
		{
			$txt = trim($_REQUEST['term']);

			$qr  = "SELECT ItemCode, ItemName ";
			$qr .= "FROM promotion_detail ";
			$qr .= "WHERE promotion_id = {$promotion_id} ";

			if($txt != '*')
			{
				$qr .= "AND (ItemCode LIKE '%{$txt}%' OR ItemName LIKE '%{txt}%') ";
			}

			$qr .= "ORDER BY ItemName ASC ";
	    $qr .= "LIMIT 20";

			$rs = $this->db->query($qr);

			if($rs->num_rows() > 0)
	    {
	      foreach($rs->result() as $rd)
	      {
	        $sc[] = $rd->ItemName .' | '. $rd->ItemCode;
	      }
	    }
			else
			{
				$sc[] = "Not found";
			}

	    echo json_encode($sc);
		}
	}




	function get_item_data()
	{
		$sc = TRUE;
		$code = trim($this->input->get('code'));
		$promotion_id = $this->input->get('promotion_id');

		if(!empty($code))
		{
			if(!empty($promotion_id))
			{
				$this->load->model('stock_model');

				$pd = $this->promotion_model->get_detail_by_item($promotion_id, $code);

				if(!empty($pd))
				{
					$item = $this->item_model->get_item($code);

					if(!empty($item))
					{
						$stock = $this->stock_model->get_stock($item->code, $item->dfWhsCode);
						$whsQty = !empty($stock) ? round($stock->OnHand,2) : 0;
						$commitQty = !empty($stock) ? round($stock->IsCommited,2) : 0;
						$available = !empty($stock) ? $whsQty - $commitQty : 0;

						$arr = array(
							'uom' => $pd->UomCode,
							'qty' => $pd->Qty,
							'price' => round($pd->SellPrice,2),
							'amount' => round($pd->Qty * $pd->SellPrice, 2),
							'vatCode' => $item->VatCode,
							'vatRate' => $item->Rate,
							'inStock' => $whsQty,
							'commit' => $commitQty,
							'available' => $available,
							'whsCode' => $item->dfWhsCode
						);
					}
					else
					{
						$sc = FALSE;
						$this->error = "Invalid Item code : {$code}";
					}

				}
				else
				{
					$sc = FALSE;
					$this->error = "Invalid promotion or item";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Please Select promotion";
			}

		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter : ItemCode";
		}

		echo $sc === TRUE ? json_encode($arr) : $this->error;
	}



	public function add()
	{
		$sc = TRUE;
		$header = json_decode($this->input->post('header'));
		$details = json_decode($this->input->post('details'));

		if(!empty($header))
		{
			if(!empty($details))
			{
				$this->load->model('sale_person_model');

					$code = $this->get_new_code();
					$customer = $this->customer_model->get($header->CardCode);
					$group_id = $this->get_group_id($customer);
					$sale_person_id = $this->sale_person_model->get_id($customer->U_SALE_PERSON);
					$team_id = $this->user_model->get_team_id_by_customer_group($group_id, $sale_person_id);

					$groupNum = $customer->GroupNum;


					$arr = array(
						'code' => $code,
						'CardCode' => $customer->CardCode,
						'CardName' => $customer->CardName,
						'CardGroup' => $group_id,
						'CardTeam' => $team_id,
						'VatGroup' => $customer->ECVatGroup,
						'SlpCode' => get_null($customer->SlpCode),
						'GroupNum' => $groupNum,
						'Pricelist' => NULL,
						'NumAtCard' => get_null($header->NumAtCard),
						'DocCur' => $header->DocCur,
						'DocRate' => $header->DocRate,
						'DocTotal' => $header->docTotal,
						'VatSum' => $header->totalVat,
						'PayToCode' => $header->PayToCode,
						'ShipToCode' => $header->ShipToCode,
						'Address' => $header->BillTo,
						'Address2' => $header->ShipTo,
						'Address3' => get_null($header->exShipTo),
						'Approved' => 'A',
						'Approver' => 'System',
						'ApproveDate' => now(),
						'DocDate' => db_date($header->DocDate),
						'DocDueDate' => db_date($header->DocDueDate),
						'OwnerCode' => get_null($this->_user->emp_id),
						'must_approve' => 0,
						'Comments' => get_null($header->comments),
						'BillDate' => $header->billOption == 'Y' ? 1 : 0,
						'requireSQ' => $header->requireSQ == 'Y' ? 1 : 0,
						'date_add' => now(),
						'user_id' => $this->_user->id,
						'uname' => $this->_user->uname,
						'is_promotion' => 1,
						'promotion_id' => $header->promotion_id,
						'promotion_code' => $header->promotionCode
					);

					if($this->orders_model->add($arr))
					{
						$row = 1;
						foreach($details as $rs)
						{
							if($sc === FALSE)
							{
								break;
							}

							$sellPrice = $rs->SellPrice == "" ? $rs->stdPrice : $rs->SellPrice;

							$arr = array(
								'order_code' => $code,
								'LineNum' => $row,
								'ItemCode' => $rs->ItemCode,
								'ItemName' => $rs->ItemName,
								'Qty' => $rs->Qty,
								'freeQty' => $rs->freeQty,
								'UomCode' => $rs->UomCode,
								'stdPrice' => $rs->stdPrice,
								'SellPrice' => $sellPrice,
								'VatGroup' => $rs->VatGroup,
								'VatRate' => $rs->VatRate,
								'VatAmount' => $rs->VatAmount,
								'LineTotal' => $rs->lineTotal,
								'WhsCode' => get_null($rs->WhsCode),
								'lineText' => get_null($rs->lineText),
								'status' => 'A',
								'promotion_id' => $header->promotion_id,
								'promotion_code' => $header->promotionCode
							);

							$id = $this->orders_model->add_detail($arr);

							if($id != FALSE)
							{
								$row++;

								if($rs->freeQty > 0)
								{
									$arr = array(
										'order_code' => $code,
										'LineNum' => $row,
										'ItemCode' => $rs->ItemCode,
										'ItemName' => $rs->ItemName,
										'Qty' => $rs->freeQty,
										'UomCode' => $rs->UomCode,
										'stdPrice' => get_zero($rs->stdPrice),
										'SellPrice' => 0.00,
										'DiscPrcnt' => 100,
										'VatGroup' => $rs->VatGroup,
										'VatRate' => $rs->VatRate,
										'VatAmount' => 0.00,
										'LineTotal' => 0.00,
										'WhsCode' => get_null($rs->WhsCode),
										'lineText' => NULL,
										'free_item' => 1,
										'link_id' => $id,
										'status' => 'A',
										'promotion_id' => $header->promotion_id,
										'promotion_code' => $header->promotionCode
									);

									if($this->orders_model->add_detail($arr))
									{
										$row++;
									}
									else
									{
										$sc = FALSE;
										$this->error = "Insert Free Item failed : {{$rs->ItemCode}}";
									}
								}
							}
							else
							{
								$sc = FALSE;
								$this->error = "Insert Item failed : {{$rs->ItemCode}}";
							}
						} //--- end foreach details

						$this->doExport($code);

					}
					else
					{
						$sc = FALSE;
						$this->error = "Insert Order failed";
					}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Missing Details Data";
			}

		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing Header Data";
		}



		$this->_response($sc);
	}


	public function get_group_id($customer)
	{
		$max = 16;
		$group_id = 0;

		$i = 5;

		while($i <= $max) {
			$query = "QryGroup".$i;
			if($customer->$query == 'Y')
			{
				$group_id = $i;
			}

			if($group_id == $i)
			{
				break;
			}

			$i++;
		}

		return $group_id;
	}



	public function get_detail()
	{
		$sc = TRUE;

		$code = $this->input->get('code');

		if(!empty($code))
		{
			$doc = $this->orders_model->get($code);

			if(!empty($doc))
			{

				$ds = array(
					'orderCode' => $doc->code,
					'SONO' => $doc->DocNum,
					'DONO' => $doc->DeliveryNo,
					'INVNO' => $doc->InvoiceNo,
					'customerName' => $doc->CardCode.' | '.$doc->CardName,
					'billToCode' => $doc->PayToCode,
					'billToAddress' => $doc->Address,
					'shipToCode' => $doc->ShipToCode,
					'shipToAddress' => $doc->Address2,
					'exShipTo' => $doc->Address3,
					'currency' => $doc->DocCur,
					'currencyRate' => $doc->DocRate,
					'docDate' => thai_date($doc->DocDate, FALSE),
					'dueDate' => thai_date($doc->DocDueDate, FALSE),
					'PoNo' => $doc->NumAtCard,
					'billOption' => $doc->BillDate == 1 ? 'Y' : 'N',
					'requiredSQ' => $doc->requireSQ == 1 ? 'Y' : 'N',
					'remark' => $doc->Comments,
					'Approved' => $doc->Approved,
					'CanApprove' => FALSE,
					'promotionCode' => $doc->promotion_code,
					'promotionName' => "",
					'items' => array()
				);

				if($doc->Approved == 'A')
				{
					$ds['ApproveBy'] = "Approved by  {$doc->Approver}  @ ".thai_date($doc->ApproveDate, TRUE);
				}
				else if($doc->Approved == 'R')
				{
					$ds['ApproveBy'] = "Rejected By  {$doc->Approver}  @ ".thai_date($doc->ApproveDate, TRUE);
				}

				if($doc->promotion_id)
				{
					$pro = $this->promotion_model->get($doc->promotion_id);

					$ds['promotionName'] = $pro->name;
				}


				$details = $this->orders_model->get_details($code);

				if(!empty($details))
				{
					$no = 1;
					foreach($details as $rs)
					{
						if($rs->free_item == 0)
						{
							$open_qty = (!empty($doc->DocNum) ? $this->orders_model->get_open_qty($doc->code, $rs->ItemCode) : ($rs->freeQty + $rs->Qty));
							$DoNo = (!empty($doc->DocNum) ? $this->orders_model->get_do_no($doc->code, $rs->ItemCode) : NULL);
							$Inv = (!empty($doc->DocNum) ? $this->orders->model->get_inv_no_and_date($doc->code, $rs->ItemCode) : NULL);
							$InvNo = (empty($Inv) ? NULL : $Inv->DocNum);
							$InvDate = (empty($Inv) ? NULL : thai_date($Inv->DocDate, FALSE));

							$arr = array(
								'id' => $rs->id,
								'itemName' => $rs->ItemName,
								'qty' => number($rs->Qty, 2),
								'free' => number($rs->freeQty, 2),
								'uom' => $rs->UomCode,
								'stdPrice' => number($rs->stdPrice, 2),
								'sellPrice' => number($rs->SellPrice, 2),
								'amount' => number($rs->LineTotal, 2),
								'lineText' => $rs->LineText,
								'openQty' => $open_qty,
								'DoNo' => $DoNo,
								'InvNo' => $InvNo,
								'InvDate' => $InvDate,
								'checkbox' => get_checkbox($rs->id, $rs->status, FALSE, $no) //--- orders_helper
							);

							array_push($ds['items'], $arr);
						}

						$no++;
					}

					$arr = array(
						'totalAmount' => number($doc->DocTotal, 2)
					);

					array_push($ds['items'], $arr);
				}

			}
			else
			{
				$sc = FALSE;
				$this->error = "Invalid Order Code : {$code}";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter : Code";
		}

		echo $sc === TRUE ? json_encode($ds) : $this->error;
	}



	public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $M = date('m', strtotime($date));
    $prefix = getConfig('PREFIX_ORDER');
    $run_digit = getConfig('RUN_DIGIT_ORDER');
    $pre = $prefix .'-'.$Y.$M;
    $code = $this->orders_model->get_max_code($pre);
    if(! empty($code))
    {
      $run_no = mb_substr($code, ($run_digit*-1), NULL, 'UTF-8') + 1;
      $new_code = $prefix . '-' . $Y . $M . sprintf('%0'.$run_digit.'d', $run_no);
    }
    else
    {
      $new_code = $prefix . '-' . $Y . $M . sprintf('%0'.$run_digit.'d', '001');
    }

    return $new_code;
  }



	public function sendToSAP()
	{
		$sc = TRUE;

		$code = $this->input->post('code');

		if(!empty($code))
		{
			$rs = $this->doExport($code);

			if(!$rs)
			{
				$sc = FALSE;
			}
		}

		$this->_response($sc);
	}





	public function doExport($code)
	{
		$sc = TRUE;

		$order = $this->orders_model->get($code);

		if(!empty($order))
		{
			$details = $this->orders_model->get_details($code);

			if(!empty($details))
			{

				$is_exists = $this->orders_model->is_exists_sap_order($code);

				if(! $is_exists)
				{
					$temp = $this->orders_model->get_temp_order($code);

		      if(!empty($temp))
		      {
		        foreach($temp as $rows)
		        {
		          if(! $this->orders_model->drop_temp_exists_data($rows->DocEntry))
		          {
		            $sc = FALSE;
		            $this->error = "ลบรายการที่ค้างใน Temp ไม่สำเร็จ";
		          }
		        }
		      }


					if($sc === TRUE)
					{
						//--- header data
						$arr = array(
							'U_WEB_ORNO' => $order->code,
							'DocType' => 'I',
							'CANCELED' => 'N',
							'DocDate' => sap_date($order->DocDate, TRUE),
							'DocDueDate' => sap_date($order->DocDueDate, TRUE),
							'CardCode' => $order->CardCode,
							'CardName' => $order->CardName,
							'PayToCode' => $order->PayToCode,
							'Address' => $order->Address,
							'ShipToCode' => $order->ShipToCode,
							'Address2' => $order->Address2,
							'NumAtCard' => get_null($order->NumAtCard),
							'DocCur' => $order->DocCur,
							'DocRate' => $order->DocRate,
							'DocTotal' => $order->DocTotal,
							'VatSum' => $order->VatSum,
							'GroupNum' => $order->GroupNum,
							'SlpCode' => $order->SlpCode,
							'OwnerCode' => $order->OwnerCode,
							'U_BEX_TYPE' => $order->CardType,
							'U_SQ_BILLDATE' => $order->BillDate == 1 ? 'Y' : 'N',
							'U_SQ_REQ_SQ' => $order->requireSQ == 1 ? 'Y' : 'N',
							'U_SQ_Shipto' => $order->Address3,
							'U_BEX_WEBORDERREMARK' => $order->Comments,
							'F_Web' => 'A',
							'F_WebDate' => now()
						);

						//--- start transection
						$this->mc->trans_begin();

						$docEntry = $this->orders_model->add_temp_order($arr);

						if($docEntry)
						{
							$LineNum = 0;

							foreach($details as $rs)
							{
								if($sc === FALSE)
								{
									break;
								}

								if($rs->status == 'A')
								{
									$arr = array(
										'DocEntry' => $docEntry,
										'LineNum' => $LineNum,
										'ItemCode' => $rs->ItemCode,
										'Dscription' => $rs->ItemName,
										'Quantity' => $rs->Qty,
										'UnitMsr' => $rs->UomCode,
										'PriceBefDi' => remove_vat($rs->stdPrice, $rs->VatRate),
										'LineTotal' => remove_vat($rs->LineTotal, $rs->VatRate),
										'Currency' => $order->DocCur,
										'Rate' => $order->DocRate,
										'DiscPrcnt' => $rs->DiscPrcnt,
										'Price' => remove_vat($rs->SellPrice, $rs->VatRate),
										'VatPrcnt' => $rs->VatRate,
										'VatGroup' => $rs->VatGroup,
										'PriceAfVAT' => $rs->SellPrice,
										'GTotal' => $rs->LineTotal,
										'VatSum' => $rs->VatAmount,
										'WhsCode' => $rs->WhsCode,
										'OwnerCode' => $order->OwnerCode,
										'U_WEB_ORNO' => $order->code,
										'U_BEX_WEBREMARK' => $rs->LineText
									);

									if(!$this->orders_model->add_temp_detail($arr))
									{
										$sc = FALSE;
										$this->error = "Insert Temp detail failed : {{$rs->ItemCode}}";
									}

									$LineNum++;
								}
							}


							if($sc === TRUE)
							{
								$this->mc->trans_commit();
							}
							else
							{
								$this->mc->trans_rollback();
							}


							if($sc === TRUE)
							{
								$arr = array(
									'Status' => 1,
									'temp_date' => now()
								);

								$this->orders_model->update($code, $arr);
							}
						}
						else
						{
							$sc = FALSE;
							$this->error = "Insert Document Failed";
						}
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Document Already in SAP";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "No Items in Order";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Order not found : {$code}";
		}

		return $sc;
	}



	public function get_temp_data()
  {
    $code = $this->input->get('code'); //--- U_WEBORDER

    $data = $this->orders_model->get_temp_data($code);

    if(!empty($data))
    {
			//$btn = "<button type='button' class='btn btn-sm btn-danger' onClick='removeTemp()'' ><i class='fa fa-trash'></i> Delete Temp</button>";

			$status = 'Pending';

			if($data->F_Sap === NULL)
			{
				$status = "Pending";
			}
			else if($data->F_Sap === 'N')
			{
				$status = "Failed";
			}
			else if($data->F_Sap === 'Y')
			{
				$so = $this->orders_model->get_sap_order($code);

				if(!empty($so))
				{
					$status = "Success";
				}
				else
				{
					$status = "Not Found";
				}
			}


      $arr = array(
        'U_WEB_ORNO' => $data->U_WEB_ORNO,
        'CardCode' => $data->CardCode,
        'CardName' => $data->CardName,
        'F_WebDate' => thai_date($data->F_WebDate, TRUE),
        'F_SapDate' => empty($data->F_SapDate) ? '-' : thai_date($data->F_SapDate, TRUE),
        'F_Sap' => $status, //$data->F_Sap === 'Y' ? 'Success' : ($data->F_Sap === 'N' ? 'Failed' : 'Pending'),
        'Message' => empty($data->Message) ? '' : $data->Message,
				'del_btn' => ($status === "Pending" OR $status === "Failed") ? 'ok' : ''
      );

      echo json_encode($arr);
    }
    else
    {
      echo 'No data found';
    }
  }


	public function remove_temp()
  {
    $sc = TRUE;
    $code = $this->input->post('code');
    $temp = $this->orders_model->get_temp_status($code);

    if(empty($temp))
    {
      $sc = FALSE;
      $this->error = "Temp data not exists";
    }
    else if($temp->F_Sap === 'Y')
    {
      $sc = FALSE;
      $this->error = "Delete Failed : Temp Data already in SAP";
    }

    if($sc === TRUE)
    {
      if(! $this->orders_model->drop_temp_exists_data($temp->DocEntry))
      {
        $sc = FALSE;
        $this->error = "Delete Failed : Delete Temp Failed";
      }
			else
			{
				$arr = array(
					'Status' => 0,
					'DocNum' => NULL,
					'Message' => NULL,
					'sap_date' => NULL,
					'temp_date' => NULL
				);

				$this->orders_model->update($code, $arr);
			}
    }


    $this->_response($sc);
  }


  public function clear_filter()
	{
		$filter = array(
			'so_WebCode',
			'so_DocNum',
			'so_DeliveryNo',
			'so_InvoiceNo',
			'so_PoNo',
			'so_CardCode',
			'so_UserName',
			'so_Approved',
			'so_Status',
			'so_fromDate',
			'so_toDate'
		);

		clear_filter($filter);

		echo 'done';
	}

}//--- end class


 ?>
