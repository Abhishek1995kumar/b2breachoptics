<style>
    #payment_form input {
        font-weight : 500;
    }
    ::placeholder {
        font-weight: 400;
    }
    #payment_form input[type=text]{
        font-weight: bold;
    }
    
    #payment_form select[name=Country] option{
        font-weight: bold;
    }
    
    #payment_form input[type=number]{
        font-weight: bold;
    }
    #payment_form input[type=email]{
        font-weight: bold;
    }
    #payment_form order_notes{
        font-weight: bold;
    }

    .apply_coupon_code {
        cursor: pointer;
        color: #e90505;
        width: 17%;
    }

    .apply_coupon_code:hover {
        font-style: italic;
    }
    
    .billing-name-link{
        display: flex;
        gap:52%;
        bottom: 20px;
    }
    
    @media screen and (min-width:0px) and (max-width:768px)
    {
        .billing-name-link{
            display: flex;
            flex-direction: column;
            gap: 1px;
            bottom: 0px;
        }
        
        .billing-details-area {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    }
    
</style>

@extends('includes.newmaster')
@section('content')
    <div class="home-wrapper">
        <!-- Starting of product shipping form -->
        <div class="section-padding product-shipping-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="product-shipping-full-div">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="signIn-title">{{$language->order_details}}</h2> &nbsp;
                                    <hr/>
                                    <div class="pricing-list">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th width="20%">{{$language->product_name}}</th>
                                                <th width="20%">Product Size</th>
                                                <th width="20%">{{$language->quantity}}</th>
                                                <th width="10%">GST%</th>
                                                <th width="10%">Unit Price</th>
                                                <th width="10%">{{$language->subtotal}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cartdata as $cart)
                                                <tr>
                                                    <td><a href="{{url('/product')}}/{{$cart->product}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($cart->product)->title))}}" target="_blank">{{$cart->title}}</a></td>
                                                    <td>{{$cart->size}}</td>
                                                    <td>{{$cart->quantity}}</td>
                                                    @if($cart->category == 82)
                                                        @if($cart->precat != '')
                                                            <!--<td>{{$cart->precat}}</td>-->
                                                            @if($cart->precat == "Sunglasses")
                                                                <td>18</td>
                                                            @else
                                                                <td>12</td>
                                                            @endif
                                                        @endif
                                                    @else
                                                    
                                                    @if($cart->category == 58)
                                                        <td>12</td>
                                                    @else
                                                        <td>{{$cart->tax_rate}}</td>
                                                    @endif
                                                    @endif
                                                    @if($cart->category == 58)
                                                        <td>{{$settings[0]->currency_sign}}{{$cart->main_price}}</td>
                                                    @else
                                                        <td>{{$settings[0]->currency_sign}}{{$cart->main_price}}</td>
                                                    @endif
                                                        
                                                        
                                                    @if($cart->category == 82)
                                                        @if($cart->precat != '')
                                                            @if($cart->precat == "Sunglasses")
                                                                <td>{{$settings[0]->currency_sign}} {{($cart->cost/100*18)+$cart->cost}}</td>
                                                            @else
                                                                <td>{{$settings[0]->currency_sign}} {{($cart->cost/100*12)+$cart->cost}}</td>
                                                            @endif
                                                        @endif
                                                    @elseif($cart->category == 58)  
                                                        <td>{{$settings[0]->currency_sign}} {{$cart->cost*(12/100)+$cart->cost}}</td>
                                                    @else
                                                        <td>{{$settings[0]->currency_sign}} {{($cart->cost/100*$cart->tax_rate)+$cart->cost}}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table" id="coupon_discount"></table>
                                        <table class="table">
                                            <tr id="shipshow">
                                                <td><strong>{{$language->shipping_cost}}:</strong></td>
                                                <td width="20%"><strong>{{$settings[0]->currency_sign}}<span id="ship-cost">{{round($settings[0]->shipping_cost,2)}}</span></strong></td>
                                            </tr>
                                            <tr hidden id="shipshow">
                                                <td><strong>Discount</strong></td>
                                                <td width="20%"><strong><span id="ship-cost">{{round($settings[0]->fixed_commission,2)}} %</span></strong></td>
                                            </tr>
                                            <tr>
                                                <td><h3>{{$language->total}}:</h3></td>
                                                @if($cart->category == 58)
                                                    <td width="20%"><h3>{{$settings[0]->currency_sign}}<span id="total-cost">{{round($total,2)}}</span></h3></td>
                                                @else
                                                    <td width="20%"><h3>{{$settings[0]->currency_sign}}<span id="total-cost">{{round($total,2)}}</span></h3></td>
                                                @endif
                                                <td hidden width="20%"><h3>{{$settings[0]->currency_sign}}<span id="clone-total-cost">{{round($total,2)}}</span></h3></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @if(Auth::guard('profile')->guest())
                                @else
                                <form  action="" method="post" id="payment_form">
                                    {{csrf_field()}}
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                        <div class="billing-details-area">
                                            <div class="col-sm-12 billing-name-link">
                                                <h2 class="signIn-title col-sm-12">Billing Details</h2>
                                                <div class="detail_coupon col-sm-6" style="display: flex; flex-direction: column; align-items: center;">
                                                    <a id="get_coupon_link" href="javascript:void(0)" onclick="paytmLink()">Get Coupon Code <i class="fa fa-arrow-right"></i></a>
                                                    <p type="button" width="30%" onclick="openCouponInput()" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Apply Coupon Code</p>
                                                </div>
                                            </div>
                                            <hr/>
                                            <hr/>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                <div class="form-group">
                                                    <select style="font-weight: bold;" class="form-control" onChange="sHipping(this)" id="shipop" name="shipping" required style=" font-weight : 500;">
                                                        <option value="shipto" selected>Ship To Address</option>
                                                        <option value="pickup">Pick Up</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                <div class="form-group">
                                                <select name="method" id="paymentType" onchange="paymentMode(this)" class="form-control" style=" font-weight : 500; font-weight: bold;" required>
                                                    <option value="" selected>Select Payment Method</option>
                                                    @if($settings[0]->razorpay_status == 1)
                                                        <option value="Razorpay">Razorpay</option>
                                                    @endif
                                                    @if($settings[0]->paypal_status == 1)
                                                        <option value="Paypal">Paypal</option>
                                                    @endif
                                                    @if($settings[0]->stripe_status == 1)
                                                        <option value="Stripe">Credit Card</option>
                                                    @endif
                                                    @if($settings[0]->mobile_status == 1)
                                                        <option value="Mobile">Mobile Money</option>
                                                    @endif
                                                    @if($settings[0]->bank_status == 1)
                                                        <option value="Bank">Bank Wire</option>
                                                    @endif
                                                    @if($settings[0]->cash_status == 1)
                                                        <option value="Cash">Cash On Delivery</option>
                                                    @endif
                                                    <!--@if($settings[0]->payment_90_days == 1)-->
                                                    <!--    <option value="Payment">Payment Terms with in 90 Days Credit Period</option>-->
                                                    <!--@endif-->
                                                    @if($settings[0]->payment_paytm_coupon == 1)
                                                        <option value="Paytm">Paytm Coupon Code</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div id="mobile" style="display: none;">
                                                <div class="form-group">
                                                    <strong>{{$settings[0]->mobile_money}}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <label for="shippingFull_name">Transaction ID# <span>*</span></label>
                                                    <input  type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">
                                                </div>
                                            </div>
                                            <div id="bank" style="display: none;">
                                                <div class="form-group">
                                                    <strong>Bank {{$settings[0]->bank_wire}}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <label for="shippingFull_name">Transaction ID# <span>*</span></label>
                                                    <input type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">
                                                </div>
                                            </div>
                                            <div id="stripes" style="display: none;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="card" placeholder="Card">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="cvv" placeholder="Cvv">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="month" placeholder="Month">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="year" placeholder="Year">
                                                </div>
                                            </div>
                                            <input type="hidden" name="total" id="grandtotal" value="{{round($total,2)}}" />
                                            <input type="hidden" name="products" value="{{$product}}" />
                                            <input type="hidden" name="quantities" value="{{$quantity}}" />
                                            <input type="hidden" name="sizes" value="{{$sizes}}" />
                                            <input type="hidden" name="color" value="{{$color}}" />
                                            <input type="hidden" name="categoryID" value="{{$category}}" />
                                            <input type="hidden" name="cost" value="{{$mainprice}}" />
                                            <input type="hidden" name="maincolor" value="{{$maincolor}}" />
                                            <input type="hidden" name="productImage" value="{{$productImage}}">
                                            <input type="hidden" name="gstAmount" value="{{$gstAmount}}">
                                            
                                            <input type="hidden" name="premiumtype" value="{{$premiumtype}}">
                                            <input type="hidden" name="productAttrId" value="{{$attrid}}">
                                            <input type="hidden" name="colorcode" value="{{$colorcode}}">
                                            <input type="hidden" name="coupons">
                                            <input type="hidden" name="couponAmount">

                                            <div id="paypals">
                                                <input type="hidden" name="cmd" value="_xclick" />
                                                <input type="hidden" name="no_note" value="1" />
                                                <input type="hidden" name="lc" value="INDIA" />
                                                <input type="hidden" name="currency_code" value="INR" />
                                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                            </div>
                                        </div>
                                        @endif
                                        <div id="pick" style="display:none;">
                                            <div class="form-group">
                                                <select style="font-weight: bold;" class="form-control" name="pickup_location">
                                                    <option value="">Select a PickUp Location</option>
                                                    @foreach($pickups as $pickup)
                                                        <option value="{{$pickup->address}}">{{$pickup->address}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                         
                                        @if(Auth::guard('profile')->guest())
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">full name <span>*</span></label>-->
                                            <!--    <input type="text" class="form-control" name="name" value="" placeholder="Full Name" required>-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">Phone Number <span>*</span></label>-->
                                            <!--    <input type="text" class="form-control" name="phone" value="" placeholder="Phone Number" required>-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">Email <span>*</span></label>-->
                                            <!--    <input type="email" class="form-control" name="email" value="" placeholder="Email" required>-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">Address <span>*</span></label>-->
                                            <!--    <input type="text" class="form-control" name="address" value="" placeholder="Address" required>-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">City <span>*</span></label>-->
                                            <!--    <input type="text" class="form-control" name="city" value="" placeholder="City" required>-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="shippingFull_name">Postal Code <span>*</span></label>-->
                                            <!--    <input type="text" class="form-control" name="zip" value="" placeholder="Postal Code" required>-->
                                            <!--</div>-->
                                            <!--<input type="hidden" name="customer" value="0" />-->
                                        @else
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">Buyer Name <span>*</span></label>
                                                    <input id="full_name" style="font-weight: bold;" type="text" class="form-control" name="name" value="{{Auth::guard('profile')->user()->bussiness_name}}" placeholder="e.g. John Smith" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">phone <span>*</span></label>
                                                    <input type="number" class="form-control" name="phone" value="{{Auth::guard('profile')->user()->phone}}" placeholder="e.g. 99******99" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">email address <span>*</span></label>
                                                    <input type="email" class="form-control" name="email" value="{{Auth::guard('profile')->user()->email}}" placeholder="e.g. smith@gmail.com" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">Zip / Postal Code <span>*</span></label>
                                                    <input type="number" class="form-control" name="zip" value="{{Auth::guard('profile')->user()->zip}}" placeholder="e.g. 400001" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">address line 1 <span>*</span></label>
                                                    <input type="text" class="form-control" name="address" value="{{Auth::guard('profile')->user()->address}}" placeholder="House / Flat number" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">address line 2<span>*</span></label>
                                                    <input type="text" class="form-control" name="address2" value="{{Auth::guard('profile')->user()->address2}}" placeholder="Area, Street & Landmark  " required>
                                                </div>
                                            </div>
    
                                            @if($buyerdetail[0]->country != "")
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">Country <span>*</span></label>
                                                        <input type="text" class="form-control" value="{{DB::table('b2b_countrymaster')->where('id', Auth::guard('profile')->user()->country)->get()[0]->Name}}" placeholder="e.g. India">
                                                        <input type="hidden" class="form-control" name="country" value="{{DB::table('b2b_countrymaster')->where('id', Auth::guard('profile')->user()->country)->get()[0]->id}}" placeholder="e.g. India" required>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">Country <span>*</span></label>
                                                        <select type="text" id="countries" class="form-control" name="country" onchange="selectCountry()" required>
                                                            <option class="bold-option">Select Country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}" <?php old('country') == "{{$country->Name}}" ? "selected" : "" ?> >{{$country->Name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
    
                                            @if($buyerdetail[0]->state != "")
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">State / Province <span>*</span></label>
                                                        <input type="text" class="form-control" value="{{DB::table('b2b_statemaster')->where('id', Auth::guard('profile')->user()->state)->get()[0]->Name}}" placeholder="e.g. Maharashtra">
                                                        <input type="hidden" class="form-control" name="state" value="{{DB::table('b2b_statemaster')->where('id', Auth::guard('profile')->user()->state)->get()[0]->id}}" placeholder="e.g. Maharashtra" required>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">State / Province <span>*</span></label>
                                                        <select type="text" id="allstates" class="form-control" name="state" onchange="selectState()" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
    
                                            @if($buyerdetail[0]->city != "")
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">Town / City <span>*</span></label>
                                                        <input type="text" class="form-control" value="{{DB::table('b2b_citymaster')->where('id', Auth::guard('profile')->user()->city)->get()[0]->Name}}" placeholder="e.g. Mumbai">
                                                        <input type="hidden" class="form-control" name="city" value="{{DB::table('b2b_citymaster')->where('id', Auth::guard('profile')->user()->city)->get()[0]->Id}}" placeholder="e.g. Mumbai" required>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                                    <div class="form-group">
                                                        <label for="shippingFull_name">Town / City <span>*</span></label>
                                                        <select type="text" id="allcities" class="form-control" name="city" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                                <div class="form-group">
                                                    <label for="shippingFull_name">Alternate Phone <span>*</span></label>
                                                    <input type="number" class="form-control" name="alternate_phone" value="{{Auth::guard('profile')->user()->alternate_phone}}" placeholder="e.g. 99******99" required>
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" name="customer" value="{{Auth::guard('profile')->user()->id}}" />
                                        @endif
                                        @if(Auth::guard('profile')->guest())
                                        @else
                                        <!--    <div class="form-group">-->
                                                
                                        <!--        <label>select Payment Method <span>*</span></label>-->
                                        <!--        <select name="method" onChange="payemntMethod(this)" class="form-control" required>-->
                                        <!--            <option value="" selected>Select Payment Method</option>-->
                                        <!--            @if($settings[0]->paypal_status == 1)-->
                                        <!--                <option value="Paypal">Paypal</option>-->
                                        <!--            @endif-->
                                                    <!--@if($settings[0]->stripe_status == 1)-->
                                                    <!--    <option value="Stripe">Credit Card</option>-->
                                                    <!--@endif-->
                                                    <!--@if($settings[0]->mobile_status == 1)-->
                                                    <!--    <option value="Mobile">Mobile Money</option>-->
                                                    <!--@endif-->
                                                    <!--@if($settings[0]->bank_status == 1)-->
                                                    <!--    <option value="Bank">Bank Wire</option>-->
                                                    <!--@endif-->
                                        <!--            @if($settings[0]->cash_status == 1)-->
                                        <!--                <option value="Cash">Cash On Delivery</option>-->
                                        <!--            @endif-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--<div id="mobile" style="display: none;">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <strong>{{$settings[0]->mobile_money}}</strong>-->
                                        <!--    </div>-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label for="shippingFull_name">Transaction ID# <span>*</span></label>-->
                                        <!--        <input type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div id="bank" style="display: none;">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <strong>Bank {{$settings[0]->bank_wire}}</strong>-->
                                        <!--    </div>-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label for="shippingFull_name">Transaction ID# <span>*</span></label>-->
                                        <!--        <input type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div id="stripes" style="display: none;">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <input type="text" class="form-control" name="card" placeholder="Card">-->
                                        <!--    </div>-->
                                        <!--    <div class="form-group">-->
                                        <!--        <input type="text" class="form-control" name="cvv" placeholder="Cvv">-->
                                        <!--    </div>-->
                                        <!--    <div class="form-group">-->
                                        <!--        <input type="text" class="form-control" name="month" placeholder="Month">-->
                                        <!--    </div>-->
                                        <!--    <div class="form-group">-->
                                        <!--        <input type="text" class="form-control" name="year" placeholder="Year">-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!--<input type="hidden" name="total" id="grandtotal" value="{{round($total,2)}}" />-->
                                        <!--<input type="hidden" name="products" value="{{$product}}" />-->
                                        <!--<input type="hidden" name="quantities" value="{{$quantity}}" />-->
                                        <!--<input type="hidden" name="sizes" value="{{$sizes}}" />-->

                                        <!--<div id="paypals">-->
                                        <!--    <input type="hidden" name="cmd" value="_xclick" />-->
                                        <!--    <input type="hidden" name="no_note" value="1" />-->
                                        <!--    <input type="hidden" name="lc" value="UK" />-->
                                        <!--    <input type="hidden" name="currency_code" value="{{$settings[0]->currency_code}}" />-->
                                        <!--    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                @endif
                                @if(Auth::guard('profile')->guest())
                                @else
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <div class="shipping-title">
                                        <label id="ship-diff">
                                            <input class="shippingCheck" type="checkbox" value="check"> {{$language->ship_to_another}}
                                        </label>
                                        <label id="pick-info" style="display: none">
                                            {{$language->pickup_details}}
                                        </label>
                                    </div>
                                    <hr/>
                                    <div class="shipping-details-area">
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                            <div class="form-group">
                                                <label for="shippingFull_name">full name <span>*</span></label>
                                                <input class="form-control" placeholder="e.g. John Smith" type="text" name="shipping_name" id="shippingFull_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                            <div class="form-group">
                                                <label for="shipingPhone_number">Phone Number <span>*</span></label>
                                                <input class="form-control" placeholder="e.g. 99******99" type="number" name="shipping_phone" id="shipingPhone_number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                            <div class="form-group">
                                                <label for="ship_email">Email Address <span>*</span></label>
                                                <input class="form-control" placeholder="e.g. smith@gmail.com" type="email" name="shipping_email" id="ship_email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                            <div class="form-group">
                                                <label for="shippingPostal_code">zip / postal code <span>*</span></label>
                                                <input class="form-control" placeholder="e.g. 400001" type="number" name="shipping_zip" id="shippingPostal_code">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                            <div class="form-group">
                                                <label for="shipping_address">address line 1  <span>*</span></label>
                                                <input class="form-control" type="text" name="shipping_address" id="shipping_address" placeholder="House / Flat number">
                                                <!--<textarea class="form-control" placeholder="e.g. John Smith" placeholder="e.g." name="shipping_address" id="shipping_address" cols="30" rows="1" style="resize: vertical;"></textarea>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                            <div class="form-group">
                                                <label for="shipping_address2">address line 2  <span>*</span></label>
                                                <input class="form-control" type="text" name="shipping_address2" id="shipping_address2" placeholder="Area, Street & Landmark">
                                                <!--<textarea class="form-control" name="shipping_address" id="shipping_address" cols="30" rows="1" style="resize: vertical;"></textarea>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                            <div class="form-group">
                                                <label for="shipping_country">Country <span>*</span></label>
                                                <select type="text" id="shipping_country" class="form-control" name="shipping_country" onchange="selectCountryAlter()" required>
                                                    <option class="bold-option">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}" <?php old('country') == "{{$country->Name}}" ? "selected" : "" ?> >{{$country->Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                            <div class="form-group">
                                                <label for="shipping_state">State / Province <span>*</span></label>
                                                <select type="text" id="shipping_state" class="form-control" name="shipping_state" onchange="selectStateAlter()" >
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-left-0">
                                            <div class="form-group">
                                                <label for="shipping_city">Town / City <span>*</span></label>
                                                <select type="text" id="shipping_city" class="form-control" name="shipping_city" >
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">
                                            <div class="form-group">
                                                <label for="shipping_alternate_phone">Alternate Phone number <span>*</span></label>
                                                <input class="form-control" placeholder="e.g. 99******99" type="text" name="shipping_alternate_phone" id="shipping_alternate_phone">
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-6 col-md-3 col-sm-12 col-xs-12 padding-right-0">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label for="shippingPostal_code">postal code <span>*</span></label>-->
                                        <!--        <input class="form-control" type="text" name="shipping_zip" id="shippingPostal_code">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="form-group">
                                        <label for="order_notes">order notes</label>
                                        <textarea style="font-weight: bold;" class="form-control order-notes" name="order_note" id="order_notes"  style=" font-weight : 500;" cols="30" rows="5" style="resize: vertical;"></textarea>
                                    </div>
                                </div>
                                @endif
                                    @if(Auth::guard('profile')->guest())
                                        <div class="text-center">
                                            <a href="{{route('user.login').'?checkout=true'}}" class="continue_btn">CONTINUE</a>
                                        </div>
                                    @else
                                        <div class="row text-center" id="order_payment">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of product shipping form -->

    </div>

    
<div class="modal fade bd-example-modal-sm" id="couponModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="input-group w-auto" style="display: flex;">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Coupon Code"
                        aria-label="Example input"
                        aria-describedby="button-addon1" id="coupon_code_input" name="coupon" />
                    <button class="btn btn-primary" onclick="couponSubmit()" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

<script type="text/javascript" src="{{ URL::asset('assets/js/checkout.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('footer')
    <script type="text/javascript">
        // window.onload = () => {
        //     $("#get_coupon_link").hide();
        // }
        
        function paymentMode(e) {
            console.log(e.value == "Razorpay")
            $("#order_payment").find("div").html("");
            if(e.value == "Razorpay"){
                $("#order_payment").find("div").append(`<input class="btn btn-md order-btn" type="submit" value="Payment">`);
            }
            else if(e.value == "Cash"){
                $("#order_payment").find("div").append(`<input class="btn btn-md order-btn" type="submit" value="Order Now">`);
            }
            else{
                $("#order_payment").find('div').append(`<input class="btn btn-md order-btn" id="" value="please select payment mode">`);
            }
                    
            var action1 = mainurl + "/payment";;
            var action2 = mainurl + "/cashondelivery";
            var action3 = mainurl + "/cashondelivery";
            var action4 = mainurl + "/mobile_money";
            var action5 = mainurl + "/bank_wire";
            if (e.value == "Mobile") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action4);
                $("#stripes").hide();
                $("#mobile").show();
                $("#bank").hide();
            }
            if (e.value == "Bank") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action5);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").show();
            }
            if (e.value == "Paypal") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action1);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
            
            if (e.value == "Razorpay") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action1);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
            
            if (e.value == "Stripe") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action2);
                $("#stripes").show();
                $("#mobile").hide();
                $("#bank").hide();
            }
            if (e.value == "Cash") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action3);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
            if (e.value == "Payment") {
                $("#get_coupon_link").hide();
                $("#payment_form").attr("action", action3);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
            if (e.value == "Paytm") {
                $("#get_coupon_link").show();
                $("#payment_form").attr("action", action3);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
        }

        function sHipping(val) {
            var shipcost = parseFloat($("#ship-cost").html());
            var totalcost = parseFloat($("#total-cost").html());
            var total = 0;

            if (val.value == "shipto") {
                total = shipcost + totalcost;
                $("#pick").hide();
                $("#ship-diff").show();
                $("#pick-info").hide();
                $("#shipshow").show();
                $("#total-cost").html(total);
                $("#grandtotal").val(total);
                $("#shipto").find("input").prop('required',true);
                $("#pick").find("select").prop('required',false);
            }

            if (val.value == "pickup") {
                total = totalcost - shipcost;
                $("#pick").show();
                $("#pick-info").show();
                $("#ship-diff").hide();
                $("#shipshow").hide();
                $("#total-cost").html(total);
                $("#grandtotal").val(total);
                $("#shipto").find("input").prop('required',false);
                $("#pick").find("select").prop('required',true);
            }
        }

    </script>
@stop














