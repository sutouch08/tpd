var HOME = BASE_URL + "promotion/";


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
  var name = $('#name').val();
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  var items = [];
  var error = 0;

  if(name.length == 0)
  {
    $('#name').addClass('has-error');
    return false;
  }
  else  {
    $('#name').removeClass('has-error');
  }


  if(!isDate(start_date)) {
    $('#start_date').addClass('has-error');
    return false;
  }
  else {
    $('#start_date').removeClass('has-error');
  }

  if(!isDate(end_date)) {
    $('#end_date').addClass('has-error');
    return false;
  }
  else {
    $('#end_date').removeClass('has-error');
  }




  $('.item-row').each(function() {
    let no = $(this).data('no');
    let itemCode = $('#item-'+no).val();
    let itemName = $('#item-'+no+' :selected').text();
    let qty = parseDefault(parseFloat($('#input-qty-'+no).val()), 0);
    let price = parseDefault(parseFloat($('#input-price-'+no).val()), 0);

    var err = 0;

    if(itemCode == "") {
      $('#item-'+no).addClass('has-error');
      error++;
      err++;
    }
    else {
      $('#item-'+no).removeClass('has-error');
    }

    if(qty <= 0) {
      $('#input-qty-'+no).addClass('has-error');
      error++;
      err++;
    }
    else {
      $('#input-qty-'+no).removeClass('has-error');
    }


    if(price <= 0) {
      $('#input-price-'+no).addClass('has-error');
      error++;
      err++;
    }
    else {
      $('#input-price-'+no).removeClass('has-error');
    }


    if(err === 0) {
      let arr = {
        "itemCode" : itemCode,
        "itemName" : itemName,
        "qty" : qty,
        "price" : price
      }

      items.push(arr);
    }
  });

  if(error > 0) {
    return false;
  }

  if(items.length == 0) {
    swal({
      title:"No item found",
      text:"Please fill item, qty, proce at least 1 row(s)",
      type:'warning'
    })

    return false;
  }


  var ds = [
    
  ]
}



$('#start_date').datepicker({
  dateFormat:'dd-mm-yy',
  onClose:function(sd) {
    $('#end_date').datepicker("option", "minDate", sd);
  }
});


$('#end_date').datepicker({
  dateFormat:'dd-mm-yy',
  onClose:function(sd) {
    $('#start_date').datepicker('option', 'maxDate', sd);
  }
})


function addRow() {
  var no = parseDefault(parseInt($('#top-row').val()), 1);
  var ds = {"no" : no};
  var source = $('#row-template').html();
  var output = $('#detail-table');

  render_append(source, ds, output);
  reIndex();
  init(no);
  no++;
  $('#top-row').val(no);
}




function removeRow() {
	$('.chk').each(function(){
		if($(this).is(':checked')) {
			var no = $(this).val();
			$('#row-'+no).remove();
		}
	})

	reIndex();
}


function update_uom(el) {
  let no = el.data('no');
  let uom = $('#item-'+no).find(':selected').data('uom');

  $('#uom-'+no).val(uom);
  $('#input-qty-'+no).focus();
}


function init(no) {
  $('#item-'+no).select2();

}


$(document).ready(function(){
  init(1);
})
