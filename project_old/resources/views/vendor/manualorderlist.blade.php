@extends('vendor.includes.master-vendor')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<style type="text/css">
    .dataTables_wrapper div.dataTables_processing {
        border: none;
    }

    .eye-btn{
        cursor: pointer;
    }

    #order_process_table tbody tr td, #order_table tbody tr td, #total_order_table tbody tr td, #ready_for_pickup_table tbody tr td, #in_transit_table tbody tr td, #delivered_table tbody tr td{
        padding: 15px 5px 15px 10px;
    }

    #order_process_table thead tr th, #order_table thead tr th, #order_table tfoot tr th, #order_process_table tfoot tr th, #total_order_table tfoot tr th, #total_order_table thead tr th, #ready_for_pickup_table thead tr th, #ready_for_pickup_table tfoot tr th, #in_transit_table tfoot tr th, #in_transit_table thead tr th, #delivered_table thead tr th, #delivered_table tfoot tr th{
        padding: 15px;
    }

    #order_process_table, #order_table, #total_order_table, #ready_for_pickup_table, #in_transit_table, #delivered_table{
        width: 100% !important;
    }

    a:hover,a:focus{
        outline: none;
        text-decoration: none;
    }

    .tab .nav-tabs{
        border: none;
        margin-bottom: 20px;
    }
    .tab .nav-tabs li a{
        padding: 10px 30px;
        margin-right: 5px;
        background: #cb5245;
        font-size: 1vw;
        font-weight: 700;
        color: #fff;
        border: 2px solid #cb5245;
        border-radius: 50px;
        overflow: hidden;
        z-index: 1;
        position: relative;
        transition: all 0.4s ease-in 0s;
    }

    @media(min-width:961px){

    .tab .nav-tabs li a{
        padding: 10px 41px;
        margin-right: 5px;
        background: #cb5245;
        font-size: 1vw;
        font-weight: 700;
        color: #fff;
        border: 2px solid #cb5245;
        border-radius: 50px;
        overflow: hidden;
        z-index: 1;
        position: relative;
        transition: all 0.4s ease-in 0s;
    } 



    }
    .tab .nav-tabs li a:hover{
        color: #cb5245;
        background: #fff;
        border: 2px solid #cb5245;
    }
    .tab .nav-tabs li.active a{
        color: #092c4f;
        border: 2px solid #092c4f;
    }
    .tab .nav-tabs li a:before{
        content: "";
        display: block;
        width: 220px;
        height: 200px;
        border-radius: 50%;
        background: #fff;
        margin-top: -100px;
        position: absolute;
        top: 50%;
        left: -50%;
        opacity: 0.3;
        z-index: -1;
        transform: scale(0);
        transition: all 0.4s ease-in 0.1s;
    }
    .tab .nav-tabs li a:hover:before,
    .tab .nav-tabs li.active a:before{
        opacity: 1;
        transform: scale(2);
    }
    .tab .tab-content{
        padding: 10px 15px;
        /*background: #cb5245;*/
        font-size: 15px;
        color: black;
        line-height: 30px;
        letter-spacing: 1px;
        border: 2px solid #092c4f;
        border-radius: 25px;
        /*outline: 5px solid #092c4f;*/
        outline-offset: 3px;
    }
    .tab .tab-content h3{
        font-size: 24px;
        margin-top: 0;
    }
    @media only screen and (max-width: 479px){
        .tab .nav-tabs li{
            width: 100%;
            text-align: center;
            margin-bottom: 15px;
        }
        .tab .nav-tabs li a:hover:before,
        .tab .nav-tabs li.active a:before{
            transform: scale(10);
        }
    }

    #example_processing{
        background: none;
        border: none;
    }

    #loader{
        display: flex;
        justify-content: center;
        background: transparent;
        position: fixed;
        cursor: wait;
        pointer-events: all;
        z-index: 99999999999;
        top: 50%;
        left: 50%;
        width: 100px !important;
        /* display:none; */
    }

    .load{
        cursor: wait !important;
    }

    :root {
        --hue: 223;
        --bg: hsl(var(--hue),90%,95%);
        --fg: hsl(var(--hue),90%,5%);
        --trans-dur: 0.3s;
        font-size: calc(16px + (24 - 16) * (100vw - 320px) / (1280 - 320));
    }

    .ip {
        width: 16em;
        height: 8em;
    }
    .ip__track {
        stroke: hsl(var(--hue),90%,90%);
        transition: stroke var(--trans-dur);
    }
    .ip__worm1,
    .ip__worm2 {
        animation: worm1 2s linear infinite;
    }

    .ip__worm2 {
        animation-name: worm2;
    }

    /* Dark theme */
    @media (prefers-color-scheme: dark) {
        :root {
            --bg: hsl(var(--hue),90%,5%);
            --fg: hsl(var(--hue),90%,95%);
        }
        .ip__track {
            stroke: hsl(var(--hue),90%,15%);
        }
    }

    /* Animation */
    @keyframes worm1 {
        from {
            stroke-dashoffset: 0;
        }
        50% {
            animation-timing-function: steps(1);
            stroke-dashoffset: -358;
        }
        50.01% {
            animation-timing-function: linear;
            stroke-dashoffset: 358;
        }
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes worm2 {
        from {
            stroke-dashoffset: 358;
        }
        50% {
            stroke-dashoffset: 0;
        }
        to {
            stroke-dashoffset: -358;
        }
    }
</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right" style="margin-right:49%;">
                       
                    </div>


                    <h3>Manual Orders</h3>
                    
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

                        <div class="col-md-12">
                            <div class="tab" role="tabpanel">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li onclick="totalOrderTabClick()" role="presentation" >
                                            <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Total Order <br>
                                                <div class="text-center">{{ \App\OrderedProducts::where('vendorid','=',Auth::guard('vendor')->user()->id)->get()->count() }}</div> 
                                            </a>
                                        </li>
                                        <li role="presentation" onclick="orderTabClick()" class="active">
                                            <a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Order <br> 
                                                <div id="pending_count" class="text-center">
                                                    {{ \App\OrderedProducts::where('status','pending')->where('vendorid','=',Auth::guard('vendor')->user()->id)->get()->count() }} 
                                                </div>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab" onclick="orderProcess()">Order Process <br> 
                                                <div id="order_process_count" class="text-center">{{ \App\OrderedProducts::where('vendorid','=',Auth::guard('vendor')->user()->id)->where('status','processing')->count() }}</div>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a onclick="readyForPickup()" href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Ready For Pickup <br> 
                                                <div id="ready_for_pickup_count" class="text-center">{{ \App\OrderedProducts::where('vendorid','=',Auth::guard('vendor')->user()->id)->where('status','picked')->count() }}</div>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a onclick="inTransit()" href="#Section5" aria-controls="messages" role="tab" data-toggle="tab">In Transit <br>
                                                <div id="in_transit_count" class="text-center"> {{ \App\OrderedProducts::where('vendorid','=',Auth::guard('vendor')->user()->id)->where('status','InTransit')->count() }}</div>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a onclick="deliveredTab()" href="#Section6" aria-controls="messages" role="tab" data-toggle="tab">Delivered <br> 
                                                <div id="completed_count" class="text-center">{{ \App\OrderedProducts::where('vendorid','=',Auth::guard('vendor')->user()->id)->where('status','completed')->count() }}</div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs">
                                        <div role="tabpanel" class="tab-pane fade " id="Section1">
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="total_order_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Order By</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Order By</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">Status</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>


                                        <div role="tabpanel" class="tab-pane fade in active" id="Section2">
                                            <div class="text-center">
                                                <a href="#" class="btn btn-success" id="acceptAllSelectedRecord">Accept Selected orders</a>
                                            </div>
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="order_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">
                                                        <!-- <input type="checkbox" id="chkCheckAll" /> -->
                                                        </th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px;width: 90px;">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">
                                                        <!-- <input type="checkbox" id="chkCheckAll" /> -->
                                                        </th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section3">
                                            <div class="text-center">
                                                <a href="#" class="btn btn-success" id="confirmAllSelectedRecord">Confirm Selected orders</a>
                                            </div>
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="order_process_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">
                                                            <!-- <input type="checkbox" id="concheckedaall" /> -->
                                                        </th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px; width: 90px;">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Accept Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px"></th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Accept Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section4">
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="ready_for_pickup_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Pickup Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Slip/Slot</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Pickup Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Slip/Slot</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section5">
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="in_transit_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Intransit Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Courier Boy</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Intransit Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Courier Boy</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section6">
                                            <table class="table-hover dt-responsive table-striped table-bordered" id="delivered_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Order Date</th>
                                                        <th class="text-center" style="font-size: 12px">Delivered Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Order Date</th>
                                                        <th class="text-center" style="font-size: 12px">Delivered Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">Cost</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                            </div>
                        </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <input type="hidden" class="shipping_cost_value" value="{{round($settings[0]->shipping_cost,2)}}">
    
    <div class="order_table_modal">
    </div>
    
    <div class="combine_order_table_modal">
    </div>
    
    <div class="parmeter_prescription">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Parmeter Prescription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">A Size</label>
                            <input style="width: 100%;" type="text" >
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">B Size</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">DBL</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">BVD</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">R-ED</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">L-ED</label>
                            <input style="width: 100%;" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">R-FITTING HEIGHT</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">L-FITTING HEIGHT</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">R-DIAMETER</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">L-DIAMETER</label>
                            <input style="width: 100%;" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">SHAPE CODE</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">PANTASCOPIC TINT</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">TEMPLE SIZE</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-3" style="font-size: 12px;">
                            <label for="">BOW ANGLE</label>
                            <input style="width: 100%;" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4" style="font-size: 12px;">
                            <label for="">FT- FULL/HALF/RIMLESS</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-4" style="font-size: 12px;">
                            <label for="">NEARWORK DISTANCE</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">FRAME FIT</label>
                            <input style="width: 100%;" type="text">
                        </div>
                        <div class="col-md-2" style="font-size: 12px;">
                            <label for="">MATERIALS</label>
                            <input style="width: 100%;" type="text">
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->


<!-- end model for booking slot -->

<!-- model for view booked date and time -->
    
    <div class="modal fade" id="pickupModelShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id:</b> </h4>
              </div>
              <div class="modal-body">
                <form method="post" id="CourierDetail">
                    <input type="hidden" value="intransit" id="status">
                    <input type="hidden" value="" id="pickuporderId">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <h3>Courier Boy Name</h3>
                    <div>
                      <label><input type="text" name="courier_boy" id="courier_boy"></label>
                    </div>
                    <hr>
                    <button onclick="courierID()" type="button" class="btn btn-success">Confirm Pickup</button>
                </form>
               
              </div>
              <div class="modal-footer">
                
              </div>
        </div>
      </div>
    </div>
    

<script src="{{URL::asset('assets/js/vendor/order/manualorderserversite.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- end model for view booked date and time -->



@stop

<script type="text/javascript">
    $(function () {
        $("a[class='Update']").click(function () {
            $("#MyPopup").modal("show");
            return false;
        });
    });
</script>

<script type="text/javascript">  
    function toggle(source) {
        checkboxes = document.getElementsByName('checkall');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    } 
    
    function togglenew(source) {
        checkboxes = document.getElementsByName('checkallnew');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    } 

    $(function(e){
        $(document).ready(function() {
            $("#acceptAllSelectedRecord").click(function(e){
                e.preventDefault();
                var allids = [];

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                if(allids.length <= 0){
                    alert("Please Select At Least One Order");
                    return false;
                }

                if (!confirm("Are you sure you want to Process this selected Order?")) return false;
                
                $.ajax({
                    type:"POST",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allids
                    },
                    success:function(response){
                        let {pending_total, processing_total} = response.data;
                        alert(response.msg);
                        order_table_datatable.ajax.reload(null, false);
                        $("#order_process_count").text(processing_total);
                        $("#pending_count").text(pending_total);
                    }
                });
            });
        });
    });

    $(function(e){
        $("#confirmAllSelectedRecord").click(function(e){
            e.preventDefault();
           
            var allidsnew = [];
            $("input:checkbox[name=idsnew]:checked").each(function(){
                allidsnew.push($(this).val());
            });

            if(allidsnew.length <= 0){
                alert("Please Select At Least One Order");
                return false;
            }

            if (!confirm("Are you sure you want to Process this selected Order?")) return false;

            $.ajax({
                url:"{{route('order.confirm')}}",
                type:"POST",
                data:{
                    _token:$("input[name=_token]").val(),
                    ids:allidsnew
                },
                success:function(response){
                    alert(response.msg);
                    order_process_datatable.ajax.reload(null, false);
                    let {processing_total, picked_total} = response.data;
                    $("#order_process_count").text(processing_total);
                    $("#ready_for_pickup_count").text(picked_total);
                }
            });

        });
    });
    
    function myfun(paravalue)
    {
        var backup  = document.body.innerHTML;
        var divcontent = document.getElementById(paravalue).innerHTML;
        document.body.innerHTML = divcontent;
        window.print();
        document.body.innerHTML = backup;
        setTimeout(function()
        {
            location.reload();
        }, 100);
    }
</script>
 
@section('footer')

@stop
