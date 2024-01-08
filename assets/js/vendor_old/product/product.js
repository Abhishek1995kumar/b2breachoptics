
$(document).ready(function() {
    $('#vendor_product').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        'bDestroy': true,
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
            'url': baseUrl + "/vendor/product/get_vendor_product_details",
            'method' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
    });
})


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
            'url': baseUrl + "/vendor/product/get_vendor_change_list_details",
            'type' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
          title: 'Are You sure for delete?',
          showCancelButton: true,
          confirmButtonText: 'OK',
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
                title: `Still Not Update Rejected Reason..?`,
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
    // console.log(url);
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
				$('#vendor_product').DataTable().ajax.reload();
            }
        }
    })
}

function deactiveProduct(id){
    var val = 1;
    var url = baseUrl + "/vendor/products/status"+'/'+id+'/'+val;
    // console.log(url);
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
                    text: data.msg,
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
    })
}




