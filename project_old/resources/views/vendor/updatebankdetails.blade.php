@extends('vendor.includes.master-vendor')

@section('content')

<style type="text/css">
	.btn-send {
	font-weight: 300;
	text-transform: uppercase;
	letter-spacing: 0.2em;
	width: 80%;
	margin-left: 3px
	}

	.help-block.with-errors {
	    color: #ff5050;
	    margin-top: 5px
	}

	.card {
	    margin-left: 10px;
	    margin-right: 10px
	}
</style>

<div class="container"> 
    <div class=" text-center mt-5 ">
        <h1>Update Bank Details</h1>
    </div>
    <div class="go-title">
        <div class="pull-right">
            <a href="{!! url('vendor/vendorprofile') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </div>
    <br>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form method="POST" action="{{ route('bankdetails.update') }}" enctype="multipart/form-data">
                        	{{csrf_field()}}
                            <div class="controls">
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="accountholdername">Account Holder Name * </label>
                                            <input id="form_name" type="text" value="{{ $data->accountholdername }}" name="accountholdername" class="form-control" placeholder="Please Account Holder Name *" required="required" data-error="Account Holder Name Is Required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_lastname">Account Number *</label>
                                            <input id="form_lastname" type="text" value="{{$data->accountnumber != '' ? $data->accountnumber : ''}}" name="accountnumber" class="form-control" placeholder="Please Enter Account Number *" required="required" data-error="Account Number Is Required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_email">Bank Name *</label>
                                            <input id="form_email" type="text" name="bankname" value="{{$data->bankname != '' ? $data->bankname : ''}}" class="form-control" placeholder="Please Enter Bank Name *" required="required" data-error="Bank Name Is Required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_email">IFSC Code</label>
                                            <input id="form_email" type="text" name="ifsccode" value="{{$data->ifsccode != '' ? $data->ifsccode : ''}}" class="form-control" placeholder="Please Enter IFSC Code *" required="required" data-error="IFSC Code Is Required">
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> -->
                                <!--        	<label for="form_need">Account Type</label> -->
                                <!--        	<select id="form_need" name="accounttype" class="form-control"  data-error="Please Select Account Type">-->
                                <!--                <option value="{{$data->accounttype != '' ? $data->accounttype : ''}}" selected>{{$data->accounttype != '' ? $data->accounttype : ''}}</option>-->
                                <!--                <option value="Saving">Saving</option>-->
                                <!--                <option value="Current">Current</option>-->
                                <!--            </select>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="form_need">Account Type</label> 
                                            <select id="form_need" name="accounttype" class="form-control"  data-error="Please Select Account Type">
                                                <option value="{{$data->accounttype}}" selected>{{$data->accounttype}}</option>
                                                <option value="Saving">Saving</option>
                                                <option value="Current">Current</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: ;">
                                            <div class="form-group">
                                                <label for="form_email">Cancel Cheque</label> 
                                                <div style="display:flex;">
                                                    <input placeholder="Upload Adhar Card (jpeg.png.pdf(500*500,Size:400kb))" id="cancelcheckData" type="file" name="cancelcheck" class="form-control"  data-error="Cancel Check Is Required">
                                                    <a href="javascript:void(0)" id="checkCheque" aria-hidden="true"><i class="fa fa-eye" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="row">-->
                                <!--	<div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group">-->
                                <!--    		    <label for="form_email">Cancel Cheque</label>-->
                                <!--    		    <input id="form_email" type="file" name="cancelcheck" class="form-control" data-error="Cancel Check Is Required">-->
                                <!--    		    <small>Upload Cancel Check (jpeg.png.pdf(500*500,Size:400kb))</small>-->
                                <!--		    </div>-->
                                <!--    	</div>-->
                                <!--    </div>-->

                                <!--    <div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group">-->
                                <!--        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/' . ($data->cancelcheck != '' ? $data->cancelcheck : '')) }}">-->
                                <!--        	</div>-->
                                <!--    	</div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: ;">
                                            <div class="form-group">
                                                <label for="form_email">PassBook</label> 
                                                <div style="display:flex;">
                                                    <input placeholder="Upload Trademark Certificate (jpeg.png(500*500,Size:400kb))" id="passbookDetails" type="file" name="passbook"  class="form-control" data-error="Cancel Check Is Required">
                                                    <a id="checkPassbook" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <!--<div class="col-md-6">-->
                                    <!--    <div class="form-group"> -->
                                    <!--    	<label for="form_email">PassBook</label> -->
                                    <!--    	<input id="form_email" type="file" name="passbook" class="form-control" data-error="Cancel Check Is Required">-->
                                    <!--    	<small>Upload Passbook Frontpage Or Bank Statement (jpeg.png.pdf(500*500,Size:400kb))</small>-->
                                    <!--    </div>   -->
                                    <!--</div>-->

                                    <!--<div class="col-md-6">-->
                                    <!--	<div class="form-group">-->
                                    <!--		<div class="form-group">-->
                                    <!--    	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/' . ($data->passbook != '' ? $data->passbook : '')) }}">-->
                                    <!--    	</div>-->
                                    <!--	</div> 	-->
                                    <!--</div>-->

                                    <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Update Bank Details"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>	

    <!-- Abhishek -->

    <!--<div class="modal fade bd-example-modal-lg" id="fetchChequeImage" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-lg ImageContentGet" role="document">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header d-flex justify-content-between">-->
    <!--                <h4 class="modal-title" id="exampleModalLabel">Adhaar Photo</h4>-->
    <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                    <span aria-hidden="true">&times;</span>-->
    <!--                </button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12 text-center">-->
    <!--                        <iframe width="1200rem;" height="450rem;" src="{{ url('assets/images/VendorDoc/' . $data->cancelcheck) }}" ></iframe>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchChequeImage" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Cancel Check</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->cancelcheck != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->cancelcheck}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->cancelcheck}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="modal fade bd-example-modal-lg" id="fetchPassbookImage"  aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-lg ImageContentTrade" role="document">-->
    <!--        <div class="modal-content" >-->
    <!--            <div class="modal-header">-->
    <!--                <h4 class="modal-title" id="exampleModalLabel">Trademark Photo</h4>-->
    <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                    <span aria-hidden="true">&times;</span>-->
    <!--                </button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12 text-center">-->
    <!--                        <iframe width="1200rem;" height="450rem;" src="{{ url('assets/images/VendorDoc/' . $data->passbook) }}"></iframe>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchPassbookImage" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Passbook</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->passbook != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->passbook}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->passbook}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer')
<!-- Abhishek -->
<script src="{{URL::asset('assets/js/vendor/updatebankdetails.js')}}"></script>
<br>
@stop