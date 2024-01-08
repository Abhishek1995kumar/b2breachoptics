@extends('admin.includes.master-admin')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <!-- Page Heading -->
            <div class="go-title">
                <h3>Role Manage</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
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
                                        <p class="lead">ADD NEW ROLE</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div  class="col-sm-6">
                                        <form action="{{route('role.store')}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><h4>Role</h4></label>
                                                <input type="text" class="form-control" name="role" id="rolemanage" aria-describedby="emailHelp" placeholder="Enter role">
                                                <small id="emailHelp" class="form-text text-muted">Define Role by which handle admin panel.</small>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                            </div>
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

@stop

@section('footer')

@stop