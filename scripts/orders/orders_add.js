//----  get new customer list
function changeCustomerList() {
	let type = $('#cardType').val();

	//load_in();

	$.ajax({
		url:HOME + 'get_user_customer_list/'+type,
		type:"GET",
		cache:false,
		success:function(rs) {
			//load_out();
			if(isJson(rs)) {
				let data = $.parseJSON(rs);
				let source = $('#customer-template').html();
				let output = $('#customer');

				render(source, data, output);
				$('#customer').select2();
				$('#VatGroup').val('');
				$('#vatRate').val('');
				$('#shipToCode option').remove();
				$('#ShipTo').val('');
				$('#billToCode option').remove();
				$('#BillTo').val('');
				$('#slpName').val('');
			}
			else {
				swal({
					title:"Error!",
					text:rs,
					type:'error'
				});
			}
		}
	})
}


function getAddress() {
	//--- update vatcode
	let code = $('#customer').val();
	let vatCode = $('#customer option:selected').data('vat');
	let vatRate = $('#customer option:selected').data('rate');
	$('#VatGroup').val(vatCode);
	$('#vatRate').val(vatRate);
	recalVat();
	get_address_ship_to_code(code);
	//---- create Address bill to
	get_address_bill_to_code(code);

	if($('#slpName').length) {
		get_sale_name_by_customer(code);
	}
}



function get_sale_name_by_customer(code) {
	if(code.length) {
		$.ajax({
			url:HOME + 'get_sale_name_by_customer',
			type:'GET',
			cache:false,
			data: {
				"CardCode" : code
			},
			success:function(rs) {
				$('#slpName').val(rs);
			}
		})
	}
}




function get_address_ship_to_code(code)
{
	$.ajax({
		url:HOME + 'get_address_ship_to_code',
		type:'GET',
		cache:false,
		data:{
			'CardCode' : code
		},
		success:function(rs) {
			var rs = $.trim(rs);
			if(isJson(rs)) {
				var data = $.parseJSON(rs);
				var source = $('#ship-to-template').html();
				var output = $('#shipToCode');
				render(source, data, output);

				get_address_ship_to();
			}
			else {
				$('#shipToCode').html('');
			}
		}
	})
}

function get_address_ship_to() {
	var code = $('#customer').val()
	var adr_code = $('#shipToCode').val();
	$.ajax({
		url:HOME + 'get_address_ship_to',
		type:'GET',
		cache:false,
		data:{
			'CardCode' : code,
			'Address' : adr_code
		},
		success:function(rs) {
			var rs = $.trim(rs);
			if(isJson(rs)) {
				var ds = $.parseJSON(rs);

				let address = ds.address === "" ? "" : ds.address + " ";
				let street = ds.street === "" ? "" : ds.street + " ";
				let sub_district = ds.sub_district === "" ? "" : ds.sub_district + " ";
				let district = ds.district === "" ? "" : ds.district + " ";
				let province = ds.province === "" ? "" : ds.province + " ";
				let postcode = ds.postcode === "" ? "" : ds.postcode + " "
				let country = ds.country === 'TH' ? '' : ds.countryName;
				let adr = address + street + sub_district + district + province + postcode + country;

				$('#ShipTo').val(adr);
			}
		}
	})
}



function get_address_bill_to_code(code)
{
	$.ajax({
		url:HOME + 'get_address_bill_to_code',
		type:'GET',
		cache:false,
		data:{
			'CardCode' : code
		},
		success:function(rs) {
			var rs = $.trim(rs);
			if(isJson(rs)) {
				var data = $.parseJSON(rs);
				var source = $('#bill-to-template').html();
				var output = $('#billToCode');
				render(source, data, output);

				get_address_bill_to();
			}
			else {
				$('#billToCode').html('');
			}
		}
	})
}


function get_address_bill_to() {
	var code = $('#customer').val();
	var adr_code = $('#billToCode').val();
	$.ajax({
		url:HOME + 'get_address_bill_to',
		type:'GET',
		cache:false,
		data:{
			'CardCode' : code,
			'Address' : adr_code
		},
		success:function(rs) {
			var rs = $.trim(rs);
			if(isJson(rs)) {
				var ds = $.parseJSON(rs);
				let address = ds.address === "" ? "" : ds.address + " ";
				let street = ds.street === "" ? "" : ds.street + " ";
				let sub_district = ds.sub_district === "" ? "" : ds.sub_district + " ";
				let district = ds.district === "" ? "" : ds.district + " ";
				let province = ds.province === "" ? "" : ds.province + " ";
				let postcode = ds.postcode === "" ? "" : ds.postcode + " "
				let country = ds.country === 'TH' ? '' : ds.countryName;
				let adr = address + street + sub_district + district + province + postcode + country;

				$('#BillTo').val(adr);
			}
		}
	})
}


function checkPriceList() {
	let count = 0;
	$('.item-code').each(function(){
		if($(this).val() != "") {
			count++;
		}
	});

	if(count > 0) {
		//--- clear item
		$('#details-template').html('');

		//--- add new value to top row
		$('#top-row').val(0);

		addRow();
	}

	init();
}


function init() {
	var priceList = $('#priceList').val();
	var priceList = priceList == "" ? "nopricelist" : priceList;

	$('.input-item-code').autocomplete({
		source:HOME + 'get_item_code_and_name/'+priceList,
		autoFocus:true,
		open:function(event){
			var $ul = $(this).autocomplete('widget');
			$ul.css('width', 'auto');
		},
		close:function(){
			var data = $(this).val();
			var arr = data.split(' | ');
			if(arr.length == 2) {
				let no = $(this).data("no");
				$('#itemCode-'+no).val(arr[1]);
				$(this).val(arr[0]);
				getItemData(arr[1], no);
			}
			else {
				$(this).val('');
			}
		}
	})
}




	function getItemData(code, no) {
		var priceList = $('#priceList').val();
		var priceList = priceList == "" ? "nopricelist" : priceList;

		$.ajax({
			url:HOME + "get_item_data",
			type:"GET",
			cache:false,
			data:{
				'code' : code,
				'priceList' : priceList
			},
			success:function(rs) {
				var rs = $.trim(rs);
				if(isJson(rs)) {
					var ds = $.parseJSON(rs);
					var price = parseFloat(ds.price);
					$('#uom-'+no).val(ds.uom);
					$('#stdPrice-'+no).val(price);
					$('#price-'+no).val(price);
					$('#instock-'+no).val(ds.inStock);
					$('#commit-'+no).val(ds.commit);
					$('#available-'+no).val(ds.available);
					$('#itemVatCode-'+no).val(ds.vatCode);
					$('#itemVatRate-'+no).val(ds.vatRate);
					$('#whsCode-'+no).val(ds.whsCode);

					recalAmount(no);
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



function addRow() {
	var no = $('#top-row').val();
	no++;
	$('#top-row').val(no);

	var data = {"no" : no};
	var source = $('#row-template').html();
	var output = $('#details-template');

	render_append(source, data, output);
	init();

	$('#itemCode-'+no).focus();
}

function removeRow() {
	$('.chk').each(function(){
		if($(this).is(':checked')) {
			var no = $(this).val();
			$('#row-'+no).remove();
		}
	})

	recalTotal();
}

function remove_vat(amount, vat) {

	if(vat != 0) {
		vat = parseDefault(parseFloat(vat), 0);
		re_vat	= (vat + 100) / 100;
		amount = parseDefault(parseFloat(amount), 0);
		return amount/re_vat;
	}

	return amount;
}


function get_vat_amount(amount, vat) {
	vat = parseDefault(parseFloat(vat), 0);
	amount = parseDefault(parseFloat(amount), 0);
	if(vat > 0) {
		re_vat = (amount * vat) / (100 + vat);
		return re_vat;
	}


	return 0;
}


function recalVat() {
	$('.item-code').each(function(){
		let no = $(this).data('no');
		recalAmount(no);
	});
}


function recalAmount(no) {
	let vatRate = parseDefault(parseFloat($('#vatRate').val()), 0);

	if($('#VatGroup').val() === "") {
		vatRate = parseDefault(parseFloat($('#itemVatRate-'+no).val()), 0);
	}

	let qty = parseDefault(parseFloat($('#qty-'+no).val()), 0);
	let stdPrice = parseDefault(parseFloat($('#stdPrice-'+no).val()), 0);
	let sellPrice = $('#price-'+no).val();

	if(sellPrice != "") {
		let amount = qty * sellPrice;
		let vatamount = get_vat_amount(amount, vatRate);
		$('#amount-'+no).val(amount.toFixed(2));
		$('#vatAmount-'+no).val(vatamount);
	}
	else {
		let amount = qty * stdPrice;
		let vatamount = get_vat_amount(amount, vatRate);
		$('#amount-'+no).val(amount.toFixed(2));
		$('#vatAmount-'+no).val(vatamount);
	}

	recalTotal();
}



function recalTotal() {
	var totalAmount = 0.00; //--- price before vat
	var totalVat = 0.00; //--- total vat
	var docTotal = 0.00;

	$('.input-qty').each(function(){
		let no = $(this).data('no');
		let vatAmount = parseDefault(parseFloat($('#vatAmount-'+no).val()), 0);
		let amount = parseDefault(parseFloat($('#amount-'+no).val()), 0);
		let lineTotal = amount - vatAmount;

		totalAmount += lineTotal;
		totalVat += vatAmount;
		docTotal += amount;
	});


	$('#totalAmount').val(addCommas(totalAmount.toFixed(2)));
	$('#totalVat').val(addCommas(totalVat.toFixed(2)));
	$('#docTotal').val(addCommas(docTotal.toFixed(2)));
}



function previewOrder() {
	var err = 0;
	var count = 0;
	var runno = 1;
	var msg = "";
	var price_edit = 0;
	//--- check valid data
	var customerCode = $('#customer').val();
	var customerName = $('#customer option:selected').text();
	var shipToCode = $('#shipToCode').val();
	var shipToAddress = $('#ShipTo').val();
	var billToCode = $('#billToCode').val();
	var billToAddress = $('#BillTo').val();
	var priceList = $('#priceList').val();
	var docDate = $('#DocDate').val();
	var dueDate = $('#DocDueDate').val();
	var PoNo = $('#PoNo').val();
	var exShipTo = $('#exShipTo').val();
	var currencyRate = $('#currencyRate').val();
	var currency = $('#currency').val();
	var items = [];

	if(customerCode == "") {
		$('#customer').addClass('has-error');
		msg = "กรุณาเลือกลูกค้า";
		warning(msg);
		return false;
	}
	else {
		$('#customer').removeClass('has-error');
	}

	if(priceList == "") {
		$('#priceList').addClass('has-error');
		msg = "กรุณาเลือก payment term";
		warning(msg);
		return false;
	}
	else {
		$('#priceList').removeClass('has-error');
	}

	if(currencyRate == 0) {
		$('#currencyRate').addClass('has-error');
		msg = "อัตราแลกเปลี่ยนไม่ถูกต้อง";
		warning(msg);
		return false;
	}
	else {
		$('#currencyRate').removeClass('has-error');
	}

	$('.item-code').each(function() {
		let no = $(this).data('no');
		if($(this).val() != "") {
			count++;
			if($('#qty-'+no).val() == "" || $('#qty-'+no).val() == 0) {
				$('#qty-'+no).addClass('has-error');
				msg = "จำนวนไม่ถูกต้อง";
				err++;
			}
			else {
				$('#qty-'+no).removeClass('has-error');

				if($('#price-'+no).val() != "") {
					let stdPrice = parseDefault(parseFloat($('#stdPrice-'+no).val()), 0);
					let sellPrice = parseDefault(parseFloat($('#price-'+no).val()), 0);

					if(sellPrice < stdPrice) {
						price_edit++;
					}
				}

				let item = {
					"no" : runno,
					"ItemCode" : $(this).val(),
					"itemName" : $('#item-'+no).val(),
					"qty" : addCommas($('#qty-'+no).val()),
					"free" : addCommas($('#free-'+no).val()),
					"uom" : $('#uom-'+no).val(),
					"stdPrice" : addCommas($('#stdPrice-'+no).val()),
					"sellPrice" : addCommas($('#price-'+no).val()),
					"amount" : addCommas($('#amount-'+no).val())
				}

				items.push(item);
				runno++;
			}
		}
	});

	let docTotal = {"totalAmount" : $('#docTotal').val()};

	items.push(docTotal);

	if(count == 0) {
		msg = "ไม่พบรายการสินค้า";
		warning(msg);
		return false;
	}

	if(err > 0) {
		warning(msg);
		return false;
	}




	var data = {
		"orderCode" : $('#code').val(),
		"customerCode" : customerCode,
		"customerName" : customerName,
		"shipToCode" : shipToCode,
		"shipToAddress" : shipToAddress,
		"billToCode" : billToCode,
		"billToAddress" : billToAddress,
		"currency" : currency,
		"currencyRate" : currencyRate,
		"docDate" : docDate,
		"dueDate" : dueDate,
		"PoNo" : PoNo,
		"exShipTo" : exShipTo,
		"billOption" : $("input[name=billoption]:checked").val(),
		"requiredSQ" : $('#require-sq').is(':checked') ? 'Y' : 'N',
		"remark" : $('#remark').val(),
		"items" : items
	}

	let total = removeCommas($('#docTotal').val());

	$.ajax({
		url:HOME + 'check_approve',
		type:'GET',
		cache:false,
		data:{
			'docTotal' : total,
			'priceEdit' : price_edit,
			'customerCode' : customerCode
		},
		success:function(rs) {
			if(rs == 'pass') {
				var source = $('#preview-template').html();
				var output = $('#result');

				render(source, data, output);

				$('#previewModal').modal('show');
			}
			else {
				swal({
			    title:'',
			    text:rs,
			    type:'warning',
			    showCancelButton: true,
					confirmButtonText: 'ดำเนินการต่อ',
					cancelButtonText: 'กลับไปแก้ไข',
					closeOnConfirm: true
			  },function(){
					var source = $('#preview-template').html();
					var output = $('#result');

					render(source, data, output);

					$('#previewModal').modal('show');
			  })
			}
		}
	})
}



function warning(msg) {
	swal({
		title:"",
		text:msg,
		type:"warning"
	})
}



function toggleSubmit() {
	let uncheck = 0;
	$('.check-list').each(function() {
			if(! $(this).is(":checked")) {
				uncheck++;
			}
	})

	if(uncheck == 0) {
		$('#btn-submit').removeAttr('disabled');
	}
	else {
		$('#btn-submit').attr('disabled', 'disabled');
	}
}


function getRate() {
	var code = $('#currency').val();
	if(code === 'THB') {
		$('#currencyRate').val('1.000000');
	}
	else {
		$.ajax({
			url:HOME + 'get_currency_rate/'+code,
			type:"GET",
			cache:false,
			success:function(rs) {
				if(rs === "notfound") {
					$('#currencyRate').val(0);
					swal({
						title:'Error!',
						text:"ไม่พบอัตราแลกเปลี่ยนของวันนี้ กรุณาติดต่อผู้ดูแลระบบ",
						type:"error"
					});
				}
				else {
					$('#currencyRate').val(rs);
				}
			}
		})
	}
}


///------------------------------------------------------------------------------------------------------------------ old code
function saveAdd() {
	$('#previewModal').modal('hide');
	var ds = {
		//---- Right column
		'CardCode' : $('#customer').val(),  //****** required
		'PriceList' : $('#priceList').val(),
		'PayToCode' : $('#billToCode').val(),
		'BillTo' : $('#BillTo').val(),
		'ShipToCode' : $('#shipToCode').val(),
		'ShipTo' : $('#ShipTo').val(),
		'exShipTo' : $('#exShipTo').val(),
		'VatGroup' : $('#vatGroup').val(),
		//--- right Column
		'DocDate' : $('#DocDate').val(), //****** required
		'DocDueDate' : $('#DocDueDate').val(), //****** required
		'NumAtCard' : $('#PoNo').val(),
		'DocCur' : $('#currency').val(),
		'DocRate' : $('#currencyRate').val(),

		//---- footer
		'billOption' : $("input[name=billoption]:checked").val(),
		'requireSQ' : $('#require-sq').is(':checked') ? 'Y' : 'N',
		'comments' : $.trim($('#remark').val()),

		'totalVat' : removeCommas($('#totalVat').val()), //-- VatSum
		'docTotal' : removeCommas($('#docTotal').val())
	}


	var details = [];

	var vatGroup = $('#VatGroup').val(); //---- Vat code ตาม customer ถ้าไม่มีใช้ตาม item
	var docRate = $('#vatRate').val(); //--- vat rate ตาม customer ถ้าไม่มีใช้ตาม item

	$('.item-code').each(function() {
		if($(this).val() != "") {
			let no = $(this).data('no');
			let vatCode = $('#itemVatCode-'+no).val(); ///---- vat code at item
			let vatRate = $('#itemVatRate-'+no).val(); ///---- vat rate at item
			let sellPrice = $('#price-'+no).val();
			let stdPrice = parseDefault(parseFloat($('#stdPrice-'+no).val()), 0);
			let item = {
				"ItemCode" : $(this).val(),
				"ItemName" : $("#item-"+no).val(),
				"Qty" : parseDefault(parseFloat($('#qty-'+no).val()), 1),
				"freeQty" : parseDefault(parseFloat($('#free-'+no).val()), 0),
				"UomCode" : $('#uom-'+no).val(),
				"stdPrice" : stdPrice,
				"SellPrice" : (sellPrice == "" ? stdPrice : sellPrice),
				"VatGroup" : (vatGroup == "" ? vatCode : vatGroup), //---- Vat code ตาม customer ถ้าไม่มีใช้ตาม item
				"VatRate" : (vatGroup == "" ? vatRate : docRate), //--- vat rate ตาม customer ถ้าไม่มีใช้ตาม item
				"VatAmount" : $('#vatAmount-'+no).val(),
				"lineTotal" : $('#amount-'+no).val(),
				"lineText" : $('#remark-'+no).val(),
				"WhsCode" : $('#whsCode-'+no).val()
			}

			details.push(item);
		}
	}); //--- end each function


	load_in();

	$.ajax({
		url:HOME + 'add',
		type:'POST',
		cache:false,
		data:{
			"header" : JSON.stringify(ds),
			"details" : JSON.stringify(details)
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
					goBack();
				}, 1200);
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

}


$(document).ready(function(){
	init();
})




$('.autosize').autosize({append: "\n"});

function wordCount(el, no) {
	let count = el.val().length;
	$('#word-count-'+no).text(count);
}
