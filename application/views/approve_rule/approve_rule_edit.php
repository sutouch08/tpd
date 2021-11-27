<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title"><i class="fa fa-user-circle"></i>&nbsp; <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->

<?php $no = 1; ?>

<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Code</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<input type="text" name="code" id="code" class="width-100" value="<?php echo $data->code; ?>" disabled />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="code-error"></div>
  </div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Condition</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="conditions" id="conditions">
				<option value="">Please Select</option>
				<?php echo select_conditions($data->conditions); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="conditions-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Amount</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<input type="number" name="amount" id="amount" class="width-100" value="<?php echo $data->amount ?>" />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="amount-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Sale Team</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="sale_team" id="sale_team">
				<option value="">Please Select</option>
				<?php echo select_sale_team($data->sale_team); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="sale_team-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="is_price_list" id="is_price_list" <?php echo is_checked(1, $data->is_price_list); ?> />
				<span class="lbl">&nbsp; &nbsp;Price below price list must be approve</span>
			</label>
    </div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="status" id="status" value="1" <?php echo is_checked(1, $data->status); ?> />
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>


  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-12">
    <button type="button" class="btn btn-sm btn-success btn-block" id="btn-save" onclick="update()"><i class="fa fa-save"></i> Update</button>
    </div>
  </div>

	<input type="hidden" id="rule_id" value="<?php echo $data->id; ?>" />	
</form>


<script src="<?php echo base_url(); ?>scripts/approve_rule/approve_rule.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
