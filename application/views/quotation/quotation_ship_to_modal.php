<!--  Add New Address Modal  --------->
<div class="modal fade" id="shipToModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site text-center" >Ship To Address</h4>
            </div>
            <div class="modal-body">
            <input type="hidden" id="s_address" value="<?php echo $address->sBranchCode; ?>"/>
            <input type="hidden" id="s-block" value="<?php echo $address->sAddress; ?>"/>
            <input type="hidden" id="s-street" value="<?php echo $address->sStreet; ?>"/>
            <input type="hidden" id="s-subDistrict" value="<?php echo $address->sSubDistrict; ?>"/>
            <input type="hidden" id="s-district" value="<?php echo $address->sDistrict; ?>"/>
            <input type="hidden" id="s-province" value="<?php echo $address->sProvince; ?>"/>
            <input type="hidden" id="s-country" value="<?php echo $address->sCountry; ?>"/>
            <input type="hidden" id="s-postcode" value="<?php echo $address->sPostCode; ?>"/>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                	<label class="input-label">Street/PO Box/เลขที่ ตึก ชั้น..</label>
                    <input type="text" class="form-control input-sm" id="sBlock" placeholder="เลขที่, หมู่บ้าน(จำเป็น)" value="<?php echo $address->sAddress; ?>" />
                </div>

                <div class="col-sm-12 col-xs-12">
                	<label class="input-label">Street No./ถนน</label>
                    <input type="text" class="form-control input-sm"  id="sStreet" placeholder="ถนน" value="<?php echo $address->sStreet; ?>"/>
                </div>

                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">Block/ตำบล/แขวง</label>
                    <input type="text" class="form-control input-sm" id="sSubDistrict" placeholder="ตำบล" value="<?php echo $address->sSubDistrict; ?>"/>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">County/อำเภอ/เขต</label>
                    <input type="text" class="form-control input-sm" id="sDistrict" placeholder="อำเภอ (จำเป็น)" value="<?php echo $address->sDistrict; ?>" />
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">City/จังหวัด</label>
                    <input type="text" class="form-control input-sm" id="sProvince" placeholder="จังหวัด (จำเป็น)" value="<?php echo $address->sProvince; ?>"/>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">Country/ประเทศ</label>
                    <select class="form-control input-sm" id="sCountry">
                      <?php echo select_country($address->sCountry); ?>
                    </select>

                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control input-sm" id="sPostCode" placeholder="รหัสไปรษณีย์" value="<?php echo $address->sPostCode; ?>"/>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" onClick="updateShipTo()" ><i class="fa fa-save"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>
