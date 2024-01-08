@extends('admin.includes.master-admin')
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
                    <a href="{!! url('admin/report_attr') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <h3>Return Report</h3>
                <div class="go-line"></div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <div class="card-body padding-bottom-0">
                            <form method="post" onsubmit="submitReturnOrder(event)" id="return_report_list" >
                                <div class="form-group row">
                                    <div class="col-sm-3" class="datepicker" id="datepicker">
                                        <label class="col-form-label" for="">From Date</label>
                                        <input id="fromdate" name="from_date" type="text" class="form-control" placeholder="Select From Date">
                                    </div>

                                    <div class="col-sm-3" class="datepicker datepickertwo" id="datepickertwo">
                                        <label class="col-form-label" for="">To Date</label>
                                        <input name="to_date" id="todate" class="form-control" type="text" placeholder="Select To Date" />
                                    </div>

                                    <div class="col-sm-3" id="cateMainid">
                                        <label class="col-form-label" for="">Category</label>
                                        <select class="form-control js-select2" name="mainid" id="category_name" >
                                            <option disabled selected value>Select Category</option>
                                            <option value="all">all</option>
                                            @foreach($category as $cname)
                                                <option value="{{ $cname->name }}">{{ $cname->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-3 " id="buyerName">
                                        <label class="col-form-label" for="">Buyer Name</label>
                                        <select class="form-control js-select2" name="buyer_name" id="buyer_name" placeholder="Select Buyer Name" >
                                            <option  disabled selected value>Select Buyer Name</option>
                                            <option value="all">all</option>
                                            @foreach($buyer_name as $bname)
                                                <option value="{{ $bname->buyer_name }}">{{ $bname->buyer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="ownerName">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="">Owner</label>
                                        <select name="owner_name" onchange="select_owner_name(event)" id="owner_name" class="form-control js-select2" placeholder="Select Owner Name" >
                                            <option selected disabled value>-- select owner name --</option>
                                            <option value="all">all</option>
                                            @foreach($owner_name as $name)
                                                <option value="{{ $name->owner }}">{{ $name->owner }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3" id="vendor_details" hidden>
                                        <label class="col-form-label" for="">Vendor Name</label>
                                        <select class="form-control" name="select_vendor_name" id="select_vendor_name" >
                                            <option disabled selected>Select Vendor Name</option>
                                            <option value="all">all</option>
                                            @foreach($vendor_name as $vname)
                                                <option value="{{ $vname->businessname }}">{{ $vname->businessname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="col-sm-1 ">
                                        <button type="submit" id="submit" class=" btn btn-primary add-button-style"  style="margin-top:0.2rem;">Submit</button>
                                    </div>
                                    
                                    <div class="col-sm-1 exportButton">
                                        <input type="button" onclick="export_return_details()" style="margin-top:0.2rem;" class="btn btn-success add-button-style" value="Export">
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
                                                <!-- <th>Tracking</th> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.min.js" integrity="sha512-WaHZ16+n6qSSVxDii8MZGmFlnro3iZdJa/hb1XKraoMx1/HVILhLdAX22ypk4lT/8+t4XMYcjzCDwfvZ1CAJgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".js-select2").select2();
    
    $('#returnTableData').css('display', 'none');
    $('.exportButton').css('display', 'none');

    function select_owner_name(e){
        if(e.target.value == "vendor" || e.target.value == "all"){
            $("#vendor_details").show();
        }else if(e.target.value == "admin"){
            $("#vendor_details").hide();
        }
    }

    // date picker
    let current = new Date();
    let tomorrow = new Date(current.getTime() + 86400000); 
    tomorrow.toLocaleDateString();
    const startpicker = new Litepicker({
        element: document.getElementById('fromdate'),
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
            return totalDays - 1;
        },
        plugins: ['mobilefriendly']
    });
    const endpicker = new Litepicker({
        element: document.getElementById('todate'),
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
            return totalDays - 1;
        },
    });

    function submitReturnOrder(e){
        e.preventDefault();
        const loader = `<div id="preloader"> 
                            <div id="loader-img">
                                <div class="loading">
                                    <div class="loading__letter">R</div>
                                    <div class="loading__letter">E</div>
                                    <div class="loading__letter">A</div>
                                    <div class="loading__letter">C</div>
                                    <div class="loading__letter">H</div>
                                </div>
                            </div>
                        </div>`;
        
        let fromDate = $("#return_report_list [name=from_date]").val();
        let toDate = $("#return_report_list [name=to_date]").val();
        let mainCategory = $("#return_report_list [name=mainid]").val();
        let buyerName = $("#return_report_list [name=buyer_name]").val();
        let ownerName = $("#return_report_list [name=owner_name]").val();
        let vendorName = $("#return_report_list [name=select_vendor_name]").val();
        
        let returnOrderDetails = {
            fromDate : fromDate,
            toDate : toDate,
            mainCategory : mainCategory,
            buyerName : buyerName,
            ownerName : ownerName,
            vendorName : vendorName
        };
        // if(!fromDate || !toDate || !mainCategory || !buyerName || !ownerName && vendorName!=""){
        if(!fromDate || !toDate || !mainCategory || !buyerName || !ownerName ){
            let data = [];
            data[0] = document.getElementById("fromdate");
            data[1] = document.getElementById("todate");
            data[2] = document.getElementById("category_name");
            data[3] = document.getElementById("buyer_name");
            data[4] = document.getElementById("owner_name");
            data[5] = document.getElementById("select_vendor_name");
            for(let x=0; x<data.length; x++){
                if(data[x].value == ""){
                    Swal.fire({
                        title: "Please Enter " + data[x].id,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    });
                    return false;
                }
            }
            return;
        }
        
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
            language : {
                processing : loader,
            },
            responsive: true,
            colReorder: true,
            ajax: {
                url : "{{ url('/admin/getReturnOrderDetails') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    returnOrderDetails : returnOrderDetails,
                    "_token" : "{{ csrf_token() }}"
                },
            }
        });
       
    };

    function export_return_details(){
        console.log("export_return_details");
        let fromDate     = $("#return_report_list [name=from_date]").val();
        let toDate       = $("#return_report_list [name=to_date]").val();
        let mainCategory = $("#return_report_list [name=mainid]").val();
        let buyerName    = $("#return_report_list [name=buyer_name]").val();
        let ownerName    = $("#return_report_list [name=owner_name]").val();
        let vendorName   = $("#return_report_list [name=select_vendor_name]").val();
        const url = "{{ url('/admin/getExportExcel') }}";
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : url,
            data : {
                data : {
                    fromDate      : fromDate,  
                    toDate        : toDate,   
                    mainCategory  : mainCategory,
                    buyerName     : buyerName,
                    ownerName     : ownerName,
                    vendorName    : vendorName,
                },
                "_token" : "{{ csrf_token() }}",
            },
            success : function(resp){
                let table = document.createElement("table");
                let thead = document.createElement("thead");
                let tbody = document.createElement("tbody");
                table.setAttribute('id', 'return_order_details');
                let thead_tr = $('.returnTr').clone();
                thead.append(thead_tr[0]);
                table.append(thead);
                for(let x=0; x<resp.length; x++){
                    let tr = document.createElement("tr");
                    tr.setAttribute('id', 'bodyTr_'+(x+1));
                    for(let key in resp[x]){
                        let td = document.createElement("td");
                        $(td).text(resp[x][key] ? resp[x][key] : " -- ");
                        tr.append(td);
                    }
                    tbody.append(tr);
                }
                table.append(tbody);
                if(resp.length > 0){
                    table.append(tbody)
                    var data = table;
                    var returnDetails = XLSX.utils.table_to_book(data, {sheet: 'returnOrder'});
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