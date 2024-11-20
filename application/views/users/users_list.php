<?php $this->load->view('include/header'); ?>
<?php $pm = get_permission('PWDRESET'); //--- สามารถ reset user password ได้หรือไม่ ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<h4 class="title"><?php echo $this->title; ?></h4>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<?php if($this->pm->can_add) : ?>
				<button type="button" class="btn btn-sm btn-success" onclick="goAdd()"><i class="fa fa-plus"></i> Add User</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Username</label>
    <input type="text" class="form-control input-sm text-center search-box" name="uname" value="<?php echo $uname; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Employee</label>
    <input type="text" class="form-control input-sm text-center search-box" name="emp_name" value="<?php echo $emp_name; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Sale empl.</label>
		<select class="width-100" name="sale_id" onchange="getSearch()">
    <option value="all">All</option>
			<?php echo select_saleman($sale_id); ?>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Group</label>
    <select class="form-control input-sm" name="user_group" onchange="getSearch()">
			<option value="all">All</option>
			<?php echo select_user_group($user_group); ?>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Role</label>
    <select class="form-control input-sm" name="role" onchange="getSearch()">
			<option value="all">All</option>
			<option value="sales" <?php echo is_selected($role, "sales"); ?>>Sales</option>
			<option value="salesAdmin" <?php echo is_selected($role, "salesAdmin"); ?> >Sales Admin</option>
			<option value="GM" <?php echo is_selected($role, "GM"); ?>>GM</option>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label>Team</label>
    <select class="form-control input-sm" name="sale_team" onchange="getSearch()">
			<option value="all">All</option>
			<?php echo select_sales_team_condition($sale_team); ?>
		</select>
  </div>

	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6 padding-5">
    <label>Status</label>
    <select class="form-control input-sm" name="status" onchange="getSearch()">
			<option value="all">All</option>
			<option value="1" <?php echo is_selected('1', $status); ?>>Active</option>
			<option value="0" <?php echo is_selected('0', $status); ?>>Inactive</option>
		</select>
  </div>

  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 padding-5">
    <label class="display-block not-show ">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block">Search</button>
  </div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 padding-5">
    <label class="display-block not-show ">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()">Reset</button>
  </div>
</div>
<hr class="margin-top-15 padding-5">
</form>
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-hover border-1" style="min-width:1020px;">
			<thead>
				<tr>
					<th class="fix-width-120 middle"></th>
					<th class="fix-width-50 middle text-center">#</th>
					<th class="fix-width-150 middle">Username</th>
					<th class="fix-width-150 middle">Empl.</th>
					<th class="fix-width-150 middle">Sales empl.</th>
					<th class="fix-width-150 middle">Team Condition</th>
					<th class="fix-width-100 middle">Group</th>
					<th class="fix-width-100 middle">Role</th>
					<th class="fix-width-50 middle text-center">Status</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($data)) : ?>
				<?php $no = $this->uri->segment(3) + 1; ?>
				<?php foreach($data as $rs) : ?>
					<tr>
						<td class="">
							<?php if($pm->can_add OR $pm->can_edit OR $pm->can_delete) : ?>
								<button type="button" class="btn btn-mini btn-info" title="Reset password" onclick="goReset(<?php echo $rs->id; ?>)">
									<i class="fa fa-key"></i>
								</button>
							<?php endif; ?>
							<?php if($this->pm->can_edit) : ?>
								<button type="button" class="btn btn-mini btn-warning" onclick="goEdit(<?php echo $rs->id; ?>)">
									<i class="fa fa-pencil"></i>
								</button>
							<?php endif; ?>
							<?php if($this->pm->can_delete) : ?>
								<button type="button" class="btn btn-mini btn-danger" onclick="getDelete(<?php echo $rs->id; ?>, '<?php echo $rs->uname; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							<?php endif; ?>
						</td>
						<td class="middle text-center no"><?php echo $no; ?></td>
						<td class="middle">
							<?php echo $rs->uname; ?>
						</td>
						<td class="middle"><?php echo $rs->emp_name; ?></td>
						<td class="middle"><?php echo $rs->sale_name; ?></td>
						<td class="middle"><?php echo $rs->team_name; ?></td>
						<td class="middle"><?php echo $rs->group_name; ?></td>
						<td class="middle"><?php echo $rs->role; ?></td>
						<td class="middle text-center">
							<?php echo is_active($rs->status); ?>
						</td>

					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>

	$('#sale_id').select2();
</script>

<script src="<?php echo base_url(); ?>scripts/users/users.js"></script>

<?php $this->load->view('include/footer'); ?>
