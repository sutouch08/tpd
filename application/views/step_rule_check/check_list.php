<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h4 class="title"><i class="fa fa-bolt"></i>&nbsp; <?php echo $this->title; ?></h4>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    	<p class="pull-right top-p">
      <?php if($this->pm->can_add) : ?>
        <button type="button" class="btn btn-sm btn-success" onclick="goAdd()"><i class="fa fa-plus"></i> New Rule</button>
      <?php endif; ?>
      </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
	<div class="col-lg-3 col-md-3-harf col-sm-3-harf col-xs-6 padding-5">
    <label>Price List</label>
    <select class="form-control input-sm" id="price-list">
			<option value="">Select</option>
			<?php echo select_price_list(); ?>
		</select>
  </div>

	<div class="col-lg-5 col-md-3-harf col-sm-3-harf col-xs-6 padding-5">
		<label>Items</label>
		<select class="width-100 item-row" id="item">
			<option value="" data-uom="">Select</option>
			<?php if(!empty($items)) : ?>
				<?php foreach($items as $rs) : ?>
					<option value="<?php echo $rs->code; ?>" data-uom="<?php echo $rs->UoM; ?>"><?php echo $rs->name; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
  </div>

  <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-primary btn-block" onclick="getData()">Search</button>
  </div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearData()">Clear</button>
  </div>
</div>
<hr class="margin-top-15 padding-5">

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped table-bordered border-1" style="min-width:950px;">
			<thead>
				<tr>
					<th class="fix-width-50 middle text-center">#</th>
					<th class="fix-width-200 middle">Item Code</th>
					<th class="min-width-200 middle">Description</th>
					<th class="fix-width-100 middle text-center">Price</th>
					<th class="fix-width-100 middle text-center">Qty</th>
					<th class="fix-width-100 middle text-center">Free</th>
					<th class="fix-width-100 middle text-center">Average</th>
					<th class="fix-width-100 middle text-center">Discount</th>
				</tr>
			</thead>
			<tbody id="step-table">	</tbody>
		</table>
	</div>
</div>

<script type="text/x-handlebarTemplate" id="step-template">
	{{#each this}}
		{{#if nodata}}
		<tr>
			<td colspan="8" class="text-center">---{{nodata}} ----</td>
		</tr>
		{{else}}
			<tr>
				<td class="text-center">{{no}}</td>
				<td class="">{{ItemCode}}</td>
				<td class="">{{ItemName}}</td>
				<td class="text-center">{{Price}}</td>
				<td class="text-center">{{Qty}}</td>
				<td class="text-center">{{freeQty}}</td>
				<td class="text-center">{{avgPrice}}</td>
				<td class="text-center">{{discPrcnt}} %</td>
			</tr>
		{{/if}}
	{{/each}}
</script>


<script src="<?php echo base_url(); ?>scripts/step_rule_check/step_rule_check.js?v=<?php echo date('Ymd'); ?>"></script>
<script>
	$('#item').select2();
</script>

<?php $this->load->view('include/footer'); ?>
