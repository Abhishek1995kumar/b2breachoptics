var dataTable;
$(document).ready(function() {
	$('.premiumtype').hide();
	dataTable = $('#product_list_table').DataTable({
		dom: 'lfrtip',
		'fixedHeader': true,
		'processing': true,
		'serverSide': true,
		"bLengthChange": false,
		"language": {
			"processing": ` <div id='loader' style=''>
		<svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
		<defs>
			<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
				<stop offset="0%" stop-color="#5ebd3e" />
				<stop offset="33%" stop-color="#ffb900" />
				<stop offset="67%" stop-color="#f78200" />
				<stop offset="100%" stop-color="#e23838" />
			</linearGradient>
			<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
				<stop offset="0%" stop-color="#e23838" />
				<stop offset="33%" stop-color="#973999" />
				<stop offset="67%" stop-color="#009cdf" />
				<stop offset="100%" stop-color="#5ebd3e" />
			</linearGradient>
		</defs>
		<g fill="none" stroke-linecap="round" stroke-width="16">
			<g class="ip__track" stroke="#ddd">
				<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
				<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
			</g>
			<g stroke-dasharray="180 656">
				<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
				<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
				</g>
			</g>
		</svg>
		</div>`
		},
		'responsive': true,
		'colReorder': true,
		'ajax': {
			'url': baseUrl + "/admin/products/get_list_details",
			'type': 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: function(d) {
				// Append additional data to the request, such as the selected category_id
				d._token = $('meta[name="csrf-token"]').attr("content");
				d.category_id = $('#category').val();
				d.premiumtype = $('#premiumtype').val();
			},
		},
		"columnDefs": [{
			"orderable": false,
			"targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
		}, ],
		"aaSorting": []
	});

	$('#category').on('change', function() {
		var category_id = $(this).val();
		if(category_id == 82){
			$('.premiumtype').show();
		}
		else {
			$('.premiumtype').hide();
		}
		dataTable.ajax.reload();
		handleExportButtonVisibility(category_id);
	});

	$('#premiumtype').on('change', function() {
		dataTable.ajax.reload();
	});
});

function getExcelExportDate(data)
{
	return new Promise(function(myResolve, myReject) {
		$.ajax({
			url: baseUrl + "/admin/export_excel",
			type: "POST",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: data,
			success: function(resp) {
				myResolve(resp)
			},
			error: function(err) {
				myReject(err);
			}
		});
	});
}

// Exporting excel here
async function exportExcel() {
	let data = {
		category_id: $('#category').val(),
		draw: dataTable.ajax.params().draw,
		search: {
			value: dataTable.search()
		}
	};

	try {
		let resp = await getExcelExportDate(data);
		if(resp.length > 0){
			if(resp[0].category == "Frames"){
				frame_export_excel(resp);
			}
			else if(resp[0].category == "Lenses"){
				lenses_export_excel(resp);
			}
			else if(resp[0].category == "Sunglasses"){
				sunglasses_export_excel(resp);
			}
			else if(resp[0].category == "Contact Lenses"){
				contact_lens_export_excel(resp);
			}
			else if(resp[0].category == "Premium Brands"){
				premium_brand_export_excel(resp);
			}
			else if(resp[0].category == "Contact Lens Solutions"){
				contact_lens_solution_export_excel(resp);
			}
			else{
				//
			}
		}
		else{
			Swal.fire({
				title: `No Product Found In Records`,
				confirmButtonText: 'OK',
			});
		}

	} catch (error) {
		alert(error.massage)
	}
};

function frame_export_excel(resp) {
	table = $('#excel_product_frame_list_div').clone();
	tbody = table.find('.excel_frame_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].shape ? resp[i].shape : "--");
		trow.append(td3)
		td4 = document.createElement("td");
		td4.append(resp[i].framecolor ? resp[i].framecolor : "--");
		trow.append(td4)

		td5 = document.createElement("td");
		td5.append(resp[i].gender ? resp[i].gender : "--");
		trow.append(td5)
		td6 = document.createElement("td");
		td6.append(resp[i].brandname ? resp[i].brandname : "--");
		trow.append(td6)
		td7 = document.createElement("td");
		td7.append(resp[i].modelno ? resp[i].modelno : "--");
		trow.append(td7)
		td8 = document.createElement("td");
		td8.append(resp[i].colorcode ? resp[i].colorcode : "--");
		trow.append(td8)
		td9 = document.createElement("td");
		td9.append(resp[i].sellername ? resp[i].sellername : "--");
		trow.append(td9)
		td10 = document.createElement("td");
		td10.append(resp[i].framematerial ? resp[i].framematerial : "--");
		trow.append(td10)

		td11 = document.createElement("td");
		td11.append(resp[i].framewidth ? resp[i].framewidth : "--");
		trow.append(td11)
		td12 = document.createElement("td");
		td12.append(resp[i].templematerial ? resp[i].templematerial : "--");
		trow.append(td12)
		td13 = document.createElement("td");
		td13.append(resp[i].templecolor ? resp[i].templecolor : "--");
		trow.append(td13)
		td14 = document.createElement("td");
		td14.append(resp[i].frametype ? resp[i].frametype : "--");
		trow.append(td14)
		td15 = document.createElement("td");
		td15.append(resp[i].manufracturer ? resp[i].manufracturer : "--");
		trow.append(td15)
		td16 = document.createElement("td");
		td16.append(resp[i].warrentytype ? resp[i].warrentytype : "--");
		trow.append(td16)
		td17 = document.createElement("td");
		td17.append(resp[i].productdimension ? resp[i].productdimension : "--");
		trow.append(td17)
		td18 = document.createElement("td");
		td18.append(resp[i].weight ? resp[i].weight : "--");
		trow.append(td18)
		td19 = document.createElement("td");
		td19.append(resp[i].height ? resp[i].height : "--");
		trow.append(td19)
		td20 = document.createElement("td");
		td20.append(resp[i].packweight ? resp[i].packweight : "--");
		trow.append(td20)
		td21 = document.createElement("td");
		td21.append(resp[i].packwidth ? resp[i].packwidth : "--");
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].packlength ? resp[i].packlength : "--");
		trow.append(td22)
		td23 = document.createElement("td");
		td23.append(resp[i].countryoforigin);
		trow.append(td23)
		td24 = document.createElement("td");
		td24.append(resp[i].hsncode ? resp[i].hsncode : "--");
		trow.append(td24)
		td25 = document.createElement("td");
		td25.append(resp[i].description ? resp[i].description : "--");
		trow.append(td25)
		td26 = document.createElement("td");
		td26.append(resp[i].price ? resp[i].price : "--");
		trow.append(td26)
		td27 = document.createElement("td");
		td27.append(resp[i].previous_price ? resp[i].previous_price : "--");
		trow.append(td27)
		td28 = document.createElement("td");
		td28.append(resp[i].costprice ? resp[i].costprice : "--");
		trow.append(td28)
		td29 = document.createElement("td");
		td29.append(resp[i].stock ? resp[i].stock : "0");
		trow.append(td29)
		td30 = document.createElement("td");
		td30.append(resp[i].producttat ? resp[i].producttat : "--");
		trow.append(td30)
		td31 = document.createElement("td");
		td31.append(resp[i].policy ? resp[i].policy : "--");
		trow.append(td31)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+k));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("--");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("--");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("--");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append(resp[i].get_product_attribute[k].attr_color);
				trow.append(td4)

				td5 = document.createElement("td");
				td5.append("--");
				trow.append(td5)
				td6 = document.createElement("td");
				td6.append("--");
				trow.append(td6)
				td7 = document.createElement("td");
				td7.append("--");
				trow.append(td7)
				td8 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td8.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				trow.append(td8)
				td09 = document.createElement("td");
				td09.append("--");
				trow.append(td09)
				td10 = document.createElement("td");
				td10.append("--");
				trow.append(td10)

				td11 = document.createElement("td");
				td11.append("--");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("--");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append("--");
				trow.append(td13)
				td14 = document.createElement("td");
				td14.append("--");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("--");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("--");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append(resp[i].get_product_attribute[k].attr_size);
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("--");
				trow.append(td18)
				td19 = document.createElement("td");
				td19.append("--");
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append("--");
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append("--");
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("--");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("--");
				trow.append(td23)
				td24 = document.createElement("td");
				td24.append("--");
				trow.append(td24)
				td25 = document.createElement("td");
				td25.append("--");
				trow.append(td25)
				td26 = document.createElement("td");
				td26.append("--");
				trow.append(td26)

				td27 = document.createElement("td");
				td27.append(resp[i].get_product_attribute[k].attr_mrp);
				trow.append(td27)
				td28 = document.createElement("td");
				td28.append(resp[i].get_product_attribute[k].attr_price);
				trow.append(td28)
				td29 = document.createElement("td");
				td29.append(resp[i].get_product_attribute[k].attr_qty);
				trow.append(td29)
				td30 = document.createElement("td");
				td30.append("--");
				trow.append(td30)
				td31 = document.createElement("td");
				td31.append("--");
				trow.append(td31);
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function lenses_export_excel(resp) {
	table = $('#excel_product_lenses_list_div').clone();
	tbody = table.find('.excel_lenses_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].brandname ? resp[i].brandname : "-");
		trow.append(td3)

		td4 = document.createElement("td");
		td4.append(resp[i].visioneffect ? resp[i].visioneffect : "-");
		trow.append(td4)

		td5 = document.createElement("td");
		td5.append(resp[i].colorcode ? resp[i].colorcode : "-");
		trow.append(td5)

		td6 = document.createElement("td");
		td6.append(resp[i].sellername ? resp[i].sellername : "-");
		trow.append(td6)
		td7 = document.createElement("td");
		td7.append(resp[i].diameterlens ? resp[i].diameterlens : "-");
		trow.append(td7)
		td8 = document.createElement("td");
		td8.append(resp[i].sphere ? resp[i].sphere : "-");
		trow.append(td8)

		td9 = document.createElement("td");
		td9.append(resp[i].axisnlens ? resp[i].axisnlens : "-");
		trow.append(td9)

		td10 = document.createElement("td");
		td10.append(resp[i].cylinderlens ? resp[i].cylinderlens : "-");
		trow.append(td10)
		td11 = document.createElement("td");
		td11.append(resp[i].addpower ? resp[i].addpower : "-");
		trow.append(td11)

		td12 = document.createElement("td");
		td12.append(resp[i].lensmaterialtype ? resp[i].lensmaterialtype : "-");
		trow.append(td12)

		td13 = document.createElement("td");
		td13.append(resp[i].color ? resp[i].color : "-");
		trow.append(td13)

		td14 = document.createElement("td");
		td14.append(resp[i].lenstechnology ? resp[i].lenstechnology : "-");
		trow.append(td14)

		td15 = document.createElement("td");
		td15.append(resp[i].lensindex ? resp[i].lensindex : "-");
		trow.append(td15)
		td16 = document.createElement("td");
		td16.append(resp[i].gravity ? resp[i].gravity : "-");
		trow.append(td16)

		td17 = document.createElement("td");
		td17.append(resp[i].coating ? resp[i].coating : "-");
		trow.append(td17)
		td18 = document.createElement("td");
		td18.append(resp[i].coatingcolor ? resp[i].coatingcolor : "-");
		trow.append(td18)

		td19 = document.createElement("td");
		td19.append(resp[i].abbevalue ? resp[i].abbevalue : "-");
		trow.append(td19)

		td20 = document.createElement("td");
		td20.append(resp[i].focallength ? resp[i].focallength : "-");
		trow.append(td20)

		td21 = document.createElement("td");
		td21.append(resp[i].manufracturer ? resp[i].manufracturer : "-");
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].warrentytype ? resp[i].warrentytype : "-");
		trow.append(td22)

		td23 = document.createElement("td");
		td23.append(resp[i].weight ? resp[i].weight : "-");
		trow.append(td23)

		td24 = document.createElement("td");
		td24.append(resp[i].packweight ? resp[i].packweight : "-");
		trow.append(td24)
		td25 = document.createElement("td");
		td25.append(resp[i].packwidth ? resp[i].packwidth : "-");
		trow.append(td25)
		td26 = document.createElement("td");
		td26.append(resp[i].packlength ? resp[i].packlength : "-");
		trow.append(td26)
		td27 = document.createElement("td");
		td27.append(resp[i].countryoforigin);
		trow.append(td27)
		td28 = document.createElement("td");
		td28.append(resp[i].hsncode);
		trow.append(td28)
		td29 = document.createElement("td");
		td29.append(resp[i].description ? resp[i].description : "-");
		trow.append(td29)
		td30 = document.createElement("td");
		td30.append(resp[i].price ? resp[i].price : "-");
		trow.append(td30)
		td31 = document.createElement("td");
		td31.append(resp[i].previous_price);
		trow.append(td31)
		td32 = document.createElement("td");
		td32.append(resp[i].costprice);
		trow.append(td32)
		td33 = document.createElement("td");
		td33.append(resp[i].stock);
		trow.append(td33)
		td34 = document.createElement("td");
		td34.append(resp[i].producttat ? resp[i].producttat : "-");
		trow.append(td34)
		td35 = document.createElement("td");
		td35.append(resp[i].policy ? resp[i].policy : "-");
		trow.append(td35)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+j));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("-");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("-");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("-");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append("-");
				trow.append(td4)
				td5 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td5.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				trow.append(td5)
				td6 = document.createElement("td");
				td6.append("-");
				trow.append(td6)
				td7 = document.createElement("td");
				td7.append("-");
				trow.append(td7)
				td8 = document.createElement("td");
				td8.append("-");
				trow.append(td8)
				td9 = document.createElement("td");
				td9.append("-");
				trow.append(td9)
				td10 = document.createElement("td");
				td10.append("-");
				trow.append(td10)
				td11 = document.createElement("td");
				td11.append("-");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("-");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append(resp[i].get_product_attribute[k].attr_color);
				trow.append(td13)
				td14 = document.createElement("td");
				td14.append("-");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("-");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("-");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append("-");
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("-");
				trow.append(td18)
				td19 = document.createElement("td");
				td19.append("-");
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append("-");
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append("-");
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("-");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("-");
				trow.append(td23)
				td24 = document.createElement("td");
				td24.append("-");
				trow.append(td24)
				td25 = document.createElement("td");
				td25.append("-");
				trow.append(td25)
				td26 = document.createElement("td");
				td26.append("-");
				trow.append(td26)
				td27 = document.createElement("td");
				td27.append("-");
				trow.append(td27)
				td28 = document.createElement("td");
				td28.append("-");
				trow.append(td28)
				td29 = document.createElement("td");
				td29.append("-");
				trow.append(td29)
				td30 = document.createElement("td");
				td30.append("-");
				trow.append(td30)
				td31 = document.createElement("td");
				td31.append(resp[i].get_product_attribute_color[k].attr_mrp);
				trow.append(td31)
				td32 = document.createElement("td");
				td32.append(resp[i].get_product_attribute_color[k].attr_price);
				trow.append(td32)
				td33 = document.createElement("td");
				td33.append(resp[i].get_product_attribute_color[k].attr_qty);
				trow.append(td33)
				td34 = document.createElement("td");
				td34.append("-");
				trow.append(td34)
				td35 = document.createElement("td");
				td35.append("-");
				trow.append(td35)
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function sunglasses_export_excel(resp) {
	table = $('#excel_product_sunglasses_list_div').clone();
	tbody = table.find('.excel_sunglasses_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].shape ? resp[i].shape : "-");
		trow.append(td3)
		td4 = document.createElement("td");
		td4.append(resp[i].framecolor ? resp[i].framecolor : "-");
		trow.append(td4)

		td5 = document.createElement("td");
		td5.append(resp[i].gender ? resp[i].gender : "-");
		trow.append(td5)
		td6 = document.createElement("td");
		td6.append(resp[i].brandname ? resp[i].brandname : "-");
		trow.append(td6)
		td7 = document.createElement("td");
		td7.append(resp[i].modelno ? resp[i].modelno : "-");
		trow.append(td7)
		td8 = document.createElement("td");
		td8.append(resp[i].colorcode ? resp[i].colorcode : "-");
		trow.append(td8)
		td9 = document.createElement("td");
		td9.append(resp[i].sellername ? resp[i].sellername : "-");
		trow.append(td9)
		td10 = document.createElement("td");
		td10.append(resp[i].framematerial ? resp[i].framematerial : "-");
		trow.append(td10)

		td11 = document.createElement("td");
		td11.append(resp[i].framewidth ? resp[i].framewidth : "-");
		trow.append(td11)
		td12 = document.createElement("td");
		td12.append(resp[i].templematerial ? resp[i].templematerial : "-");
		trow.append(td12)
		td13 = document.createElement("td");
		td13.append(resp[i].templecolor ? resp[i].templecolor : "-");
		trow.append(td13)
		td14 = document.createElement("td");
		td14.append(resp[i].frametype ? resp[i].frametype : "-");
		trow.append(td14)

		td32 = document.createElement("td");
		td32.append(resp[i].lensmaterialtype ? resp[i].lensmaterialtype : "-");
		trow.append(td32)
		td33 = document.createElement("td");
		td33.append(resp[i].color ? resp[i].color : "--");
		trow.append(td33)
		td34 = document.createElement("td");
		td34.append(resp[i].lenstechnology ? resp[i].lenstechnology : "-");
		trow.append(td34)

		td15 = document.createElement("td");
		td15.append(resp[i].manufracturer ? resp[i].manufracturer : "-");
		trow.append(td15)
		td16 = document.createElement("td");
		td16.append(resp[i].warrentytype ? resp[i].warrentytype : "-");
		trow.append(td16)
		td17 = document.createElement("td");
		td17.append(resp[i].productdimension ? resp[i].productdimension : "-");
		trow.append(td17)
		td18 = document.createElement("td");
		td18.append(resp[i].weight ? resp[i].weight : "-");
		trow.append(td18)
		td19 = document.createElement("td");
		td19.append(resp[i].height ? resp[i].height : "-");
		trow.append(td19)
		td20 = document.createElement("td");
		td20.append(resp[i].packweight ? resp[i].packweight : "-");
		trow.append(td20)
		td21 = document.createElement("td");
		td21.append(resp[i].packwidth ? resp[i].packwidth : "-");
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].packlength ? resp[i].packlength : "-");
		trow.append(td22)
		td23 = document.createElement("td");
		td23.append(resp[i].countryoforigin);
		trow.append(td23)
		td24 = document.createElement("td");
		td24.append(resp[i].hsncode ? resp[i].hsncode : "-");
		trow.append(td24)
		td25 = document.createElement("td");
		td25.append(resp[i].description ? resp[i].description : "-");
		trow.append(td25)
		td26 = document.createElement("td");
		td26.append(resp[i].price ? resp[i].price : "--");
		trow.append(td26)
		td27 = document.createElement("td");
		td27.append(resp[i].previous_price ? resp[i].previous_price : "-");
		trow.append(td27)
		td28 = document.createElement("td");
		td28.append(resp[i].costprice ? resp[i].costprice : "-");
		trow.append(td28)
		td29 = document.createElement("td");
		td29.append(resp[i].stock ? resp[i].stock : "0");
		trow.append(td29)
		td30 = document.createElement("td");
		td30.append(resp[i].producttat ? resp[i].producttat : "-");
		trow.append(td30)
		td31 = document.createElement("td");
		td31.append(resp[i].policy ? resp[i].policy : "-");
		trow.append(td31)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+k));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("-");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("-");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("-");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append(resp[i].get_product_attribute[k].attr_color);
				trow.append(td4)

				td5 = document.createElement("td");
				td5.append("-");
				trow.append(td5)
				td6 = document.createElement("td");
				td6.append("-");
				trow.append(td6)
				td7 = document.createElement("td");
				td7.append("-");
				trow.append(td7)
				td8 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td8.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				trow.append(td8)
				td9 = document.createElement("td");
				td9.append("-");
				trow.append(td9)
				td10 = document.createElement("td");
				td10.append("-");
				trow.append(td10)
				td11 = document.createElement("td");
				td11.append("-");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("-");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append("-");
				trow.append(td13)

				td14 = document.createElement("td");
				td14.append("-");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("-");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("-");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append("-");
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("-");
				trow.append(td18)
				td19 = document.createElement("td");
				td19.append("-");
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append(resp[i].get_product_attribute[k].attr_size);
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append("-");
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("-");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("-");
				trow.append(td23)
				td24 = document.createElement("td");
				td24.append("-");
				trow.append(td24)
				td25 = document.createElement("td");
				td25.append("-");
				trow.append(td25)
				td26 = document.createElement("td");
				td26.append("-");
				trow.append(td26)
				td27 = document.createElement("td");
				td27.append("-");
				trow.append(td27)
				td28 = document.createElement("td");
				td28.append("-");
				trow.append(td28)
				td29 = document.createElement("td");
				td29.append("-");
				trow.append(td29)

				td30 = document.createElement("td");
				td30.append(resp[i].get_product_attribute[k].attr_mrp);
				trow.append(td30)
				td31 = document.createElement("td");
				td31.append(resp[i].get_product_attribute[k].attr_price);
				trow.append(td31)
				td32 = document.createElement("td");
				td32.append(resp[i].get_product_attribute[k].attr_qty);
				trow.append(td32)
				td33 = document.createElement("td");
				td33.append("--");
				trow.append(td33)
				td34 = document.createElement("td");
				td34.append("--");
				trow.append(td34);
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function contact_lens_export_excel(resp) {
	table = $('#excel_product_contact_lenses_list_div').clone();
	tbody = table.find('.excel_contact_lenses_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].brandname ? resp[i].brandname : "-");
		trow.append(td3)

		td4 = document.createElement("td");
		td4.append(resp[i].lenstype ? resp[i].lenstype : "-");
		trow.append(td4)

		td5 = document.createElement("td");
		td5.append(resp[i].modelno ? resp[i].modelno : "-");
		trow.append(td5)

		td6 = document.createElement("td");
		td6.append(resp[i].colorcode ? resp[i].colorcode : "-");
		trow.append(td6)

		td7 = document.createElement("td");
		td7.append(resp[i].sellername ? resp[i].sellername : "-");
		trow.append(td7)
		td8 = document.createElement("td");
		td8.append(resp[i].diameter ? resp[i].diameter : "-");
		trow.append(td8)
		td9 = document.createElement("td");
		td9.append(resp[i].basecurve ? resp[i].basecurve : "-");
		trow.append(td9)

		td10 = document.createElement("td");
		td10.append(resp[i].powermin ? resp[i].powermin : "-");
		trow.append(td10)

		td11 = document.createElement("td");
		td11.append(resp[i].powermax ? resp[i].powermax : "-");
		trow.append(td11)
		td12 = document.createElement("td");
		td12.append(resp[i].axisnew ? resp[i].axisnew : "-");
		trow.append(td12)

		td13 = document.createElement("td");
		td13.append(resp[i].cylindernew ? resp[i].cylindernew : "-");
		trow.append(td13)

		td14 = document.createElement("td");
		td14.append(resp[i].addpower ? resp[i].addpower : "-");
		trow.append(td14)

		td15 = document.createElement("td");
		td15.append(resp[i].centerthiknessnew ? resp[i].centerthiknessnew : "-");
		trow.append(td15)

		td16 = document.createElement("td");
		td16.append(resp[i].contactlensmaterialtype ? resp[i].contactlensmaterialtype : "-");
		trow.append(td16)
		td17 = document.createElement("td");
		td17.append(resp[i].lenscolor ? resp[i].lenscolor : "-");
		trow.append(td17)

		td18 = document.createElement("td");
		td18.append(resp[i].usagesduration ? resp[i].usagesduration : "-");
		trow.append(td18)
		td19 = document.createElement("td");
		td19.append(resp[i].disposability ? resp[i].disposability : "-");
		trow.append(td19)

		td20 = document.createElement("td");
		td20.append(resp[i].packaging ? resp[i].packaging : "-");
		trow.append(td20)

		td21 = document.createElement("td");
		td21.append(resp[i].manufracturer ? resp[i].manufracturer : "-");
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].warrentytype ? resp[i].warrentytype : "-");
		trow.append(td22)

		td23 = document.createElement("td");
		td23.append(resp[i].weight ? resp[i].weight : "-");
		trow.append(td23)

		td24 = document.createElement("td");
		td24.append(resp[i].packweight ? resp[i].packweight : "-");
		trow.append(td24)
		td25 = document.createElement("td");
		td25.append(resp[i].packwidth ? resp[i].packwidth : "-");
		trow.append(td25)
		td26 = document.createElement("td");
		td26.append(resp[i].packlength ? resp[i].packlength : "-");
		trow.append(td26)
		td27 = document.createElement("td");
		td27.append(resp[i].countryoforigin);
		trow.append(td27)
		td28 = document.createElement("td");
		td28.append(resp[i].hsncode);
		trow.append(td28)
		td29 = document.createElement("td");
		td29.append(resp[i].description ? resp[i].description : "-");
		trow.append(td29)
		td30 = document.createElement("td");
		td30.append(resp[i].price ? resp[i].price : "-");
		trow.append(td30)
		td31 = document.createElement("td");
		td31.append(resp[i].previous_price);
		trow.append(td31)
		td32 = document.createElement("td");
		td32.append(resp[i].costprice);
		trow.append(td32)
		td33 = document.createElement("td");
		td33.append(resp[i].stock);
		trow.append(td33)
		td34 = document.createElement("td");
		td34.append(resp[i].producttat ? resp[i].producttat : "-");
		trow.append(td34)
		td35 = document.createElement("td");
		td35.append(resp[i].policy ? resp[i].policy : "-");
		trow.append(td35)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+k));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("-");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("-");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("-");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append("-");
				trow.append(td4)
				td5 = document.createElement("td");
				td5.append("-");
				trow.append(td5)
				td6 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td6.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				trow.append(td6)
				td7 = document.createElement("td");
				td7.append("-");
				trow.append(td7)
				td8 = document.createElement("td");
				td8.append("-");
				trow.append(td8)
				td9 = document.createElement("td");
				td9.append("-");
				trow.append(td9)
				td10 = document.createElement("td");
				td10.append("-");
				trow.append(td10)
				td11 = document.createElement("td");
				td11.append("-");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("-");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append("-");
				trow.append(td13)
				td14 = document.createElement("td");
				td14.append("-");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("-");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("-");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append(resp[i].get_product_attribute[k].attr_color);
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("-");
				trow.append(td18)
				td19 = document.createElement("td");
				td19.append("-");
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append("-");
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append("-");
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("-");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("-");
				trow.append(td23)
				td24 = document.createElement("td");
				td24.append("-");
				trow.append(td24)
				td25 = document.createElement("td");
				td25.append("-");
				trow.append(td25)
				td26 = document.createElement("td");
				td26.append("-");
				trow.append(td26)
				td27 = document.createElement("td");
				td27.append("-");
				trow.append(td27)
				td28 = document.createElement("td");
				td28.append("-");
				trow.append(td28)
				td29 = document.createElement("td");
				td29.append("-");
				trow.append(td29)
				td30 = document.createElement("td");
				td30.append("-");
				trow.append(td30)
				td31 = document.createElement("td");
				td31.append(resp[i].get_product_attribute[k].attr_mrp ? resp[i].get_product_attribute[k].attr_mrp : "-");
				trow.append(td31)
				td32 = document.createElement("td");
				td32.append(resp[i].get_product_attribute[k].attr_price ? resp[i].get_product_attribute[k].attr_price : "-");
				trow.append(td32)
				td33 = document.createElement("td");
				td33.append(resp[i].get_product_attribute[k].attr_qty ? resp[i].get_product_attribute[k].attr_qty : "-");
				trow.append(td33)
				td34 = document.createElement("td");
				td34.append("-");
				trow.append(td34)
				td35 = document.createElement("td");
				td35.append("-");
				trow.append(td35)
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function premium_brand_export_excel(resp) {
	table = $('#excel_product_premium_list_div').clone();
	tbody = table.find('.excel_premium_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].shape ? resp[i].shape : "-");
		trow.append(td3)
		td4 = document.createElement("td");
		td4.append(resp[i].framecolor ? resp[i].framecolor : "-");
		trow.append(td4)

		td5 = document.createElement("td");
		td5.append(resp[i].gender ? resp[i].gender : "-");
		trow.append(td5)
		td6 = document.createElement("td");
		td6.append(resp[i].brandname ? resp[i].brandname : "-");
		trow.append(td6)
		td7 = document.createElement("td");
		td7.append(resp[i].modelno ? resp[i].modelno : "-");
		trow.append(td7)
		td8 = document.createElement("td");
		td8.append(resp[i].colorcode ? resp[i].colorcode : "-");
		trow.append(td8)
		td9 = document.createElement("td");
		td9.append(resp[i].sellername ? resp[i].sellername : "-");
		trow.append(td9)
		td10 = document.createElement("td");
		td10.append(resp[i].framematerial ? resp[i].framematerial : "-");
		trow.append(td10)

		td11 = document.createElement("td");
		td11.append(resp[i].framewidth ? resp[i].framewidth : "-");
		trow.append(td11)
		td12 = document.createElement("td");
		td12.append(resp[i].templematerial ? resp[i].templematerial : "-");
		trow.append(td12)
		td13 = document.createElement("td");
		td13.append(resp[i].templecolor ? resp[i].templecolor : "-");
		trow.append(td13)
		td14 = document.createElement("td");
		td14.append(resp[i].frametype ? resp[i].frametype : "-");
		trow.append(td14)

		td32 = document.createElement("td");
		td32.append(resp[i].lensmaterialtype ? resp[i].lensmaterialtype : "-");
		trow.append(td32)
		td33 = document.createElement("td");
		td33.append(resp[i].color ? resp[i].color : "--");
		trow.append(td33)
		td34 = document.createElement("td");
		td34.append(resp[i].lenstechnology ? resp[i].lenstechnology : "-");
		trow.append(td34)

		td15 = document.createElement("td");
		td15.append(resp[i].manufracturer ? resp[i].manufracturer : "-");
		trow.append(td15)
		td16 = document.createElement("td");
		td16.append(resp[i].warrentytype ? resp[i].warrentytype : "-");
		trow.append(td16)
		td17 = document.createElement("td");
		td17.append(resp[i].productdimension ? resp[i].productdimension : "-");
		trow.append(td17)
		td18 = document.createElement("td");
		td18.append(resp[i].weight ? resp[i].weight : "-");
		trow.append(td18)
		td19 = document.createElement("td");
		td19.append(resp[i].height ? resp[i].height : "-");
		trow.append(td19)
		td20 = document.createElement("td");
		td20.append(resp[i].packweight ? resp[i].packweight : "-");
		trow.append(td20)
		td21 = document.createElement("td");
		td21.append(resp[i].packwidth ? resp[i].packwidth : "-");
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].packlength ? resp[i].packlength : "-");
		trow.append(td22)
		td23 = document.createElement("td");
		td23.append(resp[i].countryoforigin);
		trow.append(td23)
		td24 = document.createElement("td");
		td24.append(resp[i].hsncode ? resp[i].hsncode : "-");
		trow.append(td24)
		td25 = document.createElement("td");
		td25.append(resp[i].description ? resp[i].description : "-");
		trow.append(td25)
		td26 = document.createElement("td");
		td26.append(resp[i].price ? resp[i].price : "--");
		trow.append(td26)
		td27 = document.createElement("td");
		td27.append(resp[i].previous_price ? resp[i].previous_price : "-");
		trow.append(td27)
		td28 = document.createElement("td");
		td28.append(resp[i].costprice ? resp[i].costprice : "-");
		trow.append(td28)
		td29 = document.createElement("td");
		td29.append(resp[i].stock ? resp[i].stock : "0");
		trow.append(td29)
		td30 = document.createElement("td");
		td30.append(resp[i].producttat ? resp[i].producttat : "-");
		trow.append(td30)
		td31 = document.createElement("td");
		td31.append(resp[i].policy ? resp[i].policy : "-");
		trow.append(td31)
		td35 = document.createElement("td");
		td35.append(resp[i].premiumtype ? resp[i].premiumtype : "-");
		trow.append(td35)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+k));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("-");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("-");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("-");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append(resp[i].get_product_attribute[k].attr_color);
				trow.append(td4)

				td5 = document.createElement("td");
				td5.append("-");
				trow.append(td5)
				td6 = document.createElement("td");
				td6.append("-");
				trow.append(td6)
				td7 = document.createElement("td");
				td7.append("-");
				trow.append(td7)
				td8 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td8.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				trow.append(td8)
				td9 = document.createElement("td");
				td9.append("-");
				trow.append(td9)
				td10 = document.createElement("td");
				td10.append("-");
				trow.append(td10)
				td11 = document.createElement("td");
				td11.append("-");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("-");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append("-");
				trow.append(td13)

				td14 = document.createElement("td");
				td14.append("-");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("-");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("-");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append("-");
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("-");
				trow.append(td18)
				td19 = document.createElement("td");
				td19.append("-");
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append(resp[i].get_product_attribute[k].attr_size);
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append("-");
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("-");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("-");
				trow.append(td23)
				td24 = document.createElement("td");
				td24.append("-");
				trow.append(td24)
				td25 = document.createElement("td");
				td25.append("-");
				trow.append(td25)
				td26 = document.createElement("td");
				td26.append("-");
				trow.append(td26)
				td27 = document.createElement("td");
				td27.append("-");
				trow.append(td27)
				td28 = document.createElement("td");
				td28.append("-");
				trow.append(td28)
				td29 = document.createElement("td");
				td29.append("-");
				trow.append(td29)

				td30 = document.createElement("td");
				td30.append(resp[i].get_product_attribute[k].attr_mrp);
				trow.append(td30)
				td31 = document.createElement("td");
				td31.append(resp[i].get_product_attribute[k].attr_price);
				trow.append(td31)
				td32 = document.createElement("td");
				td32.append(resp[i].get_product_attribute[k].attr_qty);
				trow.append(td32)
				td33 = document.createElement("td");
				td33.append("--");
				trow.append(td33)
				td34 = document.createElement("td");
				td34.append("--");
				trow.append(td34);
				td35 = document.createElement("td");
				td35.append("--");
				trow.append(td35);
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function contact_lens_solution_export_excel(resp) {
	table = $('#excel_product_contact_solution_list_div').clone();
	thead = table.find('.excel_contact_solution_product_row');
	thead.find("th").each(function (ind, val) {
		$(val).css("width", "20px")
		$(val).css("font-weight", "bold")
		$(val).css("color", "red")
	})
	tbody = table.find('.excel_contact_solution_product_list').children('tbody')[0];
	for(let i=0; i<resp.length; i++){
		let attrcolorcode = [];
		
		let trow = document.createElement("tr");
		trow.setAttribute('class', 'row'+(i+1));
		td0 = document.createElement("td");
		td0.append(resp[i].productsku);
		trow.append(td0)
		td1 = document.createElement("td");
		td1.append(resp[i].title);
		trow.append(td1)
		td2 = document.createElement("td");
		td2.append(resp[i].category);
		trow.append(td2)
		td3 = document.createElement("td");
		td3.append(resp[i].brandname ? resp[i].brandname : "-");
		trow.append(td3)
		td4 = document.createElement("td");
		td4.append(resp[i].netquntity ? resp[i].netquntity : "-");
		trow.append(td4)
		td5 = document.createElement("td");
		td5.append(resp[i].shelflife ? resp[i].shelflife : "-");
		trow.append(td5)
		td6 = document.createElement("td");
		td6.append(resp[i].colorcode ? resp[i].colorcode : "-");
		trow.append(td6)
		td7 = document.createElement("td");
		td7.append(resp[i].productcolor ? resp[i].productcolor : "-");
		trow.append(td7)


		td8 = document.createElement("td");
		td8.append(resp[i].manufracturer ? resp[i].manufracturer : "-");
		trow.append(td8)
		td9 = document.createElement("td");
		td9.append(resp[i].warrentytype ? resp[i].warrentytype : "-");
		trow.append(td9)
		td10 = document.createElement("td");
		td10.append(resp[i].weight ? resp[i].weight : "-");
		trow.append(td10)
		td11 = document.createElement("td");
		td11.append(resp[i].height ? resp[i].height : "-");
		trow.append(td11)
		td12 = document.createElement("td");
		td12.append(resp[i].packweight ? resp[i].packweight : "-");
		trow.append(td12)
		td13 = document.createElement("td");
		td13.append(resp[i].packwidth ? resp[i].packwidth : "-");
		trow.append(td13)
		td14 = document.createElement("td");
		td14.append(resp[i].packlength ? resp[i].packlength : "-");
		trow.append(td14)
		td15 = document.createElement("td");
		td15.append(resp[i].countryoforigin);
		trow.append(td15)
		td16 = document.createElement("td");
		td16.append(resp[i].hsncode);
		trow.append(td16)
		td17 = document.createElement("td");
		td17.append(resp[i].description);
		trow.append(td17)
		td18 = document.createElement("td");
		td18.append(resp[i].price ? resp[i].price : "-");
		trow.append(td18)
		td19 = document.createElement("td");
		td19.append(resp[i].previous_price);
		trow.append(td19)
		td20 = document.createElement("td");
		td20.append(resp[i].costprice);
		trow.append(td20)
		td21 = document.createElement("td");
		td21.append(resp[i].stock);
		trow.append(td21)
		td22 = document.createElement("td");
		td22.append(resp[i].producttat);
		trow.append(td22)
		td23 = document.createElement("td");
		td23.append(resp[i].policy);
		trow.append(td23)

		tbody.append(trow);
		if(resp[i].get_product_attribute.length > 0){
			for(let k=0; k<resp[i].get_product_attribute.length; k++){
				let trow = document.createElement("tr");
				trow.setAttribute('class', 'row'+(i+k));
				td0 = document.createElement("td");
				td0.append(resp[i].get_product_attribute[k].attr_sku);
				trow.append(td0)
				td1 = document.createElement("td");
				td1.append("-");
				trow.append(td1)
				td2 = document.createElement("td");
				td2.append("-");
				trow.append(td2)
				td3 = document.createElement("td");
				td3.append("-");
				trow.append(td3)
				td4 = document.createElement("td");
				td4.append("-");
				trow.append(td4)
				td5 = document.createElement("td");
				td5.append("-");
				trow.append(td5)
				td6 = document.createElement("td");
				if(resp[i].get_product_attribute_color[k]){
					if(resp[i].get_product_attribute_color[k].attr_color_code){
						if(!attrcolorcode.includes(resp[i].get_product_attribute[k].attr_color_code)){
							attrcolorcode.push(resp[i].get_product_attribute_color[k].attr_color_code);
							td6.append(resp[i].get_product_attribute_color[k].attr_color_code);
						}
					}
				}
				td7 = document.createElement("td");
				td7.append("--");
				trow.append(td7)
				td8 = document.createElement("td");
				td8.append("--");
				trow.append(td8)
				td9 = document.createElement("td");
				td9.append("--");
				trow.append(td9)
				td10 = document.createElement("td");
				td10.append("--");
				trow.append(td10)


				td10 = document.createElement("td");
				td10.append("--");
				trow.append(td10)
				td11 = document.createElement("td");
				td11.append("--");
				trow.append(td11)
				td12 = document.createElement("td");
				td12.append("--");
				trow.append(td12)
				td13 = document.createElement("td");
				td13.append("--");
				trow.append(td13)
				td14 = document.createElement("td");
				td14.append("--");
				trow.append(td14)
				td15 = document.createElement("td");
				td15.append("--");
				trow.append(td15)
				td16 = document.createElement("td");
				td16.append("-");
				trow.append(td16)
				td17 = document.createElement("td");
				td17.append("--");
				trow.append(td17)
				td18 = document.createElement("td");
				td18.append("-");
				trow.append(td18)

				td19 = document.createElement("td");
				td19.append(resp[i].get_product_attribute[k].attr_mrp);
				trow.append(td19)
				td20 = document.createElement("td");
				td20.append(resp[i].get_product_attribute[k].attr_price);
				trow.append(td20)
				td21 = document.createElement("td");
				td21.append(resp[i].get_product_attribute[k].attr_qty);
				trow.append(td21)
				td22 = document.createElement("td");
				td22.append("--");
				trow.append(td22)
				td23 = document.createElement("td");
				td23.append("--");
				trow.append(td23);
				
				tbody.append(trow);
			}
		}
	}
	return print_report(table);
}

function print_report(table) {
	var fp = XLSX.utils.table_to_book(data, {sheet: 'products'});
	XLSX.write(fp, {
		bookType: 'xlsx',
		type: 'base64'
	});
	XLSX.writeFile(fp, 'products.xlsx');
}


function handleExportButtonVisibility(selectedCategoryId = null) {
	// If no category is selected or the selected category is empty, hide the button
	if (!selectedCategoryId || selectedCategoryId === '') {
		$('#exportButtonDiv').hide();
	} else {
		// Otherwise, show the button
		$('#exportButtonDiv').show();
	}
}

function vendorProduct()
{
	$("#vendor_export_ButtonDiv").hide();
	$("#vendor_searchButton").click(function (e) {
		datatable.ajax.reload();
		$("#vendor_export_ButtonDiv").show();
	});
    var datatable = $('#vendor_product_list_table').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": ` <div id='loader' style=''>
                    	        <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                        			<defs>
                        				<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                        					<stop offset="0%" stop-color="#5ebd3e" />
                        					<stop offset="33%" stop-color="#ffb900" />
                        					<stop offset="67%" stop-color="#f78200" />
                        					<stop offset="100%" stop-color="#e23838" />
                        				</linearGradient>
                        				<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                        					<stop offset="0%" stop-color="#e23838" />
                        					<stop offset="33%" stop-color="#973999" />
                        					<stop offset="67%" stop-color="#009cdf" />
                        					<stop offset="100%" stop-color="#5ebd3e" />
                        				</linearGradient>
                        			</defs>
                        			<g fill="none" stroke-linecap="round" stroke-width="16">
                        				<g class="ip__track" stroke="#ddd">
                        					<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        				<g stroke-dasharray="180 656">
                        					<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        			</g>
                        		</svg>
                        	</div>`
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl + "/admin/products/get_vendor_list_details",
            'type' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			'data': function(d) {
				d._token = $('meta[name="csrf-token"]').attr("content");
				d.vendor_category = $('#vendor_category').val();
				d.vendor_name = $('#vendor_name').val();
			}
        },
        "columnDefs": [
            { "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
        ],
        "aaSorting": []
    });

	// Exporting excel here
	$("#Vendor_export_Button").on("click", function () {
		$.ajax({
			url: baseUrl + "/admin/vendor/vendorExport-excel",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr("content"),
				vendor_category: $("#vendor_category").val(),
				vendor_name: $("#vendor_name").val(),
				draw: datatable.ajax.params().draw,
				start: 0,
				length: -1,
				search: {
					value: datatable.search(),
				},
			},
			success: function (response) {
				// Response contains the Excel file data, initiate the download
				var blob = new Blob([response]);
				var link = document.createElement("a");
				var fileName = "vendor" + ".xls";
				link.href = window.URL.createObjectURL(blob);
				link.download = fileName;
				link.click();
			},
			error: function (error) {
				console.error("Error fetching data for Excel export:", error);
			},
		});
	});
}


function getVendorPendingProduct()
{
    $('#vendor_pending_product_list_table').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": ` <div id='loader' style=''>
                    	        <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                        			<defs>
                        				<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                        					<stop offset="0%" stop-color="#5ebd3e" />
                        					<stop offset="33%" stop-color="#ffb900" />
                        					<stop offset="67%" stop-color="#f78200" />
                        					<stop offset="100%" stop-color="#e23838" />
                        				</linearGradient>
                        				<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                        					<stop offset="0%" stop-color="#e23838" />
                        					<stop offset="33%" stop-color="#973999" />
                        					<stop offset="67%" stop-color="#009cdf" />
                        					<stop offset="100%" stop-color="#5ebd3e" />
                        				</linearGradient>
                        			</defs>
                        			<g fill="none" stroke-linecap="round" stroke-width="16">
                        				<g class="ip__track" stroke="#ddd">
                        					<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        				<g stroke-dasharray="180 656">
                        					<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        			</g>
                        		</svg>
                        	</div>`
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl + "/admin/products/get_vendor_pending_list_details",
            'type' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        "columnDefs": [
            { "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6, 7] },
        ],
        "aaSorting": []
    });
}

function rejectNote(e, id)
{
    modal = $(e.target).attr('data');
    url = baseUrl + "/admin/products/rejectnote/" + id;
    $('#'+modal).find('form').attr('action');
    $('#'+modal).find('form').attr('action', url);
    $('#'+modal).modal();
}