<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><i class="fa fa-bolt"></i>&nbsp; <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
			<?php if($this->pm->can_edit) : ?>
				<button type="button" class="btn btn-sm btn-success" onclick="save()"><i class="fa fa-save"></i> &nbsp;Save</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->

<hr class="padding-5"/>

<div class="row">
  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 padding-5">
		<label>Price List</label>
		<select class="form-control input-sm e" id="price-list" disabled>
      <option value="">Select</option>
      <?php echo select_price_list($doc->PriceList); ?>
    </select>
	</div>
	<div class="col-lg-8 col-md-6-harf col-sm-6-harf col-xs-12 padding-5">
		<label>Description</label>
			<input type="text" class="form-control input-sm e" id="name" name="name" placeholder="Description" value="<?php echo $doc->name; ?>" />
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
</div>

<hr class="padding-5 margin-top-15 margin-bottom-15">

<?php $this->load->view('step_rule/step_detail'); ?>

<script src="<?php echo base_url(); ?>scripts/step_rule/step_rule.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
