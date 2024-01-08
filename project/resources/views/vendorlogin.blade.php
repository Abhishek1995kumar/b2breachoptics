@extends('includes.newmaster')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
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
        width:50%;
    }
    .contentBx .formBx h2{
        color:#607d8b;
        font-weight:600;
        font-size: 1.5em;
        text-transform:uppercase;
        margin-bottom:20px;
        border: none;
        display: inline-block;
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
    .contentBx .formBx .inputBx input[type="submit"]:hover{
        background:#655999f2;
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
    
    #Before_send{
      display: flex;
      /*height: 100vh;*/
      align-items: center;
      justify-content: center;
    }
    
    @keyframes arrows {
      0%,
      100% {
        color: black;
        transform: translateY(0);
      }
      50% {
        color: red;
        transform: translateY(20px);
      }
    }
    
    .before{
      --delay: 0s;
      animation: arrows 1s var(--delay) infinite ease-in;
    }
</style>
    <div class="wrapper">
        <div class="container1">
            <br>
            <div style="border:none" class="contentBx">
                <div class="formBx">
                    <h2 class="form-title" style="border-bottom: solid 1px white;">Vendor Sign in</h2>
                    <form id="loginForm" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="inputBx">
                            <span style="color:white">Email ID</span>
                            <input style="color:white" placeholder="Email ID"  type="text" name="email" id="email" onkeypress="">
                        </div>
                        <div class="inputBx">
                            <span style="color:white">Password</span>
                            <input  style="color:white" placeholder="Password" type="password" name="password" id="password" >
                            <i title="Shop Act Licence" id='shop-act-lic' img-show="2" class="fa fa-eye showpwd"  style="margin-right: -33px; float: right; margin-top: 14px;cursor: pointer;color: blue;"></i>
                        </div>
                        <br><br>
                        <div class="inputBx" id="submit_btn">
                            <input type="submit" value="Continue">
                        </div>
                        <div id="Before_send"  style="display:none;">
                          <h2 class="before">R</h2>
                          <h2 class="before" style="--delay: 0.1s">E</h2>
                          <h2 class="before" style="--delay: 0.3s">A</h2>
                          <h2 class="before" style="--delay: 0.4s">C</h2>
                          <h2 class="before" style="--delay: 0.5s">H</h2>
                        </div>
                        <div class="inputBx">
                           <p>Don't have an account?<a href="{{route('vendor.reg')}}" style="border-bottom: solid 1px grey;">Sign Up</a></p>
                        </div>
                        <div class="inputBx">
                           <p><a href="{{route('vendor.forgotpass')}}" style="color: red; ">Forgot Password?</a></p>
                        </div>
                    </form>
                    <div class="social-media">
                        <ul class="sci">
                            <li><a href="https://www.facebook.com/profile.php?id=100083349458623"><img src="{{url('assets/images/facebook.png')}}"></a></li>
                            <li><a href=""><img src="{{url('assets/images/instagram.png')}}"></a></li>
                            <li><a href=""><img src="{{url('assets/images/twitter.png')}}"></a></li>
                            <li><a href=""><img src="{{url('assets/images/linkedin.png')}}"></a></li>
                        </ul>
                    </div>
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
<script>
    $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('#loginForm').submit(function(e){
        var formData = new FormData(this);
        e.preventDefault();
        if(validate()){
            $.ajax({
                url: "{{url('/vendor/login')}}",
                method:'POST',
                data : formData,
                processData: false,
                contentType: false,
                cache : false,
                dataType: 'JSON',
                beforeSend: function() 
                {
                    $('#Before_send').css("display", "block");
                    $('#submit_btn').hide();
                },
                complete: function() 
                {
                    $('#Before_send').css("display", "none");
                    $('#submit_btn').show();
                },
                success:function(resp){
                    if(resp.status == "email"){
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        })
                    }
                    if(resp.status == "not_approve"){
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        })
                    }
                    if(resp.status == "not_active"){
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        })
                    }
                    if(resp.status == "deactive"){
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        })
                    }
                    if(resp.status == "otp"){
                      Swal.fire({
                          icon: 'success',
                          title: 'success',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        }).then((result) => {
                            window.location = "{{url('/verifyOTP?email=')}}"+resp.data;
                        })
                    }
                },
            });
        }
	}); 
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: "Allow Only Number Value !!",
                  background: "#151614d4",
                  color:"white",
                })
        return false;
    }
    return true;
}

const validate = ()=>{
        if($('#email').val() == ''){
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Please Fill Email ID !!",
                    background: "#151614d4",
                    color:"white",
                })
		    $('#phone').focus();
		    return false
		}
		if($('#password').val() == ''){
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Please Fill Password !!",
                    background: "#151614d4",
                    color:"white",
                })
		    $('#password').focus();
		    return false
		}
		
		 else{
            return true
        }
        
    }
        
</script>