$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


function pickupModelShow(id) {
    $('#pickuporderId').val('');
    $('#courier_boy').val('');
    $('#pickuporderId').val(id);
    
    $('#pickupModelShow').modal('show');
}

function courierID() {
    let status = $('#status').val();
    let id = $('#pickuporderId').val();
    let formData = $("#CourierDetail").serializeArray();
    formData.push({'name':'status', 'value':status})
    formData.push({'name':'id', 'value':id})
    
    const url = baseUrl + "/admin/courierboy"+"/"+id;
    
    if(formData[1].value != ""){
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            success:function(resp){
                if(resp.status){
                    Swal.fire({
                        title: 'Message!',
                        text: resp.msg,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    })
                    $('#pickupModelShow').modal('toggle');
                    ready_for_pickup_datatable.ajax.reload(null, false);
                    let {picked_total, intransit_total} = resp.data;
                    $("#ready_for_pickup_count").text(picked_total);
                    $("#in_transit_count").text(intransit_total);
                }else{
                    Swal.fire({
                        title: 'Message!',
                        text: "error",
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    title: 'Message!',
                    text: err,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                })
            } 
        });
    }
    else
    {
        Swal.fire({
            title: 'Message!',
            text: `Courier Boy Name Not Defined...!`,
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