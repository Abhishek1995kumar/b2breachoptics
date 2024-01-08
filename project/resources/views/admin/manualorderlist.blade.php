@extends('admin.includes.master-admin')

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
                        <div class="col-md-3">
                          <select class="form-control" id="category">
                            <option value="">Select Category</option>
                            @foreach ($categoriesmanual as $categorymanuals)
                                @if(in_array($categorymanuals->id, $order_category_per))
                                    <option value="{!! $categorymanuals->id !!}">{!! $categorymanuals->name !!}
                                    </option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="tab" role="tabpanel">

                                    <ul class="nav nav-tabs" role="tablist">
                                        {{--  TO , OO , OP , RFP , IT , DELV  --}}
                                        <?php
                                            if(in_array('TO', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li onclick="totalOrderTabClick()" role="presentation" >
                                                <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Total Order <br>
                                                    <div class="text-center">{{ \App\OrderedProducts::get()->count() }}</div> 
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if(in_array('OO', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li role="presentation" onclick="orderTabClick()" class="active">
                                                <a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Order <br> 
                                                    <div id="pending_count" class="text-center">
                                                        {{ \App\OrderedProducts::where('status','pending')->count() }} 
                                                    </div>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if(in_array('OP', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li role="presentation">
                                                <a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab" onclick="orderProcess()">Order Process <br> 
                                                    <div id="order_process_count" class="text-center">{{ \App\OrderedProducts::where('status','processing')->count() }}</div>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if(in_array('RFP', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li role="presentation">
                                                <a onclick="readyForPickup()" href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Ready For Pickup <br> 
                                                    <div id="ready_for_pickup_count" class="text-center">{{ \App\OrderedProducts::where('status','picked')->count() }}</div>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if(in_array('IT', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li role="presentation">
                                                <a onclick="inTransit()" href="#Section5" aria-controls="messages" role="tab" data-toggle="tab">In Transit <br>
                                                    <div id="in_transit_count" class="text-center"> {{ \App\OrderedProducts::where('status','InTransit')->count() }}</div>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php
                                            if(in_array('DELV', explode(',', session()->get('role')['manual_orders']))) {
                                        ?>
                                            <li role="presentation">
                                                <a onclick="deliveredTab()" href="#Section6" aria-controls="messages" role="tab" data-toggle="tab">Delivered <br> 
                                                    <div id="completed_count" class="text-center">{{ \App\OrderedProducts::where('status','completed')->count() }}</div>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">Order By</th>
                                                        <th class="text-center" style="font-size: 12px">Entry By</th>
                                                        <th class="text-center" style="font-size: 12px">Status</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>


                                        <div role="tabpanel" class="tab-pane fade in active" id="Section2">
                                            <?php
                                                if(in_array('A', session()->get('role')['role_actions']['oo'])) {
                                                    ?>
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-success" id="acceptAllSelectedRecord">Accept Selected orders</a>
                                                </div>
                                                <?php
                                                }
                                            ?>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section3">
                                            <?php
                                                if(in_array('U', session()->get('role')['role_actions']['op'])) {
                                                    ?>
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-success" id="confirmAllSelectedRecord">Confirm Selected orders</a>
                                                </div>
                                                    <?php
                                                }
                                            ?>
                                            
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
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
                            <label for="">CORRIDOR</label>
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
    


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
<script src="{{ URL::asset('assets/js/admin/manualorderlist.js') }}"></script>   
<script type="text/javascript">

    var order_table_datatable;
    var order_process_datatable;
    var total_order_datatable;
    var ready_for_pickup_datatable;
    var in_transit_datatable;
    var delivered_datatable;
    $('#category').on('change', function() {
        var category_id = $(this).val();
        order_table_datatable = $('#order_table').DataTable(orderTableDataTableObject);
    });
    
    const loader = `<div id="preloader"> 
                        <div id="loader-img">
                            <div class="loading">
                                <div class="loading__letter">R</div>
                                <div class="loading__letter">E</div>
                                <div class="loading__letter">A</div>
                                <div class="loading__letter">C</div>
                                <div class="loading__letter">H</div>
                            </div>
                        </div>
                    </div>`;
                                                        
    
    var orderTableDataTableObject = {
        dom: 'lfrtip',
        'processing': true,
        "bDestroy": true,
        'serverSide': true,
        "bLengthChange": false,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        "createdRow": function(row, data, dataIndex) {
                $(row).attr("id", "sid"+data[1])
            },
        'ajax': {
            'url': "{{url('/admin/manualorders/get_order_details')}}",
            'method' : 'POST',
            'data': function(d) {
                d._token = "{{ csrf_token() }}";
                d.category_id = $('#category').val();
            },
        }
    }

    function orderTabClick(){
        $("#Section1").children().children('div').eq(1).html('');
    }

    function orderProcess(){
        $("#Section1").children().children('div').eq(1).html('');
        $("#Section2").children().children('div').eq(1).html('');
        order_process_datatable = $('#order_process_table').DataTable({
            dom: 'lfrtip',
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "bDestroy": true,
            "language": {
                "processing": loader
            },
            'responsive': true,
            'colReorder': true,
            "createdRow": function(row, data, dataIndex) {
                $(row).attr("id", "cid"+data[1])
            },
            'ajax': {
                'url': "{{url('/admin/manualorders/get_order_process_details')}}",
                'method' : 'POST',
                'data': function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.category_id = $('#category').val();
                },
            }
        });
    }

</script>
<!-- end model for view booked date and time -->



@stop


<script type="text/javascript">
   $(document).ready(function () {
        $('table#example').DataTable();
        $('pres-table#example');
    });
    
</script>
<script type="text/javascript">
    $(function () {
        $("a[class='Update']").click(function () {
            $("#MyPopup").modal("show");
            return false;
        });
    });
</script>


 
 <script>
  /*$('#btn_save').on('click', function() {
    var optionSelected = $('#courier_id').find("option:selected");
    var courier_id = optionSelected.val();
    alert(courier_id);

    $.ajax({
        type: "post",
        url: "{{url('create_order/')}}",
        data: {
            "_token": "{{ csrf_token() }}",
            id: courier_id,
            order_id: 
        }
        // data: $("#courier_id").val()
    })
    //   .done(function() {
    //     alert('im here');
    //   });
  }); */
  </script>


<script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
<script>
   function exportpickedTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

<script>
   function exportpendingTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

<script>
   function exportconfirmedTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

<script>
   function exportshippedTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

<script>
   function exportdeliveredTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

<script>
    function hit_api(id) {
        $.ajax({
            type:"post",
            url: "{{url('shipping/')}}",
            data : {"_token": "{{ csrf_token() }}",id},
            dataType: "JSON",
            success:function(resp) {
                // console.log(resp);
            }
        })
    }
</script>


<script type="text/javascript">
    
    $(document).ready(function() {
    $('table.table').DataTable();
} );

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
</script>


  <!-- accept all status -->



<script type="text/javascript">
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
                    url:"{{route('manualorder.accept')}}",
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

// confirm selected orders

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

    const fetch_order_details = (order_pro_id) => {
        return new Promise(function(resolve, reject) {
            
            $.ajax({
                url:"{{route('order_details_fetch')}}",
                type:"POST",
                data:{
                    _token:$("input[name=_token]").val(),
                    order_pro_id: order_pro_id
                },
                success:function(response){
                    if(response.status){
                        resolve(response.order_pro_details)
                    }else{
                        Swal.fire({
                            title: 'Message!',
                            text: response.msg,
                            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            confirmButtonText: 'OK',
                        })
                        reject(err);
                    }
                },
                error: function(err) {
                    reject(err) // Reject the promise and go to catch()
                }
            });
        });
    }

    const order_product_modal_show = (order_product_details_arr, order_pro_id) => {
        let order_product_details = order_product_details_arr[0];
       
        let first_row  = $(".parmeter_prescription").find(".modal-body .row:eq(0)");
        let second_row  = $(".parmeter_prescription").find(".modal-body .row:eq(1)");
        let third_row  = $(".parmeter_prescription").find(".modal-body .row:eq(2)");
        let four_row  = $(".parmeter_prescription").find(".modal-body .row:eq(3)");
       
        first_row.find(".col-md-2 input:eq(0)").val(order_product_details.a_size)
        first_row.find(".col-md-2 input:eq(1)").val(order_product_details.b_size)
        first_row.find(".col-md-2 input:eq(2)").val(order_product_details.dbl)
        first_row.find(".col-md-2 input:eq(3)").val(order_product_details.bvd)
        first_row.find(".col-md-2 input:eq(4)").val(order_product_details.r_ed)
        first_row.find(".col-md-2 input:eq(5)").val(order_product_details.l_ed)

        second_row.find(".col-md-3 input:eq(0)").val(order_product_details.r_fitting)
        second_row.find(".col-md-3 input:eq(1)").val(order_product_details.l_fitting)
        second_row.find(".col-md-3 input:eq(2)").val(order_product_details.r_dia)
        second_row.find(".col-md-3 input:eq(3)").val(order_product_details.l_dia)

        third_row.find(".col-md-3 input:eq(0)").val(order_product_details.shape_code)
        third_row.find(".col-md-3 input:eq(1)").val(order_product_details.pantascopic)
        third_row.find(".col-md-3 input:eq(2)").val(order_product_details.temple_size)
        third_row.find(".col-md-3 input:eq(3)").val(order_product_details.bow_angle)

        four_row.find(".col-md-4 input:eq(0)").val(order_product_details.frame_type)
        four_row.find(".col-md-4 input:eq(1)").val(order_product_details.network_distance)
        four_row.find(".col-md-2 input:eq(0)").val(order_product_details.frame_fit)
        four_row.find(".col-md-2 input:eq(1)").val(order_product_details.materials)
       
        let total = order_product_details.cost + 0 + <?php echo round($settings[0]->shipping_cost,2); ?>;
        let options = ` <div class="modal fade" id="${order_pro_id}_eye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: ${order_product_details.orderid}</b> </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <hr style="background-color: red;">
                                            <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                                            <div class="text-left col-md-6" style="padding-left: 10px;">
                                                <p> <b>Name:- </b> ${order_product_details.buyer_name}</p>
                                                <p> <b>Address:- </b>${order_product_details.buyer_address}</p>`;
                                                if(!order_product_details.cname){
                                                    options +=  `<p> <b>City:- </b>${order_product_details.buyer_city}</p>`; 
                                                }
                                                else{
                                                    options +=  `<p> <b>City:- </b>${order_product_details.cname}</p>`; 
                                                }
                                                
                                                if(!order_product_details.sname){
                                                    options +=  `<p> <b>State:- </b>${order_product_details.buyer_state}</p>`; 
                                                }
                                                else{
                                                    options +=  `<p> <b>State:- </b>${order_product_details.sname}</p>`; 
                                                }
                                    options +=  `<p> <b>Mobile No:- </b>${order_product_details.buyer_phone}</p> 
                                            </div>
                                            <div class="container text-right col-md-6" style="padding-left: 10px;">`;
                                            if(order_product_details.categoryID == 58){
                                    options +=  `<div>
                                                    <a data-toggle="modal" data-target="#exampleModal" href='javascript:void(0)' style='text-decoration:none;'  class='eye-btn' >Parameter &nbsp; <i class='fa fa-eye' style='font-size:15px' ></i></a>
                                                </div>`;
                                            }
                                options +=  `<table class="pres-table table-bordered" style="width:100%; outline: 3px;">
                                                    <thead>`;
                                                  
                                                        if(order_product_details.categoryID == 72){
                                                            if(order_product_details.presc_image === null){
                                                                if(order_product_details.lenstype == 'MultiFocal'){
                                                                    options += `<tr>
                                                                                    <th style="width:2%"scope="col"></th>
                                                                                    <th style="width:2%"scope="col"><center>Add Power</center></th>
                                                                                    <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                    <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                    <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                    <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                                </tr>`;
                                                                }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                    options += `<tr>
                                                                                    <th style="width:2%"scope="col"></th>
                                                                                    <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                    <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                    <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                    <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                                    <th style="width:2%"scope="col"><center>AXIS</center></th>
                                                                                    <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                                </tr>`;
                                                                }else{
                                                                    options += `<tr>
                                                                                    <th style="width:2%"scope="col"></th>
                                                                                    <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                    <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                    <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                    <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                                </tr>`;
                                                                }
                                                            }else{
                                                                options += `<tr>
                                                                            <th style="width:2%" scope="col"><center>IMAGE</center></th>
                                                                        </tr>`;
                                                                    }
                                                        }else if(order_product_details.categoryID == 58){
                                                            if(order_product_details.Lpower != null || order_product_details.rpower != null){
                                                                options += `<tr>
                                                                            <th style="width:2%"scope="col"></th>
                                                                            <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                            <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                            <th style="width:2%"scope="col"><center>AXIS</center></th>
                                                                            <th style="width:2%"scope="col"><center>Add Power</center></th>
                                                                            <th style="width:2%"scope="col"><center>PD</center></th>
                                                                        </tr>`;
                                                            }else{
                                                                options += `<tr>
                                                                            <th style="width:2%"scope="col"></th>
                                                                            <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                            <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                            <th style="width:2%"scope="col"><center>Axis</center></th>
                                                                            <th style="width:2%"scope="col"><center>PD</center></th>
                                                                        </tr>`;
                                                            }
                                                        }
                                                        options += `</thead>
                                                    <tbody>`;
                                                        if(order_product_details.categoryID == 72){
                                                            if(order_product_details.presc_image === null){
                                                                if(order_product_details.same_rx_both != null){
                                                                    if(order_product_details.lenstype == 'MultiFocal'){
                                                                        options +=  `<tr>
                                                                                    <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                    <td><center>${order_product_details.rpower}</center></td>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>`;
                                                                            if(order_product_details.lefteyequantity != null){
                                                                                options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                            }else if(order_product_details.righeyequantity != null){
                                                                                options += `<td><center>${order_product_details.righeyequantity}</center></td>`;
                                                                            }else if(order_product_details.botheyequantity != null){
                                                                                options += `<td><center>${order_product_details.botheyequantity}</center></td>`;
                                                                            }
                                                                        options += `</tr>`;
                                                                    }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                        options += `<tr>
                                                                                    <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>
                                                                                    <td><center>${order_product_details.rcyl}</center></td>
                                                                                    <td><center>${order_product_details.Raxis}</center></td>`;
                                                                        if(order_product_details.lefteyequantity != null){
                                                                            options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                        }else if(order_product_details.righeyequantity != null){
                                                                            options += `<td><center>${order_product_details.righeyequantity}</center></td>`;
                                                                        }else if(order_product_details.botheyequantity != null){
                                                                            options += `<td><center>${order_product_details.botheyequantity}</center></td>`;
                                                                        }
                                                                        options += `</tr>`;
                                                                    }else{
                                                                        options += `<tr>
                                                                                        <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                        <td><center>${order_product_details.rsphere}</center></td>
                                                                                        <td><center>${order_product_details.rbc}</center></td>
                                                                                        <td><center>${order_product_details.rdia}</center></td>`;
                                                                        if(order_product_details.lefteyequantity != null){
                                                                            options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                        }else if(order_product_details.righeyequantity != null){
                                                                            options += `<td><center> ${order_product_details.righeyequantity} </center></td>`;
                                                                        }else if(order_product_details.botheyequantity != null){
                                                                            options += `<td><center> ${order_product_details.botheyequantity} </center></td>`;
                                                                        }else if(order_product_details.quantity){
                                                                            options += `<td><center> ${order_product_details.quantity} </center></td>`;
                                                                        }
                                                                        options += `</tr>`;
                                                                    }
                                                                }else{
                                                                    if(order_product_details.lenstype == 'MultiFocal'){
                                                                        options += `<tr>
                                                                                        <th style="width:2%" scope="row">Right(OD)</th>
                                                                                        <td><center>${order_product_details.rpower}</center></td>
                                                                                        <td><center>${order_product_details.rsphere}</center></td>
                                                                                        <td><center>${order_product_details.rbc}</center></td>
                                                                                        <td><center>${order_product_details.rdia}</center></td>
                                                                                        <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Left(OS)</th>
                                                                                        <td><center>${order_product_details.Lpower}</center></td>
                                                                                        <td><center>${order_product_details.Lsphere}</center></td>
                                                                                        <td><center>${order_product_details.LBc}</center></td>
                                                                                        <td><center>${order_product_details.LDia}</center></td>
                                                                                        <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                    </tr>`;
                                                                    }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                        options += `<tr>
                                                                                        <th style="width:2%" scope="row">Right(OD)</th>
                                                                                        <td><center>${order_product_details.rsphere}</center></td>
                                                                                        <td><center>${order_product_details.rbc}</center></td>
                                                                                        <td><center>${order_product_details.rdia}</center></td>
                                                                                        <td><center>${order_product_details.rcyl}</center></td>
                                                                                        <td><center>${order_product_details.Raxis}</center></td>
                                                                                        <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Left(OS)</th>
                                                                                        <td><center>${order_product_details.Lsphere}</center></td>
                                                                                        <td><center>${order_product_details.LBc}</center></td>
                                                                                        <td><center>${order_product_details.LDia}</center></td>
                                                                                        <td><center>${order_product_details.Lcyle}</center></td>
                                                                                        <td><center>${order_product_details.Laxis}</center></td>
                                                                                        <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                    </tr>`;
                                                                    }else{
                                                                        options += `<tr>
                                                                                        <th style="width:2%" scope="row">Right(OD)</th>
                                                                                        <td><center>${order_product_details.rsphere}</center></td>
                                                                                        <td><center>${order_product_details.rbc}</center></td>
                                                                                        <td><center>${order_product_details.rdia}</center></td>
                                                                                        <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <th scope="row">Left(OS)</th>
                                                                                        <td><center>${order_product_details.Lsphere}</center></td>
                                                                                        <td><center>${order_product_details.LBc}</center></td>
                                                                                        <td><center>${order_product_details.LDia}</center></td>
                                                                                        <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                    </tr>`;
                                                                    }
                                                                }
                                                            }else{
                                                    options += `<tr>
                                                                    <td>
                                                                        <center style="padding: 5px 5px;">
                                                                            <a  href="<?php echo asset('assets/prescription'); ?><?php echo "/";?>${order_product_details.presc_image}" target="_blank">
                                                                                <img src="<?php echo asset('assets/prescription'); ?><?php echo "/";?>${order_product_details.presc_image}" alt="" width="150" height="100">
                                                                            </a></center>
                                                                    </td>
                                                                </tr>`;
                                                            }
                                                        }else if(order_product_details.categoryID == 58){
                                                            if(order_product_details.Lpower != null || order_product_details.rpower != null){
                                                options +=     `<tr>
                                                                    <th style="width:2%" scope="row">RE</th>
                                                                    <td><center>${order_product_details.rsphere != null ? order_product_details.rsphere : '--'}</center></td>
                                                                    <td><center>${order_product_details.rcyl != null ? order_product_details.rcyl : '--'}</center></td>
                                                                    <td><center>${order_product_details.Raxis != null ? order_product_details.Raxis : '--'}</center></td>
                                                                    <td><center>${order_product_details.rpower != null ? order_product_details.rpower : '--'}</center></td>
                                                                    <td><center>${order_product_details.Repd != null ? order_product_details.Repd : '--'}</center></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:2%" scope="row">LE</th>
                                                                    <td><center>${order_product_details.Lsphere != null ? order_product_details.Lsphere : '--'}</center></td>
                                                                    <td><center>${order_product_details.Lcyle != null ? order_product_details.Lcyle : '--'}</center></td>
                                                                    <td><center>${order_product_details.Laxis != null ? order_product_details.Laxis : '--'}</center></td>
                                                                    <td><center>${order_product_details.Lpower != null ? order_product_details.Lpower : '--'}</center></td>
                                                                    <td><center>${order_product_details.Lepd != null ? order_product_details.Lepd : '--'}</center></td>
                                                                </tr>`;
                                                            }else{
                                                    options += `<tr>
                                                                    <th style="width:2%" scope="row">RE</th>
                                                                    <td><center>${order_product_details.rsphere != null ? order_product_details.rsphere : '--'}</center></td>
                                                                    <td><center>${order_product_details.rcyl != null ? order_product_details.rcyl : '--'}</center></td>
                                                                    <td><center>${order_product_details.Raxis != null ? order_product_details.Raxis : '--'}</center></td>
                                                                    <td><center>${order_product_details.Repd != null ? order_product_details.Repd : '--'}</center></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:2%" scope="row">LE</th>
                                                                    <td><center>${order_product_details.Lsphere != null ? order_product_details.Lsphere : '--'}</center></td>
                                                                    <td><center>${order_product_details.Lcyle != null ? order_product_details.Lcyle : '--'}</center></td>
                                                                    <td><center>${order_product_details.Laxis != null ? order_product_details.Laxis : '--'}</center></td>
                                                                    <td><center>${order_product_details.Lepd != null ? order_product_details.Lepd : '--'}</center></td>
                                                                </tr>`;
                                                            }
                                                        }
                                                       
                                        options += `</tbody>
                                                </table>
                                            </div>
                                            <hr style="background-color: red;">
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3">`;
                                            if(order_product_details.maincolor != order_product_details.color){
                                                options += `<img width="200px" height="200px" src="<?php echo asset('assets/images/product_attr')."/"; ?>${order_product_details.product_image}" />`;
                                            }
                                            else{
                                                options += `<img width="200px" height="200px" src="<?php echo asset('assets/images/products')."/"; ?>${order_product_details.product_image}" />`;
                                            }
                            options += `</div>
                                        <div class="col-md-3">
                                            <h5><b>Order Details:</b></h5>
                                            <p> <b>Product SKU:- </b> ${order_product_details.product_sku}</p>
                                            <p> <b>Order Id:-</b> ${order_product_details.orderid}</p>
                                            <p> <b>Product Name:-</b> ${order_product_details.product_title}</p>`;
                                            if(order_product_details.color){
                                                options += `<p> <b>Product Color:-</b> ${order_product_details.color} - ${order_product_details.colorcode != null ? order_product_details.colorcode : ''}</p>`;
                                            }
                                            if(order_product_details.size){
                                                options += `<p> <b>Product Size:-</b> ${order_product_details.size}</p>`;
                                            }
                                            if(order_product_details.order_note){
                                                options += `<p> <b>Order Note :-</b> ${order_product_details.order_note}</p>`;
                                            }
                            options += `</div>
                                        <div class="col-md-3">
                                                <h5><b>Order Summary:</b></h5>
                                                <p> <b>Order Date:-</b> ${order_product_details.created_at}</p>
                                                <p> <b>Dispatch Date:-</b> ${order_product_details.updated_at}</p>
                                                <p> <b>Deliver Date:-</b> ${order_product_details.created_at}</p>`;
                                                if(order_product_details.buyer_order_id){
                                                    options += `<p><b>Buyer Order ID:-</b> ${order_product_details.buyer_order_id}</p>`;
                                                }
                                                if(order_product_details.seller_order_id){
                                                    options += `<p><b>Seller Order ID:-</b> ${order_product_details.seller_order_id}</p>`;
                                                }
                            options += `</div>
                                        <div class="col-md-3">
                                            <h5><b>Bill Details:</b></h5>
                                            <p> <b>Product QTY :-</b> ${order_product_details.quantity}</p>
                                            <p> <b>Unit Price :-</b> ${order_product_details.cost}</p>
                                            <p> <b>Gst Amount :-</b> ${order_product_details.gstAmount}</p>
                                            <p> <b>Coupon Discount :-</b> ${order_product_details.couponAmount != "" ? order_product_details.couponAmount : "0"}</p>
                                            <p> <b>Shipping Charges :-</b> <?php echo round($settings[0]->shipping_cost,2); ?></p>
                                            <hr>
                                            <p> <b>Total :-</b> ${(Number(order_product_details.quantity * order_product_details.cost) + Number(order_product_details.gstAmount)).toFixed(2)} </p>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>`;

        $(".order_table_modal").append(options);
        $('#'+order_pro_id+'_eye').modal();
    }
    
    // Start Here
    const combine_order_modal_show = (combine_order_details_arr, order_pro_id) => {
        let combine_order_details = combine_order_details_arr;
        let total = combine_order_details.cost + 5 + <?php echo round($settings[0]->shipping_cost,2); ?>;
        let options = `<div class="modal fade" id="${order_pro_id}_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="closeInvoice('${combine_order_details[0].status}')" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="print_invoice">
                        <div class="container" style="width: auto; width: auto;border: 1px solid black;padding: 0;padding-bottom: 20px;">
                            <div style="text-align: center;background-color: red;padding-top: 6px;padding-bottom: 8px;color: white;font-size: 17px; border-bottom: 1px solid black;">TAX INVOICE</div>
                                <div style="display:flex;border-bottom: 1px solid black;">
                                    <div style="width: 50%; padding:15px;line-height: 22px;padding-top: 6%;">
                                        <div style="">Elrica Global Enterprises PVT LTD</div>
                                        <div style="">102 Vinayak Chember,Near Waman Hari Pethe, Naupada Road, Thane West. Pin-400602.</div>
                                        <div style=" "><h7 style="font-weight:550;">Phone:-</h7>7700044084</div>
                                        <div style=" "><h7 style="font-weight:550;">Email ID:-</h7>support@elricaglobal.in </div>
                                    </div>
                                    <div style="width: 67%; margin-left: 10%;line-height: 25px;border-left: 1px solid black;">
                                        <div style="border-bottom:1px solid black">
                                            <div style="display: flex;justify-content: center;">
                                                <img src="{{url('/assets/images/new_invoice.png')}}" style="padding-bottom: 6px; width:61%;">
                                            </div>
                                        </div>
                                        <div style="display: flex;">
                                            <div style="width: 50%; height: 50%;" class="inv_details">
                                                <div style="border-bottom: 1px solid black;text-align: center;border-right: 1px solid black;">
                                                    <h7 style="font-weight:550;">Invoice No</h7>
                                                </div>
                                                <div style="border-bottom: 1px solid black;text-align: center;border-right: 1px solid black;">
                                                    <h7 style="">${combine_order_details[0].invoice_number}</h7>
                                                </div>
                                            </div>
                                            <div style="width: 50%;height: 50%;" class="inv_details">
                                                <div style="border-bottom: 1px solid black;text-align: center;">
                                                    <h7 style="font-weight:550;">Invoice Date</h7>
                                                </div>
                                                <div style="border-bottom: 1px solid black;text-align: center;">
                                                    <h7 style="">${combine_order_details[0].order_accept_date.split(' ')[0]}</h7>
                                                </div>  
                                           </div>
                                        </div>    
                                        <div style="border-bottom: 1px solid black;display: flex;justify-content: center;padding-right: 45%;">
                                            <span><h7 style="font-weight:550;">Order Id:-</h7>   ${combine_order_details[0].orderid}</span>
                                        </div>
                                      
                                        <div style="display: flex;justify-content: center;padding-right: 0%;">
                                            <h7 style="font-size: 119%;font-weight: 700;">27AAFCE6495B1ZK</h7>
                                        </div>
                                        <div style="display: flex;justify-content: center;padding-right: 0%;">
                                           <h7 style="font-size: 13px;font-weight: 900;">(MAHARASHTRA)</h7>
                                        </div>      
                                    </div>
                                </div>
                                <div style="display:flex;">
                                    <div style="width: 50%; padding:15px;line-height: 16px;">
                                        <h5><b style="">Billing Address</b></h5>`;
                                        if(combine_order_details[0].bussiness_name){
                                            options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>`;
                                        }
                                        else {
                                            options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7></div>`;
                                        }
                                        options += `<div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2 != null ? combine_order_details[0].buyer_address2 : ''}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>
                                    </div>
                                    <div style="width: 54%; margin-left: 13px;padding:15px;line-height: 18px;border-left: 1px solid black;">
                                        <h5 style=""><b>Shipping Address</b></h5>`;
                                        
                                            if(combine_order_details[0].shipping_address != null)
                                            {
                                                options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].shipping_name}</div>`;
                                                
                                                options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_address}.${combine_order_details[0].shipping_address2 != null ? combine_order_details[0].shipping_address2 : ''}</div>`
                                                
                                                
                                                if(combine_order_details[0].shipping_city != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">City:-</h7>${combine_order_details[0].Ship_city}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">City:-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_state != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">State:-</h7>${combine_order_details[0].Ship_state}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">State:-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_zip != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Pin :-</h7>${combine_order_details[0].shipping_zip}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Pin :-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_phone != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].shipping_phone}</div>`
                                                }else{
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>NA</div>`
                                                }
                                            }
                                            else
                                            {
                                            options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2 != null ? combine_order_details[0].buyer_address2 : ''}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>`;
                                            }
                                           options += `<div style=""><h7 style="font-weight:550;">Email ID:-</h7>${combine_order_details[0].cus_email}</div>
                                    </div>
                                </div>
                               
                                <div style="display:flex; overflow-y:auto;border-top:1px solid black;" >
                                    <table  id="invoice_table" style="height:46px; width: 100%; border-collapse: collapse; border-style: solid;" border="1">
                                        <thead style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                            <tr style="background-color: red;color: white;text-align: center;">
                                                <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">SrNo</th>
                                                <th style="width: 40%;text-align: center; font-size: 9px;border-left: 1px solid black;">DESCRIPTION OF GOODS</th>
                                                <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">Model No</th>
                                                <th style="width: 8%;text-align: center; font-size: 9px;border-left: 1px solid black;">HSN Code</th>
                                                <th style="width: 8%;text-align: center; font-size: 9px;border-left: 1px solid black;">Color Code</th>
                                                <th style="width: 7%;text-align: center; font-size: 9px;border-left: 1px solid black;">Rate</th>
                                                <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">Qty</th>`;
                                                if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state == "22"){
                                                    options += `<th style="width: 6%;text-align: center;font-size: 8px;border-left: 1px solid black;">CGST%</th>
                                                        <th style="width: 6%;text-align: center;font-size: 8px;border-right: 1px solid black;">SGST%</th>`;
                                                }else{
                                                    options += `<th style="width: 6%;text-align: center; font-size: 8px;border-left: 1px solid black;border-right: 1px solid black;">IGST%</th>`;
                                                }
                                                options += `<th style="width: 7%;text-align: center; font-size: 8px;border-right: 1px solid black;">GST Amount</th>
                                                <th style="width: 28%;text-align: center; font-size: 8px;border-right: 1px solid black;">Disc.(%)</th>
                                                <th style="width: 28%;text-align: center; font-size: 8px;border-right: 1px solid black;">Total Amount(Rs)</th>
                                            </tr>
                                        </thead>
                                        <tbody border="0" class="invoice_list">`;
                                            for (let i=0; i <combine_order_details.length; i++ ){
                                            let id = i + 1;
                                            options += `<tr style="height:30px;border-bottom: 1px solid black;">
                                                <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${id}</td>
                                                <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].product_title}</td>`;
                                                if(combine_order_details[i].modelno){
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].modelno != '' ? combine_order_details[i].modelno : '--' }</td>`;
                                                }
                                                else{
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">--</td>`;
                                                }
                                    options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].hsn_code}</td>
                                                <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].colorcode != null ? combine_order_details[i].colorcode : '--'}</td>
                                                <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].cost_price}</td>
                                                <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].quantity}</td>`
                                                if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state  == "22"){
                                                    if(combine_order_details[i].categoryID == 63 || combine_order_details[i].categoryID == 53 || combine_order_details[i].categoryID == 72 || combine_order_details[i].categoryID == 58 || combine_order_details[i].categoryID == 87){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                            ${((combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(1+(combine_order_details[i].tax/100))).toFixed(2)*(1-(combine_order_details[i].invoice_discount/100))).toFixed(2)}
                                                        </td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                            ${((combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(1+(combine_order_details[i].tax1/100))).toFixed(2)*(1-(combine_order_details[i].invoice_discount/100))).toFixed(2)}
                                                        </td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                            ${((combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(1+(combine_order_details[i].tax1/100))).toFixed(2)*(1-(combine_order_details[i].invoice_discount/100))).toFixed(2)}
                                                        </td>`
                                                    }
                                                }else{
                                                    if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                        options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                            ${((combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(1+(combine_order_details[i].tax1/100))).toFixed(2)*(1-(combine_order_details[i].invoice_discount/100))).toFixed(2)}
                                                        </td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                            ${((combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(1+(combine_order_details[i].tax1/100))).toFixed(2)*(1-(combine_order_details[i].invoice_discount/100))).toFixed(2)}
                                                        </td>`
                                                    }
                                                    else{
                                                        options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].gstAmount}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].invoice_discount ? combine_order_details[i].invoice_discount : '-'}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price+combine_order_details[i].gstAmount).toFixed(2)}</td>`
                                                    }
                                                }
                                                options +=`
                                            </tr>`;
                                        }    
                                        options += `</tbody>
                                    </table> 
                                </div>
                                <div style="background-color:red; color:white; border: 1px solid black;">
                                    <div style="font-size:9px;margin-left:25px;margin-top:5px;"><b>Total Taxable Value</b></div>
                                    <div id="show_total" style="margin-left: 90%;margin-top:-17px;"></div>
                                </div>
                                <div style="display:flex;">
                                    <div style="padding-left: 11px;width:50%;font-size: 9px; padding-top: 9px;"><b>E.&O.E</b></div>
                                </div>
                                <div style="display:flex;">
                                    <div style="width:49%;margin-left: 7px;font-size: 7px;padding:3px;"><b style="font-size: 9px;">Declaration:-</b>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</div>
                                    <div style="margin-left: 132px;">Elrica Global Enterprises PVT LTD</div><br>
                                </div>
                                <div style="display:flex;">
                                    <div style="width: 50%;">
                                        <div style="margin-left: 7px;">Terms and Conditions</div>
                                        <div style="margin-left: 50px;font-size: 7px;">1 Total Payment Due in 90 Days.</div>
                                        <div style="margin-left: 50px;font-size: 7px;">2 Please include the Invoice No. on your Cheque.</div>
                                        <br><br>
                                        <div>This is an electronically generated receipt no signature is required</div>
                                    </div>
                                    <div style="width: 50%;">
                                        <br><br><br><br>
                                        <div style="margin-left: 210px;">Authorised Signatory</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default cancel" data-dismiss="modal" >Cancel</button>
                            <button type="button" class="btn btn-primary" id="" onclick="myfun('print_invoice')">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $(".combine_order_table_modal").append(options);
        let total_tr = 10;
        let append_tr = total_tr - combine_order_details.length;
       
        if(combine_order_details.length > 14 && combine_order_details.length <= 18){
        for(let i=0; i < 4; i++ )
        {
            $('#invoice_table tbody').append(`<tr style="height:30px;border: none;">
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                                <td style="text-align: center;font-size: 9px;"></td>
                                            </tr>`)
        }
        }
        for(let i=0; i < append_tr; i++ )
        {
            $('#invoice_table tbody').append(`<tr style="height:30px;">
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                                <td style="text-align: center;font-size: 9px; border: none;"></td>
                                            </tr>`)
        }

        $('#'+order_pro_id+'_pdf').modal();
    }
    // End Here

    async function checkEyesOrder(order_pro_id){
        $(".order_table_modal").html('');
        try {
            let result = await fetch_order_details(order_pro_id);
            result.length > 0 && order_product_modal_show(result, order_pro_id);
        } catch (error) {
            Swal.fire({
                title: 'Message!',
                text: error,
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                confirmButtonText: 'OK',
            })
        }

        // fetch_order_details(order_pro_id).then(data => {
        //     order_product_modal_show(data, order_pro_id);
        // }).catch(e => {
        //     console.log(e);
        // })
    }
    // start Here
    
    async function view_combine_order(order_pro_id,order_id, invoice, e)
    {
        $(".combine_order_table_modal").html('');
        status = $(e.target.parentElement).attr('data-status');
        try {
            let result = await combine_order_details(order_pro_id, order_id, invoice, status);
            result.length > 0 && combine_order_modal_show(result, order_pro_id);
            console.log(result)
            let total_order_amt = 0;
             $("#invoice_table > tbody > tr").each(function(index, value){
                 
                 let total_amount = parseFloat($(this).find(':last-child').text());
                 console.log(total_amount)
                 if(total_amount){
                     total_order_amt = total_order_amt + total_amount;
                 }
             })
             $("#show_total").text((total_order_amt).toFixed(2));
        } catch (error) {
            alert(error);
        }
    }
    
    const combine_order_details = (order_pro_id, order_id, invoice, status) => {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:"{{route('combine_details_fetch')}}",
                type:"POST",
                data:{
                    _token:$("input[name=_token]").val(),
                    order_pro_id: order_pro_id,
                    order_id: order_id,
                    invoice: invoice,
                    status: status
                },
                success:function(response){
                    if(response.status){
                        resolve(response.order_details)
                    }else{
                        Swal.fire({
                            title: 'Message!',
                            text: response.msg,
                            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            confirmButtonText: 'OK',
                        })
                        reject(err);
                    }
                },
                error: function(err) {
                    reject(err) 
                }
            });
        });
    }
    // ENd Here
    function closeInvoice(status){
        if(status == "processing")
        {
            $('#order_process_table').DataTable().ajax.reload();
        }
        else if(status == "completed")
        {
            $('#delivered_table').DataTable().ajax.reload();
        }
    }
    
    async function orderAcceptAndReject(id, e){
        if(!$(e.target).parent().attr('action')){
            return false;
        }

        if($(e.target).parent().attr('action') == 'processing'){
            if (!confirm("Are you sure you want to Process this Order?")) return false;
        }else if($(e.target).parent().attr('action') == 'cancelled'){
            if (!confirm("Are you sure you want to Cancel this Order?")) return false;
        }
         
        let current_order_status = $(e.target).parent().attr('action');

        try {
            let result = await order_status_update(id, current_order_status);
            if(result.status){
                let {pending_total, processing_total} = result.data;
                order_table_datatable.ajax.reload(null, false);
                $("#order_process_count").text(processing_total);
                $("#pending_count").text(pending_total);
            }
        } catch (error) {
            alert(error)
        }
    }

    async function orderConfirm(id, e){
        console.log(id)
        // if (!confirm("Are you sure you want to Process this Order?")) return false;

        try {
            let result = await order_status_update(id, $(e.target).attr('action'));
            if(result.status) {
                let {picked_total, processing_total} = result.data;
                order_process_datatable.ajax.reload(null, false);
                $("#order_process_count").text(processing_total);
                $("#ready_for_pickup_count").text(picked_total);
            }
        } catch (error) {
            alert(error);
        }
    }

    const order_status_update = (id, current_order_status) => {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:"{{route('status')}}",
                type:"POST",
                data:{
                    _token:$("input[name=_token]").val(),
                    id: id,
                    status: current_order_status
                },
                success:function(response){
                    Swal.fire({
                        title: 'Message!',
                        text: response.msg,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            resolve(response);
                        }
                    });
                },
                error: function(err) {
                    reject(err) // Reject the promise and go to catch()
                }
            });
        })
        
    }

    function totalOrderTabClick(){
        total_order_datatable = $('#total_order_table').DataTable({
            dom: 'lfrtip',
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "bDestroy": true,
            "language": {
                "processing": loader
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': "{{url('/admin/manualorders/get_total_order_details')}}",
                'method' : 'POST',
                'data': function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.category_id = $('#category').val();
                },
            }
        });
    }

    function readyForPickup(){
        $("#Section1").children().children('div').eq(1).html('');
        $("#Section2").children().children('div').eq(1).html('');
        $("#Section3").children().children('div').eq(1).html('');
        ready_for_pickup_datatable = $('#ready_for_pickup_table').DataTable({
            dom: 'lfrtip',
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "bDestroy": true,
            "language": {
                "processing": loader
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': "{{url('/admin/manualorders/get_ready_for_pickup_details')}}",
                'method' : 'POST',
                'data': function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.category_id = $('#category').val();
                },
            }
        });
    }

    function inTransit(){
        $("#Section1").children().children('div').eq(1).html('');
        $("#Section2").children().children('div').eq(1).html('');
        $("#Section3").children().children('div').eq(1).html('');
        $("#Section4").children().children('div').eq(1).html('');
        in_transit_datatable = $('#in_transit_table').DataTable({
            dom: 'lfrtip',
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "bDestroy": true,
            "language": {
                "processing": loader
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': "{{url('/admin/manualorders/get_in_transit_details')}}",
                'method' : 'POST',
                'data': function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.category_id = $('#category').val();
                },
            }
        });
    }

    async function orderDelivered(id, e){
        if (!confirm("Are you sure you want to Delivered this Order?")) return false;
        try {
            let result = await order_status_update(id, $(e.target).attr('action'));
            if(result.status){
                in_transit_datatable.ajax.reload(null, false)
                let {intransit_total, completed_total} = result.data;
                $("#in_transit_count").text(intransit_total);
                $("#completed_count").text(completed_total);
            }
        } catch (error) {
            alert(error);
        }
    }

    function deliveredTab(){
        $("#Section1").children().children('div').eq(1).html('');
        $("#Section2").children().children('div').eq(1).html('');
        $("#Section3").children().children('div').eq(1).html('');
        $("#Section4").children().children('div').eq(1).html('');
        $("#Section5").children().children('div').eq(1).html('');
        delivered_datatable = $('#delivered_table').DataTable({
            dom: 'lfrtip',
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "bDestroy": true,
            "language": {
                "processing": loader
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': "{{url('/admin/manualorders/get_delivered_details')}}",
                'method' : 'POST',
                'data': function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.category_id = $('#category').val();
                },
            }
        });
    }
    
    function invoiceDowload()
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Create Invoice Number First...',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
    }

  </script>
<script>
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
  
  function alertmassege()
  {
    Swal.fire({
        title: 'Message!',
        text: 'Please Click on (Print Icon) for Generating Invoice',
        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
  }
  

</script>
 <!-- end of accept all status -->
 
@section('footer')

@stop
