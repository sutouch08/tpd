<?php $this->load->view('include/header'); ?>
<?php $pm = get_permission('PERMISSION', $this->_user->uid, $this->_user->ugroup_id); ?>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title">
      <i class="fa fa-users"></i> <?php echo $this->title; ?>
    </h4>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-4 padding-5">
    	<p class="pull-right top-p">
      <?php if($this->pm->can_add) : ?>
        <button type="button" class="btn btn-sm btn-success" onclick="goAdd()"><i class="fa fa-plus"></i> Add New</button>
      <?php endif; ?>
      </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-6 padding-5">
    <label>Name</label>
    <input type="text" class="form-control input-sm text-center search-box" name="name" value="<?php echo $name; ?>" />
  </div>

	<div class="col-md-3 col-sm-3 col-xs-6 padding-5">
    <label>Sale Person</label>
		<select class="form-control input-sm" name="sale_person" id="sale_person">
			<option value="all">ทั้งหมด</option>
			<?php echo select_sale_person($sale_person); ?>
		</select>
  </div>


  <div class="col-md-2 col-sm-2 col-xs-3 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
  </div>
	<div class="col-md-2 col-sm-2 col-xs-3 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
  </div>
</div>
<hr class="margin-top-15 padding-5">
</form>
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-hover border-1" style="min-width:300px;">
			<thead>
				<tr>
					<th class="width-5 middle text-center">#</th>
					<th class="width-15 middle">Sale Team</th>
					<th class="width-10 middle">Sale Person</th>
					<th class="width-10 middle">Cust Team</th>
					<th class="width-15 middle">Authorizer</th>
					<th class="width-30 middle">Customer Group</th>
					<th class="width-5 middle text-center">Member</th>
					<th class="width-15 middle text-right"></th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($data)) : ?>
				<?php $no = $this->uri->segment(4) + 1; ?>
				<?php foreach($data as $rs) : ?>
					<tr>
						<td class="middle text-center no"><?php echo $no; ?></td>
						<td class="middle"><?php echo $rs->name; ?></td>
						<td class="middle"><?php echo sale_person_name($rs->sale_person_id); ?></td>
						<td class="middle"><?php echo customer_team_name($rs->customer_team_id); ?></td>
						<th class="middle"><?php echo $rs->approver_list; ?></th>
						<td class="middle"><?php echo $rs->customerGroup; ?></td>
						<td class="middle text-center"><?php echo number($rs->member); ?></td>
						</td>
						<td class="middle text-right">
							<button type="button" class="btn btn-xs btn-info" onclick="viewMember(<?php echo $rs->id; ?>)">
								Member
							</button>
							<?php if($this->pm->can_edit) : ?>
							<button type="button" class="btn btn-xs btn-warning" onclick="goEdit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
							<?php endif; ?>
							<?php if($this->pm->can_delete) : ?>
							<button type="button" class="btn btn-xs btn-danger" onclick="getDelete(<?php echo $rs->id; ?>, '<?php echo $rs->name; ?>')"><i class="fa fa-trash"></i></button>
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


<!--  Add New Address Modal  --------->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;" ></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered border-1" style="margin-bottom:0px;">
										<thead>
											<tr>
												<th class="width-40">Username</th>
												<th class="width-40">Emmployee</th>
												<th class="width-20">Role(team)</th>
											</tr>
										</thead>
                    <tbody id="result">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" onClick="dismiss('memberModal')" >Close</button>
            </div>
        </div>
    </div>
</div>

<script id="member-template" type="text/x-handlebarsTemplate">
  {{#each this}}
		<tr>
		<td class="middle">{{uname}}</td>
		<td class="middle ">{{emp_name}}</td>
		<td class="middle">{{role}}</td>
	</tr>
  {{/each}}
</script>


<script src="<?php echo base_url(); ?>scripts/sale_team/sale_team.js"></script>

<?php $this->load->view('include/footer'); ?>
