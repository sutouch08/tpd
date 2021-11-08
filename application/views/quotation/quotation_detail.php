<?php $this->load->view('include/header'); ?>
<style>
	.bg-green {
		background-color: #dfebd5;
	}

	td {
		white-space: normal;
		border:0 !important;
	}
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery.autosize.js"></script>
<div class="row">
	<div class="col-sm-4 col-xs-12 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
    </div>
    <div class="col-sm-8 col-xs-12 padding-5">
    	<p class="pull-right top-p">
        <button type="button" class="btn btn-xs btn-default" onclick="goBack()"><i class="fa fa-arrow-left"></i> &nbsp; Back</button>
				<button type="button" class="btn btn-xs btn-info" onclick="printQuotation('normal')"><i class="fa fa-print"></i> ใบเสนอราคา</button>
				<button type="button" class="btn btn-xs btn-info" onclick="printQuotation('nodiscount')"><i class="fa fa-print"></i> ใบเสนอราคา(ไม่แสดงส่วนลด)</button>
				<?php if(getConfig('ALLOW_DUPLICATE_QUOTATION') == 1) : ?>
				<button type="button" class="btn btn-xs btn-primary" onclick="duplicateSQ()"><i class="fa fa-copy"></i> คัดลอกใบเสนอราคา</button>
				<?php endif; ?>
				<?php if($header->Approved !== 'A' && !$in_draft) : ?>
					<button type="button" class="btn btn-xs btn-warning" onclick="goEdit('<?php echo $header->code; ?>')"><i class="fa fa-pencil"></i> แก้ไข</button>
				<?php endif; ?>
				<?php if($header->must_approve == 1 && $header->Approved === 'P' && $can_approve) : ?>
					<button type="button" class="btn btn-xs btn-success" onclick="doApprove()"><i class="fa fa-check"></i> อนุมัติ</button>
					<button type="button" class="btn btn-xs btn-danger" onclick="doReject()"><i class="fa fa-times"></i> ไม่อนุมัติ</button>
				<?php endif; ?>
				<?php if($header->Approved === 'A' && empty($header->DocNum)) : ?>
					<button type="button" class="btn btn-xs btn-warning" onclick="unApprove()">ยกเลิกการอนุมัติ</button>
				<?php endif; ?>
				<?php if((getConfig('SQ_MANUAL_EXPORT') == 1 OR $header->Status == 1 OR $header->Status == 3) && ($header->Approved === 'A' OR $header->Approved === 'S')) : ?>
					<button type="button" class="btn btn-xs btn-success" onclick="sendToSAP()"><i class="fa fa-send"></i> Send To SAP</button>
				<?php endif; ?>
      </p>
    </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="addForm" method="post" action="">
<?php $this->load->view('quotation/quotation_preview_header'); ?>
<?php $this->load->view('quotation/quotation_preview_detail'); ?>
<?php $this->load->view('quotation/quotation_preview_footer'); ?>
<input type="hidden" name="code" id="code" value="<?php echo $header->code; ?>" />
<input type="hidden" id="sq-code" value="<?php echo $header->code; ?>" />
</form>


<script src="<?php echo base_url(); ?>scripts/quotation/quotation.js?v=<?php echo date('YmdH'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/quotation/quotation_add.js?v=<?php echo date('YmdH'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
