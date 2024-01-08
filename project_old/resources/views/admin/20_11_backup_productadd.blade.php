@extends('admin.includes.master-admin')
<style type="text/css">
    .error{
        padding-left: 310px;
    }
    input[type="file"] {
      display: block;
    }
    
    .swal2-container.swal2-center > .swal2-popup {
        font-size: 16px;
    }

    #manage_attr_table, th, td {
    border: 1px solid white; !important;
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
  #product_attr_div #colorAttr option:hover {
      background-color: transparent !important ;
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

<style>
    /* Popup Window CSS Start */

    .show-prescription {
        width: 100%;
    }

    .show-prescription button {
        width: 100%;
        height: 30px;
        border: none;
        border-bottom: 1px solid #838587;
        color: #d9e0e7;
        background-color:rgb(52, 168, 230);
        border-radius: 5px;
        cursor: pointer;
    }

    #uploadImage {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 25px 20px;
        font-size: 16px;
        background-color: rgba(195,215,225,0.7);
        color: #000;
        border: #000;
        border-radius: 10px;
        cursor: pointer;
    }

    #uploadImage:hover {
        background-color: rgb(250,250,250);
        box-shadow: 0 0 5px rgba(0, 0, 0);
        transition: 0.2s;
    }

    #getImage {
        display:none;
    }

    .close_img{
        display:flex;
        justify-content: center;
        align-items: center;
        width: 20px;
        height: 20px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 3px;
        background-color: red;
    }
    
    .img_close {
        display:flex;
        justify-content: center;
        align-items: center;
        width: 20px;
        height: 20px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 3px;
        background-color: red;
        color: #f1f1f1;
    }

    #showFile {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        width: 100%;
        height:100%;
        border: 1px solid #000;
        border-radius: 5px;
        box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.6);
        position: relative;
        margin: auto;
        gap: 1%;
        padding: 5px;
        overflow: scroll;
    }

    #row-box {
        padding: 5px;
        margin-top: 10px;
    }

    .row-data {
        width: 100%;
        height: 20%;
    }

    .img-div{
        display: flex;
        width: 100%;
        height: 200px;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border-radius: 3px;
    }

    .imageModel {
        width: 150px;
        height: 190px;
        cursor: pointer;
        overflow: hidden;
    }

    .modelShaddow {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(245, 255, 255, 0.6);
    }

    .prescriptionModel {
        display: none;
        position: fixed;
        top:50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50%;
        height: 500px;
        background: #f5f5f5;
        font-family: "Raleway";
        padding: 20px;
        box-shadow: 5px 5px 5px 2px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }

    .model-header {
        width: 100%;
        height: 30px;
    }

    .model-title {
        width: 80%;
        height: 20px;
        display: flex;
        position: fixed;
        top: 0;
        justify-content: center;
    }

    .close {
        width: 30px;
        position: fixed;
        top: 10px;
        right: 5px;
        border: none;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        padding: 3px;
        background-color: #f5f5f5;
    }

    .close:hover {
        border-radius: 30px;
        background-color: rgb(241, 235, 235);
    }

    .right-left-data {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .modal-dialog {
        height: 340px;
    }

    .model-body {
        width: 100%;
        height: 100%;
    }

    .model-content {
        height: 100%;
    }

    .data-content {
        width: 100%;
        height: 100%;
    }

    /* .row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        padding: 20px;
    } */

    /* End CSS */
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
                        <form method="POST" action="{!! action('ProductController@store') !!}" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}
                            
                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku">Product Sku</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{old('productsku')}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text" required>
                                </div>
                            </div>
                            <div class="error">
                                 @if ($errors->has('productsku'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('productsku') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" required value="{{old('title')}}" type="text">
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
                                <label for="maincats" class="control-label col-md-3 col-sm-3 col-xs-12">Main Category<span class="required">*</span>

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
                             <div class="error">
                                 @if ($errors->has('mainid'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('mainid') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label for="subs" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="subid[]" id="subs" disabled>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="childs" class="control-label col-md-3 col-sm-3 col-xs-12">Child Category<span class="required">*</span>

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
                                <label for="shape" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Shape </label>
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
                                <label for="color" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Color </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
                                        <option value="">Select Color</option>
                                        <option value="BLACK" {{ old('color') == "BLACK" ? 'selected' : '' }}>BLACK</option>
                                        <option value="GOLD" {{ old('color') == "GOLD" ? 'selected' : '' }}>GOLDEN</option>
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
                                <label for="gender"  class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender</label>
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
                                        <option value="Adriano Cross" {{ old('brandname') == "Adriano Cross" ? 'selected' : '' }} >Adriano Cross</option>
                                        <option value="Aryan" {{ old('brandname') == "Aryan" ? 'selected' : '' }} >Aryan</option>
                                        <option value="Azzaro" {{ old('brandname') == "Azzaro" ? 'selected' : '' }} >Azzaro</option>
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
                                        <option value="Boss" {{ old('brandname') == "Boss" ? 'selected' : '' }}>Boss</option>
                                        <option value="Carrera" {{ old('brandname') == "Carrera" ? 'selected' : '' }}>Carrera</option>
                                        <option value="Carrera Ducati" {{ old('brandname') == "Carrera Ducati" ? 'selected' : '' }}>Carrera Ducati</option>
                                        <option value="Dior" {{ old('brandname') == "Dior" ? 'selected' : '' }}>Dior</option>
                                        <option value="Dior Homme" {{ old('brandname') == "Dior Homme" ? 'selected' : '' }}>Dior Homme</option>
                                        <option value="Elie Saab" {{ old('brandname') == "Elie Saab" ? 'selected' : '' }}>Elie Saab</option>
                                        <option value="E=mc2" {{ old('brandname') == "E=mc2" ? 'selected' : '' }}>E=mc2</option>
                                        <option value="Fendi" {{ old('brandname') == "Fendi" ? 'selected' : '' }}>Fendi</option>
                                        <option value="Fossil" {{ old('brandname') == "Fossil" ? 'selected' : '' }}>Fossil</option>
                                        <option value="Givenchy" {{ old('brandname') == "Givenchy" ? 'selected' : '' }}>Givenchy</option>
                                        <option value="Havaianas" {{ old('brandname') == "Havaianas" ? 'selected' : '' }}>Havaianas</option>
                                        <option value="Isabel Marant" {{ old('brandname') == "Isabel Marant" ? 'selected' : '' }}>Isabel Marant</option>
                                        <option value="Jimmy Choo" {{ old('brandname') == "Jimmy Choo" ? 'selected' : '' }}>Jimmy Choo</option>
                                        <option value="Juicy Couture" {{ old('brandname') == "Juicy Couture" ? 'selected' : '' }}>Juicy Couture</option>
                                        <option value="Kate Spade" {{ old('brandname') == "Kate Spade" ? 'selected' : '' }}>Kate Spade</option>
                                        <option value="Levis" {{ old('brandname') == "Levis" ? 'selected' : '' }}>Levis</option>
                                        <option value="M Missoni" {{ old('brandname') == "M Missoni" ? 'selected' : '' }}>M Missoni</option>
                                        <option value="Marc By Marc Jacobs" {{ old('brandname') == "Marc By Marc Jacobs" ? 'selected' : '' }}>Marc By Marc Jacobs</option>
                                        <option value="Marc Jacobs" {{ old('brandname') == "Marc Jacobs" ? 'selected' : '' }}>Marc Jacobs</option>
                                        <option value="Max & Co." {{ old('brandname') == "Max & Co." ? 'selected' : '' }}>Max & Co.</option>
                                        <option value="Max Mara" {{ old('brandname') == "Max Mara" ? 'selected' : '' }}>Max Mara</option>
                                        <option value="Missoni" {{ old('brandname') == "Missoni" ? 'selected' : '' }}>Missoni</option>
                                        <option value="Moschino" {{ old('brandname') == "Moschino" ? 'selected' : '' }}>Moschino</option>
                                        <option value="Moschino Love" {{ old('brandname') == "Moschino Love" ? 'selected' : '' }}>Moschino Love</option>
                                        <option value="Oxydo" {{ old('brandname') == "Oxydo" ? 'selected' : '' }}>Oxydo</option>
                                        <option value="Pierre Cardin" {{ old('brandname') == "Pierre Cardin" ? 'selected' : '' }}>Pierre Cardin</option>
                                        <option value="Polaroid" {{ old('brandname') == "Polaroid" ? 'selected' : '' }}>Polaroid</option>
                                        <option value="Polaroid Ancillaries" {{ old('brandname') == "Polaroid Ancillaries" ? 'selected' : '' }}>Polaroid Ancillaries</option>
                                        <option value="Polaroid Kids" {{ old('brandname') == "Polaroid Kids" ? 'selected' : '' }}>Polaroid Kids</option>
                                        <option value="Polaroid Premium" {{ old('brandname') == "Polaroid Premium" ? 'selected' : '' }}>Polaroid Premium</option>
                                        <option value="Polaroid Reading Glasses" {{ old('brandname') == "Polaroid Reading Glasses" ? 'selected' : '' }}>Polaroid Reading Glasses</option>
                                        <option value="Polaroid Sport" {{ old('brandname') == "Polaroid Sport" ? 'selected' : '' }}>Polaroid Sport</option>
                                        <option value="Polaroid Staysafe" {{ old('brandname') == "Polaroid Staysafe" ? 'selected' : '' }}>Polaroid Staysafe</option>
                                        <option value="Rag&Bone" {{ old('brandname') == "Rag&Bone" ? 'selected' : '' }}>Rag&Bone</option>
                                        <option value="Selebration" {{ old('brandname') == "Selebration" ? 'selected' : '' }}>Selebration</option>
                                        <option value="Stepper" {{ old('brandname') == "Stepper" ? 'selected' : '' }}>Stepper</option>
                                        <option value="Safilo" {{ old('brandname') == "Safilo" ? 'selected' : '' }}>Safilo</option>
                                        <option value="Safilo By Marcel Wanders" {{ old('brandname') == "Safilo By Marcel Wanders" ? 'selected' : '' }}>Safilo By Marcel Wanders</option>
                                        <option value="Seventh Street" {{ old('brandname') == "Seventh Street" ? 'selected' : '' }}>Seventh Street</option>
                                        <option value="Smith" {{ old('brandname') == "Smith" ? 'selected' : '' }}>Smith</option>
                                        <option value="Boss Orange" {{ old('brandname') == "Boss Orange" ? 'selected' : '' }}>Boss Orange</option>
                                        <option value="Tommy Hilfiger" {{ old('brandname') == "Tommy Hilfiger" ? 'selected' : '' }}>Tommy Hilfiger</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <!-- Start new input fields added as per category  -->
                            
                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Contact Lens Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype">
                                        <option value="">Select Lens Type</option>
                                        <option value="Single Vision" {{ old('lenstype') == "Single Vision" ? 'selected' : '' }}>Single Vision</option>
                                        <option value="MultiFocal" {{ old('lenstype') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>
                                        <option value="toric and Astigmatism" {{ old('lenstype') == "toric and Astigmatism" ? 'selected' : '' }}>toric and Astigmatism</option>
                                        <option value="Plano" {{ old('lenstype') == "Plano" ? 'selected' : '' }}>Plano</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="visioneffect">Lens Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect">
                                        <option value="">Select Lens Power</option>
                                        <option value="Single Vision" {{ old('visioneffect') == "Single Vision" ? 'selected' : '' }}>single Vision</option>
                                        <option value="Biofocal" {{ old('visioneffect') == "Biofocal" ? 'selected' : '' }}>Biofocal</option>
                                        <option value="Progressive" {{ old('visioneffect') == "Progressive" ? 'selected' : '' }}>Progressive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{old('modelno')}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{old('sellername')}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth"> Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framewidth" value="{{old('framewidth')}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usages"> Usages</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usages" value="{{old('usages')}}" class="form-control col-md-7 col-xs-12" name="usages" placeholder="Enter Usages" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usagesduration"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="{{old('usagesduration')}}" class="form-control col-md-7 col-xs-12" name="usagesduration" placeholder="Enter Usages Duration" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templematerial">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="{{old('templematerial')}}" class="form-control col-md-7 col-xs-12" name="templematerial" placeholder="Temple Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templecolor">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="{{old('templecolor')}}" class="form-control col-md-7 col-xs-12" name="templecolor" placeholder="Temple Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype">
                                        <option value="">Select Lens Material</option>
                                        <option value="CR-39" {{ old('lensmaterialtype') == "CR-39" ? 'selected' : '' }}>CR-39</option>
                                        <option value="Injected/Propion" {{ old('lensmaterialtype') == "Injected/Propion" ? 'selected' : '' }}>Injected/Propion</option>
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
                                        <option value="Other" {{ old('lensmaterialtype') == "Other" ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="leanscoatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leanscoating">Lens coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="leanscoating" value="{{old('leanscoating')}}" class="form-control col-md-7 col-xs-12" name="leanscoating" placeholder="Lens coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactlensmaterialtype">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="{{old('contactlensmaterialtype')}}" class="form-control col-md-7 col-xs-12" name="contactlensmaterialtype" placeholder="Contact Lens Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="watercontent">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{old('watercontent')}}" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control" multiple="multiple" name="diameter[]" id="diameter">
                                        <option value="14" {{ old('diameter') == "14" ? 'selected' : '' }}>14</option>
                                        <option value="14.2" {{ old('diameter') == "14.2" ? 'selected' : '' }}>14.2</option>
                                        <option value="14.1" {{ old('diameter') == "14.1" ? 'selected' : '' }}>14.1</option>
                                        <option value="14.5" {{ old('diameter') == "14.5" ? 'selected' : '' }}>14.5</option>
                                        <option value="13.8" {{ old('diameter') == "13.8" ? 'selected' : '' }}>13.8</option>
                                        <option value="14.3" {{ old('diameter') == "14.3" ? 'selected' : '' }}>14.3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="basecurve[]" id="basecurve">
                                        <option value="">Select cylinder</option>
                                        <option value="8.5" {{ old('basecurve') == "8.5" ? 'selected' : '' }}>8.5</option>
                                        <option value="8.6" {{ old('basecurve') == "8.6" ? 'selected' : '' }}>8.6</option>
                                        <option value="8.4" {{ old('basecurve') == "8.4" ? 'selected' : '' }}>8.4</option>
                                        <option value="8.9" {{ old('basecurve') == "8.9" ? 'selected' : '' }}>8.9</option>
                                        <option value="8.7" {{ old('basecurve') == "8.7" ? 'selected' : '' }}>8.7</option>
                                        <option value="9" {{ old('basecurve') == "9" ? 'selected' : '' }}>9</option>
                                        <option value="8.8" {{ old('basecurve') == "8.8" ? 'selected' : '' }}>8.8</option>
                                        <option value="8.3" {{ old('basecurve') == "8.3" ? 'selected' : '' }}>8.3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmin">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "( " ?> <i class="fa fa-minus"></i> <?php echo " )" ?> <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <select class="form-control" name="powermin[]" id="powermin" multiple>
                                        <option value="">Select Min Power</option>
                                        <option value="0.00" {{ old('powermin') == "0.00" ? 'selected' : '' }}>0.00</option>
                                        <option value="-0.25" {{ old('powermin') == "-0.25" ? 'selected' : '' }}>-0.25</option>
                                        <option value="-0.50" {{ old('powermin') == "-0.50" ? 'selected' : '' }}>-0.50</option>
                                        <option value="-0.75" {{ old('powermin') == "-0.75" ? 'selected' : '' }}>-0.75</option>
                                        <option value="-1.00" {{ old('powermin') == "-1.00" ? 'selected' : '' }}>-1.00</option>
                                        <option value="-1.25" {{ old('powermin') == "-1.25" ? 'selected' : '' }}>-1.25</option>
                                        <option value="-1.50" {{ old('powermin') == "-1.50" ? 'selected' : '' }}>-1.50</option>
                                        <option value="-1.75" {{ old('powermin') == "-1.75" ? 'selected' : '' }}>-1.75</option>
                                        <option value="-2.00" {{ old('powermin') == "-2.00" ? 'selected' : '' }}>-2.00</option>
                                        <option value="-2.25" {{ old('powermin') == "-2.25" ? 'selected' : '' }}>-2.25</option>
                                        <option value="-2.50" {{ old('powermin') == "-2.50" ? 'selected' : '' }}>-2.50</option>
                                        <option value="-2.75" {{ old('powermin') == "-2.75" ? 'selected' : '' }}>-2.75</option>
                                        <option value="-3.00" {{ old('powermin') == "-3.00" ? 'selected' : '' }}>-3.00</option>
                                        <option value="-3.25" {{ old('powermin') == "-3.25" ? 'selected' : '' }}>-3.25</option>
                                        <option value="-3.50" {{ old('powermin') == "-3.50" ? 'selected' : '' }}>-3.50</option>
                                        <option value="-3.75" {{ old('powermin') == "-3.75" ? 'selected' : '' }}>-3.75</option>
                                        <option value="-4.00" {{ old('powermin') == "-4.00" ? 'selected' : '' }}>-4.00</option>
                                        <option value="-4.25" {{ old('powermin') == "-4.25" ? 'selected' : '' }}>-4.25</option>
                                        <option value="-4.50" {{ old('powermin') == "-4.50" ? 'selected' : '' }}>-4.50</option>
                                        <option value="-4.75" {{ old('powermin') == "-4.75" ? 'selected' : '' }}>-4.75</option>
                                        <option value="-5.00" {{ old('powermin') == "-5.00" ? 'selected' : '' }}>-5.00</option>
                                        <option value="-5.25" {{ old('powermin') == "-5.25" ? 'selected' : '' }}>-5.25</option>
                                        <option value="-5.50" {{ old('powermin') == "-5.50" ? 'selected' : '' }}>-5.50</option>
                                        <option value="-5.75" {{ old('powermin') == "-5.75" ? 'selected' : '' }}>-5.75</option>
                                        <option value="-6.00" {{ old('powermin') == "-6.00" ? 'selected' : '' }}>-6.00</option>
                                        <option value="-6.25" {{ old('powermin') == "-6.25" ? 'selected' : '' }}>-6.25</option>
                                        <option value="-6.50" {{ old('powermin') == "-6.50" ? 'selected' : '' }}>-6.50</option>
                                        <option value="-6.75" {{ old('powermin') == "-6.75" ? 'selected' : '' }}>-6.75</option>
                                        <option value="-7.00" {{ old('powermin') == "-7.00" ? 'selected' : '' }}>-7.00</option>
                                        <option value="-7.25" {{ old('powermin') == "-7.25" ? 'selected' : '' }}>-7.25</option>
                                        <option value="-7.50" {{ old('powermin') == "-7.50" ? 'selected' : '' }}>-7.50</option>
                                        <option value="-7.75" {{ old('powermin') == "-7.75" ? 'selected' : '' }}>-7.75</option>
                                        <option value="-8.00" {{ old('power') == "-8.00" ? 'selected' : '' }}>-8.00</option>
                                        <option value="-8.25" {{ old('powermin') == "-8.25" ? 'selected' : '' }}>-8.25</option>
                                        <option value="-8.50" {{ old('powermin') == "-8.50" ? 'selected' : '' }}>-8.50</option>
                                        <option value="-8.75" {{ old('powermin') == "-8.75" ? 'selected' : '' }}>-8.75</option>
                                        <option value="-9.00" {{ old('powermin') == "-9.00" ? 'selected' : '' }}>-9.00</option>
                                        <option value="-9.25" {{ old('powermin') == "-9.25" ? 'selected' : '' }}>-9.25</option>
                                        <option value="-9.50" {{ old('powermin') == "-9.50" ? 'selected' : '' }}>-9.50</option>
                                        <option value="-9.75" {{ old('powermin') == "-9.75" ? 'selected' : '' }}>-9.75</option>
                                        <option value="-10.00" {{ old('powermin') == "-10.00" ? 'selected' : '' }}>-10.00</option>
                                        <option value="-10.25" {{ old('powermin') == "-10.25" ? 'selected' : '' }}>-10.25</option>
                                        <option value="-10.50" {{ old('powermin') == "-10.50" ? 'selected' : '' }}>-10.50</option>
                                        <option value="-10.75" {{ old('powermin') == "-10.75" ? 'selected' : '' }}>-10.75</option>
                                        <option value="-11.00" {{ old('powermin') == "-11.00" ? 'selected' : '' }}>-11.00</option>
                                        <option value="-11.25" {{ old('powermin') == "-11.25" ? 'selected' : '' }}>-11.25</option>
                                        <option value="-11.50" {{ old('powermin') == "-11.50" ? 'selected' : '' }}>-11.50</option>
                                        <option value="-11.75" {{ old('powermin') == "-11.75" ? 'selected' : '' }}>-11.75</option>
                                        
                                        <option value="-12.00" {{ old('powermin') == "-12.00" ? 'selected' : '' }}>-12.00</option>
                                        <option value="-12.25" {{ old('powermin') == "-12.25" ? 'selected' : '' }}>-12.25</option>
                                        <option value="-12.50" {{ old('powermin') == "-12.50" ? 'selected' : '' }}>-12.50</option>
                                        <option value="-12.75" {{ old('powermin') == "-12.75" ? 'selected' : '' }}>-12.75</option>
                                        <option value="-13.00" {{ old('powermin') == "-13.00" ? 'selected' : '' }}>-13.00</option>
                                        <option value="-13.25" {{ old('powermin') == "-13.25" ? 'selected' : '' }}>-13.25</option>
                                        <option value="-13.50" {{ old('powermin') == "-13.50" ? 'selected' : '' }}>-13.50</option>
                                        <option value="-13.75" {{ old('powermin') == "-13.75" ? 'selected' : '' }}>-13.75</option>
                                        <option value="-14.00" {{ old('powermin') == "-14.00" ? 'selected' : '' }}>-14.00</option>
                                        <option value="-14.25" {{ old('powermin') == "-14.25" ? 'selected' : '' }}>-14.25</option>
                                        <option value="-14.50" {{ old('powermin') == "-14.50" ? 'selected' : '' }}>-14.50</option>
                                        <option value="-14.75" {{ old('powermin') == "-14.75" ? 'selected' : '' }}>-14.75</option>
                                        <option value="-15.00" {{ old('powermin') == "-15.00" ? 'selected' : '' }}>-15.00</option>
                                        <option value="-15.25" {{ old('powermin') == "-15.25" ? 'selected' : '' }}>-15.25</option>
                                        <option value="-15.50" {{ old('powermin') == "-15.50" ? 'selected' : '' }}>-15.50</option>
                                        <option value="-15.75" {{ old('powermin') == "-15.75" ? 'selected' : '' }}>-15.75</option>
                                        <option value="-16.00" {{ old('powermin') == "-16.00" ? 'selected' : '' }}>-16.00</option>
                                        <option value="-16.25" {{ old('powermin') == "-16.25" ? 'selected' : '' }}>-16.25</option>
                                        <option value="-16.50" {{ old('powermin') == "-16.50" ? 'selected' : '' }}>-16.50</option>
                                        <option value="-16.75" {{ old('powermin') == "-16.75" ? 'selected' : '' }}>-16.75</option>
                                        <option value="-17.00" {{ old('powermin') == "-17.00" ? 'selected' : '' }}>-17.00</option>
                                        <option value="-17.25" {{ old('powermin') == "-17.25" ? 'selected' : '' }}>-17.25</option>
                                        <option value="-17.50" {{ old('powermin') == "-17.50" ? 'selected' : '' }}>-17.50</option>
                                        <option value="-17.75" {{ old('powermin') == "-17.75" ? 'selected' : '' }}>-17.75</option>
                                        <option value="-18.00" {{ old('powermin') == "-18.00" ? 'selected' : '' }}>-18.00</option>
                                        <option value="-18.25" {{ old('powermin') == "-18.25" ? 'selected' : '' }}>-18.25</option>
                                        <option value="-18.50" {{ old('powermin') == "-18.50" ? 'selected' : '' }}>-18.50</option>
                                        <option value="-18.75" {{ old('powermin') == "-18.75" ? 'selected' : '' }}>-18.75</option>
                                        <option value="-19.00" {{ old('powermin') == "-19.00" ? 'selected' : '' }}>-19.00</option>
                                        <option value="-19.25" {{ old('powermin') == "-19.25" ? 'selected' : '' }}>-19.25</option>
                                        <option value="-19.50" {{ old('powermin') == "-19.50" ? 'selected' : '' }}>-19.50</option>
                                        <option value="-19.75" {{ old('powermin') == "-19.75" ? 'selected' : '' }}>-19.75</option>
                                        <option value="-20.00" {{ old('powermin') == "-20.00" ? 'selected' : '' }}>-20.00</option>
                                    </select>
                                </div>
                            </div>
            
            
                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "( " ?> <i class="fa fa-plus"></i> <?php echo " )" ?> <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <select class="form-control" name="powermax[]" id="powermax" multiple>
                                        <option value="0" {{ old('powermax') == "0" ? 'selected' : '' }}>0</option>                         
                                        <option value="0.25" {{ old('powermax') == "0.25" ? 'selected' : '' }}>0.25</option>
                                        <option value="0.50" {{ old('powermax') == "0.50" ? 'selected' : '' }}>0.50</option>
                                        <option value="0.75" {{ old('powermax') == "0.75" ? 'selected' : '' }}>0.75</option>
                                        
                                        <option value="1" {{ old('powermax') == "1" ? 'selected' : '' }}>1</option>
                                        <option value="1.25" {{ old('powermax') == "1.25" ? 'selected' : '' }}>1.25</option>
                                        <option value="1.50" {{ old('powermax') == "1.50" ? 'selected' : '' }}>1.50</option>
                                        <option value="1.75" {{ old('powermax') == "1.75" ? 'selected' : '' }}>1.75</option>
                                        
                                        <option value="2" {{ old('powermax') == "2" ? 'selected' : '' }}>2</option>
                                        <option value="2.25" {{ old('powermax') == "2.25" ? 'selected' : '' }}>2.25</option>
                                        <option value="2.50" {{ old('powermax') == "2.50" ? 'selected' : '' }}>2.50</option>
                                        <option value="2.75" {{ old('powermax') == "2.75" ? 'selected' : '' }}>2.75</option>
                                        
                                        <option value="3" {{ old('powermax') == "3" ? 'selected' : '' }}>3</option>
                                        <option value="3.25" {{ old('powermax') == "3.25" ? 'selected' : '' }}>3.25</option>
                                        <option value="3.50" {{ old('powermax') == "3.50" ? 'selected' : '' }}>3.50</option>
                                        <option value="3.75" {{ old('powermax') == "3.75" ? 'selected' : '' }}>3.75</option>
                                        
                                        <option value="4" {{ old('powermax') == "4" ? 'selected' : '' }}>4</option>
                                        <option value="4.25" {{ old('powermax') == "4.25" ? 'selected' : '' }}>4.25</option>
                                        <option value="4.50" {{ old('powermax') == "4.50" ? 'selected' : '' }}>4.50</option>
                                        <option value="4.75" {{ old('powermax') == "4.75" ? 'selected' : '' }}>4.75</option>

                                        <option value="5" {{ old('powermax') == "5" ? 'selected' : '' }}>5</option>
                                        <option value="5.25" {{ old('powermax') == "5.25" ? 'selected' : '' }}>5.25</option>
                                        <option value="5.50" {{ old('powermax') == "5.50" ? 'selected' : '' }}>5.50</option>
                                        <option value="5.75" {{ old('powermax') == "5.75" ? 'selected' : '' }}>5.75</option>

                                        <option value="6" {{ old('powermax') == "6" ? 'selected' : '' }}>6</option>
                                        <option value="6.25" {{ old('powermax') == "6.25" ? 'selected' : '' }}>6.25</option>
                                        <option value="6.50" {{ old('powermax') == "6.50" ? 'selected' : '' }}>6.50</option>
                                        <option value="6.75" {{ old('powermax') == "6.75" ? 'selected' : '' }}>6.75</option>
                                        
                                        <option value="7" {{ old('powermax') == "7" ? 'selected' : '' }}>7</option>
                                        <option value="7.25" {{ old('powermax') == "7.25" ? 'selected' : '' }}>7.25</option>
                                        <option value="7.50" {{ old('powermax') == "7.50" ? 'selected' : '' }}>7.50</option>
                                        <option value="7.75" {{ old('powermax') == "7.75" ? 'selected' : '' }}>7.75</option>
                                        
                                        <option value="8" {{ old('powermax') == "8" ? 'selected' : '' }}>8</option>
                                        <option value="8.25" {{ old('powermax') == "8.25" ? 'selected' : '' }}>8.25</option>
                                        <option value="8.50" {{ old('powermax') == "8.50" ? 'selected' : '' }}>8.50</option>
                                        <option value="8.75" {{ old('powermax') == "8.75" ? 'selected' : '' }}>8.75</option>
                                        
                                        <option value="9" {{ old('powermax') == "9" ? 'selected' : '' }}>9</option>
                                        <option value="9.25" {{ old('powermax') == "9.25" ? 'selected' : '' }}>9.25</option>
                                        <option value="9.50" {{ old('powermax') == "9.50" ? 'selected' : '' }}>9.50</option>
                                        <option value="9.75" {{ old('powermax') == "9.75" ? 'selected' : '' }}>9.75</option>
                                        
                                        <option value="10" {{ old('powermax') == "10" ? 'selected' : '' }}>10</option>
                                        <option value="10.25" {{ old('powermax') == "10.25" ? 'selected' : '' }}>10.25</option>
                                        <option value="10.50" {{ old('powermax') == "10.50" ? 'selected' : '' }}>10.50</option>
                                        <option value="10.75" {{ old('powermax') == "10.75" ? 'selected' : '' }}>10.75</option> 
                                        
                                        <option value="11" {{ old('powermax') == "11" ? 'selected' : '' }}>11</option>
                                        <option value="11.25" {{ old('powermax') == "11.25" ? 'selected' : '' }}>11.25</option>
                                        <option value="11.50" {{ old('powermax') == "11.50" ? 'selected' : '' }}>11.50</option>
                                        <option value="11.75" {{ old('powermax') == "11.75" ? 'selected' : '' }}>11.75</option> 
                                        <option value="12" {{ old('powermax') == "12" ? 'selected' : '' }}>12</option>
                                        
                                        <option value="12.25" {{ old('powermax') == "12.25" ? 'selected' : '' }}>12.25</option>
                                        <option value="12.50" {{ old('powermax') == "12.50" ? 'selected' : '' }}>12.50</option>
                                        <option value="12.75" {{ old('powermax') == "12.75" ? 'selected' : '' }}>12.75</option>
                                        <option value="13" {{ old('powermax') == "13" ? 'selected' : '' }}>13</option>
                                        <option value="13.25" {{ old('powermax') == "13.25" ? 'selected' : '' }}>13.25</option>
                                        <option value="13.50" {{ old('powermax') == "13.50" ? 'selected' : '' }}>13.50</option>
                                        <option value="13.75" {{ old('powermax') == "13.75" ? 'selected' : '' }}>13.75</option>
                                        <option value="14" {{ old('powermax') == "14" ? 'selected' : '' }}>14</option>
                                        <option value="14.25" {{ old('powermax') == "14.25" ? 'selected' : '' }}>14.25</option>
                                        <option value="14.50" {{ old('powermax') == "14.50" ? 'selected' : '' }}>14.50</option>
                                        <option value="14.75" {{ old('powermax') == "14.75" ? 'selected' : '' }}>14.75</option>
                                        <option value="15" {{ old('powermax') == "15" ? 'selected' : '' }}>15</option>
                                        <option value="15.25" {{ old('powermax') == "15.25" ? 'selected' : '' }}>15.25</option>
                                        <option value="15.50" {{ old('powermax') == "15.50" ? 'selected' : '' }}>15.50</option>
                                        <option value="15.75" {{ old('powermax') == "15.75" ? 'selected' : '' }}>15.75</option>
                                        <option value="16" {{ old('powermax') == "16" ? 'selected' : '' }}>16</option>
                                        <option value="16.25" {{ old('powermax') == "16.25" ? 'selected' : '' }}>16.25</option>
                                        <option value="16.50" {{ old('powermax') == "16.50" ? 'selected' : '' }}>16.50</option>
                                        <option value="16.75" {{ old('powermax') == "16.75" ? 'selected' : '' }}>16.75</option>
                                        <option value="17" {{ old('powermax') == "17" ? 'selected' : '' }}>17</option>
                                        <option value="17.25" {{ old('powermax') == "17.25" ? 'selected' : '' }}>17.25</option>
                                        <option value="17.50" {{ old('powermax') == "17.50" ? 'selected' : '' }}>17.50</option>
                                        <option value="17.75" {{ old('powermax') == "17.75" ? 'selected' : '' }}>17.75</option>
                                        <option value="18" {{ old('powermax') == "18" ? 'selected' : '' }}>18</option>
                                        <option value="18.25" {{ old('powermax') == "18.25" ? 'selected' : '' }}>18.25</option>
                                        <option value="18.50" {{ old('powermax') == "18.50" ? 'selected' : '' }}>18.50</option>
                                        <option value="18.75" {{ old('powermax') == "18.75" ? 'selected' : '' }}>18.75</option>
                                        <option value="19" {{ old('powermax') == "19" ? 'selected' : '' }}>19</option>
                                        <option value="19.25" {{ old('powermax') == "19.25" ? 'selected' : '' }}>19.25</option>
                                        <option value="19.50" {{ old('powermax') == "19.50" ? 'selected' : '' }}>19.50</option>
                                        <option value="19.75" {{ old('powermax') == "19.75" ? 'selected' : '' }}>19.75</option>
                                        <option value="20" {{ old('powermax') == "20" ? 'selected' : '' }}>20</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="cylinderneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="cylindernew[]" id="cylindernew">
                                        <option value="">Select cylinder</option>
                                        <option value="0.00" {{ old('cylindernew') == "0.00" ? 'selected' : '' }}>0.00</option>
                                        <option value="-0.50" {{ old('cylindernew') == "-0.50" ? 'selected' : '' }}>-0.50</option>
                                        <option value="-0.75" {{ old('cylindernew') == "-0.75" ? 'selected' : '' }}>-0.75</option>
                                        <option value="-1.00" {{ old('cylindernew') == "-1.00" ? 'selected' : '' }}>-1.00</option>
                                        <option value="-1.25" {{ old('cylindernew') == "-1.25" ? 'selected' : '' }}>-1.25</option>
                                        <option value="-1.50" {{ old('cylindernew') == "-1.50" ? 'selected' : '' }}>-1.50</option>
                                        <option value="-1.75" {{ old('cylindernew') == "-1.75" ? 'selected' : '' }}>-1.75</option>
                                        <option value="-2.00" {{ old('cylindernew') == "-2.00" ? 'selected' : '' }}>-2.00</option>
                                        <option value="-2.25" {{ old('cylindernew') == "-2.25" ? 'selected' : '' }}>-2.25</option>
                                        <option value="-2.50" {{ old('cylindernew') == "-2.50" ? 'selected' : '' }}>-2.50</option>
                                        <option value="-2.75" {{ old('cylindernew') == "-2.75" ? 'selected' : '' }}>-2.75</option>
                                        <option value="-3.00" {{ old('cylindernew') == "-3.00" ? 'selected' : '' }}>-3.00</option>
                                    </select>                              
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" multiple="multiple" name="addpower[]" id="addpower">
                                        <option value="">Select Power</option>
                                        <option value="0.75" {{ old('addpower') == "0.75" ? 'selected' : '' }}>0.75</option>
                                        <option value="1" {{ old('addpower') == "1" ? 'selected' : '' }}>1</option>
                                        <option value="1.25" {{ old('addpower') == "1.25" ? 'selected' : '' }}>1.25</option>
                                        <option value="1.5" {{ old('addpower') == "1.5" ? 'selected' : '' }}>1.5</option>
                                        <option value="1.75" {{ old('addpower') == "1.75" ? 'selected' : '' }}>1.75</option>
                                        <option value="2" {{ old('addpower') == "2" ? 'selected' : '' }}>2</option>
                                        <option value="2.25" {{ old('addpower') == "2.25" ? 'selected' : '' }}>2.25</option>
                                        <option value="2.75" {{ old('addpower') == "2.75" ? 'selected' : '' }}2.75</option>
                                        <option value="3" {{ old('addpower') == "3" ? 'selected' : '' }}>3</option>
                                    </select>   
                                </div>
                            </div>
                            
                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="axisnew[]" id="axisnew">
                                        <option value="">Select Axis</option>
                                        <option value="0" {{ old('axisnew') == "0" ? 'selected' : '' }}>0</option>
                                        <option value="10" {{ old('axisnew') == "10" ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ old('axisnew') == "20" ? 'selected' : '' }}>20</option>
                                        <option value="30" {{ old('axisnew') == "30" ? 'selected' : '' }}>30</option>
                                        <option value="40" {{ old('axisnew') == "40" ? 'selected' : '' }}>40</option>
                                        <option value="50" {{ old('axisnew') == "50" ? 'selected' : '' }}>50</option>
                                        <option value="60" {{ old('axisnew') == "60" ? 'selected' : '' }}>60</option>
                                        <option value="70" {{ old('axisnew') == "70" ? 'selected' : '' }}>70</option>
                                        <option value="80" {{ old('axisnew') == "80" ? 'selected' : '' }}>80</option>
                                        <option value="90" {{ old('axisnew') == "90" ? 'selected' : '' }}>90</option>
                                        <option value="100" {{ old('axisnew') == "100" ? 'selected' : '' }}>100</option>
                                        <option value="110" {{ old('axisnew') == "110" ? 'selected' : '' }}>110</option>
                                        <option value="120" {{ old('axisnew') == "120" ? 'selected' : '' }}>120</option>
                                        <option value="130" {{ old('axisnew') == "130" ? 'selected' : '' }}>130</option>
                                        <option value="140" {{ old('axisnew') == "140" ? 'selected' : '' }}>140</option>
                                        <option value="150" {{ old('axisnew') == "150" ? 'selected' : '' }}>150</option>
                                        <option value="160" {{ old('axisnew') == "160" ? 'selected' : '' }}>160</option>
                                        <option value="170" {{ old('axisnew') == "170" ? 'selected' : '' }}>170</option>
                                        <option value="180" {{ old('axisnew') == "180" ? 'selected' : '' }}>180</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="centerthikness">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" class="form-control col-md-7 col-xs-12" value="{{old('centerthiknessnew')}}" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability">
                                        <option value="">Select Disposability</option>
                                        <option value="Daily" {{ old('disposability') == "Daily" ? 'selected' : '' }}>Daily</option>
                                        <option value="Weekly" {{ old('disposability') == "Weekly" ? 'selected' : '' }}>Weekly</option>
                                        <option value="Monthly" {{ old('disposability') == "Monthly" ? 'selected' : '' }}>Monthly</option>
                                        <option value="Yearly" {{ old('disposability') == "Yearly" ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="">Select Color</option>
                                        <option value="brown" {{ old('lenscolor') == "brown" ? 'selected' : '' }}>Brown</option>
                                        <option value="red" {{ old('lenscolor') == "red" ? 'selected' : '' }}>Red</option>
                                        <option value="orange" {{ old('lenscolor') == "orange" ? 'selected' : '' }}>Orange</option>
                                        <option value="green" {{ old('lenscolor') == "green" ? 'selected' : '' }}>Green</option>
                                        <option value="blue" {{ old('lenscolor') == "blue" ? 'selected' : '' }}>Blue</option>
                                        <option value="Transparent" {{ old('lenscolor') == "Transparent" ? 'selected' : '' }}>Transparent</option>
                                        <option value="multicolor" {{ old('lenscolor') == "multicolor" ? 'selected' : '' }}>Multicolor</option>
                                        <option value="gray" {{ old('lenscolor') == "gray" ? 'selected' : '' }}>Gray</option>
                                        <option value="Silver" {{ old('lenscolor') == "Silver" ? 'selected' : '' }}>Silver</option>
                                        <option value="Golden" {{ old('lenscolor') == "Golden" ? 'selected' : '' }}>Golden</option>
                                        <option value="Sky Blue" {{ old('lenscolor') == "Sky Blue" ? 'selected' : '' }}>Sky Blue</option>
                                        <option value="Voilet" {{ old('lenscolor') == "Voilet" ? 'selected' : '' }}>Voilet</option>
                                        <option value="Black" {{ old('lenscolor') == "Black" ? 'selected' : '' }}>Black</option>
                                        <option value="Pink" {{ old('lenscolor') == "Pink" ? 'selected' : '' }}>Pink</option>
                                        <option value="Maroon" {{ old('lenscolor') == "Maroon" ? 'selected' : '' }}>Maroon</option>
                                        <option value="Yellow" {{ old('lenscolor') == "Yellow" ? 'selected' : '' }}>Yellow</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Contact Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="">Select Color</option>
                                        <option value="Brown" {{ old('lenscolor') == "Brown" ? 'selected' : '' }}>Brown</option>
                                        <option value="Hazel" {{ old('lenscolor') == "Hazel" ? 'selected' : '' }}>Hazel</option>
                                        <option value="Turquois" {{ old('lenscolor') == "Turquois" ? 'selected' : '' }}>Turquois</option>
                                        <option value="Green" {{ old('lenscolor') == "Green" ? 'selected' : '' }}>Green</option>
                                        <option value="Blue" {{ old('lenscolor') == "Blue" ? 'selected' : '' }}>Blue</option>
                                        <option value="Transparent" {{ old('lenscolor') == "Transparent" ? 'selected' : '' }}>Transparent</option>
                                        <option value="Multicolor" {{ old('lenscolor') == "Multicolor" ? 'selected' : '' }}>Multicolor</option>
                                        <option value="Grey" {{ old('lenscolor') == "Grey" ? 'selected' : '' }}>Grey</option>
                                        <option value="Purple" {{ old('lenscolor') == "Purple" ? 'selected' : '' }}>Purple</option>
                                        <option value="Hony" {{ old('lenscolor') == "Hony" ? 'selected' : '' }}>Hony</option>
                                        <option value="Sky Blue" {{ old('lenscolor') == "Sky Blue" ? 'selected' : '' }}>Sky Blue</option>
                                        <option value="Voilet" {{ old('lenscolor') == "Voilet" ? 'selected' : '' }}>Voilet</option>
                                        <option value="Black" {{ old('lenscolor') == "Black" ? 'selected' : '' }}>Black</option>
                                        <option value="Clear" {{ old('lenscolor') == "Clear" ? 'selected' : '' }}>Clear</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
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
                                        <option value="Other" {{ old('lenstechnology') == "Other" ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gravity">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" value="{{old('gravity')}}" class="form-control col-md-7 col-xs-12" name="gravity" placeholder="Enter Gravity" type="text">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coating">Coating</label>
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

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coatingcolor">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" value="{{old('coatingcolor')}}" class="form-control col-md-7 col-xs-12" name="coatingcolor" placeholder="Enter Coating Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="abbevalue">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" value="{{old('abbevalue')}}" class="form-control col-md-7 col-xs-12" name="abbevalue" placeholder="Enter Abbe Value" type="text">
                                </div>
                            </div> 

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="netquntity">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" value="{{old('netquntity')}}" class="form-control col-md-7 col-xs-12" name="netquntity" placeholder="Enter Net Quantity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="focallength">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="{{old('focallength')}}" class="form-control col-md-7 col-xs-12" name="focallength" placeholder="Enter Focal Length" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shelflife">Shelf Life</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="{{old('shelflife')}}" class="form-control col-md-7 col-xs-12" name="shelflife" placeholder="Enter Shelf Life" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="formnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form">Form</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="form" value="{{old('form')}}" class="form-control col-md-7 col-xs-12" name="form" placeholder="Enter Form" type="text">
                                </div>
                            </div>

                            
                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productcolor">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="{{old('productcolor')}}" class="form-control col-md-7 col-xs-12" name="productcolor" placeholder="Enter Product Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdim">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="{{old('productdim')}}" class="form-control col-md-7 col-xs-12" name="productdim" placeholder="Enter Product Dimension" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="{{old('material')}}" class="form-control col-md-7 col-xs-12" name="material" placeholder="Enter Product Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="frametype" id="frametype">
                                        <option value="">Select Frame Type</option>
                                        <option value="Full Rim" {{ old('frametype') == "Full Rim" ? 'selected' : '' }}>Full Rim</option>
                                        <option value="Half Rim" {{ old('frametype') == "Half Rim" ? 'selected' : '' }}>Half Rim</option>
                                        <option value="Rim less" {{ old('frametype') == "Rim less" ? 'selected' : '' }}>Rim less</option>
                                    </select>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>
                             <div class="item form-group" id="manufracturernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" value="{{old('manufracturer')}}" class="form-control col-md-7 col-xs-12" name="manufracturer" placeholder=" Enter Manufracturer" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warrentytype">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" value="{{old('warrentytype')}}" class="form-control col-md-7 col-xs-12" name="warrentytype" placeholder="Warrenty Type" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew"> 
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" value="{{old('productdimension')}}" class="form-control col-md-7 col-xs-12" name="productdimension" placeholder="Frame Dimension in cm"  type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" value="{{old('weight')}}" class="form-control col-md-7 col-xs-12" name="weight" placeholder="Product weight in gm" type="number" required>
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{old('height')}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Product Height in cm" type="number">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packageweightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Package Weight <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" value="{{old('packweight')}}" class="form-control col-md-7 col-xs-12" name="packweight" placeholder="Package weight in gm" type="number" required>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packagewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{old('packwidth')}}" class="form-control col-md-7 col-xs-12" name="packwidth" placeholder="Package width in cm" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Package Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{old('packheight')}}" class="form-control col-md-7 col-xs-12" name="packheight" placeholder="Package Height in cm" type="number">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packagelengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Package Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{old('packlength')}}" class="form-control col-md-7 col-xs-12" name="packlength" placeholder="Package Length in cm" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="{{old('hsncode')}}"  id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" placeholder="Hsn Code" type="number">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adminimg"> Current Featured Image <span class="required">*</span>
                                  <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="photo" type="file" required>
                                </div>
                            </div>
                            
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
                                            <input type="file" style="display: none;" name="gallery[]" id="file-ip-1" accept="image/*" class="imagevalidation" data-image_val="1"  onchange="showPreview(event, 1);" required>
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
                            </div>
                            <br>
                            
                            <div class="error">
                                 @if ($errors->has('photo'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Upload Video1
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Upload Video2
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Upload Video3
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
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('price')}}" name="price" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="number" id="selling-price">
                                </div>
                            </div>

                            <div class="error">
                                 @if ($errors->has('price'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP<span class="required">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('previous_price')}}" name="previous_price" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="number">
                                </div>
                            </div>

                            <div class="error">
                                 @if ($errors->has('previous_price'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('previous_price') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Product Cost Price<span class="required">*</span>
                                    
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('costprice')}}" name="costprice" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="number">
                                </div>
                            </div>


                            <!-- end bulk product -->

                            <div class="item form-group" id="stocknew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock<span class="required">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('stock')}}" name="stock" placeholder="e.g 15" pattern="[0-9]{1,10}" type="number">
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
                                            <input type="checkbox" {{ (old('featured') == '1') ? 'checked' : ''}} name="featured" value="1" autocomplete="off">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Product Tags<span class="required">*</span>
                                    <p class="small-label">(Write your product tags Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="tags" value="{{old('tags')}}"  data-role="tagsinput"/>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            

                            <!-- Product Attribute form start here -->

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <!--Add color Attribute-->
                                <div>
                                    <label><input type="checkbox" id="available_pro_color">&nbsp; Available Product Color</label>
                                </div>
                                
                                <div class="col-lg-12" id="product_color_div" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group color_image" id="row-box">
                                                <div id="product_attr">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                    
                                                            <select class="form-control" name="attr_color" class="form-control"  id="attr_color" >
                                                                <option value="">Select Color</option>
                                                                <option value="BLACK" >BLACK</option>
                                                                <option value="GOLD">GOLDEN</option>
                                                                <option value="WHITE">WHITE</option>
                                                                <option value="BROWN">BROWN</option>
                                                                <option value="RED">RED</option>
                                                                <option value="Tortoise">Tortoise</option>
                                                                <option value="Blue">Blue</option>
                                                                <option value="Silver">Silver</option>
                                                                <option value="Grey">Grey</option>
                                                                <option value="Gunmetal">Gunmetal</option>
                                                                <option value="Pink">Pink</option>
                                                                <option value="Beige">Beige</option>
                                                                <option value="green" >green</option>
                                                                <option value="Purple" >Purple</option>
                                                                <option value="Multicolor" >Multicolor</option>
                                                                <option value="Rose Gold">Rose Gold</option>
                                                                <option value="yellow">yellow</option>
                                                                <option value="Orange">Orange</option>
                                                                <option value="Glitter">Glitter</option>
                                                                <option value="Maroon">Maroon</option>
                                                                <option value="Transparent">Transparent</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input name="color_file[]" id="color_file" type="file" multiple class="form-control" aria-required="true" aria-invalid="false" value="" >
                                                        </div>

                                                        <div class="col-md-4">
                                                           <button type="button" class="btn btn-success " id="add_product_color" value="Add">Add</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="color_table" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Color Name</th>
                                                                <th>Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Product Sell Discount -->
                                <div>
                                    <label><span class="required"><input type="checkbox" id="available_pro_whole">&nbsp; Available Product whole sell</span>
                                    </label>
                                </div>
                                
                                <div id="product_whole_div" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">

                                    <table class="table table-striped table-bordered text-center" style="width: 100%;" id="test_Tables">
                                    <th style="border: 1px solid #a9a5a5; text-align: center;">Quantity Limit</th>
                                    <th style="border: 1px solid #a9a5a5; text-align: center;">Discount %</th>
                                    </tr>

                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" name="ranegnameone" id="ranegnameone" placeholder="e.g 11-50">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_one" id="discount_one" placeholder="e.g. 10">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" name="rangenametwo" id="rangenametwo" placeholder="e.g 51-100">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_two" id="discount_two" placeholder="e.g. 20">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" name="rangenamethree" id="rangenamethree" placeholder="e.g 101-150">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_three" id="discount_three" placeholder="e.g. 30">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>

                                <!--Add Product Attribute-->
                                <div>
                                    <label><input type="checkbox" id="manage_pro_attr">&nbsp; Manage Product Attribute </label>
                                </div>
                                
                                <div id="manage_pro_attr_div" style="margin:-2px; display:none; margin-bottom: 10px; ">

                                    <table id="manage_attr_table" style="width: 100%;">
                                        <tbody>
                                            <tr id="1" class="form-group"> 
                                            <td class="col-md-2">
                                                <input type="text" class="form-control att_pro_sku" name="att_pro_sku[]" placeholder="Attr SKU No" />
                                            </td>
                                            <td class="col-md-2">
                                                <input type="text" class="form-control attr_pro_size" name="attr_pro_size[]" placeholder="Size"/>
                                            </td>
                                            <td class="col-md-2">
                                                <input type="number" placeholder="Qty" class="form-control attr_pro_qty" name="attr_pro_qty[]" placeholder="Attr Qty" />
                                            </td>

                                            <td class="col-md-2">
                                                    <input type="number" placeholder="MRP" class="form-control attr_pro_price" name="attr_pro_price[]" placeholder="Attr Size Price" />
                                            </td>
                                            <td class="col-md-3">
                                                <select class="form-control attr_pro_color" name="attr_pro_color[]">
                                                    <option value="0" selected >Select Color</option>
                                                </select>
                                            </td>

                                            <td class="col-md-1">
                                                    <button type="button" class="btn btn-default" style="padding: 0.5rem 0.75rem !important;"><i class="fa fa-plus" onclick="replicateManageTable('manage_attr_table')" ></i>
                                                </button>
                                                </td>
                                            </tr>
                                            <br>
                                        </tbody>

                                    </table>


                                  
                                </div>
                            </div>
                            <!-- Product Attribute form end here -->
                            
                            <div class="modelShaddow"></div>
                            
                            <!----- Popup window for image gallery ----->
                            <div class="pres-model">
                                <div class="prescriptionModel" tabindex="-1" role="dialog">
                                    <div id="data">
                                    </div>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="model-content">
                                            <div class="model-header">
                                                <h3 class="model-title">Product Attribute Image Gallery</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="model-body">
                                                <div class="right-left-data">
                                                    <div class="data-content">
                                                        <div style="display:block;" id="form-model">
                                                            <div class="col-md-12" style="display:flex; justify-content: center; align-items: center;">
                                                                <div style="width: 35%; height: 100%;">
                                                                    <label for="getImage" class="control-label mb-1" id="uploadImage">Attr Image</label>
                                                                    <div>
                                                                        <p class="text-center">Choose Multiple Images</p>
                                                                        <input id="getImage" name="" type="file" aria-required="true" aria-invalid="false" value="" multiple>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div style="display:none;" id="img-model">
                                                            <label for="color-img" class="control-label mb-1 col-sm-12"><p id="num-of-file"></p></label>
                                                            <div class="col-sm-12 scroll-div">
                                                                <button type="button" class="close_img" data-dismiss="modal">&times;</button>
                                                                <div id="showFile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" id="submit-form-button">
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


<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>

<style type="text/css" src="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></style>

<!------------ JavaScript code by Prashant Start here ----------->

<script type="text/javascript">

    var color_datatable;
    $(document).on('click', '#available_pro_color', function(){ 

    var product_id = $('#productsku').val();
    if($(this).is(':checked')) {
         $('#color_table').dataTable({
            'serverSide': true,
            'processing' : true,
            'searching' : false,
            'ordering' : false,
            'paging' : false,
           
            'scrollY': '400px',
            'scrollCollapse': true,
            'info' : false,
            'bDestroy' : true,
            'order': [], 
            'ajax' : {
            'url'  : "{{url('fetch_attr_color_list')}}",
            'data' : {product_id : product_id , '_token' : '{{ csrf_token() }}'},
            'type' : 'POST',
            },
            
            "columns": [
            { data: [0] },
            { data: [1] },
            { data: [2] },
            { data: [3] },
            
            ],

            // "rowReorder": true,
           
        });
    } 
  });

     $('#color_table').DataTable().on( 'row-reorder', function ( e, diff, edit ) {
        var result = 'Reorder started on row: '+edit.triggerRow.data()[0]+'<br>';
 
        for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
            var rowData = $('#color_table').DataTable().row( diff[i].node ).data();
 
            result += rowData[1]+' updated to be in position '+
                diff[i].newData+' (was '+diff[i].oldData+')<br>';
        }
        console.log(result);
        // $('#result').html( 'Event result:<br>'+result );
    } );

    function updateDataTable() {
        console.log('dfs');
    }


     $(document).on('click', "#add_product_color", function(e){
        e.preventDefault();
        let product_id = $('#productsku').val();
        let fileInput = $('#color_file')[0];
        let add_attr_color = $('#attr_color').val();

        if(product_id != '' && add_attr_color != '') {
             if( fileInput.files.length > 0 ){
                let formData = new FormData();
                $.each(fileInput.files, function(k,file){
                    formData.append('images[]', file);
                });

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('color', add_attr_color);
                formData.append('product_id', product_id);
                let url = "{{url('add_product_color')}}";
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    dataType: 'JSON',
                    success: function(resp)
                    {
                        if(resp.status == 200) 
                        {
                            $('#attr_color').val('');
                            $('#color_file').val('');
                            fetch_attr_color_dropdown();
                            $('#color_table').DataTable().ajax.reload();
                        }else {
                            alert(resp.msg);
                        }
                    }
                });
            }else {
               alert('Please select image file first !'); 
            }
        }else {
            alert("Product code and Attribute color can't be empty");
        }
    });

     function fetch_attr_color_dropdown() {
        let id = $('#productsku').val();
        let url = "{{url('fetch_attr_color_dropdown')}}";
        $.ajax({  
            url:url,  
            method:"POST",  
            data:{id:id, '_token' : '{{ csrf_token() }}'}, 
            dataType : 'json', 
            success:function(resp)  
            {  
                if(resp.status == 200) {
                    $('.attr_pro_color').html(resp.data);
                }
                
            }  
        });  
     }

     $(document).on('click', '.delete_color', function(){  
        var id = $(this).attr("id");
        var pro_id = $(this).attr("pro_id");
        if(confirm("Are you sure you want to delete this?"))  
        {  

        let url = "{{url('delete_attr_color')}}";
        $.ajax({  
                url:url,  
                method:"POST",  
                data:{id:id, '_token' : '{{ csrf_token() }}'}, 
                dataType : 'json', 
                success:function(resp)  
                {  
                    if(resp.status == 200) {
                        $('#color_table').DataTable().ajax.reload();
                        $("select[name='attr_pro_color[]']").html(resp.data);
                    }
                    
                }  
            });  
        }  
        else  
        {  
            return false;       
        }  
    }); 

    $(document).on('click', '#available_pro_color', function() {
        if(this.checked) {
           $('#product_color_div').show();
        }else {
            $('#product_color_div').hide();
        }
    });

    $(document).on('click', '#available_pro_whole', function() {
        if(this.checked) {
           $('#product_whole_div').show();
        }else {
            $('#product_whole_div').hide();
        }
    });

    $(document).on('click', '#manage_pro_attr', function() {
        if(this.checked) {
           $('#manage_pro_attr_div').show();
        }else {
            $('#manage_pro_attr_div').hide();
        }
    });

    $(document).on('click', '#available_pro_color', function() {
        if(this.checked) {
           $('#product_color_div').show();
        }else {
            $('#product_color_div').hide();
        }
    });

    $(document).on('click', '#available_pro_size', function() {
        if(this.checked) {
           $('#product_size_div').show();
        }else {
            $('#product_size_div').hide();
        }
    });

    $(document).on('click', '#available_pro_whole', function() {
        if(this.checked) {
           $('#product_whole_div').show();
        }else {
            $('#product_whole_div').hide();
        }
    });

    $(document).on('click', '#manage_pro_attr', function() {
        if(this.checked) {
            fetch_attr_color_dropdown();
           $('#manage_pro_attr_div').show();
        }else {
            $('#manage_pro_attr_div').hide();
        }
    });


    function replicateManageTable(tbl_name) {
        var tbl = '#'+tbl_name;
        let att_pro_sku =  $(tbl).find('tr:last .att_pro_sku').val();
        let attr_pro_size =  $(tbl).find('tr:last .attr_pro_size').val();
        let attr_pro_qty =  $(tbl).find('tr:last .attr_pro_qty').val();
        let attr_pro_price =  $(tbl).find('tr:last .attr_pro_price').val();
        let attr_pro_color =  $(tbl).find('tr:last .attr_pro_color').val();

        if(att_pro_sku != '' && attr_pro_qty != '' && attr_pro_price && attr_pro_color) {
            tbl = $(tbl).find('tr:last');
            tbl = tbl.attr('id');
            var new_id = parseInt(tbl) + 1;
            var myRow = $('#manage_attr_table').closest('table').find('tr:last-child').clone().attr('id', new_id); 
            myRow.find('.att_pro_sku').val("");
            myRow.find('.attr_pro_size').val("");
            myRow.find('.attr_pro_qty').val("");
            myRow.find('.attr_pro_price').val("");
            myRow.find('.attr_pro_color').val("");
            $('#manage_attr_table tr:last').after(myRow);
        }else {
            alert('Fill All Attribute details');
        }
    }



</script>
   
<script type="text/javascript">

    bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('description');
        new nicEditor().panelInstance('policy');
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

   $('#maincats').on('change', function() {
    var select_status = document.getElementById("maincats");
    var categoryname = select_status.options[select_status.selectedIndex].text;
    // alert(strUser); 
    if( categoryname == "Frames" ) {
        $(".sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#contactlenscolornew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
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
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
      
        $('#frameshape').show();
        $('#sellername').show();
        $('#gendernew').show();
        $('.attr_pro_size').removeAttr('readonly', 'readonly');
 }

    else if(categoryname == "Contact Lenses") { 
         $("#sizeAttr").attr('disabled', true);
        $(".sizeCheck").attr('disabled', true);
        $('#catetwonew').hide();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#shapenew').hide();
        $('#gendernew').hide();
        $('#packagewidthnew').show();
        $('#colornew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        
        $('#weightnew').show();
        $('#contactlensmaterialtypenew').show();
        $('#watercontentnew').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#contactlenscolornew').show();
        $('#lenscolornew').hide();
        $('#modelnonew').show();
        $('#lenstechnologynew').hide();
        $('#centerthiknessneww').show();
        $('#usagesdurationnew').show();
        $('#lenstypenew').show();
        
        $('#diameternew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#addpowernew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('.attr_pro_size').attr('readonly', 'readonly');
        
        $('#lenstype').on('change', function() {
            var lensData = document.getElementById("lenstype");
            var lenscategoryname = lensData.options[lensData.selectedIndex].text;
            if( lenscategoryname == "Single Vision" ) {
                
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
                
            }else if( lenscategoryname == "MultiFocal" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').show();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
                
            }else if( lenscategoryname == "toric and Astigmatism" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').show();
                $('#axisneww').show();
                $('#cylindernew').find('option:contains(0.00)').attr('disabled',true); 
                $('#cylindernew').find('option:contains(-0.50)').attr('disabled',true);
                
            }else if( lenscategoryname == "Plano" ) {
                $('#diameternew').show();
                $('#basecurvenew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
            }else {
                $('#diameternew').hide();
                $('#basecurvenew').hide();
                $('#powernewmin').hide();
                $('#powernewmax').hide();
                $('#addpowernew').hide();
                $('#cylinderneww').hide();
                $('#axisneww').hide();
            }
        });

    }else if(categoryname == "Sunglasses"){
         $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
         $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show(); 
         $('#contactlenscolornew').hide();
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
         $('#powernewmin').hide();
         $('#powernewmax').hide();
         $('#disposabilitynew').hide();
         $('#packagingnew').hide();
         $('#lensindexnew').hide();
         $('#focallengthnew').hide();
         $('#shelflifenew').hide();
         $('#formnew').hide();
         $('#productcolornew').hide();
         $('#productdimnew').hide();
         $('#materialnew').hide();
         $('#usagesdurationnew').hide();
         $('#shapenew').show();

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();
        $('#addpowernew').hide();

    }else if(categoryname == "Lenses"){
        $("#sizeAttr").attr('disabled', true);
        $(".sizeCheck").attr('disabled', true);
        $('#lensmaterialtypenew').show();
        $('#diameternew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#contactlenscolornew').hide();
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
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
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
        $('#modelnonew').hide();
        $('#heightnew').hide();

        $('#gravitynew').show();
        $('#coatingcolornew').show();
        $('#abbevaluenew').show();
        $('#netquntitynew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').show();
        $('#coatingnew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();



    }else if(categoryname == "Accessories"){
         $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#productdimensionnew').hide();
        $('#frametypenew').hide();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
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
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#contactlenscolornew').hide();
        $('#lenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#usagesnew').show();
        $('#shelflifenew').show();
        $('#formnew').show();
        $('#productcolornew').show();
        $('#productdimnew').hide();
        $('#materialnew').show();
        $('#warrentytypenew').show();
        $('#weightnew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').show();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#gendernew').hide();
        $('#coatingnew').hide();
        $('#manufracturer').show();
        $('#visioneffectnew').hide();
        $('#framedimensionnew').hide();

    }else if(categoryname == "Premium Brands"){
         $('.attr_pro_size').removeAttr('readonly', 'readonly');
        $(".sizeCheck").attr('disabled', false);
        $('#catetwonew').show();
        $('#packageweightnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#packagewidthnew').show();
        $('#shapenew').show();
        $('#colornew').show();
        $('#framestylenew').hide();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show(); 
        $('#contactlenscolornew').hide();
        $('#lenscolornew').show();
        $('#lenstechnologynew').show();
        $('#warrentytypenew').show();
        $('#productdimensionnew').hide();
        $('#weightnew').show(); 
        $('#frametypenew').hide();
        $('#usagesnew').hide();
        $('#lensmaterialtypenew').show();
        $('#leanscoatingnew').hide();
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#usagesdurationnew').hide();

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessneww').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
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

            if((image_width >= 1160 && image_width <= 1300) && (image_height >= 1160 && image_height <= 1300)) {
               if(fileSize > 110) {
                    $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " Size large");
                    myImgRemove(serial);
                } 
            }
    
            else {
                myImgRemove(serial);
                $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " size should between 1300px and 1160px");
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
  $('#diameter').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
  });
</script>

<script>
  $('#powermin').select2({
    width: '100%',
    placeholder: "Select Min Power",
    allowClear: true
  });
  
  $('#powermax').select2({
    width: '100%',
    placeholder: "Select Max Power",
    allowClear: true
  });
 </script>
 
 <script>
  $('#basecurve').select2({
    width: '100%',
    placeholder: "Select Base curve",
    allowClear: true
  });
 </script>
 
 <script>
  $('#cylindernew').select2({
    width: '100%',
    placeholder: "Select cylinder",
    allowClear: true
  });
 </script>
 
 <script>
  $('#addpower').select2({
    width: '100%',
    placeholder: "Select  Power",
    allowClear: true
  });
 </script>

<script>
  $('#axisnew').select2({
    width: '100%',
    placeholder: "Select Axis",
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
    //     $('#contactlenscolornew').hide();
    //     $('#lenstechnologynew').show();
    //     $('#lensindexnew').show();
    //     $('#focallengthnew').show();
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