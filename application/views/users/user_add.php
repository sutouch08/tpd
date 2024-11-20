<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
			<?php if($this->pm->can_add) : ?>
				<button type="button" class="btn btn-sm btn-success btn-100" id="btn-save" onclick="add()"><i class="fa fa-save"></i> Add</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Username</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="text" name="uname" id="uname" class="width-100 e" maxlength="50" value="" onkeyup="validCode(this)" autofocus required />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Password</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="password" name="pwd" id="pwd" class="width-100 e" value="" required />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="pwd-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Confirm Password</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<input type="password" name="cfpwd" id="cfpwd" class="width-100 e" value="" required />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="cfpwd-error"></div>
  </div>

	<div class="divider">	</div>

	<div class="form-group">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Employee</label>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100 e" name="emp" id="emp">
				<option value="">Please Select</option>
				<?php if(!empty($emp_list)) : ?>
					<?php foreach($emp_list as $emp) : ?>
						<option value="<?php echo $emp->empID; ?>"><?php echo $emp->firstName.' '.$emp->lastName; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="emp-error"></div>
	</div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Sales Employee</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100 e" name="saleman" id="saleman">
				<option value="">Please Select</option>
				<?php if(!empty($sale_list)) : ?>
					<?php foreach($sale_list as $sale) : ?>
						<option value="<?php echo $sale->id; ?>"><?php echo $sale->name; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="saleman-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Group</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100 e" name="ugroup" id="ugroup">
				<option value="">Please Select</option>
				<?php echo select_user_group(); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
		<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 grey">
			สำหรับกำหนด Permission ของ User
		</div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">User Role</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100" name="u_role" id="u_role">
				<option value="sales">Sales</option>
				<option value="salesAdmin">Sales Admin</option>
				<option value="GM">GM</option>
			</select>
    </div>

		<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 grey">
			Sales :  สามารถมองเห็นออเดอร์ของตัวเองและออเดอร์ใน Area ของตัวเองเท่านั้น<br/>
			Sales Admin :  สามารถมองเห็นออเดอร์ของตัวเองและออเดอร์ของของ Team ที่ตัวเองอยู่เท่านั้น<br/>
			GM  :  สามารถมองเห็นออเดอร์ทั้งหมดโดยไม่มีเงื่อนไข
		</div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">User Area</label>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<select class="width-100" name="area" id="area">
				<option value="">Please Select</option>
				<?php echo select_area(); ?>
			</select>
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="area-error"></div>
		<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 grey">
			User จะสมารถมองเห็นออเดอร์ตาม area ที่กำหนดเท่านั้น และ รายชื่อลูกค้าจะถูกดึงมาให้เลือกตาม Area ที่กำหนดเท่านั้น
		</div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="status" id="status" value="1" checked/>
				<span class="lbl">&nbsp; &nbsp;Active</span>
			</label>
    </div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<label>
				<input type="checkbox" class="ace" name="bi" id="bi" value="1"/>
				<span class="lbl">&nbsp; &nbsp;Power BI Access</span>
			</label>
    </div>
  </div>

	<div class="divider"></div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">Price List</label>
    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 table-responsive border-1" style="padding-left:0px; padding-right: 0px; max-height:300px; overflow:auto;">
			<table class="table table-striped table-bordered tableFixHead border-1" style="margin-top:-1px; margin-left:-1px;">
				<thead>
					<tr>
						<th class="width-10 text-center fix-header">#</th>
						<th class=" fix-header">Select Price List</th>
						<th class="width-10 text-center  fix-header">
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
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $ps->name; ?></td>
								<td class="text-center">
									<label>
										<input type="checkbox"
										class="ace chk"
										name="priceList[<?php echo $ps->id; ?>]"
										id="priceList-<?php echo $ps->id; ?>"
										value="<?php echo $ps->id; ?>" data-name="<?php echo $ps->name; ?>">
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
		<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 grey">
			กำหนดว่า User นี้จะสามารถใช้ Price List ใดได้บ้าง
		</div>
  </div>


	<div class="divider"></div>
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-8 control-label no-padding-right">Sales Team Condition</label>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
			<select class="width-100 e" name="sale_team" id="sale_team">
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

	<div class="form-group hide" id="team-list">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right"></label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="user-team-list">
    </div>
  </div>

	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>
	<div class="divider-hidden"></div>

  <div class="form-group">
    <div class="col-lg-7 col-md-9 col-sm-9 col-xs-12 text-right">
    <button type="button" class="btn btn-sm btn-success btn-100" id="btn-save" onclick="add()"><i class="fa fa-save"></i> Add</button>
    </div>
  </div>


	<input type="hidden" id="use_strong_pwd" value="<?php echo $strong_pwd; ?>" />
	<input type="hidden" id="old_uname" value=""/>
	<input type="hidden" id="no" value="1">

	<script id="tag-template" type="text/x-handlebarsTemplate">
	  <label class="btn-block"  style="padding:10px; border:solid 1px #81a87b;" id="tag-{{no}}">
	    {{role}} | {{name}}
	    <a class="pointer bold pull-right red" onclick="removeTag('{{no}}')" style="margin-left:15px;">
	      <i class="fa fa-times"></i>
	    </a>
	  </label>
	  <input type="hidden" class="team-list" name="team_list" id="team-{{no}}" value="{{team_id}}" data-role="{{role}}"/>
	</script>
</form>
<script>
$('#emp').select2();
$('#saleman').select2();
$('#area').select2();
</script>
<script src="<?php echo base_url(); ?>scripts/users/users.js"></script>
<?php $this->load->view('include/footer'); ?>
