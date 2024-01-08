   
@extends('includes.newmaster')


@section('header')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
@stop


@section('content')
<link href="{{ URL::asset('assets/css/product.css')}}" rel="stylesheet">

    <div class="home-wrapper">
        <div class="container-fluid">
          <nav class="navbar navbar-default">
            <div class="container-fluid header-fluid">
              <div class="navbar-header" style="padding-top: 15px;">
                <a href="{{url('/home')}}" >{{$language->home}}</a>{{"/"}}
                <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->category[0])->first()->slug}}">{{\App\Category::where('id',$productdata->category[0])->first()->name}}</a>
                @if($productdata->subid != "")
                    <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->subid)->first()->slug}}">{{\App\Category::where('id',$productdata->subid)->first()->name}}</a>
                @endif
                @if($productdata->childid != "")
                    <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->childid)->first()->slug}}">{{\App\Category::where('id',$productdata->childid)->first()->name}}</a>
                @endif
                <a style ="color : black;" href="{{url('/product')}}/{{$productdata->id}}/{{str_replace(' ','-',strtolower($productdata->title))}}">{{$productdata->title}}</a>
              </div>
              <ul class="nav navbar-nav" style="float:right; padding-right:30px"  >
                <li class="active"><a data-toggle="tab" href="#overview-tab-1"><?php echo "Product";?></a></li>
                <li><a data-toggle="tab" href="#overview-tab-2">{{$language->description}}</a></li>
                <li><a data-toggle="tab" href="#pricing-tab-3">{{$language->return_policy}}</a></li>
                <li><a data-toggle="tab" href="#location-tab-4">{{$language->reviews}}({{\App\Review::where('productid',$productdata->id)->count()}})</a></li>
              </ul>
            </div>
          </nav>
        </div>
        <div class="product-details-wrapper padding-bottom-0 wow fadeInUp" style="padding-top:20px;">
            <div class="container-fluid" id="product_container">
                <div class="padding-right-0 col_div_1">
                    <div class="project-image-shubh">
                        {{-- @if(isset($product_gallery))
                        <div class="single-product-item" id="attrImages">
                            @forelse($product_gallery as $gally)
                                <div class="images-attr">
                                    <img id="icon{{$gally->id}}" onmouseover="productattrGallery(this.id)" src="{{url('/assets/images/product_attr')}}/{{$gally->attr_imgs}}" alt="">
                                </div>
                            @empty
                            @endforelse
                        </div>
                        @else --}}
                        <div class="single-product-item" id="attrImages">
                            @forelse($gallery as $galdta)
                                    <div class="images-attr">
                                        <img id="galleryimg{{$galdta->id}}" onmouseover="productGallery(this.id)" src="{{url('/assets/images/gallery')}}/{{$galdta->image}}" alt="">
                                    </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="videobutton">
                        <!-- video1 -->
                        <div id="light">
                            <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
                            <video id="VisaChipCardVideo" controls>
                                <source src="{{url('/assets/images/products')}}/{{$productdata->video}}" type="video/mp4">
                            </video>
                        </div>
    
                        <div id="fade" onClick="lightbox_close();"></div>
                          <div class="itemsContainer">
                              <div class="play"><a onclick="lightbox_open();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                        </div>
                        <!-- endvideo1 -->
    
                        <!-- video2 -->
                        <div id="light1">
                            <a class="boxclose1" id="boxclose1" onclick="lightbox_close1();"></a>
                            <video id="VisaChipCardVideo1" controls>
                                <source src="{{url('/assets/images/products')}}/{{$productdata->video1}}" type="video/mp4">
                            </video>
                        </div>
    
                        <div id="fade1" onClick="lightbox_close1();"></div>
                        @if($productdata->video2 != '')
                            <div class="itemsContainer">
                                <div class="play"><a onclick="lightbox_open1();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                            </div>
                        @endif
                        <!-- endvideo 2 -->
    
                        <!-- video3 -->
                        <div id="light2">
                            <a class="boxclose2" id="boxclose1" onclick="lightbox_close2();"></a>
                            <video id="VisaChipCardVideo2" controls>
                                <source src="{{url('/assets/images/products')}}/{{$productdata->video2}}" type="video/mp4">
                            </video>
                        </div>
    
                        <div id="fade2" onClick="lightbox_close2();"></div>
                        @if($productdata->video2 != '')
                            <div class="itemsContainer">
                                <div class="play"><a onclick="lightbox_open2();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="padding-right-0 padding-left-0 main_product_div">
                    <div class="padding-right-0 padding-left-0 main_img_div">
                        <div class="image_div_shubh">
                            <div class="product-review-carousel-img product-zoom">
                                <img id="imageDiv" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="padding-right-0 main_containent_div">
                        <div class="tab-content">
                            <div id="overview-tab-1" class="tab-pane active fade in">
                                <div class="productmain_details">
                                    <div class="padding-right-0 padding-left-0 product_detail_div">
                                        <h2 class="product-header">{{$productdata->title}}</h2>
                                        <!--@if($productdata->owner != "admin")-->
                                        <!--    @if(\App\Vendors::where('id',$productdata->vendorid)->count() != 0)-->
                                        <!--        <strong class="">{{$language->vendor}}: <a href="{{url('/shop')}}/{{$productdata->vendorid}}/{{str_replace(' ','-',strtolower(\App\Vendors::findOrFail($productdata->vendorid)->shop_name))}}" target="_blank">{{\App\Vendors::findOrFail($productdata->vendorid)->shop_name}}</a></strong>-->
                                        <!--    @endif-->
                                        <!--@else-->
                                        <!--@endif-->
                                            
                                        <!-- Stock Management -->
                                        <p class="product-status padding-top-10 stockmanagement">
                                            @if($productdata->stock != 0 || $productdata->stock === null )
                                                <span class="available">
                                                    <i class="fa fa-check-square-o"></i>
                                                    <span>{{$language->available}}</span>
                                                </span>
                                            
                                            @else
                                                <span class="not-available">
                                                <i class="fa fa-times-circle-o"></i>
                                                <span>{{$language->out_of_stock}}</span>
                                                <input name="btn" type="submit" class="btn-notify" value="Notify Me">
                                                <!--<button type="" >Notify Me</button>-->
                                                </span>
                                            @endif
                                        </p>
                                        
                                        <!-- End stock management -->
                                        @if($productdata->producttat != "")
                                        <div class="product_tat">
                                            <span style="font-size: 13px;"><b>Estimated Shipping Time :&nbsp;</b><b><span> {{$productdata->producttat}}<?php echo " - " ?>{{$productdata->producttat+2}} days</span></b></span>
                                        </div>
                                        <br>
                                        @endif
                                        <div id="rating_review">
                                            <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:{{\App\Review::ratings($productdata->id)}}%"></div>
                                            </div>
                                            @if(\App\Review::reviewCount($productdata->id) > 1)
                                                <span>{{\App\Review::reviewCount($productdata->id)}} Reviews</span>
                                            @else
                                                <span>{{\App\Review::reviewCount($productdata->id)}} Review</span>
                                            @endif
                                        </div>
                                        <h1 class="product-price">
                                            @if($productdata->previous_price != "")
                                                <!-- <span style="font-size: 20px;"><b> MRP :</b> </span ><del style="font-size: 15px;">{{$settings[0]->currency_sign}}{{$productdata->previous_price}}</del>-->
                                                <!--</span>-->
                                            @endif
                                              <!--<span style="font-size: 25px; font-weight : bold">{{$settings[0]->currency_sign}}</span><span id="price_span" style="font-size: 25px; font-weight : bold">{{\App\Product::Cost($productdata->id)}}</span>-->
                                              <span style="font-size: 25px; font-weight : bold"><b> MRP : </b> {{$settings[0]->currency_sign}}</span><span id="price_span" style="font-size: 25px; font-weight : bold">{{$productdata->previous_price}}</span>
                                              
                                                <!--<del class="offer-pricenew"><a data-toggle="modal" data-target="#view_{{$productdata->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>-->
                                            @if(Auth::guard('profile')->check())
                                                @if(Auth::guard('profile')->user()->costpriceshow == 'Yes')
                                                    <del class="offer-pricenew"><a data-toggle="modal" data-target="#view_{{$productdata->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>
                                                @endif
                                            @endif
                                        </h1>
                                        @if($productdata->category[0] != '' && $productdata->category[0] != 87)
                                            @if($productdata->category[0] == 72)
                                            <div class="color_name">
                                                <span style="font-size: 13px;"><b> Color : </b>&nbsp;<span id="color_span" style="font-weight: bold;">{{$productdata->lenscolor}}</span> @if($productdata->colorcode)<?php echo " - "?> <span id="color_code_span" style="font-weight: bold;">{{$productdata->colorcode}}</span>@endif </span>
                                            </div>
                                            @elseif($productdata->category[0] == 63 || $productdata->category[0] == 53 || $productdata->category[0] == 82)
                                            <div class="color_name">
                                                <span style="font-size: 13px;"><b> Color : </b>&nbsp;<span id="color_span" style="font-weight: bold;">{{$productdata->framecolor}}</span> @if($productdata->colorcode)<?php echo " - "?> <span id="color_code_span" style="font-weight: bold;">{{$productdata->colorcode}}</span>@endif </span>
                                            </div>
                                            @else
                                            <div class="color_name">
                                                <span style="font-size: 13px;"><b> Color : </b>&nbsp;<span id="color_span" style="font-weight: bold;">{{$productdata->color}}</span> @if($productdata->colorcode)<?php echo " - "?> <span id="color_code_span" style="font-weight: bold;">{{$productdata->colorcode}}</span>@endif </span>
                                            </div>
                                            @endif
                                        @endif
                                            
                                        <div class="attrColor btn-group" style="gap:5px; position: relative; padding: 5px;">
                                            @if($productdata->category[0] != '')
                                                @if($productdata->category[0] == 72)
                                                    <button id="mainData{{$productdata->id}}"  class="mainColor selected_css" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changemainImage('{{$productdata->id}}', this)" data="{{$productdata->lenscolor}}">
                                                        <img alt="color image" height="50" width="50" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}"/>
                                                    </button>
                                                @elseif($productdata->category[0] == 53 || $productdata->category[0] == 63 || $productdata->category[0] == 82)
                                                    <button id="mainData{{$productdata->id}}"  class="mainColor selected_css" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changemainImage('{{$productdata->id}}', this)" data="{{$productdata->framecolor}}">
                                                    <img alt="color image" height="50" width="50" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}"/>
                                                @else
                                                    <button id="mainData{{$productdata->id}}"  class="mainColor selected_css" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changemainImage('{{$productdata->id}}', this)" data="{{$productdata->color}}">
                                                        <img alt="color image" height="50" width="50" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}"/>
                                                    </button>
                                                @endif
                                            @endif
                                            
                                            <!--@if(isset($product_gallery))-->
                                            <!--    @foreach($product_gallery as $attr)-->
                                            <!--        @if($attr != '')-->
                                            <!--        <button id="getData{{$attr->pid}}" height="50"  class="main-class" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changeImage('{{$attr->color}}', this)" data="{{$attr->pid}}">-->
                                            <!--            <img alt="color image" width="50" src="{{url('/assets/images/product_attr')}}/{{$attr->attr_imgs}}"/>-->
                                            <!--        </button>-->
                                            <!--        @endif-->
                                            <!--    @endforeach-->
                                            <!--@endif-->
                                            
                                            @if(isset($product_gallery))
                                                <input type="hidden" class="allImageDatas" value="{{count($product_gallery)}}">
                                                <?php
                                                    if(count($product_gallery) > 3){
                                                        for($i=0; $i<=3; $i++){
                                                ?>
                                                            @if($product_gallery[$i] != '')
                                                                <button id="getData{{$product_gallery[$i]->pid}}"  class="main-class" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changeImage('{{$product_gallery[$i]->color}}', this)" data="{{$product_gallery[$i]->pid}}">
                                                                  <img alt="color image" width="50" src="{{url('/assets/images/product_attr')}}/{{$product_gallery[$i]->attr_imgs}}"/>
                                                                </button>
                                                            @endif
                                                <?php
                                                        }
                                                    }else{
                                                        for($i=0; $i<count($product_gallery); $i++){
                                                ?>
                                                            @if($product_gallery[$i] != '')
                                                                <button id="getData{{$product_gallery[$i]->pid}}"  class="main-class" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changeImage('{{$product_gallery[$i]->color}}', this)" data="{{$product_gallery[$i]->pid}}">
                                                                  <img alt="color image" width="50" src="{{url('/assets/images/product_attr')}}/{{$product_gallery[$i]->attr_imgs}}"/>
                                                                </button>
                                                            @endif
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                <a href="javascript:void(0)" class="maoreImage">More...</a>
    
                                                <span class="moreImageData" style="display:none;">
                                                <?php
                                                    for($i=4; $i<count($product_gallery); $i++){
                                                ?>
                                                        @if($product_gallery[$i] != '')
                                                            <button id="getData{{$product_gallery[$i]->pid}}"  class="main-class" type="button" style="border : 1px solid #c1bcbc;  background: #fff;" onclick="changeImage('{{$product_gallery[$i]->color}}', this)" data="{{$product_gallery[$i]->pid}}">
                                                              <img alt="color image" width="50" src="{{url('/assets/images/product_attr')}}/{{$product_gallery[$i]->attr_imgs}}"/>
                                                            </button>
                                                        @endif
                                                <?php
                                                    }
                                                ?>
                                                </span>
                                                <a href="javascript:void(0)" class="lessImage" style="display:none;">...Less</a>
                                            @endif
                                            
                                        </div>
                                        <br>
                                        <br>
                                        @if($productdata->category[0] == 58)
                    
                                        @else
                                            @if($productdata->category[0] != '' && $productdata->category[0] != 87)
                                                @if($productdata->category[0] != 72)
                                                    <div class="color_name">
                                                        <span style="font-size: 13px;"><b>Size :</b>  <span id="size_span" > {{$productdata->productdimension}}</span> </span>
                                                    </div>
                                                    <div style="display: flex; padding-top: 5px;" class="btn-group">
                                                        <div class="product-size text-center" id="product-size">
                                                            <span style="width: 80px; border : 1px solid #c1bcbc; font-weight: bold; background: #fff;" onclick="changeSize('{{$productdata->productdimension}}', event)" class="sizeClick" data="{{$productdata->productdimension}}">{{$productdata->productdimension}}</span>
                                                        </div>
                                                    </div>
                                                 @endif
                                            @endif
                                        @endif
                                            
                                        <?php
                                            $date = Carbon\Carbon::today()->addDays($productdata->producttat);
                                            $deliver = $date->toDateString();
                                        ?>
                                        
                                        @if($productdata->producttat != "")
                                            <br>
                                        @endif
                                            
                                        <div>
                                            <h5>Technical Information</h5>
                                            <div>
                                                @if($productdata->category[0] == 53)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku</div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Model No. </div> <div>{{$productdata->modelno}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Width </div> <div>{{$productdata->framewidth}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Dimensions </div> <div class="productDimension">{{$productdata->productdimension}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Color </div> <div class="frameColors">{{$productdata->framecolor}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @elseif($productdata->category[0] == 72)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Model No. </div> <div>{{$productdata->modelno}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku </div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Usages Duration </div> <div>{{$productdata->usagesduration}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Diameter </div> <div>{{str_replace(',',', ', $productdata->diameter)}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @elseif($productdata->category[0] == 63)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku</div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Shape </div> <div>{{$productdata->shape}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Model No </div> <div>{{$productdata->modelno}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Color </div> <div class="frameColors">{{$productdata->framecolor}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Gender </div> <div>{{$productdata->gender}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @elseif($productdata->category[0] == 87)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku </div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Net Quantity </div> <div>{{$productdata->netquntity}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Shelf Life </div> <div>{{$productdata->shelflife}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Form </div> <div>{{$productdata->form}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @elseif($productdata->category[0] == 58)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku </div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Lens Color </div> <div class="lensColors">{{$productdata->color}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Lens Material </div> <div>{{$productdata->lensmaterialtype}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Lens Diameter </div> <div>{{str_replace(',',', ', $productdata->diameterlens)}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @elseif($productdata->category[0] == 445)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku </div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Net Quantity </div> <div>{{$productdata->netquntity}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Shelf Life </div> <div>{{$productdata->shelflife}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @else($productdata->category[0] == 82)
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Brand Name </div> <div>{{$productdata->brandname}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Model No. </div> <div>{{$productdata->modelno}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Product Sku </div> <div class="productSkuInfo">{{$productdata->productsku}}</div></div>
                                                    <br>
                                                    <div class="col-sm-12" style="display: flex; grid-template-columns: repeat(2, 1fr);"><div style="width:50%;">Frame Color </div> <div class="frameColors">{{$productdata->framecolor}}</div></div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-12" id="showallinformation">
                                                        <a class="showallbutton" data-toggle="modal" data-target="#exampleModal"><b>Show All Information</b></a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div>
                                            <table hidden id="bulk_qty" class="table table-bordered">
                                                <tr>
                                                    @if($productdata->ranegnameone != '')
                                                    <button id="toggle" style="color: #1B1212;margin-bottom: 11px;border: transparent; font-weight: 500px; background-color: lightgray; padding: 10px; border-radius: 3px;"><b>Bulk Quantity Discount</b></button>
                                                    <th class="text-center">{{$productdata->ranegnameone}}</th>
                                                    @endif
                                                    @if($productdata->rangenametwo != '')
                                                    <th class="text-center">{{$productdata->rangenametwo}}</th>
                                                    @endif
                                                    @if($productdata->rangenamethree != '')
                                                    <th class="text-center">{{$productdata->rangenamethree}}</th>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @if($productdata->discount_one != '')
                                                        <td  class="text-center"> {{$productdata->discount_one}} % </td>
                                                    @endif
                                                    @if($productdata->discount_two != '')
                                                        <td  class="text-center">{{$productdata->discount_two}} %</td>
                                                    @endif
                                                    @if($productdata->discount_three != '')
                                                        <td  class="text-center">{{$productdata->discount_three}} %</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="col-sm-12 cart formarea">
                                                <div class="product-meta-area pranali" id="product_meta_area_add">
                                                    <form class="addtocart-form">
                                                        {{csrf_field()}}
                                                        @if(Session::has('uniqueid'))
                                                            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                                        @else
                                                            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                                        @endif
                                                        
                                                        <input type="hidden" id="price" name="price" value="{{\App\Product::Cost($productdata->id)}}">
                                                        
                                                        <input type="hidden" id="main_price" name="main_price" value="{{$productdata->costprice}}">
    
                                                        <input type="hidden" id="rangenameone" name="rangenameone" value="{{$productdata->ranegnameone}}">
                                                        <input type="hidden" id="rangenametwo" name="rangenametwo" value="{{$productdata->rangenametwo}}">
                                                        <input type="hidden" id="rangenamethree" name="rangenamethree" value="{{$productdata->rangenamethree}}">
    
    
                                                        <input type="hidden" id="discount_one" name="discount_one" value="{{$productdata->discount_one}}">
    
                                                        <input type="hidden" id="discount_two" name="discount_two" value="{{$productdata->discount_two}}">
    
                                                        <input type="hidden" id="discount_three" name="discount_three" value="{{$productdata->discount_three}}">
    
                                                        <input type="hidden" id="category" name="category" value="{{$productdata->category[0]}}">
                                                        <input type="hidden" name="title" value="{{$productdata->title}}">
                                                        <input type="hidden" name="product" value="{{$productdata->id}}">
    		                                            <input type="hidden" value="{{$productdata->feature_image}}" name="productImage" id="productImage">
    		                                            
                                                        @if($productdata->category[0] != '')
                                                            @if($productdata->category[0] != 72)
                                                                @if($productdata->category[0] == 53 || $productdata->category[0] == 63 || $productdata->category[0] == 82)
                                                                    <input type="hidden" id="colormain" name="maincolor" value="{{$productdata->framecolor}}">
                                                                    <input type="hidden" id="attrColorData" name="cartcolor" value="{{$productdata->framecolor}}">
                                                                @elseif($productdata->category[0] == 87)
                                                                    <input type="hidden" id="colormain" name="maincolor" value="{{$productdata->productcolor}}">
                                                                    <input type="hidden" id="attrColorData" name="cartcolor" value="{{$productdata->productcolor}}">
                                                                @else
                                                                    <input type="hidden" id="colormain" name="maincolor" value="{{$productdata->color}}">
                                                                    <input type="hidden" id="attrColorData" name="cartcolor" value="{{$productdata->color}}">
                                                                @endif
                                                            @else
                                                                <input type="hidden" id="lenscolor" value="{{$productdata->lenscolor}}">
                                                            @endif
                                                            @if($productdata->category[0] == 82)
                                                                <input type="hidden" name="precat" value="{{$productdata->premiumtype}}">
                                                            @endif
                                                        @endif
    
                                                        <input type="hidden" id="color_code" name="colorcode" value="{{$productdata->colorcode}}">
                                                        <input type="hidden" id="cost" name="cost" value="{{$productdata->costprice}}">
                                                        <input type="hidden" id="productstock" name="productstock" value="{{$productdata->stock}}">
                                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                                        <input type="hidden" id="size" name="size" value="{{$productdata->productdimension}}">
                                                        <input type="hidden" id="productAttrId" name="productAttrId" value="">
    
                                                        <!--@if($productdata->category[0] == 72)-->
                                                        <!--   <button type="button" class="btn btn-primary" style="border:none; cursor:pointer;" disabled><a href="{{url('/productshoww')}}/{{$productdata->id}}/{{$productdata->lenscolor}}" id="presButton" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>-->
    
                                                        <!--@elseif($productdata->stock != 0 || $productdata->stock === null )-->
                                                        <!--    <button style="margin-left: 0px;" type="button" class="addTo-cart to-cart  "><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                                        <!--@else-->
                                                        <!--    <button style="margin-left: 0px;" type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>-->
                                                        <!--@endif-->
    
                                                        @if($productdata->category[0] == 72)
                                                            @if($productdata->stock != 0 || $productdata->stock === null )
                                                                <div class="cartButton">
                                                                    <button type="button" class="btn btn-primary" style="border:none; cursor:pointer;"><a href="{{url('/productshoww')}}/{{$productdata->id}}/{{$productdata->lenscolor}}" id="presButton" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>
                                                                </div>
                                                            @else
                                                                <div class="cartButton">
                                                                    <button style="margin-left: 0px;" type="button" class="btn btn-primary" disabled><i class="fa fa-cart-plus "></i>Add Prescription</button>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="col-sm-12">
                                                                @if($cartsmain > 0)
                                                                    <div class="cartButton">
                                                                        <button style="margin-left: 0px;" type="button" onclick="cartedProduct()" class="added-cart">Added Cart</button>
                                                                    </div>
                                                                @else
                                                                    @if($productdata->stock != 0 || $productdata->stock === null )
                                                                        @if($productdata->category[0] == 58)
                                                                            <div class="cartButton productaddtocart">
                                                                                <button style="margin-left: 0px;" type="button"  onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                                            </div>
                                                                            <div class="cartButton prescriptionadd">
                                                                                <button style="margin-left: 0px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescriptionModal" data-whatever="@getbootstrap" style="outline:none;">
                                                                                    Add Prescription
                                                                                </button>
                                                                            </div>
                                                                        @else
                                                                            <div class="cartButton">
                                                                                <button style="margin-left: 0px;" type="button"  onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                                            </div>
                                                                        @endif
                                                                        <!--<div class="cartButton">-->
                                                                        <!--    <button style="margin-left: 0px;" type="button"  onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                                                        <!--</div>-->
                                                                    @else
                                                                        <div class="cartButton">
                                                                            <button style="margin-left: 0px;" type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nik Here -->
                                    <div class="offer-banner">
                                        @foreach($product_baner as $key => $banner)
                                            @if($banner->cat_name == $productdata->category[0])
                                            <div id="coupon-banner-image">        
                                                <a href="{{$banner->pro_baner_url}}"><img src="{{url('/assets')}}/images/product_baner/pro_baner/{{$banner->pro_baner}}"></a>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-0 padding-left-0">
                                    </div>
                                </div>
                            </div>
                            
                        <div id="overview-tab-2" class="tab-pane fade">
                            <p>{!! $productdata->description !!}</p>
                        </div>

                        <div id="pricing-tab-3" class="tab-pane fade">
                            <p>{!! $productdata->policy !!}</p>
                        </div>
                        <div id="location-tab-4" class="tab-pane fade">
                            <p>
                                <div class="review-rating-description">
                                    @if(Auth::guard('profile')->check())
                                        <div class="review_divs">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="rating-block">
                                                            <h4>Average user rating</h4>
                                                            <h2 class="bold padding-bottom-7">{{round($averagerate, 1)}}<small>/ 5</small></h2>
                                                            <?php
                                                                for($j=0.5; $j<5; $j++){
                                                                    if(round($j, 1)<=round($averagerate, 1)){
                                                            ?>
                                                                        <button type="button" class="btn btn-warning btn-xs" style="background: green; border-color: green; outline: none;" aria-label="Left Align">
                                                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                                        </button>
                                                            <?php
                                                                    }
                                                                    else{
                                                            ?>
                                                                        <button type="button" class="btn btn-default btn-grey btn-xs" style="outline: none;" aria-label="Left Align">
                                                                            <span class="glyphicon glyphicon-star" style="color: white;" aria-hidden="true"></span>
                                                                        </button>
                                                            <?php 
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 review_bar" width="40%">
                                                        <h4>Rating breakdown</h4>
                                                        <div class="pull-left" style="display: flex;">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:200px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog5*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews5}}</div>
                                                        </div>
                                                        <div class="pull-left" style="display: flex;">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:200px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog4*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews4}}</div>
                                                        </div>
                                                        <div class="pull-left" style="display: flex;">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:200px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog3*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews3}}</div>
                                                        </div>
                                                        <div class="pull-left" style="display: flex;">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:200px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog2*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews2}}</div>
                                                        </div>
                                                        <div class="pull-left" style="display: flex;">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:200px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog1*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews1}}</div>
                                                        </div>
                                                    </div>	
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="review-block" <?php if(count($reviews)>0){ ?> style="overflow-y:scroll; height: 150px;" <?php } ?>>
                                                        @if(count($reviews) > 0)
                                                            <?php for($i=0; $i<count($reviews); $i++){ ?>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                                                                        <div class="review-block-name">{{$reviews[$i]->name}}</div>
                                                                        <div class="review-block-date">{{$reviews[$i]->review_date}}<br/>{{$allyear[$i]}} Year {{$allmonth[$i]}} Month  {{$alldays[$i]}} day ago</div>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="review-block-rate">
                                                                            <?php
                                                                            for($j=1; $j<6; $j++){
                                                                                if($j<=$reviews[$i]->rating){
                                                                            ?>
                                                                                    <button type="button" class="btn btn-warning btn-xs" style="background: green; border-color: green;  outline: none;" aria-label="Left Align">
                                                                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                                                    </button>
                                                                            <?php
                                                                                }
                                                                                else{
                                                                            ?>
                                                                                    <button type="button" class="btn btn-default btn-grey btn-xs" style="outline: none;" aria-label="Left Align">
                                                                                        <span class="glyphicon glyphicon-star" style="color: white;" aria-hidden="true"></span>
                                                                                    </button>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="review-block-title"><?php $reviews[$i]->rating > '3' ? print_r("Nice Riview") : print_r("Please Improve in your riview") ?></div>
                                                                        <div class="review-block-description">{{$reviews[$i]->review}}</div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
                                                                    <h4>{{$language->no_review}}</h4>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-sm-12 text-center">
                                                    @if($is_reviews_avaible > 0)
                                                        <button type="button" onclick="reviewSubmit()" class="btn btn-primary">Your Review</button>
                                                    @else
                                                        <button type="button" id="pleasePurchaseProduct" onclick="showAlert()" class="btn btn-primary">Your Review</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="rating-block">
                                                            <h4>Average user rating</h4>
                                                            <h2 class="bold padding-bottom-7">{{$averagerate}}<small>/ 5</small></h2>
                                                            <?php
                                                                for($j=1; $j<6; $j++){
                                                                    if($j<=$averagerate){
                                                            ?>
                                                                        <button type="button" class="btn btn-warning btn-xs" style="background: green; border-color: green; outline: none;" aria-label="Left Align">
                                                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                                        </button>
                                                            <?php
                                                                    }
                                                                    else{
                                                            ?>
                                                                        <button type="button" class="btn btn-default btn-grey btn-xs" style="outline: none;" aria-label="Left Align">
                                                                            <span class="glyphicon glyphicon-star" style="color: white;" aria-hidden="true"></span>
                                                                        </button>
                                                            <?php 
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h4>Rating breakdown</h4>
                                                        <div class="pull-left">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:180px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog5*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews5}}</div>
                                                        </div>
                                                        <div class="pull-left">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:180px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog4*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews4}}</div>
                                                        </div>
                                                        <div class="pull-left">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:180px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog3*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews3}}</div>
                                                        </div>
                                                        <div class="pull-left">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:180px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog2*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews2}}</div>
                                                        </div>
                                                        <div class="pull-left">
                                                            <div class="pull-left" style="width:35px; line-height:1;">
                                                                <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                                            </div>
                                                            <div class="pull-left" style="width:180px;">
                                                                <div class="progress" style="height:9px; margin:8px 0;">
                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: {{$prog1*100}}%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right" style="margin-left:10px;">{{$reviews1}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-sm-12">
                                                    <div class="review-block" <?php if(count($reviews)>0){ ?> style="overflow-y:scroll; height: 150px;" <?php } ?>>
                                                        @forelse($reviews as $review)
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                                                                    <div class="review-block-name">{{$review->name}}</div>
                                                                    <div class="review-block-date">{{$review->review_date}}<br/>1 day ago</div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="review-block-rate">
                                                                        <?php
                                                                        for($i=1; $i<6; $i++){
                                                                            if($i<=$review->rating){
                                                                        ?>
                                                                                <button type="button" class="btn btn-warning btn-xs" style="background: green; border-color: green; outline: none;" aria-label="Left Align">
                                                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                                                </button>
                                                                        <?php
                                                                            }
                                                                            else{
                                                                        ?>
                                                                                <button type="button" class="btn btn-default btn-grey btn-xs" style="outline: none;" aria-label="Left Align">
                                                                                    <span class="glyphicon glyphicon-star" style="color: white;" aria-hidden="true"></span>
                                                                                </button>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="review-block-title"><?php $review->rating > '3' ? print_r("Nice Riview") : print_r("Please Improve in your riview") ?></div>
                                                                    <div class="review-block-description">{{$review->review}}</div>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                        @empty
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
                                                                    <h4>{{$language->no_review}}</h4>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-sm-12 text-center">
                                                    @if(Auth::guard('profile')->check())
                                                        <button type="button" onclick="reviewSubmit()" class="btn btn-primary">Your Review</button>
                                                    @else
                                                        <button type="button" onclick="loginFirst()" class="btn btn-primary">Your Review</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-padding product-carousel-wrapper wow fadeInUp">
        <div class="container-fluid latest_product_container">
            <!--<div class="product-carousel-full-div">-->
                <div class="row margin-bottom-0">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="margin-bottom-0">{{$language->related_products}}</h2>
                            <!--<hr>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="col-md-12">-->
                        <div class="product-carousel-list">
                            @foreach($relateds as $product)
                                <div class="single-product-carousel-item" id="imagepad" >
                                    <div class="image_latest_product_shubh">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                        @php $gallery = $product->gallery_images->toArray(); @endphp
                                        <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
                                    </div>
                                    <div class="product-carousel-text">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                            <h4 class="product-title">{{$product->title}}</h4>
                                        </a>
                                        <div class="product-price">
                                            <div class="offer-price">₹{{$product->previous_price}}</div>
                                        </div>
                                        <div class="product-meta-area">
                                            <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                            <!--    <i class="fa fa-eye"></i>-->
                                            <!--</a>-->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    <!--</div>-->
                </div>
            <!--</div>-->
        </div>
    </div>

        <!-- tranding products area start -->
    @if($pagesettings[0]->featuredpro_status)
    <!-- starting of featured project area -->
    <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp" id="tendingpad">
        <div class="container-fluid">
            <!--<div class="product-carousel-full-div">-->
                <div class="row margin-bottom-0">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="margin-bottom-0">{{$language->featured_products}}</h2>
                            <!--<hr>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="col-md-12">-->
                        <div class="product-carousel-list">
                            @foreach($tranding as $product)
                                <div class="single-product-carousel-item" id="imagepad" >
                                    <div class="image_latest_product_shubh">
                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                    @php $gallery = $product->gallery_images->toArray(); @endphp
                                    <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" style="margin: 0px; margin-left: 0px;" /> </a>
                                    </div>
                                    <div class="product-carousel-text">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                            <h3 class="product-title">{{$product->title}}</h3>
                                        </a>
                                        <div class="product-price">
                                            @if($product->previous_price != "")
                                                <!--<span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                            @else
                                            @endif
                                            <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                            <div class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    <!--</div>-->
                </div>
            <!--</div>-->
        </div>
    </div>
    <!-- Ending of featured project area -->
    @endif
<!-- tranding products area end -->

<!-- popup for show all Information -->
@include('components.productdetail.popupforshowallinformation')
<!-- popup for show all end -->

<!--Lens Prescription Form Start-->
@include('components.productdetail.lensprescription')
<!--Lens Prescription Form End-->

<!-- end popup for show all information -->


        <!-- for selected image slider  start-->

    @if($pagesettings[0]->featuredpro_status)
    <!-- starting of featured project area -->
    <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp" id="selectedpad">
        <div class="container-fluid">
            <!--<div class="product-carousel-full-div">-->
                <div class="row margin-bottom-0">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="margin-bottom-0">Selected Product</h2>
                            <!--<hr>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="col-md-12">-->
                        <div class="product-carousel-list">
                            @foreach($selected as $product)
                                <div class="single-product-carousel-item" id="imagepad">
                                    <div class="image_latest_product_shubh">
                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                    @php $gallery = $product->gallery_images->toArray(); @endphp
                                    <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" style="margin: 0px; margin-left: 0px;" /> </a>
                                    </div>
                                    <div class="product-carousel-text">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                            <h3 class="product-title">{{$product->title}}</h3>
                                        </a>
                                        <!--<div class="ratings">-->
                                        <!--    <div class="empty-stars"></div>-->
                                        <!--    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>-->
                                        <!--</div>-->
                                        <div class="product-price">
                                            @if($product->previous_price != "")
                                                <!--<span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                            @else
                                            @endif
                                            <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                            <div class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    <!--</div>-->
                </div>
            <!--</div>-->
        </div>
    </div>
    <!-- Ending of featured project area -->
    @endif
    <!-- for selected image slider  end -->
</div>

<input type="hidden" id="mainId" value="{{$productdata->id}}">
<input type="hidden" id="availablity" value="{{$language->available}}">
<input type="hidden" id="outofstock" value="{{$language->out_of_stock}}">
<input type="hidden" id="addtocartbutton" value="{{$language->add_to_cart}}">
<input type="hidden" id="productdimensionsize" value="{{$productdata->productdimension}}">
    
<!-- Product cost popup modal -->
@include('components.productdetail.productcost')
<!-- Product cost popup modal end-->

<!-- for review template start -->
@include('components.productdetail.review')
<!-- for review template end -->



@stop

@section('footer')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ URL::asset('assets/js/productdetail/lensprescription.js')}}"></script>
<script src="{{ URL::asset('assets/js/productdetail/lensprescription.js')}}"></script>
<script src="{{ URL::asset('assets/js/productdetail/product.js')}}"></script>
<script src="{{ URL::asset('assets/js/productdetail/productreview.js')}}"></script>
<script src="{{ URL::asset('assets/js/productdetail/colorimagefilter.js')}}"></script>

<script type="text/javascript" src="https://www.color-blindness.com/color-name-hue-tool/js/ntc.js"></script>

<script type="text/javascript">
        var value = $('.getColor').val();
        let result = ntc.name(value);
        var is_exact_match = result[3];
        var is_exact_match2 = result[1];
        $('.lenscolor').text(is_exact_match + '  ( '+ is_exact_match2 +' )');
</script>

<script>
    var baseUrl = "{{url('/')}}";
    const queryString = window.location.search;
</script>

<script>

    // multiple images fetch from onclick function for product attribute ----------

    function changeSize(size, e) 
    {
        for(let i=0; i<$("#product-size").children().length; i++)
        {
            $($("#product-size").children()[i]).css("border-color", "");
        }
        $(e.target).css({"border-color": "blue" ,"border-width" :"3px"});
        $('#size').val(size);
        $('#size_span').text(size);
    }
    
    var prescriptionData;
    $(document).ready(function() {
        prescriptionData = localStorage.getItem("formObject");
    });
</script>

<script>
    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });

    $("#showmore").click(function() {
        $('html, body').animate({
            scrollTop: $("#description").offset().top - 200
        }, 1000);
    });


    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });
</script>

<script>
function myFunction() {
var popup = document.getElementById("myPopup");
popup.classList.toggle("show");

if (popup.paused){ 
    popup.play(); 
    }
  else{ 
    popup.pause();
    }
 
}
</script>

@stop