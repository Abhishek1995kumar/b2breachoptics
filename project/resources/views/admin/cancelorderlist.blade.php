@extends('admin.includes.master-admin')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style type="text/css">
	
	.demo {
  padding: 30px;
  min-height: 280px;
}

.tab-content{
  padding: 10px;
}

@nav-link-hover-bg: #eeeeee;
@nav-tabs-border-color: #dddddd;
@border-radius-base: 5px;
@screen-xs-max: 767px;


//css to add hamburger and create dropdown
.nav-tabs.nav-tabs-dropdown,
.nav-tabs-dropdown {
 @media (max-width: @screen-xs-max) {
      border: 1px solid @nav-tabs-border-color;
      border-radius: @border-radius-base;
      overflow: hidden;
      position: relative;

      &::after {
        content: "☰";
        position: absolute;
        top: 8px;
        right: 15px;
        z-index: 2;
        pointer-events: none;
      }

      &.open {
        a {
          position: relative;
          display: block;
        }

        > li.active > a {
          background-color: @nav-link-hover-bg;
        }
      }


    li {
      display: block;
      padding: 0;
      vertical-align: bottom;
    }

    > li > a {
      position: absolute;
      top: 0;
      left: 0;
      margin: 0;
      width: 100%;
      height: 100%;
      display: inline-block;
      border-color: transparent;

      &:focus,
      &:hover,
      &:active {
        border-color: transparent;
      }
    }

    > li.active > a {
      display:block;
      border-color: transparent;
      position: relative;
      z-index: 1;
      background: #fff;

      &:focus,
      &:hover,
      &:active {
        border-color: transparent;
      }
       
    }
  }
}


</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
             
               
                <!-- Page Heading -->
                <div class="go-title">
                    <h3> Cancel Orders</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12">
						    <div class="demo">
							    <div role="tabpanel">

							    <!-- Nav tabs -->
							    <ul class="nav nav-tabs nav-justified nav-tabs-dropdown" role="tablist">
                                    <?php
                                        if(in_array('RCO', explode(',', session()->get('role')['cancelled_orders']))) {
                                    ?>
							            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">REACH CANCELLED ORDER</a></li>
    							    <?php
                                        }
                                    ?>
                
                                    <?php
                                        if(in_array('VCO', explode(',', session()->get('role')['cancelled_orders']))) {
                                    ?>
    							        <li role="presentation"><a href="#profile" onclick="vendorCancel()" aria-controls="profile" role="tab" data-toggle="tab">VENDOR CANCELLED ORDER</a></li>
							        <?php
                                        }
                                    ?>
							    </ul>

							    <!-- Tab panes -->
							    <div class="tab-content">
    							    <div role="tabpanel" class="tab-pane active" id="home">
    							    	<table class="table-hover dt-responsive table-striped table-bordered" id="reach_cancel_order" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="font-size: 12px">Order Id</th>
                                                    <th class="text-center" style="font-size: 12px">Product</th>
                                                    <th class="text-center" style="font-size: 12px">SKU</th>
                                                    <th class="text-center" style="font-size: 12px">Model No.</th>
                                                    <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                    <th class="text-center" style="font-size: 12px">Cancel Date</th>
                                                    <th class="text-center" style="font-size: 12px">Qty</th>
                                                    <th class="text-center" style="font-size: 12px">CP</th>
                                                    <th class="text-center" style="font-size: 12px">Owner</th>
                                                    <th class="text-center" style="font-size: 12px">View</th>
                                                    <th class="text-center" style="font-size: 12px">Buyer Name</th>
                                                    <th class="text-center" style="font-size: 12px">Entry By</th>
                                                    <th class="text-center" style="font-size: 12px">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             
                                            </tbody>
                                        </table>
    							    </div>
    							    <div role="tabpanel" class="tab-pane" id="profile">
    							    	<table class="table-hover dt-responsive table-striped table-bordered" id="vendoe_cancel_order" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Order Id</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">SKU</th>
                                                    <th class="text-center">Model No.</th>
                                                    <th class="text-center">Date & Time</th>
                                                    <th class="text-center">Cancel Date</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">MRP</th>
                                                    <th class="text-center">Vendor</th>
                                                    <th class="text-center">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
    							    </div>
							    </div>
							 </div>
						</div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>




@stop

<script src="{{ URL::asset('assets/js/admin/cancelorders.js') }}"></script>  

<script type="text/javascript">
	$('.nav-tabs-dropdown').on("click", "li:not('.active') a", function(event) {  
	    $(this).closest('ul').removeClass("open");
    })
    .on("click", "li.active a", function(event) {        
        $(this).closest('ul').toggleClass("open");
    });

</script>

<script type="text/javascript">
    
    $(document).ready(function() {
    $('table.table').DataTable();
} );

</script>


@section('footer')

@stop
