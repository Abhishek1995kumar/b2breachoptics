
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
                        
function exportAllExcel(e)
{
    e.preventDefault();
    let fdate = $('#report_list [name="fdate"]').val();
    let tdate = $('#report_list [name="tdate"]').val();
    let category = $('#report_list [name="mainid"]').val();
    let buyer = $('#report_list [name="buyer"]').val();
    let owner = $('#report_list [name="owner"]').val();
    let search = $('.input-sm').val();

    const url = baseUrl + "/admin/exportsalesreport";

    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            fdate: fdate,
            tdate: tdate,
            category: category,
            buyer: buyer,
            owner: owner,
            search: search
        },
        success: function(resp) {
            let table = document.createElement("table");
            let thead = document.createElement("thead");
            let tbody = document.createElement("tbody");

            table.setAttribute('id', 'export_table');
            let tbl_thead_clone = $('.theadrow').clone();
            thead.append(tbl_thead_clone[0]);
            table.append(thead);

            for(let i=0; i<resp.length; i++) {
                console.log(resp[i]);
                let sgst = '';
                let cgst = '';
                let igst = '';
                let gstamount = '';
                let subtotal = '';
                let grandtotal = '';
                let discount = 0;
                let shipping = 0;
                
                if(resp[i].tax != "")
                {
                    if(resp[i].buyer_state == "maharashtra" || resp[i].buyer_state == "Maharashtra" || resp[i].buyer_state == "MAHARASHTRA" || resp[i].buyer_state == 22)
                    {
                        sgst = resp[i].tax/2;
                        cgst = resp[i].tax/2;
                        igst = '--';
                        gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                        subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                        grandtotal = subtotal + shipping;
                    }
                    else
                    {
                        sgst = '--';
                        cgst = '--';
                        igst = resp[i].tax;
                        gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                        subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                        grandtotal = subtotal + shipping;
                    }
                }
                else
                {
                    if(resp[i].buyer_state == "maharashtra" || resp[i].buyer_state == "Maharashtra" || resp[i].buyer_state == "MAHARASHTRA")
                    {
                        if(resp[i].premiumtype != ""){
                            if(resp[i].premiumtype == "Sunglasses")
                            {
                                sgst = 18/2;
                                cgst = 18/2;
                                igst = '--';
                                gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                                subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                                grandtotal = subtotal + shipping;
                            }
                            else if(resp[i].premiumtype == "Frames")
                            {
                                sgst = 12/2;
                                cgst = 12/2;
                                igst = '--';
                                gstamount = 12 * (resp[i].costprice * resp[i].quantity)/100;
                                subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                                grandtotal = subtotal + shipping;
                            }
                        }
                    }
                    else
                    {
                        if(resp[i].premiumtype != ""){
                            if(resp[i].premiumtype == "Sunglasses")
                            {
                                sgst = '--';
                                cgst = '--';
                                igst = 18;
                                gstamount = 18 * (resp[i].costprice * resp[i].quantity)/100;
                                subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                                grandtotal = subtotal + shipping;
                            }
                            else if(resp[i].premiumtype == "Frames")
                            {
                                sgst = '--';
                                cgst = '--';
                                igst = 12;
                                gstamount = 12 * (resp[i].costprice * resp[i].quantity)/100;
                                subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                                grandtotal = subtotal + shipping;
                            }
                        }
                    }
                }

                let trow = document.createElement("tr");
                trow.setAttribute('class', 'row'+(i+1));
                td0 = document.createElement("td");
                td0.append(i+1);
                trow.append(td0)
                td1 = document.createElement("td");
                td1.append(resp[i].orderid);
                trow.append(td1)
                td2 = document.createElement("td");
                td2.append(resp[i].created_at);
                trow.append(td2)
                td3 = document.createElement("td");
                td3.append(resp[i].invoice_number ? resp[i].invoice_number : "-");
                trow.append(td3)
                
                td4 = document.createElement("td");
                td4.append(resp[i].seller_order_id ? resp[i].seller_order_id : "-");
                trow.append(td4);
        
                td5 = document.createElement("td");
                td5.append(resp[i].buyer_order_id ? resp[i].buyer_order_id : "-");
                trow.append(td5);
                
                td6 = document.createElement("td");
                td6.append(resp[i].buyer_name ? resp[i].buyer_name : "-");
                trow.append(td6)
                td7 = document.createElement("td");
                td7.append(resp[i].buyer_phone ? resp[i].buyer_phone : "-");
                trow.append(td7)
                td8 = document.createElement("td");
                td8.append(resp[i].product_title ? resp[i].product_title : "-");
                trow.append(td8)
                td9 = document.createElement("td");
                td9.append(resp[i].buyer_state ? resp[i].buyer_state : "-");
                trow.append(td9)
                td10 = document.createElement("td");
                td10.append(resp[i].product_sku ? resp[i].product_sku : "-");
                trow.append(td10)
                td11 = document.createElement("td");
                td11.append(resp[i].modelno ? resp[i].modelno : "-");
                trow.append(td11)
                td12 = document.createElement("td");
                td12.append(resp[i].quantity ? resp[i].quantity : "-");
                trow.append(td12)
                td13 = document.createElement("td");
                td13.append(resp[i].cname ? resp[i].cname : "-");
                trow.append(td13)
                td14 = document.createElement("td");
                td14.append(resp[i].hsncode ? resp[i].hsncode : "-");
                trow.append(td14)
                td15 = document.createElement("td");
                td15.append(resp[i].gst_no ? resp[i].gst_no : "-");
                trow.append(td15)
                td16 = document.createElement("td");
                td16.append(resp[i].costprice ? resp[i].costprice : "-");
                trow.append(td16)
                td17 = document.createElement("td");
                td17.append(0);
                trow.append(td17)
                td18 = document.createElement("td");
                td18.append(sgst);
                trow.append(td18)
                td19 = document.createElement("td");
                td19.append(cgst);
                trow.append(td19)
                td20 = document.createElement("td");
                td20.append(igst);
                trow.append(td20)
                td21 = document.createElement("td");
                td21.append(gstamount);
                trow.append(td21)
                td22 = document.createElement("td");
                td22.append(subtotal);
                trow.append(td22)
                td23 = document.createElement("td");
                td23.append(discount);
                trow.append(td23)
                td24 = document.createElement("td");
                td24.append(grandtotal);
                trow.append(td24)
                td25 = document.createElement("td");
                td25.append(resp[i].status);
                trow.append(td25)
                
                tbody.append(trow);
            }
            if(resp.length > 0){
                table.append(tbody)
                var data = table;
                var fp = XLSX.utils.table_to_book(data, {sheet: 'salesorder'});
                XLSX.write(fp, {
                    bookType: 'xlsx',
                    type: 'base64'
                });
                XLSX.writeFile(fp, 'salesorder.xlsx');
            }
            else
            {
                Swal.fire({
                    title: `No Product Found In Records`,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // location.reload(true);
                    }
                })
            }
        }
    })
}

function exportAllCancelExcel(e)
{
    e.preventDefault();
    let fdate = $('#cancil_list [name="from_date"]').val();
    let tdate = $('#cancil_list [name="to_date"]').val();
    let category = $('#cancil_list [name="category"]').val();
    let buyer = $('#cancil_list [name="buyer_name"]').val();
    let vendor = $('#cancil_list [name="vendor_name"]').val();
    let owner = $('#cancil_list [name="owner"]').val();
    let search = $('.input-sm').val();

    const url = baseUrl + "/admin/exportcancelreport";

    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            fdate: fdate,
            tdate: tdate,
            category: category,
            buyer: buyer,
            vendor: vendor,
            owner: owner,
            search: search
        },
        success: function(resp) {
            let table = document.createElement("table");
            let thead = document.createElement("thead");
            let tbody = document.createElement("tbody");

            table.setAttribute('id', 'export_table');
            let tbl_thead_clone = $('.canceltheadrow').clone();
            thead.append(tbl_thead_clone[0]);
            table.append(thead);

            for(let i=0; i<resp.length; i++) {

                let can_by = '';
                // let sgst = '';
                // let cgst = '';
                // let igst = '';
                // let gstamount = '';
                // let subtotal = '';
                // let grandtotal = '';
                // let discount = 0;
                // let shipping = 0;
                
                if(resp[i].status == 'declined')
                {
                    can_by = resp[i].buyer_name
                }
                else if(resp[i].status == 'cancelled')
                {
                    can_by = 'Admin'
                }
                
                // if(resp[i].tax != "")
                // {
                //     if(resp[i].buyer_state == "maharashtra" || resp[i].buyer_state == "Maharashtra" || resp[i].buyer_state == "MAHARASHTRA")
                //     {
                //         sgst = resp[i].tax/2;
                //         cgst = resp[i].tax/2;
                //         igst = '--';
                //         gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                //         subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //         grandtotal = subtotal + shipping;
                //     }
                //     else
                //     {
                //         sgst = '--';
                //         cgst = '--';
                //         igst = resp[i].tax;
                //         gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                //         subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //         grandtotal = subtotal + shipping;
                //     }
                // }
                // else
                // {
                //     if(resp[i].buyer_state == "maharashtra" || resp[i].buyer_state == "Maharashtra" || resp[i].buyer_state == "MAHARASHTRA")
                //     {
                //         if(resp[i].premiumtype != ""){
                //             if(resp[i].premiumtype == "Sunglasses")
                //             {
                //                 sgst = 18/2;
                //                 cgst = 18/2;
                //                 igst = '--';
                //                 gstamount = resp[i].tax * (resp[i].costprice * resp[i].quantity)/100;
                //                 subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //                 grandtotal = subtotal + shipping;
                //             }
                //             else if(resp[i].premiumtype == "Frames")
                //             {
                //                 sgst = 12/2;
                //                 cgst = 12/2;
                //                 igst = '--';
                //                 gstamount = 12 * (resp[i].costprice * resp[i].quantity)/100;
                //                 subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //                 grandtotal = subtotal + shipping;
                //             }
                //         }
                //     }
                //     else
                //     {
                //         if(resp[i].premiumtype != ""){
                //             if(resp[i].premiumtype == "Sunglasses")
                //             {
                //                 sgst = '--';
                //                 cgst = '--';
                //                 igst = 18;
                //                 gstamount = 18 * (resp[i].costprice * resp[i].quantity)/100;
                //                 subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //                 grandtotal = subtotal + shipping;
                //             }
                //             else if(resp[i].premiumtype == "Frames")
                //             {
                //                 sgst = '--';
                //                 cgst = '--';
                //                 igst = 12;
                //                 gstamount = 12 * (resp[i].costprice * resp[i].quantity)/100;
                //                 subtotal = gstamount + resp[i].costprice * resp[i].quantity + discount;
                //                 grandtotal = subtotal + shipping;
                //             }
                //         }
                //     }
                // }

                let trow = document.createElement("tr");
                trow.setAttribute('class', 'row'+(i+1));
                td0 = document.createElement("td");
                td0.append(i+1);
                trow.append(td0)
                td1 = document.createElement("td");
                td1.append(resp[i].orderid);
                trow.append(td1)
                td2 = document.createElement("td");
                td2.append(resp[i].created_at);
                trow.append(td2)
                td3 = document.createElement("td");
                td3.append(resp[i].owner);
                trow.append(td3)
                td4 = document.createElement("td");
                td4.append(resp[i].order_payment_method ? resp[i].order_payment_method : "-");
                trow.append(td4)
                td5 = document.createElement("td");
                td5.append(resp[i].product_title ? resp[i].product_title : "-");
                trow.append(td5)
                td6 = document.createElement("td");
                td6.append(resp[i].product_sku ? resp[i].product_sku : "-");
                trow.append(td6)
                td7 = document.createElement("td");
                td7.append(resp[i].modelno ? resp[i].modelno : "-");
                trow.append(td7)
                td8 = document.createElement("td");
                td8.append(resp[i].canceled_date ? resp[i].canceled_date : "-");
                trow.append(td8)
                td9 = document.createElement("td");
                td9.append(resp[i].canceled_reason ? resp[i].canceled_reason : "-");
                trow.append(td9)
                td10 = document.createElement("td");
                td10.append(resp[i].quantity ? resp[i].quantity : "-");
                trow.append(td10)
                td11 = document.createElement("td");
                td11.append(resp[i].previous_price ? resp[i].previous_price : "-");
                trow.append(td11)
                td12 = document.createElement("td");
                td12.append(resp[i].cost ? resp[i].cost : "-");
                trow.append(td12)
                td13 = document.createElement("td");
                td13.append(resp[i].seller_name ? resp[i].seller_name : "-");
                trow.append(td13)
                td14 = document.createElement("td");
                td14.append(resp[i].buyer_name ? resp[i].buyer_name : "-");
                trow.append(td14)
                // td15 = document.createElement("td");
                // td15.append(0);
                // trow.append(td15)
                // td16 = document.createElement("td");
                // td16.append(sgst);
                // trow.append(td16)
                // td17 = document.createElement("td");
                // td17.append(cgst);
                // trow.append(td17)
                // td18 = document.createElement("td");
                // td18.append(igst);
                // trow.append(td18)
                // td19 = document.createElement("td");
                // td19.append(gstamount);
                // trow.append(td19)
                // td20 = document.createElement("td");
                // td20.append(subtotal);
                // trow.append(td20)
                // td21 = document.createElement("td");
                // td21.append(discount);
                // trow.append(td21)
                // td22 = document.createElement("td");
                // td22.append(grandtotal);
                // trow.append(td22)
                td23 = document.createElement("td");
                td23.append(can_by);
                trow.append(td23)
                td24 = document.createElement("td");
                td24.append(resp[i].gst_no ? resp[i].gst_no : "-");
                trow.append(td24)
                
                tbody.append(trow);
            }
            if(resp.length > 0){
                table.append(tbody)
                var data = table;
                var fp = XLSX.utils.table_to_book(data, {sheet: 'cancelorder'});
                XLSX.write(fp, {
                    bookType: 'xlsx',
                    type: 'base64'
                });
                XLSX.writeFile(fp, 'cancelorder.xlsx');
            }
            else
            {
                Swal.fire({
                    title: `No Product Found In Records`,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // location.reload(true);
                    }
                })
            }
        }
    })
}