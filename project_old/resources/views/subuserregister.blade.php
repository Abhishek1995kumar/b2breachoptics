@extends('includes.newmaster')

@section('content')

    <div class="home-wrapper">
        <!-- Starting of login area -->
        <div class="section-padding login-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="newAccount-area">
                            <h2 class="signIn-title text-center"><b>Nice to meet you!</b></h2>
                
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                          
                            <form action="{{route('subuser.reg.submit')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="user_id" value="{{Auth::guard('profile')->user()->id}}" id="reg_name" required>
                                </div>
                                <div class="form-group">
                                    <!--<label for="reg_name">name <span>*</span></label>-->
                                    <input class="form-control" placeholder="Name e.g.John" type="text" name="name" value="{{old('name')}}" id="reg_name" required>
                                </div>
                                <div class="form-group">
                                    <!--<label for="reg_Pnumber">Phone Number <span>*</span></label>-->
                                    <input class="form-control" type="text" placeholder="Phone Number" name="phone" value="{{old('phone')}}" id="reg_Pnumber" required>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="reg_email">Email Address <span>*</span></label>-->
                                    <input class="form-control" placeholder="Email Address" type="email" name="email"  value="{{old('email')}}" id="reg_email" required>
                                </div>
                                <div class="form-group">
                                
                                    <!--<label for="reg_password">Password <span>*</span></label>-->
                                    <input class="form-control" type="password" name="password" value="{{old('password')}}" placeholder="Demo@123" id="reg_password" required>
                                      <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px"></i>
                                </div>
                                <div class="form-group">
                                                                       <!--<label for="confirm_password">Confirm Password <span>*</span></label>-->
                                    <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation"  value="{{old('password_confirmation')}}" id="confirm_password" required>
                                     <i class="fa fa-eye showpwd" style="margin-left: -30px; float: right; margin-top: -25px"></i>


                                </div>
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
                               
                                 <div class="form-group">
                                    <input class="btn btn-md login-btn" type="submit" value="Register">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of login area -->
    </div>
@stop

@section('footer')

@stop