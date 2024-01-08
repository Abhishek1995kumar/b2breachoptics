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
            
window.addEventListener('load', function() {
    $('#active_customer').DataTable({
        dom: 'lfrtip',
        'fixedHeader': true,
        'processing': true,
        'serverSide': true,
        'bLengthChange': false,
        'bDestroy': true,
        'order': [[0, 'desc']],
        'language': {
            "processing": loader
        },
        'responsive': true,
        'colReorder': true,
        'ajax': {
            // 'url': baseUrl+"/admin/customers/get_active_customer_details",
            'url': baseUrl + "/admin/customers/get_active_customer_details",
            'type' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
    });
});

function customerexportAllExcel(e) {
    e.preventDefault();
    const url = baseUrl + "/admin/customerexportsalesreport";
    $.ajax({
        type: "POST",
        url: url,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
            let table = document.createElement("table");
            let thead = document.createElement("thead");
            let tbody = document.createElement("tbody");
    
            if (resp) {
                table.setAttribute("id", "export_table");
                let tbl_thead_clone = $("#customer-tr-id").clone();
                tbl_thead_clone.find("th:eq(16)").remove();
                tbl_thead_clone.find("th:eq(15)").remove();
                tbl_thead_clone.find("th:eq(14)").remove();
                tbl_thead_clone.find("th:eq(13)").remove();
                thead.append(tbl_thead_clone[0]);
                table.append(thead);
        
                for (let i = 0; i < resp.length; i++) {
                    let trow = document.createElement("tr");
                    td0 = document.createElement("td");
                    td0.append(resp[i].name);
                    trow.append(td0);
                    td1 = document.createElement("td");
                    td1.append(resp[i].phone);
                    trow.append(td1);
                    td2 = document.createElement("td");
                    td2.append(resp[i].alternate_phone ? resp[i].alternate_phone : "-");
                    trow.append(td2);
                    td3 = document.createElement("td");
                    td3.append(resp[i].email);
                    trow.append(td3);
                    td4 = document.createElement("td");
                    td4.append(resp[i].address ? resp[i].address : "-");
                    trow.append(td4);
                    td5 = document.createElement("td");
                    td5.append(resp[i].state);
                    trow.append(td5);
                    td6 = document.createElement("td");
                    td6.append(resp[i].city);
                    trow.append(td6);
                    td7 = document.createElement("td");
                    td7.append(resp[i].zip ? resp[i].zip : "-");
                    trow.append(td7);
                    td8 = document.createElement("td");
                    td8.append(resp[i].bank_name ? resp[i].bank_name : "-");
                    trow.append(td8);
                    td9 = document.createElement("td");
                    td9.append(resp[i].acc_no ? resp[i].acc_no : "-");
                    trow.append(td9);
                    td10 = document.createElement("td");
                    td10.append(resp[i].ifsc_code ? resp[i].ifsc_code : "-");
                    trow.append(td10);
                    td11 = document.createElement("td");
                    td11.append(resp[i].bussiness_name ? resp[i].bussiness_name : "-");
                    trow.append(td11);
                    td12 = document.createElement("td");
                    td12.append(resp[i].gst_no ? resp[i].gst_no : "-");
                    trow.append(td12);
        
                    tbody.append(trow);
                }
                if (resp.length > 0) {
                    table.append(tbody);
                    var data = table;
                    var fp = XLSX.utils.table_to_book(data, { sheet: "customerlist" });
                    XLSX.write(fp, {
                        bookType: "xlsx",
                        type: "base64",
                    });
                    XLSX.writeFile(fp, "customerlist.xlsx");
                }
            }
            else {
        		Swal.fire({
        			title: 'Message!',
        			text: 'No Customer Found In Records',
        			imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
        			imageWidth: 400,
        			imageHeight: 200,
        			imageAlt: 'Custom image',
        			confirmButtonText: 'OK',
        		});
            }
        },
    });
}