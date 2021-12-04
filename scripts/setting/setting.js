var HOME = BASE_URL + 'setting/';
function updateConfig(formName)
{
	load_in();
	var formData = $("#"+formName).serialize();
	$.ajax({
		url: HOME + "update_config",
		type:"POST",
    cache:"false",
    data: formData,
		success: function(rs){
			load_out();
      rs = $.trim(rs);
      if(rs == 'success'){
        swal({
          title:'Updated',
          type:'success',
          timer:1000
        });
      }else{
        swal('Error!', rs, 'error');
      }
		}
	});
}

function togglePWD(option) {
	$('#pwd').val(option);

	if(option == 1) {
		$('#btn-pwd-on').addClass('btn-primary');
		$('#btn-pwd-off').removeClass('btn-primary');
		return;
	}
	else
	{
		$('#btn-pwd-on').removeClass('btn-primary');
		$('#btn-pwd-off').addClass('btn-primary');
	}
}


function openSystem() {
	$('#closed').val(0);
	$('#btn-close').removeClass('btn-danger');
	$('#btn-open').addClass('btn-success');
}

function closeSystem() {
	$('#closed').val(1);
	$('#btn-open').removeClass('btn-success');
	$('#btn-close').addClass('btn-danger');
}
