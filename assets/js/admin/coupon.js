
var excelFile;

document.getElementById('upload_file').addEventListener("change", (event) => {
    excelFile = event.target.files[0];
});

function couponExcelUpload(e)
{
    let couponsheet;
    if(excelFile)
    {
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(excelFile);
        fileReader.onload = (e) => {
            let data = e.target.result;
            let workbook = XLSX.read(data, {type:"binary"});
            let object;
            let worksheet;
            workbook.SheetNames.forEach(sheet => {
                 worksheet = workbook.Sheets[workbook.SheetNames[0]]
                 object = XLSX.utils.decode_range(worksheet["!ref"]);
            });
            
            let data1 = [];
            for (let row=object.s.r+1; row<=object.e.r; row++) {
                let i = data1.length;
                data1.push([]);
                
                for (let col=object.s.c; col<=object.e.c; col++) {
                    let cell = worksheet[XLSX.utils.encode_cell({r:row, c:col})];
                    cell.hasOwnProperty("w") ? data1[i].push(cell.w) : data1[i].push(cell.v);
                }
            }
            importExcelData(data1);
        }
    }
    else
    {
        Swal.fire({
            title: `Please Choose File...?`,
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed)
            {
                //
            }
        });
    }
}

function importExcelData(couponsheet)
{
    const url = baseUrl + "/admin/coupan/import_excel"
    $.ajax({
        type: "POST",
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {coupon:couponsheet},
        success: function(response)
        {
            location.reload(true)
        }
    })
}

function downloadCouponExcel(e)
{
    const url = baseUrl + '/admin/coupan/export_coupon_excel';
    $.ajax({
        type: 'POST',
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() 
        {
            $('#preloader').parent().css("display", "block");
            $('#preloader').css("display", "block");
        },
        complete: function() 
        {
            $('#preloader').parent().css("display", "none");
            $('#preloader').css("display", "none");
        },
        success: function(resp) {
            if(resp)
            {
                let csv = '';
                for (let row = 0; row < resp.length; row++) {
                    let keysAmount = resp[row].length;
                    let keysCounter = 0;
                    if(row === 0){
                        resp[row].forEach(function(ele){
                            csv += ele + (keysCounter+1 < keysAmount ? ',' : '\r\n' );
                            keysCounter++;
                        });
                        keysCounter = 0;
                    }
                    if(row > 0){
                        resp[row].forEach(function(ele){
                              csv += (ele ? ele : ele) + (keysCounter+1 < keysAmount ? ',' : '\r\n');
                              keysCounter++;
                        });
                        keysCounter = 0;
                    }
                }
                let link = document.createElement('a');
                link.id = 'download-csv';
                link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
                link.setAttribute('download', 'coupon_sales.csv');
                document.body.appendChild(link);
                document.querySelector('#download-csv').click();
                $("#download-csv").remove();
            }
        }
    })
}

function sampleDownloadExcel(e)
{
    const url = baseUrl + '/admin/coupan/export_sample_coupon_excel';
    $.ajax({
        type: 'POST',
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() 
        {
            $('#preloader').parent().css("display", "block");
            $('#preloader').css("display", "block");
        },
        complete: function() 
        {
            $('#preloader').parent().css("display", "none");
            $('#preloader').css("display", "none");
        },
        success: function(resp) {
            if(resp)
            {
                let csv = '';
                for (let row = 0; row < resp.length; row++) {
                    let keysAmount = resp[row].length;
                    let keysCounter = 0;
                    if(row === 0){
                        resp[row].forEach(function(ele){
                            csv += ele + (keysCounter+1 < keysAmount ? ',' : '\r\n' );
                            keysCounter++;
                        });
                        keysCounter = 0;
                    }
                    if(row > 0){
                        resp[row].forEach(function(ele){
                              csv += (ele ? ele : ele) + (keysCounter+1 < keysAmount ? ',' : '\r\n');
                              keysCounter++;
                        });
                        keysCounter = 0;
                    }
                }
                let link = document.createElement('a');
                link.id = 'download-csv';
                link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
                link.setAttribute('download', 'coupon_sample.csv');
                document.body.appendChild(link);
                document.querySelector('#download-csv').click();
                $("#download-csv").remove();
            }
        }
    });
}