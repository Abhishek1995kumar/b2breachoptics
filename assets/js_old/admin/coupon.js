
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
                    data1[i].push(cell.w);
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
    url = baseUrl + "/admin/coupan/import_excel"
    $.ajax({
        type: "POST",
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {coupon:couponsheet},
        success: function(response)
        {
            window.location.reload(true)
        }
    })
}

function downloadCouponExcel(e)
{
    console.log(e);
}