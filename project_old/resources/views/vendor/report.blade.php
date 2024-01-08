@extends('vendor.includes.master-vendor')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Report </h3>
        <div class="row">
        <div class="dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head" >
                    <div class="dashboard-product-image col-md-4" style="background: linear-gradient(to top right, pink,red,black);">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Product Stock
                        <!-- <span class="product-quantity">{{ \App\Product::where('approved','no')->count() }}</span> -->
                        <span></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('vendor/report_list')}}">
                            <span class="pull-left">Search</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head" >
                    <div class="dashboard-product-image col-md-4" style="background: linear-gradient(to top right, pink,red,black);">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Order Report
                        <span></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('vendor/sales_report_list')}}">
                            <span class="pull-left">Search</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head" >
                    <div class="dashboard-product-image col-md-4" style="background: linear-gradient(to top right, pink,red,black);">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Cancel Order Report
                        <span></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('vendor/cancil_report_list')}}">
                            <span class="pull-left">Search</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="main" >

        </div>
    </div>
</div>






@stop
@section('footer')
@stop