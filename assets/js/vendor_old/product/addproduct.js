$("#productFormSubmit").on("submit", function(e){
    e.preventDefault();
    let url = baseUrl + '/vendor/products/add';
    let rurl = baseUrl + '/vendor/products';
    let formData = new FormData(this);
    if(validate()){
        $.ajax({
            method: 'POST',
            url: url,
            data: formData,
            processData: false, // Preventing default data parse behavior
            contentType: false, //Preventing content type data eg:- application/json
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
            dataType: 'JSON',
            success: function(resp){
                console.log(resp);
                if(resp.status == "success"){
                    Swal.fire({
                        title: 'Message!',
                        text: 'Product Add Successfully ..!!',
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = rurl;
                        }
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status == 422)
                {
                    let text = xhr.responseText
                    const value = text.split('"');
                    Swal.fire({
                        title: 'Message!',
                        text: value[3],
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            return false;
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
        });
	    $('#name').focus();
	    return false
	}
	
	if($('#titledescription').val() == ''){
        Swal.fire({
            title: 'Message!',
            text: 'Please Enter Product Description',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
	    $('#titledescription').focus();
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
    if(text2 == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Description',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#description').focus();
        return false;
    }
    if(text == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Return Policy',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#policy').focus();
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Current Featured Image Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
        });
        $('#file-ip-1').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Product Description Filed',
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
            text: 'Please Fill Lens Color Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Current Featured Image Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
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
    if($('#uploadFile').val() == '')
    {
        Swal.fire({
            title: 'Message!',
            text: 'Please Fill Current Featured Image Filed',
            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        });
        $('#uploadFile').focus();
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
    return true;
}

function premiumbrandsValidation()
{
    if($('#premiumtype').val() == '')
    {
        alert("Please Fill Premium Type Filed");
        $('#premiumtype').focus();
        return false;
    }
    if($('#subs').val().length == 0)
    {
        alert("Please Select At Least One SubCategory");
        $('#subs').focus();
        return false;
    }
    if($('#childs').val().length == 0)
    {
        alert("Please Select At Least One ChildCategory");
        $('#childs').focus();
        return false;
    }
    if($('#shape').val() == '')
    {
        alert("Please Fill Frame Shape Filed");
        $('#shape').focus();
        return false;
    }
    if($('#color').val() == '')
    {
        alert("Please Fill Frame Color Filed");
        $('#color').focus();
        return false;
    }
    if($('#gender').val() == '')
    {
        alert("Please Select Gender");
        $('#gender').focus();
        return false;
    }
    if($('#brandname').val() == '')
    {
        alert("Please Select Brand Name");
        $('#brandname').focus();
        return false;
    }
    if($('#modelno').val() == '')
    {
        alert("Please Fill Model No");
        $('#modelno').focus();
        return false;
    }
    if($('#sellername').val() == '')
    {
        alert("Please Fill Seller Name");
        $('#sellername').focus();
        return false;
    }
    if($('#framematerial').val() == '')
    {
        alert("Please Select Frame Material");
        $('#framematerial').focus();
        return false;
    }
    if($('#lenscolor').val() == '')
    {
        alert("Please Fill Lens Color Filed");
        $('#lenscolor').focus();
        return false;
    }
    if($('#contactlenscolor').val() == '')
    {
        alert("Please Fill Contact Lens Color Filed");
        $('#lenscolor').focus();
        return false;
    }
    if($('#frametype').val() == '')
    {
        alert("Please Select Frame Type");
        $('#frametype').focus();
        return false;
    }
    if($('#manufracturer').val() == '')
    {
        alert("Please Fill Manufracturer Filed");
        $('#manufracturer').focus();
        return false;
    }
    if($('#productdimension').val() == '')
    {
        alert("Please Fill Frame Dimension Filed");
        $('#productdimension').focus();
        return false;
    }
    if($('#weight').val() == '')
    {
        alert("Please Fill Product Weight Filed");
        $('#weight').focus();
        return false;
    }
    if($('#frameheight').val() == '')
    {
        alert("Please Fill Frame Height Filed");
        $('#frameheight').focus();
        return false;
    }
    if($('#packeageweight').val() == '')
    {
        alert("Please Fill Packeage Weight Filed");
        $('#packeageweight').focus();
        return false;
    }
    if($('#packwidth').val() == '')
    {
        alert("Please Fill Packeage Width Filed");
        $('#packwidth').focus();
        return false;
    }
    if($('#height').val() == '')
    {
        alert("Please Fill Packeage Height Filed");
        $('#height').focus();
        return false;
    }
    if($('#packlength').val() == '')
    {
        alert("Please Fill Packeage Length Filed");
        $('#packlength').focus();
        return false;
    }
    if($('#countryoforigin').val() == '')
    {
        alert("Please Fill Country Of Origin Filed");
        $('#countryoforigin').focus();
        return false;
    }
    if($('#hsncode').val() == '')
    {
        alert("Please Fill Hsn Code Filed");
        $('#hsncode').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        alert("Please Fill Product Descriptio Filed");
        $('textarea#description').focus();
        return false;
    }
    if($('#pre_mrp').val() == '')
    {
        alert("Please Fill MRP Filed");
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
        alert("Please Fill Product Stock Filed");
        $('#pro_stock').focus();
        return false;
    }
    if($('textarea#policy').val() == '')
    {
        alert("Please Fill Product Buy/Return Policy Filed");
        $('textarea#policy').focus();
        return false;
    }
    return true;
}

function SunglassValidation()
{
    if($('#subs').val().length == 0)
    {
        alert("Please Select At Least One SubCategory");
        $('#subs').focus();
        return false;
    }
    if($('#childs').val().length == 0)
    {
        alert("Please Select At Least One ChildCategory");
        $('#childs').focus();
        return false;
    }
    if($('#shape').val() == '')
    {
        alert("Please Select Frame Shape");
        $('#shape').focus();
        return false;
    }
    if($('#color').val() == '')
    {
        alert("Please Select Frame Color");
        $('#color').focus();
        return false;
    }
    if($('#gender').val() == '')
    {
        alert("Please Select Gender");
        $('#gender').focus();
        return false;
    }
    if($('#brandname').val() == '')
    {
        alert("Please Select Brand Name");
        $('#brandname').focus();
        return false;
    }
    if($('#modelno').val() == '')
    {
        alert("Please Fill Model No Filed");
        $('#modelno').focus();
        return false;
    }
    if($('#framematerial').val() == '')
    {
        alert("Please Select Frame Material");
        $('#framematerial').focus();
        return false;
    }
    if($('#frametype').val() == '')
    {
        alert("Please Select Frame Type");
        $('#frametype').focus();
        return false;
    }
    if($('#manufracturer').val() == '')
    {
        alert("Please Fill Manufracturer Filed");
        $('#manufracturer').focus();
        return false;
    }
    if($('#productdimension').val() == '')
    {
        alert("Please Fill Frame Dimension Filed");
        $('#productdimension').focus();
        return false;
    }
    if($('#weight').val() == '')
    {
        alert("Please Fill Product Weight Filed");
        $('#weight').focus();
        return false;
    }
    if($('#packeageweight').val() == '')
    {
        alert("Please Fill Packeage Weight Filed");
        $('#packeageweight').focus();
        return false;
    }
    if($('#packwidth').val() == '')
    {
        alert("Please Fill Packeage Width Filed");
        $('#packwidth').focus();
        return false;
    }
    if($('#packheight').val() == '')
    {
        alert("Please Fill Packeage Height Filed");
        $('#packheight').focus();
        return false;
    }
    if($('#packlength').val() == '')
    {
        alert("Please Fill Packeage Length Filed");
        $('#packlength').focus();
        return false;
    }
    if($('#countryoforigin').val() == '')
    {
        alert("Please Fill Country Of Origin Filed");
        $('#countryoforigin').focus();
        return false;
    }
    if($('#hsncode').val() == '')
    {
        alert("Please Fill Hsn Code Filed");
        $('#hsncode').focus();
        return false;
    }
    if($('textarea#description').val() == '')
    {
        alert("Please Fill Product Descriptio Filed");
        $('textarea#description').focus();
        return false;
    }
    if($('#pre_mrp').val() == '')
    {
        alert("Please Fill MRP Filed");
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
        alert("Please Fill Product Stock Filed");
        $('#pro_stock').focus();
        return false;
    }
    if($('textarea#policy').val() == '')
    {
        alert("Please Fill Product Buy/Return Policy Filed");
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

function mainCategory(e)
{
    let category = e.srcElement.value;
    let url = baseUrl + "/vendor/get_brand_name";
    $.ajax({
        type: "POST",
        url: url,
        'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {category_id: category},
        success: function(response)
        {
            var s = ''; 
            $('#brandname').removeAttr('disabled');
            $('#brandname').empty();
            for (var i = 0; i < response.length; i++) {
                s = '<option value="' + response[i].name + '">' + response[i].name + '</option>';
                $('#brandname').append(s);
            }
        }
    })
}


