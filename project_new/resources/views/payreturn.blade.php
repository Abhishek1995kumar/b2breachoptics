@extends('includes.newmaster')

@section('content')


    <div class="home-wrapper">
        <!-- Starting of Account Dashboard area -->
        <div class="section-padding dashboard-account-wrapper wow fadeInUp">
            <div class="row">
                <div class="container">
                    <div class="col-md-12 text-center services">
                        <div class="services-div">
                            @if(isset($signatureStatus))
                                @if($signatureStatus == true)
                                    <h1 class="text-center" style="color: green"> Congratulation !!</h1>
                                    <h2>Your Order Has been Confirmed.</h2>
                                @else
                                    <h1 class="text-center text-warning"> Sorry !!</h1>
                                    <h2>Your Order Has been Failed. Please contact to the admin or try again later.</h2>
                                @endif
                            @else
                                <h1 class="text-center" style="color: green"> Congratulation !!</h1>
                                <h2>Your Order Has been Confirmed.</h2>
                            @endif
                            <p></p>
                            <a href="{{route('user.account')}}" class="button style-10">My Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')

@stop