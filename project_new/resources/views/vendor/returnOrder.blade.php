@extends('vendor.includes.master-vendor')
<link href="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/css/litepicker.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

<style>
    .select2.select2-container .select2-selection {
        border: 1px solid #ccc;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        height: 34px;
        margin-bottom: 1px;
        outline: none;
        transition: all .15s ease-in-out;
    }
    .select2.select2-container .select2-selection .select2-selection__rendered{
        color: #333;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2-container .select2-dropdown{
        background: transparent;
        border: none;
        margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search{
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul{
        background: #fff;
        border: 1px solid #34495e;
    }
</style>
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <div class="go-title">
                <div class="pull-right">
                    <a href="{!! url('vendor/vendor_report') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i>
                        Back</a>
                </div>
                <h3>Return Report</h3>
                <div class="go-line"></div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <div class="card-body padding-bottom-0">
                            <form method="post" id="return_order_form" onsubmit="VendorReturnOrder(event)">
                                {{ csrf_field() }}
                                <div class="form-group row col-sm-12">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <label class="col-form-label" for="">From Date </label>
                                        <small><input type="text" id="from_date" name="from_date" class="form-control fa fa-calendar" placeholder="Select From Date"><i class="fa fa-calendar" style="margin-left: -2rem;"></i></small>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <label class="col-form-label" for="">To Date </label> 
                                        <small><input type="text" id="to_date" name="to_date" class="form-control fa fa-calendar" placeholder="Select To Date"><i class="fa fa-calendar" style="margin-left: -2rem;"></i></small>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <label class="col-form-label" for="">Category</label>
                                        <select id="category" name="category" class="form-control selectData" placeholder="Select Category">
                                            <option disabled selected value="">Select Category</option>
                                            <option value="all">All</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <label class="col-form-label" for="">Buyer Name</label>
                                        <select id="buyer_name" name="buyer_name" class="form-control selectData" placeholder="Select Buyer Name">
                                            <option disabled selected value=""> Select Buyer Name </option>
                                            <option value="all">All</option>
                                            @foreach ($buyer_name as $buyer)
                                                <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="form-group col-sm-12">
                                    <div class="col-sm-2 align-text-bottom">
                                        <input type="submit" id="return_order_submit" class="btn btn-primary add-button-style">
                                    </div>
                                    
                                    <div class="col-sm-1 exportButton">
                                        <input type="button" onclick="export_return_details(event)" style="margin-top:0.2rem;" class="btn btn-success add-button-style" value="Export">
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                        <div id="returnTableData">
                            <div class="col-md-12" id="returnReport">
                                <div class="table-responsive">
                                    <table id="return_order_details" class="table table-bordered zero-configuration" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: linear-gradient(to top right, pink, brown); border:2px solid linear-gradient(to top right, pink, brown);">
                                            <tr class="text-center returnTr">
                                                <th>Order Id</th>
                                                <th>Category</th>
                                                <th>Owner</th>
                                                <th>Order Date</th>
                                                <th>Payment Method</th>
                                                <th>Order Return Date</th>
                                                <th>Order Return Reason</th>
                                                <th>Return Status</th>
                                                <th>Return Complete Date</th>
                                                <th>Quantity</th>
                                                <th>Cost Price</th>
                                                <th>Product Name</th>
                                                <th>Product SkU</th>
                                                <th>Model No.</th>
                                                <th>MRP</th>
                                                <th>Seller Name</th>
                                                <th>Seller GST</th>
                                                <th>Buyer Name</th>
                                                <th>Buyer GST</th>
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

<script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.min.js" integrity="sha512-WaHZ16+n6qSSVxDii8MZGmFlnro3iZdJa/hb1XKraoMx1/HVILhLdAX22ypk4lT/8+t4XMYcjzCDwfvZ1CAJgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(".selectData").select2();
    
    $('#returnTableData').css('display', 'none');
    $('.exportButton').css('display', 'none');
    
    let current = new Date();
    let tomorrow = new Date(current.getTime() + 86400000); 
    tomorrow.toLocaleDateString();
    const startpicker = new Litepicker({
        element: document.getElementById('from_date'),
        singleMode: true,
        allowRepick: true,
        autoRefresh: true,
        format: 'YYYY-MM-DD',
        numberOfMonths: 1,
        numberOfColumns: 1,
        tooltipText: {
            one: 'night',
            other: 'nights'
        },
        tooltipNumber: (totalDays) => {
            return totalDays;
        },
        plugins: ['mobilefriendly']
    });
    const endpicker = new Litepicker({
        element: document.getElementById('to_date'),
        singleMode: true,
        allowRepick: true,
        autoRefresh: true,
        format: 'YYYY-MM-DD',
        numberOfMonths: 1,
        numberOfColumns: 1,
        tooltipText: {
            one: 'night',
            other: 'nights'
        },
        tooltipNumber: (totalDays) => {
            return totalDays;
        },
    });

    function VendorReturnOrder(e){
        e.preventDefault();
        let fromDate = $("#return_order_form [name=from_date]").val();
        let toDate = $("#return_order_form [name=to_date]").val();
        let category_name = $("#return_order_form [name=category]").val();
        let buyer = $("#return_order_form [name=buyer_name]").val();
        let data = { fromDate : fromDate, toDate : toDate, category_name : category_name, buyer : buyer };
        
        if(!fromDate || !toDate || !category_name || !buyer){
            let fieldValidation = [];
            fieldValidation[3] = document.getElementById("from_date");
            fieldValidation[2] = document.getElementById("to_date");
            fieldValidation[1] = document.getElementById("category");
            fieldValidation[0] = document.getElementById("buyer_name");
            for(let x=0; fieldValidation.length>x; x++){
                if(fieldValidation[x].value == ""){
                    Swal.fire({
                        title: "Please Enter " + fieldValidation[x].id,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    });
                }
            }
            return;
        };
        
        $('#returnTableData').css('display', 'block');
        $('.exportButton').css('display', 'block');
        
        $("#return_order_details").DataTable({
            dom: "lfrtip",
            fixedHeader: true,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            bDestroy: true,
            scrollX: true,
            responsive: true,
            colReorder: true,
            ajax : {
                url : "{{ url('/vendor/return_order_data_from_database') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    data : data,
                    "_token" : "{{ csrf_token() }}"
                },
            }
        });
    }

    function export_return_details(e){
        let fromDate = $("#return_order_form [name=from_date]").val();
        let toDate = $("#return_order_form [name=to_date]").val();
        let category_name = $("#return_order_form [name=category]").val();
        let buyer_name = $("#return_order_form [name=buyer_name]").val();

        let data = {
            fromDate : fromDate,
            toDate : toDate,
            category_name : category_name,
            buyer_name : buyer_name,
        };
        
        const url = "{{ url('/vendor/export_return_order_data') }}"
        $.ajax({
            type : "POST",
            url : url,
            data : {
                data : data,
                "_token" : "{{ csrf_token() }}",
            },
            
            success : function(resp){
                let table = document.createElement("table");
                let thead = document.createElement("thead");
                let tbody = document.createElement("tbody");
                
                table.setAttribute("id","vendor_table");
                thead.setAttribute("id","vendor_thead");
                tbody.setAttribute("id","vendor_tbody");
                
                let thead_tr = $('.returnTr').clone();
                thead.append(thead_tr[0]);
                table.append(thead);
                for(let x=0; resp.length>x; x++){
                    let tr = document.createElement("tr");
                    for(let key in resp[x]){
                        let td = document.createElement("td");
                        $(td).text(resp[x][key] ? resp[x][key] : " -- ");
                        tr.append(td);
                    }
                    tbody.append(tr);
                }
                table.append(thead);
                if(resp.length > 0){ // resp.length==0 par header print hoga iss liye resp.length>0 kiya hai
                    table.append(tbody)
                    let data = table;
                    let returnDetails = XLSX.utils.table_to_book(data, {sheet: 'returnOrder'});
                    XLSX.write(returnDetails, {
                        bookType: 'xlsx',
                        type: 'base64'
                    });
                    XLSX.writeFile(returnDetails, 'returnOrder.xls');
                } else {
                    Swal.fire({
                        title: `Product Not Found In Records`,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    })
                }
            }
        })
    }

</script>
@stop
@section('footer')
@stop













