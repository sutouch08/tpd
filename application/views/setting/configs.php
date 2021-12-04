<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
    	<h4 class="title"><?php echo $this->title; ?></h4>
	</div>
</div>
<hr class="padding-5" />
<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 padding-5 padding-right-0" style="padding-top:5px;">
		<ul id="myTab1" class="setting-tabs" style="margin-left:0px;">
			<li class="li-block active"><a href="#company" data-toggle="tab">ข้อมูลบริษัท</a></li>
		  <li class="li-block"><a href="#document" data-toggle="tab">เลขที่เอกสาร</a></li>
			<li class="li-block"><a href="#SAP" data-toggle="tab">ข้อมูล SAP</a></li>
			<li class="li-block"><a href="#system" data-toggle="tab">ระบบ</a></li>
		</ul>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 padding-5" style="padding-top:5px; border-left:solid 1px #ccc; min-height:600px; max-height:1500px;">
		<div class="tab-content" style="border:0px;">

			<?php $this->load->view('setting/setting_company'); ?>
			<?php $this->load->view('setting/setting_document'); ?>
			<?php $this->load->view('setting/setting_sap'); ?>
			<?php $this->load->view('setting/setting_system'); ?>

		</div>
	</div><!--/ col-sm-9  -->
</div><!--/ row  -->


<script src="<?php echo base_url(); ?>scripts/setting/setting.js"></script>
<script src="<?php echo base_url(); ?>scripts/setting/setting_document.js"></script>
<?php $this->load->view('include/footer'); ?>
