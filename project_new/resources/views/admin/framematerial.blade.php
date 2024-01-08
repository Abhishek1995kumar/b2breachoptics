@extends('admin.includes.master-admin')
<style>
    .go-title{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #color_name{
        width: 21.8rem;
        border-radius: 0.2rem;
    }
</style>
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Add Frame Material</h3>
                    <div class="backbtn">
                        <a href="{{ url('admin/productsetting') }}" class="btn btn-success text-center" value="Back">Back</a>
                    </div>
                </div>
                <div class="go-line"></div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div id="response"></div>
                        <form method="POST" action="" id="material_add" class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Frame Material Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" id="" name="name" placeholder="Frame Material Name" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Frame Material</button>
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
    $("#material_add").on("submit", function(e){
        e.preventDefault();
        let url = "{{url('/admin/frame_material/insert')}}";
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
                            window.location = "{{url('admin/frame_material/create')}}";
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