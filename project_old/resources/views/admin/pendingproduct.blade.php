@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/products') !!}" class="btn btn-primary btn-add"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                    </div>
                    <h3>Pending Products</h3>
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
                      
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="10%">ID#</th>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->costprice}}</td>
                                <td>{{$product->category}}</td>
                                <td>
                                    @if($product->status == 1)
                                        Active
                                    @elseif($product->status == 2)
                                        Pending
                                          @elseif($product->status == 3)
                                        Rejected
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>

                                        <a href="{!! url('admin/products') !!}/{{$product->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
                                        @if($product->status==3)

                                        <a  data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Send Rejection Note </a>

                                        @else

                                        <a href="{!! url('admin/products/accept') !!}/{{$product->id}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept </a>

                                        <a  href="{!! url('admin/products/reject') !!}/{{$product->id}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject </a>

                                        @endif

                                    <!--     <a  data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Rejection Note </a> -->

                                                                                               
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="get" action="{!! url('admin/products/rejectnote') !!}/{{$product->id}}">
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

                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
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