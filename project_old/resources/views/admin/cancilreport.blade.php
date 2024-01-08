@extends('admin.includes.master-admin')

<style>
    /* .dataTables_length {
        display: none;      
    } */
    .swal2-popup .swal2-actions .swal2-confirm {
        font-size: 0.5rem;
    }

    .swal2-popup .swal2-title {
        font-size: 20px;
    }

    .theadrow {
        font-size: 16px;
    }

    .tbody {
        font-size: 14px;
        text-align: center;
    }
</style>
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/report_attr') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <h3>Report</h3>
                    <div class="go-line"></div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="gocover"></div>
                            <div id="response"></div>
                            <div class="card-body padding-bottom-0">
                                <form method="post" id="cancil_list">
                                    {{ csrf_field() }}
                                    <div class="form-group row col-sm-12">
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">From Date </label>
                                            <input type="date" id="from_date" name="from_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">To Date </label>
                                            <input type="date" id="to_date" name="to_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">Category</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">Select Category</option>
                                                <option value="all">All</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">Buyer Name</label>
                                            <select class="form-control" id="buyer_name" name="buyer_name" required>
                                                <option value="all">All</option>
                                                @foreach ($buyers as $buyer)
                                                    <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">Vendor Name</label>
                                            <select type="text" class="form-control" id="vendor_name" name="vendor_name"
                                                required>
                                                <option value="all">All</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->name }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                            <label class="col-form-label" for="">Seller Type</label>
                                            <select type="text" class="form-control" id="owner" name="owner"
                                                required>
                                                <option value="all">All</option>
                                                <option value="admin">Admin</option>
                                                <option value="vendor">Vendor</option>
                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="col-sm-2 align-text-bottom">
                                            <button type="submit" id="cancil_order" class="btn btn-primary add-button-style">Submit</button>
                                            <button type="button" class="btn btn-success cancil-excel" onclick="exportAllCancelExcel(event)"><i class="fa fa-download"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="cancilDiv">
                                <div class="col-md-12" id="gridReport">
                                    <div class="table-responsive">
                                        <table id="cancils_order" class="table table-bordered zero-configuration"
                                            cellspacing="0">
                                            <thead
                                                style="position: sticky; top: 0; background: linear-gradient(to top right, white, red); border:2px solid linear-gradient(to top right, white, red);">
                                                <tr class="text-center canceltheadrow">
                                                    <th>Sr.</th>
                                                    <th>Order ID</th>
                                                    <th>Order Date</th>
                                                    <th>Owner</th>
                                                    <th>Order Type</th>
                                                    <th>Product Name</th>
                                                    <th>SkU</th>
                                                    <th>Model No</th>
                                                    <th>Cancel Date /Time</th>
                                                    <th>Cancel Reason</th>
                                                    <th>Qty</th>
                                                    <th>MRP</th>
                                                    <th>Cost Price</th>
                                                    <th>Seller Name</th>
                                                    <th>Buyer Name</th>
                                                    <th>Cancel By</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/admin/cancelreport.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/admin/exportexcelreport.js') }}"></script>

@stop
@section('footer')
@stop