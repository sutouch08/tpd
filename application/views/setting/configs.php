<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12">
    	<h4 class="title"><?php echo $this->title; ?></h4>
	</div>
</div>
<hr style="border-color:#CCC; margin-top: 15px; margin-bottom:0px;" />

<div class="row">
<div class="col-sm-2 padding-right-0" style="padding-top:15px;">
<ul id="myTab1" class="setting-tabs">
	<li class="li-block active"><a href="#company" data-toggle="tab">ข้อมูลบริษัท</a></li>
  <li class="li-block"><a href="#document" data-toggle="tab">เลขที่เอกสาร</a></li>
	<li class="li-block"><a href="#SAP" data-toggle="tab">ข้อมูล SAP</a></li>
	<li class="li-block"><a href="#PRINT" data-toggle="tab">ฟอร์มพิมพ์</a></li>
</ul>
</div>
<div class="col-sm-10" style="padding-top:15px; border-left:solid 1px #ccc; min-height:600px; max-height:1500px;">
<div class="tab-content" style="border:0px;">

<!---  ตั้งค่าบริษัท  ------------------------------------------------------>
<?php $this->load->view('setting/setting_company'); ?>
<!---  ตั้งค่าเอกสาร  --------------------------------------------------->
<?php $this->load->view('setting/setting_document'); ?>

<?php $this->load->view('setting/setting_sap'); ?>

<?php $this->load->view('setting/setting_print'); ?>



</div>
</div><!--/ col-sm-9  -->
</div><!--/ row  -->


<script src="<?php echo base_url(); ?>scripts/setting/setting.js"></script>
<script src="<?php echo base_url(); ?>scripts/setting/setting_document.js"></script>
<?php $this->load->view('include/footer'); ?>
