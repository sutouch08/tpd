<!--  Add New Address Modal  --------->
<div class="modal fade" id="billToModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-site text-center" >Bill To Address</h4>
            </div>
            <div class="modal-body">
            <form	>
            <input type="hidden" id="b_address" value="<?php echo $address->bBranchCode; ?>"/>
            <input type="hidden" id="b-block" value="<?php echo $address->bAddress; ?>"/>
            <input type="hidden" id="b-street" value="<?php echo $address->bStreet; ?>"/>
            <input type="hidden" id="b-subDistrict" value="<?php echo $address->bSubDistrict; ?>"/>
            <input type="hidden" id="b-district" value="<?php echo $address->bDistrict; ?>"/>
            <input type="hidden" id="b-province" value="<?php echo $address->bProvince; ?>"/>
            <input type="hidden" id="b-country" value="<?php echo $address->bCountry; ?>"/>
            <input type="hidden" id="b-postcode" value="<?php echo $address->bPostCode; ?>"/>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                	<label class="input-label">Street/PO Box/เลขที่ ตึก ชั้น..</label>
                    <input type="text" class="form-control input-sm" id="bBlock" placeholder="เลขที่, หมู่บ้าน(จำเป็น)" value="<?php echo $address->bAddress; ?>" />
                </div>

                <div class="col-sm-12 col-xs-12">
                	<label class="input-label">Street No./ถนน</label>
                    <input type="text" class="form-control input-sm"  id="bStreet" placeholder="ถนน" value="<?php echo $address->bStreet; ?>" />
                </div>

                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">Block/ตำบล/แขวง</label>
                    <input type="text" class="form-control input-sm" id="bSubDistrict" placeholder="ตำบล" value="<?php echo $address->bSubDistrict; ?>" />
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">County/อำเภอ/เขต</label>
                    <input type="text" class="form-control input-sm" id="bDistrict" placeholder="อำเภอ (จำเป็น)" value="<?php echo $address->bDistrict; ?>"/>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">City/จังหวัด</label>
                    <input type="text" class="form-control input-sm" id="bProvince" placeholder="จังหวัด (จำเป็น)" value="<?php echo $address->bProvince; ?>"/>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">Country/ประเทศ</label>
                  <select class="form-control input-sm" id="bCountry">
                    <?php echo select_country($address->bCountry); ?>
                  </select>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<label class="input-label">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control input-sm" id="bPostCode" placeholder="รหัสไปรษณีย์" value="<?php echo $address->bPostCode; ?>"/>
                </div>
            </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" onClick="updateBillTo()" ><i class="fa fa-save"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>
