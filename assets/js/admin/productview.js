$(document).ready(function() {
    var select_status = document.getElementById("maincats");
    var categoryname = select_status.value;
    if( categoryname == "Frames" )
    {
        $('#premiumtypenew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#addpowernew').hide();
        $('#centerthiknessnew').hide();
        $('#watercontentnew').hide();
        $('#disposabilitynew').hide();
        $('#diameterlenss').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameternew').hide();
        
        $('#packagingnew').hide();
        $('#gravitynew').hide();
        $('#lensindexnew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#netquntitynew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#warrentytypenew').hide();
        $('#usagesdurationnew').hide();
        $('#lensmaterialtypenew').hide();
        $('#lenstechnologynew').hide();
    }
    else if( categoryname == "Sunglasses" )
    {
        $(".sizeCheck").attr('disabled', false);
        $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#colorcodenew').show();
        $('#packagewidthnew').show();
         $('#shapenew').show();
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
    }
    else if( categoryname == "Premium Brands" )
    {
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#addpowernew').hide();
        $('#centerthiknessnew').hide();
        $('#watercontentnew').hide();
        $('#disposabilitynew').hide();
        $('#diameterlenss').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#packagingnew').hide();
        $('#gravitynew').hide();
        $('#lensindexnew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#netquntitynew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#warrentytypenew').hide();
    }
    else if( categoryname == "Contact Lenses" )
    {
        $('#premiumtypenew').hide();
        $('#gendernew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#gravitynew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#netquntitynew').hide();
        $('#focallengthnew').hide();
        $('#lenstechnologynew').hide();
        $('#shelflifenew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#frametypenew').hide();
        $('#productdimensionnew').hide();
        $('#warrentytypenew').hide();
        $('#framematerialnew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#colorcodenew').hide();
        
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#lensmaterialtypenew').hide();
        
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lensindexnew').hide();
        $('#addpowernew').hide();
    }
    else if( categoryname == "Lenses" )
    {
        $('#premiumtypenew').hide();
        $('#gendernew').hide();
        $('#lenstypenew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#addpowernew').hide();
        $('#centerthiknessnew').hide();
        $('#netquntitynew').hide();
        $('#shelflifenew').hide();
        $('#watercontentnew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#frametypenew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#modelnonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#colorcodenew').hide();
        $('#framematerialnew').hide();
        $('#usagesdurationnew').hide();
    }
    else if( categoryname == "Accessories" )
    {
        $('#shelflifenew').show();
    }
    else if(categoryname == 'Contact Lens Solutions'){
        $('#productskunew').show();
        $('#titlenew').show();
        $('#brandnamenew').show();
        $('#shelflifenew').show();
        $('#manufracturernew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#countryoforiginnew').show();
        $('#colorcodenew').hide();
        $('#hsncodenew').show();
        $('#descriptionnew').show();
        $('#formnew').show();
        $('#productcolornew').show();
        $('#netquntitynew').show();
        $('#warrentytypenew').show();
        $('#stocknew').show();
        $('#policynew').show();
        
        $('#centerthiknessneww').hide();
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
        $('#centerthiknessnew').hide();
    }
    else
    {
        //
    }
    
    

var color_datatable;
$(document).on('click', '#available_pro_color', function(){ 
    var product_id = '{{$product->productsku}}';
    if($(this).is(':checked')) {
        $('#color_table').dataTable({
            'serverSide': true,
            'bProcessing': true,
            'searching' : false,
            'ordering' : false,
            'paging' : false,
            'scrollY': '300px',
            'scrollCollapse': true,
            'info' : false,
            'bDestroy' : true,
            'order': [], 
            'ajax' : {
                'url'  : mainUrl + '/admin/attr_color_list',
                'data' : {
                    product_id : product_id , 
                    '_token' : '{{ csrf_token() }}'
                },
                'type' : 'POST',
            },
            "columns": [
            { data: [0] },
            { data: [1] },
            { data: [2] },
            { data: [3] },
            
            ],
            // "rowReorder": true,
        });
    } 
});

$('#color_table').DataTable().on( 'row-reorder', function ( e, diff, edit ) {
    var result = 'Reorder started on row: '+edit.triggerRow.data()[0]+'<br>';

    for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
        var rowData = $('#color_table').DataTable().row( diff[i].node ).data();

        result += rowData[1]+' updated to be in position '+
            diff[i].newData+' (was '+diff[i].oldData+')<br>';
    }
    // $('#result').html( 'Event result:<br>'+result );
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

$(document).on('click', '#available_pro_color', function() {
    if(this.checked) {
       $('#product_color_div').show();
    }else {
        $('#product_color_div').hide();
    }
});

    
    
bkLib.onDomLoaded(function() {
    new nicEditor().panelInstance('description');
    new nicEditor().panelInstance('policy');
});

$("#allow").change(function () {
    $("#pSizes").toggle();
});

 $("#bulkrange").change(function () {
   $("#bulkfield").toggle();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#adminimg').attr('src', e.target.result);
            // $('#adminvideo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
    
    
bkLib.onDomLoaded(function() {
    new nicEditor().panelInstance('description');
    new nicEditor().panelInstance('policy');
});

$("#allow").change(function () {
    $("#pSizes").toggle();
});

 $("#bulkrange").change(function () {
   $("#bulkfield").toggle();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#adminimg').attr('src', e.target.result);
            // $('#adminvideo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

});