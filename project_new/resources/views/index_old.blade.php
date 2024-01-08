@extends('includes.newmaster')
@section('content')
<style type="text/css">

.flex-container {
  display: flex;
  flex-wrap: nowrap;
  height: 50%;padding-top: 17px;
 
}

/*.flex-container > div {
  background-color: #f1f1f1;
  width: 24%;
  height:80%;
  margin: 10px;
  padding: 5px;
  text-align: center;
  line-height: 75px;
  font-size: 30px;
  border-radius: 30px;
}*/

.flex-container > div {
  background-color: #f1f1f1;
  width: 24%;
  height:80%;
  margin: 8px;
  margin-right: 16px;
  padding: 18px;
  text-align: justify;
  line-height: 75px;
  font-size: 30px;
  border-radius: -7px;
  padding-left: 25px;
  padding-top: 31px;
}


.responsive {
    width: 249%;
    height: 40%;
}

.test{
    position: absolute; top: 40%; width: 100%; user-select: none; -ms-user-select: none; -moz-user-select: none;
}

@media screen and (min-width:480px) and (max-width:600px ){
    .demo{
       height: 100%;
       width: 100%;
    }

    .responsive{
        height: 50%;
        width: 60%;
    }

    .test{
        position: absolute;
        top:30%;
        width: 100%;
        height: 270px;
        user-select: none; -ms-user-select: none; -moz-user-select: none;
    }
    .test h4{
        font-size: 8px;
    }

    .test img{
        border-radius: 30px;
    }
}

@media screen and (min-width:400px) and (max-width:480px ){
    .demo{
       height: 100%;
       width: 100%;
    }

    .product-price {
        font-size: 15px;
        font-weight: 400;
        margin-left: -81px;
    }

    .product-title {
        font-size: 16px;
        height: 30px;
        margin-right: 83px;
    }
    
    .responsive{
        height: 70%;
        width: 70%;
    }

     #top-bar-shubhnew{
        display: none;
        }

    .test{
        position: absolute;
        top:30%;
        width: 100%;
        height: 230px;
        user-select: none; -ms-user-select: none; -moz-user-select: none;
    }
    .test h4{
        font-size: 6px;
    }

    .test img{
        border-radius: 10px;
    }

    .owl-carousel .owl-item img {
        display: block;
        width: 100%;
        margin-left: -40px;
        -webkit-transform-style: preserve-3d;
        /* box-shadow: 5px 5px 10px #aaaaaa; */
    }
}

@media screen and (min-width: 300px) and (max-width: 400px) {
    .owl-carousel .owl-item img {
        display: block;
        width: 100%;
        margin-left: -43px;
        -webkit-transform-style: preserve-3d;
        /* box-shadow: 5px 5px 10px #aaaaaa; */
    }

    .product-carousel-text {
        /* margin-top: 220px; */
        margin-top: -15px;
        margin-right: 80px;
        /* height: 150px; */
        height: 85px;
        text-align: center;
        position: relative;
    }

    #top-bar-shubh{
        margin: 0;
        z-index: 9999;
        /* background-color: #e90505; */
        background-image: linear-gradient(
        315deg, #e90505 100%, white 0%);

        height: 37px;
        color: #ffffff;
        font-size: 13px;
        font-weight: 200;
        padding-left: 20px;
         /*font-family: 'Mada', sans-serif;*/
    }

    .header-top-entry .title {
        padding: 0 26px;
    }

    .open-cart-popup{
        display: none;
    }

    #logo img {
        display: none;
        width: 60%;
        padding-top: 5px;
    }

    #latest{
        margin-top: -84px;
    }

    #top-bar-shubhnew{
        display: none;
    }


    .section-padding.product-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev, .section-padding.blog-area-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev, .section-padding.logo-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev {
        left: 10px;
        padding-bottom: -39px;
        margin-top: -60px;
    }

    .section-title h2 {
        padding-left: 0px;
        font-size: 15px;
        margin-top: 10px;
    }


    .section-padding.product-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-next, .section-padding.blog-area-wrapper .owl-carousel .owl-controls .owl-nav .owl-next, .section-padding.logo-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-next {
        margin-top: -60px;
        right: 0px;
    }


    .test{
        position: absolute;
        top:18%;
        width: 100%;
        height: 200px;
        user-select: none; -ms-user-select: none; -moz-user-select: none;
    }
    .test h4{
        font-size: 5px;
    }

    .test img{
        border-radius: 10px;
    }

        .responsive{
        height: 50%;
        width: 50%;
    }


}


@media screen and (min-width:600px) and (max-width:800px ){
    .demo{
       height: 100%;
       width: 100%;
    }

    .responsive{
        height: 75%;
        width: 70%;
    }

    .test{
        position: absolute;
        top:30%;
        width: 100%;
        height: 380px;
        user-select: none; -ms-user-select: none; -moz-user-select: none;
    }
    .test h4{
        font-size: 10px;
    }

    .test img{
        border-radius: 30px;
    }
}


@media screen and (max-width: 768px){
    .text-center.pranali{
        padding-left: 44px;
        height: 45px;
        margin-right: 300px;
        margin-left: -265px;
        padding-left: 474px;
        margin-top: -47px;
        padding-right: 169px;
    }

    .image_div_shubh 
    {
        text-align: center;
        vertical-align: middle;
    }

    .single-product-item {
        cursor: pointer;
        height: 50px;
        /* width: 50px; */
        width: 170px;
        display: inline-block;
        background-color: #fff;
    }

}

     @media screen and (max-width: 768px){
        .text-center.sociallinks{
            margin-top: -52px;
            margin-right: -44px;
        }
     }
     @media screen and (max-width: 768px){
        .text-center.joinus{
            text-align: left;
            padding-left: 30px;
        }
     }

     @media screen and (max-width: 1024px)
     {

            .home-wrapper {
                background-color: white;
                padding-bottom: 0px;
            }
     }

    }

/*end of for mobile latest


    @media screen and (min-width:400px) and (max-width:550px ){
        .demo{
           height: 100%;
           width: 100%;
        }

        .responsive{
            height: 75%;
            width: 70%;
        }

        .test{
            position: absolute;
            top:30%;
            width: 100%;
            height: 230px;
            user-select: none; -ms-user-select: none; -moz-user-select: none;
        }
        .test h4{
            font-size: 6px;
        }

        .test img{
            border-radius: 15px;
        }
    }



    @media screen and (min-width: 480px) {
       /* .leftsidebar {width: 200px; float: left;}
        .main {margin-left: 216px;}*/
     /*   .boxline{
                height: 50px;
                width: 100%;
                background-color: white;
                margin-left: 127px;
        }*/
        
}



</style>

 <div class="home-wrapper" style="overflow: hidden">
    <!--start newslider as per client -->
    <div class="col-lg-12">
        <div id="myCarousel" class="carousel slide demo"  data-ride="carousel">
            <div class="carousel-inner">
                @foreach($mainslider as $key => $banner)
                  <div class="item {{$key == 0 ? 'active':''}}">
                    <a href="{{$banner->link}}">
                        <img style="border-radius: 25px; width: 100%;" src="{{url('/assets')}}/images/sliders/{{$banner->image}}">
                    </a>
                  </div>
                @endforeach
            </div>
        </div>
    </div>
<!-- end newslider as per client -->

       <!--  @if($pagesettings[0]->category_status) -->
        <!-- Starting of featured product area
        <div class="section-padding featured-categories padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="product-featured-full-div">-->
                   <!--  <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->top_category}}</h2>
                                
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row featured-list">
                        <div class="featured-categories-wrapper">
                            <div class="col-md-6 col-sm-12">
                                <div class="single-featured-area">
                                    <a href="{{url('/category')}}/{{$fcategory->slug}}">
                                        <img class="featured-img" src="{{url('/assets')}}/images/categories/{{$fcategory->feature_image}}" alt="">
                                        <div class="product-feature-content">
                                            <h3>{{$fcategory->name}}</h3>
                                            @if(\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()>1)
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()}} products</p>
                                            @else
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()}} product</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @foreach($fcategories as $fcat)
                            <div class="col-md-3 col-sm-6">
                                <div class="single-featured-area">
                                    <a href="{{url('/category')}}/{{$fcat->slug}}">
                                        <img class="featured-img" src="{{url('/assets')}}/images/categories/{{$fcat->feature_image}}" alt="">
                                        <div class="product-feature-content">
                                            <h4>{{$fcat->name}}</h4>
                                            @if(\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()>1)
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()}} products</p>
                                            @else
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()}} product</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div> -->
                <!--</div>-->
           <!--  </div>
        </div> -->
        <!-- Ending of featured product area -->
        <!-- @endif -->

        <!--@if($pagesettings[0]->sbanner_status)-->
        <!-- Starting of product-imageBlog area -->
        <!--<div class="section-padding product-imageBlog-section padding-top-0 padding-bottom-0 wow fadeInUp">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
                        <!--<div class="product-imgBlog-fullDiv">-->
        <!--                    @foreach($banners as $banner)-->
        <!--                    <div class="col-md-4">-->
        <!--                        <a href="{{$banner->link}}" target="_blank">-->
        <!--                            <img src="{{url('/assets')}}/images/brands/{{$banner->image}}" alt="">-->
        <!--                        </a>-->
        <!--                    </div>-->
        <!--                    @endforeach-->
                        <!--</div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- Ending of product-imageBlog area -->
        <!--@endif-->
        
        
        <!---LATEST ARRIVALS--->
        @if($pagesettings[0]->latestpro_status)
        <!-- starting of new project area -->
        <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp" id="latest">
            <div class="container-fluid">
            <!-- pranali's code for 4 banner -->
                </div>
                    <div class="flex-container">
                         @foreach($smallbox as $banner)
                        <div>  
                             <h4>{{$banner->title}}</h4>
                            <a href="{{$banner->link}}">
                                <img src="{{url('assets/images/sliders')}}/{{$banner->image}}" class="responsive" >
                            </a>
                        </div>
                           @endforeach              
                    </div>

                    <!-- end of pranali's code for 4 banner -->

                <!--<div class="product-carousel-full-div">-->
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title padding-bottom-0">
                                <h2 class="margin-bottom-0" style="margin-top: 30px;">{{$language->latest_products}}</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-md-12">-->
                            <div class="col-md-4 product-carousel-list">
                                @foreach($new as $product)
                                    <div class="single-product-carousel-item text-center margin-left-0" style="padding-left: 106px">
                                        <div class="image_latest_product_shubh">
                                        <!--<a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>-->
                                        @php $gallery = $product->gallery_images->toArray(); @endphp
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
                                        <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                        </div>
                                        <div class="product-carousel-text">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}">
                                                <h4 class="product-title">{{$product->title}}</h4>
                                            </a>
                                            <!--<div class="ratings">-->
                                            <!--    <div class="empty-stars"></div>-->
                                            <!--    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>-->
                                            <!--</div>-->
                                            <div class="product-price">
                                                <!--@if($product->previous_price != "")-->
                                                <!--    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                                <!--@else-->
                                                <!--@endif-->
                                                <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                                <div class="original-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</div>
                                            </div>
                                            <!--<div class="product-meta-area">-->
                                            <!--    <form class="addtocart-form">-->
                                            <!--        {{csrf_field()}}-->
                                            <!--        @if(Session::has('uniqueid'))-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">-->
                                            <!--        @else-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">-->
                                            <!--        @endif-->
                                            <!--        <input type="hidden" name="title" value="{{$product->title}}">-->
                                            <!--        <input type="hidden" name="product" value="{{$product->id}}">-->
                                            <!--        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">-->
                                            <!--        <input type="hidden" id="quantity" name="quantity" value="1">-->
                                            <!--        @if($product->stock != 0 || $product->stock === null )-->
                                            <!--            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--        @else-->
                                            <!--            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>-->
                                            <!--        @endif-->
                                            <!--    </form>-->
                                                <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                                <!--    <i class="fa fa-eye"></i>-->
                                                <!--</a>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <!--</div>-->
                    </div>
                <!--</div>-->
            </div>
        </div>
        <!-- Ending of new project area -->
        @endif
        
        <!--TRENDING PRODUCTS-->
        @if($pagesettings[0]->featuredpro_status)
        <!-- starting of featured project area -->
        <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp">
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
                                    <div class="single-product-carousel-item text-center" style="padding-left: 106px;">
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
                                                <!--@if($product->previous_price != "")-->
                                                <!--    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                                <!--@else-->
                                                <!--@endif-->
                                                <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                                <div class="original-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</div>
                                            </div>
                                            <!--<div class="product-meta-area">-->
                                            <!--    <form class="addtocart-form">-->
                                            <!--        {{csrf_field()}}-->
                                            <!--        @if(Session::has('uniqueid'))-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">-->
                                            <!--        @else-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">-->
                                            <!--        @endif-->
                                            <!--        <input type="hidden" name="title" value="{{$product->title}}">-->
                                            <!--        <input type="hidden" name="product" value="{{$product->id}}">-->
                                            <!--        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">-->
                                            <!--        <input type="hidden" id="quantity" name="quantity" value="1">-->
                                            <!--        @if($product->stock != 0 || $product->stock === null )-->
                                            <!--            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--        @else-->
                                            <!--            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>-->
                                            <!--        @endif-->
                                            <!--    </form>-->
                                                <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                                <!--    <i class="fa fa-eye"></i>-->
                                                <!--</a>-->
                                            <!--</div>-->
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
        
        @if($pagesettings[0]->popularpro_status)
        <!-- starting of best seller area -->
        <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <!--<div class="product-carousel-full-div">-->
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->popular_products}}</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-carousel-list">
                                @foreach($tops as $product)
                                    <div class="single-product-carousel-item text-center">
                                        <div class="image_latest_product_shubh">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                        </div>
                                        <div class="product-carousel-text">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                <h4 class="product-title">{{$product->title}}</h4>
                                            </a>
                                            <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>
                                            </div>
                                            <div class="product-price">
                                                <!--@if($product->previous_price != "")-->
                                                <!--    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>-->
                                                <!--@else-->
                                                <!--@endif-->
                                                <!--<del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>-->
                                                <div class="original-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</div>
                                            </div>
                                            <div class="product-meta-area">
                                                <form class="addtocart-form">
                                                    {{csrf_field()}}
                                                    @if(Session::has('uniqueid'))
                                                        <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                                    @else
                                                        <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                                    @endif
                                                    <input type="hidden" name="title" value="{{$product->title}}">
                                                    <input type="hidden" name="product" value="{{$product->id}}">
                                                    <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">
                                                    <input type="hidden" id="quantity" name="quantity" value="1">
                                                    @if($product->stock != 0 || $product->stock === null )
                                                        <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                    @else
                                                        <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                                    @endif
                                                </form>
                                                <a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!-- Ending of best seller area -->
        @endif
        
        
        <!--Advertisement full banner-->
       <!--  @if($pagesettings[0]->lbanner_status) -->
        <!-- Starting of Breadcroumb area -->
        <!-- <div class="breadcroumb-section text-center  wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{$pagesettings[0]->banner_link}}" target="_blank">
                            <img height="700px" width="1500px" id="advertisement-full-banner-shubh" style="width: 100%;" src="{{url('/assets/images')}}/{{$pagesettings[0]->large_banner}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Ending of Breadcroumb area -->
        <!-- @endif -->

         <!--Advertisement full banner-->
        @if($pagesettings[0]->lbanner_status)
        <!-- Starting of New Home Slider area -->
    <div class="container" style="width: 100%; max-height: 100%;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
          <!--   <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol> -->

            <!-- Wrapper for slides -->
            
            <div class="carousel-inner">
                @foreach($newsliders as $key => $banner)
                  <div class="item {{$key == 0 ? 'active':''}}">
                    <a href="{{$banner->link}}" target="_blank">
                        <img style="border-radius: 25px; " src="{{url('/assets')}}/images/sliders/{{$banner->image}}" class="img-responsive" alt="Responsive image">
                    </a>
                  </div>
                @endforeach
            </div>
            

            <!-- Left and right controls -->
            
        </div>
    </div>

        <!-- Ending of New Home Slider area -->
        @endif




        
        <!--Advertisement small banner-->
        @if($pagesettings[0]->sbanner_status)
         <!--Starting of product-imageBlog area -->
        <div class="section-padding product-imageBlog-section padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 padding-left-0">
                        <!--<div class="product-imgBlog-fullDiv">-->
                            @foreach($banners as $banner)
                            <div class="col-md-4">
                                <a href="{{$banner->link}}" target="_blank">
                                    <img height="400" width = "400" id="small-ads-image-shubh" src="{{url('/assets')}}/images/brands/{{$banner->image}}" class="img-responsive" alt="Responsive image">
                                </a>
                            </div>
                            @endforeach
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
         <!--Ending of product-imageBlog area -->
        @endif
        
        
        <!--@if($pagesettings[0]->subscribe_status)-->
        <!-- Starting of product subscribe form area -->
        <!--<div class="container-fluid">-->
        <!--    <div class="row">-->
        <!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
        <!--            <div class="product-subscribe-section text-center wow fadeInUp">-->
        <!--                <img src="{{url('/assets/images')}}/{{$settings[0]->background}}" alt="">-->
        <!--                <div class="product-subscribe-form">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">-->
                                    <!--<div class="product-subscribe-form-content">
                                        <div class="product-subscribe-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <h1>{{$language->subscription}}</h1>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, magni, ad. Molestiae, error similique voluptates nam dignissimos, alias fugit assumenda.</p>--}}
                                        <p id="resp"></p>
                                        <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="email" id="email" placeholder="Enter Email" name="email" required>

                                            <input id="subs"  type="button" class="btn subscribe-btn" value="{{$language->subscribe}}">
                                        </form>
                                    </div>
                                </div>
                            </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- Ending of product subscribe form area -->
        <!--@endif-->


        @if($pagesettings[0]->blogs_status)
        <!-- Starting of blog area -->
        <div class="section-padding blog-area-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="blog-area-fullDiv">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="section-title text-center">
                                <h2>{{$languages->blog_title}}</h2>
                                <p>{{$languages->blog_text}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="blog-area-slider">
                                @foreach($blogs as $blog)
                                <div class="single-blog-box">
                                    <div class="blog-thumb-wrapper">
                                        <img src="{{url('/assets')}}/images/blog/{{$blog->featured_image}}" alt="Blog Image">
                                    </div>
                                    <div class="blog-text">
                                        <p class="blog-meta">{{date('d M Y',strtotime($blog->created_at))}}</p>
                                        <h4>{{$blog->title}}</h4>
                                        <p>{{substr(strip_tags($blog->details),0,125)}}</p>
                                        <a href="{{url('/blog')}}/{{$blog->id}}" class="blog-more-btn">{{$language->view_details}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of blog area -->
        @endif
        @if($pagesettings[0]->testimonial_status)
        <!-- Starting of customer review carousel area -->
        <div class="customer-review-carousel-wrapper text-center wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="customer-review-carousel-image">
                            <img src="{{url('/assets/images')}}/{{$settings[0]->background}}" alt="">

                            <div class="review-carousel-table">
                                <div class="review-carousel-table-cell">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                                                <div class="section-title text-center">
                                                    <h2>{{$languages->testimonial_title}}</h2>
                                                    <p>{{$languages->testimonial_text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="testimonial-section animated fadeInRight">
                                                    @foreach($testimonials as $testimonial)
                                                    <div class="single-testimonial-area">
                                                        <div class="testimonial-text">
                                                            <p>{{$testimonial->review}}</p>
                                                        </div>
                                                        <div class="testimonial-author">
                                                            <img src="{{url('/assets/images/cusavatar.png')}}" alt="Author">
                                                            <h4><strong>{{$testimonial->client}}</strong> <br> {{$testimonial->designation}}</h4>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of customer review carousel area -->
        @endif
        
        
        
        @if($pagesettings[0]->brands_status)
         <!--Starting of brandLogo-carousel-wrapper area -->
        <div class="section-padding logo-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <!--<div class="col-md-12">-->
                        <div class="logo-carousel">
                            @foreach($brands as $brand)
                            <div class="single-logo-item">
                                <div class="logo-item-inner">
                                   <img src="{{url('/assets/images/brands')}}/{{$brand->image}}" alt="">
                                </div>
                            </div>
                            @endforeach

                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
         <!--Ending of brandLogo-carousel-wrapper area -->
        @endif
        
        <!-- Pranali's Code For Bottom Slider -->
        @if($pagesettings[0]->subscribe_status)

            <div class="section-padding padding-bottom-0 wow fadeInUp">
                <div class="container-fluid">
                    <div class="row" >
                        <div class="col-md-4" >
                            <a href="{{$banner->link}}" target="_blank">
                                <img style="max-height : 388px; width: 100%; margin-left: 0px;"  id="subscription_form_image" src="{{url('/assets/images')}}/{{$settings[0]->background}}"  class="img-responsive" alt="Responsive image">
                            </a>
                        </div>
                        <div class="col-md-8" >
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  @foreach($bottomslider as $key => $banner)
                                      <div class="item {{$key == 0 ? 'active':''}}">
                                        <a href="{{$banner->link}}">
                                            <img  id="bottomslider"style="border-radius: 25px; width: 100%; height: 380px;" src="{{url('/assets')}}/images/sliders/{{$banner->image}}">
                                        </a>
                                      </div>
                                  @endforeach     
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    <!-- End of Pranali's Code For Bottom Slider -->

        <br><br>
        <!-- pranali's Code For Subscribe For -->

        <div class="row" style="background: #C0C0C0; height: 55px; margin-right: 0px;">
            <div class="col-md-4" style="padding-top: 18px;" >
                <div class="text-center joinus">

                     <h5 style="align-content: center;">BE IN TOUCH WITH US:</h5> 
                </div>
            </div>
            <div class="col-md-5" style="padding-top: 4px;">

                <div class="text-center pranali"> 

                    <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">
                         {{csrf_field()}}
                         <div class="input-group">  
                           <input type="email" name="email" id="email" class="form-control" style="height: 47px; margin-right: 238px;" placeholder="Enter Email" >
                           
                             
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">JOIN US</button>
                                
                              </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center sociallinks ">
                    <div class="footer-social-links" style="padding-top: 12px; padding-right: 45px;" >
                            <li>
                                <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2Febangladesh "style="border: none;" ><img src="https://img.icons8.com/ios/50/000000/facebook-new.png"/></a>
                            
                            </li>                        
                            <li>
                                <a href="https://www.instagram.com/"style="border: none;"><img src="https://img.icons8.com/fluency-systems-regular/48/000000/instagram-new--v1.png"/></a>   
                            </li>
                            
                            <li>
                                <a href="https://twitter.com/" style="border: none;" >
                                    <img src="https://img.icons8.com/ios/48/000000/twitter-circled--v1.png"/>
                                </a>
                            </li>
                    </div> 
                </div>
            </div>
       </div>
<br>
<!-- End Of pranali's Code For Subscribe For  -->







        <!-- @if($pagesettings[0]->subscribe_status) -->
        <!-- Starting of product subscribe form area -->
        <!-- <div class="section-padding padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-xs-12  padding-right-0 padding-left-5">
                        <a href="{{$banner->link}}" target="_blank">
                            <img style="max-height : 400px; width: 100%; margin-left: 0px;"  id="subscription_form_image" src="{{url('/assets/images')}}/{{$settings[0]->background}}"  class="img-responsive" alt="Responsive image">
                        </a>
                    </div>
                    <div class="col-md-8 col-xs-12 padding-right-0 padding-left-0" style="border : 1px solid black; max-height : 390px; max-width:960px; border-radius : 20px; position : relative;padding: 20px; margin-bottom: 10px; margin-left: 3px;">
                        <div class="product-subscribe-form-content-shubh">
                                <div class="subscription-title-shubh">
                                    <h4 id="subscription-heading-shubh">Subscribe for exclusive Reach newsletter</h4>  
                                    <p id="subscription-paragraph-shubh">To receive 
                                    early bird promotional offers and new product arrivals updates</p>
                                </div>
                                <div class="padding-right-0">
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, magni, ad. Molestiae, error similique voluptates nam dignissimos, alias fugit assumenda.</p>--}}
                                    <p id="resp"></p>
                                    <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">
                                        {{csrf_field()}}
                                        <input id="email" placeholder="Enter your email address" type="email" name="email" required/>
                                       
                                        <input id="subs"  type="submit" class="subscribe-button" value="{{$language->subscribe}}">
                                    </form>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
            </div>
        </div> -->

        <!-- Ending of product subscribe form area -->
        <!-- @endif -->
        
        <!--@if($pagesettings[0]->brands_status)-->
        <!-- Starting of brandLogo-carousel-wrapper area -->
        <!--<div class="section-padding logo-carousel-wrapper  wow fadeInUp">-->
        <!--    <div class="container-fluid">-->
        <!--        <div class="row">-->
                    <!--<div class="col-md-12">-->
        <!--                <div class="logo-carousel">-->
        <!--                    @foreach($brands as $brand)-->
        <!--                    <div class="single-logo-item">-->
        <!--                        <div class="logo-item-inner">-->
        <!--                            <img src="{{url('/assets/images/brands')}}/{{$brand->image}}" alt="">-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    @endforeach-->

        <!--                </div>-->
                    <!--</div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- Ending of brandLogo-carousel-wrapper area -->
        <!--@endif-->

    </div>
@stop

@section('footer')

<script>
// Wrap every letter in a span
// Wrap every letter in a span
var textWrapper = document.querySelector('.ml10 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml10 .letter',
    rotateY: [-90, 0],
    duration: 1300,
    delay: (el, i) => 45 * i
  }).add({
    targets: '.ml10',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>
@stop