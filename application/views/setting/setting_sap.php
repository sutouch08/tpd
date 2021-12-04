
<div class="tab-pane fade" id="SAP">
	<form id="sapForm" method="post" action="<?php echo $this->home; ?>/update_config">
  	<div class="row">

      <div class="col-lg-3 col-md-4 col-sm-5 col-xs-8 padding-5">
        <span class="form-control left-label">รหัสภาษีซื้อ</span>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-4 padding-5">
        <input type="text" class="form-control input-sm input-small" name="PURCHASE_VAT_CODE" value="<?php echo $PURCHASE_VAT_CODE; ?>" />
      </div>
      <div class="divider-hidden"></div>

      <div class="col-lg-3 col-md-4 col-sm-5 col-xs-8 padding-5">
        <span class="form-control left-label">อัตราภาษีซื้อ</span>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-4 padding-5">
        <input type="text" class="form-control input-sm input-small" name="PURCHASE_VAT_RATE" value="<?php echo $PURCHASE_VAT_RATE; ?>" />
      </div>
      <div class="divider-hidden"></div>

			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-8 padding-5">
        <span class="form-control left-label">รหัสภาษีขาย</span>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-4 padding-5">
        <input type="text" class="form-control input-sm input-small" name="SALE_VAT_CODE" value="<?php echo $SALE_VAT_CODE; ?>" />
      </div>
      <div class="divider-hidden"></div>

      <div class="col-lg-3 col-md-4 col-sm-5 col-xs-8 padding-5">
        <span class="form-control left-label">อัตราภาษีขาย</span>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-4 padding-5">
        <input type="text" class="form-control input-sm input-small" name="SALE_VAT_RATE" value="<?php echo $SALE_VAT_RATE; ?>" />
      </div>
      <div class="divider-hidden"></div>

      <div class="divider-hidden"></div>



      <div class="col-lg-9 col-lg-offset-3 col-md-8 col-md-offset-4 col-sm-7 col-sm-offset-5 col-xs-6 col-xs-offset-6">
				<?php if($this->pm->can_edit OR $this->_SuperAdmin) : ?>
        <button type="button" class="btn btn-sm btn-success input-small" onClick="updateConfig('sapForm')">
          <i class="fa fa-save"></i> บันทึก
        </button>
				<?php endif; ?>
      </div>
      <div class="divider-hidden"></div>

  	</div><!--/ row -->
  </form>
</div>
