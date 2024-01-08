@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="alert alert-info">
                    <strong>Info!</strong> Waitng For Vendor Documentation.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                    <a href="{!! url('admin/vendors') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <h3>Vendors Pending Documents</h3>
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
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>Vendor Name</th>
                                <th width="10%">Vendor Email</th>
                                <th>Phone</th>
                                <!--<th>Document</th>-->
                                <th width="10%">Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{$vendor->name}}</td>
                                    <td>{{$vendor->email}}</td>
                                    <td>{{$vendor->phone}}</td>
                                    <!--<td><img style="max-width: 80px;" src="{{url('assets/images')}}/{{$vendor->addressproof}}"></td>-->
                                    <td>{{$vendor->address}}</td>
                                    <td>Pending</td>

                                    <td>
                                        <a href="{{url('admin/vendors')}}/{{$vendor->vendorid}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>
                                        <a href="{{url('admin/vendors/accept/doc/')}}/{{$vendor->vendorid}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</a>
                                        <a href="{{url('admin/vendors/reject/doc/')}}/{{$vendor->vendorid}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</a>
                                        <a href="{{url('admin/vendors/waitingdoc/')}}/{{$vendor->vendorid}}" class="btn btn-primary btn-xs"><i class="fa fa-caret-square-o-right"></i> Send For Document Correction</a>
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