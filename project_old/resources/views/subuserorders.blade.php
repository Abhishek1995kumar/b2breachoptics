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

 .go-line{
    border: 1px solid #ddd;
    margin: 26px 0px;
}

.go-title{
    margin: 0px 20px; 
}

.go-title h3{
    font-weight: 700; 
}

.panel-default{
    border-radius: 0;
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
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="dashboard-content">
                        <div class="row" id="main">
                            <div id="my-orders-tab">
                                <ul class="nav nav-tabs tabs-left">
                                    @if($user->user_id == '')
                                        <li><a href="{{url('user/orders')}}"><strong>My Orders ({{\App\OrderedProducts::where('customer_id_new', Auth::user()->id)->count()}})</strong></a></li>
                                        <li class="active"><a href="{{url('user/subuserorders')}}"><strong>Users Orders ({{\App\OrderedProducts::where('parent_id', Auth::user()->id)->count()}})</strong></a></li>
                                    @else
                                        <h3 id="my-orders-tab_h3">my orders</h3>
                                    @endif
                                </ul>
                                <div class="order-table-responsive">
                                    <table class="table" id="userOrders">
                                        <div class="go-line"></div>
                                        <thead>
                                        <tr class="table-header-row">
                                            <th>Order By</th>
                                            <th>Image</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Product Sku</th>
                                            <th>Order Id</th>
                                            <th>Order Date</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>View Order</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->buyer_name}}</td>
                                            <td><img width="80px" height="80px" src="{{url('assets/images/products')}}/{{$order->product_image}} " /></td>
                                            <td></td>
                                            <td>{{$order->size}}</td>
                                            <td>{{$order->product_sku}}</td>
                                            <td>{{$order->orderid}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->quantity}}</td>
                                            <td>{{$settings[0]->currency_sign}}{{$order->cost}}</td>
                                            <!-- <td>{{$order->status}}</td> -->
                                            <td><a href="{{url('user/order/')}}/{{$order->id}}">view order</a></td>
                                            <!-- <td><a data-toggle="modal" data-target="#yourModal{{$order->id}}">Track Order</a></td> -->
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
        </div>
    </div>

    @foreach ($orders as $order)    
    <div class="modal fade" id="yourModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" style="width: 50%;"  role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Order Id: {{$order->order_number}} </h4>
          </div>
          <div class="modal-body">
            <hr>
            @if($order->status =='pending')
                <div class="container">
                    <article class="card">
                        <header class="card-header"> <h5 style="float: left;">Order Id: {{$order->order_number}} </h5> <h5 style="float: right;">Order Status: {{$order->status}} </h5>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div>
                            </div> 
                        </div>
                    </article>
                </div>  
            @elseif($order->status == 'processing')
                <div class="container">
                    <article class="card">
                        <header class="card-header"> <h5 style="float: left;">Order Id: {{$order->order_number}} </h5> <h5 style="float: right;">Order Status: {{$order->status}} </h5>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div>
                            </div> 
                        </div>
                    </article>
                </div>   
            @elseif($order->status == 'picked')
                 <div class="container">
                    <article class="card">
                        <header class="card-header"> <h6 style="float: left;">Order Id: {{$order->order_number}} </h6> <h6 style="float: right;">Order Status: {{$order->status}} </h6>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step active "> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div>
                            </div> 
                        </div>
                    </article>
                </div>  
            @elseif($order->status == 'shipped')
                <div class="container">
                    <article class="card">
                        <header class="card-header"> <h6 style="float: left;">Order Id: {{$order->order_number}} </h6> <h6 style="float: right;">Order Status: {{$order->status}} </h6>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step active "> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div>
                            </div> 
                        </div>
                    </article>
                </div>  
            @elseif($order->status == 'completed')

               <div class="container">
                    <article class="card">
                        <header class="card-header"> <h6 style="float: left;">Order Id: {{$order->order_number}} </h6> <h6 style="float: right;">Order Status: {{$order->status}} </h6>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div>
                            </div> 
                        </div>
                    </article>
                </div>  
            @elseif($order->status == 'cancelled')   
             
             <div class="container">
                    <article class="card">
                        <header class="card-header"> <h6 style="float: left;">Order Id: {{$order->order_number}} </h6> <h6 style="float: right;">Order Status: {{$order->status}} </h6>  </header>
                        <div class="card-body">
                           <br>
                           <br>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 15px;"></i> </span> <span class="text">Pending</span> </div>
                               <!--  <div class="step active"> <span class="icon"> <i class="fa fa-thumbs-up" style="margin-top: 15px;"></i> </span> <span class="text">Confirmed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-envelope" style="margin-top: 15px;"></i> </span> <span class="text">Picked</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck" style="margin-top: 15px;"></i> </span> <span class="text">Shipped</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-gift" style="margin-top: 15px;"></i> </span> <span class="text">Delivered</span> </div> -->
                                <div class="step active"> <span class="icon"> <i class="fa fa-close" style="margin-top: 15px;"></i> </span> <span class="text">Cancelled</span> </div>
                            </div> 
                        </div>
                    </article>
                </div> 

            @else
                <h4>Your Order Is In Return Process</h4>
            @endif
          </div>
          <div class="modal-footer">
            @if($order->status == 'cancelled')
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            @elseif($order->status == 'completed')
                <a href="" class="btn btn-danger">Return Order</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            @else

            <a href="{{url('cancel_order/')}}/{{$order->id}}" class="btn btn-danger">Cancel Order</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            @endif
            
            
          </div>
        </div>
      </div>
    </div>
@endforeach

    <!-- Ending of Account Dashboard area -->
</div>

@stop

@section('footer')
<script>
    $('#userOrders').DataTable( {
        "order": []
    });
</script>
@stop