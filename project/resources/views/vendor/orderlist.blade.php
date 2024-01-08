@extends('vendor.includes.master-vendor')

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
    padding: 10px 50px;
    margin-right: 5px;
    background: #cb5245;
    font-size: 18px;
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
    font-size: 18px;
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
    width: 200px;
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
    padding: 15px 20px;
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
                        </div>

                        <div class="col-md-12">

                            <div class="tab" role="tabpanel">

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" ><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Total Order <br><div class="text-center">{{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->count() }}</div> </a></li>
                                        <li role="presentation" class="active"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Order <br> <div class="text-center">{{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','pending')->count() }} </div></a></li>
                                        <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Order Process <br> <div class="text-center">{{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','processing')->count() }}</div></a></li>
                                        <li role="presentation"><a href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Ready For Pickup <br> <div class="text-center">{{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','picked')->count() }}</div></a></li>
                                        <li role="presentation"><a href="#Section5" aria-controls="messages" role="tab" data-toggle="tab">In Transit <br><div class="text-center"> {{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','InTransit')->count() }}</div></a></li>
                                        <li role="presentation"><a href="#Section6" aria-controls="messages" role="tab" data-toggle="tab">Delivered <br> <div class="text-center">{{ \App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','completed')->count() }}</div></a></li>
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
                                                        <!-- <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($totalorders as $row)
                                                    <tr>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($totalpending as $row)
                                                    <tr id="sid{{$row->id}}">
                                                        <td class="text-center" style="font-size: 15px;"><input type="checkbox"  name="ids" value="{{$row->id}}" class="checkBoxClass"></td>
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
                                                        <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->unique_id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                        <td>
                                                           <div class="pull-left">
                                                              <a href="orders/status/{{$row->id}}/processing" class="btn btn-xs btn-success"><i class="fa fa-check-square" style="font-size:15px"></i></a> 
                                                           </div> 

                                                           <div class="pull-right">
                                                               <a href="orders/status/{{$row->id}}/declined" class="btn btn-xs btn-danger"><i class="fa fa-close" style="font-size:15px"></i></a>
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
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($totalprocessing as $row)
                                                    <tr id="cid{{$row->id}}">
                                                        <td class="text-center" style="font-size: 15px;"><input type="checkbox" name="idsnew"
                                                            value="{{$row->id}}" class="checkBoxClassnew"></td>
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
                                                        <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->unique_id}}"><i class="fa fa-eye" style="font-size:15px"></i></a><br><a href="{{url('vendor/generatePDF/'.$row->id)}}" style="color: red;">Download Invoice</a>

                                                        </td>
                                                        <td>
                                                           <div class="text-center">
                                                              <a href="orders/status/{{$row->id}}/picked" class="btn btn-success">Confirm</a> 
                                                           </div> 

                                                           <!-- <div class="pull-right">
                                                               <a href="orders/status/{{$row->id}}/declined" class="btn btn-xs btn-danger"><i class="fa fa-close" style="font-size:15px"></i></a>
                                                           </div> -->

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
                                                        <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->unique_id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                        <td>
                                                          @if($row->book_slot_date != '' && $row->book_slot_time != '')
                                                           <a href="{{url('vendor/genrateacknowladgeslip/'.$row->id)}}" style="font-size: 10px">Pickup Acknowledgement Slip</a>
                                                           @endif
                                                           <br>
                                                           @if($row->book_slot_date == '' && $row->book_slot_time == '')
                                                           <a style="font-size: 10px; color: red;" data-toggle="modal" data-target="#yourModalnew{{$row->id}}">Book Slot</a>
                                                           @else
                                                           <a style="font-size: 10px; color: green;" data-toggle="modal" data-target="#viewslottimeanddate{{$row->id}}">Slot Booked</a>
                                                           @endif
                                                           <br>
                                                           @if($row->book_slot_date != '' && $row->book_slot_time != '')
                                                           <a href="{{url('vendor/downloadpickupslip/'.$row->id)}}" style="font-size: 10px;"> Download Pickup Slip</a>
                                                           @endif 

                                                           <!-- <div class="text-center">
                                                              <a href="orders/status/{{$row->id}}/picked" class="btn btn-success">Confirm</a> 
                                                           </div> --> 

                                                           <!-- <div class="pull-right">
                                                               <a href="orders/status/{{$row->id}}/declined" class="btn btn-xs btn-danger"><i class="fa fa-close" style="font-size:15px"></i></a>
                                                           </div> -->

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
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Tracking Id</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($totalintransit as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                        @if($row->vendorname == '')
                                                        <td class="text-center" style="font-size: 15px;">REACH</td>
                                                        @else
                                                        <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                        @endif
                                                        <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->unique_id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="Section6">
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
                                                        <td class="text-center" style="font-size: 15px;"><a data-toggle="modal" data-target="#yourModal{{$row->unique_id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
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
    <div class="modal fade" id="yourModal{{$order->unique_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->order_number_new }}</b> </h4>
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
                
              </div>
        </div>
      </div>
    </div>
@endforeach


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
    <div class="modal fade" id="yourModalnew{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: {{$order->order_number_new }}</b> </h4>
              </div>
              <div class="modal-body">
                
                <form method="post" action="{!! action('VendorOrdersController@vendorbookslot',['id' => $order->id]) !!}">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <h2>Select Date</h2>
                    <div class="checkbox">
                      <label><input type="radio" name="dateforslot" value="{{$order->tomorrow_date}}">{{$order->tomorrow_date}}</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="radio" name="dateforslot" value="{{$order->after_tomorrow_date}}">{{$order->after_tomorrow_date}}</label>
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


<!-- end model for view booked date and time -->



@stop

<script type="text/javascript">

   $(document).ready(function () {
            $('table#example').DataTable();
        });
    
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

                    url:"{{route('vendor.accept')}}",
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

                    url:"{{route('vendor.confirm')}}",
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
