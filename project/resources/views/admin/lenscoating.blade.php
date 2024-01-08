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
    .input-group {
        width: 100%;
        position: relative;
        display: table;
        border-collapse: separate;
    }
</style>
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Add Lens Coating</h3>
                    <div class="backbtn">
                        <a href="{{ url('admin/productsetting') }}" class="btn btn-success text-center" value="Back">Back</a>
                    </div>
                </div>
                <div class="go-line"></div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div id="response"></div>
                        <form method="POST" action="" id="lens_coating_add" class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Lens Coating Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" id="" name="name" placeholder="Lens Coating Name" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Lens Coating</button>
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
    $("#lens_coating_add").on("submit", function(e){
        e.preventDefault();
        let url = "{{url('/admin/lens_coating/insert')}}";
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
                            title: 'Message!',
                            text: resp.msg,
                            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
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