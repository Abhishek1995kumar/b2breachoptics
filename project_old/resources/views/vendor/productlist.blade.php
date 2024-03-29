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
                                            <!--@foreach($products as $product)-->
                                            <!--    <tr>-->
                                            <!--        <td>{{$product->id}}</td>-->
                                            <!--        <td>{{$product->title}}</td>-->
                                            <!--        <td>{{$settings[0]->currency_sign}}{{$product->costprice}}</td>-->
                                            <!--        <td>{{$product->category_name}}</td>-->
                                            <!--        <td>{{$product->stock}}</td>-->
                                            <!--        <td><img style="max-width: 50px;" src="{{url('assets/images/products')}}/{{$product->feature_image}}"></td>-->
                                            <!--        <td>-->
                                            <!--            @if($product->status == 1)-->
                                            <!--                Active-->
                                            <!--            @elseif($product->status == 2)-->
                                            <!--                Pending-->
                                            <!--            @elseif($product->status == 3)-->
                                            <!--                Rejected-->
                                            <!--            @else-->
                                            <!--                Inactive-->
                                            <!--            @endif-->
                                            <!--        </td>-->
                                            <!--        <td>{{$product->note}}</td>-->
                                            <!--        <td>-->
                                            <!--            <form method="POST" action="{!! action('VendorProductsController@destroy',['id' => $product->id]) !!}">-->
                                            <!--                {{csrf_field()}}-->
                                            <!--                <input type="hidden" name="_method" value="DELETE">-->
                                            <!--                <a href="{!! url('vendor/products') !!}/{{$product->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>-->
                                                            <!--   @if($product->status==1)
                                            <!--                    <a href="{!! url('vendor/products') !!}/status/{{$product->id}}/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>-->
                                            <!--                @elseif($product->status==0)-->
                                            <!--                    <a href="{!! url('vendor/products') !!}/status/{{$product->id}}/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>-->
                                            <!--                @else-->
                                            <!--                @endif -->
                                            <!--                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>-->
                                            <!--            </form>-->
                                            <!--        </td>-->
                                            <!--    </tr>-->
                                            <!--@endforeach-->
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