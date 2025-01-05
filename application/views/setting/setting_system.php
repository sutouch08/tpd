<div class="tab-pane fade" id="system">
<?php
    $open     = $CLOSE_SYSTEM == 0 ? 'btn-success' : '';
    $close    = $CLOSE_SYSTEM == 1 ? 'btn-danger' : '';
    $freze    = $CLOSE_SYSTEM == 2 ? 'btn-warning' : '';
    $pwd_on   = $USE_STRONG_PWD == 1 ? 'btn-primary' : '';
    $pwd_off  = $USE_STRONG_PWD == 0 ? 'btn-primary' : '';
    $dis_on   = $USE_DISCSALE == 1 ? 'btn-primary' : '' ;
    $dis_off  = $USE_DISCSALE == 0 ? 'btn-primary' : '';
    $pm = get_permission('CLOSE_SYSTEM');
    $cando = ($pm->can_add + $pm->can_edit) > 0 ? TRUE : FALSE;
?>

  <form id="systemForm">
    <div class="row">
  	<?php if( $cando === TRUE ): //---- ถ้ามีสิทธิ์ปิดระบบ ---//	?>
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">ปิดระบบ</span></div>
      <div class="col-lg-3 col-md-9 col-sm-9 col-xs-12">
        <div class="btn-group input-xlarge">
        	<button type="button" class="btn btn-sm <?php echo $open; ?>" style="width:33%;" id="btn-open" onClick="openSystem()">เปิด</button>
          <button type="button" class="btn btn-sm <?php echo $close; ?>" style="width:33%;" id="btn-close" onClick="closeSystem()">ปิด</button>
          <button type="button" class="btn btn-sm <?php echo $freze; ?>" style="width:34%" id="btn-freze" onclick="frezeSystem()">ดูอย่างเดียว</button>
        </div>

      	<input type="hidden" name="CLOSE_SYSTEM" id="closed" value="<?php echo $CLOSE_SYSTEM; ?>" />
      </div>
      <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12">
        <span class="help-block">กรณีปิดระบบจะไม่สามารถเข้าใช้งานระบบได้ในทุกส่วน โปรดใช้ความระมัดระวังในการกำหนดค่านี้</span>
      </div>
      <div class="divider-hidden"></div>

    <?php endif; ?>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Strong Password</span></div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
      <div class="btn-group width-100">
        <button type="button" class="btn btn-sm <?php echo $pwd_on; ?>" style="width:50%;" id="btn-pwd-on" onClick="togglePWD(1)">เปิด</button>
        <button type="button" class="btn btn-sm <?php echo $pwd_off; ?>" style="width:50%;" id="btn-pwd-off" onClick="togglePWD(0)">ปิด</button>
      </div>
      <input type="hidden" name="USE_STRONG_PWD" id="pwd" value="<?php echo $USE_STRONG_PWD; ?>" />
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12">
      <span class="help-block">เมื่อเปิดใช้งาน การตั้งรหัสผ่านจะต้องมีความซับซ้อน โดยรหัสผ่านจะต้องมีความยาวไม่น้อยกว่า 8 ตัวอักษรและต้องประกอบด้วย ตัวอัษรพิมพ์ใหญ่ พิมพ์เล็ก ตัวเลข และสัญลักษณ์พิเศษ อย่างน้อยอย่างละ 1 ตัว</span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Discount Sales</span></div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
      <div class="btn-group width-100">
        <button type="button" class="btn btn-sm <?php echo $dis_on; ?>" style="width:50%;" id="btn-dis-on" onClick="toggleDis(1)">เปิด</button>
        <button type="button" class="btn btn-sm <?php echo $dis_off; ?>" style="width:50%;" id="btn-dis-off" onClick="toggleDis(0)">ปิด</button>
      </div>
      <input type="hidden" name="USE_DISCSALE" id="dis" value="<?php echo $USE_DISCSALE; ?>" />
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12">
      <span class="help-block">เปิด/ปิด การใช้งาน Discount Sales</span>
    </div>
    <div class="divider-hidden"></div>


    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Sync logs</span></div>
    <div class="col-lg-1-harf col-md-2 col-sm-2-harf col-xs-8">
      <div class="input-group">
        <input type="text" class="form-control input-sm input-small" name="KEEP_SYNC_LOGS" value="<?php echo $KEEP_SYNC_LOGS; ?>" />
        <span class="input-group-addon"> วัน</span>
      </div>
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12">
      <span class="help-block">เก็บ Sync logs ระหว่าง Web กับ SAP ไว้ไม่เกินจำนวนวันที่กำหนด</span>
    </div>
    <div class="divider-hidden"></div>
    <div class="divider-hidden"></div>

    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12">
      <?php if($this->pm->can_add OR $this->pm->can_edit OR $cando) : ?>
      <button type="button" class="btn btn-sm btn-success" onClick="updateConfig('systemForm')"><i class="fa fa-save"></i> บันทึก</button>
      <?php endif; ?>
    </div>
    <div class="divider-hidden"></div>

    </div><!--/row-->
  </form>
</div><!--/ tab pane -->
