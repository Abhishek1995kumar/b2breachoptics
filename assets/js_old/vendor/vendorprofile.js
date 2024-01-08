function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#vendorimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

  
function readCancelCheck(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


function readPassbook(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readAdhar(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readTrademark(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readUdyam(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readCompanyLogo(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#address-img-tag5').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}





