window.addEventListener('load', () => {
	init();
});

//----  get new customer list
function changeCustomerList() {
	let type = $('#cardType').val();

	load_in();

	$.ajax({
		url:HOME + 'get_user_customer_list/'+type,
		type:"GET",
		cache:false,
		success:function(rs) {
			load_out();
			if(isJson(rs)) {
				let ds = JSON.parse(rs);
				let data = {
					'count' : ds.length,
					'data' : ds
				}

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

				let prevType = type == 'V' ? 'Q' : 'V';
				$('#cardType').val(prevType);
			}
		}
	})
}


$('#customer').change(function() {
	let isControl = $('#customer option:selected').data('control') == 'Y' ? 'Y' : 'N';

	if(isControl == 'N') {
		$('.is-control').each(function() {
			if($(this).val() == 'Y') {
				let no = $(this).data('no');
				$('#row-'+no).remove();
			}
		})
	}

	init();
});


function getAddress() {
	//--- update vatcode
	let code = $('#customer').val();
	let vatCode = $('#customer option:selected').data('vat');
	let vatRate = $('#customer option:selected').data('rate');
	let currency = $('#customer option:selected').data('currency');

	if(currency == '##') {
		$('#currency').removeAttr('disabled');
	}
	else
	{
		$('#currency').attr('disabled', 'disabled');
	}

	currency = currency == '##' ? $('#default_currency').val() : currency;

	$('#VatGroup').val(vatCode);
	$('#vatRate').val(vatRate);
	$('#currency').val(currency);
	recalVat();
	get_address_ship_to_code(code);
	//---- create Address bill to
	get_address_bill_to_code(code);

	if($('#slpName').length) {
		get_sale_name_by_customer(code);
	}

	getRate();
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


function get_address_ship_to_code(code) {
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


function get_address_bill_to_code(code) {
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

	$('.item-code').each(function() {
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

	getStepTemplate();
	getTermDropdown();
}


function init() {
	let priceList = $('#priceList').val();
	priceList = priceList == "" ? 0 : priceList;
	let control = $('#customer option:selected').data('control') == 'Y' ? 'Y' : 'N';

	$('.input-item-code').autocomplete({
		source:HOME + 'get_item_code_and_name/'+priceList+'/'+control,
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


function getStepTemplate() {
	let priceList = $('#priceList').val();

	$.ajax({
		url:HOME + 'get_step_template',
		type:'POST',
		cache:false,
		data:{
			'PriceList' : priceList
		},
		success:function(rs) {
			if(isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status == 'success') {
					$('#step-template').html(ds.template);

					$('.step').each(function() {
						let no = $(this).data('no');

						updateSelectStep(no);

						updateStepQty(no);
					});
				}
				else {
					swal({
						title:'Error !',
						text:ds.message,
						type:'error',
						html:true
					})
				}
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
				text:rs.responseText,
				type:'error',
				html:true
			})
		}
	})
}


function getTermDropdown() {
	let priceList = $('#priceList').val();

	$.ajax({
		url:HOME + 'get_payment_term',
		type:'POST',
		cache:false,
		data:{
			'PriceList' : priceList
		},
		success:function(rs) {
			if(isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status == 'success') {
					$('#term').html(ds.options);
				}
				else {
					swal({
						title:'Error !',
						text:ds.message,
						type:'error',
						html:true
					})
				}
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
				text:rs.responseText,
				type:'error',
				html:true
			})
		}
	})
}

function getItemData(code, no) {
	let priceList = $('#priceList').val();

	load_in();

	$.ajax({
		url:HOME + "get_item_data",
		type:"GET",
		cache:false,
		data:{
			'code' : code,
			'priceList' : priceList,
			'no' : no
		},
		success:function(rs) {
			load_out();

			if(isJson(rs)) {
				let ds = JSON.parse(rs);
				let price = parseFloat(ds.price);

				$('#control-'+no).val(ds.isControl);
				$('#uom-'+no).val(ds.uom);
				$('#stdPrice-'+no).val(price);
				$('#item-'+no).data('price', price);
				$('#price-'+no).val('');
				$('#instock-'+no).val(ds.inStock);
				$('#commit-'+no).val(ds.commit);
				$('#available-'+no).val(ds.available);
				$('#itemVatCode-'+no).val(ds.vatCode);
				$('#itemVatRate-'+no).val(ds.vatRate);
				$('#whsCode-'+no).val(ds.whsCode);

				if(ds.is_sale_discount == 'Y') {
					$('#dis-'+no).prop('checked', true);
				}
				else {
					$('#dis-'+no).prop('checked', false);
				}

				if(ds.step != '' && ds.step !== null && ds.step != undefined) {
					$('#step-'+no).html(ds.step);
				}

				if(ds.stepData != '' && ds.stepData !== null && ds.stepData != undefined) {
					$('#step-data-'+no).val(JSON.stringify(ds.stepData));
				}

				$('#qty-'+no).focus();

				if(ds.isControl == 'Y') {
					$('#row-'+no).addClass('control');
				}
				else {
					$('#row-'+no).removeClass('control');
				}

				updateStepQty(no);
				//recalAmount(no);
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


function updateSelectStep(no) {
	let template = $('#step-template').html();
	let ds = {"no" : no};
	let target = $('#step-'+no);
	render(template, ds, target);
}


function updateStepQty(no) {
	let priceList = $('#priceList').val();
	let stepQty = parseDefault(parseFloat($('#step-'+no+' option:selected').data('stepqty')), 0);
	let freeQty = parseDefault(parseFloat($('#step-'+no+' option:selected').data('freeqty')), 0);
	let force = $('#step-'+no+' option:selected').data('force');
	let price = parseDefault(parseFloat($('#step-'+no+' option:selected').data('price')), 0);

	if(priceList == 'x') {
		$('#stdPrice-'+no).val(price);
	}

	$('#qty-'+no).val(stepQty);
	$('#free-'+no).val(freeQty);

	if(force) {
		$('#qty-'+no).attr('disabled', 'disabled');
		$('#free-'+no).attr('disabled', 'disabled');
	}
	else {
		$('#qty-'+no).removeAttr('disabled');
		$('#free-'+no).removeAttr('disabled');
		$('#qty-'+no).focus();
	}

	recalAmount(no);
}


function addRow() {
	var no = $('#top-row').val();
	no++;
	$('#top-row').val(no);
	let data = {"no" : no};
	let source = $('#row-template').html();
	let output = $('#details-template');
	render_append(source, data, output);
	init();
	$('#itemCode-'+no).focus();

	updateSelectStep(no);
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
	let priceList = $('#priceList').val();
	let stepData = null;

	let vatRate = parseDefault(parseFloat($('#vatRate').val()), 0);

	if($('#VatGroup').val() === "") {
		vatRate = parseDefault(parseFloat($('#itemVatRate-'+no).val()), 0);
	}

	let qty = parseDefault(parseFloat($('#qty-'+no).val()), 0);
	let stdPrice = parseDefault(parseFloat($('#stdPrice-'+no).val()), 0);
	let sellPrice = $('#price-'+no).val();
	let prevPrice = parseDefault(parseFloat($('#item-'+no).data('price')), 0);

	//--- ถ้า special price list ถูกเลือกให้ทำแบบนี้ด้วย
	if(priceList == 'x') {
		//--- เปลี่ยนราคาขายต่่อชิ้น และ จำนวนแถม ตาม step price qty
		let stepVal = $('#step-'+no).val();

		let step = $('#step-data-'+no).val();
		if(step.length) {
			stepData = JSON.parse(step);
			let data = null;
			let qtt = 0;
			stepData.forEach(function(item) {
				if(item.stepQty <= qty && item.stepQty > qtt) {
					data = item;
					qtt = item.stepQty;
				}
			})

			if(data !== null) {
				stdPrice = data.stepPrice;
				$('#stdPrice-'+no).val(data.stepPrice);
				$('#free-'+no).val(data.freeQty);
			}
			else {
				stdPrice = prevPrice;
				$('#stdPrice-'+no).val(prevPrice);
				$('#free-'+no).val(0);
			}
		}
	}
	else {
		let limitQty = parseDefault(parseInt($('#step-'+no+' option:selected').data('limit')), 0);
		let minQty = parseDefault(parseInt($('#step-'+no+' option:selected').data('stepqty')), 1);

		if(qty < minQty) {
			$('#qty-'+no).hasError();
			$('#err-'+no).val(1);
		}
		else {
			$('#qty-'+no).clearError();
			$('#err-'+no).val(0);
		}

		if(limitQty > 0 && qty > limitQty) {
			qty = limitQty;
			$('#qty-'+no).val(qty);
		}
	}



	if(sellPrice != "") {
		let amount = qty * sellPrice;
		let vatamount = get_vat_amount(amount, vatRate);
		$('#amount-'+no).val(amount.toFixed(2));
		$('#vatAmount-'+no).val(vatamount);
		console.log(amount);
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
	var totalBefDi = 0.00; //--- total befor discount but include vat
	var discPrcnt = parseDefault(parseFloat($('#discPrcnt').val()), 0); //--- discount percentage
	var totalDisc = 0.00; //--- discount amount
	var totalVat = 0.00; //--- total vat
	var totalAmount = 0; //--- total after bill discount
	var docTotal = 0.00;

	$('.input-qty').each(function(){
		let no = $(this).data('no');
		let vatRate = parseDefault(parseFloat($('#itemVatRate-'+no).val()), 0);
		let amount = parseDefault(parseFloat($('#amount-'+no).val()), 0);
		let discAmount = amount * (discPrcnt * 0.01);
		let lineTotal = amount - discAmount; //--- total after discount but include vat
		let vatAmount = get_vat_amount(lineTotal, vatRate);

		totalBefDi += amount;
		totalDisc += discAmount;
		totalVat += vatAmount;
		totalAmount += lineTotal;
	});

	totalBefVat = totalAmount - totalVat;
	docTotal = totalAmount;

	$('#totalBefDi').val(addCommas(totalBefDi.toFixed(2)));
	$('#discSum').val(addCommas(totalDisc.toFixed(2)));
	$('#totalAmount').val(addCommas(totalBefVat.toFixed(2)));
	$('#totalVat').val(addCommas(totalVat.toFixed(2)));
	$('#docTotal').val(addCommas(docTotal.toFixed(2)));
}


function previewOrder() {
	clearErrorByClass('e');

	let err = 0;
	let count = 0;
	let runno = 1;
	let msg = "";
	let price_edit = 0;

	//--- check valid data
	let customerCode = $('#customer').val();
	let customerName = $('#customer option:selected').data('name');
	let saleTeam = $('#customer option:selected').data('saleteam');
	let areaId = $('#customer option:selected').data('area');
	let shipToCode = $('#shipToCode').val();
	let shipToAddress = $('#ShipTo').val();
	let billToCode = $('#billToCode').val();
	let billToAddress = $('#BillTo').val();
	let priceList = $('#priceList').val();
	let term = $('#term').val();
	let termName = $('#term option:selected').text();
	let listName = $('#priceList option:selected').text();
	let docDate = $('#DocDate').val();
	let dueDate = $('#DocDueDate').val();
	let PoNo = $('#PoNo').val();
	let exShipTo = $('#exShipTo').val();
	let currencyRate = $('#currencyRate').val();
	let currency = $('#currency').val();
	let items = [];
	let totalBefDi = 0;
	let totalAmount = 0;
	let DiscPrcnt = parseDefault(parseFloat($('#discPrcnt').val()), 0);
	let DiscSum = 0;

	if(customerCode == "") {
		$('#customer').hasError();
		warning("กรุณาเลือกลูกค้า");
		return false;
	}

	if(priceList == "") {
		$('#priceList').hasError();
		warning("กรุณาเลือก Price List");
		return false;
	}

	if(currencyRate == 0) {
		$('#currencyRate').hasError();
		warning("อัตราแลกเปลี่ยนไม่ถูกต้อง");
		return false;
	}

	if(term == "") {
		$('#term').hasError();
		warning("กรุณาเลือก Payment Term");
		return false;
	}


	$('.item-code').each(function() {
		let no = $(this).data('no');
		let er = 0;

		if($(this).val() != "") {
			count++;
			let qty = parseDefault(parseInt($('#qty-'+no).val()), 0);
			let minQty = parseDefault(parseInt($('#step-'+no+' option:selected').data('stepqty')), 0);
			let limitQty = parseDefault(parseInt($('#step-'+no+' option:selected').data('limit')), 0);
			let freeQty = parseDefault(parseInt($('#step-'+no+' option:selected').data('freeqty')), 0);
			let free = parseDefault(parseInt($('#free-'+no).val()), 0);

			if(qty == 0 || qty < minQty || (limitQty > 0 && qty > limitQty)) {
				$('#qty-'+no).hasError();
				msg = "จำนวนไม่ถูกต้อง";
				err++;
				er++;
			}

			if(freeQty > 0 && free != freeQty) {
				$('#free-'+no).hasError();
				msg = "จำนวนแถมไม่ถูกต้อง";
				err++;
				er++;
			}

			if(er == 0) {
				let stdPrice = parseDefault(parseFloat($('#stdPrice-'+no).val()), 0);
				let sellPrice = parseDefault(parseFloat($('#price-'+no).val()), 0);

				if($('#price-'+no).val() != "") {
					if(sellPrice < stdPrice) {
						price_edit++;
					}
				}

				let amount = parseDefault(parseFloat($('#amount-'+no).val()), 0);

				let item = {
					"no" : runno,
					"ItemCode" : $(this).val(),
					"itemName" : $('#item-'+no).val(),
					"qty" : addCommas($('#qty-'+no).val()),
					"free" : addCommas($('#free-'+no).val()),
					"uom" : $('#uom-'+no).val(),
					"stdPrice" : addCommas(stdPrice.toFixed(2)),
					"sellPrice" : addCommas(sellPrice.toFixed(2)),
					"amount" : addCommas(amount.toFixed(2)),
					"dis" : $('#dis-'+no).is(':checked') ? '<i class="fa fa-check blue"></i>' : ''
				}

				items.push(item);
				runno++;
				totalBefDi += amount;
			}
		}
	});

	DiscSum = totalBefDi * (DiscPrcnt * 0.01);
	totalAmount = totalBefDi - DiscSum;

	let subTotal = {
		"totalBefDi" : addCommas(totalBefDi.toFixed(2)),
		"DiscPrcnt" : DiscPrcnt.toFixed(2),
		"DiscSum" : addCommas(DiscSum.toFixed(2)),
		"totalAmount" : addCommas(totalAmount.toFixed(2))
	}

	items.push(subTotal);

	if(count == 0) {
		warning("ไม่พบรายการสินค้า");
		return false;
	}

	if(err > 0) {
		warning(msg);
		return false;
	}


	let data = {
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
		"priceList" : priceList,
		"termName" : termName,
		"listName" : listName,
		"exShipTo" : exShipTo,
		"billOption" : $("input[name=billoption]:checked").val(),
		"requiredSQ" : $('#require-sq').is(':checked') ? 'Y' : 'N',
		"remark" : $('#remark').val(),
		"items" : items
	}

	console.log(data);

	$.ajax({
		url:HOME + 'check_approve',
		type:'GET',
		cache:false,
		data:{
			'docTotal' : totalAmount,
			'priceEdit' : price_edit,
			'customerCode' : customerCode,
			'saleTeam' : saleTeam,
			'areaId' : areaId
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
					setTimeout(() => {
						var source = $('#preview-template').html();
						var output = $('#result');
						render(source, data, output);
						$('#previewModal').modal('show');
					}, 100);
			  })
			}
		}
	})
}


function warning(msg) {
	swal({
		title:"",
		text:msg,
		type:"warning",
		html:true
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


function toggleDiscount() {
	let term_id = $('#term').val();
	let discPrcnt = parseDefault(parseFloat($('#term option:selected').data('disc')), 0);

	if(term_id != '-10' && term_id != '') {
		swal({
			title:'โปรดทราบ',
			text:'คุณจำเป็นต้องแจ้งให้ลูกค้าทราบเกี่ยวกับ payment term ที่เลือกนี้ด้วย',
			type:'warning',
			showCancelButton:true,
			confirmButtonText:'รับทราบ',
			cancelButtonText:'ยกเลิก',
			closeOnConfirm:true
		}, function(isConfirm) {
			if(isConfirm) {
				let canChange = $('#term option:selected').data('change');

				$('#discPrcnt').val(discPrcnt);

				if(canChange == 1) {
					$('#discPrcnt').removeAttr('disabled');
					$('#discPrcnt').focus();
				}
				else {
					$('#discPrcnt').attr('disabled', 'disabled');
				}

				recalTotal();
			}
			else {
				$('#term').val("");
				$('#discPrcnt').attr('disabled', 'disabled');
				$('#discPrcnt').val(0);
				recalTotal();
			}
		})
	}
	else {
		let canChange = $('#term option:selected').data('change');

		$('#discPrcnt').val(discPrcnt);

		if(canChange == 1) {
			$('#discPrcnt').removeAttr('disabled');
			$('#discPrcnt').focus();
		}
		else {
			$('#discPrcnt').attr('disabled', 'disabled');
		}

		recalTotal();
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


function saveAdd() {

	$('#previewModal').modal('hide');

	var ds = {
		//---- Right column
		'CardCode' : $('#customer').val(),  //****** required
		'CardName' : $('#customer option:selected').data('name'),
		'CustomerGroupNum' : $('#customer option:selected').data('groupnum'),
		'isControl' : $('#customer option:selected').data('control') == 'Y' ? 'Y' : 'N',
		'saleTeam' : $('#customer option:selected').data('saleteam'),
		'areaId' : $('#customer option:selected').data('area'),
		'SlpCode' : $('#customer option:selected').data('sale'),
		'CardGroup' : $('#customer option:selected').data('department'), //--- department
		'PriceList' : $('#priceList').val(),
		'PayToCode' : $('#billToCode').val(),
		'BillTo' : $('#BillTo').val(),
		'ShipToCode' : $('#shipToCode').val(),
		'ShipTo' : $('#ShipTo').val(),
		'exShipTo' : $('#exShipTo').val(),
		'VatGroup' : $('#VatGroup').val(),
		'VatRate' : $('#vatRate').val(),
		'CardType' : $('#cardType').val(),
		//--- right Column
		'DocDate' : $('#DocDate').val(), //****** required
		'DocDueDate' : $('#DocDueDate').val(), //****** required
		'NumAtCard' : $('#PoNo').val(),
		'DocCur' : $('#currency').val(),
		'DocRate' : $('#currencyRate').val(),
		//---- footer
		'TotalBefDi' : parseDefault(parseFloat(removeCommas($('#totalBefDi').val())), 0),
		'term' : $('#term').val(),
		'DiscType' : $('#term option:selected').data('change') == '1' ? 'M' : 'A',
		'GroupNum' : $('#term option:selected').data('groupnum'),
		'DiscPrcnt' : parseDefault(parseFloat($('#discPrcnt').val()), 0),
		'DiscSum' : parseDefault(parseFloat(removeCommas($('#discSum').val())), 0),
		'billOption' : $("input[name=billoption]:checked").val(),
		'requireSQ' : $('#require-sq').is(':checked') ? 'Y' : 'N',
		'comments' : $.trim($('#remark').val()),
		'TotalAfDisc' : parseDefault(parseFloat(removeCommas($('#totalAmount').val())), 0),
		'totalVat' : parseDefault(parseFloat(removeCommas($('#totalVat').val())), 0),
		'docTotal' : parseDefault(parseFloat(removeCommas($('#docTotal').val())), 0),
		'is_discount_sales' : 0
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
			let dis = $('#dis-'+no).is(':checked') ? 1 : 0;
			let step_id = $('#step-'+no).val();

			let item = {
				"ItemCode" : $(this).val(),
				"ItemName" : $("#item-"+no).val(),
				"isControl" : $('#control-'+no).val(),
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
				"WhsCode" : $('#whsCode-'+no).val(),
				"discount_sales" : dis,
				"step_id" : step_id
			}

			if($('#freeTxt-'+no).length) {
				item.freeTxt = $('#freeTxt-'+no).val();
			}

			if(dis == 1) {
				ds.is_discount_sales = 1;
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


function clearText(no) {
	$('#item-'+no).val('');
	$('#itemCode-'+no).val('');
	$('#step-'+no).html('<option value="">Select</option>');
	$('#step-data-'+no).val('');
	$('#uom-'+no).val('');
	$('#qty-'+no).val('');
	$('#free-'+no).val('');
	$('#amount-'+no).val('');
	$('#stdPrice-'+no).val('');
	$('#price-'+no).val('');
	$('#instock-'+no).val('');
	$('#commit-'+no).val('');
	$('#available-'+no).val('');
	$('#itemVatCode-'+no).val('');
	$('#itemVatRate-'+no).val('');
	$('#whsCode-'+no).val('');

	recalAmount(no);
	$('#item-'+no).focus();
}



$('.autosize').autosize({append: "\n"});

function wordCount(el, no) {
	let count = el.val().length;
	$('#word-count-'+no).text(count);
}


$('#discPrcnt').keyup(function() {
	recalTotal();
})
