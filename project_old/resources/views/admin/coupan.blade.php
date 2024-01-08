@extends('admin.includes.master-admin')
<style>
    .go-title{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .colorpicker-component{
        display: block;
        width: 25rem;
    }

</style>
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3 id="form_title">Add Coupan</h3>
                    <div class="backbtn">
                        <a href="{{ url('admin/coupan') }}" class="btn btn-success text-center" value="Back">Back</a>
                    </div>
                </div>
                <div class="go-line"></div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response"></div>
                        <form method="POST" action="{{ route('coupan.save') }}" id="coupan_form" class="form-horizontal form-label-left">
                            {{ csrf_field() }}

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coupan_amount">Coupan Amount<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        <input type="text" id="coupan_amount" name="coupan_amount" value="{{ $coupan_amount }}" placeholder="color Name" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coupan_type">Coupan Discount type<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component" >
                                        <select name="coupan_type" id="" class="form-control" style="width: 25rem; height: 1.4rem; border-color: gainsboro;">
                                            <option>Select coupan type</option>
                                            @if($coupan_type=='V')
                                                <option id="coupan_type" selected name="coupan_type" value="V" >Value</option>
                                            @else
                                                <option id="coupan_type" name="coupan_type" value="V" >Value</option>
                                            @endif
                                            @if($coupan_type=='P')  
                                                <option id="coupan_type" selected name="coupan_type" value="P" >Percentage</option>
                                            @else
                                                <option id="coupan_type" name="coupan_type" value="P" >Percentage</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_date">Start Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        <input type="date" id="start_date" name="start_date" value="{{ $start_date }}" placeholder="start date" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coupan_code">Coupan Code<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        <input type="text" id="coupan_code" name="coupan_code" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))" value="{{ $coupan_code }}" required placeholder="coupan code" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b2b_code">b2b Code<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        @if($b2b_code != '')
                                            <input type="text" id="b2b_code" name="b2b_code" value="{{ $b2b_code }}" required placeholder="b2b code" class="form-control" readonly />
                                        @else
                                            <input type="text" id="b2b_code" name="b2b_code" value="RCH-" required placeholder="b2b code" class="form-control" readonly />
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="validity">validity<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        <input type="text" id="validity" name="validity" value="{{ $validity }}" placeholder="validity" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id ">User</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group colorpicker-component">
                                        <select name="userid" id="userid" class="form-control">
                                            @foreach($users as $user)
                                                @if($userid == $user->id)
                                                    <option value="{{ $user->id }}" selected>{{$user->name}}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" id="coupan_submit" class="btn btn-success btn-block">Add Coupan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        // function couponCode(e){
        //     e.preventDefault();
        //     if(!e.charCode) return true
        //     let regex = new RegExp("^[0-9a-zA-Z_\.]+e");
        //     let str = String.fromCharCode(!e.charCode ? e.which : e.charCode)
        //     if((e.charCode >= 48 && e.charCode <= 57) || (e.charCode >= 65 && e.charCode <= 90) || (e.charCode >= 97 && e.charCode <= 122)){
        //         console.log(str);
        //         return true;
        //     }
        //     return false;
        // }

        // $(document).ready(function(){
        //     $('#b2b_code').keypress(function(event){
        //         if(!event.charCode) return true
        //         let regex = new RegExp("^[0-9a-zA-Z_\.]+event");
        //         let str = String.fromCharCode(!event.charCode ? event.which : event.charCode)
        //         if(regex.test(str)){
        //             return true
        //         }
        //         event.preventDefault();
        //         return false;
        //         console.log(regex);
        //     });
        // });
        let b2bcoupon = document.getElementById('b2b_code');
        $('#coupan_code').keyup(function(){
            if( b2bcoupon.value !== 0 ){
                b2bcoupon.value = 'RCH-' + $('#coupan_code').val();
                b2bcoupon.text = 'RCH-' + $('#coupan_code').val();
            }
        });
    </script>
@stop