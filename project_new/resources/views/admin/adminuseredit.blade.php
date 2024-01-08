@extends('admin.includes.master-admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />

@section('content')

<style>
    .iti{
        width: 100%;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <!-- Page Heading -->
            <div class="go-title">
                <h3>Role Manage</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div class="tab-pane active" id="product_list">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right" style="margin-">
                                            <a href="{!! route('manageroles') !!}" class="btn btn-primary btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                        <p class="lead">EDIT USER ROLE</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div  class="col-sm-6">
                                        <form action="{{route('adminrole.update')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$admin[0]->id}}">
                                            <div class="form-group">
                                                <label for="name"><h4>Name</h4></label>
                                                <input type="text" class="form-control" name="name" id="rolemanage" value="{{$admin[0]->name}}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="username"><h4>Username</h4></label>
                                                <input type="text" class="form-control" name="username" id="rolemanage" value="{{$admin[0]->username}}" aria-describedby="emailHelp" placeholder="Enter username">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><h4>Email</h4></label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{$admin[0]->email}}" aria-describedby="emailHelp" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><h4>Phone</h4></label>
                                                <input  type="tel" class="form-control" name="phone" id="phone" value="{{$admin[0]->phone}}" aria-describedby="emailHelp" placeholder="Enter phone number">
                                            </div>
                                            <div class="form-group">
                                                <label for="password"><h4>Password</h4></label>
                                                <input  type="text" class="form-control" name="password" id="password" placeholder="Enter New Password">
                                            </div>

                                            <div class="form-group">
                                                <label for="role">
                                                    <h4>Admin Role<span class="required">*</span></h4>
                                                </label>
                                                <div>
                                                    <select class="form-control" name="role" id="role" required>
                                                        <option  value="{{$admin[0]->rid}}">{{$admin[0]->role}}</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js"></script>
<script>
    var input = document.querySelector("#phone");
    intlTelInput(input, {
        initialCountry: "auto",
        separateDialCode:true,
        geoIpLookup: function (success, failure) {
        console.log(input);
        $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "us";
            success(countryCode);
        });
      },
    });
</script>
@stop

@section('footer')

@stop