<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title"><i class="fa fa-user-circle-o"></i> <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Username</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="text" name="uname" id="uname" class="width-100" maxlength="50" value="<?php echo $user->uname; ?>" onkeyup="validCode(this)" disabled />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

	<div class="form-group">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Employee</label>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="text" name="emp" id="emp" class="width-100" value="<?php echo $user->emp_name; ?>" required />
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="emp-error"></div>
	</div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Sales Employee</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="saleman" id="saleman">
				<option value="">Please select</option>
				<?php echo select_saleman($user->sale_id); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="saleman-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Group</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="ugroup" id="ugroup">
				<option value="">Please select</option>
				<?php echo select_user_group($user->ugroup_id); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Role</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="form-control input-sm" name="role" id="role">
				<option value="">Please select</option>
				<?php echo select_user_role($user->user_role); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="role-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="status" id="status" value="1" <?php echo is_checked($user->status, 1); ?> />
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>

	<div class="divider"></div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Customer Group</label>
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 table-responsive" style="height:400px; overflow-y:scroll">
			<table class="table table-striped table-bordered border-1">
				<thead>
					<tr>
						<th class="width-10 text-center">#</th>
						<th>Customer Group</th>
						<th class="width-10 text-center">
							<label>
								<input type="checkbox" class="ace" id="chk-all">
								<span class="lbl"></span>
							</label>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($customer_group)) : ?>
						<?php $no = 1; ?>
						<?php foreach($customer_group as $cg)  : ?>
							<?php $is_checked = isset($user->ugroup[$cg->GroupCode]) ? TRUE : FALSE; ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $cg->GroupName; ?></td>
								<td class="text-center">
									<label>
										<input type="checkbox"
										class="ace chk"
										name="customerGroup[<?php echo $cg->GroupCode; ?>]"
										id="customerGroup-<?php echo $cg->GroupCode; ?>"
										value="<?php echo $cg->GroupCode; ?>" <?php echo ($is_checked === TRUE ? "checked" : ""); ?>>
										<span class="lbl"></span>
									</label>
								</td>
							</tr>
							<?php $no++; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
    </div>

  </div>

	<div class="divider-hidden"></div>


  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <p class="pull-right">
        <button type="button" class="btn btn-sm btn-success" id="btn-save" onclick="update()"><i class="fa fa-save"></i> Update</button>
      </p>
    </div>
    <div class="help-block col-xs-12 col-sm-reset inline">
      &nbsp;
    </div>
  </div>
	<input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>" />
	<input type="hidden" name="emp_id" id="emp_id" value="<?php echo $user->emp_id; ?>"/>
	<input type="hidden" id="use_strong_pwd" value="<?php echo $strong_pwd; ?>" />
	<input type="hidden" id="old_uname" value="<?php echo $user->uname; ?>"/>

</form>

<script src="<?php echo base_url(); ?>scripts/users/users.js"></script>
<?php $this->load->view('include/footer'); ?>
