@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <div class="pull-right">
                    <a href="{!! url('admin/customers') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <h3>Customers Pending</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
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
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th width="10%">Customer Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th width="10%">City</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->city}}</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="{{url('admin/customers')}}/{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>
                                        <a href="javascript:;" onclick="activeCustomer({{$customer->id}})" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</a>
                                        <!--<a href="{{url('admin/customer/reject')}}/{{$customer->id}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</a>-->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    function activeCustomer(id) {
        url = "{{ url('admin/customer/accept') }}/"+id;
        url2 = "{{ url('/admin/customers') }}"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(resp){
                if(resp.status == "success"){
                    Swal.fire({
                        title: 'Message!',
                        text: resp.msg,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url2;
                        }
                    });
                }
            }
        })
    }
</script>
@stop