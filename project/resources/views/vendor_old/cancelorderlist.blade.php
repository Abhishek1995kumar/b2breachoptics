@extends('vendor.includes.master-vendor')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">



@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
             
               
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right" style="margin-right:49%;">
                      
                    </div>


                    <h3>Cancelled Orders</h3>
                    
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
                                        <!-- <th class="text-center" style="font-size: 12px">Tracking Id</th> -->
                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                        <th class="text-center" style="font-size: 12px">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cancelorderlist as $row)
                                    <tr>
                                        <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                        <!-- <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td> -->
                                        <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('vendor/cancel/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>                 
                        </div>
                        

                        
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@foreach ($cancelorderlist as $order) 

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



@stop






<script type="text/javascript">
    
    $(document).ready(function() {
    $('table.table').DataTable();
} );

</script>





  

@section('footer')



@stop
