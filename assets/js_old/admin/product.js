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
		if(resp){
			let csv = ''
			for(let row = 0; row < resp.length; row++){
				let keysAmount = resp[row].length;
				let keysCounter = 0;
				if(row === 0){
					resp[row].forEach(function(ele){
						csv += ele + (keysCounter+1 < keysAmount ? ',' : '\r\n' );
						keysCounter++;
					});
					keysCounter = 0;
				}
				if(row > 0){
					resp[row].forEach(function(ele){
					  	csv += (ele ? ele : ele) + (keysCounter+1 < keysAmount ? ',' : '\r\n');
					  	keysCounter++
					});
					keysCounter = 0
				}
			}
			let link = document.createElement('a');
			link.id = 'download-csv';
			link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
			link.setAttribute('download', 'stock_report.csv');
			document.body.appendChild(link);
			document.querySelector('#download-csv').click();
			$("#download-csv").remove();
		}
	} catch (error) {
		console.log(error);
		Swal.fire({
			title: 'Message!',
			text: error.statusText,
			imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
			imageWidth: 400,
			imageHeight: 200,
			imageAlt: 'Custom image',
			confirmButtonText: 'OK',
		});
	}
};

function handleExportButtonVisibility(selectedCategoryId = null) {
	if (!selectedCategoryId || selectedCategoryId === '') {
		$('#exportButtonDiv').hide();
	} else {
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