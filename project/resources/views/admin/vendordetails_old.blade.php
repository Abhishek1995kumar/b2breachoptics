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
                        <a href="{!! url('admin/vendors') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Vendor Details</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <div class="card">
                            <div class="container">
                                <h3 class="text-center"><b>Vendor Details</b></h3> 
                            </div>
                          <table class="table">
                              <tr>
                                <th>Vendors Company Name:</th>
                                <td>{{$vendor->shop_name}}</td>
                              </tr>
                              <tr>
                                <th>Total Products:</th>
                                <td>{{\App\Product::where('vendorid',$vendor->id)->count()}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Name:</th>  
                                <td>{{$vendor->name}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Email:</th>  
                                <td>{{$vendor->email}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Phone:</th>  
                                <td>{{$vendor->phone}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Fax:</th>  
                                <td>{{$vendor->fax}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Address:</th>  
                                <td>{{$vendor->address}}</td>
                              </tr>
                              <tr>
                                <th>Vendor City:</th>  
                                <td>{{$vendor->city}}</td>
                              </tr>
                              <tr>
                                <th>Vendor Zip:</th>  
                                <td>{{$vendor->zip}}</td>
                              </tr>
                              <tr>
                                <th>Documents:</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/vendor/addressproof')}}/{{$vendor->addressproof}}"></td>
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
                                <td>{{$vendor->accountholdername}}</td>
                              </tr>
                              <tr>
                                <th>Account Number</th>
                                <td>{{$vendor->accountnumber}}</td>
                              </tr>
                              <tr>
                                <th>Bank Name:</th>  
                                <td>{{$vendor->bankname}}</td>
                              </tr>
                              <tr>
                                <th>IFSC Code</th>  
                                <td>{{$vendor->ifsccode}}</td>
                              </tr>
                              <tr>
                                <th>Account Type</th>  
                                <td>{{$vendor->accounttype}}</td>
                              </tr>
                              <tr>
                                <th>Cancel Check:</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->cancelcheck}}"></td>
                              </tr>
                              <tr>
                                <th>Passbook:</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->passbook}}"></td>
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
                                <td>{{$vendor->businessname}}</td>
                              </tr>
                              <tr>
                                <th>Address:</th>
                                <td>{{$vendor->addressone}}</td>
                              </tr>
                              <tr>
                                <th>Alternate Address:</th>  
                                <td>{{$vendor->addresstwo}}</td>
                              </tr>
                              <tr>
                                <th>LandMark:</th>  
                                <td>{{$vendor->landmark}}</td>
                              </tr>
                              <tr>
                                <th>City:</th>  
                                <td>{{$vendor->city}}</td>
                              </tr>
                              <tr>
                                <th>State:</th>  
                                <td>{{$vendor->state}}</td>
                              </tr>
                              <tr>
                                <th>Country:</th>  
                                <td>{{$vendor->country}}</td>
                              </tr>
                              <tr>
                                <th>Pin Code:</th>  
                                <td>{{$vendor->pincode}}</td>
                              </tr>
                              <tr>
                                <th>Company Type:</th>  
                                <td>{{$vendor->companytype}}</td>
                              </tr>
                              <tr>
                                <th>Business Type</th>  
                                <td>{{$vendor->businesstype}}</td>
                              </tr>
                              <tr>
                                <th>Year Of Establishment</th>  
                                <td>{{$vendor->yoe}}</td>
                              </tr>
                              <tr>
                                <th>Product Profile Of Your Company</th>  
                                <td>{{$vendor->ppoyc}}</td>
                              </tr>
                              <tr>
                                <th>GSTIN</th>  
                                <td>{{$vendor->gst}}</td>
                              </tr>
                              <tr>
                                <th>Company PAN</th>  
                                <td>{{$vendor->pan}}</td>
                              </tr>
                              <tr>
                                <th>Adhar Card Number</th>  
                                <td>{{$vendor->adhar}}</td>
                              </tr>
                              <tr>
                                <th>TAN</th>  
                                <td>{{$vendor->tan}}</td>
                              </tr>
                              <tr>
                                <th>Adhar Card</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->adharimg}}"></td>
                              </tr>
                              <tr>
                                <th>Trademark Certificate</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->trademarkimg}}"></td>
                              </tr>
                              <tr>
                                <th>Udyam Registration Certificate</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->udyamimg}}"></td>
                              </tr>
                              <tr>
                                <th>Company Logo</th>  
                                <td><img style="max-width: 500px;" src="{{url('assets/images/VendorDoc')}}/{{$vendor->companylogo}}"></td>
                              </tr>

                              <tr>
                                <td width="30%"></td>
                                <td><a href="email/{{$vendor->vendorid}}" class="btn btn-primary"><i class="fa fa-send"></i> Contact Vendor</a>
                                </td>
                            </tr>
                            </table>
                        </div>
                        <br>

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