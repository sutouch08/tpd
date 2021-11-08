<div class="row">
  <!--- left column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">Sale Employee</label>
        <div class="col-sm-7 col-xs-12">
          <input type="text" id="slpCode" class="form-control input-sm" value="<?php echo $sale_name; ?>" disabled />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">Owner</label>
        <div class="col-sm-7 col-xs-12">
          <select class="form-control input-sm" id="owner">
            <option value=""></option>
            <?php $owner = empty($header->OwnerCode) ? $this->user->emp_id : $header->OwnerCode; ?>
            <?php echo select_employee($owner); ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">เงินมัดจำ</label>
        <div class="col-sm-7 col-xs-12">
          <input type="text" id="deposit" class="form-control input-sm text-right" value="<?php echo number($header->U_SQDPM, 2); ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">Remark</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="comments" class="autosize autosize-transition form-control"><?php echo $header->Comments; ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">หมายเหตุในการออกเอกสาร</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="remark" class="autosize autosize-transition form-control"><?php echo $header->U_BEX_EXREMARK; ?></textarea>
        </div>
      </div>

    </div>
  </div>

  <!--- Middle column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">เงื่อนไขการส่งของ</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="doCondition" class="autosize autosize-transition form-control"><?php echo $header->U_DO_CONDITION; ?></textarea>
        </div>
      </div>
      <div class="divider-hidden"></div>
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right">เงื่อนไขการติดตั้ง</label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="intCondition" class="autosize autosize-transition form-control"><?php echo $header->U_INT_CONDITION; ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <!--- right column -->
  <div class="col-sm-4 col-xs-12 padding-5">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-6 control-label no-padding-right">Total Before Discount</label>
        <div class="col-sm-6 col-xs-12 padding-5 last">
          <input type="text" class="form-control input-sm text-right" id="totalAmount" value="<?php echo number($totalAmount, 2); ?>" disabled>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Discount</label>
        <div class="col-sm-3 col-xs-6 padding-5">
          <span class="input-icon input-icon-right">
          <input type="number" id="discPrcnt" class="form-control input-sm" value="<?php echo round($header->DiscPrcnt, 2); ?>"/>
          <i class="ace-icon fa fa-percent"></i>
          </span>
        </div>
        <div class="col-sm-6 col-xs-6 padding-5 last">
          <input type="text" id="discAmount" class="form-control input-sm text-right" value="<?php echo number($totalAmount * ($header->DiscPrcnt * 0.01), 2); ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label no-padding-right">Rouding</label>
        <div class="col-sm-6 col-xs-6 padding-5 last">
          <input type="text" id="roundDif" class="form-control input-sm text-right" value="<?php echo number($header->RoundDif, 2); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label no-padding-right">Tax</label>
        <div class="col-sm-6 col-xs-6 padding-5 last">
          <input type="text" id="tax" class="form-control input-sm text-right" value="<?php echo number($header->VatSum, 2); ?>" disabled />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label no-padding-right">Total</label>
        <div class="col-sm-6 col-xs-6 padding-5 last">
          <input type="text" id="docTotal" class="form-control input-sm text-right" value="<?php echo number($header->DocTotal, 2); ?>" />
        </div>
      </div>

    </div>
  </div>

  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>
  <input type="hidden" id="vat_rate" value="<?php echo getConfig('SALE_VAT_RATE'); //--- default sale vat rate ?>" />
  <input type="hidden" id="vat_code" value="<?php echo getConfig('SALE_VAT_CODE'); //--- default sale vat code?>" />
  <input type="hidden" id="user_sale_name" value="<?php echo $user_sale_name; ?>" />
  <input type="hidden" id="user_sale_id" value="<?php echo $this->user->sale_id; ?>" />

  <div class="col-sm-6 col-xs-6 padding-5">
    <button type="button" class="btn btn-sm btn-primary" onclick="update()">Update</button>
    <button type="button" class="btn btn-sm btn-warning" onclick="leave()">Cancel</button>
  </div>
  <div class="col-sm-6 col-xs-6 padding-5">
    <?php if(!empty($logs)) : ?>
      <p class="pull-right" style="font-size:12px; font-style: italic; color:#c5d0dc;">
      <?php foreach($logs as $log) : ?>
        <?php echo "*".logs_action_name($log->action) ." &nbsp;&nbsp; {$log->uname} &nbsp;&nbsp; {$log->emp_name}  &nbsp;&nbsp; ".thai_date($log->date_upd, TRUE)."<br/>"; ?>
      <?php endforeach; ?>
      </p>
    <?php endif; ?>
  </div>
</div>
