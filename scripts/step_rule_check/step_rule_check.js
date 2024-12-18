var HOME = BASE_URL + "step_rule_check/";

function getData() {
  let itemCode = $('#item').val().trim();
  let priceList = $('#price-list').val().trim();

  if(priceList.length == 0) {
    $('#price-list').hasError();
    return false;
  }

  if(itemCode.length == 0) {
    $('#item').hasError();
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'get_data',
    type:'POST',
    cache:false,
    data:{
      'itemCode' : itemCode,
      'priceList' : priceList
    },
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          let source = $('#step-template').html();
          let output = $('#step-table');

          render(source, ds.data, output);
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

function clearData() {
  $('#price-list').val('');
  $('#item').val('').trigger('change');
  $('#step-table').html('');
}
