
ClassicEditor
    .create( document.querySelector( '#editor' ) )
        .then( editor => {
    } )
        .catch( error => {
});

$(document).ready(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
 });

let productdiv = document.querySelector("#product_attr_data");
function removereplicateManageTable(id, e){
    e.target.parentElement.parentElement.parentElement.remove();
    let attrdiv = document.createElement("input");
    attrdiv.setAttribute('name', 'removeattr[]');
    attrdiv.setAttribute('type', 'hidden');
    attrdiv.setAttribute('value', id);
    productdiv.appendChild(attrdiv);
}

let color_datatable;
const loader = `<i class="fa fa-spinner fa-spin" aria-hidden="true" style="font-size:100px;color:rgb(127, 0, 255); background:tranparent; z-index:100;"></i>`;

$(document).on('click', '#available_pro_color', function(){ 
    let product_id = $('#productsku').val();
    if($(this).is(':checked')) {
        $('#color_table').dataTable({
            'serverSide': true,
            'bProcessing': true,
            'searching' : false,
            'ordering' : false,
            'paging' : false,
            'scrollY': '10rem',
            'scrollCollapse': true,
            "bLengthChange": false,
            'info' : false,
            'bDestroy' : true,
            "language": {
                "processing": loader
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).find('td:eq(0)').attr('contentEditable',true);
                $(row).find('td:eq(0)').attr('row_id', data[data.length - 1]);
                $(row).find('td:eq(0)').attr('column_name','color');
                $(row).find('td:eq(0)').css('text-align', 'center');

                $(row).find('td:eq(1)').attr('contentEditable',true);
                $(row).find('td:eq(1)').attr('row_id', data[data.length - 1]);
                $(row).find('td:eq(1)').attr('column_name','attr_color_code');
                $(row).find('td:eq(1)').css('text-align', 'center');

                $(row).find('td:eq(2)').css('text-align', 'center');
                $(row).find('td:eq(3)').css('text-align', 'center');
    
                $(row).find('td:eq(4)').hide();
                
            },

            'ajax' : {
                'url'  : baseUrl + '/admin/attr_color_fetch',
                'type' : 'POST',
                'data' : {product_id : product_id},
            },
        });
    } 
});

$(document).on('blur', '#color_table', function(e){
    const id = $(e.target).attr("row_id");
    const column_name = $(e.target).attr("column_name");
    const value = $(e.target).text();
    console.table(column_name,value);
    const data = {id:id, table_column:column_name, value:value};
    $.ajax({
        url: baseUrl + "/admin/updateColorValue",
        type: "POST",
        dataType: "JSON",
        data: {
            data:data,
        },
        success:function(response){
            if(response.status == "success"){
                $('#color_table').DataTable().ajax.reload();
            }
        }
    });
});


$(document).on('change', '#color_table', function(e){
    console.log($(e.target).attr('row_id'));
});


$('#color_table').DataTable().on( 'row-reorder', function ( e, diff, edit ) {
    let result = 'Reorder started on row: '+edit.triggerRow.data()[0]+'<br>';
    for ( let i=0, ien=diff.length ; i<ien ; i++ ) {
        let rowData = $('#color_table').DataTable().row( diff[i].node ).data();

        result += rowData[1]+' updated to be in position '+
            diff[i].newData+' (was '+diff[i].oldData+')<br>';
    }
});

function updateDataTable() {
}

$(document).on('click', "#product_color_attr", function(e){
    e.preventDefault();
    let fileInput = $('#color_file')[0];
    let product_id = $("#main_product_sku").val();
    let add_attr_color = $('#attr_color').val();
    let add_attr_color_code = $('#attr_color_code').val();
    if(product_id != '' && add_attr_color != '' && add_attr_color_code != '') {
        if( fileInput.files.length > 0 ){
            let formData = new FormData();
            $.each(fileInput.files, function(k,file){formData.append('images[]', file);});
            formData.append('color', add_attr_color);
            formData.append('product_id', product_id);
            formData.append('attr_color_code', add_attr_color_code);
            let url = baseUrl + "/admin/product_color_attr";
            $.ajax({
                method: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false, 
                contentType: false, 
                dataType: 'JSON',
                success: function(resp){
                    if(resp.status == 200) {
                        $('#attr_color').val('');
                        $('#color_file').val('');
                        fetch_attr_color_dropdown();
                        $('#color_table').DataTable().ajax.reload();
                    }else {
                        alert(resp.msg);
                    }
                }
            });
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'SELECT IMAGES FIRST !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    }else {
        let data = [];
        data[0] = product_id;
        data[1] = add_attr_color;
        data[2] = add_attr_color_code;
        data[3] = fileInput;
        for(let x=0; x<data.length; x++){
            if(data[x].value == ''){
                Swal.fire({
                    title: data[x],
                    width: 500,
                    text: data[x].placeholder,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            return;
        }
    }
});




function fetch_attr_color_dropdown() {
    let id = '{{$product->productsku}}';
    let url = baseUrl + "/fetch_attr_color_dropdown";
    $.ajax({  
        url:url,  
        method:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{id:id}, 
        dataType : 'json', 
        success:function(resp) {  
            if(resp.status == 200) {
                $('.attr_pro_color').html(resp.data);
            }
        }  
    });  
}


function attr_color_dropdown() {
    let id = '{{ $product->productsku }}';
    let url = baseUrl + "/admin/attr_color_dropdown";
    $.ajax({  
        url:url,  
        method:"POST",  
        dataType : 'JSON', 
        data:{
            id:id, 
            '_token' : '{{ csrf_token() }}'
        }, 
        success:function(resp)  {  
            if(resp.status == 200) {
                $('.attr_pro_color').html(resp.data);
            }
            
        }  
    });  
}


$(document).on('click', '.delete_color', function(){
    var id = $(this).attr("id");
    var pro_id = $(this).attr("pro_id");
    if(confirm("Are you sure you want to delete this?")) {
    let url = baseUrl + "/delete_attr_color";
    $.ajax({  
            url:url,  
            method:"POST",  
            data:{
                id:id, 
                '_token' : '{{ csrf_token() }}'
            }, 
            dataType : 'json', 
            success:function(resp) {  
                if(resp.status == 200) {
                    $('#color_table').DataTable().ajax.reload();
                    $("select[name='attr_pro_color[]']").html(resp.data);
                }
                
            }  
        });  
    }  
    else  
    {  
        return false;       
    }  
}); 


$(document).on('click', '#available_pro_color', function() {
    if(this.checked) {
        $('#product_color_div').show();
    }else {
        $('#product_color_div').hide();
    }
});


$(document).on('click', '#available_pro_whole', function() {
    if(this.checked) {
    $('#product_whole_div').show();
    }else {
        $('#product_whole_div').hide();
    }
});


$(document).on('click', '#manage_pro_attr', function() {
    if(this.checked) {
        $('#manage_pro_attr_div').show();
    }else {
        $('#manage_pro_attr_div').hide();
    }
});



function replicateManageTable(tbl_name) {
    let tbl = '#'+tbl_name;
    let att_pro_sku =  $(tbl).find('tr:last .att_pro_sku').val();
    let attr_pro_size =  $(tbl).find('tr:last .attr_pro_size').val();
    let attr_pro_qty =  $(tbl).find('tr:last .attr_pro_qty').val();
    let attr_mrp =  $(tbl).find('tr:last .attr_mrp').val();
    let attr_pro_price =  $(tbl).find('tr:last .attr_pro_price').val();
    let attr_pro_color =  $(tbl).find('tr:last .attr_pro_color').val();

    if(att_pro_sku != '' && attr_pro_qty != '' && attr_pro_price && attr_pro_color) {
        tbl = $(tbl).find('tr:last');
        tbl = tbl.attr('id');
        console.log(tbl);
        let new_id = parseInt(tbl) + 1;
        let myRow = $('#manage_attr_table').closest('table').find('tr:last-child').clone().attr('id', new_id); 
        myRow.find('.att_pro_sku').val("");
        myRow.find('.attr_pro_size').val("");
        myRow.find('.attr_pro_qty').val("");
        myRow.find('.attr_mrp').val("");
        myRow.find('.attr_pro_price').val("");
        myRow.find('.attr_pro_color').val("");
        $('#manage_attr_table tr:last').after(myRow);
    }else {
        let data = [];
        data[0] = att_pro_sku;
        data[1] = attr_pro_qty;
        data[2] = attr_mrp;
        data[3] = attr_pro_price;
        data[4] = attr_pro_color;
        for(let x=0; x<data.length; x++){
            if(data[x].value == ''){
                Swal.fire({
                    title: data[x],
                    width: 500,
                    text: 'Please Enter !' + data[x].placeholder,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            return;
        }
    }
}


bkLib.onDomLoaded(function() {
    // new nicEditor().panelInstance('description');
    // new nicEditor().panelInstance('policy');
});

$("#allow").change(function () {
    $("#pSizes").toggle();
});

$("#bulkrange").change(function () {
    $("#bulkfield").toggle();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#adminimg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$('.slide button').on('click',function(){
    $(this).parent('.slide').remove();
});

$(document).ready(function() {
    let main_cat = $('#maincats').val();
    if(main_cat == '58') {
        $('#spheres').show();
        $('#axisnlenss').show();
        $('#cylinderlenss').show();
        $('#addpowerlenss').hide();
    }else{
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();  
    }
    let lens_type = $('#visioneffect').val();
    if(lens_type == 'Single Vision')
    {
        $('#addpowerlenss').hide();
    }else if(lens_type == 'Zero Power'){
        $('#addpowerlenss').hide();
    }else if(lens_type == 'Biofocal'){
        $('#addpowerlenss').show();
    }else if(lens_type == 'Progressive'){
        $('#addpowerlenss').show();
    }

    var select_status = document.getElementById("maincats");
    var categoryname = select_status.options[select_status.selectedIndex].text;
    // if( categoryname == "Frames" ) {
    //     $('#diameternew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#basecurvenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#powernew').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#lenscolornew').hide();
    //     $('#contactlenscolornew').hide();
    //     $('#lenstechnologynew').hide();
    //     $('#lensindexnew').hide();
    //     $('#focallengthnew').hide();
    //     $('#shelflifenew').hide();
    //     $('#formnew').hide();
    //     $('#usagesnew').hide();
    //     $('#productcolornew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#lensmaterialtypenew').hide();

    //     $('#netquntitynew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();
    //     $('#framedimension').hide()
    //     $('#centerthiknessnew').hide();
    //     $('#cylinderneww').hide();
    //     $('#axisneww').hide();

    //     $('#gendernew').show();
    //     $('#warrentytypenew').show();
    //     $('#frametypenew').show();

    //     $('#leanscoatingnew').hide();
    //     $('#visioneffectnew').hide();
    //     $('#coatingnew').hide();
    //     $('#lenstypenew').hide();
    //     $('#addpowernew').hide();
    //     $('#framematerialnew').show();
    //     $('#frameshape').show();
    //     $('#sellername').show();
    //     $('#framestylenew').hide();
    //     $('#gendernew').show();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#productdimensionnew').show();
    //     $('#framecolornew').show();
    //     $('#premiumtypenew').hide();
    //     $('#addpowerlenss').hide();
    //     $('#spheres').hide();
    //     $('#axisnlenss').hide();
    //     $('#cylinderlenss').hide();
    //     $('#diameterlenss').hide();

    // } else if(categoryname == "Contact Lenses") {

    //     $('#catetwonew').hide();
    //     $('#shapenew').hide();
    //     $('#framecolornew').hide();
    //     $('#gendernew').hide();
    //     $('#framestylenew').hide();
    //     $('#framematerialnew').hide();
    //     $('#templematerialnew').hide();
    //     $('#templecolornew').hide();    
    //     $('#lensmaterialtypenew').hide();
    //     $('#leanscoatingnew').hide();
    //     $('#lenstechnologynew').hide();
    //     $('#lensindexnew').hide();
    //     $('#focallengthnew').hide();
    //     $('#shelflifenew').hide();
    //     $('#formnew').hide();
    //     $('#productcolornew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#warrentytypenew').hide();
    //     $('#productdimensionnew').hide();
    //     $('#weightnew').show();
    //     $('#packageweightnew').show();
    //     $('#usagesnew').hide();
    //     $('#frametypenew').hide();
    //     $('#framewidthnew').hide();
    //     $('#heightnew').hide();

    //     $('#netquntitynew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();
    //     $('#coatingnew').hide();

    //     $('#visioneffectnew').hide();
    //     $('#lenstypenew').show();
    //     $('#usagesdurationnew').show();
    //     $('#premiumtypenew').hide();
    //     $('#addpowerlenss').hide();
    //     $('#diameterlenss').hide();
    //     $('#spherelens').hide();
    //     $('#axisnlens').hide();
    //     $('#cylinderlens').hide();

    //     let lensValue = $("#lenstype option")[0].value;
        
    //     if(lensValue == 'Single Vision'){
    //         $('#basecurvenew').show();
    //         $('#diameternew').show();
    //         $('#powernewmin').show();
    //         $('#powernewmax').show();
    //         $('#addpowernew').hide();
    //         $('#axisneww').hide();
    //         $('#cylinderneww').hide();
    //         $('#spherelens').hide();
    //         $('#axisnlens').hide();
    //         $('#cylinderlens').hide();
    //     }
    //     else if(lensValue == 'MultiFocal'){
    //         $('#basecurvenew').show();
    //         $('#diameternew').show();
    //         $('#powernewmin').show();
    //         $('#powernewmax').show();
    //         $('#addpowernew').show();
    //         $('#axisneww').hide();
    //         $('#cylinderneww').hide();
    //         $('#spherelens').hide();
    //         $('#axisnlens').hide();
    //         $('#cylinderlens').hide();
    //     }
    //     else if(lensValue == 'toric and Astigmatism'){
    //         $('#basecurvenew').show();
    //         $('#diameternew').show();
    //         $('#powernewmin').show();
    //         $('#powernewmax').show();
    //         $('#addpowernew').hide();
    //         $('#axisneww').show();
    //         $('#cylinderneww').show();
    //         $('#spherelens').hide();
    //         $('#axisnlens').hide();
    //         $('#cylinderlens').hide();
    //     }
    //     else if(lensValue == 'Plano'){
    //         $('#basecurvenew').show();
    //         $('#diameternew').show();
    //         $('#powernewmin').show();
    //         $('#powernewmax').show();
    //         $('#addpowernew').hide();
    //         $('#axisneww').hide();
    //         $('#cylinderneww').hide();
    //         $('#spherelens').hide();
    //         $('#axisnlens').hide();
    //         $('#cylinderlens').hide();
    //     }

    //     $('#lenstype').on('change', function() {
    //         if($('#lenstype').val() == 'Single Vision'){
    //             $('#basecurvenew').show();
    //             $('#diameternew').show();
    //             $('#powernewmin').show();
    //             $('#powernewmax').show();
    //             $('#addpowernew').hide();
    //             $('#axisneww').hide();
    //             $('#cylinderneww').hide();
    //             $('#spherelens').hide();
    //             $('#axisnlens').hide();
    //             $('#cylinderlens').hide();
    //         }
    //         else if($('#lenstype').val() == 'MultiFocal'){
    //             $('#basecurvenew').show();
    //             $('#diameternew').show();
    //             $('#powernewmin').show();
    //             $('#powernewmax').show();
    //             $('#addpowernew').show();
    //             $('#axisneww').hide();
    //             $('#cylinderneww').hide();
    //             $('#spherelens').hide();
    //             $('#axisnlens').hide();
    //             $('#cylinderlens').hide();
    //         }
    //         else if($('#lenstype').val() == 'toric and Astigmatism'){
    //             console.log("hellow");
    //             $('#basecurvenew').show();
    //             $('#diameternew').show();
    //             $('#powernewmin').show();
    //             $('#powernewmax').show();
    //             $('#addpowernew').hide();
    //             $('#axisneww').show();
    //             $('#cylinderneww').show();
    //             $('#spherelens').hide();
    //             $('#axisnlens').hide();
    //             $('#cylinderlens').hide();
    //         }
    //         else if($('#lenstype').val() == 'Plano'){
    //             $('#basecurvenew').show();
    //             $('#diameternew').show();
    //             $('#powernewmin').show();
    //             $('#powernewmax').show();
    //             $('#addpowernew').hide();
    //             $('#axisneww').hide();
    //             $('#cylinderneww').hide();
    //             $('#spherelens').hide();
    //             $('#axisnlens').hide();
    //             $('#cylinderlens').hide();
    //         }
    //     });

    // }else if(categoryname == "Sunglasses"){

    //     $('#usagesnew').hide();
    //     $('#leanscoatingnew').hide();
    //     $('#diameternew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#basecurvenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#lensindexnew').hide();
    //     $('#focallengthnew').hide();
    //     $('#shelflifenew').hide();
    //     $('#formnew').hide();
    //     $('#productcolornew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#netquntitynew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();

    //     $('#centerthiknessnew').hide();
    //     $('#cylinderneww').hide();
    //     $('#axisneww').hide();
    //     $('#lenstypenew').hide();
    //     $('#visioneffectnew').hide();
    //     $('#framestylenew').hide();
    //     $('#addpowernew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#coatingnew').hide();

    //     $('#lenstechnologynew').show();
    //     $('#gendernew').show();
    //     $('#shapenew').show();
    //     $('#framecolornew').show();
    //     $('#premiumtypenew').hide();
    //     $('#addpowerlenss').hide();
    //     $('#diameterlenss').hide();
    //     $('#spheres').hide();
    //     $('#axisnlenss').hide();
    //     $('#cylinderlenss').hide();
    // }else if(categoryname == "Lenses"){

    //     $('#catetwonew').hide();
    //     $('#shapenew').hide();
    //     $('#framecolornew').hide();
    //     $('#gendernew').hide();
    //     $('#framestylenew').hide();
    //     $('#framematerialnew').hide();
    //     $('#usagesnew').hide();
    //     $('#templematerialnew').hide();
    //     $('#templecolornew').hide();
    //     $('#leanscoatingnew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#basecurvenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#shelflifenew').hide();
    //     $('#formnew').hide();
    //     $('#productcolornew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#warrentytypenew').hide();
    //     $('#productdimensionnew').hide();
    //     $('#frametypenew').hide();
    //     $('#allownew').hide();
    //     $('#framewidthnew').hide();
    //     $('#heightnew').hide();
    //     $('#modelnonew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#netquntitynew').hide();
    //     $('#centerthiknessnew').hide();
    //     $('#cylinderneww').hide();
    //     $('#axisneww').hide();
    //     $('#visioneffectnew').show();
    //     $('#lenstypenew').hide();
    //     $('#addpowernew').hide();
    //     $('#lenstechnologynew').show();
    //     $('#coatingnew').show();
    //     $('#premiumtypenew').hide();
    //     // $('#addpowerlenss').show();
    //     $('#diameternew').hide();
    //     $('#diameterlenss').show();
    //     $('#visioneffect').on('change', function() {
    //         let lens_type = $('#visioneffect').val();
    //         if(lens_type == 'Single Vision')
    //         {
    //             $('#addpowerlenss').hide();
    //             // $('#diameterlenss').show();
    //         }else if(lens_type == 'Zero Power'){
    //             $('#addpowerlenss').hide();
    //             //  $('#diameterlenss').show();
    //         }else if(lens_type == 'Biofocal'){
    //             $('#addpowerlenss').show();
    //             //  $('#diameterlenss').show();
    //         }else if(lens_type == 'Progressive'){
    //             $('#addpowerlenss').show();
    //             //  $('#diameterlenss').show();
    //         }
    //     });  
        
    // }else if(categoryname == "Accessories"){

    //     $('#frametypenew').hide();
    //     $('#catetwonew').hide();
    //     $('#shapenew').hide();
    //     $('#framecolornew').hide();
    //     $('#framestylenew').hide();
    //     $('#framematerialnew').hide();
    //     $('#templematerialnew').hide();
    //     $('#templecolornew').hide();
    //     $('#lensmaterialtypenew').hide();
    //     $('#leanscoatingnew').hide();
    //     $('#diameternew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#basecurvenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#lenscolornew').hide();
    //     $('#contactlenscolornew').hide();
    //     $('#lenstechnologynew').hide();
    //     $('#lensindexnew').hide();
    //     $('#focallengthnew').hide();
    //     $('#modelnonew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();
    //     $('#framewidthnew').hide();
    //     $('#modelnonew').hide();
    //     $('#heightnew').hide();
    //     $('#centerthiknessnew').hide();
    //     $('#cylinderneww').hide();
    //     $('#axisneww').hide();
    //     $('#lenstypenew').hide();
    //     $('#addpowernew').hide();
    //     $('#visioneffectnew').hide();
    //     $('#coatingnew').hide();
    //     $('#productdimnew').hide();
    //     // $('#productdimensionnew').show();
    //     $('#framedimensionnew').hide();
    //     $('#gendernew').hide();
    //     $('#premiumtypenew').hide();
    //     $('#addpowerlenss').hide();
    //     $('#diameterlenss').hide();
    //     $('#productdimensionnew').show();

    // }else if(categoryname == "Premium Brands"){

    //     $('#usagesnew').hide();
    //     $('#lensmaterialtypenew').show();
    //     $('#leanscoatingnew').hide();
    //     $('#diameternew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#basecurvenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#lensindexnew').hide();
    //     $('#focallengthnew').hide();
    //     $('#shelflifenew').hide();
    //     $('#formnew').hide();
    //     $('#productcolornew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#netquntitynew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();
    //     $('#centerthiknessnew').hide();
    //     $('#cylinderneww').hide();
    //     $('#axisneww').hide();
    //     $('#visioneffectnew').hide();
    //     $('#frametypenew').show();
    //     $('#lenstypenew').hide();
    //     $('#addpowernew').hide();
    //     $('#coatingnew').hide();
    //     $('#framestylenew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#diameterlenss').hide();
    //     $('#gendernew').show();
    //     $('#lenstechnologynew').show();
    //     $('#premiumtypenew').show();
    //     $('#addpowerlenss').hide();

    // }else if(categoryname == 'Contact Lens Solutions'){
    //     $('#productskunew').show();
    //     $('#titlenew').show();
    //     $('#brandnamenew').show();
    //     $('#shelflifenew').show();
    //     $('#manufracturernew').show();
    //     $('#weightnew').show();
    //     $('#packageweightnew').show();
    //     $('#packagewidthnew').show();
    //     $('#packageheightnew').show();
    //     $('#packagelengthnew').show();
    //     $('#countryoforiginnew').show();
    //     $('#hsncodenew').show();
    //     $('#descriptionnew').show();
    //     $('#formnew').show();
    //     $('#productcolornew').show();
    //     $('#netquntitynew').show();
    //     $('#warrentytypenew').show();
    //     $('#stocknew').show();
    //     $('#policynew').show();
        
    //     $('#centerthiknessneww').hide();
    //     $('#shapenew').hide();
    //     $('#framecolornew').hide();
    //     $('#gendernew').hide();
    //     $('#lenstypenew').hide();
    //     $('#visioneffectnew').hide();
    //     $('#modelnonew').hide();
    //     $('#sellernamenew').hide();
    //     $('#addpowerlenss').hide();
    //     $('#diameterlenss').hide();
    //     $('#spheres').hide();
    //     $('#axisnlenss').hide();
    //     $('#cylinderlenss').hide();
    //     $('#framematerialnew').hide();
    //     $('#framewidthnew').hide();
    //     $('#usagesnew').hide();
    //     $('#usagesdurationnew').hide();
    //     $('#templematerialnew').hide();
    //     $('#templecolornew').hide();
    //     $('#lensmaterialtypenew').hide();
    //     $('#leanscoatingnew').hide();
    //     $('#contactlensmaterialtypenew').hide();
    //     $('#watercontentnew').hide();
    //     $('#diameternew').hide();
    //     $('#basecurvenew').hide();
    //     $('#powernewmin').hide();
    //     $('#powernewmax').hide();
    //     $('#cylinderneww').hide();
    //     $('#addpowernew').hide();
    //     $('#axisneww').hide();
    //     $('#centerthiknessneww').hide();
    //     $('#disposabilitynew').hide();
    //     $('#packagingnew').hide();
    //     $('#lenscolornew').hide();
    //     $('#contactlenscolornew').hide();
    //     $('#lenstechnologynew').hide();
    //     $('#lensindexnew').hide();
    //     $('#gravitynew').hide();
    //     $('#coatingnew').hide();
    //     $('#coatingcolornew').hide();
    //     $('#abbevaluenew').hide();
    //     $('#premiumtypenew').hide();
    //     $('#focallengthnew').hide();
    //     $('#productdimnew').hide();
    //     $('#materialnew').hide();
    //     $('#frametypenew').hide();
    //     $('#productdimensionnew').hide();
    //     $('#heightnew').hide();
    // } else{

    // }

});


if($("#maincats option:selected").text() == 'Frames'){
    $("#sizeCheck").attr('disabled', false);
}else if($("#maincats option:selected").text() == 'Contact Lenses'){
    $("#sizeCheck").attr('disabled', true);
    $("#sizeAttr").attr('disabled', true);
}else if($("#maincats option:selected").text() == 'Sunglasses'){
    $("#sizeCheck").attr('disabled', false);
}else if($("#maincats option:selected").text() == 'Lenses'){
    $("#sizeCheck").attr('disabled', true);
    $("#sizeAttr").attr('disabled', true);
}else if($("#maincats option:selected").text() == 'Accessories'){
    $("#sizeCheck").attr('disabled', false);
}else if($("#maincats option:selected").text() == 'Premium Brands'){
    $("#sizeCheck").attr('disabled', false);
}

window.onload = (event) => {
    let categoryname = $("#maincats option:selected").text();
    if( categoryname == "Frames" ) {
        $("#sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#contactlenscolornew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#usagesnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#framestylenew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#usagesdurationnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
        
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#frametypenew').show();
        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#frameshape').show();
        $('#sellername').show();
        $('#gendernew').show();

    }else if(categoryname == "Contact Lenses") { 
        $("#sizeCheck").attr('disabled', true);
        $("#sizeAttr").attr('disabled', true);
        $('#catetwonew').hide();
        $('#lenscolornew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#coatingnew').hide();
        $('#visioneffectnew').hide();
        $('#spherelens').hide();
        $('#axisnlens').hide();
        $('#cylinderlens').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#usagesnew').hide();
        $('#frametypenew').hide();

        $('#weightnew').show();
        $('#lenstechnologynew').show();
        $('#packageweightnew').show();
        $('#contactlensmaterialtypenew').show();
        $('#watercontentnew').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#contactlenscolornew').show();
        $('#modelnonew').show();
        $('#usagesdurationnew').show();
        $('#centerthiknew').show();
        $('#lenstypenew').show();

        $('#lenstype').on('change', function() {
            let lensData = document.getElementById("lenstype");
            let lenscategoryname = lensData.value;
            if( lenscategoryname == "Single Vision" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
                
            }else if( lenscategoryname == "MultiFocal" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').show();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
                
            }else if( lenscategoryname == "toric and Astigmatism" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').show();
                $('#axisneww').show();
                $('#cylindernew').find('option:contains(0.00)').attr('disabled',true); 
                $('#cylindernew').find('option:contains(-0.50)').attr('disabled',true);
                
            }else if( lenscategoryname == "Plano" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
            }else {
                $('#diameternew').hide();
                $('#basecurvenew').hide();
                $('#powernewmin').hide();
                $('#powernewmax').hide();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
            }
        });

    }else if(categoryname == "Sunglasses"){
        $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#usagesnew').hide();
        $('#leanscoatingnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#usagesdurationnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        $('#addpowernew').hide();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#contactlenscolornew').hide();
        $('#framestylenew').hide();

        $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show(); 
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show(); 
        $('#frametypenew').show();
        $('#lensmaterialtypenew').show();
        $('#shapenew').show();
        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();

    }else if(categoryname == "Lenses"){
        $("#sizeAttr").attr('disabled', true);
        $("#sizeCheck").attr('disabled', true);
        $('#productcolornew').hide();
        $('#premiumtypenew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#frametypenew').hide();
        $('#allownew').hide();
        $('#usagesdurationnew').hide();
        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#netquntitynew').hide();
        $('#framecolornew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#usagesnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#shelflifenew').hide();
        $('#gendernew').hide();
        $('#formnew').hide();
        $('#contactlenscolornew').hide();
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#centerthiknew').hide();
        $('#weightnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameternew').hide();
        $('#addpowernew').hide();
        
        $('#lensmaterialtypenew').show();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#lensindexnew').show();
        $('#focallengthnew').show();
        $('#packageweightnew').show();
        $('#gravitynew').show();
        $('#coatingcolornew').show();
        $('#abbevaluenew').show();
        $('#visioneffectnew').show();
        $('#coatingnew').show();

        $("#visioneffect").on("change", function(){
            let lenstypeChange = document.getElementById("visioneffect");
            let lentype = lenstypeChange.value;
            if(lentype == "Biofocal"){
                $("#cylinderlenss").show();
                $("#axisnlenss").show();
                $("#spheres").show();
                $("#diameterlenss").show();
                $("#addpowerlenss").show();
            }else if(lentype == "Progressive"){
                $("#cylinderlenss").show();
                $("#axisnlenss").show();
                $("#spheres").show();
                $("#diameterlenss").show();
                $("#addpowerlenss").show();
            }else if(lentype == "single Vision"){
                $("#cylinderlenss").show();
                $("#axisnlenss").show();
                $("#spheres").show();
                $("#diameterlenss").show();
                $("#addpowerlenss").hide();
            }else if(lentype == "Zero Power"){
                $("#cylinderlenss").show();
                $("#axisnlenss").show();
                $("#spheres").show();
                $("#diameterlenss").show();
                $("#addpowerlenss").hide();
            }
        })
    }else if(categoryname == "Premium Brands"){
        $("#sizeCheck").attr('disabled', false);
        $('#framestylenew').hide();
        $('#contactlenscolornew').hide();
        $('#usagesnew').hide();
        $('#leanscoatingnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#usagesdurationnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#sellernamenew').hide();
        
        console.log($("#addpowerlenss"));
        $("#addpowerlenss").hide();
        $("#diameterlenss").hide();
        
        $('#lensmaterialtypenew').show();
        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#lenstechnologynew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#frametypenew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#lenscolornew').show();
        $('#premiumtypenew').show();
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#framecolornew').show();
        $('#gendernew').show();

    }else if(categoryname == 'Contact Lens Solutions'){
        $('#shapenew').hide();
        $('#framecolornew').hide();
        $('#gendernew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#modelnonew').hide();
        $('#sellernamenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#framematerialnew').hide();
        $('#framewidthnew').hide();
        $('#usagesnew').hide();
        $('#usagesdurationnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#watercontentnew').hide();
        $('#diameternew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#addpowernew').hide();
        $('#axisneww').hide();
        $('#centerthiknew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#gravitynew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#premiumtypenew').hide();
        $('#focallengthnew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#frametypenew').hide();
        $('#productdimensionnew').hide();
        $('#heightnew').hide();

        $('#productskunew').show();
        $('#titlenew').show();
        $('#brandnamenew').show();
        $('#manufracturernew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#countryoforiginnew').show();
        $('#hsncodenew').show();
        $('#shelflifenew').show();
        $('#descriptionnew').show();
        $('#formnew').hide();
        $('#productcolornew').show();
        $('#netquntitynew').show();
        $('#warrentytypenew').show();
    }
    else if(categoryname == "Accessories"){
        $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#productdimensionnew').hide();
        $('#framecolornew').hide();
        $('#frametypenew').hide();
        $('#centerthiknew').hide();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide(); 
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();  
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#contactlenscolornew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#usagesnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').show();
        $('#productdimnew').hide();
        $('#materialnew').show();
        $('#warrentytypenew').show();
        $('#weightnew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').show();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#gendernew').hide();
        $('#coatingnew').hide();
        $('#manufracturer').show();
        $('#visioneffectnew').hide();
        $('#framedimensionnew').hide();
        $('#premiumtypenew').hide();
        $("#premiumtype").attr("required", false);
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();

    }else{ }
};


$('#childs').select2({
    width: '100%',
    placeholder: "Select Child Category",
    allowClear: true
});
$('#subs').select2({
    width: '100%',
    placeholder: "Select Sub Category",
    allowClear: true
});


$('#lenstechnology').select2({
    width: '100%',
    placeholder: "Select lenstechnology ",
    allowClear: true
});


$('#coating').select2({
    width: '100%',
    placeholder: "Select Coating ",
    allowClear: true
});
$('#gender').select2({
    width: '100%',
    placeholder: "Select gender ",
    allowClear: true
});
$('#axisnew').select2({
    width: '100%',
    placeholder: "Select Axis",
    allowClear: true
});
$('#addpower').select2({
    width: '100%',
    placeholder: "Select  Power",
    allowClear: true
});
$('#basecurve').select2({
    width: '100%',
    placeholder: "Select Base curve",
    allowClear: true
});
$('#powermin').select2({
    width: '100%',
    placeholder: "Select Power",
    allowClear: true
});

$('#powermax').select2({
    width: '100%',
    placeholder: "Select Power",
    allowClear: true
});
$('#addpower').select2({
    width: '100%',
    placeholder: "Select  Power",
    allowClear: true
});
$('#diameter').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
});
$('#cylindernew').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
});
$('#addpowerlens').select2({
    width: '100%',
    placeholder: "Select Add Power",
    allowClear: true
});
$('#diameterlens').select2({
    width: '100%',
    placeholder: "Select Add Power",
    allowClear: true
});
$('#axisnlens').select2({
    width: '100%',
    placeholder: "Select Axis",
    allowClear: true
});
$('#spherelens').select2({
    width: '100%',
    placeholder: "Select Sphere",
    allowClear: true
});
$('#cylinderlens').select2({
    width: '100%',
    placeholder: "Select Cylinder",
    allowClear: true
});

$('#subs').change(function() {

    $.ajax({
        type : 'POST',
        url : baseUrl + "/childcats",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            "subid" : $(this).val(),
            },
        success: function (resp) {
            let value = '';
            $('#childs').removeAttr('disabled');
            $('#childs').empty();
            let id = resp.response.id;
            let name = resp.response.name;
            for (let i = 0; i < id.length; i++) {
                value = '<option value="' + id[i] + '">' + name[i] + '</option>';
                $('#childs').append(value);
            }
        },
    })
})


$(document).ready(function() {
    $(document).on('change',".imagevalidation",function(){
        // alert("sadsad");
        // $('.imagevalidation').bind('change', function() {
        let _URL = window.URL || window.webkitURL;
        let serial = $(this).attr("data-image_val");
        $("#image"+serial).find("span>strong").text("");
        $("#image"+serial).find("span>strong").text("");
        let a=(this.files[0].size);
        let fileSize = Math.round(this.files[0].size/1024);
        let image_width = image_height = 0;
        let img = new Image()
        img.src = window.URL.createObjectURL(this.files[0])
        img.onload = () => {
            image_width = parseInt(img.width);
            image_height = parseInt(img.height);
            if(image_width == 1300 && image_height == 1160) {
                if(fileSize > 100) {
                        $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " Size large");
                        // myImgRemove(serial);
                }
            }else {
                $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " size should be 1300px and 1160px");
            }

        }
    });

    let test = 2;
    $("#addimg").click(function(){
        $(".clone").find("input[type='file']").attr("data-image_val",test);
        let lsthmtl = $(".clone").html();


        lsthmtl += "<div id='image"+test+"' class='error'>"+
                                    "<span class='help-block'>"+
                                        "<strong style='color: red;'></strong>"+
                                        "</span>"+
                            "</div>";

        $(".increment").after(lsthmtl);
        test++;
    });

    $("body").on("click","#removeimg",function(){

    $(this).parents(".hdtuto").remove();

    });

});



$("#productFormSubmit").on("submit", function(e){
    e.preventDefault();
    const url = baseUrl + "/admin/products/updateVendorProduct"
    let formData = new FormData(this);
    $.ajax({
        method: 'POST',
        url: url,
        data: formData,
        processData: false, 
        contentType: false,
        dataType: 'JSON',
        beforeSend: function(){
            $("#loader").show();
            productFormSubmit.classList.add("load");
            $("#page-wrapper").hide();
        },
        complete: function(){
            $("#loader").hide();
            productFormSubmit.classList.remove("load");
            $("#page-wrapper").show();
        },
        success: function(resp){
            if(resp.status == "success"){
                window.location = baseUrl + '/admin/products/';
                alert(resp.message);
            }
        }
    });
});


const validate = ()=>{
    if($('#name').val() == ''){
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Enter Product Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#name').focus();
        return false
    }

    if($('#maincats').val() == ''){
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Main Category',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#maincats').focus();
        return false
    }

    if($('#maincats').val() != ''){
        //frame
        if($('#maincats').val() == 53)
        { 
            if(frameValidation())
            {
                return true;
            }else{
                return false;
            }
        }
        //sunglass
        if($('#maincats').val() == 63)
        {  
            if(SunglassValidation())
            {
                return true;
            }else{
                return false;
            }
        }
        //Contact Lens
        if($('#maincats').val() == 72)
        {  
            if(ContaclensValidation())
            {
                return true;
            }else{
                return false;
            }
        }
        //  Premium Brands
        if($('#maincats').val() == 82)
        {  
            if(premiumbrandsValidation())
            {
                return true;
            }else{
                return false;
            }
        }
        //  lenses
        if($('#maincats').val() == 58)
        {  
            if(lensesValidation())
            {
                return true;
            }else{
                return false;
            }
        }
        // lenses solution
    
        if($('#maincats').val() == 87){  
            if(lenses_solution_Validation()){
                return true;
            }else{
                return false;
            }
        }
    }
}


function lenses_solution_Validation() {
    if($('#subs').val() == ""){
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One SubCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
        })
    $('#subs').focus();
    return false;
    }
    return true;
}


function lensesValidation() {
    if($('#subs').val() == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One SubCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#subs').focus();
        return false;
    }
    if($('#childs').val() == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One ChildCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#childs').focus();
        return false;
    }
    // if($('#uploadFile').val() == '')
    // {
    //     alert("Please Fill Current Featured Image Filed");
    //     
    //     return false;
    // }
    if($('#pre_mrp').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill MRP Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pre_mrp').focus();
        return false;
    }
    return true;
}

function frameValidation(){
    let data = [];
    data[0] = document.getElementById('subs');
    data[1] = document.getElementById('childs');
    data[2] = document.getElementById('shape');
    data[3] = document.getElementById('color');
    data[4] = document.getElementById('gender');
    data[5] = document.getElementById('brandname');
    data[6] = document.getElementById('modelno');
    data[7] = document.getElementById('sellername');
    data[8] = document.getElementById('framematerial');
    data[9] = document.getElementById('frametype');
    data[10] = document.getElementById('manufracturer');
    data[11] = document.getElementById('productdimension');
    data[12] = document.getElementById('weight');
    data[13] = document.getElementById('packweight');
    data[14] = document.getElementById('packwidth');
    data[15] = document.getElementById('packheight');
    data[16] = document.getElementById('packlength');
    data[17] = document.getElementById('countryoforigin');
    data[18] = document.getElementById('hsncode');
    data[19] = document.getElementById('pre_mrp');
    data[20] = document.getElementById('pro_costprice');
    data[21] = document.getElementById('pro_stock');
    data[21] = document.getElementById('policy');
    for(let x=0; x<data.length; x++){
        if(data[x].value == ''){
            Swal.fire({
                    title: data[x],
                    text: data[x],
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            data[x].focus();
        }
        return;
    }
    return true;
}

function SunglassValidation() {
    let data = [];
    data[0] = document.getElementById('subs');
    data[1] = document.getElementById('childs');
    data[2] = document.getElementById('shape');
    data[3] = document.getElementById('color');
    data[4] = document.getElementById('gender');
    data[5] = document.getElementById('brandname');
    data[6] = document.getElementById('modelno');
    data[7] = document.getElementById('sellername');
    data[7] = document.getElementById('lensmaterialtype');
    data[8] = document.getElementById('framematerial');
    data[9] = document.getElementById('frametype');
    data[10] = document.getElementById('manufracturer');
    data[11] = document.getElementById('productdimension');
    data[12] = document.getElementById('weight');
    data[13] = document.getElementById('packeageweight');
    data[14] = document.getElementById('packwidth');
    data[15] = document.getElementById('packheight');
    data[16] = document.getElementById('packlength');
    data[17] = document.getElementById('countryoforigin');
    data[18] = document.getElementById('hsncode');
    data[19] = document.getElementById('pre_mrp');
    data[20] = document.getElementById('pro_costprice');
    data[21] = document.getElementById('pro_stock');
    data[21] = document.getElementById('textarea#policy');
    data[22] = document.getElementById('lenscolor');

    for(let x=0; x<data.length; x++){
        if($('policy').val() == ''){
            Swal.fire({
                    title: data[x],
                    text: data[x],
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            data[x].focus();
        }
        return;
    }
}

function ContaclensValidation() {
    if($('#subs').val() == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One SubCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#subs').focus();
        return false;
    }
    if($('#childs').val() == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One ChildCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#childs').focus();
        return false;
    }
    if($('#brandname').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Brand Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#brandname').focus();
        return false;
    }
    if($('#lenstype').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Contact Lens Type',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#lenstype').focus();
        return false;
    }else if($('#lenstype').val() == 'Single Vision'){
        
        if($('#diameter').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Diameter',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#diameter').focus();
            return false;
        }
        if($('#basecurve').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Basecurve',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#basecurve').focus();
            return false;
        }
        if($('#powermin').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (-)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermin').focus();
            return false;
        }
        if($('#powermax').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (+)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermax').focus();
            return false;
        }
    }  // herer condition 
    else if($('#lenstype').val() == 'MultiFocal'){
        
        if($('#diameter').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Diameter',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#diameter').focus();
            return false;
        }
        if($('#basecurve').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Basecurve',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#basecurve').focus();
            return false;
        }
        if($('#powermin').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (-)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermin').focus();
            return false;
        }
        if($('#powermax').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (+)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermax').focus();
            return false;
        }
        if($('#addpower').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Add Power',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#addpower').focus();
            return false;
        }
    }else if($('#lenstype').val() == 'toric and Astigmatism'){
        
        if($('#diameter').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Diameter',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#diameter').focus();
            return false;
        }
        if($('#basecurve').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Basecurve',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#basecurve').focus();
            return false;
        }
        if($('#powermin').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (-)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermin').focus();
            return false;
        }
        if($('#powermax').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (+)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermax').focus();
            return false;
        }
        if($('#cylindernew').val() == '')
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Fill Cylinder Lens Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#cylindernew').focus();
            return false;
        }
        if($('#axisnew').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Axis',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#axisnew').focus();
            return false;
        }
    }else if($('#lenstype').val() == 'Single Vision'){
        
        if($('#diameter').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Diameter',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#diameter').focus();
            return false;
        }
        if($('#basecurve').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Basecurve',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#basecurve').focus();
            return false;
        }
        if($('#powermin').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (-)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermin').focus();
            return false;
        }
        if($('#powermax').val().length == 0)
        {
        
            Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One Sphere Power (+)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#powermax').focus();
            return false;
        }
    }  
    if($('#modelno').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Model No Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#modelno').focus();
        return false;
    }
    if($('#sellername').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Seller Name Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#sellername').focus();
        return false;
    }
    if($('#lenscolor').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Lens Color Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#lenscolor').focus();
        return false;
    }
    if($('#manufracturer').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Manufracturer Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#manufracturer').focus();
        return false;
    }
    if($('#weight').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Weight Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#weight').focus();
        return false;
    }
    if($('#packeageweight').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Weight Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packeageweight').focus();
        return false;
    }
    if($('#packwidth').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Width Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packwidth').focus();
        return false;
    }
    if($('#packheight').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Height Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packheight').focus();
        return false;
    }
    if($('#packlength').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Length Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packlength').focus();
        return false;
    }
    if($('#countryoforigin').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Country Of Origin Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packlength').focus();
        return false;
    }
    if($('#hsncode').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Hsn Code Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#hsncode').focus();
        return false;
    }

    if($('#pre_mrp').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill MRP Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pre_mrp').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Cost Price Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pro_costprice').focus();
        return false;
    }
    if($('#pro_stock').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Stock Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pro_stock').focus();
        return false;
    }
    if($('textarea#policy').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Buy/Return Policy Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#policy').focus();
        return false;
    }

    if($('#packaging').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packaging Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packaging').focus();
        return false;
    }
    return true;
    }

function premiumbrandsValidation() {
    if($('#premiumtype').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Premium Type Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#premiumtype').focus();
        return false;
    }
    if($('#subs').val() == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One SubCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#subs').focus();
        return false;
    }
    if($('#childs').val().length == 0)
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select At Least One ChildCategory',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#childs').focus();
        return false;
    }
    if($('#shape').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Frame Shape Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#shape').focus();
        return false;
    }
    if($('#color').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Frame Color Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#color').focus();
        return false;
    }
    if($('#gender').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Gender',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#gender').focus();
        return false;
    }
    if($('#brandname').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Brand Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#brandname').focus();
        return false;
    }
    if($('#modelno').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Model No',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#modelno').focus();
        return false;
    }
    if($('#sellername').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Seller Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#sellername').focus();
        return false;
    }
    if($('#framematerial').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Frame Material',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#framematerial').focus();
        return false;
    }
    if($('#lensmaterialtype').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Lens Material Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#lensmaterialtype').focus();
        return false;
    }
    if($('#lenscolor').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Lens Color Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#lenscolor').focus();
        return false;
    }
    if($('#frametype').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Frame Type',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#frametype').focus();
        return false;
    }
    if($('#manufracturer').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Manufracturer Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#manufracturer').focus();
        return false;
    }
    if($('#productdimension').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Frame Dimension Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#productdimension').focus();
        return false;
    }
    if($('#weight').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Weight Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#weight').focus();
        return false;
    }
    // if($('#frameheight').val() == '')
    // {
    //     alert("Please Fill Frame Height Filed");
    //$('#frameheight').focus();     

    //     return false;
    // }
    if($('#packeageweight').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Weight Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packeageweight').focus();
        return false;
    }
    if($('#packwidth').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Width Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packwidth').focus();
        return false;
    }
    if($('#height').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Height Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#height').focus();
        return false;
    }
    if($('#packlength').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Packeage Length Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#packlength').focus();
        return false;
    }
    if($('#countryoforigin').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Country Of Origin Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#countryoforigin').focus();
        return false;
    }
    if($('#hsncode').val() == '')
    {
    
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Hsn Code Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#hsncode').focus();
        return false;
    }

    if($('#pre_mrp').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill MRP Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pre_mrp').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Cost Price Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pro_costprice').focus();
        return false;
    }
    if($('#pro_stock').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Stock Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#pro_stock').focus();
        return false;
    }
    if($('textarea#policy').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Buy/Return Policy Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#policy').focus();
        return false;
    }
    return true;
}
