@extends('vendor.includes.master-vendor')

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
                    <h3> Vendor List</h3>
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
                                                @foreach($Accept as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
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
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('vendor/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Intransit as $row)
                                                    <tr>
                                                        <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
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
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('vendor/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
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
                                                        <td class="text-center" style="font-size: 15px;">{{$row->order_number_new}}</td>
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
                                                        <td class="text-center" style="font-size: 15px;"><a href="{{url('vendor/return/order/view/')}}/{{$row->id}}"><i class="fa fa-eye" style="font-size:15px"></i></a></td>
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




@stop

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
