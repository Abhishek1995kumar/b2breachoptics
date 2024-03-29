@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        
                        <a href="{!! url('admin/blog/') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add policy</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response"></div>
                        <form method="POST" action="{!! action('BlogController@storepolicy') !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Policy title<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="titles" placeholder="Enter policy Title" required="required" type="text">
                                </div>
                            </div>
                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Policy Details<span class="required">*</span>
                                    <!--<p class="small-label">(In Any Language)</p>-->
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea rows="10" class="form-control" name="details" id="content1" placeholder="Enter policy Contents"></textarea>

                                </div>
                            </div>
                            
                             <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Featured Image<span class="required">*</span>
                                 <p class="small-label">(Prefered ratio 16 : 9)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="file" accept="image/*" name="image">
                                </div>
                            </div>  -->
                           <!--  <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video
                                </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video" type="file" >
                                </div>
                            </div> -->
                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add New Policy Title</button>
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
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('content1');
        });
    </script>
@stop