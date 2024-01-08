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
    /*background: #0b7dda;*/
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

    .modal-content {
        width: 830px;
        margin: 0;
    }

    .input-group {
        width: 40%;
        margin-left: -30px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        border: 1px solid #d3f7f2;
        border-radius: 10px;
        position: relative;
    }

    .uploadImage {
        width: 100%;
        display: flex;
        left: 0;
        justify-content: space-between;
        padding: 15px 10px;
        font-size: 16px;
        background-color: rgba(255,255,255,0.7);
        color: #000;
        border: #000;
        border-radius: 10px;
        cursor: pointer;
    }

    .showImageData {
        box-shadow: 0 10px 10px rgba(0,0,0,0.1);
        text-align: center;
        font-size:14px;
        color: #b3b3b3;
        padding: 10px 18px;
        border-radius: 10px;
        position: absolute;
        opacity: 0;
        top: -55px;
        pointer-events: none;
    }

    .uploadImage:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0);
        transition: 0.2s;
    }

    .uploadImage:hover .showImageData {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-footer .upload{
        display:none;
    }



    .dropdown-check-list ul.items li {
    list-style: none;
    }


    .product-price .offer-pricenew {
        color: #4d4d4d;
        font-size: 15px;
        font-weight: 500;
        padding-left: 10px;
        color: initial;
        font-family: 'Montserrat', sans-serif;
    }

    .product-price .offer-pricenewone {
        color: #4d4d4d;
        font-size: 10px;
        font-weight: 500;
        padding-right: 6px;
        color: initial;
        font-family: 'Montserrat', sans-serif;
        text-decoration: none;
    }


        .dropdown-check-list {
            max-height: 20rem;
            overflow: auto;
            max-width: 20rem;
            border-radius: 1rem;
            background-color: ghostwhite;
        }

        .dropdown-check-list span{
            margin-left: 2rem;
        }

        .dropdown-check-list::-webkit-scrollbar{
            width:5px;
            background-color:white;
        }

        .dropdown-check-list::-webkit-scrollbar-thumb{
            background:gainsboro;
            border-radius:1rem;
        }
        .ratings{
            margin-top: 1rem;
        }
        
        .filter-section {
            display: flex;
            flex-direction: column;
        }
    /*media queries*/

    @media only screen and (max-width:400px)  {
        .bannar-image{
            background: "url({{url('/assets')}}/images/categories/{{$category->feature_image}})" no-repeat center center; 
            background-size: cover; 
            border-radius : 1.25rem; 
            height:20vh; 
            width:100%;
        }
    }

    @media only screen and (min-width:400px)  {
        .bannar-image{
            background: "url({{url('/assets')}}/images/categories/{{$category->feature_image}})" no-repeat center center; 
            background-size: cover; 
            border-radius : 1.25rem; 
            height:22vh; 
            width:100%;
        }
    }

    @media only screen and (min-width:800px)  {
        .bannar-image{
            background: "url({{url('/assets')}}/images/categories/{{$category->feature_image}})" no-repeat center center; 
            background-size: cover; 
            border-radius : 1.25rem; 
            height:30vh; 
            width:100%;
        }
    }

    @media only screen and (min-width:1000px)  {
        .bannar-image{
            background: "url({{url('/assets')}}/images/categories/{{$category->feature_image}})" no-repeat center center; 
            background-size: cover; 
            border-radius : 1.25rem; 
            height:60vh; 
            width:100%;
        }
    }

    /*end of media queries*/


</style>


    <div class="home-wrapper" style="overflow: hidden">
        <!-- Starting of product filter breadcroumb area -->
    
    <div class="container-fluid">
        <section class="bannar-image" style="background: url({{url('/assets')}}/images/categories/{{$category->feature_image}}) no-repeat center center; background-size: cover; border-radius : 1.25rem; ">
            <!--<section>-->
            <div class="row margin-left-0 margin-right-0" style="">

                <div style="margin: 0% 0px 0% 0px;">
                    <div class="text-center" style="color: #FFF;padding: 20px;">
                        @if(is_object($category))
                            <!--<h1 style="color : black; margin-bottom : 0;">{{$category->name}}</h1>-->
                        @else
                            <h1 style="color : black; margin-bottom : 0;">No Category Found</h1>
                        @endif
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
                                                    @if(isset($sort))
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
                                                    @endif
                                                </select>
                                            </div>
                                            <br>
                                            <!--start serach  -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="example" id="secondsearchform" style="margin:auto;">
                                                        <input type="text" id="secondsearchdata" placeholder="Search.." name="search">
                                                        <button type="submit" id="secondsearchbtn"><i class="fa fa-search"></i></button>
                                                    </form>
                                                </div>
                                            </div>>
                                            <!-- end search -->
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
                                                @if(isset($products[0]))
                                                  @if($products[0]->category[0] == 63)
                                                  <?php print_r("Sunglasses"); ?>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Gender</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='gender'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="MEN" @if(!empty($gender) && in_array('MEN', explode(',',$gender))) checked @endif /> Men  </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="WOMEN" @if(!empty($gender) && in_array('WOMEN', explode(',',$gender))) checked @endif />  Women </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="KIDS" @if(!empty($gender) && in_array('KIDS', explode(',',$gender))) checked @endif />  Kids </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="Unisex" @if(!empty($gender) && in_array('Unisex', explode(',',$gender))) checked @endif />  Unisex </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Type</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='frametype'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Full Rim" @if(!empty($frametype) && in_array('Full Rim', explode(',',$frametype))) checked @endif /> Full Rim </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Half Rim" @if(!empty($frametype) && in_array('Half Rim', explode(',',$frametype))) checked @endif />  Half Rim </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Rim less" @if(!empty($frametype) && in_array('Rim less', explode(',',$frametype))) checked @endif />  Rimless </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Shape</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                                    <ul class="items">
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Round" @if(!empty($shapes) && in_array('Round', explode(',',$shapes))) checked @endif> Round
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Square" @if(!empty($shapes) && in_array('Square', explode(',',$shapes))) checked @endif> Square
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Oval" @if(!empty($shapes) && in_array('Oval', explode(',',$shapes))) checked @endif>  Oval
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Rectangle" @if(!empty($shapes) && in_array('Rectangle', explode(',',$shapes))) checked @endif> Rectangle
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Cat eye" @if(!empty($shapes) && in_array('Cat eye', explode(',',$shapes))) checked @endif>  Cate Eye
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Geometric" @if(!empty($shapes) && in_array('Geometric', explode(',',$shapes))) checked @endif>  Geometric
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Brow line" @if(!empty($shapes) && in_array('Brow line', explode(',',$shapes))) checked @endif>  Brownline
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Aviator" @if(!empty($shapes) && in_array('Aviator', explode(',',$shapes))) checked @endif>  Aviator
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="classicwayframe" @if(!empty($shapes) && in_array('classicwayframe', explode(',',$shapes))) checked @endif>  Classic Wayframe
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Wrap" @if(!empty($shapes) && in_array('Wrap', explode(',',$shapes))) checked @endif>  Wrap
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='shape[]' value="Oversized" @if(!empty($shapes) && in_array('Oversized', explode(',',$shapes))) checked @endif>  Oversized
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Material</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Plastic" @if(!empty($framematerial) && in_array('Plastic', explode(',',$framematerial))) checked @endif /> Plastic </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Acetate" @if(!empty($framematerial) && in_array('Acetate', explode(',',$framematerial))) checked @endif />  Acetate </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Metal" @if(!empty($framematerial) && in_array('Metal', explode(',',$framematerial))) checked @endif />  Metal </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Stainless Steel" @if(!empty($framematerial) && in_array('Stainless Steel', explode(',',$framematerial))) checked @endif />  Stainless Steel </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Titanium" @if(!empty($framematerial) && in_array('Titanium', explode(',',$framematerial))) checked @endif />  Titanium </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="TR90" @if(!empty($framematerial) && in_array('TR90', explode(',',$framematerial))) checked @endif />  TR90 </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Ultem" @if(!empty($framematerial) && in_array('Ultem', explode(',',$framematerial))) checked @endif />  Ultem </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Wood" @if(!empty($framematerial) && in_array('Wood', explode(',',$framematerial))) checked @endif />  Wood </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Monel" @if(!empty($framematerial) && in_array('Monel', explode(',',$framematerial))) checked @endif />  Monel </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Aluminium" @if(!empty($framematerial) && in_array('Aluminium', explode(',',$framematerial))) checked @endif />  Aluminium </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Color</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                                    <ul class="items">
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="BLACK" @if(!empty($colors) && in_array('BLACK', explode(',',$colors))) checked @endif> Black
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="GOLDEN" @if(!empty($colors) && in_array('GOLDEN', explode(',',$colors))) checked @endif> GOLDEN
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="WHITE" @if(!empty($colors) && in_array('WHITE', explode(',',$colors))) checked @endif> White
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="BROWN" @if(!empty($colors) && in_array('BROWN', explode(',',$colors))) checked @endif> BROWN
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="RED" @if(!empty($colors) && in_array('RED', explode(',',$colors))) checked @endif> RED
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Turtoise" @if(!empty($colors) && in_array('Turtoise', explode(',',$colors))) checked @endif> Turtoise
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Blue" @if(!empty($colors) && in_array('Blue', explode(',',$colors))) checked @endif> Blue
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Silver" @if(!empty($colors) && in_array('Silver', explode(',',$colors))) checked @endif> Silver
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Grey" @if(!empty($colors) && in_array('Grey', explode(',',$colors))) checked @endif> Grey
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Gunmetal" @if(!empty($colors) && in_array('Gunmetal', explode(',',$colors))) checked @endif> Gunmetal
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Pink" @if(!empty($colors) && in_array('Pink', explode(',',$colors))) checked @endif> Pink
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Beige" @if(!empty($colors) && in_array('Beige', explode(',',$colors))) checked @endif> Beige 
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="green" @if(!empty($colors) && in_array('green', explode(',',$colors))) checked @endif> Green
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Purple" @if(!empty($colors) && in_array('Purple', explode(',',$colors))) checked @endif> Purple
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Multicolor" @if(!empty($colors) && in_array('Multicolor', explode(',',$colors))) checked @endif> Multicolor
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Rose Gold" @if(!empty($colors) && in_array('Rose Gold', explode(',',$colors))) checked @endif> Rose Gold
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="yellow" @if(!empty($colors) && in_array('yellow', explode(',',$colors))) checked @endif> Yellow
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Orange" @if(!empty($colors) && in_array('Orange', explode(',',$colors))) checked @endif> Orange
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Glitter" @if(!empty($colors) && in_array('Glitter', explode(',',$colors))) checked @endif> Glitter
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Maroon" @if(!empty($colors) && in_array('Maroon', explode(',',$colors))) checked @endif> Maroon
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='color[]' value="Transparent" @if(!empty($colors) && in_array('Transparent', explode(',',$colors))) checked @endif> Transparent
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Lense Color</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="brown" @if(!empty($lenscolor) && in_array('brown', explode(',',$lenscolor))) checked @endif /> Brown  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="red" @if(!empty($lenscolor) && in_array('red', explode(',',$lenscolor))) checked @endif /> Red  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="orange" @if(!empty($lenscolor) && in_array('orange', explode(',',$lenscolor))) checked @endif /> Orange  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="green" @if(!empty($lenscolor) && in_array('green', explode(',',$lenscolor))) checked @endif /> Green  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="blue" @if(!empty($lenscolor) && in_array('blue', explode(',',$lenscolor))) checked @endif /> Blue  </li>
                                                                            
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Transparent" @if(!empty($lenscolor) && in_array('Transparent', explode(',',$lenscolor))) checked @endif /> Transparent  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="multicolor" @if(!empty($lenscolor) && in_array('multicolor', explode(',',$lenscolor))) checked @endif /> Multicolor  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="gray" @if(!empty($lenscolor) && in_array('gray', explode(',',$lenscolor))) checked @endif /> Gray  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="blue" @if(!empty($lenscolor) && in_array('blue', explode(',',$lenscolor))) checked @endif /> Blue  </li>


                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Silver" @if(!empty($lenscolor) && in_array('Silver', explode(',',$lenscolor))) checked @endif /> Silver  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Golden" @if(!empty($lenscolor) && in_array('Golden', explode(',',$lenscolor))) checked @endif /> Golden  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Sky Blue" @if(!empty($lenscolor) && in_array('Sky Blue', explode(',',$lenscolor))) checked @endif /> Sky Blue  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Silver" @if(!empty($lenscolor) && in_array('Silver', explode(',',$lenscolor))) checked @endif /> Silver  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Voilet" @if(!empty($lenscolor) && in_array('Voilet', explode(',',$lenscolor))) checked @endif /> Voilet  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Black" @if(!empty($lenscolor) && in_array('Black', explode(',',$lenscolor))) checked @endif /> Black  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Pink" @if(!empty($lenscolor) && in_array('Pink', explode(',',$lenscolor))) checked @endif /> Pink  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Maroon" @if(!empty($lenscolor) && in_array('Maroon', explode(',',$lenscolor))) checked @endif /> Maroon  </li>

                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Yellow" @if(!empty($lenscolor) && in_array('Yellow', explode(',',$lenscolor))) checked @endif /> Yellow  </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4">
                                                        <button type="button" style="float: left; " class="btn btn-primary" name="allfilterApply">Apply</button>
                                                    </div>

                                                @elseif($products[0]->category[0] == 53)
                                                    <?php print_r("Frame"); ?>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Gender</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='gender'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="MEN" @if(!empty($gender) && in_array('MEN', explode(',',$gender))) checked @endif /> Men </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="WOMEN" @if(!empty($gender) && in_array('WOMEN', explode(',',$gender))) checked @endif />  Women </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="KIDS" @if(!empty($gender) && in_array('KIDS', explode(',',$gender))) checked @endif />  Kids </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="Unisex" @if(!empty($gender) && in_array('Unisex', explode(',',$gender))) checked @endif />  Unisex </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Type</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='frametype'>
                                                                    <ul class="items">
                                                                    <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Full Rim" @if(!empty($frametype) && in_array('Full Rim', explode(',',$frametype))) checked @endif /> Full Rim </li>
                                                                    <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Half Rim" @if(!empty($frametype) && in_array('Half Rim', explode(',',$frametype))) checked @endif />  Half Rim </li>
                                                                    <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Rim less" @if(!empty($frametype) && in_array('Rim less', explode(',',$frametype))) checked @endif />  Rimless </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                            

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Shape</b></span>
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                                <ul class="items">
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Round" @if(!empty($shapes) && in_array('Round', explode(',',$shapes))) checked @endif> Round
                                                               </li>
                                                               <li>
                                                                   <input type="checkbox" class="form-check-input" name='shape[]' value="Square" @if(!empty($shapes) && in_array('Square', explode(',',$shapes))) checked @endif> Square
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Oval" @if(!empty($shapes) && in_array('Oval', explode(',',$shapes))) checked @endif>  Oval
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Rectangle" @if(!empty($shapes) && in_array('Rectangle', explode(',',$shapes))) checked @endif> Rectangle
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Cat eye" @if(!empty($shapes) && in_array('Cat eye', explode(',',$shapes))) checked @endif>  Cate Eye
                                                                </li>
                                                                
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Geometric" @if(!empty($shapes) && in_array('Geometric', explode(',',$shapes))) checked @endif>  Geometric
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Brow line" @if(!empty($shapes) && in_array('Brow line', explode(',',$shapes))) checked @endif>  Brownline
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Aviator" @if(!empty($shapes) && in_array('Aviator', explode(',',$shapes))) checked @endif>  Aviator
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="classicwayframe" @if(!empty($shapes) && in_array('classicwayframe', explode(',',$shapes))) checked @endif>  Classic Wayframe
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Wrap" @if(!empty($shapes) && in_array('Wrap', explode(',',$shapes))) checked @endif>  Wrap
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Oversized" @if(!empty($shapes) && in_array('Oversized', explode(',',$shapes))) checked @endif>  Oversized
                                                                </li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                   

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Material</b></span>
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Plastic" @if(!empty($framematerial) && in_array('Plastic', explode(',',$framematerial))) checked @endif /> Plastic </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Acetate" @if(!empty($framematerial) && in_array('Acetate', explode(',',$framematerial))) checked @endif />  Acetate </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Metal" @if(!empty($framematerial) && in_array('Metal', explode(',',$framematerial))) checked @endif />  Metal </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Stainless Steel" @if(!empty($framematerial) && in_array('Stainless Steel', explode(',',$framematerial))) checked @endif />  Stainless Steel </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Titanium" @if(!empty($framematerial) && in_array('Titanium', explode(',',$framematerial))) checked @endif />  Titanium </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="TR90" @if(!empty($framematerial) && in_array('TR90', explode(',',$framematerial))) checked @endif />  TR90 </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Ultem" @if(!empty($framematerial) && in_array('Ultem', explode(',',$framematerial))) checked @endif />  Ultem </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Wood" @if(!empty($framematerial) && in_array('Wood', explode(',',$framematerial))) checked @endif />  Wood </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Monel" @if(!empty($framematerial) && in_array('Monel', explode(',',$framematerial))) checked @endif />  Monel </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Aluminium" @if(!empty($framematerial) && in_array('Aluminium', explode(',',$framematerial))) checked @endif />  Aluminium </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Frame Color</b></span>
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                               <ul class="items">
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="BLACK" @if(!empty($colors) && in_array('BLACK', explode(',',$colors))) checked @endif> Black
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="GOLDEN" @if(!empty($colors) && in_array('GOLDEN', explode(',',$colors))) checked @endif> GOLDEN
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="WHITE" @if(!empty($colors) && in_array('WHITE', explode(',',$colors))) checked @endif> White
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="BROWN" @if(!empty($colors) && in_array('BROWN', explode(',',$colors))) checked @endif> BROWN
                                                                </li>

                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="RED" @if(!empty($colors) && in_array('RED', explode(',',$colors))) checked @endif> RED
                                                                </li>
                                                                
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Turtoise" @if(!empty($colors) && in_array('Turtoise', explode(',',$colors))) checked @endif> Turtoise
                                                               </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Blue" @if(!empty($colors) && in_array('Blue', explode(',',$colors))) checked @endif> Blue
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Silver" @if(!empty($colors) && in_array('Silver', explode(',',$colors))) checked @endif> Silver
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Grey" @if(!empty($colors) && in_array('Grey', explode(',',$colors))) checked @endif> Grey
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Gunmetal" @if(!empty($colors) && in_array('Gunmetal', explode(',',$colors))) checked @endif> Gunmetal
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Pink" @if(!empty($colors) && in_array('Pink', explode(',',$colors))) checked @endif> Pink
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Beige" @if(!empty($colors) && in_array('Beige', explode(',',$colors))) checked @endif> Beige 
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="green" @if(!empty($colors) && in_array('green', explode(',',$colors))) checked @endif> Green
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Purple" @if(!empty($colors) && in_array('Purple', explode(',',$colors))) checked @endif> Purple
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Multicolor" @if(!empty($colors) && in_array('Multicolor', explode(',',$colors))) checked @endif> Multicolor
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Rose Gold" @if(!empty($colors) && in_array('Rose Gold', explode(',',$colors))) checked @endif> Rose Gold
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="yellow" @if(!empty($colors) && in_array('yellow', explode(',',$colors))) checked @endif> Yellow
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Orange" @if(!empty($colors) && in_array('Orange', explode(',',$colors))) checked @endif> Orange
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Glitter" @if(!empty($colors) && in_array('Glitter', explode(',',$colors))) checked @endif> Glitter
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Maroon" @if(!empty($colors) && in_array('Maroon', explode(',',$colors))) checked @endif> Maroon
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Transparent" @if(!empty($colors) && in_array('Transparent', explode(',',$colors))) checked @endif> Transparent
                                                               </li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                        <div class="col-lg-4">
                                                                 <button type="button" style="float: left; display: none;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                         </div>
                                                @elseif($products[0]->category[0] == 72)
                                                    <?php print_r("Contact Lense"); ?>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Brand Name</b></span>
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Alcon" @if(!empty($brandname) && in_array('Alcon', explode(',',$brandname))) checked @endif /> Alcon </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="johnson and johnson" @if(!empty($brandname) && in_array('johnson and johnson', explode(',',$brandname))) checked @endif />  Johnson And Johnson </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="bausch and lomb" @if(!empty($brandname) && in_array('bausch and lomb', explode(',',$brandname))) checked @endif />  Bausch And Lomb </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="cooper vision" @if(!empty($brandname) && in_array('cooper vision', explode(',',$brandname))) checked @endif />  Cooper Vision </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="CL India" @if(!empty($brandname) && in_array('CL India', explode(',',$brandname))) checked @endif />  CL India </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Asian Eyewear" @if(!empty($brandname) && in_array('Asian Eyewear', explode(',',$brandname))) checked @endif />  Asian Eyewear </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Vision Care Lab" @if(!empty($brandname) && in_array('Vision Care Lab', explode(',',$brandname))) checked @endif />  Vision Care Lab </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Zeiss" @if(!empty($brandname) && in_array('Zeiss', explode(',',$brandname))) checked @endif />  Zeiss </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Hoya" @if(!empty($brandname) && in_array('Hoya', explode(',',$brandname))) checked @endif />  Hoya </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Adriano Cross" @if(!empty($brandname) && in_array('Adriano Cross', explode(',',$brandname))) checked @endif />  Adriano Cross </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Azzaro" @if(!empty($brandname) && in_array('Azzaro', explode(',',$brandname))) checked @endif />  Azzaro </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="E=mc2" @if(!empty($brandname) && in_array('E=mc2', explode(',',$brandname))) checked @endif />  E=mc2 </li>
                                                              

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Purvesh" @if(!empty($brandname) && in_array('Purvesh', explode(',',$brandname))) checked @endif />  Purvesh </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Prime" @if(!empty($brandname) && in_array('Prime', explode(',',$brandname))) checked @endif />  Prime </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Boss" @if(!empty($brandname) && in_array('Boss', explode(',',$brandname))) checked @endif />  Boss </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Carrera" @if(!empty($brandname) && in_array('Carrera', explode(',',$brandname))) checked @endif />  Carrera </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Carrera Ducati" @if(!empty($brandname) && in_array('Carrera Ducati', explode(',',$brandname))) checked @endif />  Carrera Ducati </li>


                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Dior" @if(!empty($brandname) && in_array('Dior', explode(',',$brandname))) checked @endif />  Dior </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Dior Homme" @if(!empty($brandname) && in_array('Dior Homme', explode(',',$brandname))) checked @endif />  Dior Homme </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Elie Saab" @if(!empty($brandname) && in_array('Elie Saab', explode(',',$brandname))) checked @endif />  Elie Saab </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Fendi" @if(!empty($brandname) && in_array('Fendi', explode(',',$brandname))) checked @endif />  Fendi </li>
                                                              
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Fossil" @if(!empty($brandname) && in_array('Fossil', explode(',',$brandname))) checked @endif />  Fossil </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Givenchy" @if(!empty($brandname) && in_array('Givenchy', explode(',',$brandname))) checked @endif />  Givenchy </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Havaianas" @if(!empty($brandname) && in_array('Havaianas', explode(',',$brandname))) checked @endif />  Havaianas </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Isabel Marant" @if(!empty($brandname) && in_array('Isabel Marant', explode(',',$brandname))) checked @endif />  Isabel Marant </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Jimmy Choo" @if(!empty($brandname) && in_array('Jimmy Choo', explode(',',$brandname))) checked @endif />  Jimmy Choo </li>
                                                              

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Juicy Couture" @if(!empty($brandname) && in_array('Juicy Couture', explode(',',$brandname))) checked @endif />  Juicy Couture </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Kate Spade" @if(!empty($brandname) && in_array('Kate Spade', explode(',',$brandname))) checked @endif />  Kate Spade </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Levis" @if(!empty($brandname) && in_array('Levis', explode(',',$brandname))) checked @endif />  Levis </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="M Missoni" @if(!empty($brandname) && in_array('M Missoni', explode(',',$brandname))) checked @endif />  M Missoni </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Marc By Marc Jacobs" @if(!empty($brandname) && in_array('Marc By Marc Jacobs', explode(',',$brandname))) checked @endif />  Marc By Marc Jacobs </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Marc Jacobs" @if(!empty($brandname) && in_array('Marc Jacobs', explode(',',$brandname))) checked @endif />  Marc Jacobs </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Max & Co." @if(!empty($brandname) && in_array('Max & Co.', explode(',',$brandname))) checked @endif />  Max & Co. </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Max Mara" @if(!empty($brandname) && in_array('Max Mara', explode(',',$brandname))) checked @endif />  Max Mara </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Missoni" @if(!empty($brandname) && in_array('Missoni', explode(',',$brandname))) checked @endif />  Missoni </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Moschino" @if(!empty($brandname) && in_array('Moschino', explode(',',$brandname))) checked @endif />  Moschino </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Moschino Love" @if(!empty($brandname) && in_array('Moschino Love', explode(',',$brandname))) checked @endif />  Moschino Love </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Oxydo" @if(!empty($brandname) && in_array('Oxydo', explode(',',$brandname))) checked @endif />  Oxydo </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Pierre Cardin" @if(!empty($brandname) && in_array('Pierre Cardin', explode(',',$brandname))) checked @endif />  Pierre Cardin </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid" @if(!empty($brandname) && in_array('Polaroid', explode(',',$brandname))) checked @endif />  Polaroid </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Ancillaries" @if(!empty($brandname) && in_array('Polaroid Ancillaries', explode(',',$brandname))) checked @endif />  Polaroid Ancillaries </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Kids" @if(!empty($brandname) && in_array('Polaroid Kids', explode(',',$brandname))) checked @endif />  Polaroid Kids </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Premium" @if(!empty($brandname) && in_array('Polaroid Premium', explode(',',$brandname))) checked @endif />  Polaroid Premium </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Reading Glasses" @if(!empty($brandname) && in_array('Polaroid Reading Glasses', explode(',',$brandname))) checked @endif />  Polaroid Reading Glasses </li>
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Sport" @if(!empty($brandname) && in_array('Polaroid Sport', explode(',',$brandname))) checked @endif />  Polaroid Sport </li>


                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Polaroid Staysafe" @if(!empty($brandname) && in_array('Polaroid Staysafe', explode(',',$brandname))) checked @endif />  Polaroid Staysafe </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Rag&Bone" @if(!empty($brandname) && in_array('Rag&Bone', explode(',',$brandname))) checked @endif />  Rag&Bone </li>

                                                              
                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Stepper" @if(!empty($brandname) && in_array('Stepper', explode(',',$brandname))) checked @endif />  Stepper </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Safilo" @if(!empty($brandname) && in_array('Safilo', explode(',',$brandname))) checked @endif />  Safilo </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Safilo By Marcel Wanders" @if(!empty($brandname) && in_array('Safilo By Marcel Wanders', explode(',',$brandname))) checked @endif />  Safilo By Marcel Wanders </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Seventh Street" @if(!empty($brandname) && in_array('Seventh Street', explode(',',$brandname))) checked @endif />  Seventh Street </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Smith" @if(!empty($brandname) && in_array('Smith', explode(',',$brandname))) checked @endif />  Smith </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Boss Orange" @if(!empty($brandname) && in_array('Boss Orange', explode(',',$brandname))) checked @endif />  Boss Orange </li>

                                                              <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Tommy Hilfiger" @if(!empty($brandname) && in_array('Tommy Hilfiger', explode(',',$brandname))) checked @endif />  Tommy Hilfiger </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Lens Type</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenstype'>
                                                                    <ul class="items">
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='lenstype[]' value="Single Vision" @if(!empty($lenstype) && in_array('Single Vision', explode(',',$lenstype))) checked @endif> Single Vision
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='lenstype[]' value="MultiFocal" @if(!empty($lenstype) && in_array('MultiFocal', explode(',',$lenstype))) checked @endif> Multi Focal
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='lenstype[]' value="toric and Astigmatism" @if(!empty($lenstype) && in_array('toric and Astigmatism', explode(',',$lenstype))) checked @endif> Toric and Astigmatism
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='lenstype[]' value="Plano" @if(!empty($lenstype) && in_array('Plano', explode(',',$lenstype))) checked @endif> Plano
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Lens Color</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Brown" @if(!empty($lenscolor) && in_array('Brown', explode(',',$lenscolor))) checked @endif />  Brown</li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Hazel" @if(!empty($lenscolor) && in_array('Hazel', explode(',',$lenscolor))) checked @endif />  Hazel </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Turquoise" @if(!empty($lenscolor) && in_array('Turquoise', explode(',',$lenscolor))) checked @endif />  Turquoise </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Green" @if(!empty($lenscolor) && in_array('Green', explode(',',$lenscolor))) checked @endif /> Green  </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Blue" @if(!empty($lenscolor) && in_array('Blue', explode(',',$lenscolor))) checked @endif /> Blue  </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Transparent" @if(!empty($lenscolor) && in_array('Transparent', explode(',',$lenscolor))) checked @endif />  Transparent </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Multicolor" @if(!empty($lenscolor) && in_array('Multicolor', explode(',',$lenscolor))) checked @endif />  Multicolor </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Grey" @if(!empty($lenscolor) && in_array('Grey', explode(',',$lenscolor))) checked @endif />  Grey </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Purple" @if(!empty($lenscolor) && in_array('Purple', explode(',',$lenscolor))) checked @endif />  Purple </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Hony" @if(!empty($lenscolor) && in_array('Hony', explode(',',$lenscolor))) checked @endif />  Hony </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Sky Blue" @if(!empty($lenscolor) && in_array('Sky Blue', explode(',',$lenscolor))) checked @endif />  Sky Blue </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Voilet" @if(!empty($lenscolor) && in_array('Voilet', explode(',',$lenscolor))) checked @endif />  Voilet </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Black" @if(!empty($lenscolor) && in_array('Black', explode(',',$lenscolor))) checked @endif />  Black </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="Clear" @if(!empty($lenscolor) && in_array('Clear', explode(',',$lenscolor))) checked @endif />  Clear </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <span class="anchor"><b>Select Lens Per Box</b></span>
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='packaging'>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="1 Lens Per Box" @if(!empty($packaging) && in_array('1 Lens Per Box', explode(',',$packaging))) checked @endif /> 1 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="2 Lens Per Box" @if(!empty($packaging) && in_array('2 Lens Per Box', explode(',',$packaging))) checked @endif />  2 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="3 Lens Per Box" @if(!empty($packaging) && in_array('3 Lens Per Box', explode(',',$packaging))) checked @endif />  3 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="5 Lens Per Box" @if(!empty($packaging) && in_array('5 Lens Per Box', explode(',',$packaging))) checked @endif />  5 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="6 Lens Per Box" @if(!empty($packaging) && in_array('6 Lens Per Box', explode(',',$framematerial))) checked @endif />  6 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="12 Lens Per box" @if(!empty($packaging) && in_array('12 Lens Per box', explode(',',$packaging))) checked @endif />  12 Lens Per box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="30 Lens Per Box" @if(!empty($packaging) && in_array('30 Lens Per Box', explode(',',$packaging))) checked @endif />  30 Lens Per Box </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='packaging[]' value="90 Lens Per Box" @if(!empty($packaging) && in_array('90 Lens Per Box', explode(',',$packaging))) checked @endif />  90 Lens Per Box </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4">
                                                        <button type="button" style="float: left;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                    </div>

                                                @elseif($products[0]->category[0] == 58)
                                                    <!--<?php print_r("Lenses"); ?>-->
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group" style="display: flex; align-items:center; justify-content: center;">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="outline:none;">
                                                                    Product Prescription
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                                    <span class="anchor"><b>Select Brand Name</b></span>
                                                                    <ul class="items">
                                                                        <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Zeiss" @if(!empty($brandname) && in_array('Zeiss', explode(',',$brandname))) checked @endif /> Zeiss  </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Hoya" @if(!empty($brandname) && in_array('Hoya', explode(',',$brandname))) checked @endif />Hoya</li>
                                                                        <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Purvesh" @if(!empty($brandname) && in_array('Purvesh', explode(',',$brandname))) checked @endif />  Purvesh </li>
                                                                        <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Prime" @if(!empty($brandname) && in_array('Prime', explode(',',$brandname))) checked @endif />  Prime </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='visioneffect'>
                                                                    <span class="anchor"><b>Select Lens Type</b></span>
                                                                    <ul class="items">
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='visioneffect[]' value="Single Vision" @if(!empty($visioneffect) && in_array('Single Vision', explode(',',$visioneffect))) checked @endif> Single Vision
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='visioneffect[]' value="Biofocal" @if(!empty($visioneffect) && in_array('Biofocal', explode(',',$visioneffect))) checked @endif> Biofocal
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='visioneffect[]' value="Progressive" @if(!empty($visioneffect) && in_array('Progressive', explode(',',$visioneffect))) checked @endif> Progressive
                                                                        </li>
                                                                        <li>
                                                                            <input type="checkbox" class="form-check-input" name='visioneffect[]' value="Zero Power" @if(!empty($visioneffect) && in_array('Zero Power', explode(',',$visioneffect))) checked @endif> Zero Power
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                     <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensindex'>
                                                              <span class="anchor"><b>Select Index</b></span>
                                                                <ul class="items">
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.49" @if(!empty($lensindex) && in_array('1.49', explode(',',$lensindex))) checked @endif> 1.49 
                                                                </li>
                                                                <li>
                                                                   <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.5" @if(!empty($lensindex) && in_array('1.5', explode(',',$lensindex))) checked @endif> 1.5
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.53" @if(!empty($lensindex) && in_array('1.53', explode(',',$lensindex))) checked @endif> 1.53
                                                               </li>
                                                                 <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.55" @if(!empty($lensindex) && in_array('1.55', explode(',',$lensindex))) checked @endif>1.55
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.56" @if(!empty($lensindex) && in_array('1.56', explode(',',$lensindex))) checked @endif>1.56
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.59" @if(!empty($lensindex) && in_array('1.59', explode(',',$lensindex))) checked @endif>1.59
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.60" @if(!empty($lensindex) && in_array('1.60', explode(',',$lensindex))) checked @endif>1.60
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.61" @if(!empty($lensindex) && in_array('1.61', explode(',',$lensindex))) checked @endif>1.61
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.67" @if(!empty($lensindex) && in_array('1.67', explode(',',$lensindex))) checked @endif>1.67
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.7" @if(!empty($lensindex) && in_array('1.7', explode(',',$lensindex))) checked @endif>1.7
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.74" @if(!empty($lensindex) && in_array('1.74', explode(',',$lensindex))) checked @endif>1.74
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='lensindex[]' value="1.80" @if(!empty($lensindex) && in_array('1.80', explode(',',$lensindex))) checked @endif>1.80
                                                                </li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensmaterialtype'>
                                                                    <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Material</b></span>
                                                                    <ul class="items">
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenstechnology'>
                                                               <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Technology</b></span>
                                                                <ul class="items">
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Mirror Coating" @if(!empty($lenstechnology) && in_array('Mirror Coating', explode(',',$lenstechnology))) checked @endif> Mirror Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Scratch Resistant Coating" @if(!empty($lenstechnology) && in_array('Scratch Resistant Coating', explode(',',$lenstechnology))) checked @endif> Scratch Resistant Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Anti-Reflective Coating" @if(!empty($lenstechnology) && in_array('Anti-Reflective Coating', explode(',',$lenstechnology))) checked @endif> Anti-Reflective Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Anti-Fog Coating" @if(!empty($lenstechnology) && in_array('Anti-Fog Coating', explode(',',$lenstechnology))) checked @endif> Anti-Fog Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Water Resistant Coating" @if(!empty($lenstechnology) && in_array('Water Resistant Coating', explode(',',$lenstechnology))) checked @endif> Water Resistant Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="UV Protection Coating" @if(!empty($lenstechnology) && in_array('UV Protection Coating', explode(',',$lenstechnology))) checked @endif> UV Protection Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Blue Control Coating" @if(!empty($lenstechnology) && in_array('Blue Control Coating', explode(',',$lenstechnology))) checked @endif> Blue Control Coating
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Polarized" @if(!empty($lenstechnology) && in_array('Polarized', explode(',',$lenstechnology))) checked @endif> Polarized
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Other" @if(!empty($lenstechnology) && in_array('Other', explode(',',$lenstechnology))) checked @endif> Other
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Conventional Manufacturing Technology" @if(!empty($lenstechnology) && in_array('Conventional Manufacturing Technology', explode(',',$lenstechnology))) checked @endif> Conventional Manufacturing Technology
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="FreeForm Manufacturing Technology" @if(!empty($lenstechnology) && in_array('FreeForm Manufacturing Technology', explode(',',$lenstechnology))) checked @endif> FreeForm Manufacturing Technology
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Digital Surface" @if(!empty($lenstechnology) && in_array('Digital Surface', explode(',',$lenstechnology))) checked @endif> Digital Surface
                                                                    
                                                                    </li>
                                                                    <li>
                                                                      <input type="checkbox" class="form-check-input" name='lenstechnology[]' value="Mold Casting" @if(!empty($lenstechnology) && in_array('Mold Casting', explode(',',$lenstechnology))) checked @endif> Mold Casting
                                                                    </li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4">
                                                        <button type="button" style="float: left;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                    </div>
                                                @elseif($products[0]->category[0] == 82)
                                                    <!--<?php print_r("Premium Brand"); ?>-->
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='gender'>
                                                              <span class="anchor"><b style="margin-left:3.5rem;">Select Gender</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="MEN" @if(!empty($gender) && in_array('MEN', explode(',',$gender))) checked @endif /> MEN </li>
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="WOMEN" @if(!empty($gender) && in_array('WOMEN', explode(',',$gender))) checked @endif />  WOMEN </li>
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="KIDS" @if(!empty($gender) && in_array('KIDS', explode(',',$gender))) checked @endif />  KIDS </li>
                                                              <li><input type="checkbox" class="form-check-input" name='gender[]' value="Unisex" @if(!empty($gender) && in_array('Unisex', explode(',',$gender))) checked @endif />  Unisex </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='frametype'>
                                                              <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Type</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Full Rim" @if(!empty($frametype) && in_array('Full Rim', explode(',',$frametype))) checked @endif /> Full Rim </li>
                                                              <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Half Rim" @if(!empty($frametype) && in_array('Half Rim', explode(',',$frametype))) checked @endif />  Half Rim </li>
                                                              <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Rim less" @if(!empty($frametype) && in_array('Rim less', explode(',',$frametype))) checked @endif />  Rim less </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                              <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Shape</b></span>
                                                              <ul class="items">
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Round" @if(!empty($shapes) && in_array('Round', explode(',',$shapes))) checked @endif> Round
                                                               </li>
                                                               <li>
                                                                   <input type="checkbox" class="form-check-input" name='shape[]' value="Square" @if(!empty($shapes) && in_array('Square', explode(',',$shapes))) checked @endif> Square
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Oval" @if(!empty($shapes) && in_array('Oval', explode(',',$shapes))) checked @endif>  Oval
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Rectangle" @if(!empty($shapes) && in_array('Rectangle', explode(',',$shapes))) checked @endif> Rectangle
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Cat eye" @if(!empty($shapes) && in_array('Cat eye', explode(',',$shapes))) checked @endif>  Cate Eye
                                                                </li>
                                                                
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Geometric" @if(!empty($shapes) && in_array('Geometric', explode(',',$shapes))) checked @endif>  Geometric
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Brow line" @if(!empty($shapes) && in_array('Brow line', explode(',',$shapes))) checked @endif>  Brownline
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Aviator" @if(!empty($shapes) && in_array('Aviator', explode(',',$shapes))) checked @endif>  Aviator
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="classicwayframe" @if(!empty($shapes) && in_array('classicwayframe', explode(',',$shapes))) checked @endif>  Classic Wayframe
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Wrap" @if(!empty($shapes) && in_array('Wrap', explode(',',$shapes))) checked @endif>  Wrap
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='shape[]' value="Oversized" @if(!empty($shapes) && in_array('Oversized', explode(',',$shapes))) checked @endif>  Oversized
                                                                </li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                              <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Material</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Plastic" @if(!empty($framematerial) && in_array('Plastic', explode(',',$framematerial))) checked @endif /> Plastic </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Acetate" @if(!empty($framematerial) && in_array('Acetate', explode(',',$framematerial))) checked @endif />  Acetate </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Metal" @if(!empty($framematerial) && in_array('Metal', explode(',',$framematerial))) checked @endif />  Metal </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Stainless Steel" @if(!empty($framematerial) && in_array('Stainless Steel', explode(',',$framematerial))) checked @endif />  Stainless Steel </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Titanium" @if(!empty($framematerial) && in_array('Titanium', explode(',',$framematerial))) checked @endif />  Titanium </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="TR90" @if(!empty($framematerial) && in_array('TR90', explode(',',$framematerial))) checked @endif />  TR90 </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Ultem" @if(!empty($framematerial) && in_array('Ultem', explode(',',$framematerial))) checked @endif />  Ultem </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Wood" @if(!empty($framematerial) && in_array('Wood', explode(',',$framematerial))) checked @endif />  Wood </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Monel" @if(!empty($framematerial) && in_array('Monel', explode(',',$framematerial))) checked @endif />  Monel </li>
                                                              <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="Aluminium" @if(!empty($framematerial) && in_array('Aluminium', explode(',',$framematerial))) checked @endif />  Aluminium </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div><br>


                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                               <span class="anchor" style="padding:2.5rem;"><b>Select Frame Color</b></span>
                                                               <ul class="items">
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="BLACK" @if(!empty($colors) && in_array('BLACK', explode(',',$colors))) checked @endif> Black
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="GOLDEN" @if(!empty($colors) && in_array('GOLDEN', explode(',',$colors))) checked @endif> GOLDEN
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="WHITE" @if(!empty($colors) && in_array('WHITE', explode(',',$colors))) checked @endif> White
                                                                </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="BROWN" @if(!empty($colors) && in_array('BROWN', explode(',',$colors))) checked @endif> BROWN
                                                                </li>

                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="RED" @if(!empty($colors) && in_array('RED', explode(',',$colors))) checked @endif> RED
                                                                </li>
                                                                
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Turtoise" @if(!empty($colors) && in_array('Turtoise', explode(',',$colors))) checked @endif> Turtoise
                                                               </li>
                                                                <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Blue" @if(!empty($colors) && in_array('Blue', explode(',',$colors))) checked @endif> Blue
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Silver" @if(!empty($colors) && in_array('Silver', explode(',',$colors))) checked @endif> Silver
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Grey" @if(!empty($colors) && in_array('Grey', explode(',',$colors))) checked @endif> Grey
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Gunmetal" @if(!empty($colors) && in_array('Gunmetal', explode(',',$colors))) checked @endif> Gunmetal
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Pink" @if(!empty($colors) && in_array('Pink', explode(',',$colors))) checked @endif> Pink
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Beige" @if(!empty($colors) && in_array('Beige', explode(',',$colors))) checked @endif> Beige 
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="green" @if(!empty($colors) && in_array('green', explode(',',$colors))) checked @endif> Green
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Purple" @if(!empty($colors) && in_array('Purple', explode(',',$colors))) checked @endif> Purple
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Multicolor" @if(!empty($colors) && in_array('Multicolor', explode(',',$colors))) checked @endif> Multicolor
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Rose Gold" @if(!empty($colors) && in_array('Rose Gold', explode(',',$colors))) checked @endif> Rose Gold
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="yellow" @if(!empty($colors) && in_array('yellow', explode(',',$colors))) checked @endif> Yellow
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Orange" @if(!empty($colors) && in_array('Orange', explode(',',$colors))) checked @endif> Orange
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Glitter" @if(!empty($colors) && in_array('Glitter', explode(',',$colors))) checked @endif> Glitter
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Maroon" @if(!empty($colors) && in_array('Maroon', explode(',',$colors))) checked @endif> Maroon
                                                               </li>
                                                               <li>
                                                                  <input type="checkbox" class="form-check-input" name='color[]' value="Transparent" @if(!empty($colors) && in_array('Transparent', explode(',',$colors))) checked @endif> Transparent
                                                               </li>
                                                              </ul>                                         </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                              <span class="anchor" style="padding:3rem;"><b>Select Lense Color</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="grey" @if(!empty($lenscolor) && in_array('grey', explode(',',$lenscolor))) checked @endif /> Grey  </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="blue" @if(!empty($lenscolor) && in_array('blue', explode(',',$lenscolor))) checked @endif />  Blue </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="green" @if(!empty($lenscolor) && in_array('green', explode(',',$lenscolor))) checked @endif />  Green </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="brown" @if(!empty($lenscolor) && in_array('brown', explode(',',$lenscolor))) checked @endif />  Brown </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="yellow" @if(!empty($lenscolor) && in_array('yellow', explode(',',$lenscolor))) checked @endif />  Yellow </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="pink" @if(!empty($lenscolor) && in_array('pink', explode(',',$lenscolor))) checked @endif />  Pink </li>
                                                              <li><input type="checkbox" class="form-check-input" name='lenscolor[]' value="black" @if(!empty($lenscolor) && in_array('black', explode(',',$lenscolor))) checked @endif />  Black </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4">
                                                        <button type="button" style="float: left;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                    </div>
                                                @elseif($products[0]->category[0] == 87)
                                                    <!--<?php print_r("Contact Lens Solution"); ?>-->
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                                <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                                    <span class="anchor" style="padding:3rem;"><b>Select Brand Name</b></span>
                                                                    <ul class="items">
                                                                      <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Alcon" @if(!empty($brandname) && in_array('Alcon', explode(',',$brandname))) checked @endif /> Alcon </li>
                                                                      <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Johnson and Johnson" @if(!empty($brandname) && in_array('Johnson and Johnson', explode(',',$brandname))) checked @endif />  Johnson And Johnson </li>
                                                                      <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Bausch and Lomb" @if(!empty($brandname) && in_array('Bausch and Lomb', explode(',',$brandname))) checked @endif />  Bausch And Lomb </li>
                                                                      <li><input type="checkbox" class="form-check-input" name='brandname[]' value="Cooper Vision" @if(!empty($brandname) && in_array('Cooper Vision', explode(',',$brandname))) checked @endif />  Cooper Vision </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group filter-section">
                                                             <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                              <span class="anchor" style="padding:3.5rem;"><b>Net Quantity</b></span>
                                                              <ul class="items">
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="8 ML" @if(!empty($netquntity) && in_array('8 ML', explode(',',$netquntity))) checked @endif /> 8 ML  </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="60 ML" @if(!empty($netquntity) && in_array('60 ML', explode(',',$netquntity))) checked @endif />  60 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="105 ML" @if(!empty($netquntity) && in_array('105 ML', explode(',',$netquntity))) checked @endif />  105 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="118 ML" @if(!empty($netquntity) && in_array('118 ML', explode(',',$netquntity))) checked @endif />  118 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="120 ML" @if(!empty($netquntity) && in_array('120 ML', explode(',',$netquntity))) checked @endif />  120 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="300 ML" @if(!empty($netquntity) && in_array('300 ML', explode(',',$netquntity))) checked @endif />  300 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="35-5 ML" @if(!empty($netquntity) && in_array('35-5 ML', explode(',',$netquntity))) checked @endif />  35-5 ML </li>
                                                              <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="500 ML" @if(!empty($netquntity) && in_array('500 ML', explode(',',$netquntity))) checked @endif />  500 ML </li>
                                                              </ul>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4">
                                                             <button type="button" style="float: left;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                    </div>
                                                   @endif
                                                @endif
                                    <!-- end of gender filter -->
                                                   <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class=" filter-product visible" tabindex="100" data-filter="color">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>      
                                                                       
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                              <div class=" filter-product visible" tabindex="100" data-filter="shape">
                                                               
                                                              </div>   
                                                        </div>
                                                    </div>    
                                                </div>

                                                                     
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">




                                                              <div class=" filter-product visible" tabindex="100" data-filter="shape">
                                                                
                                                              </div> 
                                                        </div>
                                                  </div>

                                                
                                            </div> 


                                     <!--         <h3 class="filter-title">MakeStyle</h3>                           
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="checkbox-inline">
                                                                      <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name='make[]' value="metal" @if(!empty($makes) && in_array('metal', explode(',',$makes))) checked @endif>Metal
                                                                      </label>
                                                                </div>
                                                                <div class="checkbox-inline">
                                                                      <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name='make[]' value="shell" @if(!empty($makes) && in_array('shell', explode(',',$makes))) checked @endif>Shell
                                                                      </label>
                                                                </div><br>
                                                                <div class="checkbox-inline">
                                                                      <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name='make[]' value="rimless" @if(!empty($makes) && in_array('rimless', explode(',',$makes))) checked @endif>Remless
                                                                      </label>
                                                                </div>
                                                                <div class="checkbox-inline">
                                                                      <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name='make[]' value="metalplastic" @if(!empty($makes) && in_array('metalplastic', explode(',',$makes))) checked @endif>Metal Plastic
                                                                      </label>
                                                                </div>
                                                        </div>
                                                  </div>

                                                        <div class="col-lg-4">
                                                                 <button type="button" style="float: left;" class="btn btn-primary" name="allfilterApply">Apply</button>
                                                         </div>
                                                
                                            </div>  -->

                                    </div>
                                </div>
                            </div>
                        <!-- hide sidebar category -->
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="product-filter-option">
                                        <h3 class="filter-title">All Categories</h3>
                                        <ul>
                                            @foreach($menus as $menu)
                                                <li>
                                                <span href="#{{$menu->slug}}-1" aria-expanded="false" data-toggle="collapse">
                                                    <i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                                                </span>
                                                    <a href="{{url('/category')}}/{{$menu->slug}}">{{$menu->name}}</a>
                                                    <ul id="{{$menu->slug}}-1" class="collapse">
                                                        @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get() as $submenu)
                                                            <li>
                                                        <span href="#{{$submenu->slug}}-1" aria-expanded="false" data-toggle="collapse">
                                                        <i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                                                        </span>
                                                                <a href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a>
                                                                <ul id="{{$submenu->slug}}-1" class="collapse">
                                                                    @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get() as $childmenu)
                                                                        <li><i class="fa fa-angle-right"></i><a href="{{url('/category')}}/{{$childmenu->slug}}">{{$childmenu->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div> -->

                            <!-- end sidebar category -->

                          <!--  <div class="row">
                                <div class="col-md-12">
                                    <div class="product-filter-option">
                                        <h3 class="filter-title">Tags</h3>
                                        <div class="product-filter-content tags">
                                            @foreach(explode(',',$settings[0]->popular_tags) as $tag)
                                                <a href="{{url('/tags')}}/{{$tag}}">{{$tag}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="product-filter-rightDiv">
                            <div class="row" id="products">
                                @if(isset($products))
                                @forelse($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="single-product-carousel-item text-center">
                                            <div class="image_latest_product_shubh">
                                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                                @php $gallery = $product->gallery_images->toArray(); @endphp
                                                <a class="img-top" href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"> <img src="@if(!empty($gallery)){{url('/assets/images/gallery')}}/{{$gallery[0]['image']}}@endif" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
                                            </div>
                                            <div class="product-carousel-text">
                                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}">
                                                    <h4 class="product-title">{{$product->title}}</h4>
                                                </a>
                                                <div class="ratings">
                                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"><div class="empty-stars"></div></a>
                                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace('/','',strtolower($product->title))}}"><div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div></a>
                                                </div>
                                                <div class="product-price">
                                                  <del class="offer-pricenewone" ><i  title ="Add to My site"class=" fa fa-share-alt" style="font-size:15px"></i></del>
                                                    @if($product->previous_price != "")
                                                        <!--<span class="original-price">₹{{\App\Product::Cost($product->id)}}</span>-->
                                                        <span class="original-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</span>
                                                    @else
                                                    @endif
                                                    <!--<del class="offer-price">₹{{$product->previous_price}}</del>-->
                                                    <!--<del class="offer-pricenew" data="{{$product->id}}"><a data-toggle="modal" data-target="#view_{{$product->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>-->
                                                    @if(Auth::guard('profile')->check())
                                                        @if(Auth::guard('profile')->user()->costpriceshow == 'Yes')
                                                            <del class="offer-pricenew" data="{{$product->id}}"><a data-toggle="modal" data-target="#view_{{$product->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>
                                                        @endif
                                                    @endif
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
                                                        <!-- @if($product->stock != 0 || $product->stock === null )
                                                            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                        @else
                                                            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                                        @endif -->
                                                    </form>
                                                     <!-- model for view Cost Price -->

                                                    <div class="modal fade" id="view_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Product Cost Price</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if($product->costprice == '')
                                                                        <h5>Product Cost Price:- 0</h5>
                                                                    @else
                                                                        <h5>Product Cost Price:- {{$product->costprice}}</h5>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer text-center">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end model for view Cost Price -->
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
                                @endif
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
            </div>
        <!-- Ending of product filter area -->
    </div>



@stop

@section('footer')

<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $('#filterData').on('click', function(){-->
<!--            var lenseSph = document.getElementById('lense-sph').value;-->
<!--            var lenseCyl = document.getElementById('lense-cyl').value;-->
<!--            var lenseAxis = document.getElementById('lense-axis').value;-->
<!--            var lenseLE = document.getElementById('lense-le').value;-->
<!--            var lenseRE = document.getElementById('lense-re').value;-->
<!--            var lensePD = document.getElementById('lense-pd').value;-->
            
<!--            $.ajax({-->
                
<!--            })-->
<!--        })-->
<!--    })-->
<!--</script>-->

<script>
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
    
    
    // SOME CHANGES PROGRESS Nik 18/02/2023
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
</script>

<script>
    var presData = JSON.parse(window.localStorage.getItem("formObject"));
    console.log(presData);
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
</script>

<script>
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
                    console.log(revalue);
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
    
</script>

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
        var lensestype = $('#lenseType').val();
        var radd = $('.ReAddPower').val();
        var rsph = $('.reSphere').val();
        var rcyl = $('.reCyl').val();
        var raxis = $('.reAxis').val();
        var ladd = $('.leAddPower').val();
        var lsph = $('.leSphere').val();
        var lcyl = $('.leCyl').val();
        var laxis = $('.leAxis').val();
        // var ldia = $('#ldiameterlens').val();
        // var rdia = $('#rdiameterlens').val();
        var ldia = "";
        var rdia = "";
        
        
        var role = "{{$category->role}}";
        var sort = $("#sortby").val();
        var colors = '';
        var shapes = '';
        var gender='';
        var makes ='';

        var frametype = '';
        var framematerial = '';
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

        var slug = '';
        var id = '';
        if(role == "child")
        {
            id = "{{$category->id}}";
            slug = sort+"/"+id
            console.log(slug);
            
        }
        else
        {
            slug = "{{$category->slug}}";
            console.log(slug);
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

        window.location = "{{url('/category')}}/"+slug+"?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender+"&frametype="+frametype+"&framematerial="+framematerial+"&lenscolor="+lenscolor+"&size="+size+"&brandname="+brandname+"&lenstype="+lenstype+"&disposability="+disposability+"&packaging="+packaging+"&lensmaterialtype="+lensmaterialtype+"&lenstechnology="+lenstechnology+"&lensindex="+lensindex+"&visioneffect="+visioneffect+"&lensestype="+lensestype+"&radd="+radd+"&rsph="+rsph+"&rcyl="+rcyl+"&raxis="+raxis+"&ladd="+ladd+"&lsph="+lsph+"&lcyl="+lcyl+"&laxis="+laxis+"&ldia="+ldia+"&rdia="+rdia+"&netquntity="+netquntity;
    }

    $("#sortby").change(function () {
        runProductFilter();
    });


    $(document).on('click','input[type=checkbox]', function(){
        runProductFilter();
    })



    $("#load-more").click(function () {
        $("#load").show();
        var slug = "{{$category->slug}}";
        var page = $("#page").val();
        var sort = $("#sortby").val();
        
        // console.log(slug);
        // console.log(page);

        var colors = '';
        var shapes = '';
        var makes ='';
        var gender='';

        var frametype = '';
        var framematerial = '';
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

        $.get("{{url('/')}}/loadcategory/"+slug+"/"+page+"?sort="+sort+"&colors="+colors+"&shapes="+shapes+"&makes="+makes+"&gender="+gender+"&frametype="+frametype+"&framematerial="+framematerial+"&lenscolor="+lenscolor+"&size="+size+"&brandname="+brandname+"&lenstype="+lenstype+"&disposability="+disposability+"&packaging="+packaging+"&lensmaterialtype="+lensmaterialtype+"&lenstechnology="+lenstechnology+"&lensindex="+lensindex+"&visioneffect="+visioneffect, function(data, status){
            $("#load").fadeOut();
            $("#products").append(data);
            $("#page").val(parseInt($("#page").val())+1);
            if ($.trim(data) == ""){
                $("#load-more").fadeOut();
            }

        });
    });
</script>
@stop