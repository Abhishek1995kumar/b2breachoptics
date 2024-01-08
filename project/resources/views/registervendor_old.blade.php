@extends('includes.newmaster')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    *{
        padding:0;
        margin:0;
        box-sizing:border-box;
        font-family:sans-serif;
    }
    .container1{
        max-width:700px;
        background: rgba(0,0,0,0.5);
        padding:28px;
        margin: 0 28px;
        border-radius: 10px;
        box-shadow:inset -2px 2px 2px white;
    }

    .form-title{
        font-size:26px;
        font-weight:600;
        text-align:center;
        padding-bottom:6px;
        color:white;
        text-shadow:2px 2px 2px black;
        border-bottom:solid 1px white;
    }
    .main-user-info{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        padding: 20px 0;
    }

    .user-input-box:nth-child(2n){
        justify-content:end;
    }
    .user-input-box{
        display:flex;
        flex-wrap:wrap;
        width:50%;
        padding-bottom:15px;
    }
    .user-input-box label{
        width:95%;
        color:white;
        font-size:15px;
        font-weight:400;
        margin: 5px 0;
    }
    .user-input-box input{
        height:40px;
        width:95%;
        border-radius: 7px;
        outline: none;
        border: 1px solid grey;
        padding: 0 10px;
        color:white;
    }

    .wrapper{
        display: flex;
        justify-content: right;
        padding-bottom: 20px;
        padding-top: 20px;
        background-image:url("{{url('assets/images/test_c.jpg')}}");
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;
    }
    
    .selectpicker option
    {
        background-color: white;
        margin-top: -20px;
        background: none;
    }
    .selectpicker
    {
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        width: 20vw;
    }

    form button{
        width:110px;
        height:35px;
        margin:0 10px;
        background: #927e9cf2;
        border-radius:30px;
        border:0;
        outline:none;
        color:black;
        cursor:pointer;
    }

    .button{
        width:110px;
        height:35px;
        margin:0 10px;
        background: #927e9cf2;
        border-radius:30px;
        border:0;
        outline:none;
        color:black;
        cursor:pointer;
    }
    
    .upload-box{
        background:#232020;
        border:5px;
        color: grey; 
    }
    .upload-box::-webkit-file-upload-button{
        color:green;
        background-image: linear-gradient(45deg,blue);
        padding:5px 16px;
        margin-top: 5px;
        border:none;
        border-radius:50px;  
        cursor: pointer;
        outline:none;
    }
</style>
                                     
<div class="wrapper">
    <div class="container1">
        <h2 class="form-title"><b>Nice to meet you!</b></h2>
        <form id="registrationForm" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="main-user-info" id="main">
                <div class="user-input-box">
                    <label for="reg_name">First Name<span style="color: red;"> *</span></label>
                    <input style="background-color: transparent;"  placeholder="First Name" type="text" name="name" value="" id="first_name" >
                </div>
                <div class="user-input-box">
                    <label for="reg_name">Middle Name<span style="color: red;"> *</span></label>
                    <input  class="" placeholder="Middle Name" type="text" name="mname" value="" id="middle_name" style="background-color: transparent;" >
                </div>
                <div class="user-input-box">
                    <label for="reg_name">Last Name<span style="color: red;"> *</span></label>
                    <input  class="" placeholder="Last Name" type="text" name="lname" value="" id="last_name" style="background-color: transparent;" >
                </div>
                <div class="user-input-box">
                    <label for="reg_Pnumber">Phone Number<span style="color: red;"> *</span></label>
                    <input  class="" type="text" placeholder="Phone Number" name="phone" value="" id="reg_Pnumber" style="background-color: transparent;" >
                </div>
                <div class="user-input-box">
                    <label for="">Alternate Phone Number<span style="color: red;"> *</span></label>
                    <input  class="" type="text" placeholder="Alternate Phone Number" name="alt_phone" value="" id="alternate_number" style="background-color: transparent;" >
                </div>
                <div class="user-input-box">
                    <label for="reg_email">Email Address<span style="color: red;"> *</span></label>
                    <input class="" placeholder="Email Address" type="email" name="email"  value="" id="reg_email" style="background-color: transparent;">
                </div>
                <div class="user-input-box">
                    <label for="">Shop Name<span style="color: red;"> *</span></label>
                    <input class="" type="text"  placeholder="Shop Name" name="shop_name" value="" id="shop_name" style="background-color: transparent;">
                </div>
                <div class="user-input-box">
                    <label for="">Address 1<span style="color: red;"> *</span></label>
                    <input class="" type="text" name="address" id="address1"  placeholder="House / Flat number" style="background-color: transparent;">
                </div>
                <div class="user-input-box">
                    <label for="">Address 2<span style="color: red;"> *</span></label>
                    <input class="" type="text" name="areaandstreet" id="address2"  placeholder="Area, Street " style="background-color: transparent;">
                </div>
                <div class="user-input-box">
                    <label for="">Landmark<span style="color: red;"> *</span></label>
                    <input class="" type="text" name="landmark" id="landmark"  placeholder="Landmark" style="background-color: transparent;">
                </div>
                <div class="btn-box">
                    <button type="button" id="next1" onclick="Hide_form()">Next</button>
                </div>
            </div>
            
            <div class="main-user-info" id="next_div" style="display: none;">
                <div class="user-input-box">
                    <label for="">Country<span style="color: red;"> *</span></label>
                    <select class="selectpicker"  id="country-dropdown" name="country" style="background-color: transparent; color:black;">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $data)
                        <option value="{{$data->id}}">
                            {{$data->Name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">State<span style="color: red;"> *</span></label>
                    <select id="state-dropdown" class="selectpicker" name="state" style="background-color: transparent; color:black;">
                        <option value="">-- Select State --</option>
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">City<span style="color: red;"> *</span></label>
                    <select id="city-dropdown" name="city" class="selectpicker" style="background-color: transparent; color:black;">
                        <option value="">-- Select City --</option>
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">ZIP<span style="color: red;"> *</span></label>
                    <input style="background-color: transparent;" id="zip" name="zip" placeholder="e.g. 400001" class=""  type="number" >
                </div>
                <div class="user-input-box">
                    <label for="">Password<span style="color: red;"> *</span></label>
                    <input  class="" type="password" style="background-color: transparent;" name="password" value="" placeholder="Demo@123" id="reg_password" >
                    <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label for="confirm_password">Confirm Password<span style="color: red;"> *</span></label>
                    <input  class="" placeholder="Confirm Password" type="password" name="password_confirmation" style="background-color: transparent;" value="{{old('password_confirmation')}}" id="confirm_password" >
                    <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label>Address Proof<span style="color: red;"> *</span></label>
                    <input img-target-modal='1' style="background-color: transparent;"  id="idProof" onchange="readURL(this, event)" type="file" class="upload-box" name="addressproof" >
                    <i title="ID Proof" id='id-proof' img-show="1" class="fa fa-eye showpwd"  style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                    <span for="" style="color:white">I have an account, <a href="{{url('vendor')}}">Sign in</a></span>
                </div>
                <div class="" >
                    <input class="button"  type="submit"  id="sign_up" value="sign up">
                </div>
                <div class="btn-box">
                    <button onclick="back_btn()" type="button" id="back1">Back</button>
                </div>
            </div>
        </form>
    </div>  
</div>                                
<!-- here start -->
<script>
   function Hide_form()
   {
//         if($('#first_name').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill First Name',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
//     	    $('#first_name').focus();
//     	    return false
//     	}
//         if($('#middle_name').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Middle Name',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#middle_name').focus();
// 		    return false
// 		}
//         if($('#last_name').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Last Name',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#last_name').focus();
// 		    return false
// 		}
//         if($('#reg_Pnumber').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Phone Number',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#reg_Pnumber').focus();
// 		    return false
// 		}
//         if($('#alternate_number').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Alternate Phone Number',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#alternate_number').focus();
// 		    return false
// 		}
//         if($('#reg_email').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Email Id',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#reg_email').focus();
// 		    return false
// 		}
//         if($('#shop_name').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Shop Name',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#shop_name').focus();
// 		    return false
// 		}
//         if($('#address1').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Address',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#address1').focus();
// 		    return false
// 		}
//         if($('#address2').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Address2',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#address2').focus();
// 		    return false
// 		}
//         if($('#landmark').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Landmark',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#landmark').focus();
// 		    return false
// 		}
        $('#main').css("display","none");
        $('#next_div').css("display","block");
        $('#next_div').css("display","");
   }

   function back_btn()
   {
        $('#main').css("display","block");
        $('#main').css("display","");
        $('#next_div').css("display","none");
   }
</script>
                                                    
<script>
    window.onload = function () {
        const elements = document.querySelectorAll('[type="password"]');
        elements.forEach(function(elem) {
        elem.parentNode.querySelector('i').addEventListener('click', function(){
        if (elem.type === "password") {
        elem.type = "text";
        this.className = 'fa fa-eye showpwd';
        } else {
        elem.type = "password";
        this.className = 'fa fa-eye-slash showpwd';
        }
        });
        });
        }
</script>
                                                      
@stop

@section('footer')

@stop
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var validImgExtensions = ['jpg','jpeg', 'png'];
    var validPDFExtensions = ['pdf'];
    function readURL(input, event)
    {
        // let file_name = event.target.files[0].name;
        // let file_name_array = file_name.split(".")
        // let current_file_extension = file_name_array[file_name_array.length-1];
        // if(validImgExtensions.includes(current_file_extension))
        // {
        //     Imgvalidation(input, event);
        // }else if(validPDFExtensions.includes(current_file_extension)){
        //     pdfvalidation(input, event);
        // }else{
        //     alert('Please select valid file');
        //     $(`#${event.target.getAttribute('id')}`).val('');
        // }
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
                var idCountry = this.value;
                console.log(idCountry);
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
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
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{url('city')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
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
    
    // validation 
 const validate = ()=>{
//         if($('#country-dropdown').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Select Country Dropdown ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#country-dropdown').focus();
// 		    return false
// 		}
//         if($('#state-dropdown').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Select State Dropdown ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#state-dropdown').focus();
// 		    return false
// 		}
//         if($('#city-dropdown').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Select City Dropdown ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#city-dropdown').focus();
// 		    return false
// 		}
//         if($('#zip').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Zip ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#zip').focus();
// 		    return false
// 		}
      
// 		if($('#reg_password').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Password',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#reg_password').focus();
// 		    return false
// 		}
//         if($('#confirm_password').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Confirm Password ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#confirm_password').focus();
// 		    return false
// 		}
       
        // else{
        //     return true
        // }
    }

    $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('#registrationForm').submit(function(e){
        var formData = new FormData(this);
        e.preventDefault();
        // if(validate()){
            $.ajax({
                url: "{{url('/vendor/registration')}}",
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
                             window.location = "{{url('/vendor')}}";
                        });
                    }
                },
            });
        // }
});
});
</script>    
    

    
  