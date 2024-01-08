@extends('includes.newmaster')

@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/category.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/test.scss')}}">

<div class="home-wrapper" style="overflow: hidden">
    <div class="container-fluid">
        <section class="bannar-image" style="background: url({{url('/assets')}}/images/categories/{{$category->feature_image}}); border-radius : 1.25rem; background-position: center center; background-repeat: no-repeat; background-size: cover">
            <div class="row margin-left-0 margin-right-0" style="">
                <div style="margin: 0% 0px 0% 0px;">
                    <div class="text-center" style="color: #FFF;padding: 20px;">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Starting of product filter area -->
    <div class="section-padding product-filter-wrapper padding-left-15 wow fadeInUp">
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
                                    </div>
                                    <!-- end search -->
                                    <br>
                                    <!-- price filter -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="product-filter-option-form">
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
                                    @if(isset($cat))
                                        @if($cat == 63) 

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>  

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
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
                                                    <div class="form-group">
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
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Shape</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                            <ul class="items">
                                                                @foreach($frame_shape as $shape)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='shape[]' value="{{$shape->name}}" @if(!empty($shapes) && in_array($shape->name, explode(',',$shapes))) checked @endif> {{$shape->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Material</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                            <ul class="items">
                                                                @foreach($frame_material as $material)
                                                                    <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="{{$material->name}}" @if(!empty($framematerial) && in_array($material->name, explode(',',$framematerial))) checked @endif /> {{$material->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Color</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                            <ul class="items">
                                                                @foreach($frame_color as $color)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='framecolor[]' value="{{$color->name}}" @if(!empty($framecolor) && in_array($color->name, explode(',',$framecolor))) checked @endif> {{$color->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Lense Color</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                            <ul class="items">
                                                                @foreach($lenscolors as $color)
                                                                    <li><input type="checkbox" class="form-check-input" name='color[]' value="{{$color->name}}" @if(!empty($colors) && in_array($color->name, explode(',',$colors))) checked @endif /> {{$color->name}}  </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                        @elseif($cat == 53)

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="padding:3rem;"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            
                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Gender</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='gender'>
                                                            <ul class="items overflow-auto">
                                                                <li><input type="checkbox" class="form-check-input" name='gender[]' value="MEN" @if(!empty($gender) && in_array('MEN', explode(',',$gender))) checked @endif /> Men </li>
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
                                                    <div class="form-group">
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
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Shape</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                            <ul class="items">
                                                                @foreach($frame_shape as $shape)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='shape[]' value="{{$shape->name}}" @if(!empty($shapes) && in_array($shape->name, explode(',',$shapes))) checked @endif> {{$shape->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Material</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                            <ul class="items">
                                                                @foreach($frame_material as $material)
                                                                    <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="{{$material->name}}" @if(!empty($framematerial) && in_array($material->name, explode(',',$framematerial))) checked @endif /> {{$material->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Frame Color</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                            <ul class="items">
                                                                @foreach($frame_color as $color)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='framecolor[]' value="{{$color->name}}" @if(!empty($framecolor) && in_array($color->name, explode(',',$framecolor))) checked @endif> {{$color->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @elseif($cat == 72)

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
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
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
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
                                                    <div class="form-group">
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

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Disposability</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($disposabilities as $dispos)
                                                                    <li><input type="checkbox" class="form-check-input" name='disposability[]' value="{{$dispos->name}}" @if(!empty($disposability) && in_array($dispos->name, explode(',',$disposability))) checked @endif /> {{$dispos->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @elseif($cat == 58)
                                                
                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group" style="display: flex; align-items:center; justify-content: center;">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="outline:none;">
                                                            Product Prescription
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Lens Type</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='visioneffect'>
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
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Index</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensindex'>
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
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                            <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Material</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensmaterialtype'>
                                                            <ul class="items">
                                                                @foreach($lensmaterial as $material)
                                                                    <li><input type="checkbox" class="form-check-input" name='lensmaterialtype[]' value="{{$material->name}}" @if(!empty($lensmaterialtype) && in_array($material->name, explode(',',$lensmaterialtype))) checked @endif />  {{$material->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                            <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Color</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensmaterialtype'>
                                                            <ul class="items">
                                                                @foreach($lenscolors as $color)
                                                                    <li><input type="checkbox" class="form-check-input" name='color[]' value="{{$color->name}}" @if(!empty($colors) && in_array($color->name, explode(',',$colors))) checked @endif /> {{$color->name}}  </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                            <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Coating</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lensmaterialtype'>
                                                            <ul class="items">
                                                                @foreach($lens_coating as $coat)
                                                                    <li><input type="checkbox" class="form-check-input" name='coating[]' value="{{$coat->name}}" @if(!empty($coating) && in_array($coat->name, explode(',',$coating))) checked @endif /> {{$coat->name}}  </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b style="margin-left:3.5rem;">Select Lens Technology</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenstechnology'>
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

                                        @elseif($cat == 82)

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="padding:3rem;"><b>Select Brand Type</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='premiumtype'>
                                                            <ul class="items">
                                                                <li><input type="checkbox" class="form-check-input" name='premiumtype[]' value="Frames" @if(!empty($premiumtype) && in_array('Frames', explode(',',$premiumtype))) checked @endif /> Frames </li>
                                                                <li><input type="checkbox" class="form-check-input" name='premiumtype[]' value="Sunglasses" @if(!empty($premiumtype) && in_array('Sunglasses', explode(',',$premiumtype))) checked @endif />  Sunglasses </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b style="margin-left:3.5rem;">Select Gender</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='gender'>
                                                        <ul class="items">
                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="MEN" @if(!empty($gender) && in_array('MEN', explode(',',$gender))) checked @endif /> MEN </li>
                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="WOMEN" @if(!empty($gender) && in_array('WOMEN', explode(',',$gender))) checked @endif />  WOMEN </li>
                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="KIDS" @if(!empty($gender) && in_array('KIDS', explode(',',$gender))) checked @endif />  KIDS </li>
                                                        <li><input type="checkbox" class="form-check-input" name='gender[]' value="Unisex" @if(!empty($gender) && in_array('Unisex', explode(',',$gender))) checked @endif />  Unisex </li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Type</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='frametype'>
                                                        <ul class="items">
                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Full Rim" @if(!empty($frametype) && in_array('Full Rim', explode(',',$frametype))) checked @endif /> Full Rim </li>
                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Half Rim" @if(!empty($frametype) && in_array('Half Rim', explode(',',$frametype))) checked @endif />  Half Rim </li>
                                                        <li><input type="checkbox" class="form-check-input" name='frametype[]' value="Rim less" @if(!empty($frametype) && in_array('Rim less', explode(',',$frametype))) checked @endif />  Rim less </li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Shape</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='shape'>
                                                            <ul class="items">
                                                                @foreach($frame_shape as $shape)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='shape[]' value="{{$shape->name}}" @if(!empty($shapes) && in_array($shape->name, explode(',',$shapes))) checked @endif> {{$shape->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="margin-left:2.5rem;"><b>Select Frame Material</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='framematerial'>
                                                            <ul class="items">
                                                                @foreach($frame_material as $material)
                                                                    <li><input type="checkbox" class="form-check-input" name='framematerial[]' value="{{$material->name}}" @if(!empty($framematerial) && in_array($material->name, explode(',',$framematerial))) checked @endif /> {{$material->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor" style="padding:2.5rem;"><b>Select Frame Color</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='color'>
                                                            <ul class="items">
                                                                @foreach($frame_color as $color)
                                                                    <li>
                                                                        <input type="checkbox" class="form-check-input" name='framecolor[]' value="{{$color->name}}" @if(!empty($framecolor) && in_array($color->name, explode(',',$framecolor))) checked @endif> {{$color->name}}
                                                                    </li>
                                                                @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            @if(in_array('Sunglasses', explode(',',$premiumtype)))
                                                <div class="row">   
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <span class="anchor" style="padding:3rem;"><b>Select Lense Color</b></span>
                                                            <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                                <ul class="items">
                                                                    @foreach($lenscolors as $color)
                                                                        <li><input type="checkbox" class="form-check-input" name='color[]' value="{{$color->name}}" @if(!empty($colors) && in_array($color->name, explode(',',$colors))) checked @endif /> {{$color->name}}  </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <br>

                                        @elseif($cat == 87)

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <span class="anchor"><b>Select Brand Name</b></span>
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='brandname'>
                                                            <ul class="items">
                                                                @foreach($brands as $brand)
                                                                    <li><input type="checkbox" class="form-check-input" name='brandname[]' value="{{$brand->name}}" @if(!empty($brandname) && in_array($brand->name , explode(',',$brandname))) checked @endif /> {{$brand->name}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">   
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                    <span class="anchor" style="padding:3.5rem;"><b>Net Quantity</b></span>   
                                                        <div class="dropdown-check-list filter-product " tabindex="100" data-filter='lenscolor'>
                                                            <ul class="items">
                                                                @foreach($netQuentities as $quantity)
                                                                    <li><input type="checkbox" class="form-check-input" name='netquntity[]' value="{{$quantity->value}}" @if(!empty($netquntity) && in_array($quantity->value, explode(',',$netquntity))) checked @endif /> {{$quantity->value}}  </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="product-filter-rightDiv">
                        <div class="row" id="products">
                            @if(isset($products))
                                @forelse($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 single_product">
                                        <div class="single-product-carousel-item">
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
                                                        @if($user_profiles->costpriceshow == 'Yes')
                                                            <del class="offer-pricenew" data="{{$product->id}}"><a data-toggle="modal" data-target="#view_{{$product->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>
                                                        @else
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
    </div>
</div>
<input type="hidden" class="categoryvalue" value="{{$category->role}}">
<input type="hidden" class="categoryslug" value="{{$category->slug}}">

@if($category->role == "child")
    <input type="hidden" class="childcategoryid" value="{{$category->id}}">
@endif


<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Lense Prescription</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="LensePrescription" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body" style="padding:10px; display: flex; justify-content: center; align-items: center;">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="col-sm-6" style="padding: 5px;" id="lenseType" name="visioneffect" value="<?php if(!empty($search_type['lensestype'])){ echo $search_type['lensestype'];} ?>">
                                    <option value="">Select Lense Type</option>
                                    <option value="Single Vision">Single Vision</option>
                                    <option value="Biofocal">Biofocal</option>
                                    <option value="Progressive">Progressive</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <br>
                        <table class="table table-bordered" id="pre_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" class="text-center" id="addPower" style="opacity: 0;">ADD</th>
                                    <th colspan="4" class="text-center"><input type="checkbox" id="lecheckbox">&nbsp;LE</th>
                                    <th colspan="4" class="text-center"><input type="checkbox" id="recheckbox">&nbsp;RE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="leaddPowerField" style="opacity: 0;">
                                        <input type="text" name="Lpower" class="leAddPower" value="<?php if(!empty($search_type['ladd'])){ echo $search_type['ladd'];} ?>" style="width: 60px;">
                                    </td>
                                    <td id="readdPowerField" style="opacity: 0;">
                                        <input type="text" name="rpower" class="ReAddPower" value="<?php if(!empty($search_type['radd'])){echo $search_type['radd'];} ?>" style="width: 60px;">
                                    </td>
                                    <td id="leSphere">SPH</i></td>
                                    <td id="leCylinder">CYL</td>
                                    <td id="leAxis">AXIS</td>
                                    <td id="leAxis">VA</td>
                                    <td id="reSphere">SPH</td>
                                    <td id="reCylinder">CYL</td>
                                    <td id="reAxis">AXIS</td>
                                    <td id="reAxis">VA</td>
                                </tr>
                                <tr class="distance">
                                    <td colspan="2" class="text-center">Distance</td>
                                    <td class="text-center">
                                        <input type="text" name="Lsphere" class="leSphere" value="<?php if(!empty($search_type['lsph'])){ echo $search_type['lsph'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="Lcyle" class="leCyl" value="<?php if(!empty($search_type['lcyl'])){ echo $search_type['lcyl'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="Laxis" class="leAxis" value="<?php if(!empty($search_type['laxis'])){ echo $search_type['laxis'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="lva" class="leva" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="rsphere" class="reSphere" value="<?php if(!empty($search_type['rsph'])){ echo $search_type['rsph'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="rcyl" class="reCyl" value="<?php if(!empty($search_type['rcyl'])){ echo $search_type['rcyl'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="Raxis" class="reAxis" value="<?php if(!empty($search_type['raxis'])){ echo $search_type['raxis'];} ?>" style="width: 60px;">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="rva" class="reva" style="width: 60px;">
                                    </td>
                                </tr>
                                
                                <tr class="reading">
                                    <td colspan="2" class="text-center readingText">Reading</td>
                                    <td class="text-center">
                                        <input type="text" class="lsph" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="lcyl" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="laxis" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="readinglva" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="rsph" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="rcyl" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="raxis" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="readingrva" style="width: 60px;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr id="addPowerField" style="opacity: 0;">
                                    <td colspan="4" class="text-center">
                                        Total PD
                                        <input type="text" name="totalPd" class="totalPd" style="width: 70px">
                                    </td>
                                    <td colspan="3" class="text-center">
                                        LE PD
                                        <!--<input type="text" name="lePd" class="lePd" style="width: 70px">-->
                                        <select type="text" name="Lepd" class="lePd" style="width: 70px">
                                            <option value="0" >Select Left PD<option/>
                                            @foreach($left_pd as $pd)
                                                <option value="{{$pd->left_pd}}">{{$pd->left_pd}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="3" class="text-center">
                                        RE PD
                                        <select type="text" name="Repd" class="rePd" style="width: 70px">
                                            <option value="0" >Select Left PD<option/>
                                            @foreach($left_pd as $pd)
                                                <option value="{{$pd->right_pd}}">{{$pd->right_pd}}</option>
                                            @endforeach
                                        </select>
                                        <!--<input type="text" name="rePd" class="rePd" style="width: 70px">-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: baseline;">
        <!--            <div class="input-group">-->
    				<!--	<label for="uploadFile" class="uploadImage">-->
    				<!--	    <p class="showImageData">file type - png, jpg, gif, jpeg !</p>-->
    				<!--	    Upload File-->
    				<!--	</label>-->
    				<!--	<input type="file" name="pres_img" id="uploadFile" accept="image/png, image/jpg, image/gif, image/jpeg"  class="upload">-->
    				<!--</div>-->
    				<!--<div class="input-group img-div" style="display:none;">-->
    				<!--	<img  id="showFile" src="" style="width:100px; height:80px;">-->
    				<!--</div>-->
                    <button type="submit" class="btn btn-success" id="getPrescription" style="outline:none; width: 80px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="filterbuttondiv">
    <button class="mobilefilter"><i class="fa fa-filter"></i> &nbsp; Filter</button>
</div>

@stop

@section('footer')

<script src="{{URL::asset('assets/js/category.js')}}"></script>

@stop