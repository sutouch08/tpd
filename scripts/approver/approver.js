var HOME = BASE_URL + 'approver/';
var uname_error = 1;
var amount_error = 1;

function goBack() {
  window.location.href = HOME;
}


function goAdd() {
  window.location.href = HOME + 'add_new';
}


function goEdit(id) {
  window.location.href = HOME + 'edit/'+id;
}


$('#uname').change(function() {
  let uname = $('#uname').val();
  let name = $('#uname option:selected').data('name');
  $('#emp_name').val(name);
});


function add() {
  clearErrorByClass('e');

  let h = {
    'uname' : $('#uname').val(),
    'emp_name' : $('#emp_name').val(),
    'amount' : parseDefault(parseFloat($('#amount').val()), 0),
    'status' : $('#status').is(':checked') ? 1 : 0
  }

  if(h.uname == '') {
    $('#uname').hasError('Required');
    return false;
  }

  if(h.amount <= 0) {
    $('#amount').hasError('Approve amount must be greater than 0');
    $('#amount').focus();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'data' : JSON.stringify(h)
    },
    success:function(rs) {
      load_out();

      if(rs.trim() === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(function(){
          goAdd();
        }, 1200);
      }
      else {
        showError(rs);
      }
    },
    error:function(rs) {
      load_out();
      showError(rs);
    }
  })
}



function update() {
  clearErrorByClass('e');

  let h = {
    'id' : $('#id').val(),
    'uname' : $('#uname').val(),
    'amount' : parseDefault(parseFloat($('#amount').val()), 0),
    'status' : $('#status').is(':checked') ? 1 : 0
  }

  if(h.amount <= 0) {
    $('#amount').hasError("Approve amount must be greater than 0");
    $('#amount').focus();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'data' : JSON.stringify(h)
    },
    success:function(rs) {
      load_out();

      if(rs.trim() === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1200
        });
      }
      else {
        showError(rs);
      }
    },
    error:function(rs) {
      load_out();
      showError(rs);
    }
  })
}


function getDelete(id, uname){
  swal({
    title:'Are sure ?',
    text:'Do you really want to delete '+ uname +' ? <br/> This process cannot be undone.',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'Delete',
		cancelButtonText: 'Cancle',
		closeOnConfirm: true,
    html:true
  }, function() {
    load_in();

    setTimeout(() => {
      $.ajax({
        url:HOME + 'delete',
        type:'POST',
        cache:false,
        data:{
          'id' : id,
          'uname' : uname
        },
        success:function(rs) {
          load_out();

          if(rs.trim() === 'success') {
            swal({
              title:'Success',
              text:'Approver has been deleted',
              type:'success',
              time: 1000
            });

            setTimeout(function(){
              window.location.reload();
            }, 1200)
          }
          else {
            showError(rs);
          }
        },
        error:function(rs) {
          load_out();
          showError(rs);
        }
      })
    }, 100);    
  })
}


$('#gp').focusout(function(){
  validData($(this), $('#gp-error'), "gp-errror");
})

$('#gp').keyup(function(){
  var disc = $(this).val();

  var disc = parseFloat(disc);
  if(disc > 100) {
    $(this).val(100);
  }

  if(disc < 0) {
    $(disc).val(0);
  }
})


function check_value(item, index) {
  let el = $('#'+item.el);
  let label = $('#'+item.label);
  let error = item.error;

  validData(el, label, error);
}

function validData(el, label, error) {
  if(el.val() == '') {
    set_error(el, label, "Required");
    window[error] = 1;
  }
  else {
    clear_error(el, label);
    window[error] = 0;
  }
}


$('#sale_team').focusout(function() {
  validData($(this), $('#sale-team-error'), 'team_error');
})
