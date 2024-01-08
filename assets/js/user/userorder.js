window.addEventListener('load', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function getPresData(id){
    $('.table-data').html("");
    $('.prescription-parameter').html("");
    const url = mainurl + "/user/get_prescription_details/"+id;
    $.ajax({
        type: "GET",
        url : url,
        dataType: 'JSON',
        success: function(response){
            $('.table-data').append(response.data)
            $('.prescription-parameter').append(response.data3)
            $('.table-data').append(response.data2)
            $('#viewmodal').show();
        },
        error : function(err){
            console.log(err.responseText);
        }
    });
}
    
function closeModal(e)
{
    $('#viewmodal').hide();
}


function call_cancel(id) {
    let data = $('#reason option:selected');
    let reason_val = data.val();
    let reason_txt = data.text();
    let cancelcomment = $('[name="cancelcomment"]').val();
    const url = mainurl + "/cancel_order/"+id;
    $.ajax({
        type: "post",
        url: url,
        data: {
            reason:reason_val,
            cancelcomment: cancelcomment,
        },
        success:function(data) {
            $('.alert').show();
            $('.alert').html(result.success);
        }
    });
}

function call_return(id) {
    let data = $('#returnreason option:selected');
    let reason_val = data.val();
    let reason_txt = data.text();
    let comment = $('[name="comment"]').val();
    const url = mainurl + "/returnorder/"+id;
    $.ajax({
        type: "post",
        url: url,
        data: {
            reason:reason_val,
            comment: comment,
        },
        success:function(data) {
            $('.alert').show();
            $('.alert').html(result.success);
        }
    });
}
    
