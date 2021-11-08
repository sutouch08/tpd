var HOME = BASE_URL + 'approver/';
var uname_error = 1;
var cond_error = 1;
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


function saveAdd() {

  var arr = [
    {'el' : 'uname', 'label':'uname-error', 'error':'uname_error'},
    {'el' : 'conditions', 'label' : 'conditions-error', 'error' : 'cond_error'},
    {'el' : 'amount', 'label' : 'amount-error', 'error' : 'amount_error'}
  ];

  arr.forEach(check_value);

  var error = uname_error + cond_error + amount_error;

  if( error > 0) {
    return false;
  }

  let uname = $('#uname').val();
  let conditions = $('#conditions').val();
  let amount = parseDefault(parseFloat($('#amount').val()), 0);
  let status = $('#status').is(':checked') ? 1 : 0;

  if(amount <= 0) {
    $('#amount').addClass('has-error');
    $('#amount-error').text("Approve amount must be greater than 0");
    $('#amount').focus();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'uname' : uname,
      'conditions' : conditions,
      'amount' : amount,
      'status' : status
    },
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
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
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:'Error!',
        text:'Error: '+xhr.responseText,
        type:'error',
        html:true
      });
    }
  })
}



function update() {

  var arr = [
    {'el' : 'conditions', 'label' : 'conditions-error', 'error' : 'cond_error'},
    {'el' : 'amount', 'label' : 'amount-error', 'error' : 'amount_error'}
  ];

  arr.forEach(check_value);

  var error = cond_error + amount_error;

  if( error > 0) {
    return false;
  }

  let id = $('#id').val();
  let conditions = $('#conditions').val();
  let amount = parseDefault(parseFloat($('#amount').val()), 0);
  let status = $('#status').is(':checked') ? 1 : 0;

  if(amount <= 0) {
    $('#amount').addClass('has-error');
    $('#amount-error').text("Approve amount must be greater than 0");
    $('#amount').focus();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'conditions' : conditions,
      'amount' : amount,
      'status' : status
    },
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1200
        });

      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:'Error!',
        text:'Error: '+xhr.responseText,
        type:'error',
        html:true
      });
    }
  })
}



function getDelete(id, name){
  swal({
    title:'Are sure ?',
    text:'Do you really want to delete '+ name +' ? <br/> This process cannot be undone.',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'Delete',
		cancelButtonText: 'Cancle',
		closeOnConfirm: false,
    html:true
  },function(){
    $.ajax({
      url: HOME + 'delete',
      type:'POST',
      cache:false,
      data:{
        'id' : id,
        'uname' : name
      },
      success:function(rs){
        if(rs == 'success'){
          swal({
            title:'Success',
            text:'Approver has been deleted',
            type:'success',
            time: 1000
          });

          setTimeout(function(){
            window.location.reload();
          }, 1500)

        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }
      }
    })
  })
}

$('#uname').autocomplete({
  source: BASE_URL + 'auto_complete/get_user_and_emp',
  autoFocus:true,
  close:function() {
    var rs = $.trim($(this).val());
    if(rs === 'Not found') {
      $(this).val('');
    }
    else {
      var arr = rs.split(' | ');
      if(arr.length === 2) {
        $(this).val(arr[0]); //--- uname
        $('#emp_name').val(arr[1]); //--- emp name
      }
      else {
        $(this).val('');
      }
    }
  }
});



$('#uname').focusout(function(){
  validData($(this), $('#uname-error'), "uname_error");
});


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
