var HOME = BASE_URL + 'users/';
var uname_error = 1;
var pwd_error = 1;
var emp_error = 1;
//var sale_error = 1;
var ugroup_error = 1;


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
            text:'Sales Team has been deleted',
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



function saveAdd() {
  var arr = [
    {'el' : 'uname', 'label':'uname-error', 'error':'uname_error'},
    {'el' : 'emp', 'label' : 'emp-error', 'error' : 'emp_error'},
    {'el' : 'ugroup', 'label' : 'ugroup-error', 'error' : 'ugroup_error'}
  ];

  arr.forEach(check_value);


  var error = uname_error + emp_error + pwd_error + ugroup_error;

  if( error > 0) {
    return false;
  }

  let uname = $('#uname').val();
  let emp_id = $('#emp').val();
  let emp_name = $('#emp :selected').text();
  let sale_id = $('#saleman').val();
  let pwd = $('#pwd').val();
  let ugroup = $('#ugroup').val();
  let status = $('#status').is(':checked') ? 1 : 0;
  let team = [];

  $('.team-list').each(function() {
    let team_list = {
      "team_id" : $(this).val(),
      "user_role" : $(this).data('role')
    }

    team.push(team_list);
  });




  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'uname' : uname,
      'emp_id' : emp_id,
      'emp_name' : emp_name,
      'sale_id' : sale_id,
      'pwd' : pwd,
      'ugroup' : ugroup,
      'status' : status,
      'user_team' : JSON.stringify(team)
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
  var arr = [
    {'el' : 'emp', 'label' : 'emp-error', 'error' : 'emp_error'},
    {'el' : 'ugroup', 'label' : 'ugroup-error', 'error' : 'ugroup_error'}
  ];

  arr.forEach(check_value);


  var error = emp_error + ugroup_error;

  if( error > 0) {
    return false;
  }

  let id = $('#id').val();
  let emp_id = $('#emp_id').val();
  let emp_name = $('#emp option:selected').text();
  let sale_id = $('#saleman').val();
  let ugroup = $('#ugroup').val();
  let status = $('#status').is(':checked') ? 1 : 0;
  let team = [];

  $('.team-list').each(function() {
    let team_list = {
      "team_id" : $(this).val(),
      "user_role" : $(this).data('role')
    }

    team.push(team_list);
  });

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'user_id' : id,
      'emp_id' : emp_id,
      'emp_name' : emp_name,
      'sale_id' : sale_id,
      'ugroup' : ugroup,
      'status' : status,
      'user_team' : JSON.stringify(team)
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


function check_value(item, index) {
  let el = $('#'+item.el);
  let label = $('#'+item.label);
  let error = item.error;

  validData(el, label, error);
}


function check_uname() {
  var el_uname = $('#uname');
  var label = $('#uname-error');
  var uname = $.trim($('#uname').val());
  var old_uname = $('#old_uname').val();

  $.ajax({
    url:HOME + 'is_exists_uname',
    type:'POST',
    cache:false,
    data:{
      'uname' : uname,
      'old_uname' : old_uname
    },
    success:function(rs) {
      var rs = $.trim(rs);
      if(rs === 'success') {
        clear_error(el_uname, label);
        uname_error = 0;
      }
      else {
        set_error(el_uname, label, rs);
        uname_error = 1;
      }
    }
  })
}

//-- use to validate password is strong or not
function validatePassword(input)
{
	var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;

	if(input.match(passw))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function check_pwd() {
  var use_strong_pwd = $('#use_strong_pwd').val();
  var pwd = $('#pwd').val();
  var cfpwd = $('#cfpwd').val();
  var el = $('#cfpwd');
  var label = $('#cfpwd-error');

  if(use_strong_pwd == 1) {
    //--- check pwd is strong or not
    if(!validatePassword(pwd)) {
			$('#pwd-error').text('The password must have at least 8 characters, at least 1 digit(s), at least 1 lower case letter(s), at least 1 upper case letter(s), at least 1 non-alphanumeric character(s) ');
      $('#pwd').addClass('has-error');
			pwd_error = 1;
      return false;
		}
		else {
			$('#pwd-error').text('');
			$('#pwd').removeClass('has-error');
			pwd_error = 0;
		}
  }
  else {
    if(pwd.length < 6) {
      $('#pwd-error').text('The password must have at least 6 characters');
      $('#pwd').addClass('has-error');
      pwd_error = 1;
      return false;
    }
    else {
      $('#pwd-error').text('');
			$('#pwd').removeClass('has-error');
			pwd_error = 0;
    }
  }


  if(pwd !== cfpwd) {
    set_error(el, label, "Password didn't match");
    pwd_error = 1;
  }
  else {
    clear_error(el, label);
    pwd_error = 0;
  }
}


$('#pwd').focusout(function(){
  var pwd = $(this).val();
  if(pwd.length > 0) {
    check_pwd();
  }
})


$('#cfpwd').focusout(function(){
  check_pwd();
})


function validData(el, label, error) {
  if(el.val() == '') {
    set_error(el, label, "Required");
    window[error] = 1;
  }
  else {
    clear_error(el, label);
    window[error] = 0;
  }

  console.log(error + " = " + window[error]);
}


function reset_password(){
  var id = $('#user_id').val();
  var pwd = $('#pwd');
  var cfpwd = $('#cfpwd');
  var pLabel = $('#pwd-error');
  var cLabel = $('#cfpwd-error');
  var password = $.trim(pwd.val());
  var cm_pwd = $.trim(cfpwd.val());

  if(password.length === 0) {
    set_error(pwd, pLabel, "Required");
    pwd.focus();
    return false;
  }
  else {
    clear_error(pwd, pLabel);
  }

  if(password !== cm_pwd) {
    set_error(cfpwd, cLabel, "Password Mismatch");
    cfpwd.focus();
    return false;
  }
  else {
    clear_error(pwd, cLabel);
  }

  load_in();

  $.ajax({
    url:HOME + 'change_password',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'pwd' : password
    },
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:'Success',
          text:'Password has been changed',
          type:'success',
          timer:2000
        });
      }
      else {
        swal({
          title:'Error!!',
          text:rs,
          type:'error'
        })
      }
    }
  })
}




$('#uname').focusout(function(){
  var uname = $('#uname').val();
  if(uname.length > 0) {
    check_uname();
  }
  else {
    validData($(this), $('#uname-error'), "uname_error");
  }
});


$('#emp').focusout(function() {
  validData($(this), $('#emp-error'), 'emp_error');
})


$('#ugroup').focusout(function() {
  validData($(this), $('#ugroup-error'), 'ugroup_error');
})



//----- focus next element when press enter
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
  let no = $('#no').val();
  no = parseDefault(parseInt(no), 1);
  let team_id = $('#sale_team').val();
  let name = $('#sale_team option:selected').text();
  let role = $('#role').val();


  if(team_id == "") {
    $('#sale_team').addClass('has-error');
    return false;
  }
  else {
    $('#sale_team').removeClass('has-error');
  }

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
  $('#no').val(no+1);
  $('#team-list').removeClass('hide');
}



function removeTag(id) {
  $('#tag-'+id).remove();
  $('#team-'+id).remove();
  if($('.team-list').length == 0) {
    $('#team-list').addClass('hide');
  }
}
