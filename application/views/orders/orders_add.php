<?php $this->load->view('include/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.autosize.js"></script>
<style>
	.form-group {
		margin-bottom: 5px;
	}
	.input-icon > .ace-icon {
		z-index: 1;
	}
</style>
<?php $hide = $this->disSale ? "" : 'hide'; ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<h3 class="title">
			<?php echo $this->title; ?>
		</h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-default" onclick="leave()"><i class="fa fa-arrow-left"></i> &nbsp; Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="addForm" method="post" action="<?php echo $this->home; ?>/add">
<?php $this->load->view('orders/orders_add_header'); ?>
<?php $this->load->view('orders/orders_add_detail'); ?>
<?php $this->load->view('orders/orders_add_footer'); ?>

<input type="hidden" id="sale_id" value="<?php echo $this->_user->sale_id; ?>" />
<input type="hidden" id="default_currency" value="<?php echo getConfig('CURRENCY'); ?>" />
</form>

<!--  Add New Address Modal  --------->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90vw; max-width:95vw;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;" >ตรวจสอบข้อมูล</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="result">

                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-danger pull-left" onClick="dismiss('previewModal')" >Cancel</button>
								<button type="button" class="btn btn-md btn-success pull-right" id="btn-submit" disabled  onclick="saveAdd()">Submit</button>
            </div>
        </div>
    </div>
</div>


<script id="customer-template" type="text/x-handlebarsTemplate">
		<option value="">Select Customer ({{this.count}})</option>
		{{#each this.data}}
			<option value="{{CardCode}}"
				data-code="{{CardCode}}"
				data-name="{{CardName}}"
				data-groupnum="{{GroupNum}}"
				data-area="{{areaId}}"
				data-currency="{{Currency}}"
				data-sale="{{SlpCode}}"
				data-vat="{{ECVatGroup}}"
				data-rate="{{Rate}}"
				data-type="{{customerType}}"
				data-saleteam="{{saleTeam}}"
				data-saleperson="{{salePerson}}"
				data-department="{{department}}">
				{{CardCode}}  {{CardName}}
			</option>
		{{/each}}
</script>

<script id="ship-to-template" type="text/x-handlebarsTemplate">
		{{#each this}}
			<option value="{{code}}">{{code}}</option>
		{{/each}}
</script>

<script id="bill-to-template" type="text/x-handlebarsTemplate">
		{{#each this}}
			<option value="{{code}}">{{code}}</option>
		{{/each}}
</script>

<script id="preview-template" type="text/x-handlebarsTemplate">
	<table class="table table-bordered border-1" style="margin-bottom:10px;">
		<tr>
			<td class="width-30">
			รหัสลูกค้า
			<label class="pull-right">
			<input type="checkbox" class="ace check-list" onchange="toggleSubmit()">
			<span class="lbl"></span>
			</label>
			</td>
			<td>{{customerName}}</td>
		</tr>
		<tr><td>เลขที่ใบสั่งสินค้า</td><td>{{orderCode}}</td></tr>
		<tr><td>ที่อยู่ตามใบกำกับภาษี</td><td>{{billToCode}}  {{billToAddress}}</td></tr>
		<tr><td>สถานที่ส่งของ</td><td>{{shipToCode}}  {{shipToAddress}}</td></tr>
		<tr><td>สถานที่จัดส่งเพิ่มเติม</td><td>{{exShipTo}}</td></tr>
		<tr><td>Currency</td><td>{{currency}} | Rate: {{currencyRate}} </td></tr>
		<tr><td>วันที่สั่งสินค้า</td><td>{{docDate}}</td></tr>
		<tr><td>วันที่จัดส่ง</td><td>{{dueDate}}</td></tr>
		<tr><td>เลขที่ PO</td><td>{{PoNo}}</td></tr>
		<tr><td>บิลลงวันที่</td><td>{{billOption}}</td></tr>
		<tr><td>ต้องการใบเสนอราคา</td><td>{{requiredSQ}}</td></tr>
		<tr>
			<td>
				PriceList
				<label class="pull-right">
					<input type="checkbox" class="ace check-list" onchange="toggleSubmit()">
					<span class="lbl"></span>
				</label>
			</td>
			<td>{{listName}}</td>
		</tr>
		<tr>
			<td>
				Payment Terms
				<label class="pull-right">
					<input type="checkbox" class="ace check-list" onchange="toggleSubmit()">
					<span class="lbl"></span>
				</label>
			</td>
			<td>{{termName}}</td>
		</tr>
		<tr><td>Remark สำหรับสื่อสารกับ Admin</td><td>{{remark}}</td></tr>
	</table>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-0 border-1" style="max-height:300px; overflow:auto;">
		<table class="table table-bordered border-1" style="min-width:1000px; margin-bottom:0px;">
			<thead>
				<tr>
					<th class="fix-width-50 middle text-center">#</th>
					<th class="min-width-200 middle text-center">รายการสินค้า</th>
					<th class="fix-width-80 middle text-center">จำนวน</th>
					<th class="fix-width-80 middle text-center">แถม</th>
					<th class="fix-width-100 middle text-center">หน่วย</th>
					<th class="fix-width-100 middle text-center">ราคา/หน่วย (Term)</th>
					<th class="fix-width-100 middle text-center">ราคา(พิเศษ)/หน่วย</th>
					<th class="fix-width-50 middle text-center <?php echo $hide; ?>">Discount Sales</th>
					<th class="fix-width-100 middle text-center">มูลค่า</th>
					<th class="fix-width-100 middle text-center">หมายเหตุ</th>
					<th class="fix-width-50"></th>
				</tr>
			</thead>
			<tbody>
				{{#each items}}
					<tr>
						<td class="middle text-center">{{no}}</td>
						<td class="middle">{{itemName}}</td>
						<td class="middle text-right">{{qty}}</td>
						<td class="middle text-right">{{free}}</td>
						<td class="middle text-center">{{uom}}</td>
						<td class="middle text-right">{{stdPrice}}</td>
						<td class="middle text-right">{{sellPrice}}</td>
						<td class="middle text-center <?php echo $hide; ?>">{{{dis}}}</td>
						<td class="middle text-right">{{amount}}</td>
						<td class="middle">{{remark}}</td>
						<td class="middle text-center">
							<label><input type="checkbox" class="ace check-list" onchange="toggleSubmit()"><span class="lbl"></span></label>
						</td>
					</tr>
				{{/each}}
			</tbody>
		</table>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px; padding-right:7px;">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="col-lg-10 col-md-10 col-sm-9 col-xs-6 control-label no-padding-right">ราคาสินค้า</label>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 padding-5">
					<input type="text" class="form-control input-sm text-right" value="{{subTotal.totalBefDi}}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-10 col-md-10 col-sm-9 col-xs-6 control-label no-padding-right">ส่วนลด [{{subTotal.DiscPrcnt}} %]</label>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 padding-5">
					<input type="text" class="form-control input-sm text-right" value="{{subTotal.DiscSum}}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-10 col-md-10 col-sm-9 col-xs-6 control-label no-padding-right">ราคาสุทธิก่อนภาษีมูลค่าเพิ่ม</label>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 padding-5">
					<input type="text" class="form-control input-sm text-right" value="{{subTotal.totalBefVat}}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-10 col-md-10 col-sm-9 col-xs-6 control-label no-padding-right">ภาษีมูลค่าเพิ่ม</label>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 padding-5">
					<input type="text" class="form-control input-sm text-right" value="{{subTotal.totalVat}}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-10 col-md-10 col-sm-9 col-xs-6 control-label no-padding-right">รวมเงินสุทธิ</label>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 padding-5">
					<input type="text" class="form-control input-sm text-right" value="{{subTotal.docTotal}}" readonly>
				</div>
			</div>
		</div>
	</div>
</script>

<script src="<?php echo base_url(); ?>scripts/orders/orders.js?v=<?php echo date('YmdH'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/orders/orders_add.js?v=<?php echo date('YmdH'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/address.js"></script>




<?php $this->load->view('include/footer'); ?>
