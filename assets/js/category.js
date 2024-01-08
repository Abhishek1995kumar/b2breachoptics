// 1 - prescription javascript
// 2 - Lens Prescription Submit
// 3 - presData Lense Type Selected
// 4 - Prescription Lens type Select Filter
// 4 - Prescription Lens type Select Filter Function
// 5 - Left Eye Check Event
// 6 - Right Eye Check Event
// 7 - Product Filter Visibility
// 8 - Product Filter Function
// 9 - Load More Funtion



// prescription javascript
$('#pre_table').hide();
$("#lenseType").click(function(){
    if($('#lenseType').val() == 'Single Vision')
    {
        $("#pre_table").show();
    }else if($('#lenseType').val() == 'Biofocal')
    {
        $("#pre_table").show();
    }else if($('#lenseType').val() == 'Progressive')
    {
        $("#pre_table").show();
    }
    else{
            $('#pre_table').hide();
    }
});

$('.leAddPower').on('keyup', function() {
    let leAddPower = $(".leAddPower").val() == '' ? 0 : $(".leAddPower").val();
    let leSphere = $(".leSphere").val() == '' ? 0 : $(".leSphere").val();
    $(".lsph").val(parseFloat(leAddPower) + parseFloat(leSphere));
});

$('.leSphere').on('keyup', function() {
    let leAddPower = $(".leAddPower").val() == '' ? 0 : $(".leAddPower").val();
    let leSphere = $(".leSphere").val() == '' ? 0 : $(".leSphere").val();
    $(".lsph").val((parseFloat(leAddPower) + parseFloat(leSphere)).toFixed(2));
});

$('.ReAddPower').on('keyup', function() {
    let reAddPower = $(".ReAddPower").val() == '' ? 0 : $(".ReAddPower").val();
    let reSphere = $(".reSphere").val() == '' ? 0 : $(".reSphere").val();
    $(".rsph").val((parseFloat(reAddPower) + parseFloat(reSphere)).toFixed(2)); 
});

$('.reSphere').on('keyup', function() {
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

$('.leCyl').on('keyup', function() {
    let leCyl = $(".leCyl").val() == '' ? 0 : $(".leCyl").val();
    $(".lcyl").val(parseFloat(leCyl));
});

$('.leAxis').on('keyup', function() {
    let laxis = $(".leAxis").val() == '' ? 0 : $(".leAxis").val();
    $(".laxis").val(parseFloat(laxis));
});

$('.leva').on('keyup', function() {
    let leva = $(".leva").val() == '' ? 0 : $(".leva").val();
    $(".readinglva").val(parseFloat(leva));
});

$('.reCyl').on('keyup', function() {
    let reCyl = $(".reCyl").val() == '' ? 0 : $(".reCyl").val();
    $(".rcyl").val(parseFloat(reCyl));
});

$('.reAxis').on('keyup', function() {
    let reAxis = $(".reAxis").val() == '' ? 0 : $(".reAxis").val();
    $(".raxis").val(parseFloat(reAxis));
});

$('.reva').on('keyup', function() {
    let reva = $(".reva").val() == '' ? 0 : $(".reva").val();
    $(".readingrva").val(parseFloat(reva));
});

// Lens Prescription Submit
var uploadFile = document.getElementById('uploadFile');
$(document).ready(function() {
    $('#LensePrescription').submit(function(e){
        // var formData = new FormData(this);
        var sessionData = $("#LensePrescription").serializeArray();
        e.preventDefault();
        window.localStorage.setItem("formObject", JSON.stringify(sessionData));
        $('.close').click();
        runProductFilter();
//         $.ajax({
//             url: "{{url('/spectacle')}}",
//             method:'POST',
//             data : formData,
//             processData: false,
//             contentType: false,
//             cache : false,
//             dataType: 'JSON',
//             success:function(data){
// 			    //
// 			},
// 		});
    }); 
});

// presData Lense Type Selected
var presData = JSON.parse(window.localStorage.getItem("formObject"));
if(presData != null){
    $('.lsph').val("");
    $("#lenseType").val(presData[1].value);
    var type = presData[1].value;
    if(type == "Single Vision"){
        $('.lsph').val(presData[2].value);
    }
    if(type == "Boifocal"){
        //
    }
    if(type == "Progressive"){
        //
    }
}

// Prescription Lens type Select Filter
var addPower = document.getElementById('addPower');
var pdRow = document.getElementById('addPowerField');
var lePdPowerField = document.getElementById('leaddPowerField');
var rePdPowerField = document.getElementById('readdPowerField');

var leAddPower = document.querySelector(".leAddPower");
var reAddPower = document.querySelector(".ReAddPower");

var readingText = document.querySelector(".readingText");

window.addEventListener("load", (event) => {
    leAddPower.disabled = true;
    reAddPower.disabled = true;
    $(".reading").hide();
    document.querySelector(".totalPd").disabled = true;
    document.querySelector(".lePd").disabled = true;
    document.querySelector(".rePd").disabled = true;
    lensPrescriptionType();
});

$('#lenseType').on('change', function(){
    lensPrescriptionType();
});

// Prescription Lens type Select Filter Function
function lensPrescriptionType(){
    if($('#lenseType').val() == "Single Vision"){
        $(".reading").show();
        $(".distance").show();
        document.querySelector(".totalPd").disabled = false;
        document.querySelector(".lePd").disabled = false;
        document.querySelector(".rePd").disabled = false;
        document.querySelector(".lsph").removeAttribute('readonly');
        document.querySelector(".rsph").removeAttribute('readonly');
        reAddPower.disabled = false;
        leAddPower.disabled = false;
        var lense = $('#lenseType').val();
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
                $('.rsph').val(revalue);
            }
        });
        
        reAddPower.disabled = true;
    }
    else if($('#lenseType').val() == "Biofocal"){
        var lense = $('#lenseType').val();
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
        document.querySelector(".lsph").setAttribute("readonly", "readonly");
        document.querySelector(".rsph").setAttribute("readonly", "readonly");
    }
    else if($('#lenseType').val() == "Progressive"){
        var lense = $('#lenseType').val();
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
        document.querySelector(".lsph").setAttribute("readonly", "readonly");
        document.querySelector(".rsph").setAttribute("readonly", "readonly");
    }
    else{
        var lense = $('#lenseType').val();
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

var leCheck = document.getElementById('lecheckbox');
var reCheck = document.getElementById('recheckbox');

// Left Eye Check Event
leCheck.addEventListener('click', function() {
    if(leCheck.checked) {
        $(".leSphere").val('');
        $(".leCyl").val('');
        $(".leAxis").val('');
        
        $(".lsph").val('');
        $(".lcyl").val('');
        $(".laxis").val('');
        
        document.querySelector(".leSphere").disabled = true;
        document.querySelector(".leCyl").disabled = true;
        document.querySelector(".leAxis").disabled = true;
        
        document.querySelector(".lsph").disabled = true;
        document.querySelector(".lcyl").disabled = true;
        document.querySelector(".laxis").disabled = true;
    }
    else{
        document.querySelector(".leSphere").disabled = false;
        document.querySelector(".leCyl").disabled = false;
        document.querySelector(".leAxis").disabled = false;
        
        document.querySelector(".lsph").disabled = false;
        document.querySelector(".lcyl").disabled = false;
        document.querySelector(".laxis").disabled = false;
    }
});

// Right Eye Check Event
reCheck.addEventListener('click', function() {
    if(reCheck.checked) {
        $(".reSphere").val('');
        $(".reCyl").val('');
        $(".reAxis").val('');
        
        $(".rsph").val('');
        $(".rcyl").val('');
        $(".raxis").val('');
        
        document.querySelector(".reSphere").disabled = true;
        document.querySelector(".reCyl").disabled = true;
        document.querySelector(".reAxis").disabled = true;
        
        document.querySelector(".rsph").disabled = true;
        document.querySelector(".rcyl").disabled = true;
        document.querySelector(".raxis").disabled = true;
    }
    else{
        document.querySelector(".reSphere").disabled = false;
        document.querySelector(".reCyl").disabled = false;
        document.querySelector(".reAxis").disabled = false;
        
        document.querySelector(".rsph").disabled = false;
        document.querySelector(".rcyl").disabled = false;
        document.querySelector(".raxis").disabled = false;
    }
});

// Product Filter Visibility
$(document).on('click', '.filter-product', function(e){
    if(e.target.className == 'anchor'){
        if($(this).hasClass('visible')){
            $(this).removeClass('visible');
        }else{
            $(this).addClass('visible');
        }
    }
});

// Product Filter Function
function runProductFilter(){
    var lensestype = $('#lenseType').val();
    var radd = $('.ReAddPower').val();
    var rsph = $('.reSphere').val();
    var rcyl = $('.reCyl').val();
    var raxis = $('.reAxis').val();
    var ladd = $('.leAddPower').val();
    var lsph = $('.leSphere').val();
    var lcyl = $('.leCyl').val();
    var laxis = $('.leAxis').val();
    var ldia = "";
    var rdia = "";
    
    var role = $('.categoryvalue').val();
    var sort = $("#sortby").val();
    var colors = '';
    var shapes = '';
    var gender='';
    var makes ='';

    var frametype = '';
    var framematerial = '';
    var framecolor = '';
    var lenscolor = '';
    var size = '';
    var brandname = '';
    var lenstype = '';
    var disposability = '';
    var packaging = '';

    var lensmaterialtype = '';
    var lenstechnology = '';
    var lensindex = '';
    var visioneffect = '';
    var netquntity = '';
    var premiumtype = '';
    var coating = '';

    var slug = '';
    var id = '';
    if(role == "child")
    {
        id = $('.childcategoryid').val();
        slug = sort+"/"+id;
        
    }
    else
    {
        slug = $('.categoryslug').val();
    }
    
    $('input[name="color[]"]:checked').each(function(index,item){
        colors += (colors)?','+$(item).val():$(item).val();
    })

    $('input[name="make[]"]:checked').each(function(index,item){
        makes += (makes)?','+$(item).val():$(item).val();
    })

    $('input[name="shape[]"]:checked').each(function(index,item){
        shapes += (shapes)?','+$(item).val():$(item).val();
    })

    $('input[name="gender[]"]:checked').each(function(index,item){
        gender += (gender)?','+$(item).val():$(item).val();
    })

    $('input[name="frametype[]"]:checked').each(function(index,item){
        frametype += (frametype)?','+$(item).val():$(item).val();
    })

    $('input[name="framematerial[]"]:checked').each(function(index,item){
        framematerial += (framematerial)?','+$(item).val():$(item).val();
    })

    $('input[name="framecolor[]"]:checked').each(function(index,item){
        framecolor += (framecolor)?','+$(item).val():$(item).val();
    })

    $('input[name="lenscolor[]"]:checked').each(function(index,item){
        lenscolor += (lenscolor)?','+$(item).val():$(item).val();
    })

    $('input[name="size[]"]:checked').each(function(index,item){
        size += (size)?','+$(item).val():$(item).val();
    })

    $('input[name="brandname[]"]:checked').each(function(index,item){
        brandname += (brandname)?','+$(item).val():$(item).val();
    })

    $('input[name="lenstype[]"]:checked').each(function(index,item){
        lenstype += (lenstype)?','+$(item).val():$(item).val();
    })

    $('input[name="disposability[]"]:checked').each(function(index,item){
        disposability += (disposability)?','+$(item).val():$(item).val();
    })

    $('input[name="packaging[]"]:checked').each(function(index,item){
        packaging += (packaging)?','+$(item).val():$(item).val();
    })

    $('input[name="lensmaterialtype[]"]:checked').each(function(index,item){
        lensmaterialtype += (lensmaterialtype)?','+$(item).val():$(item).val();
    })

    $('input[name="lenstechnology[]"]:checked').each(function(index,item){
        lenstechnology += (lenstechnology)?','+$(item).val():$(item).val();
    })

    $('input[name="lensindex[]"]:checked').each(function(index,item){
        lensindex += (lensindex)?','+$(item).val():$(item).val();
    })

    $('input[name="visioneffect[]"]:checked').each(function(index,item){
        visioneffect += (visioneffect)?','+$(item).val():$(item).val();
    })

    $('input[name="netquntity[]"]:checked').each(function(index,item){
        netquntity += (netquntity)?','+$(item).val():$(item).val();
    })

    $('input[name="premiumtype[]"]:checked').each(function(index,item){
        premiumtype += (premiumtype)?','+$(item).val():$(item).val();
    })

    $('input[name="coating[]"]:checked').each(function(index,item){
        coating += (coating)?','+$(item).val():$(item).val();
    })

    window.location = mainurl+"/category/"+slug+"?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender+"&frametype="+frametype+"&framematerial="+framematerial+"&framecolor="+framecolor+"&lenscolor="+lenscolor+"&size="+size+"&brandname="+brandname+"&lenstype="+lenstype+"&disposability="+disposability+"&packaging="+packaging+"&lensmaterialtype="+lensmaterialtype+"&lenstechnology="+lenstechnology+"&lensindex="+lensindex+"&visioneffect="+visioneffect+"&premiumtype="+premiumtype+"&coating="+coating+"&radd="+radd+"&rsph="+rsph+"&rcyl="+rcyl+"&raxis="+raxis+"&ladd="+ladd+"&lsph="+lsph+"&lcyl="+lcyl+"&laxis="+laxis+"&ldia="+ldia+"&rdia="+rdia+"&netquntity="+netquntity;
}

$("#sortby").change(function () {
    runProductFilter();
});

$(document).on('click','input[type=checkbox]', function(){
    runProductFilter();
})

// Load More Funtion
$("#load-more").click(function () {
    var lensestype = $('#lenseType').val();
    var radd = $('.ReAddPower').val();
    var rsph = $('.reSphere').val();
    var rcyl = $('.reCyl').val();
    var raxis = $('.reAxis').val();
    var ladd = $('.leAddPower').val();
    var lsph = $('.leSphere').val();
    var lcyl = $('.leCyl').val();
    var laxis = $('.leAxis').val();
    var ldia = "";
    var rdia = "";
    
    $("#load").show();
    var page = $("#page").val();
    var sort = $("#sortby").val();
    
    var slug = $('.categoryslug').val();

    var colors = '';
    var shapes = '';
    var makes ='';
    var gender='';

    var frametype = '';
    var framematerial = '';
    var framecolor = '';
    var lenscolor = '';
    var size = '';
    var brandname = '';
    var lenstype = '';
    var disposability = '';
    var packaging = '';

    var lensmaterialtype = '';
    var lenstechnology = '';
    var lensindex = '';
    var visioneffect = '';
    var netquntity = '';
    var premiumtype = '';
    var coating = '';

    $('input[name="color[]"]:checked').each(function(index,item){
        colors += (colors)?','+$(item).val():$(item).val();
    })

    $('input[name="make[]"]:checked').each(function(index,item){
        makes += (makes)?','+$(item).val():$(item).val();
    })

    $('input[name="shape[]"]:checked').each(function(index,item){
        shapes += (shapes)?','+$(item).val():$(item).val();
    })

    $('input[name="gender[]"]:checked').each(function(index,item){
        gender += (gender)?','+$(item).val():$(item).val();
    })

    $('input[name="frametype[]"]:checked').each(function(index,item){
        frametype += (frametype)?','+$(item).val():$(item).val();
    })

    $('input[name="framematerial[]"]:checked').each(function(index,item){
        framematerial += (framematerial)?','+$(item).val():$(item).val();
    })

    $('input[name="framecolor[]"]:checked').each(function(index,item){
        framecolor += (framecolor)?','+$(item).val():$(item).val();
    })

    $('input[name="lenscolor[]"]:checked').each(function(index,item){
        lenscolor += (lenscolor)?','+$(item).val():$(item).val();
    })

    $('input[name="size[]"]:checked').each(function(index,item){
        size += (size)?','+$(item).val():$(item).val();
    })

    $('input[name="brandname[]"]:checked').each(function(index,item){
        brandname += (brandname)?','+$(item).val():$(item).val();
    })

    $('input[name="lenstype[]"]:checked').each(function(index,item){
        lenstype += (lenstype)?','+$(item).val():$(item).val();
    })

    $('input[name="disposability[]"]:checked').each(function(index,item){
        disposability += (disposability)?','+$(item).val():$(item).val();
    })

    $('input[name="packaging[]"]:checked').each(function(index,item){
        packaging += (packaging)?','+$(item).val():$(item).val();
    })

    $('input[name="lensmaterialtype[]"]:checked').each(function(index,item){
        lensmaterialtype += (lensmaterialtype)?','+$(item).val():$(item).val();
    })

    $('input[name="lenstechnology[]"]:checked').each(function(index,item){
        lenstechnology += (lenstechnology)?','+$(item).val():$(item).val();
    })

    $('input[name="lensindex[]"]:checked').each(function(index,item){
        lensindex += (lensindex)?','+$(item).val():$(item).val();
    })

    $('input[name="visioneffect[]"]:checked').each(function(index,item){
        visioneffect += (visioneffect)?','+$(item).val():$(item).val();
    })

    $('input[name="netquntity[]"]:checked').each(function(index,item){
        netquntity += (netquntity)?','+$(item).val():$(item).val();
    })

    $('input[name="premiumtype[]"]:checked').each(function(index,item){
        premiumtype += (premiumtype)?','+$(item).val():$(item).val();
    })

    $('input[name="coating[]"]:checked').each(function(index,item){
        coating += (coating)?','+$(item).val():$(item).val();
    })

    $('input[name="disposability[]"]:checked').each(function(index,item){
        disposability += (disposability)?','+$(item).val():$(item).val();
    })
    
    console.log(colors)

    $.get(mainurl+"/loadcategory/"+slug+"/"+page+"?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender+"&frametype="+frametype+"&framematerial="+framematerial+"&framecolor="+framecolor+"&lenscolor="+lenscolor+"&size="+size+"&brandname="+brandname+"&lenstype="+lenstype+"&disposability="+disposability+"&packaging="+packaging+"&lensmaterialtype="+lensmaterialtype+"&lenstechnology="+lenstechnology+"&lensindex="+lensindex+"&visioneffect="+visioneffect+"&premiumtype="+premiumtype+"&coating="+coating+"&radd="+radd+"&rsph="+rsph+"&rcyl="+rcyl+"&raxis="+raxis+"&ladd="+ladd+"&lsph="+lsph+"&lcyl="+lcyl+"&laxis="+laxis+"&ldia="+ldia+"&rdia="+rdia+"&netquntity="+netquntity, function(data, status){
        $("#load").fadeOut();
        $("#products").append(data);
        $("#page").val(parseInt($("#page").val())+1);
        if ($.trim(data) == ""){
            $("#load-more").fadeOut();
        }
    });
});

$(document).ready(function() {
    function toggleFilterPanel() {
        $(".product-filter-leftDiv").toggleClass("show-panel");
    }
    
    $(".mobilefilter").click(function() {
        toggleFilterPanel();
    });
    
    $(document).on("click", function(event) {
        if (
            $(event.target).closest(".product-filter-leftDiv").length === 0 &&
            $(event.target).closest(".mobilefilter").length === 0
        ) {
            $(".product-filter-leftDiv").removeClass("show-panel");
        }
    });

    $(document).on("click", ".close-icon", function() {
        toggleFilterPanel(); // Toggle the filter panel (open/close)
        $('.product-filter-leftDiv').css('transition', 'left 1s ease');
    });
});