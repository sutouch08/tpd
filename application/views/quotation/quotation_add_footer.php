<div class="row">
  <!--- left column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">Sale Employee</label>
        <div class="col-sm-7 col-xs-12">
          <input type="text" id="slpCode" class="form-control input-sm" value="<?php echo $sale_name; ?>" disabled />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">Owner</label>
        <div class="col-sm-7 col-xs-12">
          <select class="form-control input-sm" id="owner" disabled>
            <option value=""></option>
            <?php echo select_employee($this->user->emp_id); ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">เงินมัดจำ</label>
        <div class="col-sm-7 col-xs-12">
          <input type="text" id="deposit" class="form-control input-sm text-right" value="0.00" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">Remark</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="comments" class="autosize autosize-transition form-control"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">หมายเหตุในการออกเอกสาร</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="remark" class="autosize autosize-transition form-control"></textarea>
        </div>
      </div>

    </div>
  </div>

  <!--- Middle column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">เงื่อนไขการส่งของ</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="doCondition" class="autosize autosize-transition form-control"></textarea>
        </div>
      </div>
      <div class="divider-hidden"></div>
      <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label no-padding-right">เงื่อนไขการติดตั้ง</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="intCondition" class="autosize autosize-transition form-control"></textarea>
        </div>
      </div>
    </div>
  </div>

  <!--- right column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-6 col-xs-12 control-label no-padding-right">Total Before Discount</label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" class="form-control input-sm text-right" id="totalAmount" value="0.00" disabled>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 col-3-harf col-xs-12 control-label no-padding-right">Discount</label>
        <div class="col-sm-2 col-2-harf col-xs-6 padding-right-0">
          <span class="input-icon input-icon-right width-100">
          <input type="number" id="discPrcnt" class="form-control input-sm" value="0.00"/>
          <i class="ace-icon fa fa-percent"></i>
          </span>
        </div>
        <div class="col-sm-6 col-xs-6">
          <input type="text" id="discAmount" class="form-control input-sm text-right" value="0.00">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 col-xs-12 control-label no-padding-right">Rouding</label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" id="roundDif" class="form-control input-sm text-right" value="0.00" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 col-xs-12 control-label no-padding-right">Tax</label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" id="tax" class="form-control input-sm text-right" value="0.00" disabled />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 col-xs-12 control-label no-padding-right">Total</label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" id="docTotal" class="form-control input-sm text-right" value="0.00" />
        </div>
      </div>

    </div>
  </div>

  <input type="hidden" id="vat_rate" value="<?php echo getConfig('SALE_VAT_RATE'); //--- default sale vat rate ?>" />
  <input type="hidden" id="vat_code" value="<?php echo getConfig('SALE_VAT_CODE'); //--- default sale vat code?>" />
  <input type="hidden" id="user_sale_name" value="<?php echo $sale_name; ?>" />
  <input type="hidden" id="user_sale_id" value="<?php echo $this->user->sale_id; ?>" />
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>

  <div class="col-sm-12 col-xs-12 padding-5">
    <button type="button" class="btn btn-sm btn-primary" onclick="saveAdd()">Add</button>
    <button type="button" class="btn btn-sm btn-warning" onclick="leave()">Cancel</button>
  </div>
</div>
