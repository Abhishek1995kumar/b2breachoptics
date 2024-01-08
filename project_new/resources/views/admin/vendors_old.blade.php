@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    {{--<div class="pull-right">--}}
                    {{--<a href="{!! url('admin/services/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Service</a>--}}
                    {{--</div>--}}
                    <h3>Vendors <a href="{{url('admin/vendors/pending')}}" class="btn btn-primary"><strong>Pending Vendors ({{\App\Vendors::where('status', 0)->count()}})</strong></a> <a href="{{url('admin/vendors/pending/documents')}}" class="btn btn-danger"><strong>Pending Vendors Documents ({{\App\Vendors::where('status', 1)->count()}})</strong></a> <a href="{{url('admin/vendors/Correction/documents')}}" class="btn btn-primary"><strong>Pending Vendors Documents Correction ({{\App\Vendors::where('status', 3)->count()}})</strong></a></h3>
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
                                <th width="10%">Address</th>
                                <th>Address Proof</th>
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
                                    <td>{{$vendor->address}}</td>
                                    <!--<td><a href="{{url('assets/images/vendor')}}/{{$vendor->addressproof}}" target="_blank">proof</a></td>-->
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg_{{$vendor->id}}"></i></a></td>
                                    <td>
                                        @if($vendor->status != 0)
                                            Apporve
                                        @else
                                            Pending
                                        @endif
                                    </td>

                                    <td>

                                        <form method="POST" action="{!! action('VendorsController@destroy',['id' => $vendor->id]) !!}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="vendors/{{$vendor->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>

                                            <a href="vendors/email/{{$vendor->id}}" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Send Email</a>

                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                        </form>

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
                            <img src="{{url('assets/images/vendor')}}/{{$vendor->addressproof}}" style="width: 850px; height: 510px;">
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