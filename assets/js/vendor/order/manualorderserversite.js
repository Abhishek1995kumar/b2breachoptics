
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
                
var order_table_datatable, orderTableDataTableObject;
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
                    
    orderTableDataTableObject = {
        dom: 'lfrtip',
        'processing': true,
        "bDestroy": true,
        'serverSide': true,
        "bLengthChange": false,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        "createdRow": function(row, data, dataIndex) {
                $(row).attr("id", "sid"+data[1]);
        },
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_order_details",
            'method' : 'POST',
            'data': function(d) {
                d.category = $('#categoryValue').val();
            },
            beforeSend: function() 
            {
                $('#preloader').css("display", "block");
            },
            complete: function() 
            {
                $('#preloader').css("display", "none");
            },
        }
    };
    
    $(window).load(function() {
        order_table_datatable = $('#order_table').DataTable(orderTableDataTableObject);
    });

});
    
function orderTabClick(){
    $("#Section1").children().children('div').eq(1).html('');
    order_table_datatable = $('#order_table').DataTable(orderTableDataTableObject);
}

var total_order_datatable;
function totalOrderTabClick(){
    total_order_datatable = $('#total_order_table').DataTable({
        dom: 'lfrtip',
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_total_order_details",
            'method' : 'POST',
            'data': function(d) {
                d.category = $('#categoryValue').val();
            }
        }
    });
}

var order_process_datatable;
function orderProcess(){
    $("#Section1").children().children('div').eq(1).html('');
    $("#Section2").children().children('div').eq(1).html('');
    order_process_datatable = $('#order_process_table').DataTable({
        dom: 'lfrtip',
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        "createdRow": function(row, data, dataIndex) {
            $(row).attr("id", "cid"+data[1])
        },
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_order_process_details",
            'method' : 'POST',
        }
    });
}

var ready_for_pickup_datatable;
function readyForPickup(){
    $("#Section1").children().children('div').eq(1).html('');
    $("#Section2").children().children('div').eq(1).html('');
    $("#Section3").children().children('div').eq(1).html('');
    ready_for_pickup_datatable = $('#ready_for_pickup_table').DataTable({
        dom: 'lfrtip',
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_ready_for_pickup_details",
            'method' : 'POST',
        }
    });
}

var in_transit_datatable;
function inTransit(){
    $("#Section1").children().children('div').eq(1).html('');
    $("#Section2").children().children('div').eq(1).html('');
    $("#Section3").children().children('div').eq(1).html('');
    $("#Section4").children().children('div').eq(1).html('');
    in_transit_datatable = $('#in_transit_table').DataTable({
        dom: 'lfrtip',
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_in_transit_details",
            'method' : 'POST',
        }
    });
}

var delivered_datatable;
function deliveredTab(){
    $("#Section1").children().children('div').eq(1).html('');
    $("#Section2").children().children('div').eq(1).html('');
    $("#Section3").children().children('div').eq(1).html('');
    $("#Section4").children().children('div').eq(1).html('');
    $("#Section5").children().children('div').eq(1).html('');
    delivered_datatable = $('#delivered_table').DataTable({
        dom: 'lfrtip',
        'processing': true,
        'serverSide': true,
        "bLengthChange": false,
        "bDestroy": true,
        "language": {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            'url': baseUrl+"/vendor/manualorders/get_delivered_details",
            'method' : 'POST',
        }
    });
}
    

const fetch_order_details = (order_pro_id) => {
    return new Promise(function(resolve, reject) {
        
        $.ajax({
            url: baseUrl + "/vendor/manualorders/order_details_fetch",
            type:"POST",
            data:{
                _token:$("input[name=_token]").val(),
                order_pro_id: order_pro_id
            },
            success:function(response){
                if(response.status){
                    resolve(response.order_pro_details)
                }else{
                    alert(response.msg);
                    reject(err);
                }
            },
            error: function(err) {
                reject(err) // Reject the promise and go to catch()
            }
        });

    });

}

                    
function filterCategoryWise(e) {
    let category = $(e.target).val();
    $("#order_process_tab").find("li").each(function(index, element){
        if(element.classList.contains("active")){
            element.click();
        }
    });
}

// For click on eye button start --------------
async function checkEyesOrder(order_pro_id){
    $(".order_table_modal").html('');
    try {
        let result = await fetch_order_details(order_pro_id);
        result.length > 0 && order_product_modal_show(result, order_pro_id);
    } catch (error) {
        alert(error);
    }
}

const order_product_modal_show = (order_product_details_arr, order_pro_id) => {
    let order_product_details = order_product_details_arr[0];
    
    let url1 = baseUrl + '/assets/prescription/';
    let url2 = baseUrl + '/assets/images/product_attr/';
    let url3 = baseUrl + '/assets/images/products/';
    let first_row  = $(".parmeter_prescription").find(".modal-body .row:eq(0)");
    let second_row  = $(".parmeter_prescription").find(".modal-body .row:eq(1)");
    let third_row  = $(".parmeter_prescription").find(".modal-body .row:eq(2)");
    let four_row  = $(".parmeter_prescription").find(".modal-body .row:eq(3)");
   
    first_row.find(".col-md-2 input:eq(0)").val(order_product_details.a_size)
    first_row.find(".col-md-2 input:eq(1)").val(order_product_details.b_size)
    first_row.find(".col-md-2 input:eq(2)").val(order_product_details.dbl)
    first_row.find(".col-md-2 input:eq(3)").val(order_product_details.bvd)
    first_row.find(".col-md-2 input:eq(4)").val(order_product_details.r_ed)
    first_row.find(".col-md-2 input:eq(5)").val(order_product_details.l_ed)

    second_row.find(".col-md-3 input:eq(0)").val(order_product_details.r_fitting)
    second_row.find(".col-md-3 input:eq(1)").val(order_product_details.l_fitting)
    second_row.find(".col-md-3 input:eq(2)").val(order_product_details.r_dia)
    second_row.find(".col-md-3 input:eq(3)").val(order_product_details.l_dia)

    third_row.find(".col-md-3 input:eq(0)").val(order_product_details.shape_code)
    third_row.find(".col-md-3 input:eq(1)").val(order_product_details.pantascopic)
    third_row.find(".col-md-3 input:eq(2)").val(order_product_details.temple_size)
    third_row.find(".col-md-3 input:eq(3)").val(order_product_details.bow_angle)

    four_row.find(".col-md-4 input:eq(0)").val(order_product_details.frame_type)
    four_row.find(".col-md-4 input:eq(1)").val(order_product_details.network_distance)
    four_row.find(".col-md-2 input:eq(0)").val(order_product_details.frame_fit)
    four_row.find(".col-md-2 input:eq(1)").val(order_product_details.materials)
   
    let total = order_product_details.cost + 0 + $('.shipping_cost_value').val();
    let options = ` <div class="modal fade" id="${order_pro_id}_eye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Order Id: ${order_product_details.orderid}</b> </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <hr style="background-color: red;">
                                        <h5 class="text-left" style="padding-left: 10px;"><b>Buyer Details</b></h5>
                                        <div class="text-left col-md-6" style="padding-left: 10px;">
                                            <p> <b>Name:- </b> ${order_product_details.buyer_name}</p>
                                            <p> <b>Address:- </b>${order_product_details.buyer_address}</p>`;
                                            if(!order_product_details.cname){
                                                options +=  `<p> <b>City:- </b>${order_product_details.buyer_city}</p>`; 
                                            }
                                            else{
                                                options +=  `<p> <b>City:- </b>${order_product_details.cname}</p>`; 
                                            }
                                            
                                            if(!order_product_details.sname){
                                                options +=  `<p> <b>State:- </b>${order_product_details.buyer_state}</p>`; 
                                            }
                                            else{
                                                options +=  `<p> <b>State:- </b>${order_product_details.sname}</p>`; 
                                            }
                                options +=  `</div>
                                        <div class="container text-right col-md-6" style="padding-left: 10px;">`;
                                        if(order_product_details.categoryID == 58){
                                options +=  `<div>
                                                <a data-toggle="modal" data-target="#exampleModal" href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px' ></i></a>
                                            </div>`;
                                        }
                            options +=  `<table class="pres-table table-bordered" style="width:100%; outline: 3px;">
                                                <thead>`;
                                              
                                                    if(order_product_details.categoryID == 72){
                                                        if(order_product_details.presc_image === null){
                                                            if(order_product_details.lenstype == 'MultiFocal'){
                                                                options += `<tr>
                                                                                <th style="width:2%"scope="col"></th>
                                                                                <th style="width:2%"scope="col"><center>Add Power</center></th>
                                                                                <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                            </tr>`;
                                                            }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                options += `<tr>
                                                                                <th style="width:2%"scope="col"></th>
                                                                                <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                                <th style="width:2%"scope="col"><center>AXIS</center></th>
                                                                                <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                            </tr>`;
                                                            }else{
                                                                options += `<tr>
                                                                                <th style="width:2%"scope="col"></th>
                                                                                <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                                <th style="width:2%"scope="col"><center>BC</center></th>
                                                                                <th style="width:2%"scope="col"><center>DIA</center></th>
                                                                                <th style="width:2%"scope="col"><center>Qty</center></th>
                                                                            </tr>`;
                                                            }
                                                        }else{
                                                            options += `<tr>
                                                                        <th style="width:2%" scope="col"><center>IMAGE</center></th>
                                                                    </tr>`;
                                                                }
                                                    }else if(order_product_details.categoryID == 58){
                                                        if(order_product_details.Repd != null || order_product_details.Lepd != null){
                                                            options += `<tr>
                                                                        <th style="width:2%"scope="col"></th>
                                                                        <th style="width:2%"scope="col"><center>Power</center></th>
                                                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                        <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                        <th style="width:2%"scope="col"><center>AXIS</center></th>
                                                                        <th style="width:2%"scope="col"><center>PD</center></th>
                                                                    </tr>`;
                                                        }else{
                                                            options += `<tr>
                                                                        <th style="width:2%"scope="col"></th>
                                                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                                                        <th style="width:2%"scope="col"><center>CYL</center></th>
                                                                        <th style="width:2%"scope="col"><center>AXIS</center></th>
                                                                        <th style="width:2%"scope="col"><center>PD</center></th>
                                                                    </tr>`;
                                                        }
                                                    }
                                                    options += `</thead>
                                                <tbody>`;
                                                    if(order_product_details.categoryID == 72){
                                                        if(order_product_details.presc_image === null){
                                                            if(order_product_details.same_rx_both != null){
                                                                if(order_product_details.lenstype == 'MultiFocal'){
                                                                    options +=  `<tr>
                                                                                <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                <td><center>${order_product_details.rpower}</center></td>
                                                                                <td><center>${order_product_details.rsphere}</center></td>
                                                                                <td><center>${order_product_details.rbc}</center></td>
                                                                                <td><center>${order_product_details.rdia}</center></td>`;
                                                                        if(order_product_details.lefteyequantity != null){
                                                                            options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                        }else if(order_product_details.righeyequantity != null){
                                                                            options += `<td><center>${order_product_details.righeyequantity}</center></td>`;
                                                                        }else if(order_product_details.botheyequantity != null){
                                                                            options += `<td><center>${order_product_details.botheyequantity}</center></td>`;
                                                                        }
                                                                    options += `</tr>`;
                                                                }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                    options += `<tr>
                                                                                <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                <td><center>${order_product_details.rsphere}</center></td>
                                                                                <td><center>${order_product_details.rbc}</center></td>
                                                                                <td><center>${order_product_details.rdia}</center></td>
                                                                                <td><center>${order_product_details.rcyl}</center></td>
                                                                                <td><center>${order_product_details.Raxis}</center></td>`;
                                                                    if(order_product_details.lefteyequantity != null){
                                                                            console.log("hello left");
                                                                        options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                    }else if(order_product_details.righeyequantity != null){
                                                                            console.log("hello right");
                                                                        options += `<td><center>${order_product_details.righeyequantity}</center></td>`;
                                                                    }else if(order_product_details.botheyequantity != null){
                                                                            console.log("hello both");
                                                                        options += `<td><center>${order_product_details.botheyequantity}</center></td>`;
                                                                    }
                                                                    options += `</tr>`;
                                                                }else{
                                                                    options += `<tr>
                                                                                    <th style="width:4%; padding:5px;" scope="row">(OD & OS)</th>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>`;
                                                                    if(order_product_details.lefteyequantity != null){
                                                                        options += `<td><center>${order_product_details.lefteyequantity}</center></td>`;
                                                                    }else if(order_product_details.righeyequantity != null){
                                                                        options += `<td><center> ${order_product_details.righeyequantity} </center></td>`;
                                                                    }else if(order_product_details.botheyequantity != null){
                                                                        options += `<td><center> ${order_product_details.botheyequantity} </center></td>`;
                                                                    }else if(order_product_details.quantity){
                                                                        options += `<td><center> ${order_product_details.quantity} </center></td>`;
                                                                    }
                                                                    options += `</tr>`;
                                                                }
                                                            }else{
                                                                if(order_product_details.lenstype == 'MultiFocal'){
                                                                    options += `<tr>
                                                                                    <th style="width:2%" scope="row">Right(OD)</th>
                                                                                    <td><center>${order_product_details.rpower}</center></td>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>
                                                                                    <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Left(OS)</th>
                                                                                    <td><center>${order_product_details.Lpower}</center></td>
                                                                                    <td><center>${order_product_details.Lsphere}</center></td>
                                                                                    <td><center>${order_product_details.LBc}</center></td>
                                                                                    <td><center>${order_product_details.LDia}</center></td>
                                                                                    <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                </tr>`;
                                                                }else if(order_product_details.lenstype == 'toric and Astigmatism' || order_product_details.lenstype == 'toric & Astigmatism'){
                                                                    options += `<tr>
                                                                                    <th style="width:2%" scope="row">Right(OD)</th>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>
                                                                                    <td><center>${order_product_details.rcyl}</center></td>
                                                                                    <td><center>${order_product_details.Raxis}</center></td>
                                                                                    <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Left(OS)</th>
                                                                                    <td><center>${order_product_details.Lsphere}</center></td>
                                                                                    <td><center>${order_product_details.LBc}</center></td>
                                                                                    <td><center>${order_product_details.LDia}</center></td>
                                                                                    <td><center>${order_product_details.Lcyle}</center></td>
                                                                                    <td><center>${order_product_details.Laxis}</center></td>
                                                                                    <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                </tr>`;
                                                                }else{
                                                                    options += `<tr>
                                                                                    <th style="width:2%" scope="row">Right(OD)</th>
                                                                                    <td><center>${order_product_details.rsphere}</center></td>
                                                                                    <td><center>${order_product_details.rbc}</center></td>
                                                                                    <td><center>${order_product_details.rdia}</center></td>
                                                                                    <td><center>${order_product_details.righeyequantity}</center></td>
                                                                                </tr> 
                                                                                <tr>
                                                                                    <th scope="row">Left(OS)</th>
                                                                                    <td><center>${order_product_details.Lsphere}</center></td>
                                                                                    <td><center>${order_product_details.LBc}</center></td>
                                                                                    <td><center>${order_product_details.LDia}</center></td>
                                                                                    <td><center>${order_product_details.lefteyequantity}</center></td>
                                                                                </tr>`;
                                                                }
                                                            }
                                                        }else{
                                                options += `<tr>
                                                                <td>
                                                                    <center style="padding: 5px 5px;">
                                                                        <a  href="${url1}${order_product_details.presc_image}" target="_blank">
                                                                            <img src="${url1}+${order_product_details.presc_image}" alt="" alt="" width="150" height="100">
                                                                        </a></center>
                                                                </td>
                                                            </tr>`;
                                                        }
                                                    }else if(order_product_details.categoryID == 58){
                                                        if(order_product_details.Repd != null || order_product_details.Lepd != null){
                                                options +=     `<tr>
                                                                <th style="width:2%" scope="row">LE</th>
                                                                <td><center>${order_product_details.Lpower}</center></td>
                                                                <td><center>${order_product_details.Lsphere}</center></td>
                                                                <td><center>${order_product_details.Lcyle}</center></td>
                                                                <td><center>${order_product_details.Laxis}</center></td>
                                                                <td rowspan="2"><center>${order_product_details.totalPd}</center></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:2%" scope="row">RE</th>
                                                                <td><center>${order_product_details.rpower}</center></td>
                                                                <td><center>${order_product_details.rsphere}</center></td>
                                                                <td><center>${order_product_details.rcyl}</center></td>
                                                                <td><center>${order_product_details.Raxis}</center></td>
                                                            </tr>`;
                                                        }else{
                                                options += `<tr>
                                                                <th style="width:2%" scope="row">LE</th>
                                                                <td><center>${order_product_details.Lsphere}</center></td>
                                                                <td><center>${order_product_details.Lcyle}</center></td>
                                                                <td><center>${order_product_details.Laxis}</center></td>
                                                                <td><center>${order_product_details.Lepd}</center></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:2%" scope="row">RE</th>
                                                                <td><center>${order_product_details.rsphere}</center></td>
                                                                <td><center>${order_product_details.rcyl}</center></td>
                                                                <td><center>${order_product_details.Raxis}</center></td>
                                                                <td><center>${order_product_details.Repd}</center></td>
                                                            </tr>`;
                                                        }
                                                    }
                                                   
                                    options += `</tbody>
                                            </table>
                                        </div>
                                        <hr style="background-color: red;">
                                    </div>
                                    <div class="row">
                                    <div class="col-md-3">`;
                                    if(order_product_details.maincolor != order_product_details.color){
                                        options += `<img width="200px" height="200px" src="${url2}${order_product_details.product_image}" />`;
                                    }
                                    else{
                                        options += `<img width="200px" height="200px" src="${url3}${order_product_details.product_image}" />`;
                                    }
                                    options += `</div>
                                    <div class="col-md-3">
                                        <h5><b>Order Details:</b></h5>
                                        <p> <b>Product SKU:- </b> ${order_product_details.product_sku}</p>
                                        <p> <b>Order Id:-</b> ${order_product_details.orderid}</p>
                                        <p> <b>Product Name:-</b> ${order_product_details.product_title}</p>`;
                                        if(order_product_details.color){
                                            options += `<p> <b>Product Color:-</b> ${order_product_details.color} - ${order_product_details.colorcode != null ? order_product_details.colorcode : ''}</p>`;
                                        }
                                        if(order_product_details.size){
                                            options += `<p> <b>Product Size:-</b> ${order_product_details.size}</p>`;
                                        }
                                        if(order_product_details.order_note){
                                            options += `<p> <b>Order Note :-</b> ${order_product_details.order_note}</p>`;
                                        }
                            options += `</div>
                                    <div class="col-md-3">
                                            <h5><b>Order Summary:</b></h5>
                                            <p> <b>Order Date:-</b> ${order_product_details.created_at}</p>
                                            <p> <b>Dispatch Date:-</b> ${order_product_details.updated_at}</p>
                                            <p> <b>Deliver Date:-</b> ${order_product_details.created_at}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><b>Bill Details:</b></h5>
                                        <p> <b>Product QTY :-</b> ${order_product_details.quantity}</p>
                                        <p> <b>Unit Price :-</b> ${order_product_details.cost}</p>
                                        <p> <b>Gst Amount :-</b> ${order_product_details.gstAmount}</p>
                                        <p> <b>Coupon Discount :-</b> ${order_product_details.couponAmount != "" ? order_product_details.couponAmount : "0"}</p>
                                        <p> <b>Shipping Charges :- ${$('.shipping_cost_value').val()}</p>
                                        <hr>
                                        <p> <b>Total :-</b> ${Number(order_product_details.quantity * order_product_details.cost) + Number(order_product_details.gstAmount)} </p>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>`;

    $(".order_table_modal").append(options);
    $('#'+order_pro_id+'_eye').modal();
}
// End eye function -----------------------

// Print invoice Nemuber Button Start --------------
async function view_combine_order(order_pro_id,order_id, invoice, e)
{
    $(".combine_order_table_modal").html('');
    status = $(e.target.parentElement).attr('data-status');
    try {
        let result = await combine_order_details(order_pro_id, order_id, invoice, status);
        result.length > 0 && combine_order_modal_show(result, order_pro_id);
        
        let total_order_amt = 0;
         $("#invoice_table > tbody > tr").each(function(index, value){
             
             let total_amount = parseFloat($(this).find(':last-child').text());
             if(total_amount){
                 total_order_amt = total_order_amt + total_amount;
             }
         })
         $("#show_total").text((total_order_amt).toFixed(2));
    } catch (error) {
        Swal.fire({
          title: 'Message!',
          text: error,
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        })
    }
}

const combine_order_details = (order_pro_id, order_id, invoice, status) => {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: baseUrl+"/vendor/manualorders/combine_details_fetch",
            type:"POST",
            data:{
                _token:$("input[name=_token]").val(),
                order_pro_id: order_pro_id,
                order_id: order_id,
                invoice: invoice,
                status: status
            },
            success:function(response){
                if(response.status){
                    resolve(response.order_details)
                }else{
                    Swal.fire({
                      title: 'Message!',
                      text: response.msg,
                      imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                      imageWidth: 400,
                      imageHeight: 200,
                      confirmButtonText: 'OK',
                    })
                    reject(err);
                }
            },
            error: function(err) {
                reject(err) 
            }
        });
    });
}

const combine_order_modal_show = (combine_order_details_arr, order_pro_id) => {
    let logo = baseUrl + '/assets/images/new_invoice.png';
    let combine_order_details = combine_order_details_arr;
    let total = combine_order_details.cost + 5 + $('.shipping_cost_value').val();
    let options = `<div class="modal fade" id="${order_pro_id}_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="closeInvoice('${combine_order_details[0].status}')" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="print_invoice">
                    <div class="container" style="width: auto; width: auto;border: 1px solid black;padding: 0;padding-bottom: 20px;">
                        <div style="text-align: center;background-color: red;padding-top: 6px;padding-bottom: 8px;color: white;font-size: 17px; border-bottom: 1px solid black;">TAX INVOICE</div>
                            <div style="display:flex;border-bottom: 1px solid black;">
                                <div style="width: 50%; padding:15px;line-height: 22px;padding-top: 6%;">
                                    <div style="">Elrica Global Enterprises PVT LTD</div>
                                    <div style="">102 Vinayak Chember,Near Waman Hari Pethe, Naupada Road, Thane West. Pin-400602.</div>
                                    <div style=" "><h7 style="font-weight:550;">Phone:-</h7>7700044084</div>
                                    <div style=" "><h7 style="font-weight:550;">Email ID:-</h7>support@elricaglobal.in </div>
                                </div>
                                <div style="width: 67%; margin-left: 10%;line-height: 25px;border-left: 1px solid black;">
                                    <div style="border-bottom:1px solid black">
                                        <div style="display: flex;justify-content: center;">
                                            <img src="${logo}" style="padding-bottom: 6px; width:61%;">
                                        </div>
                                    </div>
                                    <div style="display: flex;">
                                        <div style="width: 50%; height: 50%;" class="inv_details">
                                            <div style="border-bottom: 1px solid black;text-align: center;border-right: 1px solid black;">
                                                <h7 style="font-weight:550;">Invoice No</h7>
                                            </div>
                                            <div style="border-bottom: 1px solid black;text-align: center;border-right: 1px solid black;">
                                                <h7 style="">${combine_order_details[0].invoice_number}</h7>
                                            </div>
                                        </div>
                                        <div style="width: 50%;height: 50%;" class="inv_details">
                                            <div style="border-bottom: 1px solid black;text-align: center;">
                                                <h7 style="font-weight:550;">Invoice Date</h7>
                                            </div>
                                            <div style="border-bottom: 1px solid black;text-align: center;">
                                                <h7 style="">${combine_order_details[0].order_accept_date.split(' ')[0]}</h7>
                                            </div>  
                                       </div>
                                    </div>    
                                    <div style="border-bottom: 1px solid black;display: flex;justify-content: center;padding-right: 45%;">
                                        <span><h7 style="font-weight:550;">Order Id:-</h7>   ${combine_order_details[0].orderid}</span>
                                    </div>
                                  
                                    <div style="display: flex;justify-content: center;padding-right: 0%;">
                                        <h7 style="font-size: 119%;font-weight: 700;">27AAFCE6495B1ZK</h7>
                                    </div>
                                    <div style="display: flex;justify-content: center;padding-right: 0%;">
                                       <h7 style="font-size: 13px;font-weight: 900;">(MAHARASHTRA)</h7>
                                    </div>      
                                </div>
                            </div>
                            <div style="display:flex;">
                                <div style="width: 50%; padding:15px;line-height: 16px;">
                                    <h5><b style="">Billing Address</b></h5>
                                    <div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>
                                    <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>
                                </div>
                                <div style="width: 54%; margin-left: 13px;padding:15px;line-height: 18px;border-left: 1px solid black;">
                                    <h5 style=""><b>Shipping Address</b></h5>`;
                                    
                                        if(combine_order_details[0].shipping_address != null)
                                            {
                                                options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].shipping_name}</div>`;
                                                
                                                options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_address}.${combine_order_details[0].shipping_address2 != null ? combine_order_details[0].shipping_address2 : ''}</div>`
                                                
                                                
                                                if(combine_order_details[0].shipping_city != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">City:-</h7>${combine_order_details[0].Ship_city}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">City:-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_state != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">State:-</h7>${combine_order_details[0].Ship_state}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">State:-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_zip != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].shipping_zip}</div>`
                                                }
                                                else
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Address:-</h7>NA</div>`
                                                }
                                                
                                                if(combine_order_details[0].shipping_phone != null)
                                                {
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].shipping_phone}</div>`
                                                }else{
                                                    options += `<div style=""><h7 style="font-weight:550;">Mobile No:-</h7>NA</div>`
                                                }
                                            }
                                            else
                                            {
                                            options += `<div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].bussiness_name}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2 != null ? combine_order_details[0].buyer_address2 : ''}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>`;
                                            }
                                        
                                    options += `<div style=""><h7 style="font-weight:550;">Email ID:-</h7>${combine_order_details[0].cus_email}</div>
                                </div>
                            </div>
                           
                            <div style="display:flex; overflow-y:auto;border-top:1px solid black;" >
                                <table  id="invoice_table" style="height:46px; width: 100%; border-collapse: collapse; border-style: solid;" border="1">
                                    <thead style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                        <tr style="background-color: red;color: white;text-align: center;">
                                            <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">SrNo</th>
                                            <th style="width: 40%;text-align: center; font-size: 9px;border-left: 1px solid black;">DESCRIPTION OF GOODS</th>
                                            <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">Model No</th>
                                            <th style="width: 8%;text-align: center; font-size: 9px;border-left: 1px solid black;">HSN Code</th>
                                            <th style="width: 8%;text-align: center; font-size: 9px;border-left: 1px solid black;">Color Code</th>
                                            <th style="width: 7%;text-align: center; font-size: 9px;border-left: 1px solid black;">Rate</th>
                                            <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">Qty</th>`
                                            if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state == "22"){
                                            options += `<th style="width: 6%;text-align: center;font-size: 8px;border-left: 1px solid black;">CGST%</th>
                                            <th style="width: 6%;text-align: center;font-size: 8px;border-right: 1px solid black;">SGST%</th>`;
                                            }else{
                                            options += `<th style="width: 6%;text-align: center; font-size: 8px;border-left: 1px solid black;border-right: 1px solid black;">IGST%</th>`;
                                            }
                                            options += `<th style="width: 7%;text-align: center; font-size: 8px;border-right: 1px solid black;">GST Amount</th>
                                            <th style="width: 28%;text-align: center; font-size: 8px;border-right: 1px solid black;">Total Amount(Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody border="0" class="invoice_list">`;
                                        for (let i=0; i <combine_order_details.length; i++ ){
                                        let id = i + 1;
                                        options += `<tr style="height:30px;border-bottom: 1px solid black;">
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${id}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].product_title}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].modelno}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].hsn_code}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].colorcode != null ? combine_order_details[i].colorcode : '--'}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].cost_price}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].quantity}</td>`
                                            if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state == 'maharashtra' || combine_order_details[0].buyer_state  == "22"){
                                              
                                                // options +=`<td style="text-align: center;font-size: 9px;">${combine_order_details[i].tax/2}</td>
                                                // <td style="text-align: center;font-size: 9px;">${combine_order_details[i].tax/2}</td>
                                                // <td style="text-align: center;font-size: 9px;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)}</td>
                                                // <td style="text-align: center;font-size: 9px;">
                                                // ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                //     combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)
                                                // }</td>`
                                                if(combine_order_details[i].categoryID == '63' || combine_order_details[i].categoryID == 63 || combine_order_details[i].categoryID == '53' || combine_order_details[i].categoryID == '72' || combine_order_details[i].categoryID == '58'){
                                                    options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                    ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                        combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax/100)).toFixed(2)
                                                    }</td>`
                                                }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                    options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                    ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                        combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)
                                                    }</td>`
                                                }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                    options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1/2}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                    ${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                        combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)
                                                    }</td>`
                                                }
                                            }else{
                                                if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Sunglasses'){
                                                    options += `<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                    ${combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                        combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)
                                                    }</td>`
                                                }else if(combine_order_details[i].categoryID == 82 && combine_order_details[i].premiumtype == 'Frames'){
                                                    options +=`<td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].tax1}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${(combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100)).toFixed(2)}</td>
                                                    <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">
                                                    ${combine_order_details[i].cost_price*(combine_order_details[i].quantity)+
                                                        combine_order_details[i].cost_price*(combine_order_details[i].quantity)*(combine_order_details[i].tax1/100).toFixed(2)
                                                    }</td>`
                                                }
                                            }
                                            options +=`
                                        </tr>`;
                                    }    
                                    options += `</tbody>
                                </table> 
                            </div>
                            <div style="background-color:red; color:white; border: 1px solid black;">
                                <div style="font-size:9px;margin-left:25px;margin-top:5px;"><b>Total Taxable Value</b></div>
                                <div id="show_total" style="margin-left: 90%;margin-top:-17px;"></div>
                            </div>
                            <div style="display:flex;">
                                <div style="padding-left: 11px;width:50%;font-size: 9px; padding-top: 9px;"><b>E.&O.E</b></div>
                            </div>
                            <div style="display:flex;">
                                <div style="width:49%;margin-left: 7px;font-size: 7px;padding:3px;"><b style="font-size: 9px;">Declaration:-</b>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</div>
                                <div style="margin-left: 132px;">Elrica Global Interprises PVT LTD</div><br>
                            </div>
                            <div style="display:flex;">
                                <div style="width: 50%;">
                                    <div style="margin-left: 7px;">Terms and Conditions</div>
                                    <div style="margin-left: 50px;font-size: 7px;">1 Total Payment Due in 90 Days.</div>
                                    <div style="margin-left: 50px;font-size: 7px;">2 Please include the Invoice No. on your Cheque.</div>
                                </div>
                                <div style="width: 50%;">
                                    <br><br><br><br>
                                    <div style="margin-left: 210px;">Authorised Signatory</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal" >Cancel</button>
                        <button type="button" class="btn btn-primary" id="" onclick="myfun('print_invoice')">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
    $(".combine_order_table_modal").append(options);
    let total_tr = 10;
    let append_tr = total_tr - combine_order_details.length;
   
    if(combine_order_details.length > 14 && combine_order_details.length <= 18){
    for(let i=0; i < 4; i++ )
    {
        $('#invoice_table tbody').append(`<tr style="height:30px;border: none;">
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                            <td style="text-align: center;font-size: 9px;"></td>
                                        </tr>`)
    }
    }
    for(let i=0; i < append_tr; i++ )
    {
        $('#invoice_table tbody').append(`<tr style="height:30px;">
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;border-right: 1px solid black;"></td>
                                            <td style="text-align: center;font-size: 9px; border: none;"></td>
                                        </tr>`)
    }

    $('#'+order_pro_id+'_pdf').modal();
}
    
function closeInvoice(status){
    if(status == "processing")
    {
        $('#order_process_table').DataTable().ajax.reload();
    }
    else if(status == "completed")
    {
        $('#delivered_table').DataTable().ajax.reload();
    }
}
// Print Invoice Button End ------------------

// Download Invoice Button -------------
function invoiceDowload()
{
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        width: 500,
        text: 'Please create invoice first !',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
}
// Download Invoice Button End ----------------

// Confirm Button -------------
function alertmassege()
{
    Swal.fire({
        title: 'Message!',
        text: 'Please Click on (Print Icon) for Generating Invoice',
        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
        imageWidth: 350,
        imageHeight: 180,
        imageAlt: 'Custom image',
    })
}
// Confirm Button End ----------------

// Pickup Courier Boy Start -------------------
function pickupModelShow(id) {
    $('#pickuporderId').val('');
    $('#courier_boy').val('');
    $('#pickuporderId').val(id);
    
    $('#pickupModelShow').modal('show');
}

 function courierID() {
    var status = $('#status').val();
    var id = $('#pickuporderId').val();
    var formData = $("#CourierDetail").serializeArray();
    formData.push({'name':'status', 'value':status})
    formData.push({'name':'id', 'value':id})
    
    var url = baseUrl+"/vendor/courierboy/"+id;
    
    if(formData[1].value != ""){
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            success:function(resp){
                if(resp.status){
                    Swal.fire({
                      title: 'Message!',
                      text: resp.msg,
                      imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                      imageWidth: 400,
                      imageHeight: 200,
                      confirmButtonText: 'OK',
                    })
                    $('#pickupModelShow').modal('toggle');
                    ready_for_pickup_datatable.ajax.reload(null, false);
                    let {picked_total, intransit_total} = resp.data;
                    $("#ready_for_pickup_count").text(picked_total);
                    $("#in_transit_count").text(intransit_total);
                }else{
                    alert("error");
                }
            },
            error: function(err) {
                alert(err);
            } 
        });
    }
    else
    {
        Swal.fire({
            title: `Courier Boy Name Not Defined...!`,
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return false;
            }
        })
    }
}
// Pickup Courier Boy End -------------------

// Order Delivered Button Start ------------

async function orderDelivered(id, e){
    if (!confirm("Are you sure you want to Delivered this Order?")) return false;

    try {
        let result = await order_status_update(id, $(e.target).attr('action'));
        if(result.status){
            in_transit_datatable.ajax.reload(null, false)
            let {intransit_total, completed_total} = result.data;
            $("#in_transit_count").text(intransit_total);
            $("#completed_count").text(completed_total);
        }
    } catch (error) {
        Swal.fire({
          title: 'Message!',
          text: error,
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                resolve(response);
            } else if (result.isDenied) {
                return false;
            }
        })
    }
}

const order_status_update = (id, current_order_status) => {
    let url = baseUrl+"/vendor/manualorders/status"+"/"+id+"/"+current_order_status;
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: url,
            type:"POST",
            data:{
                _token:$("input[name=_token]").val()
            },
            success:function(response){
                alert(response.msg);
                resolve(response);
            },
            error: function(err) {
                reject(err) // Reject the promise and go to catch()
            }
        });
    })
    
}

async function orderAcceptAndReject(id, e){
    if(!$(e.target).parent().attr('action')){
        return false;
    }

    if($(e.target).parent().attr('action') == 'processing'){
        if (!confirm("Are you sure you want to Process this Order?")) return false;
    }else if($(e.target).parent().attr('action') == 'cancelled'){
        if (!confirm("Are you sure you want to Cancel this Order?")) return false;
    }
     
    let current_order_status = $(e.target).parent().attr('action');

    try {
        let result = await order_status_update(id, current_order_status);
        if(result.status){
            let {pending_total, processing_total} = result.data;
            order_table_datatable.ajax.reload(null, false);
            $("#order_process_count").text(processing_total);
            $("#pending_count").text(pending_total);
        }
    } catch (error) {
        Swal.fire({
          title: 'Message!',
          text: error,
          imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
          imageWidth: 400,
          imageHeight: 200,
          showCancelButton: true,
          confirmButtonText: 'OK',
        })
    }
}

async function orderConfirm(id, e){
    if (!confirm("Are you sure you want to Process this Order?")) return false;

    try {
        let result = await order_status_update(id, $(e.target).attr('action'));
        if(result.status) {
            let {picked_total, processing_total} = result.data;
            order_process_datatable.ajax.reload(null, false);
            $("#order_process_count").text(processing_total);
            $("#ready_for_pickup_count").text(picked_total);
        }
    } catch (error) {
        alert(error)
    }
}
    
    