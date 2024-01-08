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

</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
             
               
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right" style="margin-right:49%;">
                       <!--  <form method="POST" action="{{route('search')}}">
                            {!! csrf_field() !!}
                          <div class="col-sm-12">
                            <div class="col-md-5">
                              <input type="date" name="fromdate" id="fromdate" class="form-control"> 
                            </div>
                            <div class="col-md-5">
                              <input type="date" name="todate" id="todate" class="form-control">
                            </div>
                            <div class="col-md-2">
                              <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </div>
                        </div>
                        </form> -->

                        <!-- <span><span style="background-color: lightgreen;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Completed</span>
                        <span><span style="background-color: #d9edf7;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Processing</span> -->
                    </div>


                    <h3>Orders</h3>
                    
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
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12">

                            <div class="tab" role="tabpanel">

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">All Order<br><div class="text-center">{{ \App\Order::all()->count() }}</div> </a></li>
                                        <li role="presentation" class="active"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Order <br> <div class="text-center">{{ \App\OrderedProducts::where('status','pending')->count() }} </div></a></li>
                                        <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Order Process<br> <div class="text-center">{{ \App\OrderedProducts::where('status','processing')->count() }}</div></a></li>
                                        <li role="presentation"><a href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Ready For Pickup<br> <div class="text-center">{{ \App\OrderedProducts::where('status','picked')->count() }}</div></a></li>
                                        <li role="presentation"><a href="#Section5" aria-controls="messages" role="tab" data-toggle="tab">In Transit<br><div class="text-center">{{ DB::table('api_temp_resp')->where('status', '!=', 'cancelled')->where('status', '!=', 'completed')->where('status', '!=', 'NEW')->count() }}</div></a></li>
                                        <!--<li role="presentation"><a href="#Section6" aria-controls="messages" role="tab" data-toggle="tab">Pickups<br><div class="text-center"> {{ \App\OrderedProducts::where('status','InTransit')->count() }}</div></a></li>-->
                                        <li role="presentation"><a href="#Section7" aria-controls="messages" role="tab" data-toggle="tab">Delivered <br> <div class="text-center">{{ \App\OrderedProducts::where('status','completed')->count() }}</div></a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs">
                                        <div role="tabpanel" class="tab-pane fade " id="Section1">
                                            <table class="table" id="tableone">
                                                
                                                
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="text-center" style="font-size: 12px">Check All {!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!} <input type="checkbox" id="select-all" name=""></th> -->
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                         <th class="text-center" style="font-size: 12px">View</th>
                                                        <!--<th class="text-center" style="font-size: 12px">Action</th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($totalorders as $row)
                                                        <tr>
                                                            <!-- <td class="text-center" style="font-size: 15px;"><input type="checkbox" name="checkall"></td> -->
                                                            <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                            @if($row->vendorname == '')
                                                            <td class="text-center" style="font-size: 15px;">REACH</td>
                                                            @else
                                                            <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                            @endif
                                                            <!-- <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                            <td>
                                                               <div class="pull-left">
                                                                  <a href="orders/status/{{$row->id}}/processing" class="btn btn-xs btn-success"><i class="fa fa-check-square" style="font-size:15px"></i></a> 
                                                               </div> 
    
                                                               <div class="pull-right">
                                                                   <a href="orders/status/{{$row->id}}/processing" class="btn btn-xs btn-danger"><i class="fa fa-close" style="font-size:15px"></i></a>
                                                               </div>
    
                                                             </td> -->
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <div role="tabpanel" class="tab-pane fade in active" id="Section2">
                                            <table class="table" id="tableone">
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-success" id="acceptAllSelectedRecord">Accept Selected orders</a>
                                                </div>
                                                
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px"><input type="checkbox" id="chkCheckAll" /></th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach($totalpending as $row)
                                                            <tr id="sid{{$row->id}}">
                                                                <td class="text-center" style="font-size: 15px;"><input type="checkbox"  name="ids" value="{{$row->id}}" class="checkBoxClass"></td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                                <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                                @if($row->vendorname == '')
                                                                <td class="text-center" style="font-size: 15px;">REACH</td>
                                                                @else
                                                                <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                                @endif
                                                                <td class="text-center" style="font-size: 15px;">
                                                                    <a data-toggle="modal" data-target="#yourPendingModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a>
                                                                </td>
                                                                <td style="width:12%;">
                                                                    <!--@if($row->shipment_id == '')-->
                                                                    <!--<div class="pull-left">-->
                                                                    <!--    <button class="btn btn-primary"><a href="{{url('/create_order/'.$row->id)}}" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;">Create</a></button>-->
                                                                    <!--</div>-->
                                                                    
                                                                    <!--<div class="pull-right">-->
                                                                    <!--    <button class="btn btn-danger"><a href="orders/status/{{$row->id}}/declined" style="text-align:center; color:white; font-weight:600; text-decoration:none;"><i class="fa fa-close" style="font-size:15px"></i></a></button>-->
                                                                    <!--</div>-->
                                                                    <!--@else-->
                                                                    
                                                                    <!--<div class="pull-right">-->
                                                                    <!--    <button class="btn btn-success"><a href="orders/status/{{$row->id}}/processing" style="text-align:center; color:white; font-weight:600; text-decoration:none;"><i class="fa fa-check" style="font-size:15px"></i></a></button>-->
                                                                    <!--</div>-->
                                                                    <!--@endif-->
                                                                    
                                                                    <div class="pull-left">
                                                                        <button class="btn btn-danger"><a href="orders/status/{{$row->id}}/declined" style="text-align:center; color:white; font-weight:600; text-decoration:none;"><i class="fa fa-close" style="font-size:15px"></i></a></button>
                                                                    </div>
                                                                    
                                                                    <div class="pull-right">
                                                                        <button class="btn btn-success"><a href="orders/status/{{$row->id}}/processing" style="text-align:center; color:white; font-weight:600; text-decoration:none;"><i class="fa fa-check" style="font-size:15px"></i></a></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section3">
                                            <div class="text-center">
                                                  <a href="#" class="btn btn-success" id="confirmAllSelectedRecord">Confirm Selected orders</a>
                                            </div>
                                            <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px"><input type="checkbox" id="concheckedaall" /></th>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Buyer</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($totalprocessing as $row)
                                                        <tr id="cid{{$row->id}}">
                                                            <td class="text-center" style="font-size: 15px;"><input type="checkbox" name="idsnew"
                                                                value="{{$row->id}}" class="checkBoxClassnew"></td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->buyer_name}}</td>
                                                            <td class="text-center" style="font-size: 15px;">
                                                                <a data-toggle="modal" data-target="#yourProcessingModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a><br>
                                                                <a href="{{url('generatePDF/'.$row->id)}}" style="color: red;">Download Invoice</a>
                                                            </td>
                                                            <td>
                                                                @if($row->shipment_id == '')
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary"><a href="{{url('/create_order/'.$row->id)}}" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;">Create</a></button>
                                                                </div>
                                                                @else
                                                                <div class="text-center">
                                                                    <a href="orders/status/{{$row->id}}/picked" class="btn btn-success">Confirm</a> 
                                                                </div>
                                                                @endif
                                                             </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section4">
                                            <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="text-center" style="font-size: 12px">Check All <input type="checkbox" id="select-all" name=""></th> -->
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Slip/Slot</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($totalconfirm as $row)
                                                        <input type="hidden" id="order_val">
                                                        <tr id="sid{{$row->id}}">
                                                            <!-- <td class="text-center" style="font-size: 15px;"><input type="checkbox" name="checkall"></td> -->
                                                            <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;"></td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                            @if($row->vendorname == '')
                                                            <td class="text-center" style="font-size: 15px;">REACH</td>
                                                            @else
                                                            <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                            @endif
                                                            
                                                            <td class="text-center" style="font-size: 15px;">
                                                                <a data-toggle="modal" data-target="#yourModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a>
                                                            </td>
                                                            
                                                            <td>
                                                                @if($row->book_slot_date == '' && $row->book_slot_time == '')
                                                                   <a style="font-size: 10px; color: red;" data-toggle="modal" data-target="#yourModalbook{{$row->id}}">Book Slot</a>
                                                                   
                                                                @else
                                                                    <div class="text-center">
                                                                        <a style="font-size: 10px; color: green;" data-toggle="modal" data-target="#viewslottimeanddate{{$row->id}}">Slot Booked</a>
                                                                    </div>
                                                                    
                                                                    @if($row->awb_code == '')
                                                                    <div class="text-center">
                                                                        <button class="btn btn-primary"><a class="Update" href="javascript:void(0); #my-modal" style="font-size: 15px; color:white; font-weight:600; text-decoration:none;" onclick="set_val({{$row->id}});">Courier</a></button>
                                                                    </div>
                                                                    @else
                                                                    <div class="text-center">
                                                                        <button class="btn btn-danger"><a href="{{url('cancel_shipment/'.$row->id)}}" style="font-size: 15px; color:white; font-weight:600; text-decoration:none;">Shipment</a></button>
                                                                    </div>
                                                                    @endif
                                                                @endif
    
                                                             </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section5">
                                            <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Invoice</th>
                                                        <th class="text-center" style="font-size: 12px">Pickup Requested Date</th>
                                                        <th class="text-center" style="font-size: 12px">Shipment Count</th>
                                                        <th class="text-center" style="font-size: 12px">Pickup Address</th>
                                                        <th class="text-center" style="font-size: 12px">AWB Code</th>
                                                        <th class="text-center" style="font-size: 12px">Status</th>
                                                        <th class="text-center" style="font-size: 12px">Tracking Id</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($apiData as $row)
                                                        <tr>
                                                            <td class="text-center" style="font-size: 15px;">
                                                                <a href="" target="_blank">{{$row->order_id}}</a>
                                                            </td>
                                                            <td class="text-center" style="font-size: 15px;"><a href="">{{$row->invoice_number}}</a></td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->api_order_id}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->courier_id}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">
                                                                <a href="{{url('track/'.$row->order_id)}}" target="_blank">{{$row->awb_code}}</a>
                                                            </td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->status}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->tracking_id}}</td>
                                                            <td class="text-center" style="font-size: 15px;">
                                                                <a class="show" data-toggle="modal" data-target="#yourModalnew{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a>
                                                            </td>
                                                            <td>
                                                                @if($row->awb_code == '')
                                                                    <button class="btn btn-primary"><a class="Update" href="javascript:void(0); #my-modal" style="font-size: 15px; color:white; font-weight:600; text-decoration:none;" onclick="set_val({{$row->id}});">Courier</a></button>
                                                                @endif
                                                                
                                                                @if($row->label_url == '' && $row->awb_code != '') 
                                                                    <button class="btn btn-primary" style="border-radius: 50px; width:130px; margin-top: 5px;"><a href="{{url('downloadlabel/'.$row->order_id)}}" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Generate Label</a></button>
                                                                @endif
                                                                
                                                                @if($row->invoice_url == '' && $row->awb_code != '') 
                                                                    <button class="btn btn-primary" style="border-radius: 50px; width:70px; margin-top: 5px;"><a href="{{url('downloadinvoice/'.$row->order_id)}}" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Invoice</a></button>
                                                                @endif
                                                                
                                                                @if($row->invoice_url != '' && $row->awb_code != '')
                                                                    <button class="btn btn-success" style="border-radius: 50px; width:80px; margin-top: 5px;"><a href="orders/status/{{$row->order_id}}/completed" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Confirm</a></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--<div role="tabpanel" class="tab-pane fade" id="Section6">-->
                                        <!--    <table class="table" id="tableone">-->
                                        <!--        <thead>-->
                                        <!--            <tr>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Order Id</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Product</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">SKU</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Date & Time</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Delivery Date</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">AWB Code</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Shipmet ID</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Tracking Id</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Seller</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">View</th>-->
                                        <!--                <th class="text-center" style="font-size: 12px">Action</th>-->
                                        <!--            </tr>-->
                                        <!--        </thead>-->
                                        <!--        <tbody>-->
                                        <!--        @foreach($totalintransit as $row)-->
                                        <!--            <tr>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>-->
                                        <!--                @if($row->vendorname == '')-->
                                        <!--                <td class="text-center" style="font-size: 15px;">REACH</td>-->
                                        <!--                @else-->
                                        <!--                <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>-->
                                        <!--                @endif-->
                                        <!--                <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>-->
                                        <!--                <td>-->
                                        <!--                    <button class="btn btn-success" style="border-radius: 50px; width:80px; margin-top: 5px;"><a href="orders/status/{{$row->orderid}}/completed" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Confirm</a></button>-->
                                        <!--                </td>-->
                                        <!--            </tr>-->
                                        <!--        @endforeach-->
                                        <!--        </tbody>-->
                                        <!--    </table>-->
                                        <!--</div>-->
                                        <div role="tabpanel" class="tab-pane fade" id="Section7">
                                            <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($totalcompleted as $row)
                                                        <tr>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                            <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                            @if($row->vendorname == '')
                                                            <td class="text-center" style="font-size: 15px;">REACH</td>
                                                            @else
                                                            <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                            @endif
                                                            <td class="show" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                            <a href="{{url('generatePDF/'.$row->id)}}" style="color: red;">Download Invoice</a>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
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
    <!-- /#page-wrapper -->

@foreach ($totalorders as $order) 

<?php 
 $total= $order->cost + 5 + round($settings[0]->shipping_cost,2);

?>   
    <div class="modal fade" id="yourModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->orderid }}</b> </h4>
              </div>
              <div class="modal-body">
                <div class="row" >
                    <hr style="background-color: red;">
                    <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                    <div class="text-left" style="padding-left: 10px;">
                        <p>{{$order->buyer_name}}</p>
                        <p>{{$order->buyer_address}}</p>
                        <p>{{$order->buyer_city}}</p>
                        <p>{{$order->buyer_state}}</p> 
                        <p>Mobile No:-{{$order->buyer_phone}}</p> 
                    </div>
                    <hr style="background-color: red;">
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <img width="200px" height="200px" src="{{url('assets/images/products')}}/{{$order->product_image}} " />
                  </div>
                  <div class="col-md-3">
                      <h5><b>Order Details:</b></h5>
                      <p>Product SKU:- {{$order->product_sku}}</p>
                      <p>Order Id:- {{$order->order_number_new}}</p>
                      <p>Product Name:- {{$order->product_title}}</p>
                  </div>
                  <div class="col-md-3">
                        <h5><b>Order Summary:</b></h5>
                        <p>Order Date:- {{$order->created_at}}</p>
                        <p>Dispatch Date:- {{$order->updated_at}}</p>
                        <p>Deliver Date:- {{$order->created_at}}</p>
                  </div>
                  <div class="col-md-3">
                      <h5><b>Bill Details:</b></h5>
                      <p>Product QTY:-{{$order->quantity}}</p>
                      <p>Unit Price:-{{$order->cost}}</p>  
                      <p>Tax:-5</p>
                      <p>Shipping Cost:-{{round($settings[0]->shipping_cost,2)}}</p>
                      <hr>
                      <p>Total:- {{$total}} </p>
                  </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
                <div class="button-div">
                    @if($order->book_slot_date != '' && $order->book_slot_time != '')
                        
                        @if(($order->awb_code != '') && ($order->pickup_scheduled_date == ''))
                            <button class="btn btn-success"><a href="{{url('pickups/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Book Slot</a></button>
                        @endif
                        
                        @if(($order->manifest_url == '') && ($order->pickup_scheduled_date != ''))
                            <button class="btn btn-success"><a href="{{url('manifest/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Manifest</a></button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
@endforeach


<!--pending order model-->

@foreach ($totalpending as $order) 

<?php 
 $total= $order->cost + 5 + round($settings[0]->shipping_cost,2);

?>   
    <div class="modal fade" id="yourPendingModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->orderid }}</b> </h4>
              </div>
              <div class="modal-body">
                <div class="row" >
                    <hr style="background-color: red;">
                    <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                    <div class="text-left" style="padding-left: 10px;">
                        <p>{{$order->buyer_name}}</p>
                        <p>{{$order->buyer_address}}</p>
                        <p>{{$order->buyer_city}}</p>
                        <p>{{$order->buyer_state}}</p> 
                        <p>Mobile No:-{{$order->buyer_phone}}</p> 
                    </div>
                    <hr style="background-color: red;">
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <img width="200px" height="200px" src="{{url('assets/images/products')}}/{{$order->product_image}} " />
                  </div>
                  <div class="col-md-3">
                      <h5><b>Order Details:</b></h5>
                      <p>Product SKU:- {{$order->product_sku}}</p>
                      <p>Order Id:- {{$order->order_number_new}}</p>
                      <p>Product Name:- {{$order->product_title}}</p>
                  </div>
                  <div class="col-md-3">
                        <h5><b>Order Summary:</b></h5>
                        <p>Order Date:- {{$order->created_at}}</p>
                        <p>Dispatch Date:- {{$order->updated_at}}</p>
                        <p>Deliver Date:- {{$order->created_at}}</p>
                  </div>
                  <div class="col-md-3">
                      <h5><b>Bill Details:</b></h5>
                      <p>Product QTY:-{{$order->quantity}}</p>
                      <p>Unit Price:-{{$order->cost}}</p>  
                      <p>Tax:-5</p>
                      <p>Shipping Cost:-{{round($settings[0]->shipping_cost,2)}}</p>
                      <hr>
                      <p>Total:- {{$total}} </p>
                  </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
                <div class="button-div">
                    @if($order->book_slot_date != '' && $order->book_slot_time != '')
                        
                        @if(($order->awb_code != '') && ($order->pickup_scheduled_date == ''))
                            <button class="btn btn-success"><a href="{{url('pickups/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Book Slot</a></button>
                        @endif
                        
                        @if(($order->manifest_url == '') && ($order->pickup_scheduled_date != ''))
                            <button class="btn btn-success"><a href="{{url('manifest/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Manifest</a></button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
@endforeach

<!--processing order model-->

@foreach ($totalprocessing as $order) 

<?php 
 $total= $order->cost + 5 + round($settings[0]->shipping_cost,2);

?>   
    <div class="modal fade" id="yourProcessingModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->orderid }}</b> </h4>
              </div>
              <div class="modal-body">
                <div class="row" >
                    <hr style="background-color: red;">
                    <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                    <div class="text-left" style="padding-left: 10px;">
                        <p>{{$order->buyer_name}}</p>
                        <p>{{$order->buyer_address}}</p>
                        <p>{{$order->buyer_city}}</p>
                        <p>{{$order->buyer_state}}</p> 
                        <p>Mobile No:-{{$order->buyer_phone}}</p> 
                    </div>
                    <hr style="background-color: red;">
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <img width="200px" height="200px" src="{{url('assets/images/products')}}/{{$order->product_image}} " />
                  </div>
                  <div class="col-md-3">
                      <h5><b>Order Details:</b></h5>
                      <p>Product SKU:- {{$order->product_sku}}</p>
                      <p>Order Id:- {{$order->order_number_new}}</p>
                      <p>Product Name:- {{$order->product_title}}</p>
                  </div>
                  <div class="col-md-3">
                        <h5><b>Order Summary:</b></h5>
                        <p>Order Date:- {{$order->created_at}}</p>
                        <p>Dispatch Date:- {{$order->updated_at}}</p>
                        <p>Deliver Date:- {{$order->created_at}}</p>
                  </div>
                  <div class="col-md-3">
                      <h5><b>Bill Details:</b></h5>
                      <p>Product QTY:-{{$order->quantity}}</p>
                      <p>Unit Price:-{{$order->cost}}</p>  
                      <p>Tax:-5</p>
                      <p>Shipping Cost:-{{round($settings[0]->shipping_cost,2)}}</p>
                      <hr>
                      <p>Total:- {{$total}} </p>
                  </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
                <div class="button-div">
                    @if($order->book_slot_date != '' && $order->book_slot_time != '')
                        
                        @if(($order->awb_code != '') && ($order->pickup_scheduled_date == ''))
                            <button class="btn btn-success"><a href="{{url('pickups/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Book Slot</a></button>
                        @endif
                        
                        @if(($order->manifest_url == '') && ($order->pickup_scheduled_date != ''))
                            <button class="btn btn-success"><a href="{{url('manifest/'.$order->orderid)}}" style="font-size: 10px; color: white; font-weight:700; text-decoration:none;">Manifest</a></button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
@endforeach

<!-- Tracking ID submission -->

@foreach ($trackingData as $order) 
    <div class="modal fade" id="yourModalnew{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->api_order_id}}</b> </h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <hr style="background-color: red;">
                    <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                    <div class="text-left" style="padding-left: 10px;">
                        <p>{{$order->buyer_name}}</p>
                        <p>{{$order->buyer_address}}</p>
                        <p>{{$order->buyer_city}}</p>
                        <p>{{$order->buyer_state}}</p> 
                        <p>Mobile No:-{{$order->buyer_phone}}</p> 
                    </div>
                    <hr style="background-color: red;">
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img width="200px" height="200px" src="{{url('assets/images/products')}}/{{$order->product_image}} " />
                    </div>
                    @if($order->awb_code != '')
                    <div class="col-md-3">
                        <p>{{$order->order_id}}</p>
                        <p>{{$order->awb_code}}</p>
                        <p>{{$order->courier_name}}</p>
                        <p>{{$order->product_title}}</p>
                    </div>
                    @else
                    <div class="col-md-3">
                        <p>{{$order->order_id}}</p>
                        <p style="color:red;">AWB Not Create</p>
                        <p>{{$order->product_title}}</p>
                    </div>
                    @endif
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="button-div">
                    @if($order->label_url != '')
                        <button class="btn btn-primary" style="border-radius: 50px; width:60px; margin-top: 5px;"><a href="{{url(''.$order->label_url)}}" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Label</a></button>
                    @endif
                    
                    @if($order->invoice_url != '')
                        <button class="btn btn-primary" style="border-radius: 50px; width:130px; margin-top: 5px;"><a href="{{url(''.$order->invoice_url)}}" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Print Invoice</a></button>
                    @endif
                    
                    @if($order->manifest_url != '')
                        <button class="btn btn-primary" style="border-radius: 50px; width:120px; margin-top: 5px;"><a href="{{url(''.$order->manifest_url)}}" style="font-size: 15px; color:white; font-weight:400; text-decoration:none;">Print Manifest</a></button>
                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
@endforeach

<!-- End tracking ID submission -->



<!-- model for booking slot -->

@foreach ($totalorders as $order)
    <div class="modal fade" id="viewslottimeanddate{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->order_number_new }}</b> </h4>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{$order->book_slot_date}}</td>
                        <td>{{$order->book_slot_time}}</td>
                      </tr>
                    </tbody>
                </table>
               
              </div>
              <div class="modal-footer">
                
              </div>
        </div>
      </div>
    </div>
@endforeach


<!-- end model for booking slot -->

<!-- model for view booked date and time -->


@foreach ($totalorders as $order)
    <div class="modal fade" id="yourModalbook{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->order_number_new }}</b> </h4>
              </div>
              <div class="modal-body">
                
                <form method="post" action="{!! action('OrderController@bookslot',['id' => $order->id]) !!}">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <h2>Select Date</h2>
                    <div class="checkbox">
                      <label><input type="date" name="dateforslot" id="date" style="border: none; background: pink; width: 20px; border-radius:19px; text: none;"><span style="margin-left:20px;">SLOT</span></label>
                      <label></label>
                      <label><input type="text" id="datepicker" style="border: none; width: 140px; border-radius:1px; outline: none;" readonly></label>
                    </div>
                    <hr>
                    <h2>Select Time</h2>
                    <div class="checkbox">
                      <label><input type="radio" name="timeforslot" value="10.00 AM  TO 1 PM">10.00 AM  TO 1 PM</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="radio" name="timeforslot" value="1.00 PM TO 6 PM">1.00 PM TO 6 PM</label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success"> Book Slot </button>
                </form>
               
              </div>
              <div class="modal-footer">
                
              </div>
        </div>
      </div>
    </div>
@endforeach

<script>
    function set_val(order_no) {
        $('#order_val').val("");
        $('#order_val').val(order_no);
    }
</script>

<script>
    var dateInput = document.getElementById('date');
    var datepicker = document.getElementById('datepicker');
    dateInput.addEventListener('change', function() {
        $('#datepicker').val(dateInput.value);
        datepicker.style.border = '1px solid #000';
    })
</script>

@foreach ($totalconfirm as $row)
<input type="hidden" id="totalrowid" value="{{$row->id}}">
<div id="MyPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
                <h4 class="modal-title">
                    Couriers
                </h4>
            </div>
            <form  >
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="modal-body">
                    <select name="courier_id" style="width:50%;" id="courierid">
                        <option value='non'>Select an courior...</option>
                        <option value='1' name='courierData'>Blue Dart</option>
                        <option value='2' name='courierData'>FedEx</option>
                        <option value='7' name='courierData'>FEDEX PACKAGING</option>
                        <option value='8' name='courierData'>DHL Packet International</option>
                        <option value='10' name='courierData'>Delhivery</option>
                        <option value='12' name='courierData'>FedEx Surface 10 Kg</option>
                        <option value='14' name='courierData'>Ecom Express</option>
                        <option value='16' name='courierData'>Dotzot</option>
                        <option value='33' name='courierData'>Xpressbees</option>
                        <option value='35' name='courierData'>Aramex International</option>
                        <option value='37' name='courierData'>DHL PACKET PLUS INTERNATIONAL</option>
                        <option value='38' name='courierData'>DHL PARCEL INTERNATIONAL DIRECT</option>
                        <option value='39' name='courierData'>Delhivery Surface 5 Kgs</option>
                        <option value='40' name='courierData'>Gati Surface 5 Kg</option>
                        <option value='41' name='courierData'>FedEx Flat Rate</option>
                        <option value='42' name='courierData'>FedEx Surface 5 Kg</option>
                        <option value='43' name='courierData'>Delhivery Surfaceg</option>
                        <option value='44' name='courierData'>Delhivery Surface 2 Kgs</option>
                        <option value='45' name='courierData'>Ecom Express Reverse</option>
                        <option value='46' name='courierData'>Shadowfax Reverse</option>
                        <option value='48' name='courierData'>Ekart Logistics</option>
                        <option value='50' name='courierData'>Wow Express</option>
                        <option value='51' name='courierData'>Xpressbees Surface</option>
                        <option value='52' name='courierData'>RAPID DELIVERY</option>
                        <option value='53' name='courierData'>Gati Surface 1 Kg</option> 
                        <option value='54' name='courierData'>Ekart Logistics Surface</option>
                        <option value='55' name='courierData'>Blue Dart Surface</option>
                        <option value='56' name='courierData'>DHL Express International</option>
                        <option value='57' name='courierData'>Professional</option>
                        <option value='58' name='courierData'>Shadowfax Surface</option>
                        <option value='60' name='courierData'>Ecom Express ROS</option>
                        <option value='62' name='courierData'>FedEx Surface 1 Kg</option>
                        <option value='63' name='courierData'>Delhivery Flash</option>
                        <option value='68' name='courierData'>Delhivery Essential Surface</option>
                        <option value='80' name='courierData'>Delhivery Reverse QC</option>
                        <option value='95' name='courierData'>Shadowfax Local</option>
                        <option value='96' name='courierData'>Shadowfax Essential Surface</option>
                        <option value='97' name='courierData'>Dunzo Local</option>
                        <option value='99' name='courierData'>Ecom Express ROS Reverse</option>
                        <option value='100' name='courierData'>Delhivery Surface 10 Kgs</option>
                        <option value='101' name='courierData'>Delhivery Surface 20 Kgs</option>
                        <option value='102' name='courierData'>Delhivery Essential Surface 5Kg</option>
                        <option value='103' name='courierData'>Xpressbees Essential Surface</option>
                        <option value='104' name='courierData'>Delhivery Essential Surface 2Kg</option>
                        <option value='106' name='courierData'>Wefast Local</option>
                        <option value='107' name='courierData'>Wefast Local 5 Kg</option>
                        <option value='108' name='courierData'>Ecom Express Essential</option>
                        <option value='109' name='courierData'>Ecom Express ROS Essential</option>
                        <option value='110' name='courierData'>Delhivery Essential</option>
                        <option value='111' name='courierData'>Delhivery Non Essential</option>
                    </select>
                </div>
                <div class="modal-footer" style="float:left; color:primary;">
                    <button type="submit" data="" id="btn_save" class="btn btn-success" onclick="call_submit(event)">save</button>
                    <!--<a href="{{url('/courier_order/'.$row->id)}}" onclick="call_submit()">Submit</a>-->
                </div>
                <div class="modal-footer">
                    <input type="button" id="btnClosePopup" value="Close" class="btn btn-danger" data-dismiss="modal">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- end model for view booked date and time -->



@stop

<script type="text/javascript">
    function call_submit(e) {
        var order_no = $("#order_val").val();
        var courier = $('#courierid option:selected');
        var courier_id = courier.val();
        var courier_name = courier.text();
        
        var id = $('#totalrowid').val();
        
        var url = "{{url('/courier_order/')}}"+id;

        $.ajax({
            type: "post",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                courier_id:courier_id,
                courier_name:courier_name,
                order_no: order_no
            },
            success:function(data) {
                console.log(data);
                $('.alert').show();
                $('.alert').html(result.success);
            }
        });
    }
</script>


<script type="text/javascript">
   $(document).ready(function () {
        $('table#example').DataTable();
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
  
  


<script type="text/javascript">
// $('#yourModaldata').on('show.bs.modal', function(e) {  var csrf = '<?php echo csrf_token() ?>';
// var $modal = $(this),
//     Id = e.relatedTarget.id;
//     var url= 'showmodal';
//     $.ajax({
//         cache: false,
//         type: 'post',
//         url: url,
//         data:  { 'EID': Id,'_token': csrf },
//         success: function(data) {
//             alert(data);
//             $modal.find('.modal-body').html(data);
//         }
//     });
// });
</script>
  
  
<script type="text/javascript">
$('.show').on('click', function(){
   $("#yourModaldata").modal("show");
   return false;
});
</script>
  

// <script type="text/javascript">
//     document.getElementById('printManifest').on('cleck', function() {
//         window.open("$order->manifest_url");
//     });
// </script>


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
        console.log(id);
        $.ajax({
            type:"post",
            url: "{{url('shipping/')}}",
            data : {"_token": "{{ csrf_token() }}",id},
            dataType: "JSON",
            success:function(resp) {
                console.log(resp);
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


            $("#chkCheckAll").click(function(){
                $(".checkBoxClass").prop('checked',$(this).prop('checked'));
            });


            $("#acceptAllSelectedRecord").click(function(e){
                e.preventDefault();
                 var allids = [];

                 $("input:checkbox[name=ids]:checked").each(function(){
                     allids.push($(this).val());
                 });

                 $.ajax({

                    url:"{{route('order.accept')}}",
                    type:"POST",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allids
                    },

                    success:function(response){

                        alert("Selected Orders Are Accepted...!");
                        window.location.reload();

                        // $.each(allids,function(key,val){

                        //     $("#sid"+val).remove();

                        // });

                    }


                 });


            });


      });



// confirm selected orders

      $(function(e){


            $("#concheckedaall").click(function(){
                $(".checkBoxClassnew").prop('checked',$(this).prop('checked'));
            });


            $("#confirmAllSelectedRecord").click(function(e){
                e.preventDefault();
                 var allidsnew = [];

                 $("input:checkbox[name=idsnew]:checked").each(function(){
                     allidsnew.push($(this).val());
                 });

                 $.ajax({

                    url:"{{route('order.confirm')}}",
                    type:"POST",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allidsnew
                    },

                    success:function(response){
                        alert("Selected Orders Are confirmed...!");
                        window.location.reload();

                        // $.each(allidsnew,function(key,val){

                        //     $("#cid"+val).remove();

                        // });

                    }


                 });


            });


      });



  </script>


  <!-- end of accept all status -->


@section('footer')

@stop
