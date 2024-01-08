@extends($vendor->status == '2' ? 'vendor.includes.master-vendor' : 'vendor.includes.master-vendor1')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                <div class="pull-right">
                    <!-- <a href="#TaskListDialog" role="button" class="btn btn-primary" data-toggle="modal">Add Bank And Business Details</a> -->  
                </div>
                    <h3>Vendor Profile</h3>
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
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    @if($vendor->status == '1')
                        <div class="row" style="margin-top:1rem; margin-bottom:3rem;">
                           <div class="form-group">
                               <div class="col-md-6">
                                <a class="btn btn-info btn-lg form-control text-center" data-toggle="modal" data-target="#bankmyModal"><i class="fa fa-university text-center" aria-hidden="true"></i> Add Bank Details</a>
                               </div>
                               <div class="col-md-6">
                                 <a type="button" class="btn btn-info btn-lg form-control text-center" data-toggle="modal" data-target="#businessModalnew"><i class="fa fa-briefcase text-center" aria-hidden="true"></i> Add Business Details</a>
                               </div>
                           </div>      
                        </div> 
                    @elseif($vendor->status == '5' || $vendor->status == '2')
                        <div class="row" style="margin-top:1rem; margin-bottom:3rem;">
                           <div class="form-group">
                               <div class="col-md-6">
                                <a class="btn btn-info btn-lg form-control" href="{!! url('vendor/bankdetails') !!}"><i class="fa fa-university" aria-hidden="true"></i>Update Add Bank Details</a>
                               </div>
                               <div class="col-md-6">
                                 <a type="button" class="btn btn-info btn-lg form-control" href="{!! url('vendor/businessdetails') !!}"><i class="fa fa-briefcase" aria-hidden="true"></i>Update Add Business Details</a>
                               </div>
                           </div>      
                        </div>
                    @else
                    @endif 
                    <!--@if($vendor->status == 2 || $vendor->status == 3)-->
                    <!--    <div class="row" style="margin-top:1rem; margin-bottom:3rem;">-->
                    <!--       <div class="form-group row">-->
                    <!--           <label for="zip" class="control-label col-md-3 col-sm-3 col-xs-12">Reason For Updating The Details <span style="color: red;">*</span></label>-->
                    <!--           <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--            <a class="btn btn-warning btn-lg form-control text-center" data-toggle="modal" data-target="#myModalnewNarration"><i class="fa fa-university text-center" aria-hidden="true">Reason For Updating The Details </i></a>-->
                    <!--           </div>-->
                    <!--       </div>      -->
                    <!--    </div>-->
                    <!--@endif -->
                    
                    <hr style="border-top: 1px solid #b3a5a5;">
                    @if(isset($vendor))
                        <form method="POST" action="{!! action('VendorProfileController@update',['id' => $vendor->id]) !!}" onsubmit="validateVendorForm(this)" class="form-horizontal form-label-left" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Vendor Owner Name <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="" placeholder="Vendor Name" value="{{$vendor->name}} {{$vendor->mname}} {{$vendor->lname}}" readonly />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Vendor Shop Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="shop_name" placeholder="Vendor Name" value="{{$vendor->shop_name}}" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Email Address <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="email" placeholder="Vendor Email" value="{{$vendor->email}}" required="required" type="text" disabled>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Phone Number <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="phone" placeholder="Vendor Phone Number" value="{{$vendor->phone}}" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address(Building No/floor) <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" value="{{ $vendor->address }}" name="address"  class="form-control" id="" placeholder="Address(Building No/floor)"  />
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address(Area/Street) <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" value="{{$vendor->areaandstreet}}" name="areaandstreet" class="form-control" id="" placeholder="Address(Area/Street)"  />
                            </div>
                         </div>
                          <div class="form-group">
                            <label for="landmark" class="control-label col-md-3 col-sm-3 col-xs-12">LandMark <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" value="{{ $vendor->landmark }}" name="landmark" class="form-control" id="" placeholder="LandMark"   />
                            </div>
                          </div>
                        
                        <div class="form-group">
                            <label for="country" class="control-label col-md-3 col-sm-3 col-xs-12">country <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="country" class="form-control" id="" placeholder="City">
                                    <option value="">select country</option>
                                    @foreach($country as $country)
                                        @if($vendor->country == $country->id)
                                            <option selected value="{{$country->id}}">
                                        @else
                                            <option value="{{$country->id}}">
                                        @endif
                                        {{$country->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">State <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select name="state" class="form-control" id="" placeholder="City">
                                    <option value="">select state</option>
                                    @foreach($state as $st)
                                        @if($vendor->state == $st->id)
                                            <option selected value="{{$st->id}}">
                                        @else
                                            <option value="{{$st->id}}">
                                        @endif
                                        {{$st->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">City <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="city" class="form-control" id="" placeholder="City">
                                    <option value="">select city</option>
                                    @foreach($city as $c)
                                        @if($vendor->city == $c->Id)
                                            <option selected value="{{$c->Id}}">
                                        @else
                                            <option value="{{$c->Id}}">
                                        @endif
                                        {{$c->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zip" class="control-label col-md-3 col-sm-3 col-xs-12">Pincode <span style="color: red;">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" value="{{ $vendor->zip }}" name="zip" class="form-control" id="" placeholder="Pincode" />
                            </div>
                        </div>
                        
                        @if($vendor->status == 5 || $vendor->status == 2)
                            <div class="form-group">
                                <label for="zip" class="control-label col-md-3 col-sm-3 col-xs-12">Reason For Updating The Details <span style="color: red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <textarea type="text" value="{{ $vendor->narration }}" name="narration" class="form-control" id="narration" placeholder="narration" required></textarea>
                                </div>
                            </div>
                        @endif
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-block">Update profile</button>
                            </div>
                        </div>
                    </form>
                    @endif
                        
                        <br><br>
    
                        <br><br>

                        <!-- Model For Bank Details -->
                        <div id="bankmyModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bank Details</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form onsubmit="validateBankDetails(event)" enctype="multipart/form-data">
                                       
                                        <br>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Account Holder Name <span style="color: red;">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="form-control col-md-7 col-xs-12" name="accountholdername" id="AccountHolder" style="width: 49.5rem;" placeholder="Vendor Name"  />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Account Number <span style="color: red;">*</span></label>
                                            <div class="col-sm-7">
                                              <input type="text" name="accountnumber" value="{{old('accountnumber')}}" class="form-control" id="Accountnumber" placeholder="Account Number" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Bank Name<span style="color: red;">*</span></label>
                                            <div class="col-sm-7"> 
                                              <input type="text" name="bankname" onkeyup="banknameCase()" id="bankname" class="form-control"  placeholder="Bank Name"  value="{{old('bankname')}}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">IFSC Code<span style="color: red;">*</span></label>
                                            <div class="col-sm-7">
                                              <input type="text" name="ifsccode" onkeyup="ifscCodeCase()" class="form-control" id="ifsccode" placeholder="IFSC Code"  value="{{old('ifsccode')}}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Account Type <span style="color: red;">*</span></label>
                                            <div class="col-sm-7">
                                                <select name="accounttype" id="accounttype" value="{{old('accounttype')}}" class="form-control" >
                                                    <option value="saving">select account type</option>
                                                    <option value="saving">Saving</option>
                                                    <option value="current">Current</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Cancel Cheque<span style="color: red;">*</span></label>
                                            <div class="col-sm-7">
                                              <input type="file" onchange="showCancelCheckImg(this)" name="cancelcheck" id="cancelcheck" value="{{old('cancelcheck')}}" class="form-control" placeholder="Please select Cancel Check" /> <i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal1" style="margin-left: -30px; padding-right: 10px; float: right; margin-top: -25px"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Passbook<span style="color: red;">*</span></label>
                                            <div class="col-sm-7">
                                              <input type="file" onchange="showPassbookImg(this)" value="{{old('passbook')}}"  name="passbook" id="passbook" class="form-control" placeholder="Please select Passwork" /><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal2" style="margin-left: -30px; padding-right: 10px; float: right; margin-top: -25px"></i>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="modal-footer">
                                            <div class="form-group row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-success">Add Details</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- End Model For Bank Details -->

                        <!-- Start Of Model For Business Details -->
                        <div id="businessModalnew" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Business Details</h4>
                                  </div>
                                
                                    <div class="modal-body">
                                        <form onsubmit="validateBusinessDetails(event)" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Business Name <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" value="{{ $vendor->businessname }}" name="businessname" id="businessname"  placeholder="Fill Business Name" class="form-control" placeholder="" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Company Type <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <select name="companytype" value="{{old('companytype')}}" id="companytype" class="form-control" placeholder="Select Business Name">
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
                                            
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Business Type <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <select name="businesstype" value="{{old('businesstype')}}" id="businesstype" class="form-control" placeholder="Select Business Name" required>
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
                                              
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">GSTIN <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" value="{{old('gst')}}" class="form-control" name="gst" id="gst" placeholder="Fill GSTIN">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Company PAN <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" value="{{old('pan')}}" class="form-control" name="pan" id="pan" placeholder="Fill Company PAN">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Adhar Card <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" value="{{old('adhar')}}" class="form-control" name="adhar" id="adhar" placeholder="Fill Adhar Card Number" />
                                                </div>
                                            </div>
                                               
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Upload Adhar Card</label>
                                                <div class="col-sm-7">
                                                        <input type="file" onchange="showAdhaarImage(this)" name="adharimg" id="adharimg" placeholder="Select Adhaar Image" class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal3" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                                    
                                                </div>
                                            </div>
                                              
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Trademark Certificate</label>
                                                <div class="col-sm-7">
                                                  <input type="file" name="trademarkimg" id="trademarkimg" onchange="readTrademark(this)"  placeholder="Select Trademark Image" class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal4" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                                </div>
                                            </div>
        
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Udyam Registration Certificate</label>
                                                <div class="col-sm-7">
                                                  <input type="file" onchange="showUdyamImage(this)" name="udyamimg" id="udyamimg" placeholder="Select Udyam Image"class="form-control"><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal5" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Company Logo</label>
                                                <div class="col-sm-7">
                                                  <input name="companylogo" id="companylogo" placeholder="Select Companylogo Image" type="file" onchange="showCompanyLogImage(this)"  class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal6" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i><small>Upload Company Logo (jpeg.png(500*500,Size:400kb))</small>
                                                </div>
                                            </div>  
                                            
                                        </div>
                                        <div class="modal-footer"> 
                                            <div class="form-group row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-success">Add Details</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                <!-- End Of Model For Business Details -->

                    </div>
                        <!--End of Modal For Business Details-->
                        
                        <!--Start Narration -->
                        <div id="myModalnewNarration" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Reason For Updating The Details</h4>
                                  </div>
                                
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Business Name <span style="color: red;">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" value="" name="narration" id="narration"  placeholder="Reason For Updating The Details " class="form-control" placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer"> 
                                            <div class="form-group row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-success">Submit Narration</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!--End Narration -->
                </div>
            </div>
            
        </div>
        
    </div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document" style="margin-left: 2rem;">
        <div class="modal-content"  style="width:130rem; height:59rem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Upload Cancel Check</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadCancelCheckImg" width="1200px" height="500px" ></iframe>    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="margin-left: 2rem;" >
        <div class="modal-content" style="width:130rem; height:59rem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Upload Passbook</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadPassbookImg" width="1200px" height="500px" ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="margin-left: 2rem;">
        <div class="modal-content" style="width:130rem; height:59rem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Upload Adhar Card</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadAdhaarImg" width="1200px" height="500px" ></iframe>    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog ImageContentTrade" role="document" style="margin-left: 2rem;">
        <div class="modal-content"  style="width:130rem; height:59rem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Trademark Certificate</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadTradeImg" width="1200px" height="500px" ></iframe>    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="margin-left: 2rem;">
        <div class="modal-content"  style="width:130rem; height:59rem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Udyam Registration Certificate</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadUdyamImage" width="1200px" height="500px" ></iframe>    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="margin-left: 2rem;">
        <div class="modal-content"  style="width:130rem; height:59rem" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Company Logo</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <iframe src="" id="uploadLogImage" width="1200px" height="500px" ></iframe>  
                </div>
            </div>
        </div>
    </div>
</div>



@stop

@section('footer')


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ URL::asset('assets/js/vendor/vendorprofile.js') }}"></script>
    <script>
    	function banknameCase() {
    	    let uppercase = document.getElementById("bankname");
    	    uppercase.value = uppercase.value.toUpperCase();
    	};
    	
    	
    function ifscCodeCase(e){
    	    let ifsc = document.getElementById("ifsccode");
    	    ifsc.value = ifsc.value.toUpperCase();
    	};


    function businessDetails(id, url, form){
        $.ajax({
            type : "POST",
            url : url,
            data: form,
            processData: false, 
            contentType: false, 
            dataType: 'JSON',
            success : function(resp){
                if(resp.status == "success"){
                    alert(resp.message);
                    $('#businessModalnew').modal('hide');
                }
                else{
                    alert(resp.message);
                }
            }
        });
    }	

    function validateBusinessDetails(e){
        e.preventDefault();
        let form = new FormData(e.target);
        form.append('_token', '{{ csrf_token() }}')
        let url = baseUrl + "/vendor/businessdetails" ;
        let data = [];
        data[0] = document.getElementById("businessname");
        data[1] = document.getElementById("companytype");
        data[2] = document.getElementById("businesstype");
        // data[3] = document.getElementById("gst");
        // data[4] = document.getElementById("pan");
        data[3] = document.getElementById("adhar");
        data[4] = document.getElementById("adharimg");
        data[5] = document.getElementById("trademarkimg");
        data[6] = document.getElementById("udyamimg");
        data[7] = document.getElementById("companylogo");
        
        let regPan = /^([a-zA-Z]{5})([0-9]{4})([a-zA-Z]{1})$/;
        let panNumber = data[4].value.match(regPan);
        
        let regGst = /^([0-9]{2})([a-zA-Z]{5})([0-9]{4})([a-zA-Z]{1})([0-9]{1})([a-zA-Z]{1})([0-9]{1})$/;
        let GstNumber = data[3].value.match(regGst);
        
        let regAdhaar = /^([0-9]{10,14})$/;
        let AdhaarNumber = data[3].value.match(regAdhaar);
        
        let flag = false;
        for(let x=0; x<data.length; x++){
            
            // if(x==3){
            //     if(!GstNumber){
            //         Swal.fire({
            //             title: 'Message!',
            //             text: 'Please Enter Valid GST Value',
            //             imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            //             imageWidth: 400,
            //             imageHeight: 200,
            //             imageAlt: 'Custom image',
            //         });
                    // flag = true;
                    // break;
            //     }
            // };
            
            // if(x==4){
            //     if(!panNumber){
            //         Swal.fire({
            //             title: 'Message!',
            //             text: 'Please Enter Valid PAN Number',
            //             imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            //             imageWidth: 400,
            //             imageHeight: 200,
            //             imageAlt: 'Custom image',
            //         });
            //      flag = true;
            //      break;
            //     }
            // };

            if(x==5){
                if(!AdhaarNumber){
                    Swal.fire({
                        title: 'Enter Adhaar Number !',
                        text: 'Please Enter Valid Adhaar Number',
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    });
                    flag = true;
                    return;
                }
            };
            if(data[x].value == ""){
                Swal.fire({
                    title: "Please " + data[x].placeholder,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                });
                flag = true;
                break;
            }
        }
        if(flag) return;
        businessDetails(e, url, form)
    }


    function bankDetails(id, url, form){
        $.ajax({
            method: 'POST',
            url: url,
            data: form,
            processData: false, 
            contentType: false, 
            dataType: 'JSON',
            success : function(resp){
                if(resp.status == "success"){
                    alert(resp.message);
                    $('#bankmyModal').modal('hide');
                }else{
                    alert(resp.message);
                }
            }
        });
    }	
    

    function validateBankDetails(e){
        e.preventDefault();
        let form = new FormData(e.target);
        form.append('_token', '{{ csrf_token() }}');
        let url = baseUrl + "/vendor/bankdetails" ;
        let data = [];
        data[0] = document.getElementById("AccountHolder");
        data[1] = document.getElementById("Accountnumber");
        data[2] = document.getElementById("bankname");
        data[3] = document.getElementById("ifsccode");
        data[4] = document.getElementById("accounttype");
        data[5] = document.getElementById("cancelcheck");
        data[6] = document.getElementById("passbook");
    	
        let ifscReg = /^([a-zA-Z]{4,6})([0-9]{6,10})$/;
        let flag = false;
        for(let x=0; x<data.length; x++){
            let ifsc = data[3].value.match(ifscReg);
            if(x == 3){
                if(!ifsc){
        	        Swal.fire({
                        title: 'Please Enter Valid IFSC Code!',
                        text: 'first four characters are alphabets !! After 8 characters are number',
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    });
                    flag = true;
                    break;
            	}
            }
            
            if(data[x].value == ""){
                Swal.fire({
                    title: data[x].placeholder,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK',
                });
                flag = true;
                break;
            }
        }
        
        if(flag) return;
        bankDetails(e, url, form); 
    }

 
    function validateVendorForm(val){
        let data = [];
        data[0] = document.getElementById("Narration");
        for(let x=0; x<data.length; x++){
            if(data[x].value == ""){
                Swal.fire({
                    title: data[x].placeholder,
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    imageAlt: 'Custom image',
                });
                break;
            }
        }
    }



	function showCancelCheckImg(input) {
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            readImg.onload = function(e){
                $("#uploadCancelCheckImg").attr("src", e.target.result);
            }
        }
	}
	
	function showPassbookImg(input) {
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            readImg.onload = function(e){
                $("#uploadPassbookImg").attr("src", e.target.result);
            }
        }
	}
	
	function showAdhaarImage(input) {
	    console.log(input)
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            console.log(readImg); 
            readImg.onload = function(e){
                $("#uploadAdhaarImg").attr("src", e.target.result);
            }
        }
	}
	
	function readTrademark(input) {
	    console.log(input)
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            console.log(readImg); 
            readImg.onload = function(e){
                $("#uploadTradeImg").attr("src", e.target.result);
            }
        }
	}
	
	function showUdyamImage(input) {
	    console.log(input)
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            console.log(readImg); 
            readImg.onload = function(e){
                $("#uploadUdyamImage").attr("src", e.target.result);
            }
        }
	}
	
	function showCompanyLogImage(input) {
	    console.log(input)
        if(input.files && input.files[0]){
            let readImg = new FileReader();  // FilReader are use to read image value, which image we upload by input tag
            readImg.readAsDataURL(input.files[0]);  // If we want to use FilReader at this time must be used this line otherwise getting error on the console
            console.log(readImg); 
            readImg.onload = function(e){
                $("#uploadLogImage").attr("src", e.target.result);
            }
        }
	}
    </script>
@stop






