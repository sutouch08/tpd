<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><i class="fa fa-bolt"></i>&nbsp; <?php echo $this->title; ?></h4>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->

<hr class="padding-5"/>

<div class="row">
  <div class="col-lg-2-harf col-md-2-harf col-sm-2-harf col-xs-12 padding-5">
		<label>Price List</label>
		<select class="form-control input-sm e" id="price-list">
      <option value="">Select</option>
      <?php echo select_price_list(); ?>
    </select>
	</div>
	<div class="col-lg-7 col-md-5-harf col-sm-5-harf col-xs-12 padding-5">
		<label>Description</label>
			<input type="text" class="form-control input-sm e" id="name" name="name" placeholder="Description" autofocus required/>
	</div>
	<div class="col-lg-1-harf col-md-2-harf col-sm-2-harf col-xs-6">
		<label class="display-block">Status</label>
	   <div class="btn-group width-100">
       <button type="button" class="btn btn-sm width-50 btn-primary" id="btn-active" onclick="toggleActive(1)">Active</button>
       <button type="button" class="btn btn-sm width-50" id="btn-inactive" onclick="toggleActive(0)">Inactive</button>
       <input type="hidden" id="active" value="1" />
     </div>
	</div>
  <?php if($this->pm->can_add) : ?>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label class="display-block not-show">btn</label>
      <button type="button" class="btn btn-xs btn-success btn-block" onclick="add()"><i class="fa fa-plus"></i> เพิ่ม</button>
  </div>
<?php endif; ?>
</div>

<hr class="padding-5 margin-top-15 margin-bottom-15">

<script src="<?php echo base_url(); ?>scripts/step_rule/step_rule.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
