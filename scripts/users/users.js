var HOME = BASE_URL + 'users/';
var uname_error = 0;
var pwd_error = 0;
var emp_error = 0;
var ugroup_error = 0;
var area_error = 0;


function goBack() {
  window.location.href = HOME;
}


function goAdd() {
  window.location.href = HOME + 'add_new';
}


function goEdit(id) {
  window.location.href = HOME + 'edit/'+id;
}



function goReset(id)
{
  window.location.href = HOME + 'reset_password/'+id;
}


function getDelete(id, uname){
  swal({
    title:'Are sure ?',
    text:'ต้องการลบ '+ uname +' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ใช่, ฉันต้องการลบ',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: false
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
            text:'User has been deleted',
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


function add() {
  clearErrorByClass('e');
  uname_error = 0;
  emp_error = 0;
  ugroup_error = 0;
  area_error = 0;

  let h = {
    'uname' : $('#uname').val().trim(),
    'emp_id' : $('#emp').val(),
    'emp_name' : $('#emp option:selected').text(),
    'sale_id' : $('#saleman').val(),
    'sale_name' : $('#saleman option:selected').text(),
    'pwd' : $('#pwd').val().trim(),
    'ugroup' : $('#ugroup').val(),
    'area_id' : $('#area').val(),
    'status' : $('#status').is(':checked') ? 1 : 0,
    'bi' : $('#bi').is(':checked') ? 1 : 0,
    'role' : $('#u_role').val(),
    'team' : [],
    'price_list' : []
  };

  if(h.uname.length == 0) {
    $('#uname').hasError('Required');
    uname_error = 1;
  }

  if(h.pwd.length == 0) {
    $('#pwd').hasError('Required');
    pwd_error = 1;
  }

  if(h.emp_id == '') {
    $('#emp').hasError('Required');
    emp_error = 1;
  }

  if(h.ugroup == '') {
    $('#ugroup').hasError('Required');
    ugroup_error = 1;
  }

  if(h.role == 'sales' && h.area_id == '') {
    $('#area').hasError('Required when User Role = Sales');
    area_error = 1;
  }

  let error = uname_error + emp_error + pwd_error + ugroup_error + area_error;

  if( error > 0) {
    return false;
  }

  $('.chk:checked').each(function() {
    h.price_list.push({"id" : $(this).val(), "name" : $(this).data('name')});
  });

  if($('.team-list').length) {
    $('.team-list').each(function() {
      h.team.push({'team_id' : $(this).val(), 'user_role' : $(this).data('role')});
    })
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
        title:"Error",
        text:"Error-"+xhr.responseText,
        type:"error",
        html:true
      });
    }
  })
}


function update() {
  clearErrorByClass('e');
  uname_error = 0;
  emp_error = 0;
  ugroup_error = 0;

  let h = {
    'id' : $('#id').val(),
    'emp_id' : $('#emp').val(),
    'emp_name' : $('#emp option:selected').text(),
    'sale_id' : $('#saleman').val(),
    'sale_name' : $('#saleman option:selected').text(),
    'ugroup' : $('#ugroup').val(),
    'status' : $('#status').is(':checked') ? 1 : 0,
    'bi' : $('#bi').is(':checked') ? 1 : 0,
    'role' : $('#u_role').val(),
    'team' : [],
    'price_list' : []
  };


  if(h.emp_id == '') {
    $('#emp').hasError('Required');
    emp_error = 1;
  }

  if(h.ugroup == '') {
    $('#ugroup').hasError('Required');
    ugroup_error = 1;
  }

  let error = emp_error + ugroup_error;

  if( error > 0) {
    return false;
  }

  $('.chk:checked').each(function() {
    h.price_list.push({"id" : $(this).val(), "name" : $(this).data('name')});
  });

  if($('.team-list').length) {
    $('.team-list').each(function() {
      h.team.push({'team_id' : $(this).val(), 'user_role' : $(this).data('role')});
    })
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
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
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
        title:"Error",
        text:"Error-"+xhr.responseText,
        type:"error",
        html:true
      });
    }
  })
}


function check_uname() {
  let uname = $('#uname').val().trim();

  $.ajax({
    url:HOME + 'is_exists_uname',
    type:'POST',
    cache:false,
    data:{
      'uname' : uname
    },
    success:function(rs) {
      if(rs.trim() == 'success') {
        $('#uname').clearError();
        uname_error = 0;
      }
      else {
        $('#uname').hasError(rs);
        uname_error = 1;
      }
    }
  })
}


function validatePassword(input) {
	let passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
  return input.match(passw);
}


function check_pwd() {
  pwd_error = 0;
  $('#pwd').clearError();
  $('#cfpwd').clearError();

  let use_strong_pwd = $('#use_strong_pwd').val();
  let pwd = $('#pwd').val().trim();
  let cfpwd = $('#cfpwd').val().trim();

  if(use_strong_pwd == 1) {
    //--- check pwd is strong or not
    if( ! validatePassword(pwd)) {
      errmsg = 'The password must have at least 8 characters, at least 1 digit(s), at least 1 lower case letter(s), at least 1 upper case letter(s), at least 1 non-alphanumeric character(s) ';
			$('#pwd').hasError(errmsg);
			pwd_error = 1;
      return false;
		}
  }

  if(pwd.length < 6) {
    $('#pwd').hasError('The password must have at least 6 characters');
    pwd_error = 1;
    return false;
  }


  if(pwd !== cfpwd) {
    $('#cfpwd').hasError("Password didn't match");
    pwd_error = 1;
  }
}


$('#pwd').focusout(function(){
  check_pwd();
})


$('#cfpwd').focusout(function(){
  check_pwd();
})


function reset_password() {
  let id = $('#user_id').val();
  let pwd = $('#pwd').val().trim();
  let cfpwd = $('#cfpwd').val().trim();

  if(pwd.length == 0) {
    $('#pwd').hasError('Required');
    $('#pwd').focus();
    return false;
  }

  if(pwd !== cfpwd) {
    $('#cfpwd').hasError('Password Mismatch');
    $('#cfpwd').focus();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'change_password',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'pwd' : pwd
    },
    success:function(rs) {
      load_out();

      if(rs.trim() === 'success') {
        swal({
          title:'Success',
          text:'Password has been changed',
          type:'success',
          timer:1000
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


$('#uname').focusout(function(){
  uname_error = 0;
  let uname = $('#uname').val().trim();

  if(uname.length) {
    return check_uname();
  }
  else {
    $('#uname').hasError('Required');
    uname_error = 1;
  }
});


$('#emp').focusout(function() {
  emp_error = 0;

  if($('#emp').val() == '') {
    $('#emp').hasError('Required');
    emp_error = 1;
  }
})


$('#ugroup').focusout(function() {
  ugroup_error = 0;
  if($('#ugroup').val() == '') {
    $('#ugroup').hasError('Required');
    ugroup_error = 1;
  }
})


$('#uname').keyup(function(e){
  if(e.keyCode === 13) {
    $('#pwd').focus();
  }
})


$('#pwd').keyup(function(e){
  if(e.keyCode === 13) {
    $('#cfpwd').focus();
  }
})


$('#cfpwd').keyup(function(e){
  if(e.keyCode === 13) {
    $('#emp').focus();
  }
})


$('#status').keyup(function(e){
  if(e.keyCode === 13) {
    $('#btn-save').focus();
  }
})


function addTeam() {
  $('#sale_team').clearError();

  let team_id = $('#sale_team').val();
  let name = $('#sale_team option:selected').text();
  let role = $('#role').val();
  let no = role + '-' + team_id;

  if(team_id == "") {
    $('#sale_team').hasError();
    return false;
  }

  if($('#team-'+no).length == 0) {
    let source = $('#tag-template').html();
    let data = {
      "no" : no,
      "team_id" : team_id,
      "name" : name,
      "role" : role
    };

    let output = $('#user-team-list');

    render_append(source, data, output);

    $('#sale_team').val('');
    $('#role').val('Sales');
    $('#team-list').removeClass('hide');
  }
}


function removeTag(id) {
  $('#tag-'+id).remove();
  $('#team-'+id).remove();

  if($('.team-list').length == 0) {
    $('#team-list').addClass('hide');
  }
}


$('#chk-all').change(function(){
  if($(this).is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
})
