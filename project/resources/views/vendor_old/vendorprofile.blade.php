@extends($vendor->status == '2' ? 'vendor.includes.master-vendor' : 'vendor.includes.master-vendor1');
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
                        <form method="POST" action="{!! action('VendorProfileController@update',['id' => $vendor->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group">
                                <label style="margin-top: 90px;" class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Photo <span class="required">*</span>
                                </label>
                                <span class="col-md-2 col-sm-6 col-xs-12">
                                    <img style="width: 120px; height: 120px;" src="{{url('/')}}/assets/images/vendor/{{$vendor->photo}}" id="vendorimg" class="profile_img" alt="Vendor Photo">
                                </span>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input class="hidden" onchange="readURL(this)" id="uploadFile" name="photo" type="file">
                                    <div id="uploadTrigger" onclick="uploadclick()" style="margin-top: 90px;white-space: normal;" class="form-control btn btn-default"><i class="fa fa-upload"></i> Change Photo</div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Vendor Owner Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="name" placeholder="Vendor Name" value="{{$vendor->name}}" required="required" type="text">
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
                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Update profile</button>
                                </div>
                            </div>
                        </form>
                 
                        <br><br>
                    @if($vendor->status == '1')
                        <div class="row">
                           <div class="form-group">
                               <div class="col-md-6">
                                <a class="btn btn-info btn-lg form-control" data-toggle="modal" data-target="#myModal"><i class="fa fa-university" aria-hidden="true"></i> Add Bank Details</a>
                               </div>
                               <div class="col-md-6">
                                 <a type="button" class="btn btn-info btn-lg form-control" data-toggle="modal" data-target="#myModalnew"><i class="fa fa-briefcase" aria-hidden="true"></i> Add Business Details</a>
                               </div>
                           </div>      
                        </div> 
                    @elseif($vendor->status == '3' || $vendor->status == '2')
                        <div class="row">
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
                        <br><br>

                       <!-- Model For Bank Details -->

                       <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Bank Details</h4>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{ route('bankdetails.submit') }}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <br>
                                        <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Account Holder Name <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" name="accountholdername" class="form-control" id="" placeholder="Account Holder Name" value="{{old('accountholdername')}}" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Account Number <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" name="accountnumber" value="{{old('accountnumber')}}" class="form-control" id="" placeholder="Account Number" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Bank Name<span style="color: red;">*</span></label>
                                        <div class="col-sm-7"> 
                                          <input type="text" name="bankname" value="{{old('bankname')}}"  class="form-control" id="" placeholder="Bank Name" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">IFSC Code<span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" name="ifsccode" value="{{old('ifsccode')}}" class="form-control" id="" placeholder="IFSC Code" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Account Type <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                            <select name="accounttype" id="accounttype" value="{{old('accounttype')}}" class="form-control" required>
                                                <option value="saving">Saving</option>
                                                <option value="current">Current</option>
                                            </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Cancel Cheque<span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readCancelCheck(this)" name="cancelcheck" value="{{old('cancelcheck')}}" class="form-control"  > <i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal" style="margin-left: -30px; padding-right: 10px; float: right; margin-top: -25px"></i>
                                          <!--<small>Upload Cancel Check (jpeg.png.pdf(500*500,Size:400kb))</small>-->
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readPassbook(this)" name="passbook" class="form-control"><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal1" style="margin-left: -30px; padding-right: 10px; float: right; margin-top: -25px"></i>
                                          <!--<small>Upload Passbook Frontpage Or Bank Statement (jpeg.png.pdf(500*500,Size:400kb))</small>-->
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

                       <!-- End Model For Bank Details -->

                <!-- Start Of Model For Business Details -->

                <div id="myModalnew" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Business Details</h4>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{ route('businessdetails.submit') }}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Business Name <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('businessname')}}" name="businessname" class="form-control" id="" placeholder="Business Name" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address(Building No/floor) <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('addressone')}}" name="addressone"  class="form-control" id="" placeholder="Address(Building No/floor)" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address(Area/Street) <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('addresstwo')}}" name="addresstwo" class="form-control" id="" placeholder="Address(Area/Street)" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">LandMark <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('landmark')}}" name="landmark" class="form-control" id="" placeholder="LandMark" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">City <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('city')}}" name="city" class="form-control" id="" placeholder="City" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">State <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('state')}}" name="state" class="form-control" id="" placeholder="State" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">country <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('country')}}" name="country" class="form-control" id="" placeholder="Country" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Pincode <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('pincode')}}" name="pincode" class="form-control" id="" placeholder="Pincode" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Company Type <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <select name="companytype" value="{{old('companytype')}}" id="companytype" class="form-control" required>
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
                                          <select name="businesstype" value="{{old('businesstype')}}" id="businesstype" class="form-control" required>
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
                                        <label for="" class="col-sm-3 col-form-label">Year Of Establishment <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('yoe')}}" class="form-control" name="yoe" id="" placeholder="Year Of Establishment" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Product Profile Of Your Company <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('ppoyc')}}" class="form-control" name="ppoyc" id="" placeholder="Product Profile Of Your Company" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">GSTIN <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('gst')}}" class="form-control" name="gst" id="" placeholder="GSTIN" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Company PAN <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('pan')}}" class="form-control" name="pan" id="" placeholder="Company PAN" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Adhar Card <span style="color: red;">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" value="{{old('adhar')}}" class="form-control" name="adhar" id="" placeholder="Adhar Card" required>
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Upload Adhar Card</label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readAdhar(this)" value="{{old('adharimg')}}" name="adharimg" class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal2" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                          <!--<small>Upload Adhar Card (jpeg.png(500*500,Size:400kb))</small>-->
                                        </div>
                                      </div>
                                      <!--<div class="form-group row">-->
                                      <!--  <label for="" class="col-sm-3 col-form-label">TAN <span style="color: red;"></label>-->
                                      <!--  <div class="col-sm-7">-->
                                      <!--    <input type="text" value="{{old('tan')}}" class="form-control" name="tan" id="" placeholder="TAN" required>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                       <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Trademark Certificate</label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readTrademark(this)" value="{{old('trademarkimg')}}" name="trademarkimg" class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal3" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                          <!--<small>Upload Trademark Certificate (jpeg.png(500*500,Size:400kb))</small>-->
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Udyam Registration Certificate</label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readUdyam(this)" value="{{old('udyamimg')}}" name="udyamimg" class="form-control"><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal4" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i>
                                          <!--<small>Upload Udyam Registration Certificate (jpeg.png(500*500,Size:400kb))</small>-->
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Company Logo</label>
                                        <div class="col-sm-7">
                                          <input type="file" onchange="readCompanyLogo(this)" value="{{old('companylogo')}}" name="companylogo" class="form-control" ><i class="fa fa-eye showpwd" data-toggle="modal" data-target="#myModal5" style="margin-left: -30px; float: right; padding-right: 10px; margin-top: -25px"></i><small>Upload Company Logo (jpeg.png(500*500,Size:400kb))</small>
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
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<!-- imgmodel1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel1 --> 
<!-- imgmodel2 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag1" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel2 -->
<!-- imgmodel3 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag2" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel3 -->
<!-- imgmodel4 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag3" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel4 -->
<!-- imgmodel5 -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag4" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel5 -->
<!-- imgmodel6 -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Documents</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" id="address-img-tag5" width="60%" height="60%" />    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endmodel6 -->   



@stop

@section('footer')
<script>

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#vendorimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    activaTab('tab');
    function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
}
</script>
@stop


<script type="text/javascript">
    
    function readCancelCheck(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readPassbook(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readAdhar(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readTrademark(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag3').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readUdyam(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag4').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readCompanyLogo(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#address-img-tag5').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>