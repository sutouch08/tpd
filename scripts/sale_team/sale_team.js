var HOME = BASE_URL + 'sale_team/';

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
  var el = $('#name');
  var label = $('#name-error');
  var name = el.val();


  if(name.length === 0) {
    set_error(el, label, "Required");
    return false;
  }
  else {
    clear_error(el, label);
  }

  let customerGroup = [];

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      let cg = {"group_id" : $(this).val(), };
      customerGroup.push(cg);
    }
  })

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'name' : name,
      'customer_group' : JSON.stringify(customerGroup)
    },
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:"Success",
          type:"success",
          timer:1000
        });

        setTimeout(function() {
          goAdd();
        }, 1200);
      }
      else {
        swal({
          title:"Error!",
          text:rs,
          type:"error"
        });
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:"Error!",
        text:"Error-"+xhr.responseText,
        type:"error"
      });
    }
  })
}


function update() {
  var id = $('#id').val();
  var el = $('#name');
  var label = $('#name-error');
  var name = el.val();

  if(id == "") {
    swal("Error!", "Missing requierd parameter : id", "error");
    return false;
  }

  if(name.length === 0) {
    set_error(el, label, "Required");
    return false;
  }
  else {
    clear_error(el, label);
  }

  let customerGroup = [];

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      let cg = {"group_id" : $(this).val(), };
      customerGroup.push(cg);
    }
  })


  load_in();

  $.ajax({
    url:HOME + 'update/'+id,
    type:'POST',
    cache:false,
    data:{
      'name' : name,
      'customer_group' : JSON.stringify(customerGroup)
    },
    success:function(rs) {
      load_out();
      var rs = $.trim(rs);
      if(rs === 'success') {
        swal({
          title:"Success",
          type:"success",
          timer:1000
        });

      }
      else {
        swal({
          title:"Error!",
          text:rs,
          type:"error"
        });
      }
    },
    error:function(xhr) {
      load_out();
      swal({
        title:"Error!",
        text:"Error-"+xhr.responseText,
        type:"error"
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
      url: HOME + 'delete/'+id,
      type:'POST',
      cache:false,      
      success:function(rs){
        if(rs == 'success'){
          swal({
            title:'Success',
            text:'Sales team has been deleted',
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




function viewMember(id) {
  $.ajax({
    url:HOME + 'get_member/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      if(isJson(rs)) {
        var ds = $.parseJSON(rs);
        var source = $('#member-template').html();
        var output = $('#result');

        render(source, ds, output);

        $('#UserGroupModal').modal('show');
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    }
  })
}

$('#chk-all').change(function(){
  if($(this).is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
})
