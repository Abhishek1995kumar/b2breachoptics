function selectCountry()
{
    $('#allstates').html("");
    var country = document.getElementById("countries");
    var countryId = country.options[country.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/get_country",
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
        let owner = $('#report_list [name="owner"]').val();
        
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
                'url': baseUrl + "/admin/getSalesOrder",
                'type' : 'POST',
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'data': {
                    "form": {'fdate':fdate, 'tdate': tdate, 'category': category, 'buyer_name': buyer, 'state':state, 'owner': owner},
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
