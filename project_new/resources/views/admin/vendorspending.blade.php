@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- <div class="alert alert-info">
                    <strong>Info!</strong> Accept And View Details Is Enable After Vendor Fills The Bank & Business Details.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                    <a href="{!! url('admin/vendors') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <h3>Vendors Pending</h3>
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
                                <th>Document</th>
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
                                    <!--<td><img style="max-width: 80px;" src="{{url('assets/images/vendor/addressproof')}}/{{$vendor->addressproof}}"></td>-->
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg_{{$vendor->id}}"></i></a></td>
                                    <td>
                                        {{$vendor->address}}
                                        <br>
                                        {{$vendor->areaandstreet}}
                                    </td>
                                    <td>Pending</td>

                                    <td>
                                        <a href="{{url('admin/vendors/accept')}}/{{$vendor->id}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</a>
                                        <a href="{{url('admin/vendors/reject')}}/{{$vendor->id}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</a>
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


@foreach($vendors as $vendor)
    <div class="modal fade bd-example-modal-lg_{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Address Proof Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($vendor->addressproof != "")
                                <iframe src="{{url('assets/images/vendor/addressproof')}}/{{$vendor->addressproof}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/vendor/addressproof')}}/{{$vendor->addressproof}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endforeach

@stop

@section('footer')

@stop