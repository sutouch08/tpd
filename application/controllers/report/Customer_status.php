<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_status extends PS_Controller
{
	public $menu_code = 'CUST_STATUS';
	public $menu_group_code = 'REPORT';
	public $title = 'Report Customer Status';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'report/customer_status';		
		$this->load->model('report/customer_status_model');		
  }



	public function index()
  {		
    $this->load->view('report/customer_status');
  }


	public function get_report()
	{		
		$ds = [];
		$list = $this->customer_status_model->get_customer_list();

		if(!empty($list))
		{
			$no = 1;
			$today = date('Y-m-d');
			foreach($list as $rs)
			{
				$invoiceCount = $this->customer_status_model->count_customer_invoice($rs->CardCode);

				if($invoiceCount > 2)
				{
					$ds[] = (object) array(
						'no' => $no,
						'CardCode' => $rs->CardCode,
						'CardName' => $rs->CardName,
						'CreateDate' => thai_date($rs->CreateDate, FALSE),
						'Duration' => number(date_diff(date_create($rs->CreateDate), date_create($today))->days),
						'InvoiceCount' => number($invoiceCount)
					);

					$no++;					
				}
			}
		}
		else 
		{
			$ds[] = array('nodata' => 'nodata');
		}		

		echo json_encode($ds);

	} //--- end function




	public function do_export()
	{
		$token = $this->input->post('token');
		//---  Report title
		$report_title = 'รายชื่อลูกค้าไม่ประจำที่มีอายุเกิน 3 เดือนและเคยเปิด invoice แล้วอย่างน้อย 3 ใบ ณ วันที่ ' . date('d-m-Y');
		
		//--- load excel library
		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Customer Status Report');

		//--- set report title header
		$this->excel->getActiveSheet()->setCellValue('A1', $report_title);
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);		
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical('center');

		$row = 2;
		$this->excel->getActiveSheet()->setCellValue('A'.$row, '#');
		$this->excel->getActiveSheet()->setCellValue('B'.$row, 'Code');
		$this->excel->getActiveSheet()->setCellValue('C'.$row, 'Name');
		$this->excel->getActiveSheet()->setCellValue('D'.$row, 'Create Date');
		$this->excel->getActiveSheet()->setCellValue('E'.$row, 'Duration (days)');
		$this->excel->getActiveSheet()->setCellValue('F'.$row, 'Invoice Count');
		//---- กำหนดความกว้างของคอลัมภ์
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
		$row++;

		$list = $this->customer_status_model->get_customer_list();

		if( ! empty($list))
		{
			$no = 1;
			$today = date('Y-m-d');

			foreach($list as $rs)
			{
				$invoiceCount = $this->customer_status_model->count_customer_invoice($rs->CardCode);

				if($invoiceCount > 2)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.$row, $no);
					$this->excel->getActiveSheet()->setCellValue('B'.$row, $rs->CardCode);
					$this->excel->getActiveSheet()->setCellValue('C'.$row, $rs->CardName);
					$this->excel->getActiveSheet()->setCellValue('D'.$row, thai_date($rs->CreateDate, FALSE));
					$this->excel->getActiveSheet()->setCellValue('E'.$row, date_diff(date_create($rs->CreateDate), date_create($today))->days);
					$this->excel->getActiveSheet()->setCellValue('F'.$row, $invoiceCount);

					$row++;
					$no++;
				}
			}

			$this->excel->getActiveSheet()->getStyle('E3:F' . $row)->getNumberFormat()->setFormatCode("#,##0");
			$this->excel->getActiveSheet()->getStyle('A3:A' . $row)->getAlignment()->setHorizontal('center');		
			$this->excel->getActiveSheet()->getStyle('D3:F' . $row)->getAlignment()->setHorizontal('center');
			$this->excel->getActiveSheet()->getStyle('A2:F' . $row)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));
		}		

		setToken($token);

		$file_name = "Customer Status Report.xlsx";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); /// form excel 2007 XLSX
		header('Content-Disposition: attachment;filename="' . $file_name . '"');
		$writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$writer->save('php://output');

	}

} // end class


 ?>
