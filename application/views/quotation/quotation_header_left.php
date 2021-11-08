<div class="col-sm-6 col-xs-12 padding-5">
  <div class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Customer</label>
      <div class="col-sm-3 col-xs-12">
        <input type="text" id="CardCode" class="form-control input-sm" autofocus/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Name</label>
      <div class="col-sm-7 col-xs-12">
        <input type="text" id="CardName" class="form-control input-sm" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Contact Person</label>
      <div class="col-sm-7 col-xs-12">
        <select class="form-control input-sm" id="Contact">
          <option value=""></option>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Customer Ref</label>
      <div class="col-sm-3 col-xs-12">
        <input type="text" id="NumAtCard" class="form-control input-sm"  />
      </div>
      <label class="col-sm-1 col-xs-12 control-label no-padding-right">ID</label>
      <div class="col-sm-3 col-xs-12">
        <input type="text" id="LicTradNum" class="form-control input-sm" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Currency</label>
      <div class="col-sm-2 col-xs-6" style="padding-left:11px; padding-right:5px;">
        <select class="form-control input-sm" id="Currency">
          <?php echo select_currency(); ?>
        </select>
      </div>
      <div class="col-sm-2 col-xs-6 padding-5">
        <input type="number" class="form-control input-sm text-right" id="Rate" value="1.00">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Project</label>
      <div class="col-sm-7 col-xs-12">
        <select class="form-control input-sm" id="Project">
          <option value=""></option>
          <?php echo select_project(); ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">ฝ่าย</label>
      <div class="col-sm-7 col-xs-12">
        <select class="form-control input-sm" id="Department">
          <option value=""></option>
          <?php echo select_department($this->user->department_code); ?>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">แผนก</label>
      <div class="col-sm-7 col-xs-12">
        <select class="form-control input-sm" id="Division">
          <option value=""></option>
          <?php echo select_division($this->user->division_code); ?>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">ประเภทการขาย</label>
      <div class="col-sm-7 col-xs-12">
        <select class="form-control input-sm" id="SaleType">
          <option value=""></option>
          <?php echo select_sale_type(); ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 col-xs-12 control-label no-padding-right">Ship To</label>
      <div class="col-sm-3 col-xs-6" style="padding-right:5px;">
        <select class="form-control input-sm" id="shipToCode" onchange="get_address_ship_to()"></select>
      </div>
      <div class="col-sm-4 col-xs-6" style="padding-left:5px;">
        <input type="text" class="form-control input-sm" id="s-branch" readonly/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 hidden-xs control-label no-padding-right"></label>
      <div class="col-sm-7 col-xs-12">
        <textarea id="ShipTo" class="autosize autosize-transition form-control" readonly></textarea>
        <span class="badge badge-yellow pull-right margin-top-5"
        style="padding-bottom:0px; padding-top: 0px; border-radius:3px; cursor:pointer;" onclick="editShipTo()">
          <i class="fa fa-ellipsis-h"></i>
        </span>
      </div>
    </div>
  </div>
</div>
