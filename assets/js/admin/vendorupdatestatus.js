// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
// });

function vendorDeactive(id)
{
    let url = baseUrl + "/admin/vendors/deactive/"+id;
    if(id){
        Swal.fire({
          title: 'Message!',
          text: "Are You Sure For Deactive Vendor..",
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                vendorDeactiveData(id, url);
            } else if (result.isDenied) {
                return false;
            }
        })
    }
    else
    {
        Swal.fire({
            title: 'Message!',
            text: "Vendor ID Not Found",
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            showCancelButton: true,
            confirmButtonText: 'OK',
        })
    }
}

function vendorDeactiveData(id, url)
{
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp)
        {
            if(resp.status == 'success')
            {
                location.reload(true)
            }
        }
    })
}

function vendorActive(id){
    var url = baseUrl + "/admin/vendors/active/"+id;
    if(id){
        Swal.fire({
          title: 'Message!',
          text: "Are You Sure For Activate Vendor..",
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                vendorActiveData(id, url);
            } else if (result.isDenied) {
                return false;
            }
        })
    }
    else
    {
        Swal.fire({
            title: 'Message!',
            text: "Vendor ID Not Found",
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            showCancelButton: true,
            confirmButtonText: 'OK',
        })
    }
}

function vendorActiveData(id, url)
{
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp)
        {
            if(resp.status == 'success')
            {
                location.reload(true)
            }
        }
    })
}

function vendorAccept(id) {
    let url = baseUrl + "/admin/vendors/accept/doc/"+id;
    
    if(id){
        Swal.fire({
          title: 'Message!',
          text: "Are You Sure For Accept Vendor..",
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                vendorAcceptData(id, url);
            } else if (result.isDenied) {
                return false;
            }
        })
    }
    else {
        Swal.fire({
            title: 'Message!',
            text: "Vendor ID Not Found",
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            showCancelButton: true,
            confirmButtonText: 'OK',
        })
    }
}

function vendorAcceptData(id, url) {
    const url2 = baseUrl + "/admin/vendors";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp)
        {
            if(resp.status == 'success')
            {
                console.log(resp.message);
                window.location.href = url2;
            }
        }
    })
}

function vendorReject(id) {
    let url = baseUrl + "/admin/vendors/reject/doc/"+id;
    if(id){
        Swal.fire({
          title: 'Message!',
          text: "Are You Sure For Reject Vendor..",
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                vendorRejectData(id, url);
            } else if (result.isDenied) {
                return false;
            }
        })
    }
    else
    {
        Swal.fire({
            title: 'Message!',
            text: "Vendor ID Not Found",
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            showCancelButton: true,
            confirmButtonText: 'OK',
        })
    }
}

function vendorRejectData(id, url)
{
    const url2 = baseUrl + "/admin/vendors";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp)
        {
            if(resp.status == 'success')
            {
                window.location.href = url2;
            }
        }
    })
}
