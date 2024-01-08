@extends('admin.includes.master-admin')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Categories</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="res">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.start -->
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <?php
                                    if(in_array('MC', explode(',', session()->get('role')['manage_category']))) {
                                ?>
                                    <li class="active"><a href="#brand" data-toggle="tab" aria-expanded="false"><strong>Brands</strong></a>
                                <?php
                                    }
                                ?>
                                
                                <?php
                                    if(in_array('SC', explode(',', session()->get('role')['manage_category']))) {
                                ?>
                                <li><a href="#material" data-toggle="tab" aria-expanded="true"><strong>Lens Materials</strong></a>
                                <?php
                                    }
                                ?>

                                <?php
                                    if(in_array('CC', explode(',', session()->get('role')['manage_category']))) {
                                ?>
                                <li><a href="#lenscolor" data-toggle="tab" aria-expanded="true"><strong>Lens Colors</strong></a>
                                </li>
                                <?php
                                    }
                                ?>

                                <?php
                                    if(in_array('CC', explode(',', session()->get('role')['manage_category']))) {
                                ?>
                                <li><a href="#contactlenscolor" data-toggle="tab" aria-expanded="true"><strong>Contact Lens Colors</strong></a>
                                </li>
                                <?php
                                    }
                                ?>
                               
                                <?php
                                    if(in_array('CC',explode(',',session()->get('role')['manage_category']))){
                                ?> 
                                 <li><a href="#shape" data-toggle="tab" aria-expanded="true"><strong>Shape</strong></a>
                                <?php       
                                    }
                                ?>
                                
                                <?php
                                    if(in_array('CC',explode(',',session()->get('role')['manage_category']))){
                                ?>
                                    <li><a href="#color" data-toggle="tab" aria-expanded="true"><strong>Color</strong></a>
                                <?php
                                    }
                                ?>
                                
                                <?php
                                    if(in_array('CC',explode(',',session()->get('role')['manage_category']))){
                                ?>
                                    <li><a href="#frame_material" data-toggle="tab" aria-expanded="true"><strong>Frame Material</strong></a>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="col-xs-12" style="padding: 0">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['mc'])) {
                                ?>
                                <div class="tab-pane active" id="brand">
                                    <div class="go-title">
                                        <div class="pull-right">
                                        
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['mc'])) {
                                            ?>
                                                <a href="{!! url('admin/brands/addbrand') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Brand</a>
                                            <?php
                                                } 
                                            ?>
                                        </div>
                                        <h3>Product Brand</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($brands as $category)
                                                    <tr>
                                                        <td>
                                                            {{$category->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/brands/delete/{{$category->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                        
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['sc'])) {
                                ?>
                                <div class="tab-pane" id="material">
                                    <div class="go-title">
                                        <div class="pull-right">
                                        
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['mc'])) {
                                            ?>
                                                <a href="{!! url('admin/material/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Material</a>
                                            <?php
                                                } 
                                            ?>
                                        </div>
                                        <h3>Materials</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example2" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($materials as $sub)
                                                    <tr>
                                                        <td>
                                                            {{$sub->name}}
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if(in_array('D', session()->get('role')['role_actions']['sc'])) {
                                                            ?>
                                                                <a href="javascript:;" data-href="{{url('/')}}/admin/material/delete/{{$sub->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                        
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['cc'])) {
                                ?>
                                <div class="tab-pane" id="lenscolor">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['cc'])) {
                                            ?>
                                                <a href="{!! url('admin/lenscolor/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Lens Color</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <h3>Lens Color</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example3" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lenscolors as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/color/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                        
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['cc'])) {
                                ?>
                                <div class="tab-pane" id="contactlenscolor">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['cc'])) {
                                            ?>
                                                <a href="{!! url('admin/contactlens/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Contact Color</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <h3>Contact Lens Color</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example4" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($contactcolors as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/contactlens/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                
                                <?php
                                    if(in_array('V',session()->get('role')['role_actions']['cc'])){
                                ?>
                                    <div class="tab-pane" id="shape">
                                        <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['cc'])) {
                                            ?>
                                                <a href="{!! url('admin/shape/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Shape</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <h3>Shape</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example5" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Shape Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($shape as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/shape/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                
                                <!--color -->
                                <?php
                                    if(in_array('V',session()->get('role')['role_actions']['cc'])){
                                ?>
                                    <div class="tab-pane" id="color">
                                        <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['cc'])) {
                                            ?>
                                                <a href="{!! url('admin/frame_color/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Color</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <h3>Frame Color</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example6" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Color Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($frame_color as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/frame_color/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                <?php
                                    } 
                                ?>
                                </div>
                               
                                <!--frame material -->
                                <?php
                                    if(in_array('V',session()->get('role')['role_actions']['cc'])){
                                ?>
                                    <div class="tab-pane" id="frame_material">
                                        <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['cc'])) {
                                            ?>
                                                <a href="{!! url('admin/frame_material/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Frame Material</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <h3>Frame Material</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example7" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Material Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($frame_material as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->name}}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/frame_material/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } 
                                ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.end -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this Category, Everything will be deleted under this Category.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')

    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@stop