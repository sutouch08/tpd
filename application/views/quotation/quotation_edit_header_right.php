<div class="col-sm-6 col-xs-12 padding-5 last">
  <!--<div class="row">-->
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-6 col-6-harf col-xs-12 control-label no-padding-right">No.</label>
        <div class="col-sm-2 col-2-harf col-xs-6" style="padding-right:0px;">
          <select class="form-control input-sm" id="Series">
            <?php echo select_series($header->DocDate, $header->Series); ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-6">
          <input type="text" id="DocNum" class="form-control input-sm" value="<?php echo $header->DocNum; ?>" disabled/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Web Order</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="code" class="form-control input-sm" value="<?php echo $header->code; ?>" disabled/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Payment Terms</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="Payment" class="form-control input-sm" value="<?php echo $header->Term; ?>" disabled/>
          <input type="hidden" id="GroupNum" value="<?php echo $header->GroupNum; ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Status</label>
        <div class="col-sm-3 col-xs-12">
          <?php $status = $header->Approved === 'A' ? 'Approved' :($header->Approved === 'R' ? 'Rejected' : 'Pending'); ?>
          <input type="text" class="form-control input-sm" value="<?php echo $status; ?>" disabled/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Posting Date</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="DocDate" class="form-control input-sm" value="<?php echo thai_date($header->DocDate); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Valid Until</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="DocDueDate" class="form-control input-sm" value="<?php echo thai_date($header->DocDueDate); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">Document Date</label>
        <div class="col-sm-3 col-xs-12">
          <span class="input-icon input-icon-right width-100">
          <input type="text" id="TextDate" class="form-control input-sm" value="<?php echo thai_date($header->TextDate); ?>" readonly/>
          <i class="ace-icon fa fa-calendar-o"></i>
          </span>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">เลขที่ใบเสนอราคาเดิม</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="OldQuotationCode" class="form-control input-sm" value="<?php echo get_empty_text($header->U_ORIGINALSQ); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">กำหนดยืนราคา(วัน)</label>
        <div class="col-sm-3 col-xs-12">
          <input type="number" id="DuePrice" class="form-control input-sm text-right" value="<?php echo $header->BEX_DUEPRICE; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-9 col-xs-12 control-label no-padding-right">กำหนดส่งของภายใน(วัน)</label>
        <div class="col-sm-3 col-xs-12">
          <input type="text" id="DueDelivery" class="form-control input-sm text-right" value="<?php echo $header->BEX_DUEDELIVERY; ?>" />
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-5 col-xs-12 control-label no-padding-right">Bill To</label>
        <div class="col-sm-3 col-xs-6" style="padding-right:5px;">
          <select class="form-control input-sm" id="billToCode" onchange="get_address_bill_to()">
            <?php if(!empty($billToCode)) : ?>
            <?php  foreach($billToCode as $rs) : ?>
              <option value="<?php echo $rs->Address; ?>" data-branch="<?php echo $rs->Address3; ?>" <?php echo is_selected($header->PayToCode, $rs->Address); ?>>
                <?php echo $rs->Address; ?>
              </option>
            <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-sm-4 col-xs-6" style="padding-left:5px;">
          <input type="text" class="form-control input-sm" id="b-branch" value="<?php echo (empty($address) ? "" : $address->bBranchName); ?>" readonly/>
        </div>
      </div>


      <div class="form-group">

        <div class="col-sm-7 col-sm-offset-5 col-xs-12">
          <textarea id="BillTo" class="autosize autosize-transition form-control" readonly><?php echo $header->Address; ?></textarea>
          <span class="badge badge-yellow pull-right margin-top-5"
          style="padding-bottom:0px; padding-top:0px; border-radius:3px; cursor:pointer;" onclick="editBillTo()">
            <i class="fa fa-ellipsis-h"></i>
          </span>
        </div>

      </div>

    </div>
  <!--</div>-->
</div>
