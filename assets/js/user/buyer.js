function submitcostprice(id, e){
    let cost = $(e.target).val();
    let url = "/subuser/savecostprice";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id:id, costview: cost },
        success: function(resp) {
            if(resp.status == 'success'){
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
					    location.reload(true);
                    }
                });
            }
        }
    })
}

$('#country-dropdown').on('change', function () {
    const idCountry = this.value;
    const url = mainurl + "/states";
    $("#state-dropdown").html('');
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            country_id: idCountry,
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown').html('<option value="">-- Select State --</option>');
            $.each(result.states, function (key, value) {
                $("#state-dropdown").append('<option value="' + value
                    .id + '">' + value.Name + '</option>');
            });
            $('#city-dropdown').html('<option value="">-- Select City --</option>');
        }
    })
});
      

$('#state-dropdown').on('change', function () {
    const idState = this.value;
    const url = mainurl + "/city";
    $("#city-dropdown").html('');
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            state_id: idState,
        },
        dataType: 'json',
        success: function (res) {
            $('#city-dropdown').html('<option value="">-- Select City --</option>');
            $.each(res.cities, function (key, value) {
                $("#city-dropdown").append('<option value="' + value
                    .id + '">' + value.Name + '</option>');
            });
        }
    });
});