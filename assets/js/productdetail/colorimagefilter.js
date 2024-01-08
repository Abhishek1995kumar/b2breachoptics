// search key = changemainImage function - for main image
// search key = changeImage function - for attibute image
// search key = stockmanagement function - for stock management of product
// search key = hideButton and moreBotton event - for more and less functionality
// vedio open and close functions


//bulk qty
$("#toggle").on("click", function(){
  $("#bulk_qty").toggle();                 
});

// multiple images fetch from onclick function for product attribute ----------

function changeSize(size, e) 
{
    for(let i=0; i<$("#product-size").children().length; i++)
    {
        $($("#product-size").children()[i]).css("border-color", "");
    }
    $(e.target).css({"border-color": "blue" ,"border-width" :"3px"});
    $('#size').val(size);
    $('#size_span').text(size);
}

// $(window).on('load', function() {
//     var presData = mainColor
// });

function changemainImage(data, ele) {
    $('.attrColor').find('button').removeClass('selected_css');
    $(ele).addClass('selected_css');
    jQuery('#attrImages').html('');
    let mainid = data;
    $('#attrColorData').val('');
    var color = $('.mainColor').attr('data');
    $('#attrColorData').val(color);
    $('#colormain').val(color);
    const url2 = baseUrl+"/productshoww/"+mainid+"/";
    $('#presButton').attr("href", url2+color);
    const url = baseUrl + "/product/changeImage";
    $.ajax({
        type: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            mainid: mainid,
            color: color,
        },
        success: function (data) {
            jQuery('#attrImages').html('');
            jQuery('#cost_price').html('');
            html = `<img id="iconsmain" onmouseover="productattrGallery(this.id)" src="${baseUrl}/assets/images/products/${data.mainImg[0].feature_image}" alt="">`;
            
            if(data.mainImg[0].category == '72') {
              $('#color_span').text(data.mainImg[0].lenscolor);
              $('#lenscolor').val(data.mainImg[0].lenscolor);
              $('.contactLensColor').val(data.mainImg[0].lenscolor);
            }else {
                if(data.mainImg[0].category == '58'){
                    $('#color_span').text(data.mainImg[0].color);
                    $('.lensColor').text(data.mainImg[0].color);
                    $('.lensColors').text(data.mainImg[0].color);
                }
                if(data.mainImg[0].category == '53' || data.mainImg[0].category == '63' || data.mainImg[0].category == '82'){
                    $('#color_span').text(data.mainImg[0].framecolor);
                    $('.frameColor').text(data.mainImg[0].framecolor);
                    $('.frameColors').text(data.mainImg[0].framecolor);
                    $('.frameDimension').text(data.mainImg[0].productdimension);
                    $('.productDimension').text(data.mainImg[0].productdimension);
                }
            }
            
            $('.productsku_info').text(data.mainImg[0].productsku);
            $('.productSkuInfo').text(data.mainImg[0].productsku);
            
            // for stock management -----------------------
            
            $('#qty_span').text(data.mainImg[0].stock);
            $('#productstock').val(data.mainImg[0].stock);
            
            $('#productAttrId').val("");
            
            // --------------------------------------------
            
            
            $('#price_span').text(data.mainImg[0].previous_price);

            $('#price').val(data.mainImg[0].costprice);
            $('#main_price').val(data.mainImg[0].costprice);
            $('#cost').val(data.mainImg[0].costprice);
            
            $('#price_span').text(data.mainImg[0].previous_price);
            
            jQuery('#cost_price').append("Product Cost Price:- "+data.mainImg[0].costprice);
            
            for(let i=0;i<data.gallImg.length;i++){
                html += `<div class="images-attr">
                            <img id="icon${data.gallImg[i].id}" onmouseover="productattrGallery(this.id)" src="${baseUrl}/assets/images/gallery/${data.gallImg[i].image}" alt="">
                        </div>`;
            }

            let html3 = '';

            let productdimension = $('#productdimensionsize').val();
            $('.sizeClick').text(productdimension);
            $('#size_span').text(productdimension);
            $('#productImage').val(data.mainImg[0].feature_image);
            $('#color_code').val(data.mainImg[0].colorcode);
            if(data.mainImg[0].colorcode){
                $('#color_code_span').text(data.mainImg[0].colorcode);
            }
            else{
                $('#color_code_span').text('');
            }
        
            // if(data.main_pro_size[0].attr_size != '') {
            //     jQuery('#size_span').text(data.main_pro_size[0].attr_size);
            //     $('#size').val(data.main_pro_size[0].attr_size);
            //     for(let j=0; j<data.main_pro_size.length; j++) {  
            //         let html3 = `<span style="width: 60px;" onclick="changeSize('${data.main_pro_size[j].attr_size}')" class="sizeClick" data="${data.main_pro_size[j].product_id}">${data.main_pro_size[j].attr_size}</span>`;
            //         jQuery('#product-size').append(html3);
            //      }
            // }
            
            jQuery('#attrImages').append(html);

            $('#iconsmain').mouseover();
    
            stockmanagement(data.mainImg[0].stock, data.cart);
        }
    });
}

function changeImage(data, ele) {
    $('.attrColor').find('button').removeClass('selected_css');
    $(ele).addClass('selected_css');
    jQuery('#attrImages').html('');
    jQuery('#product-size').html('');
    let color = data;
    let id = $('.main-class').attr('data');
    let pid = $('#mainId').val();

    $('#attrColorData').val(color);
    const url2 = baseUrl + "/productshoww/"+ pid;
    $('#presButton').attr("href", url2+color);
    const url = baseUrl + "/product/changeImage";
    
    const imgurl = baseUrl + '/assets/images/product_attr';
    
    $.ajax({
        type: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            color: color,
            mainid: pid,
        },
        success: function (data) {
            jQuery('#attrImages').html('');
            jQuery('#product-size').html('');
            jQuery('#cost_price').html('');
            for(let i=0;i<data.gallery.length;i++){
                html = `<div class="images-attr">
                            <img id="icon${data.gallery[i].id}" onmouseover="productattrGallery(this.id)" 
                            src="${imgurl}/${data.gallery[i].attr_imgs}" alt="">
                        </div>`;
                        
                jQuery('#attrImages').append(html);
            }
            $('.images-attr').children().first().mouseover();
            
            // for stock management ------------------
            
            $('#qty_span').text(data.sizes[0].attr_qty);
            
            $('#productstock').val('');

            $('#productAttrId').val(data.sizes[0].id);
            
            // -------------------------------------
            
            $('#color_span').text(data.sizes[0].attr_color);
            if(data.gallery[0].attr_color_code){
                $('#color_code_span').text(data.gallery[0].attr_color_code);
            }
            else{
                $('#color_code_span').text('');
            }
            if(data.gallery[0].attr_color_code){
                $('#color_code').val(data.gallery[0].attr_color_code);
            }
            else{
                $('#color_code').val('');
            }
            $('#lenscolor').val(data.sizes[0].attr_color);
            $('#price_span').text(data.sizes[0].attr_mrp);
            
            $('#price').val(data.sizes[0].attr_price);
            $('#main_price').val(data.sizes[0].attr_price);
            $('#cost').val(data.sizes[0].attr_price);
            
            $('#productImage').val(data.gallery[0].attr_imgs);
            
            $('.lensColor').text(data.sizes[0].attr_color);
            $('.contactLensColor').text(data.sizes[0].attr_color);
            $('.lensColors').text(data.sizes[0].attr_color);
            $('.frameColor').text(data.sizes[0].attr_color);
            $('.frameColors').text(data.sizes[0].attr_color);
            $('.productsku_info').text(data.sizes[0].attr_sku);
            $('.productSkuInfo').text(data.sizes[0].attr_sku);
            $('.frameDimension').text(data.sizes[0].attr_size ? data.sizes[0].attr_size : "-");
            $('.productDimension').text(data.sizes[0].attr_size ? data.sizes[0].attr_size : "-");
            
            jQuery('#cost_price').append("Product Cost Price:- "+data.sizes[0].attr_price);
            
            if(data.sizes[0].attr_size != '') {
                var html2 ='';
                // jQuery('#size_span').text(data.sizes[0].attr_size);
                // $('#size').val(data.sizes[0].attr_size);
                for(let j=0; j<data.sizes.length; j++){
                    if(data.sizes[j].attr_size != ''){
                        html2 += `<span style="width: 80px; font-weight: bold;" onclick="changeSize('${data.sizes[j].attr_size}', event)" class="sizeClick" data="${data.sizes[j].product_id}">${data.sizes[j].attr_size}</span>`;
                    }
                }
                jQuery('#product-size').append(html2);
            }
            stockmanagement(data.sizes[0].attr_qty, data.cart);
        }
    });
}

function stockmanagement(stock, cart){
    const showurl = mainurl + '/productshoww';
    let outstock = $('#outofstock').val();
    let addtocart = $('#addtocartbutton').val();
    $('.cartButton').html('');
    $('.stockmanagement').html('');
    let cat = $("#category").val();
    let color = $("#lenscolor").val();
    let mainId = $("[name='product']").val();
    let html = `<span class="available">
                    <i class="fa fa-check-square-o"></i>
                    <span>${$('#availablity').val()}</span>
                </span>`;
                    
    let html2 = `<span class="not-available">
                <i class="fa fa-times-circle-o"></i>
                <span>${$('#outofstock').val()}</span>
                <input name="btn" type="submit" class="btn-notify" value="Notify Me">
                <!--<button type="" >Notify Me</button>-->
                </span>`;
    
    let but1;
    let but3;
    let but4;
    if(cat == 72){
        let but1 = `<button type="button" class="btn btn-primary" style="border:none; cursor:pointer;"><a href="${showurl}/${mainId}/${color}" id="presButton" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>`;
    }
    else if(cat == 58){
        if(prescriptionData == null)
        {
            but3 = `<button style="margin-left: 0px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescriptionModal" data-whatever="@getbootstrap" style="outline:none;">Add Prescription</button>`;
        }
        else
        {
            but4 = `<button style="margin-left: 0px;" type="button"  onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>${addtocart}</span></button>`;
        }
    }
    else{
        but1 = `<button style="margin-left: 0px;" type="button" onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>${addtocart}</span></button>`;
    }
    
    let but2 = `<button style="margin-left: 0px;" type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>${outstock}</button>`;
    let but5 = `<button style="margin-left: 0px;" type="button" onclick="cartedProduct()" class="added-cart">Added Cart</button>`;
    
    if(stock == null || stock == 0){
        if(cart>0){
            $('.cartButton').append(but5);
        }
        else{
            $('.cartButton').append(but2);
        }
        $('.stockmanagement').append(html2);
    }else{
        if(prescriptionData == null)
        {
            $('.prescriptionadd').append(but3)
        }
        else
        {
            $('.productaddtocart').append(but4)
        }
        if(cart>0){
            $('.cartButton').append(but5);
        }
        else{
            $('.cartButton').append(but1);
        }
        $('.stockmanagement').append(html);
    }
}


let imageDatas = document.querySelector(".moreImageData");
let moreBotton = document.querySelector(".maoreImage");
let hideButton = document.querySelector(".lessImage");
let allImagesDatas = document.querySelector(".allImageDatas");

if(allImagesDatas.value > 4){
  moreBotton.addEventListener('click', function() {
    imageDatas.style.display = 'inline';
    hideButton.style.display = 'inline';
    moreBotton.style.display = 'none';
  });
}
else{
  moreBotton.style.display = 'none';
}

hideButton.addEventListener('click', function() {
  imageDatas.style.display = 'none';
  hideButton.style.display = 'none';
  moreBotton.style.display = 'inline';
});


// vedio open and close functions -----------

window.document.onkeydown = function(e) {
    if (!e) {
        e = event;
    }
    if (e.keyCode == 27) {
        lightbox_close();
        lightbox_close1();
        lightbox_close2();
    }
}

function lightbox_open() {
  let lightBoxVideo = document.getElementById("VisaChipCardVideo");
  window.scrollTo(0, 0);
  document.getElementById('light').style.display = 'block';
  document.getElementById('fade').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  document.getElementById('light').style.display = 'none';
  document.getElementById('fade').style.display = 'none';
  lightBoxVideo.pause();
}

function lightbox_open1() {
  let lightBoxVideo = document.getElementById("VisaChipCardVideo1");
  window.scrollTo(0, 0);
  document.getElementById('light1').style.display = 'block';
  document.getElementById('fade1').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close1() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo1");
  document.getElementById('light1').style.display = 'none';
  document.getElementById('fade1').style.display = 'none';
  lightBoxVideo.pause();
}

function lightbox_open2() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo2");
  window.scrollTo(0, 0);
  document.getElementById('light2').style.display = 'block';
  document.getElementById('fade2').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close2() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo2");
  document.getElementById('light2').style.display = 'none';
  document.getElementById('fade2').style.display = 'none';
  lightBoxVideo.pause();
}
