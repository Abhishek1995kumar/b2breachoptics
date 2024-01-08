@extends('admin.includes.master-admin')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('assets/css/orderchart.css') }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Admin Dashboard! </h3>
        <div class="row">
            <div class="dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Total Products!
                            <span class="product-quantity">{{ \App\Product::count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/products')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Pending For Approval
                            <span class="product-quantity">{{ \App\Product::where('approved','no')->where('owner','vendor')->where('status','2')->count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/products/pending')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-usd"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Orders Pending!
                            <span class="product-quantity">{{ \App\OrderedProducts::where('status','pending')->count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Orders Processing!
                            <span class="product-quantity">{{ \App\OrderedProducts::where('status','processing')->count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Orders Completed!
                            <span class="product-quantity">{{ \App\OrderedProducts::where('status','completed')->count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Don't remove 'Pending Withdraws' because this col only hide for not show in admin dashboard may be it is use in future -->
                
                <!--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">-->
                <!--    <div class="single-dashboard-product-head">-->
                <!--        <div class="dashboard-product-image col-md-4">-->
                <!--            <i class="fa fa-bank"></i>-->
                <!--        </div>-->
                <!--        <div class="dashboard-product-type col-md-8">-->
                <!--            Pending Withdraws!-->
                <!--            <span class="product-quantity">{{ \App\Withdraw::where('status','pending')->count() }}</span>-->
                <!--        </div>-->
                <!--        <div class="border-bottom"></div>-->
                <!--        <div class="bottom-link">-->
                <!--            <a class="detail-link clearfix btn-block" href="{{url('admin/withdraws/pending')}}">-->
                <!--                <span class="pull-left">View All</span>-->
                <!--                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>-->
                <!--            </a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Total Buyer!
                            <span class="product-quantity">{{ \App\UserProfile::count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/customers')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Vendor Pending!
                            <span class="product-quantity">{{ \App\Vendors::where('status',0)->count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/vendors/pending')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Total Vendor!
                            <span class="product-quantity">{{ \App\Vendors::count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/vendors')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head">
                        <div class="dashboard-product-image col-md-4">
                            <i class="fa fa-at"></i>
                        </div>
                        <div class="dashboard-product-type col-md-8">
                            Total Subscribers!
                            <span class="product-quantity">{{ \App\Subscribers::count() }}</span>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="bottom-link">
                            <a class="detail-link clearfix btn-block" href="{{url('admin/subscribers')}}">
                                <span class="pull-left">View All</span>
                                <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Top Referrals</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            @foreach($referrals as $referral)
                                                <tr>
                                                    <td>{{$referral->referral}}</td>
                                                    <td>{{$referral->total_count}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Most Used Browser</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            @foreach($browsers as $browser)
                                                <tr>
                                                    <td>{{$browser->referral}}</td>
                                                    <td>{{$browser->total_count}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12" style="padding: 0">
                            <canvas id="lineChart" style="width: 100%"></canvas>
                        </div>

                </div> -->
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head-chart">
                        <h3>Order Chart : -</h3>
                        <hr>
                        <div class="programming-stats">
                            <div class="chart-container col-lg-7">
                                <canvas class="order-chart"></canvas>
                            </div>
                            <div class="order-details col-lg-5">
                                <table>
                                    <tr>
                                        <th scope="row">Total Orders : </th>
                                        <td>&nbsp;{{$orders}} <input type="hidden" id="total_order" value="{{$orders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">COD Orders : </th>
                                        <td>&nbsp;{{$codorders}} <input type="hidden" id="cod_order" value="{{$codorders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">90 Days Credit : </th>
                                        <td>&nbsp;{{$cedit90DaysOrders}} <input type="hidden" id="cedit90DaysOrders_order" value="{{$cedit90DaysOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Razorpay Orders : </th>
                                        <td>&nbsp;{{$razororders}} <input type="hidden" id="razorpay_order" value="{{$razororders}}"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="single-dashboard-product-head-chart">
                        <h3>Order Status Chart : -</h3>
                        <hr>
                        <div class="programming-stats">
                            <div class="chart-container col-lg-7">
                                <canvas class="order-status-chart"></canvas>
                            </div>
                            <div class="order-details col-lg-5">
                                <table>
                                    <tr>
                                        <th scope="row">Total Orders : </th>
                                        <td>&nbsp;{{$totalOrders}} <input type="hidden" id="totalOrders" value="{{$totalOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cancel Orders : </th>
                                        <td>&nbsp;{{$cancelOrders}} <input type="hidden" id="cancelOrders" value="{{$cancelOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Return Orders : </th>
                                        <td>&nbsp;{{$returnOrders}} <input type="hidden" id="returnOrders" value="{{$returnOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pending Orders : </th>
                                        <td>&nbsp;{{$pendingOrders}} <input type="hidden" id="pendingOrders" value="{{$pendingOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Completed Orders : </th>
                                        <td>&nbsp;{{$completedOrders}} <input type="hidden" id="completedOrders" value="{{$completedOrders}}"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-dashboard-product-head-chart product-chart">
                        <h3>Product Order Progress Chart : -</h3>
                        <hr>
                        <div class="programming-stats">
                            <div class="order-details col-lg-3">
                                <table>
                                    <tr>
                                        <th scope="row">Total Orders : </th>
                                        <td>&nbsp;{{$totalOrders}} <input type="hidden" id="totalOrders" value="{{$totalOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cancel Orders : </th>
                                        <td>&nbsp;{{$cancelOrders}} <input type="hidden" id="cancelOrders" value="{{$cancelOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Return Orders : </th>
                                        <td>&nbsp;{{$returnOrders}} <input type="hidden" id="returnOrders" value="{{$returnOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pending Orders : </th>
                                        <td>&nbsp;{{$pendingOrders}} <input type="hidden" id="pendingOrders" value="{{$pendingOrders}}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Completed Orders : </th>
                                        <td>&nbsp;{{$completedOrders}} <input type="hidden" id="completedOrders" value="{{$completedOrders}}"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="chart-container col-lg-9">
                                <canvas class="product-graph"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" id="main" >
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')

<script src="{{ URL::asset('assets/js/chart.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/orderchart.js') }}"></script>

    <script language="JavaScript">
        displayLineChart();
        function displayLineChart() {
            var data = {
                labels: [
                    {!! $days !!}
                ],
                datasets: [
                    {
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            {!! $sales !!}
                        ]
                    }
                ]
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                responsive: true
            };
            var lineChart = new Chart(ctx).Line(data, options);
        }
        </script>
@stop