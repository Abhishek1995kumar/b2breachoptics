@extends('includes.newmaster')

@section('content')

    <div class="home-wrapper">
        <!-- Starting of add to cart table -->
        <div class="section-padding product-shoppingCart-wrapper wow fadeInUp" style="padding-top: 5px !important">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12"> 
                        <div class="table-responsive"  style="padding: 5px 10px !important">
                            <div class="breadcrumb-box" style="margin-bottom: 0px;">
                                <a href="{{url('/home')}}">Home</a>
                                <a href="{{url('/cart')}}">My Cart</a>
                            </div>                            
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Remove</th>
                                    <th>Image</th>
                                    <th width="15%">{{$language->product_name}}</th>
                                    <th>Product Size</th>
                                    <th>Prescription</th>
                                    <th>Quantity</th>
                                    <th>Left Eye</th>
                                    <th>Right Eye</th>
                                    <th>{{$language->unit_price}}</th>
                                    <th>{{$language->subtotal}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                @if(isset($carts))
                                @forelse($carts as $cart)
                                <tr id="item{{$cart->product}}">
                                    <td><a onclick="getDelete({{$cart->product}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                        @if($cart->cartcolor == $cart->maincolor)
                                            <td><img src="{{url('/assets/images/products')}}/{{\App\Product::findOrFail($cart->product)->feature_image}}" alt=""></td>
                                        @else
                                            <td>
                                                @if(count($data))
                                                    @if($data->attr_imgs !='')
                                                    <img src="{{url('/assets/images/product_attr')}}/{{$data->attr_imgs}}" alt="">
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                    <td>
                                        <a href="{{url('/product')}}/{{$cart->product}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($cart->product)->title))}}" class="product-name-header">{{$cart->title}}</a>
                                    </td>

                                    <td>
                                    @if($cart->lefteyequantity === null)
                                        {{$cart->size}}
                                    @endif  
                                    </td>

                                    <td id="eye_image">
                                    @if($cart->lefteyequantity != null)
                                       @if($cart->priscriptionohoto === null)
                                      <a data-toggle="modal" data-target="#view_{{$cart->product}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                       @else
                                      <a data-toggle="modal" data-target="#exampleModal{{$cart->product}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                      @endif
                                    @endif  
                                      
                                    </td>
                                    
                                    <td>
                                        @if($cart->lefteyequantity === null)
                                            <p class="cart-btn">
                                                <span class="quantity-cart-minus" id="minus{{$cart->product}}"><i class="fa fa-minus"></i></span>
                                                <span class="qty_1" id="number{{$cart->product}}">{{$cart->quantity}}</span>
                                                <span class="quantity-cart-plus" id="plus{{$cart->product}}"><i class="fa fa-plus"></i></span>
                                            </p>
                                            <td></td><td></td>
                                        @else
                                            <p>
                                            <span>{{$cart->quantity}}</span>
                                            </p>
                                            <p class="cart-btn">
                                                <td class="left-qty">{{$cart->lefteyequantity}}</td>
                                                <td class="right-qty">{{$cart->righeyequantity}}</td>
                                            </p>

                                        @endif
                                    </td>

                                    <form id="citem{{$cart->product}}">
                                        {{csrf_field()}}
                                        @if(Session::has('uniqueid'))
                                            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                        @else
                                            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                        @endif
                                        <input type="hidden" name="title" value="{{$cart->title}}">
                                        <input type="hidden" id="price_update{{$cart->product}}" name="price" value="{{$cart->price}}">
                                        <input type="hidden" id="main_price{{$cart->product}}" value="{{$cart->main_price}}">
                                        <input type="hidden" id="rangenameone{{$cart->product}}" name="rangenameone" value="{{$cart->rangenameone}}">
                                        <input type="hidden" id="rangenametwo{{$cart->product}}" name="rangenametwo" value="{{$cart->rangenametwo}}">
                                        <input type="hidden" id="rangenamethree{{$cart->product}}" name="rangenamethree" value="{{$cart->rangenamethree}}">
                                    
                                        <input type="hidden" id="discount_one{{$cart->product}}" name="discount_one" value="{{$cart->discount_one}}">
                                        <input type="hidden" id="discount_two{{$cart->product}}" name="discount_two" value="{{$cart->discount_two}}">
                                        <input type="hidden" id="discount_three{{$cart->product}}" name="discount_three" value="{{$cart->discount_three}}">

                                        <input type="hidden" name="product" value="{{$cart->product}}">
                                        <input type="hidden" id="cost{{$cart->product}}" name="cost" value="{{$cart->cost}}" autocomplete="off">
                                        <input type="hidden" id="quantity{{$cart->product}}" name="quantity" value="{{$cart->quantity}}">
                                        <input type="hidden" id="size{{$cart->product}}" name="size" value="{{$cart->size}}">
                                    </form>
                                    <td>{{$settings[0]->currency_sign}}<span id="price{{$cart->product}}">{{$cart->price}}</span></td>
                                    <td>{{$settings[0]->currency_sign}}<span id="subtotal{{$cart->product}}" class="subtotal">{{$cart->cost}}</span></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h3>{{$language->empty_cart}}</h3>
                                        </td>
                                    </tr>
                                @endforelse
                                @endif
                                <tr style="border-top: 1px solid black;">

                                    <td colspan="9" style="text-align: right;">
                                        <h3 style="margin: 0px;">{{$language->total}}</h3>
                                    </td>
                                    <td colspan="1" style="text-align: right;">
                                        <h3 style="margin: 0px;">{{$settings[0]->currency_sign}}<span id="grandtotal">{{round($sum,2)}}</span></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="{{url('/home')}}" class="shopping-btn">{{$language->continue_shopping}}</a>
                                    </td>
                                    <td colspan="6">
                                        <a href="{{route('user.checkout')}}" class="update-shopping-btn">{{$language->proceed_to_checkout}}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of add to cart table -->
    </div>


@if(isset($carts))
@foreach($carts as $cart)
<div class="modal fade" id="view_{{$cart->product}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Priscription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" style="width:100%">
          <thead>
            @if($cart->presc_image === null)
                @if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null)
                    <tr>
                    <th style="width:2%"scope="col"></th>
                    <th style="width:2%" scope="col"><center>SPH</center></th>
                    <th style="width:2%"scope="col"><center>BC</center></th>
                    <th style="width:2%"scope="col"><center>DIA</center></th>
                    <th style="width:2%"scope="col"><center>Add Power</center></th>
                    </tr>
                @elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null)
                    <tr>
                    <th style="width:2%"scope="col"></th>
                    <th style="width:2%" scope="col"><center>SPH</center></th>
                    <th style="width:2%"scope="col"><center>BC</center></th>
                    <th style="width:2%"scope="col"><center>DIA</center></th>
                    <th style="width:2%"scope="col"><center>CYL</center></th>
                    <th style="width:2%"scope="col"><center>AXIS</center></th>
                    </tr>
                @else
                    <tr>
                    <th style="width:2%"scope="col"></th>
                    <th style="width:2%" scope="col"><center>SPH</center></th>
                    <th style="width:2%"scope="col"><center>BC</center></th>
                    <th style="width:2%"scope="col"><center>DIA</center></th>
                    </tr>
                @endif
            @else
                <tr>
                    <th style="width:2%" scope="col"><center>IMAGE</center></th>
                </tr>
            @endif
          </thead>
          <tbody>
            @if($cart->presc_image === null)
                @if($cart->same_rx_both != null)
                    @if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null)
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rpower}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rpower}}</center></td>
                        </tr>
                    @elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null)
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rcyl}}</center></td>
                            <td><center>{{$cart->Raxis}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rcyl}}</center></td>
                            <td><center>{{$cart->Raxis}}</center></td>
                        </tr>
                    @else
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                        </tr>
                    @endif
                @else
                    @if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null)
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rpower}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->Lsphere}}</center></td>
                            <td><center>{{$cart->LBc}}</center></td>
                            <td><center>{{$cart->LDia}}</center></td>
                            <td><center>{{$cart->Lpower}}</center></td>
                        </tr>
                    @elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null)
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                            <td><center>{{$cart->rcyl}}</center></td>
                            <td><center>{{$cart->Raxis}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->Lsphere}}</center></td>
                            <td><center>{{$cart->LBc}}</center></td>
                            <td><center>{{$cart->LDia}}</center></td>
                            <td><center>{{$cart->Lcyle}}</center></td>
                            <td><center>{{$cart->Laxis}}</center></td>
                        </tr>
                    @else
                        <tr>
                            <th style="width:2%" scope="row">Right(OD)</th>
                            <td><center>{{$cart->rsphere}}</center></td>
                            <td><center>{{$cart->rbc}}</center></td>
                            <td><center>{{$cart->rdia}}</center></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Left(OS)</th>
                            <td><center>{{$cart->Lsphere}}</center></td>
                            <td><center>{{$cart->LBc}}</center></td>
                            <td><center>{{$cart->LDia}}</center></td>
                        </tr>
                    @endif
                @endif
            @else
                <tr>
                    <td><center><a href="{{url('assets/prescription/'.$cart->presc_image)}}" target="_blank"><img src="{{url('assets/prescription/'.$cart->presc_image)}}" alt=""></a></center></td>
                </tr>
            @endif
          </tbody>
        </table>
        <h5>Context Conversion</h5>                                                         
        <p style="font-weight:500">Right Eye(sph/syl) :-  <span style="font-weight: bold;">{{$cart->minus_right_eye}}</span></p>
        <p style="font-weight:500">Left Eye(sph/syl) :- <span style="font-weight: bold;">{{$cart->minus_left_eye}}</span></p>                                                           
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="exampleModal{{$cart->product}}" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal heading -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                       Priscription
                    </h5>
                    <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <!-- Modal body with image -->
                <div class="modal-body">
                  <img src="{{url('/assets/images/products')}}/{{$cart->priscriptionohoto}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif

@stop

@section('footer')
<script>
    var unprice = document.querySelector('#price472');
    var subplus = document.querySelector('#plus472');
    
    subplus.addEventListener('click', function() {
        console.log(document.querySelector('#price472'));
    });
</script>
@stop