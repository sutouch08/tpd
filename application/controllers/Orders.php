<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends PS_Controller
{
	public $menu_code = 'ORDERS';
	public $menu_group_code = 'ORDER';
	public $title = 'Orders';
	public $disSale = FALSE;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'orders';
		$this->load->model('orders_model');
		$this->load->model('item_model');
		$this->load->model('customer_model');
		$this->load->model('sale_team_model');
		$this->load->model('customer_team_model');
		$this->load->helper('orders');
		$this->load->helper('sale_team');

		$this->disSale = getConfig('USE_DISCSALE') == 1 ? TRUE : FALSE;
  }



	public function index()
  {
		$filter = array(
			'is_promotion' => get_filter('is_promotion', 'so_is_promotion', 'all'),
			'WebCode' => get_filter('WebCode', 'so_WebCode', ''),
			'DocNum' => get_filter('DocNum', 'so_DocNum', ''),
			'DeliveryNo' => get_filter('DeliveryNo', 'so_DeliveryNo', ''),
			'InvoiceNo' => get_filter('InvoiceNo', 'so_InvoiceNo', ''),
			'PoNo' => get_filter('PoNo', 'so_PoNo', ''),
			'CardCode' => get_filter('CardCode', 'so_CardCode', ''),
			'UserName' => get_filter('UserName', 'so_UserName', ''),
			'Approver' => get_filter('Approver', 'so_Approver', ''),
			'Approved' => get_filter('Approved', 'so_Approved', 'all'),
			'Status' => get_filter('Status', 'doc_status', 'all'),
			'SO_Status' => get_filter('SO_Status', 'SO_Status', 'all'),
			'DO_Status' => get_filter('DO_Status', 'DO_Status', 'all'),
			'INV_Status' => get_filter('INV_Status', 'INV_Status', 'all'),
			'fromDate' => get_filter('fromDate', 'so_fromDate', ''),
			'toDate' => get_filter('toDate', 'so_toDate', ''),
			'is_discount_sales' => get_filter('is_discount_sales', 'is_discount_sales', 'all')
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
    $this->load->view('orders/orders_list', $filter);
  }



	public function add_new()
	{
		$this->title = "Order Add";

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

			$priceList = $this->user_model->get_user_price_list($this->_user->id);

			if(!empty($priceList))
			{
				foreach($priceList as $rs)
				{
					$rs->list_name = $this->orders_model->price_list_name($rs->list_id);
				}
			}

			$ds['priceList'] = $priceList;
			$this->load->view('orders/orders_add', $ds);
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
					'Currency' => $rs->Currency,
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




	public function get_item_code_and_name($priceList)
	{
		if($priceList == 'nopricelist')
		{
			echo json_encode(array("Please select payment term"));
		}
		else
		{
			$txt = trim($_REQUEST['term']);

			$qr  = "SELECT OITM.ItemCode, OITM.ItemName, ITM1.PriceList, ITM1.Price ";
			$qr .= "FROM OITM INNER JOIN ITM1 ON OITM.ItemCode = ITM1.ItemCode ";
			$qr .= "WHERE OITM.ItemType = 'I' ";
			$qr .= "AND OITM.SellItem = 'Y' ";
			$qr .= "AND OITM.validFor = 'Y' ";
			$qr .= "AND OITM.ItemCode LIKE 'FG%' ";
			$qr .= "AND ITM1.PriceList = {$priceList} ";
			$qr .= "AND ITM1.Price > 0 ";

			if($txt != '*')
			{
				$qr .= "AND (OITM.ItemName LIKE N'%{$this->ms->escape_str($txt)}%') ";
			}

			$qr .= "ORDER BY OITM.ItemName ASC ";
	    $qr .= "OFFSET 0 ROWS FETCH NEXT 20 ROWS ONLY";

			$rs = $this->ms->query($qr);

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
		$PriceList = $this->input->get('priceList');

		if(!empty($code))
		{
			if(!empty($PriceList))
			{
				$this->load->model('stock_model');

				$item = $this->item_model->get($code, $PriceList);

				if(!empty($item))
				{
					$stock = $this->stock_model->get_stock($item->code, $item->dfWhsCode);
					$whsQty = !empty($stock) ? round($stock->OnHand,2) : 0;
					$commitQty = !empty($stock) ? round($stock->IsCommited,2) : 0;
					$available = !empty($stock) ? $whsQty - $commitQty : 0;

					$arr = array(
						'uom' => $item->uom,
						'price' => round($item->price,2),
						'vatCode' => $item->VatCode,
						'vatRate' => $item->Rate,
						'inStock' => $whsQty,
						'commit' => $commitQty,
						'available' => $available,
						'whsCode' => $item->dfWhsCode,
						'is_sale_discount' => $item->U_TPD_DiscSale == 'Y' ? 'Y' : 'N'
					);
				}
				else
				{
					$sc = FALSE;
					$this->error = "ItemCode incorrect! : {$code}";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Please Select Payment term";
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
		$dfWhsCode = getConfig('DEFAULT_WAREHOUSE');

		if(!empty($header))
		{
			if(!empty($details))
			{
				$this->load->model('sale_person_model');

				$priceEdit = FALSE; //--- หากมีการแก้ไขราคา ตำกว่า stdPrice ตรงนี้จะเป็น TRUE;
				$code = $this->get_new_code();
				$customer = $this->customer_model->get($header->CardCode);
				$group_id = $this->get_group_id($customer);
				$sale_id = get_null($customer->SlpCode);
				$sale_person_id = $this->sale_person_model->get_id($customer->U_SALE_PERSON);
				$cust_team_id = $this->customer_team_model->get_id($customer->U_CUST_TEAM);
				$team_id = $this->user_model->get_team_id_by_customer_group($group_id, $sale_person_id, $cust_team_id);

					// เวลาส่งไปที่ SAP ให้ส่งค่าไปที่ ORDR.GroupNum
					// 1. OPLN.ListNum ลำดับ 11 ส่งไปที่ ORDR.GroupNum ลำดับ 3
					// 2. OPLN.ListNum ลำดับ 12 ส่งไปที่ ORDR.GroupNum ลำดับ 6
					// 3. OPLN.ListNum ลำดับ 13 ส่งไปที่ ORDR.GroupNum ลำดับ 7
					// 4. OPLN.ListNum ลำดับ 14 ไม่ต้องส่งค่า ORDR.GroupNum ให้อ่านตามที่ Default ไว้ใน SAP
					// 5. OPLN.ListNum ลำดับ 15 ไม่ต้องส่งค่า ORDR.GroupNum ให้อ่านตามที่ Default ไว้ใน SAP
				$PL = array(
					"11" => 3,
					"12" => 6,
					"13" => 7,
					"16" => -1,
					"17" => 5
				);

				$groupNum = isset($PL[$header->PriceList]) ? $PL[$header->PriceList] : $customer->GroupNum;


				$arr = array(
					'code' => $code,
					'CardCode' => $customer->CardCode,
					'CardName' => $customer->CardName,
					'CardGroup' => $group_id,
					'CardTeam' => $team_id,
					'VatGroup' => $customer->ECVatGroup,
					'SlpCode' => get_null($customer->SlpCode),
					'GroupNum' => $groupNum,
					'Pricelist' => $header->PriceList,
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
					'DocDate' => db_date($header->DocDate),
					'DocDueDate' => db_date($header->DocDueDate),
					'OwnerCode' => get_null($this->_user->emp_id),
					'Comments' => get_null($header->comments),
					'BillDate' => $header->billOption == 'Y' ? 1 : 0,
					'requireSQ' => $header->requireSQ == 'Y' ? 1 : 0,
					'is_discount_sales' => $this->disSale ? $header->is_discount_sales : 0,
					'date_add' => now(),
					'user_id' => $this->_user->id,
					'uname' => $this->_user->uname
				);

				$this->db->trans_begin();

					if($this->orders_model->add($arr))
					{
						$row = 1;
						foreach($details as $rs)
						{
							if($sc === FALSE)
							{
								break;
							}

							$item = $this->item_model->get($rs->ItemCode, $header->PriceList);

							if(! empty($item))
							{

								$sellPrice = $rs->SellPrice == "" ? $item->stdPrice : $rs->SellPrice;

								if(! empty($header->VatGroup))
								{
									if($header->VatRate > 0 && $sellPrice > 0)
									{
										$amount = $rs->Qty * $sellPrice;
										$rs->VatAmount = ($amount * $header->VatRate) / (100 + $header->VatRate);
									}
								}
								else
								{
									if($item->Rate > 0 && $sellPrice > 0)
									{
										$amount = $rs->Qty * $sellPrice;
										$rs->VatAmount = ($amount * $item->Rate) / (100 + $item->Rate);
									}
								}

								$arr = array(
									'order_code' => $code,
									'LineNum' => $row,
									'ItemCode' => $item->code,
									'ItemName' => $item->name,
									'Qty' => $rs->Qty,
									'freeQty' => $rs->freeQty,
									'UomCode' => $item->uom,
									'stdPrice' => $item->price,
									'SellPrice' => $sellPrice,
									'VatGroup' => empty($header->VatGroup) ? $item->VatCode : $header->VatGroup,
									'VatRate' => empty($header->VatGroup) ? $item->Rate : $header->VatRate,
									'VatAmount' => $rs->VatAmount,
									'LineTotal' => $rs->Qty * $sellPrice,
									'discount_sales' => $this->disSale ? $rs->discount_sales : 0,
									'WhsCode' => empty($rs->WhsCode) ? $dfWhsCode : $rs->WhsCode,
									'lineText' => get_null($rs->lineText)
								);

								if(!empty($rs->freeTxt))
								{
									$arr['FreeText'] = trim($rs->freeTxt);
								}

								if($sellPrice < $rs->stdPrice)
								{
									$priceEdit = TRUE;
								}

								$id = $this->orders_model->add_detail($arr);

								if($id != FALSE)
								{
									$row++;
									if($rs->freeQty > 0)
									{
										$arr = array(
											'order_code' => $code,
											'LineNum' => $row,
											'ItemCode' => $item->code,
											'ItemName' => $item->name,
											'Qty' => $rs->freeQty,
											'UomCode' => $item->uom,
											'stdPrice' => $item->price,
											'SellPrice' => 0.00,
											'DiscPrcnt' => 100,
											'VatGroup' => empty($header->VatGroup) ? $item->VatCode : $header->VatGroup,
											'VatRate' => empty($header->VatGroup) ? $item->Rate : $header->VatRate,
											'VatAmount' => 0.00,
											'LineTotal' => 0.00,
											'discount_sales' => $this->disSale ? $rs->discount_sales : 0,
											'WhsCode' => empty($rs->WhsCode) ? $dfWhsCode : $rs->WhsCode,
											'lineText' => NULL,
											'free_item' => 1,
											'link_id' => $id
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
							}

						} //--- end foreach details


						//---- check order approval exception by rule
						if(! $this->must_approve($team_id, $header->docTotal, $priceEdit))
						{
							$arr = array(
								"must_approve" => 0,
								'priceEdit' => $priceEdit === TRUE ? 1 : 0,
								'Approved' => 'A',
								'Approver' => 'System',
								'ApproveDate' => now()
							);

							$this->orders_model->update($code, $arr);
							$this->orders_model->approve_details($code);

							$this->doExport($code);
						}
						else
						{

							$arr = array(
								"priceEdit" => $priceEdit === TRUE ? 1 : 0
							);

							$this->orders_model->update($code, $arr);
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "Insert Order failed";
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


	public function test($amount)
	{
		$this->load->model('approve_rule_model');
		$team_id = 1;
		$priceEdit = FALSE;
		$sc = $this->approve_rule_model->get_exception_rule($team_id, $amount, $priceEdit);

		if(!empty($sc))
		{
			print_r($sc);
		}
		else
		{
			echo "Must Approve";
		}
	}


	public function must_approve($team_id, $docTotal, $pricelist = FALSE)
	{
		$this->load->model('approve_rule_model');

		$rule = empty($team_id) ? NULL : $this->approve_rule_model->get_exception_rule($team_id, $docTotal, $pricelist);
		//---- order must approve by default
		//--- if exception rule exists order no need to approve
		if(!empty($rule))
		{
			return FALSE;
		}

		return TRUE;
	}



	public function check_approve()
	{
		$this->load->model('sale_person_model');

		$message = "pass";
		$docTotal = $this->input->get('docTotal');
		$priceEdit = $this->input->get('priceEdit') == 0 ? FALSE : TRUE;
		$customer_code = $this->input->get('customerCode');
		$customer = $this->customer_model->get($customer_code);
		$group_id = $this->get_group_id($customer);
		$sale_person_id = $this->sale_person_model->get_id($customer->U_SALE_PERSON);
		$cust_team_id = $this->customer_team_model->get_id($customer->U_CUST_TEAM);

		$team_id = $this->user_model->get_team_id_by_customer_group($group_id, $sale_person_id, $cust_team_id);

		$this->load->model('approve_rule_model');

		$rule = empty($team_id) ? NULL : $this->approve_rule_model->get_exception_rule($team_id, $docTotal, $priceEdit);

		if(empty($rule))
		{
			if($priceEdit)
			{
				$message = "ในกรณีราคาต่ำกว่า Price list ต้องผ่านการอนุมัติ";
			}
			else if(empty($team_id))
			{
				$message = "ในกรณีเป็นลูกค้าต่างประเทศ ต้องผ่านการอนุมัติ";
			}
			else
			{
				$message = "ในกรณีจำนวนเงินสูงกว่าที่กำหนดต้องผ่านการอนุมัติ";
			}
		}

		echo $message;
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
				$can_approve = $this->can_approve($doc);

				$ds = array(
					'orderCode' => $doc->code,
					'user' => $doc->uname,
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
					'PriceList' => empty($doc->PriceList) ? "-" : $this->orders_model->price_list_name($doc->PriceList),
					'billOption' => $doc->BillDate == 1 ? 'Y' : 'N',
					'requiredSQ' => $doc->requireSQ == 1 ? 'Y' : 'N',
					'remark' => $doc->Comments,
					'Approved' => $doc->Approved,
					'promotionCode' => $doc->promotion_code,
					'CanApprove' => $can_approve,
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
					$this->load->model('promotion_model');
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
							$Inv = (!empty($doc->DocNum) ? $this->orders_model->get_inv_no_and_date($doc->code, $rs->ItemCode) : NULL);
							$InvNo = NULL;
							$InvDate = NULL;
							if(!empty($Inv))
							{
								$ra = array();
								$rb = array();
								$i = 1;
								$e = 1;
								foreach($Inv as $re)
								{
									if(! isset($ra[$re->DocNum]))
									{
										$ra[$re->DocNum] = $re->DocNum;
										$InvNo .= $i == 1 ? $re->DocNum : "<br/>".$re->DocNum;
										$i++;

										$Y = date('Y', strtotime($re->DocDate));
										$m = date('m', strtotime($re->DocDate));
										$d = date('d', strtotime($re->DocDate));

										$date = $Y.$m.$d;

										if(!isset($rb[$date]))
										{
											$rb[$date] = $re->DocDate;
											$InvDate .= $e == 1 ? thai_date($re->DocDate, FALSE) : "<br/>".thai_date($re->DocDate, FALSE);
											$e++;
										}
									}
								}
							}

							$arr = array(
								'id' => $rs->id,
								'itemName' => $rs->ItemName,
								'qty' => number($rs->Qty, 2),
								'free' => number($rs->freeQty, 2),
								'uom' => $rs->UomCode,
								'stdPrice' => number($rs->stdPrice, 4),
								'sellPrice' => number($rs->SellPrice, 4),
								'amount' => number($rs->LineTotal, 4),
								'dis' => $rs->discount_sales == 1 ? '<i class="fa fa-check blue"></i>' : '',
								'lineText' => $rs->LineText,
								'openQty' => round($open_qty, 2),
								'DoNo' => $DoNo,
								'InvNo' => $InvNo,
								'InvDate' => empty($InvNo) ? NULL : $InvDate,
								'checkbox' => get_checkbox($rs->id, $rs->status, $can_approve, $no), //--- orders_helper
								'rejectbox' => ($rs->status == 'P' ? get_rejectbox($rs->id, $rs->status, $can_approve, $no) : $rs->reject_text)
							);

							array_push($ds['items'], $arr);

							$no++;
						}


					}

					$arr = array(
						'totalAmount' => number($doc->DocTotal, 4)
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




	public function can_approve($order)
	{
		if($this->isGM)
		{
			return TRUE;
		}

		$this->load->model('approve_rule_model');
		$this->load->model('approver_model');

		//---- อยู่ในรายชื่อที่มีสิทธิ์ อนุมัติมั้ย
		$approver = $this->sale_team_model->get_approver($order->CardTeam, $this->_user->id);

		if(!empty($approver))
		{
			if($approver->amount >= $order->DocTotal)
			{
				return  TRUE;
			}
		}

		return FALSE;
	}





	public function do_approve()
	{
		$sc = TRUE;
		$code = $this->input->post('code');

		if(!empty($code))
		{
			$order = $this->orders_model->get($code);
			$approval_status = 'F'; //--- F = full, P = partial

			if(!empty($order))
			{
				if($order->must_approve == 1 && $order->Approved == 'P')
				{

					$items = json_decode($this->input->post('items'));

					if(!empty($items))
					{
						if($this->can_approve($order))
						{
							foreach($items as $item)
							{
								if($item->status == "A")
								{
									$this->orders_model->approve_detail($item->id);
								}

								if($item->status == "R")
								{
									$this->orders_model->reject_detail($item->id, get_null($item->reject_text));
									$approval_status = 'P';
								}
							}

							//--- approve order
							$arr = array(
								'Approved' => 'A',
								'Approver' => $this->_user->uname,
								'ApproveDate' => now(),
								'Approval_status' => $approval_status
							);

							if($this->orders_model->update($code, $arr))
							{
								$this->doExport($code);
							}

						}
						else
						{
							$sc = FALSE;
							$this->error = "Missing Approve Permission";
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "No items found";
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Invalid Order Status";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Invalid order code : {$code}";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter: code";
		}

		$this->_response($sc);
	}



	public function do_reject()
	{
		$sc = TRUE;
		$code = $this->input->post('code');

		if(!empty($code))
		{
			$order = $this->orders_model->get($code);

			if(!empty($order))
			{
				if($order->must_approve == 1 && $order->Approved == 'P')
				{

					if($this->can_approve($order))
					{
						$this->orders_model->reject_details($code);

						//--- approve order
						$arr = array(
							'Approved' => 'R',
							'Approver' => $this->_user->uname,
							'ApproveDate' => now(),
							'Approval_status' => 'R'
						);

						$this->orders_model->update($code, $arr);

						$items = json_decode($this->input->post('items'));
						if(!empty($items))
						{
							foreach($items as $item)
							{
								$reject_text = get_null($item->reject_text);
								if(!empty($reject_text))
								{
									$arr = array('reject_text' => $item->reject_text);
									$this->orders_model->update_detail($item->id, $arr);
								}
							}
						}
					}
					else
					{
						$sc = FALSE;
						$this->error = "Missing Reject Permission";
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Invalid Order Status";
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Invalid order code : {$code}";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter: code";
		}

		$this->_response($sc);
	}



	public function get_authorizer()
	{
		$sc = TRUE;
		$ds = array();

		$code = $this->input->get('code');

		if(!empty($code))
		{
			$doc = $this->orders_model->get($code);
			$team_id = $doc->CardTeam;

			if(!empty($doc))
			{
				$approver = $this->sale_team_model->get_team_approver($team_id);

				if(!empty($approver))
				{
					foreach($approver as $rs)
					{
						if($rs->amount >= $doc->DocTotal)
						{
							$arr = array(
								'uname' => $rs->uname,
								'emp_name' => $rs->emp_name
							);

							array_push($ds, $arr);
						}
					}

					if(empty($ds))
					{
						$gm = $this->user_model->get_gm();

						if(!empty($gm))
						{
							foreach($gm as $g)
							{
								$arr = array(
									'uname' => $g->uname,
									'emp_name' => $g->emp_name
								);

								array_push($ds, $arr);
							}
						}
					}
				}
				else
				{
					$arr = array('nodata' => 'nodata');
					array_push($ds, $arr);
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



	public function get_sale_name_by_customer()
	{
		$cardCode = trim($this->input->get('CardCode'));

		if(!empty($cardCode))
		{
			$saleName = $this->customer_model->get_sale_name_by_customer($cardCode);

			echo $saleName;
		}
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




	public function doExport($code)
	{
		$sc = TRUE;

		$this->load->library('export');

		if(!$this->export->export_order($code))
		{
			$sc = FALSE;
			$this->error = $this->export->error;
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


	public function cancle_order()
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
					'Status' => -1,
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
			'so_Approver',
			'so_Approved',
			'doc_status',
			'SO_Status',
			'DO_Status',
			'INV_Status',
			'so_fromDate',
			'so_toDate',
			'so_is_promotion',
			'is_discount_sales'
		);

		clear_filter($filter);

		echo 'done';
	}

}//--- end class


 ?>
