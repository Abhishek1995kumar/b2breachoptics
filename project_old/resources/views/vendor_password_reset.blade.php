@extends('includes.newmaster')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
    .form-title{
        font-size:26px;
        font-weight:600;
        text-align:center;
        padding-bottom:6px;
        color:white;
        text-shadow:2px 2px 2px black;
        border-bottom:solid 1px white;
    }

   .contentBx
    {
        border: none;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100%;
    }
    .formBx
    {
        width:74%;
    }

    .contentBx .formBx h2{
        color:#607d8b;
        font-weight:600;
        font-size: 1.5em;
        text-transform:uppercase;
        margin-bottom:20px;
        border: none;
        letter-spacing:1px;
    }
    .contentBx .formBx .inputBx{
        margin-bottom: 20px;
    }

   .contentBx .formBx .inputBx{
        font-size:16px;
        margin-bottom: 5px;
        display:inline-block;
        color:#607db8;
        font-weight:300;
        font-size:16px;
        letter-spacing:1px;
    }
    .contentBx .formBx .inputBx input{
        width:100%;
        padding:5px 11px;
        outline: none;
        font-weight:400;
        border:1px solid #607d8b;
        font-size:16px;
        letter-spacing: 1px;
        color:#607d8b;
        background:transparent;
        border-radius:30px;
    }

    .contentBx {
        padding:10px 20px;
        outline: none;
        font-weight:400;
        border:1px solid #607d8b;
        font-size:16px;
        letter-spacing: 1px;
        color:#607d8b;
        background:transparent;
        border-radius:30px;
    }

    .contentBx .formBx .inputBx input[type="submit"]
    {
        background: #927e9cf2;
        color: #fff;
        outline: none;border: none;
        font-weight: 500;
        cursor: pointer;
    }
    .test:hover{
        background:#87a0dd;
    }
    .inputBx{
        color: white;
    }
    .social-media{
        width:100%;
        text-align:center;
        margin-top:20px;
    }
    .social-media ul{
        list-style:none;
    }
    .social-media ul li{
        display:inline-block;
        cursor:pointer;
        margin:7px;
    }
    .social-media img{
        width: 40px;
        height: 40px;
    }
</style>
 <div class="wrapper">
    <div class="container1">
        <div style="border:none" class="contentBx">
            <div class="formBx">
                 <h3>
                    <img style="width: 15%; margin-left: 100px;" src="{{url('/assets/images/2x.png')}}">
                </h3>
              <h2 class="text-center" style="border-bottom: solid 1px #3adfca; font-size: 17px;">VENDOR RESET PASSWORD</h2>
              <p>If You've Lost Your Password Or Wish To Reset It,</p>
              <p>Use The Input  Below To Get Started.</p>
                <form id="reset_pass" role="form" autocomplete="off" class="form" method="post">
                    <div class="inputBx" style="display: flex; align-items: center; padding-top: 12px;">
                        <span style="display: block; margin-right: 12px;"><i class="fa fa-phone" style="padding-top: 8px; color:#19e5a5;"></i></span>
                        <span style="display: block;"> <input id="mobile" style="text-align: center;width: 243px; background-color: #880707;"  name="mobile" placeholder="Mobile No" class="form-control" disabled hidden value="<?php echo $phone; ?>"  type="text"></span>
                    </div>
                    <div class="inputBx" style="display: flex; align-items: center;padding-top: 12px;">
                      <span style="display: block; margin-right: 12px;"><i class="fa fa-eye" id="con_Password" style="padding-top: 8px; color:#19e5a5;"></i></span>
                      <input id="first_pass" name="first_pass" placeholder="Password" style="width: 243px; text-align: center;" class="form-control"  type="password">
                    </div>
                    <div class="inputBx" style="display: flex; align-items: center;padding-top: 12px;">
                      <span style="display: block; margin-right: 12px;" ><i class="fa fa-eye" id="togglePassword" style="padding-top: 8px; color:#19e5a5;"></i></span>
                      <input id="confirm_pass" name="confirm_pass" placeholder="Conform Password" class="form-control"  type="password" style="text-align: center; width:243px">
                    </div>
                    <br>
                    <div>
                        <input name="" class="btn btn-lg btn-block test" style="border-radius:30px; margin-left: 112px; width: 30%; padding: 5px 10px; color:black;" value="Reset" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
$("#reset_pass").on('submit', function(e){
      var mobile = $('#mobile').val();
      var first_pass = $('#first_pass').val();
      var confirm_pass = $('#confirm_pass').val();
      var form_data = {'mobile':mobile,'first_pass':first_pass,'confirm_pass':confirm_pass };
        e.preventDefault();
        $.ajax({
            url: "{{url('vendor/password_set')}}",
            data:form_data,
            dataType: 'JSON',
            method:'post',            
            success: function(resp)
            {
              if(resp.status == "success")
              {
                 Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: resp.msg,
                    background: "#151614d4",
                    color:"white",
                }).then((result) => {
                    window.location.href = "{{route('vendor.login')}}"
                })
              }else{
               Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: resp.msg,
                    background: "#151614d4",
                    color:"white",
                })
              }
            }
        });
    });
  });
</script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#confirm_pass");
    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
    });

  const con_password = document.querySelector("#con_Password");
  const first_password = document.querySelector("#first_pass");
  con_password.addEventListener("click", function () {
    const type = first_password.getAttribute("type") === "password" ? "text" : "password";
    first_password.setAttribute("type", type);
  });
</script>
@stop
@section('footer')
@stop