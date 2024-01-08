
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
function Hide_form() {
    let emailFormat = document.getElementById("reg_email");
    let emailValue = emailFormat.value.match(/^\S+@\S+\.\S+$/)
    console.log(emailValue)
    if(!emailValue){
        Swal.fire({
            title: 'Message!',
            text: 'Please Enter Valid Email -- joshua12@hotmail.com !!',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        }) 
    }
    
    if($('#first_name').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill First Name',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#first_name').focus();
        return false
    }
    if($('#middle_name').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Middle Name',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#middle_name').focus();
        return false
    }
    if($('#last_name').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Last Name',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#last_name').focus();
        return false
    }
    if($('#reg_Pnumber').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Phone Number',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#reg_Pnumber').focus();
        return false
    }
    if($('#reg_email').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Valid Email Id',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }
        $('#reg_email').focus();
        return false
    }
    if($('#address1').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Address',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#address1').focus();
        return false
    }
    if($('#address2').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Address1',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $('#address2').focus();
        return false
    }
      

    // var err = false;
    // var data = [];
    // data[0] = form.name;
    // data[1] = form.mname;
    // data[2] = form.lname;
    // data[3] = form.phone;
    // data[4] = form.email;
    // data[5] = form.address;
    // data[6] = form.areaandstreet;

    // for(x=0; x<data.length; x++){
    //     if(data[x].value == ""){
    //         Swal.fire({
    //             title: 'Message!',
    //             text: data[x].placeholder,
    //             imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
    //             imageWidth: 400,
    //             imageHeight: 200,
    //             imageAlt: 'Custom image',
    //         })
    //         data[x].style.backgroundColor  = "rgba(0, 0, 255, 0.1)";
    //         data[x].classList.add('redPlaceholder');
    //         err = true;
    //     }
    //     else{
    //         data[x].style.backgroundColor =  "transparent";
    //     }
    //     if (err){
    //         return false;
    //     }
    // }
    
    $('#main').css("display","none");
    $('#next_div').css("display","block");
    $('#next_div').css("display","");
}


function back_btn() {
    $('#main').css("display","block");
    $('#main').css("display","");
    $('#next_div').css("display","none");
}




window.onload = function () {
    const elements = document.querySelectorAll('[type="password"]');
    elements.forEach(function(elem) {
        elem.parentNode.querySelector('i').addEventListener('click', function(){
            if (elem.type === "password") {
                elem.type = "text";
                this.className = 'fa fa-eye showpwd';
            }
            else {
                elem.type = "password";
                this.className = 'fa fa-eye-slash showpwd';
            }
        });
    });
}



var validImgExtensions = ['jpg','jpeg', 'png'];
var validPDFExtensions = ['pdf'];
function readURL(input, event)
{
    let file_name = event.target.files[0].name;
    let file_name_array = file_name.split(".")
    let current_file_extension = file_name_array[file_name_array.length-1];
    if(validImgExtensions.includes(current_file_extension))
    {
        Imgvalidation(input, event);
    }else if(validPDFExtensions.includes(current_file_extension)){
        pdfvalidation(input, event);
    }else{
        alert('Please select valid file');
        $(`#${event.target.getAttribute('id')}`).val('');
    }
}

function Imgvalidation(input, event)
{
    let numb = event.target.files[0].size/1000;
    numb = numb.toFixed(2);
    if (numb > 400) 
    {
        Swal.fire({
            title: 'Message!',
            text: 'To Big Image,Maximum Size Is 400KB. Your File Size Is: ' + numb + ' KB',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $(`#${event.target.getAttribute('id')}`).val('');
        return false;
    }else{
        $(`#${$(event.target).next().attr('id')}`).on("click", function()
        {
            var reader = new FileReader();
            reader.readAsDataURL(event.target.files[0]);
            reader.onload = function () 
            {
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='" + reader.result +"'></iframe>");
            };
        })
    }
}

function pdfvalidation(input, event)
{
    let numb = event.target.files[0].size/1000;
    numb = numb.toFixed(2);
    if (numb > 1000) 
    {
        Swal.fire({
            title: 'Message!',
            text: 'To Big PDF,Maximum Size Is 1MB. Your File Size Is: ' + Math.floor(numb/1024) + ' MB',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $(`#${event.target.getAttribute('id')}`).val('');
    }else{
        $(`#${$(event.target).next().attr('id')}`).on("click", function()
        {
            var reader = new FileReader();
            reader.readAsDataURL(event.target.files[0]);
            reader.onload = function () 
            {
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='" + reader.result +"'></iframe>");
            };
        })
    }
}

$(document).ready(function() {
    $('#sign_up').show();
    $('#country-dropdown').on('change', function () {
        var url = mainurl + "/states";
        var idCountry = this.value;
        $("#state-dropdown").html('');
        $.ajax({
            url: url,
            type: "POST",
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
        });
    });

    $('#state-dropdown').on('change', function () {
        var url = mainurl + "/city";
        var idState = this.value;
        $("#city-dropdown").html('');
        $.ajax({
            url: url,
            type: "POST",
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
});

const validate = ()=>{
    if($('#country-dropdown').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Select Country !!',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#country-dropdown').focus();
	    return false
	}

    if($('#state-dropdown').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Select State !!',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#state-dropdown').focus();
	    return false
	}
    if($('#city-dropdown').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Select City !! ',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#city-dropdown').focus();
	    return false
	}
    if($('#zip').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Pin Number',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#zip').focus();
	    return false
	}
  
	if($('#reg_password').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Enter Your Password !!',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#reg_password').focus();
	    return false
	}
    if($('#confirm_password').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Enter Your Confirm Password ',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
	    $('#confirm_password').focus();
	    return false
	}
   
    else{
        return true
    }
}

$('#registrationForm').submit(function(e){
    var url = mainurl + "/vendor/registration";
    var url2 = mainurl + "/vendor";
    var formData = new FormData(this);
    e.preventDefault();
    if(validate()) {
        $.ajax({
            url: url,
            method:'POST',
            data : formData,
            processData: false,
            contentType: false,
            cache : false,
            dataType: 'JSON',
            success:function(resp){
                if(resp.status == "success"){
                    Swal.fire({
                        title: 'success',
                        text: resp.msg,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    }).then((result) => {
                         window.location = url2;
                    });
                }
            },
        });
    }
});

