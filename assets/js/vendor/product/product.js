
let loader = `<div id="preloader"> 
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
            
var vendor_product_details;
$(document).ready(function() {
    vendor_product_details = $('#vendor_product').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        'bDestroy': true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl + "/vendor/product/get_vendor_product_details",
            'method' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'data': function(d) {
                d.category_id = $('#categoryValue').val();
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
    });
})

function showExcelCategory(e){
    let category_id = $(e.target).val();
    vendor_product_details.ajax.reload();

    if(category_id){
        $("#export_value_show").show();
    }else{
        $("#export_value_show").hide();
    }
}

function vendorExcel(data) {
	return new Promise(function(vendorResolve, vendorReject) {
		$.ajax({
			url : baseUrl + "/vendor/getVendorExcelData",
			type : "POST",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: data,
			success: function(resp) {
				vendorResolve(resp)
			},
			error: function(err) {
				vendorReject(err);
			}
		});
	});
}

async function exportCategoryData() {
	let data = {
		category_id: $('#categoryValue').val(),
	};
	try {
		let resp = await vendorExcel(data);
		if(resp[1]){
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
			let name;
			if($('#categoryValue').val() == 53){
			    name = "Frames";
			}
			else if($('#categoryValue').val() == 58){
			    name = "Lenses";
			}
			else if($('#categoryValue').val() == 63){
			    name = "Sunglasses";
			}
			else if($('#categoryValue').val() == 72){
			    name = "Contact Lenses";
			}
			else if($('#categoryValue').val() == 82){
			    name = "Premium Brands";
			}
			else if($('#categoryValue').val() == 87){
			    name = "Contact Lens Solution";
			}
			else if($('#categoryValue').val() == 396){
			    name = "Accessories";
			}
			let link = document.createElement('a');
			link.id = 'download-csv';
			link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
			link.setAttribute('download', name+'.csv');
			document.body.appendChild(link);
			document.querySelector('#download-csv').click();
			$("#download-csv").remove();
		}
		else{
    		Swal.fire({
    			title: 'Message!',
    			text: 'Product Not Found',
    			imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
    			imageWidth: 400,
    			imageHeight: 200,
    			imageAlt: 'Custom image',
    			confirmButtonText: 'OK',
    		});
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
}

function vendorProductChanges()
{
    $('#vendor_product_change_list_table').DataTable({
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
            'url': baseUrl + "/vendor/product/get_vendor_change_list_details",
            'type' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        "columnDefs": [
            { "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6] },
        ],
        "aaSorting": []
    });
}

function deleteProduct(e){
    var id = $(e.target).attr('data');
    
    var url = baseUrl + "/vendor/deleteproduct"+'/'+id;
    var url2 = baseUrl + "/vendor/products";
    if(url){
        Swal.fire({
            title: 'Message!',
            text: 'Are You sure for delete?',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            confirmButtonText: 'OK',
            showCancelButton: true,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                deleteProductAjax(id, url);
            } else if (result.isDenied) {
                window.location = url2;
            }
        })
    }
}

function deleteProductAjax(id, url){
    $.ajax({
        method: 'POST',
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
		dataType: 'JSON',
		success:function(resp) {
            if(resp.status === 'success'){
                Swal.fire({
                    title: 'Message!',
                    text: resp.msg,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
					    $('#vendor_product').DataTable().ajax.reload();
                    }
                });
            }
		}
    });
}

function checkProductChanges(id)
{
    let url = baseUrl + "/vendor/product/chek_changes_product";
    
    $.ajax({
        type: "POST",
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': id
        },
        success: function(response)
        {
            productChangesMessage(response);
        }
    })
}

function productChangesMessage(data)
{
    var text = '';
    $('#exampleModal').find('.modal-body').html('')
    if(data)
    {
        if(data.note == null)
        {
            Swal.fire({
                title: 'Message!',
                text: `Still Not Update Rejected Reason..?`,
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    return;
                }
            });
        }
        else{
            text = `<p>${data.note}</p>`;
            $('#exampleModal').find('.modal-body').append(text);
            $('#exampleModal').modal();
        }
    }
}

function activeProduct(id){
    var val = 0;
    var url = baseUrl + "/vendor/products/status"+'/'+id+'/'+val;
    $.ajax({
        method: 'POST',
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{},
        dataType: 'json',
        success: function(data){
            if(data.status == 'success'){
                Swal.fire({
                    title: 'Message!',
                    text: data.message,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
					    vendor_product_details.ajax.reload();
                    }
                });
            }
        }
    })
}

function deactiveProduct(id){
    var val = 1;
    var url = baseUrl + "/vendor/products/status"+'/'+id+'/'+val;
    $.ajax({
        method: 'POST',
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{},
        dataType: 'json',
        success: function(data){
            if(data.status === 'success'){
                Swal.fire({
                    title: 'Message!',
                    text: data.message,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
					    vendor_product_details.ajax.reload();
                    }
                });
            }
        }
    })
}




