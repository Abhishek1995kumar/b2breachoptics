@extends('includes.newmaster')

@section('content')

<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="account-dashboard-tab">
                            <h3>my dashboard</h3>
                            <div class="dashboard-breadcroumb-section">
                                <!--<img src="{{url('/')}}/assets/img/testimonial-bg-img.jpg" alt="">-->
                                <div class="customer-info">
                                    <div class="col-lg-6 col-md-12 col-sm-12 padding-left-0">
                                        <h2>{{$user[0]->name}}</h2>
                                        <p class="customer-id">{{$user[0]->email}}</p>
                                        <p class="customer-points">{{$user[0]->phone}}</p>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <p class="colored-p">default billing address</p>
                                        <!--<p><strong>Name: </strong>{{$user[0]->name}}</p>-->
                                        <!--<p><strong>Email: </strong>{{$user[0]->email}}</p>-->
                                        <!--<p><strong>Phone: </strong>{{$user[0]->phone}}</p>-->
                                        <p><strong>Address: </strong>{{$user[0]->address}} {{$user[0]->address2}}</p>
                                        <p><strong>City: </strong>{{$user[0]->city}}</p>
                                        <p><strong>State: </strong>{{$user[0]->state}}</p>
                                        <p><strong>Contry: </strong>{{$user[0]->country}}</p>
                                        <p><strong>Post Code: </strong>{{$user[0]->zip}}</p>
                                        <a href="{{route('user.accinfo')}}" class="editpage-save-button">Edit address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="account-info-div">
                                <!--<h3>acconut information</h3>-->
                                <!--<div class="single-account-info-div">-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-lg-6 col-md-12 col-sm-12">-->
                                <!--                <p class="colored-p">default billing address</p>-->
                                <!--                <p><strong>Name: </strong>{{$user[0]->name}}</p>-->
                                <!--                <p><strong>Email: </strong>{{$user[0]->email}}</p>-->
                                <!--                <p><strong>Phone: </strong>{{$user[0]->phone}}</p>-->
                                <!--                <p><strong>Address: </strong>{{$user[0]->address}}</p>-->
                                <!--                <p><strong>City: </strong>{{$user[0]->city}}</p>-->
                                <!--                <p><strong>Post Code: </strong>{{$user[0]->zip}}</p>-->
                                <!--                <a href="{{route('user.accinfo')}}" class="address-btn">Edit address</a>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                {{--<div class="single-account-info-div">--}}
                                    {{--<h4>address book</h4>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-lg-6 col-md-12 col-sm-12">--}}
                                            {{--<div class="col-md-8 col-sm-8">--}}
                                                {{--<p class="colored-p">default billing address</p>--}}
                                                {{--<p>{{$user[0]->name}}</p>--}}
                                                {{--<p>{{$user[0]->email}}</p>--}}
                                                {{--<a href="" class="address-btn">manage address</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-4  col-sm-4">--}}
                                                {{--<a href="" class="edit-btn">edit address</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-lg-6 col-md-12 col-sm-12">--}}
                                            {{--<div class="col-md-8 col-sm-8">--}}
                                                {{--<p class="colored-p">default billing address</p>--}}
                                                {{--<p>md shamsuzzaman shaon</p>--}}
                                                {{--<p>shaon@gmail.com</p>--}}
                                                {{--<a href="" class="address-btn">manage address</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-4  col-sm-4">--}}
                                                {{--<a href="" class="edit-btn">edit address</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
</div>

@stop

@section('footer')

@stop