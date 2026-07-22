<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:1100px; min-width:400px; max-width:95vw; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title-site" id="modal-title" style="margin-bottom:0px;">Preview Order</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="result">

          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-warning a-btn" id="btn-request" onclick="requestPayments()">Request Payments</button>
        <button type="button" class="btn btn-sm btn-success a-btn" id="btn-accept" onclick="accept()">Accept</button>
        <button type="button" class="btn btn-sm btn-success a-btn" id="btn-approve" onclick="approve()">Approve</button>
        <button type="button" class="btn btn-sm btn-danger a-btn" id="btn-reject" onclick="reject()">Reject</button>
        <button type="button" class="btn btn-sm btn-default" onClick="dismiss('preview-modal')">Close</button>
      </div>
    </div>
  </div>
</div>

<script id="preview-template" type="text/x-handlebarsTemplate">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-0">
    <table class="table table-striped table-bordered tableNarrow border-1" style="margin-bottom:10px;">
      <tbody>
        <tr>
          <td class="fix-width-120">เลขที่ใบสั่งสินค้า</td>
          <td class="min-width-100">
            {{orderCode}}
            <input type="hidden" id="order-code" value="{{orderCode}}">
          </td>
          <td class="fix-width-120">User</td>
          <td class="fix-width-150">
          {{user}}
          <input type="hidden" id="user" value="{{user}}">
          <input type="hidden" id="emp-name" value="{{emp_name}}">
          </td>
        </tr>
        <tr>
          <td>ลูกค้า</td>
          <td>
            {{customerName}}
            <input type="hidden" id="customer-name" value="{{customerName}}">
          </td>
          <td>Currency</td>
          <td>{{currency}} | Rate: {{currencyRate}}</td>
        </tr>
        <tr>
          <td>Price List</td>
          <td>{{PriceList}}</td>
          <td>วันที่สั่งสินค้า</td>
          <td>{{docDate}}</td>
        </tr>
        <tr>
          <td>Payment Terms</td>
          <td>{{termName}}</td>
          <td>วันที่จัดส่ง</td>
          <td>{{dueDate}}</td>
        </tr>
        <tr>
          <td>Remark</td>
          <td colspan="3">{{remark}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-1 padding-0 table-responsive" style="max-height:300px; overflow:auto;">
    <table class="table table-bordered tableNarrow border-1" style="min-width:850px; margin-bottom:0px;">
      <thead>
        <tr>
          <th class="fix-width-40 middle text-center">#</th>
          <th class="min-width-250 middle text-center">รายการสินค้า</th>
          <th class="fix-width-80 middle text-center">จำนวน</th>
          <th class="fix-width-80 middle text-center">แถม</th>
          <th class="fix-width-100 middle text-center">หน่วย</th>
          <th class="fix-width-100 middle text-center">ราคา(Term)</th>
          <th class="fix-width-100 middle text-center">ราคา(พิเศษ)</th>
          <th class="fix-width-100 middle text-center">มูลค่า</th>
        </tr>
      </thead>
      <tbody>
        {{#each items}}
          <tr>
            <td class="middle text-center">{{no}}</td>
            <td class="middle">
              <input type="text" class="form-control input-xs text-label padding-0" value="{{itemName}}" readonly>						
            </td>
            <td class="middle text-right">{{qty}}</td>
            <td class="middle text-right">{{free}}</td>
            <td class="middle text-center">{{uom}}</td>
            <td class="middle text-right">{{stdPrice}}</td>
            <td class="middle text-right">{{sellPrice}}</td>
            <td class="middle text-right">{{amount}}</td>
          </tr>
        {{/each}}
      </tbody>
    </table>
  </div>
  <div class="divider" style="margin-top:5px;"></div>
  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 padding-0">
    {{#if has_document}}
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-0" id="file-list">
      <table class="table table-striped tableNarrow border-1">
        <thead>
          <tr>
            <th class="fix-width-20 text-center">#</th>          
            <th class="fix-width-60">Actions</th>
            <th class="min-width-250">File Name</th>
            <th class="fix-width-80 text-right">Size</th>
            <th class="fix-width-130">Date</th>
          </tr>
        </thead>
        <tbody id="file-table">
          {{#each files}} 
            <tr>
              <td class="middle text-center no">{{no}}</td>              
              <td class="middle">
                <button type="button" class="btn btn-white btn-minier btn-info" title="View File" onclick="viewFile('{{orderCode}}', '{{name}}')"><i class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-white btn-minier btn-success" title="Download File" onclick="downloadFile('{{orderCode}}', '{{name}}')"><i class="fa fa-download"></i></button>
              </td>
              <td class="middle">{{name}}</td>
              <td class="middle text-right">{{size}}</td>
              <td class="middle">{{date_modify}}</td>
            </tr>
          {{/each}}        
        </tbody>
      </table>
    </div>
    {{/if}}
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-lg-7 col-md-8 col-sm-8 col-xs-6 control-label no-padding-right">รวมเงินสุทธิ</label>
        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-6 padding-5">
          <input type="text" class="form-control input-sm text-right" value="{{doc_total}}" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-7 col-md-8 col-sm-8 col-xs-6 control-label no-padding-right">ยอดเกินเครดิตคงเหลือ</label>
        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-6 padding-5">
          <input type="text" class="form-control input-sm text-right" id="diff-amount" value="{{credit_diff}}" readonly>
        </div>
      </div>
      {{#if is_overdue}}
      <div class="form-group">
        <label class="col-lg-7 col-md-8 col-sm-8 col-xs-6 control-label no-padding-right">ยอดค้างชำระเกินกำหนด</label>
        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-6 padding-5">
          <input type="text" class="form-control input-sm text-right" id="overdue-amount" value="{{overdue_amount}}" readonly>
        </div>
      </div>
      {{/if}}
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    {{#each logs}} 
      {{{logx}}} 
    {{/each}}
  </div>
</script>

<div class="modal fade" id="authorizer-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:400px;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title-site" style="margin-bottom:0px;"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped table-bordered border-1">
              <thead>
                <tr>
                  <th class="width-40">Username</th>
                  <th class="width-60">Employee</th>
                </tr>
              </thead>
              <tbody id="authorizer-table">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" onClick="dismiss('authorizer-modal')">Close</button>
      </div>
    </div>
  </div>
</div>

<script id="authorizer-template" type="text/x-handlebarsTemplate">
  {{#each this}}
    {{#if nodata}}
      <tr>
        <td colspan="2" class="text-center"> ---- No Authorizer ----</td>
      </tr>
    {{else}}
      <tr>
        <td>{{uname}}</td>
        <td>{{emp_name}}
      </tr>
    {{/if}}
  {{/each}}
</script>


<div class="modal fade" id="request-payment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px; max-width:95vw; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title-site" style="margin-bottom:0px;">Request Payment</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
            <label class="label-sm">Date</label>
            <input type="text" class="form-control input-sm text-center" id="payment-order-date" readonly>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Web Order No.</label>
            <input type="text" class="form-control input-sm" id="payment-order-code" readonly>
          </div>
          <div class="col-lg-8-harf col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Customer</label>
            <input type="text" class="form-control input-sm" id="payment-customer" readonly>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
            <label class="label-sm">Doc Total</label>
            <input type="text" class="form-control input-sm text-right" id="payment-doc-total" readonly>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Credit Diff.</label>
            <input type="text" class="form-control input-sm text-right" id="payment-credit-diff" readonly>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Overdue</label>
            <input type="text" class="form-control input-sm text-right" id="payment-overdue-total" readonly>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Owner</label>
            <input type="text" class="form-control input-sm" id="payment-user" readonly>
          </div>
          <div class="divider"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label class="label-sm">Message (Optional)</label>
            <input type="text" class="form-control input-sm" id="payment-message" placeholder="Enter your message here...">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" onClick="dismiss('request-payment-modal')">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="sendRequest()">Send Request</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="preview-payment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px; max-width:95vw; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:solid 1px #e5e5e5;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title-site" style="margin-bottom:0px;">Request Payment</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
            <label class="label-sm">Date</label>
            <input type="text" class="form-control input-sm text-center" id="preview-payment-date" readonly>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <label class="label-sm">Web Order No.</label>
            <input type="text" class="form-control input-sm text-center" id="preview-payment-order-code" readonly>
          </div>
          <div class="col-lg-8-harf col-md-8-harf col-sm-8-harf col-xs-12">
            <label class="label-sm">Customer</label>
            <input type="text" class="form-control input-sm" id="preview-payment-customer" readonly>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <label class="label-sm">Doc Total</label>
            <input type="text" class="form-control input-sm text-right" id="preview-payment-doc-total" readonly>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <label class="label-sm">Credit Diff.</label>
            <input type="text" class="form-control input-sm text-right" id="preview-payment-credit-diff" readonly>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <label class="label-sm">Overdue</label>
            <input type="text" class="form-control input-sm text-right" id="preview-payment-overdue" readonly>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <label class="label-sm">Request By</label>
            <input type="text" class="form-control input-sm" id="preview-payment-request-by" readonly>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <label class="label-sm">Request date</label>
            <input type="text" class="form-control input-sm" id="preview-payment-request-date" readonly>
          </div>
          <div class="divider-hidden"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label class="label-sm">Request Message</label>
            <input type="text" class="form-control input-sm" id="preview-payment-request-message" readonly>
          </div>
          <div class="divider-hidden"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label class="label-sm">Reply Message</label>
            <input type="text" class="form-control input-sm" id="preview-payment-reply-message" readonly>
          </div>
        </div>
        <div class="row" id="preview-payment-file-list"></div>
        <div class="row" id="preview-payment-logs"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-success p-btn" id="btn-p-approve" onclick="accept()">Accept</button>
        <button type="button" class="btn btn-sm btn-danger p-btn" id="btn-p-reject" onclick="reject()">Reject</button>
        <button type="button" class="btn btn-sm btn-default" onClick="dismiss('preview-payment-modal')">Close</button>
      </div>
    </div>
  </div>
</div>


<script id="preview-files-template" type="text/x-handlebarsTemplate">
  {{#if this}}
    <div class="divider"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
      <table class="table table-striped tableNarrow border-1">
        <thead>
          <tr>
            <th class="fix-width-20 text-center">#</th>
            <th class="fix-width-60">Actions</th>
            <th class="min-width-250">File Name</th>
            <th class="fix-width-80 text-right">Size</th>
            <th class="fix-width-130">Date</th>
          </tr>
        </thead>
        <tbody id="file-table">
          {{#each this}}
            <tr>
              <td class="middle text-center no">{{no}}</td>
              <td class="middle">
                <button type="button" class="btn btn-white btn-minier btn-info" title="View File" onclick="viewFile('{{orderCode}}', '{{name}}')"><i class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-white btn-minier btn-success" title="Download File" onclick="downloadFile('{{orderCode}}', '{{name}}')"><i class="fa fa-download"></i></button>
              </td>
              <td class="middle">{{name}}</td>
              <td class="middle text-right">{{size}}</td>
              <td class="middle">{{date_modify}}</td>
            </tr>
          {{/each}}
        </tbody>
      </table>
    </div>
  {{/if}}
</script>

<script id="preview-logs-template" type="text/x-handlebarsTemplate">
  <div class="divider"></div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    {{#each this}} 
      {{{logx}}} 
    {{/each}}
  </div>
</script>