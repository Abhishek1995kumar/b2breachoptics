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
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif      
                    <div class="dashboard-content">
                        <div id="my-orders-tab">
                            <h3 id="my-orders-tab_h3">my orders</h3>
                            <ul class="nav nav-tabs nav-justified nav-tabs-dropdown" role="tablist">
							    <li role="presentation" class="active"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">USER ORDER</a></li>
							    <li role="presentation"><a href="#userorder" onclick="subuserorder()" aria-controls="userorder" role="tab" data-toggle="tab">CHILD USER ORDER</a></li>
						    </ul>
                            
						    <div class="tab-content">
							    <div role="tabpanel" class="tab-pane active" id="order">
                                    <div class="order-table-responsive">
                                        <table class="table" id="user_orders">
                                            <thead>
                                                <tr class="table-header-row">
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Product Sku</th>
                                                    <th>Color</th>
                                                    <th>Size</th>
                                                    <th>Order Date</th>
                                                    <th>Qty</th>
                                                    <th>Unit Price</th>
                                                    <th>View Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane" id="sub_user_orders">
                                    <div class="order-table-responsive">
                                        <table class="table" id="userOrders">
                                            <thead>
                                            <tr class="table-header-row">
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Product Sku</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Order Date</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>View Order</th>
                                            </tr>
                                            </thead>
                                            <tbody>
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
    $("#user_orders").DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        'bLengthChange': false,
        'bDestroy': true,
        'language': {
                    "processing": ` <div id='loader' style=''>
                            <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                                <defs>
                                    <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                                        <stop offset="0%" stop-color="#5ebd3e" />
                                        <stop offset="33%" stop-color="#ffb900" />
                                        <stop offset="67%" stop-color="#f78200" />
                                        <stop offset="100%" stop-color="#e23838" />
                                    </linearGradient>
                                    <linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                                        <stop offset="0%" stop-color="#e23838" />
                                        <stop offset="33%" stop-color="#973999" />
                                        <stop offset="67%" stop-color="#009cdf" />
                                        <stop offset="100%" stop-color="#5ebd3e" />
                                    </linearGradient>
                                </defs>
                                <g fill="none" stroke-linecap="round" stroke-width="16">
                                    <g class="ip__track" stroke="#ddd">
                                        <path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                        <path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                    </g>
                                    <g stroke-dasharray="180 656">
                                        <path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                        <path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                    </g>
                                </g>
                            </svg>
                        </div>`
                    },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': "{{url('/user/orders/get_active_userorder_details')}}",
            'method' : 'POST',
            'data': {
              "_token": "{{ csrf_token() }}"
          },
      },
    });

    
    function viewOrder(id){
        var url = "{{url('/user/order')}}/"+id;
        window.location.href = url;
    };
</script>
@stop