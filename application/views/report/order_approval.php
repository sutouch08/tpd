<?php $this->load->view('include/header'); ?>
<div class="row hidden-print">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title"> <i class="fa fa-bar-chart"></i><?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
			<p class="pull-right top-p visible-lg">
        <button type="button" class="btn btn-sm btn-success" onclick="getReport()"><i class="fa fa-bar-chart"></i> รายงาน</button>
				<button type="button" class="btn btn-sm btn-primary" onclick="doExport()"><i class="fa fa-file-excel-o"></i> Export</button>
			</p>
	</div>
</div><!-- End Row -->
<hr class="hidden-print padding-5"/>
<form class="hidden-print" id="reportForm" method="post" action="<?php echo $this->home; ?>/do_export">
<div class="row">
	<div class="col-lg-2 col-md-2-harf col-sm-3 col-xs-6 padding-5 margin-bottom-10">
		<label>วันที่</label>
		<div class="input-daterange input-group">
			<input type="text" class="form-control input-sm width-50 from-date text-center" id="fromDate" name="fromDate" value="<?php echo date('01-m-Y'); ?>" placeholder="เริ่มต้น" readonly/>
			<input type="text" class="form-control input-sm width-50 to-date text-center" id="toDate" name="toDate" value="<?php echo date('t-m-Y'); ?>" placeholder="สิ้นสุด" readonly />
		</div>
	</div>

	<div class="col-lg-1-harf col-md-2 col-sm-3 col-xs-6 padding-5 margin-bottom-10" style="height:56px;">
		<label class="">ลูกค้า</label>
		<div class="btn-group width-100">
			<button type="button" class="btn btn-sm btn-primary width-50" id="btn-cus-all" onclick="toggleAllCustomer(1)">ทั้งหมด</button>
      <button type="button" class="btn btn-sm width-50" id="btn-cus-range" onclick="toggleAllCustomer(0)">เลือก</button>
		</div>
	</div>

	<div class="col-lg-1-harf col-md-2-harf col-sm-3 col-xs-6 padding-5 margin-bottom-10">
		<label>From</label>
		<input type="text" class="form-control input-sm" name="customerFrom" id="customerFrom" value="" placeholder="เริ่มต้น" disabled/>
	</div>
	<div class="col-lg-1-harf col-md-2-harf col-sm-3 col-xs-6 padding-5 margin-bottom-10">
		<label>TO</label>
		<input type="text" class="form-control input-sm" name="customerTo" id="customerTo" value="" placeholder="สิ้นสุด" disabled/>
	</div>

	<div class="col-lg-2 col-md-2-harf col-sm-3 col-xs-6 padding-5 margin-bottom-10" style="height:56px;">
		<label class="">กลุ่มลูกค้า</label>
		<div class="btn-group width-100">
			<button type="button" class="btn btn-sm btn-primary width-50" id="btn-cg-all" onclick="toggleAllCustomerGroup(1)">ทั้งหมด</button>
      <button type="button" class="btn btn-sm width-50" id="btn-cg-range" onclick="toggleAllCustomerGroup(0)">เลือก</button>
		</div>
	</div>

	<div class="col-lg-2 col-md-2-harf col-sm-3 col-xs-6 padding-5 margin-bottom-10" style="height:56px;">
		<label class="">ผู้อนุมัติ</label>
		<div class="btn-group width-100">
			<button type="button" class="btn btn-sm btn-primary width-50" id="btn-apv-all" onclick="toggleAllApprover(1)">ทั้งหมด</button>
      <button type="button" class="btn btn-sm width-50" id="btn-apv-range" onclick="toggleAllApprover(0)">เลือก</button>
		</div>
	</div>

	<div class="col-lg-1-harf col-md-2 col-sm-3 col-xs-6 padding-5 margin-bottom-10">
		<label>การอนุมัติ</label>
		<select class="form-control input-sm" name="approval_status" id="approval_status">
			<option value="all">ทั้งหมด</option>
			<option value="P">รออนุมัติ</option>
			<option value="A">อนุมัติ</option>
			<option value="AP">อนุมัติบางส่วน</option>
			<option value="R">ไม่อนุมัติ</option>
		</select>
	</div>
	<div class="col-md-1-harf col-sm-1-harf col-xs-3 padding-5 hidden-lg">
		<label class="display-block not-show">xx</label>
		<button type="button" class="btn btn-xs btn-success btn-block" onclick="getReport()"><i class="fa fa-bar-chart"></i> รายงาน</button>

	</div>
	<div class="col-md-1-harf col-sm-1-harf col-xs-3 padding-5 hidden-lg">
		<label class="display-block not-show">xx</label>

		<button type="button" class="btn btn-xs btn-primary btn-block" onclick="doExport()"><i class="fa fa-file-excel-o"></i> Export</button>
	</div>

</div> <!-- row -->
<hr/>

<input type="hidden" name="allCustomer" id="allCustomer" value="1">
<input type="hidden" name="allCustomerGroup" id="allCustomerGroup" value="1">
<input type="hidden" name="allApprover" id="allApprover" value="1">
<input type="hidden" name="token" id="token" value="<?php echo uniqid(); ?>">

<div class="modal fade" id="customer-group-modal" tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog' id='modal' style="width:300px;">
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='title' id='modal_title'>เลือกกลุ่มลูกค้า</h4>
            </div>
            <div class='modal-body' id='modal_body' style="padding:0px;">
							<div class="col-sm-12">
	              <label>
	                <input type="checkbox" class="chk-cg" id="cg-0" name="customerGroup[0]" value="0" style="margin-right:10px;" />
	              	00 ไม่ระบุกลุ่ม
	              </label>
	            </div>
        <?php if(!empty($groupList)) : ?>
          <?php foreach($groupList as $rs) : ?>
            <div class="col-sm-12">
              <label>
                <input type="checkbox" class="chk-cg" id="cg-<?php echo $rs->GroupCode; ?>" name="customerGroup[<?php echo $rs->GroupCode; ?>]" value="<?php echo $rs->GroupCode; ?>" style="margin-right:10px;" />
              	<?php echo $rs->GroupName; ?>
              </label>
            </div>
          <?php endforeach; ?>
        <?php endif;?>

        		<div class="divider" ></div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default btn-block' data-dismiss='modal'>ตกลง</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approver-modal" tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog' id='modal' style="width:300px;">
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='title' id='modal_title'>เลือกกลุ่มลูกค้า</h4>
            </div>
            <div class='modal-body' id='modal_body' style="padding:0px;">
							<div class="col-sm-12">
	              <label>
	                <input type="checkbox" class="chk-ap" id="ap-0" name="approver[0]" value="System" style="margin-right:10px;" />
	              	System
	              </label>
	            </div>
        <?php if(!empty($approverList)) : ?>
          <?php foreach($approverList as $rs) : ?>
            <div class="col-sm-12">
              <label>
                <input type="checkbox" class="chk-ap" id="ap-<?php echo $rs->user_id; ?>" name="approver[<?php echo $rs->user_id; ?>]" value="<?php echo $rs->uname; ?>" style="margin-right:10px;" />
              	<?php echo $rs->uname; ?> | <?php echo $rs->emp_name; ?>
              </label>
            </div>
          <?php endforeach; ?>
        <?php endif;?>

        		<div class="divider" ></div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default btn-block' data-dismiss='modal'>ตกลง</button>
            </div>
        </div>
    </div>
</div>
</form>

<div class="row">
	<div class="col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-bordered" style="min-width:1900px;">
			<thead>
				<tr>
					<th class="middle text-center" style="width:20px;">#</th>
					<th class="middle" style="width:100px;">วันที่</th>
					<th class="middle" style="width:110px;">เลขที่ออเดอร์</th>
					<th class="middle" style="width:100px;">Payment Term</th>
					<th class="middle" style="width:110px;">รหัสลูกค้า</th>
					<th class="middle" style="width:250px;">ชื่อลูกค้า</th>
					<th class="middle" style="width:250px;">รายการสินค้า</th>
					<th class="middle text-right" style="width:100px;">ราคา/หน่วย</th>
					<th class="middle text-right" style="width:100px;">ราคาพิเศษ/หน่วย</th>
					<th class="middle text-right" style="width:100px;">ส่วนลด</th>
					<th class="middle text-right" style="width:100px;">จำนวน</th>
					<th class="middle text-right" style="width:100px;">มูลค่า</th>
					<th class="middle" style="width:100px;">ผู้อนุมัติ</th>
					<th class="middle text-center" style="width:80px;">สถานะ</th>
					<th class="middle" style="width:100px;">เลขที่ PO</th>
					<th class="middle" style="width:100px;">เลขที่ SO</th>
					<th class="middle" style="width:100px;">เลขที่ DO</th>
					<th class="middle" style="width:100px;">เลขที่ Invoice</th>
					<th class="middle" style="width:100px;">วันที่ Invoice</th>
				</tr>
			</thead>
			<tbody id="result">

			</tbody>
		</table>
  </div>
</div>




<script id="report-template" type="text/x-handlebarsTemplate">
	{{#each this}}
		{{#if nodata}}
			<tr><td colspan="19" class="text-center">--- ไม่พบข้อมูลตามเงื่อนไขที่กำหนด ---</td></tr>
			{{else}}
				{{#if @last}}
					<tr>
						<td colspan="10" class="middle text-right">รวม</td>
						<td class="middle text-right">{{totalQty}}</td>
						<td class="middle text-right">{{totalAmount}}</td>
						<td colspan="7"></td>
					</tr>
				{{else}}
					<tr>
						<td class="middle text-center">{{no}}</td>
						<td class="middle">{{DocDate}}</td>
						<td class="middle">{{code}}</td>
						<td class="middle">{{paymentTerm}}</td>
						<td class="middle">{{CardCode}}</td>
						<td class="middle">{{CardName}}</td>
						<td class="middle">{{ItemName}}</td>
						<td class="middle text-right">{{stdPrice}}</td>
						<td class="middle text-right">{{SellPrice}}</td>
						<td class="middle text-right">{{DiscPrcnt}}</td>
						<td class="middle text-right">{{Qty}}</td>
						<td class="middle text-right">{{Amount}}</td>
						<td class="middle">{{Approver}}</td>
						<td class="middle">{{Approval_status}}</td>
						<td class="middle">{{PoNo}}</td>
						<td class="middle">{{SONo}}</td>
						<td class="middle">{{DoNo}}</td>
						<td class="middle">{{InvNo}}</td>
						<td class="middle">{{InvoiceDate}}</td>
					</tr>
				{{/if}}
			{{/if}}
	{{/each}}
</script>


<script src="<?php echo base_url(); ?>scripts/report/order_approval.js?v=<?php echo date('YmdH'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
