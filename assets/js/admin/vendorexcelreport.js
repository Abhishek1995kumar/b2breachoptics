function vendorsexportAllExcel(e) {
    e.preventDefault();
    let url = baseUrl + "/admin/vendorexportexcel";
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
                let tbl_thead_clone = $("#vendor-tr-id").clone();
                tbl_thead_clone.find("th:eq(6)").remove();
                thead.append(tbl_thead_clone[0]);
                table.append(thead);
    
                for (let i = 0; i < resp.length; i++) {
                    let trow = document.createElement("tr");
                    //code for fetching data into excel//
                    trow.setAttribute("class", "row" + (i + 1));
            
                    td0 = document.createElement("td");
                    td0.append(resp[i].name);
                    trow.append(td0);
                    td1 = document.createElement("td");
                    td1.append(resp[i].email);
                    trow.append(td1);
                    td2 = document.createElement("td");
                    td2.append(resp[i].phone);
                    trow.append(td2);
                    td3 = document.createElement("td");
                    td3.append(resp[i].address);
                    trow.append(td3);
                    td4 = document.createElement("td");
                    td4.append(resp[i].addressproof);
                    trow.append(td4);
                    td5 = document.createElement("td");
                    td5.append(resp[i].status);
                    trow.append(td5);
                    tbody.append(trow);
                }
                if (resp.length > 0) {
                    table.append(tbody);
                    let data = table;
                    let fp = XLSX.utils.table_to_book(data, { sheet: "vendorlist" });
                    XLSX.write(fp, {
                        bookType: "xlsx",
                        type: "base64",
                    });
                    XLSX.writeFile(fp, "vendorlist.xlsx");
                } else {
                    Swal.fire({
            			title: 'Message!',
            			text: error.statusText,
            			imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            			imageWidth: 400,
            			imageHeight: 200,
            			imageAlt: 'Custom image',
            			confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                          //location.reload(true);
                        }
                    });
                }
            }
        },
    });
}
