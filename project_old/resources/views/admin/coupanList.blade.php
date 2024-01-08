
@extends('admin.includes.master-admin')
<style>
    .search-engine{
        margin-top: 1rem;
        display: flex;
        justify-content: space-between;
    }
    #searchData{
        width: 20%;
        margin-left: 1rem;
    }
    .addbtn{
        margin-right: 1rem;
    }
</style>
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <h3>Coupan</h3>
                </div>
                <div class="panel panel-default">
                    <div class="search-engine">
                        <div class="col-lg-6">
                            <div class="col-lg-6">
                                <input type="file" class="form-control import" name="upload_file" id="upload_file" accept=".xls,.xlsx">
                            </div>
                            <div class="clo-lg-2">
                                <a href="javascript:void(0)" onclick="couponExcelUpload(event)" class="btn btn-success square" id="upload"><i class="ft-upload mr-1"></i>Upload</a>
                                <a href="javascript:void(0)" class="btn btn-primary">Sample Dawnload</a>
                            </div>
                        </div>
                        <input id="searchData" type="search" class="form-control" name="property" placeholder="Search">
                        <a href="{{ url('admin/coupan/addCoupan') }}"><button class="addbtn btn btn-success"><i class="fa fa-plus"></i> Add Coupan</button></a>
                    </div>
                    <div class="panel-body">
                        <div id="response">
                            <div class="error">
                                @if($errors->has('upload_file'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('upload_file') }}
                                    </div>
                                @endif
                            </div>
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <table class="table" id="MaterialTable">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Amount</th>
                                        <th>Coupan Code</th>
                                        <th>b2b Code</th>
                                        <th>Date</th>
                                        <th>Discount Type</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $loop_Id=1;
                                ?>
                                <tbody id="display_da" class="display_da">
                                    @foreach($data as $da)
                                        <tr class="tr-shadow" id="display_tr_{{$loop_Id++}}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $da->coupan_amount }}</td>
                                            <td>{{ $da->coupan_code }}</td>
                                            <td>{{ $da->b2b_code }}</td>
                                            <td>{{ $da->start_date }}</td>
                                            <td>
                                                @if($da->coupan_type == 'V')
                                                    <p>Value</p>
                                                @elseif($da->coupan_type == 'P')
                                                    <p>Percentage</p>
                                                @endif
                                            </td>
                                            <td>{{ $da->validity }}</td>
                                            <td>
                                                @if($da->status==1)
                                                    <a href="{{url('admin/coupan/status/0')}}/{{$da->id}}"><button style="outline: none;"  class="item btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="status" type="submit" class="btn showid bg-success"><i class="fa-regular fa-signal-bars text-success"></i> Active</button></a> 
                                                @elseif($da->status==0)
                                                    <a href="{{url('admin/coupan/status/1')}}/{{$da->id}}"><button style="outline: none;"  class="item btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="status" type="submit" class="btn showid"><i class="fa-sharp fa-regular fa-signal-slash text-danger"></i> Inactive</button></a> 
                                                @else
                                                    <a href="javascript:void(0)"><button  class="item" data-toggle="tooltip" data-placement="top" title="status" type="submit" class="btn showid"><i class="zmdi zmdi-status"></i></button></a> 
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{url('admin/coupan/editCoupan/')}}/{{$da->id}}" style="margin:0 0.2rem 0 0.2rem;"><button  class="item  btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                    <a href="javascript:void(0)" onclick="deleteCoupon({{$da->id}})"><button class="item btn btn-danger" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-trash"></i></button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" ></script>
    <script type="text/javascript" src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ URL::asset('assets/js/admin/coupon.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#searchData').on('keyup', function(){
                var searchm = $(this).val().toLowerCase();
                // alert(searchm);
                $('#display_da tr').filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchm)>-1);
                });
            });
        });

        
        $(document).ready(function () {
            $('#MaterialTable').DataTable({
				scrollX: false,
                "searching": false,
                pageLength : 5,
				dom: 'Blfrtip',
                "bInfo": false, // 
                "bLengthChange": false,   // 
                "bFilter": true,
                // "bAutoWidth": false 
                buttons: [
                   {    
                        show:'hide',
                        exportOptions: {
                            
                       }
                    }
                ],
                processing : true,
                order: [[0, 'desc']]
            });
        });

        function deleteCoupon(id)
        {
            let url = "{{url('admin/coupan/delete')}}/"+id;
            if(id)
            {
                Swal.fire({
                    title: `Courier Boy Name Not Defined...!`,
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed)
                    {
                        deleteCouponAjax(id, url)
                    }
                    else
                    {
                        console.log("hello not confirmed");
                    }
                });
            }
        }
    
        function deleteCouponAjax(id, url){
            console.log(url);
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                dataType: 'JSON',
                success:function(resp) {
                    if(resp.status == 'success'){
                        location.reload(true);
                    }
                }
            });
        }

    </script>

@endsection
