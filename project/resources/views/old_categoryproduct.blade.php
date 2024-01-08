@extends('includes.newmaster')

@section('content')

<style>

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #fff;
   /* border-top-left-radius: 20px 20px;
  border-bottom-left-radius: 20px 20px;*/
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #333;
  border-radius: 0px;
  color: white;
  font-size: 17px;
  border: 1px solid black;
  border-left: none;
  cursor: pointer;
  /*border-top-right-radius: 20px 20px;
  border-bottom-right-radius: 20px 20px;*/

}

form.example button:hover {
  /background: #0b7dda;/
   border: 1px solid black;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

.dropdown-check-list {
  display: inline-block;
  width: 100%;
}

.dropdown-check-list .anchor {
  position: relative;
  cursor: pointer;
  width: 100%;
  display: inline-block;
  padding: 5px 50px 5px 10px;
  border: 1px solid #ccc;
}

.dropdown-check-list .anchor:after {
  position: absolute;
  content: "";
  border-left: 2px solid black;
  border-top: 2px solid black;
  padding: 5px;
  right: 10px;
  top: 20%;
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  transform: rotate(-135deg);
}

.dropdown-check-list .anchor:active:after {
  right: 8px;
  top: 21%;
}

.dropdown-check-list ul.items {
  padding: 2px;
  display: none;
  margin: 0;
  border: 1px solid #ccc;
  border-top: none;
}

.dropdown-check-list ul.items li {
  list-style: none;
}

.dropdown-check-list.visible .anchor {
  color: #0094ff;
}

.dropdown-check-list.visible .items {
  display: block;
}


</style>


    <div class="home-wrapper">
        <!-- Starting of product filter breadcroumb area -->
    
    <div class="container-fluid">
    
        <div class="row margin-left-0 margin-right-0" style="">

            <div style="margin: 0% 0px 0% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                <?php
                    if(isset($category)) {?>
                        @if(is_object($category))
                        @endif
                <?php } else {?>
                    <h1 style="color : black; margin-bottom : 0;">No Category Found</h1>
                <?php }?>
                    
                </div>
            </div>

        </div>
    </section>
    </div>


    


    
  

        <!-- Starting of product filter area -->
        <div class="section-padding product-filter-wrapper padding-left-15 wow fadeInUp">
            <!--<div class="container">-->
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="product-filter-leftDiv">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="product-filter-option">
                                        <h3 class="filter-title">Filter Option</h3>
                                            <div class="form-group">
                                                <select id="sortby" class="form-control">
                                                    @if($sort == "new")
                                                        <option value="new" selected>{{$language->sort_by_latest}}</option>
                                                    @else
                                                        <option value="new">{{$language->sort_by_latest}}</option>
                                                    @endif
                                                    @if($sort == "old")
                                                        <option value="old" selected>{{$language->sort_by_oldest}}</option>
                                                    @else
                                                        <option value="old">{{$language->sort_by_oldest}}</option>
                                                    @endif
                                                    @if($sort == "low")
                                                        <option value="low" selected>{{$language->sort_by_lowest}}</option>
                                                    @else
                                                        <option value="low">{{$language->sort_by_lowest}}</option>
                                                    @endif
                                                    @if($sort == "high")
                                                        <option value="high" selected>{{$language->sort_by_highest}}</option>
                                                    @else
                                                        <option value="high">{{$language->sort_by_highest}}</option>
                                                    @endif

                                                </select>


                                            </div>


<br>
                                            <!--start serach  -->
                                        <div class="row">
                                          <div class="col-md-12">
                                              <form class="example" id="searchform" style="margin:auto;">
                                              <input type="text" id="searchdata" placeholder="Search.." name="search">
                                              <button type="submit"><i class="fa fa-search"></i></button>
                                              </form>
                                            </div>
                                          </div>
                                            
                                            <br>

                                            <!-- price filter -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="product-filter-option">
                                        <h3 class="filter-title">Price</h3>
                                        <form action="" method="GET">
                                            <div class="form-group padding-bottom-10">
                                                <input id="ex2" type="text" class="form-control" value="" data-slider-min="0" data-slider-max="{{$maxvalue}}" data-slider-step="5" data-slider-value="[{{$mins}},{{$maxs}}]"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="price-min" class="price-input" value="{{$mins}}" name="min">
                                                <i class="fa fa-minus"></i>
                                                <input type="text" id="price-max" class="price-input" value="{{$maxs}}" name="max">
                                                <input type="submit" class="price-search-btn" value="SEARCH">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- end of price filter -->

                            <!-- gender filter -->

                                                       
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                             <div class="dropdown-check-list filter-product visible" tabindex="100" data-filter='gender'>
                                                              <span class="anchor" style="color:#ffb100"><b>Select Gender</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="men" @if(!empty($gender) && in_array('men', explode(',',$gender))) checked @endif /> Men </li>
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="women" @if(!empty($gender) && in_array('women', explode(',',$gender))) checked @endif />  Women </li>
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="kids" @if(!empty($gender) && in_array('kids', explode(',',$gender))) checked @endif />  Kids </li>
                                                              </ul>
                                                              </div>

                                                            </div>
                                                        </div>
                                                  </div>







                            <!-- end of gender filter -->
                                                   <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                              <div class="dropdown-check-list filter-product visible" tabindex="100" data-filter="color">
                                                                <span class="anchor" style="color:#ffb100"><b>Select Color</b></span>
                                                                <ul class="items">
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='color[]' value="red" @if(!empty($colors) && in_array('red', explode(',',$colors))) checked @endif> Red
                                                                        </li>
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='color[]' value="black" @if(!empty($colors) && in_array('black', explode(',',$colors))) checked @endif> Black
                                                                        </li>
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='color[]' value="golden" @if(!empty($colors) && in_array('golden', explode(',',$colors))) checked @endif> Golden
                                                                       </li>
                                                                        <li>
                                                                          <input type="checkbox" class="form-check-input" name='color[]' value="whiteb" @if(!empty($colors) && in_array('whiteb', explode(',',$colors))) checked @endif> White/Brown
                                                                       </li>
                                                                </ul>
                                                              </div>
                                                        </div>
                                                  </div>
                                              </div>      
                                                                       
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">



                                                              <div class="dropdown-check-list filter-product visible" tabindex="100" data-filter="shape">
                                                                <span class="anchor" style="color:#ffb100"><b>Select Shape</b></span>
                                                                <ul class="items">
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='shape[]' value="rectangle" @if(!empty($shapes) && in_array('rectangle', explode(',',$shapes))) checked @endif> Rectangle
                                                                        </li>
                                                                <li>
                                                                           <input type="checkbox" class="form-check-input" name='shape[]' value="ovel" @if(!empty($shapes) && in_array('ovel', explode(',',$shapes))) checked @endif> Ovel
                                                                        </li>
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='shape[]' value="wayfarer" @if(!empty($shapes) && in_array('wayfarer', explode(',',$shapes))) checked @endif> Wayfarer
                                                                       </li>
                                                                       <li>
                                                                        <input type="checkbox" class="form-check-input" name='shape[]' value="clubmaster" @if(!empty($shapes) && in_array('clubmaster', explode(',',$shapes))) checked @endif>  Club Master</li>
                                                                </ul>
                                                              </div>   
                                                        </div>
                                                  </div>    
                                            </div>

                                                                     
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">




                                                              <div class="dropdown-check-list filter-product visible" tabindex="100" data-filter="shape">
                                                                <span class="anchor" style="color:#ffb100"><b>Select MakeStyle</b></span>
                                                                <ul class="items">
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='make[]' value="metal" @if(!empty($makes) && in_array('metal', explode(',',$makes))) checked @endif>    Metal
                                                                        </li>
                                                                <li>
                                                                           <input type="checkbox" class="form-check-input" name='make[]' value="shell" @if(!empty($makes) && in_array('shell', explode(',',$makes))) checked @endif>  Shell
                                                                        </li>
                                                                <li>
                                                                          <input type="checkbox" class="form-check-input" name='make[]' value="rimless" @if(!empty($makes) && in_array('rimless', explode(',',$makes))) checked @endif>  Remless
                                                                       </li>
                                                                       <li>
                                                                        <input type="checkbox" class="form-check-input" name='make[]' value="metal plastic" @if(!empty($makes) && in_array('metal plastic', explode(',',$makes))) checked @endif>      Metal Plastic</li>
                                                                </ul>
                                                              </div> 
                                                        </div>
                                                  </div>

                                                        <div class="col-lg-4">
                                                                 <button type="button" style="float: left;" class="btn btn-warning" name="allfilterApply">Apply</button>
                                                         </div>
                                                
                                            </div> 


                                  
                                    </div>
                                </div>
                            </div>
                     

                   
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="product-filter-rightDiv">
                            <div class="row" id="products">
                                @forelse($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="single-product-carousel-item text-center">
                                            <div class="image_latest_product_shubh">
                                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                                @php $gallery = $product->gallery_images->toArray(); @endphp
                                                <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
                                            </div>
                                            <div class="product-carousel-text">
                                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                    <h4 class="product-title">{{$product->title}}</h4>
                                                </a>
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>
                                                </div>
                                                <div class="product-price">
                                                    @if($product->previous_price != "")
                                                        <span class="original-price">₹{{\App\Product::Cost($product->id)}}</span>
                                                    @else
                                                    @endif
                                                    <del class="offer-price">₹{{$product->previous_price}}</del>
                                                </div>
                                                <div class="product-meta-area">
                                                    <form class="addtocart-form">
                                                        {{csrf_field()}}
                                                        @if(Session::has('uniqueid'))
                                                            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                                        @else
                                                            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                                        @endif
                                                        <input type="hidden" name="title" value="{{$product->title}}">
                                                        <input type="hidden" name="product" value="{{$product->id}}">
                                                        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">
                                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                                        @if($product->stock != 0 || $product->stock === null )
                                                            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                        @else
                                                            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                                        @endif
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row" style="margin-left: 0">
                                        <div class="col-md-12">
                                            <h3>{{$language->no_result}}</h3>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            @if(count($products) > 0)
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img id="load" src="{{url('/assets/images/default.gif')}}" style="display: none;width: 80px;">
                                </div>
                                <div class="col-md-12 text-center">
                                    <input type="hidden" id="page" value="2">
                                    <a href="javascript:;" id="load-more" class="product-filter-loadMore-btn">load more</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            <!--</div>-->
        </div>
        <!-- Ending of product filter area -->

    </div>


@stop

@section('footer')
<script>


    $(document).on('click', '.filter-product', function(e){
      if(e.target.className == 'anchor'){
        if($(this).hasClass('visible')){
          $(this).removeClass('visible');
        }else{
          $(this).addClass('visible');
        }
      }
    });

    function runProductFilter(){
        var sort = $("#sortby").val();
        var colors = '';
        var shapes = '';
        var makes ='';
        var gender='';
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

        window.location = "{{url('/category')}}/{{$category->slug}}?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender;
    }

    $("#sortby").change(function () {
        runProductFilter();
    });


    $(document).on('click','button[name=allfilterApply]', function(){
        runProductFilter();
    })



    $("#load-more").click(function () {
        $("#load").show();
        var slug = "{{$category->slug}}";
        var page = $("#page").val();
        var sort = $("#sortby").val();

        var colors = '';
        var shapes = '';
        var makes ='';
        var gender='';
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

        $.get("{{url('/')}}/loadcategory/"+slug+"/"+page+"?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender, function(data, status){
            $("#load").fadeOut();
            $("#products").append(data);
            //alert("Data: " + data + "\nStatus: " + status);
            $("#page").val(parseInt($("#page").val())+1);
            if ($.trim(data) == ""){
                $("#load-more").fadeOut();
            }

        });
    });
</script>
@stop