$(document).ready(function () {
    $("#cancelorder").hide();
    $(".full-excel").hide();
    $("#cancil_list").on("submit", function (e) {
    e.preventDefault();
    let from_date = $('#cancil_list [name="from_date"]').val();
    let to_date = $('#cancil_list [name="to_date"]').val();
    let category = $('#cancil_list [name="category"]').val();
    let buyer_name = $('#cancil_list [name="buyer_name"]').val();
    
    $("#cancil_order").DataTable({
        dom: "lfrtip",
        fixedHeader: true,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        bDestroy: true,
        scrollX: true,
        language: {
        processing: ` <div id='loader' style=''>
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
                    </div>`,
                    },
        responsive: true,
        colReorder: true,
        ajax: {
            url: baseUrl + "/vendor/getCancilOrder",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                form: {
                    from_date: from_date,
                    to_date: to_date,
                    category: category,
                    buyer_name: buyer_name,
                },
            },
        },
        });
        $("#cancelorder").show();
        $(".full-excel").show();
    });
});

// Export All Cancel Order

function exportAllCancelExcel(e)
{
    e.preventDefault();
    let from_date = $('#cancil_list [name="from_date"]').val();
    let to_date = $('#cancil_list [name="to_date"]').val();
    let category = $('#cancil_list [name="category"]').val();
    let buyer_name = $('#cancil_list [name="buyer_name"]').val();
    let search = $('.input-sm').val();

    let url = baseUrl + "/vendor/getExportCancilOrder";

    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            from_date: from_date,
            to_date: to_date,
            category: category,
            buyer_name: buyer_name,
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
                
                if(resp[i].status == 'declined')
                {
                    can_by = 'Vendor';
                }
                else if(resp[i].status == 'cancelled')
                {
                    can_by = 'Admin'
                }

                let trow = document.createElement("tr");
                trow.setAttribute('class', 'row'+(i+1));
                td0 = document.createElement("td");
                td0.append(i+1);
                trow.append(td0)
                td1 = document.createElement("td");
                td1.append(resp[i].id);
                trow.append(td1)
                td2 = document.createElement("td");
                td2.append(resp[i].created_at);
                trow.append(td2)
                td3 = document.createElement("td");
                td3.append(resp[i].owner);
                trow.append(td3)
                td4 = document.createElement("td");
                td4.append(resp[i].order_payment_method);
                trow.append(td4)
                td5 = document.createElement("td");
                td5.append(resp[i].product_title);
                trow.append(td5)
                td6 = document.createElement("td");
                td6.append(resp[i].product_sku);
                trow.append(td6)
                td22 = document.createElement("td");
                td22.append(resp[i].modelno);
                trow.append(td22)
                td7 = document.createElement("td");
                td7.append(resp[i].canceled_date);
                trow.append(td7)
                td8 = document.createElement("td");
                td8.append(resp[i].canceled_reason);
                trow.append(td8)
                td9 = document.createElement("td");
                td9.append(resp[i].quantity);
                trow.append(td9)
                td10 = document.createElement("td");
                td10.append(resp[i].cost);
                trow.append(td10)
                td11 = document.createElement("td");
                td11.append(resp[i].seller_name);
                trow.append(td11)
                td12 = document.createElement("td");
                td12.append(resp[i].buyer_name);
                trow.append(td12)
                td21 = document.createElement("td");
                td21.append(can_by);
                trow.append(td21)

                tbody.append(trow);
            }
            if(resp.length > 0){
                table.append(tbody)
                var data = table;
                var fp = XLSX.utils.table_to_book(data, {sheet: 'vendorcancelorder'});
                XLSX.write(fp, {
                    bookType: 'xlsx',
                    type: 'base64'
                });
                XLSX.writeFile(fp, 'vendorcancelorder.xlsx');
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
