<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><i class="fa fa-user-circle"></i>&nbsp; <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->

<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Username</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<!-- <input type="text" name="uname" id="uname" class="width-100" value="" autofocus required /> -->
			<select class="width-100 e" id="uname" name="uname">
				<option value="">Please Select</option>
				<?php echo select_uname(); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Employee</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<input type="text" name="emp_name" id="emp_name" class="width-100 e" value="" readonly />
    </div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Maximum Amount</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<input type="number" name="amount" id="amount" class="width-100 e" value="" />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="amount-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="status" id="status" value="1" checked/>
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>

	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>

  <div class="form-group">
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 text-right">
			<button type="button" class="btn btn-sm btn-success btn-100" id="btn-save" onclick="add()"><i class="fa fa-save"></i> Add</button>
    </div>
  </div>
</form>

<script>
	$('#uname').select2();
</script>
<script src="<?php echo base_url(); ?>scripts/approver/approver.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
