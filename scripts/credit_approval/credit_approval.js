var HOME = `${BASE_URL}credit_approval/`;
var ORDER  = `${BASE_URL}orders/`;
var REQUEST_PAYMENT = `${BASE_URL}request_payment_order/`;

function goBack() {
	window.location.href = HOME;
}

$('#fromDate').datepicker({
	format:'dd-mm-yyyy',
	onClose:function(sd) {
		$('#toDate').datepicker('option', 'minDate', sd);
	}
});

$('#toDate').datepicker({
	format:'dd-mm-yyyy',
	onClose:function(sd) {
		$('#fromDate').datepicker('option', 'maxDate', sd);
	}
});

function preview(code) {
	load_in();

	$('#OrderCode').val(code);
	$('.a-btn').addClass('hide'); //-- hide all btn and will show only the btn that user can access

	$.ajax({
		url: `${HOME}get_order_detail`,
		type: 'GET',
		cache: false,
		data: {
			'code': code
		},
		success: function (rs) {
			load_out();
			if (isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status === 'success') {
					let data = ds.data;					
					let source = $('#preview-template').html();
					let output = $('#result');

					render(source, data, output);

					if(data.can_approve || data.can_review) {																	
						if(data.can_review && data.is_overdue && data.case_id == null) {							
							$('#btn-request').removeClass('hide');
							$('#btn-reject').removeClass('hide');
						}

						if(data.can_review && data.is_overdue && data.case_id != null && ! data.credit_review) {
							$('#btn-accept').removeClass('hide');
							$('#btn-reject').removeClass('hide');
						}

						if(data.can_approve && (! data.is_overdue || data.credit_review) ) {
							$('#btn-approve').removeClass('hide');
							$('#btn-reject').removeClass('hide');
						}
					}

					$('#preview-modal').modal('show');
				}
				else {
					showError(ds.message);
				}
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	})
}

function viewFile(code, fileName) {
	let width = 1000;
	let height = 600;
	let left = (screen.width - width) / 2;
	let top = (screen.height - height) / 2;
	let target = `${REQUEST_PAYMENT}open_file/${code}/${fileName}?nomenu&nonavbar`;
	window.open(target, "_blank", `width=${width}, height=${height}, left=${left}, top=${top}`);
}


function downloadFile(code, fileName) {
	let target = `${REQUEST_PAYMENT}download_file/${code}/${fileName}`;
	window.location.href = target;
}


function showAuthorize(code) {
	let diff = parseDefaultFloat(removeCommas($(`#credit-diff-${code}`).text()), 0);

	$.ajax({
		url: `${HOME}get_approver`,
		type: 'POST',
		cache: false,
		data: {			
			'diff': diff
		},
		success: function (rs) {
			if (isJson(rs)) {
				let source = $('#authorizer-template').html();
				let data = $.parseJSON(rs);
				let output = $('#authorizer-table');

				render(source, data, output);

				$('#authorizer-modal').modal('show');
			}
			else {
				swal({
					title: "Error!",
					text: rs,
					type: 'error'
				})
			}
		}
	})
}


function accept() {
	$('#preview-payment-modal').modal('hide');

	let code = $('#OrderCode').val().trim();

	swal({
		title:'Are you sure ?',
		text: `Do you want to accept this document : ${code} ?`,
		type: 'info',
		showCancelButton: true,
		confirmButtonColor: '#5cb85c',
		confirmButtonText: 'Accept',
		cancelButtonText: 'Cancel',
		closeOnConfirm: true
	}, function() {
		setTimeout(() => {
			doAccept();
		}, 300);
	});	
}


function doAccept() {
	let code = $('#OrderCode').val().trim();
	
	load_in();

	$.ajax({
		url:`${HOME}do_accept`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code
		},
		success:function(rs) {
			load_out();
			
			if(rs.trim() === 'success') {
				swal({
					title: "Success",
					type: 'success',
					timer: 1000
				});

				setTimeout(function() {
					window.location.reload();
				}, 1200);
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	});	
}


function approve() {
	$('#preview-modal').modal('hide');

	let code = $('#OrderCode').val();

	swal({
		title:'Are you sure ?',
		text: `Do you want to approve this order : ${code} ?`,
		type: 'info',
		showCancelButton: true,
		confirmButtonColor: '#5cb85c',
		confirmButtonText: 'Approve',
		cancelButtonText: 'Cancel',
		closeOnConfirm: true
	}, function() {
		setTimeout(() => {
			doApprove();
		}, 300);
	});
}


function doApprove() {
	let code = $('#OrderCode').val();	

	load_in();

	$.ajax({
		url:`${HOME}do_approve`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code
		},
		success:function(rs) {
			load_out();
			
			if(rs.trim() === 'success') {
				swal({
					title: "Success",
					type: 'success',
					timer: 1000
				});

				setTimeout(function() {
					window.location.reload();
				}, 1200);
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	});	
}


function reject() {
	let code = $('#OrderCode').val();
	swal({
		title:'Are you sure ?',
		text: `Do you want to reject this order : ${code} ?`,
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d9534f',
		confirmButtonText: 'Reject',
		cancelButtonText: 'Cancel',
		closeOnConfirm: true
	}, function() {
		setTimeout(() => {
			doReject();
		}, 300);
	});
}


function doReject() {
	let code = $('#OrderCode').val();	
	load_in();

	$.ajax({
		url:`${HOME}do_reject`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code
		},
		success:function(rs) {
			load_out();
			
			if(rs.trim() === 'success') {
				swal({
					title: "Success",
					type: 'success',
					timer: 1000
				});

				setTimeout(function() {
					window.location.reload();
				}, 1200);
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	});	
}


function addRequestPayment(code) {
	load_in();

	$.ajax({
		url:`${HOME}get_order_data`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code
		},
		success:function(rs) {
			load_out();

			if(isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status === 'success') {
					let data = ds.data;
					$('#payment-order-date').val(data.date);
					$('#payment-order-code').val(data.code);					
					$('#payment-user').val(`${data.emp_name}`);
					$('#payment-customer').val(data.customer);
					$('#payment-doc-total').val(data.doc_total);
					$('#payment-overdue-total').val(data.overdue);
					$('#payment-credit-diff').val(data.diff);
					$('#payment-message').val('').removeAttr('readonly').focus();
					$('#btn-send-request').removeClass('hide');

					$('#request-payment-modal').modal('show');
				}
				else {
					showError(ds.message);
				}
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	})
}


function requestPayments() {
	$('#preview-modal').modal('hide');

	let code = $('#OrderCode').val();
	let user = $('#user').val();
	let emp_name = $('#emp-name').val();
	let customer = $('#customer-name').val();
	let overdue = $('#overdue-amount').val();
	let diff = $('#diff-amount').val();

	$('#payment-order-code').val(code);
	$('#payment-user').val(`${user} | ${emp_name}`);
	$('#payment-customer').val(customer);
	$('#payment-credit-diff').val(diff);
	$('#payment-overdue-total').val(overdue);
	$('#payment-message').val('').removeAttr('readonly').focus();
	$('#btn-send-request').removeClass('hide');

	$('#request-payment-modal').modal('show');	
}


function sendRequest() {
	let code = $('#payment-order-code').val().trim();
	let message = $('#payment-message').val();		

	$('#request-payment-modal').modal('hide');

	$.ajax({
		url:`${HOME}send_request_payment`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code,
			'message' : message
		},
		success:function(rs) {
			if(rs.trim() === 'success') {
				swal({
					title: "Success",
					type: 'success',
					timer: 1000
				});

				setTimeout(function() {
					window.location.reload();
				}, 1200);
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	});
}


function viewRequestPayment(code) {
	$('#OrderCode').val(code);
	$('.p-btn').addClass('hide'); //-- hide all btn and will show only the btn that user can access
	load_in();
	$.ajax({
		url:`${HOME}get_request_payment_data`,
		type:'POST',
		cache:'false',
		data:{
			'code' : code
		},
		success:function(rs) {
			load_out();

			if(isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status === 'success') {
					let data = ds.data;
					$('#preview-payment-date').val(data.date);
					$('#preview-payment-order-code').val(data.code);					
					$('#preview-payment-customer').val(data.customer);
					$('#preview-payment-request-by').val(`${data.request_by}`);
					$('#preview-payment-request-date').val(data.request_date);
					$('#preview-payment-doc-total').val(data.doc_total);
					$('#preview-payment-credit-diff').val(data.diff);
					$('#preview-payment-overdue').val(data.overdue);
					$('#preview-payment-request-message').val(data.request_message);
					$('#preview-payment-reply-message').val(data.reply_message);

					if(data.has_document) {
						let source = $('#preview-files-template').html();
						let output = $('#preview-payment-file-list');
						render(source, data.files, output);
					}

					if(data.logs) {
						let source = $('#preview-logs-template').html();
						let output = $('#preview-payment-logs');
						render(source, data.logs, output);
					}

					if(data.can_review && data.status == 'O') {
						$('#btn-p-reject').removeClass('hide');
						$('#btn-p-approve').removeClass('hide');
					}

					$('#preview-payment-modal').modal('show');
				}
				else {
					showError(ds.message);
				}
			}
			else {
				showError(rs);
			}
		},
		error:function(rs) {
			showError(rs);
		}
	});
}

