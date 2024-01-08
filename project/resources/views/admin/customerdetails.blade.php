
@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="go-title">
            <div class="pull-right">
                <a href="{!! url('admin/customers') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <h3>Customer Details</h3>
            <div style="border: 1px solid #ddd;"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
              <label>Full Name</label>
              <input type="text" class="form-control" placeholder="Full Name" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->name .' '.$customer[0]->mname.' '.$customer[0]->lname}}">
            </div>
            <div class="col-sm-3">
             <label>Phone Number</label>
              <input type="text" class="form-control" placeholder="Phone Number" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->phone}}">
            </div>
            <div class="col-sm-3">
             <label>Alternate Phone Number</label>
              <input type="text" class="form-control" placeholder="Alternate Phone Number" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->alternate_phone}}">
            </div>
            <div class="col-sm-3">
              <label>Email Address</label>
              <input type="text" class="form-control" placeholder="Email Address" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->email}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
              <label>Full Address</label>
              <input type="text" class="form-control" placeholder="Address" style="text-align: center; background-color: #ded0d0;"  value="{{$customer[0]->address.' '.$customer[0]->address2}}">
            </div>
            <div class="col-sm-3">
              <label>State</label>
              <input type="text" class="form-control" placeholder="State" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->state}}">
            </div>
            <div class="col-sm-3">
              <label>City</label>
              <input type="text" class="form-control" placeholder="City" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->city}}">
            </div>
            <div class="col-sm-3">
              <label>Zip</label>
              <input type="text" class="form-control" placeholder="Zip" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->zip}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
              <label>Bank Name</label>
              <input type="text" class="form-control" placeholder="Bank Name" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->bank_name}}">
            </div>
            <div class="col-sm-3">
              <label>Account No</label>
              <input type="text" class="form-control" placeholder="Account No" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->acc_no}}">
            </div>
            <div class="col-sm-3">
              <label>IFSC Code</label>
              <input type="text" class="form-control" placeholder="IFSC Code" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->ifsc_code}}">
            </div>
            <div class="col-sm-3">
              <label>Bussiness Name</label>
              <input type="text" class="form-control" placeholder="Bussiness Name" style="text-align: center; background-color: #ded0d0;" disabled value="{{$customer[0]->bussiness_name}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
              <label>GST No</label>
              @if($customer[0]->gst_no != 'NULL')
              <input type="text" class="form-control" style="text-align: center; background-color: #ded0d0;" disabled placeholder="GST No" value="{{$customer[0]->gst_no}}">
              @else
              <input type="text" class="form-control" style="text-align: center; background-color: #ded0d0;" disabled placeholder="GST No" value="---">
              @endif
            </div>
        </div>
        <br>
        <h3>Document Details</h3>
        <div style="border: 1px solid #ddd;"></div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <label>Udyam Certificate</label>
                @if($customer[0]->udyam_cert != 'NULL')
                <a id="udyam_pdf" target='_blank' href='<?php echo "/assets/images/customer_document/udyam_certificate/".$customer[0]->udyam_cert ?>'><i class="fa fa-eye" style="font-size:17px;color:success"> preview</i>
                </a>
                @else
                <label style="color:red;">(You Could Not Add Your Attachments)</label>
                @endif
            </div>
             <div class="col-sm-3">
                <label>PAN Card</label>
                @if($customer[0]->id_proof != '')
                <a id="shop_act_pdf" target='_blank' href='<?php echo "/assets/images/customer_document/id_proof/".$customer[0]->id_proof ?>'><i class="fa fa-eye" style="font-size:17px;color:success"> preview</i>
                </a>
                @else
                <label style="color:red;">(You Could Not Add Your Attachments)</label>
                @endif
            </div>
            <div class="col-sm-3">
                <label>Aadhar Card</label>
                @if($customer[0]->aadhar_card != 'NULL')
                <a id="id_proof_pdf" target='_blank' href='<?php echo "/assets/images/customer_document/aadhar_card/".$customer[0]->aadhar_card ?>'><i class="fa fa-eye" style="font-size:17px;color:success">preview</i>
                </a>
                @else
                <label style="color:red;">(You Could Not Add Your Attachments)</label>
                @endif
            </div>
            <div class="col-sm-3">
                <label>Shop Act Licence</label>
                @if($customer[0]->shop_act_lic != '')
                <a id="shop_act_pdf" target='_blank' href='<?php echo "/assets/images/customer_document/shop_act_licence/".$customer[0]->shop_act_lic ?>'><i class="fa fa-eye" style="font-size:17px;color:success"> preview</i>
                </a>
                @else
                <label style="color:red;">(You Could Not Add Your Attachments)</label>
                @endif
            </div>
        </div>
        <br>
        <span class="row" style="">
            <a href="email/{{$customer[0]->id}}" class="btn btn-primary" style=""><i class="fa fa-send"></i> Contact Customer</a>
        </span>
    </div>
@stop

@section('footer')

@stop