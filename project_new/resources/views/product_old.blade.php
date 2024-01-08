   
@extends('includes.newmaster')



@section('content')
    
<style type="text/css">
    #fade {
  display: none;
  position: fixed;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background-color: black;
  z-index: 1001;
  -moz-opacity: 0.8;
  opacity: .80;
  filter: alpha(opacity=80);
}

#light {
  display: none;
  position: absolute;
  top: 30%;
  left: 100%;
  max-width: 800px;
  max-height: 560px;
  margin-left: 300px;
  margin-top: -180px;
  border: 2px solid #FFF;
  background: #FFF;
  z-index: 1002;
  overflow: visible;
}

#boxclose {
  float: right;
  cursor: pointer;
  color: #fff;
  border: 1px solid #AEAEAE;
  border-radius: 3px;
  background: #222222;
  font-size: 31px;
  font-weight: bold;
  display: inline-block;
  line-height: 0px;
  padding: 11px 3px;
  position: absolute;
  right: 2px;
  top: 2px;
  z-index: 1002;
  opacity: 0.9;
}

.boxclose:before {
  content: "×";
}

#fade:hover ~ #boxclose {
  display:none;
}

.test:hover ~ .test2 {
  display: none;
}

/*video 2*/
#fade1 {
  display: none;
  position: fixed;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background-color: black;
  z-index: 1001;
  -moz-opacity: 0.8;
  opacity: .80;
  filter: alpha(opacity=80);
}

#light1 {
  display: none;
  position: absolute;
  top: 30%;
  left: 100%;
  max-width: 800px;
  max-height: 560px;
  margin-left: 300px;
  margin-top: -180px;
  border: 2px solid #FFF;
  background: #FFF;
  z-index: 1002;
  overflow: visible;
}

#boxclose1 {
  float: right;
  cursor: pointer;
  color: #fff;
  border: 1px solid #AEAEAE;
  border-radius: 3px;
  background: #222222;
  font-size: 31px;
  font-weight: bold;
  display: inline-block;
  line-height: 0px;
  padding: 11px 3px;
  position: absolute;
  right: 2px;
  top: 2px;
  z-index: 1002;
  opacity: 0.9;
}

.boxclose1:before {
  content: "×";
}

#fade1:hover ~ #boxclose1 {
  display:none;
}
/*end video 2*/


/*video 3*/
#fade2 {
  display: none;
  position: fixed;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background-color: black;
  z-index: 1001;
  -moz-opacity: 0.8;
  opacity: .80;
  filter: alpha(opacity=80);
}

#light2 {
  display: none;
  position: absolute;
  top: 30%;
  left: 100%;
  max-width: 800px;
  max-height: 560px;
  margin-left: 300px;
  margin-top: -180px;
  border: 2px solid #FFF;
  background: #FFF;
  z-index: 1002;
  overflow: visible;
}

#boxclose2 {
  float: right;
  cursor: pointer;
  color: #fff;
  border: 1px solid #AEAEAE;
  border-radius: 3px;
  background: #222222;
  font-size: 31px;
  font-weight: bold;
  display: inline-block;
  line-height: 0px;
  padding: 11px 3px;
  position: absolute;
  right: 2px;
  top: 2px;
  z-index: 1002;
  opacity: 0.9;
}

.boxclose2:before {
  content: "×";
}

#fade2:hover ~ #boxclose2 {
  display:none;
}
/*end video 3*/


/*media query for mobile responsive*/

#imagepad{
  padding-left: 106px;
}

@media screen and (max-width: 992px)  {


    .single-product-carousel-item {
        text-align: center;
        vertical-align: middle;
        display: table-cell;
        padding-right: 80px;
    }


    .section-padding.product-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev, .section-padding.blog-area-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev, .section-padding.logo-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-prev {
    left: 10px;
    /* bottom: -50px; */
    top: 150px;
}



.section-padding.product-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-next, .section-padding.blog-area-wrapper .owl-carousel .owl-controls .owl-nav .owl-next, .section-padding.logo-carousel-wrapper .owl-carousel .owl-controls .owl-nav .owl-next {
    right: 10px;
    top: 150px;
}

.product-carousel-wrapper{

      padding-top: 240px;

}

.section-title h2 {
    padding-left: 14px;
    font-size: 18px;
}

.product-meta-area{
    padding-left: 111px;
}

#tendingpad{

  padding: 0px;
}

#selectedpad{

  padding:0px;
} 


.single-product-item img {
    padding: 1px 1px;
    width: 30%;
    border: 1px solid #888888;
    margin: auto;
    display: inline-block;
    
}

.tab-div-shubh {
    float: right;
    padding-right: 0px;
    padding-left: 0px;
    margin-left: -140px;
    text-align: center;
    position: relative;
    z-index: 1;
}

.image_div_shubh {
    
    text-align: center;
    vertical-align: middle;
    margin-left: 80px;
    margin-top: -263px;

}

.image_div_shubh img {
    width: 76%;
    position: relative;
    z-index: 5;
}


.tab-content {
    height: 500px;
    width: 100%;
    padding: 5px 0px;
    position: relative;
    z-index: 1;
  }
  
}




/*end of media query for mobile responsive*/
  
   .itemsContainer {
    /*background:red;*/ 
    float:left;
    position:relative
}
/*.itemsContainer:hover .play{display:block}*/
.play{
  position : absolute;
    display:block;
    top:15%; 
    width:40px;
    margin:0 auto; left:0px;
    right:0px;
    z-index:100
}   
@media screen and (max-width:2560px)  {
  .praqty{
        padding-right: 82px;



  }
  .input-group .form-control.btn-responsive{
    /*border-radius: 0;
    margin-left: -2px;
    padding-left: 41px;
    width: 108px;*/
    border-radius: 0;
    margin-left: -2px;

    padding-left: 30px;
    width: 89px;
}

.col-sm-7 .cart{


}
/* .addbtn {

 }
*/


 /*addTo-cart.to-cart.pra{
  margin-left: -70px;
 }
 /* .form-control.btn-responsive {
    display: block;
    width: 100%;
    height: 34px;
    padding: 7px 61px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    

  }*/
 /*.form-control.btn-responsive{
    border-radius: 0;
    margin-left: -2px;
    padding-left: 34px;
    width: 75px;

}*/

}
@media screen and (max-width:1440px)  {
  .input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 90px;
    margin-bottom: 0;
    padding-left: 20px;
}

./*form-control{
   padding: 7px 38px;
}*/
}

@media screen and (max-width:1024px)  {
  /*.form-control.input-number.btn-responsive{
    padding-left: 26px;
    padding-right: 29px;
    width: 73px;
    margin-left: -8px;
    margin-top: 0px;
  }*/

    .product-meta-area .addTo-cart {
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 8px;
  /*  padding: 8px -30px;*/
    display: inline-block;
    border-radius: 4px;
    margin-left: 64px;
    margin-right: -94px;
    padding: 70px;
    /*width: -16px;*/
}

  }






@media screen and (max-width:1503px)  {
    /*.form-control.btn-responsive{
    margin-right: -20px;
    margin-left: -1px;
    position: relative;
    z-index: 2;
    float: left;
    width: 164%;*/
   /* margin-bottom: 0;
    padding-left: 19px;
    padding-left: 15px;
    padding-right: 20px;
    width: 64px;
    margin-left: -8px;
    margin-top: 0px;
    border-radius: 0;
    padding-left: 39px;
    margin-left: -5px;
    width: 88px;*/
  .product-meta-area .addTo-cart {
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 15px;
    padding: 11px 34px;
    display: inline-block;
    border-radius: 4px;
    margin-left: 16px;
    margin-right: -24px;
}

/*.product-meta-area .addTo-cart {
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 15px;
    padding: 11px 34px;
    display: inline-block;
    border-radius: 4px;
    margin-left: 13px;
    margin-right: -24px;
}
}*/
}
@media screen and (max-width:1440px)  {

  .product-meta-area .addTo-cart {
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 8px;
  /*  padding: 8px -30px;*/
    display: inline-block;
    border-radius: 4px;
    margin-left: 25px;
    margin-right: -56px;
    /*width: -16px;*/
}
}

    /*.product-meta-area .addTo-cart {
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 8px;*/
  /*  padding: 8px -30px;*/
    /*display: inline-block;
    border-radius: 4px;
    margin-left: 25px;
    margin-right: -56pc;*/
    /*width: -16px;*/
/*}

  }*/
 /* @media screen and (max-width:2560px)  {
  .techinfo{

  }

}*/
@media screen and (max-width:1024px)  {
.product-meta-area.pranali{
    text-transform: uppercase;
    color: black;
    background-color: #fff;
    border: 0px solid;
    padding-top: 8px;
    display: inline-block;
    border-radius: 4px;
    margin-left: 42px;
    margin-right: -110px;
}
}
.row.content{

    margin-right: -187px;
    margin-left: -15px;
}


</style>

    <div class="home-wrapper">
        <div class="container-fluid">

          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header" style="padding-top: 15px;">
                <a href="{{url('/home')}}" >{{$language->home}}</a>{{"/"}}
               <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->category[0])->first()->slug}}">{{\App\Category::where('id',$productdata->category[0])->first()->name}}</a>
                @if($productdata->subid != "")
                    <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->subid)->first()->slug}}">{{\App\Category::where('id',$productdata->subid)->first()->name}}</a>
                @endif
                @if($productdata->childid != "")
                    <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->childid)->first()->slug}}">{{\App\Category::where('id',$productdata->childid)->first()->name}}</a>
                @endif
                <a style ="color : black;" href="{{url('/product')}}/{{$productdata->id}}/{{str_replace(' ','-',strtolower($productdata->title))}}">{{$productdata->title}}</a>
              </div>
              <ul class="nav navbar-nav" style="float:right; padding-right:30px"  >
                <li class="active"><a data-toggle="tab" href="#overview-tab-1"><?php echo "Product";?></a></li>
                <li><a data-toggle="tab" href="#overview-tab-2">{{$language->description}}</a></li>
                <li><a data-toggle="tab" href="#pricing-tab-3">{{$language->return_policy}}</a></li>
                <li><a data-toggle="tab" href="#location-tab-4">{{$language->reviews}}({{\App\Review::where('productid',$productdata->id)->count()}})</a></li>
              </ul>
            </div>
          </nav>



        </div>
        <div class="product-details-wrapper padding-bottom-0 wow fadeInUp" style="padding-top:20px;">
            <div class="container-fluid">
                <div class="col-sm-1 padding-right-0">
                    <div class="project-image-shubh">
                        <div class="single-product-item">
                            <img id="iconOne" onmouseover="productGallery(this.id)" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                        </div>
                        @forelse($gallery as $galdta)
                        <div class="single-product-item">
                            <img id="galleryimg{{$galdta->id}}" onmouseover="productGallery(this.id)" src="{{url('/assets/images/gallery')}}/{{$galdta->image}}" alt="">
                        </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- video1 -->
                    <div id="light">
                      <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
                      <video id="VisaChipCardVideo" width="700" controls>
                          <source src="{{url('/assets/images/products')}}/{{$productdata->video}}" type="video/mp4">
                        </video>
                    </div>

                    <div id="fade" onClick="lightbox_close();"></div>

                      <div class="itemsContainer">
                          <div class="image">  <img width="72" height="100" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" /></div>
                          <div class="play"><a onclick="lightbox_open();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                      </div>


                    <!-- <div class="video_thumb">
                      <a  onclick="lightbox_open();">
                        <img width="75" height="75" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                        <i class="fa fa-play-circle-o"  style="font-size:24px;color:black"></i></a>
                    </div> -->
                    <!-- endvideo1 -->

                    <!-- video2 -->
                    <div id="light1">
                      <a class="boxclose1" id="boxclose1" onclick="lightbox_close1();"></a>
                      <video id="VisaChipCardVideo1" width="600" controls>
                          <source src="{{url('/assets/images/products')}}/{{$productdata->video1}}" type="video/mp4">
                          <!--Browser does not support <video> tag -->
                        </video>
                    </div>

                    <div id="fade1" onClick="lightbox_close1();"></div>
                  @if($productdata->video2 != '')

                  <div class="itemsContainer">
                          <div class="image">  <img width="72" height="100" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" /></div>
                          <div class="play"><a onclick="lightbox_open1();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                  </div>

                    <!-- <div>
                      <a href="#" onclick="lightbox_open1();"><i class="fa fa-play-circle-o" style="font-size:78px;color:black"></i></a>
                    </div> -->
                  @endif
                    <!-- endvideo 2 -->

                    <!-- video3 -->
                      <div id="light2">
                        <a class="boxclose2" id="boxclose1" onclick="lightbox_close2();"></a>
                        <video id="VisaChipCardVideo2" width="600" controls>
                            <source src="{{url('/assets/images/products')}}/{{$productdata->video2}}" type="video/mp4">
                            <!--Browser does not support <video> tag -->
                          </video>
                      </div>

                      <div id="fade2" onClick="lightbox_close2();"></div>
                      @if($productdata->video2 != '')

                      <div class="itemsContainer">
                          <div class="image">  <img width="72" height="100" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" /></div>
                          <div class="play"><a onclick="lightbox_open2();"> <img src="{{url('/assets/img/playicon2.png')}}" />  </a></div>
                      </div>

                        <!-- <div>
                          <a href="#" onclick="lightbox_open2();"><i class="fa fa-play-circle-o" style="font-size:78px;color:black"></i></a>
                        </div> -->
                      @endif
                    <!-- endvideo3 -->

                    <!-- <video width="72px" height="72px"  src="{{url('/assets/images/products')}}/{{$productdata->video}}" controls></video> -->

                </div>
                <div class="col-md-11 padding-right-0 padding-left-0">
                <div class="product-projects-FullDiv-area">
                   

                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 padding-right-0 padding-left-0 ">
                            <div class="image_div_shubh">
                                <div class="product-review-carousel-img product-zoom">
                                    <img id="imageDiv" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                                </div>
                                <!--<img id="imageDiv" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">-->
                                <!-- <video width="250" style="margin-right: 20px;"  src="{{url('/assets/images/products')}}/{{$productdata->video}}" controls></video> -->

                            </div>

                            <!--<div class="product-review-owl-carousel">-->
                            <!--    <div class="single-product-item">-->
                            <!--        <img id="iconOne" onclick="productGallery(this.id)" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">-->
                            <!--    </div>-->
                            <!--    @forelse($gallery as $galdta)-->
                            <!--        <div class="single-product-item">-->
                            <!--            <img id="galleryimg{{$galdta->id}}" onclick="productGallery(this.id)" src="{{url('/assets/images/gallery')}}/{{$galdta->image}}" alt="">-->
                            <!--        </div>-->
                            <!--    @empty-->
                            <!--    @endforelse-->
                            <!--</div>-->
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 padding-right-0">

                            <div class="tab-content">

                                        <div id="overview-tab-1" class="tab-pane active fade in">


                                            <div class="col-md-5 padding-right-0 padding-left-0">

                                            <!--<p>{!! $productdata->description !!}</p>-->
                                            <h2 class="product-header">{{$productdata->title}}</h2>

                                       
                                            @if($productdata->owner != "admin")
                                                @if(\App\Vendors::where('id',$productdata->vendorid)->count() != 0)
                                                    <strong class="">{{$language->vendor}}: <a href="{{url('/shop')}}/{{$productdata->vendorid}}/{{str_replace(' ','-',strtolower(\App\Vendors::findOrFail($productdata->vendorid)->shop_name))}}" target="_blank">{{\App\Vendors::findOrFail($productdata->vendorid)->shop_name}}</a></strong>
                                                @endif
                                            @else
                                            @endif
                                            <p class="product-status padding-top-10">
                                            @if($productdata->stock != 0 || $productdata->stock === null )
                                                <span class="available">
                                                    <i class="fa fa-check-square-o"></i>
                                                    <span>{{$language->available}}</span>
                                                </span>
                                            @else
                                                <span class="not-available">
                                                <i class="fa fa-times-circle-o"></i>
                                                <span>{{$language->out_of_stock}}</span>
                                                <input name="btn" type="submit" class="btn-notify" value="Notify Me">
                                                <!--<button type="" >Notify Me</button>-->
                                                </span>
                                            @endif
                
                                            </p>
                                            <div id="rating_review">
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <div class="full-stars" style="width:{{\App\Review::ratings($productdata->id)}}%"></div>
                                                </div>
                                                @if(\App\Review::reviewCount($productdata->id) > 1)
                                                    <span>{{\App\Review::reviewCount($productdata->id)}} Reviews</span>
                                                @else
                                                    <span>{{\App\Review::reviewCount($productdata->id)}} Review</span>
                                                @endif
                                            </div>
                                            <!--<p class="product-description">-->
                                            <!--    {{substr(strip_tags($productdata->description), 0, 600)}}...-->
                                            <!--    <a href="">show more</a>-->
                                            <!--</p>-->
                                            <h1 class="product-price">
                                                @if($productdata->previous_price != "")
                                                    <span>
                                                     <span style="font-size: 20px;"><b> MRP :</b> </span><del style="font-size: 15px;">{{$settings[0]->currency_sign}}{{$productdata->previous_price}}</del>
                                                    </span>
                                                @endif
                                                  <span style="font-size: 25px">
                                                    <b>{{$settings[0]->currency_sign}}{{\App\Product::Cost($productdata->id)}}</b>
                                                  </span> 
                                            </h1>
                
                                            @if($productdata->sizes != null)
                                                <div class="product-size" id="product-size">
                                                <p>Size</p>
                                                    @foreach(explode(',',$productdata->sizes) as $size)
                                                    <span>{{$size}}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                           <!--  <h5>Color</h5><p class="product-size">{{$productdata->color}}</p>
                                            <h5>Shape</h5><p class="product-size">{{$productdata->shape}}</p> -->
                                            <div class="row ">
                                              <h5>Technical Information</h5>
                                              <ul>
                                              @if($productdata->category[0] == 53)
                                                <li>Product Id <span style="padding-left: 22%;">{{$productdata->productsku}}</span></li>
                                                <li>Model No. <span style="padding-left: 23%;">{{$productdata->modelno}}</span></li>
                                                <li>Frame Width <span style="padding-left: 17%;">{{$productdata->framewidth}}</span></li>
                                                <li>Frame Dimensions <span style="padding-left: 6%;">{{$productdata->productdimension}}</span></li>
                                                <li>Frame Color <span style="padding-left: 19%;">{{$productdata->color}}</span></li><br>
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>
                                              @elseif($productdata->category[0] == 72)
                                                <li>Brand Name <span style="padding-left: 18%;">{{$productdata->brandname}}</span></li>
                                               <li>Model No. <span style="padding-left: 23%;">{{$productdata->modelno}}</span></li> 
                                                <li>Product Sku <span style="padding-left: 19%;">{{$productdata->productsku}}</span></li>
                                                 <li>Usages Duration <span style="padding-left: 12%;">{{$productdata->usagesduration}}</span></li> 
                                                <li>Diameter <span style="padding-left: 24%;">{{$productdata->diameter}}</span></li><br>
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>
                                              @elseif($productdata->category[0] == 63)
                                                <li>Frame Shape <span style="padding-left: 25%;">{{$productdata->shape}}</span></li>
                                                <li>Frame Color <span style="padding-left: 27%;">{{$productdata->color}}</span></li>
                                                <li>Gender<span style="padding-left: 35%;">{{$productdata->gender}}</span></li>
                                                <li>Brand Name<span style="padding-left: 27%;">{{$productdata->brandname}}</span></li>
                                                <li>Model No<span style="padding-left: 33%;">{{$productdata->modelno}}</span></li><br>
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>
                                              @elseif($productdata->category[0] == 87)
                                                <li>Brand Name <span style="padding-left: 25%;">{{$productdata->brandname}}</span></li>
                                                <li>Product Sku <span style="padding-left: 26%;">{{$productdata->productsku}}</span></li>
                                                 <li> Net Quantity <span style="padding-left: 25%;">{{$productdata->netquntity}}</span></li>
                                                <li>Shelf Life <span style="padding-left: 32%;">{{$productdata->shelflife}}</span></li>
                                                <li>Form <span style="padding-left: 38%;">{{$productdata->form}}</span></li><br> 
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>
                                              @elseif($productdata->category[0] == 58)
                                                <li>Brand Name <span style="padding-left: 24%;">{{$productdata->brandname}}</span></li>
                                                <li>Product Sku<span style="padding-left: 26%;">{{$productdata->productsku}}</span></li>
                                                <li>Lens Material<span style="padding-left: 25%;">{{$productdata->lensmaterialtype}}</span></li>
                                                <li>Diameter<span style="padding-left: 31%;">{{$productdata->diameter}}</span></li> 
                                                <li>Lens Color<span style="padding-left: 30%;">{{$productdata->lenscolor}}</span></li><br>

                                                <!-- <li>Lens Type<span style="padding-left: 30%;">{{$productdata->lenstype}}</span></li><br> -->
                                                
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>
                                              @else($productdata->category[0] == 82)
                                                 <li>Frame Shape<span style="padding-left: 24%;">{{$productdata->shape}}</span></li>
                                                <li>Frame Color<span style="padding-left: 26%;">{{$productdata->color}}</span></li> 
                                                <li>Brand Name<span style="padding-left: 25%;">{{$productdata->brandname}}</span></li>
                                                <li>Model No<span style="padding-left: 30%;">{{$productdata->modelno}}</span></li> 
                                                <li>Product Sku<span style="padding-left: 26%;">{{$productdata->productsku}}</span></li><br>
                                                <a style="color: #1B1212; font-weight: 500px " data-toggle="modal" data-target="#exampleModal"><b>Show All Inforamation</b></a>

                                              @endif
                                              </ul>
                                                <!-- <table class="table table-bordered">
                                                      <tr>
                                                        <th class="text-center" style="padding: 20px;">Color</th>
                                                        <th class="text-center" style="padding: 20px;">Shape</th>
                                                      </tr>
                                                      <tr>
                                                        <td  class="text-center">{{$productdata->color}}</td>
                                                        <td  class="text-center">{{$productdata->shape}}</td>
                                                      </tr>
                                                    </table>   -->
                                            </div>
                                            <br>
                                            <div class="row">
                                                <table class="table table-bordered">
                                                      <tr>
                                                        @if($productdata->ranegnameone != '')
                                                        <th class="text-center">{{$productdata->ranegnameone}}</th>
                                                        @endif
                                                        @if($productdata->rangenametwo != '')
                                                        <th class="text-center">{{$productdata->rangenametwo}}</th>
                                                        @endif
                                                        @if($productdata->rangenamethree != '')
                                                        <th class="text-center">{{$productdata->rangenamethree}}</th>
                                                        @endif
                                                      </tr>
                                                      <tr>
                                                        <!-- <input type="hidden" value="{{$productdata->p40pieces}}" id="getValue1">
                                                        <input type="hidden" value="{{$productdata->p51pieces}}" id="getValue2">
                                                        <input type="hidden" value="{{$productdata->p5000pieces}}" id="getValue3"> -->
                                                      @if($productdata->p40pieces != '')
                                                        <td  class="text-center">{{$settings[0]->currency_sign}} {{$productdata->p40pieces}} </td>
                                                      @endif
                                                      @if($productdata->p51pieces != '')
                                                        <td  class="text-center">{{$settings[0]->currency_sign}} {{$productdata->p51pieces}} </td>
                                                      @endif
                                                      @if($productdata->p5000pieces != '')
                                                        <td  class="text-center">{{$settings[0]->currency_sign}} {{$productdata->p5000pieces}} </td>
                                                      @endif
                                                      </tr>
                                                    </table>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5 praqty">
                                                    <!-- <span id="pqty">1</span> -->
                                                    <!-- <div class="product-quantity">
                                                        <p>{{$language->quantity}}</p>
                                                        <span class="quantity-btn" id="qty-minus"><i class="fa fa-minus"></i></span>
                                                        <input type="text" id="pqty" value="1" style="width: 43px; height: 40px; margin-right: 0px;">
                                                        <span class="quantity-btn" id="qty-add"><i class="fa fa-plus"}}></i></span>
                                                    </div> -->
                                                    @if($productdata->category[0] == 58 && $productdata->lenstype == "Spherical" && $productdata->category[0] == 72)
                                                   <!--  <a href="{{url('singlevisionview')}}" class="btn btn-primary"> Add Prescription </a> -->
                                                    @elseif($productdata->category[0] == 58 && $productdata->lenstype == "MultiFocal")
                                                    <!-- <a href="" class="btn btn-success"> Add Prescription </a> -->
                                                    @elseif($productdata->category[0] == 58 && $productdata->lenstype == "toric & Astigmatism")
                                                    <!-- <a href="" class="btn btn-danger"> Add Prescription </a> -->
                                                    @else
                                                    <div class="form-group">
                                                        @if($productdata->category[0] != 72)
                                                        <label>Quantity: </label>
                                                        <div class="input-group" style="margin-top: 17px;">
                                                        <div class="input-group-btn">
                                                            <button id="qty-minus" class="btn btn-default" ><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="pqty" class="form-control input-number btn-responsive" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="qty-add" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                 

                                                </div>

                                                <div class="col-sm-7 cart">

                                                 <div class="product-meta-area pranali " style="padding-top: 35px;">
                                                <form class="addtocart-form">
                                                    {{csrf_field()}}
                                                    @if(Session::has('uniqueid'))
                                                        <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                                    @else
                                                        <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                                    @endif
                                                    
                                                     <input type="hidden" id="price" name="price" value="{{\App\Product::Cost($productdata->id)}}">

                                                     <input type="hidden" id="price_1" name="price_1" value="{{\App\Product::Costtwopis($productdata->id)}}">
                                                     <input type="hidden" id="price_2" name="price_2" value="{{\App\Product::Costfiftypis($productdata->id)}}">
                                                     <input type="hidden" id="price_3" name="price_3" value="{{\App\Product::Costfivethousandpis($productdata->id)}}">

                                                    <input type="hidden" name="title" value="{{$productdata->title}}">
                                                    <input type="hidden" name="product" value="{{$productdata->id}}">
                                                    <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($productdata->id)}}">
                                                    
                                                    
                                                    <input type="hidden" id="quantity" name="quantity" value="1">
                                                    <input type="hidden" id="size" name="size" value="">
                                                    
                                                    @if($productdata->category[0] == 72)
                                                       <button type="button" class="btn btn-primary" style="margin-left:30px; border:none; cursor:pointer;" disabled><a href="{{url('/productshoww')}}/{{$productdata->id}}" style="text-decoration:none; color:#fff;"><i class="fa fa-cart-plus "></i>Add Prescription</a></button>
                                                        
                                                    @elseif($productdata->stock != 0 || $productdata->stock === null)
                                                      <button type="button" class="addTo-cart to-cart  "><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}} </span></button>
        
                                                    @else

                                                      <button type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>

                                                    @endif

                                                    <!--@if($productdata->stock != 0 || $productdata->stock === null )-->
                                                    <!--    <button type="button" class="addTo-cart to-cart  "><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                                    <!--@else-->
                                                    <!--    <button type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i>{{$language->out_of_stock}}</button>-->
                                                    <!--@endif-->
                                                </form>
                                            </div>   
                                                    @endif 
                                                </div>
                                                
                                            </div>
                                            
                                            
                                    </div>
                                            
                                             <!-- <div class="col-md-6 col-xs-12">
                                                 <div style="height: 400px; width: 100%; border: 1px solid black; float: left;">
                                                     
                                                 </div>
                                             </div> -->
                                            <div class="col-md-0 padding-left-0">
                                            <!--<p>{!! $productdata->description !!}</p>-->
                                            <!--<h2 class="product-header">{{$productdata->title}}</h2>-->
                                            <!--@if($productdata->owner != "admin")-->
                                            <!--    @if(\App\Vendors::where('id',$productdata->vendorid)->count() != 0)-->
                                            <!--        <strong class="">{{$language->vendor}}: <a href="{{url('/shop')}}/{{$productdata->vendorid}}/{{str_replace(' ','-',strtolower(\App\Vendors::findOrFail($productdata->vendorid)->shop_name))}}" target="_blank">{{\App\Vendors::findOrFail($productdata->vendorid)->shop_name}}</a></strong>-->
                                            <!--    @endif-->
                                            <!--@else-->
                                            <!--@endif-->
                                            <!--<p class="product-status">-->
                                            <!--@if($productdata->stock != 0 || $productdata->stock === null )-->
                                            <!--    <span class="available">-->
                                            <!--        <i class="fa fa-check-square-o"></i>-->
                                            <!--        <span>{{$language->available}}</span>-->
                                            <!--    </span>-->
                                            <!--@else-->
                                            <!--    <span class="not-available">-->
                                            <!--    <i class="fa fa-times-circle-o"></i>-->
                                            <!--    <span>{{$language->out_of_stock}}</span>-->
                                            <!--    </span>-->
                                            <!--@endif-->
                
                                            <!--</p>-->
                                            <!--<div>-->
                                            <!--    <div class="ratings">-->
                                            <!--        <div class="empty-stars"></div>-->
                                            <!--        <div class="full-stars" style="width:{{\App\Review::ratings($productdata->id)}}%"></div>-->
                                            <!--    </div>-->
                                            <!--    @if(\App\Review::reviewCount($productdata->id) > 1)-->
                                            <!--        <span>{{\App\Review::reviewCount($productdata->id)}} Reviews</span>-->
                                            <!--    @else-->
                                            <!--        <span>{{\App\Review::reviewCount($productdata->id)}} Review</span>-->
                                            <!--    @endif-->
                                            <!--</div>-->
                                            <!--<p class="product-description">-->
                                            <!--    {{substr(strip_tags($productdata->description), 0, 600)}}...-->
                                            <!--    <a href="">show more</a>-->
                                            <!--</p>-->
                                            <!--<h1 class="product-price">-->
                                            <!--    @if($productdata->previous_price != "")-->
                                            <!--        <span>-->
                                            <!--            <del>{{$settings[0]->currency_sign}}{{$productdata->previous_price}}</del>-->
                                            <!--        </span>-->
                                            <!--    @endif-->
                                            <!--        {{$settings[0]->currency_sign}}{{\App\Product::Cost($productdata->id)}}-->
                                            <!--</h1>-->
                
                                            <!--@if($productdata->sizes != null)-->
                                            <!--    <div class="product-size" id="product-size">-->
                                            <!--    <p>Size</p>-->
                                            <!--        @foreach(explode(',',$productdata->sizes) as $size)-->
                                            <!--        <span>{{$size}}</span>-->
                                            <!--        @endforeach-->
                                            <!--    </div>-->
                                            <!--@endif-->
                                            <!--<div class="product-quantity">-->
                                            <!--    <p>{{$language->quantity}}</p>-->
                                            <!--    <span class="quantity-btn" id="qty-minus"><i class="fa fa-minus"></i></span>-->
                                            <!--    <span id="pqty">1</span>-->
                                            <!--    <span class="quantity-btn" id="qty-add"><i class="fa fa-plus"}}></i></span>-->
                                            <!--</div>-->
                                            <!--<form class="addtocart-form">-->
                                            <!--    {{csrf_field()}}-->
                                            <!--    @if(Session::has('uniqueid'))-->
                                            <!--        <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">-->
                                            <!--    @else-->
                                            <!--        <input type="hidden" name="uniqueid" value="{{str_random(7)}}">-->
                                            <!--    @endif-->
                                            <!--    <input type="hidden" id="price" name="price" value="{{\App\Product::Cost($productdata->id)}}">-->
                                            <!--    <input type="hidden" name="title" value="{{$productdata->title}}">-->
                                            <!--    <input type="hidden" name="product" value="{{$productdata->id}}">-->
                                            <!--    <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($productdata->id)}}">-->
                                            <!--    <input type="hidden" id="quantity" name="quantity" value="1">-->
                                            <!--    <input type="hidden" id="size" name="size" value="">-->
                                            <!--    @if($productdata->stock != 0 || $productdata->stock === null )-->
                                            <!--        <button type="button" class="product-addCart-btn to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--    @else-->
                                            <!--        <button type="button" class="product-addCart-btn  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>-->
                                            <!--    @endif-->
                                            <!--</form>-->
                                            </div>
                                            
                                        </div>
                                        <div id="overview-tab-2" class="tab-pane fade">
                                            <p>{!! $productdata->description !!}</p>
                                        </div>

                                        <div id="pricing-tab-3" class="tab-pane fade">
                                            <p>{!! $productdata->policy !!}</p>
                                        </div>

                                        <div id="location-tab-4" class="tab-pane fade">
                                            <p>
                                                <!--<h1>{{$language->write_a_review}}</h1>-->
                                                <!--<div class="review-star">-->
                                                <!--    <div class='starrr' id='star1'></div>-->
                                                <!--    <div>-->
                                                <!--        <span class='your-choice-was' style='display: none;'>-->
                                                <!--            Your rating is: <span class='choice'></span>.-->
                                                <!--        </span>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <!--<form class="product-review-form" method="POST" action="{{route('review.submit')}}">-->
                                                <!--    {{ csrf_field() }}-->
                                                <!--    <input type="hidden" name="rating" id="rate" value="5">-->
                                                <!--    <input type="hidden" name="productid" value="{{$productdata->id}}">-->
                                                <!--    <div class="form-group">-->
                                                <!--        <input name="name" type="text" class="form-control" placeholder="{{$language->name}}" required>-->
                                                <!--    </div>-->
                                                <!--    <div class="form-group">-->
                                                <!--        <input name="email" type="email" class="form-control" placeholder="{{$language->email}}" required>-->
                                                <!--    </div>-->
                                                <!--    <div class="form-group">-->
                                                <!--        <textarea name="review" id="" rows="5" placeholder="{{$language->review_details}}" class="form-control" style="resize: vertical;" required></textarea>-->
                                                <!--    </div>-->
                                                <!--    @if ($errors->has('error'))-->
                                                <!--        <span class="help-block">-->
                                                <!--            <strong>{{ $errors->first('password') }}</strong>-->
                                                <!--        </span>-->
                                                <!--    @endif-->
                                                <!--    <div class="form-group text-center">-->
                                                <!--        <input name="btn" type="submit" class="btn-review" value="{{$language->submit}}">-->
                                                <!--    </div>-->
                                                <!--</form>-->
                                                <!--<hr>-->
                                                <!--<h1>{{$language->reviews}}: </h1>-->
                                                <!--<hr>-->
                                                <div class="review-rating-description">
                                                    @forelse($reviews as $review)
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3">
                                                            <p>{{$review->name}}</p>
                                                            <div class="ratings">
                                                                <div class="empty-stars"></div>
                                                                <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                                            </div>
                                                            <p>{{$review->review_date}}</p>
                                                        </div>
                                                        <div class="col-md-9 col-sm-9">
                                                            <p>{{$review->review}}</p>
                                                        </div>
                                                    </div>
                                                    @empty
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4>{{$language->no_review}}</h4>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                                <!--<hr>-->
                                            </div>
                                        </div>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!--<div class="section-padding product-description-wrapper padding-bottom-0 padding-top-0 wow fadeInUp">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
        <!--                <div class="custom-tab">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-md-5">-->
        <!--                            <ul class="tab-list">-->
        <!--                                <li class="active"><a data-toggle="tab" href="#overview-tab-1">{{$language->description}}</a></li>-->
        <!--                                <li><a data-toggle="tab" href="#pricing-tab-2">{{$language->return_policy}}</a></li>-->
        <!--                                <li><a data-toggle="tab" href="#location-tab-3">{{$language->reviews}}({{\App\Review::where('productid',$productdata->id)->count()}})</a></li>-->
        <!--                            </ul>-->
        <!--                        </div>-->

        <!--                        <div class="col-md-7">-->
        <!--                            @if(Session::has('message'))-->
        <!--                                <div class="alert alert-success alert-dismissable">-->
        <!--                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
        <!--                                    {{ Session::get('message') }}-->
        <!--                                </div>-->
        <!--                            @endif-->
        <!--                            <div class="tab-content">-->
        <!--                                <div id="overview-tab-1" class="tab-pane active fade in">-->
        <!--                                    <p>{!! $productdata->description !!}</p>-->
        <!--                                </div>-->

        <!--                                <div id="pricing-tab-2" class="tab-pane fade">-->
        <!--                                    <p>{!! $productdata->policy !!}</p>-->
        <!--                                </div>-->

        <!--                                <div id="location-tab-3" class="tab-pane fade">-->
        <!--                                    <p>-->
        <!--                                        <h1>{{$language->write_a_review}}</h1>-->
        <!--                                        <hr>-->
        <!--                                        <div class="review-star">-->
        <!--                                            <div class='starrr' id='star1'></div>-->
        <!--                                            <div>-->
        <!--                                                <span class='your-choice-was' style='display: none;'>-->
        <!--                                                    Your rating is: <span class='choice'></span>.-->
        <!--                                                </span>-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                        <form class="product-review-form" method="POST" action="{{route('review.submit')}}">-->
        <!--                                            {{ csrf_field() }}-->
        <!--                                            <input type="hidden" name="rating" id="rate" value="5">-->
        <!--                                            <input type="hidden" name="productid" value="{{$productdata->id}}">-->
        <!--                                            <div class="form-group">-->
        <!--                                                <input name="name" type="text" class="form-control" placeholder="{{$language->name}}" required>-->
        <!--                                            </div>-->
        <!--                                            <div class="form-group">-->
        <!--                                                <input name="email" type="email" class="form-control" placeholder="{{$language->email}}" required>-->
        <!--                                            </div>-->
        <!--                                            <div class="form-group">-->
        <!--                                                <textarea name="review" id="" rows="5" placeholder="{{$language->review_details}}" class="form-control" style="resize: vertical;" required></textarea>-->
        <!--                                            </div>-->
        <!--                                            @if ($errors->has('error'))-->
        <!--                                                <span class="help-block">-->
        <!--                                                    <strong>{{ $errors->first('password') }}</strong>-->
        <!--                                                </span>-->
        <!--                                            @endif-->
        <!--                                            <div class="form-group text-center">-->
        <!--                                                <input name="btn" type="submit" class="btn-review" value="{{$language->submit}}">-->
        <!--                                            </div>-->
        <!--                                        </form>-->
        <!--                                        <hr>-->
        <!--                                        <h1>{{$language->reviews}}: </h1>-->
        <!--                                        <hr>-->
        <!--                                        <div class="review-rating-description">-->
        <!--                                            @forelse($reviews as $review)-->
        <!--                                            <div class="row">-->
        <!--                                                <div class="col-md-3 col-sm-3">-->
        <!--                                                    <p>cej</p>-->
        <!--                                                    <div class="ratings">-->
        <!--                                                        <div class="empty-stars"></div>-->
        <!--                                                        <div class="full-stars" style="width:{{$review->rating*20}}%"></div>-->
        <!--                                                    </div>-->
        <!--                                                    <p>{{$review->review_date}}</p>-->
        <!--                                                </div>-->
        <!--                                                <div class="col-md-9 col-sm-9">-->
        <!--                                                    <p>{{$review->review}}</p>-->
        <!--                                                </div>-->
        <!--                                            </div>-->
        <!--                                            @empty-->
        <!--                                                <div class="row">-->
        <!--                                                    <div class="col-md-12">-->
        <!--                                                        <h4>{{$language->no_review}}</h4>-->
        <!--                                                    </div>-->
        <!--                                                </div>-->
        <!--                                            @endforelse-->
        <!--                                        </div>-->
        <!--                                        <hr>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->

        <div class="section-padding product-carousel-wrapper wow fadeInUp">
            <div class="container-fluid">
                <!--<div class="product-carousel-full-div">-->
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="margin-bottom-0">{{$language->related_products}}</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-md-12">-->
                            <div class="product-carousel-list">
                                @foreach($relateds as $product)
                                    <div class="single-product-carousel-item text-center" id="imagepad" >
                                        <div class="image_latest_product_shubh">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                            @php $gallery = $product->gallery_images->toArray(); @endphp
                                            <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
                                        </div>
                                        <div class="product-carousel-text">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                <h4 class="product-title">{{$product->title}}</h4>
                                            </a>
                                            <!--<div class="ratings">-->
                                            <!--    <div class="empty-stars"></div>-->
                                            <!--    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>-->
                                            <!--</div>-->
                                            <div class="product-price">
                                                @if($product->previous_price != "")
                                                    <span class="original-price">₹{{$product->previous_price}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">₹{{$product->price}}</del>
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

                                                    <input type="hidden" id="price_1" name="price_1" value="{{\App\Product::Costtwopis($productdata->id)}}">
                                                     <input type="hidden" id="price_2" name="price_2" value="{{\App\Product::Costfiftypis($productdata->id)}}">
                                                     <input type="hidden" id="price_3" name="price_3" value="{{\App\Product::Costfivethousandpis($productdata->id)}}">

                                                    <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">
                                                    <input type="hidden" id="quantity" name="quantity" value="1">
                                                    <!-- @if($product->stock != 0 || $product->stock === null )
                                                        <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                    @else
                                                        <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                                    @endif -->
                                                </form>
                                                <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                                <!--    <i class="fa fa-eye"></i>-->
                                                <!--</a>-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <!--</div>-->
                    </div>
                <!--</div>-->
            </div>
        </div>

        <!-- tranding products area start -->

             @if($pagesettings[0]->featuredpro_status)
        <!-- starting of featured project area -->
        <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp" id="tendingpad">
            <div class="container-fluid">
                <!--<div class="product-carousel-full-div">-->
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="margin-bottom-0">{{$language->featured_products}}</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-md-12">-->
                            <div class="product-carousel-list">
                                @foreach($tranding as $product)
                                    <div class="single-product-carousel-item text-center" id="imagepad" >
                                        <div class="image_latest_product_shubh">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                        @php $gallery = $product->gallery_images->toArray(); @endphp
                                        <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" style="margin: 0px; margin-left: 0px;" /> </a>
                                        </div>
                                        <div class="product-carousel-text">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                <h3 class="product-title">{{$product->title}}</h3>
                                            </a>
                                            <!--<div class="ratings">-->
                                            <!--    <div class="empty-stars"></div>-->
                                            <!--    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>-->
                                            <!--</div>-->
                                            <div class="product-price">
                                                @if($product->previous_price != "")
                                                    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>
                                            </div>
                                            <!--<div class="product-meta-area">-->
                                            <!--    <form class="addtocart-form">-->
                                            <!--        {{csrf_field()}}-->
                                            <!--        @if(Session::has('uniqueid'))-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">-->
                                            <!--        @else-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">-->
                                            <!--        @endif-->
                                            <!--        <input type="hidden" name="title" value="{{$product->title}}">-->
                                            <!--        <input type="hidden" name="product" value="{{$product->id}}">-->
                                            <!--        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">-->
                                            <!--        <input type="hidden" id="quantity" name="quantity" value="1">-->
                                            <!--        @if($product->stock != 0 || $product->stock === null )-->
                                            <!--            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--        @else-->
                                            <!--            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>-->
                                            <!--        @endif-->
                                            <!--    </form>-->
                                                <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                                <!--    <i class="fa fa-eye"></i>-->
                                                <!--</a>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <!--</div>-->
                    </div>
                <!--</div>-->
            </div>
        </div>
        <!-- Ending of featured project area -->
        @endif



        <!-- tranding products area end -->
<!-- popup for show all Information -->



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" style="font-size: 25px; color: #1B1212;" id="exampleModalLabel">Technical Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      <div class="row content">
       @if($productdata->category[0] == 53) 
        <div class="col-md-6">
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Shape</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else {{$productdata->shape}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->color =='') NA @else  {{$productdata->color }}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gender</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else {{$productdata->gender}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                  </tr>

                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Model No</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->modelno=='') NA @else  {{$productdata->modelno}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Sellername</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else {{$productdata->sellername}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>

                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framematerial=='') NA @else {{$productdata->framematerial}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer=='') NA @else {{$productdata->manufracturer}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>

</table>
</div>

      <div class="col-md-5">
                <table width="100" class="table" border='0'> 
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Width</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framewidth=='') NA @else  {{$productdata->framewidth}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'> 
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Height</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->height=='') NA @else {{$productdata->height}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templematerial=='') NA @else {{$productdata->templematerial}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templecolor=='') NA @else  {{$productdata->templecolor}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Conditionsnew</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->conditionsnew=='') NA @else  {{$productdata->conditionsnew}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->frametype=='') NA @else  {{$productdata->frametype}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Dimensions </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productdimension=='') NA @else  {{$productdata->productdimension}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Warrenty Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->warrentytype=='') NA @else {{$productdata->warrentytype}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else {{$productdata->weight}}@endif</td>
                  </tr>
                



 </table>

</div>


        @elseif($productdata->category[0] == 58)
        <div class="col-md-6">
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname=='') NA @else {{$productdata->brandname}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku=='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype=='') NA @else  {{$productdata->lensmaterialtype}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Diameter</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->diameter=='') NA @else  {{$productdata->diameter}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenscolor=='') NA @else {{$productdata->lenscolor}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens index</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lensindex=='') NA @else  {{$productdata->lensindex}}@endif</td>
                  </tr>
                
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Power Range</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->powerrange=='') NA @else  {{$productdata->powerrange}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Coating</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->coating=='') NA @else {{$productdata->coating}}@endif</td>
                  </tr>
                   <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology=='') NA @else {{$productdata->lenstechnology}}@endif</td>
                  </tr>


               
</table>
</div>

        <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Focal Length</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->focallength=='') NA @else  {{$productdata->focallength}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer=='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else {{$productdata->weight}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gravity</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gravity=='') NA @else  {{$productdata->gravity}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Coating Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->coatingcolor=='') NA @else  {{$productdata->coatingcolor}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Abbe Value</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->abbevalue=='') NA @else  {{$productdata->abbevalue}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstype=='') NA @else  {{$productdata->lenstype}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Add Power</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->addpower =='') NA @else  {{$productdata->addpower}}@endif</td>
                  </tr>

                   





</table>
</div>

        @elseif($productdata->category[0] == 63) 
        <div class="col-md-5">
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Shape</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else {{$productdata->shape}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Color </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->color =='') NA @else  {{$productdata->color}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gender</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else {{$productdata->gender}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Model No</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else  {{$productdata->modelno}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framematerial =='') NA @else {{$productdata->framematerial}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Prescription Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->prescriptiontype =='') NA @else  {{$productdata->prescriptiontype}}@endif</td>
                  </tr>
               <!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Add Power</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->addpower =='') NA @else  {{$productdata->addpower}}@endif</td>
                  </tr> -->
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Sellername</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else  {{$productdata->sellername}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->frametype =='') NA @else {{$productdata->frametype}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Warrenty Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else {{$productdata->warrentytype}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Dimension</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                  </tr>
</table>
</div>

          <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Width</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framewidth =='') NA @else  {{$productdata->framewidth}}@endif</td>
                  </tr>
                  
              <!-- < <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Height</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->height=='') NA @else  {{$productdata->height}}@endif</td>
                  </tr> -->
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templematerial=='') NA @else {{$productdata->templematerial}}@endif</td>
                  </tr> 
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templecolor =='') NA @else  {{$productdata->templecolor}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype =='') NA @else  {{$productdata->lensmaterialtype}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenscolor =='') NA @else {{$productdata->lenscolor}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Conditions</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->conditionsnew =='') NA @else {{$productdata->conditionsnew}}@endif</td>
                  </tr> 
              <!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else  {{$productdata->lenstechnology}}@endif</td>
                  </tr> -->
              
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight =='') NA @else  {{$productdata->weight}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Height</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->height =='') NA @else  {{$productdata->height}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else  {{$productdata->lenstechnology}}@endif</td>
                  </tr>
             <!--  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Coating</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->coating =='') NA @else  {{$productdata->coating}}@endif</td>
                  </tr> -->
              <!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Usagesduration</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->usagesduration =='') NA @else {{$productdata->usagesduration}}@endif</td>
                  </tr> -->


</table>
</div>



        @elseif($productdata->category[0] == 72) 
        <div class="col-md-5">
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Model No</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else  {{$productdata->modelno}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Usages Duration</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->usagesduration =='') NA @else  {{$productdata->usagesduration}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Diameter</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->diameter =='') NA @else  {{$productdata->diameter}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Contact Lens Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->contactlensmaterialtype=='') NA @else {{$productdata->contactlensmaterialtype}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Sphere Power</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->power=='') NA @else {{$productdata->power}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Centerthikness</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->centerthiknessnew =='') NA @else {{$productdata->centerthiknessnew}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Cylinder</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->cylindernew =='') NA @else  {{$productdata->cylindernew}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Axis</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->axisnew =='') NA @else  {{$productdata->axisnew}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Base Curve</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->basecurve =='') NA @else {{$productdata->basecurve}}@endif</td>
                  </tr>
</table>
</div>

           <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">water content</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->watercontent =='') NA @else  {{$productdata->watercontent}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Power</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->power =='') NA @else  {{$productdata->power}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Disposability</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->disposability =='') NA @else  {{$productdata->disposability}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Packaging</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->packaging =='') NA @else {{$productdata->packaging}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenscolor=='') NA @else  {{$productdata->lenscolor}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else {{$productdata->countryoforigin}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Contact Lense Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->visioneffect =='') NA @else  {{$productdata->visioneffect}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else  {{$productdata->lenstechnology}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Add Power</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->addpower =='') NA @else  {{$productdata->addpower}}@endif</td>
                  </tr>


</table>
</div>



        @elseif($productdata->category[0] == 72)
       <!--  <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Shape</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else  {{$productdata->shape}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Color </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->color =='') NA @else {{$productdata->color}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gender</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else  {{$productdata->gender}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else {{$productdata->brandname}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Model No</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else {{$productdata->modelno}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>

               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framematerial =='') NA @else {{$productdata->framematerial}}@endif</td>
                  </tr>




</table>
</div>

         <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Width</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framewidth =='') NA @else  {{$productdata->framewidth}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Height</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->height =='') NA @else  {{$productdata->height}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templematerial =='') NA @else {{$productdata->templematerial}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templecolor=='') NA @else  {{$productdata->templecolor}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype =='') NA @else {{$productdata->lensmaterialtype}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenscolor =='') NA @else {{$productdata->lenscolor}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Conditions </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->conditionsnew =='') NA @else  {{$productdata->conditionsnew}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else {{$productdata->lenstechnology}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->frametype =='') NA @else {{$productdata->frametype}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Warrenty Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else  {{$productdata->warrentytype}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Dimension</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight =='') NA @else  {{$productdata->weight}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Coating</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->coating =='') NA @else {{$productdata->coating}}@endif</td>
                  </tr>
               <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Usages Duration</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->usagesduration=='') NA @else  {{$productdata->usagesduration}}@endif</td>
                  </tr>



</table>
</div> -->
            @elseif($productdata->category[0] == 87)
            <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else  {{$productdata->brandname}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Net Quantity</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->netquntity =='') NA @else  {{$productdata->netquntity}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Shelf Life</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->shelflife =='') NA @else  {{$productdata->shelflife}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Form</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->form =='') NA @else  {{$productdata->form}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productcolor =='') NA @else  {{$productdata->productcolor}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight=='') NA @else  {{$productdata->weight}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin =='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Sellername</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->sellername =='') NA @else  {{$productdata->sellername}}@endif</td>
                  </tr>

</table>
</div>

            <div class="col-md-5">
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Dimension</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->material =='') NA @else  {{$productdata->material}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Warrenty Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else  {{$productdata->warrentytype}}@endif</td>
                  </tr>
<!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gender</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else {{$productdata->gender}}@endif</td>
                  </tr> -->             
                            <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Packtype</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->packtype =='') NA @else  {{$productdata->packtype}}@endif</td>
                  </tr>
             <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Usages</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->usages =='') NA @else  {{$productdata->usages}}@endif</td>
                  </tr>
</table>
</div>
            @elseif($productdata->category[0] == 82)
            <div class="col-md-5">
          <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Shape</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->shape =='') NA @else  {{$productdata->shape}}@endif</td>
                  </tr>
          <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Color </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->color =='') NA @else {{$productdata->color}}@endif</td>
                  </tr>
          <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Gender</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->gender =='') NA @else  {{$productdata->gender}}@endif</td>
                  </tr>
          <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Brand Name</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->brandname =='') NA @else {{$productdata->brandname}}@endif</td>
                  </tr>
           <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Model No</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->modelno =='') NA @else {{$productdata->modelno}}@endif</td>
                  </tr>
           <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Product Sku</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productsku =='') NA @else  {{$productdata->productsku}}@endif</td>
                  </tr>

           <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framematerial =='') NA @else {{$productdata->framematerial}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Dimension</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->productdimension =='') NA @else  {{$productdata->productdimension}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Weight</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->weight =='') NA @else  {{$productdata->weight}}@endif</td>
                  </tr>
                <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Country Of Origin</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->countryoforigin=='') NA @else  {{$productdata->countryoforigin}}@endif</td>
                  </tr>
                  <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Warrenty Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->warrentytype =='') NA @else  {{$productdata->warrentytype}}@endif</td>
                  </tr>




</table>
</div>

          <div class="col-md-5">
             <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Width</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->framewidth =='') NA @else  {{$productdata->framewidth}}@endif</td>
                  </tr>
             <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Height</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->height =='') NA @else  {{$productdata->height}}@endif</td>
                  </tr>
             <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templematerial =='') NA @else {{$productdata->templematerial}}@endif</td>
                  </tr>
             <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Temple Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->templecolor=='') NA @else  {{$productdata->templecolor}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Material</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lensmaterialtype =='') NA @else {{$productdata->lensmaterialtype}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Color</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenscolor =='') NA @else {{$productdata->lenscolor}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Conditions </td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->conditionsnew =='') NA @else  {{$productdata->conditionsnew}}@endif</td>
                  </tr>
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Lens Technology</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->lenstechnology =='') NA @else {{$productdata->lenstechnology}}@endif</td>
                  </tr>
<!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Frame Type</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->frametype =='') NA @else {{$productdata->frametype}}@endif</td>
                  </tr> -->
              <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Manufracturer</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->manufracturer =='') NA @else  {{$productdata->manufracturer}}@endif</td>
                  </tr>


<!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Coating</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->coating =='') NA @else {{$productdata->coating}}@endif</td>
                  </tr> -->
<!-- <table width="100" class="table" border='0'>
                <tbody>
                  <tr style="border:none;">
                    <td style="width: 40%; border:none;">Usages Duration</td>
                    <td style="width: 5%; text-align: center;border:none;"> : </td>
                    <td style="width: 54%;border:none;">@if($productdata->usagesduration=='') NA @else  {{$productdata->usagesduration}}@endif</td>
                  </tr> -->



</table>
</div>


@endif
</div>


      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>



<!-- end popup for show all information -->


        <!-- for selected image slider  start-->

                 @if($pagesettings[0]->featuredpro_status)
        <!-- starting of featured project area -->
        <div class="section-padding product-carousel-wrapper padding-top-0 padding-bottom-0 wow fadeInUp" id="selectedpad">
            <div class="container-fluid">
                <!--<div class="product-carousel-full-div">-->
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="margin-bottom-0">Selected Product</h2>
                                <!--<hr>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-md-12">-->
                            <div class="product-carousel-list">
                                @foreach($selected as $product)
                                    <div class="single-product-carousel-item text-center" id="imagepad">
                                        <div class="image_latest_product_shubh">
                                        <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                        @php $gallery = $product->gallery_images->toArray(); @endphp
                                        <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" style="margin: 0px; margin-left: 0px;" /> </a>
                                        </div>
                                        <div class="product-carousel-text">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                <h3 class="product-title">{{$product->title}}</h3>
                                            </a>
                                            <!--<div class="ratings">-->
                                            <!--    <div class="empty-stars"></div>-->
                                            <!--    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>-->
                                            <!--</div>-->
                                            <div class="product-price">
                                                @if($product->previous_price != "")
                                                    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>
                                            </div>
                                            <!--<div class="product-meta-area">-->
                                            <!--    <form class="addtocart-form">-->
                                            <!--        {{csrf_field()}}-->
                                            <!--        @if(Session::has('uniqueid'))-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">-->
                                            <!--        @else-->
                                            <!--            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">-->
                                            <!--        @endif-->
                                            <!--        <input type="hidden" name="title" value="{{$product->title}}">-->
                                            <!--        <input type="hidden" name="product" value="{{$product->id}}">-->
                                            <!--        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">-->
                                            <!--        <input type="hidden" id="quantity" name="quantity" value="1">-->
                                            <!--        @if($product->stock != 0 || $product->stock === null )-->
                                            <!--            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>-->
                                            <!--        @else-->
                                            <!--            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>-->
                                            <!--        @endif-->
                                            <!--    </form>-->
                                                <!--<a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">-->
                                                <!--    <i class="fa fa-eye"></i>-->
                                                <!--</a>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <!--</div>-->
                    </div>
                <!--</div>-->
            </div>
        </div>
        <!-- Ending of featured project area -->
        @endif





        <!-- for selected image slider  end -->




    </div>



@stop

@section('footer')
<script>
    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });

    $("#showmore").click(function() {
        $('html, body').animate({
            scrollTop: $("#description").offset().top - 200
        }, 1000);
    });


    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });
</script>

<script>
function myFunction() {
var popup = document.getElementById("myPopup");
popup.classList.toggle("show");

if (popup.paused){ 
    popup.play(); 
    }
  else{ 
    popup.pause();
    }
 
}
</script>
<!-- video 1 -->

<script type="text/javascript">
    window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close();
  }
}

function lightbox_open() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
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
</script>
<!--end video 1 -->

<!-- video 2 -->
  
  <script type="text/javascript">
    window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close1();
  }
}

function lightbox_open1() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo1");
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
  </script>

<!-- end video 2 -->


<!-- video 3 -->

<script type="text/javascript">
  window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close2();
  }
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
</script>

<!-- end video 3 -->

<!-- <script type="text/javascript">
    $(function () {
    //Loop through all Labels with class 'editable'.
    $(".editable").each(function () {
        //Reference the Label.
        var label = $(this);
 
        //Add a TextBox next to the Label.
        label.after("<input type = 'text' style = 'display:none' />");
 
        //Reference the TextBox.
        var textbox = $(this).next();
 
        //Set the name attribute of the TextBox.
        textbox[0].name = this.id.replace("lbl", "txt");
 
        //Assign the value of Label to TextBox.
        textbox.val(label.html());
 
        //When Label is clicked, hide Label and show TextBox.
        label.click(function () {
            $(this).hide();
            $(this).next().show();
        });
 
        //When focus is lost from TextBox, hide TextBox and show Label.
        textbox.focusout(function () {
            $(this).hide();
            $(this).prev().html($(this).val());
            $(this).prev().show();
        });
    });
});
</script> -->

@stop