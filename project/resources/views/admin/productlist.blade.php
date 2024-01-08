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
                                <li class="active"><a href="#product_list" data-toggle="tab" aria-expanded="true">Admin Product List</a></li>
                                <li class=""><a href="#vendor_product" onclick="vendorProduct(event)" data-toggle="tab" aria-expanded="false">Vendor Product List</a></li>
                                <li class=""><a href="#vendor_pending" onclick="getVendorPendingProduct()" data-toggle="tab" aria-expanded="true">Vendor Pending Product List</a></li>
                            </ul>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div class="tab-pane active" id="product_list">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right">
                                            <a href="{!! url('admin/products/create') !!}" style="background-color:#10e9b6" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>
                                        </div>
                                        <p class="lead">Product List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-6">
                                            <select class="form-control" id="category">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    @if(in_array($category->id, $pro_category_per))
                                                        <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-right" id="exportButtonDiv" style="display: none">
                                            <a id="exportButton" onclick="exportExcel()" href="javascript:;"
                                                class="btn btn-primary btn-excel"><i class="fa fa-download"></i> &nbsp; Excel
                                            </a>
                                        </div>
                                    </div>
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
                                </div>
                        
                                <div class="tab-pane" id="vendor_product">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right">
                                            <a href="{!! url('admin/products/getVendorProduct') !!}" style="background-color:#10e9b6" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>
                                        </div>
                                        <p class="lead">Vendor Product</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-3">
                                            <select class="form-control" id="vendor_category">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{!! $category->id !!}">{!! $category->name !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" id="vendor_name">
                                                <option value="">Select Vendor</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{!! $vendor->id !!}">{!! $vendor->shop_name !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" id="vendor_searchButton"
                                                class="btn btn-primary btn-search">Search</button>
                                        </div>
                                        <div class="col-md-3 text-right" id="vendorproductexport-button">
                                            <button type="button" class="btn btn-success full-excel" onclick="vendorproductAllExcel(event)"><i class="fa fa-download"></i></button>
                                        </div>
                                    </div>
                                    <table id="vendor_product_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr id="vendor-product-header">
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
                                </div>
                        
                                <div class="tab-pane" id="vendor_pending">
                                    <p class="lead">Vendor Pending Product</p>
                                    <div class="ln_solid"></div>
                                    <table id="vendor_pending_product_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID#</th>
                                                <th>Owner</th>
                                                <th>Vendor Name</th>
                                                <th>Product</th>
                                                <th>SKU No</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="get" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rejection Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Rejection Note:-   </label>
                            <textarea name="note" class="form-control" rows="3" cols="50"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="vendorproductupdate"></div>
    
    <div class="ecxel_export_div" style="display: none;">
        @include('admin.includes.productreportexcelheader')
    </div>

@stop

@section('footer')

<script src="{{ URL::asset('assets/js/admin/product.js') }}"></script>
<script src="{{ URL::asset('assets/js/admin/updateproduct.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteProduct(e){
        var id = $(e.target).attr('data');
        
        var url = "{{url('admin/deleteproduct')}}/"+id;
        var url2 = "{{url('admin/products')}}/";
        if(url){
            Swal.fire({
                title: 'Message!',
                text: `Are You sure for delete?`,
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                confirmButtonText: 'OK',
              showCancelButton: true,
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
    
    function activeProduct(id){
        var val = 0;
        var url = "{{url('admin/products/status')}}"+'/'+id+'/'+val;
        $.ajax({
            method: 'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(data){
                if(data.status == 'success'){
                    Swal.fire({
                        title: 'Message!',
                        text: `Product Deactive Successfully ..!!`,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(true);
                        }
                    });
                }
            }
        })
    }
    
    function deactiveProduct(id){
        var val = 1;
        var url = "{{url('admin/products/status')}}"+'/'+id+'/'+val;
        $.ajax({
            method: 'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(data){
                if(data.status == 'success'){
                    Swal.fire({
                        title: 'Message!',
                        text: `Product Active successfully ..!!`,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(true);
                        }
                    });
                }
            }
        })
    }
</script>


@stop