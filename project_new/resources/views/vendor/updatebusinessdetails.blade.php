@extends('vendor.includes.master-vendor')

@section('content')

<!DOCTYPE html>
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

        .ImageContentGet{
            /*margin-left: 0;*/
        }

        .ImageContentGet .modal-content{
            width: 132rem;
            height: 57rem;
        }
  
        .ImageContentGet .modal-header{
            padding: auto;
        }

        .ImageContentTrade{
            /*margin-left: 0;*/
        }

        .ImageContentTrade .modal-content{
            width: 132rem;
            height: 57rem;
        }
  
        .ImageContentTrade .modal-header{
            padding: auto;
        }

        .ImageContentRegist{
            /*margin-left: 0;*/
        }

        .ImageContentRegist .modal-content{
            width: 132rem;
            height: 57rem;
        }
  
        .ImageContentRegist .modal-header{
            padding: auto;
        }

        viewer-toolbar #toolbar{
            display: none;
        }
</style>

<div class="container"> 
    <div class=" text-center mt-5 ">
        <h1>Update Business Details</h1>
    </div>
    <div class="go-title">
        <div class="pull-right">
            <!--<a href="{!! url('vendor/vendorprofile') !!}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>-->
            <a href="{!! url('vendor/vendorprofile') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </div>
    <br>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form method="POST" action="{{ route('businessname.update') }}" enctype="multipart/form-data">
                        	{{csrf_field()}}
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Business Name * </label> <input id="form_name" type="text" value="{{$data->businessname	}}" name="businessname" class="form-control" placeholder="Please Enter Business Name *" required="required" data-error="Business Name Is Required"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">GSTIN *</label> <input id="form_email" type="text" name="gst" value="{{$data->gst}}" class="form-control" placeholder="Please Enter GSTIN *" required="required" data-error="GSTIN Is Required"></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">Company PAN *</label> <input id="form_email" type="text" name="pan" value="{{$data->pan}}" class="form-control" placeholder="Please Enter Company PAN *" required="required" data-error="Company PAN Is Required"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">Adhar Card *</label> <input id="form_email" type="text" name="adhar" value="{{$data->adhar}}" class="form-control" placeholder="Please Enter Adhar Card *" required="required" data-error="Adhar Card Is Required"></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        	<label for="form_need">Company Type *</label> 
                                        	<select id="form_need" name="companytype" class="form-control"  data-error="Please Select Account Type">
                                                <option value="{{$data->companytype}}" selected>{{$data->companytype}}</option>
                                                <option value="Individual- Proprietor">Individual- Proprietor</option>
                                                <option value="Partnership firm">Partnership firm</option>
                                                <option value="Limited company (Ltd./Pvt.Ltd.)">Limited company (Ltd./Pvt.Ltd.)</option>
                                                <option value="HUF Firm (Hindu Undivided Family)">HUF Firm (Hindu Undivided Family)</option>
                                                <option value="Limited Liability partnership (LLP)">Limited Liability partnership (LLP)</option>
                                                <option value="Trust/ Association of person/body of individual">Trust/ Association of person/body of individual</option>
                                                <option value="Government firm/Local Authority /Artificial judiciary">Government firm/Local Authority /Artificial judiciary</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        	<label for="form_need">Business Type *</label> 
                                        	<select id="form_need" name="businesstype" class="form-control"  data-error="Please Select Account Type">
                                                <option value="{{$data->businesstype}}" selected>{{$data->businesstype}}</option>
                                                <option value="Manufacturer">Manufacturer</option>
                                                <option value="OEM manufacturer">OEM manufacturer</option>
                                                <option value="Exporter">Exporter</option>
                                                <option value="100% export oriented unit">100% export oriented unit</option>
                                                <option value="Wholesaler">Wholesaler</option>
                                                <option value="Wholesale distributor">Wholesale distributor</option>
                                                <option value="Wholesale merchant">Wholesale merchant</option>
                                                <option value="Wholesale sellers">Wholesale sellers</option>
                                                <option value="Wholesale supplier">Wholesale supplier</option>
                                                <option value="Wholesale trader">Wholesale trader</option>
                                                <option value="Authorized Wholesale dealer">Authorized Wholesale dealer</option>
                                                <option value="Distributor/channel partner">Distributor/channel partner</option>
                                                <option value="Importer ">Importer </option>
                                                <option value="Retailer">Retailer</option>
                                                <option value="Retail merchant">Retail merchant</option>
                                                <option value="Retail shop">Retail shop</option>
                                                <option value="Authorized Retail dealer">Authorized Retail dealer</option>
                                                <option value="Ecommerce shop /online business">Ecommerce shop /online business</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">Address(Area/Street) *</label> <input id="form_email" type="text" name="addresstwo" value="{{$data->addresstwo}}" class="form-control" placeholder="Please Enter Address(Area/Street) *" required="required" data-error="Address(Area/Street) Is Required"></div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">LandMark *</label> <input id="form_email" type="text" name="landmark" value="{{$data->landmark}}" class="form-control" placeholder="Please Enter LandMark *" required="required" data-error="LandMark Is Required"></div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">City *</label> <input id="form_email" type="text" name="city" value="{{$data->city}}" class="form-control" placeholder="Please Enter City *" required="required" data-error="City Is Required"></div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">State</label> <input id="form_email" type="text" name="state" value="{{$data->state}}" class="form-control" placeholder="Please Enter State *" required="required" data-error="State Is Required"></div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">Country *</label> <input id="form_email" type="text" name="country" value="{{$data->country}}" class="form-control" placeholder="Please Enter Country *" required="required" data-error="Country Is Required"></div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">Pincode *</label> <input id="form_email" type="text" name="pincode" value="{{$data->pincode}}" class="form-control" placeholder="Please Enter Pincode *" required="required" data-error="Pincode Is Required"></div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">Year Of Establishment *</label> <input id="form_email" type="text" name="yoe" value="{{$data->yoe}}" class="form-control" placeholder="Please Enter Year Of Establishment *" required="required" data-error="Year Of Establishment Is Required"></div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">Product Profile Of Your Company *</label> <input id="form_email" type="text" name="ppoyc" value="{{$data->ppoyc}}" class="form-control" placeholder="Please Enter Product Profile Of Your Company *" required="required" data-error="Product Profile Of Your Company Is Required"></div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                    
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group"> <label for="form_email">TAN</label> <input id="form_email" type="text" name="tan" value="{{$data->tan}}" class="form-control" placeholder="Please Enter TAN *" data-error="TAN Is Required"></div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 2.7rem;">
                                            <div class="form-group">
                                                <label for="form_email">Upload Adhar Card</label> 
                                                <div style="display:flex;">
                                                    <input placeholder="Upload Adhar Card (jpeg.png.pdf(500*500,Size:400kb))" id="adharimg" type="file" name="adharimg" class="form-control"  data-error="Cancel Check Is Required">
                                                    <a href="javascript:void(0)" id="checkAdhaar" aria-hidden="true"><i class="fa fa-eye" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 2.7rem;">
                                            <div class="form-group">
                                                <label for="form_email">Trademark Certificate</label> 
                                                <div style="display:flex;">
                                                    <input placeholder="Upload Trademark Certificate (jpeg.png(500*500,Size:400kb))" id="form_email" type="file" name="trademarkimg"  class="form-control"  data-error="Cancel Check Is Required">
                                                    <a id="checkTrademark" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="form_email">Udyam Registration Certificate</label> 
                                                <div style="display:flex;">
                                                    <input placeholder="Upload Udyam Registration Certificate (jpeg.png(500*500,Size:400kb))" id="form_email" type="file" name="udyamimg" class="form-control" data-error="Cancel Check Is Required">
                                                    <a href="javascript:void(0)" id="checkUdyamRegist"><i class="fa fa-eye" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="form_email">Company Logo</label>
                                            <div style="display:flex;">
                                                <input placeholder="Company Logo (jpeg.png(500*500,Size:400kb)) " id="form_email" type="file" name="companylogo" class="form-control"  data-error="Company Logo Is Required">                                                
                                                <a href="javascript:void(0)" id="checkLogoComp"><i class="fa fa-eye" style="margin-left: -2.5rem; margin-top: 0.5rem;"></i></a>
                                            </div>   
                                        </div>   
                                    </div>
                                </div>

                                <!--<div class="row">-->
                                <!--	<div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group"> <label for="form_email">Upload Adhar Card</label> <input id="form_email" type="file" name="adharimg" class="form-control"  data-error="Cancel Check Is Required"><small>Upload Adhar Card (jpeg.png.pdf(500*500,Size:400kb))</small> </div>-->
                                <!--    	</div>-->
                                <!--    </div>-->

                                <!--    <div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group">-->
                                <!--        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/'.$data->adharimg) }}">-->
                                <!--        	</div>-->
                                <!--    	</div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                <!--	<div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group"> <label for="form_email">Trademark Certificate</label> <input id="form_email" type="file" name="trademarkimg"  class="form-control"  data-error="Cancel Check Is Required"><small>Upload Trademark Certificate (jpeg.png(500*500,Size:400kb))</small></div>-->
                                <!--    	</div>-->
                                <!--    </div>-->

                                <!--    <div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group">-->
                                <!--        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/'.$data->trademarkimg) }}">-->
                                <!--        	</div>-->
                                <!--    	</div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="row">-->
                                <!--	<div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group"> <label for="form_email">Udyam Registration Certificate</label> <input id="form_email" type="file" name="udyamimg" class="form-control" data-error="Cancel Check Is Required"><small>Upload Udyam Registration Certificate (jpeg.png(500*500,Size:400kb))</small></div>-->
                                <!--    	</div>-->
                                <!--    </div>-->

                                <!--    <div class="col-md-6">-->
                                <!--    	<div class="form-group">-->
                                <!--    		<div class="form-group">-->
                                <!--        	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/'.$data->udyamimg) }}">-->
                                <!--        	</div>-->
                                <!--    	</div>-->
                                <!--    </div>-->
                                <!--</div>-->


                                <div class="row">
                                    <!--<div class="col-md-6">-->
                                    <!--    <div class="form-group"> -->
                                    <!--    	<label for="form_email">Company Logo</label> -->
                                    <!--    	<input id="form_email" type="file" name="companylogo" class="form-control"  data-error="Company Logo Is Required">-->
                                    <!--    	<small>Upload Company Logo (jpeg.png(500*500,Size:400kb))</small>-->
                                    <!--    </div>   -->
                                    <!--</div>-->

                                    <!--<div class="col-md-6">-->
                                    <!--	<div class="form-group">-->
                                    <!--		<div class="form-group">-->
                                    <!--    	 <img width="30%" style="padding: 10px;" src="{{ url('assets/images/VendorDoc/'.$data->companylogo) }}">-->
                                    <!--    	</div>-->
                                    <!--	</div> 	-->
                                    <!--</div>-->

                                    <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Update Business Details"> </div><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Abhishek -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchAdhaarImage" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Adhaar Photo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->adharimg != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->adharimg}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->adharimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchTrademarkImage" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Trademark Photo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->trademarkimg != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->trademarkimg}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->trademarkimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchUdyamImage" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Udyam Registration Cetificate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->companylogo != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->udyamimg}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->udyamimg}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="fetchLogoComp" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Company Logo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($data->companylogo != "")
                                <iframe src="{{url('assets/images/VendorDoc')}}/{{$data->companylogo}}" style="width: 850px; height: 510px;"></iframe>
                            @else
                                <img src="{{url('assets/images/VendorDoc')}}/{{$data->companylogo}}" style="width: 850px; height: 510px;" alter="Please Choose Address Document">
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
<script src="{{URL::asset('assets/js/vendor/updatebusinessdetail.js')}}"></script>
@stop