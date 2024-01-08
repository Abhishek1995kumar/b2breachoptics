$(document).ready(function () {
    $("#cancilDiv").hide();
    $(".cancil-excel").hide();
    $("#cancil_list").on("submit", function (e) {
    e.preventDefault();
    let from_date = $('#cancil_list [name="from_date"]').val();
    let to_date = $('#cancil_list [name="to_date"]').val();
    let categories = $('#cancil_list [name="category"]').val();
    let buyer_name = $('#cancil_list [name="buyer_name"]').val();
    let vendor_name = $('#cancil_list [name="vendor_name"]').val();
    let owner = $('#cancil_list [name="owner"]').val();

    $("#cancils_order").DataTable({
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
            url: baseUrl + "/admin/getCancilOrder",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                form: {
                    from_date: from_date,
                    to_date: to_date,
                    categories: categories,
                    buyer_name: buyer_name,
                    vendor_name: vendor_name,
                    owner: owner,
                },
            },
        },
        });
        $("#cancilDiv").show();
        $(".cancil-excel").show();
    });
});