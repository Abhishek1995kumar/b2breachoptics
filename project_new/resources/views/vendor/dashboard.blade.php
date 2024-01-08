
@extends($demo->status == '2' ? 'vendor.includes.master-vendor' : 'vendor.includes.master-vendor1');


@if($demo->status == '2')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Vendor Dashboard! </h3>

<div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{$settings[0]->currency_sign}}{{round(Auth::user()->current_balance,2)}}</div>
                            <p class="titles">Current Balance!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check-square fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','completed')->sum('quantity')}}</div>
                            <p class="titles">Total Item Sold!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x" style="color : #337ab7;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="text-total">{{$settings[0]->currency_sign}}{{round(\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('paid','yes')->where('status','completed')->sum('cost'),2)}}</div>
                        <p class="titles">Total Earnings!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <h3>Shop Statistics! </h3>

        <div class="row" id="main" >
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\Product::where('vendorid',Auth::user()->id)->where('status',1)->count() }}</div>
                                <p class="titles">Total Products!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('vendor/products')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','pending')->count() }}</div>
                                <p class="titles">Orders Pending!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('vendor/orders')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','processing')->count() }}</div>
                                <p class="titles">Orders Processing!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('vendor/orders')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check-circle fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','completed')->count() }}</div>
                                <p class="titles">Orders Completed!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('vendor/orders')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')

@stop


@elseif($demo->status == '3')

    @section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Vendor Dashboard! </h3>

        <div class="alert alert-danger">
          <strong> For Accessing DashBoard First You Should Fill The Correct Bank Details And Business Details </strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="alert alert-success">
          <strong>For Updating Bank & Business Details!</strong> You should <a href="{{url('vendor/vendorprofile')}}" class="alert-link">Click Here</a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

<div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{$settings[0]->currency_sign}}{{round(Auth::user()->current_balance,2)}}</div>
                            <p class="titles">Current Balance!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check-square fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','completed')->sum('quantity')}}</div>
                            <p class="titles">Total Item Sold!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x" style="color : #337ab7;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="text-total">{{$settings[0]->currency_sign}}{{round(\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('paid','yes')->where('status','completed')->sum('cost'),2)}}</div>
                        <p class="titles">Total Earnings!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <h3>Shop Statistics! </h3>

        <div class="row" id="main" >
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\Product::where('vendorid',Auth::user()->id)->where('status',1)->count() }}</div>
                                <p class="titles">Total Products!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','pending')->count() }}</div>
                                <p class="titles">Orders Pending!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','processing')->count() }}</div>
                                <p class="titles">Orders Processing!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check-circle fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','completed')->count() }}</div>
                                <p class="titles">Orders Completed!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')

@stop


@else

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Vendor Dashboard! </h3>
        @if(Auth::user()->note != "")
            <div class="alert alert-danger">
              <strong> Please Check Mail For Reason of Document Rejection </strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @if(Auth::user()->status == 1)
                <div class="alert alert-success">
                  <strong>Fill Bank & Business Details!</strong> You should <a href="{{url('vendor/vendorprofile')}}" class="alert-link">Click Here</a>.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @elseif(Auth::user()->status == 5)
                <div class="alert alert-success">
                  <strong>Update Bank & Business Details!</strong> You should <a href="{{url('vendor/vendorprofile')}}" class="alert-link">Click Here</a>.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @else
            @endif
        @else
            <div class="alert alert-danger">
              <strong> For Accessing DashBoard First You Should Fill The Bank Details And Business Details </strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
    
            <div class="alert alert-success">
              <strong>Fill Bank & Business Details!</strong> You should <a href="{{url('vendor/vendorprofile')}}" class="alert-link">Click Here</a>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif

<div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{$settings[0]->currency_sign}}{{round(Auth::user()->current_balance,2)}}</div>
                            <p class="titles">Current Balance!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check-square fa-5x" style="color : #337ab7;"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('status','completed')->sum('quantity')}}</div>
                            <p class="titles">Total Item Sold!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default" style="border-radius: 4px;margin: 0 20px 0 0">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x" style="color : #337ab7;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="text-total">{{$settings[0]->currency_sign}}{{round(\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('paid','yes')->where('status','completed')->sum('cost'),2)}}</div>
                        <p class="titles">Total Earnings!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <h3>Shop Statistics! </h3>

        <div class="row" id="main" >
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\Product::where('vendorid',Auth::user()->id)->where('status',1)->count() }}</div>
                                <p class="titles">Total Products!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','pending')->count() }}</div>
                                <p class="titles">Orders Pending!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','processing')->count() }}</div>
                                <p class="titles">Orders Processing!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check-circle fa-5x" style="color : #337ab7;"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{\App\OrderedProducts::where('vendorid',Auth::user()->id)->where('payment','Completed')->where('status','completed')->count() }}</div>
                                <p class="titles">Orders Completed!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" ><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')

@stop


@endif





