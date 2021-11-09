<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title">
      <?php echo $this->title; ?>
    </h4>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
    	<p class="pull-right top-p">
      <?php if($this->pm->can_add) : ?>
        <button type="button" class="btn btn-sm btn-success" onclick="goAdd()"><i class="fa fa-plus"></i> New Approver</button>
      <?php endif; ?>
      </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>Code</label>
    <input type="text" class="form-control input-sm text-center search-box" name="code" value="<?php echo $code; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>conditions</label>
    <select class="form-control input-sm" name="conditions" onchange="getSearch()">
			<option value="all">All</option>
			<?php echo select_conditions($conditions); ?>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Amount</label>
    <input type="text" class="form-control input-sm text-center search-box" name="amount" value="<?php echo $amount; ?>" />
  </div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
    <label>Type</label>
    <select class="form-control input-sm" name="order_type" onchange="getSearch()">
			<option value="all">All</option>
			<option value="local" <?php echo is_selected("local", $order_type); ?>>Local</option>
			<option value="oversea" <?php echo is_selected("oversea", $order_type); ?>>Overseas</option>
		</select>
  </div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
    <label>Price list</label>
    <select class="form-control input-sm" name="is_price_list" onchange="getSearch()">
			<option value="all">All</option>
			<option value="1" <?php echo is_selected("1", $is_price_list); ?>>Yes</option>
			<option value="0" <?php echo is_selected("0", $is_price_list); ?>>No</option>
		</select>
  </div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
    <label>Status</label>
    <select class="form-control input-sm" name="status" onchange="getSearch()">
			<option value="all">All</option>
			<option value="1" <?php echo is_selected('1', $status); ?>>Active</option>
			<option value="0" <?php echo is_selected('0', $status); ?>>Disactive</option>
		</select>
  </div>

  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block">Search</button>
  </div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()">Reset</button>
  </div>
</div>
<hr class="margin-top-15 padding-5">
</form>
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-hover border-1" style="min-width:300px;">
			<thead>
				<tr>
					<th class="width-5 middle text-center">#</th>
					<th class="width-10 middle">Code</th>
					<th class="width-20 middle">Condition</th>
					<th class="width-15 middle text-right">Amount</th>
					<th class="width-10 middle text-center">Type</th>
					<th class="width-8 middle text-center">Price List</th>
					<th class="width-8 middle text-center">Status</th>
					<th class="width-8 middle text-center">Authorizer</th>
					<th class="middle text-right">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($data)) : ?>
				<?php $no = $this->uri->segment(3) + 1; ?>
				<?php foreach($data as $rs) : ?>
					<tr>
						<td class="middle text-center no"><?php echo $no; ?></td>
						<td class="middle"><?php echo $rs->code; ?></td>
						<td class="middle"><?php echo $rs->conditions; //." ".get_condition_sign($rs->conditions); ?></td>
						<td class="middle text-right"><?php echo number($rs->amount,2); ?></td>
						<td class="middle text-center"><?php echo $rs->order_type == "oversea" ? "Overseas" : "Local"; ?></td>
						<td class="middle text-center"><?php echo is_active($rs->is_price_list); ?></td>
						<td class="middle text-center">
							<?php echo is_active($rs->status); ?>
						</td>
						<td class="middle text-center">
							<?php if(!empty($rs->approver)) : ?>
								<button type="button" class="btn btn-xs btn-info" onclick="showApprover(<?php echo $rs->id; ?>, '<?php echo $rs->code; ?>')">Authorizer</button>
							<?php endif; ?>
						</td>
						<td class="middle text-right">
							<?php if($this->pm->can_edit) : ?>
								<button type="button" class="btn btn-xs btn-warning" onclick="goEdit(<?php echo $rs->id; ?>)">
									<i class="fa fa-pencil"></i>
								</button>
								<button type="button" class="btn btn-xs btn-danger" onclick="getDelete(<?php echo $rs->id; ?>, '<?php echo $rs->code; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							<?php endif; ?>
						</td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="approver-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:400px;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;" ></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
									<table class="table table-striped border-1">
										<thead>
											<tr>
												<th class="width-40">Username</th>
												<th class="width-60">Employee</th>
											</tr>
										</thead>
										<tbody id="result">

										</tbody>
									</table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" onClick="dismiss('approver-modal')" >Close</button>
            </div>
        </div>
    </div>
</div>

<script id="approver-template" type="text/x-handlebarsTemplate">
{{#each this}}
	<tr>
		<td>{{uname}}</td><td>{{emp_name}}
	</tr>
{{/each}}
</script>

<script src="<?php echo base_url(); ?>scripts/approve_rule/approve_rule.js"></script>


<?php $this->load->view('include/footer'); ?>
