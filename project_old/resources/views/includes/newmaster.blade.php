<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!------------- OLD CSS ----------------->
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">-->
        <link href="{{ URL::asset('assets/css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/bootstrap-slider.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/genius-slider.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    
        <link style="height : 10px;" rel="icon" type="image/png" href="{{ url('/') }}/assets/images/{{ $settings[0]->favicon }}" />
        <title>{{ $settings[0]->title }}</title>
    
        <!-- Font Icons css -->
        <!-- <link rel="stylesheet" href="css/font-icons.css"> -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
        <!-- plugins css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/new/plugins.css') }}">
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/new/style.css') }}">
        <!-- Responsive css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/new/responsive.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/new/bootsnav.css') }}">
        @yield('header')
    </head>

<body>
    <div id="navcontainer">
        <!-- HEADER AREA START (header-3) -->
        <header class="ltn__header-area ltn__header-3 section-bg-6">       
            <!-- ltn__header-top-area start -->
            <div class="ltn__header-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="ltn__top-bar-menu">
                                <div class="header-feature-item">
                                    <div class="header-feature-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="header-feature-info">
                                        <p><a href="tel:7700044084">7700044084</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="top-bar-right text-right text-end">
                                <div class="ltn__top-bar-menu">
                                    <ul>
                                        <li>
                                            <!-- ltn__social-media -->
                                            <div class="ltn__social-media">
                                                <ul>
                                                    @if (Auth::guard('profile')->user())
                                                        <li>
                                                            <a href="{{ route('do_login_into_ci') }}" target="_blank"
                                                            onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                                <i class="fa fa-area-chart"></i> ERP
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="http://vamayekar.in/" target="_blank" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                            <i class="fa fa-globe"></i> MyWebsite
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://reachhealth.in/" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                            <i class="fa fa-eye"></i> EyeHealth
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__header-top-area end -->
            
            <!-- ltn__header-middle-area start -->
            <div class="ltn__header-middle-area">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="site-logo">
                                @if (Auth::guard('profile')->check() || Auth::guard('vendor')->check())
                                    <a href="{{ url('/home') }}" id="logo">
                                        <img alt="" src="{{ URL::asset('assets/images/logo') }}/{{ $settings[0]->logo }}">
                                    </a>
                                @else
                                    <a href="{{ url('/homepage') }}" id="logo">
                                        <img alt="" src="{{ URL::asset('assets/images/logo') }}/{{ $settings[0]->logo }}">
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col header-contact-serarch-column d-none d-lg-block">
                            <div class="header-contact-search">
                                <!-- header-feature-item -->
                                <!-- header-search-2 -->
                                <div class="header-search-2">
                                    <form id="searchform" method="get"  action="#">
                                        <input type="search" id="searchdata" placeholder="Search..." name="search"
                                            onkeyup="buttonUp();" required>
                                        <button type="submit" id="searchbtn">
                                            <span><i class="fa fa-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- header-options -->
                            <div class="ltn__header-options">
                                <ul>
                                    <li>
                                        <!-- mini-cart 2 -->
                                        <div class="mini-cart-icon mini-cart-icon-2 login">
                                            <a href="{{ url('/vendor') }}" class="ltn__utilize-toggle title">
                                                <span class="mini-cart-icon">
                                                    <i class="fa fa-users"></i>
                                                </span> Seller
                                            </a>
                                            @if (empty($normalHeader))
                                                @if (Auth::guard('profile')->guest())
                                                    <a href="{{ url('user/login') }}" class="title">
                                                        <span class="mini-cart-icon"><i class="fa fa-user"></i>Buyer</span></a>
                                                @else
                                                    <a href="{{ route('user.account') }}" class="title">
                                                        <span
                                                            class="open-profile-popup mini-cart-icon"><i class="fa fa-user"></i>&nbsp; Hi, User
                                                            {{-- {{ Auth::guard('profile')->user()->name }} --}}
                                                        </span>
                                                    </a>
                                                @endif
                                            @endif
                                            <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                <span class="mini-cart-icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </span> {{ $language->my_cart }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__header-middle-area end -->
            
            <!-- header-bottom-area start -->
            <div class="header-bottom-area ltn__border-top ltn__header-sticky ltn__primary-bg--- section-bg-1 menu-color-white--- d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col header-menu-column justify-content-center p-0">
                            <div class="sticky-logo">
                                <!--<div class="site-logo">-->
                                <!--    <a href="index.html"><img src="../assets/images/reach-logo.png" alt="Logo"></a>-->
                                <!--</div>-->
                            </div>
                            @if (Auth::guard('profile')->check() || Auth::guard('vendor')->check())
                                <div class="header-menu header-menu-2">
                                    <nav>
                                        <div class="ltn__main-menu">
                                            <ul>
                                                <li><a href="{{ url('/home') }}">{{ $language->home }}</a></li>
                                                @foreach ($menus as $menu)
                                                    <li class="menu-icon"><a href="{{ url('/category') }}/{{ $menu->slug }}">{{ $menu->name }}</a>
                                                        @if (\App\Category::where('mainid', $menu->id)->where('role', 'sub')->count() > 0)
                                                            <ul class="mega-menu">
                                                                @foreach (\App\Category::where('mainid', $menu->id)->where('role', 'sub')->get() as $submenu)
                                                                    <li><a href="{{ url('/category') }}/{{ $submenu->slug }}" class="text-uppercase">{{ $submenu->name }}</a>
                                                                        <ul class="scrollbar" id="style-2">
                                                                            @foreach (\App\Category::where('subid', $submenu->id)->where('role', 'child')->get() as $childmenu)
                                                                                <li><a href="{{ url('/category/new') }}/{{ $childmenu->id }}">{{ $childmenu->name }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            @endif
                            
                            
                            <div class="ltn__header-options sticky-header-icons">
                                <!-- header-search-1 -->
                                {{-- <div class="header-search-wrap">
                                    <div class="header-search-1">
                                        <div class="search-icon">
                                            <i class="fa fa-search for-search-show"></i>
                                            <i class="fa fa-times  for-search-close"></i>
                                        </div>
                                    </div>
                                    <div class="header-search-1-form">
                                        <form id="searchform" method="get"  action="#">
                                            <input type="text" name="search" id="searchdata" value="" placeholder="Search..." onkeyup="buttonUp();" required/>
                                            <button type="submit" id="searchbtn">
                                                <span><i class="fa fa-search text-black"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div> --}}
        
                                <!-- user-menu -->
                                <div class="ltn__drop-menu user-menu">
                                    <ul>
                                        <li>
                                            <!-- mini-cart 2 -->
                                            <div class="mini-cart-icon mini-cart-icon-2">
                                                @if (empty($normalHeader))
                                                    @if (Auth::guard('profile')->guest())
                                                        <a href="{{ url('user/login') }}" class="ltn__utilize-toggle">
                                                            <span class="mini-cart-icon">
                                                                <i class="fa fa-user text-white"></i>
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('user.account') }}" class="ltn__utilize-toggle">
                                                            <span
                                                                class="open-profile-popup text-white"><i class="fa fa-user text-white"></i>
                                                                {{ Auth::guard('profile')->user()->name }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                                <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                    <span class="mini-cart-icon">
                                                        <i class="fa fa-shopping-cart text-white"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- Mobile Menu Button -->
                                <div class="mobile-menu-toggle d-xl-none">
                                    <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                        <svg viewBox="0 0 800 600">
                                            <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                            <path d="M300,320 L540,320" id="middle"></path>
                                            <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-bottom-area end -->
        </header>
        <!-- HEADER AREA END -->

         <!-- Utilize Cart Menu Start -->
        <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <span class="ltn__utilize-menu-title">Cart</span>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <div class="mini-cart-product-area ltn__scrollbar">
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="img/product/1.png" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="fa fa-close"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Red Hot Tomato</a></h6>
                            <span class="mini-cart-quantity">1 x $65.00</span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="img/product/2.png" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="fa fa-close"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Vegetables Juices</a></h6>
                            <span class="mini-cart-quantity">1 x $85.00</span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="img/product/3.png" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="fa fa-close"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Orange Sliced Mix</a></h6>
                            <span class="mini-cart-quantity">1 x $92.00</span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="img/product/4.png" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="fa fa-close"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Orange Fresh Juice</a></h6>
                            <span class="mini-cart-quantity">1 x $68.00</span>
                        </div>
                    </div>
                </div>
                <div class="mini-cart-footer">
                    <div class="mini-cart-sub-total">
                        <h5>Subtotal: <span>$310.00</span></h5>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{{ url('/cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                        <a href="#" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                    </div>
                    <p>Free Shipping on All Orders Over $100!</p>
                </div>

            </div>
        </div>
        <!-- Utilize Cart Menu End -->

        @yield('content')

        {{-- footer --}}
        <!-- starting of footer area -->

        <!-- FOOTER AREA START -->
        <footer class="ltn__footer-area bg-image-top footer-bg-overlay-theme" data-bg="img/bg/footer-bg1.jpg">
            <div class="footer-top-area plr--5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 border-between-column">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">{{ $language->footer_links }}</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="#">{{ $language->home }}</a></li>
                                        <li><a href="#">{{ $language->about_us }}</a></li>
                                        <li><a href="#">{{ $language->faq }}</a></li>
                                        <li><a href="#">{{ $language->contact_us }}</a></li>
                                    </ul>

                                    <div class="ltn__social-media">
                                        <ul>
                                            @if (Auth::guard('profile')->user())
                                                <li>
                                                    <a href="{{ route('do_login_into_ci') }}" target="_blank"
                                                    onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                        <i class="fa fa-area-chart"></i> ERP
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="http://vamayekar.in/" target="_blank" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                    <i class="fa fa-globe"></i> MyWebsite
                                                </a>
                                            </li>
                                            <li>
                                                <a href="http://reachhealth.in/" target="_blank" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">
                                                    <i class="fa fa-eye"></i> EyeHealth
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 border-between-column">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">{{ $language->latest_blogs }}</h4>
                                <div class="footer-menu">
                                    <ul>
                                        @foreach ($lblogs as $lblog)
                                            <li>
                                                <a href="{{ url('/blog') }}/{{ $lblog->id }}">
                                                    <i class="fa fa-angle-right"></i> {{ $lblog->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="footer-newsletter-widget">
                                    <h4 class="footer-title">Be In Touch With Us:</h4>
                                    <div class="footer-newsletter">
                                        <div id="mc_embed_signup">
                                            <form action="https://gmail.us5.list-manage.com/subscribe/post?u=dde0a42ff09e8d43cad40dc82&amp;id=72d274d15d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                <div id="mc_embed_signup_scroll">
                                                    <div class="mc-field-group">
                                                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email*">
                                                    </div>
                                                    <div id="mce-responses" class="clear">
                                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dde0a42ff09e8d43cad40dc82_72d274d15d" tabindex="-1" value=""></div>
                                                    <div class="clear">
                                                        <div class="btn-wrapper">
                                                            <button class="theme-btn-1 btn"  type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"><i class="fa fa-location-arrow"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 border-between-column">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Policy</h4>
                                <div class="footer-menu">
                                    <ul>
                                        @foreach ($policynew as $lblog)
                                            <li>
                                                <a href="{{ url('/policydetails') }}/{{ $lblog->id }}">
                                                    <span>{{ $lblog->titles }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <h4 class="footer-title">Change Languages</h4>
                                <!--<button type="btn" class="language-btn">-->
                                <!--    <a href="#"><i class="fa fa-language red-text"></i> Change Languages</a>-->
                                <!--</button>-->
                                
                                <div id="google_translate_element"></div>

                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                                    }
                                </script>
                                
                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="ltn__copyright-area ltn__copyright-2 plr--5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="ltn__copyright-design clearfix">
                                <p>All Rights Reserved @ Company <span class="current-year"></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="ltn__copyright-menu text-end">
                                <div class="social-buttons">        
                                    <!-- facebook  Button -->
                                    <a href="#" target="blank" class="social-margin"> 
                                    <div class="social-icon facebook">
                                        <i class="fa fa-facebook" aria-hidden="true"></i> 
                                    </div>
                                    </a>
                                    <!-- TwitterButton -->
                                    <a href="#" target="blank" class="social-margin">
                                    <div class="social-icon instagram">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </div> 
                                    </a>
                                    <!-- TwitterButton -->
                                    <a href="#" target="blank" class="social-margin">
                                    <div class="social-icon twitter">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </div> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </footer>
        <!-- FOOTER AREA END -->

        {{-- <div class="cart-box popup">
            <div class="popup-container">
                <div id="emptycart">
                    {{ $language->empty_cart }}
                </div>
                <div id="goCart">

                </div>
                <div class="summary">
                    <div class="grandtotal">{{ $language->total }} <span
                            id="grandttl">{{ $settings[0]->currency_sign }}0.00</span></div>
                </div>
                <div class="cart-buttons">
                    <div class="column">
                        <a href="{{ url('/cart') }}" class="button style-3">{{ $language->view_cart }}</a>
                        <div class="clear"></div>
                    </div>
                    <div class="column">
                        <a href="{{ route('user.checkout') }}"
                            class="button style-4">{{ $language->checkout }}</a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="user_profile popup">
            <div class="popup-container">
                <ul class="user_profile_menu">
                    <li><a href="{{ route('user.account') }}"> <i class="fa fa-tachometer" aria-hidden="true"></i>
                            {!! '&nbsp;' !!}{!! '&nbsp;' !!}account dashboard</a></li>
                    <li><a href="{{ route('user.accinfo') }}"> <i class="fa fa-pencil-square-o"
                                aria-hidden="true"></i> {!! '&nbsp;' !!}{!! '&nbsp;' !!}edit
                            account</a></li>
                    <li><a href="{{ route('user.accpass') }}"> <i class="fa fa-key" aria-hidden="true"></i>
                            {!! '&nbsp;' !!}{!! '&nbsp;' !!}Change Password</a></li>
                    <li><a href="{{ route('user.orders') }}"> <i class="fa fa-first-order" aria-hidden="true"></i>
                            {!! '&nbsp;' !!}{!! '&nbsp;' !!}my orders</a></li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"
                                aria-hidden="true"></i>{!! '&nbsp;' !!}{!! '&nbsp;' !!}Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Product Quick View Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="viewProduct">

                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <script>
        var mainurl = '{{ url('/') }}';
        var currency = '{{ $settings[0]->currency_sign }}';
        var language = {!! json_encode($language) !!};
    </script>

    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.zoom.js') }}"></script>
    <script src="{{ URL::asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/wow.js') }}"></script>
    <script src="{{ URL::asset('assets/js/genius-slider.js') }}"></script>
    <script src="{{ URL::asset('assets/js/global.js') }}"></script>
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins.js') }}"></script>
    <script src="{{ URL::asset('assets/js/notify.js') }}"></script>


    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63bbb31447425128790c62ba/1gmaj736j';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    @yield('footer')

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript">
    </script>

    <!-- Flag click handler -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.translation-links a').click(function() {
                var lang = $(this).data('lang');
                var $frame = $('.goog-te-menu-frame:first');
                if (!$frame.size()) {
                    alert("Error: Could not find Google translate frame.");
                    return false;
                }
                $frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0)
                    .click();
                return false;
            });
        });

        $("#searchbtn").click(function() {
            var search = document.getElementById("searchdata").innerHTML;
            // if($("#searchdata").val() != ""){
            //     var newsearch = search.replace("/","");
            //     window.location = mainurl+"/search/"+newsearch;
            // }else{
            //     window.location = mainurl+"/search/none";
            // }
        });
    </script>
</body>

</html>
