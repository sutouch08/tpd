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
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Order Type</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="order_type" id="order_type">
				<option value="local" <?php echo is_selected("local", $data->order_type); ?>>Local</option>
				<option value="oversea" <?php echo is_selected("oversea", $data->order_type); ?>>Overseas</option>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="order_type-error"></div>
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



	<div class="divider"></div>
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Authorizer</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
			<select class="form-control input-sm" name="approver" id="approver">
				<option value="">Please Select</option>
				<?php echo select_approver(); ?>
			</select>
    </div>
		<div class="col-lg-1 col-md-2 col-sm-2 col-xs-4">
			<button type="button" class="btn btn-primary btn-xs btn-block" onclick="addApprover()"><i class="fa fa-plus"></i> Add to list</button>
		</div>
		<div class="help-block col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 red" id="approver-error"></div>
  </div>

	<div class="form-group" id="authorizer-list">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="approver-list">
			<?php if(!empty($data->approver)) : ?>
				<?php foreach($data->approver as $rs) : ?>
					<label class="btn-block"  style="padding:10px; border:solid 1px #81a87b;" id="tag-<?php echo $no; ?>">
						<?php echo $rs->uname .' | '.$rs->emp_name; ?>
				    <a class="pointer bold pull-right red" onclick="removeTag(<?php echo $no; ?>)" style="margin-left:15px;">
				      <i class="fa fa-times"></i>
				    </a>
				  </label>
				  <input type="hidden" class="approver-list" name="approver-list" id="approver-<?php echo $no; ?>" value="<?php echo $rs->user_id; ?>"/>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
    </div>
  </div>

	<div class="divider"></div>

	<div class="divider-hidden"></div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-12">
    <button type="button" class="btn btn-sm btn-success btn-block" id="btn-save" onclick="update()"><i class="fa fa-save"></i> Update</button>
    </div>
  </div>

	<input type="hidden" id="no" value="<?php echo $no; ?>">
	<input type="hidden" id="rule_id" value="<?php echo $data->id; ?>" />

	<script id="tag-template" type="text/x-handlebarsTemplate">
	  <label class="btn-block"  style="padding:10px; border:solid 1px #81a87b;" id="tag-{{no}}">
	    {{name}}
	    <a class="pointer bold pull-right red" onclick="removeTag({{no}})" style="margin-left:15px;">
	      <i class="fa fa-times"></i>
	    </a>
	  </label>
	  <input type="hidden" class="approver-list" name="approver-list" id="approver-{{no}}" value="{{user_id}}"/>
	</script>
</form>


<script src="<?php echo base_url(); ?>scripts/approve_rule/approve_rule.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
