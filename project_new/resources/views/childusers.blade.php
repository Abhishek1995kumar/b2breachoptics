@extends('includes.newmaster')
<style type="text/css">
    .container {
        margin-top: 50px;
        margin-bottom: 50px
    }
    
    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        /*min-width: 0;*/
        word-wrap: break-word;
        width: 60%;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }
    
    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }
    
    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }
    
    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }

    .demo{
       width: 100%;
       padding-left: 25px;
       padding-right: 25px;
    }
    
</style>
@section('content')
<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="demo">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="dashboard-content">
                        <div id="my-orders-tab">
                            <div class="order-table-responsive">
                                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                                {{-- <link rel="stylesheet" href="{{asset('css/allusers.css')}}"> --}}
                                <div class="main-box clearfix">
                                    <div class="table-responsive">
                                        <div class="register" style="display:flex; justify-content: right; align-items: center">
                                            <div class="button">
                                                <button class="btn btn-primary">
                                                    <a href="{{route('subuser.reg')}}" style="text-decoration: none; color: #fff; font-weight: bold;">New User</a>
                                                </button>
                                            </div>
                                        </div>
                                        <table class="table user-list" id="userOrders">
                                            <thead>
                                                <tr>
                                                    <th><span>Rank</span></th>
                                                    <th><span>User</span></th>
                                                    <th><span>Created</span></th>
                                                    <th class="text-center"><span>Status</span></th>
                                                    <th><span>Email</span></th>
                                                    <th>Cost Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($childuser->count() > 0)
                                                    <?php
                                                        $count = 1;
                                                    ?>
                                                    @foreach($childuser as $users)
                                                    <tr>
                                                        <td>
                                                            {{$count}}
                                                        </td>
                                                        <td>
                                                            <a href="#" class="user-link">{{$users->name}}</a>
                                                        </td>
                                                        <td>
                                                            {{$users->created_at}}
                                                        </td>
                                                        <td class="text-center">
                                                            @if($users->status == 0)
                                                                <span class="label label-warning">Pending</span>
                                                            @elseif($users->status == 1)
                                                                <span class="label label-success">Active</span>
                                                            @else
                                                                <span class="label label-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="#">{{$users->email}}</a>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <select onchange="submitcostprice({{$users->id}}, event)"  id="cost-dropdown" class="form-control" style="width: 100%;">
                                                               <option <?php if($users->costpriceshow == "Yes"){echo "selected";}?> value="Yes"> Yes</option>
                                                               <option <?php if($users->costpriceshow == "No"){echo "selected";}?> value="No"> No</option>
                                                            </select>
                                                        </td>
                                                        <td style="width: 10%;">
                                                            <a href="{{url('subuser/delete')}}/{{$users->id}}" class="table-link danger">
                                                                <span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $count++;
                                                    ?>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
<script src="{{ URL::asset('assets/js/user/buyer.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop