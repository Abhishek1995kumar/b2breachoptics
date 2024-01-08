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


</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
             
               
                <!-- Page Heading -->
                <div class="go-title">
                    <h3> Return Orders</h3>
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
                        </div>

                        <div class="col-md-12">
							<div class="demo">
                                <?php
                                    if(in_array('RRO', explode(',', session()->get('role')['return_orders']))) {
                                ?>
							  	
							  	<div class="col-md-6" >
							  		<div class="text-right">
							  			<a href="{{url('admin/return/order/adminlist')}}" class="btn btn-danger" > REACH RETURN ORDERS</a>
							  		</div>
							  	</div>
                                <?php
                                    }
                                ?>

                                <?php
                                    if(in_array('VRO', explode(',', session()->get('role')['return_orders']))) {
                                ?>

							  	<div class="col-md-6">
							  		<div class="text-left">
							  			<a href="{{url('admin/return/order/vendorlist')}}" class="btn btn-danger text-left">VENDOR RETRUN ORDER</a>
							  		</div>
							  	</div>
                                <?php
                                    }
                                ?>
							 
							</div>
                        </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>




@stop

<script type="text/javascript">
	$('.nav-tabs-dropdown')
    .on("click", "li:not('.active') a", function(event) {  $(this).closest('ul').removeClass("open");
    })
    .on("click", "li.active a", function(event) {        $(this).closest('ul').toggleClass("open");
    });

</script>

<script type="text/javascript">
    
    $(document).ready(function() {
    $('table.table').DataTable();
} );

</script>	

@section('footer')
@stop
