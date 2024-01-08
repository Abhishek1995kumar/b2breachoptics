const combine_order_modal_show = (combine_order_details_arr, order_pro_id) => {
    let combine_order_details = combine_order_details_arr;
    let total = combine_order_details.cost + 5 + $('.shipping_cost_value').val() ;
    let options = `<div class="modal fade" id="${order_pro_id}_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="closeInvoice()" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="print_invoice">
                    <div class="container" style="width: auto; width: auto;border: 1px solid black;padding: 0;padding-bottom: 20px;">
                        <div style="text-align: center;background-color: red;padding-top: 6px;padding-bottom: 8px;color: white;font-size: 17px; border-bottom: 1px solid black;">TAX INVOICE</div>
                            <div style="display:flex;border-bottom: 1px solid black;">
                                <div style="width: 50%; padding:15px;line-height: 22px;padding-top: 6%;">
                                    <div style="">Elrica Global Interprises PVT LTD</div>
                                    <div style="">102 Vinayak Chember,Near Waman Hari Pethe, Naupada Road, Thane West. Pin-400602.</div>
                                    <div style=" "><h7 style="font-weight:550;">Phone:-</h7>7700044084</div>
                                    <div style=" "><h7 style="font-weight:550;">Email ID:-</h7>support@elricaglobal.in </div>
                                </div>
                                <div style="width: 67%; margin-left: 10%;line-height: 25px;border-left: 1px solid black;">
                                    <div style="border-bottom:1px solid black">
                                        <div style="display: flex;justify-content: center;">
                                            <img src="{{url('/assets/images/new_invoice.png')}}" style="padding-bottom: 6px; width:61%;">
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
                                    <div style=" "><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].buyer_name}</div>
                                    <div style=" "><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                    <div style=" "><h7 style="font-weight:550;">GSTIN:-</h7>${combine_order_details[0].gst_no != 'NULL' ?  combine_order_details[0].gst_no : " -"}</div>
                                    <div style=" "><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>
                                </div>
                                <div style="width: 54%; margin-left: 13px;padding:15px;line-height: 18px;border-left: 1px solid black;">
                                    <h5 style=""><b>Shipping Address</b></h5>
                                    <div style=""><h7 style="font-weight:550;">Name:-</h7>${combine_order_details[0].buyer_name}</div>
                                    <div style=""><h7 style="font-weight:550;">Address:-</h7>${combine_order_details[0].buyer_address}.${combine_order_details[0].buyer_address2}.${combine_order_details[0].buyer_city}.${combine_order_details[0].buyer_state}.${combine_order_details[0].pincode}</div>
                                    <div style=""><h7 style="font-weight:550;">Mobile No:-</h7>${combine_order_details[0].buyer_phone}</div>
                                    <div style=""><h7 style="font-weight:550;">Email ID:-</h7>${combine_order_details[0].cus_email}</div>
                                </div>
                            </div>
                           
                            <div style="display:flex; overflow-y:auto;border-top:1px solid black;" >
                                <table  id="invoice_table" style="height:46px; width: 100%; border-collapse: collapse; border-style: solid;" border="1">
                                    <thead style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                        <tr style="background-color: red;color: white;text-align: center;">
                                            <th style="width: 3%;text-align: center; font-size: 9px;border-left: 1px solid black;">SrNo</th>
                                            <th style="width: 46%;text-align: center; font-size: 9px;border-left: 1px solid black;">DESCRIPTION OF GOODS</th>
                                            <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">Model No</th>
                                            <th style="width: 10%;text-align: center; font-size: 9px;border-left: 1px solid black;">HSN Code</th>
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
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].cost_price}</td>
                                            <td style="text-align: center;font-size: 9px;border-right: 1px solid black;">${combine_order_details[i].quantity}</td>`
                                              console.log(combine_order_details[i].buyer_state);
                                            if(combine_order_details[0].buyer_state == 'Maharashtra' || combine_order_details[0].buyer_state  == "22"){
                                              
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
                                            <td style="text-align: center;font-size: 9px; border: none;"></td>
                                        </tr>`)
    }

    $('#'+order_pro_id+'_pdf').modal();
}

  
async function view_combine_order(order_pro_id, order_id, invoice, e)
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
        alert(error);
    }
}

const combine_order_details = (order_pro_id, order_id, invoice,status) => {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: baseUrl + "/admin/manualorders/combine_details_fetch",
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
                    alert(response.msg);
                    reject(err);
                }
            },
            error: function(err) {
                reject(err) 
            }
        });
    });
}
function closeInvoice(){
    status = $(e.target.parentElement).attr('data-status');
    if(status == "processing")
    {
        $('#order_processing_table').DataTable().ajax.reload();
    }
    else if(status == "completed")
    {
        $('#delivered_table').DataTable().ajax.reload();
    }
}