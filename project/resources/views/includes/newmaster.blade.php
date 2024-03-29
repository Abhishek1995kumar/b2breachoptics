<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="{{$code[0]->meta_keys}}">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link style="height : 10px;" rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
    <title>{{$settings[0]->title}}</title>

    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">-->
    <link href="{{ URL::asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-slider.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-slider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/go-style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    
    <!--- Sweet Alert Link --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.css" integrity="sha512-e+TwvhjDvKqpzQLJ7zmtqqz+5jF9uIOa+5s1cishBRfmapg7mqcEzEl44ufb04BXOsEbccjHK9V0IVukORmO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->

    @yield('header')

<style type="text/css">
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }

     .dropdown:hover> .dropdown-menu{
        display: block;
    }
    .dropdown-scrollbar
{
    height: 200px;
    overflow: scroll;

}

.underline-on-hover:hover {
  text-decoration: underline;
  text-decoration-color: rgb(250, 114, 64);
  -moz-text-decoration-color: rgb(250, 114, 64);
  text-decoration-thickness: 5px;

    }

#footerlink
{
    padding-right: 85px;
}

/*media query for mobile responsive*/
    @media screen and (min-width:400px) and (max-width:800px )
    { 

              #top-bar-shubhnew{
                margin: 0;
                z-index: 9999;
                /* background-color: #e90505; */
                background-image: linear-gradient(#595959, white, #842929);
                /* background-image: linear-gradient(
                180deg, red, yellow); */
                height: 37px;
                color: #ffffff;
                font-size: 13px;
                font-weight: 200;
                padding-left: 0%;
                border-bottom: 2px solid #ffedeb;
                border-top: 2px solid #ffedeb;
              }  

    }

@media screen and (max-width: 992px)  {
        #footerlink{
            padding-right: 0px;
        }

    .footer-title {
    text-transform: uppercase;
    font-size: 18px;
    text-align: center;
    margin-bottom: 20px;
        
    }

    .dropdown, .dropup {
        position: relative;
        padding-left: 100px;
    }

    .single-footer-area{
        margin-top: 20px;
    }

}
.footer-content ul.about-footer li {
    display: block;
    padding: 3px 0;
}
.footer-content ul.latest-tweet li {
    display: block;
    position: relative;
    margin-left: 30px;
    padding-bottom: 7px;
}
.footer-content ul.latest-tweet li span {
    margin-left: 0px;
}
/*pranali's code for footer title resposnsive*/

    @media screen and (max-width: 768px)  {
    .footer-title{
        margin-left: -113px;

    }

    .footer-content ul.latest-tweet li {
        display: block;
        position: relative;
        margin-left: 48px;
        padding-bottom: 25px;
    }

    .footer-content ul.about-footer {
    margin: 0;
    padding: 0;
    list-style: none;
    margin-left: 50px;
}

    .dropdown, .dropup {
    position: relative;
    padding-left: 0px;
    
    }
}

.section::-webkit-scrollbar {
  width: 5px;
}

.section::-webkit-scrollbar-track {
  background-color: #e4e4e4;
  border-radius: 100px;
}

.section::-webkit-scrollbar-thumb {
  box-shadow: inset 0 0 6px white;
}

.section {
  scrollbar-width: thin;
}

.section {
  scrollbar-color: white;
  scrollbar-width: thin;
}

.section::-webkit-scrollbar-thumb {
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
/*end pranali's code for footer title responsive*/

/* End Of media query for mobile responsive*/

</style>
</head>
<body>
<div id="cover"></div>



<div id="top-bar-shubh">
    <div class="row" style="margin : 0; display:flex; position:relative;">
        <div class="col-md-4" >
            @if(Auth::guard('profile')->check() || Auth::guard('vendor')->check())
                <a href="{{url('/home')}}" id="logo">
                    <img alt="" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}">
                </a>
            @else
                <a href="{{url('/homepage')}}" id="logo">
                    <img alt="" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}">
                </a>
            @endif
        </div>
        <div class="col-md-1 position-relative"></div>
        <div class="col-md-3 position-relative" >
<!--  <form>-->
<!--  <input type="text" name="search" placeholder="Search..">-->
<!--</form>-->
            <form class="searchbox" id="searchform">
                    <input type="search" id="searchdata" placeholder="Search..." name="search" class="searchbox-input" onkeyup="buttonUp();" required>
                    <input type="submit" id="searchbtn" class="searchbox-submit" value=""/>
                    <span class="searchbox-icon"><i class="fa fa-search"></i></span>
            </form>

        </div>
        <diV class="col-md-4 padding-left-0" id="top-bar-list-shubh">
            <div class="header-top-entry increase-icon-responsive login">              

               
            <!-- </div> -->

               <!--<a href="" class="title"><i class="fa fa-search"></i> <span>{{$language->search}}</span></a>          -->
            </div>
           <!--   <div class="col-md-1 padding-right-0" style="margin-top:10px;color: white">
                   <a href="{{url('/track')}}" class="title"><i class="fa fa-fw fas fa-map-marker"></i> </a>
             </div> -->
            <div class="header-top-entry increase-icon-responsive login">
                @if(Auth::guard('vendor')->user())
                    <a href="{{url('/vendor/dashboard')}}" class="title "><i class="fa fa-group"></i> <span>{{Auth::guard('vendor')->user()->name}}</span></a>
                @else
                    <a href="{{url('/vendor')}}" class="title "><i class="fa fa-group"></i> <span>Seller</span></a>
                @endif
            </div>

            @if(empty($normalHeader))
                <div class="header-top-entry increase-icon-responsive login">
                @if(Auth::guard('profile')->guest())
                    <a href="{{url('user/login')}}" class="title"><i class="fa fa-user"></i> <span>Buyer</span></a>
                @else
                    <a href="{{route('user.account')}}" class="title"><i class="fa fa-user"></i> <span class="open-profile-popup">Hello , {{Auth::guard('profile')->user()->name}}</span></a>
                @endif
                </div>
            @endif

            <a href="{{url('/cart')}}" class="header-top-entry" id="notify"><div class="title"><i class="fa fa-shopping-cart"></i><span class="open-cart-popup">{{$language->my_cart}}</span></div></a>
            <!-- @if(empty($normalHeader))
            @if(Auth::guard('profile')->user())
                <a class="header-top-entry increase-icon-responsive login" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        {!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}  {!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}  <i class="fa fa-fw fa-power-off"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
           @endif
           @endif -->

    </div>
</div>
</div>
<!-- new added topbar -->
    <div id="top-bar-shubhnew"  >

            @if(Auth::guard('profile')->user())
            <div class="header-top-entry">
                <a href="{{route('do_login_into_ci')}}" style="margin-left: 89px;  color: red;" target="_blank" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='red'" class="title underline-on-hover"><i class="fa fa-area-chart"></i> <span><b>ERP</b></span></a>
            </div>
            @endif

            <div class="header-top-entry ">
                <a href="http://vamayekar.com/" class="title underline-on-hover" target="_blank" style="color: red;" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='red'" ><i class="fa fa-globe"></i> <span><b>MyWebSite</b></span></a>
            </div>
 
            <div class="header-top-entry ">
                <a href="http://reachhealth.in/" class="title underline-on-hover" target="_blank" style="color: red;" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='red'"><i class="fa fa-eye"></i> <span><b>EyeHealth</b></span></a>
            </div> 

            <div class="header-top-entry" style="margin-top: -5px;width: 24px;float: left;float: right;">
               <a href=https://api.whatsapp.com/send?phone=+918091213809> 
                    <!--<img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png "style=" margin-left: -150px" ;/>-->
                    <!--<p style="color: black; margin-top: 4px;float: right;padding-right: 52px";> +918091213809</p>-->
              </a>               
            </div>  

    </div>
    <!-- new added topbar end -->

    <div class="header-product">
    <!--                <div class="logo-wrapper">-->
    <!--                    <a href="{{url('/')}}" id="logo">-->
    <!--                        <img alt="" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}">-->
    <!--                    </a>-->
    <!--                </div>-->

    <!--                <div class="product-header-content">-->
    <!--                    <div class="line-entry">-->
    <!--                        <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>-->

    <!--                    </div>-->
    <!--                    {{--<div class="middle-line"></div>--}}-->
    <!--                    <div class="line-entry">-->
    <!--                        <div class="header-top-entry increase-icon-responsive">-->
    <!--                            <div class="">-->
                             <!--   <div class="container" id="searchContainer">-->
                            	<!--	<table class="elementsContainer">-->
                            	<!--	<tr>-->
                            	<!--	    <form id="searchform">-->
                            	<!--		<td>-->
                            	<!--			<input id="searchdata" type="text" placeholder="{{$language->search}}" class="search" name="">-->
                            	<!--		</td>-->
                            	<!--		<td>-->
                            	<!--			<a href="#"><i id="searchbtn" class="fa fa-search"></i></a>-->
                            	<!--		</td>-->
                            	<!--		</form>-->
                            	<!--	</tr>-->
                            	<!--	</table>-->
                            	<!--</div>-->
                            	<!--</div>-->
                            	
                            	
    <!--                        	<div class="search-box popup">-->
    <!--                                <form id="searchform">-->
    <!--                                    <button type="button" id="searchbtn" class="search-button">-->
    <!--                                        <i class="fa fa-search"></i>-->
                        
    <!--                                    </button>-->
                        
    <!--                                    <div class="search-field">-->
    <!--                                        <input type="text" id="searchdata" value="" placeholder="{{$language->search}}" />-->
    <!--                                    </div>-->
    <!--                                </form>-->
    <!--                            </div>-->
                                
    <!--                            <div class="title"><i class="fa fa-search"></i> <span>{{$language->search}}</span></div>-->
    <!--                        </div>-->
    <!--                        <div class="header-top-entry increase-icon-responsive login">-->
    <!--                            <a href="{{url('/vendor')}}" class="title"><i class="fa fa-group"></i> <span>{{$language->vendor}}</span></a>-->
    <!--                        </div>-->
    <!--                        <div class="header-top-entry increase-icon-responsive login">-->
    <!--                            @if(Auth::guard('profile')->guest())-->
    <!--                                <a href="{{url('user/login')}}" class="title"><i class="fa fa-user"></i> <span>{{$language->sign_in}}</span></a>-->
    <!--                            @else-->
    <!--                                <a href="{{route('user.account')}}" class="title"><i class="fa fa-user"></i> <span>Hi,{{$language->my_account}}</span></a>-->
    <!--                            @endif-->
    <!--                        </div>-->
    <!--                        <a href="{{url('/cart')}}" class="header-top-entry open-cart-popup" id="notify"><div class="title"><i class="fa fa-shopping-cart"></i><span>{{$language->my_cart}}</span> <b id="carttotal">{{$settings[0]->currency_sign}}0.00</b></div></a>-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
</div>

<div id="navcontainer">
    <div class="content-center fixed-header-margin" style="padding-top: 0px;">
        <!-- HEADER -->
        <div class="header-wrapper style-10">
            @if(Auth::guard('profile')->check() || Auth::guard('vendor')->check())
            <header class="type-1">

                <!--<div class="header-product">-->
                <!--    <div class="logo-wrapper">-->
                <!--        <a href="{{url('/')}}" id="logo">-->
                <!--            <img alt="" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}">-->
                <!--        </a>-->
                <!--    </div>-->
                <!-- adding responsive menu -->
                <div class="product-header-content">
                     <div class="line-entry">
                         <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                      </div>
                  </div>
                  <!-- end adding responsive menu -->
                <!--        {{--<div class="middle-line"></div>--}}-->
                <!--        <div class="line-entry">-->
                <!--            <div class="header-top-entry increase-icon-responsive">-->
                <!--                <div class="">-->
                <!--                <div class="container" id="searchContainer">-->
                <!--            		<table class="elementsContainer">-->
                <!--            		<tr>-->
                <!--            		    <form id="searchform">-->
                <!--            			<td>-->
                <!--            				<input id="searchdata" type="text" placeholder="{{$language->search}}" class="search" name="">-->
                <!--            			</td>-->
                <!--            			<td>-->
                <!--            				<a href="#"><i id="searchbtn" class="fa fa-search"></i></a>-->
                <!--            			</td>-->
                <!--            			</form>-->
                <!--            		</tr>-->
                <!--            		</table>-->
                <!--            	</div>-->
                <!--            	</div>-->
                            	
                            	
                            	<!--<div class="search-box popup">-->
                             <!--       <form id="searchform">-->
                             <!--           <button type="button" id="searchbtn" class="search-button">-->
                             <!--               <i class="fa fa-search"></i>-->
                        
                             <!--           </button>-->
                        
                             <!--           <div class="search-field">-->
                             <!--               <input type="text" id="searchdata" value="" placeholder="{{$language->search}}" />-->
                             <!--           </div>-->
                             <!--       </form>-->
                             <!--   </div>-->
                                
                                <!--<div class="title"><i class="fa fa-search"></i> <span>{{$language->search}}</span></div>-->
                <!--            </div>-->
                <!--            <div class="header-top-entry increase-icon-responsive login">-->
                <!--                <a href="{{url('/vendor')}}" class="title"><i class="fa fa-group"></i> <span>{{$language->vendor}}</span></a>-->
                <!--            </div>-->
                <!--            <div class="header-top-entry increase-icon-responsive login">-->
                <!--                @if(Auth::guard('profile')->guest())-->
                <!--                    <a href="{{url('user/login')}}" class="title"><i class="fa fa-user"></i> <span>{{$language->sign_in}}</span></a>-->
                <!--                @else-->
                <!--                    <a href="{{route('user.account')}}" class="title"><i class="fa fa-user"></i> <span>Hi,{{$language->my_account}}</span></a>-->
                <!--                @endif-->
                <!--            </div>-->
                <!--            <a href="{{url('/cart')}}" class="header-top-entry open-cart-popup" id="notify"><div class="title"><i class="fa fa-shopping-cart"></i><span>{{$language->my_cart}}</span> <b id="carttotal">{{$settings[0]->currency_sign}}0.00</b></div></a>-->

                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="close-header-layer"></div>
                <div class="navigation">
                    <div class="navigation-header responsive-menu-toggle-class">
                        <div class="title">Navigation</div>
                        <div class="close-menu"></div>
                    </div>
                    <div class="nav-overflow">
                        <nav>
                            <ul>
                                <li class="simple-list"><a href="{{url('/home')}}" class="">{{$language->home}}</a></li>
                         

                                @foreach($menus as $menu)
                                    <li class="full-width-columns ">
                                        <a href="{{url('/category')}}/{{$menu->slug}}">{{$menu->name}}</a>
                                
                                        @if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count() >0)
                                            
                                            <div class="submenu">
                                                @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get() as $submenu)
                                                    <div class="product-column-entry">
                                                        <div class="submenu-list-title"><a href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a><span class="toggle-list-button"></span></div>
                                                        <div class="description toggle-list-container section" style="overflow-y:scroll; max-height:15rem;" >
                                                            <ul class="list-type-1">
                                                                @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get() as $childmenu)
                                                                    <div class="overflow-auto h-50 d-inline-block section">
                                                                        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example">
                                                                            <li><a href="{{url('/category/new')}}/{{$childmenu->id}}">{{$childmenu->name}}</a></li>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="hot-mark yellow">sale</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                @endforeach

                                <!--@if($pagesettings[0]->a_status == 1)-->
                                <!--    <li class="simple-list"><a href="{{url('/about')}}" class="">{{$language->about_us}}</a></li>-->
                                <!--@endif-->
                                <!--@if($pagesettings[0]->f_status == 1)-->
                                <!--    <li class="simple-list"><a href="{{url('/faq')}}" class="">{{$language->faq}}</a></li>-->
                                <!--@endif-->
                                <!--@if($pagesettings[0]->blogs_status == 1)-->
                                <!--    <li class="simple-list"><a href="{{url('/blogs')}}" class="">{{$language->blog}}</a></li>-->
                                <!--@endif-->
                                <!--@if($pagesettings[0]->c_status == 1)-->
                                <!--    <li class="simple-list"><a href="{{url('/contact')}}" class="">{{$language->contact_us}}</a></li>-->
                                <!--@endif-->
                                 
                                <li id="shopping_header_shubh1" class="fixed-header-visible">
                                  <a id="shopping_header_shubh" class="fixed-header-square-button" href="{{url('user/login')}}"><i class="fa fa-user"></i></a>
                                   <a href="{{url('/cart')}}" id="shopping_header_shubh" class="fixed-header-square-button"><i class="fa fa-shopping-cart"></i></a>
                                    <a id="shopping_header_shubh" class="fixed-header-square-button open-search-popup"><i class="fa fa-search"></i></a>
                                </li>
                                
                            </ul>

                            <div class="clear"></div>

                        </nav>
                        <div class="navigation-footer responsive-menu-toggle-class">

                        </div>
                    </div>
                </div>
            </header>
            @endif
            <div class="clear"></div>
        </div>
    </div>

    @yield('content')

        <!-- starting of footer area -->
        <footer class="section-padding footer-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                {{$language->about_us}}
                            </div>
                            <div class="footer-content">
                                <p>
                                    {!! $settings[0]->about !!}
                                </p>
                                {!! $settings[0]->footer !!}

                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                {{$language->footer_links}}
                            </div>
                            <div class="footer-content">
                                <ul class="about-footer">
                                    <li><a href="{{url('/home')}}"><i class="fa fa-caret-right"></i> {{$language->home}}</a></li>
                                    <li><a href="{{url('/about')}}"><i class="fa fa-caret-right"></i> {{$language->about_us}}</a></li>
                                    <li><a href="{{url('/faq')}}"><i class="fa fa-caret-right"></i> {{$language->faq}}</a></li>
                                    <li><a href="{{url('/contact')}}"><i class="fa fa-caret-right"></i> {{$language->contact_us}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="single-footer-area" >
                            <div class="footer-title" style="padding-left: 31px;">
                                {{$language->latest_blogs}}
                            </div>
                            <div class="footer-content">
                                <ul class="latest-tweet">
                                    @foreach($lblogs as $lblog)
                                    <li>
                                        <a href="{{url('/blog')}}/{{$lblog->id}}">

                                           <!--  <video width="10" height="10" controls>
                                              <source src="{{url('/assets/images/blog')}}/{{$lblog->featured_image}}" type="video/mp4">
                                            </video> -->
                                            <span>{{$lblog->title}}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- pranali's code for policy-->

                        <div class="col-lg-3 col-md-3 col-sm-7 col-xs-12">
                            <div class="single-footer-area">
                                <div class="footer-title"style="padding-right: 130px;padding-left: 29px;">
                                    <h5 >Policy</h5>
                                </div>
                                <div class="footer-content">
                                    <ul class="latest-tweet">
                                        @foreach($policynew as $lblog)
                                        <li>
                                            <a href="{{url('/policydetails')}}/{{$lblog->id}}">
                                                <span>{{$lblog->titles}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <!-- end pranali's code for policy -->

                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                Change Languages
                            </div>
                       
                          <!--   <div class="footer-content tags">
                                @foreach(explode(',',$settings[0]->popular_tags) as $tag)
                                    <a href="{{url('/tags')}}/{{$tag}}">{{$tag}}</a>
                                @endforeach
                            </div>
 -->                        
                        <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Language Translator</title>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                <!--Include Google Translate API library-->
                                <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </head>
                            <body>
                                <!-- Google Translate element -->
                                <div id="google_translate_element"></div>
                            
                                <script>
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                    }
                            
                                    // Handle language selection and trigger translation
                                    $(document).ready(function() {
                                        $('.translation-links a').click(function() {
                                            var selectedLang = $(this).data('lang');
                                            googleTranslateElementInit(); // Initialize Google Translate
                                            // Translate the entire page to the selected language
                                            google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: selectedLang, layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                        });
                                    });
                                </script>
                            </body>
                        </html>

                     <!-- <div class="footer-social-links">
                        <ul id="footerlink">
                            @if($sociallinks[0]->f_status == "enable")
                            <li>
                                <a class="facebook" href="{{$sociallinks[0]->facebook}}">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->g_status == "enable")
                            <li>
                                <a class="google" href="">
                                    <i class="fa fa-google"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->t_status == "enable")
                            <li>
                                <a class="twitter" href="{{$sociallinks[0]->twiter}}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->link_status == "enable")
                            <li>
                                <a class="tumblr" href="{{$sociallinks[0]->linkedin}}">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div> -->
                                
                            
                            <!--<div class="product-subscribe-form-content-shubh">
                            <!--    <div class="footer-title padding-top-10">-->
                            <!--        {{$language->subscription}}-->
                            <!--    </div>-->
                            <!--    <div class="padding-right-0">-->
                            <!--        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, magni, ad. Molestiae, error similique voluptates nam dignissimos, alias fugit assumenda.</p>--}}-->
                            <!--        <p id="resp"></p>-->
                            <!--        <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">-->
                            <!--            {{csrf_field()}}-->
                            <!--            <input type="email" id="email" placeholder="Enter Email" name="email" required>-->
                            <!--            <input id="subs"  type="button" class="btn subscribe-btn" value="{{$language->subscribe}}">-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div> 
                    </div>
                </div>
            </div>

            <!-- <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 footer-copy"> -->
                        <!-- {!! $settings[0]->footer !!} -->
                    <!-- </div> -->
                    
                  <!--   <div class="col-md-4 col-sm-4"> -->
                        <!--<div class="product-subscribe-form-content">-->
                        <!--    <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">-->
                        <!--        {{csrf_field()}}-->
                        <!--        <input type="email" id="email" placeholder="Enter Email" name="email" required>-->
                        <!--        <input id="subs"  type="button" class="btn subscribe-btn" value="{{$language->subscribe}}">-->
                        <!--    </form>-->
                        <!--</div>-->
                        
                        <!--<div class="product-subscribe-form-content-shubh">-->
                        <!--    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, magni, ad. Molestiae, error similique voluptates nam dignissimos, alias fugit assumenda.</p>--}}-->
                        <!--    <p id="resp"></p>-->
                        <!--    <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">-->
                        <!--        {{csrf_field()}}-->
                        <!--        <input type="email" id="email" placeholder="Enter Email" name="email" required>-->
                        <!--        <input id="subs"  type="button" class="btn subscribe-btn" value="{{$language->subscribe}}">-->
                        <!--    </form>-->
                        <!--</div>-->
                <!--     </div>
                <div class="col-md-4 col-sm-4"> -->
                    <!-- <div class="footer-social-links">
                        <ul style="padding-right: 85px;">
                            @if($sociallinks[0]->f_status == "enable")
                            <li>
                                <a class="facebook" href="{{$sociallinks[0]->facebook}}">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->g_status == "enable")
                            <li>
                                <a class="google" href="">
                                    <i class="fa fa-google"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->t_status == "enable")
                            <li>
                                <a class="twitter" href="{{$sociallinks[0]->twiter}}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            @endif
                            @if($sociallinks[0]->link_status == "enable")
                            <li>
                                <a class="tumblr" href="{{$sociallinks[0]->linkedin}}">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div> -->
              <!--   </div>
                </div>
            </div>
        </footer> -->
        <!-- Ending of footer area -->


        <div class="cart-box popup">
            <div class="popup-container">
                <div id="emptycart">
                    {{$language->empty_cart}}
                </div>
                <div id="goCart">

                </div>
                <div class="summary">
                    <div class="grandtotal">{{$language->total}} <span id="grandttl">{{$settings[0]->currency_sign}}0.00</span></div>
                </div>
                <div class="cart-buttons">
                    <div class="column">
                        <a href="{{url('/cart')}}" class="button style-3">{{$language->view_cart}}</a>
                        <div class="clear"></div>
                    </div>
                    <div class="column">
                        <a href="{{route('user.checkout')}}" class="button style-4">{{$language->checkout}}</a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        
        <div class="user_profile popup">
            <div class="popup-container">
                <ul class="user_profile_menu">
                    <li><a href="{{route('user.account')}}"> <i class="fa fa-tachometer" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}account dashboard</a></li>
                    <li><a href="{{route('user.accinfo')}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}edit account</a></li>
                    <li><a href="{{route('user.accpass')}}"> <i class="fa fa-key" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}Change Password</a></li>
                    <li><a href="{{route('user.orders')}}"> <i class="fa fa-first-order" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}my orders</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>{!! "&nbsp;" !!}{!! "&nbsp;" !!}Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form></li>
                </ul>
            </div>
        </div>


        <!--<div class="search-box popup">-->
        <!--    <form id="searchform">-->
        <!--        <button type="button" id="searchbtn" class="search-button">-->
        <!--            <i class="fa fa-search"></i>-->

        <!--        </button>-->

        <!--        <div class="search-field">-->
        <!--            <input type="text" id="searchdata" value="" placeholder="{{$language->search}}" />-->
        <!--        </div>-->
        <!--    </form>-->
        <!--</div>-->

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
        </div>
</div>

<script>
    var mainurl = '{{url("/")}}';
    var currency = '{{$settings[0]->currency_sign}}';
    var language = {!! json_encode($language) !!};
</script>


<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.zoom.js')}}"></script>
<script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/wow.js')}}"></script>
<script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>
<script src="{{ URL::asset('assets/js/global.js')}}"></script>
<script src="{{ URL::asset('assets/js/main.js')}}"></script>
<script src="{{ URL::asset('assets/js/plugins.js')}}"></script>
<script src="{{ URL::asset('assets/js/notify.js')}}"></script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/63bbb31447425128790c62ba/1gmaj736j';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>


@yield('footer')


<!-- Flag click handler -->
<script type="text/javascript">
    
    $("#searchbtn").click(function (){
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