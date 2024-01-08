@extends('vendor.includes.master-vendor')

@section('content')

<!DOCTYPE html>
<html>
<head>
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
	
</head>
<body>

<div class="container"> 
    <div class=" text-center mt-5 ">
        <h1>Update Bank Details</h1>
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
                                <input class="form-control col-md-7 col-xs-12" name="status"   value="3" type="hidden">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Account Holder Name * </label> <input id="form_name" type="text" value="{{$data->accountholdername}}" name="accountholdername" class="form-control" placeholder="Please Account Holder Name *" required="required" data-error="Account Holder Name Is Required"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_lastname">Account Number *</label> <input id="form_lastname" type="text" value="{{$data->accountnumber}}" name="accountnumber" class="form-control" placeholder="Please Enter Account Number *" required="required" data-error="Account Number Is Required"> </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">Bank Name *</label> <input id="form_email" type="text" name="bankname" value="{{$data->bankname}}" class="form-control" placeholder="Please Enter Bank Name *" required="required" data-error="Bank Name Is Required"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">IFSC Code</label> <input id="form_email" type="text" name="ifsccode" value="{{$data->ifsccode}}" class="form-control" placeholder="Please Enter IFSC Code *" required="required" data-error="IFSC Code Is Required"></div>
                                    </div>
                                </div>

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
                                </div>

                                <div class="row">
                                	<div class="col-md-6">
                                    	<div class="form-group">
                                    		<div class="form-group"> <label for="form_email">Cancel Cheque</label> <input id="form_email" type="file" name="cancelcheck" class="form-control" data-error="Cancel Check Is Required"><small>Upload Cancel Check (jpeg.png.pdf(500*500,Size:400kb))</small></div>
                                    	</div>
                                    </div>

                                    <div class="col-md-6">
                                    	<div class="form-group">
                                    		<div class="form-group">
                                        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/' . $data->cancelcheck) }}">
                                        	</div>
                                    	</div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        	<label for="form_email">PassBook</label> 
                                        	<input id="form_email" type="file" name="passbook" class="form-control" data-error="Cancel Check Is Required">
                                        	<small>Upload Passbook Frontpage Or Bank Statement (jpeg.png.pdf(500*500,Size:400kb))</small>
                                        </div>   
                                    </div>

                                    <div class="col-md-6">
                                    	<div class="form-group">
                                    		<div class="form-group">
                                        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/' . $data->passbook) }}">
                                        	</div>
                                    	</div> 	
                                    </div>

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


</body>
</html>









@stop






@section('footer')
<br>
@stop