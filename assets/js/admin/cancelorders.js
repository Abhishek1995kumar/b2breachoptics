let loader = `<div id="preloader"> 
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
$(document).ready(function() {
    $("#reach_cancel_order").DataTable({
      dom: 'lfrtip',
      'fixedHeader': true,
      'processing': true,
      'serverSide': true,
      'bLengthChange': false,
      'bDestroy': true,
      'language': {
          "processing": loader
      },
      'responsive': true,
      'colReorder': true,
      'ajax': {
            'url': baseUrl + "/admin/manualorders/get_reach_cancel_details",
            'method' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() 
            {
                $('#preloader').css("display", "block");
            },
            complete: function() 
            {
                $('#preloader').css("display", "none");
            },
      },
    });
});

function vendorCancel(){
    $("#vendoe_cancel_order").DataTable({
      dom: 'lfrtip',
      'fixedHeader': true,
      'processing': true,
      'serverSide': true,
      'bLengthChange': false,
      'bDestroy': true,
      'language': {
          "processing": loader
      },
      'responsive': true,
      'colReorder': true,
      'ajax': {
            'url': baseUrl + "/admin/manualorders/get_vendor_cancel_details",
            'method' : 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() 
            {
                $('#preloader').css("display", "block");
            },
            complete: function() 
            {
                $('#preloader').css("display", "none");
            },
      },
    });
}