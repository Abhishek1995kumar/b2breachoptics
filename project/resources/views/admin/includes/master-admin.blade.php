<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="GeniusOcean Admin Panel.">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />

    <title>{{$settings[0]->title}} - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-colorpicker.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.css" integrity="sha512-e+TwvhjDvKqpzQLJ7zmtqqz+5jF9uIOa+5s1cishBRfmapg7mqcEzEl44ufb04BXOsEbccjHK9V0IVukORmO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{ URL::asset('assets/css/serverside_loader.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/pre-loader.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('assets/css/genius-admin.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header')

</head>
<body>

<div id="wrapper"><!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: linear-gradient(to top right, white, red);">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!! url('admin/dashboard') !!}">
            <img class="logo" src="{!! url('assets/images/logo') !!}/{{$settings[0]->logo}}" alt="LOGO">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="fa fa-angle-down"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{!! url('admin/adminprofile') !!}"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                <li><a href="{!! url('admin/adminpassword') !!}"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-fw fa-power-off"></i> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <?php
        $all = session()->get('role');
        $manual_orders_list = session()->get('role')['manual_orders'];
        $return_orders_list = session()->get('role')['return_orders'];
        $cancel_orders_list = session()->get('role')['cancelled_orders'];
        $product_list = session()->get('role')['products'];
        $vendor_product_list = session()->get('role')['vendors'];
        $customers_list = session()->get('role')['customers'];
        $manage_category_list = session()->get('role')['manage_category'];
        $blog_list = session()->get('role')['blog'];
        $slider_settings_list = session()->get('role')['slider_settings'];
        $page_settings_list = session()->get('role')['page_settings'];
        $social_settings_list = session()->get('role')['social_settings'];
        $general_settings_list = session()->get('role')['general_settings'];
        $subscribers_list = session()->get('role')['subscribers'];
        $manage_roles_list = session()->get('role')['manage_roles'];
        $payment_overview_list = session()->get('role')['payment_overview'];
        $report_list = session()->get('role')['report'];

        $logedIn = session()->get('role')['loggedin'];

        $manual_orders_explode = explode(',',$manual_orders_list);
        $return_orders_explode = explode(',',$return_orders_list);
        $cancel_orders_explode = explode(',',$cancel_orders_list);
        $product_explode = explode(',',$product_list);
        $vendor_product_explode = explode(',',$vendor_product_list);
        $customers_explode = explode(',',$customers_list);
        $manage_category_explode = explode(',',$manage_category_list);
        $blog_explode = explode(',',$blog_list);
        $slider_settings_explode = explode(',',$slider_settings_list);
        $page_settings_explode = explode(',',$page_settings_list);
        $social_settings_explode = explode(',',$social_settings_list);
        $general_settings_explode = explode(',',$general_settings_list);
        $subscribers_explode = explode(',',$subscribers_list);
        $manage_roles_explode = explode(',',$manage_roles_list);
        $payment_overview_explode = explode(',',$payment_overview_list);
        $report_explode = explode(',',$report_list);

        function clean_array($array1) {
        if( (!is_array($array1)) && ($array1 !== '') ) {
            $array1 = explode(',', $array1);
            $this->clean_array($array1);
            return false;
        }
        
        foreach($array1 as $row => $val) {
            $array[] = ( ($val !== '') ? $val : '' );
        }
        $array = array_filter($array);
        
        return $array;
        }
        
        $manualMaster = clean_array($manual_orders_explode);
        $returnMaster = clean_array($return_orders_explode);
        $cancelMaster = clean_array($cancel_orders_explode);
        $productMatser = clean_array($product_explode);
        $vendorMaster = clean_array($vendor_product_explode);
        $customerMaster = clean_array($customers_explode);
        $categoryMaster = clean_array($manage_category_explode);
        $blogMaster = clean_array($blog_explode);
        $sliderMaster = clean_array($slider_settings_explode);
        $pageMaster = clean_array($page_settings_explode);
        $socialMaster = clean_array($social_settings_explode);
        $generalMaster = clean_array($general_settings_explode);
        $subscriberMaster = clean_array($subscribers_explode);
        $roleMaster = clean_array($manage_roles_explode);
        $paymentMaster = clean_array($payment_overview_explode);
        $reportMaster = clean_array($report_explode);
    ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{!! url('admin/dashboard') !!}"><i class="fa fa-fw fa-home"></i>  Dashboard</a>
            </li>
            <!--<li>-->
            <!--    <a href="{!! url('admin/orders') !!}"><i class="fa fa-fw fa-usd"></i> Orders</a>-->
            <!--</li>-->
            <?php if(!empty($manualMaster)){?>
            <li>
                <a href="{!! url('admin/manualorders') !!}"><i class="fa fa-fw fa-hand-paper-o"></i>Manual Orders</a>
            </li>
            <?php } ?>

            <?php if(!empty($returnMaster)){?>
            <li>
                <a href="{!! url('admin/returnorders') !!}"><i class="fa fa-fast-forward"></i> Return Orders</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($cancelMaster)){?>
            <li>
                <a href="{!! url('admin/cancelorders') !!}"><i class="fa fa-ban"></i> Cancelled Orders</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($productMatser)){?>
            <li>
                <a href="{!! url('admin/products') !!}"><i class="fa fa-fw fa-shopping-cart"></i> Products</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($productMatser)){?>
            <li>
                <a href="{!! url('admin/productsetting') !!}"><i class="fa fa-fw fa-shopping-cart"></i> Product Settings</a>
            </li>
            <?php } ?>

            <!-- <li>
                <a href="{!! url('admin/withdraws') !!}"><i class="fa fa-fw fa-bank"></i> Withdraws</a>
            </li> -->
            
            <?php if(!empty($vendorMaster)){?>
            <li>
                <a href="{!! url('admin/vendors') !!}"><i class="fa fa-fw fa-group"></i> Vendors</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($customerMaster)){?>
            <li>
                <a href="{!! url('admin/customers') !!}"><i class="fa fa-fw fa-user"></i> Customers</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($categoryMaster)){?>
            <li>
                <a href="{!! url('admin/categories') !!}"><i class="fa fa-fw fa-sitemap"></i> Manage Category</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($blogMaster)){?>
            <li>
                <a href="{!! url('admin/blog') !!}"><i class="fa fa-fw fa-file-text"></i> Blog</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($sliderMaster)){?>
            <li>
                <a href="{!! url('admin/sliders') !!}"><i class="fa fa-fw fa-photo"></i> Slider Settings</a>
            </li>
            <?php } ?>
            <!-- <li>
                <a href="{!! url('admin/language-settings') !!}"><i class="fa fa-fw fa-language"></i> Language Settings</a>
            </li> -->
            <!-- <li>
                <a href="{!! url('admin/testimonial') !!}"><i class="fa fa-fw fa-quote-right"></i> Testimonial Section</a>
            </li> -->
            <!-- <li>
                <a href="{!! url('admin/themecolor') !!}"><i class="fa fa-fw fa-paint-brush"></i> Theme Color Settings</a>
            </li> -->
            
            <?php if(!empty($pageMaster)){?>
            <li>
                <a href="{!! url('admin/pagesettings') !!}"><i class="fa fa-fw fa-file-code-o"></i> Page Settings</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($socialMaster)){?>
            <li>
                <a href="{!! url('admin/social') !!}"><i class="fa fa-fw fa-paper-plane"></i> Social Settings</a>
            </li>
            <?php } ?>

            <!-- <li>
                <a href="{!! url('admin/tools') !!}"><i class="fa fa-fw fa-wrench"></i> Seo Tools</a>
            </li> -->
            
            <?php if(!empty($generalMaster)){?>
            <li>
                <a href="{!! url('admin/settings') !!}"><i class="fa fa-fw fa-cogs"></i> General Settings</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($subscriberMaster)){?>
            <li>
                <a href="{!! url('admin/subscribers') !!}"><i class="fa fa-fw fa-group"></i> Subscribers</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($roleMaster)){?>
            <li>
                <a href="{!! url('admin/manageroles') !!}"><i class="fa fa-fw fa-group"></i> Manage Roles</a>
            </li>
            <?php } ?>
            
            <?php if(!empty($paymentMaster)){?>
                <li>
                    <a href="{!! url('admin/Paymentview') !!}"><i class="fa fa-fw fa-group"></i> Payment Overview</a>
                </li>
            <?php } ?>
            
            
            <?php if(!empty($reportMaster)){?>
                <li>
                    <a href="{!! url('admin/report_attr') !!}"><i class="fa fa-fw fa-group"></i> Report</a>
                </li>
            <?php } ?>
            
            <?php if(!empty($reportMaster)){?>
                <li>
                    <a href="{!! url('admin/coupan') !!}"><i class="fa fa-file"></i> Coupon</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

@yield('content')

</div><!-- /#wrapper -->
<!-- /#wrapper -->
<script>
    var baseUrl = '{!! url('/') !!}';
</script>
<!-- jQuery -->
<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.smooth-scroll.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-tagsinput.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-colorpicker.js')}}"></script>
<!-- Switchery -->
<script src="{{ URL::asset('assets/js/bootstrap-toggle.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugin/nicEdit.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/admin-genius.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/Chart.min.js')}}"></script>

<script>
    $("#maincats").change(function () {
        $("#subs").html('<option value="">Select Sub Category</option>');
        $("#subs").attr('disabled',true);
        $("#childs").html('<option value="">Select Sub Category</option>');
        $("#childs").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/subcats/'+mainid, function(response){
            $("#subs").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#subs").append('<option value="'+data.id+'">'+data.name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });
    $("#subs").change(function () {
        $("#childs").html('<option value="">Select Sub Category</option>');
        $("#childs").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/childcats/'+mainid, function(response){
            $("#childs").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#childs").append('<option value="'+data.id+'">'+data.name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });


</script>
@yield('footer')
</body>
</html>

