@extends('admin.includes.master-admin')

@section('content')
    <style>
        .swal2-container.swal2-center > .swal2-popup {
            font-size: 14px;
        }
         #example_processing{
            background: none;
            border: none;
        }
        #loader{
            display: flex;
            justify-content: center;
            background: transparent;
            position: fixed;
            cursor: wait;
            pointer-events: all;
            z-index: 99999999999;
            top: 50%;
            left: 50%;
            border: none;
            width: 120px !important;
            /*display:none;*/
        }
       
    .load{
        cursor: wait !important;
    }

    :root {
	--hue: 223;
	--bg: hsl(var(--hue),90%,95%);
	--fg: hsl(var(--hue),90%,5%);
	--trans-dur: 0.3s;
	font-size: calc(16px + (24 - 16) * (100vw - 320px) / (1280 - 320));
}
/* body {
	background-color: var(--bg);
	color: var(--fg);
	font: 1em/1.5 sans-serif;
	height: 100vh;
	display: grid;
	place-items: center;
	transition: background-color var(--trans-dur);
} */
/* main {
	padding: 1.5em 0;
} */
.ip {
	width: 16em;
	height: 8em;
}
.ip__track {
	stroke: hsl(var(--hue),90%,90%);
	transition: stroke var(--trans-dur);
}
.ip__worm1,
.ip__worm2 {
	animation: worm1 2s linear infinite;
}
.ip__worm2 {
	animation-name: worm2;
}

/* Dark theme */
@media (prefers-color-scheme: dark) {
	:root {
		--bg: hsl(var(--hue),90%,5%);
		--fg: hsl(var(--hue),90%,95%);
	}
	.ip__track {
		stroke: hsl(var(--hue),90%,15%);
	}
}

/* Animation */
@keyframes worm1 {
	from {
		stroke-dashoffset: 0;
	}
	50% {
		animation-timing-function: steps(1);
		stroke-dashoffset: -358;
	}
	50.01% {
		animation-timing-function: linear;
		stroke-dashoffset: 358;
	}
	to {
		stroke-dashoffset: 0;
	}
}
@keyframes worm2 {
	from {
		stroke-dashoffset: 358;
	}
	50% {
		stroke-dashoffset: 0;
	}
	to {
		stroke-dashoffset: -358;
	}
}
    </style>
    
    <!-- loader  Start here -->
	<!--<div id='loader' style=''>-->
	<!--	<svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >-->
	<!--		<defs>-->
	<!--			<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">-->
	<!--				<stop offset="0%" stop-color="#5ebd3e" />-->
	<!--				<stop offset="33%" stop-color="#ffb900" />-->
	<!--				<stop offset="67%" stop-color="#f78200" />-->
	<!--				<stop offset="100%" stop-color="#e23838" />-->
	<!--			</linearGradient>-->
	<!--			<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">-->
	<!--				<stop offset="0%" stop-color="#e23838" />-->
	<!--				<stop offset="33%" stop-color="#973999" />-->
	<!--				<stop offset="67%" stop-color="#009cdf" />-->
	<!--				<stop offset="100%" stop-color="#5ebd3e" />-->
	<!--			</linearGradient>-->
	<!--		</defs>-->
	<!--		<g fill="none" stroke-linecap="round" stroke-width="16">-->
	<!--			<g class="ip__track" stroke="#ddd">-->
	<!--				<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>-->
	<!--				<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>-->
	<!--			</g>-->
	<!--			<g stroke-dasharray="180 656">-->
	<!--				<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>-->
	<!--				<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>-->
	<!--			</g>-->
	<!--		</g>-->
	<!--	</svg>-->
	<!--</div>-->
	<!-- loader End -->
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Product Dashboard</h3>
                    <!--<h3>Product Setting <a href="{{url('admin/products/pending')}}" class="btn btn-info"><strong>Pending Product <label class="label label-primary">{{ \App\Product::where('status','2')->count() }}</label></strong></a></h3> -->
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
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#product_list" data-toggle="tab" aria-expanded="true">Product List</a>
                                <!-- <li class=""><a href="#product_brands" data-toggle="tab" aria-expanded="true">Product Brands</a>
                                <li class=""><a href="#frame_shape" data-toggle="tab" aria-expanded="false">Frame Shape</a>
                                <li class=""><a href="#frame_type" data-toggle="tab" aria-expanded="false">Frame Type</a></li>
                                <li class=""><a href="#frame_material" data-toggle="tab" aria-expanded="false">Frame Material</a></li>
                                <li class=""><a href="#frame_color" data-toggle="tab" aria-expanded="false">Frame Color</a></li>
                                <li class=""><a href="#frame_size" data-toggle="tab" aria-expanded="false">Frame Size</a></li> -->
                                <!--<li class=""><a href="#about" data-toggle="tab" aria-expanded="false">About Us</a>-->
                                </li>
                               
                            </ul>
                        </div>
                        
                        <div class="col-xs-12">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--Starting Product List-->
                                <div class="tab-pane active" id="product_list">
                                <!--<p class="lead">Product List</p>-->
                                <!--<a href="{!! url('admin/products/create') !!}" class="lead btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>-->
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right">
                                            <a href="{!! url('admin/products/create') !!}" style="background-color:#10e9b6" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>
                                        </div>
                                        <p class="lead">Product List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                        <table id="product_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">ID#</th>
                                                    <th>Vendor Name</th>
                                                    <th>Entry By</th>
                                                    <th>Product</th>
                                                    <th>SKU No</th>
                                                    <th>Model No</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
                                                    <th>Stock</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                <!--End Product list-->
                                    </div>
                            
                                    <div class="tab-pane" id="product_brands">
                                        <p class="lead">Product Brands</p>
                                    <!--<div class="ln_solid"></div>-->
                                        <form method="POST" action="products/brands" class="form-horizontal form-label-left">
                                            {{csrf_field()}}
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand"> Add Brand <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Brand" name="brand" required="required">
                                                </div>
                                                <div class="col-md-3">
                                                    <button id="brand_update" type="submit" class="btn btn-success btn-block">Add New Brand</button>
                                                </div>
                                            </div>
                                        </form>
                                    
                                        <p class="lead">Current Brands</p>  
                                        <div class="ln_solid"></div>         
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Brands</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            
                                                </tbody>
                                            </table>
                                   
                                        </div>
                            
                            
                                        <div class="tab-pane" id="frame_shape">
                                            <p class="lead">Frame Shape</p>
                                            <!--<div class="ln_solid"></div>-->
                                    
                                            <form method="POST" action="" class="form-horizontal form-label-left">
                                                {{csrf_field()}}
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape"> Add Shape <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Shape" name="shape" required="required">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button id="frame_shape_update" type="submit" class="btn btn-success btn-block">Add New Shape</button>
                                                    </div>
                                                </div>
                                            </form>
                                    
                                            <p class="lead">Current Shapes</p>  
                                            <div class="ln_solid"></div>         
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Shapes</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        
                                                    </tbody>
                                                </table>
                                            </div>
                            
                                            <div class="tab-pane" id="frame_type">
                                                <p class="lead">Frame Type</p>
                                                <!--<div class="ln_solid"></div>-->
                                                <form method="POST" action="" class="form-horizontal form-label-left">
                                                    {{csrf_field()}}
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand"> Add Type <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Type" name="brand" required="required">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button id="frame_type_update" type="submit" class="btn btn-success btn-block">Add New Type</button>
                                                        </div>
                                                    </div>
                                                </form>
                                    
                                                <p class="lead">Current Types</p>  
                                                <div class="ln_solid"></div>         
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Types</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                   
                                            </div>
                            
                            
                                            <div class="tab-pane" id="frame_material">
                                                <p class="lead">Frame Material</p>
                                                <!--<div class="ln_solid"></div>-->
                                                <form method="POST" action="" class="form-horizontal form-label-left">
                                                    {{csrf_field()}}
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand"> Add Material <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Material" name="brand" required="required">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button id="frame_material_update" type="submit" class="btn btn-success btn-block">Add New Material</button>
                                                        </div>
                                                    </div>
                                                </form>
                                    
                                                <p class="lead">Current Materials</p>  
                                                <div class="ln_solid"></div>         
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Materials</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    
                                                        </tbody>
                                                    </table>
                                                </div>
                            
                                                <div class="tab-pane" id="frame_color">
                                                    <p class="lead">Frame Color</p>
                                                    <!--<div class="ln_solid"></div>-->
                                                    <form method="POST" action="" class="form-horizontal form-label-left">
                                                        {{csrf_field()}}
                                                        <div class="item form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color"> Add Color <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Color" name="color" required="required">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button id="frame_color_update" type="submit" class="btn btn-success btn-block">Add New Color</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <p class="lead">Current Colors</p>  
                                                    <div class="ln_solid"></div>         
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Colors</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                            
                                                    <div class="tab-pane" id="frame_size">
                                                        <p class="lead">Frame Size</p>
                                                        <!--<div class="ln_solid"></div>-->
                                                        <form method="POST" action="" class="form-horizontal form-label-left">
                                                            {{csrf_field()}}
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size"> Add Size <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Size" name="size" required="required">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button id="frame_size_update" type="submit" class="btn btn-success btn-block">Add New Size</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                        <p class="lead">Current Sizes</p>  
                                                        <div class="ln_solid"></div>         
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sizes</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                         <!--End Tab panes -->
                                                    </div>
                                                    <!--End col-xs-12-->
                                                </div>
                                                <!-- End Panel body -->
                                            </div>
                                            <!--End Page Content -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.container-fluid -->
                                </div>
                            <!-- /#page-wrapper -->

@stop

@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteProduct(e){
        var id = $(e.target).attr('data');
        
        var url = "{{url('admin/deleteproduct')}}/"+id;
        var url2 = "{{url('admin/products')}}/";
        if(url){
            Swal.fire({
              title: 'Are You sure for delete?',
              showCancelButton: true,
              confirmButtonText: 'OK',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    deleteProductAjax(id, url);
                } else if (result.isDenied) {
                    window.location = url2;
                }
            })
        }
    }
    
    function deleteProductAjax(id, url){
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
			dataType: 'JSON',
			success:function(resp) {
				if(resp.status == 'success'){
					$('#product_list_table').DataTable().ajax.reload();
				}
			}
        });
    }
</script>

<script>
$(document).ready(function() {
        console.log("hello")
    $('#product_list_table').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "language": {
            "processing": ` <div id='loader' style=''>
                    	        <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                        			<defs>
                        				<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                        					<stop offset="0%" stop-color="#5ebd3e" />
                        					<stop offset="33%" stop-color="#ffb900" />
                        					<stop offset="67%" stop-color="#f78200" />
                        					<stop offset="100%" stop-color="#e23838" />
                        				</linearGradient>
                        				<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                        					<stop offset="0%" stop-color="#e23838" />
                        					<stop offset="33%" stop-color="#973999" />
                        					<stop offset="67%" stop-color="#009cdf" />
                        					<stop offset="100%" stop-color="#5ebd3e" />
                        				</linearGradient>
                        			</defs>
                        			<g fill="none" stroke-linecap="round" stroke-width="16">
                        				<g class="ip__track" stroke="#ddd">
                        					<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        				<g stroke-dasharray="180 656">
                        					<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                        					<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                        				</g>
                        			</g>
                        		</svg>
                        	</div>`
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': "{{url('/admin/products/get_list_details')}}",
            'type' : 'POST',
            "data": {
                "_token": "{{ csrf_token() }}"
            },
        },
        "columnDefs": [
            { "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
        ],
        "aaSorting": []
    });
    
    
});
</script>

<script>
    function activeProduct(id){
        var val = 0;
        var url = "{{url('admin/products/status')}}"+'/'+id+'/'+val;
        // console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(data){
                if(data.status == 'success'){
					$('#product_list_table').DataTable().ajax.reload();
                }
            }
        })
    }
    function deactiveProduct(id){
        var val = 1;
        var url = "{{url('admin/products/status')}}"+'/'+id+'/'+val;
        // console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(data){
                if(data.status == 'success'){
					$('#product_list_table').DataTable().ajax.reload();
                }
            }
        })
    }
</script>


@stop