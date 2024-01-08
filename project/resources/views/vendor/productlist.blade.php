@extends('vendor.includes.master-vendor')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Products</h3>
                    <div class="go-line"></div>
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
                                 <li class=""><a href="#product_change" onclick="vendorProductChanges(event)" data-toggle="tab" aria-expanded="false">Product Changes</a>
                                </li>
                               
                            </ul>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div class="tab-pane active" id="product_list">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right">
                                            <a href="{!! url('vendor/products/create') !!}" style="background-color:#10e9b6" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>
                                        </div>
                                        <p class="lead">Product List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <select class="form-control" onchange="showExcelCategory(event)" id="categoryValue">
                                                <option selected value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-8 text-right" id="export_value_show" hidden>
                                            <a onclick="exportCategoryData()" href="javascript:void(0);" class="btn btn-primary btn-excel"><i class="fa fa-download"></i> &nbsp; Excel</a>
                                            <br>
                                        </div>
                                    </div>
                                    <table id="vendor_product" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                <th width="5%">ID#</th>
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
                            
                                <div class="tab-pane" id="product_change">
                                    <p class="lead">Vendor Pending Product</p>
                                    <div class="ln_solid"></div>
                                    <table id="vendor_product_change_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID#</th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rejection Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')

<script src="{{ URL::asset('assets/js/vendor/product/product.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop