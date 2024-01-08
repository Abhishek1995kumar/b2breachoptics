@extends('admin.includes.master-admin')
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


/*end of cancel order tracking css*/




</style>



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
                <div class="go-title">
                    <div class="go-line"></div>
                    <div class="pull-right">
                        <a href="{!! url('admin/cancelorders') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <!--<img  class="card-img" width="100" height="100"  src="{{url('assets/images/products')}}/{{$allcanceldata->product_image}} " />-->
                            
                                @if($allcanceldata->maincolor != $allcanceldata->color)
                                    <img class="card-img" width="100" height="100" src="{{url('assets/images/product_attr')}}/{{$allcanceldata->product_image}} " />
                                @else
                                    <img class="card-img" width="100" height="100" src="{{url('assets/images/products')}}/{{$allcanceldata->product_image}} " />
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{$allcanceldata->product_title}}</b></h5>
                                    <p><b>Cancelled Date :-</b> {{$allcanceldata->canceled_date}}</p>
                                    <p><b>Cancel Reason  :-</b> {{$allcanceldata->canceled_reason != "" ? $allcanceldata->canceled_reason : "Reason Not Defined"}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5><b>Order Details</b></h5>
                                <p>Order Id:- {{$allcanceldata->order_number_new}}</p>
                                <p>Quantity:- {{$allcanceldata->quantity}}</p>
                                <p>SKU:- {{$allcanceldata->product_sku}}</p>
                                <p>Cost Price:- {{$allcanceldata->cost}}</p>
                                @if(isset($allcancelTax))
                                    <?php  
                                        $totalamount = ($allcancelTax->tax/100+1)*($allcanceldata->quantity*$allcanceldata->cost)
                                    ?>
                                    <p>Total:- {{$totalamount}}</p>
                                @else
                                @endif
                            </div>
                            <div class="col-md-2">
                                <h5><b>Buyer Details</b></h5>
                                <p>{{$allcanceldata-> buyer_name}}</p>
                                <p>{{$allcanceldata->buyer_city}}</p>
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

<!-- tracking view -->
<br><br><br><br>



@if($allcanceldata->status != 'cancelled' && $allcanceldata->status != 'return' )
    <div class="container pb-5 mb-sm-4">
        <!-- Details-->
        <div class="row mb-3">
            <div class="col-sm-4 mb-2">
                <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status:</span>{{$allcanceldata->status}}</div>
            </div>
            <div class="col-sm-4 mb-2">
                <!-- <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status:</span>{{$allcanceldata->status}}</div> -->
            </div>
            <div class="col-sm-4 mb-2">
                <!-- <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Expected date:</span></div> -->
            </div>
        </div>
        <br><br>
        <!-- Progress-->
        <div class="steps">
            <div class="steps-header">
                <div class="progress">
                    @if($allcanceldata->status == 'pending')
                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                     @elseif($allcanceldata->status == 'processing')
                           <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                     @elseif($allcanceldata->status == 'picked')
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($allcanceldata->status == 'intransit')
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($allcanceldata->status == 'completed')
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                </div>
            </div>
            <div class="steps-body">
                <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>Ordered<br>{{$allcanceldata->created_at}}</div>
                <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Order Process<br>{{$allcanceldata->order_accept_date}}</div>
                <div class="step step-active"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></span>Shipped<br>{{$allcanceldata->order_confirm_date}}</div>
                <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></span>Out Of Delivery<br>{{$allcanceldata->created_at}}</div>
                <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>Product delivered<br>{{$allcanceldata->created_at}}</div>
            </div>
        </div>
    </div>
 @endif
<!-- end tracking view -->

<!-- cancel order tracking  view -->

    @if($allcanceldata->status == 'cancelled')
        <div class="stepper-wrapper">
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$allcanceldata->created_at}}</div><br>
            <p>Ordered</p>
          </div>
          <div class="stepper-item completed">
            <!-- <div class="step-counter">2</div> -->
            <div class="step-name"></div>
          </div>
          <div class="stepper-item completed">
            <!-- <div class="step-counter">3</div> -->
            <div class="step-name"></div>
          </div>
          <div class="stepper-item completed">
            <div class="step-counter"></div>
            <div class="step-name">{{$allcanceldata->canceled_date}}</div><br>
            @if($allcanceldata->status == 'cancelled')
                <p>Order Cancelled By Admin</p>
                <p>{{$allcanceldata->entry_by}}</p>
            @elseif($allcanceldata->status == 'declined')
                <p>Order Cancelled By Buyer</p>
                <p>{{$allcanceldata->entry_by}}</p>
            @endif
          </div>
        </div>
    @endif

<!-- end of cancel tracking order view -->


<!-- order return traking order view -->
    
   


<!-- end of order return tracking order view -->




    
</div>

@stop

@section('footer')

@stop