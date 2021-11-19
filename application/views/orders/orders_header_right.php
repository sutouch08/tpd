<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 padding-5">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-6 control-label no-padding-right">Username</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <input type="text" id="username" class="form-control input-sm" value="<?php echo $this->_user->uname; ?>" disabled/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-12 control-label no-padding-right">Order No.</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <input type="text" id="code" class="form-control input-sm" value="<?php echo $code; ?>" disabled/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-12 control-label no-padding-right">Payment Terms</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <select class="width-100" name="priceList" id="priceList" onchange="checkPriceList()">
            <option value="">Select payment</option>
            <?php if(!empty($priceList)) : ?>
              <?php foreach($priceList as $pl) : ?>
                <option value="<?php echo $pl->list_id; ?>"><?php echo $pl->list_name; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-12 control-label no-padding-right">วันที่สั่งสินค้า</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <span class="input-icon input-icon-right">
          <input type="text" id="DocDate" class="form-control input-sm text-center" value="<?php echo date('d-m-Y'); ?>" disabled/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-12 control-label no-padding-right">วันที่ส่งสินค้า</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <span class="input-icon input-icon-right">
          <input type="text" id="DocDueDate" class="form-control input-sm text-center" value="<?php echo date('d-m-Y', strtotime('+3 days')); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-7 col-md-7 col-sm-7 col-xs-12 control-label no-padding-right">เลขที่ PO</label>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <input type="text" id="PoNo" class="form-control input-sm" value=""/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">สถานที่จัดส่งเพิ่มเติม</label>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <textarea id="exShipTo" class="autosize autosize-transition form-control" maxlength="254" onkeyup="wordCount($(this), 2)"></textarea>
          <span class="pull-right grey"><span id="word-count-2">0</span>/254</span>
        </div>
      </div>

    </div>
</div>
