@extends('includes.newmaster')

@section('content')


    <section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">
        <div class="container" style="background-color:#02D0B7;background-image: linear-gradient(to right, #5FE2E5 , #5EEEAF);">

            <div style="margin: 0% 0px 0% 0px;">
                <div class="text-left" style="color:white ;padding: 25px;">
                    <h1>{{$language->search_result}}: {{$search}}</h1>
                </div>
            </div>

        </div>
    </section>
    <div class="section-padding product-filter-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <div class="single-product-carousel-item text-center">
                                <div class="image_latest_product_shubh">
                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                </div>
                                <div class="product-carousel-text">
                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','-',strtolower($product->title))}}">
                                        <h4 class="product-title">{{$product->title}}</h4>
                                    </a>
                                    <!--<div class="product-review">-->
                                    <!--    <i class="fa fa-star"></i>-->
                                    <!--</div>-->
                                    <div class="product-price">
                                        <span style="font-size: 25px; font-weight : bold"><del class="offer-pricenewone" ><i  title ="Add to My site"class=" fa fa-share-alt" style="font-size:15px"></i></del></span>
                                        @if($product->previous_price != "")
                                            <!--<span class="original-price">₹{{\App\Product::Cost($product->id)}}</span>-->
                                            <span class="original-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</span>
                                        @endif
                                        <!--<del class="offer-price">₹{{$product->previous_price}}</del>-->
                                        
                                        @if(Auth::guard('profile')->check())
                                            @if(Auth::guard('profile')->user()->costpriceshow == 'Yes')
                                                <del class="offer-pricenew" data="{{$product->id}}"><a data-toggle="modal" data-target="#view_{{$product->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>
                                            @endif
                                        @endif
                                        <!--@if($product->previous_price != "")-->
                                        <!--    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                        <!--@else-->
                                        <!--@endif-->
                                        <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                    </div>
                                        
                                    <div class="product-meta-area">
                                        <form class="addtocart-form">
                                            {{csrf_field()}}
                                            @if(Session::has('uniqueid'))
                                                <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                            @else
                                                <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                            @endif
                                                          
                                            <input type="hidden" id="price" name="price" value="{{\App\Product::Cost($product->id)}}">
                                                            
                                            <input type="hidden" id="main_price" name="main_price" value="{{$product->costprice}}">
            
                                            <input type="hidden" id="rangenameone" name="rangenameone" value="{{$product->ranegnameone}}">
                                            <input type="hidden" id="rangenametwo" name="rangenametwo" value="{{$product->rangenametwo}}">
                                            <input type="hidden" id="rangenamethree" name="rangenamethree" value="{{$product->rangenamethree}}">
            
                                            <input type="hidden" id="discount_one" name="discount_one" value="{{$product->discount_one}}">
            
                                            <input type="hidden" id="discount_two" name="discount_two" value="{{$product->discount_two}}">
            
                                            <input type="hidden" id="discount_three" name="discount_three" value="{{$product->discount_three}}">
            
                                            <input type="hidden" name="category" value="{{$product->category[0]}}">
                                            <input type="hidden" name="title" value="{{$product->title}}">
                                            <input type="hidden" name="product" value="{{$product->id}}">
                                            <input type="hidden" value="{{$product->feature_image}}" name="productImage" id="productImage">
                                            
                                            @if($product->category != '')
                                                @if($product->category != 72)
                                                    @if($product->category == 53 || $product->category == 63 || $product->category == 82)
                                                        <input type="hidden" id="colormain" name="maincolor" value="{{$product->framecolor}}">
                                                        <input type="hidden" id="attrColorData" name="cartcolor" value="{{$product->framecolor}}">
                                                    @else
                                                        <input type="hidden" id="colormain" name="maincolor" value="{{$product->color}}">
                                                        <input type="hidden" id="attrColorData" name="cartcolor" value="{{$product->color}}">
                                                    @endif
                                                @endif
                                                @if($product->category == 82)
                                                    <input type="hidden" name="precat" value="{{$product->premiumtype}}">
                                                @endif
                                            @endif
            
                                            <input type="hidden" id="cost" name="cost" value="{{$product->costprice}}">
                                            <input type="hidden" id="productstock" name="productstock" value="{{$product->stock}}">
                                            <input type="hidden" id="quantity" name="quantity" value="1">
                                            <input type="hidden" id="size" name="size" value="{{$product->productdimension}}">
                                            <input type="hidden" id="productAttrId" name="productAttrId" value="">
            
            
                                            <!--@if($product->category == 72)-->
                                            <!--    @if($product->stock != 0 || $product->stock === null )-->
                                            <!--        <div class="cartButton">-->
                                            <!--            <button type="button" class="btn btn-primary" style="border:none; cursor:pointer;"><a href="{{url('/productshoww')}}/{{$product->id}}/{{$product->lenscolor}}" id="presButton" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>-->
                                            <!--        </div>-->
                                            <!--    @else-->
                                            <!--        <div class="cartButton">-->
                                            <!--            <button style="margin-left: 0px;" type="button" class="btn btn-primary" disabled><i class="fa fa-cart-plus "></i>Add Prescription</button>-->
                                            <!--        </div>-->
                                            <!--    @endif-->
                                            <!--@else-->
                                            <!--    <div class="col-sm-12">-->
                                            <!--        @if($product->stock != 0 || $product->stock === null )-->
                                            <!--            <div class="cartButton">-->
                                            <!--                <button style="margin-left: 0px;" type="button"  onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--            </div>-->
                                            <!--        @else-->
                                            <!--            <div class="cartButton">-->
                                            <!--                <button style="margin-left: 0px;" type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>-->
                                            <!--            </div>-->
                                            <!--        @endif-->
                                            <!--    </div>-->
                                            <!--@endif-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="view_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Product Cost Price</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    @if($product->costprice == '')
                                      <h5>Product Cost Price:- 0</h5>
                                    @else
                                    <h5>Product Cost Price:- {{$product->costprice}}</h5>
                                    @endif
                                  </div>
                                  <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3>{{$language->no_result}}</h3>
                    @endforelse
                </div>
            </div>
    </div>

@stop

@section('footer')

@stop