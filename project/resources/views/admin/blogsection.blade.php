@extends('admin.includes.master-admin')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Blog Section</h3>
                    <div class="go-line"></div>
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
                                    if(in_array('BSC', explode(',', session()->get('role')['blog']))) {
                                ?>
                                <li class="active"><a href="#sectioncontent" data-toggle="tab" aria-expanded="false"><strong>Blog Section Content</strong></a>
                                <?php } ?>
                                <?php
                                    if(in_array('BST', explode(',', session()->get('role')['blog']))) {
                                ?>
                                <li><a href="#sectiontitle" data-toggle="tab" aria-expanded="true"><strong>Blog Section Title</strong></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if(in_array('POLI', explode(',', session()->get('role')['blog']))) {
                                ?>
                                <li><a href="#Policy" data-toggle="tab" aria-expanded="true"><strong>Policy</strong></a>
                                </li>
                                <?php } ?>
                                <?php
                                    if(in_array('OOFF', explode(',', session()->get('role')['blog']))) {
                                ?>
                                <li><a href="#OurOfferings" data-toggle="tab" aria-expanded="true"><strong>OurOfferings</strong></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="col-xs-12" style="padding: 0">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['bst'])) {
                                ?>
                                <div class="tab-pane" id="sectiontitle">
                                    <div class="go-title">
                                        <h3>Blog Section Title Text</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <form method="POST" action="blog/titles" class="form-horizontal form-label-left" id="website_form">
                                                {{csrf_field()}}
                                                <div class="item form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Blog Secttion Title <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12" name="blog_title" placeholder="Blog Title" required="required" type="text" value="{{$language->blog_title}}">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Blog Secttion Text <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <textarea rows="6" class="form-control" name="blog_text">{{$language->blog_text}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary btn-add">Update Text</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- pranali's code for blog policy section -->

                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['poli'])) {
                                ?>
                                <div class="tab-pane" id="Policy">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            @if($policycount == 3)
                                                <a disabled="disabled" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New policy</a>
                                            @else
                                                <?php
                                                    if(in_array('N', session()->get('role')['role_actions']['poli'])) {
                                                ?>
                                                    <a href="{!! url('admin/policy/add') !!}"  class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New policy</a>
                                                <?php
                                                    } 
                                                ?>
                                            @endif
                                             <!--  <a href= "{!! url('admin/policy/add') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add policy</a> --> 
                                        </div>
                                        <h3>Policy Section title</h3>
                                        <div class="go-line"></div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                <tr>
                                                   <!--  <th>Featured Image</th>
 -->                                                <th>Policy Title</th>
                                                    <th >Policy Details</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($policy as $s)
                                                    <tr>
                                                        <td>{{$s->titles}}</td>
                                                        <td>{{substr(strip_tags($s->details),0,100)}}</td>
                                                        <td> 
                                                            <form method="POST" action="{!! action('BlogController@policydestroy',['id' => $s->id]) !!}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <?php
                                                                    if(in_array('U', session()->get('role')['role_actions']['poli'])) {
                                                                ?>
                                                                    <a href="policy/{{$s->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                                <?php
                                                                    } 
                                                                ?>
                                                                <?php
                                                                    if(in_array('D', session()->get('role')['role_actions']['poli'])) {
                                                                ?>
                                                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                                                <?php
                                                                    } 
                                                                ?>
                                                            </form>
                                                        </td>
                                                       
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- End of Pranali's code for blog policy section -->
                                <!-- OurOfferings code start here -->

                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['poli'])) {
                                ?>
                                 <div class="tab-pane" id="OurOfferings">
                                    <div class="pull-right">
                                        <?php
                                            if(in_array('N', session()->get('role')['role_actions']['ooff'])) {
                                        ?>
                                            <a href="{!! url('admin/OurOfferings/add') !!}"  class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New OurOfferings</a>
                                        <?php
                                            } 
                                        ?>
                                    </div>
                                    <p class="lead">banner image</p>
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th width="35%">image</th>
                                                <th>titles</th> 
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($details as $banner)
                                            <tr>
                                                <td><img style="max-width: 250px;" src="{{url('assets/images/sliders')}}/{{$banner->image}}"></td>
                                                <td>{{$banner->titles}}</td>
                                           
                                                <td>
                                                            <form method="POST" action="{!! action('BlogController@OurOfferingsdestroy',['id' => $banner->id]) !!}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <?php
                                                                    if(in_array('D', session()->get('role')['role_actions']['ooff'])) {
                                                                ?>
                                                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                                                <?php
                                                                    } 
                                                                ?>
                                                            </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                                <!-- Our offerings code end here -->
                                
                                <?php
                                    if(in_array('V', session()->get('role')['role_actions']['bsc'])) {
                                ?>
                                <div class="tab-pane active" id="sectioncontent">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <?php
                                                if(in_array('N', session()->get('role')['role_actions']['bsc'])) {
                                            ?>
                                            <a href="{!! url('admin/blog/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Blog</a>
                                            <?php
                                                } 
                                            ?>
                                        </div>
                                        <h3>Blog Members</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                <tr>
                                                    <!-- <th>Featured Image</th> -->
                                                    <th>Blog Title</th>
                                                    <th width="15%">Blog Details</th>
                                                    <th width="15%">Video</th>
                                                    <th>Views</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($blogs as $blog)
                                                    <tr>
                                                        
                                                        <td>{{$blog->title}}</td>
                                                        <td>{{substr(strip_tags($blog->details),0,100)}}</td>
                                                        <td>
                                                        <video width= "width: 175px;" height="100px" controls="">
                                                            <source src="{{url('/assets/images/blog')}}/{{$blog->featured_image}}" id="adminvideo2" type="video/mp4">
                                                        </video>
                                                        <td>{{$blog->views}}</td>
                                                        <td>
                                                            <form method="POST" action="{!! action('BlogController@destroy',['id' => $blog->id]) !!}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <?php
                                                                    if(in_array('U', session()->get('role')['role_actions']['bsc'])) {
                                                                ?>
                                                                    <a href="blog/{{$blog->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                                <?php
                                                                    } 
                                                                ?>
                                
                                                                <?php
                                                                    if(in_array('D', session()->get('role')['role_actions']['bsc'])) {
                                                                ?>
                                                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                                                <?php
                                                                    } 
                                                                ?>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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

@stop

@section('footer')

@stop