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
<div class="row">
  <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 padding-5">
		<label>Price List Name</label>
		<input type="text" class="width-100 e" id="name" maxlength="100" value="<?php echo $doc->name; ?>" autofocus />
	</div>
	<?php $ac = $doc->active == 1 ? 'btn-primary' : ''; ?>
	<?php $dc = $doc->active == 0 ? 'btn-danger' : ''; ?>
	<div class="col-lg-2 col-md-2-harf col-sm-2-harf col-xs-6 padding-5">
		<label class="display-block">Status</label>
	   <div class="btn-group width-100">
       <button type="button" class="btn btn-sm width-50 <?php echo $ac; ?>" id="btn-active" onclick="toggleActive(1)">Active</button>
       <button type="button" class="btn btn-sm width-50 <?php echo $dc; ?>" id="btn-inactive" onclick="toggleActive(0)">Inactive</button>
       <input type="hidden" id="active" value="<?php echo $doc->active; ?>" />
     </div>
	</div>
	<?php if($this->pm->can_edit or $this->pm->can_add) : ?>
		<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
			<label class="display-block not-show">update</label>
			<button type="button" class="btn btn-xs btn-success btn-block" onclick="update()">Update</button>
		</div>
	<?php endif; ?>
</div>

<input type="hidden" id="id" value="<?php echo $doc->id; ?>" />

<hr class="">
<div class="row">
  <div class="col-lg-5 col-md-5-harf col-sm-6 col-xs-12 padding-5">
		<label>Items</label>
		<select class="width-100 item-row" id="item" onchange="update_uom($(this))">
			<option value="" data-uom="">Select Item</option>
			<?php if(!empty($items)) : ?>
				<?php foreach($items as $rs) : ?>
					<option value="<?php echo $rs->code; ?>" data-uom="<?php echo $rs->UoM; ?>"><?php echo $rs->name; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
		<label>Uom</label>
			<input type="text" class="form-control input-sm text-center" id="uom" value="" disabled />
	</div>
  <?php if($this->pm->can_add) : ?>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label class="display-block not-show">btn</label>
      <button type="button" class="btn btn-xs btn-primary btn-block" onclick="addItem()"><i class="fa fa-plus"></i> เพิ่ม</button>
  </div>
<?php endif; ?>
</div>
<hr class="">

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-hover border-1" style="min-width:950px;">
			<thead>
				<tr>
					<th class="fix-width-100 middle"></th>
					<th class="fix-width-50 middle text-center">#</th>
					<th class="fix-width-250 middle">Item Code</th>
					<th class="min-width-200 middle">Item Name</th>
					<th class="fix-width-80 middle text-center">Step</th>
					<th class="fix-width-80 middle text-center">Status</th>
				</tr>
			</thead>
			<tbody>
			<?php if( ! empty($details)) : ?>
				<?php $no = $this->uri->segment(3) + 1; ?>
				<?php foreach($details as $rs) : ?>
					<tr>
						<td class="middle">
							<button type="button" class="btn btn-minier btn-info" onclick="viewItem(<?php echo $rs->id; ?>)"><i class="fa fa-eye"></i></button>
							<?php if($this->pm->can_edit) : ?>
								<button type="button" class="btn btn-minier btn-warning" onclick="editItem(<?php echo $rs->id; ?>)">
									<i class="fa fa-pencil"></i>
								</button>
							<?php endif; ?>
							<?php if($this->pm->can_delete) : ?>
								<button type="button" class="btn btn-minier btn-danger" onclick="deleteItem(<?php echo $rs->id; ?>, '<?php echo $rs->ItemCode; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							<?php endif; ?>
						</td>
						<td class="middle text-center no"><?php echo $no; ?></td>
						<td class="middle"><?php echo $rs->ItemCode; ?></td>
						<td class="middle"><?php echo $rs->ItemName; ?></td>
						<td class="middle text-center"><?php echo $this->special_price_list_model->count_step($rs->id); ?></td>
						<td class="middle text-center"><?php echo is_active($rs->active); ?></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>


<script>
	$('#item').select2();
</script>

<script src="<?php echo base_url(); ?>scripts/special_price_list/special_price_list.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
