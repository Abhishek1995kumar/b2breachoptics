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
    var mainid = data;
    $('#attrColorData').val('');
    var color = $('.mainColor').attr('data');
    $('#attrColorData').val(color);
    $('#colormain').val(color);
    url2 = baseUrl+"/productshoww/"+mainid+"/";
    $('#presButton').attr("href", url2+color);
    url = baseUrl + "/product/changeImage";
    $.ajax({
        type: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            mainid: mainid,
        },
        success: function (data) {
            jQuery('#attrImages').html('');
            jQuery('#cost_price').html('');
            html = `<img id="iconsmain" onmouseover="productattrGallery(this.id)" src="${baseUrl}/assets/images/products/${data.mainImg[0].feature_image}" alt="">`;
            
            if(data.mainImg[0].category == '72') {
               $('#color_span').text(data.mainImg[0].lenscolor);
               $('#lenscolor').val(data.mainImg[0].lenscolor);
            }else {
                if(data.mainImg[0].category == '58'){
                    $('#color_span').text(data.mainImg[0].color);
                }
                if(data.mainImg[0].category == '53' || data.mainImg[0].category == '63' || data.mainImg[0].category == '82'){
                    $('#color_span').text(data.mainImg[0].framecolor);
                }
            }
            
            
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

            let productdimension = '<?php echo $productdata->productdimension; ?>';
            $('.sizeClick').text(productdimension);
            $('#size_span').text(productdimension);
            $('#productImage').val(data.mainImg[0].feature_image);
        
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
    
            stockmanagement(data.mainImg[0].stock);
        }

    });
}

function changeImage(data, ele) {
    $('#presButton').attr("href", "");
    $('.attrColor').find('button').removeClass('selected_css');
    $(ele).addClass('selected_css');
    jQuery('#attrImages').html('');
    jQuery('#product-size').html('');
    var color = data;
    var id = $('.main-class').attr('data');

    $('#attrColorData').val(color);
    url2 = baseUrl+"/productshoww/"+id+"/";
    $('#presButton').setAttribute("href", url2+color);
    url = baseUrl + "/product/changeImage";
    $.ajax({
        type: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            color: color,
        },
        success: function (data) {
            jQuery('#attrImages').html('');
            jQuery('#product-size').html('');
            jQuery('#cost_price').html('');
            for(let i=0;i<data.gallery.length;i++){
                html = `<div class="images-attr">
                            <img id="icon${data.gallery[i].id}" onmouseover="productattrGallery(this.id)" 
                            src="${baseUrl}/assets/images/product_attr/${data.gallery[i].attr_imgs}" alt="">
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
            $('#lenscolor').val(data.sizes[0].attr_color);
            $('#price_span').text(data.sizes[0].attr_mrp);

            $('#price').val(data.sizes[0].attr_price);
            $('#main_price').val(data.sizes[0].attr_price);
            $('#cost').val(data.sizes[0].attr_price);
            
            $('#productImage').val(data.gallery[0].attr_imgs);
            
            jQuery('#cost_price').append("Product Cost Price:- "+data.sizes[0].attr_price);
            
            if(data.sizes[0].attr_size != '') {
                var html2 ='';
                // jQuery('#size_span').text(data.sizes[0].attr_size);
                // $('#size').val(data.sizes[0].attr_size);
                for(let j=0; j<data.sizes.length; j++){
                    if(data.sizes[j].attr_size != ''){
                        html2 += `<span style="width: 60px; font-weight: bold;" onclick="changeSize('${data.sizes[j].attr_size}', event)" class="sizeClick" data="${data.sizes[j].product_id}">${data.sizes[j].attr_size}</span>`;
                    }
                }
                jQuery('#product-size').append(html2);
            }
            stockmanagement(data.sizes[0].attr_qty);
        }
    });
}

function stockmanagement(stock){
    $('.cartButton').html('');
    $('.stockmanagement').html('');
    var cat = $("#category").val();
    var color = $("#lenscolor").val();
    var html = `<span class="available">
                    <i class="fa fa-check-square-o"></i>
                    <span>{{$language->available}}</span>
                </span>`;
                    
    var html2 = `<span class="not-available">
                <i class="fa fa-times-circle-o"></i>
                <span>{{$language->out_of_stock}}</span>
                <input name="btn" type="submit" class="btn-notify" value="Notify Me">
                <!--<button type="" >Notify Me</button>-->
                </span>`;
                
    if(cat == 72){
        var but1 = `<button type="button" class="btn btn-primary" style="border:none; cursor:pointer;"><a href="{{url('/productshoww')}}/{{$productdata->id}}/${color}" id="presButton" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>`;
    }
    else{
        var but1 = `<button style="margin-left: 0px;" type="button" onclick="addCartProduct()" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>`;
    }
    
    var but2 = `<button style="margin-left: 0px;" type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>`;
    
    if(stock == null || stock == 0){
        $('.stockmanagement').append(html2);
        $('.cartButton').append(but2);
    }else{
        $('.stockmanagement').append(html);
        $('.cartButton').append(but1);
    }
}

var imageDatas = document.querySelector(".moreImageData");
var moreBotton = document.querySelector(".maoreImage");
var hideButton = document.querySelector(".lessImage");
var allImagesDatas = document.querySelector(".allImageDatas");

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