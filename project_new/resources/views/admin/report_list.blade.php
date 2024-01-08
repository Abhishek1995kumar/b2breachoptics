@extends('admin.includes.master-admin')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/report_attr') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Report</h3>
                    <div class="go-line"></div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="gocover"></div>
                            <div id="response"></div>
                            <div class="card-body padding-bottom-0">
                                <form method="post" id="report_list" >
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">Category</label>
                                            <select class="form-control" name="mainid" id="maincats" required>
                                                <option value="0">Select Category</option>
                                                <option value="all">All</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">Brand Name</label>
                                            <select class="form-control" name="brand_name" id="" required>
                                                <option value="0">Select Brand Name</option>
                                                <option value="all">All</option>
                                                @foreach($brandname as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}
                                                    
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><br>
                                        <div class="col-sm-3">
                                            <button type="submit" id="submit" class="btn btn-primary add-button-style" onclick="">Submit</button>
                                        </div>

                                        <input type="button" onclick="export_data()" value="Export">


                                        <!-- <div class="col-sm-3">
                                            <a href="{{route('admin/export')}}">Excel</a>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                  
                            <div id="printDiv">
                                <div class="col-md-12 table-responsive" id="gridReport" style="overflow: auto;">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Vendor Name</th>
                                            <th>Model No</th>
                                            <th>Product SKU</th>
                                            <th>MRP</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<script>
$(document).ready(function() {
    $("#printDiv").hide();
    $("#report_list").on('submit', function(e){
       e.preventDefault();
       var fd = new FormData(this);
        $.ajax({
            method: 'POST',
            url: '{{url("/admin/listPurchase")}}',
            data: fd,
            processData: false, 
            contentType: false, 
            dataType: 'JSON',
            success: function(resp)
            {
                let body_html = '';
                $('#example tbody').html("");
                for(let i=0; i < resp.length; i++)
                {
                body_html = `<tr>
                                <td>${resp[i].brandname}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td> 
                            </tr>`;
                            $('#example tbody').append(body_html);
                }
            }
        });
    });
    $("#submit").click(function(){
            $("#printDiv").show();
    });
});    
</script>




@stop
@section('footer')
@stop