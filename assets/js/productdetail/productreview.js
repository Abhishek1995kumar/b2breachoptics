function loginFirst()
{
    Swal.fire({
        title: 'Message!',
        text: 'Login First ..!!',
        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            location.replace(baseUrl + "/user/login");
        }
    });
}


function showAlert() {
    Swal.fire({
        title: 'Message!',
        text: 'Dear Customer, First Purchase this Product and recieved It then submit your review ..!!',
        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        confirmButtonText: 'OK',
    })
}

// function showOrder() {
//     Swal.fire({
//         title: 'Message!',
//         text: 'Dear Customer, when you have received your purchased product,after you submit your review ..!!',
//         imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//         imageWidth: 400,
//         imageHeight: 200,
//         imageAlt: 'Custom image',
//         confirmButtonText: 'OK',
//     })
// }

function reviewSubmit()
{
    $('#reviewmodal').modal('show');
}

function selectBackground(e)
{
    if(e.target.classList.contains("btn-grey-input")){
        let currentHoverValue = $(e.target).children()[0].value;
        let buttons = $(e.target).parent().children();

        for(let i=0; i< buttons.length; i++){
            $(buttons[i]).css("background", "#D8D8D8")
            $(buttons[i]).children()[1].style.color='black';
        }

        for(let i=0; i< buttons.length; i++){
            $(buttons[i]).css("background", "green")
            $(buttons[i]).children()[1].style.color='white';
            if(currentHoverValue == $(buttons[i]).children()[0].value) break;
        }
    }
}

function storeReview(e, id)
{
    let comment = $('#review_comment').val();
    if(e.target.classList.contains("review"))
    {
        let rating = $(e.target)[0]['nodeName'] == 'SPAN' ? $(e.target).prev().val()  : $(e.target).children()[0].value;

        let url = mainurl + "/user/review";

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                rating: rating,
                id: id,
                review: comment
            },
            success: function (response)
            {
                location.reload(true);
            }
        })
    }
}
