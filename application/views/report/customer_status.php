<?php $this->load->view('include/header'); ?>
<div class="row hidden-print h-row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
		<h4 class="title"><?php echo $this->title; ?></h4>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
		<p class="pull-right top-p visible-lg">
			<button type="button" class="btn btn-sm btn-success" onclick="getReport()"><i class="fa fa-bar-chart"></i> รายงาน</button>
			<button type="button" class="btn btn-sm btn-primary" onclick="doExport()"><i class="fa fa-file-excel-o"></i> Export</button>
		</p>
	</div>
</div><!-- End Row -->
<hr />
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive" id="result">
		<div class="alert alert-info text-center">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>
			<strong>แสดงเฉพาะลูกค้าไม่ประจำที่มีอายุเกิน 3 เดือนและเคยเปิด invoice แล้วอย่างน้อย 3 ใบ. </strong>
		</div>
	</div>
</div>

<form id="reportForm" method="post" action="<?php echo $this->home . '/do_export'; ?>">
	<input type="hidden" name="token" id="token" value="">
</form>

<script id="report-template" type="text/x-handlebarsTemplate">
	<table class="table table-striped tableNarrow border-1" style="min-width:700px;">
		<thead>
			<tr>
				<th class="fix-width-50 text-center">#</th>
				<th class="fix-width-100">Code</th>
				<th class="min-width-250">Name</th>
				<th class="fix-width-100">Create Date</th>
				<th class="fix-width-100 text-center">Duration (days)</th>
				<th class="fix-width-100 text-center">Invoice Count</th>
			</tr>
		</thead>
		<tbody>
			{{#each this}}
				{{#if nodata}}
					<tr>
						<td colspan="6" class="text-center">--- Not found ---</td>
					</tr>
				{{else}}
					<tr>
						<td class="text-center no">{{no}}</td>
						<td class="middle">{{CardCode}}</td>
						<td class="middle">{{CardName}}</td>
						<td class="middle">{{CreateDate}}</td>
						<td class="middle text-center">{{Duration}}</td>
						<td class="middle text-center">{{InvoiceCount}}</td>
					</tr>
				{{/if}}
			{{/each}}
		</tbody>
	</table>	
</script>


<script src="<?php echo base_url(); ?>scripts/report/customer_status.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>