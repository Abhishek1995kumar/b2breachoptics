ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => { } )
    .catch( error => {
} );

$(document).ready(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
 });


$(document).on('click', '#available_pro_color', function(){ 
    var product_id = $('#productsku').val();
    if($(this).is(':checked')) {
        $('#color_table').dataTable({
            'serverSide': true,
            'processing': false,
            'searching' : false,
            'ordering' : false,
            'paging' : false,
            'scrollY': '300px',
            'scrollCollapse': true,
            'info' : false,
            'bDestroy' : true,
            "createdRow": function( row, data, dataIndex ) {
                $(row).find('td:eq(0)').attr('contentEditable',true);
                $(row).find('td:eq(0)').attr('row_id', data[data.length - 1]);
                $(row).find('td:eq(0)').attr('column_name','color');
                $(row).find('td:eq(0)').css('text-align', 'center');

                $(row).find('td:eq(1)').attr('contentEditable',true);
                $(row).find('td:eq(1)').attr('row_id', data[data.length - 1]);
                $(row).find('td:eq(1)').attr('column_name','attr_color_code');
                $(row).find('td:eq(1)').css('text-align', 'center');

                // $(row).find('td:eq(2)').attr('contentEditable',true);
                // $(row).find('td:eq(2)').attr('row_id', data[data.length - 1]);
                // $(row).find('td:eq(2)').attr('column_name','attr_imgs');
                // $(row).find('td:eq(2)').css('text-align', 'center');

                // let imageField = document.getElementById('color_file');
                // imageField.innerHTML = `${row.innerHTML}<tr><td><input name="attr_imgs[]" id="color_file" type="file" multiple class="form-control" aria-required="true" aria-invalid="false" value="" ></td></tr>`;
                // row = imageField.content;
                // console.log(imageField);

                // if($(row).find('td:eq(2)').attr('column_name', 'attr_imgs') > 0){
                //     $(row).find('td:eq(2)').attr('contentEditable',true);
                //     $(row).find('td:eq(2)').attr('row_id', data[data.length - 1]);
                //     $(row).find('td:eq(2)').attr('column_name','attr_imgs');
                //     $(row).find('td:eq(2)').css('text-align', 'center');
                // }else{
                //     $(row).find('td:eq(2)').after('<input name="attr_imgs[]" id="color_file" type="file" multiple class="form-control" value="" >');
                // }

                $(row).find('td:eq(3)').css('text-align', 'center');
    
                $(row).find('td:eq(4)').hide();
            },
            'ajax' : {
                'type' : 'POST',
                'url'  : baseUrl + "/admin/attr_color_fetch",
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'data' : {
                    product_id : product_id ,
                },
            },
        });
    } 
});


$(document).on('blur', '#color_table', function(e){
    const id = $(e.target).attr("row_id");
    const column_name = $(e.target).attr("column_name");
    const value = $(e.target).text();
    const data = {id:id, table_column:column_name, value:value};
    const url = baseUrl + "/admin/updateColorValue";
    
    // console.log($(e.target).text());
    // if(column_name == "attr_imgs"){
    //     // let updateImageField = '<input name="attr_imgs[]" id="color_file" type="file" multiple class="form-control" value="" >';
    //     // column_name.innerHTML = updateImageField
    //     // console.log(column_name)
    // }
    $.ajax({
        type:'POST',
        dataType : 'JSON',
        url:url,
        data: {
            data:data,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(resp){
            if(resp.status=='success'){
                $('#color_table').DataTable().ajax.reload();
                // alert("update color data !!");
            }
        }
    })
});


$(document).on('click', "#product_color_attr", function(e){
    e.preventDefault();
    let fileInput = $('#color_file')[0];
    let product_id = $('#productsku').val();
    let add_attr_color = $('#attr_color').val();
    let add_attr_color_code = $('#attr_color_code').val();
    if(product_id != '' && add_attr_color != '' && add_attr_color_code != '') {
        if( fileInput.files.length > 0 ){
            let formData = new FormData();
            $.each(fileInput.files, function(k,file){
                formData.append('images[]', file);
            });
           
            formData.append('product_id', product_id);
            formData.append('color', add_attr_color);
            formData.append('attr_color_code', add_attr_color_code);
            let url = baseUrl + "/admin/product_color_attr ";
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
                beforeSend: function() {
                    $('#product_color_attr').text('Adding...');
                    $('#product_color_attr').prop("disabled", true);
                },
                complete: function() {
                    $('#product_color_attr').text('Add');
                    $('#product_color_attr').prop("disabled", false);
                },
                success: function(resp) {
                    if(resp.status == 200)  {
                        $('#attr_color_code').val('');
                        $('#attr_color').val('');
                        $('#color_file').val('');
                        attr_color_dropdown();
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
        if(product_id == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'PRODUCT SKU REQUIRED !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if(add_attr_color == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill Attribute Color !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    }
});

function attr_color_dropdown() {
    let id = $('#productsku').val();
    let url = baseUrl + "/admin/attr_color_dropdown";
    console.log(url);
    $.ajax({  
        url:url,  
        method:"POST",  
        dataType : 'json',
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            id:id,
        }, 
        success:function(resp) {  
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
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                id:id,
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
       attr_color_dropdown();
    }else {
        $('#manage_pro_attr_div').hide();
    }
});

$(document).on('click', '#available_pro_color', function() {
    if(this.checked) {
       $('#product_color_div').show();
    }else {
        $('#product_color_div').hide();
    }
});

function replicateManageTable(tbl_name) {
    var tbl = '#'+tbl_name;
    let att_pro_sku =  $(tbl).find('tr:last .att_pro_sku').val();
    let attr_pro_size =  $(tbl).find('tr:last .attr_pro_size').val();
    let attr_pro_qty =  $(tbl).find('tr:last .attr_pro_qty').val();
    let attr_mrp =  $(tbl).find('tr:last .attr_mrp').val();
    let attr_pro_price =  $(tbl).find('tr:last .attr_pro_price').val();
    let attr_pro_color =  $(tbl).find('tr:last .attr_pro_color').val();
    if(att_pro_sku != '' && attr_pro_qty != '' && attr_pro_price != '' && attr_pro_color != '' && attr_mrp != '') {
        tbl = $(tbl).find('tr:last');
        tbl = tbl.attr('id');
        var new_id = parseInt(tbl) + 1;
        var myRow = $('#manage_attr_table').closest('table').find('tr:last-child').clone().attr('id', new_id); 
        myRow.find('.att_pro_sku').val("");
        myRow.find('.attr_pro_size').val("");
        myRow.find('.attr_pro_qty').val("");
        myRow.find('.attr_mrp').val("");
        myRow.find('.attr_pro_price').val("");
        myRow.find('.attr_pro_color').val("");
        myRow.find('.replicaClass').html(`<i class="fa fa-minus" onclick="removeReplica(event)"></i>`);
        $('#manage_attr_table tr:last').after(myRow);
    }else {
        if(att_pro_sku == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill Attribute SKU !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if(attr_pro_qty == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill Attribute QTY !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if(attr_mrp == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill Attribute MRP !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if(attr_pro_price == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill Attribute CP !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if(attr_pro_color == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Select Attribute Color !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Fill All data !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    }
}

function removeReplica(event) {
    event.target.parentElement.parentElement.parentElement.remove();
}



bkLib.onDomLoaded(function() {
    new nicEditor().panelInstance('description');
    new nicEditor().panelInstance('policy');
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#adminimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#maincats').on('change', function() {
    let select_status = document.getElementById("maincats");
    let categoryname = select_status.options[select_status.selectedIndex].text;
    if( categoryname == "Frames" ) {
        $(".sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#productdimensionAccessories').hide();
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
        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#premiumtypenew').hide();

        // $('#packageweightnew').show();
        // $('#packagewidthnew').show();
        // $('#packageheightnew').show();
        // $('#packagelengthnew').show();
        // $('#productdimensionnew').show();
        // $('#weightnew').show();
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#warrentytypenew').show();
        $('#frametypenew').show();
        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#frameshape').show();
        $('#sellername').show();
        $('#gendernew').show();

        $('.attr_pro_size').removeAttr('readonly', 'readonly');
        
        $("#premiumtype").attr("required", false);
        
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
    }else if(categoryname == "Contact Lenses") { 
        $("#sizeAttr").attr('disabled', true);
        $(".sizeCheck").attr('disabled', true);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#gendernew').hide();
        $('#productdimensionAccessories').hide();
        $('#colornew').hide();
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
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        
        $("#premiumtype").attr("required", false);
        
        // $('#packageweightnew').show();
        // $('#packageheightnew').show();
        // $('#packagelengthnew').show();
        // $('#packagewidthnew').show();
        // $('#weightnew').show();
        $('#contactlensmaterialtypenew').show();
        $('#watercontentnew').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#contactlenscolornew').show();
        $('#lenscolornew').hide();
        $('#modelnonew').show();
        $('#centerthiknessneww').show();
        $('#usagesdurationnew').show();
        $('#lenstypenew').show();

        $('#premiumtypenew').hide();
        $('#lenstechnologynew').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
        
        $('#diameternew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#addpowernew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('.attr_pro_size').attr('readonly', 'readonly');
        
        $('#lenstype').on('change', function() {
            let lensData = document.getElementById("lenstype");
            let lenscategoryname = lensData.options[lensData.selectedIndex].text;
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
        $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framestylenew').hide();
        $('#framematerialnew').show();
        $('#productdimensionAccessories').hide();
        $('#templematerialnew').show();
        $('#templecolornew').show(); 
        $('#contactlenscolornew').hide();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show(); 
        $('#frametypenew').show();
        $('#usagesnew').hide();
        $('#lensmaterialtypenew').show();
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
        $('#shapenew').show();

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
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
        
        $("#premiumtype").attr("required", false);
        
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

    }else if(categoryname == "Lenses"){
        $("#sizeAttr").attr('disabled', true);
        $(".sizeCheck").attr('disabled', true);
        $('#lensmaterialtypenew').show();
        $('#diameternew').hide();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#productdimensionAccessories').hide();
        $('#contactlenscolornew').hide();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#lensindexnew').show();
        $('#focallengthnew').show();
        $('#weightnew').show();
        $('#catetwonew').hide();
        $('#gendernew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#usagesnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
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

        $('#gravitynew').show();
        $('#coatingcolornew').show();
        $('#abbevaluenew').show();
        $('#netquntitynew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').show();
        $('#coatingnew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#premiumtypenew').hide();
        
        $("#premiumtype").attr("required", false);
        
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
        
        $('#visioneffect').on('change', function() {
            var lensData = document.getElementById("visioneffect");
            var lenscategoryname = lensData.options[lensData.selectedIndex].text;

        if( lenscategoryname == "Single Vision" ) {
                $('#single_pds').hide();
                $('#double_pds').hide();
                $('#addpowerlenss').hide();
                $('#axisnlenss').show();
                $('#cylinderlenss').show();
                $('#spheres').show();
                $('#diameterlenss').show();
            }
            else if(lenscategoryname == "Biofocal"){
                $('#single_pds').show();
                $('#double_pds').show();
                $('#addpowerlenss').show();
                $('#axisnlenss').show();
                $('#cylinderlenss').show();
                $('#spheres').show();
                $('#diameterlenss').show();
            }
            else if(lenscategoryname == "Progressive"){
                $('#single_pds').show();
                $('#double_pds').show();
                $('#addpowerlenss').show();
                $('#axisnlenss').show();
                $('#cylinderlenss').show();
                $('#spheres').show();
                $('#diameterlenss').show();
            }
        });
        
    }else if(categoryname == "Accessories"){
        $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#productdimensionnew').hide();
        $('#frametypenew').hide();
        $('#packageweightnew').show();
        $('#productdimensionAccessories').show();
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

    }
    else if(categoryname == "Premium Brands"){
        $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#shapenew').show();
        $('#productdimensionAccessories').hide();
        $('#colornew').show();
        $('#framestylenew').hide();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show(); 
        $('#contactlenscolornew').hide();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show(); 
        $('#frametypenew').show();
        $('#usagesnew').hide();
        $('#lensmaterialtypenew').show();
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
        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        $('#premiumtypenew').show();
        $("#premiumtype").attr("required", true);
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#single_pds').hide();
        $('#double_pds').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();
        
    }else if(categoryname == 'Contact Lens Solutions'){
        $('#productskunew').show();
        $('#titlenew').show();
        $('#brandnamenew').show();
        $('#productdimensionAccessories').hide();
        $('#shelflifenew').show();
        $('#manufracturernew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#countryoforiginnew').show();
        $('#hsncodenew').show();
        $('#descriptionnew').show();
        $('#formnew').hide();
        $('#productcolornew').show();
        $('#netquntitynew').show();
        $('#warrentytypenew').show();
        $('#stocknew').show();
        $('#policynew').show();
        
        
        $('#shapenew').hide();
        $('#colornew').hide();
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
        $('#centerthiknessneww').hide();
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
        $('#centerthiknessneww').hide();
    
        
    } else{ }
});



$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#multiple_files").on("change", function(e) {
        var multiple_files = e.target.files,
            filesLength = multiple_files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = multiple_files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
            var file = e.target;
            $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"img-delete\">Remove</span>" +
                "</span>").insertAfter("#multiple_files");
            $(".img-delete").click(function(){
                $(this).parent(".pip").remove();
            });
            });
            fileReader.readAsDataURL(f);
        }
        });
    } else {
        alert("|Sorry, | Your browser doesn't support to File API")
    }

    $('.imagevalidation').bind('change', function() {
        var _URL = window.URL || window.webkitURL;
        var serial = $(this).attr("data-image_val");
        $("#image"+serial).find("span>strong").text("");
        $("#image"+serial).find("span>strong").text("");
        var fileSize = Math.round(this.files[0].size/1024);
        var image_width = image_height = 0;
        let img = new Image()
        img.src = window.URL.createObjectURL(this.files[0])
        img.onload = () => {
            image_width = parseInt(img.width);
            image_height = parseInt(img.height);

            if((image_width >= 100 && image_width >= 100) && (image_height >= 100 && image_height >= 100)) {
            if(fileSize > 110) {
                    $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " Size large");
                    myImgRemove(serial);
                } 
            }
    
            else {
                myImgRemove(serial);
                $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " size should between 1300px and 1160px");
            }

        }
        // var fileExtension = ['png','jpg','jpeg','gif'
        
    });


    const validateMaxImageFileSize = (e) => {
        e.preventDefault();
        const el = $("input[type='file']")[0];

        if (el.files && el.files[0]) {
            const file = el.files[0];

            const maxFileSize = 5242880; // 5 MB
            const maxWidth = 1920;
            const maxHeight = 1080;

            const img = new Image();
            img.src = window.URL.createObjectURL(file);
            img.onload = () => {
            if (file.type.match('image.*') && file.size > maxFileSize) {
                alert('The selected image file is too big. Please choose one that is smaller than 5 MB.');
            } else if (file.type.match('image.*') && (img.width > maxWidth || img.height > maxHeight)) {
                alert(`The selected image is too big. Please choose one with maximum dimensions of ${maxWidth}x${maxHeight}.`);
            } else {
                e.target.nodeName === 'INPUT'
                ? (e.target.form.querySelector("input[type='submit']").disabled = false)
                : e.target.submit();
            }
            };
        }
        };
});


var number = 1;
    do {
    function showPreview(event, number){
        if(event.target.files.length > 0){
        let src = URL.createObjectURL(event.target.files[0]);
        let preview = document.getElementById("file-ip-"+number+"-preview");
        preview.src = src;
        preview.style.display = "block";

        }
    }
    function myImgRemove(number) {
        document.getElementById("file-ip-"+number+"-preview").src = "https://i.ibb.co/ZVFsg37/default.png";
        document.getElementById("file-ip-"+number).value = null;
        }
    number++;
    }
    while (number < 5);



$('#subs').select2({
    width: '100%',
    placeholder: "Select Sub Category",
    allowClear: true

});
$('#childs').select2({
    width: '100%',
    placeholder: "Select Child Category",
    allowClear: true
});
$('#cylinderlens').select2({
    width: '100%',
    placeholder: "Select cylinder",
    allowClear: true
});
$('#sphere').select2({
    width: '100%',
    placeholder: "Select SPH",
    allowClear: true
});
$('#addpowerlens').select2({
    width: '100%',
    placeholder: "Select  Power",
    allowClear: true
});
$('#axisnlens').select2({
    width: '100%',
    placeholder: "Select Axis",
    allowClear: true
});
$('#diameterlens').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
});
$('#diameter').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
});
$('#powermin').select2({
    width: '100%',
    placeholder: "Select Min Power",
    allowClear: true
});

$('#powermax').select2({
    width: '100%',
    placeholder: "Select Max Power",
    allowClear: true
});

$('#basecurve').select2({
    width: '100%',
    placeholder: "Select Base curve",
    allowClear: true
});
$('#cylindernew').select2({
    width: '100%',
    placeholder: "Select cylinder",
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


$('#subs').change(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const url = baseUrl + "/childcats";
    $.ajax({
        type : 'POST',
        url : url,
        data : {
            "subid" : $(this).val()
        },
        success: function (resp) {  
           var s = ''; 
           $('#childs').removeAttr('disabled');
           $('#childs').empty();
           var id = resp.response.id;
           var name = resp.response.name;
           for (var i = 0; i < id.length; i++) { 
            s = '<option value="' + id[i] + '">' + name[i] + '</option>';
            $('#childs').append(s);
           }  
    },
          
    })
})



$('#vendor_name').select2({
    width:'100%',
    placeholder :"Select Vendor Name",
    allowClear:true
});

$('#lenstechnology').select2({
    width: '100%',
    placeholder: "Select lenstechnology",
    allowClear: true
});
$('#coating').select2({
    width:'100%',
    placeholder :"Select coating",
    allowClear:true
});

$('#gender').select2({
    width:'100%',
    placeholder :"Select gender",
    allowClear:true
});

$('#shape').select2({
    width:'100%',
    placeholder :"Select Frame Shape",
    allowClear:true
});
    
$('#brandname').select2({
    width:'100%',
    placeholder :"Select Brand Name",
    allowClear:true
});
    
$('#countryoforigin').select2({
    width:'100%',
    placeholder :"Select Country Origin",
    allowClear:true
});
    
$('#frametype').select2({
    width:'100%',
    placeholder :"Select Frame Type",
    allowClear:true
});
    
$('#framecolor').select2({
    width:'100%',
    placeholder :"Select Frame Color",
    allowClear:true
});
    
$('#framematerial').select2({
    width:'100%',
    placeholder :"Select Frame Metarial",
    allowClear:true
});

// $("#productFormSubmit").on("submit", function(e){
//     e.preventDefault();
//     let formData = new FormData(this);
//     const url = baseUrl + "/admin/products/addVendorProduct";
//     const url1 = "http://localhost/b2b.optical-hut/admin/products/";
//     if(validate()){
//         $.ajax({
//             method: 'POST',
//             url: url,
//             data: formData,
//             processData: false,
//             contentType: false, 
//             dataType: 'JSON',
//             beforeSend: function(){
//                 $("#loader").show();
//                 productFormSubmit.classList.add("load");
//                 $("#page-wrapper").hide();
//             },
//             complete: function(){
//                 $("#loader").hide();
//                 productFormSubmit.classList.remove("load");
//                 $("#page-wrapper").show();
//             },
//             success: function(resp){
//                 if(resp.status == "success"){
//                     // window.location.replace("http://localhost/b2b.optical-hut/admin/products"); 
//                     window.location.href = "productlist.blade.php"; 
//                     alert(resp.msg);
//                 }
//             }
//         });  
//     }
// });

$("#productFormSubmit").on("submit", function(e){
    e.preventDefault();
    let formData = new FormData(this);
    const url = baseUrl + "/admin/products/addVendorProduct";
    // if(validate()){
        $.ajax({
            method : 'POST',
            url : url,
            data : formData,
            dataType: 'JSON',
            processData : false,
            contentType : false,
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
    // }
});


const validate = ()=>{
    if($('#vendor_name').val() == ''){
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Vendor Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#vendor_name').focus();
        return false
    }

    if($('#productsku').val() == ''){
        Swal.fire({
                title: 'Message!',
                text: 'Please Enter Product Sku',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#productsku').focus();
        return false
    }

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
        
         //  Lenses
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
       if($('#maincats').val() == 87)
        {  
            if(lenses_solution_Validation())
            {
                return true;
            }else{
                return false;
            }
        }
    }
}

function lenses_solution_Validation(){
    if($('#subs').val().length == 0)
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
     return true;
}

function lensesValidation(){
    if($('#subs').val().length == 0)
    {
       // alert("Please Select At Least One SubCategory");
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
       // alert("Please Select At Least One ChildCategory");
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
    if($('#uploadFile').val() == '')
    {
       // alert("Please Fill Current Featured Image Filed");
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Current Featured Image Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#uploadFile').focus();
        return false;
    }
    if($('#pre_mrp').val() == '')
    {
       // alert("Please Fill MRP Filed");
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
    if($('#subs').val().length == 0)
    {
       // alert("Please Select At Least One SubCategory");
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
       // alert("Please Select At Least One ChildCategory");
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
    if($('#shape').val() == '')  {
       // alert("Please Select Frame Shape");
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Frame Shape',
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
       // alert("Please Select Frame Color");
        Swal.fire({
                title: 'Message!',
                text: 'Please Select Frame Color',
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Current Featured Image Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#uploadFile').focus();
        return false;
    }
    if($('#file-ip-1').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Gallery Images Filed(At Least One)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Descriptio Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#description').focus();
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

function SunglassValidation(){
    if($('#subs').val().length == 0)
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
                text: 'Please Select Frame Shape',
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
                text: 'Please Select Frame Color',
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
                text: 'Please Fill Model No Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#modelno').focus();
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Current Featured Image Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#uploadFile').focus();
        return false;
    }
    if($('#file-ip-1').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Gallery Images Filed(At Least One)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Descriptio Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#description').focus();
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

function ContaclensValidation(){
    if($('#subs').val().length == 0)
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
                text: 'Please Select At Least One Add Power',
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
    if($('#contact_lenscolor').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Lens Color Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#contact_lenscolor').focus();
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Current Featured Image Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#uploadFile').focus();
        return false;
    }
    if($('#file-ip-1').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Gallery Images Filed(At Least One)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Descriptio Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#description').focus();
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

function premiumbrandsValidation(){
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
    if($('#subs').val().length == 0)
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Current Featured Image Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#uploadFile').focus();
        return false;
    }
    if($('#file-ip-1').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Gallery Images Filed(At Least One)',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
                title: 'Message!',
                text: 'Please Fill Product Descriptio Filed',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        $('textarea#description').focus();
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

let validVideoExtensions = ['mp4','mkv','mov','wmv','avi'];
$(document).on("change", "#uploadFile1", function(e){
    let numb = e.target.files[0].size/1000;
    numb = numb.toFixed(0);
    if(numb <= 1000){  //1000kb = 1mb
        let fileName = e.target.files[0].name;
        let fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if(validVideoExtensions.includes(fileNameExt)){
            $(e.target.nextElementSibling.childNodes[3]).children()[0].src =  URL.createObjectURL(this.files[0]);
            e.target.nextElementSibling.childNodes[3].load();
            $(e.target.nextElementSibling).css("display", "flex");
        }else{
            alert('Only mp4, mkv, all video file types are accepted');
            $("#uploadFile1").val('');
            e.target.nextElementSibling.setAttribute("hidden", true);
        }
    }else{
        alert('To big Video, maximum size is 1MB. Your file size is: ' + numb/1000 + ' MB');
        $("#uploadFile1").val('');
        e.target.nextElementSibling.setAttribute("hidden", true);
    }
});

$(document).on("change", "#uploadFile2", function(e){
    let numb = e.target.files[0].size/1000;
    numb = numb.toFixed(0);
    if(numb <= 1000){  //1000kb = 1mb
        let fileName = e.target.files[0].name;
        let fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if(validVideoExtensions.includes(fileNameExt)){
            $(e.target.nextElementSibling.childNodes[3]).children()[0].src =  URL.createObjectURL(this.files[0]);
            e.target.nextElementSibling.childNodes[3].load();
            $(e.target.nextElementSibling).css("display", "flex");
        }else{
            alert('Only mp4, mkv, all video file types are accepted');
            $("#uploadFile2").val('');
            e.target.nextElementSibling.setAttribute("hidden", true);
        }
    }else{
        alert('To big Video, maximum size is 1MB. Your file size is: ' + numb/1000 + ' MB');
        $("#uploadFile2").val('');
        e.target.nextElementSibling.setAttribute("hidden", true);
    }
});

$(document).on("change", "#uploadFile3", function(e){
    let numb = e.target.files[0].size/1000;
    numb = numb.toFixed(0);
    if(numb <= 1000){  //1000kb = 1mb
        let fileName = e.target.files[0].name;
        let fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if(validVideoExtensions.includes(fileNameExt)){
            $(e.target.nextElementSibling.childNodes[3]).children()[0].src =  URL.createObjectURL(this.files[0]);
            e.target.nextElementSibling.childNodes[3].load();
            $(e.target.nextElementSibling).css("display", "flex");
        }else{
            alert('Only mp4, mkv, all video file types are accepted');
            $("#uploadFile2").val('');
            e.target.nextElementSibling.setAttribute("hidden", true);
        }
    }else{
        alert('To big Video, maximum size is 1MB. Your file size is: ' + numb/1000 + ' MB');
        $("#uploadFile3").val('');
        e.target.nextElementSibling.setAttribute("hidden", true);
    }
});

function remove_firstvideo(e){
    $(e.target.parentElement).css("display","none");
    $(e.target.parentElement).prev().val('');
}

function remove_secondvideo(e) {
    $(e.target.parentElement).css("display","none");
    $(e.target.parentElement).prev().val('');
}

function remove_thirdvideo(e) {
    $(e.target.parentElement).css("display","none");
    $(e.target.parentElement).prev().val('');
}

$(document).on("change", "#color_file", function(e){
    var a=(this.files[0].size);
    if(a > 100000)
    {
        $("#color_file").val('');
        alert("File Size Is Greater Than 1 MB.Please Upload File Below 1 MB"); 
    }
});



