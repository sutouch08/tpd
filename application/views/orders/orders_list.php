<?php $this->load->view('include/header'); ?>

<style>
	.table > tr > td {
		padding:8px !important;
	}

  @media (min-width: 768px) {

    .fix-no {
      left: -1px;
      position: sticky;
    }

    .fix-date {
      left:49px;
      position: sticky;
    }

    .fix-code {
      left:149px;
      position: sticky;
    }

		.fix-cust {
			left:269px;
			position: sticky;
		}

		.fix-name {
			left:369px;
			position: sticky;
		}

    td[scope=row] {
      background-color: #f8f8f8;
      border: 0 !important;
      outline: solid 1px #dddddd;
			z-index: 2;
    }
  }
</style>

<?php $hide = $this->disSale ? "" : 'hide'; ?>

<div class="row h-row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5" style="padding-top:5px;">
		<h3 class="title"> <?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5 text-right">
		<button type="button" class="btn btn-white btn-success top-btn" onclick="goAdd()"><i class="fa fa-plus"></i> New Order</button>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row f-row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">เลขที่</label>
			<input type="text" class="form-control input-sm text-center search-box" name="WebCode" value="<?php echo $WebCode; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">ลูกค้า</label>
			<input type="text" class="form-control input-sm text-center search-box" name="CardCode" value="<?php echo $CardCode; ?>" placeholder="Code OR Name" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">SO No.</label>
			<input type="text" class="form-control input-sm text-center search-box" name="DocNum" value="<?php echo $DocNum; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">DO No.</label>
			<input type="text" class="form-control input-sm text-center search-box" name="DeliveryNo" value="<?php echo $DeliveryNo; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">Invoice No.</label>
			<input type="text" class="form-control input-sm text-center search-box" name="InvoiceNo" value="<?php echo $InvoiceNo; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">เลขที่ PO</label>
			<input type="text" class="form-control input-sm text-center search-box" name="PoNo" value="<?php echo $PoNo; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">User</label>
			<input type="text" class="form-control input-sm text-center search-box" name="UserName" value="<?php echo $UserName; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">ผู้อนุมัติ</label>
			<input type="text" class="form-control input-sm text-center search-box" name="Approver" value="<?php echo $Approver; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">การอนุมัติ</label>
			<select class="form-control input-sm" name="Approved" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="P" <?php echo is_selected('P', $Approved); ?>>รออนุมัติ</option>
				<option value="A" <?php echo is_selected('A', $Approved); ?>>อนุมัติ</option>
				<option value="AP" <?php echo is_selected('AP', $Approved); ?>>อนุมัติบางส่วน</option>
				<option value="R" <?php echo is_selected('R', $Approved); ?>>ไม่อนุมัติ</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">Team condition</label>
			<select class="form-control input-sm" name="con_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo select_sales_team_condition($con_id); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">สถานะ</label>
			<select class="form-control input-sm" name="Status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="0" <?php echo is_selected('0', $Status); ?>>Not Export</option>
				<option value="1" <?php echo is_selected('1', $Status); ?>>Pending</option>
				<option value="2" <?php echo is_selected('2', $Status); ?>>Success</option>
				<option value="3" <?php echo is_selected('3', $Status); ?>>Error</option>
				<option value="-1" <?php echo is_selected('-1', $Status); ?>>Cancelled</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">SO Status</label>
			<select class="form-control input-sm" name="SO_Status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="x" <?php echo is_selected("x", $SO_Status); ?>>No SO</option>
				<option value="O" <?php echo is_selected('O', $SO_Status); ?>>Open</option>
				<option value="C" <?php echo is_selected('C', $SO_Status); ?>>Closed</option>
				<option value="D" <?php echo is_selected('D', $SO_Status); ?>>Cancelled</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">DO Status</label>
			<select class="form-control input-sm" name="DO_Status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="x" <?php echo is_selected("x", $DO_Status); ?>>No DO</option>
				<option value="P" <?php echo is_selected('P', $DO_Status); ?>>Partial</option>
				<option value="F" <?php echo is_selected('F', $DO_Status); ?>>Full</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">Invoice Status</label>
			<select class="form-control input-sm" name="INV_Status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="x" <?php echo is_selected("x", $INV_Status); ?>>No Invoice</option>
				<option value="P" <?php echo is_selected('P', $INV_Status); ?>>Partial</option>
				<option value="F" <?php echo is_selected('F', $INV_Status); ?>>Full</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">Discount Sales</label>
			<select class="form-control input-sm" name="is_discount_sales" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="1" <?php echo is_selected("1", $is_discount_sales); ?>>มี</option>
				<option value="0" <?php echo is_selected('0', $is_discount_sales); ?>>ไม่มี</option>
			</select>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 padding-5">
			<label class="search-label">วันที่</label>
			<div class="input-daterange input-group width-100">
				<input type="text" class="form-control input-sm width-50 from-date text-center" id="fromDate" name="fromDate" value="<?php echo $fromDate; ?>" placeholder="From" readonly/>
				<input type="text" class="form-control input-sm width-50 to-date text-center" id="toDate" name="toDate" value="<?php echo $toDate; ?>" placeholder="To" readonly />
			</div>
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
		</div>
		<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
		</div>
	</div>

	<input type="hidden" name="search" value="1" />
</form>

<hr class="margin-top-15 padding-5">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 border-1 table-responsive" id="item-div" style="overflow: auto; padding-left:0px; padding-right:0px; padding-bottom:5px; margin-left:5px; margin-right:5px;">
		<table class="table table-bordered tableFixHead border-1" style="margin-left: -1px; margin-top: -1px; min-width:1990px;">
			<thead>
				<tr>
					<th class="fix-width-50 text-center fix-no fix-header">#</th>
					<th class="fix-width-100 fix-date fix-header">วันที่</th>
					<th class="fix-width-120 fix-code fix-header">เลขที่</th>
					<th class="fix-width-100 fix-cust fix-header">รหัสลูกค้า</th>
					<th class="fix-width-250 fix-name fix-header">ลูกค้า</th>
					<th class="fix-width-100">เลขที่ PO</th>
					<th class="fix-width-120 text-right">มูลค่า</th>
					<th class="fix-width-100 text-center">Preview</th>
					<th class="fix-width-100 text-center">สถานะ</th>
					<th class="fix-width-100 text-center">ผู้มีสิทธิ์อนุมัติ</th>
					<th class="fix-width-100 text-center">การอนุมัติ</th>
					<th class="fix-width-100">ผู้อนุมัติ</th>
					<th class="fix-width-100 text-center">SO No.</th>
					<th class="fix-width-100 text-center">SO Status</th>
					<th class="fix-width-100 text-center">DO Status</th>
					<th class="fix-width-100 text-center">Invoice Status</th>
					<th class="min-width-100">User</th>
					<th class="fix-width-100">STC.</th>
				</tr>
			</thead>
			<tbody>

			<?php if(!empty($data)) : ?>
				<?php $no = $this->uri->segment(3) + 1; ?>
				<?php foreach($data as $rs) : ?>
					<tr >
						<td class="middle text-center fix-no no" scope="row"><?php echo $no; ?></td>
						<td class="middle fix-date" scope="row"><?php echo thai_date($rs->DocDate, FALSE,'/'); ?></td>
						<td class="middle fix-code" scope="row"><?php echo $rs->code; ?></td>
						<td class="middle fix-cust" scope="row"><?php echo $rs->CardCode; ?></td>
						<td class="middle fix-name" scope="row"><?php echo $rs->CardName; ?></td>
						<td class="middle"><?php echo $rs->NumAtCard; ?></td>
						<td class="middle text-right"><?php echo number($rs->DocTotal, 2); ?></td>
						<td class="middle text-center"><span class="btn btn-mini btn-primary btn-block" onclick="preview('<?php echo $rs->code; ?>')">Preview</span></td>
						<td class="middle text-center">
							<?php if($rs->Status == 2) : ?>
								<button type="button" class="btn btn-mini btn-success btn-block" onclick="viewDetail('<?php echo $rs->code; ?>')">Success</button>
							<?php endif; ?>
							<?php if($rs->Status == 3) : ?>
								<button type="button" class="btn btn-mini btn-danger btn-block" onclick="viewDetail('<?php echo $rs->code; ?>')">Failed</button>
							<?php endif; ?>
							<?php if($rs->Status == 1) : ?>
								<button type="button" class="btn btn-mini btn-warning btn-block" onclick="viewDetail('<?php echo $rs->code; ?>')">Pending</button>
							<?php endif; ?>
							<?php if($rs->Status == 0) : ?>
								<span class="label label-lg label-danger btn-block">Not Export</span>
							<?php endif; ?>
							<?php if($rs->Status == -1) : ?>
								<span class="label label-lg label-danger btn-block">Canceled</span>
							<?php endif; ?>
						</td>
						<td class="middle text-center">
							<?php if($rs->must_approve == 1) : ?>
								<button class="btn btn-mini btn-primary" onclick="showAuthorize('<?php echo $rs->code; ?>')">Authorizer</button>
							<?php endif; ?>
						</td>
						<td class="middle text-center">
							<?php if($rs->must_approve == 1 && $rs->Approved == 'A') : ?>
								<?php if($rs->Approval_status === 'P') : ?>
									<span class="label label-lg label-success btn-block">อนุมัติบางส่วน</span>
								<?php else : ?>
									<span class="label label-lg label-success btn-block">อนุมัติ</span>
								<?php endif; ?>
							<?php elseif($rs->must_approve == 1 && $rs->Approved == 'P') : ?>
								<span class="label label-lg label-warning btn-block">รออนุมัติ</span>
							<?php elseif($rs->must_approve == 1 && $rs->Approved == 'R') : ?>
								<span class="label label-lg label-danger btn-block">ไม่อนุมัติ</span>
							<?php else : ?>
								<span class="label label-lg label-success btn-block">อนุมัติ</span>
							<?php endif; ?>
						</td>
						<td class="middle"><?php echo $rs->Approver; ?></td>
						<td class="middle text-center"><?php echo $rs->DocNum; ?></td>
						<td class="middle text-center">
							<?php if($rs->SO_Status == 'D') : ?>
								<span class="red">Cancelled</span>
							<?php else : ?>
							<?php echo $rs->SO_Status == 'C' ? 'Closed' : ($rs->SO_Status == 'O' ? 'Open' : ''); ?>
							<?php endif; ?>
						</td>
						<td class="middle text-center"><?php echo $rs->DO_Status == 'P' ? 'Partial' : ($rs->DO_Status == 'F' ? 'Full' : '') ; ?></td>
						<td class="middle text-center"><?php echo $rs->INV_Status == 'P' ? 'Partial' : ($rs->INV_Status == 'F' ? 'Full' : ''); ?></td>
						<td class="middle"><?php echo $rs->uname; ?></td>
						<td class="middle"><?php echo sales_team_condition_name($rs->Condition_id); ?></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="15" class="middle text-center">ไม่พบรายการ</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>



<!--  Add New Address Modal  --------->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%; min-width:400px; max-width:95vw; margin-left:auto; margin-right:auto;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;" >Preview Order</h4>
            </div>
            <div class="modal-body">
              <div class="row" id="result">

              </div>
            </div>

            <div class="modal-footer">
							<button type="button" class="btn btn-sm btn-success pull-left hide" id="btn-approve" onclick="doApprove()" disabled>อนุมัติ</button>
							<button type="button" class="btn btn-sm btn-danger pull-left hide" style="margin-left:25%;" id="btn-reject" onclick="doReject()" disabled>ไม่อนุมัติ</button>
							<button type="button" class="btn btn-sm btn-primary pull-left hide" id="btn-temp" onclick="sendToSAP()">Send To Temp</button>
              <button type="button" class="btn btn-sm btn-danger pull-right" id="btn-close" onClick="dismiss('previewModal')" >Close</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="OrderCode" value="">


<script id="preview-template" type="text/x-handlebarsTemplate">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<table class="table table-striped table-bordered border-1" style="margin-bottom:10px;">
	<tbody>
	<tr><td class="th">เลขที่ใบสั่งสินค้า</td><td>{{orderCode}}</td></tr>
	<tr><td class="th">User</td><td>{{user}}</td></tr>
	<tr><td class="th" class="width-30">รหัสลูกค้า</td><td>{{customerName}}</td></tr>
	<tr><td class="th">ที่อยู่ตามใบกำกับภาษี</td><td>{{billToCode}} | {{billToAddress}}</td></tr>
	<tr><td class="th">สถานที่ส่งของ</td><td>{{shipToCode}} | {{shipToAddress}}</td></tr>
	<tr><td class="th">สถานที่จัดส่งเพิ่มเติม</td><td>{{exShipTo}}</td></tr>
	<tr><td class="th">Currency</td><td>{{currency}} | Rate: {{currencyRate}} </td></tr>
	<tr><td class="th">วันที่สั่งสินค้า</td><td>{{docDate}}</td></tr>
	<tr><td class="th">วันที่จัดส่ง</td><td>{{dueDate}}</td></tr>
	<tr><td class="th">Promotion</th><td>{{promotionCode}}  |   {{promotionName}}</td></tr>
	<tr><td class="th">SO No.</td><td>{{SONO}}</td></tr>
	<tr><td class="th">เลขที่ PO</td><td>{{PoNo}}</td></tr>
	<tr><td class="th">บิลลงวันที่</td><td>{{billOption}}</td></tr>
	<tr><td class="th">ต้องการใบเสนอราคา</td><td>{{requiredSQ}}</td></tr>
	<tr><td class="th">Price List</td><td>{{PriceList}}</td></tr>
	<tr><td class="th">Payment Terms</td><td>{{termName}}</td></tr>
	<tr><td class="th">Remark สำหรับสื่อสารกับ Admin</td><td>{{remark}}</td></tr>
	</tbody>
</table>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" style="max-height:300px; overflow-y:auto;">
<table class="table table-bordered border-1" style="min-width:1580px;">
	<thead>
		<tr>
			<th class="fix-width-40 middle text-center">#</th>
			<th class="min-width-250 middle text-center">รายการสินค้า</th>
			<th class="fix-width-80 middle text-center">จำนวน</th>
			<th class="fix-width-80 middle text-center">แถม</th>
			<th class="fix-width-100 middle text-center">หน่วย</th>
			<th class="fix-width-100 middle text-center">ราคา/หน่วย (Term)</th>
			<th class="fix-width-100 middle text-center">ราคา(พิเศษ)/หน่วย</th>
			<th class="fix-width-80 middle text-center <?php echo $hide; ?>">Discount Sales</th>
			<th class="fix-width-100 middle text-center">มูลค่า</th>
			<th class="fix-width-100 middle text-center">หมายเหตุ</th>
			<th class="fix-width-100 middle text-center">จำนวนค้างส่ง</th>
			<th class="fix-width-100 middle text-center">เลขที่ DO</th>
			<th class="fix-width-100 middle text-center">เลขที่ Invoice</th>
			<th class="fix-width-100 middle text-center">วันที่ Invoice</th>
			<th class="fix-width-200 middle text-center">เหตุผลในการ Reject</th>
		</tr>
	</thead>
	<tbody>
		{{#each items}}
			{{#if @last}}
				<tr>
					<td colspan="7" class="middle text-right"><strong>ราคาสินค้า</strong></td>
					<td class="middle text-right">{{totalBefDi}}</td>
					<td colspan="6" class="middle text-right"></td>
				</tr>
				<tr>
					<td colspan="7" class="middle text-right"><strong>ส่วนลด [{{DiscPrcnt}} %]</strong></td>
					<td class="middle text-right">{{DiscSum}}</td>
					<td colspan="6" class="middle text-right"></td>
				</tr>
				<tr>
					<td colspan="7" class="middle text-right"><strong>ราคาสุทธิก่อนภาษีมูลค่าเพิ่ม</strong></td>
					<td class="middle text-right">{{totalBefVat}}</td>
					<td colspan="6" class="middle text-right"></td>
				</tr>
				<tr>
					<td colspan="7" class="middle text-right"><strong>ภาษีมูลค่าเพิ่ม</strong></td>
					<td class="middle text-right">{{totalVat}}</td>
					<td colspan="6" class="middle text-right"></td>
				</tr>
				<tr>
					<td colspan="7" class="middle text-right"><strong>รวมเงินสุทธิ</strong></td>
					<td class="middle text-right">{{docTotal}}</td>
					<td colspan="6" class="middle text-right"></td>
				</tr>
			{{else}}
				<tr>
					<td class="middle text-center">
						{{{checkbox}}}
					</td>
					<td class="middle">{{itemName}}</td>
					<td class="middle text-right">{{qty}}</td>
					<td class="middle text-right">{{free}}</td>
					<td class="middle text-center">{{uom}}</td>
					<td class="middle text-right">{{stdPrice}}</td>
					<td class="middle text-right">{{sellPrice}}</td>
					<td class="middle text-center <?php echo $hide; ?>">{{{dis}}}</td>
					<td class="middle text-right">{{amount}}</td>
					<td class="middle">{{lineText}}</td>
					<td class="middle text-right">{{openQty}}</td>
					<td class="middle text-center">{{{DoNo}}}</td>
					<td class="middle text-center">{{{InvNo}}}</td>
					<td class="middle text-center">{{{InvDate}}}</td>
					<td class="middle">{{{rejectbox}}}</td>
				</tr>
			{{/if}}
		{{/each}}
	</tbody>
</table>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	{{#if ApproveBy}} {{ApproveBy}} {{/if}}
</div>

</script>





<div class="modal fade" id="authorizer-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:400px;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;" ></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
									<table class="table table-striped table-bordered border-1">
										<thead>
											<tr>
												<th class="width-40">Username</th>
												<th class="width-60">Employee</th>
											</tr>
										</thead>
										<tbody id="authorizer-table">

										</tbody>
									</table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" onClick="dismiss('authorizer-modal')" >Close</button>
            </div>
        </div>
    </div>
</div>

<script id="authorizer-template" type="text/x-handlebarsTemplate">
{{#each this}}
	{{#if nodata}}
		<tr>
			<td colspan="2" class="text-center"> ---- No Authorizer ----</td>
		</tr>
		{{else}}
		<tr>
			<td>{{uname}}</td><td>{{emp_name}}
		</tr>
		{{/if}}
{{/each}}
</script>




<div class="modal fade" id="tempModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:800px;">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom:0px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="font-size: 24px; font-weight: bold; padding-bottom: 10px; color:#428bca; border-bottom:solid 2px #428bca">Sales Sales Order Temp Status</h4>
            </div>
            <div class="modal-body" style="padding-top:5px;">
            <div class="row">
              <div class="col-sm-12 col-xs-12" id="temp-table">

              </div>
            </div>

        </div>
    </div>
  </div>
</div>

<script id="temp-template" type="text/x-handlebarsTemplate">
  <input type="hidden" id="U_WEB_ORNO" value="{{U_WEB_ORNO}}"/>
  <table class="table table-bordered" style="margin-bottom:0px;">
    <tbody style="font-size:16px;">
      <tr><td class="width-30">Web Order</td><td class="width-70">{{U_WEB_ORNO}}</td></tr>
      <tr><td class="width-30">BP Code</td><td class="width-70">{{CardCode}}</td></tr>
      <tr><td>BP Name</td><td>{{CardName}}</td></tr>
      <tr><td>Date/Time To Temp</td><td>{{F_WebDate}}</td></tr>
      <tr><td>Date/Time To SAP</td><td>{{F_SapDate}}</td></tr>
      <tr><td>Status</td><td>{{F_Sap}}</td></tr>
      <tr><td>Message</td><td>{{Message}}</td></tr>
			<tr>
				<td colspan="2">
				{{#if del_btn}}
					<button type="button" class="btn btn-sm btn-danger" onClick="cancleOrder()" ><i class="fa fa-times"></i> Cancel Order</button>
					<button type="button" class="btn btn-sm btn-warning" onClick="removeTemp()" ><i class="fa fa-trash"></i> Delete Temp</button>
				{{/if}}

				<button type="button" class="btn btn-sm btn-default pull-right" onclick="closeModal('tempModal')">Close</button>
				</td>
			</tr>
    </tbody>
  </table>
</script>

<style>
	.table > tr > td {
		white-space: nowrap;
	}
</style>
<script>

	$(document).ready(function() {
		setTimeout(function() {
			window.location.reload();
		}, 1000*60*5); //--- reload every 5 minutes
	});
</script>

<script src="<?php echo base_url(); ?>scripts/orders/orders.js?v=<?php echo date('YmdH'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
