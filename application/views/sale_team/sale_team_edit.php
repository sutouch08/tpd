<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-8 padding-5">
    <h4 class="title"><i class="fa fa-users"></i> <?php echo $this->title; ?></h4>
  </div>
	<div class="col-md-6 col-sm-6 col-xs-4 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5 margin-bottom-30"/>

<form class="form-horizontal">
	<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Team Name</label>
    <div class="col-xs-12 col-sm-4">
			<input type="text" name="name" id="name" class="width-100" maxlength="100" value="<?php echo $data->name; ?>" autofocus required />
    </div>
		<div class="help-block col-xs-12 col-sm-reset inline red" id="name-error"></div>
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
							<?php $is_checked = isset($data->tgroup[$cg->GroupCode]) ? TRUE : FALSE; ?>
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
		<label class="col-sm-3 col-xs-6 control-label no-padding-right hidden-xs"></label>
		<div class="col-lg-2-harf col-md-2 col-sm-2 col-xs-6"></div>
    <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
			<button type="button" class="btn btn-sm btn-success btn-block" id="btn-save" onclick="update()"><i class="fa fa-save"></i>&nbsp;&nbsp Update</button>
    </div>
    <div class="help-block col-xs-12 col-sm-reset inline">
      &nbsp;
    </div>
  </div>
	<input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>">
</form>

<script src="<?php echo base_url(); ?>scripts/sale_team/sale_team.js"></script>
<?php $this->load->view('include/footer'); ?>
