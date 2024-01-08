@extends('admin.includes.master-admin')
<style type="text/css">
    .error{
        padding-left: 310px;
    }
       input[type="file"] {
  display: block;
}

.image-upload-one{
    grid-area: img-u-one;
    display: flex;
    justify-content: center;
  }
  .image-upload-two{
    grid-area: img-u-two;
    display: flex;
    justify-content: center;
  }
  .image-upload-three{
    grid-area: img-u-three;
    display: flex;
    justify-content: center;
  }
  .image-upload-four{
    grid-area: img-u-four;
    display: flex;
    justify-content: center;
  }
  .image-upload-five{
    grid-area: img-u-five;
    display: flex;
    justify-content: center;
  }
  .image-upload-six{
    grid-area: img-u-six;
    display: flex;
    justify-content: center;
  }

  .image-upload-container{
    display: grid;
    grid-template-areas: 'img-u-one img-u-two img-u-three img-u-four img-u-five img-u-six';
  }
  .center {
    display:inline;
    margin: 3px;
  }

  .form-input {
    width:150px;
    padding:3px;
    background:#fff;
    border:2px dashed dodgerblue;
  }
  
  .form-input label {
    display:block;
    width:140px;
    height: auto;
    max-height: 100px;
    background:#333;
    border-radius:10px;
    cursor:pointer;
  }
  
  .form-input img {
    width:135px;
    height: 100px;
    margin: 2px;
   /* opacity: .4;*/
  }

  .imgRemove{
    position: relative;
    bottom: 114px;
    left: 68%;
    background-color: transparent;
    border: none;
    font-size: 30px;
    outline: none;
  }
  .imgRemove::after{
    content: ' \21BA';
    color: #fff;
    font-weight: 900;
    border-radius: 8px;
    cursor: pointer;
  }

  .small{
    color: #fff;
  }

  table, th, td {
  border:1px solid black;
}

  @media only screen and (max-width: 700px){
    .image-upload-container{
      grid-template-areas: 'img-u-one img-u-two img-u-three'
       'img-u-four img-u-five img-u-six';
    }
  }
</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/products') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <div class="text-left">
                            <label style="padding-left: 180px;">Fetch From Id </label>
                            <input style="margin-left: 35px;" type="number" name="id">
                            
                        </div><br>
                        <form method="POST" action="{!! action('ProductController@store') !!}" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}
                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stock Id<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div> -->

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" required="required" value="{{old('title')}}" type="text">
                                </div>
                            </div>
                            <div class="error">
                                 @if ($errors->has('title'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" required>
                                        <option value="">Select Main Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="subid[]" id="subs" disabled>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="childid[]" id="childs" disabled>
                                        <option value="">Select Child Category</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- <div class="item form-group" id="cateonenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category-1<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="cateone" id="cateone" required>
                                        <option value="">Select Category-1</option>
                                        <option value="CAT 1">CAT 1</option>
                                        <option value="GBF">GBF</option>
                                        <option value="GBH">GBH</option>
                                        <option value="GFSV">GFSV</option>
                                    </select>
                                </div>
                            </div> -->
                            
                             <!-- <div class="item form-group" id="catetwonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category-2 </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control" name="catetwo" id="catetwo" >
                                        <option value="">Select Category-2</option>
                                        <option value="DBF" {{ old('catetwo') == "DBF" ? 'selected' : '' }} >DBF</option>
                                        <option value="CAT2" {{ old('catetwo') == "CAT2" ? 'selected' : '' }}>CAT2</option>
                                        <option value="THICK SIDE" {{ old('catetwo') == "THICK SIDE" ? 'selected' : '' }}>THICK SIDE </option>
                                        <option value="CLEAR" {{ old('catetwo') == "CLEAR" ? 'selected' : '' }}>CLEAR</option>
                                    </select>
                                </div>
                            </div> -->
                            
                               <!-- <div class="item form-group" id="makenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Make<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control" name="make" id="make" required>
                                        <option value="">Select Make</option>
                                        <option value="METAL">METAL</option>
                                        <option value="SHELL">SHELL</option>
                                        <option value="RIMLESS">RIMLESS</option>
                                        <option value="METAL PLASTIC">METAL PLASTIC</option>
                                    </select>
                                </div>
                            </div> -->
                            
                               <div class="item form-group" id="shapenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Shape </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="shape" id="shape" >
                                        <option value="">Select Shape</option>
                                        <option value="Round" {{ old('shape') == "Round" ? 'selected' : '' }}>Round</option>
                                        <option value="Square" {{ old('shape') == "Square" ? 'selected' : '' }}>Square</option>
                                        <option value="Oval" {{ old('shape') == "Oval" ? 'selected' : '' }}>Oval</option>
                                        <option value="Rectangle" {{ old('shape') == "Rectangle" ? 'selected' : '' }}>Rectangle</option>
                                        <option value="Cat eye" {{ old('shape') == "Cat eye" ? 'selected' : '' }}>Cat eye</option>
                                        <option value="Geometric" {{ old('shape') == "Geometric" ? 'selected' : '' }}>Geometric</option>
                                        <option value="Brow line" {{ old('shape') == "Brow line" ? 'selected' : '' }}>Brow line</option>
                                        <option value="Aviator" {{ old('shape') == "Aviator" ? 'selected' : '' }}>Aviator</option>
                                        <option value="Wayfarer" {{ old('shape') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>
                                        <option value="Pilot" {{ old('shape') == "Pilot" ? 'selected' : '' }}>Pilot</option>
                                        <option value="Wrap" {{ old('shape') == "Wrap" ? 'selected' : '' }}>Wrap</option>
                                        <option value="Wayfarer" {{ old('shape') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>
                                        <option value="Oversized" {{ old('shape') == "Oversized" ? 'selected' : '' }}>Oversized</option>
                                    </select>
                                </div>
                            </div>
                            
                               <div class="item form-group" id="colornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Color </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
                                        <option value="">Select Color</option>
                                        <option value="BLACK" {{ old('color') == "BLACK" ? 'selected' : '' }}>BLACK</option>
                                        <option value="GOLDEN" {{ old('color') == "GOLDEN" ? 'selected' : '' }}>GOLDEN</option>
                                        <option value="WHITE" {{ old('color') == "WHITE" ? 'selected' : '' }}>WHITE</option>
                                        <option value="BROWN" {{ old('color') == "BROWN" ? 'selected' : '' }}>BROWN</option>
                                        <option value="RED" {{ old('color') == "RED" ? 'selected' : '' }}>RED</option>
                                        <option value="Tortoise" {{ old('color') == "Tortoise" ? 'selected' : '' }}>Tortoise</option>
                                        <option value="Blue" {{ old('color') == "Blue" ? 'selected' : '' }}>Blue</option>
                                        <option value="Silver" {{ old('color') == "Silver" ? 'selected' : '' }}>Silver</option>
                                        <option value="Grey" {{ old('color') == "Grey" ? 'selected' : '' }}>Grey</option>
                                        <option value="Gunmetal" {{ old('color') == "Gunmetal" ? 'selected' : '' }}>Gunmetal</option>
                                        <option value="Pink" {{ old('color') == "Pink" ? 'selected' : '' }}>Pink</option>
                                        <option value="Beige" {{ old('color') == "Beige" ? 'selected' : '' }}>Beige</option>
                                        <option value="green" {{ old('color') == "green" ? 'selected' : '' }}>green</option>
                                        <option value="Purple" {{ old('color') == "Purple" ? 'selected' : '' }}>Purple</option>
                                        <option value="Multicolor" {{ old('color') == "Multicolor" ? 'selected' : '' }}>Multicolor</option>
                                        <option value="Rose Gold" {{ old('color') == "Rose Gold" ? 'selected' : '' }}>Rose Gold</option>
                                        <option value="yellow" {{ old('color') == "yellow" ? 'selected' : '' }}>yellow</option>
                                        <option value="Orange" {{ old('color') == "Orange" ? 'selected' : '' }}>Orange</option>
                                        <option value="Glitter" {{ old('color') == "Glitter" ? 'selected' : '' }}>Glitter</option>
                                        <option value="Maroon" {{ old('color') == "Maroon" ? 'selected' : '' }}>Maroon</option>
                                        <option value="Transparent" {{ old('color') == "Transparent" ? 'selected' : '' }}>Transparent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control" multiple="multiple" name="gender[]" id="gender" >
                                        <option value="">Select Gender</option>
                                        <option value="MEN" {{ old('gender') == "MEN" ? 'selected' : '' }} >Male</option>
                                        <option value="WOMEN" {{ old('gender') == "WOMEN" ? 'selected' : '' }}>Female</option>
                                        <option value="KIDS" {{ old('gender') == "KIDS" ? 'selected' : '' }}>Kids</option>
                                        <option value="Unisex" {{ old('gender') == "Unisex" ? 'selected' : '' }}>Unisex</option>
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname">
                                        <option value="">Select Brand</option>
                                        <option value="Alcon" {{ old('brandname') == "Alcon" ? 'selected' : '' }} >Alcon</option>
                                        <option value="johnson and johnson" {{ old('brandname') == "johnson and johnson" ? 'selected' : '' }}>Johnson And Johnson</option>
                                        <option value="bausch and lomb" {{ old('brandname') == "bausch and lomb" ? 'selected' : '' }}>Bausch And Lomb</option>
                                        <option value="cooper vision" {{ old('brandname') == "Cooper Vision" ? 'selected' : '' }}>Cooper Vision</option>
                                        <option value="CL India" {{ old('brandname') == "CL India" ? 'selected' : '' }}>CL India</option>
                                        <option value="Asian Eyewear" {{ old('brandname') == " Asian Eyewear" ? 'selected' : '' }}> Asian Eyewear</option>
                                        <option value="Vision Care Lab" {{ old('brandname') == "Vision Care Lab" ? 'selected' : '' }}>Vision Care Lab</option>
                                        <option value="Zeiss" {{ old('brandname') == "Zeiss" ? 'selected' : '' }}>Zeiss</option>
                                        <option value="Hoya" {{ old('brandname') == "Hoya" ? 'selected' : '' }}>Hoya</option>
                                        <option value="Purvesh" {{ old('brandname') == "Purvesh" ? 'selected' : '' }}>Purvesh</option>
                                        <option value="Prime" {{ old('brandname') == "Prime" ? 'selected' : '' }}>Prime</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <!-- Start new input fields added as per category  -->

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Model No</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{old('modelno')}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Seller Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{old('sellername')}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sku</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{old('productsku')}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text">
                                </div>
                            </div>

                            <!-- <div class="item form-group" id="framestylenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Style</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framestyle" id="framestyle" required>
                                        <option value="">Select Frame Style</option>
                                        <option value="Cat eye" {{ old('framestyle') == "Cat eye" ? 'selected' : '' }}>Cat eye</option>
                                        <option value="Geometric" {{ old('framestyle') == "Geometric" ? 'selected' : '' }}>Geometric</option>
                                        <option value="Brow line" {{ old('framestyle') == "Brow line" ? 'selected' : '' }}>Brow line</option>
                                        <option value="Aviator" {{ old('framestyle') == "Aviator" ? 'selected' : '' }}>Aviator</option>
                                        <option value="Wayfarer" {{ old('framestyle') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>
                                        <option value="Pilot" {{ old('framestyle') == "Pilot" ? 'selected' : '' }}>Pilot</option>
                                        <option value="Wrap" {{ old('framestyle') == "Wrap" ? 'selected' : '' }}>Wrap</option>
                                        <option value="Wayfarer" {{ old('framestyle') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>
                                        <option value="Oversized" {{ old('framestyle') == "Oversized" ? 'selected' : '' }}>Oversized</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial" required>
                                        <option value="">Select Frame Material</option>
                                        <option value="Plastic" {{ old('framematerial') == "Plastic" ? 'selected' : '' }}>Plastic</option>
                                        <option value="Acetate" {{ old('framematerial') == "Acetate" ? 'selected' : '' }}>Acetate</option>
                                        <option value="Metal" {{ old('framematerial') == "Metal" ? 'selected' : '' }}>Metal</option>
                                        <option value="Stainless Steel" {{ old('framematerial') == "Stainless Steel" ? 'selected' : '' }}>Stainless Steel</option>
                                        <option value="Titanium" {{ old('framematerial') == "Titanium" ? 'selected' : '' }}>Titanium</option>
                                        <option value="TR90" {{ old('framematerial') == "TR90" ? 'selected' : '' }}>TR90</option>
                                        <option value="Ultem" {{ old('framematerial') == "Ultem" ? 'selected' : '' }}>Ultem</option>
                                        <option value="Wood" {{ old('framematerial') == "Wood" ? 'selected' : '' }}>Wood</option>
                                        <option value="Monel" {{ old('framematerial') == "Monel" ? 'selected' : '' }}>Monel</option>
                                        <option value="Aluminium" {{ old('framematerial') == "Aluminium" ? 'selected' : '' }}>Aluminium</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framewidth" value="{{old('framewidth')}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="prescriptiontypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Prescription Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="prescriptiontype" value="{{old('prescriptiontype')}}" class="form-control col-md-7 col-xs-12" name="prescriptiontype" placeholder="Enter Prescription Type" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{old('height')}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Enter Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usages" value="{{old('usages')}}" class="form-control col-md-7 col-xs-12" name="usages" placeholder="Enter Usages" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="{{old('usagesduration')}}" class="form-control col-md-7 col-xs-12" name="usagesduration" placeholder="Enter Usages Duration" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="{{old('templematerial')}}" class="form-control col-md-7 col-xs-12" name="templematerial" placeholder="Temple Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="{{old('templecolor')}}" class="form-control col-md-7 col-xs-12" name="templecolor" placeholder="Temple Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype">
                                        <option value="">Select Lens Material</option>
                                        <option value="CR-39" {{ old('lensmaterialtype') == "CR-39" ? 'selected' : '' }}>CR-39</option>
                                        <option value="MR-8" {{ old('lensmaterialtype') == "MR-8" ? 'selected' : '' }}>MR-8</option>
                                        <option value="PNX" {{ old('lensmaterialtype') == "PNX" ? 'selected' : '' }}>PNX</option>
                                        <option value="Trivex" {{ old('lensmaterialtype') == "Trivex" ? 'selected' : '' }}>Trivex</option>
                                        <option value="Blue Cantrol" {{ old('lensmaterialtype') == "Blue Cantrol" ? 'selected' : '' }}>Blue Cantrol</option>
                                        <option value="Tribrid" {{ old('lensmaterialtype') == "Tribrid" ? 'selected' : '' }}>Tribrid</option>
                                        <option value="High Index Plastic" {{ old('lensmaterialtype') == "High Index Plastic" ? 'selected' : '' }}>High Index Plastic</option>
                                        <option value="Polycarbonate" {{ old('lensmaterialtype') == "Polycarbonate" ? 'selected' : '' }}>Polycarbonate</option>
                                        <option value="Crown Glass" {{ old('lensmaterialtype') == "Crown Glass" ? 'selected' : '' }}>Crown Glass</option>
                                        <option value="MR-7" {{ old('lensmaterialtype') == "MR-7" ? 'selected' : '' }}>MR-7</option>
                                        <option value="PGX" {{ old('lensmaterialtype') == "PGX" ? 'selected' : '' }}>PGX</option>
                                        <option value="PBX" {{ old('lensmaterialtype') == "PBX" ? 'selected' : '' }}>PBX</option>
                                        <option value="Mid Index" {{ old('lensmaterialtype') == "Mid Index" ? 'selected' : '' }}>Mid Index</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="leanscoatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="leanscoating" value="{{old('leanscoating')}}" class="form-control col-md-7 col-xs-12" name="leanscoating" placeholder="Lens coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Diameter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="diameter" value="{{old('diameter')}}" class="form-control col-md-7 col-xs-12" name="diameter" placeholder="Enter Diameter" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="{{old('contactlensmaterialtype')}}" class="form-control col-md-7 col-xs-12" name="contactlensmaterialtype" placeholder="Contact Lens Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Base Curve</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="basecurve" value="{{old('basecurve')}}" class="form-control col-md-7 col-xs-12" name="basecurve" placeholder="Base Curve" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{old('watercontent')}}" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sphere Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="power" value="{{old('power')}}" class="form-control col-md-7 col-xs-12" name="power" placeholder="Enter Sphere Power" type="text">
                                </div>
                            </div>
                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" class="form-control col-md-7 col-xs-12" value="{{old('centerthiknessnew')}}" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="cylindernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cylinder" value="{{old('cylindernew')}}" class="form-control col-md-7 col-xs-12" name="cylindernew" placeholder="Enter Cylinder" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="axisnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="axis" value="{{old('axisnew')}}" class="form-control col-md-7 col-xs-12" name="axisnew" placeholder="Enter Axis" type="text">
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Disposability</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability" required>
                                        <option value="">Select Disposability</option>
                                        <option value="Daily" {{ old('disposability') == "Daily" ? 'selected' : '' }}>Daily</option>
                                        <option value="Weekly" {{ old('disposability') == "Weekly" ? 'selected' : '' }}>Weekly</option>
                                        <option value="Monthly" {{ old('disposability') == "Monthly" ? 'selected' : '' }}>Monthly</option>
                                        <option value="Yearly" {{ old('disposability') == "Yearly" ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Packaging</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging" required>
                                        <option value="">Select Packaging</option>
                                        <option value="1 Lens Per Box" {{ old('packaging') == "1 Lens Per Box" ? 'selected' : '' }}>1 Lens Per Box</option>
                                        <option value="2 Lens Per Box" {{ old('packaging') == "2 Lens Per Box" ? 'selected' : '' }}>2 Lens Per Box</option>
                                        <option value="3 Lens Per Box" {{ old('packaging') == "3 Lens Per Box" ? 'selected' : '' }}>3 Lens Per Box</option>
                                        <option value="5 Lens Per Box" {{ old('packaging') == "5 Lens Per Box" ? 'selected' : '' }}>5 Lens Per Box</option>
                                        <option value="6 Lens Per Box" {{ old('packaging') == "6 Lens Per Box" ? 'selected' : '' }}>6 Lens Per Box</option>
                                        <option value="10 Lens Per Box" {{ old('packaging') == "10 Lens Per Box" ? 'selected' : '' }}>10 Lens Per Box</option>
                                        <option value="12 Lens Per box" {{ old('packaging') == "12 Lens Per Box" ? 'selected' : '' }}>12 Lens Per box</option>
                                        <option value="30 Lens Per Box" {{ old('packaging') == "30 Lens Per Box" ? 'selected' : '' }}>30 Lens Per Box</option>
                                        <option value="90 Lens Per Box" {{ old('packaging') == "90 Lens Per Box" ? 'selected' : '' }}>90 Lens Per Box</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="">Select Color</option>
                                        <option value="grey" {{ old('lenscolor') == "grey" ? 'selected' : '' }}>Grey</option>
                                        <option value="blue" {{ old('lenscolor') == "blue" ? 'selected' : '' }}>Blue</option>
                                        <option value="green" {{ old('lenscolor') == "green" ? 'selected' : '' }}>Green</option>
                                        <option value="brown" {{ old('lenscolor') == "brown" ? 'selected' : '' }}>Brown</option>
                                        <option value="yellow" {{ old('lenscolor') == "yellow" ? 'selected' : '' }}>Yellow</option>
                                        <option value="pink" {{ old('lenscolor') == "pink" ? 'selected' : '' }}>Pink</option>
                                        <option value="black" {{ old('lenscolor') == "black" ? 'selected' : '' }}>Black</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="conditionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Conditions</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="condition" value="{{old('conditionsnew')}}" class="form-control col-md-7 col-xs-12" name="conditionsnew" placeholder="Conditions" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="lenstechnology[]" id="lenstechnology" >
                                        <option value="">Select Lens Technology</option>
                                        <option value="Mirror Coating" {{ old('lenstechnology') == "Mirror Coating" ? 'selected' : '' }}>Mirror Coating</option>
                                        <option value="Scratch Resistant Coating" {{ old('lenstechnology') == "Scratch Resistant Coating" ? 'selected' : '' }}>Scratch Resistant Coating</option>
                                        <option value="Anti-Fog Coating" {{ old('lenstechnology') == "Anti-Fog Coating" ? 'selected' : '' }}>Anti-Fog Coating</option>
                                        <option value="Anti-Reflective Coating" {{ old('lenstechnology') == "Anti-Reflective Coating" ? 'selected' : '' }}>Anti-Reflective Coating</option>
                                        <option value="Water Resistant Coating" {{ old('lenstechnology') == "Water Resistant Coating" ? 'selected' : '' }}>Water Resistant Coating</option>
                                        <option value="UV Protection Coating" {{ old('lenstechnology') == "UV Protection Coating" ? 'selected' : '' }}>UV Protection Coating</option>
                                        <option value="Blue Control Coating" {{ old('lenstechnology') == "Blue Control Coating" ? 'selected' : '' }}>Blue Control Coating</option>
                                        <option value="Polarized" {{ old('lenstechnology') == "Polarized" ? 'selected' : '' }}>Polarized</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex" required>
                                        <option value="">Select Lens Index</option>
                                        <option value="1.49" {{ old('lensindex') == "1.49" ? 'selected' : '' }}>1.49</option>
                                        <option value="1.5" {{ old('lensindex') == "1.5" ? 'selected' : '' }}>1.5</option>
                                        <option value="1.53" {{ old('lensindex') == "1.53" ? 'selected' : '' }}>1.53</option>
                                        <option value="1.55" {{ old('lensindex') == "1.55" ? 'selected' : '' }}>1.55</option>
                                        <option value="1.56" {{ old('lensindex') == "1.56" ? 'selected' : '' }}>1.56</option>
                                        <option value="1.59" {{ old('lensindex') == "1.59" ? 'selected' : '' }}>1.59</option>
                                        <option value="1.6" {{ old('lensindex') == "1.6" ? 'selected' : '' }}>1.6</option>
                                        <option value="1.61" {{ old('lensindex') == "1.61" ? 'selected' : '' }}>1.61</option>
                                        <option value="1.67" {{ old('lensindex') == "1.67" ? 'selected' : '' }}>1.67</option>
                                        <option value="1.7" {{ old('lensindex') == "1.7" ? 'selected' : '' }}>1.7</option>
                                        <option value="1.74" {{ old('lensindex') == "1.74" ? 'selected' : '' }}>1.74</option>
                                        <option value="1.8" {{ old('lensindex') == "1.8" ? 'selected' : '' }}>1.8</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="gravitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" value="{{old('gravity')}}" class="form-control col-md-7 col-xs-12" name="gravity" placeholder="Enter Gravity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powerrangenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Power Range</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="powerange" value="{{old('powerrange')}}" class="form-control col-md-7 col-xs-12" name="powerrange" placeholder="Enter Power Range" type="text">
                                </div>
                            </div>

                            <!-- <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" required>
                                        <option value="">Select Lens Power</option>
                                        <option value="Biofocal" {{ old('visioneffect') == "Biofocal" ? 'selected' : '' }}>Biofocal</option>
                                        <option value="Progressive" {{ old('visioneffect') == "Progressive" ? 'selected' : '' }}>Progressive</option>
                                        <option value="Zero Power" {{ old('visioneffect') == "Zero Power" ? 'selected' : '' }}>Zero Power</option>
                                        <option value="single Vision" {{ old('visioneffect') == "single Vision" ? 'selected' : '' }}>single Vision</option>
                                    </select>
                                </div>
                            </div> -->
                                       <!-- coating area -->
                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="coating[]" id="coating" >
                                        <option value="">Select Coating</option>
                                        <option value="hardcoat" {{ old('coating') == "hardcoat" ? 'selected' : '' }}>hardcoat</option>
                                        <option value="Anti Reflection coating" {{ old('Anti Reflection coating') == "Anti Reflection coating" ? 'selected' : '' }}>Anti Reflection coating</option>
                                        <option value="Blue Cantrol" {{ old('Blue Cantrol ') == "Blue Cantrol " ? 'selected' : '' }}>Blue Cantrol </option>
                                        <option value="Anti fog" {{ old('Anti fog  ') == "Anti fog  " ? 'selected' : '' }}>Anti fog </option>
                                        <option value=" Photochromatic" {{ old(' Photochromatic ') == " Photochromatic " ? 'selected' : '' }}> Photochromatic</option>
                                    </select>
                                </div>
                            </div>
                                         <!-- coating area end -->
                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                        <option value="">Select Lens Type</option>
                                        <option value="Biofocal" {{ old('lenstype') == "Biofocal" ? 'selected' : '' }}>Biofocal</option>
                                        <option value="Progressive" {{ old('lenstype') == "Progressive" ? 'selected' : '' }}>Progressive</option>
                                        <option value="Zero Power" {{ old('lenstype') == "Zero Power" ? 'selected' : '' }}>Zero Power</option>
                                        <option value="single Vision" {{ old('lenstype') == "single Vision" ? 'selected' : '' }}>single Vision</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Contact Lense Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" >
                                        <option value="">Select contact lense type </option>
                                        <option value="Spherical" {{ old('visioneffect') == "Spherical" ? 'selected' : '' }}>Spherical</option>
                                        <option value="MultiFocal" {{ old('visioneffect') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>
                                        <option value="toric & Astigmatism" {{ old('visioneffect') == "toric & Astigmatism" ? 'selected' : '' }}>toric & Astigmatism</option>
                                        <option value="No Power" {{ old('visioneffect') == "No Power" ? 'selected' : '' }}>No Power</option>
                                        <option value="Color Lenses" {{ old('visioneffect') == "Color Lenses" ? 'selected' : '' }}>Color Lenses</option>
                                        <option value="ColorWithPower" {{ old('visioneffect') == "ColorWithPower" ? 'selected' : '' }}>ColorWithPower</option>

                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="addpower" value="{{old('addpower')}}" class="form-control col-md-7 col-xs-12" name="addpower" placeholder="Enter Power" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" value="{{old('coatingcolor')}}" class="form-control col-md-7 col-xs-12" name="coatingcolor" placeholder="Enter Coating Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" value="{{old('abbevalue')}}" class="form-control col-md-7 col-xs-12" name="abbevalue" placeholder="Enter Abbe Value" type="text">
                                </div>
                            </div> 

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" value="{{old('netquntity')}}" class="form-control col-md-7 col-xs-12" name="netquntity" placeholder="Enter Net Quantity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="{{old('focallength')}}" class="form-control col-md-7 col-xs-12" name="focallength" placeholder="Enter Focal Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pack Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packtype" value="{{old('packtype')}}" class="form-control col-md-7 col-xs-12" name="packtype" placeholder="Enter Pack Type" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Shelf Life</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="{{old('shelflife')}}" class="form-control col-md-7 col-xs-12" name="shelflife" placeholder="Enter Shelf Life" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="formnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Form</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="form" value="{{old('form')}}" class="form-control col-md-7 col-xs-12" name="form" placeholder="Enter Form" type="text">
                                </div>
                            </div>

                            
                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="{{old('productcolor')}}" class="form-control col-md-7 col-xs-12" name="productcolor" placeholder="Enter Product Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="{{old('productdim')}}" class="form-control col-md-7 col-xs-12" name="productdim" placeholder="Enter Product Dimension" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="{{old('material')}}" class="form-control col-md-7 col-xs-12" name="material" placeholder="Enter Product Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="frametype" id="frametype" required>
                                        <option value="">Select Frame Type</option>
                                        <option value="fullrim" {{ old('frametype') == "Full Rim" ? 'selected' : '' }}>Full Rim</option>
                                        <option value="halfrim" {{ old('frametype') == "Half Rim" ? 'selected' : '' }}>Half Rim</option>
                                        <option value="rimless" {{ old('frametype') == "Rimless" ? 'selected' : '' }}>Rimless</option>
                                    </select>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>
                             <div class="item form-group" id="manufracturernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" value="{{old('manufracturer')}}" class="form-control col-md-7 col-xs-12" name="manufracturer" placeholder=" Enter Manufracturer" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" value="{{old('warrentytype')}}" class="form-control col-md-7 col-xs-12" name="warrentytype" placeholder="Warrenty Type" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew"> 
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" value="{{old('productdimension')}}" class="form-control col-md-7 col-xs-12" name="productdimension" placeholder="Frame Dimension"  type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Weight</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" value="{{old('weight')}}" class="form-control col-md-7 col-xs-12" name="weight" placeholder="weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country Of Origin</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="countryoforigin" id="countryoforigin" required>
                                        <option value="">Select Country Of Origin</option>
                                        @foreach($countryoforigin as $item)
                                        @if (old('countryoforigin') == $item->name)
                                            <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endif
                                          <!-- <option value="{{ $item->name }}">{{ $item->name }}</option> -->
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="hsncodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="{{old('hsncode')}}"  id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" placeholder="Hsn Code" type="text">
                                </div>
                            </div>

                                
<!-- 
                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Upload Video<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div> -->                            

                             <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HSN Code<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                  <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="photo" type="file" required>
                                </div>
                            </div>
                            <div class="error">
                                 @if ($errors->has('photo'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video1
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                           <!--      <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added">
                                </div> -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video" type="file" >
                                </div>
                            </div>
                            <br>
                            <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video2
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                           <!--      <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added">
                                </div> -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video1" type="file" >
                                </div>
                            </div>
                            <br>
                            <!-- <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video3
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                           <!--      <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added">
                                </div> -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video2" type="file" >
                                </div>
                            </div>
                            <br>
                            <!-- <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div> -->

<label class="control-label col-md-1 col-sm-1 col-xs-10" for="number"> Product Gallery Images <span class="required">*</span>
                         <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                            </label>
                            
                            <div class="image-upload-container">
                                  <div class="image-upload-one">
                                    <div class="center">
                                      <div class="form-input">
                                        <label for="file-ip-1">
                                          <img id="file-ip-1-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                          <button type="button" class="imgRemove" onclick="myImgRemove(1)"></button>
                                        </label>
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-1" accept="image/*" class="imagevalidation" data-image_val="1"  onchange="showPreview(event, 1);">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- ************************************************************************************************************ -->
                                  <div class="image-upload-two">
                                    <div class="center">
                                      <div class="form-input">
                                        <label for="file-ip-2">
                                          <img id="file-ip-2-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                          <button type="button" class="imgRemove" onclick="myImgRemove(2)"></button>
                                        </label>
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-2" class="imagevalidation" data-image_val="2" accept="image/*" onchange="showPreview(event, 2);">
                                      </div>
                                    </div>
                                  </div>

                                  <!-- ************************************************************************************************************ -->
                                  <div class="image-upload-three">
                                    <div class="center">
                                      <div class="form-input">
                                        <label for="file-ip-3">
                                          <img id="file-ip-3-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                          <button type="button" class="imgRemove" onclick="myImgRemove(3)"></button>
                                        </label>
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-3" class="imagevalidation" data-image_val="3" accept="image/*" onchange="showPreview(event, 3);">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- *********************************************************************************************************** -->
                                    <div class="image-upload-four">
                                      <div class="center">
                                        <div class="form-input">
                                          <label for="file-ip-4">
                                            <img id="file-ip-4-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                            <button type="button" class="imgRemove" onclick="myImgRemove(4)"></button>
                                          </label>
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-4" class="imagevalidation" data-image_val="4"accept="image/*" onchange="showPreview(event, 4);">
                                        </div>
                                      </div>
                                    </div>
                                    <!-- ************************************************************************************************************ -->
                                    <div class="image-upload-five">
                                      <div class="center">
                                        <div class="form-input">
                                          <label for="file-ip-5">
                                            <img id="file-ip-5-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                            <button type="button" class="imgRemove" onclick="myImgRemove(5)"></button>
                                          </label>
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-5"class="imagevalidation" data-image_val="5" accept="image/*" onchange="showPreview(event, 5);">
                                        </div>
                                      </div>
                                    </div>
                              
                                    <!-- ************************************************************************************************************ -->
                                    <div class="image-upload-six">
                                      <div class="center">
                                        <div class="form-input">
                                          <label for="file-ip-6">
                                            <img id="file-ip-6-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                            <button type="button" class="imgRemove" onclick="myImgRemove(6)"></button>
                                          </label>
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-6" class="imagevalidation" data-image_val="6" accept="image/*" onchange="showPreview(event, 6);">
                                        </div>
                                      </div>
                                    </div>

                                  <!-- ************************************************************************************************************** -->
                                </div><br>
    
<!-- 
                                            <div class="field" align="left">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Product Gallery Images <span class="required">*</span>
                                            <p class="small-label">(700 × 560)(Size:400kb)(Type:jpeg,png)</p>
                                            </label>
                                              <input type="file" id="multiple_files" name="gallery[]" multiple />
                                            </div>
 -->
                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Product Gallery Images <span class="required">*</span>
                                <p class="small-label">(700 × 560)(Size:400kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group hdtuto control-group lst increment" >

                                      <input type="file" name="gallery[]" class="myfrm form-control">

                                      <div class="input-group-btn"> 

                                        <button id="addimg" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>

                                      </div>

                                    </div>

                                    <div class="clone hide">

                                      <div class="hdtuto control-group lst input-group" style="margin-top:10px">

                                        <input type="file" name="gallery[]" class="myfrm form-control">

                                        <div class="input-group-btn"> 

                                          <button id="removeimg" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Remove</button>

                                        </div>

                                      </div>

                                    </div>
                                    <br>
                                    <p class="small-label">Multiple Image Allowed</p>
                                </div>
                             
                            </div> -->

                           <!--  <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Product Gallery Images <span class="required">*</span>
                                <p class="small-label">(700 × 560)(Size:400kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="file-input" accept="image/*" name="gallery[]" multiple/>
                                    <br>
                                    <div id="thumb-output"></div>
                                    <p class="small-label">Multiple Image Allowed</p>
                                </div>
                            </div> -->
                            <div id="image1" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div id="image2" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div id="image3" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div id="image4" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div id="image5" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div id="image6" class="error">
                                <span class="help-block">
                                                <strong style="color: red;"></strong>
                                 </span>
                            </div>
                            <div class="error">
                                 @if ($errors->has('gallery'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('gallery') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group" id="allownew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="pallow" id="allow" value="1"><strong>Allow Product Sizes</strong></label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group" id="pSizes" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>
                                    <p class="small-label">(Write your own size Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="sizes" value="X,XL,XXL,M,L,S" data-role="tagsinput"/>
                                </div>
                            </div>
 
                            <div class="item form-group" id="descriptionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="description" class="form-control" rows="6">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="error">
                                 @if ($errors->has('description'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" value="{{old('price')}}" name="price" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP<span class="required">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('previous_price')}}" name="previous_price" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Product Cost Price<span class="required">*</span>
                                    
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('costprice')}}" name="costprice" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <!-- for bulk product -->

                            <div class="item form-group" id="bulk">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="bulkrange" id="bulkrange" value="1"><strong>Allow Bulk Size</strong></label>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group" id="bulkfield" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <table class="table table-striped">
                                      <thead>
                                        <tr>
                                         
                                          <th scope="col">Range</th>
                                          <th scope="col">Price</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><input type="text" value="{{old('ranegnameone')}}" name="ranegnameone"></td>
                                          <td><input type="number" value="{{old('p40pieces')}}" name="p40pieces"></td>
                                          
                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{old('rangenametwo')}}" name="rangenametwo"></td>
                                          <td><input type="number" value="{{old('p51pieces')}}" name="p51pieces"></td>
                                         
                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{old('rangenamethree')}}" name="rangenamethree"></td>
                                          <td><input type="number" value="{{old('p5000pieces')}}" name="p5000pieces"></td>
                                          
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(2 - 49 Pieces)<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('p40pieces')}}" name="p40pieces" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(50 - 4999 Pieces)<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('p51pieces')}}" name="p51pieces" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(>=5000 Pieces)<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('p5000pieces')}}" name="p5000pieces" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div> -->


                            <!-- end bulk product -->

                            <div class="item form-group" id="stocknew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock<span class="required">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('stock')}}" name="stock" placeholder="e.g 15" pattern="[0-9]{1,10}" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="policynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="policy" class="form-control" rows="6">{{old('policy')}}</textarea>
                                </div>
                            </div>
                            
                            <div class="error">
                                 @if ($errors->has('featured'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('featured') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" {{ (old('featured') == '1') ? 'checked' : ''}} name="featured" value="1" autocomplete="off" required>
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                             Featured Product
                                        </label>
                                    </div>

                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="tranding" {{ (old('tranding') == '1') ? 'checked' : ''}} value="1" autocomplete="off">
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                             Tranding Product
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="checkbox" name="tranding" value="1" autocomplete="off">
                                        <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                         Tranding Product
                                    </label>
                                </div>
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="latest" {{ (old('latest') == '1') ? 'checked' : ''}} value="1" autocomplete="off">
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                            Latest Product
                                        </label> 
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="selected" {{ (old('selected') == '1') ? 'checked' : ''}} value="1" autocomplete="off">
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                             Selected Product
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="checkbox" name="selected" value="1" autocomplete="off">
                                        <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                         Selected Product
                                    </label>
                                </div>
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags<span class="required">*</span>
                                    <p class="small-label">(Write your product tags Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="tags" value="{{old('tags')}}"  data-role="tagsinput"/>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="add_ads" type="submit" class="btn btn-success btn-block">Add New Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@stop

@section('footer')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('description');
            new nicEditor().panelInstance('policy');
        });

        $("#allow").change(function () {
           $("#pSizes").toggle();
        });

        $("#bulkrange").change(function () {
           $("#bulkfield").toggle();
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        
        $(document).ready(function() {

      $("#addimg").click(function(){ 

          var lsthmtl = $(".clone").html();

          $(".increment").after(lsthmtl);

      });

      $("body").on("click","#removeimg",function(){ 

          $(this).parents(".hdtuto").remove();

      });

    });
    </script>

    <script>
 
    $(document).ready(function(){
     $('#file-input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
             
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result).css('width','40px').css('height','50px').css('margin','5px'); //create image element
                        // var remove = $('<small/>').addClass.value('remove',e.target.result);
                         
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
 
</script>

<script type="text/javascript">
      
   $('#maincats').on('change', function() {
    var select_status = document.getElementById("maincats");
    var categoryname = select_status.options[select_status.selectedIndex].text;
    // alert(strUser); 
    if( categoryname == "Frames" ) {
        $('#diameternew').hide(); 
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#packtypenew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#usagesnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framestylenew').hide();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#frametypenew').show();
        $('#usagesdurationnew').hide();
       

        $('#framewidthnew').show();
        $('#prescriptiontypenew').hide();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#conditionnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#powerrangenew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
      
        $('#frameshape').show();
        $('#sellername').show();
        $('#gendernew').show();

 }

    else if(categoryname == "Contact Lenses") { 
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#gendernew').hide();
        $('#colornew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lenstechnologynew').show();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#packtypenew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#weightnew').hide();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#diameternew').show();
        $('#contactlensmaterialtypenew').show();
        $('#basecurvenew').show();
        $('#watercontentnew').show();
        $('#powernew').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#lenscolornew').show();

        $('#modelnonew').show();
        $('#usagesdurationnew').show();
        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').show();
        $('#cylindernew').show();
        $('#axisnew').show();

        $('#powerrangenew').hide();
        $('#visioneffectnew').show();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').show();




    }else if(categoryname == "Sunglasses"){

         $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show(); 
         $('#lenscolornew').show(); 
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show(); 
         $('#frametypenew').show();
         $('#usagesnew').hide();
         $('#lensmaterialtypenew').show();
         $('#leanscoatingnew').hide();
         $('#diameternew').hide();
         $('#contactlensmaterialtypenew').hide();
         $('#basecurvenew').hide();
         $('#watercontentnew').hide();
         $('#powernew').hide();
         $('#disposabilitynew').hide();
         $('#packagingnew').hide();
         $('#lensindexnew').hide();
         $('#focallengthnew').hide();
         $('#packtypenew').hide();
         $('#shelflifenew').hide();
         $('#formnew').hide();
         $('#productcolornew').hide();
         $('#productdimnew').hide();
         $('#materialnew').hide();
         $('#usagesdurationnew').hide();
         $('#shapenew').show();

        $('#framewidthnew').show();
        $('#prescriptiontypenew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#conditionnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#powerrangenew').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        $('#addpowernew').hide();

    }else if(categoryname == "Lenses"){

        $('#lensmaterialtypenew').show();
        $('#diameternew').show();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#lensindexnew').show();
        $('#focallengthnew').show();
        $('#weightnew').show();
        $('#catetwonew').hide();
        $('#gendernew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#usagesnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#packtypenew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#frametypenew').hide();
        $('#allownew').hide();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();

        $('#gravitynew').show();
        $('#coatingcolornew').show();
        $('#abbevaluenew').show();
        $('#netquntitynew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#powerrangenew').show();
        $('#visioneffectnew').hide();
        $('#coatingnew').show();
        $('#lenstypenew').show();
        $('#addpowernew').show();



    }else if(categoryname == "Accessories"){

        $('#productdimensionnew').show();
        $('#frametypenew').hide();
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide(); 
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();  
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernew').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#usagesnew').show();
        $('#packtypenew').show();
        $('#shelflifenew').show();
        $('#formnew').show();
        $('#productcolornew').show();
        $('#productdimnew').hide();
        $('#materialnew').show();
        $('#warrentytypenew').show();
        $('#weightnew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();

        $('#netquntitynew').show();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#powerrangenew').hide();
        $('#gendernew').hide();
        $('#coatingnew').hide();
        $('#manufracturer').show();
        $('#visioneffectnew').hide();
        $('#framedimensionnew').hide();

    }else if(categoryname == "Premium Brands"){

        $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show(); 
         $('#lenscolornew').show(); 
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show(); 
         $('#frametypenew').hide();
         $('#usagesnew').hide();
         $('#lensmaterialtypenew').show();
         $('#leanscoatingnew').hide();
         $('#diameternew').hide();
         $('#contactlensmaterialtypenew').hide();
         $('#basecurvenew').hide();
         $('#watercontentnew').hide();
         $('#powernew').hide();
         $('#disposabilitynew').hide();
         $('#packagingnew').hide();
         $('#lensindexnew').hide();
         $('#focallengthnew').hide();
         $('#packtypenew').hide();
         $('#shelflifenew').hide();
         $('#formnew').hide();
         $('#productcolornew').hide();
         $('#productdimnew').hide();
         $('#materialnew').hide();
         $('#usagesdurationnew').hide();

                $('#framewidthnew').show();
                $('#prescriptiontypenew').show();
                $('#modelnonew').show();
                $('#heightnew').show();
                $('#conditionnew').show();
                $('#netquntitynew').hide();
                $('#gravitynew').hide();
                $('#coatingcolornew').hide();
                $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#powerrangenew').hide();
        $('#visioneffectnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        
    }else{

    }

});

</script>

<script>
$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#multiple_files").on("change", function(e) {
      var multiple_files = e.target.files,
        filesLength = multiple_files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = multiple_files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"img-delete\">Remove</span>" +
            "</span>").insertAfter("#multiple_files");
          $(".img-delete").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("|Sorry, | Your browser doesn't support to File API")
  }

    $('.imagevalidation').bind('change', function() {
        var _URL = window.URL || window.webkitURL;
        var serial = $(this).attr("data-image_val");
        $("#image"+serial).find("span>strong").text("");
        $("#image"+serial).find("span>strong").text("");
        var a=(this.files[0].size);
        var fileSize = Math.round(this.files[0].size/1024);
        var image_width = image_height = 0;

        let img = new Image()
        img.src = window.URL.createObjectURL(this.files[0])
        img.onload = () => {
            image_width = parseInt(img.width);
            image_height = parseInt(img.height);

            if(image_width == 1300 && image_height == 1160) {
               if(fileSize > 100) {
                    $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " Size large");
                    myImgRemove(serial);
                } 
            }
            // else if (img=="PNG","jpg","jpeg","gif") {
            //     myImgRemove(serial);
            //     $("#image"+serial).find("span>strong").text("Gallary Image "+serial+ " size should be jpeg,png image ");
            // }

            else {
                myImgRemove(serial);
                $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " size should be 1300px and 1160px");
            }

        }
        // var fileExtension = ['png','jpg','jpeg','gif'
        
    });


    const validateMaxImageFileSize = (e) => {
          e.preventDefault();
          const el = $("input[type='file']")[0];

          if (el.files && el.files[0]) {
            const file = el.files[0];

            const maxFileSize = 5242880; // 5 MB
            const maxWidth = 1920;
            const maxHeight = 1080;

            const img = new Image();
            img.src = window.URL.createObjectURL(file);
            img.onload = () => {
              if (file.type.match('image.*') && file.size > maxFileSize) {
                alert('The selected image file is too big. Please choose one that is smaller than 5 MB.');
              } else if (file.type.match('image.*') && (img.width > maxWidth || img.height > maxHeight)) {
                alert(`The selected image is too big. Please choose one with maximum dimensions of ${maxWidth}x${maxHeight}.`);
              } else {
                e.target.nodeName === 'INPUT'
                  ? (e.target.form.querySelector("input[type='submit']").disabled = false)
                  : e.target.submit();
              }
            };
          }
        };
});
</script>
<script type="text/javascript">


var number = 1;
do {
  function showPreview(event, number){
    if(event.target.files.length > 0){
      let src = URL.createObjectURL(event.target.files[0]);
      let preview = document.getElementById("file-ip-"+number+"-preview");
      preview.src = src;
      preview.style.display = "block";

    }
  }
  function myImgRemove(number) {
      document.getElementById("file-ip-"+number+"-preview").src = "https://i.ibb.co/ZVFsg37/default.png";
      document.getElementById("file-ip-"+number).value = null;
    }
  number++;
}
while (number < 5);
</script>
<script>
  $('#subs').select2({
    width: '100%',
    placeholder: "Select Sub Category",
    allowClear: true

  });
</script>
<script>
  $('#childs').select2({
    width: '100%',
    placeholder: "Select Child Category",
    allowClear: true
  });
</script>


<script>
    $('#subs').change(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
        $.ajax({
            type : 'POST',
            url : "{{ url('/childcats') }}",
            data : {"_token": "{{ csrf_token() }}",
                "subid" : $(this).val()},
            success: function (resp) {  
               var s = ''; 
               $('#childs').removeAttr('disabled');
               $('#childs').empty();
               var id = resp.response.id;
               var name = resp.response.name;
               for (var i = 0; i < id.length; i++) { 
                s = '<option value="' + id[i] + '">' + name[i] + '</option>';
                console.log(s);
                $('#childs').append(s);
               }  
        },
                    

            
        })
    })
</script>
<script>
  $('#lenstechnology').select2({
    width: '100%',
    placeholder: "Select lenstechnology",
    allowClear: true

  });
</script>
<script>
    $('#coating').select2({
        width:'100%',
        placeholder :"Select coating",
        allowClear:true
        });
    

</script>
<script>
    $('#gender').select2({
        width:'100%',
        placeholder :"Select gender",
        allowClear:true
        });
    

</script>

<!-- <script>
        var files = $('#file-ip')[0].files;
        for(var i = 0; i<files.length; i++) {
            var name = files[i].name;
            var extension = name.split('.').pop().toLowerCase();
            var imageSize = parseFloat($("#file-ip")[0].files[0]).toFixed(2);
            var height = this.height;
            var width = this.width;
            if($('#file-ip_type').val() == 'image'){
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)   {
                    error += "Invalid File Type";
                } else if(imageSize > 10000) {
                    error += "Invalid File Size";
                }else if (height < 1160 || width < 1300) {
                    error += "Invalid File Dimension"
                }
            }
        }

    if(error != '') alert(error);
    </script> -->
    <!--  // else{

    //     $('#diameternew').show(); 
    //     $('#contactlensmaterialtypenew').show();
    //     $('#basecurvenew').show();
    //     $('#watercontentnew').show();
    //     $('#powernew').show();
    //     $('#disposabilitynew').show();
    //     $('#packagingnew').show();
    //     $('#lenscolornew').show();
    //     $('#lenstechnologynew').show();
    //     $('#lensindexnew').show();
    //     $('#focallengthnew').show();
    //     $('#packtypenew').show();
    //     $('#shelflifenew').show();
    //     $('#formnew').show();
    //     $('#usagesnew').show();
    //     $('#productcolornew').show();
    //     $('#productdimnew').show();
    //     $('#materialnew').show();

    // }  -->
   <!--  <script>
    $(function() {
  $("input[type='file']").change(function() {
    var myid = $(this).attr("id");
    validateImage(myid);

  });
})

function validateImage(id) {
  var file = document.getElementById(id).files[0];
  var ext = file.type.split('/').pop().toLowerCase();
  var spanid = $('#' + id).next().next().attr('id');
  alert(spanid)
  switch (ext) {
    case 'jpg':
    case 'jpeg':
    case 'png':
    case 'gif':
    case 'pdf':
      flag = true;
      $("#" + spanid).text("")
      break;
    default:
      flag = false;
  }

  if (flag == false) {
    $("#" + spanid).text('Invalid file')
    return false;
  } else {
    var size = GetFileSize(id);
    if (size > 500) {
      $("#" + spanid).text("Max size is 500KB")
      return false;
    } else {
      $("#" + spanid).text("")
      return true;
    }
  }

  function GetFileSize(fileid) {
    fileSize = $("#" + fileid)[0].files[0].size
    fileSize = fileSize / 1000;
    return fileSize
  }
}  
</script> -->
@stop