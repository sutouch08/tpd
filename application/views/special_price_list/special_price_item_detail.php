<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
    <h4 class="title"><?php echo $this->title; ?></h4>
  </div>
</div><!-- End Row -->

<hr class="padding-5"/>

<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 padding-5">
		<label>Item Code</label>
		<input type="text" class="width-100" id="item-code" value="<?php echo $item->ItemCode; ?>" disabled />
		<input type="hidden" id="id" value="<?php echo $item->id; ?>" />
	</div>
	<div class="col-lg-6-harf col-md-6 col-sm-7 col-xs-12 padding-5">
		<label>Item Name</label>
		<input type="text" class="width-100" id="item-name" value="<?php echo $item->ItemName; ?>" disabled />
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
		<label>Uom</label>
		<input type="text" class="width-100" id="uom" value="<?php echo $item->UomCode; ?>" disabled />
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-2 col-xs-6 padding-5">
		<label>Status</label>
		<input type="text" class="width-100 text-center" value="<?php echo $item->active == 1 ? 'Active' : 'Inactive'; ?>" disabled />
	</div>
</div>

<hr class="padding-5 margin-top-15 margin-bottom-15">

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive" style="over-flow:auto;">
		<table class="table table-bordered border-1" style="min-width:800px;">
			<thead>
				<tr class="">
					<th class="fix-width-50 text-center">#</th>
					<th class="min-width-200">Description</th>
					<th class="fix-width-100 text-right">Min. Qty</th>
					<th class="fix-width-100 text-right">Sell Price</th>
					<th class="fix-width-100 text-right">Free Qty</th>
					<th class="fix-width-200">Update by</th>
					<th class="fix-width-150">Update at</th>
				</tr>
			</thead>
			<tbody id="detail-table">
				<?php $no = 1; ?>
				<?php if(!empty($details)) : ?>
					<?php foreach($details as $rs) : ?>
				<tr id="row-<?php echo $no; ?>">
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->name; ?></td>
					<td class="middle text-right"><?php echo number($rs->Qty, 2); ?></td>
					<td class="middle text-right"><?php echo number($rs->SellPrice, 2); ?></td>
					<td class="middle text-right"><?php echo number($rs->freeQty, 2); ?></td>
					<td class="middle"><?php echo $this->user_model->get_uname($rs->update_by); ?></td>
					<td class="middle"><?php echo thai_date($rs->date_upd, TRUE); ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script src="<?php echo base_url(); ?>scripts/special_price_list/special_price_list.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
