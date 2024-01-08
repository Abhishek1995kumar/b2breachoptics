const nextFirst = document.querySelector('.next-1');
const nextSecond = document.querySelector('.next-2');
const nextThird = document.querySelector('.next-3');
const nextFourth = document.querySelector('.next-4');
const nextFifth = document.querySelector('.next-5');
const nextSixth = document.querySelector('.next-6');

const imgNext = document.querySelector('.img-next');

const fillManual = document.querySelector('.fill-manual');

const firstCheck = document.querySelector('#both_eyes');
const secondCheck = document.querySelector('#both_eyes-2');
const thirdCheck = document.querySelector('#both_eyes-3');

const firstForm = document.querySelector('#form-1');
const secondForm = document.querySelector('#form-2');
const thirdForm = document.querySelector('#form-3');
const fourthForm = document.querySelector('#form-4');
const fifthForm = document.querySelector('#form-5');
const sixthForm = document.querySelector('#form-6');

const formModel = document.querySelector('#form-model');
const imgModel = document.querySelector('#img-model');
const bothQty = document.querySelector('#bothQuantity');
const leftQty = document.querySelector('#leftQuantity');
const rightQty = document.querySelector('#rightQuantity');


var fileTag = document.getElementById("uploadFile"),
	preview = document.getElementById("showFile");
	labelData = document.getElementById("showLabel");

fileTag.addEventListener("change", function() {
	changeImage(this);
	formModel.style.display = "none";
	imgModel.style.display = "block";
});

var image = {};
function changeImage(input) {
	var reader;

	if (input.files && input.files[0]) {
		reader = new FileReader();

		reader.onload = function(e) {
			preview.setAttribute('src', e.target.result);

			var filename = input.files[0].name;
			
			if(filename !== '') {
				$('#showLabel').html(filename);
			}
		};

		reader.readAsDataURL(input.files[0]);
		
        image.prescription = input.files[0];
	}
	
}

imgNext.addEventListener('click', function() {
	if(image.prescription !== null) {
	    // left eye field ----------
	    $('#toric_ldia').val('');
	    $('#toric_laxis').val('');
	    $('#toric_lbc').val('');
	    $('#toric_lcyle').val('');
	    $('#sph_ldia').val('');
	    $('#sph_lbc').val('');
	    $('#multi_lopwer').val('');
	    $('#multi_lbc').val('');
	    $('#multi_ldia').val('');
	    
	    // right eye field --------
	    $('.getPowerRight').val('');
	    $('#raxis').val('');
	    $('#rbc').val('');
	    $('#rcyl').val('');
	    $('#rdia').val('');
	    $('#multi_rpower').val('');
	    
	    // both eye field ---------
	    $('.getPowerBoth').val('');
		$('#multi_bbc').val('');
		$('#multi_bpower').val('');
		$('#toric_bcyle').val('');
		$('#sph_bbc').val('');
	
		fifthForm.style.display = 'block';
		firstForm.style.display = 'none';
		// imgModel.style.display = 'none';
	}else {
		fifthForm.style.display = 'none';
		imgModel.style.display = 'none';
		formModel.style.display = "block";
		firstForm.style.display = 'block';
	}
});

nextFirst.addEventListener('click', function() {
    // left eye field ----------
    $('#toric_ldia').val('');
    $('#toric_laxis').val('');
    $('#toric_lbc').val('');
    $('#toric_lcyle').val('');
    $('#sph_ldia').val('');
    $('#sph_lbc').val('');
    $('#multi_lopwer').val('');
    $('#multi_lbc').val('');
    $('#multi_ldia').val('');
    
    // right eye field --------
    $('.getPowerRight').val('');
    $('#raxis').val('');
    $('#rbc').val('');
    $('#rcyl').val('');
    $('#rdia').val('');
    $('#multi_rpower').val('');
    
    // both eye field ---------
    $('.getPowerBoth').val('');
	$('#multi_bbc').val('');
	$('#multi_bpower').val('');
	$('#toric_bcyle').val('');
	$('#sph_bbc').val('');
    
	fifthForm.style.display = 'block';
	firstForm.style.display = 'none';
});

fillManual.addEventListener('click', function() {
    if(firstCheck.checked){
        thirdForm.style.display = 'block';
	    firstForm.style.display = 'none';
    }else{
        secondForm.style.display = 'block';
	    firstForm.style.display = 'none';
    }
})

firstCheck.addEventListener('click', function() {
    $('#toric_ldia').val('');
    $('#toric_laxis').val('');
    $('#toric_lbc').val('');
    $('#toric_lcyle').val('');
    $('#sph_ldia').val('');
    $('#sph_lbc').val('');
    $('#multi_lopwer').val('');
    $('#multi_lbc').val('');
    $('#multi_ldia').val('');
    
    if($('.getPowerRight').val() != '' && $('#raxis').val() != '' && $('#rbc').val() != '' && $('#rcyl').val() != '' && $('#rdia').val() != '' && $('#multi_rpower').val() != '') {
		if(firstCheck.checked) {
			thirdForm.style.display = 'block';
			secondForm.style.display = 'none';
			secondCheck.checked = true;
			thirdCheck.checked = true;
            
            if($('#lenseType').val() == "MultiFocal") {
    			var rightPower = $('.getPowerRight').val();
    			var rightBase = $('#rbc').val();
    			var rightAddPower = $('#multi_rpower').val();
			
    			$('.getPowerBoth').val(rightPower);
    			$('#multi_bbc').val(rightBase);
    			$('#multi_bpower').val(rightAddPower);
		    }
		    else if($('#lenseType').val() == "toric and Astigmatism") {
		        var rightPower = $('.getPowerRight').val();
    			var rightAxis = $('#raxis').val();
    			var rightBase = $('#rbc').val();
    			var rightCycle = $('#rcyl').val();
    			
    			$('.getPowerBoth').val(rightPower);
    			$('#toric_baxis').val(rightAxis);
    			$('#toric_bbc').val(rightBase);
    			$('#toric_bcyle').val(rightCycle);
		    }
		    else {
		        var rightPower = $('.getPowerRight').val();
    			var rightBase = $('#rbc').val();
    			var rdia = $('#rdia').val();
			
    			$('.getPowerBoth').val(rightPower);
    			$('#sph_bbc').val(rightBase);
    			$('#sph_bdia').val(rdia)
		    }
		    
		    $("#sph_ldia option[value!='']").attr('selected', false);
	        $("#sph_lbc option[value!='']").attr('selected', false);
		}
		
		if(firstCheck.unchecked) {
    		$('.getPowerBoth').val('');
    		$('#toric_baxis').val('');
    		$('#toric_bbc').val('');
    		$('#toric_bcyle').val('');
    		$('#multi_bpower').val('');
		}
    }
    else{
        firstCheck.checked = false;
        if($('.getPowerRight').val() == '') {
	        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_rpower').val() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right ADD Power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#rbc').val() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right BC data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#raxis').val() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right Axis data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#rcyl').val() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right RCYL data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#rdia').val() != ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill right DIA data!',
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

secondCheck.addEventListener('click', function() {
	if(secondCheck.checked == false)
	{
		thirdForm.style.display = 'none';
		secondForm.style.display = 'block';
		firstCheck.checked = false;
		thirdCheck.checked = false;
		
		$("#sph_ldia option[value!='']").attr('selected', false);
	    $("#sph_lbc option[value!='']").attr('selected', false);
	}
	else
	{
	    $('#toric_ldia').val('');
	    $('#toric_laxis').val('');
	    $('#toric_lbc').val('');
	    $('#toric_lcyle').val('');
	    $('#sph_ldia').val('');
	    $('#sph_lbc').val('');
	    $('#multi_lopwer').val('');
	    $('#multi_lbc').val('');
	    $('#multi_ldia').val('');
	}
});

thirdCheck.addEventListener('click', function() {
	if(thirdCheck.checked)
	{
		thirdForm.style.display = 'block';
		fourthForm.style.display = 'none';
		secondCheck.checked = true;
		thirdCheck.checked = true;
		
		var rightPower = $('.getPowerRight').val();
		var rightAxis = $('#raxis').val();
		var rightBase = $('#rbc').val();
		var rightCycle = $('#rcyl').val();
		
		$('.getPowerBoth').val(rightPower);
		$('#toric_baxis').val(rightAxis);
		$('#toric_bbc').val(rightBase);
		$('#toric_bcyle').val(rightCycle);
		
		$("#sph_ldia option[value!='']").attr('selected', false);
	    $("#sph_lbc option[value!='']").attr('selected', false);
	    
	    // left eye field -----------
	    $('#toric_ldia').val('');
	    $('#toric_laxis').val('');
	    $('#toric_lbc').val('');
	    $('#toric_lcyle').val('');
	    $('#sph_ldia').val('');
	    $('#sph_lbc').val('');
	    $('#multi_lopwer').val('');
	    $('#multi_lbc').val('');
	    $('#multi_ldia').val('');
	}
		
});

nextSecond.addEventListener('click', function() {
    if($('#lenseType').val() == "MultiFocal")
    {
        if($('.getPowerRight').val() !='' && $('#raxis').val() != '' && $('#rbc').val() != '' && $('#rcyl').val() != '' && $('#rdia').val() != '' && $('#multi_rpower').val() != '') {
    		fourthForm.style.display = 'block';
    		secondForm.style.display = 'none';
        }
        else {
            if($('.getPowerRight').val() == '') {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#multi_rpower').val() == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rbc').val() == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#raxis').val() == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rcyl').val() == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Cyl data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rdia').val() != ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right DIA data!',
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
    else if($('#lenseType').val() == "toric and Astigmatism")
    {
        if($('.getPowerRight').val() !='' && $('#raxis').val() != '' && $('#rbc').val() != '' && $('#rcyl').val() != '' && $('#rdia').val() != '') {
    		fourthForm.style.display = 'block';
    		secondForm.style.display = 'none';
        }
        else {
            if($('.getPowerRight').val() == '')
            {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#multi_rpower').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rbc').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#raxis').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rcyl').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Cyl data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rdia').val() != '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right DIA data!',
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
    else {
        if($('.getPowerRight').val() !='' && $('#rbc').val() != '' && $('#rdia').val() != '')
        {
    		fourthForm.style.display = 'block';
    		secondForm.style.display = 'none';
        }
        else {
            if($('.getPowerRight').val() == '')
            {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rbc').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if($('#rdia').val() != '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right DIA data!',
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
})

nextThird.addEventListener('click', function()
{
    if($('.getPowerBoth').val() != ''&& $('#sph_bbc').val() != '' && $('#sph_bdia').val() != '' && $('#toric_baxis').val() != '' && $('#toric_bcyle').val() != '') {
		fifthForm.style.display = 'block';
		thirdForm.style.display = 'none';
	    bothQty.style.display = 'block';
	    leftQty.style.display = 'none';
	    rightQty.style.display = 'none';
    }
    else
    {
        if($('.getPowerLeft').val() == '')
        {
	        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_lopwer').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left ADD Power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_lbc').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left BC data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#raxis').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left Axis data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#rcyl').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left Axis data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_ldia').val() != '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left DIA data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    }
})

nextFourth.addEventListener('click', function() {
    if($('.getPowerLeft').val() != '' && $('#multi_lopwer').val() != '' && $('#multi_lbc').val() != '' && $('#multi_ldia').val() != '') {
		fifthForm.style.display = 'block';
		fourthForm.style.display = 'none';
    }
    else
    {
        if($('.getPowerLeft').val() == '')
        {
	        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_lopwer').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left ADD Power data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_lbc').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left BC data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#raxis').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left Axis data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#rcyl').val() == '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left Axis data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
        else if($('#multi_ldia').val() != '')
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please fill Left DIA data!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    }
})

nextFifth.addEventListener('click', function()
{
    if($('.left-quantity').val() != '' || $('.right-quantity').val() != '' || $('.both-quantity').val() != ''){
		sixthForm.style.display = 'block';
		fifthForm.style.display = 'none';
		
		if($('.left-quantity').val() != '')
		{
		    var quantity = parseInt($('.left-quantity').val());
		}
		else
		{
		    var quantity = 0;
		}
		
		if($('.right-quantity').val() != '')
		{
		    var quantity2 = parseInt($('.right-quantity').val());
		}
		else
		{
		    var quantity2 = 0;
		}
		
		if($('.both-quantity').val() != '')
		{
		    var quantity3 = parseInt($('.both-quantity').val());
		}
		else{
		    var quantity3 = 0;
		}
		var prePrice = parseInt($('#prev-price').val());
		var price = parseInt($('#sell-price').val());
		
		if(quantity3 == ''){
		    var mrpPrice = (quantity + quantity2) * prePrice;
		}
		else
		{
		    var mrpPrice = (quantity3) * prePrice;
		}
		
		if(quantity3 == '')
		{
		    var sellPrice = (quantity + quantity2) * price;
		}
		else
		{
		    var sellPrice = (quantity3) * price;
		}
		
		if(quantity3 == '')
		{
		    $('.boxQty').val(quantity + quantity2);
		    $('#quantity').val(quantity + quantity2);
		}
		else
		{
		    $('.boxQty').val(quantity3);
		    $('#quantity').val(quantity3);
		}
		
		$(".previous").val(mrpPrice);
		
		$(".selling").val(sellPrice);
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            width: 500,
            text: 'Please Select Any One Eye Qty !',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
              hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    }
	
});

const firstBack = document.querySelector('.back-1');
const secondBack = document.querySelector('.back-2');
const thirdBack = document.querySelector('.back-3');
const fourthBack = document.querySelector('.back-4');
const fifthBack = document.querySelector('.back-5');

$('.main-back').on('click', function() {
    window.location.href = $('#relocate_location').val();
})

firstBack.addEventListener('click', function() {
	firstForm.style.display = 'block';
	secondForm.style.display = 'none';
	formModel.style.display = "block";
});

secondBack.addEventListener('click', function() {
	firstForm.style.display = 'block';
	thirdForm.style.display = 'none';
});

thirdBack.addEventListener('click', function() {
	secondForm.style.display = 'block';
	fourthForm.style.display = 'none';
});

fourthBack.addEventListener('click', function() {
	if(secondCheck.checked == true){
	    thirdForm.style.display = 'block';
	    fifthForm.style.display = 'none';
	}else {
	    if(image.prescription != null){
		    firstForm.style.display = 'block';
	        imgModel.style.display = "block";
	        formModel.style.display = "none";
	        fifthForm.style.display = 'none';
	        thirdForm.style.display = 'none';
	    }
	    else{
	        fourthForm.style.display = 'block';
	        fifthForm.style.display = 'none';
	        imgModel.style.display = "none";
	        formModel.style.display = "none";
	        firstForm.style.display = 'none';
	    }
	}
});

fifthBack.addEventListener('click', function() {
	fifthForm.style.display = 'block';
	sixthForm.style.display = 'none';
});

$(document).ready(()=>{
	$("#select option[value=0]").attr('selected', 'selected');
	$("#select2 option[value=0]").attr('selected', 'selected');
	$("#sph_ldia option[value!='']").attr('selected', true);
	$("#sph_lbc option[value!='']").attr('selected', true);
});

// right eye power ajax function -------------------------

$(".power-data-right").click(function() {
	var data = $(this).attr('value');
	insertDataRight(data);
});

function insertDataRight(data) {
	$('.getPowerRight').val(data);
}

// both eye ajax function ----------------------------------

$(".power-data-both").click(function() {
	var data = $(this).attr('value');
	insertDataBoth(data);
});

function insertDataBoth(data) {
	$('.getPowerBoth').val(data);
}

// left eye ajax function ---------------------------------

$(".power-data-left").click(function() {
	var data = $(this).attr('value');
	insertDataLeft(data);
});

function insertDataLeft(data) {
	$('.getPowerLeft').val(data);
}

var save_method;

$(document).ready(function(){
   
    $('#PrescriptionForm').submit(function(e){
        var formData = new FormData(this);
		
        e.preventDefault();
        $.ajax({
            url: mainUrl + "/cartupdate",
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : formData,
            processData: false,
            contentType: false,
            cache : false,
            dataType: 'JSON',
            success:function(data){
			    if (data.status == 200) {
					window.location.href = mainUrl + "/cart";
				}
			},
		});
	}); 
});

function validate() {
    var msg = new Array();
    if( !jQuery.isEmptyObject(msg))
    {
        $('.error').text(msg[0]);
    }
    else return true;
}

var getPowerRight, selectRigCyl;
function powerRightToricPlusMinusList(e){
	getPowerRight = $(".getPowerRight").val();
	getRightEyeConv();
}
function selectRightCylinder(e){
	selectRigCyl = e.target.value;
	getRightEyeConv();
}

var validArray = ['',undefined]
function getRightEyeConv(){
	if(!(validArray.includes(getPowerRight)) && !(validArray.includes(selectRigCyl))){
		$.ajax({
			method:'POST',
			url: mainUrl + "/fetchConversionRight",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: {
                sphere: getPowerRight,
				cylinder: selectRigCyl
            },
			dataType: 'JSON',
			success:function(resp) {
				if(resp.ststus == 'success'){
					$("#minus_right_eye").val(resp.data);
				}
			}
		});
	}
}

$("#both_eyes").on("click", function(e){
	if($(this).prop('checked')){
		$("#minus_left_eye").val($("#minus_right_eye").val());
	}else{
		$("#minus_left_eye").val('');
	}
});

$("#both_eyes-3").on("click", function(e){
	if($(this).prop('checked')){
		$("#minus_left_eye").val($("#minus_right_eye").val());
	}else{
		$("#minus_left_eye").val('');
	}
});

var getPowerLeft, selectLeftCyl;
function powerLeftToricPlusMinusList(e){
	getPowerLeft = $(".getPowerLeft").val();
	getLeftEyeConv();
}
function selectLeftCylinder(e){
	selectLeftCyl = e.target.value;
	getLeftEyeConv();
}

function getLeftEyeConv(){
	if(!(validArray.includes(getPowerLeft)) && !(validArray.includes(selectLeftCyl))){
		$.ajax({
			method:'POST',
			url: mainUrl + "/fetchConversionRight",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: {
                sphere: getPowerLeft,
				cylinder: selectLeftCyl
            },
			dataType: 'JSON',
			success:function(resp) {
				if(resp.ststus == 'success'){
					$("#minus_left_eye").val(resp.data);
				}
			}
		});
	}
}

var url = mainUrl + "/check-product-qty";
var leftEyeQuantity;
function leftQuantity(e)
{
	let id = $("input[name=product]").val();
	let paid = $("input[name=productAttrId]").val();
	
	leftEyeQuantity = $(e.target).val();
	
	if(!leftEyeQuantity) return false;
	fetchEyeQtyDetails(id, paid, leftEyeQuantity, url, e);
}
	
var rightEyeQuantity;
function rightQuantity(e)
{
	var id = $("input[name=product]").val();
	var paid = $("input[name=productAttrId]").val();
	rightEyeQuantity = $(e.target).val();
	if(!rightEyeQuantity) return false;
	fetchEyeQtyDetails(id, paid, rightEyeQuantity, url, e);
}

function fetchEyeQtyDetails(id, paid, qty, url, e){
	$.ajax({
		type: "POST",
		url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: {
			id:id,
			paid:paid,
			qty:qty,
		},
		success: function(data) {
			if(data.error){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					width: 500,
					text: data.response,
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				});
				$(e.target).val('');
			}else{
				bothEyeQuantity(e);
			}
		}
	});
}


const bothEyeQuantity = (e) => {
	let id = $("input[name=product]").val();
	let paid = $("input[name=productAttrId]").val();

	if(rightEyeQuantity && leftEyeQuantity){
		let qty = parseInt(rightEyeQuantity)+parseInt(leftEyeQuantity);
		$.ajax({
			type: "POST",
			url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data: {
				id:id,
				paid:paid,
				qty:qty,
			},
			success: function(data) {
				if(data.error){
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						width: 500,
						text: data.response,
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						}
					});
					$(e.target).val('');
					leftEyeQuantity = $(e.target).val();
					rightEyeQuantity = $(e.target).val();
				}
			}
		});
	}
}



function bothQuantity(e)
{
	var id = $("input[name=product]").val();
	var paid = $("input[name=productAttrId]").val();
	var color = $("input[name=cartcolor]").val();
	var qty = $(e.target).val();
	var url = mainUrl + "/check-product-qty";
	if(!qty) return false;
	$.ajax({
		type: "POST",
		url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: {
			id:id,
			paid:paid,
			color:color,
			qty:qty,
		},
		success: function(data) {
			if(data.error){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					width: 500,
					text: data.response,
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				});
				$(e.target).val('');
			}
		}
	});
}
	
	
	
	
	
	