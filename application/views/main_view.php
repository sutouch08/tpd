<?php $this->load->view('include/header'); ?>
<?php $od = get_permission('ORDERS'); ?>
<?php $op = get_permission('ORDERPRO'); ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-center">
    <h1>Hello!</h1>
    <h5>Good to see you here</h5>
  </div>
  <div class="divider"></div>
  <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 padding-5 text-center">
    <?php if($od->can_add) : ?>
    <button type="button" class="btn btn-white btn-primary btn-lg margin-bottom-15"><i class="fa fa-plus"></i>&nbsp; New order</button>
    <?php endif; ?>
    <?php if($op->can_add) : ?>
    <button type="button" class="btn btn-white btn-primary btn-lg margin-bottom-15"><i class="fa fa-plus"></i>&nbsp; New order promotion</button>
    <?php endif; ?>
  </div>
</div>

<?php $this->load->view('include/footer'); ?>
