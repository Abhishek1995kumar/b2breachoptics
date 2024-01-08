@extends('admin.includes.master-admin')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style type="text/css">
    .content-box {
        background-color: #fafafb;
        box-shadow: 1px 4px 8px rgba(0,0,0,.15);
        transition: all .3s ease-in-out;
        padding: 10px;
        padding-bottom: 0;
        margin-top: 40px;
        margin-bottom: 10px;
        height: 250px;
    }
.content-box .finbyz-icon {
    height: 100px;
    width: 100px;
    display: inline;
}

</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                   <!--  <div class="pull-right">
                        <a href="{!! url('vendor/withdrawmoney') !!}" class="btn btn-primary btn-add"><i class="fa fa-download"></i> Withdraw Now</a>
                    </div> -->
                    <h3>Payment Overview</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>


                    <div class="container">
                        <div class="row">   
                            <div class="col-md-4 text-center" style="opacity: 1;">
                               <div class="content-box">
                                <h4 class="content-box-title text-left"><b>Order Value</b></h4>
                                <p class="content-box-sub text-left" >COD<a style="padding-left: 30%;"  id="showmenu"> ₹ {{$CODtotal}}</a></p>
                                <p class="content-box-sub text-left" >E-Payment <a  style="padding-left: 19%;" id="showmenu2"> ₹ {{$Onlinetotal}}</a></p>
                                <hr>
                                <p class="content-box-sub text-left">Total  <a style="padding-left: 30%;">₹ {{$OrderTotalCost}}</a></p>
                                <small class="text-left">When Order Receive Outstanding Amount Will Reflect Here</small>
                               </div>
                            </div>

                            <div class="col-md-4" style="opacity: 1;">
                                <div class="content-box">
                                <h4 class="content-box-title"><b>Cancel Order</b></h4>
                                <p class="content-box-sub text-left">Cancel COD <a style="padding-left: 30%;" id="showmenu3" >₹ {{$CancelCODOrdertotal}}</a> </p>
                                <p class="content-box-sub text-left">Cancel E-Payment <a style="padding-left: 19%;" id="showmenu4" >₹ {{$CanceOnlineOrdertotal}}</a> </p>
                                <hr>
                                <p class="content-box-sub text-left">Total - <a style="padding-left: 42%">₹ {{$CancelOrderTotalCost}}</a></p>
                                <small>Order Cancelled Before Dispatch Will Reflect here</small>
                                </div>
                            </div>

                            <div class="col-md-4" style="opacity: 1;">
                                <div class="content-box">
                                <h4 class="content-box-title"><b>Return Order</a></b></h4>
                                <p class="content-box-sub text-left">Return COD - <a id="showmenu5" style="padding-left: 30%;">₹ {{$ReturnCODOrdertotal}}</a> </p>
                                <p class="content-box-sub text-left">Return E-Payment - <a id="showmenu6" style="padding-left: 19%;">₹ {{$ReturnOnlineOrdertotal}}</a> </p>
                                <hr>
                                <p class="content-box-sub text-left">Total - <a style="padding-left: 44%;">₹ {{$ReturnOrderTotalCost}}</a></p>
                                <small>Order Cancelled After Dispatch Will Reflect here</small>
                                </div>
                            </div>

                            <div class="col-md-4" style="opacity: 1;">
                                <div class="content-box">
                                <h4 class="content-box-title"><b>Today's Settlement ( {{$todayDate}} {{$todayMonth}} )</a></b></h4>
                                <p class="content-box-sub text-left">COD - <a id="showmenu7" style="padding-left: 30%;">₹ {{$completedCODOrdertotal}}</a> </p>
                                <p class="content-box-sub text-left">E-Payment - <a id="showmenu8" style="padding-left: 19%;">₹ {{$completedOnlineOrdertotal}}</a> </p>
                                <hr>
                                <p class="content-box-sub text-left">Total - <a style="padding-left: 31%">₹ {{$completedOrderTotalCost}}</a></p>
                                <small>Payment Has Been Scheduled For Today's Settlement</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COD Pendings Orders List -->
                    <br><br>
                    <div class="demo1" style="display: none;">
                        <h3 id="tpost"><b>Orders Payment Method: COD</b><a style="padding-left: 100px;">Total Amount:₹ {{$CODtotal}}</a></h3><hr>
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($CODlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">SELL</td>
                                    <td class="text-center">₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/orderpayment/view/')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                   
                    <!-- End COD Pendings Orders List -->

                    <!-- Online Pendings Orders List -->
                    <br><br>
                   <div class="demo2" style="display: none;">
                        <hr>
                        <h3 id="tpostone"><b> Orders Payment Method: E-Payment </b><a style="padding-left: 100px;">Total Amount: ₹ {{$Onlinetotal}}</a></h3><hr>

                        <table class="table" id="tableone">
                            <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Onlinelist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">SELL</td>
                                    <td class="text-center">₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/orderpayment/view/')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                        </table>  
                   </div> 
                    <!-- End Online Pendings Orders List -->

                    <!-- Cancel COD Orders List  -->

                    <br><br>
                <div class="demo3" style="display: none;">
                    <hr>
                    <h3 id="tposttwo"><b>Cancel Orders Payment Method:COD</b><a style="padding-left: 100px;">Total Amount: ₹ {{$CancelCODOrdertotal}}</a></h3><hr>

                    <table class="table" id="tabletwo">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($CancelCODOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">Cancel</td>
                                    <td class="text-center">-₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/cancelpayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>   
                </div>
                    <!-- End Online Pendings Orders List -->

                    <!-- Cancel online Orders List -->

                    <br><br>
                <div class="demo4" style="display: none;">
                    <hr>
                    <h3 id="tpostthree"><b>Cancel Orders Payment Method:E-Payment</b><a style="padding-left: 100px;">Total Amount: ₹ {{$CanceOnlineOrdertotal}}</a></h3><hr>

                    <table class="table" id="tablethree">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($CancelOnlineOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">Cancel</td>
                                    <td class="text-center">-₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/cancelpayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>
                </div>
                    <!-- END Cancel online Orders List-->


                    <!-- return COD Orders List -->

                    <br><br>
                <div class="demo5" style="display: none;">
                    <hr>
                    <h3 id="tpostfour"><b>Return Orders Payment Method:COD</b><a style="padding-left: 100px;">Total Amount: ₹ {{$ReturnCODOrdertotal}}</a></h3><hr>

                    <table class="table" id="tablethree">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ReturnCODOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">Return</td>
                                    <td class="text-center">-₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/returnpayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>
                </div>
                    <!--end return COD Orders List-->


                    <!-- return online Orders List -->

                    <br><br>
                <div class="demo6" style="display: none;">
                    <hr>
                    <h3 id="tpostfive"><b> Return Orders Payment Method:E-Payment</b><a style="padding-left: 100px;">Total Amount: ₹ {{$ReturnOnlineOrdertotal}}</a></h3><hr>

                    <table class="table" id="tablethree">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ReturnOnlineOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">Return</td>
                                    <td class="text-center">-₹ {{$row->cost}}</td>
                                    <td class="text-center"><a href="{{url('admin/returnpayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>
                </div>
                    <!-- End return online Orders List-->


                     <!-- completed COD Orders List -->

                    <br><br>
                <div class="demo7" style="display: none;">
                    <hr>
                    <h3 id="tpostsix"><b>Completed Orders Payment Method:COD</b><a style="padding-left: 100px;">Total Amount: ₹ {{$completedCODOrdertotal}}</a></h3><hr>

                    <table class="table" id="tablethree">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">UTR NUMBER</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($completedCODOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">SALE</td>
                                    <td class="text-center">₹ {{$row->cost}}</td>
                                    <td class="text-center">123456789</td>
                                    <td class="text-center"><a href="{{url('admin/todaypayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>
                </div>
                    <!--end completed COD Orders List-->


                    <!-- completed online Orders List -->

                    <br><br>
                <div class="demo8" style="display: none;">
                    <hr>
                    <h3 id="tpostseven"><b>Completed Orders Payment Method:E-Payment</b><a style="padding-left: 100px;">Total Amount: ₹ {{$completedOnlineOrdertotal}}</a></h3><hr>

                    <table class="table" id="tablethree">
                        <thead>
                                <tr>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">DISCRIPTION</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">UTR NUMBER</th>
                                    <th class="text-center">ORDER DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($completedOnlineOrderlist as $row)
                                <tr>
                                    <td class="text-center">{{$row->order_number_new}}</td>
                                    <td class="text-center">{{$row->created_at}}</td>
                                    <td class="text-center">SALE</td>
                                    <td class="text-center">₹ {{$row->cost}}</td>
                                    <td class="text-center">123456789</td>
                                    <td class="text-center"><a href="{{url('admin/todaypayment/view')}}/{{$row->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                                   
                            </tbody>
                    </table>
                </div>
                    <!-- End completed online Orders List-->

               
                
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@stop

@section('footer')

@stop

<script>
  $(document).ready(function() {
    $('#table').DataTable();
});

  $(document).ready(function() {
    $('#tableone').DataTable();
} );

  $(document).ready(function() {
    $('#tabletwo').DataTable();
} );

  $(document).ready(function() {
    $('#tablethree').DataTable();
} );

$(document).ready(function() {
        $('#showmenu').click(function() {
		$(".demo1").css("display", "block");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");
               
        });
      });
  
$(document).ready(function() {
        $('#showmenu2').click(function() {
       	$(".demo1").css("display", "none");
		$(".demo2").css("display", "block");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");
        });
    });

$(document).ready(function() {
        $('#showmenu3').click(function() {
		$(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "block");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");
        });
    });

$(document).ready(function() {
        $('#showmenu4').click(function() {
        $(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "block");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");

        });
    });

$(document).ready(function() {
        $('#showmenu5').click(function() {
       	$(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "block");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");
        });
    });

$(document).ready(function() {
        $('#showmenu6').click(function() {
       	$(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "block");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "none");
        });
    });

$(document).ready(function() {
        $('#showmenu7').click(function() {
        $(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "block");
		$(".demo8").css("display", "none");
        });
    });

$(document).ready(function() {
        $('#showmenu8').click(function() {
        $(".demo1").css("display", "none");
		$(".demo2").css("display", "none");
		$(".demo3").css("display", "none");
		$(".demo4").css("display", "none");
		$(".demo5").css("display", "none");
		$(".demo6").css("display", "none");
		$(".demo7").css("display", "none");
		$(".demo8").css("display", "block");
        });
    });



 </script>