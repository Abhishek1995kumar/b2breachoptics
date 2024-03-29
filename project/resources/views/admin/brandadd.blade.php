@extends('admin.includes.master-admin')
<style>
    .go-title{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #brand_name{
        width: 22.2rem;
        border-radius: 0.2rem;
    }
    #category_id{
        width: 22.2rem;
        border-radius: 0.2rem;
    }
</style>
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Add Brand</h3>
                    <div class="backbtn">
                        <a href="{{ url('admin/productsetting') }}" class="btn btn-success text-center" value="Back">Back</a>
                    </div>
                </div>
                <div class="go-line"></div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div id="response"></div>
                        <form method="POST" id="brand_add" class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Select Category<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group">
                                        <select type="text" id="category_id" name="category_id" placeholder="Brand Name" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Brand Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="cp2" class="input-group">
                                        <input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Brand</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    
@stop
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('footer')
   <script>
    $("#brand_add").on("submit", function(e){
        e.preventDefault();
        let url = "{{url('/admin/brands/insert')}}";
        let formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: url,
                data: formData,
                processData: false, 
                contentType: false,
                cache: false,
                async: false,
                dataType: 'JSON',
                success: function(resp){
                    if(resp.status == 404){
                        Swal.fire({
                            icon: 'error',
                            text: resp.msg,
                            imageAlt: 'Custom image',
                        }).then((result) => {
                            window.location = "{{url('admin/brand/create')}}";
                        })
                        
                    }else{
                        Swal.fire({
                            icon: 'success',
                            text: resp.msg,
                            imageAlt: 'Custom image',
                        }).then((result) => {
                            window.location = "{{url('admin/productsetting')}}";
                        })
                    }
                }
            });  
    });
    </script>
@stop