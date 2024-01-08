$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


function updateProductTrade(id)
{
    const url = baseUrl + "/admin/products/vendor_product_update";
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id},
        success: function(response)
        {
            $('.vendorproductupdate').empty();
            let html = '';
            html +=  `<div class="modal fade" id="viewpupdatetrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Prescription Parameter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" id="updateTradeFeatures">
                                    <div class="modal-body" style="text-align:center;">
                                        <table class"table table-bordered" style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td  style="border: 1px solid lightgrey; padding: 5px 0 5px 0;">
                                                        <div class="col-md-12">
                                                            <label class="btn btn-default" style="width: 180px;">`;
                                                            if(response.featured == 1){
                                                                html +=  `<input type="checkbox" name="featured" value="1" autocomplete="off" checked>`;
                                                            }
                                                            else{
                                                                html +=  `<input type="checkbox" name="featured" value="1" autocomplete="off">`;
                                                            }
                                                    html +=  `&nbsp; Featured Product
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td  style="border: 1px solid lightgrey; padding: 5px 0 5px 0;">
                                                        <div class="col-md-12">
                                                            <label class="btn btn-default" style="width: 180px;">`;
                                                                if(response.tranding == 1){
                                                                    html +=  `<input type="checkbox" name="tranding" value="1" autocomplete="off" checked>`;
                                                                }
                                                                else{
                                                                    html +=  `<input type="checkbox" name="tranding" value="1" autocomplete="off">`;
                                                                }
                                                    html +=  `&nbsp; Tranding Product
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td  style="border: 1px solid lightgrey; padding: 5px 0 5px 0;">
                                                        <div class="col-md-12">
                                                            <label class="btn btn-default" style="width: 180px;">`;
                                                                if(response.latest == 1){
                                                                    html +=  `<input type="checkbox" name="latest" value="1" autocomplete="off" checked>`;
                                                                }
                                                                else{
                                                                    html +=  `<input type="checkbox" name="latest" value="1" autocomplete="off">`;
                                                                }
                                                    html +=  `&nbsp; Latest Product
                                                            </label> 
                                                        </div>
                                                    </td>
                                                    <td  style="border: 1px solid lightgrey; padding: 5px 0 5px 0;">
                                                        <div class="col-md-12">
                                                                <label class="btn btn-default" style="width: 180px;">`;
                                                                if(response.selected == 1){
                                                                    html +=  `<input type="checkbox" name="selected" value="1" autocomplete="off" checked>`;
                                                                }
                                                                else{
                                                                    html +=  `<input type="checkbox" name="selected" value="1" autocomplete="off">`;
                                                                }
                                                    html +=  `&nbsp; Selected Product
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" onclick="updateTradeFeatures(event, ${id})" class="btn btn-success">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>`;
                    
                $('.vendorproductupdate').append(html);
                $('#viewpupdatetrade').modal();
        }
    });
}

function updateTradeFeatures(e, id) {
    e.preventDefault();
    let form = $('#updateTradeFeatures').serializeArray();
    form.push({name: "id", value: id});
    const url = baseUrl + "/admin/products/vendor/productupdate";
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        data: form,
        success: function(resp)
        {
            if(resp.status == 'success'){
                Swal.fire({
                    title: 'Message!',
                    text: "Product Update Successfully..!!",
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#viewpupdatetrade").fadeOut();
					    location.reload(true);
                    }
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(xhr.status == 422)
            {
                let text = xhr.responseText
                const value = text.split('"');
                Swal.fire({
                    title: 'Message!',
                    text: value[3],
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        return false;
                    }
                });
            }
        }
        
    })
}

