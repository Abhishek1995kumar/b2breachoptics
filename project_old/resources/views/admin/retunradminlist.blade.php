@extends('admin.includes.master-admin')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style type="text/css">
	
	.demo {
  padding: 30px;
  min-height: 280px;
}


</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
             
               
                <!-- Page Heading -->
                <div class="go-title">
                    <h3> Admin List</h3>
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
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>

                         <div class="col-md-12">
                        
                          <div class="demo">
                            
                              <div role="tabpanel">

                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs nav-justified nav-tabs-dropdown" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Return Order</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">In Transit</a></li>
                                <li role="presentation"><a href="#pro" aria-controls="pro" role="tab" data-toggle="tab">Completed</a></li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">Reason</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Accept as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                        @if($row->vendorname == '')
                                                        <td class="text-center" style="font-size: 15px;">Reach</td>
                                                        @else
                                                        <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                        @endif
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('admin/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                        <td class="text-center" style="font-size: 15px;">
                                                            <!--<button class="btn btn-primary"><a href="{{url('return_order/'.$row->order_id)}}" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;">Create order</a></button>-->
                                                            <button class="btn btn-primary"><a href="{{url('/admin/returnorder/'.$row->id.'/intransit')}}" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;">Create order</a></button>
                                                            
                                                            @if($row->rtn_shipment_id != '')
                                                                <button class="btn btn-primary"><a class="Update" href="javascript:void(0); #my-modal" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;" onclick="set_val({{$row->id}});">Courier</a></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                        <th class="text-center" style="font-size: 12px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Intransit as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                         @if($row->vendorname == '')
                                                        <td class="text-center" style="font-size: 15px;">Reach</td>
                                                        @else
                                                        <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                        @endif
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('admin/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
                                                        <td class="text-center" style="font-size: 15px;">
                                                            <button class="btn btn-primary"><a href="{{url('/admin/returnorder/'.$row->id.'/completed')}}" style="font-size: 15px; width:100%; text-align:center; color:white; font-weight:600; text-decoration:none;">Confirmed</a></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="pro">
                                    <table class="table" id="tableone">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="font-size: 12px">Order Id</th>
                                                        <th class="text-center" style="font-size: 12px">Product</th>
                                                        <th class="text-center" style="font-size: 12px">SKU</th>
                                                        <th class="text-center" style="font-size: 12px">Date & Time</th>
                                                        <th class="text-center" style="font-size: 12px">Delivery Date</th>
                                                        <th class="text-center" style="font-size: 12px">Qty</th>
                                                        <th class="text-center" style="font-size: 12px">MRP</th>
                                                        <th class="text-center" style="font-size: 12px">Seller</th>
                                                        <th class="text-center" style="font-size: 12px">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Completed as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->orderid}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_title}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->product_sku}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->created_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->updated_at}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->quantity}}</td>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->cost}}</td>
                                                         @if($row->vendorname == '')
                                                        <td class="text-center" style="font-size: 15px;">Reach</td>
                                                        @else
                                                        <td class="text-center" style="font-size: 15px;">{{$row->vendorname}}</td>
                                                        @endif
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('admin/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>



@foreach ($Accept as $row)
<div id="MyPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
                <h4 class="modal-title">
                    Couriers
                </h4>
            </div>
            <form method="post" action="{!! action('TestController@return_courier_order',['id' => $row->orderid]) !!}">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="modal-body">
                    <select name="courier_id" style="width:50%;" id="courierid">
                        <option value='non'>Select an courior...</option>
                        <option value='1' name='courierData'>Blue Dart</option>
                        <option value='2' name='courierData'>FedEx</option>
                        <option value='7' name='courierData'>FEDEX PACKAGING</option>
                        <option value='8' name='courierData'>DHL Packet International</option>
                        <option value='10' name='courierData'>Delhivery</option>
                        <option value='12' name='courierData'>FedEx Surface 10 Kg</option>
                        <option value='14' name='courierData'>Ecom Express</option>
                        <option value='16' name='courierData'>Dotzot</option>
                        <option value='33' name='courierData'>Xpressbees</option>
                        <option value='35' name='courierData'>Aramex International</option>
                        <option value='37' name='courierData'>DHL PACKET PLUS INTERNATIONAL</option>
                        <option value='38' name='courierData'>DHL PARCEL INTERNATIONAL DIRECT</option>
                        <option value='39' name='courierData'>Delhivery Surface 5 Kgs</option>
                        <option value='40' name='courierData'>Gati Surface 5 Kg</option>
                        <option value='41' name='courierData'>FedEx Flat Rate</option>
                        <option value='42' name='courierData'>FedEx Surface 5 Kg</option>
                        <option value='43' name='courierData'>Delhivery Surfaceg</option>
                        <option value='44' name='courierData'>Delhivery Surface 2 Kgs</option>
                        <option value='45' name='courierData'>Ecom Express Reverse</option>
                        <option value='46' name='courierData'>Shadowfax Reverse</option>
                        <option value='48' name='courierData'>Ekart Logistics</option>
                        <option value='50' name='courierData'>Wow Express</option>
                        <option value='51' name='courierData'>Xpressbees Surface</option>
                        <option value='52' name='courierData'>RAPID DELIVERY</option>
                        <option value='53' name='courierData'>Gati Surface 1 Kg</option> 
                        <option value='54' name='courierData'>Ekart Logistics Surface</option>
                        <option value='55' name='courierData'>Blue Dart Surface</option>
                        <option value='56' name='courierData'>DHL Express International</option>
                        <option value='57' name='courierData'>Professional</option>
                        <option value='58' name='courierData'>Shadowfax Surface</option>
                        <option value='60' name='courierData'>Ecom Express ROS</option>
                        <option value='62' name='courierData'>FedEx Surface 1 Kg</option>
                        <option value='63' name='courierData'>Delhivery Flash</option>
                        <option value='68' name='courierData'>Delhivery Essential Surface</option>
                        <option value='80' name='courierData'>Delhivery Reverse QC</option>
                        <option value='95' name='courierData'>Shadowfax Local</option>
                        <option value='96' name='courierData'>Shadowfax Essential Surface</option>
                        <option value='97' name='courierData'>Dunzo Local</option>
                        <option value='99' name='courierData'>Ecom Express ROS Reverse</option>
                        <option value='100' name='courierData'>Delhivery Surface 10 Kgs</option>
                        <option value='101' name='courierData'>Delhivery Surface 20 Kgs</option>
                        <option value='102' name='courierData'>Delhivery Essential Surface 5Kg</option>
                        <option value='103' name='courierData'>Xpressbees Essential Surface</option>
                        <option value='104' name='courierData'>Delhivery Essential Surface 2Kg</option>
                        <option value='106' name='courierData'>Wefast Local</option>
                        <option value='107' name='courierData'>Wefast Local 5 Kg</option>
                        <option value='108' name='courierData'>Ecom Express Essential</option>
                        <option value='109' name='courierData'>Ecom Express ROS Essential</option>
                        <option value='110' name='courierData'>Delhivery Essential</option>
                        <option value='111' name='courierData'>Delhivery Non Essential</option>
                    </select>
                </div>
                <div class="modal-footer" style="float:left; color:primary;">
                    <button type="submit" id="btn_save" class="btn btn-success" onclick="call_submit()">save</button>
                    <!--<a href="{{url('/check_return_courier/'.$row->order_id)}}" onclick="call_submit()">Submit</a>-->
                </div>
                <div class="modal-footer">
                    <input type="button" id="btnClosePopup" value="Close" class="btn btn-danger" data-dismiss="modal">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@stop

<!--courier popup window start ------------------>

<script type="text/javascript">
    $(function () {
        $("a[class='Update']").click(function () {
            $("#MyPopup").modal("show");
            return false;
        });
    });
</script>

<script type="text/javascript">
    function call_submit() {
        var order_no = $("#order_val").val();
        var courier = $('#courier_id option:selected');
        var courier_id = courier.val();
        var courier_name = courier.text();

        
        // alert(courier_name);

        $.ajax({
            type: "post",
            url: "{{url('/return_courier/')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                courier_id:courier_id,
                courier_name:courier_name,
                order_no = order_no
            }
            success:function(data) {
                $('.alert').show();
                $('.alert').html(result.success);
            }
        });
    }
</script>

<!--courier popup window end------------------>

<script type="text/javascript">
	$('.nav-tabs-dropdown')
    .on("click", "li:not('.active') a", function(event) {  $(this).closest('ul').removeClass("open");
    })
    .on("click", "li.active a", function(event) {        $(this).closest('ul').toggleClass("open");
    });

</script>

<script type="text/javascript">
    
    $(document).ready(function() {
    $('table.table').DataTable();
} );

</script>	

@section('footer')
@stop
