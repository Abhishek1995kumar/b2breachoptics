@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>
                        Vendors <a href="{{url('admin/vendors/pending')}}" class="btn btn-primary"><strong>Pending Vendors ({{\App\Vendors::where('status', 0)->count()}})</strong></a> <a href="{{url('admin/vendors/pending/documents')}}" class="btn btn-danger"><strong>Pending Vendors Documents ({{\App\Vendors::where('status', 1)->count()}})</strong></a> <a href="{{url('admin/vendors/pending/uploadeddocument')}}" class="btn btn-warning"><strong>Uploaded Vendors Documents ({{\App\Bankdetali::where('status', 0)->count()}})</strong></a> <a href="{{url('admin/vendors/Correction/documents')}}" class="btn btn-primary"><strong>Pending Vendors Documents Correction ({{\App\Vendors::where('status', 3)->count()}})</strong></a>
                        <button type="button" class="btn btn-success full-excel" onclick="vendorsexportAllExcel(event)"><i class="fa fa-download"></i></button>
                    </h3>
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
                            <tr id="vendor-tr-id">
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
                                    <td>{{$vendor->address}} {{$vendor->areaandstreet}}</td>
                                    <!--<td><a href="{{url('assets/images/vendor')}}/{{$vendor->addressproof}}" target="_blank">proof</a></td>-->
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg_{{$vendor->id}}"></i></a></td>
                                    <td>
                                        @if($vendor->status == 0)
                                            Pending
                                        @elseif($vendor->status == 1)
                                            Document Pending
                                        @elseif($vendor->status == 2)
                                            Approved
                                        @elseif($vendor->status == 4)
                                            Vendor Deactive
                                        @else
                                            Document Correction Pending
                                        @endif
                                    </td>

                                    <td>
                                        @if($vendor->status == 2)
                                            <a href="{{url('/admin/vendors')}}/{{$vendor->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>
                                        @endif

                                        <a href="vendors/email/{{$vendor->id}}" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Send Email</a>
                                        
                                        @if($vendor->status == 2)
                                        <a href="javascript:void(0)" onclick="vendorDeactive({{$vendor->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Deactive </a>
                                        @elseif($vendor->status == 4)
                                        <a href="javascript:void(0)" onclick="vendorActive({{$vendor->id}})" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Active </a>
                                        @else
                                        @endif
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
<script src="{{URL::asset('assets/js/admin/vendorupdatestatus.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/admin/vendorexcelreport.js')}}"></script>

@stop