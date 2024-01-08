@extends('admin.includes.master-admin')

<style>
    .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 100%;
    }
    
    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        @if($vendor[0]->status == 2)
                            <a href="{!! url('admin/vendors') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                        @elseif($vendor[0]->status == 3)
                            <a href="{!! url('admin/vendors/Correction/documents') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                        @else
                            <a href="{!! url('admin/vendors/pending/uploadeddocument') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                        @endif
                    </div>
                    <h3>
                        @if($vendor[0]->narration != "")
                            Vendor Details :- <span>{{$vendor[0]->narration}}</span>
                        @else
                            Vendor Details
                        @endif
                    </h3>

                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="card">
                            <div class="container">
                                <h3 class="text-center"><b>Vendor Details</b></h3> 
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Shop Name:</th>
                                    <td>{{$vendor[0]->shop_name}}</td>
                                </tr>
                                <tr>
                                    <th>Total Products:</th>
                                    <td>{{\App\Product::where('vendorid',$vendor[0]->id)->count()}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Name:</th>  
                                    <td>{{$vendor[0]->name}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Email:</th>  
                                    <td>{{$vendor[0]->email}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Phone:</th>  
                                    <td>{{$vendor[0]->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Address:</th>  
                                    <td>{{$vendor[0]->address}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor City :</th>  
                                    <?php $city = DB::table("b2b_citymaster")->where("id", $vendor[0]->city)->get()[0]->Name; ?>
                                    <td>{{ $city }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Vendor State:</th>  
                                    <td>{{\DB::table('b2b_statemaster')->where('id',$vendor[0]->state)->get()[0]->Name}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Country:</th>  
                                    <td>{{\DB::table('b2b_countrymaster')->where('id',$vendor[0]->country)->get()[0]->Name}}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Zip:</th>  
                                    <td>{{$vendor[0]->zip}}</td>
                                </tr>
                                <tr>
                                    <th>Documents:</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lgd_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        
                        <div class="card">
                            <div class="container">
                                <h3 class="text-center"><b>Bank Details</b></h3> 
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Account Holder Name:</th>
                                    <td>{{$vendor[0]->accountholdername}}</td>
                                </tr>
                                <tr>
                                    <th>Account Number</th>
                                    <td>{{$vendor[0]->accountnumber}}</td>
                                </tr>
                                <tr>
                                    <th>Bank Name:</th>  
                                    <td>{{$vendor[0]->bankname}}</td>
                                </tr>
                                <tr>
                                    <th>IFSC Code</th>  
                                    <td>{{$vendor[0]->ifsccode}}</td>
                                </tr>
                                <tr>
                                    <th>Account Type</th>  
                                    <td>{{$vendor[0]->accounttype}}</td>
                                </tr>
                                <tr>
                                    <th>Cancel Check:</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lgcc_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                                <tr>
                                    <th>Passbook:</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lgp_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        
                        <div class="card">
                            <div class="container">
                                <h3 class="text-center"><b>Business Details</b></h3> 
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Business Name:</th>
                                    <td>{{$vendor[0]->businessname}}</td>
                                </tr>
                                <tr>
                                    <th>Company Type:</th>  
                                    <td>{{$vendor[0]->companytype}}</td>
                                </tr>
                                <tr>
                                    <th>Business Type</th>  
                                    <td>{{$vendor[0]->businesstype}}</td>
                                </tr>
                                <tr>
                                    <th>GSTIN</th>  
                                    <td>{{$vendor[0]->gst}}</td>
                                </tr>
                                <tr>
                                    <th>Company PAN</th>  
                                    <td>{{$vendor[0]->pan}}</td>
                                </tr>
                                <tr>
                                    <th>Adhar Card Number</th>  
                                    <td>{{$vendor[0]->adhar}}</td>
                                </tr>
                                <tr>
                                    <th>Adhar Card</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                                <tr>
                                    <th>Trademark Certificate</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg2_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                                <tr>
                                    <th>Udyam Registration Certificate</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg3_{{$vendor[0]->id}}"></i></a></td>
                                </tr>
                                <tr>
                                    <th>Company Logo</th>
                                    <td><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg4_{{$vendor[0]->id}}"></i></a></td>
                                </tr>

                                <tr>
                                    <td width="30%"></td>
                                    <td><a href="email/{{$vendor[0]->id}}" class="btn btn-primary"><i class="fa fa-send"></i> Contact Vendor</a></td>
                                </tr>
                            </table>
                            @if(\App\Businessdetali::where('vendorid', $vendor[0]->id)->where('status', 0)->get()->first())
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0)" onclick="vendorAccept({{$vendor[0]->id}})" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0)" onclick="vendorReject({{$vendor[0]->id}})" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

<div class="modal fade bd-example-modal-lgd_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
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
                        @if($vendor[0]->addressproof != "")
                            <iframe src="{{url('assets/images/vendor/addressproof')}}/{{$vendor[0]->addressproof}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/vendor/addressproof')}}/{{$vendor[0]->addressproof}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lgcc_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Cancel Check Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if($vendor[0]->cancelcheck != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->cancelcheck}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->cancelcheck}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lgp_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Passbook Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if($vendor[0]->passbook != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->passbook}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->passbook}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Aadhhar Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if($vendor[0]->adharimg != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->adharimg}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->adharimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg2_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Trademark Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if($vendor[0]->trademarkimg != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->trademarkimg}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->trademarkimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg3_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Udyam Registration Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if($vendor[0]->udyamimg != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->udyamimg}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->udyamimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg4_{{$vendor[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1380px;">
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
                        @if($vendor[0]->companylogo != "")
                            <iframe src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->companylogo}}" style="width: 1350px; height: 530px;"></iframe>
                        @else
                            <img src="{{url('assets/images/VendorDoc')}}/{{$vendor[0]->companylogo}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
<script src="{{URL::asset('assets/js/admin/vendorupdatestatus.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop