<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->

<hr class="padding-5"/>

<div class="form-horizontal">
	<div class="form-group margin-top-30">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Payment Terms</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100 e" id="payment-term">
				<option value="">Select</option>
				<?php echo select_payment_term(); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="payment-term-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Name</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="text" id="name" class="width-100 e" maxlength="100" value=""  />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="name-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Discount</label>
    <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-12">
			<div class="input-group width-100">
				<input type="number" id="disc" class="width-100 text-center e" value="0.00"  />
				<span class="input-group-addon">%</span>
			</div>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="disc-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Position</label>
		<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
			<select class="width-100" id="position">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10" selected>10</option>
			</select>
    </div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" id="allow-change" value="1"/>
				<span class="lbl">&nbsp; &nbsp;Allow Change</span>
			</label>
    </div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" id="active" value="1" checked/>
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>

	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>

  <div class="form-group">
    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12 text-right">
    <button type="button" class="btn btn-sm btn-success btn-100" id="btn-save" onclick="add()">Add</button>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>scripts/payment_term_discount/payment_term_discount.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>