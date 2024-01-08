$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


$("#productFormSubmit").on("submit", function(e){
    e.preventDefault();
    let formData = new FormData(this);
    url = baseUrl + "/vendor/products/update";
    url2 = baseUrl + "/vendor/products";
    if(validate()){
        $.ajax({
            method: 'POST',
            url: url,
            data: formData,
            processData: false, // Preventing default data parse behavior
            contentType: false, //Preventing content type data eg:- application/json
            beforeSend: function(){
                $('#preloader').css("display", "block");
                productFormSubmit.classList.add("load");
                $("#page-wrapper").hide();
            },
            complete: function(){
                $('#preloader').css("display", "none");
                productFormSubmit.classList.remove("load");
                $("#page-wrapper").show();
            },
            dataType: 'JSON',
            success: function(resp){
                if(resp.status == "success"){
                    Swal.fire({
                        title: 'Message!',
                        text: resp.msg,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = url2;
                        }
                    });
                }
            }
        });  
    }
});

var text = '';
var text2 = '';
window.addEventListener('load', function() {
    $('#descriptionnew .nicEdit-main').on('keyup', function(event) {
        var nicE = new nicEditors.findEditor('description');
        text2 = nicE.getContent();
        $('#description').text(text2);
    });
    
    $('#policynew .nicEdit-main').on('keyup', function(event) {
        var nicE = new nicEditors.findEditor('policy');
        text = nicE.getContent();
        $('#policy').text(text);
    });
})

const validate = ()=>{
	if($('#productsku').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Enter Product SKU',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
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
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
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
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
	    $('#maincats').focus();
	    return false
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
        });
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
        });
        $('#childs').focus();
        return false;
    }
	
	if($('#maincats').val() != ''){
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
	    
	     //lenses
	    if($('#maincats').val() == 58)
	    {  
	        if(lensesValidation())
	        {
	            return true;
	        }else{
	            return false;
	        }
	    }
	  //  Contact lens solution
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

function frameValidation()
{
    if($('#shape').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Select Frame Shape',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
        $('#gender').focus();
        return false;
    }
    if($('#brandname').val() == '')
    {
        Swal.fire({
            title: 'Please Select Brand Name',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#brandname').focus();
        return false;
    }
    if($('#modelno').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Model No',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#modelno').focus();
        return false;
    }
    if($('#sellername').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Seller Name',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#sellername').focus();
        return false;
    }
    if($('#framematerial').val() == '')
    {
        Swal.fire({
            title: 'Please Select Frame Material',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#framematerial').focus();
        return false;
    }
    if($('#frametype').val() == '')
    {
        Swal.fire({
            title: 'Please Select Frame Type',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#frametype').focus();
        return false;
    }
    if($('#manufracturer').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Manufracturer Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#manufracturer').focus();
        return false;
    }
    if($('#productdimension').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Frame Dimension Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#productdimension').focus();
        return false;
    }
    if($('#weight').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Weight Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#weight').focus();
        return false;
    }
    if($('#packeageweight').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Packeage Weight Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#packeageweight').focus();
        return false;
    }
    if($('#packwidth').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Packeage Width Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
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
        });
        $('#packheight').focus();
        return false;
    }
    if($('#packlength').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Packeage Length Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#packlength').focus();
        return false;
    }
    if($('#countryoforigin').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Country Of Origin Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#countryoforigin').focus();
        return false;
    }
    if($('#hsncode').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Hsn Code Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#hsncode').focus();
        return false;
    }
    if($('#file-ip-1').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Gallery Images Filed(At Least One)',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Descriptio Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('textarea#description').focus();
        return false;
    }
    if($('#pre_mrp').val() == '')
    {
        Swal.fire({
            title: 'Please Fill MRP Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#pre_mrp').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Selling Price Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#pro_costprice').focus();
        return false;
    }
    if($('#pro_stock').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Stock Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('#pro_stock').focus();
        return false;
    }
    if($('textarea#policy').val() == '')
    {
        Swal.fire({
            title: 'Please Fill Product Buy/Return Policy Filed',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                return true;
            }
        });
        $('textarea#policy').focus();
        return false;
    }
    return true;
}

function ContaclensValidation()
{
    if($('#brandname').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Select Brand Name',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
            });
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
        });
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
        });
        $('#sellername').focus();
        return false;
    }
    if($('#contactlenscolor').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Contact Lens Color Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#contactlenscolor').focus();
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
        $('#hsncode').focus();
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
        });
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
        });
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
        });
        $('#pre_mrp').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Selling Price Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
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
        });
        $('#packaging').focus();
        return false;
    }
    return true;
}

	
function lensesValidation()
{
    if($('#subs').val().length == 0)
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Select At Least One SubCategory',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
        $('#brandname').focus();
        return false;
    }
    if($('#visioneffect').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Select Lens Type',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#visioneffect').focus();
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
        });
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
        });
        $('#lenscolor').focus();
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
        });
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
        });
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
        });
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
        });
        $('#packlength').focus();
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
        });
        $('#pre_mrp').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Selling Price Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
        $('#pro_stock').focus();
        return false;
    }
    return true;
}

function premiumbrandsValidation()
{
    if($('#premiumtype').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Premium Type Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
        $('#weight').focus();
        return false;
    }
    if($('#frameheight').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Frame Height Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#frameheight').focus();
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
        });
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
        });
        $('#packwidth').focus();
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
        });
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
        });
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
        });
        $('#hsncode').focus();
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
        });
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
        });
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
        });
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
        });
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
        });
        $('textarea#policy').focus();
        return false;
    }
    return true;
}

function SunglassValidation()
{
    if($('#subs').val().length == 0)
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Select At Least One SubCategory',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
        $('#lensmaterialtype').focus();
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
        $('#hsncode').focus();
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
        });
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
        });
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
        });
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
        });
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
        });
        $('textarea#policy').focus();
        return false;
    }
    return true;
}

function lenses_solution_Validation()
{
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
    if($('#weight').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Weight Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
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
        });
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
        });
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
        });
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
        });
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
        });
        $('#hsncode').focus();
        return false;
    }
    if($('#pro_costprice').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Selling Price Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
        $('#pro_stock').focus();
        return false;
    }
    return true;
}

function mainCategoryEdit(categoryname)
{
    let category = categoryname;
    let url = baseUrl + "/vendor/get_brand_name";
    const brand = document.querySelector('#brandname');
    $.ajax({
        type: "POST",
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {category_id: category},
        success: function(response)
        {
            sel = document.getElementById('selected');
            $('#brandname').removeAttr('disabled');
            if(response.length > 0)
            {
                const items = response.map((res) => {
                    var s = '';
                    s = '<option value="' + res.name + '">' + res.name + '</option>';
                    brand.insertAdjacentHTML('beforeend', s);
                })
            }
        }
    })
}


