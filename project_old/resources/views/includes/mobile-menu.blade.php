
    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu mobile-utilize-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
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
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="ltn__utilize-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="ltn__utilize-menu">
                <ul>
                    <li><a href="{{ url('/home') }}">{{ $language->home }}</a></li>
                    @foreach ($menus as $menu)
                        <li><a href="{{ url('/category') }}/{{ $menu->slug }}">{{ $menu->name }}</a>
                            @if (\App\Category::where('mainid', $menu->id)->where('role', 'sub')->count() > 0)
                                <ul class="sub-menu">
                                    @foreach (\App\Category::where('mainid', $menu->id)->where('role', 'sub')->get() as $submenu)
                                        <li><a href="{{ url('/category') }}/{{ $submenu->slug }}" class="text-uppercase">{{ $submenu->name }}</a>
                                            <ul class="sub-menu">
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
            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>
                    <li>
                        <a href="#" title="My Account">
                            <span class="utilize-btn-icon">
                                <i class="fa fa-user"></i>
                            </span>
                            Seller
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Shoping Cart">
                            <span class="utilize-btn-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <sup>5</sup>
                            </span>
                            My Cart
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ltn__social-media-2">
                <ul>
                    <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->
    

    <div class="ltn__utilize-overlay"></div>
    

    <div class="mobile-header-menu-fullwidth">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <!-- Mobile Menu Button -->
                    <div class="mobile-menu-toggle d-lg-none">
                        <!-- <span>MENU</span> -->
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