@extends('includes.newmaster')

@section('content')
<div class="body-wrapper">
    <!-- Mobile Menu Start -->
    <div class="included-mobile-menu">
        @include('includes.mobile-menu')
    </div>
    <!-- Mobile Menu End -->

    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3  section-bg-1">
        <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
            @foreach ($mainslider as $key => $banner)
                <div class="ltn__slide-item-3">
                    <div class="ltn__slide-item-inner">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 p-0">
                                        <a href="{{ $banner->link }}">
                                            @php
                                                echo '<img src="' . asset('assets/images/sliders'). '/' . $banner->image . '">';
                                            @endphp
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- SLIDER AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    <div class="ltn__product-area ltn__product-gutter">
        <div class="container">
            <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                <!-- ltn__product-item -->
                @foreach($smallbox as $banner)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 hover-circle">
                            <div class="product-img">
                                <figure><a href="{{$banner->link}}"><img src="{{url('assets/images/sliders')}}/{{$banner->image}}" alt="#"></a></figure>
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="{{$banner->link}}">{{$banner->title}}</a></h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- PRODUCT AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <div class="ltn__blog-area bg-image bg-overlay-theme-black-80" data-bg="../assets/images/product-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h2 class="section-title white-color">{{$language->latest_products}}</h2>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                @foreach($new as $product)
                    <div class="col-lg-12 front-img">
                        <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="" class="image">
                        <p class="desk">{{substr($product->title, 0, 20)}}...<br><br>( {{$product->productsku}} )</p>
                        <div class="overlay overlay-md overlay-sm">
                            <div class="text white-color">{{$product->title}}<br>
                                <strong class="black-text">{{$settings[0]->currency_sign}}&nbsp;{{$product->costprice}}</strong></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <div class="ltn__blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h2 class="section-title">Trending Products</h2>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                @foreach ($new as $product)
                    <div class="col-lg-12 front-img">
                        <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="" class="image">
                        <p class="desk">{{substr($product->title, 0, 20)}}...<br><br>( {{$product->productsku}} )</p>
                        <div class="overlay overlay-md overlay-sm">
                            <div class="text white-color">{{$product->title}}<br><br>( {{$product->productsku}} )<br>
                                <strong class="black-text">{{$settings[0]->currency_sign}}&nbsp;{{$product->costprice}}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->

    <!-- CATEGORY AREA START -->
    @if($pagesettings[0]->lbanner_status)
        <div class="ltn__category-area section-bg-1--">
            <div class="container-fluid">
                <div class="row ltn__category-slider-active">
                    @foreach ($newsliders as $key => $banner)
                        <div class="col-12 p-0">
                            <div class="ltn__category-item ltn__category-item-3 m-0 p-0 border-0">
                                <div class="ltn__category-item-img">
                                    <a href="{{ $banner->link }}">
                                        <img src="{{asset('assets/images/sliders')}}/{{$banner->image}}" alt="Image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- CATEGORY AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    @if($pagesettings[0]->sbanner_status)
        <div class="ltn__product-area1 ltn__product-gutter">
            <div class="container">
                <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                    <!-- ltn__product-item -->
                    @foreach ($banners as $banner)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12  ">
                            <div class="ltn__product-item1 ltn__product-item-3">
                                <div class="product-img product-img-border">
                                    <a href="#"><img src="{{ url('/assets') }}/images/brands/{{ $banner->image }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- PRODUCT AREA END -->


    <!-- BRAND LOGO AREA START -->
    @if($pagesettings[0]->brands_status)
        <div class="ltn__brand-logo-area ltn__brand-logo-1 section-bg-6 pt-35 pb-35 plr-8">
            <div class="container-fluid">
                <div class="row ltn__brand-logo-active">
                    @foreach ($brands as $brand)
                        <div class="col-lg-12">
                            <div class="ltn__brand-logo-item">
                                <img src="{{ url('/assets/images/brands') }}/{{ $brand->image }}" alt="Brand Logo">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- BRAND LOGO AREA END -->

    <section class="subscibe">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 subscibe-pl">
                    <a href="{{ $banner->link }}"><img src="{{ url('/assets/images') }}/{{ $settings[0]->background }}"></a>
                </div>

                <div class="col-md-8 subscibe-pr">
                    <!-- CATEGORY AREA START -->
                    <div class="ltn__category-area section-bg-1--">
                        <div class="container-fluid">
                            <div class="row ltn__category-slider-active">
                                @foreach ($bottomslider as $key => $banner)
                                    <div class="col-12 p-0">
                                        <div class="ltn__category-item ltn__category-item-3 m-0 p-0 border-0">
                                            <div class="ltn__category-item-img">
                                                <a href="{{ $banner->link }}">
                                                    <img src="{{ url('/assets/images/sliders') }}/{{ $banner->image }}" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY AREA END -->
                </div>
            </div>
        </div>
    </section>


 </div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
@stop
@section('footer')
    <!-- All JS Plugins -->
    <script src="assets/js/new/plugins.js"></script>
    <!-- Main JS -->
    <script src="assets/js/new/main.js"></script>
    <script src="{{ URL::asset('assets/js/plugins.js') }}"></script>

    <script type="text/javascript">
        (function($) {
          $('.collapsible-title').on('click', function() {
            $(this).addClass('is-active').siblings('.collapsible-title').removeClass('is-active');
          });
        })(jQuery);
    </script>

    <script type="text/javascript">
        function opentitle(e)
        {
            $(e.target).parent().find('.collapsible-content').attr("style", "display:block !important");
            $(e.target).parent().siblings().find('.collapsible-title').removeClass('is-active');
            let div = $(e.target).parent().siblings().find('.collapsible-content').attr("style", "display:none");
        }
    </script>
@stop

