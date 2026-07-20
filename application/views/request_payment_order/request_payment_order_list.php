<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
		<h4 class="title"><?php echo $this->title; ?></h4>
	</div>
</div><!-- End Row -->
<hr class="padding-5" />
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">เลขที่</label>
			<input type="text" class="form-control input-sm text-center search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 padding-5">
			<label class="search-label">ลูกค้า</label>
			<input type="text" class="form-control input-sm text-center search-box" name="customer" value="<?php echo $customer; ?>" placeholder="Code OR Name" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 padding-5">
			<label class="search-label">Request By</label>
			<select class="form-control input-sm filter" name="request_by">
				<option value="all" <?php echo is_selected('all', $request_by); ?>>ทั้งหมด</option>
				<?php echo select_credit_approver($request_by); ?>
			</select>
		</div>		

		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
			<label class="search-label">สถานะ</label>
			<select class="form-control input-sm filter" name="status">
				<option value="all" <?php echo is_selected('all', $status); ?>>ทั้งหมด</option>
				<option value="O" <?php echo is_selected('O', $status); ?>>Pending</option>
				<option value="A" <?php echo is_selected('A', $status); ?>>Accepted</option>
				<option value="R" <?php echo is_selected('R', $status); ?>>Rejected</option>
				<option value="C" <?php echo is_selected('C', $status); ?>>Closed</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2-harf col-sm-2-harf col-xs-6 padding-5">
			<label class="search-label">วันที่</label>
			<div class="input-daterange input-group width-100">
				<input type="text" class="form-control input-sm width-50 from-date text-center" id="fromDate" name="from_date" value="<?php echo $from_date; ?>" placeholder="From" readonly />
				<input type="text" class="form-control input-sm width-50 to-date text-center" id="toDate" name="to_date" value="<?php echo $to_date; ?>" placeholder="To" readonly />
			</div>
		</div>

		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6 padding-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block">Search</button>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6 padding-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()">Reset</button>
		</div>
	</div>

	<input type="hidden" name="search" value="1" />
</form>

<hr class="margin-top-15 padding-5">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped tableNarrow border-1" style="min-width:960px;">
			<thead>
				<tr>
					<th class="fix-width-40 text-center">#</th>
					<th class="fix-width-100">Actions</th>
					<th class="fix-width-60">Status</th>
					<th class="fix-width-130">Request date</th>
					<th class="fix-width-100">WebOrder</th>
					<th class="fix-width-100">Request by</th>
					<th class="min-width-250">Customer</th>
					<th class="fix-width-80 text-right">Doc total</th>
					<th class="fix-width-80 text-center">Credit diff</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($data)) : ?>
					<?php $no = $this->uri->segment($this->segment) + 1; ?>
					<?php foreach ($data as $rs) : ?>			
					<?php $color = $rs->reply_status == 'N' ? 'background-color:#ffdede;' : 'background-color:#f1f8e9;'; ?>									
						<tr style="<?php echo $color; ?>">
							<td class="middle text-center"><?php echo $no; ?></td>
							<td class="middle">
								<button type="button" class="btn btn-minier btn-info" title="View Detail" onclick="viewDetail('<?php echo $rs->code; ?>')"><i class="fa fa-eye"></i></button>
								<button type="button" class="btn btn-minier btn-primary" title="Authorizer" onclick="showAuthorize('<?php echo $rs->code; ?>')"><i class="fa fa-user"></i></button>								
							</td>
							<td class="middle">
								<?php echo $rs->status == 'C' ? 'Closed' : ($rs->status == 'A' ? 'Accepted' : ($rs->status == 'R' ? 'Rejected' : 'Pending')); ?>
							</td>
							<td class="middle text-center"><?php echo thai_date($rs->date_add, TRUE); ?></td>
							<td class="middle"><?php echo $rs->code; ?></td>
							<td class="middle"><?php echo emp_name_by_id($rs->add_by); ?></td>
							<td class="middle"><?php echo $rs->CardCode; ?> | <?php echo $rs->CardName; ?></td>
							<td class="middle">
								<input type="text" class="form-control input-xs text-right text-label" value="<?php echo number($rs->DocTotal, 2); ?>" readonly>
							</td>
							<td class="middle">
								<input type="text" class="form-control input-xs text-right text-label" value="<?php echo number($rs->credit_diff, 2); ?>" readonly>
							</td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="9" class="middle text-center">ไม่พบรายการ</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>



<div class="modal fade" id="authorizer-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width:400px;">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title-site" style="margin-bottom:0px;"></h4>
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
				<button type="button" class="btn btn-sm btn-primary" onClick="dismiss('authorizer-modal')">Close</button>
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
				<td>{{uname}}</td>
				<td>{{emp_name}}</td>
			</tr>
		{{/if}}
	{{/each}}
</script>

<script>
	$('#user-id').select2();
	$(document).ready(function() {
	  setTimeout(function() {
	    window.location.reload();
	  }, 1000 * 60 * 5); //--- reload every 5 minutes
	});
</script>

<script src="<?php echo base_url(); ?>scripts/request_payment_order/request_payment_order.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>