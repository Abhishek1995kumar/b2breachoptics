@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/pagesettings') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add Product Baner</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response"></div>
                        <form id="loginForm" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Images<span class="required">*</span>
                                    <p class="small-label">(Preferred Size : 1200px * 400px)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="col-md-7 col-xs-12" name="pro_baner" accept="" required="required" type="file">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    <small class="big-label">Banner Link *</small>
                                    <small>(Any Url Address)</small>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="col-md-7 col-xs-12 form-control" name="pro_baner_url" accept="" type="url" />
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="cat_name" id="">
                                        <option value="">Select Main Category</option>
                                        <option value="53">Frames</option>
                                        <option value="58">Lenses</option>
                                        <option value="63">Sunglasses</option>
                                        <option value="72">Contact Lenses</option>
                                        <option value="82">Premium Brands</option>
                                        <option value="87">Contact Lens Solutions</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Product Baner</button>
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

@section('footer')

@stop
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('#loginForm').submit(function(e){
        var formData = new FormData(this);
        e.preventDefault();
            $.ajax({
                url: "{{url('/admin/product_baner/save')}}",
                method:'POST',
                data : formData,
                processData: false,
                contentType: false,
                cache : false,
                dataType: 'JSON',
                beforeSend: function() 
                {
                    $('#Before_send').css("display", "block");
                    $('#submit_btn').hide();
                },
                complete: function() 
                {
                    $('#Before_send').css("display", "none");
                    $('#submit_btn').show();
                },
                success:function(resp){
                   if(resp.status == '404')
                   {
                    Swal.fire({
                          icon: 'error',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        }).then((result) => {
                            location.reload(true);
                        })
                   }else{
                    Swal.fire({
                          icon: 'success',
                          text: resp.msg,
                          background: "#151614d4",
                          color:"white",
                        }).then((result) => {
                            window.location = "{{url('admin/pagesettings')}}";
                        })
                   }
                },
            });
	}); 
});
</script>
