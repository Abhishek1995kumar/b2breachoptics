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
                                        <th>Product Size/Color</th>
                                        <th>Prescription</th>
                                        <th>Quantity</th>
                                        <th>Left Eye</th>
                                        <th>Right Eye</th>
                                        <th>Both Eye</th>
                                        <th>{{$language->unit_price}}</th>
                                        <th>{{$language->subtotal}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @if(count($carts) > 0)
                                    @forelse($carts as $cart)
                                    <tr id="item{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}">
                                        <td><a onclick="getDelete({{$cart->product}}, '{{$cart->cartcolor}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                            @if($cart->maincolor == $cart->cartcolor)
                                                <td><img src="{{url('/assets/images/products')}}/{{\App\Product::findOrFail($cart->product)->feature_image}}" alt=""></td>
                                            @else
                                                <td><img src="{{url('/assets/images/product_attr')}}//{{$cart->productImage}}" alt=""></td>
                                            @endif
                                        <td>
                                            <a href="{{url('/product')}}/{{$cart->product}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($cart->product)->title))}}" class="product-name-header">{{$cart->title}}</a>
                                        </td>
    
                                        <td>
                                            {{$cart->size}} / {{$cart->cartcolor}}
                                        </td>
    
                                        <td id="eye_image">
                                            @if($cart->category == 72 || $cart->category == 58)
                                                <!--<a data-toggle="modal" data-target="#view_{{$cart->product}}"><i class="fa fa-eye" aria-hidden="true"></i> </a></td>-->
                                                <a href="javascript:void(0)" onclick="showPrescription({{$cart->id}})"><i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                            @else
                                                <a data-toggle="modal" data-target="#exampleModal{{$cart->product}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($cart->category != 72)
                                                <p class="cart-btn">
                                                    <span class="quantity-cart-minus" id="minus{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" data="{{str_replace(' ', '-', $cart->cartcolor)}}" attr="{{$cart->product}}"><i class="fa fa-minus"></i></span>
                                                    <span class="qty_1" id="number{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}">{{$cart->quantity}}</span>
                                                    <span class="quantity-cart-plus" id="plus{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" data="{{str_replace(' ', '-', $cart->cartcolor)}}" attr="{{$cart->product}}"><i class="fa fa-plus"></i></span>
                                                </p>
                                                <td><?php echo "-";?></td>
                                                <td><?php echo "-";?></td>
                                            @else
                                                <p>
                                                <span>{{$cart->quantity}}</span>
                                                </p>
                                                <p class="cart-btn">
                                                    @if($cart->botheyequantity == '')
                                                        @if($cart->lefteyequantity != '')
                                                            <td class="left-qty">{{$cart->lefteyequantity}}</td>
                                                        @else
                                                            <td><?php echo "-";?></td>
                                                        @endif
                                                        
                                                        @if($cart->lefteyequantity != '')
                                                            <td class="right-qty">{{$cart->righeyequantity}}</td>
                                                        @else
                                                            <td><?php echo "-";?></td>
                                                        @endif
                                                    @else
                                                        <td><?php echo "-";?></td>
                                                        <td><?php echo "-";?></td>
                                                        <td class="both-qty">{{$cart->botheyequantity}}</td>
                                                    @endif
                                                </p>
                                            @endif
                                        </td>
    
                                        <form id="citem{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}">
                                            {{csrf_field()}}
                                            @if(Session::has('uniqueid'))
                                                <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                            @else
                                                <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                            @endif
                                            <input type="hidden" name="title" value="{{$cart->title}}">
                                            <input type="hidden" id="price_update{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" name="price" value="{{$cart->price}}">
                                            <input type="hidden" id="main_price{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" value="{{$cart->main_price}}">
                                            <input type="hidden" id="rangenameone{{$cart->product}}" name="rangenameone" value="{{$cart->rangenameone}}">
                                            <input type="hidden" id="rangenametwo{{$cart->product}}" name="rangenametwo" value="{{$cart->rangenametwo}}">
                                            <input type="hidden" id="rangenamethree{{$cart->product}}" name="rangenamethree" value="{{$cart->rangenamethree}}">
                                        
                                            <input type="hidden" id="discount_one{{$cart->product}}" name="discount_one" value="{{$cart->discount_one}}">
                                            <input type="hidden" id="discount_two{{$cart->product}}" name="discount_two" value="{{$cart->discount_two}}">
                                            <input type="hidden" id="discount_three{{$cart->product}}" name="discount_three" value="{{$cart->discount_three}}">
    
                                            <input type="hidden" name="product" value="{{$cart->product}}">
                                            <input type="hidden" id="cost{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" name="cost" value="{{$cart->cost}}" autocomplete="off">
                                            <input type="hidden" id="quantity{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" name="quantity" value="{{$cart->quantity}}">
                                            <input type="hidden" id="size{{$cart->product}}" name="size" value="{{$cart->size}}">
                                            <input type="hidden" id="cartcolor{{$cart->product}}" name="cartcolor" value="{{$cart->cartcolor}}">
                                            <input type="hidden" id="color_code{{$cart->colorcode}}" name="colorcode" value="{{$cart->colorcode}}">
                                        </form>
                                        <!-- for incease quantity of product send to javascript function data and show -->
                                        @if($cart->botheyequantity == '')
                                            <td></td>
                                            <td>{{$settings[0]->currency_sign}}<span id="price{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}">{{$cart->main_price}}</span></td>
                                            <td>{{$settings[0]->currency_sign}}<span id="subtotal{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" class="subtotal">{{$cart->cost}}</span></td>
                                        @else
                                            <td>{{$settings[0]->currency_sign}}<span id="price{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}">{{$cart->main_price}}</span></td>
                                            <td>{{$settings[0]->currency_sign}}<span id="subtotal{{$cart->product}}{{str_replace(' ', '-', $cart->cartcolor)}}" class="subtotal">{{$cart->cost}}</span></td>
                                        @endif
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <h3>{{$language->empty_cart}}</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="12">
                                            <h3>{{$language->empty_cart}}</h3>
                                        </td>
                                    </tr>
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

@stop

@section('footer')
<script>
    function showPrescription(id)
    {
        $('.table-data').html("");
        $('.prescription-parameter').html("");
        url = "{{url('showprescription')}}/"+id;
        $.ajax({
            type:"POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                id:id,
            },
            success:function(response)
            {
                $('.table-data').append(response.data)
                $('.prescription-parameter').append(response.data3)
                $('.table-data').append(response.data2)
                $('#viewmodal').show();
            }
        })
    }
    
    function closeModal(e)
    {
        $('#viewmodal').hide();
    }
    
    // $(window).on('click', function()
    // {
    //     $('#viewmodal').hide();
    // })
</script>
@stop