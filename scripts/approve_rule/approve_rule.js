var HOME = BASE_URL + 'approve_rule/';

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
  var conditions = $('#conditions').val();
  var amount = parseDefault(parseFloat($('#amount').val()),0);
  var sale_team = $('#sale_team').val();
  var is_price_list = $('#is_price_list').is(':checked') ? 1 : 0;
  var status = $('#status').is(':checked') ? 1 : 0;


  if(conditions == "") {
    $('#conditions').addClass('has-error');
    $('#conditions-error').text('Required');
    return false;
  }
  else {
    $('#conditions').removeClass('has-error');
    $('#conditions-error').text('');
  }


  if(sale_team == "") {
    $('#sale_team').addClass('has-error');
    $('#sale_team-error').text('Required');
    return false;
  }
  else {
    $('#sale_team').removeClass('has-error');
    $('#sale_team-error').text('');
  }


  if(amount < 0) {
    $('#amount').addClass('has-error');
    $('#amount-error').text('Amount must Greater than 0');
    $('#amount').focus();
    return false;
  }
  else {
    $('#amount').removeClass('has-error');
    $('#amount-error').text('');
  }


  var fd = new FormData();

  fd.append("conditions", conditions);
  fd.append("amount", amount);
  fd.append("sale_team", sale_team);
  fd.append("is_price_list", is_price_list);
  fd.append("status" , status);

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:fd,
    processData:false,
    contentType:false,
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
          title:"Error",
          text:rs,
          type:'error'
        })
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:"Error!",
        text:"Error : "+xhr.responseText,
        type:"error",
        html:true
      })
    }
  })

}




function update() {
  var rule_id = $('#rule_id').val();
  var conditions = $('#conditions').val();
  var amount = parseDefault(parseFloat($('#amount').val()),0);
  var sale_team = $('#sale_team').val();
  var is_price_list = $('#is_price_list').is(':checked') ? 1 : 0;
  var status = $('#status').is(':checked') ? 1 : 0;

  if(conditions == "") {
    $('#conditions').addClass('has-error');
    $('#conditions-error').text('Required');
    return false;
  }
  else {
    $('#conditions').removeClass('has-error');
    $('#conditions-error').text('');
  }


  if(amount < 0) {
    $('#amount').addClass('has-error');
    $('#amount-error').text('Amount must Greater than 0');
    $('#amount').focus();
    return false;
  }
  else {
    $('#amount').removeClass('has-error');
    $('#amount-error').text('');
  }

  if(sale_team == "") {
    $('#sale_team').addClass('has-error');
    $('#sale_team-error').text('Required');
    return false;
  }
  else {
    $('#sale_team').removeClass('has-error');
    $('#sale_team-error').text('');
  }


  var fd = new FormData();

  fd.append("rule_id", rule_id);
  fd.append("conditions", conditions);
  fd.append("amount", amount);
  fd.append("sale_team", sale_team);
  fd.append("is_price_list", is_price_list);
  fd.append("status" , status);

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:fd,
    processData:false,
    contentType:false,
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(function() {
          window.location.reload();
        }, 1200);
      }
      else {
        swal({
          title:"Error",
          text:rs,
          type:'error'
        })
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:"Error!",
        text:"Error : "+xhr.responseText,
        type:"error",
        html:true
      })
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
          'id' : id
        },
        success:function(rs){
          if(rs == 'success'){
            swal({
              title:'Success',
              text:'Approve rule has been deleted',
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
