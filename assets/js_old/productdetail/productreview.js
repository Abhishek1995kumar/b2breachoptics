function loginFirst()
{
    alert('Login first');
    location.replace(baseUrl + "/user/login");
}

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

        let url = baseUrl + "/user/review";

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