@extends('admin.includes.master-admin')

<style>
    .theadrow {
        font-size: 16px;
    }
</style>

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading --> 
                <div class="go-title">
                    <h3>
                        Customers <a href="{{url('admin/customers/pending')}}" class="btn btn-primary"><strong>
                        Pending Customers ({{\App\UserProfile::where('status', '0')->count()}})</strong></a> <a href="{{url('admin/customers')}}" class="btn btn-success"><strong>
                        Active customers ({{\App\UserProfile::where('status', '1')->orwhere('status', '2')->count()}})</strong></a>
                        <button type="button" class="btn btn-success full-excel" onclick="customerexportAllExcel(event)"><i class="fa fa-download"></i></button>
                    </h3>
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
                        <table class="table table-bordered zero-configuration" cellspacing="0" id="active_customer">
                            <thead style="position: sticky; top: 0; background: linear-gradient(to top right, white, red); border:2px solid linear-gradient(to top right, white, red);">
                            <tr id="customer-tr-id" class="text-center theadrow">
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Alternate Phone NO</th>
                                <th width="10%">Customer Email</th>
                                <th width="10%">Address</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Zip</th>
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>IFSC Code</th>
                                <th>Bussiness Name</th>
                                <th>GST No</th>
                                <th>Cost Price Show</th>
                                <th>Select Project</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
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

@section('footer')
<script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/admin/customers.js')}}"></script>

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

<script type="text/javascript">
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
            success: function (resp){
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
                            $('#active_customer').DataTable().ajax.reload();
                        }
                    });
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
            success: function (resp){
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
                            $('#active_customer').DataTable().ajax.reload();
                        }
                    });
                }
            }
        });
    }
</script>

@stop