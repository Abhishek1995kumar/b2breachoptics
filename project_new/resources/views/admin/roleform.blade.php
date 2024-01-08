@extends('admin.includes.master-admin')


@section('content')
<style>
    .swal2-container.swal2-center > .swal2-popup {
        font-size: 14px;
    }
</style>

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
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#role_admin" data-toggle="tab" aria-expanded="false"><strong>Role Amin List</strong></a>
                                <li><a href="#role" data-toggle="tab" aria-expanded="false"><strong>Role List</strong></a>
                                <li><a href="#permission" data-toggle="tab" aria-expanded="true"><strong>Permission List</strong></a>
                            </ul>
                        </div>
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div class="tab-pane active" id="role_admin">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right" style="margin-">
                                            <a href="{!! route('adminrole.create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New User</a>
                                        </div>
                                        <p class="lead">Admin User List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID#</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Actions</th>
                                                <th>Live Login</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($admins->isNotEmpty())
                                                @foreach($admins as $admin)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$admin->name}}</td>
                                                        <td>{{$admin->role}}</td>
                                                        <td>{{$admin->username}}</td>
                                                        <td>{{$admin->email}}</td>
                                                        <td>{{$admin->phone}}</td>
                                                        <td>
                                                            <a href="{!! url('admin/adminroledit') !!}/{{$admin->id}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> View </a>
                                                            @if($admin->status == '0')
                                                                <a href="{!! url('admin/managerole') !!}/status/{{$admin->id}}/1" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Deactive </a>
                                                            @else
                                                                <a href="{!! url('admin/managerole') !!}/status/{{$admin->id}}/0" class="btn btn-primary btn-xs"><i class="fa fa-universal-access"></i> Active </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($admin->login_status == '0' || $admin->login_status == '')
                                                                <span class="btn btn-warning btn-xs"><i class="fa fa-sign-out"></i> Logged Out </span>
                                                            @else
                                                                <span class="btn btn-primary btn-xs"><i class="fa fa-sign-in"></i> Logged In </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <h4>Record Not Found</h4>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="role">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right" style="margin-">
                                            <a href="{!! route('role.create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Role</a>
                                        </div>
                                        <p class="lead">Role List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID#</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($roles->isNotEmpty())
                                                @foreach($roles as $role)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$role->role}}</td>
                                                        <td>
                                                            <a href="{!! url('admin/roledit') !!}/{{$role->id}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit Role </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <h4>Record Not Found</h4>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="permission">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right" style="margin-">
                                        </div>
                                        <p class="lead">Permissions List</p>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <table id="example4" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID#</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($roles->isNotEmpty())
                                                @foreach($roles as $role)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$role->role}}</td>
                                                        <td>
                                                            <a href="{!! url('admin/permission/') !!}/{{$role->id}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit Permission </a>
                                                            {{-- <a href="{!! url('admin/permissiondelete') !!}/{{$role->id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <h4>Record Not Found</h4>
                                                    </td>
                                                </tr>
                                            @endif
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
</div>

@stop

@section('footer')

@stop