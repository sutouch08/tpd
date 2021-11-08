<div class="tab-pane fade" id="document">
	<form id="documentForm" method="post" action="<?php echo $this->home; ?>/update_config">
    <div class="row">
			<div class="col-sm-12 col-xs-12 padding-5">
				Sales Quotation
			</div>
		</div>

		<div class="row">
    	<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Prefix</span>
					<input type="text"
					class="form-control input-sm input-small text-center prefix"
					name="PREFIX_QUOTATION" required
					value="<?php echo $PREFIX_QUOTATION; ?>" />
				</div>
			</div>
			<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Runnig</span>
					<input type="text"
					class="form-control input-sm input-small text-center digit"
					required name="RUN_DIGIT_QUOTATION"
					value="<?php echo $RUN_DIGIT_QUOTATION; ?>" />
				</div>
			</div>
			<div class="col-sm-3 col-xs-12 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Manual Export</span>
					<select class="form-control input-sm input-small" name="SQ_MANUAL_EXPORT">
						<option value="1" <?php echo is_selected($SQ_MANUAL_EXPORT, '1'); ?>>Yes</option>
						<option value="0" <?php echo is_selected($SQ_MANUAL_EXPORT, '0'); ?>>No</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12 padding-5">Activity</div>
		</div>

		<div class="row">
			<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Prefix</span>
					<input type="text"
					class="form-control input-sm input-small text-center prefix"
					name="PREFIX_ACTIVITY" required
					value="<?php echo $PREFIX_ACTIVITY; ?>" />
				</div>
			</div>
			<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Running</span>
					<input type="text"
					class="form-control input-sm input-small text-center digit" required
					name="RUN_DIGIT_ACTIVITY"
					value="<?php echo $RUN_DIGIT_ACTIVITY; ?>" />
				</div>
			</div>
			<div class="col-sm-3 col-xs-12 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Manual Export</span>
					<select class="form-control input-sm input-small" name="AC_MANUAL_EXPORT">
						<option value="1" <?php echo is_selected($AC_MANUAL_EXPORT, '1'); ?>>Yes</option>
						<option value="0" <?php echo is_selected($AC_MANUAL_EXPORT, '0'); ?>>No</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12 padding-5">
				Bussiness Partner
			</div>
		</div>

		<div class="row">
			<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Prefix</span>
					<input type="text"
					class="form-control input-sm input-small text-center prefix"
					name="PREFIX_BP" required
					value="<?php echo $PREFIX_BP; ?>" />
				</div>
			</div>
			<div class="col-sm-2 col-xs-6 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Runnig</span>
					<input type="text"
					class="form-control input-sm input-small text-center digit"
					required name="RUN_DIGIT_BP"
					value="<?php echo $RUN_DIGIT_BP; ?>" />
				</div>
			</div>
			<div class="col-sm-3 col-xs-12 padding-5 margin-bottom-15">
				<div class="input-group">
					<span class="input-group-addon">Manual Export</span>
					<select class="form-control input-sm input-small" name="BP_MANUAL_EXPORT">
						<option value="1" <?php echo is_selected($BP_MANUAL_EXPORT, '1'); ?>>Yes</option>
						<option value="0" <?php echo is_selected($BP_MANUAL_EXPORT, '0'); ?>>No</option>
					</select>
				</div>
			</div>
		</div>


      <div class="divider-hidden"></div>
			<div class="divider-hidden"></div>

			<div class="row">
				<div class="col-sm-7 col-xs-12 padding-5">
					<?php if($this->isAdmin) : ?>
						<p class="pull-right">
	      			<button type="button"
							class="btn btn-sm btn-success input-small text-center"
							onClick="checkDocumentSetting()">
							<i class="fa fa-save"></i> บันทึก
							</button>
						</p>
					<?php endif; ?>
	      </div>
			</div>

      <div class="divider-hidden"></div>

  </form>
</div>
