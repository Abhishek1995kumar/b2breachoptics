@extends('includes.newmaster')

@section('content')
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
</style>
<div class="wrapper">
    <div class="container1">
        <div style="border:none" class="contentBx">
            <div class="formBx">
            <h5 class="form-title" style="border-bottom: solid 1px white;font-size: 16px;">FORGOT VENDOR PASSWORD </h5>
            <h6>Enter Your Email To Reset Your Password </h6>
                <form action="{{ route('vendor.forgotpass.submit') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="inputBx">
                        <input class="form-control" value="{{ old('email') }}" placeholder="Email Address" type="email" name="email" id="email" required>
                    </div>
                    
                    <div class="inputBx" style="padding-top: 13px;">
                        <input class="btn btn-md login-btn" type="submit" value="SUBMIT">
                        
                    </div>  
                    <a href="{{url('user/login')}}" style="color: white;">Login Now</a>
                    <div class="social-media">
                    <ul class="sci">
                        <li><a href="https://www.facebook.com/profile.php?id=100083349458623"><img src="{{url('assets/images/facebook.png')}}"></a></li>
                        <li><a href=""><img src="{{url('assets/images/instagram.png')}}"></a></li>
                        <li><a href=""><img src="{{url('assets/images/twitter.png')}}"></a></li>
                        <li><a href=""><img src="{{url('assets/images/linkedin.png')}}"></a></li>
                    </ul>
                </div> 
                </form>
                
            </div>
        </div>
    </div> 
</div>
@stop

@section('footer')

@stop