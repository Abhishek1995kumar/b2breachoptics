@extends('includes.newmaster')

@section('content')

<div class="home-wrapper">
     <!--Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="account-information-tab">
                           
                            <div class="edit-account-info-div">
                                <h3>Edit account information</h3>
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form action="{{ action('UserProfileController@update',['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="dash_fname">First Name </label>
                                            <input class="form-control" type="text" name="name" id="dash_fname" value="{{$user->name}}" placeholder="First Name" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_fname">Middle Name </label>
                                            <input class="form-control" type="text" name="mname" id="dash_fname" value="{{$user->mname}}" placeholder="Middle Name" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_fname">Last Name </label>
                                            <input class="form-control" type="text" name="lname" id="dash_fname" value="{{$user->lname}}" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Phone Number </label>
                                            <input class="form-control" type="number" name="phone" value="{{$user->phone}}" style="background-color: #fffcfc;" placeholder="e.g. 91+**********" required readonly>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Alternate Number </label>
                                            <input class="form-control" type="number" placeholder="e.g. 91+**********"" name="alternate_phone" value="{{$user->alternate_phone}}" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Email address </label>
                                            <input class="form-control" type="email" name="email" value="{{$user->email}}" style="background-color: #fffcfc;" id="dash_email" placeholder="e.g. smith@gmail.com"  required readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Address line 1 </label>
                                            <input class="form-control" type="text" name="address" id="dash_fname" value="{{$user->address}}" placeholder="House / Flat number" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Address line 2 </label>
                                            <input class="form-control" type="text" name="address2" id="dash_fname" value="{{$user->address2}}" placeholder="Area, Street & Landmark  " required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Zip / Postal Code </label>
                                            <input name="zip" placeholder="e.g. 400001" class="form-control" value="{{$user->zip}}" type="number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" value="{{$user['state']}}" id="state_id">
                                            <input type="hidden" value="{{$user['city']}}" id="city_id">
                                            <label for="dash_email">Country </label>
                                            <select  id="country-dropdown" class="form-control" name="country">
                                                <option value="">-- Select Country --</option>
                                                @foreach ($countries as $data)
                                                <?php if($user['country'] == $data->id) {?>
                                                    <option value="{{$data->id}}" selected>
                                                    {{$data->Name}}
                                                    </option>
                                                <?php } else{?>
                                                    <option value="{{$data->id}}" >
                                                    {{$data->Name}}
                                                    </option>
                                                    <?php } ?>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">State / Province </label>
                                            <select id="state-dropdown" class="form-control" name="state">
                                            </select>
                                        </div>
                                       <div class="col-md-4 form-group">
                                            <label for="dash_email">Town / City </label>
                                            <select id="city-dropdown" name="city" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="">Bussiness Name</label>
                                            <input class="form-control" type="text" name="bussiness_name" value="{{$user->bussiness_name}}"  placeholder="Bussiness Name">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">Bank Name</label>
                                            <input name="bank_name" placeholder="Bank Name" class="form-control" value="{{$user->bank_name}}" type="text" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">GST No</label>
                                            <input name="gst_no" placeholder="GST No" class="form-control" value="{{$user->gst_no}}" type="text" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="">Account No</label>
                                            <input class="form-control" type="text" name="acc_no" value="{{$user->acc_no}}" placeholder="Account No">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="dash_email">IFSC Code</label>
                                            <input name="ifsc_code" placeholder="IFSC Code" class="form-control" value="{{$user->ifsc_code}}" type="text" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="" for="uploadFile">Pan Card</label>
                                            @if($user->id_proof != 'NULL' && $user->id_proof != '' )
                                            <a id="id_proof_pdf" style="padding-left: 23%;font-size: 19px;" target='_blank' href='<?php echo "/assets/images/customer_document/id_proof/".$user->id_proof ?>'><i class="fa fa-eye" style="font-size: 18px;color: blue;"></i>
                                            </a>
                                            @else
                                            <label class="" for="uploadFile" style="color:red;font-size: 10px;">(You Could Not Add Your Attachments)</label>
                                            @endif
                                            <input onchange="readURL(this,event)" id="id_proof" name="photo" value="{{$user->id_proof}}" type="file">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="" for="uploadFile">Shop Act Licence</label>
                                            @if($user->shop_act_lic != 'NULL' && $user->shop_act_lic != '' )
                                            <a  style="padding-left: 6%;font-size: 20px;" id="shop_act_pdf" target='_blank' href='<?php echo "/assets/images/customer_document/shop_act_licence/".$user->shop_act_lic ?>'><i class="fa fa-eye" style="font-size: 18px;color: blue;"></i>
                                            </a>
                                            @else
                                            <label class="" for="uploadFile" style="color:red;font-size: 10px;">(You Could Not Add Your Attachments)</label>
                                            @endif
                                            <input onchange="read_lic(this,event)" id="shop_act_licence" name="shop_lice" value="" type="file">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="" for="uploadFile">Udyam Certificate</label>
                                            @if($user->udyam_cert != 'NULL' && $user->udyam_cert != '' )
                                            <a id="udyam_pdf" style="padding-left: 6%;font-size: 20px;" target='_blank' href='<?php echo "/assets/images/customer_document/udyam_certificate/".$user->udyam_cert ?>'><i class="fa fa-eye" style="font-size: 18px;color: blue;"></i>
                                            </a>
                                            @else
                                            <label class="" for="uploadFile" style="color:red;font-size: 10px;">(You Could Not Add Your Attachments)</label>
                                            @endif
                                            <input onchange="read_udyam(this,event)" id="udyam_car" name="udyam_cert" value="" type="file">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="" for="uploadFile">Aadhar Card</label>
                                            @if($user->aadhar_card != 'NULL' && $user->aadhar_card != '' )
                                            <a id="id_proof_pdf" style="padding-left: 14%;font-size: 19px;" target='_blank' href='<?php echo "/assets/images/customer_document/aadhar_card/".$user->aadhar_card ?>'><i class="fa fa-eye" style="font-size: 18px;color: blue;"></i>
                                            </a>
                                            @else
                                            <label class="" for="uploadFile" style="color:red;font-size: 10px;">(You Could Not Add Your Attachments)</label>
                                            @endif
                                            <input onchange="readURL(this,event)" id="aadhar_proof" name="aadhar_card" value="{{$user->aadhar_card}}" type="file">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" style="display: flex;margin-left: 32%;">
                                        <div class="col-md-4 form-group">
                                            <!--<a class="btn btn-md back-btn" href="{{route('user.account')}}">back</a>-->
                                            <input class="editpage-save-button" type="submit" value="save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!--Ending of Account Dashboard area -->
</div>


@stop

@section('footer')
<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#country-dropdown').on('change', function () {
        var idCountry = this.value;
        $("#state-dropdown").html('');
        $.ajax({
            url: "{{url('fetch-states')}}",
            type: "POST",
            data: {
                country_id: idCountry,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#state-dropdown').html('<option value="">-- Select State --</option>');
                $.each(result.states, function (key, value) {
                    $("#state-dropdown").append('<option value="' + value
                        .id + '">' + value.Name + '</option>');
                });
                $('#city-dropdown').html('<option value="">-- Select City --</option>');
            }
        });
    });

    var idCountry = $("#country-dropdown").val();
    $("#state-dropdown").html('');
    $.ajax({
        url: "{{url('fetch-states')}}",
        type: "POST",
        data: {
            country_id: idCountry,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown').html('<option value="">-- Select State --</option>');
            $.each(result.states, function (key, value) {
                if(value.id == $("#state_id").val()){
                    $("#state-dropdown").append('<option selected value="' + value
                    .id + '">' + value.Name + '</option>');
                }else {
                    
                $("#state-dropdown").append('<option value="' + value
                    .id + '">' + value.Name + '</option>');
                }
            });
            $('#city-dropdown').html('<option value="">-- Select City --</option>');
        }
    });

    $('#state-dropdown').on('change', function () {
        var idState = this.value;
        $("#city-dropdown").html('');
        $.ajax({
            url: "{{url('fetch-city')}}",
            type: "POST",
            data: {
                state_id: idState,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#city-dropdown').html('<option value="">-- Select City --</option>');
                $.each(res.cities, function (key, value) {
                    $("#city-dropdown").append('<option value="' + value
                        .id + '">' + value.Name + '</option>');
                });
            }
        });
    });
    var idState = $("#state_id").val();
        $("#city-dropdown").html('');
        $.ajax({
            url: "{{url('fetch-city')}}",
            type: "POST",
            data: {
                state_id: idState,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#city-dropdown').html('<option value="">-- Select City --</option>');
                $.each(res.cities, function (key, value) {
                if(value.id == $("#city_id").val()){
                    $("#city-dropdown").append('<option selected value="' + value
                    .id + '">' + value.Name + '</option>');
                }else {
                    
                $("#city-dropdown").append('<option value="' + value
                    .id + '">' + value.Name + '</option>');
                }
            });
            }
        });
    });
    
    
    var validImgExtensions = ['jpg','jpeg', 'png'];
    var validPDFExtensions = ['pdf'];
    function readURL(input,event) 
    {
       let file_name = event.target.files[0].name;
       let file_name_array = file_name.split(".")
       let current_file_extension = file_name_array[file_name_array.length-1];
       if(validImgExtensions.includes(current_file_extension)){
        Imgvalidation(input, event);
       }else if(validPDFExtensions.includes(current_file_extension)){
        pdfvalidation(input, event);
       }else{
        alert('Please select valid file');
        
        $(`#${event.target.getAttribute('id')}`).val('');
       }
       
    }

    function read_lic(input, event) 
    {
        let file_name = event.target.files[0].name;
        let file_name_array = file_name.split(".")
        let current_file_extension = file_name_array[file_name_array.length-1];
        if(validImgExtensions.includes(current_file_extension)){
            Imgvalidation(input, event);
        }else if(validPDFExtensions.includes(current_file_extension)){
            pdfvalidation(input, event);
        }else{
            alert("Please select valid file");
            $(`#${event.target.getAttribute('id')}`).val('');
        }
    }

    function read_udyam(input, event) 
    {
        let file_name = event.target.files[0].name;
        let file_name_array = file_name.split(".")
        let current_file_extension = file_name_array[file_name_array.length-1];
        if(validImgExtensions.includes(current_file_extension)){
            Imgvalidation(input, event);
        }else if(validPDFExtensions.includes(current_file_extension)){
            pdfvalidation(input, event);
        }else{
          alert("Please select valid file");
            $(`#${event.target.getAttribute('id')}`).val('');
        }
    }


    function Imgvalidation(input, event)
    {
        
        let numb = event.target.files[0].size/1000;
        numb = numb.toFixed(2);
        if (numb > 400) 
        {
            alert('To Big Image,Maximum Size Is 400KB. Your File Size Is: ' + numb + ' KB');
           
            $(`#${event.target.getAttribute('id')}`).val('');
            return false;
        }else{
            $(`#${$(event.target).prev().attr('id')}`).on("click", function()
            {
                var reader = new FileReader();
                reader.readAsDataURL(event.target.files[0]);
                var pdfWindow = window.open("");
                reader.onload = function () 
                {
                    pdfWindow.document.write("<iframe width='100%' height='100%' src='" + reader.result +"'></iframe>");
                };
            })
        }
    }
    
    function pdfvalidation(input, event)
    {
        let numb = event.target.files[0].size/1000;
        numb = numb.toFixed(2);
        if (numb > 1000) 
        {
            alert('To Big PDF,Maximum Size Is 1MB. Your File Size Is: ' + Math.floor(numb/1024) + ' MB');
           
            $(`#${event.target.getAttribute('id')}`).val('');
        }else{
            $(`#${$(event.target).prev().attr('id')}`).on("click", function()
            {
                var reader = new FileReader();
                reader.readAsDataURL(event.target.files[0]);
                var pdfWindow = window.open("");
                reader.onload = function () 
                {
                    pdfWindow.document.write("<iframe width='100%' height='100%' src='" + reader.result +"'></iframe>");
                };
            })
        }
    }
</script>

@stop