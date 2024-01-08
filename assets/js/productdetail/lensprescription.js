
$(document).ready(function() {
    $('.productaddtocart').hide();
    $('.prescriptionadd').hide();
    var prescription = localStorage.getItem("formObject");
    if(prescription == null)
    {
        $('.prescriptionadd').show();
        $('.productaddtocart').hide();
    }
    else
    {
        $('.prescriptionadd').hide();
        $('.productaddtocart').show();
    }
    
    $('#parameter_table').hide();
});

$('#leAddPowers').select2({
	width: '100%',
});

$('#ReAddPowers').select2({
	width: '100%',
});

$('#leSpheres').select2({
	width: '100%',
});

$('#leCyls').select2({
	width: '100%',
});

$('#leAxiss').select2({
	width: '100%',
});

$('#levas').select2({
	width: '100%',
});

$('#reSpheres').select2({
	width: '100%',
});

$('#reCyls').select2({
	width: '100%',
});

$('#reAxiss').select2({
	width: '100%',
});

$('#lePds').select2({
	width: '60%',
});

$('#rePds').select2({
	width: '60%',
});

$('#revas').select2({
	width: '100%',
});


$('#pre_table').hide();
        
if($('#lenseType').val() == 'Single Vision')
{
    $("#pre_table").show();
}
else if($('#lenseType').val() == 'Biofocal')
{
    $("#pre_table").show();
}
else if($('#lenseType').val() == 'Progressive')
{
    $("#pre_table").show();
}
else{
     $('#pre_table').hide();
}


$('.leAddPower').on('change', function() {
    let leAddPower = $(".leAddPower").val() == '' ? 0 : $(".leAddPower").val();
    let leSphere = $(".leSphere").val() == '' ? 0 : $(".leSphere").val();
    $(".lsph").val((parseFloat(leAddPower) + parseFloat(leSphere)).toFixed(2));
});

$('.leSphere').on('change', function() {
    let leAddPower = $(".leAddPower").val() == '' ? 0 : $(".leAddPower").val();
    let leSphere = $(".leSphere").val() == '' ? 0 : $(".leSphere").val();
    $(".lsph").val((parseFloat(leAddPower) + parseFloat(leSphere)).toFixed(2));
});

$('.ReAddPower').on('change', function() {
    let reAddPower = $(".ReAddPower").val() == '' ? 0 : $(".ReAddPower").val();
    let reSphere = $(".reSphere").val() == '' ? 0 : $(".reSphere").val();
    $(".rsph").val((parseFloat(reAddPower) + parseFloat(reSphere)).toFixed(2)); 
});

$('.reSphere').on('change', function() {
    let reAddPower = $(".ReAddPower").val() == '' ? 0 : $(".ReAddPower").val();
    let reSphere = $(".reSphere").val() == '' ? 0 : $(".reSphere").val();
    $(".rsph").val((parseFloat(reAddPower) + parseFloat(reSphere)).toFixed(2));
});

$('.lePd').on('change', function() {
    let lePD = $(".lePd").val() == '' ? 0 : $(".lePd").val();
    let rePD = $(".rePd").val() == '' ? 0 : $(".rePd").val();
    $(".totalPd").val((parseFloat(lePD) + parseFloat(rePD)).toFixed(1));
});

$('.rePd').on('change', function() {
    let lePD = $(".lePd").val() == '' ? 0 : $(".lePd").val();
    let rePD = $(".rePd").val() == '' ? 0 : $(".rePd").val();
    $(".totalPd").val((parseFloat(lePD) + parseFloat(rePD)).toFixed(1));
});

$('.leCyl').on('change', function() {
    let leCyl = $(".leCyl").val() == '' ? 0 : $(".leCyl").val();
    $(".lcyl").val(parseFloat(leCyl));
});

$('.leAxis').on('change', function() {
    let laxis = $(".leAxis").val() == '' ? 0 : $(".leAxis").val();
    $(".laxis").val(parseFloat(laxis));
});

$('.leva').on('change', function() {
    let leva = $(".leva").val() == '' ? 0 : $(".leva").val();
    $(".readinglva").val(parseFloat(leva));
});

$('.reCyl').on('change', function() {
    let reCyl = $(".reCyl").val() == '' ? 0 : $(".reCyl").val();
    $(".rcyl").val(parseFloat(reCyl));
});

$('.reAxis').on('change', function() {
    let reAxis = $(".reAxis").val() == '' ? 0 : $(".reAxis").val();
    $(".raxis").val(parseFloat(reAxis));
});

$('.reva').on('change', function() {
    let reva = $(".reva").val() == '' ? 0 : $(".reva").val();
    $(".readingrva").val(parseFloat(reva));
});

// SOME CHANGES PROGRESS Nik 18/02/2023
var uploadFile = document.getElementById('uploadFile');
function lensPrescription(e)
{
    if(validate()){
        // var formData = new FormData(this);
        var sessionData = $("#LensePrescription").serializeArray();
        e.preventDefault();
        window.localStorage.setItem("formObject", JSON.stringify(sessionData));
        $('.close').click();
        Swal.fire({
            title: `Your Prescription Add successfully..!!
                    Now You can by this Product`,
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(true);
            }
        })
        // $('.prescriptionadd').hide();
        // $('.productaddtocart').show();
        
        // runProductFilter();
    }
}

let addPower = document.getElementById('addPower');
let pdRow = document.getElementById('addPowerField');
let lePdPowerField = document.getElementById('leaddPowerField');
let rePdPowerField = document.getElementById('readdPowerField');

let leAddPower = document.querySelector(".leAddPower");
let reAddPower = document.querySelector(".ReAddPower");

let readingText = document.querySelector(".readingText");

window.addEventListener("load", (event) => {
    leAddPower.disabled = true;
    reAddPower.disabled = true;
    $(".reading").hide();
    document.querySelector(".totalPd").disabled = true;
    document.querySelector(".lePd").disabled = true;
    document.querySelector(".rePd").disabled = true;
    let lenstype = $('#lenseType').val()
    lensPrescriptionType(lenstype);
});

if($('#lenseType').val() != ""){
    document.querySelector(".lsph").setAttribute("readonly", "readonly");
    document.querySelector(".rsph").setAttribute("readonly", "readonly");
    lensPrescriptionType();
}

function lensPrescriptionType(lenstype){
    if(lenstype == "Single Vision"){
        $(".reading").show();
        $(".distance").show();
        document.querySelector(".totalPd").disabled = false;
        document.querySelector(".lePd").disabled = false;
        document.querySelector(".rePd").disabled = false;
        // document.querySelector(".lsph").removeAttribute('readonly');
        // document.querySelector(".rsph").removeAttribute('readonly');
        reAddPower.disabled = false;
        leAddPower.disabled = false;
        let lense = $('#lenseType').val();
        readingText.innerHTML = "Power";
        addPower.style.opacity = 0;
        addPower.value == '';
        pdRow.style.opacity = 1;
        
        lePdPowerField.style.opacity = 0;
        leAddPower.value = null;
        $(".lsph").val('');
        
        $('.leSphere').on('change', function(){
            if($('.leSphere').val() != ''){
                var levalue = $('.leSphere').val();
                $('.lsph').val(levalue);
            }
        });
        
        leAddPower.disabled = true;
        
        rePdPowerField.style.opacity = 0;
        reAddPower.value = null;
        $(".rsph").val('');
        
        $('.reSphere').on('change', function(){
            if($('.reSphere').val() != ''){
                var revalue = $('.reSphere').val();
                console.log(revalue);
                $('.rsph').val(revalue);
            }
        });
        
        reAddPower.disabled = true;
    }
    else if(lenstype == "Biofocal"){
        let lense = $('#lenseType').val();
        $(".reading").show();
        $(".distance").show();
        readingText.innerHTML = "Reading";
        addPower.style.opacity = 1;
        pdRow.style.opacity = 1;
        lePdPowerField.style.opacity = 1;
        // lePdPowerField.disabled = true;
        rePdPowerField.style.opacity = 1;
        // rePdPowerField.disabled = true;
        document.querySelector(".leAddPower").disabled = false;
        document.querySelector(".ReAddPower").disabled = false;
        document.querySelector(".totalPd").disabled = false;
        document.querySelector(".lePd").disabled = false;
        document.querySelector(".rePd").disabled = false;
        leAddPower.disabled = false;
        reAddPower.disabled = false;
        // document.querySelector(".lsph").setAttribute("readonly", "readonly");
        // document.querySelector(".rsph").setAttribute("readonly", "readonly");
    }
    else if(lenstype == "Progressive"){
        let lense = $('#lenseType').val();
        $(".reading").show();
        $(".distance").show();
        readingText.innerHTML = "Reading";
        addPower.style.opacity = 1;
        pdRow.style.opacity = 1;
        lePdPowerField.style.opacity = 1;
        rePdPowerField.style.opacity = 1;
        document.querySelector(".leAddPower").disabled = false;
        document.querySelector(".ReAddPower").disabled = false;
        document.querySelector(".totalPd").disabled = false;
        document.querySelector(".lePd").disabled = false;
        document.querySelector(".rePd").disabled = false;
        reAddPower.disabled = false;
        leAddPower.disabled = false;
        // document.querySelector(".lsph").setAttribute("readonly", "readonly");
        // document.querySelector(".rsph").setAttribute("readonly", "readonly");
    }
    else{
        let lense = $('#lenseType').val();
        $(".reading").hide();
        $(".distance").show();
        document.querySelector(".totalPd").disabled = true;
        document.querySelector(".lePd").disabled = true;
        document.querySelector(".rePd").disabled = true;
        reAddPower.disabled = true;
        leAddPower.disabled = true;
        readingText.innerHTML = "Reading";
        addPower.style.opacity = 0;
        pdRow.style.opacity = 0;
        lePdPowerField.style.opacity = 0;
        rePdPowerField.style.opacity = 0;
    }
}

let leCheck = document.getElementById('lecheckbox');
let reCheck = document.getElementById('recheckbox');

leCheck.addEventListener('click', function() {
    if(leCheck.checked) {
        $(".leSphere").val('');
        $(".leCyl").val('');
        $(".leAxis").val('');
        $(".leva").val('');
        
        $(".lsph").val('');
        $(".lcyl").val('');
        $(".laxis").val('');
        $(".readinglva").val('');
        
        $('.leAxis').val('').trigger('change');
        $('.leCyl').val('').trigger('change');
        $('.leSphere').val('').trigger('change');
        $('.leva').val('').trigger('change');
        
        document.querySelector(".leSphere").disabled = true;
        document.querySelector(".leCyl").disabled = true;
        document.querySelector(".leAxis").disabled = true;
        
        document.querySelector(".lsph").disabled = true;
        document.querySelector(".lcyl").disabled = true;
        document.querySelector(".laxis").disabled = true;
        document.querySelector(".leva").disabled = true;
    }
    else{
        document.querySelector(".leSphere").disabled = false;
        document.querySelector(".leCyl").disabled = false;
        document.querySelector(".leAxis").disabled = false;
        
        document.querySelector(".lsph").disabled = false;
        document.querySelector(".lcyl").disabled = false;
        document.querySelector(".laxis").disabled = false;
        document.querySelector(".leva").disabled = false;
    }
});

reCheck.addEventListener('click', function() {
    if(reCheck.checked) {
        $(".reSphere").val('');
        $(".reCyl").val('');
        $(".reAxis").val('');
        $(".reva").val('');
        
        $(".rsph").val(null);
        $(".rcyl").val(null);
        $(".raxis").val(null);
        $(".readingrva").val(null);
        
        $('.reSphere').val('').trigger('change');
        $('.reCyl').val('').trigger('change');
        $('.reAxis').val('').trigger('change');
        $('.reva').val('').trigger('change');
        
        document.querySelector(".reSphere").disabled = true;
        document.querySelector(".reCyl").disabled = true;
        document.querySelector(".reAxis").disabled = true;
        
        document.querySelector(".rsph").disabled = true;
        document.querySelector(".rcyl").disabled = true;
        document.querySelector(".raxis").disabled = true;
        document.querySelector(".reva").disabled = true;
    }
    else{
        document.querySelector(".reSphere").disabled = false;
        document.querySelector(".reCyl").disabled = false;
        document.querySelector(".reAxis").disabled = false;
        
        document.querySelector(".rsph").disabled = false;
        document.querySelector(".rcyl").disabled = false;
        document.querySelector(".raxis").disabled = false;
        document.querySelector(".reva").disabled = false;
    }
});

function addParamete(e)
{
    if(e.currentTarget.checked)
    {
        $('#parameter_table').show();
    }
    else
    {
        $('#parameter_table').hide();
    }
}

var parameters = document.getElementById('checkparameter');

function validate()
{
    if(leCheck.checked == false) {
        if($('#leSpheres').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Left SPH',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#leSpheres').focus();
            return false;
        }
        if($('#leCyls').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Left Cylindrical',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#leCyls').focus();
            return false;
        }
        if($('#leAxiss').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Left Axis',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#leAxiss').focus();
            return false;
        }
        if($('#lePds').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Left PD',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lePds').focus();
            return false;
        }
        if($('#rePds').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Right PD',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#rePds').focus();
            return false;
        }
    }
    if(reCheck.checked == false) {
        if($('#reSpheres').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Right SPH',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#reSpheres').focus();
            return false;
        }
        if($('#reCyls').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Right Cylindrical',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#reCyls').focus();
            return false;
        }
        if($('#reAxiss').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Right Axis',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#reAxiss').focus();
            return false;
        }
        if($('#lePds').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Left PD',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lePds').focus();
            return false;
        }
        if($('#rePds').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Right PD',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#rePds').focus();
            return false;
        }
    }
    if(parameters.checked == true) {
        if($('#a_size').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input A Size',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#a_size').focus();
            return false;
        }
        if($('#b_size').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input B Size',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#b_size').focus();
            return false;
        }
        if($('#dbl').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input DBL',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#dbl').focus();
            return false;
        }
        if($('#r_dia').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input R Dia',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#r_dia').focus();
            return false;
        }
        if($('#l_dia').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input L Dia',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#l_dia').focus();
            return false;
        }
        if($('#r_fitting').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input R Fitting Height',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#r_fitting').focus();
            return false;
        }
        if($('#l_fitting').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input L Fitting Height',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#l_fitting').focus();
            return false;
        }
        if($('#frame_type').val().length == 0)
        {
            Swal.fire({
                    title: 'Message!',
                    text: 'Please Input Frame Type',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#frame_type').focus();
            return false;
        }
    }
    else{
        Swal.fire({
            title: 'Message!',
            text: 'Please Add Parameter',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        return false;
    }
    return true;
}


