<div class="col-sm-6 col-xs-12 padding-5 last">
  <!--<div class="row">-->
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-6 col-6-harf col-xs-12 control-label no-padding-right">No.</label>
        <div class="col-sm-2 col-2-harf col-xs-6" style="padding-right:0px;">
          <select class="form-control input-sm" id="Series">
            <?php echo select_series(); ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-6">
          <input type="text" id="DocNum" class="form-control input-sm" value="" disabled/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Web Order</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="code" class="form-control input-sm" value="" disabled/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Payment Terms</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="Payment" class="form-control input-sm" value="" disabled/>
          <input type="hidden" id="GroupNum" value="">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Posting Date</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="DocDate" class="form-control input-sm" value="<?php echo date('d-m-Y'); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Valid Until</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="DocDueDate" class="form-control input-sm" value="<?php echo date('d-m-Y'); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Document Date</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="TextDate" class="form-control input-sm" value="<?php echo date('d-m-Y'); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">เลขที่ใบเสนอราคาเดิม</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="OldQuotationCode" class="form-control input-sm" value="" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">กำหนดยืนราคา(วัน)</label>
        <div class="col-sm-3 col-xs-12">
          <input type="number" id="DuePrice" class="form-control input-sm text-right" value="<?php echo getConfig('DEFAULT_DUE_PRICE'); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">กำหนดส่งของภายใน(วัน)</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="DueDelivery" class="form-control input-sm text-right" value="<?php echo getConfig('DEFAULT_DUE_DELIVERY'); ?>" />
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-5 col-xs-12 control-label no-padding-right">Bill To</label>
        <div class="col-sm-3 col-xs-6" style="padding-right:5px;">
          <select class="form-control input-sm" id="billToCode" onchange="get_address_bill_to()"></select>
        </div>
        <div class="col-sm-4 col-xs-6" style="padding-left:5px;">
          <input class="form-control input-sm" id="b-branch" readonly />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-5 hidden-xs control-label no-padding-right"></label>
        <div class="col-sm-7 col-xs-12">
          <textarea id="BillTo" class="autosize autosize-transition form-control" readonly></textarea>
          <span class="badge badge-yellow pull-right margin-top-5"
          style="padding-bottom:0px; padding-top:0px; border-radius:3px; cursor:pointer;" onclick="editBillTo()">
            <i class="fa fa-ellipsis-h"></i>
          </span>
        </div>

      </div>

    </div>
  <!--</div>-->
</div>
