@extends('includes.newmaster')
@section('content')
    {{-- Start by Qasim --}}
    <style type="text/css">
        .flex-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding-top: 17px;
        }

        .flex-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f1f1f1;
            width: 100%;
            margin-bottom: 5px;
            padding: 5px;
            font-size: 30px;
            border-radius: 5px;
        }

        .flex-item img {
            max-width: 100%;
            height: auto;
        }

        @media screen and (max-width: 768px) {
            .small_banner{
                margin-top: 5rem;
            }
            .small_banner .container-fluid .row {
                padding-left: 30px;
            }
            .flex-container {
                grid-template-columns: repeat(2, minmax(60px, 1fr));
                gap: 2px !important;
            }
            
            .banner_title{
                font-size: 12px;
            }

            .flex-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #f1f1f1;
                width: 80%;
                margin-bottom: 5px;
                padding: 5px;
                font-size: 30px;
                border-radius: 5px;
            }
    
            .flex-item img {
                max-width: 100%;
                height: auto;
            }
        }

        @media screen and (max-width: 969px) {
            .flex-item img {
                width: 200px;
                height: auto;
            }
        }

        @media screen and (max-width: 991px) {
            .joinus {
                margin-top: 10px;
            }

            #sociallinks {
                margin-top: 5px;
            }

            #subcription_input {
                margin-top: -1px;
            }

            .product-title {
                font-size: 1.1rem;
            }
        }

        /* Start media query for image carousel */
        @media screen and (max-width: 599px) {
            .image_latest_product_shubh {
                width: 500px;
                height: 200px
            }
        }


        /* Start media query by Qasim */
        @media screen and (max-width: 1316px) {
            .product-title {
                margin-bottom: 25px;
                font-size: 1.3rem;
            }
        }

        @media screen and (max-width: 1084px) and (min-width: 768px) {
            .product-title {
                margin-bottom: 30px;
                font-size: 1.3rem;
                /* margin-bottom: 0px; */
            }
            
            .small_banner{
                margin-top: 5rem;
            }
        }

        @media screen and (max-width: 767px) and (min-width: 480px) {
            .product-title {
                font-size: 1rem;
                /* margin-bottom: 0px; */
            }
        }

        .product-title {
            margin-bottom: 25px;
        }

        @media screen and (max-width: 479px) {
            .product-title {
                font-size: 1rem;
            }
        }

        @media screen and (max-width: 767px) and (min-width: 360px) {
            .single-product-carousel-item {
                padding-left: 1rem !important;
            }
        }

        /* End media query by Qasim */
        /* End media query for image carousel */
    </style>
    {{-- End by Qasim --}}


    <div class="home-wrapper" style="overflow: hidden">
        <!--start newslider as per client -->
        <div class="col-lg-12">
            <div id="myCarousel" class="carousel slide demo" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mainslider as $key => $banner)
                        <div class="item {{ $key == 0 ? 'active' : '' }}">
                            <a href="{{ $banner->link }}">
                                @php
                                    echo '<img style="border-radius: 10px; width: 100%;" src="' . asset('assets/images/categories/16826830091650269904assistant-eyeglasses-returning-exam-sheets.jpg') . '">';
                                @endphp
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!---LATEST ARRIVALS--->
        @if ($pagesettings[0]->latestpro_status)
            <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp" id="latest">
                <div class="container-fluid" style="margin-top: -50px;">
                    <div class="container-fluid"></div>
                    <div class="small_banner">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="flex-container">
                                    @foreach ($smallbox as $banner)
                                        <div class="flex-item">
                                            <h4 class="banner_title">{{ $banner->title }}</h4>
                                            <a href="{{ $banner->link }}">
                                                @php
                                                    echo '<img src="' . asset('assets/images/sliders') . '/' . $banner->image . '" class="responsive">';
                                                @endphp
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of pranali's code for 4 banner -->

                <!--<div class="product-carousel-full-div">-->
                <div class="container-fluid">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title padding-bottom-0">
                                <h2 class="margin-bottom-0" style="margin-top: 30px;">{{ $language->latest_products }}</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-3 col-sm-12 product-carousel-list">
                            @foreach ($new as $product)
                                <div class="single-product-carousel-item text-center" style="padding-left: 6rem">
                                    <div class="container-fluid">
                                        <div class="image_latest_product_shubh">
                                            @php $gallery = $product->gallery_images->toArray(); @endphp
                                            <a
                                                href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace('/', '', strtolower($product->title)) }}">
                                                @if($gallery)
                                                    @php
                                                        echo '<img src="' . asset('assets/images/gallery') . '/' . $gallery[0]['image'] . '" class="responsive">';
                                                    @endphp
                                                @endif
                                            </a>
                                            <a class="img-top"
                                                href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace('/', '', strtolower($product->title)) }}">
                                                @php
                                                    echo '<img src="' . asset('assets/images/products') . '/' . $product->feature_image . '" class="responsive">';
                                                @endphp
                                        </div>
                                    </div>
                                    <div class="product-carousel-text">
                                        <a href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace('/', '', strtolower($product->title)) }}">
                                            <h4 class="product-title">{{ $product->title }}</h4>
                                        </a>
                                        <div class="product-price">
                                            <div class="original-price">
                                                {{ $settings[0]->currency_sign }}{{ $product->previous_price }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                <!--</div>-->
            </div>
        @endif

    <!--TRENDING PRODUCTS-->
    @if ($pagesettings[0]->featuredpro_status)
        <!-- starting of featured project area -->
        <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <!--<div class="product-carousel-full-div">-->
                <div class="row margin-bottom-0">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="margin-bottom-0">{{ $language->featured_products }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-sm-12 product-carousel-list">
                        @foreach ($tranding as $product)
                            <div class="single-product-carousel-item text-center" style="padding-left: 6rem">
                                <div class="image_latest_product_shubh">
                                    <a
                                        href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace(' ', '-', strtolower($product->title)) }}">
                                        @php
                                            echo '<img src="' . asset('assets/images/products') . '/' . $product->feature_image . '" class="responsive">';
                                        @endphp
                                    </a>
                                    @php $gallery = $product->gallery_images->toArray(); @endphp
                                    <a class="img-top"
                                        href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace(' ', '-', strtolower($product->title)) }}">
                                        @if(isset($gallery[0]))
                                            @php
                                                echo '<img src="' . asset('assets/images/gallery') . '/' . $gallery[0]['image'] . '" class="responsive" style="margin: 0px; margin-left: 0px;">';
                                            @endphp
                                        @endif
                                    </a>
                                </div>
                                <div class="product-carousel-text">
                                    <a
                                        href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace(' ', '-', strtolower($product->title)) }}">
                                        <h3 class="product-title">{{ $product->title }}</h3>
                                    </a>
                                    <div class="product-price">
                                        <div class="original-price">
                                            {{ $settings[0]->currency_sign }}{{ $product->previous_price }}</div>
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

    @if ($pagesettings[0]->popularpro_status)
        <!-- starting of best seller area -->
        <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <!--<div class="product-carousel-full-div">-->
                <div class="row margin-bottom-0">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>{{ $language->popular_products }}</h2>
                            <!--<hr>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-carousel-list">
                            @foreach ($tops as $product)
                                <div class="single-product-carousel-item text-center">
                                    <div class="image_latest_product_shubh">
                                        <a href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace('/', '', strtolower($product->title)) }}">
                                            @php
                                                echo '<img src="' . asset('assets/images/products') . '/' . $product->feature_image . '" class="responsive" style="margin: 0px; margin-left: 0px;">';
                                            @endphp
                                        </a>
                                    </div>
                                    <div class="product-carousel-text">
                                        <a href="{{ url('/product') }}/{{ $product->id }}/{{ str_replace(' ', '-', strtolower($product->title)) }}">
                                            <h4 class="product-title">{{ $product->title }}</h4>
                                        </a>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars"
                                                style="width:{{ \App\Review::ratings($product->id) }}%"></div>
                                        </div>
                                        <div class="product-price">
                                            <div class="original-price">
                                                {{ $settings[0]->currency_sign }}{{ $product->previous_price }}
                                            </div>
                                        </div>
                                        <div class="product-meta-area">
                                            <a href="javascript:;" class="wish-list"
                                                onclick="getQuickView({{ $product->id }})" data-toggle="modal"
                                                data-target="#myModal">
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
    @if($pagesettings[0]->lbanner_status)
        <!-- Starting of New Home Slider area -->
        <div class="container" style="width: 100%; max-height: 100%;">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($newsliders as $key => $banner)
                        <div class="item {{ $key == 0 ? 'active' : '' }}">
                            <a href="{{ $banner->link }}" target="_blank">
                                {{-- <img style="border-radius: 25px; "
                                    src="{{ url('/assets/images/sliders') }}/{{ $banner->image }}"
                                    class="img-responsive" alt="Responsive image"> --}}
                                @php
                                    echo '<img style="border-radius: 10px;" src="' . asset('assets/images/sliders') . '/' . $banner->image . '" class="img-responsive" alt="Product Image">';
                                @endphp
                            </a>
                        </div>
                    @endforeach
                </div>


                <!-- Left and right controls -->

            </div>
        </div>

        <!-- Ending of New Home Slider area -->
    @endif





    <!--Advertisement small banner brands-->
    @if ($pagesettings[0]->sbanner_status)
        <!--Starting of product-imageBlog area -->
        <div class="section-padding product-imageBlog-section padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row" style="margin-right: -29px;">
                    <div class="col-md-12 padding-left-0">
                        <!--<div class="product-imgBlog-fullDiv">-->
                        @foreach ($banners as $banner)
                            <div class="col-md-4">
                                <a href="{{ $banner->link }}" target="_blank">
                                    <img height="400" width="400" id="small-ads-image-shubh"
                                        src="{{ url('/assets') }}/images/brands/{{ $banner->image }}"
                                        class="img-responsive" alt="Responsive image">
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

    @if ($pagesettings[0]->blogs_status)
        <!-- Starting of blog area -->
        <div class="section-padding blog-area-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="blog-area-fullDiv">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="section-title text-center">
                                <h2>{{ $languages->blog_title }}</h2>
                                <p>{{ $languages->blog_text }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="blog-area-slider">
                                @foreach ($blogs as $blog)
                                    <div class="single-blog-box">
                                        <div class="blog-thumb-wrapper">
                                            <img src="{{ url('/assets') }}/images/blog/{{ $blog->featured_image }}"
                                                alt="Blog Image">
                                        </div>
                                        <div class="blog-text">
                                            <p class="blog-meta">{{ date('d M Y', strtotime($blog->created_at)) }}</p>
                                            <h4>{{ $blog->title }}</h4>
                                            <p>{{ substr(strip_tags($blog->details), 0, 125) }}</p>
                                            <a href="{{ url('/blog') }}/{{ $blog->id }}"
                                                class="blog-more-btn">{{ $language->view_details }}</a>
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
    @if ($pagesettings[0]->testimonial_status)
        <!-- Starting of customer review carousel area -->
        <div class="customer-review-carousel-wrapper text-center wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="customer-review-carousel-image">
                            <img src="{{ url('/assets/images') }}/{{ $settings[0]->background }}" alt="">
                            <div class="review-carousel-table">
                                <div class="review-carousel-table-cell">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                                                <div class="section-title text-center">
                                                    <h2>{{ $languages->testimonial_title }}</h2>
                                                    <p>{{ $languages->testimonial_text }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="testimonial-section animated fadeInRight">
                                                    @foreach ($testimonials as $testimonial)
                                                        <div class="single-testimonial-area">
                                                            <div class="testimonial-text">
                                                                <p>{{ $testimonial->review }}</p>
                                                            </div>
                                                            <div class="testimonial-author">
                                                                <img src="{{ url('/assets/images/cusavatar.png') }}"
                                                                    alt="Author">
                                                                <h4><strong>{{ $testimonial->client }}</strong> <br>
                                                                    {{ $testimonial->designation }}</h4>
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



    @if ($pagesettings[0]->brands_status)
        <!--Starting of brandLogo-carousel-wrapper area -->
        <div class="section-padding logo-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <!--<div class="col-md-12">-->
                    <div class="logo-carousel">
                        @foreach ($brands as $brand)
                            <div class="single-logo-item">
                                <div class="logo-item-inner">
                                    <img src="{{ url('/assets/images/brands') }}/{{ $brand->image }}" alt="">
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
    @if ($pagesettings[0]->subscribe_status)

        <div class="section-padding product-imageBlog-section padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ $banner->link }}" target="_blank">
                            {{-- <img style="max-height : 388px; width: 100%; margin-left: 0px;" id="subscription_form_image"
                                src="{{ url('/assets/images') }}/{{ $settings[0]->background }}"
                                class="img-responsive" alt="Responsive image"> --}}
                            @php
                                echo '<img class="img-responsive" alt="Responsive image" style="max-height : 388px; width: 100%; margin-left: 0px;" src="' . asset('assets/images'). '/' . $settings[0]->background . '">';
                            @endphp
                        </a>
                    </div>
                    <div class="col-md-8" id="bottomCarouselSlider" style="padding-bottom: 10px">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($bottomslider as $key => $banner)
                                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                                        <a href="{{ $banner->link }}">
                                            {{-- <img id="bottomslider"style="border-radius: 25px; width: 100%; height: 380px;"
                                                src="{{ url('/assets') }}/images/sliders/{{ $banner->image }}"> --}}

                                            @php
                                                echo '<img id="bottomslider" style="border-radius: 25px; width: 100%; height: 380px;" src="' . asset('assets/images/sliders') . '/' . $banner->image . '" class="responsive" style="margin: 0px; margin-left: 0px;">';
                                            @endphp
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
        <div class="col-md-4" style="padding-top: 18px;">
            <div class="text-center joinus">
                <h5 style="align-content: center;">BE IN TOUCH WITH US:</h5>
            </div>
        </div>
        <div class="col-md-5">
            <div class="text-center pranali joinus">
                <form id="subform" action="{{ action('FrontEndController@subscribe') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group" style="margin-top: 3px" id="subcription_input">
                        <input type="email" name="email" id="email" class="form-control"
                            style="height: 47px; margin-right: 238px;" placeholder="Enter Email">
                        <span class="input-group-btn">
                            <button class="btn btn-default" style="margin-top: 2px" type="submit">JOIN US</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3" style="background: #C0C0C0;" id="sociallinks">
            <div class="text-center sociallinks">
                <div class="footer-social-links" style="padding-top: 12px; padding-right: 45px;">
                    <li>
                        <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2Febangladesh "style="border: none;">
                            <img src="https://img.icons8.com/ios/50/000000/facebook-new.png" />
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/"style="border: none;">
                            <img src="https://img.icons8.com/fluency-systems-regular/48/000000/instagram-new--v1.png" />
                        </a>
                    </li>

                    <li>
                        <a href="https://twitter.com/" style="border: none;">
                            <img src="https://img.icons8.com/ios/48/000000/twitter-circled--v1.png" />
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <!-- End Of pranali's Code For Subscribe For  -->
    </div>
@stop

@section('footer')

    <script>
        // Wrap every letter in a span
        // Wrap every letter in a span
        var textWrapper = document.querySelector('.ml10 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({
                loop: true
            })
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
