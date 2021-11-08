<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-sm-6 col-xs-6 padding-5">
    <h3 class="title"> <?php echo $this->title; ?></h3>
  </div>
	<div class="col-sm-6 col-xs-6 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Name</label>
    <div class="col-xs-12 col-sm-4">
			<input type="text" name="name" id="name" class="width-100" value="" autofocus required />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="name-error"></div>
  </div>

	<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Sales Team</label>
    <div class="col-xs-12 col-sm-4">
			<select class="form-control input-sm" name="sale_team" id="sale_team">
				<option value="">เลือก</option>
				<?php echo select_sales_team(); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="sale-team-error"></div>
  </div>


  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">GP Less than or equal to </label>
    <div class="col-xs-8 col-sm-1 col-1-harf frist">
			<div class="input-group">
				<input type="number" name="gp" id="gp" class="width-100 text-right" value="" placeholder="0-100" required/>
				<span class="input-group-addon"><i class="ace-icon fa fa-percent"></i></span>
			</div>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline" id="gp-error">must be approve</div>
  </div>

	<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"></label>
    <div class="col-xs-12 col-sm-4">
			<label>
				<input type="checkbox" class="ace" name="active" id="active" value="1" checked/>
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>

	<div class="divider-hidden">

	</div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"></label>
    <div class="col-xs-12 col-sm-4">
      <p class="pull-right">
        <button type="button" class="btn btn-sm btn-success" id="btn-save" onclick="saveAdd()"><i class="fa fa-save"></i> Add</button>
      </p>
    </div>
    <div class="help-block col-xs-12 col-sm-reset inline">
      &nbsp;
    </div>
  </div>
</form>

<script src="<?php echo base_url(); ?>scripts/gp_rule/gp_rule.js?v=<?php echo date('YmdH'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
