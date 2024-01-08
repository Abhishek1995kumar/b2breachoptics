@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading --> 
                <div class="go-title">
                    {{--<div class="pull-right">--}}
                    {{--<a href="{!! url('admin/services/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Service</a>--}}
                    {{--</div>--}}
                    
                    <h3>Customers <a href="{{url('admin/customers/pending')}}" class="btn btn-primary"><strong>Pending Customers ({{\App\UserProfile::where('status', '0')->count()}})</strong></a> <a href="{{url('admin/customers')}}" class="btn btn-success"><strong>Active customers ({{\App\UserProfile::where('status', '1')->orwhere('status', '2')->count()}})</strong></a></h3>
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
                        <table class="table table-striped table-bordered" cellspacing="0" id="active_customer" width="100%">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th width="10%">Customer Email</th>
                                <th>Phone</th>
                                <th width="10%">Address</th>
                                <th>City</th>
                                <th>Cost Price Show</th>
                                <th>Select Project</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--@foreach($customers as $customer)-->
                            <!--    <tr>-->
                            <!--        <td>{{$customer->name}}</td>-->
                            <!--        <td>{{$customer->email}}</td>-->
                            <!--        <td>{{$customer->phone}}</td>-->
                            <!--        <td>{{$customer->address}}</td>-->
                                    
                            <!--        <td>{{$customer->city}}</td>-->
                                    
                            <!--          <td><select  id="cost-dropdown" class="form-control">-->
                            <!--           <option value="Yes"> Yes</option>-->
                            <!--           <option value="No"> No</option>-->
                                    
                            <!--        </select></td>-->
                            <!--         <td><select  id="country-dropdown" class="form-control"> <option value=""> Select Project</option>-->
                            <!--        @foreach ($newprojectdetails as $data)-->
                            <!--            <option value="{{$data->projectname}}">-->
                            <!--                {{$data->projectname}}-->
                            <!--            </option>-->
                            <!--        @endforeach-->
                                    
                            <!--        </select></td>-->
                            <!--        <td>-->
                            <!--            @if($customer->status == 1)-->
                            <!--                <button type="button" class="btn btn-success" style="outline:none; border: none;"><a href="{{url('admin/customer/reject')}}/{{$customer->id}}" style="text-decoration:none; color: #fff;">Active</a></button>-->
                            <!--            @elseif($customer->status == 2 )-->
                            <!--                <button type="button" class="btn btn-primary" style="outline:none; border: none;"><a href="{{url('admin/customer/accept')}}/{{$customer->id}}" style="text-decoration:none; color: #fff;">Inactive</a></button>-->
                            <!--            @endif-->
                            <!--        </td>-->

                            <!--        <td>-->
                            <!--            <form method="POST" action="{!! action('CustomerController@destroy',['id' => $customer->id]) !!}">-->
                            <!--                {{csrf_field()}}-->
                            <!--                <input type="hidden" name="_method" value="DELETE">-->
                            <!--                <a href="customers/{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>-->

                            <!--                <a href="customers/email/{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Send Email</a>-->
                                            <!--<button type="button" class="btn btn-success" onclick="submitProject({{$customer->id}}, event)">Submit</button>-->
                            <!--            </form>-->
                            <!--              <button type="button" class="btn btn-success" onclick="submitProject({{$customer->id}}, event)">Submit</button>-->
                            <!--        </td>-->
                            <!--    </tr>-->
                            <!--@endforeach-->
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
 <script type="text/javascript">
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    function submitProject(id, e){
        //  var cost = $("#cost-dropdown").val();
     var cost = $(e.target).parent().prev().prev().prev().children().val();
        url = "{{url('/admin/customers/create')}}";           

        $.ajax({
            type:'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
                cost:cost, 
                title: $(e.target).parent().prev().prev().children().val()
            },
            success:function(data){
                alert("Data Updated sucessfully");
                $('#active_customer').DataTable().ajax.reload();
            }
        });
    
    }
    
     function submitcostprice(id, e){
        let cost = $(e.target).siblings('select').val();
        console.log($(e.target).siblings('select').val());
        let url = "{{url('/admin/customers/savecostprice')}}";           

        $.ajax({
            type:'POST',
            url: url,
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
                cost:cost, 
                title: $(e.target).parent().prev().prev().children().val()
            },
            success:function(data){
                    alert("Data Updated sucessfully");
                $('#active_customer').DataTable().ajax.reload();
               
            }
        });
    
    }
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
  
</script>

@stop

@section('footer')

<script type="text/javascript">
    $(document).ready(function() {
        $('#active_customer').DataTable({
            dom: 'lfrtip',
            'fixedHeader': true,
            'processing': true,
            'serverSide': true,
            'bLengthChange': false,
            'bDestroy': true,
            'order': [[0, 'desc']],
            'language': {
                "processing": ` <div id='loader' style=''>
                                    <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                                        <defs>
                                            <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                                                <stop offset="0%" stop-color="#5ebd3e" />
                                                <stop offset="33%" stop-color="#ffb900" />
                                                <stop offset="67%" stop-color="#f78200" />
                                                <stop offset="100%" stop-color="#e23838" />
                                            </linearGradient>
                                            <linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                                                <stop offset="0%" stop-color="#e23838" />
                                                <stop offset="33%" stop-color="#973999" />
                                                <stop offset="67%" stop-color="#009cdf" />
                                                <stop offset="100%" stop-color="#5ebd3e" />
                                            </linearGradient>
                                        </defs>
                                        <g fill="none" stroke-linecap="round" stroke-width="16">
                                            <g class="ip__track" stroke="#ddd">
                                                <path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                                <path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                            </g>
                                            <g stroke-dasharray="180 656">
                                                <path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                                <path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>`
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // 'url': baseUrl+"/admin/customers/get_active_customer_details",
                'url': "{{url('/admin/customers/get_active_customer_details')}}",
                'type' : 'POST',
                'data': {
                    "_token": "{{ csrf_token() }}",
                },
            },
        });
    });

    function viewCustomer(id){
        var url = "{{url('/admin/customer/view')}}/"+id;
        window.location.href = url;
    }

    function sendMail(id){
        var url = "{{url('/admin/customers/email')}}/"+id;
        window.location.href = url;
    }

    // destroy Customer function -------------------------------------------
    // function removeCustomer(id){
    //     var url = "{{url('/admin/customer/destroy')}}";
    //     var url2 = "{{url('/admin/customers')}}";
    //     if(url){
    //         Swal.fire({
    //           title: 'Are You sure for delete?',
    //           showCancelButton: true,
    //           confirmButtonText: 'OK',
    //         }).then((result) => {
    //           /* Read more about isConfirmed, isDenied below */
    //             if (result.isConfirmed) {
    //                 deleteProductAjax(id, url);
    //             } else if (result.isDenied) {
    //                 window.location = url2;
    //             }
    //         })
    //     }
    // }
    
    // function deleteProductAjax(id, url){
    //     console.log(url);
    //     console.log(id);
    //     $.ajax({
    //         method: 'POST',
    //         url: url,
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             id: id,
    //         },
	// 		dataType: 'JSON',
	// 		success:function(resp) {
	// 			if(resp.status == 'success'){
	// 				$('#active_customer').DataTable().ajax.reload();
	// 			}
	// 		}
    //     });
    // }

    function acceptCustomer(id){
        url = "{{url('/admin/customer/accept')}}/"+id;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (data){
                if(data.response){
                    $('#active_customer').DataTable().ajax.reload();
                }
            }
        });
    }

    function rejectCustomer(id){
        url = "{{url('/admin/customer/reject')}}/"+id;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (data){
                console.log(data.response);
                if(data.response){
                    $('#active_customer').DataTable().ajax.reload();
                }
            }
        });
    }
</script>

@stop