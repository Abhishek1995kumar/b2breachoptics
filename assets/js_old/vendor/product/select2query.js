
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

$('#axisnlens').select2({
    width: '100%',
    placeholder: "Select Axis",
    allowClear: true
});

$('#diameterlens').select2({
    width: '100%',
    placeholder: "Select Add Power",
    allowClear: true
});

$('#spherelens').select2({
    width: '100%',
    placeholder: "Select Sphere",
    allowClear: true
});

$('#sphere').select2({
    width: '100%',
    placeholder: "Select Sphere",
    allowClear: true
});

$('#cylinderlens').select2({
    width: '100%',
    placeholder: "Select Cylinder",
    allowClear: true
});

$('#framecolor').select2({
    width: '100%',
    placeholder: "Select framecolor",
    allowClear: true
});

$('#countryoforigin').select2({
    width: '100%',
    placeholder: "Select Country",
    allowClear: true
});

$('#framematerial').select2({
    width: '100%',
    placeholder: "Select frame material",
    allowClear: true
});

$('#brandname').select2({
    width: '100%',
    placeholder: "Select brand name",
    allowClear: true
});

$('#lenscolor').select2({
    width: '100%',
    placeholder: "Select lenscolor",
    allowClear: true
});

$('#contactlenscolor').select2({
    width: '100%',
    placeholder: "Select lenscolor",
    allowClear: true
});

$('#lensmaterialtype').select2({
    width: '100%',
    placeholder: "Select lens material type",
    allowClear: true
});
  
$('#shape').select2({
    width: '100%',
    placeholder: "Select shape",
    allowClear: true
});


$(document).ready(function() {
    let lens_type = $('#visioneffect').val();
    if(lens_type == 'single Vision')
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
    var categoryid = select_status.options[select_status.selectedIndex].value;
    // alert(strUser);
    if( categoryname == "Frames" ) {
        mainCategoryEdit(categoryid);
        $(".sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#packageweightnew').show();
        $('#colorcodenew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
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
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framestylenew').hide();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#centerthiknessnew').hide();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#frametypenew').show();
        $('#framecolornew').show();
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
        
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#premiumtypenew').hide();
      
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

    } else if(categoryname == "Contact Lenses") {
        mainCategoryEdit(categoryid);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#coatingnew').hide();
        $('#colorcodenew').show();

        $('#visioneffectnew').hide();
        $('#lenstypenew').show();
        $('#usagesdurationnew').show();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#framecolornew').hide();
        var lensValue = $("#lenstype option")[0].value;
        
        if(lensValue == 'Single Vision'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }
        else if(lensValue == 'MultiFocal'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').show();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }
        else if(lensValue == 'toric and Astigmatism'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').show();
            $('#cylinderneww').show();
        }
        else if(lensValue == 'Plano'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }

        $('#lenstype').on('change', function() {
            if($('#lenstype').val() == 'single Vision'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
            else if($('#lenstype').val() == 'MultiFocal'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').show();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
            else if($('#lenstype').val() == 'toric and Astigmatism'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').show();
                $('#cylinderneww').show();
            }
            else if($('#lenstype').val() == 'Plano'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
        });

    }else if(categoryname == "Sunglasses"){
        mainCategoryEdit(categoryid);
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
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#framestylenew').hide();
        $('#addpowernew').hide();
        $('#usagesdurationnew').hide();
        $('#coatingnew').hide();

        $('#lenstechnologynew').show();
        $('#gendernew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#colorcodenew').show();
        $('#framecolornew').show();

    }else if(categoryname == "Lenses"){
        mainCategoryEdit(categoryid);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
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
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#frametypenew').hide();
        $('#allownew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();
        $('#netquntitynew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#lenstechnologynew').show();
        $('#coatingnew').show();
        $('#premiumtypenew').hide();
        // $('#addpowerlenss').show();
        $('#diameterlenss').show();
        $('#colorcodenew').show();
        $('#framecolornew').hide();
        $('#diameternew').hide();
        
        $('#visioneffect').on('change', function() {
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
        });  
        
    }else if(categoryname == "Accessories"){
        mainCategoryEdit(categoryid);
        $('#frametypenew').hide();
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
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#productdimnew').hide();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();
        $('#gendernew').hide();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#productdimensionnew').show();
        $('#colorcodenew').show();
        $('#framecolornew').hide();

    }else if(categoryname == "Premium Brands"){
        mainCategoryEdit(categoryid);
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
         // $('#frametypenew').show();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#frametypenew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#framestylenew').hide();
        $('#usagesdurationnew').hide();
        $('#diameterlenss').hide();
        $('#gendernew').show();
        $('#lenstechnologynew').show();
        $('#premiumtypenew').show();
        $('#addpowerlenss').hide();
        $('#colorcodenew').show();
        $('#cylinderlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#framecolornew').show();

    }else if(categoryname == 'Contact Lens Solutation'){
        mainCategoryEdit(categoryid);
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
        $('#colorcodenew').hide();
        $('#framecolornew').hide();
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
    else{
        //
    }
});


if($("#maincats option:selected").text() == 'Frames')
{
    $("#sizeCheck").attr('disabled', false);
}
else if($("#maincats option:selected").text() == 'Contact Lenses')
{
    $("#sizeCheck").attr('disabled', true);
    $("#sizeAttr").attr('disabled', true);
}
else if($("#maincats option:selected").text() == 'Sunglasses')
{
    $("#sizeCheck").attr('disabled', false);
}
else if($("#maincats option:selected").text() == 'Lenses')
{
    $("#sizeCheck").attr('disabled', true);
    $("#sizeAttr").attr('disabled', true);
 
}
else if($("#maincats option:selected").text() == 'Accessories')
{
    $("#sizeCheck").attr('disabled', false);
}
else if($("#maincats option:selected").text() == 'Premium Brands')
{
    $("#sizeCheck").attr('disabled', false);
}


$('#maincats').on('change', function() {
    var select_status = document.getElementById("maincats");
    var categoryname = select_status.options[select_status.selectedIndex].text;
    if( categoryname == "Frames" ) {
        console.log(categoryname);
        $("#sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#usagesnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framestylenew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#frametypenew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#gendernew').show();
        $('#colorcodenew').show();
    }
    else if(categoryname == "Contact Lenses") {
        console.log(categoryname);
        $("#sizeCheck").attr('disabled', true);
         $("#sizeAttr").attr('disabled', true);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lenstechnologynew').show();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#diameternew').show();
        $('#contactlensmaterialtypenew').show();
        $('#basecurvenew').show();
        $('#watercontentnew').show();
        $('#powernewmin').show();
        $('#powernewmax').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').show();

        $('#modelnonew').show();
        $('#usagesdurationnew').show();
        $('#framewidthnew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').show();
        $('#cylinderneww').show();
        $('#axisneww').show();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').show();
        $('#addpowernew').show();
        $('#visioneffectnew').hide();
        $('#colorcodenew').show();


    }else if(categoryname == "Sunglasses"){
        console.log(categoryname);
         $("#sizeCheck").attr('disabled', false);
         $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show();
         $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show();
        $('#packageweightnew').show();
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

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

         $('#lenstypenew').hide();
         $('#visioneffectnew').hide();
         $('#powernewmin').hide();
        $('#powernewmax').hide();
         $('#coatingnew').hide();
         $('#gendernew').show();
         $('#colornew')
         $('#shapenew').show();
         $('#addpowernew').hide();
        $('#colorcodenew').show();
    }else if(categoryname == "Lenses"){
        console.log(categoryname);
        $("#sizeAttr").attr('disabled', true);
        $("#sizeCheck").attr('disabled', true);

        $('#lensmaterialtypenew').show();
        $('#diameternew').hide();
        $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').show();
        $('#lensindexnew').show();
        $('#focallengthnew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#catetwonew').hide();
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
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#shelflifenew').hide();
        $('#gendernew').hide();
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

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').show();
        $('#powernewmax').show();
        $('#visioneffectnew').show();
        $('#coatingnew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').show();
        $('#colorcodenew').show();

    }else if(categoryname == "Accessories"){
        console.log(categoryname);
        $("#sizeCheck").attr('disabled', false);

        $('#productdimensionnew').show();
        $('#frametypenew').hide();
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
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#usagesnew').show();
        $('#shelflifenew').show();
        $('#formnew').show();
        $('#productcolornew').show();
        $('#productdimnew').hide();
        $('#materialnew').show();
        $('#warrentytypenew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').show();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#gendernew').hide();
        $('#manufracturer').show();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();
        $('#colorcodenew').hide();

    }else if(categoryname == "Premium Brands"){
        console.log(categoryname);
        $("#sizeCheck").attr('disabled', false);


         $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show();
         $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show();
        $('#packageweightnew').show();
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

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        $('#colorcodenew').show();

    }
    else{
        //
        console.log("else");
    }
});

