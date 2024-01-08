const loader = `<div id="preloader"> 
                <div id="loader-img">
                    <div class="loading">
                        <div class="loading__letter">R</div>
                        <div class="loading__letter">E</div>
                        <div class="loading__letter">A</div>
                        <div class="loading__letter">C</div>
                        <div class="loading__letter">H</div>
                    </div>
                </div>
            </div>`;
            
let dataTable;
$(document).ready(function() {
    dataTable = $('#product_list_table').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "language": {
            "processing": loader
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
                d.category_id = $('#category').val();
            },
            beforeSend: function() 
            {
                $('#preloader').css("display", "block");
            },
            complete: function() 
            {
                $('#preloader').css("display", "none");
            },
        },
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }, ],
        "aaSorting": []
    });
    
    // Button visibility on category change
    $('#category').on('change', function() {
        // Get the selected category_id
        var category_id = $(this).val();
    
        // Reload the DataTable with new data based on the selected category
        $('#product_list_table').DataTable().ajax.reload();
    
        // Handle button visibility on category change
        handleExportButtonVisibility(category_id);
    });
});

function getExcelExportDate(data) {
	return new Promise(function(myResolve, myReject) {
		$.ajax({
			url: baseUrl + "/admin/export_excel",
			type: "POST",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: data,
            beforeSend: function() 
            {
                $('#preloader').parent().css("display", "block");
                $('#preloader').css("display", "block");
                $('#exportButton').attr('disabled', 'disabled');
            },
            complete: function() 
            {
                $('#preloader').parent().css("display", "none");
                $('#preloader').css("display", "none");
                $('#exportButton').attr('disabled', '');
            },
			success: function(resp) {
				myResolve(resp);
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
					  	keysCounter++;
					});
					keysCounter = 0;
				}
			}
			var name;
			if($('#category').val() == 53){
			    name = "Frames";
			}
			else if($('#category').val() == 58){
			    name = "Lenses";
			}
			else if($('#category').val() == 63){
			    name = "Sunglasses";
			}
			else if($('#category').val() == 72){
			    name = "Contact Lenses";
			}
			else if($('#category').val() == 82){
			    name = "Premium Brands";
			}
			else if($('#category').val() == 87){
			    name = "Contact Lens Solution";
			}
			let link = document.createElement('a');
			link.id = 'download-csv';
			link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
			link.setAttribute('download', name+'.csv');
			document.body.appendChild(link);
			document.querySelector('#download-csv').click();
			$("#download-csv").remove();
		}
	} catch (error) {
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
    // If no category is selected or the selected category is empty, hide the button
    if (!selectedCategoryId || selectedCategoryId === '') {
        $('#exportButtonDiv').hide();
    } else {
        // Otherwise, show the button
        $('#exportButtonDiv').show();
    }
}

let datatable;
function vendorProduct()
{
    $('#vendorproductexport-button').hide();
	$("#vendor_searchButton").click(function (e) {
		datatable.ajax.reload();
        if($('#vendor_category').val() || $('#vendor_name').val()){
            $('#vendorproductexport-button').show();
        }
        else{
            $('#vendorproductexport-button').hide();
        }
	});
    datatable = $('#vendor_product_list_table').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
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
}

function vendorproductAllExcel(e) {
    e.preventDefault();
    let vendor = $("#vendor_name").val();
    let category = $("#vendor_category").val();
    let search = $(".input-sm").val();

    const url = baseUrl + "/admin/vendorproductexcel";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
          category: category,
          vendor: vendor,
          search: search,
        },
        success: function (resp) {
            let table = document.createElement("table");
            let thead = document.createElement("thead");
            let tbody = document.createElement("tbody");
            if (resp) {
                table.setAttribute("id", "export_table");
                let tbl_thead_clone = $("#vendor-product-header").clone();
                tbl_thead_clone.find("th:eq(9)").remove();
                tbl_thead_clone.find("th:eq(10)").remove();
                tbl_thead_clone.find("th:eq(11)").remove();
                thead.append(tbl_thead_clone[0]);
                table.append(thead);
        
                for (let i = 0; i < resp.length; i++) {
                    let trow = document.createElement("tr");
                    trow.setAttribute("class", "row" + (i + 1));
                    td0 = document.createElement("td");
                    td0.append(i + 1);
                    trow.append(td0);
                    td1 = document.createElement("td");
                    td1.append(resp[i].vendor_name);
                    trow.append(td1);
                    td2 = document.createElement("td");
                    td2.append(resp[i].entry_by);
                    trow.append(td2);
                    td3 = document.createElement("td");
                    td3.append(resp[i].title);
                    trow.append(td3);
                    td4 = document.createElement("td");
                    td4.append(resp[i].productsku);
                    trow.append(td4);
                    td5 = document.createElement("td");
                    td5.append(resp[i].modelno);
                    trow.append(td5);
                    td6 = document.createElement("td");
                    td6.append(resp[i].costprice);
                    trow.append(td6);
                    td7 = document.createElement("td");
                    td7.append(resp[i].category);
                    trow.append(td7);
                    td8 = document.createElement("td");
                    td8.append(resp[i].stock);
                    trow.append(td8);
                    td9 = document.createElement("td");
                    td9.append(resp[i].status);
                    trow.append(td9);
            
                    tbody.append(trow);
                }
                if (resp.length > 0) {
                    table.append(tbody);
                    var data = table;
                    var fp = XLSX.utils.table_to_book(data, { sheet: "vendorproduct" });
                    XLSX.write(fp, {
                        bookType: "xlsx",
                        type: "base64",
                    });
                  XLSX.writeFile(fp, "vendorproduct.xlsx");
                } else {
                    Swal.fire({
                        title: 'Message!',
                        text: `No Product Found In Records`,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //location.reload(true);
                        }
                    });
                }
            }
        },
        error: function(error)
        {
            Swal.fire({
              title: 'Message!',
              text: error,
              imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
              imageWidth: 400,
              imageHeight: 200,
              confirmButtonText: 'OK',
            });
        }
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
            "processing": loader
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
    const url = baseUrl + "/admin/products/rejectnote/" + id;
    $('#'+modal).find('form').attr('action');
    $('#'+modal).find('form').attr('action', url);
    $('#'+modal).modal();
}