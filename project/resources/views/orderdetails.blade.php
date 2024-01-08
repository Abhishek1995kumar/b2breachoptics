@extends('includes.newmaster')

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
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('user/orders') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="go-line"></div>
                </div>
                <br>
                <br>
                <!--@if(session()->has('message'))-->
                <!-- <div class="alert alert-success">-->
                <!--    {{ session()->get('message') }}-->
                <!-- </div>-->
                <!--@endif-->
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
                <div class="text-center">
                    <h1>Order Details</h1>
                    <hr>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                @if($order->maincolor != $order->color)
                                    <img class="card-img" src="{{url('assets/images/product_attr')}}/{{$order->product_image}} " />
                                @else
                                    <img class="card-img" src="{{url('assets/images/products')}}/{{$order->product_image}} " />
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">{{$order->product_title}}</h5>
                                    <p><b>Order Date :-</b> {{$order->created_at}}</p>
                                    <p><b>Order Id :-</b> {{$order->orderid}}</p>
                                    <p><b>SKU :-</b> {{$order->product_sku}}</p>
                                    <p><b>Color :-</b>@if($order->color == '') NA @else {{$order->color}} @endif @if($order->colorcode == '') <?php echo ""?> @else <?php echo "-"; ?> {{$order->colorcode}} @endif</p>
                                    <p><b>Size :-</b>@if($order->size == '') NA @else {{$order->size}} @endif</p>
                                    @if($order->order_payment_method == 'COD')
                                        <p><b>Order Type :-</b>Postpaid</p>
                                    @else
                                        <p><b>Order Type :-</b>Prepaid</p>
                                    @endif
                                        <?php $qty = $order->quantity ?>
                                        <?php $tax = $order->tax * $order->cost/100 ?>
                                        <?php $cost = $order->cost ?>
                                        <p><b>Quantity :-</b> {{ $order->quantity }}</p>
                                        <p><b>Unit Price :-</b> {{ $order->cost }}</p>
                                        <p><b>Total Amount :-</b> {{number_format((($order->tax * $order->cost)/100)+($order->quantity*$order->cost)),2}}</p>
                                                             
                                    @if($order->categoryID == 58 || $order->categoryID == 72)
                                    <p id="getPresDe">
                                        <b>Prescription Data :- </b>
                                        <a href="javascript:void(0)" onclick="getPresData({{$order->id}})"><i class="fa fa-eye"></i></a>
                                    </p>
                                    @endif
                                    
                                    @if($order->producttat != "")
                                        @if($order->status != "completed" && $order->status != "cancelled" && $order->status != "declined" && $order->status != "return")
                                            <?php $date = Carbon\Carbon::parse($order->created_at)->addDays($order->producttat); ?>
                                            <?php $date2 = Carbon\Carbon::parse($order->created_at)->addDays($order->producttat + 2); ?>
                                            <p><b>Estimated Shipping Date :-</b> {{$date->toDateString()}} <?php echo " to "?> {{$date2->toDateString()}} date</p>
                                        @endif
    
                                        @if($order->status == "return")
                                            <?php $date = Carbon\Carbon::parse($order->returnorder_date)->addDays($order->producttat); ?>
                                            <?php $date2 = Carbon\Carbon::parse($order->returnorder_date)->addDays($order->producttat + 2); ?>
                                            <p><b>Estimated Shipping Date :-</b> {{$date->toDateString()}} <?php echo " to "?> {{$date2->toDateString()}} date</p>
                                        @endif
                                    @endif
                                    <p><b>Order Note :-</b>@if($order->order_note == '') NA @else {{$order->order_note}} @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($order->status == 'completed' || $order->status == 'return' )
                       <button type="button" onclick="reviewSubmit()" class="btn btn-primary">Your Review</button>
                    @endif
                    @if($order->return_replaceorrefund  == 'Refund' && $order->status == 'return' )
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Your Order Has Been Return...!</h4>
                            <p>Your Refund Will Be Credited In Your Bank Account In 7 Working Days.</p>
                        </div>
                    @endif

                    @if($order->return_replaceorrefund  == 'Replace' && $order->status == 'return' )
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Your Order Is In Replacement...!</h4>
                            <p></p>
                        </div>
                    @endif


                    @if($order->status == 'completed')
                        <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Return Order</button>
                        <button type="button"  value="" onclick="taxinvoce({{$order->orderid}})" class="btn btn-primary showid"><i class="fa fa-sm fa-print"></i></button>
                        <!--<a href="{{url('user/downloadinvoice/')}}/{{$order->id}}" class="btn btn-info">Download Invoice</a>-->
                    @elseif($order->status == 'return' && $order->rtn_shipment_id == '')
                        @if($order->return_status != 'completed')
                            <a href="{{url('user/cancelreturnorder/')}}/{{$order->id}}" class="btn btn-danger btn-md" style="color: black;">Cancel Return Order</a>
                        @endif
                    @elseif($order->status == 'pending' || $order->status == 'processing' || $order->status == 'picked' || $order->status == 'shipped')
                        @if($order->status == 'cancelled')
                            <p style="font-size: 16px;">Order Cancelled</p>
                        @else
                            <a data-toggle="modal" data-target="#myModalnew" class="btn btn-danger btn-md" >Cancel Order</a>
                        @endif
                    @endif

                    @if($order->status == 'cancelled' || $order->status == 'declined')
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Your Order Has Been Cancel...! </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                @if(isset($allorder))
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <h4 style="border-bottom: 2px solid lightgrey;">Other Products Of This Order : -</h4>
                                </div>
                            </div>
                        </div>
                        @foreach($extraorder as $other)
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    @if($other[0]->maincolor == $other[0]->color)
                                        <img class="card-img" src="{{url('assets/images/products')}}/{{$other[0]->product_image}} " />
                                    @else
                                        <img class="card-img" src="{{url('assets/images/product_attr')}}/{{$other[0]->product_image}} " />
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <div class="card-body">
                                        <?php $date = Carbon\Carbon::parse($other[0]->created_at)->addDays($other[0]->producttat); ?>
                                        <h5 class="card-title">{{$other[0]->product_title}}</h5>
                                        <p><b>Order Date :-</b> {{$other[0]->created_at}}</p>
                                        <p><b>Order Id :-</b> {{$other[0]->orderid}}</p>
                                        <p><b>SKU :-</b> {{$other[0]->product_sku}}</p>
                                        <p><b>Color :-</b>@if($other[0]->color == '') NA @else {{$other[0]->color}} @endif @if($other[0]->colorcode != '') <?php echo " - "?> {{$other[0]->colorcode}} @endif</p>
                                        <p><b>Size :-</b>@if($other[0]->size == '') NA @else {{$other[0]->size}} @endif</p>
                                        @if($other[0]->order_payment_method == 'COD')
                                        <p><b>Order Type :-</b>Postpaid</p>
                                        @else
                                        <p><b>Order Type :-</b>Prepaid</p>
                                        @endif
                                        <p><b>Quantity :-</b> {{$other[0]->quantity}}</p>
                                        <p><b>Unit Price :-</b>  {{$other[0]->cost}}</p>
                                        @if($other[0]->status == 'cancelled' || $other[0]->status == 'declined')
                                            <p><b>Status :-</b>  <span style="color:red">Your Order Has Been Cancel...!</span></p>
                                        @else
                                            <p><b>Status :-</b>  <span style="color:green">{{$other[0]->status}}</span></p>
                                        @endif
                                        
                                        @if($other[0]->producttat != "")
                                            @if($other[0]->status != 'completed' && $other[0]->status != 'cancelled' && $other[0]->status != 'declined')
                                                <p><b>Estimated Shipping Date :-</b> {{$date->toDateString()}}</p>
                                            @endif
                                        @endif
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                
                                <div class="col-sm-1">
                                    @if($other[0]->status == 'completed')
                                        <button type="button" onclick="reviewSubmit()" class="btn btn-primary">Your Review</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
    
    <!-- Modal for return model -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reason For Return</h4>
                </div>
                <form method="POST" action="{!! action('UserProfileController@returnorder',['id' => $order->id]) !!}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Choose a Reason:</label>
                            </div>
                            <div class="col-md-8">
                                <select name="reason" id="returnreason" class="form-control" required>
                                    <option>Select Reason</option>
                                    <option value="Item didn't turn on an arrival/installation">Item didn't turn on an arrival/installation</option>
                                    <option value="Recieved a broken/damage item">Recieved a broken/damage item</option>
                                    <option value="Product is missing in the package">Product is missing in the package</option>
                                    <option value="Received Wrong Item">Received Wrong Item</option>
                                    <option value="Accessory Missing">Accessory Missing</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Comment:</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="comment"  placeholder="Comment..." class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Return Order Pickup Address:</label>
                            </div>
                            <div class="col-md-8">
                                @if($order->buyer_address != '' || $order->buyer_address2 != '')
                                    <textarea name="address" cols=48 rows=3 width="100%" value="{{$order->buyer_address}}  {{$order->buyer_address2}}">{{$order->buyer_address}}  {{$order->buyer_address2}}</textarea>
                                @else
                                    <textarea name="address"  placeholder="Comment..." class="form-control"></textarea>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Refund/Replace</label>
                            </div>
                            <div class="col-md-8">
                                  <input type="radio" id="html" name="replaceorrefund" value="Refund">
                                  <label for="Refund">Refund</label>
                                  <!--<input type="radio" id="css" name="replaceorrefund" value="Replace">-->
                                  <!--<label for="Replace">Replace</label>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" style="width: 20%;" onclick="call_return({{$order->id}})">Return</button>
                            <!-- <a href="{{url('user/returnorder/')}}/{{$order->id}}" class="btn btn-danger"> Return </a> -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end model for return order -->
    
    <!-- model for cancel order -->
    
    <div id="myModalnew" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reason For Cancellation</h4>
                </div>
                <form method="POST" action="{!! action('UserProfileController@ordercancel',['id' => $order->id]) !!}">
                    {{csrf_field()}}
                    <div class="modal-body"> 
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Choose a Reason:</label>
                            </div>
                            <div class="col-md-8">
                                <select name="cancelreason" id="reason" class="form-control" required>
                                  <option value="">Select Reason</option>
                                  <option value="I want to change the contact details">I want to change the contact details</option>
                                  <option value="I want to change size/color">I want to change size/color</option>
                                  <option value="I was hoping for a shorter delivery time">I was hoping for a shorter delivery time</option>
                                  <option value="I want to change the delivery address">I want to change the delivery address</option>
                                  <option value="I am worried about the ratings/reviews">I am worried about the ratings/reviews</option>
                                  <option value="I want to change the payment option">I want to change the payment option</option>
                                  <option value="Price of the product has now decreased">Price of the product has now decreased</option>
                                  <option value="Other Reason">Other Reason</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cars">Comment:</label>
                            </div>
                            <div class="col-md-8">
                                <textarea required name="cancelcomment"  placeholder="Comment..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" style="width: 20%;" onclick="call_cancel({{$order->id}})">Cancel</button>
                        <!-- <a href="{{url('user/returnorder/')}}/{{$order->id}}" class="btn btn-danger"> Return </a> -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-top: 20vh;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Prescription</h5>
            <button type="button" class="close" onclick="closeModal(event)" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-data" style="width:100%">
                
            </div>
        </div>
        <div class="modal-footer text-center">
            <button type="button" onclick="closeModal(event)" class="btn btn-secondary">Close</button>
        </div>
        </div>
      </div>
    </div>
    
    <div class="prescription-parameter"></div>
    
    <!-- end model for cancel order -->
    
    <!-- tracking view -->
    <br><br><br><br>
    
    
    
    @if($order->status != 'cancelled' && $order->status != 'return')
        <div class="container pb-5 mb-sm-4">
            <!-- Details-->
            <div class="row mb-3">
                <div class="col-sm-4 mb-2">
                    @if($order->status == 'picked')
                        <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status &nbsp; : &nbsp;</span>In Transit</div>
                    @elseif($order->status == 'declined')
                        <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status &nbsp; : &nbsp;</span>Cancel Order</div>
                    @else
                        <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status&nbsp; : &nbsp;</span>{{$order->status}}</div>
                    @endif
                </div>
                <div class="col-sm-4 mb-2">
                    <!-- <div class="bg-secondary p-4 text-dark text-center" style="padding-top: 12px;"><span class="font-weight-semibold mr-2">Status:</span>{{$order->status}}</div> -->
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
                        @if($order->status == 'pending')
                            <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                         @elseif($order->status == 'processing')
                               <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                         @elseif($order->status == 'picked')
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($order->status == 'intransit')
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($order->status == 'completed')
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                    </div>
                </div>
                <div class="steps-body">
                    <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>Ordered<br>{{$order->created_at}}</div>
                    <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Order Process<br>{{$order->order_accept_date}}</div>
                    <div class="step step-active"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></span>Shipped<br>{{$order->order_confirm_date}}</div>
                    <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></span>Out Of Delivery<br>
                        <p>Product not Scheduled</p>
                    </div>
                    <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
                        Product delivered<br>{{$order->created_at}}
                    </div>
                </div>
            </div>
        </div>
    @else
        <!--- code by Prashant --->
        <div class="container pb-5 mb-sm-4">
            <div class="steps">
                <div class="steps-header">
                    <div class="progress">
                        @if($order->status == 'cancelled')
                            <div class="progress-bar" role="progressbar" style="width: 100%; color:red;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                    </div>
                </div>
                <div class="steps-body">
                    <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>Ordered<br>{{$order->created_at}}</div>
                    <div class="step step-completed"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Order Process<br>{{$order->order_accept_date}}</div>
                    <div class="step step-active"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></span>Shipped<br>{{$order->order_confirm_date}}</div>
                    <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></span>Out Of Delivery<br>
                            
                            <p>Product not Scheduled</p>
                    </div>
                    <div class="step"><span class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
                        Product concelled<br>
                    </div>
                </div>
            </div>
        </div>
     @endif
<!-- end tracking view -->

<!-- cancel order tracking  view -->

    @if($order->status_code == 'cancelled')
        <div class="stepper-wrapper">
            <div class="stepper-item completed">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->created_at}}</div><br>
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
                <div class="step-name">{{$order->canceled_date}}</div><br>
                <p>Cancelled</p>
            </div>
        </div>
    @endif

<!-- end of cancel tracking order view -->


<!-- order return traking order view -->
    
    @if($order->status == 'return' && $order->return_replaceorrefund == 'Refund')
        <div class="stepper-wrapper">
            <div class="stepper-item completed">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->returnorder_date}}</div><br>
                <p>Return</p>
            </div>
            <div class="stepper-item">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->return_intransit_date}}</div><br>
                <p>Return Picked</p>
            </div>
            <div class="stepper-item">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->return_completed_date}}</div><br>
                <p>Refund</p>
            </div>
        </div>
    @endif

    @if($order->status == 'return' && $order->return_replaceorrefund == 'Replace')
        <div class="stepper-wrapper">
            <div class="stepper-item completed">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->created_at}}</div><br>
                <p>Replacement</p>
            </div>
            <div class="stepper-item ">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->canceled_date}}</div><br>
                <p>Approve</p>
            </div>
            <div class="stepper-item ">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->canceled_date}}</div><br>
                <p>Return Picked</p>
            </div>
            <div class="stepper-item ">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->canceled_date}}</div><br>
                <p>In Transit</p>
            </div>
            <div class="stepper-item ">
                <div class="step-counter"></div>
                <div class="step-name">{{$order->canceled_date}}</div><br>
                <p>Deliverd</p>
            </div>
        </div>
    @endif
<!-- end of order return tracking order view -->
</div>

<!-- for review template start -->
@include('components.productdetail.review')
<!-- for review template end -->

<div class="combine_order_table_modal">
</div>

@stop

<script src="{{ URL::asset('assets/js/user/userorder.js') }}"></script>

<script src="{{ URL::asset('assets/js/productdetail/productreview.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    async function taxinvoce(id)
    {
        $(".combine_order_table_modal").html('');
        try {
            let result = await combine_order_details(id);
            result.length > 0 && combine_order_modal_show(result, id);
            
            // console.log(result);
            // debugger;
            
            let total_order_amt = 0;
             $("#invoice_table > tbody > tr").each(function(index, value){
                 
                 let total_amount = parseFloat($(this).find(':last-child').text());
                 if(total_amount){
                     total_order_amt = total_order_amt + total_amount;
                 }
             })
             $("#show_total").text((total_order_amt).toFixed(2));
        } catch (error) {
            alert(error);
        }
    }
    // second part 

    const combine_order_details = (id) => {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:"{{route('buyer_invoice')}}",
                type:"POST",
                data:{
                    _token:$("input[name=_token]").val(),
                    orderid: id
                },
                success:function(response){
                    if(response.status){
                        resolve(response.order_details)
                    }
                },
                error: function(err) {
                    reject(err) 
                }
            });
        });
    }
    // 3 part

    const combine_order_modal_show = (combine_order_details_arr, order_pro_id) => {
        let combine_order_details = combine_order_details_arr;
        // ${combine_order_details[0].order_accept_date.split(' ')[0]
        let total = combine_order_details.cost + 5 + <?php echo round($settings[0]->shipping_cost,2); ?>;
        let options = `<div class="modal fade" id="${order_pro_id}_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="closeInvoice(${combine_order_details[0].status})" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                                    <h7 style="">${combine_order_details[0].order_accept_date ? combine_order_details[0].order_accept_date.split(' ')[0] : '-'}</h7>
                                                    
                                                </div>  
                                           </div>
                                        </div>    
                                        <div style="border-bottom: 1px solid black;display: flex;justify-content: center;padding-right: 45%;">
                                            <span><h7 style="font-weight:550;">Order Id:-</h7>${combine_order_details[0].orderid}</span>
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
                                        <h5><b style="">Billing Address</b></h5>
                                        <div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>
                                        <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                        <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                        <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>
                                    </div>
                                    <div style="width: 54%; margin-left: 13px;padding:15px;line-height: 18px;border-left: 1px solid black;">
                                        <h5 style=""><b>Shipping Address</b></h5>`;
                                        
                                            if(combine_order_details[0].shipping_address)
                                            {
                                                options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].shipping_name}</div>`;
                                                options +=  `<div style =""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_address}.${combine_order_details[0].shipping_address2}.${combine_order_details[0].shipping_city}.${combine_order_details[0].shipping_state}.${combine_order_details[0].customer_zip}</div>`;
                                                // if(combine_order_details[0].shipping_address2)
                                                // {
                                                //     options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_address}.${combine_order_details[0].shipping_address2}</div>`
                                                // }
                                               
                                                
                                                // if(combine_order_details[0].shipping_city)
                                                // {
                                                //     options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_city}</div>`
                                                // }
                                               
                                                
                                                // if(combine_order_details[0].shipping_state)
                                                // {
                                                //     options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_state}</div>`
                                                // }
                                               
                                                
                                                if(combine_order_details[0].shipping_zip)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_zip}</div>`
                                                }
                                               
                                                
                                                if(combine_order_details[0].shipping_phone)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].shipping_phone}</div>`
                                                }else{
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].shipping_phone}  </div>`
                                                }
                                            }
                                            else
                                            {
                                            options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>`;
                                            }
                                        options += `<div style=""><h7 style="font-weight:550;">Email ID:-</h7>${combine_order_details[0].customer_email}</div>
                                    </div>
                                </div>
                               
                                <div style="display:flex; overflow-y:auto;border-top:1px solid black;" >
                                    <table  id="invoice_table" style="height:46px; width: 100%; border-collapse: collapse; border-style: solid;" border="1">
                                        <thead style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                            <tr style="background-color: red;color: white;text-align: center;">
                                                <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">SrNo</th>
                                                <th style="width: 46%;text-align: center; font-size: 9px;border-left: 1px solid black;">DESCRIPTION OF GOODS</th>
                                                <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">Model No</th>
                                                <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">HSN Code</th>
                                                <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">Color Code</th>
                                                <th style="width: 7%;text-align: center; font-size: 9px;border-left: 1px solid black;">Rate</th>
                                                <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">Qty</th>`
                                                if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state == "22"){
                                                options += `<th style="width: 6%;text-align: center;font-size: 8px;border-left: 1px solid black;">CGST%</th>
                                                <th style="width: 6%;text-align: center;font-size: 8px;border-right: 1px solid black;">SGST%</th>`;
                                                }else{
                                                options += `<th style="width: 6%;text-align: center; font-size: 8px;border-left: 1px solid black;border-right: 1px solid black;">IGST%</th>`;
                                                }
                                                options += `<th style="width: 7%;text-align: center; font-size: 8px;border-right: 1px solid black;">GST Amount</th>
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
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;"></td>`;
                                                }

                                                if(combine_order_details[i].hsncode){
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].hsncode != '' ? combine_order_details[i].hsncode : '--' }</td>`;
                                                }
                                                else{
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;"></td>`;
                                                }

                                                if(combine_order_details[i].colorcode){
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].colorcode != '' ? combine_order_details[i].colorcode : '--' }</td>`;
                                                }
                                                else{
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;"></td>`;
                                                }

                                                if(combine_order_details[i].hsncode){
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].cost_price != '' ? combine_order_details[i].cost_price : '--' }</td>`;
                                                }
                                                else{
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;"></td>`;
                                                }

                                                if(combine_order_details[i].quantity){
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].quantity != '' ? combine_order_details[i].quantity : '--' }</td>`;
                                                }
                                                else{
                                                   options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;"></td>`;
                                                }


                                                if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state  == "22"){
                                                  
                                                    if(combine_order_details[i].categoryID == '63' || combine_order_details[i].categoryID == 63 || combine_order_details[i].categoryID == '53' || combine_order_details[i].categoryID == '72' || combine_order_details[i].categoryID == '58'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                        ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                            combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)
                                                        }</td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                        ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                            combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)
                                                        }</td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                        ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                            combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)
                                                        }</td>`
                                                    }
                                                }else{
                                                    if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                        options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                        ${combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                            combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)
                                                        }</td>`
                                                    }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                        options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                        <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                        ${combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                            combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100).toFixed(2)
                                                        }</td>`
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
                                    <div style="margin-left: 132px;">Elrica Global Interprises PVT LTD</div><br>
                                </div>
                                <div style="display:flex;">
                                    <div style="width: 50%;">
                                        <div style="margin-left: 7px;">Terms and Conditions</div>
                                        <div style="margin-left: 50px;font-size: 7px;">1 Total Payment Due in 90 Days.</div>
                                        <div style="margin-left: 50px;font-size: 7px;">2 Please include the Invoice No. on your Cheque.</div>
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
                                                <td style="text-align: center;font-size: 9px; border: none;"></td>
                                            </tr>`)
        }

        $('#'+order_pro_id+'_pdf').modal();
    }
</script>

@section('footer')

@stop