<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title"><i class="fa fa-user-circle-o"></i> <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
			<?php if($this->pm->can_edit) : ?>
				<button type="button" class="btn btn-sm btn-success" id="btn-save" onclick="update()"><i class="fa fa-save"></i> Update</button>
			<?php endif; ?>
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
			<select class="width-100" name="emp" id="emp">
				<option value="">Please select</option>
				<?php if(!empty($emp_list)) : ?>
					<?php foreach($emp_list as $emp) : ?>
						<option value="<?php echo $emp->empID; ?>" <?php echo is_selected($user->emp_id, $emp->empID); ?>><?php echo $emp->firstName.' '.$emp->lastName; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="emp-error"></div>
	</div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Sales Employee</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100" name="saleman" id="saleman">
				<option value="">Please Select</option>
				<?php if(!empty($sale_list)) : ?>
					<?php foreach($sale_list as $sale) : ?>
						<option value="<?php echo $sale->id; ?>" <?php echo is_selected($user->sale_id, $sale->id); ?>><?php echo $sale->name; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="saleman-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Group</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100" name="ugroup" id="ugroup">
				<option value=""></option>
				<?php echo select_user_group($user->ugroup_id); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Role</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100" name="role" id="role">
				<option value="sales" <?php echo is_selected($user->role, "sales"); ?>>Sales</option>
				<option value="salesAdmin" <?php echo is_selected($user->role, "salesAdmin"); ?> >Sales Admin</option>
				<option value="GM" <?php echo is_selected($user->role, "GM"); ?>>GM</option>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline grey"></div>
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

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="bi" id="bi" value="1" <?php echo is_checked(1, $user->bi_link); ?>/>
				<span class="lbl">&nbsp; &nbsp;Power BI Access</span>
			</label>
    </div>
  </div>

	<div class="divider"></div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Payment Term</label>
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 table-responsive">
			<table class="table table-striped table-bordered border-1">
				<thead>
					<tr>
						<th class="width-10 text-center">#</th>
						<th>Select Payment Term</th>
						<th class="width-10 text-center">
							<label>
								<input type="checkbox" class="ace" id="chk-all">
								<span class="lbl"></span>
							</label>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($price_list)) : ?>
						<?php $no = 1; ?>
						<?php foreach($price_list as $ps)  : ?>
							<?php $is_checked = isset($user->priceList[$ps->id]) ? TRUE : FALSE; ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $ps->name; ?></td>
								<td class="text-center">
									<label>
										<input type="checkbox"
										class="ace chk"
										name="priceList[<?php echo $ps->id; ?>]"
										id="priceList-<?php echo $ps->id; ?>"
										value="<?php echo $ps->id; ?>" data-name="<?php echo $ps->name; ?>" <?php echo ($is_checked === TRUE ? "checked" : ""); ?> >
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

	<div class="divider"></div>

	<div class="form-group">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-8 control-label no-padding-right">Team</label>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
			<select class="width-100" name="sale_team" id="sale_team">
				<option value="">Please Select</option>
				<?php echo select_sale_team(); ?>
			</select>
		</div>
		<label class="col-xs-4 padding-5 visible-xs" style="margin-top:-25px;">Role</label>
		<div class="col-lg-1 col-md-2 col-sm-2 col-xs-4" style="padding-left:5px;">
			<select class="width-100" id="role">
				<option value="Sales">Sales</option>
				<option value="Lead">Lead</option>
			</select>
		</div>
		<div class="divider-hidden visible-xs">	</div>
		<div class="divider-hidden visible-xs">	</div>
		<div class="col-xs-6 visible-xs"></div>
		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6" style="padding-left:5px;">
			<button type="button" class="btn btn-primary btn-xs btn-block" onclick="addTeam()"><i class="fa fa-plus"></i> Add to list</button>
		</div>
		<div class="help-block col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 red" id="sale-team-error"></div>
	</div>

	<?php $no = 1; ?>
	<div class="form-group <?php echo empty($user->user_team) ? 'hide' : ''; ?>" id="team-list">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="user-team-list">
			<?php if(!empty($user->user_team)) : ?>
				<?php foreach($user->user_team as $rs) : ?>
					<label class="btn-block"  style="padding:10px; border:solid 1px #81a87b;" id="tag-<?php echo $no; ?>">
				    <?php echo $rs->user_role; ?> | <?php echo $rs->team_name; ?>
				    <a class="pointer bold pull-right red" onclick="removeTag(<?php echo $no; ?>)" style="margin-left:15px;">
				      <i class="fa fa-times"></i>
				    </a>
				  </label>
				  <input type="hidden" class="team-list" name="team_list" id="team-<?php echo $no; ?>" value="<?php echo $rs->team_id; ?>" data-role="<?php echo $rs->user_role; ?>"/>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>



	<input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>" />
	<input type="hidden" id="use_strong_pwd" value="<?php echo $strong_pwd; ?>" />
	<input type="hidden" id="no" value="<?php echo $no; ?>">

	<script id="tag-template" type="text/x-handlebarsTemplate">
	  <label class="btn-block"  style="padding:10px; border:solid 1px #81a87b;" id="tag-{{no}}">
	    {{role}} | {{name}}
	    <a class="pointer bold pull-right red" onclick="removeTag({{no}})" style="margin-left:15px;">
	      <i class="fa fa-times"></i>
	    </a>
	  </label>
	  <input type="hidden" class="team-list" name="team_list" id="team-{{no}}" value="{{team_id}}" data-role="{{role}}"/>
	</script>

</form>

<script>
$('#emp').select2();
$('#saleman').select2();
</script>

<script src="<?php echo base_url(); ?>scripts/users/users.js"></script>
<?php $this->load->view('include/footer'); ?>
