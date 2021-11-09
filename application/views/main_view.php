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
    <button type="button" class="btn btn-white btn-primary btn-lg margin-bottom-15" onclick="newOrder()"><i class="fa fa-plus"></i>&nbsp; New order</button>
    <?php endif; ?>
    <?php if($op->can_add) : ?>
    <button type="button" class="btn btn-white btn-primary btn-lg margin-bottom-15" onclick="newOrderPromotion()"><i class="fa fa-plus"></i>&nbsp; New order promotion</button>
    <?php endif; ?>

    <?php if($this->_user->bi_link == 1) : ?>
      <button type="button" class="btn btn-white btn-success btn-lg margin-bottom-15" onclick="goPowerBi()"><i class="fa fa-barchart"></i>&nbsp; Power BI</button>
    <?php endif; ?>
  </div>
</div>


<script>

  function newOrder() {
    window.location.href = BASE_URL + 'order/add_new';
  }


  function newOrderPromotion() {
    window.location.href = BASE_URL + 'order_promotion/add_new';
  }



  function goPowerBi() {
    window.location.href = BASE_URL + 'power_bi';
  }


</script>

<?php $this->load->view('include/footer'); ?>
