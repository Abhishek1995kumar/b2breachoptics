function selectCountry() {
    $('#allstates').html("");
    var country = document.getElementById("countries");
    var countryId = country.options[country.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: mainurl + "/get_country_state",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: countryId,
        },
        success: function(resp)
        {
            let data = '';
            if(resp)
            {
                for(let i=0; i<resp.length; i++)
                {
                    data += `<option value="${resp[i].id}" '"state" == "${resp[i].Name}" ? "selected" : ""' ><b>${resp[i].Name}</b></option>`;
                }
                $('#allstates').append(data);
            }
        }
    });
}


function selectState()
{
    $('#allcities').html("");
    var state = document.getElementById("allstates");
    var stateId = state.options[state.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: mainurl + "/get_state_city",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: stateId,
        },
        success: function(resp)
        {
            let data = '';
            if(resp)
            {
                for(let i=0; i<resp.length; i++)
                {
                    data += `<option value="${resp[i].Id}" '"city" == "${resp[i].Name}" ? "selected" : ""' ><b>${resp[i].Name}</b></option>`;
                }
                $('#allcities').append(data);
            }
        }
    });
}

        
function selectCountryAlter()
{
    $('#shipping_state').html("");
    var country = document.getElementById("shipping_country");
    var countryId = country.options[country.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: mainurl + "/get_country_state",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: countryId,
        },
        success: function(resp)
        {
            let data = '';
            if(resp)
            {
                for(let i=0; i<resp.length; i++)
                {
                    data += `<option value="${resp[i].id}" '"state" == "${resp[i].Name}" ? "selected" : ""' ><b>${resp[i].Name}</b></option>`;
                }
                $('#shipping_state').append(data);
            }
        }
    });
}

function selectStateAlter()
{
    $('#shipping_city').html("");
    var state = document.getElementById("shipping_state");
    var stateId = state.options[state.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: mainurl + "/get_state_city",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: stateId,
        },
        success: function(resp)
        {
            let data = '';
            if(resp)
            {
                for(let i=0; i<resp.length; i++)
                {
                    data += `<option value="${resp[i].Id}" '"city" == "${resp[i].Name}" ? "selected" : ""' ><b>${resp[i].Name}</b></option>`;
                }
                $('#shipping_city').append(data);
            }
        }
    });
}


// Coupon related
function openCouponInput()
{
    // document.getElementById("coupon_fields").style.display = "block";
    $('#get_coupon_link').hide();
}


let coupons = localStorage.getItem('coupons') ? JSON.parse(localStorage.getItem('coupons')) : [];
let coupon_details = localStorage.getItem('coupon_details') ? JSON.parse(localStorage.getItem('coupon_details')) : [];
window.addEventListener('load', function() {
    $('[name="total"]').val('');
    let total = parseFloat($('#total-cost').text());
    $('#total-cost').text("");
    $('#coupon_discount').html('');
    let totalcoupon=[];
    let totalcoupon_code = [];
    for(let i = 0; i < coupon_details.length; i++){
        let amount = coupon_details[i].coupan_amount;
        total = total - amount;
        let row = '';
        row = `<tr>
                <td width="22%"><b>Discount</b></td>
                <td width="20%">${coupon_details[i].coupan_code} &nbsp; <a href="javascript:void(0)" onclick="deleteCoupon('${coupon_details[i].coupan_code}',${coupon_details[i].coupan_amount}, event)"><i class="fa fa-times-circle"></i></a></td>
                <td width="20%"></td>
                <td width="28%"></td>
                <td width="20%">${coupon_details[i].coupan_amount}<input type="hidden" name="coupon_amount" value="${coupon_details[i].coupan_amount}"></td>
            </tr>
            `;
            totalcoupon.push(coupon_details[i].coupan_amount);
            totalcoupon_code.push(coupon_details[i].coupan_code);
        $('#coupon_discount').append(row);
    }
    let sumCoupon = totalcoupon.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
    $('#total-cost').append(total.toFixed(2));
    $('[name="total"]').val(total.toFixed(2));
    $('[name="couponAmount"]').val(sumCoupon);
    $('[name="coupons"]').val(totalcoupon_code);
}, false);


function couponSubmit()
{
    coupons = localStorage.getItem('coupons') ? JSON.parse(localStorage.getItem('coupons')) : [];
    coupon_details = localStorage.getItem('coupon_details') ? JSON.parse(localStorage.getItem('coupon_details')) : [];
    let coupon = $('[name=coupon]').val();
    $('[name="total"]').val('');
    if(coupons.includes(coupon)){
        Swal.fire({
            title: 'Message!',
            text: 'Already uses coupon code..',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed)
            {
                $('#couponModel').modal().fadeOut();
                $('.modal-backdrop').fadeOut();
            }
        });
        return
    };
    let total = parseFloat($('#clone-total-cost').text());
    $('#total-cost').text("");
    
    coupons.push(coupon);
    let coupons_unique = [...new Set(coupons)];  //array unique
    window.localStorage.setItem("coupons", JSON.stringify(coupons_unique));
    let url = mainurl + "/get_coupon";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {items: coupons},
        success: function(response)
        {
            $('[name="coupons"]').val('');
            $('[name="couponAmount"]').val('');
            window.localStorage.setItem("coupon_details", JSON.stringify(response));
            let coupon_code_get = localStorage.getItem('coupons')
            let totalcoupon=[];
            let totalcoupon_code = [];
            $('#coupon_discount').html('');
            let row = '';
            if(response.length > 0)
            {
                for(let i = 0; i < response.length; i++)
                {
                    row = `<tr>
                            <td width="22%"><b>Discount</b></td>
                            <td width="20%">${response[i].coupan_code} &nbsp; <a href="javascript:void(0)" onclick="deleteCoupon('${response[i].coupan_code}',${response[i].coupan_amount}, event)"><i class="fa fa-times-circle"></i></a></td>
                            <td width="20%"></td>
                            <td width="28%"></td>
                            <td width="20%">${response[i].coupan_amount}<input type="hidden" name="coupon_amount" value="${response[i].coupan_amount}"></td>
                        </tr>
                        `;
                    $('#coupon_discount').append(row);
                    totalcoupon.push(response[i].coupan_amount);
                    totalcoupon_code.push(response[i].coupan_code);
                }
                let sumCoupon = totalcoupon.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                
                if(!totalcoupon_code.includes(coupon))
                {
                    Swal.fire({
                        title: 'Message!',
                        text: 'Invalid Coupon Code..?',
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed)
                        {
                            localStorage.setItem('coupons', JSON.stringify(totalcoupon_code));
                        }
                    });
                }
                
                if(parseFloat(sumCoupon) > total)
                {
                    Swal.fire({
                        title: 'Message!',
                        text: 'Coupon Amount Excced From Pay Amount..?',
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed)
                        {
                            deleteCoupon(coupon, amount=null, event=null);
                            location.reload(true);
                        }
                    });
                }
                else
                {
                    let total_cost = total - parseFloat(sumCoupon);
                    $('[name="couponAmount"]').val(sumCoupon);
                    $('[name="coupons"]').val(totalcoupon_code);
                    $('#total-cost').text(total_cost.toFixed(2));
                    $('[name="total"]').val(total_cost.toFixed(2));
                }
            }
        }
    });
    $('#coupon_code_input').val('');
    $('#coupon_code_input').text('');
    $('#couponModel').modal('hide');
}

function deleteCoupon(coupon, amount, e) {
    let total = parseFloat($('#total-cost').text());
    $('#total-cost').text("");
    if(e != null){
        e.target.parentElement.parentElement.parentElement.remove();
    }
    let coupons = JSON.parse(localStorage.getItem('coupons'));
    let filterCoupons = coupons.filter(e => e !== coupon);
    localStorage.setItem('coupons', JSON.stringify(filterCoupons));

    let coupon_details = JSON.parse(localStorage.getItem('coupon_details'));
    let filterCouponDetails = coupon_details.filter(e => e.coupan_code !== coupon);
    localStorage.setItem('coupon_details', JSON.stringify(filterCouponDetails));
    let coupon_details_count = JSON.parse(localStorage.getItem('coupon_details'));
    let totalcoupon=[];
    let totalcoupon_code = [];
    for(let i = 0; i < coupon_details_count.length; i++){
        totalcoupon.push(coupon_details_count[i].coupan_amount);
        totalcoupon_code.push(coupon_details_count[i].coupan_code);
    }
    let sumCoupon = totalcoupon.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
    let total_cost;
    if(amount == null) {
        total_cost = total;
    }
    else
    {
        total_cost = total + amount;
    }
    $('#total-cost').text(total_cost.toFixed(2));
    $('[name="total"]').val(total_cost.toFixed(2));
    $('[name="couponAmount"]').val(sumCoupon);
    $('[name="coupons"]').val(totalcoupon_code);
}



function paytmLink() {
    // url = 'https://paytm.com/shop/h/elrica-gift-card';
    url = 'paytmmp://mini-app?aId=358b2bd4936a4f34918c620a3c7ac4f9&data=eyJzcGFyYW1zIjp7InNob3dUaXRsZUJhciI6ZmFsc2V9LCJwYXJhbXMiOiI/dXRtX3NvdXJjZT1CcmFuZF9QYWdlIiwicGF0aCI6Ii9zZi92Mi9oL2VscmljYS1naWZ0LWNhcmQifQ==';
    if(url != "")
    {
        window.open(url, "_blank");
    }
    else
    {
        Swal.fire({
            title: 'Message!',
            text: 'Sorry For Proceed Now..?',
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
}

window.onload = () => {
    $("#get_coupon_link").hide();
}
        
// function payemntMethod(val){
//     let payment1 = mainurl + "/payment",
//     let payment2 = mainurl + "/cashondelivery",
//     let payment3 = mainurl + "/mobile_money",
//     let payment4 = mainurl + "/bank_wire",
//     // let payment5 = "{{route('stripe.submit')}}";

//     if (val.value == "Mobile") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment3);
//         $("#stripes").hide();
//         $("#mobile").show();
//         $("#bank").hide();
//     }
    
//     if (val.value == "Bank") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment4);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").show();
//     }
    
//     if (val.value == "Paypal") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment1);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").hide();
//     }
            
//     if (val.value == "Razorpay") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment1);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").hide();
//     }
    
//     // if (val.value == "Stripe") {
//     //     $("#get_coupon_link").hide();
//     //     $("#payment_form").attr("action", action2);
//     //     $("#stripes").show();
//     //     $("#mobile").hide();
//     //     $("#bank").hide();
//     // }
            
//     if (val.value == "Cash") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment2);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").hide();
//     }
    
//     if (val.value == "Payment") {
//         $("#get_coupon_link").hide();
//         $("#payment_form").attr("action", payment2);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").hide();
//     }
    
//     if (val.value == "Paytm") {
//         $("#get_coupon_link").show();
//         $("#payment_form").attr("action", payment2);
//         $("#stripes").hide();
//         $("#mobile").hide();
//         $("#bank").hide();
//     }
// }


// function sHipping(val) {
//     var shipcost = parseFloat($("#ship-cost").html());
//     var totalcost = parseFloat($("#total-cost").html());
//     var total = 0;

//     if (val.value == "shipto") {
//         total = shipcost + totalcost;
//         $("#pick").hide();
//         $("#ship-diff").show();
//         $("#pick-info").hide();
//         $("#shipshow").show();
//         $("#total-cost").html(total);
//         $("#grandtotal").val(total);
//         $("#shipto").find("input").prop('required',true);
//         $("#pick").find("select").prop('required',false);
//     }

//     if (val.value == "pickup") {
//         total = totalcost - shipcost;
//         $("#pick").show();
//         $("#pick-info").show();
//         $("#ship-diff").hide();
//         $("#shipshow").hide();
//         $("#total-cost").html(total);
//         $("#grandtotal").val(total);
//         $("#shipto").find("input").prop('required',false);
//         $("#pick").find("select").prop('required',true);
//     }
// }

function paymentMode(val) {
    let action1 = mainurl + "/payment";
    let action2 = mainurl + "/cashondelivery";
    let action3 = mainurl + "/cashondelivery";
    let action4 = mainurl + "/mobile_money";
    let action5 = mainurl + "/bank_wire";
    
    if (val.value == "Mobile") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action4);
        $("#stripes").hide();
        $("#mobile").show();
        $("#bank").hide();
    }
    if (val.value == "Bank") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action5);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").show();
    }
    if (val.value == "Paypal") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action1);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").hide();
    }
    
    if (val.value == "Razorpay") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action1);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").hide();
    }
    
    
    if (val.value == "Stripe") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action2);
        $("#stripes").show();
        $("#mobile").hide();
        $("#bank").hide();
    }
    if (val.value == "Cash") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action3);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").hide();
    }
    if (val.value == "Payment") {
        $("#get_coupon_link").hide();
        $("#payment_form").attr("action", action3);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").hide();
    }
    if (val.value == "Paytm") {
        $("#get_coupon_link").show();
        $("#payment_form").attr("action", action3);
        $("#stripes").hide();
        $("#mobile").hide();
        $("#bank").hide();
    }
}

$("#paymentType").on("change", function(e){
    console.log(e.target.value);
})

function sHipping(val) {
    var shipcost = parseFloat($("#ship-cost").html());
    var totalcost = parseFloat($("#total-cost").html());
    var total = 0;

    if (val.value == "shipto") {
        total = shipcost + totalcost;
        $("#pick").hide();
        $("#ship-diff").show();
        $("#pick-info").hide();
        $("#shipshow").show();
        $("#total-cost").html(total);
        $("#grandtotal").val(total);
        $("#shipto").find("input").prop('required',true);
        $("#pick").find("select").prop('required',false);
    }

    if (val.value == "pickup") {
        total = totalcost - shipcost;
        $("#pick").show();
        $("#pick-info").show();
        $("#ship-diff").hide();
        $("#shipshow").hide();
        $("#total-cost").html(total);
        $("#grandtotal").val(total);
        $("#shipto").find("input").prop('required',false);
        $("#pick").find("select").prop('required',true);
    }
}



















