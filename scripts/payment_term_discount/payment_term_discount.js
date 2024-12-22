var HOME = BASE_URL + "payment_term_discount/";


function goBack() {
  window.location.href = HOME;
}


function goAdd() {
  window.location.href = HOME + 'add_new';
}


function goEdit(id) {
  window.location.href = HOME + 'edit/'+id;
}


function viewDetail(id) {
  window.location.href = HOME + 'view_detail/'+id;
}


$('#chk-all').change(function() {
  if($(this).is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
});


function add() {
  clearErrorByClass('e');

  let h = {
    'GroupNum' : $('#payment-term').val(),
    'PymntGroup' : $('#payment-term option:selected').text(),
    'name' : $('#name').val().trim(),
    'DiscPrcnt' : parseDefault(parseFloat($('#disc').val()), 0),
    'position' : $('#position').val(),
    'canChange' : $('#allow-change').is(':checked') ? 1 : 0,
    'active' : $('#active').is(':checked') ? 1 : 0,
    'priceList' : []
  };


  if(h.GroupNum == "") {
    $('#payment-term').hasError('Required');
    return false;
  }

  if(h.name.length == 0) {
    $('#name').hasError('Required');
    return false;
  }

  if(h.DiscPrcnt < 0) {
    $('#disc').hasError('Discount must between 0 - 100');
    return false;
  }

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      h.priceList.push($(this).val());
    }
  });

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

      if(rs.trim() == 'success') {
        swal({
          title:'Success',
          text:'สร้างรายการสำเร็จ ต้องการส่างรายการอื่นต่อหรือไม่ ?',
          type:'success',
          showCancelButton:true,
          confirmButtonText:'Yes',
          cancelButtonText:'No'
        }, function(isConfirm) {
          if(isConfirm) {
            goAdd();
          }
          else {
            goBack();
          }
        })
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error',
          html:true
        })
      }
    },
    error:function(rs) {
      swal({
        title:'Error!',
        text:rs.reaponseText,
        type:'error',
        html:true
      })
    }
  })
}


function update() {
  clearErrorByClass('e');

  let h = {
    'id' : $('#id').val(),
    'GroupNum' : $('#payment-term').val(),
    'PymntGroup' : $('#payment-term option:selected').text(),
    'name' : $('#name').val().trim(),
    'DiscPrcnt' : parseDefault(parseFloat($('#disc').val()), 0),
    'position' : $('#position').val(),
    'canChange' : $('#allow-change').is(':checked') ? 1 : 0,
    'active' : $('#active').is(':checked') ? 1 : 0,
    'priceList' : []
  };


  if(h.GroupNum == "") {
    $('#payment-term').hasError('Required');
    return false;
  }

  if(h.name.length == 0) {
    $('#name').hasError('Required');
    return false;
  }

  if(h.DiscPrcnt < 0) {
    $('#disc').hasError('Discount must between 0 - 100');
    return false;
  }

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      h.priceList.push($(this).val());
    }
  });

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

      if(rs.trim() == 'success') {
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
          type:'error',
          html:true
        })
      }
    },
    error:function(rs) {
      swal({
        title:'Error!',
        text:rs.reaponseText,
        type:'error',
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
            text:'Payment Term list has been deleted',
            type:'success',
            time: 1000
          });

          setTimeout(function(){
            window.location.reload();
          }, 1200)
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
