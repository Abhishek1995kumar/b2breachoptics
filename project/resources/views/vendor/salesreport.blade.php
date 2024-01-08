@extends('vendor.includes.master-vendor')

<style>
    /* .dataTables_length {
        display: none;
    } */
</style>
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('/vendor/vendor_report') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Report</h3>
                    <div class="go-line"></div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="gocover"></div>
                            <div id="response"></div>
                            <div class="card-body padding-bottom-0">
                                <form method="post" id="report_list" >
                                    {{csrf_field()}}
                                    <div class="form-group row col-sm-12">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">From Date</label>
                                            <input name="fdate" class="form-control" type="date">
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">To Date</label>
                                            <input name="tdate" class="form-control" type="date">
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">Category</label>
                                            <select class="form-control" name="mainid" required>
                                                <option value="">Select Category</option>
                                                <option value="all">All</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="">Buyer Name</label>
                                            <select type="text" class="form-control" name="buyer" required>
                                                <option value="all">All</option>
                                                @foreach($buyers as $buyer)
                                                    <option value="{{$buyer->name}}">{{$buyer->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="col-sm-2 align-text-bottom">
                                            <button type="submit" id="submit" class="btn btn-primary add-button-style" onclick="">Submit</button>
                                            <button type="button" class="btn btn-success full-excel" onclick="exportAllExcel(event)"><i class="fa fa-download"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                  
                            <div id="printDiv">
                                <div class="col-md-12" id="gridReport">
                                    <table id="sales_order" class="table table-bordered zero-configuration" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: linear-gradient(to top right, white, red); border:2px solid linear-gradient(to top right, white, red);">
                                        <tr class="text-center theadrow">
                                            <th>Sr.</th>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Invoice</th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Mobile</th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>STATE</th>
                                            <th>SKU</th>
                                            <th>Model</th>
                                            <th>QTY</th>
                                            <th>Category</th>
                                            <th>HSN</th>
                                            <th>Cost</th>
                                            <th>Discount</th>
                                            <th>SGST %</th>
                                            <th>CGST %</th>
                                            <th>IGST %</th>
                                            <th>GST Amount</th>
                                            <th>Sub Total</th>
                                            <th>Shipping Charge</th>
                                            <th>Grand Total</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ URL::asset('assets/js/vendor/report/serversite.js')}}"></script>

@stop
@section('footer')
@stop