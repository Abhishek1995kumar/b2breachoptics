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
                    <label for="reg_name">First Name</label>
                    <input style="background-color: transparent; color:white;"  placeholder="First Name" type="text" name="name" value="" id="first_name" >
                </div>
                <div class="user-input-box">
                    <label for="reg_name">Middle Name <span>*</span></label>
                    <input  class="" placeholder="Middle Name" type="text" name="mname" value="" id="middle_name" style="background-color: transparent; color:white;" >
                </div>
                <div class="user-input-box">
                    <label for="reg_name">Last Name<span>*</span></label>
                    <input  class="" placeholder="Last Name" type="text" name="lname" value="" id="last_name" style="background-color: transparent; color:white;" >
                </div>
                <div class="user-input-box">
                    <label for="reg_Pnumber">Phone Number <span>*</span></label>
                    <input  class="" type="text" placeholder="Phone Number" name="phone" value="" id="reg_Pnumber" style="background-color: transparent; color:white; " >
                </div>
                <div class="user-input-box">
                    <label for="">Alternate Phone Number</label>
                    <input  class="" type="text" placeholder="Alternate Phone Number" name="alt_phone" value="" id="alternate_number" style="background-color: transparent; color:white; " >
                </div>
                <div class="user-input-box">
                    <label for="reg_email">Email Address <span>*</span></label>
                    <input class="" placeholder="Email Address" type="email" name="email"  value="" id="reg_email" style="background-color: transparent; color:white; ">
                </div>
                <div class="user-input-box">
                    <label for="">Address 1</label>
                    <input class="" type="text" name="address" id="address1"  placeholder="House / Flat number" style="background-color: transparent; color:white; ">
                </div>
                <div class="user-input-box">
                    <label for="">Address 2</label>
                    <input class="" type="text" name="address2" id="address2"  placeholder="Area, Street & Landmark " style="background-color: transparent; color:white; ">
                </div>
                <div class="user-input-box">
                    <label for="">Country</label>
                    <select class="selectpicker"  id="country-dropdown" name="country" style="background-color: transparent;   color:black;">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $data)
                        <option value="{{$data->id}}">
                            {{$data->Name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">State</label>
                    <select id="state-dropdown" class="selectpicker" name="state" style="background-color: transparent; color:black;">
                        <option value="">-- Select State --</option>
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">City</label>
                    <select id="city-dropdown" name="city" class="selectpicker" style="background-color: transparent;  color:black;">
                        <option value="">-- Select City --</option>
                    </select>
                </div>
                <div class="user-input-box">
                    <label for="">ZIP</label>
                    <input style="background-color: transparent; color:white; " id="zip" name="zip" placeholder="e.g. 400001" class=""  type="number" >
                </div>
                <div class="btn-box">
                    <button type="button" id="next1" onclick="Hide_form()">Next</button>
                </div>
            </div>
            <div class="main-user-info" id="next_div" style="display: none;">
                <div class="user-input-box">
                    <label for="">Business Name</label>
                    <input name="bussiness_name" style="background-color: transparent; color:white; " placeholder="Business Name" id="bussiness_name" class=""  type="text" >
                </div>
                <div class="user-input-box">
                    <label for="">Bank Name</label>
                    <input name="bank_name" style="background-color: transparent; color:white; " placeholder="Bank Name" id="bank_name" class=""  type="text" >
                </div>
                <div class="user-input-box">
                    <label for="">Account No</label>
                    <input name="acc_no" style="background-color: transparent; color:white; " placeholder="Account No" class="" is="acc_no" type="number" >
                </div>
                <div class="user-input-box">
                    <label for="">IFSC Code</label>
                    <input name="ifsc_code" style="background-color: transparent; color:white; " id="ifsc_code" placeholder="IFSC Code" class=""  type="text" >
                </div>
                <div class="user-input-box">
                    <label for="">GST No</label>
                    <input minlength="15" maxlength="15" style="background-color: transparent; color:white; " class=""  placeholder="GST No e.g.AAAAA0000A" type="text" name="gst_no"  id="gst_no"  oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="user-input-box">
                    <label for="">Password</label>
                    <input  class="" type="password" style="background-color: transparent; color:white; " name="password" value="{{old('password')}}" placeholder="Demo@123" id="reg_password" >
                    <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label for="confirm_password">Confirm Password <span>*</span></label>
                    <input  class="" placeholder="Confirm Password" type="password" name="password_confirmation" style="background-color: transparent; color:white; " value="{{old('password_confirmation')}}" id="confirm_password" >
                    <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label>PAN Card<span style="color: red;">*</span></label>
                    <input img-target-modal='1' style="background-color: transparent; color:white; "  id="idProof" onchange="readURL(this, event)" type="file" class="upload-box" name="id_proof" >
                    <i title="ID Proof" id='id-proof' img-show="1" class="fa fa-eye showpwd"  style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label>Shop Act Licence</label>
                    <input img-target-modal='2' style="background-color: transparent; color:white; "   id="shopActLic" onchange="readURL(this, event)" type="file" class="upload-box" name="shop_act_lic" >
                    <i title="Shop Act Licence" id='shop-act-lic' img-show="2" class="fa fa-eye showpwd"  style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label>Udyam Certificate</label>
                    <input img-target-modal='3'  id="udyamCert" style="background-color: transparent; color:white; " onchange="readURL(this, event)" type="file" class="upload-box" name="udyam_cert" >
                    <i title="Udyam Certificate" id='udyam-certi' img-show="3" class="fa fa-eye showpwd"  style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                    <label>Aadhar Card</label>
                    <input img-target-modal='3' style="background-color: transparent; color:white; "  id="aadhar_card" onchange="readURL(this, event)" type="file" class="upload-box" name="aadhar_card" >
                    <i title="Aadhar Card" id='aadhar_show' img-show="3" class="fa fa-eye showpwd"  style="margin-left: -30px; float: right; margin-top: -25px;cursor: pointer;color: blue;"></i>
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                    <label type="text" name="terms" id="terms_conditions"><a>Terms And Conditions</a></label>
                </div>
                
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                </div>
                <div class="user-input-box">
                    <span for="" style="color:white">I have an account, <a href="{{url('user/login')}}"> Sign in</a></span>
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
		 if($('#reg_Pnumber').val() == '8693027642'){
            Swal.fire({
                    title: 'Message!',
                    text: 'All Ready This  Phone Number Store',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
		    $('#reg_Pnumber').focus();
		    return false
		}
		
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
        if($('#reg_email').val() == ''){
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Email Id',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
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
                    text: 'Please Fill Address2',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
		    $('#address2').focus();
		    return false
		}
        if($('#country-dropdown').val() == ''){
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Country Dropdown ',
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
                    text: 'Please Select State Dropdown ',
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
                    text: 'Please Select City Dropdown ',
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
                    text: 'Please Fill Zip ',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
		    $('#zip').focus();
		    return false
		}
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
                                                      
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg"   >
        <div class="modal-content" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center;">TERMS AND CONDITIONS</h4>
        </div>
        <div class="modal-body" >
            <h6>1. INTRODUCTION</h6>
            <p>This document is an electronic record in terms of Information Technology Act, 2000 and rules there under as applicable and the amended provisions pertaining to electronic records in various statutes as amended by the Information Technology Act, 2000. This electronic record is generated by a computer system and does not require any physical or digital signatures.This document is published in accordance with the provisions of Rule 3(1) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of domain name <a>https://www.elricaglobal.in</a> (“Website”), including the related mobile site.
                For the purpose of these Terms of Use, wherever the context so requires "You", “Your”, "User" shall mean any natural or legal person who access, visits, uses, deals with and / or transact at the Website in any way. The term "We", "Us", "Our", “the Company” shall mean M/s. Elrica Global Enterprises Private Limited.
                This website <a>https://www.elricaglobal.in</a> (our “website”) is offered to you conditioned on your acceptance without modification of the terms, conditions, and notices contained herein (the “Terms”). Your use of our website constitutes your agreement to all such Terms. Our website is owned and operated by M/s. Elrica Global Enterprise Private Limited. with its office located at 01, 1st Floor, Vinayak Smruti, Gokhale Road, Naupada Thane (West) Thane - 400602. By using the Site, you agree to comply with and be legally bound by the terms and conditions of these Terms of Service (“Terms”).
                These Terms govern your access to and use of the Site and Services and all Collective Content and constitute a binding legal agreement between you and us. Please read carefully these Terms and our Privacy Policy, which may be found at <a>https://www.elricaglobal.in/privacy-policy</a>, and which is incorporated by reference into these Terms. If you do not agree to these Terms, you have no right to obtain information from or otherwise continue using the Site. Failure to use the Site in accordance with these Terms may subject you to civil and criminal penalties.
                Our website has been made available to integrate both buyers and sellers  (“users”) through our website as a digital channel to formulate a seamless functioning of optical business for the specific purpose of enabling users to Purchase & Sell original merchandise such as eyewear which includes both spectacles and contact lens ("Products"). Wherein users can purchase or sell the products offered through the website. The use of this Website constitutes your consent to, and agreement to, abide by the most current version of these terms and conditions (the “Terms”). We may at any time revise these terms and conditions by updating the Terms. You agree to be bound by subsequent revisions and agree to review the Terms periodically for changes to the terms and conditions.
                The most up to date version of the Terms will always be available for your review under the “Terms and conditions” link that appears at the bottom of the Website. This website reserves the right to recover the cost of services, collection charges and lawyers fees from persons using the Site fraudulently. This website reserves the right to initiate legal proceedings against such persons for fraudulent use of the Site and any other unlawful acts or acts or omissions in breach of these terms and conditions.
                Please read these terms of use and carefully as they contain important information regarding your legal rights, remedies and obligations. These include various limitations and exclusions, and a clause that governs the jurisdiction and venue of disputes. in using this website you are deemed to have read and agreed to the following terms and conditions set forth herein. any incidental documents and links mentioned shall be considered to be accepted jointly with these terms. you agree to use the website only in strict interpretation and acceptance of these terms and any actions or commitments made without regard to these terms shall be at your own risk. These terms and conditions form part of the agreement between the users and us. By accessing this website, and/or undertaking to perform a service by us indicates your understanding, agreement to and acceptance, of the disclaimer notice and the full terms and conditions contained herein.
            </p>
            <h6>2.DEFINITIONS AND INTERPRETATION</h6>
            <p> 
                <b>•</b>   “Agreement” means the terms and conditions as detailed herein including all Exhibits, privacy policy, other policies mentioned on the website and will include the references to this agreement as amended, negated, supplemented, varied or replaced from time to time.<br>
                <b>•</b>	“Elrica Global” means (“Elrica Global Enterprise Private Limited” or  “<a>https://www.elricaglobal.in</a>” or “Company”, or “REACH”)  is a online platform has been made available to integrate both buyers and sellers  (“users”) through our website as a digital channel to formulate a seamless functioning of optical business for the specific purpose of enabling users to Purchase & Sell original merchandise such as eyewear which includes both spectacles and contact lens ("Products & Services").<br>
                <b>•</b>	“Account” means the accounts created by the users at the time of registration and through which you can access the Products & services provided on the website.<br>
                <b>•</b>	“User/Visitor” means the individual who avails our services.<br>
                <b>•</b>	“Content” means text, graphics, images, music, audio, video, information or other materials.<br>
                <b>•</b>	“User Content” means all Content that a user posts, uploads, publishes, submits or transmits to be made available through our website.<br>
                <b>•</b>	The official language of these terms shall be English.<br>
                <b>•</b>	The headings and sub-headings are merely for convenience purposes and shall not be used for interpretation.<br>
            </p>
            <h6>3.USERS ELIGIBILITY</h6>
            <p>
                Use of the Website is available only to persons who can form legally binding contracts under Indian Contract Act, 1872. Persons who are “incompetent to contract” within the meaning of the Indian Contract Act, 1872 including minors, un-discharged insolvents etc. are not eligible to use the Website. If you are a minor i.e. under the age of 18 years, you shall not register as a User of the website and shall not transact on or use the website. As a minor if you wish to use or transact on a website, such use or transaction may be made by your legal guardian or parents on the Website.  Elrica Global reserves the right to terminate your account and / or refuse to provide you with access to the Website if it is brought to ElricaGlobal’s notice or if it is discovered that you are under the age of 18 years.
            </p>
            <h6>4. USER ACCOUNT & REGISTRATION</h6>
            <p>
                You may be required to register and set up an account (“Account”) for using the App by entering an email address and password or by using any permitted social media the App account to sign in ("Account Information"). Elrica Global as its sole discretion may ask for the verification of Your Account Information provided by You and hence, it is advisable to provide valid information e.g. like email address or mobile number etc. while creating an Account. The App will set-up an account and email the details of the Account at the email address provided.  You can create one Account only and it is not permitted to transfer or interchange such Account to any other person. The list of information required to be provided by You, the manner of usage, protection and confidentiality of Your information and Account information are more specifically dealt with under the App’s Privacy Policy and You are requested to read the Privacy Policy in detail before sharing Your information or creating an Account.
            </p>
            <p>
                If You use this Website, you are solely responsible for maintaining the confidentiality of Your account and password(s) and for restricting access to Your computer, and You agree to accept responsibility for all activities that occur under Your account or password. If You register on the Website, You agree that any information You provide to Us will be true, currect, accurate and complete. We reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders at our sole discretion. We will not be liable for any loss that You may incur as a result of someone else using Your password or account, either with or without Your knowledge. However, You could be held liable for losses incurred by Us or another party due to someone else using Your account and/or password either with or without Your knowledge. You agree to notify the Company immediately of any unauthorized use of Your account and/or password(s), or other breach of security.
            </p>
            <p>
                You will be required to enter a valid phone number and email id while placing an order on the Website. By registering Your phone number and email id with Us, You consent to be contacted by Us via phone calls, SMS notifications, email notification, mobile applications and/or any other electronic mode of communication in case of any order or shipment or delivery related updates. We may use Your personal information to initiate any promotional phone calls or SMS.
            </p>
            <h6>5.WEBSITE CONTENT</h6>
            <p>
                Elrica Global owns the copyright to all the contents of this website, including images. All trademarks and other intellectual property are owned or licensed to us (unless otherwise specified).
                You shall not copy, reproduce, distribute, republish, download, display, post or transmit any part of the website without the written consent from us. You may print or download any pages for your own personal and non-commercial use only. If you have any doubts about what you can do, please email us at reach@elricaglobal.in or call us on 8091213809, while our website is accurate as possible, we cannot accept responsibility for any inaccuracies or errors beyond our reasonable control. We cannot guarantee that colored images will be rendered correctly on different computer monitors.
            </p>
            <h6>6.DESCRIPTION OF SERVICE AND PRODUCTS</h6>
            <p>
                The Company provides an opportunity for You to purchase the Products from high end manufacturers. Upon placing order, the Company shall ship the Product to You and will be entitled to its payment for the Products and Services. All Products and information displayed on the Website or App constitute an "invitation to offer". Your order for purchase constitutes your "offer" which shall be subject to the terms and conditions as detailed in this Agreement. The Company may accept or reject Your offer in its sole discretion which cannot be contested by You. The Company, to the best of its knowledge, has displayed or attempts to display on the Website/s as accurately as is possible, colors of the Products that are displayed on the Website/s. However, the colors visible to You are solely dependent on Your monitor. Hence, no guarantee is provided by the Company regarding Your visibility of the colors on the Website.<br>
            </p>
            <p>
                The Company does not provide any warranty or guarantee that the Product descriptions are accurate, complete, reliable, current, or error-free. If a Product offered by the Website/s is not as described, Your sole remedy is to return it in unused, unsoiled and resale condition. The Company currently offers Eyewear through its website <a>www.ericaglobal.in</a> The Company offers a large selection of contact lenses and related products, along with information which will inform and guide You to make the Purchase.
            </p>
                <h6>7.WEBSITE PAYMENT POLICY</h6>
            <p>
                Payment is an integral part of an online shopping experience. All payments shall be collected through secured payment options. We accept all prepaid payment options such as all the major Credit Cards, Debit Cards, Net-Banking etc. Elrica Global may also offer industry-leading solutions for Cash on Delivery.
            </p>
            <p>
                All payments for purchases made by You on the App shall only be in Indian Rupees. In case of a prepaid transaction, after payment for the order has been successfully received by Elrica Global, You will be sent a notification by email or SMS at the email address or mobile number provided to Elrica Global confirming receipt of payment. There may be limits to the amount of Cash on Delivery payments based on pin codes or the State in India where delivery is to be made. Elrica Global reserves the right to withdraw or block or limit Your purchases using Cash on Delivery basis transaction history.
            </p>
                <b>Credit and Debit Card</b>
            <p>
                Elrica Global accepts all Visa, Master Card, Maestro, American Express and Diners cards. You will be redirected to Your issuing bank's site, where You will have to follow the instruction to complete the payment.
            </p>  
                <b>Net Banking</b>
            <p>
                You can make payment for an order by using Your Net Banking account. The App accepts payments for Your orders to sellers through various banks. You will be redirected to Your bank's site where You will be able to make payment after entering in Your login id and password that is known only to You.
            </p>
                <b>EMI Payments</b>
            <p>
                EMI is one of the payment methods available on Elrica Global for Your convenience which allows You to pay for Your orders easily. The equated monthly installments payment method is only available for customers using certain credit cards or debit cards as per the relevant terms and conditions being in force. Applicable charges/fees/costs, if any, levied by the Bank or payment gateway providers for facilitating EMI, shall be directly and solely borne by the Customer.  Elrica Global does not charge any processing or convenience fee for the said purpose.  Any dispute in this regard shall be directly dealt by the Customer with the Bank or payment gateway providers and Elrica Global shall not be held liable in any case, whatsoever.
            </p>  
                <b>Cash on Delivery</b>
            <p>
                Cash on Delivery is one of the payment methods for making purchases on Elrica Global where You don't have to make any advance payment. Cash on Delivery is available as a payment method for all eligible products on Elrica Global. Eligible products will be indicated by the message [‘Eligible for Cash on Delivery’] on the [‘product order page’] for delivery in certain pin codes.
            </p>  
                <b> Issues with Payments - Pending Payments</b>
            <p>
                Payments can sometimes fail or remain in the pending stage. Some of the reasons could be:
            </p>
            <p>
                <b>1.</b>Incorrect debit or credit card details are entered.<br>
                <b>2.</b>Card may be blocked or card details are no longer valid or need to be updated.<br>
                <b>3.</b>The page is accidentally closed or refreshed or backspace is pressed while the transaction is being processed by Your bank.<br>
                <b>4.</b>The connection between Elrica Global and Your bank or issuer failed due to some technical reasons and the transaction could not be completed.<br>
                <b>5.</b>Card or bank or issuer is not recognised by Elrica Global.<br>
                <b>6.</b>Incorrect login or password details are entered.<br>
                <b>7.</b>Payment amount exceeds the limit mutually agreed to between You and Your bank or issuer.<br>
            </p>
            <p>
                If You face any of the above payment issues, try placing the order again in a short while or contact Your bank or issuer for technical assistance. Elrica Global is not liable for any loss or inconvenience caused to You when making payment or for any wrongful debits to Your cards or net banking accounts.
            </p>  
                <b>Buyers arrangement with issuing Bank</b>
            <p>
                All Valid Credit / Debit / Cash Card / EMI and other payment instruments are processed using a Credit Card payment gateway or appropriate payment system infrastructure and the same will also be governed by the terms and conditions agreed to between the Buyer and the respective Issuing Bank and payment instrument issuing company.
            </p>
            <p>
                All Online Bank Transfers from Valid Bank Accounts are processed using the gateway provided by the respective Issuing Bank which support Payment Facility to provide these services to the Users. All such Online Bank Transfers on Payment Facility are also governed by the terms and conditions agreed to between Buyer and the respective Issuing Bank
            </p>
            <b> Requirements of Permanent Account Number (PAN) & GST Registration Certificate</b>
            <p>
                For all the purchase of an amount equal to or exceeding INR 2,00,000 (INR two lakhs only), You will be required to upload a copy of Your PAN card, within such time as may be prescribed from the date of purchase, failing which, the purchase made by You will be automatically cancelled. The order shall also stand cancelled if there is a discrepancy between Your name in Account with Elrica Global the name printed on the PAN card. Further, you have to provide your GST Registration Certificate wherever B2B Transactions are involved if any. The requirement to provide a copy of PAN card or GST Registration Certificate is a one time activity and You don’t need to submit it again.
            </p>
            <h6>8.SHIPPING POLICY</h6>
            <p>
                Your shipping address and pin code will be verified with the database of Elrica Global before You proceed to pay for Your purchase. In the event Your order is not serviceable by our logistics service providers or the area is not covered, we will request You to provide us with an alternate shipping address. You can make purchases on the App from anywhere in the world but at the same time You must ensure the payment and shipping address is within India.
            </p>
            <p>
                Your shipping address and pin code will be verified with the database of Elrica Global before You proceed to pay for Your purchase. In the event Your order is not serviceable by our logistics service providers or the area is not covered, we will request You to provide us with an alternate shipping address. You can make purchases on the App from anywhere in the world but at the same time You must ensure the payment and shipping address is within India.
            </p>
            <b>Delivery by Elrica Global</b>
            <p>
                The delivery of the ordered products to You will be made by logistics service providers assigned by Elrica Global. The logistics service provider assigned by Elrica Global will make a maximum of three [3] attempts to deliver Your order. In case You are not reachable, available or do not accept delivery of products in these attempts Elrica Global reserves the right to cancel the order at its discretion. You may be informed of such cancellation by email or SMS at the email address or mobile number provided to Elrica Global. The cancelled order is returned to Elrica Global. You agree not to hold Elrica Global liable for any such cancellation.
            </p>
            <p>
                If You wish to request the App to resend the product, You can do so by placing a new order for the product on the terms set out on the website or app when You place the new order. Your order will be accepted subject to availability of the product.
            </p>
            <p>
                In case there is any dispute regarding the shipment of the product or serviceability for the area not covered by the logistics service providers, Elrica Global will not be responsible for the non-delivery of the product. Title and risk of loss for all products ordered by You shall pass on to You upon delivery of the products at the shipping address provided by You.
            </p>
            <b>Multiple Product Orders</b>
            <p>
                In case You order multiple products in one transaction, Elrica Global would endeavor to ship all products together. However, this may not always be possible due to some product characteristics or logistics issues or the location of the wherehouse and You may receive the products separately and at different times. If You purchase multiple products in a single transaction, then all the products would be dispatched to a single shipping address given by You. If You wish to ship products to different addresses, then You should book the orders separately based on the shipping addresses.
            </p>
            <b>Missing Items</b>
            <p>
                In the event, the product package received by You is missing one or more products or accessories or does not include the freebie or the order is partly delivered, You should inform Elrica Global through the Customer Care Team within 7 days of delivery date of the package.<b>Missing products claims will not be accepted after 7 days from delivery date.</b> When a package delivered is missing one or more products or accessories, You are requested to return the original package delivered to Elrica Global in accordance with the Return Policy.
            </p>
            <b>Refusal of Delivery</b>
            <p>
                Before accepting delivery of any product, kindly ensure that the product's packaging is not damaged or tampered. If You observe that the package is damaged or tampered, You are requested to refuse to accept delivery and inform Elrica Global within 7 days of delivery date.
            </p>
            <p>
                You are requested to fill the delivery sheet / acknowledgement used by the logistics service providers and note down the condition of the delivered package. Damaged or tampered products claims will not be accepted beyond the returns policy
            </p>
            <b>Delivery Time</b>
            <p>
                An estimated delivery time of each product will be displayed on the website or mobile app at the time of placing the order. On placing Your order, You will receive an email or SMS at the email address or mobile number provided to Elrica Global containing a summary of the order and also the estimated delivery time to Your location. In exceptional situations it may take additional time to pack and dispatch certain products. Delivery timeframes are just estimates and are not guaranteed delivery timeframes and should not be relied upon as such. Deliveries to certain locations may take longer than expected due to accessibility of the location and serviceability by the logistics service provider.
            </p>
            <b>About Delayed Delivery</b>
            <p>
                Sometimes, delivery may take longer due to:
            </p>
            <p>
                <b>1.</b>Bad weather.<br>
                <b>2.</b>Transportation delays.<br>
                <b>3.</b>Natural calamities.<br>
                <b>4.</b>Political disruptions.<br>
                <b>5.</b>Logistics service provider related challenges.<br>
                <b>6.</b>Product lost in transit.<br>
                <b>7.</b>Regional or national holidays which are considered as delivery holidays.<br>
                <b>8.</b>Other unforeseen circumstances or events beyond the control of Elrica Global or logistics service provider.<br>
            </p>
            <p>
                If the estimated delivery date has passed and You still have not received Your order, please contact us and we will take steps to track Your package. In such cases, we may also try to proactively contact You. Please check Your emails and SMS regularly for such updates.
            </p>
            <p>
                Elrica Global will not compensate for any mental agony or inconvenience or loss caused due to delay in delivery for any reason. You may be informed by email or SMS at the email address or mobile number provided to Elrica Global if any product in the order is unavailable or is delayed or lost in transit.
            </p>
            <b>Shipping Charges</b>
            <p>
                You may be required to pay Shipping Charges in addition to the order value amount. The shipping charges, if any, will appear at the time of checkout. All delivery charges are inclusive of applicable taxes unless stated otherwise. Shipping Charges may vary for different pin codes as well as type of product.
            </p>
            <b>Open Delivery</b>
            <p>
                Elrica Global reserves the right to provide Open delivery or not. Open delivery service which is provided by Elrica Global with some Specifics logistics service providers. Open delivery depends upon our logistics service provider’s service dependencies. <b>You can’t open parcel if logistics service provider doesn’t allow and in such event, You have a right to accept the parcel after paying the amount and thereafter You can use our hassle-free return policy.</b> Please refer to the Return and Refund Policies, if You wish to return the delivered product to Elrica Global.
            </p>
            <h6>9. RETURN POLICY</h6>
            <p>
                Return Policy makes it possible for You to return a product if You receive a damaged or defective product or if the product is significantly different from what was purchased or when the package delivered is missing one or more products or accessories. Return Policy here should be read in conjunction with any specific terms and conditions applicable to a product which can be found on product descriptions page for returning a product.
            </p>
            <b>Conditions for Return</b>
            <p>
                In order to return any product sold through the website or App, You are required to comply with the below mentioned conditions, viz.:
            </p>
            <p>
                <b>1.</b>	The return has to be in compliance with the Return Policy associated with the product category.</br>
                <b>2.</b>	Elrica Global should be notified of the receipt of a damaged or defective product or if the product is significantly different from what was purchased, within the period of 7 days from the date of delivery of the product.</br>
                <b>3.</b>	Products should be returned unused, in their original packaging along with the original price tags, labels, packing, barcodes, user manual, warranty card and invoices, accessories, freebies and original boxes defined as essentials. If any product is returned without the essentials, the product shall not be accepted for return and shall be sent back to You.</br>
                <b>4.</b>	The return packages should be strongly and adequately packaged so that there is no damage to products during transit.</br>
                <b>5.</b>	The returned products are subject to verification and quality checks by the Elrica Global in order to determine the legitimacy of the complaint or return.</br>
                <b>6.</b>	You should fill the Return Form provided by Elrica Global with the originally delivered package or make it available to You over email or account and include it in the returned package. Return requests are not processed if the Return Form is incomplete or absent in the returned package received. The reason for return should be stated in the Return form. You should additionally fill out the delivery sheet used by the logistics service providers and note down any damaged or tampered condition of the delivered package.</br>
                <b>7.</b>	The return has to be in compliance with the return policy of the manufacturer of the product where applicable.</br>
            </p>
            <b>Non-returnable Products</b>
            <p>All products cannot be returned. Some of the products that cannot be returned are:</p>
            <p>
                <b>1.</b>	Products that have been used </br>
                <b>2.</b>	Products damaged due to misuse of product or products having incidental damages due to malfunctioning.</br>
                <b>3.</b>	A product with defects not covered under manufacturer’s warranty.</br>
                <b>4.</b>	Personalized or engraved products or resized products.</br>   
                <b>5.</b>	Products sold in sets or combinations cannot be returned individually.</br>
                <b>6.</b>	Any other product depending upon the Return Policy in force.</br>
            </p>
            <p>
                If You are unable to inform Elrica Global of the receipt of a damaged or defective product or the product is not as per specifications of Your order or the package delivered is missing one or more products or accessories as per the returns policy and procedure, Elrica Global shall not be obliged to accept the returned product or be liable in this regard. In the event, such a product will be returned to the user and the same needs to be accepted from the assigned logistics service provider. Elrica Global will not be responsible if the product is not accepted and no refund will be issued.
            </p>
            <b>Damaged, Defective or Other Non-conforming Products</b>
            <p>
                Returns of damaged, defective or other products eligible for return are accepted as under:
            </p>
            <p>
                <b>i.</b>In the event You receive a damaged or defective product or a product that does not comply with the specifications as per Your original or the product is delivered after the expected delivery period or the package delivered is missing one or more products or accessories and eligible for return as described by Return Policy, You are required to get in touch with the Customer Care Team through any of the below mentioned channels or submit a return request as per the Returns Policy.</br>
                <b>Ii.</b>Upon receiving Your return request, Elrica Global shall verify the authenticity and the nature of the request and if the request is genuine, Elrica Global will inform the seller of the return request and will ask the seller for a refund to be processed upon the receipt and quality check of the returned product. It will take a minimum of [ 4-6] business days to process Your request for return of products.</br>
                <b>iii.</b>Elrica Global may arrange for pick-up of the product through an assigned logistics service provider. You will receive an email or SMS notification at Your email address or mobile number provided to Elrica Global. In the event Elrica Global is unable to arrange pick-up, Elrica Global will notify You regarding the same and You will be required to send the product to the provided address using a reputed courier service in Your area.</br>
                <b>v.</b>If Your pin code is not serviceable, Elrica Global may ask You to ship the product using a relevant and available logistics service provider or Indian Postal services. Customers are required to submit the shipping information of the self-ship by contact Customer Service. In the event the details are not provided and the shipment arrives without returns form or invoice, the refund may be delayed.</br>
                <b>vi.</b>Upon receipt of the returned product by the seller and successful completion of the quality check, You will receive an email or SMS confirmation at the email address or mobile number provided to Elrica Global.</br>  
                <b>vii.</b>You will be refunded the product cost along with taxes and shipping charges, if any. Courier freight charges You paid to courier or shipping service for returning the product will be reimbursed as per method agreed with You.</br>
            </p>
            <p>
                You expressly acknowledge that the seller is solely responsible for the damaged or defective product or a product that does not meet the specifications of Your original order or delayed delivery of the order or delivery of the package with one or more products or accessories missing and for any claims that You may have in relation to such products and Elrica Global shall not in any manner be held liable for the same.
            </p>
            <b>Period for Return</b>
            <p>
                within 7 days from the date on which a product delivered can be returned by the Buyer subject to the other terms and conditions of the Return Policy contained hereunder.
            </p>
            <b>Cancellation of Return Request</b>
            <p>
                A request for return once made can be cancelled by contacting Customer Service. In case the Logistics Service provider arrives to receive the shipment and You want to cancel the request, You may choose to inform the logistics service provider that You do not wish to return the product. You will receive an email or SMS notification at the email address or mobile number provided to Elrica Global cancelling Your return request.
            </p>
            <b>Refusal of Return Request</b>
            <p>
                Elrica Global reserves the right to refuse or cancel any return request.  If the request for returns is not allowed by the Returns Policy, You will not be refunded the payment made or any costs and will not be able to raise a second request for return for the same product. You agree not to dispute the decision made by Elrica Global and accept ElricaGlobal’s decision regarding the refusal or cancellation and further agree not hold Elrica Global liable for any refusal or cancellation.
            </p>
            <b>Frivolous Complaints</b>
            <p>
                In the event of frivolous or baseless complaints or requests regarding the quality or content of the products, Elrica Global reserves the right to take necessary legal actions against You and You will be solely liable for all costs incurred by Elrica Global in this regard.
            </p> 
            <b>Return Shipping Process</b>
            <p>
                In case of return of products initiated and subsequent courier of the product by You, if it is found that the returned product was not delivered to the Elrica Global or any other designated location specified or the package was empty, the onus shall be on You to prove through submission of proof of delivery from the concerned courier service provider to establish Your claim of return. Self-courier of returns should be initiated within the periods specified in the ElricaGlobal’s Returns Policy. Elrica Global is not liable to process the return request until satisfactory proof of delivery is provided to Elrica Global. In case of damage claims, Elrica Global may ask for pictures of the damaged product before it is approved or allowed for return.
            </p>
            <p>
                For return shipping managed by Elrica Global, You will need to hand over the product to the assigned logistics service provider at the time of pick-up. In the event the logistics service provider makes attempts to pick-up the product and You are unavailable or not ready to handover the product, Elrica Global or logistics service provider will not be held responsible for the delay in pick-up or processing of the quality check. A maximum of 2 attempts will be made by the logistics service provider to pick-up the product to be returned. Elrica Global will not be liable for the products returned by mistake.
            </p>
            <p>
                In the event where a product not belonging to Elrica Global is returned by mistake, Elrica Global is not accountable for such misplacement and is not responsible for its delivery back to You or any costs incurred by You or any refund.
            </p>
            <p>
                In case of any discrepancy in the status of pick-up of a product arranged by Elrica Global, (where You claim the product has been returned, while our system suggests otherwise) refund will be initiated only if You successfully furnish the courier slip given by the Elrica Global assigned logistics service provider at the time of the pick-up.
            </p>
            <b>10. ORDER CANCELLATION POLICY</b>
            <p>
                Cancellation of an order can be done either by Elrica Global or by You as under:
            </p> 
            <b>Cancellation by Elrica Global</b>
            <p>
                Elrica Global has the discretion to cancel an order. Some of the reasons for cancellation are as under (not being exhaustive list of reasons):
            </p>
            <p>
                <b>a.</b>Your failure to comply with any of these terms.<br>
                <b>b.</b>Product is unavailable with Elrica Global.<br>
                <b>c.</b>Technical errors or issues.<br>
                <b>d.</b>Any reason identified by ElricaGlobal's credit and fraud avoidance team.<br>
                <b>e.</b>Invalid address or wrong address is given in order details.<br>
                <b>f.</b>Malpractices used to place the order.<br>
                <b>g.</b>Order is undelivered after three (3) attempts.<br>
                <b>h.</b>EMI offer is rejected by the bank.<br>
                <b>i.</b>Pricing or specifications on any product as is shown on the website or App due to typographical error or incorrect information inadvertently provided due to some technical glitch, resulting into incorrect pricing or specifications.<br>
            </p>
            <p>
                Notwithstanding anything contained hereunder, Elrica Global reserves the right, at its sole discretion, to refuse or cancel any order for any reason whatsoever without any further liability. On such cancellation, You will be sent a notification email or SMS at the email address or mobile number provided to Elrica Global.
            </p>
            <p>
                You agree to release and indemnify Elrica Global, its officers and representatives from any cost, damage, liability or any of the actions in case of cancellation of Your Order by Elrica Global or seller.
            </p> 
            <b>Cancellation by You</b>
            <p>
                You may cancel an order for any reason, although cancellation by You must be done before the product has been shipped for delivery to You. No cancellation is permitted subsequently.
            </p>
            <p>
                You can cancel an order, or part of an order where multiple products have been ordered. This can be done either by calling or emailing Customer Care Team or in Your account on the website or App through ‘my account’. You should state the reason for such cancellation. Elrica Global will process the request for cancellation as per the policy in force. If an order has been successfully cancelled, You will be sent a confirmation email or SMS at the email address or mobile number provided to Elrica Global. 
            </p>
            <p>
                Elrica Global reserves the right to accept or reject requests for order cancellations for any reason whatsoever. You agree not to hold Elrica Global liable for any rejection of order cancellations. You will receive a refund for Your cancelled orders that have been accepted in accordance with the Refund Policy.
            </p>
            <b>11. REFUND POLICY</b>
            <p>
                Refunds are provided for cancellation / return of products, subject to the eligible cancellation/ return as per Return Policy or these terms and conditions, initiated in accordance with the Return or Cancellation Policy.
            </p>
            <p>
                Refund is made for the full amount of the order or part order successfully cancelled that was paid by You for the delivery of the order. For return requests, the refund of payment is made after the returned product has been received by Elrica Global and has passed the quality checks. The entire product cost along with any taxes and shipping charges if any will be refunded to You.
            </p>
            <p>
                If any refund is received by You pending the quality checks, You will hold such amounts in trust on behalf of Elrica Global until conclusion of such quality checks unless claimed by Elrica Global any time before that. If You are in receipt of any wrongful refunded or payment, You will transfer such amount back to Elrica Global within 3 days of You receiving such amount.
            </p>
            <p>
                No refund due to non-deliverability will be applicable to orders placed with Cash on Delivery options. Refund of Cash on Delivery orders returned by You may be subject to levy of a charge which will be deducted from Your refund amount.
            </p>     
            <b>Time Period for Refunds</b>
            <p>
                Refunds are normally processed within 1-6 working days after the completion of quality checks of product returned and further depends on various banking and payment channels. Interest charged by the bank providing the EMI Scheme till the time the request for return or cancellation is raised will not be refunded. 
            </p>
            <p>
                Elrica Global is not responsible for any errors or delays in refund due to banks or third party service provider errors or delays.
            </p>     
            <b>Mode of Refund</b>
            <p>
                The mode of refund of payments cannot be changed at any stage as the refund amount is transferred to Your source account. Refunds are paid back to the source of payment.
            </p>
            <p>
                Refund for payments made by modes other than Cash on Delivery, which fail when processed back to source may be refunded by National Electronic Funds Transfer (“NEFT”) to Your bank account.
            </p>
            <p>
                Refund of orders placed using Cash on Delivery as the payment method will be made by cheque or demand draft or to Your bank account via NEFT or to Your wallet account depending on the discretion of Elrica Global.
            </p>
            <p>
                You will need to update the bank account number and IFSC code to enable us to process a refund to Your account. Refunds cannot be processed to third-party accounts, i.e. the name on Your Elrica Global account should match with the name of the bank account holder provided for refund via NEFT. A refund initiation confirmation by email or SMS at the email address or mobile number provided to Elrica Global will be sent to You.
            </p>
            <p>
                All refunds by cheque will be in form of "at par" cheques or via online transfer; basis sole discretion of Elrica Global.
            </p>     
            <b>Terminated Payment Mode</b>
            <p>
                If the original payment method You used to make the payment (credit or debit card or net banking) is no longer valid, we will issue the refund through a cheque. When we receive a payment failure notice from Your bank, we will send You an email asking You to call us. When You call us, we will collect Your address where You want the cheque to be sent, and proceed with the refund. Please refer to our Payment Policy for further details.
            </p>
            <p>
                You explicitly give Your consent to receiving communications (by SMS, email or other mode of communication) sent to You by Elrica Global, however, You may withdraw Your consent any time at Your sole discretion.
            </p>
            <b>12. THIRD PARTY WEBSITES</b>
            <p>
                The App may contain links to other websites and the App is not in any way responsible for the terms of use or content of such websites and expressly disclaims all liability associated with the content and use of these websites. The linked websites are not under the control of Elrica Global and You are encouraged to read the terms of use and privacy policy of each and every linked website before accessing any of the third-party websites linked to the App and You acknowledge that any risk associated thereof while accessing and using such linked third-party websites solely lies with You and Elrica Global shall not be responsible in any manner whatsoever.
            </p>
            <b>13. INTELLECTUAL PROPERTY RIGHTS</b>
            <p>
                All content included on the App, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of Elrica Global, its affiliates, associates or its content suppliers and is protected by Indian/ International copyright, authors' rights and database right laws. The compilation of all content on the App is the exclusive property of Elrica Global, its affiliates, associates or its content suppliers and is protected by laws of Indian/ International copyright and database right laws. All software used on this App is the property of Elrica Global, its affiliates, associates or its software suppliers and is protected by laws of India and international copyright authors rights and database laws.
            </p>
            <p>
                Elrica Global grants You a limited licence to access and make personal use of this App, but not to download (other than page caching) or modify it, or any portion of it, except with express written consent of Elrica Global. This licence does not include any resale or commercial use of the contents of the App; any collection and use of any product listings, descriptions, or prices; any derivative use of this App or its contents; any downloading or copying of account information for the benefit of another seller.
            </p>
            <p>
                The trademarks, logos and service marks displayed on the Website or App <b>("Marks")</b> are the properties of Elrica Global or its affiliates, associates or its content suppliers or users or respective third parties. Users are not permitted to use the Marks without the prior consent of Elrica Global, its affiliates, associates or its content suppliers or users or the third party that may own the Marks.
            </p>
            <p>
                Elrica Global owns all intellectual property rights to and into the trademark "Elrica Global,” and the App, including, without limitation, any and all rights, title and interest in and to copyright, related rights, patents, utility models, designs, know-how, trade secrets and inventions, goodwill, source code, meta tags, databases, text, content, graphics, icons, and hyperlinks.
            </p>
            <p>
                You agree not to use or apply for registration of any marks, or domain names which are similar to the marks or domain names used in connection with the App or owned by Elrica Global.
            </p>
            <p>
                You shall not use, copy, reproduce, modify, alter, change, amend, transmit, broadcast, edit, revise, review, adapt, translate, distribute, perform, display, sell or otherwise deal with  content or the intellectual property rights of the App or content suppliers or third parties in any mode medium or manner now known or developed in future without authorization from Elrica Global and on happening of any such event Elrica Global reserves the right to immediately discontinue the services to such User without prejudice ElricaGlobal’s right to initiate legal action in this regard. You are strictly prohibited from framing or use framing techniques to enclose any content or intellectual property on the website or App to illegally and unlawfully exploit the content or intellectual property rights owned by Elrica Global or content suppliers or third party as the case is.
            </p> 
            <b>Trademark Infringement Complaints</b>
            <p>
                Elrica Global fully respects Intellectual Property (IP) Rights of the IP owners. In case You feel that Your Trademark has been infringed, you may write us at <a>reach@elricaglobal.in</a> with the subject line as “Trademark Infringement Complaint” with complete details viz. Your name and contact address, particulars of Your IP and products listed on App allegedly infringing Your IP,
            </p>
            <b>14.FEE</b>
            <p>
                Users can use and access the website or App free of charge. However, at any time in future, after duly notifying in advance, Elrica Global reserves its right to charge the users for the use of the website or App and provisioning of the services through the App as per applicable Indian law.
            </p> 
            <b>15.EMAIL ABUSE & THREAT POLICY</b>
            <p>
                Private communication, including email correspondence, is not regulated by Elrica Global. Elrica Global encourages its Users to be professional, courteous and respectful when communicating by email. However, Elrica Global will investigate and can take action on certain types of unwanted emails that violate Elrica Global policies.Such instances:
            </p>
            <p>
                <b>1.</b>Threats of Bodily Harm - Elrica Global does not permit Users to send explicit threats of bodily harm.<br>
                <b>2.</b>Misuse of Elrica Global System - Elrica Global allows Users to facilitate transactions through the Elrica Global systems but will investigate any misuse of this service.<br>
                <b>3.</b>Spoof (Fake) email - Elrica Global will never ask you to provide sensitive information through email. In case you receive any spoof (fake) email, you are requested to report the same to Us through the ‘Contact Us’ tab.<br>
                <b>4.</b>Spam (Unsolicited Commercial email) - ElricaGlobal’s spam policy applies only to unsolicited commercial messages sent by Elrica Global Users. Elrica Global Users are not allowed to send spam messages to other Users.<br>
                <b>5.</b>Offers to Buy or Sell Outside of Elrica Global - Elrica Global prohibits email offers to buy or sell listed products outside of the Elrica Global Website. Offers of this nature are a potential fraud risk for the users.<br>
                <b>6.</b>Elrica Global policy prohibits user-to-user threats of physical harm via any method including, phone, email and on Our public message boards.<br>
                <b>7.</b>Violations of this policy may result in a range of actions, including:Limits on account privileges, Account suspension<br>
            </p>
            <b>16.LEGAL USES</b>
            <p>
                Further, You agree and understand that Your right to access and use the Services offered on this Website is personal to You and is not transferable by You to any other person or entity. You understand that You are authorized to access and use the services only for legal and lawful purposes.
            </p>
            <p>
                You further undertake and state that by using the services You are in no way impersonating or misrepresenting any person or entity. All services availed are for Yourself only. In the event You are representing individual/s, company/ies, third parties or any entities, You undertake and state that You are authorized to represent such individual/s, company/ies, third parties or any entities. You shall be solely responsible for the consequences arising out of such acts and the Company shall not be held responsible or liable in any way to any person or entity.
            </p>
            <p>
                Any changes in Your registration information must be duly updated by You. Your access and use of this Website may be interrupted from time to time for any of the several reasons, including, without limitation, the malfunction of equipment, periodic updating, maintenance or repair of the Website or other actions that the Website, in its sole discretion, may elect to take. We at the Company utilize our best efforts to provide the Services without any interruptions or hindrance, however, we do not warrant that the function, operation, security or accessibility of the Website will be uninterrupted or error-free, that defects will be corrected, or that this Website or the server that makes it available will be free of viruses or other harmful elements. As a user of the Website, You agree that Your access will be subject to these terms and conditions and that access is undertaken at Your own risk. We shall not be liable for damages of any kind related to Your use of or inability to access the Website.
            </p>
            <b>17. STORAGE, DELETION OR TRANSPORT OF DATA</b>
            <p>     
                The Company states that the data provided by You shall belong solely and exclusively to You. As such, You are permitted to remove or delete the data, so provided, either in full or any portion, at any point in time as You desire. The Company requests You to notify the Company of such removal or deletion. In the event, You desire the Company to remove or delete all or any portion of the data belonging to You, then, the same needs to be provided in writing to the Company. Upon receipt of such written request, the Company will do the needful forthwith and notify You of the same. The Company will not retain any copies of such data on its server or in any other place.
            </p>
            <p>
                In this regard, the Company warrants that it cannot access such deleted material at any point in time. Any contact, information or access that the Company had towards such data or material or accounts will cease forthwith. However, certain portions of Your data, which the Company had maintained on its servers may remain either in backups or in transaction logs. These are maintained only for the specific purpose of backup or to provide Services to You in the event of any malfunction or damage to our server in order to ensure continuity of our service without disruption.
            </p>
            <b>18.  COMMUNICATION</b>
            <p>
                The Company may send you communication, notices or alerts from time to time. These alerts and communication will be sent automatically by the Company to You. Please be informed that you have agreed to receive any type of communication including but not limited to emails, SMS, phone calls or any other mode of communication from us that is transactional, promotional & informational in nature. In case You have suppressed the receipt or disabled or marked alerts or communication in general to be junked, the Company recommends You to revise the same and activate the receipt of alerts to Your proper destination. As such any communication from our end will be related to the Services and not any marketing or spam mails.
            </p>
            <p>
                Changes to Your email address will apply to all of Your alerts. Any email which is sent by the Company or through any of the websites mentioned above, its contents and attachments, if any, are intended solely for the attention of the addressee/s and may also be privileged. If You are not the addressee You may not copy, forward, disclose any part of any message received or its attachments and if You receive a message in error, please delete the said message from Your system and notify us immediately.
            </p>
            <p>
                You agree and acknowledge that internet communications cannot be guaranteed to be secure or error free. Any information sent via the internet could be intercepted, corrupted, lost or contain viruses. The Company and the Website therefore does not accept responsibility for any errors or omissions in messages received by You which may arise as a result of internet transmission.
            </p>
            <b>19.  RIGHTS GRANTED BY YOU</b>
            <p>     
                As the provision of Services includes You providing us with information, data, passwords, usernames, personal identification numbers and other materials and contents, suggestions, ideas, feedback, etc., You are hereby expressly granting us the license and right to utilize the same for and on Your behalf in order to provide the Services. 
            </p>
            <p>
                The Company may or will use such information with the sole purpose for providing You the required Services and not for any other purpose. As such, You hereby warrant and represent that You are duly authorized to submit or represent the third party on behalf of whom You are providing these information to the Company. Further, You acknowledge and agree that these materials, suggestions, feedback and information can be utilized without any obligation or restriction on the Company in terms of payment of fee or any other limitations for marketing, promoting, advertising or other purposes.
            </p>
            <p>
                By using the Service, you expressly authorize the Company to access Your accounts maintained by identified third parties, on Your behalf as Your agent. When You use the specified feature of another additional account of the Service, you will be directly connected to the website for the third party You have identified. The Company will submit information including usernames and passwords that You provide to log you into the site. You hereby authorize and permit the Company to use information submitted by You to the Service (such as account passwords and usernames) to accomplish the foregoing and to configure the Service so that it is compatible with the third-party sites for which You submit Your information.
            </p>
            <b>20.  YOUR POSTINGS ON WEBSITE</b>
            <p>
                We, as part of our Service, encourage and permit You to post Your messages or content on any publicly available forums, blogs and other locations on the Website. By using or posting messages or data or any other information on such forums, blogs and other public locations, you expressly agree that You and only You, are responsible for all the matters contained in such content. You further, represent and warrant to us that You have all the necessary rights to post such messages or information or content and grant us a perpetual, worldwide, royalty free, non-exclusive, transferable and sub licensable right to use, reproduce, distribute, display, modify, amend, perform, etc of such content or information to promote, modify or redistribute this Website, including preparation of any derivative works thereof, in any form and through any medium without any restrictions thereof. You expressly agree that all the rights granted under this paragraph will also be available to each and every user of this Website.
            </p>
            <p>
                Further, if You intend to use a forum, a blog or any other feature available on this Website, then, You should make an independent and informed choice about submitting Your personal identifiable information. All personally identifiable information submitted on such forums, blogs or community features can be read, collected or used by any third party. There is a danger of such information being misused or misappropriated. We do not have control over such actions and we are not responsible or liable for the personally identifiable information that You as a user have chosen to submit on a public platform. In case of any violation of this condition, then, the Company reserves the right to forthwith stop your participation on such public forums.
            </p>
            <b>21.  SECURITY AND PRIVACY</b>
            <p>
                The Company knows that You care how information about You is used and shared, and we appreciate Your trust that we will do so carefully and sensibly. We let You retain as much control as possible over Your personal information. However, you may not visit and use our site at any time without telling us who You are or revealing the required information about Yourself. To the Company, our most important asset is our relationship with You. We are committed to maintaining the confidentiality, integrity and security of any personal information about our users. We are proud of our privacy practices and the strength of our site security and want you to know how we protect Your information and use it to provide to You the services. This notice describes our privacy policy. By visiting this Website, you are accepting the practices described in this Privacy Policy.
            </p>
            <p>
                <b>a.</b>Information You Give Us: We receive any information You enter on our Website or give us in any other way. However, we do not store any personal sensitive information on our server. They remain with You on Your system. You can choose not to provide certain information, but then You might not be able to take advantage of many of our features. We use the information that You Provide for such purposes as responding to your requests, customizing future commercial transactions, improving our database, and communicating with You and utilizing/exploiting/disclosing, without prejudice to any of Your other rights, the same for any other, whether commercial or non-commercial purpose which the Company in its sole discretion considers necessary for its business purposes or otherwise. You can add or update certain information. When You update information, we usually keep a copy of the prior version for our records.</br>
                <b>b.</b>Automatic Information: We receive and store certain types of information whenever You interact with us. Our server logs Your activities for various diagnostic and analytical purposes. However, other than the IP address of Your machine from where You are accessing the Service, there is no other personal information maintained by the Company in the logs.</br>
                <b>c.</b>E-mail Communications: To help us make emails more useful and interesting, we may request to receive a confirmation when Your open email from Your end if Your computer supports such capabilities.</br>
                <b>d.</b>Sharing of Information Received by the Company: You can tell when another business is involved in Your transactions, and we share, use or, disclose customer information related to those transactions with that business.</br>
                <b>e.</b>Business Transfers: As we continue to develop our business, we might be acquired completely or merge with any other Company. In such transactions, customer information generally is one of the transferred business assets. In such a case, we will intimate to You of the same and ensure the protection of Your information as per these policies and guidelines.</br>
                <b>f.</b>Protection of the Company and Others: We release accounts and other personal information when we believe release is appropriate to comply with law; enforce or apply our Terms and Conditions and other agreements; or protect the rights, property, or safety of Company, our users, or others. This includes exchanging information with other companies and organizations for fraud protection and other similar matters.</br>
            </p>
            <b>22.SECURITY OF INFORMATION</b>
            <p>
                We work to protect the security of your information during transmission by using Secure Sockets Layer (SSL) software, which encrypts information You input. We constantly re-evaluate our privacy and security policies and adapt them as necessary to deal with new challenges. We do not and will not sell or rent Your personal information to anyone, for any reason, at any time, unless it is in 
            </p>
            <p>
                <b>i.</b>in response to a valid legal request by a law enforcement officer or government agency or</br> 
                <b>ii.</b>when You have explicitly or implicitly given Your consent, or</br> 
                <b>iii.</b>utilize the same for some statistical or other representation without disclosing personal data.</br>
            </p>
            <p>
                We only reveal those numbers of Your account as required to enable us to access and provide You the required services relating to Your accounts. We make every effort to allow You to retain the anonymity of Your personal identity and You are free to choose a Login ID email address and password that keeps Your personal identity anonymous. Access to Your Registration Information and Your personal financial data is strictly restricted to those of our Company employees and contractors, strictly on a need to know basis, in order to operate, develop or improve the Service. These employees or contractors may be subject to discipline, including termination and criminal prosecution, if they fail to meet these obligations. With the exception of a Login ID in the form of an email address, which may be provided on an anonymous basis, and Your Third-Party Account Information, which is required for providing the services, the Company does not require any information from You that might constitute personally identifiable information.
            </p>
            <p>
                It is important for You to protect against unauthorized access to Your password and to Your computer. Be sure to sign off when finished using a shared computer. As described in this Agreement and with Your consent, the Company will from time to time connect electronically to Your online bank, credit card and other online financial accounts to process Your Order. 
            </p>
            <b>23.DISCLAIMER</b>
            <p>
                THE CONTENT AND ALL SERVICES ASSOCIATED WITH THIS WEBSITE OR PROVIDED THROUGH THE SERVICE ARE PROVIDED TO YOU ON AN “AS-IS” AND “AS AVAILABLE” BASIS. THE COMPANY MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE CONTENT OR OPERATION OF THIS WEBSITE OR OF THE SERVICE. YOU EXPRESSLY AGREE THAT YOUR USE OF THE SERVICE AND PURCHASE OF THE PRODUCTS IS AT YOUR SOLE RISK.
            </p>
            <p>
                THE COMPANY MAKES NO REPRESENTATIONS, WARRANTIES OR GUARANTEES, EXPRESS OR IMPLIED, REGARDING (i) THE ACCURACY, RELIABILITY OR COMPLETENESS OF THE CONTENT ON THIS WEBSITE OR (ii) OF THE SERVICE AND PRODUCTS AND EXPRESSLY DISCLAIMS ANY WARRANTIES OF NON-INFRINGEMENT OR FITNESS FOR A PARTICULAR PURPOSE. THE COMPANY ENGAGES AND EMPLOY THE BEST METHODS TO SAFEGUARD AND PROTECT AGAINST VIRUSES, INFECTION., ETC, HOWEVER, DESPITE SUCH BEST EFFORTS, THE COMPANY MAKES NO REPRESENTATION, WARRANTY OR GUARANTEE THAT THE CONTENT THAT MAY BE AVAILABLE THROUGH THE SERVICE IS FREE OF INFECTION FROM ANY VIRUSES OR OTHER CODE OR COMPUTER PROGRAMMING ROUTINES THAT CONTAIN CONTAMINATING OR DESTRUCTIVE PROPERTIES OR THAT ARE INTENDED TO DAMAGE, SURREPTITIOUSLY INTERCEPT OR EXPROPRIATE ANY SYSTEM, DATA OR PERSONAL INFORMATION.
            </p>
            <b>24.LIMITATION OF LIABILITY</b>
            <p> 
                THE COMPANY SHALL IN NO EVENT BE RESPONSIBLE OR LIABLE TO YOU OR TO ANY THIRD PARTY, WHETHER IN CONTRACT, WARRANTY, TORT (INCLUDING NEGLIGENCE) OR OTHERWISE, FOR ANY INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL, EXEMPLARY, LIQUIDATED OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO LOSS OF PROFIT, REVENUE OR BUSINESS, BUSINESS INTERRUPTION, LOSS OF PROGRAMS OR INFORMATION, OR LOSS OF SAVINGS, OR ANY OTHER DAMAGES ARISING - IN ANY WAY, SHAPE OR FORM - OUT OF THE AVAILABILITY, USE, RELIANCE ON, OR INABILITY TO UTILIZE THE SERVICE ARISING IN WHOLE OR IN PART FROM YOUR ACCESS TO THIS WEBSITE, YOUR USE OF THE SERVICE, YOUR PURCHASE OF PRODUCTS THROUGH THE WEBSITE OR THIS AGREEMENT, EVEN IF THE COMPANY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
            </p>
            <b>25.INDEMNITY BY YOU</b>
            <p>
                You shall defend, indemnify and hold harmless the Company and its officers, directors, shareholders, and employees, from and against all loss, damages, claims and expenses, including but not limited to attorney’s fees, in whole or in part arising out of or attributable to any breach of this Agreement by You, any misrepresentation or misuse of the Service offered to You or any negligent or unreasonable or inappropriate use of the Website or the Services.
            </p>
            <b>26.TERMINATION</b>
            <p>
                This Agreement to be applicable and shall be binding on the parties, i.e., You and the Company, unless terminated as specified below:
            </p>
            <p>
                <b>a.</b>by You, by providing a written notice of at least 3 (three) business days;<br>
                <b>b.</b>closure of Your account by the Company or You for any reason immediately;<br>
                <b>c.</b>The Company may terminate this Agreement and close Your account if it comes to the knowledge of the Company that You have breached any of these terms and conditions, whether intentionally or by implication;<br>
                <b>d.</b>The Company may terminate the Agreement, it is so required to be one by an express direction of law<br>
            </p>
            <p>
                All termination notices have to be forwarded to No. 01, 1st Floor, Vinayak Smruti, Gokhale Road, Naupada Thane (West) Thane Thane 400602
                The Company hereby expressly states that this Service (including, without limitation, the underlying network, system, software, servers, various directories and listings, various message and news and bulletin boards, blogs, tools, information and databases) is intended for End Users who are legally permitted to enter into a contract. This Service is not intended for the use of minors or people who are not permitted to enter into a valid and binding contract. In the event if it comes to the attention of the Company, from authentic and valid resources, that a particular End User does not meet this criteria, then, the Company will forthwith close the account of the said End User and will delete all information and content which is relating to that End User without any obligation or liability towards such End User from the Company’s records.
            </p>
            <b>27.JURISDICTION</b>
            <p> 
                The Company controls and operates this Website or App from its registered office in Mumbai, India, and makes no representation that these materials are appropriate or available for use in other locations. If You use this Website or App from other locations, You are responsible for compliance with applicable local laws. This Agreement shall be treated as though it were executed and performed in Mumbai, India and shall be governed by and construed in accordance with the local domestic laws of India (without regard to conflict of law principles). All legal proceedings arising out of or in connection with this Agreement shall be brought solely in Mumbai, India. All disputes that may arise shall be resolved in accordance with rules specified under the Indian Arbitration and Conciliation Act, 1996 and venue for arbitration shall be Mumbai. The courts in Mumbai shall have the sole jurisdiction regarding the subject matter of this Agreement.
            </p>    
            <b>28.FORCE MAJEURE</b>
            <p>
                We shall be under no liability to you in respect of anything that, if not for this provision, would or might constitute a breach of these Terms, where this arises out of circumstances beyond our control, including but not limited to:(a) acts of god;(b) natural disasters;(c) sabotage;(d) accident;(e) riot;(f) shortage of supplies, equipment, and materials;(g) strikes and lockouts;(h) civil unrest;(i) Computer hacking; or(j) malicious damage.
            </p>  
            <b>29.  GRIEVANCE OFFICER</b>
            <p>
                In accordance with Information Technology Act 2000 and rules made there Under, the name and contact details of the Grievance Officer are provided below:
            </p>   
                <p>Grievance Officer Name: Mr.</p>
                <p>Company Name: Elrica Global Services Private Limited</p>
                <p>Company Address: 102-103, 1st Floor, Vinayak Smruti,</p> 
                <p>Gokhale Road, Naupada, Thane West,</p> 
                <p>Thane - 400602 Maharashtra</p>
                <p>Email Id: reach@elricaglobal.in, Ph: 8091213809</p>
            
            <b>30.MISCELLANEOUS</b>
            <p>     
                <b>a.</b>The language in this Agreement shall be interpreted as to its fair meaning and not strictly for or against either party.
                <b>b.</b>Should any part of this Agreement be held invalid or unenforceable, that portion shall be construed consistent with applicable law and the remaining portions shall remain in full force and effect without being impaired or invalidated in any way.<br>
                <b>c.</b>To the extent that anything in or associated with the Website is in conflict or inconsistent with this Agreement, this Agreement shall take precedence.<br>
                <b>d.</b>Failure of the Company to enforce any provision of this Agreement shall not be deemed a waiver of such provision nor of the right to enforce such provision.<br>
                <b>e.</b>This Agreement may only be amended by either the same electronic means as were used to enter into this Agreement or in a writing that specifically refers to this Agreement, executed by both parties hereto.<br>
                <b>f.</b>Elrica Global Enterprises Private Limited. sells products under various brands & sub-brands through this website or app.<br>
            </p>    
            <b>31.ENTIRE AGREEMENT</b>
            <p>
                These Terms collectively represent the entire agreement and understanding between you and us and supersede any other agreement or understanding (written, oral or implied) that you and we may have had. Any statement, inducement, promise, covenant or condition not expressly found either in these Terms shall be deemed as void.
            </p>
            <b>32.CONTACT US</b>
            <p>
                For any further clarification of our Terms and Conditions, please write to us at <a>reach@elricaglobal.in</a>.
            </p>
        </div>
        <div class="modal-footer">
            <input type="checkbox" name="accept_condition" id="accept_condition" value="accepted" / > <b>Accept This Terms And Conditions</b>
        </div>
        
        </div>
    </div>
</div>
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
        $('#sign_up').hide();
        $("#terms_conditions").click(function(){
           $('#myModal').modal('show');
        });
        
        $("#accept_condition").on("change",function(){
            if($('#accept_condition').is(':checked'))
            {
                $('#sign_up').show();
                $('#myModal').modal('hide');
                $('#back1').show();
            }else{
               Swal.fire({
                    title: 'Message!',
                    text: 'Please Accept Terms And  Condition Then You Can Sign Up This Page',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                 $('#sign_up').hide();
                 $('#myModal').modal('hide');
                 $('#back1').show();
            }
        });
        
        
        $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
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
        if($('#bussiness_name').val() == ''){
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Bussiness Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
		    $('#bussiness_name').focus();
		    return false
		}
//         if($('#bank_name').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Bank Name ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#bank_name').focus();
// 		    return false
// 		}
//         if($('#acc_no').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill Account Number ',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#acc_no').focus();
// 		    return false
// 		}
//         if($('#ifsc_code').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please Fill IFSC Code',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#ifsc_code').focus();
// 		    return false
// 		}
//         if($('#gst_no').val() == ''){
//             Swal.fire({
//                     title: 'Message!',
//                     text: 'Please FIll GST Number',
//                     imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
//                     imageWidth: 400,
//                     imageHeight: 200,
//                     imageAlt: 'Custom image',
//                 })
// 		    $('#gst_no').focus();
// 		    return false
// 		}
		if($('#reg_password').val() == ''){
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Password ',
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
                    text: 'Please Fill Confirm Password ',
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

    $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('#registrationForm').submit(function(e){
        var formData = new FormData(this);
        e.preventDefault();
        if(validate()){
            $.ajax({
                url: "{{url('/user/registration')}}",
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
                             window.location = "{{url('/user/login')}}";
                        });
                    }
                },
            });
        }
	}); 
});
    
</script>

    

    
  