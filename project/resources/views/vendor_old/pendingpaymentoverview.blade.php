@extends('vendor.includes.master-vendor')
@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .dashboard-content * {
            visibility: visible;
        }
        .print-order-btn,.edit-account-info-div .back-btn{
            visibility: hidden;
        }
        .dashboard-content {
            position: absolute;
            margin-top: -100px;
            width: 100%;
        }
    }

.steps {
    border: 1px solid #e7e7e7
}

.steps-header {
    padding: .375rem;
    border-bottom: 1px solid #e7e7e7
}

.steps-header .progress {
    height: 1.25rem;
    margin-top: 19px;
}

.steps-body {
    display: table;
    table-layout: fixed;
    width: 100%
}

.step {
    display: table-cell;
    position: relative;
    padding: 1rem .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-right: 1px dashed #dfdfdf;
    color: rgba(0, 0, 0, 0.65);
    font-weight: 600;
    text-align: center;
    text-decoration: none
}

.step:last-child {
    border-right: 0
}

.step-indicator {
    display: block;
    position: absolute;
    top: .75rem;
    left: .75rem;
    width: 1.5rem;
    height: 1.5rem;
    border: 1px solid #e7e7e7;
    border-radius: 50%;
    background-color: #fff;
    font-size: .875rem;
    line-height: 1.375rem
}

.has-indicator {
    padding-right: 1.5rem;
    padding-left: 2.375rem
}

.has-indicator .step-indicator {
    top: 50%;
    margin-top: -.75rem
}

.step-icon {
    display: block;
    width: 1.5rem;
    height: 1.5rem;
    margin: 0 auto;
    margin-bottom: .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    color: #888
}

.step:hover {
    color: rgba(0, 0, 0, 0.9);
    text-decoration: none
}

.step:hover .step-indicator {
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-color: transparent;
    background-color: #f4f4f4
}

.step:hover .step-icon {
    color: rgba(0, 0, 0, 0.9)
}

.step-active,
.step-active:hover {
    color: rgba(0, 0, 0, 0.9);
    pointer-events: none;
    cursor: default
}

.step-active .step-indicator,
.step-active:hover .step-indicator {
    border-color: transparent;
    background-color: #5c77fc;
    color: #fff
}

.step-active .step-icon,
.step-active:hover .step-icon {
    color: #5c77fc
}

.step-completed .step-indicator,
.step-completed:hover .step-indicator {
    border-color: transparent;
    background-color: rgba(51, 203, 129, 0.12);
    color: #33cb81;
    line-height: 1.25rem
}

.step-completed .step-indicator .feather,
.step-completed:hover .step-indicator .feather {
    width: .875rem;
    height: .875rem
}

@media (max-width: 575.98px) {
    .steps-header {
        display: none
    }
    .steps-body,
    .step {
        display: block
    }
    .step {
        border-right: 0;
        border-bottom: 1px dashed #e7e7e7
    }
    .step:last-child {
        border-bottom: 0
    }
    .has-indicator {
        padding: 1rem .75rem
    }
    .has-indicator .step-indicator {
        display: inline-block;
        position: static;
        margin: 0;
        margin-right: 0.75rem
    }
}

.bg-secondary {
    background-color: #f7f7f7 !important;
    height: 50px;
}


/*cancel order tracking css*/

    .stepper-wrapper {
  margin-top: auto;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}

.stepper-item::before {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: -50%;
  z-index: 2;
}

.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ccc;
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.completed .step-counter {
  background-color: #4bb543;
}

.stepper-item.completed::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}

p.b { 
  word-spacing: 50px;
}



/*end of cancel order tracking css*/




</style>


<?php 
  $total = $pendingdata->cost + 0 + 0 + 0;
?>


<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                @if(session()->has('message'))
                 <div class="alert alert-success">
                    {{ session()->get('message') }}
                 </div>
                @endif
                <div class="text-center">
                    <h1>Order Details</h1>
                    <hr>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" style="max-width: 100%;">
                          <div class="row no-gutters">
                            <div class="col-md-4">
                              <img  class="card-img" width="100" height="100"  src="{{url('assets/images/products')}}/{{$pendingdata->product_image}} " />
                            </div>
                            <div class="col-md-4">
                             <h5><b>{{$pendingdata->product_title}}</b></h5>
                             <p>Order Id:- {{$pendingdata->order_number_new}}</p>
                             <p>SKU:- {{$pendingdata->product_sku}}</p>
                              @if($pendingdata->order_payment_method == 'COD')
                                <p>Order type :- COD</p>
                              @else
                                <p>Order type :- E-Payment</p>
                              @endif
                             <p>Quantity:- {{$pendingdata->quantity}}</p>
                              <p>Shipped To :- {{$pendingdata->buyer_address}},{{$pendingdata->buyer_state}}</p>
                            </div>
                            <div class="col-md-4">
                              <div class="card-body">
                                <h5 class="card-title"><b>Sale Details</b></h5>
                                <p><b>Sale Amount :-</b> {{$pendingdata->cost}}</p>
                                <p><b>MarketPlace Fee :-</b> 0</p>
                                <p><b>Taxes :-</b> 0</p>
                                <p><b>Shipping Charge :-</b> 0</p>
                                <hr>
                                <p>Amount :- {{$total}}</p>
                               </div>
                            </div>
                          </div>
                        </div>
                </div>
                <div class="col-md-4">
                   
                </div>

            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->

 <!-- Modal for return model -->

<!-- end model for return order -->

<!-- model for cancel order -->

<!-- end model for cancel order -->


<!-- cancel order tracking  view -->

      @if($pendingdata->status == 'pending')
        <div class="stepper-wrapper">
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <!-- <div class="step-name">{{$pendingdata->created_at}}</div><br> -->
            <p>Order Received</p>
          </div>
            
          <div class="stepper-item">
            <div class="step-counter"></div>
            <!-- <div class="step-name">{{$pendingdata->created_at}}</div> -->
            <p>Shipment Dispatched</p>
          </div>

          <div class="stepper-item">
            <div class="step-counter"></div>
            <!-- <div class="step-name">{{$pendingdata->created_at}}</div> -->
            <p>Delivered</p>
          </div>

          <div class="stepper-item">
            <div class="step-counter"></div>
            <!-- <div class="step-name">{{$pendingdata->canceled_date}}</div><br> -->
            <p>Settlement Date</p>
          </div>
        </div>
      @elseif($pendingdata->return_status == 'intransit')
        <div class="stepper-wrapper">
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->created_at}}</div><br>
            <p>Return Approve</p>
          </div>
            
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->created_at}}</div>
            <p>In Transit</p>
          </div>
          <div class="stepper-item">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->canceled_date}}</div><br>
            <p>Deliverd</p>
          </div>
        </div>
      @elseif($pendingdata->return_status == 'completed')
        <div class="stepper-wrapper">
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->created_at}}</div><br>
            <p>Return Approve</p>
          </div>
            
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->created_at}}</div>
            <p>In Transit</p>
          </div>
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$pendingdata->canceled_date}}</div><br>
            <p>Deliverd</p>
          </div>
        </div>
      @else
      <h1>No Tracking</h1>
      @endif




<!-- end of cancel tracking order view -->


<!-- order return traking order view -->
    
   


<!-- end of order return tracking order view -->




    
</div>

@stop

@section('footer')

@stop