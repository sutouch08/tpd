var HOME = BASE_URL + "step_rule/";


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


function add() {
  $('.e').removeClass('has-error');

  let priceList = $('#price-list').val();
  let priceName = $('#price-list option:selected').text();
  let name = $('#name').val().trim();
  let active = $('#active').val();

  if(priceList == "") {
    $('#price-list').addClass('has-error');
    return false;
  }

  if(name.length == 0) {
    $('#name').addClass('has-error');
    return false;
  }

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'price_list' : priceList,
      'price_list_name' : priceName,
      'name' : name,
      'active' : active
    },
    success:function(rs) {
      if(rs.trim() == 'success') {
        goEdit(priceList);
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


function save() {
  $('.e').removeClass('has-error');

  let err = 0;

  let d = {
    'price_list' : $('#price-list').val(),
    'price_list_name' : $('#price-list option:selected').text(),
    'name' : $('#name').val().trim(),
    'active' : $('#active').val(),
    'rows' : [],
    'delete_rows' : []
  }

  if(d.price_list == "") {
    $('#price-list').addClass('has-error');
    return false;
  }

  if(d.name.length == 0) {
    $('#name').addClass('has-error');
    return false;
  }

  if($('.chk').length) {
    $('.chk').each(function() {
      let no = $(this).data('no');
      let id = $(this).data('id');
      let label = $('#label-'+no).val().trim();
      let stepQty = parseDefault(parseInt($('#step-qty-'+no).val()), 0);
      let freeQty = parseDefault(parseInt($('#free-qty-'+no).val()), 0);
      let active = $('#active-'+no).is(':checked') ? 1 : 0;
      let position = parseDefault(parseInt($('#pos-'+no).val()), 0);

      if(label.length == 0) {
        $('#label-'+no).hasError();
        err++;
      }

      if(stepQty <= 0) {
        $('#step-qty-'+no).hasError();
        err++;
      }

      if(freeQty <= 0) {
        $('#free-qty-'+no).hasError();
        err++;
      }

      let row = {
        'id' : id,
        'label' : label,
        'stepQty' : stepQty,
        'freeQty' : freeQty,
        'active' : active,
        'position' : position
      };

      d.rows.push(row);
    });
  }

  $('.delete-row').each(function() {
    d.delete_rows.push($(this).val());
  })

  if(err > 0) {
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'save',
    type:'POST',
    cache:false,
    data:{
      'data' : JSON.stringify(d)
    },
    success:function(rs) {
      load_out();

      if(rs.trim() == 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(() => {
          window.location.reload();
        }, 1200);
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
      load_out();
      swal({
        title:'Error!',
        text:rs.responseText,
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
        'price_list' : id
      },
      success:function(rs){
        if(rs == 'success'){
          swal({
            title:'Success',
            text:'Price list has been deleted',
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


function toggleActive(option) {
  $('#active').val(option);

  if(option == 1) {
    $('#btn-active').addClass('btn-primary');
    $('#btn-inactive').removeClass('btn-danger');
  }

  if(option == 0) {
    $('#btn-inactive').addClass('btn-danger');
    $('#btn-active').removeClass('btn-primary');
  }
}


function addRow() {
  let no = parseDefault(parseInt($('#top-row').val()), 0);

  let source = $('#row-template').html();
  let ds = {'no' : no};
  let output = $('#detail-table');

  render_append(source, ds, output);
  no++;
  $('#top-row').val(no);

  reIndex();
}


function removeRow() {
  if($('.chk:checked').length) {
    $('.chk:checked').each(function() {
      let id = parseDefault(parseInt($(this).data('id')), 0);
      let no = $(this).data('no');

      if(id > 0) {
        let source = $('#delete-template').html();
        let data = {'row_id' : id};
        let output = $('#deleted-table');

        render_append(source, data, output);
      }

      $('#row-'+no).remove();

      reIndex();
    });
  }
}


function checkAll() {
  if($('#check-all').is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}
