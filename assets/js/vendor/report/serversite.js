function selectCountry()
{
    $('#allstates').html("");
    var country = document.getElementById("countries");
    var countryId = country.options[country.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: baseUrl + "/vendor/get_country",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: countryId,
        },
        success: function(resp)
        {
            let data = '';
            if(resp)
            {
                data += `<option value="all">All</option>`;
                for(let i=0; i<resp.length; i++)
                {
                    data += `<option value="${resp[i].id}" '"state" == "${resp[i].Name}" ? "selected" : ""' ><b>${resp[i].Name}</b></option>`;
                }
                $('#allstates').append(data);
            }
        }
    });
}

$(document).ready(function() {
    $('#printDiv').hide();
    $('.full-excel').hide();
    $("#report_list").on('submit', function(e){
        e.preventDefault();
        let fdate = $('#report_list [name="fdate"]').val();
        let tdate = $('#report_list [name="tdate"]').val();
        let category = $('#report_list [name="mainid"]').val();
        let buyer = $('#report_list [name="buyer"]').val();
        let state = $('#report_list [name="state"]').val();
        
        $('#sales_order').DataTable({
            dom: 'lfrtip',
            'fixedHeader': true,
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            'bDestroy': true,
            'scrollX': true,
            "language": {
                "processing": ` <div id='loader' style=''>
                                    <svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
                                        <defs>
                                            <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                                                <stop offset="0%" stop-color="#5ebd3e" />
                                                <stop offset="33%" stop-color="#ffb900" />
                                                <stop offset="67%" stop-color="#f78200" />
                                                <stop offset="100%" stop-color="#e23838" />
                                            </linearGradient>
                                            <linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                                                <stop offset="0%" stop-color="#e23838" />
                                                <stop offset="33%" stop-color="#973999" />
                                                <stop offset="67%" stop-color="#009cdf" />
                                                <stop offset="100%" stop-color="#5ebd3e" />
                                            </linearGradient>
                                        </defs>
                                        <g fill="none" stroke-linecap="round" stroke-width="16">
                                            <g class="ip__track" stroke="#ddd">
                                                <path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                                <path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                            </g>
                                            <g stroke-dasharray="180 656">
                                                <path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
                                                <path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>`
            },
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': baseUrl + "/vendor/getSalesOrder",
                'type' : 'POST',
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'data': {
                    "form": {'fdate':fdate, 'tdate': tdate, 'category': category, 'buyer_name': buyer, 'state':state},
                },
            }
        });
        $('#printDiv').show();
        $('.full-excel').show();
    });
});



function exportExcel(){
    var data = document.getElementById('printDiv');
    var fp = XLSX.utils.table_to_book(data, {sheet: 'salesorder'});
    XLSX.write(fp, {
        bookType: 'xlsx',
        type: 'base64'
    });
    XLSX.writeFile(fp, 'salesorder.xlsx');
};

function exportAllExcel(e)
{
    e.preventDefault();
    let fdate = $('#report_list [name="fdate"]').val();
    let tdate = $('#report_list [name="tdate"]').val();
    let category = $('#report_list [name="mainid"]').val();
    let buyer = $('#report_list [name="buyer"]').val();
    let search = $('.input-sm').val();

    let url = baseUrl + "/vendor/exportsalesreport";

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
                
                let sgst = '';
                let cgst = '';
                let igst = '';
                let discount = 0;
                let shipping = 0;
                let gstamount = '';
                let subtotal = '';
                let grandtotal = '';
                
                if(resp[i].tax != "")
                {
                    if(resp[i].buyer_state == "22")
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
                    if(resp[i].buyer_state == "22")
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
                td3.append(resp[i].invoice_number);
                trow.append(td3)
                td4 = document.createElement("td");
                td4.append(resp[i].buyer_name);
                trow.append(td4)
                td5 = document.createElement("td");
                td5.append(resp[i].buyer_phone);
                trow.append(td5)
                td6 = document.createElement("td");
                td6.append(resp[i].product_title);
                trow.append(td6)
                td7 = document.createElement("td");
                td7.append(resp[i].Sname);
                trow.append(td7)
                td8 = document.createElement("td");
                td8.append(resp[i].product_sku);
                trow.append(td8)
                td9 = document.createElement("td");
                td9.append(resp[i].modelno);
                trow.append(td9)
                td10 = document.createElement("td");
                td10.append(resp[i].quantity);
                trow.append(td10)
                td11 = document.createElement("td");
                td11.append(resp[i].cname);
                trow.append(td11)
                td12 = document.createElement("td");
                td12.append(resp[i].hsncode);
                trow.append(td12)
                td13 = document.createElement("td");
                td13.append(resp[i].hsncode);
                trow.append(td13)
                td14 = document.createElement("td");
                td14.append(resp[i].costprice);
                trow.append(td14)
                td15 = document.createElement("td");
                td15.append(discount);
                trow.append(td15)
                td16 = document.createElement("td");
                td16.append(sgst);
                trow.append(td16)
                td17 = document.createElement("td");
                td17.append(cgst);
                trow.append(td17)
                td18 = document.createElement("td");
                td18.append(igst);
                trow.append(td18)
                td19 = document.createElement("td");
                td19.append(gstamount);
                trow.append(td19)
                td20 = document.createElement("td");
                td20.append(subtotal);
                trow.append(td20)
                td21 = document.createElement("td");
                td21.append(shipping);
                trow.append(td21)
                td22 = document.createElement("td");
                td22.append(grandtotal);
                trow.append(td22)
                td23 = document.createElement("td");
                td23.append(resp[i].status);
                trow.append(td23)
                
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
                    title: `<i class="fa fa-times-circle"></i><br>No Product Found In Records`,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                    }
                })
            }
        }
    })
}