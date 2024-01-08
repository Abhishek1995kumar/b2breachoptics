@extends('admin.includes.master-admin')
<style type="text/css">
    .error{
        padding-left: 310px;
    }
</style>

<style>
    /* Popup Window CSS Start */

    .show-prescription {
        width: 100%;
    }

    .swal2-container.swal2-center > .swal2-popup {
        font-size: 16px;
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
        background-color: #ace8cd
    }

    .close_imgs{
        display:flex;
        justify-content: center;
        align-items: center;
        width: 20px;
        height: 20px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 3px;
        background-color: #ace8cd
    }
    
    #img-model{
        width: 100%;
        height: 100%;
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
        flex-direction: row;
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

    .prescriptionModel, .prescriptionModel_1, .prescriptionModel_2, .prescriptionModel_3, .prescriptionModel_4, .prescriptionModel_5, .prescriptionModel_6 {
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
        z-index: 100;
    }

    .prescriptionModel_7, .prescriptionModel_8, .prescriptionModel_9, .prescriptionModel_10, .prescriptionModel_11, .prescriptionModel_12 {
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
        z-index: 100;
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

    .close, .close_1, .close_2, .close_3, .close_4, .close_5, .close_6, .close_7, .close_8, .close_9, .close_10, .close_11, .close_12 {
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

    .close:hover, .close_1:hover, .close_2:hover, .close_3:hover, .close_4:hover, .close_5:hover {
        border-radius: 30px;
        background-color: rgb(241, 235, 235);
    }

    .close_6:hover, .close_7:hover, .close_8:hover, .close_9:hover, .close_10:hover, .close_11:hover, .close_12:hover {
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
                    <h3>Update Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <form method="POST" action="{!! action('ProductController@update',['id' => $product->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" value="{{$product->title}}" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
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
                                            @if($product->category[0] == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control"  multiple="multiple" name="subid[]" id="subs">
                                        <option value="">Select Sub Category</option>

                                        <?php foreach($subs as $row => $key) {
                                            if(in_array($key->id, $demo_new)) {
                                                echo "<option value=".$key->id." selected>".$key->name."</option>";
                                            } else {
                                                echo "<option value=".$key->id.">".$key->name."</option>";
                                            }
                                        } ?>


                                    </select>
                                </div>
                            </div>

                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="childid[]" id="childs">
                                        <option value="">Select Child Category</option>
                                        <?php foreach($child as $row => $key) {
                                            if(in_array($key->id, $dd)) {
                                                echo "<option value=".$key->id." selected>".$key->name."</option>";
                                            } else {
                                                echo "<option value=".$key->id.">".$key->name."</option>";
                                            }
                                        } ?>


                                    </select>
                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category-1<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="cateone" id="cateone" required>
                                        <option value="{{$product->cateone}}">{{$product->cateone}}</option>
                                        <option value="CAT 1">CAT 1</option>
                                        <option value="GBF">GBF</option>
                                        <option value="GBH">GBH</option>
                                        <option value="GFSV">GFSV</option>
                                    </select>
                                </div>
                            </div> -->

                             <!-- <div class="item form-group" id="catetwonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category-2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control" name="catetwo" id="catetwo" >
                                        <option value="{{$product->catetwo}}">{{$product->catetwo}}</option>
                                        <option value="DBF">DBF</option>
                                        <option value="CAT2">CAT2</option>
                                        <option value="THICK SIDE ">THICK SIDE </option>
                                        <option value="CLEAR">CLEAR</option>
                                    </select>
                                </div>
                            </div> -->

                               <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Make<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control" name="make" id="make" required>
                                        <option value="{{$product->make}}">{{$product->make}}</option>
                                        <option value="METAL">METAL</option>
                                        <option value="SHELL">SHELL</option>
                                        <option value="RIMLESS">RIMLESS</option>
                                        <option value="METAL PLASTIC">METAL PLASTIC</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="item form-group" id="shapenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="shape" id="shape" >
                                        <option value="{{$product->shape}}">{{$product->shape}}</option>
                                        <option value="Round">Round</option>
                                        <option value="Square">Square</option>
                                        <option value="Oval">Oval</option>
                                        <option value="Rectangle">Rectangle</option>
                                        <option value="Cat eye">Cat eye</option>
                                        <option value="Geometric">Geometric</option>
                                        <option value="Brow line">Brow line</option>
                                        <option value="Aviator">Aviator</option>
                                        <option value="Wayfarer">Wayfarer</option>
                                        <option value="Pilot">Pilot</option>
                                        <option value="Wrap">Wrap</option>
                                        <option value="Wayfarer">Wayfarer</option>
                                        <option value="Oversized">Oversized</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="colornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Frame Color </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
                                        <option value="{{$product->color}}">{{$product->color}}</option>
                                        <option value="BLACK">BLACK</option>
                                        <option value="GOLDEN">GOLDEN</option>
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
                                        <option value="green">green</option>
                                        <option value="Purple">Purple</option>
                                        <option value="Multicolor">Multicolor</option>
                                        <option value="Rose Gold">Rose Gold</option>
                                        <option value="yellow">yellow</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Glitter">Glitter</option>
                                        <option value="Maroon">Maroon</option>
                                        <option value="Transparent">Transparent</option>
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="gender" id="gender" >
                                        <option value="{{$product->gender}}">{{$product->gender}}</option>
                                        <option value="MEN">Male</option>
                                        <option value="WOMEN">Female</option>
                                        <option value="KIDS">Kids</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>
                            </div>


                            <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandname">Brand Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname" >
                                        <option value="{{$product->brandname}}">{{$product->brandname}}</option>
                                        <option value="Adriano Cross">Adriano Cross</option>
                                        <option value="Alcon">Alcon</option>
                                        <option value="Azzaro">Azzaro</option>
                                        <option value="Johnson And Johnson">Johnson And Johnson</option>
                                        <option value="Bausch And Lomb">Bausch And Lomb</option>
                                        <option value="Cooper Vision">Cooper Vision</option>
                                        <option value="CL India">CL India</option>
                                        <option value="Asian Eyewear">Asian Eyewear</option>
                                        <option value="Vision Care Lab">Vision Care Lab</option>
                                        <option value="Zeiss">Zeiss</option>
                                        <option value="Hoya">Hoya</option>
                                        <option value="Purvesh">Purvesh</option>
                                        <option value="Prime">Prime</option>
                                        <option value="Boss">Boss</option>
                                        <option value="Boss Orange">Boss Orange</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Carrera Ducati">Carrera Ducati</option>
                                        <option value="Dior">Dior</option>
                                        <option value="Dior Homme">Dior Homme</option>
                                        <option value="Elie Saab">Elie Saab</option>
                                        <option value="E=mc2">E=mc2</option>
                                        <option value="Fendi">Fendi</option>
                                        <option value="Fossil">Fossil</option>
                                        <option value="Givenchy">Givenchy</option>
                                        <option value="Havaianas">Havaianas</option>
                                        <option value="Isabel Marant">Isabel Marant</option>
                                        <option value="Jimmy Choo">Jimmy Choo</option>
                                        <option value="Juicy Couture">Juicy Couture</option>
                                        <option value="Kate Spade">Kate Spade</option>
                                        <option value="Levis">Levis</option>
                                        <option value="M Missoni">M Missoni</option>
                                        <option value="Marc By Marc Jacobs">Marc By Marc Jacobs</option>
                                        <option value="Marc Jacobs">Marc Jacobs</option>
                                        <option value="Max & Co.">Max & Co.</option>
                                        <option value="Max Mara">Max Mara</option>
                                        <option value="Missoni">Missoni</option>
                                        <option value="Moschino">Moschino</option>
                                        <option value="Moschino Love">Moschino Love</option>
                                        <option value="Oxydo">Oxydo</option>
                                        <option value="Pierre Cardin">Pierre Cardin</option>
                                        <option value="Polaroid">Polaroid</option>
                                        <option value="Polaroid Ancillaries">Polaroid Ancillaries</option>
                                        <option value="Polaroid Kids">Polaroid Kids</option>
                                        <option value="Polaroid Premium">Polaroid Premium</option>
                                        <option value="Polaroid Reading Glasses">Polaroid Reading Glasses</option>
                                        <option value="Polaroid Sport">Polaroid Sport</option>
                                        <option value="Polaroid Staysafe">Polaroid Staysafe</option>
                                        <option value="Rag&Bone">Rag&Bone</option>
                                        <option value="Safilo">Safilo</option>
                                        <option value="Safilo By Marcel Wanders">Safilo By Marcel Wanders</option>
                                        <option value="Seventh Street">Seventh Street</option>
                                        <option value="Smith">Smith</option>
                                        <option value="Stepper">Stepper</option>
                                        <option value="Tommy Hilfiger">Tommy Hilfiger</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <!-- Start new input fields added as per category  -->

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                        <option selected value="{{$product->lenstype}}">{{$product->lenstype}}</option>
                                        <option value="Spherical" {{ old('lenstype') == "Spherical" ? 'selected' : '' }}>Single Vision</option>
                                        <option value="MultiFocal" {{ old('lenstype') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>
                                        <option value="toric & Astigmatism" {{ old('lenstype') == "toric & Astigmatism" ? 'selected' : '' }}>toric & Astigmatism</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth"> Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framewidth" value="{{$product->framewidth}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height"> Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{$product->height}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Enter Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usagesduration"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="{{$product->usagesduration}}" class="form-control col-md-7 col-xs-12" name="usagesduration" placeholder="Enter Usages Duration" type="text">
                                </div>
                            </div>

                             {{-- <div class="item form-group" id="conditionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="condition">Conditions</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="condition" value="{{$product->conditionsnew}}" class="form-control col-md-7 col-xs-12" name="conditionsnew" placeholder="Conditions" type="text">
                                </div>
                            </div> --}}

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text">
                                </div>
                            </div>

                            <!--<div class="item form-group" id="framestylenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Style</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framestyle" id="framestyle" >
                                        <option value="{{$product->framestyle}}">{{$product->framestyle}}</option>
                                        <option value="Cat eye">Cat eye</option>
                                        <option value="Geometric">Geometric</option>
                                        <option value="Brow line">Brow line</option>
                                        <option value="Aviator">Aviator</option>
                                        <option value="Wayfarer">Wayfarer</option>
                                        <option value="Pilot">Pilot</option>
                                        <option value="Wrap">Wrap</option>
                                        <option value="Wayfarer">Wayfarer</option>
                                        <option value="Oversized">Oversized</option>
                                    </select>
                                </div>
                            </div>-->

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial" >
                                        <option value="{{$product->framematerial}}">{{$product->framematerial}}</option>
                                        <option value="Plastic">Plastic</option>
                                        <option value="Acetate">Acetate</option>
                                        <option value="Metal">Metal</option>
                                        <option value="Stainless Steel">Stainless Steel</option>
                                        <option value="Titanium">Titanium</option>
                                        <option value="TR90">TR90</option>
                                        <option value="Ultem">Ultem</option>
                                        <option value="Wood">Wood</option>
                                        <option value="Monel">Monel</option>
                                        <option value="Aluminium">Aluminium</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="usagesnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usages"> Usages</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usages" value="{{$product->usages}}"  class="form-control col-md-7 col-xs-12" name="usages" placeholder="Enter Usages" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templematerial">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="{{$product->templematerial}}" class="form-control col-md-7 col-xs-12" name="templematerial" placeholder="Temple Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templecolor">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="{{$product->templecolor}}" class="form-control col-md-7 col-xs-12" name="templecolor" placeholder="Temple Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype" >
                                        <option value="{{$product->lensmaterialtype}}">{{$product->lensmaterialtype}}</option>
                                        <option value="CR-39">CR-39</option>
                                        <option value="MR-8">MR-8</option>
                                        <option value="PNX">PNX</option>
                                        <option value="Trivex">Trivex</option>
                                        <option value="Blue Cantrol">Blue Cantrol</option>
                                        <option value="Tribrid">Tribrid</option>
                                        <option value="High Index Plastic">High Index Plastic</option>
                                        <option value="Polycarbonate">Polycarbonate</option>
                                        <option value="Crown Glass">Crown Glass</option>
                                        <option value="MR-7">MR-7</option>
                                        <option value="PGX">PGX</option>
                                        <option value="PBX">PBX</option>
                                        <option value="Mid Index">Mid Index</option>
                                    </select>
                                </div>
                            </div>


                            <div class="item form-group" id="leanscoatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leanscoating">Lens coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="leanscoating" value="{{$product->leanscoating}}" class="form-control col-md-7 col-xs-12" name="leanscoating" placeholder="Lens coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrdiam = explode(',',$product->diameter);
                                    ?>
                                     <select class="form-control" multiple="multiple" name="diameter[]" id="diameter">
                                        <option  <?=(in_array("14", $arrdiam)  ? 'selected' : '');?> value="14">14</option>
                                        <option <?=(in_array("14.2", $arrdiam)  ? 'selected' : '');?> value="14.2">14.2</option>
                                        <option <?=(in_array("14.1", $arrdiam)  ? 'selected' : '');?> value="14.1">14.1</option>
                                        <option <?=(in_array("14.5", $arrdiam)  ? 'selected' : '');?> value="14.5" >14.5</option>
                                        <option <?=(in_array("13.8", $arrdiam)  ? 'selected' : '');?>  value="13.8" >13.8</option>
                                        <option <?=(in_array("14.3", $arrdiam)  ? 'selected' : '');?> value="14.3" >14.3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactlensmaterialtype">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="{{$product->contactlensmaterialtype}}" class="form-control col-md-7 col-xs-12" name="contactlensmaterialtype" placeholder="Contact Lens Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrBCcurve = explode(',',$product->basecurve);
                                    ?>
                                     <select class="form-control" multiple="multiple" name="basecurve[]" id="basecurve">
                                        <option  <?=(in_array("8.5", $arrBCcurve)  ? 'selected' : '');?> value="8.5">8.5</option>
                                        <option <?=(in_array("8.6", $arrBCcurve)  ? 'selected' : '');?> value="8.6">8.6</option>
                                        <option  <?=(in_array("8.4", $arrBCcurve)  ? 'selected' : '');?> value="8.4">8.4</option>
                                        <option  <?=(in_array("8.9", $arrBCcurve)  ? 'selected' : '');?> value="8.9">8.9</option>
                                        <option  <?=(in_array("8.7", $arrBCcurve)  ? 'selected' : '');?> value="8.7">8.7</option>
                                        <option  <?=(in_array("9", $arrBCcurve)  ? 'selected' : '');?> value="9">9</option>
                                        <option  <?=(in_array("8.8", $arrBCcurve)  ? 'selected' : '');?> value="8.8">8.8</option>
                                        <option  <?=(in_array("8.3", $arrBCcurve)  ? 'selected' : '');?> value="8.3">8.3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="watercontent">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{$product->watercontent}}" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmin">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "(" ?><i class="fa fa-minus"></i> <?php echo ")" ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMinspere = explode(',',$product->powermin);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="powermin[]" id="powermin">
                                        <option  <?=(in_array("0", $arrMinspere)  ? 'selected' : '');?> value="0">0</option>
                                        <option  <?=(in_array("-0.25", $arrMinspere)  ? 'selected' : '');?> value="-0.25">-0.25</option>
                                        <option <?=(in_array("-0.50", $arrMinspere)  ? 'selected' : '');?> value="-0.50">-0.50</option>
                                        <option  <?=(in_array("-0.75", $arrMinspere)  ? 'selected' : '');?> value="-0.75">-0.75</option>
                                        <option  <?=(in_array("-1", $arrMinspere)  ? 'selected' : '');?> value="-1">-1</option>
                                        <option  <?=(in_array("-1.25", $arrMinspere)  ? 'selected' : '');?> value="-1.25">-1.25</option>
                                        <option  <?=(in_array("-1.50", $arrMinspere)  ? 'selected' : '');?> value="-1.50">-1.50</option>
                                        <option  <?=(in_array("-1.75", $arrMinspere)  ? 'selected' : '');?> value="-1.75">-1.75</option>
                                        <option  <?=(in_array("-2", $arrMinspere)  ? 'selected' : '');?> value="-2">-2</option>
                                        <option  <?=(in_array("-2.25", $arrMinspere)  ? 'selected' : '');?> value="-2.25">-2.25</option>
                                        <option  <?=(in_array("-2.50", $arrMinspere)  ? 'selected' : '');?> value="-2.50">-2.50</option>
                                        <option  <?=(in_array("-2.75", $arrMinspere)  ? 'selected' : '');?> value="-2.75">-2.75</option>
                                        <option  <?=(in_array("-3", $arrMinspere)  ? 'selected' : '');?> value="-3">-3</option>
                                        <option  <?=(in_array("-3.25", $arrMinspere)  ? 'selected' : '');?> value="-3.25">-3.25</option>
                                        <option  <?=(in_array("-3.50", $arrMinspere)  ? 'selected' : '');?> value="-3.50">-3.50</option>
                                        <option  <?=(in_array("-3.75", $arrMinspere)  ? 'selected' : '');?> value="-3.75">-3.75</option>
                                        <option  <?=(in_array("-4", $arrMinspere)  ? 'selected' : '');?> value="-4">-4</option>
                                        <option  <?=(in_array("-4.25", $arrMinspere)  ? 'selected' : '');?> value="-4.25">-4.25</option>
                                        <option  <?=(in_array("-4.50", $arrMinspere)  ? 'selected' : '');?> value="-4.50">-4.50</option>
                                        <option  <?=(in_array("-4.75", $arrMinspere)  ? 'selected' : '');?> value="-4.75">-4.75</option>
                                        <option  <?=(in_array("-5", $arrMinspere)  ? 'selected' : '');?> value="-5">-5</option>
                                        <option <?=(in_array("-5.25", $arrMinspere)  ? 'selected' : '');?> value="-5.25">-5.25</option>
                                        <option  <?=(in_array("-5.50", $arrMinspere)  ? 'selected' : '');?> value="-5.50">-5.50</option>
                                        <option  <?=(in_array("-5.75", $arrMinspere)  ? 'selected' : '');?> value="-5.75">-5.75</option>
                                        <option  <?=(in_array("-6", $arrMinspere)  ? 'selected' : '');?> value="-6">-6</option>
                                        <option <?=(in_array("-6.25", $arrMinspere)  ? 'selected' : '');?> value="-6.25">-6.25</option>
                                        <option  <?=(in_array("-6.50", $arrMinspere)  ? 'selected' : '');?> value="-6.50">-6.50</option>
                                        <option  <?=(in_array("-6.75", $arrMinspere)  ? 'selected' : '');?> value="-6.75">-6.75</option>
                                        <option  <?=(in_array("-7", $arrMinspere)  ? 'selected' : '');?> value="-7">-7</option>
                                        <option <?=(in_array("-7.25", $arrMinspere)  ? 'selected' : '');?> value="-7.25">-7.25</option>
                                        <option  <?=(in_array("-7.50", $arrMinspere)  ? 'selected' : '');?> value="-7.50">-7.50</option>
                                        <option  <?=(in_array("-7.75", $arrMinspere)  ? 'selected' : '');?> value="-7.75">-7.75</option>
                                        <option  <?=(in_array("-8", $arrMinspere)  ? 'selected' : '');?> value="-8">-8</option>
                                        <option  <?=(in_array("-8.25", $arrMinspere)  ? 'selected' : '');?> value="-8.25">-8.25</option>
                                        <option  <?=(in_array("-8.50", $arrMinspere)  ? 'selected' : '');?> value="-8.50">-8.50</option>
                                        <option  <?=(in_array("-8.75", $arrMinspere)  ? 'selected' : '');?> value="-8.75">-8.75</option>
                                        <option  <?=(in_array("-9", $arrMinspere)  ? 'selected' : '');?> value="-9">-9</option>
                                        <option  <?=(in_array("-9.25", $arrMinspere)  ? 'selected' : '');?> value="-9.25">-9.25</option>
                                        <option  <?=(in_array("-9.50", $arrMinspere)  ? 'selected' : '');?> value="-9.50">-9.50</option>
                                        <option  <?=(in_array("-9.75", $arrMinspere)  ? 'selected' : '');?> value="-9.75">-9.75</option>
                                        <option  <?=(in_array("-10<", $arrMinspere)  ? 'selected' : '');?> value="-10<">-10</option>
                                        <option  <?=(in_array("-10.25", $arrMinspere)  ? 'selected' : '');?> value="-10.25">-10.25</option>
                                        <option <?=(in_array("-10.50", $arrMinspere)  ? 'selected' : '');?> value="-10.50">-10.50</option>
                                        <option  <?=(in_array("-10.75", $arrMinspere)  ? 'selected' : '');?> value="-10.75">-10.75</option>
                                        <option  <?=(in_array("-11", $arrMinspere)  ? 'selected' : '');?> value="-11">-11</option>
                                        <option  <?=(in_array("-11.25", $arrMinspere)  ? 'selected' : '');?> value="-11.25">-11.25</option>
                                        <option  <?=(in_array("-11.50", $arrMinspere)  ? 'selected' : '');?> value="-11.50">-11.50</option>
                                        <option  <?=(in_array("-11.75", $arrMinspere)  ? 'selected' : '');?> value="-11.75">-11.75</option>

                                        <option  <?=(in_array("-12", $arrMinspere)  ? 'selected' : '');?> value="-12">-12</option>
                                        <option  <?=(in_array("-12.25", $arrMinspere)  ? 'selected' : '');?> value="-12.25">-12.25</option>
                                        <option  <?=(in_array("-12.50", $arrMinspere)  ? 'selected' : '');?> value="-12.50">-12.50</option>
                                        <option  <?=(in_array("-12.75", $arrMinspere)  ? 'selected' : '');?> value="-12.75">-12.75</option>

                                        <option  <?=(in_array("-13", $arrMinspere)  ? 'selected' : '');?> value="-13">-13</option>
                                        <option  <?=(in_array("-13.25", $arrMinspere)  ? 'selected' : '');?> value="-13.25">-13.25</option>
                                        <option  <?=(in_array("-13.50", $arrMinspere)  ? 'selected' : '');?> value="-13.50">-13.50</option>
                                        <option  <?=(in_array("-13.75", $arrMinspere)  ? 'selected' : '');?> value="-13.75">-13.75</option>

                                        <option  <?=(in_array("-14", $arrMinspere)  ? 'selected' : '');?> value="-14">-14</option>
                                        <option  <?=(in_array("-14.25", $arrMinspere)  ? 'selected' : '');?> value="-14.25">-14.25</option>
                                        <option  <?=(in_array("-14.50", $arrMinspere)  ? 'selected' : '');?> value="-14.50">-14.50</option>
                                        <option  <?=(in_array("-14.75", $arrMinspere)  ? 'selected' : '');?> value="-14.75">-14.75</option>

                                        <option  <?=(in_array("-15", $arrMinspere)  ? 'selected' : '');?> value="-15">-15</option>
                                        <option  <?=(in_array("-15.25", $arrMinspere)  ? 'selected' : '');?> value="-15.25">-15.25</option>
                                        <option  <?=(in_array("-15.50", $arrMinspere)  ? 'selected' : '');?> value="-15.50">-15.50</option>
                                        <option  <?=(in_array("-15.75", $arrMinspere)  ? 'selected' : '');?> value="-15.75">-15.75</option>

                                        <option  <?=(in_array("-16", $arrMinspere)  ? 'selected' : '');?> value="-16">-16</option>
                                        <option  <?=(in_array("-16.25", $arrMinspere)  ? 'selected' : '');?> value="-16.25">-16.25</option>
                                        <option  <?=(in_array("-16.50", $arrMinspere)  ? 'selected' : '');?> value="-16.50">-16.50</option>
                                        <option  <?=(in_array("-16.75", $arrMinspere)  ? 'selected' : '');?> value="-16.75">-16.75</option>

                                        <option  <?=(in_array("-17", $arrMinspere)  ? 'selected' : '');?> value="-17">-17</option>
                                        <option  <?=(in_array("-17.25", $arrMinspere)  ? 'selected' : '');?> value="-17.25">-17.25</option>
                                        <option  <?=(in_array("-17.50", $arrMinspere)  ? 'selected' : '');?> value="-17.50">-17.50</option>
                                        <option  <?=(in_array("-17.75", $arrMinspere)  ? 'selected' : '');?> value="-17.75">-17.75</option>

                                        <option  <?=(in_array("-18", $arrMinspere)  ? 'selected' : '');?> value="-18">-18</option>
                                        <option  <?=(in_array("-18.25", $arrMinspere)  ? 'selected' : '');?> value="-18.25">-18.25</option>
                                        <option  <?=(in_array("-18.50", $arrMinspere)  ? 'selected' : '');?> value="-18.50">-18.50</option>
                                        <option  <?=(in_array("-18.75", $arrMinspere)  ? 'selected' : '');?> value="-18.75">-18.75</option>

                                        <option  <?=(in_array("-19", $arrMinspere)  ? 'selected' : '');?> value="-19">-19</option>
                                        <option  <?=(in_array("-19.25", $arrMinspere)  ? 'selected' : '');?> value="-19.25">-19.25</option>
                                        <option  <?=(in_array("-19.50", $arrMinspere)  ? 'selected' : '');?> value="-19.50">-19.50</option>
                                        <option  <?=(in_array("-19.75", $arrMinspere)  ? 'selected' : '');?> value="-19.75">-19.75</option>
                                        <option  <?=(in_array("-20", $arrMinspere)  ? 'selected' : '');?> value="-20">-20</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "(" ?><i class="fa fa-plus"></i> <?php echo ")" ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMaxspere = explode(',',$product->powermax);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="powermax[]" id="powermax">
                                        <option  <?=(in_array("0", $arrMaxspere)  ? 'selected' : '');?> value="0">0</option>
                                        <option  <?=(in_array("0.25", $arrMaxspere)  ? 'selected' : '');?> value="0.25">0.25</option>
                                        <option <?=(in_array("0.50", $arrMaxspere)  ? 'selected' : '');?> value="0.50">0.50</option>
                                        <option  <?=(in_array("0.75", $arrMaxspere)  ? 'selected' : '');?> value="0.75">0.75</option>
                                        <option  <?=(in_array("1", $arrMaxspere)  ? 'selected' : '');?> value="1">1</option>
                                        <option  <?=(in_array("1.25", $arrMaxspere)  ? 'selected' : '');?> value="1.25">1.25</option>
                                        <option  <?=(in_array("1.50", $arrMaxspere)  ? 'selected' : '');?> value="1.50">1.50</option>
                                        <option  <?=(in_array("1.75", $arrMaxspere)  ? 'selected' : '');?> value="1.75">1.75</option>
                                        <option  <?=(in_array("2", $arrMaxspere)  ? 'selected' : '');?> value="2">2</option>
                                        <option  <?=(in_array("2.25", $arrMaxspere)  ? 'selected' : '');?> value="2.25">2.25</option>
                                        <option  <?=(in_array("2.50", $arrMaxspere)  ? 'selected' : '');?> value="2.50">2.50</option>
                                        <option  <?=(in_array("2.75", $arrMaxspere)  ? 'selected' : '');?> value="2.75">2.75</option>
                                        <option  <?=(in_array("3", $arrMaxspere)  ? 'selected' : '');?> value="3">3</option>
                                        <option  <?=(in_array("3.25", $arrMaxspere)  ? 'selected' : '');?> value="3.25">3.25</option>
                                        <option  <?=(in_array("3.50", $arrMaxspere)  ? 'selected' : '');?> value="3.50">3.50</option>
                                        <option  <?=(in_array("3.75", $arrMaxspere)  ? 'selected' : '');?> value="3.75">3.75</option>
                                        <option  <?=(in_array("4", $arrMaxspere)  ? 'selected' : '');?> value="4">4</option>
                                        <option  <?=(in_array("4.25", $arrMaxspere)  ? 'selected' : '');?> value="4.25">4.25</option>
                                        <option  <?=(in_array("4.50", $arrMaxspere)  ? 'selected' : '');?> value="4.50">4.50</option>
                                        <option  <?=(in_array("4.75", $arrMaxspere)  ? 'selected' : '');?> value="4.75">4.75</option>
                                        <option  <?=(in_array("5", $arrMaxspere)  ? 'selected' : '');?> value="5">5</option>
                                        <option <?=(in_array("5.25", $arrMaxspere)  ? 'selected' : '');?> value="5.25">5.25</option>
                                        <option  <?=(in_array("5.50", $arrMaxspere)  ? 'selected' : '');?> value="5.50">5.50</option>
                                        <option  <?=(in_array("5.75", $arrMaxspere)  ? 'selected' : '');?> value="5.75">5.75</option>
                                        <option  <?=(in_array("6", $arrMaxspere)  ? 'selected' : '');?> value="6">6</option>
                                        <option <?=(in_array("6.25", $arrMaxspere)  ? 'selected' : '');?> value="6.25">6.25</option>
                                        <option  <?=(in_array("6.50", $arrMaxspere)  ? 'selected' : '');?> value="6.50">6.50</option>
                                        <option  <?=(in_array("6.75", $arrMaxspere)  ? 'selected' : '');?> value="6.75">6.75</option>
                                        <option  <?=(in_array("7", $arrMaxspere)  ? 'selected' : '');?> value="7">7</option>
                                        <option <?=(in_array("7.25", $arrMaxspere)  ? 'selected' : '');?> value="7.25">7.25</option>
                                        <option  <?=(in_array("7.50", $arrMaxspere)  ? 'selected' : '');?> value="7.50">7.50</option>
                                        <option  <?=(in_array("7.75", $arrMaxspere)  ? 'selected' : '');?> value="7.75">7.75</option>
                                        <option  <?=(in_array("8", $arrMaxspere)  ? 'selected' : '');?> value="8">8</option>
                                        <option  <?=(in_array("8.25", $arrMaxspere)  ? 'selected' : '');?> value="8.25">8.25</option>
                                        <option  <?=(in_array("8.50", $arrMaxspere)  ? 'selected' : '');?> value="8.50">8.50</option>
                                        <option  <?=(in_array("8.75", $arrMaxspere)  ? 'selected' : '');?> value="8.75">8.75</option>
                                        <option  <?=(in_array("9", $arrMaxspere)  ? 'selected' : '');?> value="9">9</option>
                                        <option  <?=(in_array("9.25", $arrMaxspere)  ? 'selected' : '');?> value="9.25">9.25</option>
                                        <option  <?=(in_array("9.50", $arrMaxspere)  ? 'selected' : '');?> value="9.50">9.50</option>
                                        <option  <?=(in_array("9.75", $arrMaxspere)  ? 'selected' : '');?> value="9.75">9.75</option>

                                        <option  <?=(in_array("10<", $arrMaxspere)  ? 'selected' : '');?> value="10<">10</option>
                                        <option  <?=(in_array("10.25", $arrMaxspere)  ? 'selected' : '');?> value="10.25">10.25</option>
                                        <option  <?=(in_array("10.50", $arrMaxspere)  ? 'selected' : '');?> value="10.50">10.50</option>
                                        <option  <?=(in_array("10.75", $arrMaxspere)  ? 'selected' : '');?> value="10.75">10.75</option>

                                        <option  <?=(in_array("11", $arrMaxspere)  ? 'selected' : '');?> value="11">11</option>
                                        <option  <?=(in_array("11.25", $arrMaxspere)  ? 'selected' : '');?> value="11.25">11.25</option>
                                        <option  <?=(in_array("11.50", $arrMaxspere)  ? 'selected' : '');?> value="11.50">11.50</option>
                                        <option  <?=(in_array("11.75", $arrMaxspere)  ? 'selected' : '');?> value="11.75">11.75</option>

                                        <option  <?=(in_array("12", $arrMaxspere)  ? 'selected' : '');?> value="12">12</option>
                                        <option  <?=(in_array("12.25", $arrMaxspere)  ? 'selected' : '');?> value="12.25">12.25</option>
                                        <option  <?=(in_array("12.50", $arrMaxspere)  ? 'selected' : '');?> value="12.50">12.50</option>
                                        <option  <?=(in_array("-12.75", $arrMaxspere)  ? 'selected' : '');?> value="-12.75">-12.75</option>

                                        <option  <?=(in_array("13", $arrMaxspere)  ? 'selected' : '');?> value="13">13</option>
                                        <option  <?=(in_array("13.25", $arrMaxspere)  ? 'selected' : '');?> value="13.25">13.25</option>
                                        <option  <?=(in_array("13.50", $arrMaxspere)  ? 'selected' : '');?> value="13.50">13.50</option>
                                        <option  <?=(in_array("13.75", $arrMaxspere)  ? 'selected' : '');?> value="13.75">13.75</option>

                                        <option  <?=(in_array("14", $arrMaxspere)  ? 'selected' : '');?> value="14">14</option>
                                        <option  <?=(in_array("14.25", $arrMaxspere)  ? 'selected' : '');?> value="14.25">14.25</option>
                                        <option  <?=(in_array("14.50", $arrMaxspere)  ? 'selected' : '');?> value="14.50">14.50</option>
                                        <option  <?=(in_array("14.75", $arrMaxspere)  ? 'selected' : '');?> value="14.75">14.75</option>

                                        <option  <?=(in_array("15", $arrMaxspere)  ? 'selected' : '');?> value="15">15</option>
                                        <option  <?=(in_array("15.25", $arrMaxspere)  ? 'selected' : '');?> value="15.25">15.25</option>
                                        <option  <?=(in_array("15.50", $arrMaxspere)  ? 'selected' : '');?> value="15.50">15.50</option>
                                        <option  <?=(in_array("15.75", $arrMaxspere)  ? 'selected' : '');?> value="15.75">15.75</option>

                                        <option  <?=(in_array("16", $arrMaxspere)  ? 'selected' : '');?> value="16">16</option>
                                        <option  <?=(in_array("16.25", $arrMaxspere)  ? 'selected' : '');?> value="16.25">16.25</option>
                                        <option  <?=(in_array("16.50", $arrMaxspere)  ? 'selected' : '');?> value="16.50">16.50</option>
                                        <option  <?=(in_array("16.75", $arrMaxspere)  ? 'selected' : '');?> value="16.75">16.75</option>

                                        <option  <?=(in_array("17", $arrMaxspere)  ? 'selected' : '');?> value="17">17</option>
                                        <option  <?=(in_array("17.25", $arrMaxspere)  ? 'selected' : '');?> value="17.25">17.25</option>
                                        <option  <?=(in_array("17.50", $arrMaxspere)  ? 'selected' : '');?> value="17.50">17.50</option>
                                        <option  <?=(in_array("17.75", $arrMaxspere)  ? 'selected' : '');?> value="17.75">17.75</option>

                                        <option  <?=(in_array("18", $arrMaxspere)  ? 'selected' : '');?> value="18">18</option>
                                        <option  <?=(in_array("18.25", $arrMaxspere)  ? 'selected' : '');?> value="18.25">18.25</option>
                                        <option  <?=(in_array("18.50", $arrMaxspere)  ? 'selected' : '');?> value="18.50">18.50</option>
                                        <option  <?=(in_array("18.75", $arrMaxspere)  ? 'selected' : '');?> value="18.75">18.75</option>

                                        <option  <?=(in_array("19", $arrMaxspere)  ? 'selected' : '');?> value="19">19</option>
                                        <option  <?=(in_array("19.25", $arrMaxspere)  ? 'selected' : '');?> value="19.25">19.25</option>
                                        <option  <?=(in_array("19.50", $arrMaxspere)  ? 'selected' : '');?> value="19.50">19.50</option>
                                        <option  <?=(in_array("19.75", $arrMaxspere)  ? 'selected' : '');?> value="19.75">19.75</option>
                                        <option  <?=(in_array("20", $arrMaxspere)  ? 'selected' : '');?> value="20">20</option>
                                    </select>
                                </div>
                            </div>

                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="centerthikness">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" value="{{$product->centerthiknessnew}}" class="form-control col-md-7 col-xs-12" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="cylinderneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylinder = explode(',',$product->cylindernew);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="cylindernew[]" id="cylindernew" >
                                        <option  <?=(in_array("0", $arrSpecialitycylinder)  ? 'selected' : '');?> value="0">0</option>
                                        <option  <?=(in_array("-0.5<", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-0.5<">-0.5</option>
                                        <option  <?=(in_array("-0.75", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-0.75">-0.75</option>
                                        <option  <?=(in_array("-1", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-1">-1</option>
                                        <option  <?=(in_array("-1.25", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-1.25">-1.25</option>
                                        <option  <?=(in_array("-1.5", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-1.5">-1.5</option>
                                        <option  <?=(in_array("-1.75", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-1.75">-1.75</option>
                                        <option  <?=(in_array("-2", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-2">-2</option>
                                        <option  <?=(in_array("-2.25", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-2.25">-2.25</option>
                                        <option  <?=(in_array("-2.50", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-2.50">-2.50</option>
                                        <option  <?=(in_array("-2.75", $arrSpecialitycylinder)  ? 'selected' : '');?> value="-2.75">-2.75</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpeciality = explode(',',$product->axisnew);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="axisnew[]" id="axisnew" >
                                        <option <?=(in_array("10", $arrSpeciality)  ? 'selected' : '');?> value="10">10</option>
                                        <option <?=(in_array("20", $arrSpeciality)  ? 'selected' : '');?> value="20">20</option>
                                        <option <?=(in_array("30", $arrSpeciality)  ? 'selected' : '');?> value="30">30</option>
                                        <option <?=(in_array("40", $arrSpeciality)  ? 'selected' : '');?> value="40">40</option>
                                        <option <?=(in_array("50", $arrSpeciality)  ? 'selected' : '');?> value="50">50</option>
                                        <option <?=(in_array("60", $arrSpeciality)  ? 'selected' : '');?> value="60">60</option>
                                        <option <?=(in_array("70", $arrSpeciality)  ? 'selected' : '');?> value="70">70</option>
                                        <option <?=(in_array("80", $arrSpeciality)  ? 'selected' : '');?> value="80">80</option>
                                        <option <?=(in_array("90", $arrSpeciality)  ? 'selected' : '');?> value="90">90</option>
                                        <option <?=(in_array("100", $arrSpeciality)  ? 'selected' : '');?> value="100">100</option>
                                        <option <?=(in_array("110", $arrSpeciality)  ? 'selected' : '');?> value="110">110</option>
                                        <option <?=(in_array("120", $arrSpeciality)  ? 'selected' : '');?> value="120">120</option>
                                        <option <?=(in_array("130", $arrSpeciality)  ? 'selected' : '');?> value="130">130</option>
                                        <option <?=(in_array("140", $arrSpeciality)  ? 'selected' : '');?> value="140">140</option>
                                        <option <?=(in_array("150", $arrSpeciality)  ? 'selected' : '');?> value="150">150</option>
                                        <option <?=(in_array("160", $arrSpeciality)  ? 'selected' : '');?> value="160">160</option>
                                        <option <?=(in_array("170", $arrSpeciality)  ? 'selected' : '');?> value="170">170</option>
                                        <option <?=(in_array("180", $arrSpeciality)  ? 'selected' : '');?> value="180">180</option>
                                        <option <?=(in_array("190", $arrSpeciality)  ? 'selected' : '');?> value="190">190</option>
                                        <option <?=(in_array("200", $arrSpeciality)  ? 'selected' : '');?> value="200">200</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability" >
                                        <option value="{{$product->disposability}}">{{$product->disposability}}</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging" >
                                        <option value="{{$product->packaging}}">{{$product->packaging}}</option>
                                        <option value="1 Lens Per Box">1 Lens Per Box</option>
                                        <option value="2 Lens Per Box">2 Lens Per Box</option>
                                        <option value="3 Lens Per Box">3 Lens Per Box</option>
                                        <option value="5 Lens Per Box">5 Lens Per Box</option>
                                        <option value="6 Lens Per Box">6 Lens Per Box</option>
                                        <option value="6 Lens Per Box">10 Lens Per Box</option>
                                        <option value="12 Lens Per box">12 Lens Per box</option>
                                        <option value="30 Lens Per Box">30 Lens Per Box</option>
                                        <option value="6 Lens Per Box">90 Lens Per Box</option>
                                    </select>
                                </div>
                            </div>

                            @if($product->category[0] == 58 || $product->category[0] == 63 || $product->category[0] == 82)
                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="lenscolor" >
                                        <option value="{{$product->color}}">{{$product->color}}</option>
                                        <option value="grey">Grey</option>
                                        <option value="blue" >Blue</option>
                                        <option value="green" >Green</option>
                                        <option value="brown" >Brown</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="pink" >Pink</option>
                                        <option value="black">Black</option>
                                        <option value="clear">Clear</option>
                                        <option value="multicolor">Multicolor</option>
                                        <option value="orange">Orange</option>
                                        <option value="red">Red</option>
                                        <option value="silver">Silver</option>
                                        <option value="golden">Golden</option>
                                        <option value="maroon">Maroon</option>
                                        <option value="voilet">Voilet</option>
                                        <option value="Sky Blue">Sky Blue</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($product->category[0] == 72)
                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Contact Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="{{$product->lenscolor}}">{{$product->lenscolor}}</option>
                                        <option value="grey">Grey</option>
                                        <option value="blue" >Blue</option>
                                        <option value="green" >Green</option>
                                        <option value="brown" >Brown</option>
                                        <option value="turquois">Turquois</option>
                                        <option value="hazel" >Hazel</option>
                                        <option value="black">Black</option>
                                        <option value="voilet">Voilet</option>
                                        <option value="Sky Blue">Sky Blue</option>
                                        <option value="purple">Purple</option>
                                        <option value="multicolor">Multicolor</option>
                                        <option value="hony">Hony</option>
                                        <option value="clear">Clear</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstechnology" id="lenstechnology" >
                                        <option value="{{$product->lenstechnology}}">{{$product->lenstechnology}}</option>
                                        <option value="Mirror Coating">Mirror Coating</option>
                                        <option value="Scratch Resistant Coating">Scratch Resistant Coating</option>
                                        <option value="Anti-Fog Coating">Anti-Fog Coating</option>
                                        <option value="Anti-Reflective Coating">Anti-Reflective Coating</option>
                                        <option value="Water Resistant Coating">Water Resistant Coating</option>
                                        <option value="UV Protection Coating">UV Protection Coating</option>
                                        <option value="Blue Control Coating">Blue Control Coating</option>
                                        <option value="Polarized">Polarized</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex" >
                                        <option value="{{$product->lensindex}}">{{$product->lensindex}}</option>
                                        <option value="1.49">1.49</option>
                                        <option value="1.5">1.5</option>
                                        <option value="1.53">1.53</option>
                                        <option value="1.55">1.55</option>
                                        <option value="1.56">1.56</option>
                                        <option value="1.59">1.59</option>
                                        <option value="1.6">1.6</option>
                                        <option value="1.61">1.61</option>
                                        <option value="1.67">1.67</option>
                                        <option value="1.7">1.7</option>
                                        <option value="1.74">1.74</option>
                                        <option value="1.8">1.8</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="gravitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gravity">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" class="form-control col-md-7 col-xs-12" value="{{$product->gravity}}" name="gravity" placeholder="Enter Gravity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="visioneffect">Lens Type </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" >
                                        <option value="{{$product->visioneffect}}">{{$product->visioneffect}}</option>
                                        <option value="Biofocal">Biofocal</option>
                                        <option value="Progressive">Progressive</option>
                                        <option value="Zero Power">Zero Power</option>
                                        <option value="single Vision">single Vision</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coating">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coating" value="{{$product->coating}}" class="form-control col-md-7 col-xs-12" name="coating" placeholder="Enter Coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityadd = explode(',',$product->addpower);
                                    ?>
                                     <select class="form-control" multiple="multiple" name="addpower[]" id="addpower">
                                         <option  <?=(in_array("0.75", $arrSpecialityadd)  ? 'selected' : '');?> value="0.75">0.75</option>
                                         <option  <?=(in_array("1", $arrSpecialityadd)  ? 'selected' : '');?> value="1">1</option>
                                         <option  <?=(in_array("1.25", $arrSpecialityadd)  ? 'selected' : '');?> value="1.25">1.25</option>
                                         <option  <?=(in_array("1.5", $arrSpecialityadd)  ? 'selected' : '');?> value="1.5">1.5</option>
                                         <option  <?=(in_array("1.75", $arrSpecialityadd)  ? 'selected' : '');?> value="1.75">1.75</option>
                                         <option  <?=(in_array("2", $arrSpecialityadd)  ? 'selected' : '');?> value="2">2</option>
                                         <option  <?=(in_array("2.25", $arrSpecialityadd)  ? 'selected' : '');?> value="2.25">2.25</option>
                                         <option  <?=(in_array("2.75", $arrSpecialityadd)  ? 'selected' : '');?> value="2.75">2.75</option>
                                         <option  <?=(in_array("3", $arrSpecialityadd)  ? 'selected' : '');?> value="3">3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coatingcolor">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" class="form-control col-md-7 col-xs-12" value="{{$product->coatingcolor}}" name="coatingcolor" placeholder="Enter Coating Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="abbevalue">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" class="form-control col-md-7 col-xs-12" value="{{$product->abbevalue}}" name="abbevalue" placeholder="Enter Abbe Value" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="netquntity">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" class="form-control col-md-7 col-xs-12" value="{{$product->netquntity}}" name="netquntity" placeholder="Enter Net Quantity" type="text">
                                </div>
                            </div>


                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="focallength">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="{{$product->focallength}}" class="form-control col-md-7 col-xs-12" name="focallength" placeholder="Enter Focal Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shelflife">Shelf Life</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="{{$product->shelflife}}" class="form-control col-md-7 col-xs-12" name="shelflife" placeholder="Enter Shelf Life" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="formnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Form</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="form" value="{{$product->form}}" class="form-control col-md-7 col-xs-12" name="form" placeholder="Enter Form" type="text">
                                </div>
                            </div>


                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productcolor">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="{{$product->productcolor}}" class="form-control col-md-7 col-xs-12" name="productcolor" placeholder="Enter Product Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdim">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="{{$product->productdim}}" class="form-control col-md-7 col-xs-12" name="productdim" placeholder="Enter Product Dimension" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="{{$product->material}}" class="form-control col-md-7 col-xs-12" name="material" placeholder="Enter Product Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="frametype" id="frametype" >
                                        <option value="{{$product->frametype}}">{{$product->frametype}}</option>
                                        <option value="fullrim">Full Rim</option>
                                        <option value="halfrim">Half Rim</option>
                                        <option value="rimless">Rimless</option>
                                    </select>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>

                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" class="form-control col-md-7 col-xs-12" value="{{$product->manufracturer}}" name="manufracturer" placeholder=" Enter Manufracturer" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warrentytype">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" class="form-control col-md-7 col-xs-12" value="{{$product->warrentytype}}" name="warrentytype" placeholder="Warrenty Type" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" name="productdimension" placeholder="Product Dimension"  type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" class="form-control col-md-7 col-xs-12" value="{{$product->weight}}" name="weight" placeholder="Product Weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageweightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packweight">Package Weight <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packweight" value="{{$product->packweight}}" class="form-control col-md-7 col-xs-12" name="packweight" placeholder="Package weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{$product->packwidth}}" class="form-control col-md-7 col-xs-12" name="packwidth" placeholder="Package width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packheight">Package Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packheight" value="{{$product->packheight}}" class="form-control col-md-7 col-xs-12" name="packheight" placeholder="Package Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagelengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packlength">Package Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packlength" value="{{$product->packlength}}" class="form-control col-md-7 col-xs-12" name="packlength" placeholder="Package Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="countryoforigin" id="countryoforigin" >
                                        <option value="{{$product->countryoforigin}}">{{$product->countryoforigin}}</option>
                                        @foreach($countryoforigin as $item)
                                          <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" value="{{$product->hsncode}}" placeholder="Hsn Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFile"> Current Featured Image <span class="required">*</span>
                                <p class="small-label">(1300 Ã— 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="{{url('assets/images/products')}}/{{$product->feature_image}}" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" name="photo" value="{{$product->feature_image}}" type="file">
                                    {{--<div id="uploadTrigger" onclick="uploadclick()" style="white-space: normal;" class="form-control btn btn-default"><i class="fa fa-upload"></i> Add Featured Image</div>--}}
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="galdel" value="1"/>
                                            Delete Old Gallery Images</label>
                                    </div>

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo1"> Upload Video1
                                  <!-- <p class="small-label">(250 Ã— 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video}}" id="adminvideo"  type="video/mp4">
                                    </video>
                                    <!-- <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added"> -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo1" accept="video/*" name="video" type="file">
                                </div>
                            </div>

                            <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo2"> Upload Video2
                                  <!-- <p class="small-label">(250 Ã— 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video1}}" id="adminvideo1"  type="video/mp4">
                                    </video>
                                    <!-- <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added"> -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo2" accept="video/*" name="video1" type="file">
                                </div>
                            </div>

                            <!-- <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo3"> Upload Video3
                                  <!-- <p class="small-label">(250 Ã— 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video2}}" id="adminvideo2"  type="video/mp4">
                                    </video>
                                    <!-- <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added"> -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo3" accept="video/*" name="video2" type="file">
                                </div>
                            </div>

                            <!-- <div class="error">
                                 @if ($errors->has('video'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                            </div> -->


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Product Gallery Images <span class="required">*</span>
                                <p class="small-label">(1300 Ã— 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!-- <input type="file" id="file-input" accept="image/*" name="gallery[]" multiple/> -->
                                     <div class="input-group hdtuto control-group lst increment" >

                                      <input type="file" name="gallery[]" class="myfrm form-control imagevalidation" data-image_val="1">

                                      <div class="input-group-btn">

                                        <button id="addimg" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>

                                      </div>

                                    </div>
                                    <div id="image1" class="error">
                                       <span class="help-block">
                                        <strong style="color: red;"></strong>
                                        </span>
                            </div>

                                    <div class="clone hide">

                                      <div class="hdtuto control-group lst input-group" style="margin-top:10px">

                                        <input type="file" name="gallery[]" class="myfrm form-control imagevalidation">

                                        <div class="input-group-btn">

                                          <button id="removeimg" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Remove</button>

                                        </div>

                                      </div>

                                    </div>
                                    <br>
                                    <div class="slide">
                                        @foreach ($gallery as $num)
                                            <img width="30%" style="padding: 10px;" src="{{ url('assets/images/gallery/' . $num->image) }}">
                                            <a href = "{{URL::to('/img/destroy/'.$num->id)}}" class="btn btn-danger">Delete</a>
                                        @endforeach

                                    </div>


                                    <div id="thumb-output"></div>

                                    <p class="small-label">Multiple Image Allowed</p>
                                </div>
                            </div>
                            <div id="image" class="error">
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

                            <!--@if($product->sizes != null)-->
                            <!--<div class="item form-group">-->
                            <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">-->
                            <!--    </label>-->
                            <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--        <div class="checkbox">-->
                            <!--            <label><input type="checkbox" name="pallow" id="allow" value="1" checked><strong>Allow Product Sizes</strong></label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="item form-group" id="pSizes">-->
                            <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>-->
                            <!--        <p class="small-label">(Write your own size Separated by Comma[,])</p>-->
                            <!--    </label>-->
                            <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--        <input class="form-control col-md-7 col-xs-12" name="sizes" value="{{$product->sizes}}" data-role="tagsinput"/>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--@else-->
                            <!--    <div class="item form-group">-->
                            <!--        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">-->
                            <!--        </label>-->
                            <!--        <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--            <div class="checkbox">-->
                            <!--                <label><input type="checkbox" name="pallow" id="allow" value="1"><strong>Allow Product Sizes</strong></label>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="item form-group" id="pSizes" style="display: none;">-->
                            <!--        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>-->
                            <!--            <p class="small-label">(Write your own size Separated by Comma[,])</p>-->
                            <!--        </label>-->
                            <!--        <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--            <input class="form-control col-md-7 col-xs-12" name="sizes" value="X,XL,XXL,M,L,S" data-role="tagsinput"/>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--@endif-->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="description" class="form-control" rows="6">{{$product->description}}</textarea>
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
                                    <input id="selling-price" class="form-control col-md-7 col-xs-12" name="price" value="{{$product->price}}" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP<span class="required">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="previous_price" value="{{$product->previous_price}}" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Cost Price<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="costprice" value="{{$product->costprice}}" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                                 <!-- for bulk product -->

                        @if($product->ranegnameone != null)
                             <div class="item form-group" id="bulk">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="bulkrange" id="bulkrange" value="1" checked><strong>Available Bulk Discount</strong></label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group" id="bulkfield">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <table class="table table-striped">
                                      <thead>
                                        <tr>

                                          <th scope="col">Range</th>
                                          <th scope="col">Discount<?php echo " %" ?></th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><input type="text" value="{{$product->ranegnameone}}" name="ranegnameone"></td>
                                          <td><input type="number" value="{{$product->discount_one}}" name="discount_one"></td>

                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{$product->rangenametwo}}" name="rangenametwo"></td>
                                          <td><input type="number" value="{{$product->discount_two}}" name="discount_two"></td>

                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{$product->rangenamethree}}" name="rangenamethree"></td>
                                          <td><input type="number" value="{{$product->discount_three}}" name="discount_three"></td>

                                        </tr>
                                      </tbody>
                                    </table>
                                </div>


                            </div>
                        @else
                                <div class="item form-group" id="bulk">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="bulkrange" id="bulkrange" value="1"><strong>Available Bulk Discount</strong></label>
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
                                          <th scope="col">Discount<?php echo " %" ?></th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><input type="text"  name="ranegnameone"></td>
                                          <td><input type="number"  name="discount_one"></td>

                                        </tr>
                                        <tr>
                                          <td><input type="text"  name="rangenametwo"></td>
                                          <td><input type="number"  name="discount_two"></td>

                                        </tr>
                                        <tr>
                                          <td><input type="text"  name="rangenamethree"></td>
                                          <td><input type="number"  name="discount_three"></td>

                                        </tr>
                                      </tbody>
                                    </table>
                                </div>


                            </div>

                            @endif



                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(2 - 49 Pieces)<span class="">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{$product->p40pieces}}" name="p40pieces" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places."  type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(50 - 4999 Pieces)
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="p51pieces" value="{{$product->p51pieces}}" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places."  type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Price For(>=5000 Pieces)
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="p5000pieces" value="{{$product->p5000pieces}}" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places."  type="text">
                                </div>
                            </div> -->
                            <!-- end bulk product -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock<span class="required">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="stock" value="{{$product->stock}}" placeholder="e.g 15" pattern="[0-9]{1,10}" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="policy" class="form-control" rows="6">{{$product->policy}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags<span class="required">*</span>
                                    <p class="small-label">(Write your product tags Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="tags" value="{{$product->tags}}" data-role="tagsinput"/>
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
                                        @if($product->featured == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="featured" value="1" autocomplete="off" checked>
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                 Featured Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="featured" value="1" autocomplete="off">
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                 Featured Product
                                            </label>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                         @if($product->tranding == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="tranding" value="1" autocomplete="off" checked>
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                Tranding Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="tranding" value="1" autocomplete="off">
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                Tranding Product
                                            </label>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    @if($product->tranding == 1)
                                        <label class="btn btn-default active">
                                            <input type="checkbox" name="tranding" value="1" autocomplete="off" checked>
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Tranding Product
                                        </label>
                                    @else
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="tranding" value="1" autocomplete="off">
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Tranding Product
                                        </label>
                                    @endif
                                </div>
                            </div> -->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-6">
                                        @if($product->latest == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="latest" value="1" autocomplete="off" checked>
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                 Latest Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="latest" value="1" autocomplete="off">
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                 Latest Product
                                            </label>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        @if($product->selected == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="selected" value="1" autocomplete="off" checked>
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                Selected Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="selected" value="1" autocomplete="off">
                                                <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                                Selected Product
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <?php
                                $new_array = array();
                                foreach($attrData as $data){
                                    $attimages = DB::table('product_attr_gallery')->select('*')->where('color', $data->attr_color)->orwhere('paid', $data->id)->get()->toArray();


                                    array_push($new_array, $attimages);
                                }
                                $images_array = [];

                                $color_with_image_array = array();
                                for($i=0; $i<count($new_array); $i++) {
                                    $color_with_image= array();
                                    // $color_with_image = array("color"=>$new_array[$i][0]->color);
                                    $color_with_image['color'] = $new_array[$i][0]->color;
                                    for($j=0; $j<count($new_array[$i]); $j++){
                                       $color_with_image['images'][$j] = $new_array[$i][$j]->attr_imgs;
                                       $color_with_image['ids'][$j] = $new_array[$i][$j]->id;
                                    }
                                    array_push($color_with_image_array, $color_with_image);
                                }
                                // echo "<pre>";
                                // print_r($color_with_image_array);

                            //     $color_data = new stdClass();
                            //    $color_img_array = array();

                                // for($i=0; $i<count($new_array); $i++){
                                //     $img_array = array();
                                //     $color_data->color =  $new_array[$i][0]->color;
                                //     for($j=0; $j<count($new_array[$i]); $j++){
                                //         array_push($img_array, $new_array[$i][$j]->attr_imgs);
                                //         $color_data->images =  $img_array;
                                //     }
                                //     array_push($color_img_array, $color_data);
                                //     // print_r($color_data->images);
                                // }
                                //     echo "<pre>";
                                //     print_r($color_img_array);
                                //     for($i=0;$i<count($color_img_array);$i++){
                                //         // print_r($color_img_array[$i]);
                                //         // print_r($color_img_array[$i]->images);
                                //     }

                            ?>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    @if($product->selected == 1)
                                        <label class="btn btn-default active">
                                            <input type="checkbox" name="selected" value="1" autocomplete="off" checked>
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Selected Product
                                        </label>
                                    @else
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="selected" value="1" autocomplete="off">
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Selected Product
                                        </label>
                                    @endif
                                </div>
                            </div> -->

                            <div class="ln_solid"></div>

                            {{-- @foreach($attrData as $color)
                                @foreach($attrImages as $data)
                                    @for($i=0; $i<count($data); $i++)
                                        @if($color->attr_color == $data[$i]->color)
                                            @php
                                                echo "<pre>";
                                                print_r($color->attr_color);
                                                print_r($data[$i]->color);
                                            @endphp
                                            @continue
                                        @endif
                                    @endfor
                                @endforeach
                            @endforeach --}}

                            <?php
                                // echo "<pre>";
                                // print_r($attrData);

                                // $attimages = DB::table('product_attr_gallery')->select('*')->where('color', 'black')->orwhere('paid', 7)->get();
                                // echo "<pre>";
                                // print_r($attimages);

                                // $attimages = DB::table('product_attr_gallery')->select('*')->where('color', 'grey')->orwhere('paid', 8)->get();
                                // echo "<pre>";
                                // print_r($attimages);


                                // echo "<pre>";
                                // print_r($new_array);
                            ?>

                            <!-- Product Attribute form start here -->

                            <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                            @if(count($attrData) > 0)
                            <div class="col-md-9 col-sm-6 col-xs-12">
                                <!--Add color Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" checked class="colorCheck">&nbsp; Allow Product Color</span>
                                    </label>
                                </div>

                                @php
                                    $color_loop_count = 0;
                                @endphp

                                <div class="col-lg-12" id="color_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group color_image" id="row-box">

                                                {{-- //vishal --}}
                                                <?php
                                                $productColorObj = array();
                                                ?>


                                                <?php
                                                   
                                                    $new_array = array();
                                                    $color_counts=0;
                                                    $attimages = array();
                                                    foreach($attrData as $data){
                                                        $attimages = DB::table('product_attr_gallery')->select('*')->where('paid', $data->id)->where('color', $data->attr_color)->get()->toArray();
                                                        
                                                        // vishal
                                                        // echo "<pre>";
                                                        // print_r($attimages);
                                                        $colorId =  $color_counts > 0 ? ('colorpicker_'.$color_counts) : ('colorpicker');
                                                        $productColorObj[$colorId] = $data->attr_color;
                                                        
                                                        array_push($new_array, $attimages);
                                                        $color_counts++;
                                                    }

                                                    $color_with_image_array = array();
                                                    for($i=0; $i<count($new_array); $i++) {
                                                        $color_with_image= array();
                                                        // $color_with_image = array("color"=>$new_array[$i][0]->color);
                                                            
                                                        if(count($new_array[$i]) > 0){
                                                            $color_with_image['color'] = $new_array[$i][0]->color;
                                                            for($j=0; $j<count($new_array[$i]); $j++){
                                                            $color_with_image['images'][$j] = $new_array[$i][$j]->attr_imgs;
                                                            $color_with_image['ids'][$j] = $new_array[$i][$j]->id;
                                                            }
                                                            array_push($color_with_image_array, $color_with_image);
                                                        }
                                                    }
                                                    // echo "<pre>";
                                                    // print_r($color_with_image_array);
                                                    // die();
                                                    for($l=0; $l<count($color_with_image_array); $l++){
                                                        // echo "<pre>";
                                                        // print_r($color_with_image_array);
                                                ?>
                                                <div id="product_attr<?php $l > 0 ? print_r('_'.$l) : print_r(''); ?>"  data="{{$color_loop_count++}}" class="attr_color_div{{$color_with_image_array[$l]['ids'][0]}}">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label for="color" class="control-label mb-1">Product Color</label>
                                                            <div style="display:flex;">

                                                                <input onchange="colorAppendOnSelect(event)" id="colorpicker<?php $l > 0 ? print_r('_'.$l) : print_r(''); ?>" name="imgColor[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$color_with_image_array[$l]['color']}}" readonly>

                                                               {{-- <input id="colorpicker" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$color_with_image_array[$l]['color']}}"> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="color" class="control-label mb-1">Attr Images</label>
                                                            <div class="show-prescription">
                                                                <button class="showPrescription<?php $l > 0 ? print_r('_'.$l) : print_r(''); ?>" type="button">Image Gellery</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                                <?php $productColorObj = json_encode($productColorObj); 
                                                ?>
                                                 <input type="hidden" id="productColorObj" value='<?php  echo $productColorObj; ?>'>
                                                 <input type="hidden" id="color_loop_count" value="<?php echo $color_counts; ?>">

                                                <div class="modelShaddow"></div>

                                                <!----- Popup window for image gallery ----->
                                                <div class="pres-model">
                                                    <?php
                                                    if(count($color_with_image_array) > 0){
                                                        for($k=0; $k<count($color_with_image_array); $k++) {
                                                    ?>
                                                    <div class="prescriptionModel<?php $k > 0 ? print_r('_'.$k) : print_r(''); ?>" tabindex="-1" role="dialog">
                                                        <div id="data">
                                                            <input type="hidden" name="count[]" value="{{$k}}">
                                                        </div>
                                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                                            <div class="model-content">
                                                                <div class="model-header">
                                                                    <h3 class="model-title">Product Attribute Image Gallery</h3>
                                                                    <button type="button" class="close<?php $k > 0 ? print_r('_'.$k) : print_r(''); ?>" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="model-body">

                                                                    <div class="right-left-data">
                                                                        <div class="data-content">
                                                                            <div style="display: none;" id="form-model">
                                                                                <div class="col-md-12" style="display:flex; justify-content: center; align-items: center;">
                                                                                    <div style="width: 35%; height: 100%;">
                                                                                        <label for="getImage" class="control-label mb-1" id="uploadImage">Attr Image</label>
                                                                                        <input id="getImage" name="" type="file" aria-required="true" aria-invalid="false" value="{{$count}}" multiple>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="img-model">
                                                                                <label for="color-img" class="control-label mb-1 col-sm-12"><p id="num-of-file">{{$count}}</p></label>
                                                                                <div class="col-sm-12 scroll-div">
                                                                                    <button type="button" class="close_img" data-dismiss="modal">&times;</button>
                                                                                    <div id="showFile">
                                                                                        <?php
                                                                                        if(count($color_with_image_array[$k]['images']) > 0){
                                                                                        for($m=0; $m<count($color_with_image_array[$k]['images']); $m++) {
                                                                                        ?>
                                                                                        <div class="img-div">
                                                                                            <a type="button" class="close_imgs_{{$color_with_image_array[$k]['ids'][$m]}}" onclick="removeImg({{$color_with_image_array[$k]['ids'][$m]}})" style="opacity: 0; position: absolute; cursor: pointer; text-align: center; text-decoration: none; z-index: 1;" onmouseover="showDelete({{$color_with_image_array[$k]['ids'][$m]}})"><button type="button" class="btn btn-danger">Delete</button></a>
                                                                                            <a href="{{url('assets/images/product_attr')}}/{{$color_with_image_array[$k]['images'][$m]}}" target="_blank">
                                                                                                <img class="imageModel" src="{{url('assets/images/product_attr')}}/{{$color_with_image_array[$k]['images'][$m]}}" onmouseover="hideDelete({{$color_with_image_array[$k]['ids'][$m]}})">
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php } } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-9 color_add_more">
                                                <div style="display:flex; justify-content:center; margin-top: 10px;">
                                                    <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_more()">Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----product attribute count ---->
                                <input type="hidden" id="product_attr_count" value="<?php echo count($color_with_image_array); ?>">

                                <!--Add size Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" checked id="sizeCheck">&nbsp; Allow Product Size</span>
                                    </label>
                                </div>

                                <div class="col-lg-12" id="size_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group product_sizes">
                                                <?php $i=0;
                                                $productSizeObj = array();
                                                ?>
                                                @foreach($attrData as $data)
                                                <?php
                                                    $sizeId =  $i > 0 ? ('getSize_'.$i) : ('getSize');
                                                    $productSizeObj[$sizeId] = $data->attr_size;
                                                ?>
                                                @if($data->attr_size != '')
                                                    <div class="row" id="size_group">
                                                        <div class="col-md-9">
                                                            <label for="size" class="control-label mb-1">Product Size</label>
                                                            <div style="display:flex;">
                                                                <input onchange="sizeAppendOnSelect(event)" id="getSize<?php $i > 0 ? print_r('_'.$i) : print_r(''); ?>" type="text" class="form-control" value="{{$data->attr_size}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <?php $i++; ?>
                                                @endforeach
                                                <?php $productSizeObj = json_encode($productSizeObj);
                                                ?>
                                                <input type="hidden" id="productSizeObj" value='<?php echo $productSizeObj; ?>'>
                                                <input type="hidden" id="size_loop_count" value="<?php echo $i; ?>">
                                            </div>
                                            <div style="display:flex; justify-content:center; margin-top: 10px;">
                                                <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_size()">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Product Sell Discount -->
                                <!--<div>-->
                                <!--    <label><span class="required"><input type="checkbox" checked class="productSellCheck">&nbsp; Allow Product whole sell</span>-->
                                <!--    </label>-->
                                <!--</div>-->

                                <!--<div id="product_sell_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">-->
                                <!--    <input id="paid" type="hidden" value="">-->
                                <!--    <div class="card" id="">-->
                                <!--        <div class="card-body">-->
                                <!--            <div class="form-group" id="add_product_sell">-->
                                <!--                <div class="row">-->
                                <!--                    <div class="row-sell-data">-->
                                <!--                        <div class="col-md-4">-->
                                <!--                           <label for="color" class="control-label mb-1">Limit Quantity</label>-->
                                <!--                           <div>-->
                                <!--                               <input class="col-sm-12" id="product_range" name="ranegnameone" type="text" value="{{$product->ranegnameone}}">-->
                                <!--                           </div>-->
                                <!--                        </div>-->

                                <!--                        <div class="col-md-4">-->
                                <!--                           <label for="color" class="control-label mb-1">Discount %</label>-->
                                <!--                           <div>-->
                                <!--                               <input class="col-sm-12" id="percent" name="discount_one" type="text" value="{{$product->discount_one}}">-->
                                <!--                           </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--            <div style="display:flex; justify-content:center; margin-top: 10px;">-->
                                <!--               <button type="button" class="btn btn-primary" onclick="add_discount()" style="width: 200px;">Add More</button>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--Add Product Attribute-->

                                    <div>
                                        <label><span class="required"><input type="checkbox" checked class="productCheck">&nbsp; Manage Product Attribute</span>
                                        </label>
                                    </div>
                                    
                                    @php
                                        $attr_count = 0;
                                    @endphp

                                    <div id="product_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                        <div class="card" id="">
                                            <div class="card-body">
                                                <input type="hidden" id="total_row_count" value="<?php echo count($attrData); ?>">
                                                <div class="form-group product_attr_data">
                                                    <?php $product_attr_row_count = 0;?>
                                                    @foreach($attrData as $data)
                                                    <div class="row" id="product_attr_div_{{$data->id}}">
                                                        <input type="hidden" name="id[]" value="{{$data->id}}">
                                                        <input id="paid" type="hidden" name="product_id" value="{{$data->product_id}}">
                                                        <div class="row-data" id="{{$attr_count++}}">
                                                            <div class="col-md-4">
                                                                <label for="color" class="control-label mb-1">Attr SKU</label>
                                                                <div>
                                                                    <input id="attr_sku" name="attr_sku[]" type="text" style="width: 100%; height: 30px;" value="{{$data->attr_sku}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="color" class="control-label mb-1">Size</label>
                                                                <div>
                                                                    <select id="sizeAttr<?php $product_attr_row_count > 0 ? print_r('_'.$product_attr_row_count) : print_r(''); ?>" name="attr_size[]" style="width: 100%; height: 30px;">
                                                                        <!-- <option value="{{$data->attr_size}}" selected>{{$data->attr_size}}</option> -->
                                                                        <option value="">select size</option>
                                                                        @foreach($attrData as $size)
                                                                            <?php if($data->attr_size == $size->attr_size){ ?>
                                                                                <option selected value="{{$size->attr_size}}">{{$size->attr_size}}</option>
                                                                            <?php }else{ ?>
                                                                                <option  value="{{$size->attr_size}}">{{$size->attr_size}}</option>
                                                                           <?php } ?>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="color" class="control-label mb-1">Qty</label>
                                                                <div>
                                                                    <input id="attr_qty" name="attr_qty[]" type="text" style="width: 100%; height: 30px;" value="{{$data->attr_qty}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="color" class="control-label mb-1">Price</label>
                                                                <div>
                                                                    <input id="attr_price" name="attr_price[]" type="price" style="width: 100%; height: 30px;" value="{{$data->attr_price}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="color" class="control-label mb-1">Color</label>
                                                                <div>
                                                                    <select id="colorAttr<?php $product_attr_row_count > 0 ? print_r('_'.$product_attr_row_count) : print_r(''); ?>" name="attr_color[]" style="width: 100%; height: 30px; ">
                                                                        <option value="">Please Select Color</option>
                                                                        @foreach($attrData as $color)
                                                                            <?php if($color->attr_color == $data->attr_color){ ?>

                                                                            <option  selected  value="{{$color->attr_color}}"> {{$color->attr_color}} </option>
                                                                            <?php } else{ ?>
                                                                                <option   value="{{$color->attr_color}}"> {{$color->attr_color}} </option>
                                                                                <?php } ?>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-1">
                                                                <label class="control-label mb-1" style="height: 20px;"></label>
                                                                <div style="display:flex; height: 37px; align-items: center; justify-content: center; border-radius: 20px;">
                                                                    <button style="cursor: pointer; border-radius: 50px; color: white; border: none; height: 23px; background-color: darkred;" type="button" class="close_attr_{{$data->id}}" data="{{$data->id}}" onclick="removeProduct(event)"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $product_attr_row_count++; ?>
                                                    @endforeach
                                                </div>

                                                <div style="display:flex; justify-content:center; margin-top: 10px;">
                                                <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_product()">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Attribute form end here -->

                            @else

                            <!--<?php print_r("hello this is else part"); ?>-->
                            <div class="col-md-9 col-sm-6 col-xs-12">
                                <!--Add color Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" class="colorCheck">&nbsp; Allow Product Color</span>
                                    </label>
                                </div>

                                @php
                                    $color_loop_count = 0;
                                @endphp

                                <div class="col-lg-12" id="color_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group color_image" id="row-box">
                                                <div id="product_attr"  data="{{$color_loop_count++}}">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label for="color" class="control-label mb-1">Product Color</label>
                                                            <div style="display:flex;">
                                                               <input id="colorpicker" name="imgColor[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" readonly>
                                                               <!-- <input type="color" value="" id="colorpicker" style="height:34px;"> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="color" class="control-label mb-1">Attr Images</label>
                                                            <div class="show-prescription">
                                                                <button class="showPrescription" type="button">Image Gellery</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div style="display:flex; justify-content:center; margin-top: 10px;">
                                                    <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_more()">Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Add size Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" id="sizeCheck">&nbsp; Allow Product Size</span>
                                    </label>
                                </div>

                                <div class="col-lg-12" id="size_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group product_sizes">
                                                <div class="row" id="size_group">
                                                    <div class="col-md-9">
                                                        <label for="size" class="control-label mb-1">Product Size</label>
                                                        <div style="display:flex;">
                                                            <input id="getSize" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display:flex; justify-content:center; margin-top: 10px;">
                                                <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_size()">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Product Sell Discount -->
                                <!--<div>-->
                                <!--    <label><span class="required"><input type="checkbox" class="productSellCheck">&nbsp; Allow Product whole sell</span>-->
                                <!--    </label>-->
                                <!--</div>-->

                                <!--<div id="product_sell_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">-->
                                <!--    <input id="paid" type="hidden" value="">-->
                                <!--    <div class="card" id="">-->
                                <!--        <div class="card-body">-->
                                <!--            <div class="form-group" id="add_product_sell">-->
                                <!--                <div class="row">-->
                                <!--                    <div class="row-sell-data">-->
                                <!--                        <div class="col-md-4">-->
                                <!--                           <label for="color" class="control-label mb-1">Limit Quantity</label>-->
                                <!--                           <div>-->
                                <!--                               <input class="col-sm-12" id="product_range" name="ranegnameone" type="text">-->
                                <!--                           </div>-->
                                <!--                        </div>-->

                                <!--                        <div class="col-md-4">-->
                                <!--                           <label for="color" class="control-label mb-1">Discount %</label>-->
                                <!--                           <div>-->
                                <!--                               <input class="col-sm-12" id="percent" name="discount_one" type="text">-->
                                <!--                           </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--            <div style="display:flex; justify-content:center; margin-top: 10px;">-->
                                <!--               <button type="button" class="btn btn-primary" onclick="add_discount()" style="width: 200px;">Add More</button>-->
                                <!--           </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--Add Product Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" class="productCheck">&nbsp; Manage Product Attribute</span>
                                    </label>
                                </div>

                                <div id="product_attr_box" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card" id="">
                                        <div class="card-body">
                                            <div class="form-group product_attr_data">
                                                <div class="row" id="product_attr_div">
                                                    <input id="paid" type="hidden" name="product_id[]" value="">
                                                    <div class="row-data">
                                                        <div class="col-md-4">
                                                            <label for="color" class="control-label mb-1">Attr SKU</label>
                                                            <div>
                                                                <input id="attr_sku" name="attr_sku[]" type="text" style="width: 100%; height: 30px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="color" class="control-label mb-1">Size</label>
                                                            <div>
                                                                <select id="sizeAttr" name="attr_size[]" style="width: 100%; height: 30px;">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="color" class="control-label mb-1">Size Qty</label>
                                                            <div>
                                                                <input id="attr_qty" name="attr_qty[]" type="text" style="width: 100%; height: 30px;">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="color" class="control-label mb-1">Size Price</label>
                                                            <div>
                                                                <input id="attr_price" name="attr_price[]" type="price" style="width: 100%; height: 30px;">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="color" class="control-label mb-1">Color</label>
                                                            <div>
                                                                <select id="colorAttr" name="attr_color[]" style="width: 100%; height: 30px;">
                                                                    <option>Select Color</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="display:flex; justify-content:center; margin-top: 10px;">
                                            <button type="button" class="btn btn-primary" style="width: 200px;" onclick="add_product()">Add More</button>
                                        </div>
                                        </div>
                                    </div>
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
                                                                    <input id="getImage" name="" type="file" aria-required="true" aria-invalid="false" value="" multiple>
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

                            @endif
                            <!-- /#page-wrapper -->

                            <div class="form-group" id="submit-form-button">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="add_ads" type="submit" class="btn btn-success btn-block">Update Product</button>
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

<!------------ JavaScript code by Prashant Start here ----------->

    <script>
        // Product color and image attribute script for append html tag -----------------------

        var color_loop_count = $("#product_attr_count").val();
        var all_style = [];
        function add_more(){
            if($('#colorpicker').val() != '') {
                html = `
                    <style id="color_data_${color_loop_count}">
                        .close_color_${color_loop_count} {
                            height: 22px;
                            border:none;
                            background-color: #f1f1f1;
                            border-radius : 20px;
                            padding: 5px;
                            color: red;
                        }

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
                    </style>
                        <div id="product_attr_${color_loop_count}">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="color" class="control-label mb-1">Product Color</label>
                                    <div style="display:flex;">
                                        <input name="imgColor[]" id="colorpicker_${color_loop_count}" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="color" class="control-label mb-1">Attr Images</label>
                                    <div class="show-prescription">
                                        <button class="showPrescription_${color_loop_count}" onclick="showPrescrip()" type="button">Image Gellery</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label mb-1" style="height: 24px"></label>
                                    <div style="display:flex; height: 37px; align-items: center; justify-content: center;">
                                        <button type="button" class="close_color_${color_loop_count}" onclick="remove_color(${color_loop_count})"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                jQuery('.color_image').append(html);

                div =   `
                    <style id="prescrip_${color_loop_count}">
                        .prescriptionModel_${color_loop_count} {
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
                            z-index: 100;
                        }

                        #uploadImage_${color_loop_count} {
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

                        #uploadImage_${color_loop_count}:hover {
                            background-color: rgb(250,250,250);
                            box-shadow: 0 0 5px rgba(0, 0, 0);
                            transition: 0.2s;
                        }

                        #getImage_${color_loop_count} {
                            display:none;
                        }

                        .close_img_${color_loop_count} {
                            display:flex;
                            justify-content: center;
                            align-items: center;
                            width: 20px;
                            height: 20px;
                            border: none;
                            border-radius: 10px;
                            font-size: 14px;
                            margin-bottom: 3px;
                            background-color: #ace8cd
                        }

                        #showFile_${color_loop_count} {
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

                        .close_${color_loop_count} {
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

                        .close_${color_loop_count}:hover {
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
                    </style>
                        <div class="prescriptionModel_${color_loop_count}" tabindex="-1" role="dialog">
                            <div id="data${color_loop_count}">
                            </div>
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="model-content">
                                    <div class="model-header">
                                        <h3 class="model-title">Product Attribute Image Gallery</h3>
                                        <button type="button" class="close_${color_loop_count}" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="model-body">
                                        <div class="right-left-data">
                                            <div class="data-content">
                                                <div style="display:block;" id="form-model_${color_loop_count}">
                                                    <div class="col-md-12" style="display:flex; justify-content: center; align-items: center;">
                                                        <div style="width: 35%; height: 100%;">
                                                            <label for="getImage_${color_loop_count}" class="control-label mb-1" id="uploadImage_${color_loop_count}">Attr Image</label>
                                                            <input id="getImage_${color_loop_count}" name="" type="file" aria-required="true" aria-invalid="false" value="" multiple>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display:none;" id="img-model_${color_loop_count}">
                                                    <label for="color-img" class="control-label mb-1 col-sm-12"><p id="num-of-file_${color_loop_count}"></p></label>
                                                    <div class="col-sm-12 scroll-div">
                                                        <button type="button" class="close_img_${color_loop_count}" data-dismiss="modal">&times;</button>
                                                        <div id="showFile_${color_loop_count}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                jQuery('.pres-model').append(div);

                // prescritionButton increament function ------------------------------
                var mainButton = document.querySelector('#submit-form-button');
                var showPresButton = document.querySelector('.showPrescription_'+color_loop_count);
                var closeModelButton = document.querySelector('.close_'+color_loop_count);

                var modelWindow = document.querySelector('.prescriptionModel_'+color_loop_count);
                var overLayWindow = document.querySelector('.modelShaddow');
                var productattrForm = document.querySelector('#product_attr_box');
                var sizeattrForm = document.querySelector('#size_attr_box');
                // var discountattrForm = document.querySelector('#product_sell_box');

                showPresButton.addEventListener('click', function() {
                    overLayWindow.style.display = 'block';
                    overLayWindow.style.overflowY = 'hidden';
                    modelWindow.style.display = 'block';
                    mainButton.style.display = 'none';
                    productattrForm.style.display = 'none';
                    sizeattrForm.style.display = 'none';
                    // discountattrForm.style.display = 'none';
                });

                closeModelButton.addEventListener('click', function() {
                    overLayWindow.style.display = 'none';
                    modelWindow.style.display = 'none';
                    mainButton.style.display = 'block';
                    productattrForm.style.display = 'block';
                    sizeattrForm.style.display = 'block';
                    // discountattrForm.style.display = 'block';
                });

                // get color and show color function ---------------------------------------
                var getColorData = document.getElementById('colorpicker_'+color_loop_count);
                // var showColor = document.getElementById('getColor_'+color_loop_count);

                getColorData.addEventListener("change", function(e) {

                    fetchData();
                    addColorData(e);
                });

                var product_style = {};
                function fetchData(){
                    // if(getSizeData.value != null || getColorData.value != null) {
                        // $("#colorAttr").append("<option id='color-cards_"+color_loop_count+"' style='background:"+getColorData.value+";' value='"+getColorData.value+"'></option>");
                    // }
                    product_style.color = getColorData.value;
                }

                // image upload and preview function ----------------------------------
                const formModel = document.querySelector('#form-model_'+color_loop_count);
        	    const imgModel = document.querySelector('#img-model_'+color_loop_count);

                var fileTag = document.getElementById("getImage_"+color_loop_count);
                var imageNumber = document.getElementById("num-of-file_"+color_loop_count);
                var preview = document.getElementById("showFile_"+color_loop_count);
                var countData = $('#data'+color_loop_count);


                fileTag.addEventListener("change", function() {
                    changeImage(this, preview);
                    formModel.style.display = "none";
                    imgModel.style.display = "block";

                    var imgData = fileTag.files.length;

                    var images = [];
                    images.push(fileTag);
                    product_style.images_array = images;

                    product_style.data = countData;
                });

                all_style.push(product_style);


                function changeImage(input, preview) {

            		var data = input.files.length;


        		    preview.innerHLML = '';
            		imageNumber.textContent = input.files.length +" Files Selected";
            		for(var i=0; i < data ; i++) {
            		    var subdiv = document.createElement("div");
            		    subdiv.setAttribute('class', 'img-div_'+i);

                        var imgClose = document.createElement("button");
                        imgClose.setAttribute('type', 'button');
                        imgClose.setAttribute('class', 'close_img');
                        imgClose.setAttribute('onclick', 'deleteImage('+i+')');


            		    var anchor = document.createElement("a");
            		    anchor.setAttribute('target', '_blank');

            		    var imgnew = document.createElement("img");
            		    imgnew.setAttribute('src', URL.createObjectURL(input.files[i]));
            		    imgnew.setAttribute('class', 'imageModel');

            		    anchor.setAttribute('href', URL.createObjectURL(input.files[i]));

            		    subdiv.appendChild(anchor);
                        subdiv.appendChild(imgClose);
            		    anchor.appendChild(imgnew);
            		    preview.append(subdiv);

            		}

            	}

                // close perticular image click on span ------------------------------------

                function deleteImage(e) {
                    $(".img-div_"+e).remove();
                }

                var closeImage = document.querySelector('.close_img_'+color_loop_count);

                closeImage.addEventListener('click', function() {
                    formModel.style.display = "block";
                    imgModel.style.display = "none";
                });

                // delete image ---------------------------
                color_loop_count++;
            }
            else {
                if($('#getColor').val() == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        width: 500,
                        height: 300,
                        text: 'Please select color!',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                          hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                }
                else if($('#getImage').val() == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        width: 500,
                        height: 300,
                        text: 'Please choose images!',
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

        function remove_color(color_loop_count) {
            delete productColorObj[`colorpicker_${color_loop_count}`];  // add line
            listProductAllColor(productColorObj);  // add line

            jQuery("#product_attr_"+color_loop_count).remove();
            jQuery("#color_data_"+color_loop_count).remove();

            jQuery(".prescriptionModel_"+color_loop_count).remove();
            jQuery("#prescrip_"+color_loop_count).remove();
        }
    </script>

    <script>

        // Product size attribute script for append html tag -----------------------
        var size_loop_count = $("#size_loop_count").val();

        function add_size(){
            if($('#getSize').val() != '') {

                html = `
                        <style id="size_style_${size_loop_count}">
                            .close_size_${size_loop_count} {
                                height: 22px;
                                border:none;
                                background-color: #f1f1f1;
                                border-radius : 20px;
                                padding: 5px;
                                color: red;
                            }
                        </style>
                        <div class="row" id="size_group_${size_loop_count}">`;

                html += '<div class="col-md-9"><label for="size" class="control-label mb-1">Product Size</label>';

                html += '<div style="display:flex;"><input id="getSize_'+size_loop_count+'" type="text" class="form-control"></div>';

                html+='</div>';

                html+= `<div class="col-md-1">
                            <label class="control-label mb-1" style="height: 24px"></label>
                            <div style="display:flex; height: 37px; align-items: center; justify-content: center;">
                                <button type="button" class="close_size_${size_loop_count}" onclick="remove_size(${size_loop_count})"><i class="fa fa-times"></i></button>
                            </div>
                        </div>`;

                html+='</div>';

                jQuery('.product_sizes').append(html);

                var getSizeData = document.getElementById('getSize_'+size_loop_count);


                getSizeData.addEventListener("change", function(e) {
                    var sizedata = getSizeData.value;
                    fetchData();

                    fetchSizeData(e);
                });

                function fetchData(size_loop_count){
                    if(getSizeData.value != null) {
                        // $("#sizeAttr").append("<option id='size-cards_"+size_loop_count+"'>"+getSizeData.value+ "</option>");
                    }
                }

                size_loop_count++;
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    height: 300,
                    text: 'Please fill size data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        }

        function remove_size(size_loop_count) {
            delete productSizeObj[`getSize_${size_loop_count}`];
            listProductAllSize(productSizeObj);

            jQuery("#size_group_"+size_loop_count).remove();
            jQuery("#size_style_"+size_loop_count).remove();
        }


    </script>

    <script>
        const formModel = document.querySelector('#form-model');
    	const imgModel = document.querySelector('#img-model');


    	var fileTag = document.getElementById("getImage");
    	var imageNumber = document.getElementById("num-of-file");
        var preview = document.getElementById("showFile");


        var all_style = [];
        var product_style = {};

    	fileTag.addEventListener("change", function() {
    		changeImage(this, preview);
    		formModel.style.display = "none";
    		imgModel.style.display = "block";

    		var imgData = fileTag.files.length;

    		var countData = $('#data');

            var images = [];
            images.push(fileTag);
            product_style.images_array = images;

            product_style.data = countData;
    	});

    	function changeImage(input, preview) {

    		var data = input.files.length;


		    preview.innerHLML = '';
    		imageNumber.textContent = input.files.length +" Files Selected";
    		for(var i=0; i < data ; i++) {
    		    var subdiv = document.createElement("div");
    		    subdiv.setAttribute('class', 'img-div_'+i);

                var imgClose = document.createElement("button");
                imgClose.setAttribute('type', 'button');
                imgClose.setAttribute('class', 'close_img');
                imgClose.setAttribute('onclick', 'deleteImage('+i+')');


    		    var anchor = document.createElement("a");
    		    anchor.setAttribute('target', '_blank');

    		    var imgnew = document.createElement("img");
    		    imgnew.setAttribute('src', URL.createObjectURL(input.files[i]));
    		    imgnew.setAttribute('class', 'imageModel');

    		    anchor.setAttribute('href', URL.createObjectURL(input.files[i]));

    		    subdiv.appendChild(anchor);
                subdiv.appendChild(imgClose);
    		    anchor.appendChild(imgnew);
    		    preview.append(subdiv);

    		}

    	}

        // close perticular image click on span ------------------------------------

        function deleteImage(e) {
            $(".img-div_"+e).remove()
        }

        var closeImage = document.querySelector('.close_img');

        closeImage.addEventListener('click', function() {
            formModel.style.display = "block";
            imgModel.style.display = "none";
        });

        // delete image ---------------------------



        // Color JS functionality ------------------------------------------

        var colorCheckBox = document.querySelector('.colorCheck');
        // var getColorData = document.getElementById('colorpicker');
        var coloForm = document.querySelector('#color_attr_box');


        if(colorCheckBox.checked == true) {
            coloForm.style.display = "block";
        }

        colorCheckBox.addEventListener('click', function() {
            if(colorCheckBox.checked == true) {
                coloForm.style.display = "block";
            }else {
                coloForm.style.display = "none";
            }
        });

        // var showColor = document.getElementById('getColor');

        function colorAppendOnSelect(e) {
            var imgData = fileTag.files;
            fetchData(e.target.value);
            addColorData(e);
        }

        var productColorObj = JSON.parse($("#productColorObj").val());
        function addColorData(e){
            if(e.target.value != ''){
                productColorObj[e.target.getAttribute("id")] = e.target.value;
            }else if(e.target.value == ''){
                delete productColorObj[e.target.getAttribute("id")];
            }
            listProductAllColor(productColorObj);
        }

        function listProductAllColor(productColorObj){
            let pro_attr_counts = parseInt(loop_count) - 1;
            for(let i=0; i<=pro_attr_counts; i++){
                let multipleProductAttrId = (parseInt(i) > 0) ? "colorAttr_"+(parseInt(i)) : "colorAttr";
                
                $("#"+multipleProductAttrId).html('');
                $("#"+multipleProductAttrId).append(`<option value=""> Select Color </option>`);
                for (let key in productColorObj) {
                    $("#"+multipleProductAttrId).append(`<option data='${key}' > ${productColorObj[key]}</option>`);
                }
            }
        }


        // Size JS functionality ------------------------------------------

        var checkBoxSelect = document.getElementById('sizeCheck');
        // var getSizeData = document.getElementById('getSize');
        var sizeForm = document.querySelector('#size_attr_box');

        if(checkBoxSelect.checked == true) {
            sizeForm.style.display = "block";
        }

        checkBoxSelect.addEventListener('click', function() {
            console.log("hello");
            if(checkBoxSelect.checked == true) {
                sizeForm.style.display = "block";
            }else {
                sizeForm.style.display = "none";
            }
        });

        function sizeAppendOnSelect(e) {
            fetchSizeData(e);
        }

        var productSizeObj = JSON.parse($("#productSizeObj").val());
        function fetchSizeData(e){
            if(e.target.value != ''){
                productSizeObj[e.target.getAttribute("id")] = e.target.value;
            }else if(e.target.value == ''){
                delete productSizeObj[e.target.getAttribute("id")];
            }
            listProductAllSize(productSizeObj);
        }

        function listProductAllSize(productSizeObj){
            let pro_attr_counts = parseInt(loop_count) - 1;
            for(let i=0; i<=pro_attr_counts; i++){
                let multipleProductAttrId = (parseInt(i) > 0) ? "sizeAttr_"+(parseInt(i)) : "sizeAttr";
                $("#"+multipleProductAttrId).html('');
                $("#"+multipleProductAttrId).append(`<option value=""> Select Size </option>`);
                for (let key in productSizeObj) {
                    $("#"+multipleProductAttrId).append(`<option id=''> ${productSizeObj[key]}</option>`);
                }
            }

        }

        // Product JS functionality,  product arttribute get value of size color and images value --------------------------------

        var productCheckBox = document.querySelector('.productCheck');
        var productForm = document.querySelector('#product_attr_box');

        if(productCheckBox.checked == true) {
            productForm.style.display = "block";
        }

        productCheckBox.addEventListener('click', function() {
            if(productCheckBox.checked == true) {
                productForm.style.display = "block";
            }else {
                productForm.style.display = "none";
            }
        });

        function fetchData(getColorData){
            // if(getSizeData.value != null || getColorData.value != null) {
                // $("#sizeAttr").append("<option id='size-cards'>"+getSizeData.value+ "</option>");
                // $("#colorAttr").append("<option id='color-cards' style='background:"+getColorData.value+";' value='"+getColorData.value+"'></option>");
            // }

            product_style.color = getColorData;

        }
        all_style.push(product_style);

        $("#sizeAttr").on('change', function() {
            var getsizeValue = $("#sizeAttr").val();
        });

        var data_loop = 0;
        $("#colorAttr").on('change', function() {
            $("#colorAttr").css({"background-color": $("#colorAttr").val()});

            for(k=0; k<all_style.length; k++) {
                if(all_style[k].color == $("#colorAttr").val()){
                    all_style[k].images_array[0].setAttribute('name', 'attr_imgs_'+data_loop+'[]');

                    all_style[k].data.append("<input id='imgColor' value='"+data_loop+"' name='count[]'>");

                }
            }
        });


        // Product Sell JS functionality ------------------------------------------

        var sellCheckBox = document.querySelector('.productSellCheck');
        var sellForm = document.querySelector('#product_sell_box');

        var sellPercent = document.getElementById('percent');
        var sellPrice = document.getElementById('selling-price');
        var productRange = document.getElementById('product_range');
        var discount = document.querySelector('.discount_amount');

        if(sellCheckBox.checked == true){
            sellForm.style.display = "block";
        }

        sellCheckBox.addEventListener('click', function() {
            if(sellCheckBox.checked == true) {
                sellForm.style.display = "block";
            }else {
                sellForm.style.display = "none";
            }
        });

        // // calculate discount value --------------------------------

        // $("#product_range").on("change", function(){
        //     calDiscount();
        // });
        // $("#percent").on("change", function(){
        //     calDiscount();
        // });
        // $("#selling-price").on("change", function(){
        //     calDiscount();
        // });

        // function calDiscount(){
        //     var allrange = $("#product_range").val();
        //     var firstrange = allrange.slice(0, 2);
        //     var secrange = allrange.slice(3, 5);
        //     var mainrange = secrange - firstrange;

        //     if($("#product_range").val() != null && $("#percent").val() && $("#selling-price").val() != null){
        //         let disc_amount = ( $("#selling-price").val() * mainrange )/100 * $("#percent").val();
        //         var disdata = $(".discount_amount").val(disc_amount);

        //     }
        // }

    </script>

    <script>
        var sell_loop_count =1;
        function add_discount(){
            if($('#product_range').val() != '' && $('#percent').val() != ''){
                html = `
                    <style id="sell_style_${sell_loop_count}">
                        .close_discount_${sell_loop_count} {
                            height: 22px;
                            border:none;
                            background-color: #f1f1f1;
                            border-radius : 20px;
                            padding: 5px;
                            color: red;
                        }
                    </style>
                        <div class="row" id="product_sell_${sell_loop_count}">
                            <div class="row-sell-data">
                                <div class="col-md-4">
                                   <label for="color" class="control-label mb-1">Limit Quantity</label>
                                   <div>
                                       <input class="col-sm-12" id="product_range" name="rangenametwo" type="text">
                                   </div>
                                </div>

                                <div class="col-md-4">
                                   <label for="color" class="control-label mb-1">Discount %</label>
                                   <div>
                                       <input class="col-sm-12" id="percent" name="discount_two" type="text">
                                   </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label mb-1" style="height: 20px;"></label>
                                    <div style="display:flex; height: 37px; align-items: center; justify-content: center;">
                                        <button type="button" class="close_discount_${loop_count}" onclick="remove_sell(${sell_loop_count})"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;





                jQuery('#add_product_sell').append(html);

                sell_loop_count++;
            }
            else {
                var values = "Please fill all data";
                alert(values);
            }
        }

        function remove_sell(sell_loop_count) {
            jQuery("#product_sell_"+sell_loop_count).remove();
            jQuery("#sell_style_"+sell_loop_count).remove();

        }
    </script>

    <script>

        // Product attribute script for append html tag -----------------------

        var loop_count = $("#total_row_count").val();
        function add_product(){
            var color_html = jQuery('#colorAttr').html();
            var size_html = jQuery('#sizeAttr').html();  // it is use for get main size html data and append it in increament size select box  --------

            if($("#colorAttr").val() != '' && $("#attr_price").val() != '' && $("#attr_sku").val() != '' && $("#attr_qty").val() !='') {

                html = `
                    <style id="product_style_${loop_count}">
                        .close_attr_${loop_count} {
                            height: 22px;
                            border:none;
                            background-color: #f1f1f1;
                            border-radius : 20px;
                            padding: 5px;
                            color: red;
                        }
                    </style>
                        <div class="row" id="product_attr_div_${loop_count}">
                            <input type="hidden" name="id[]" value="">
                            <input id="paid" type="hidden" name="product_id[]" value="">
                            <div class="row-data">
                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1">Attr SKU</label>
                                    <div>
                                        <input id="attr_sku" name="attr_sku[]" type="text" style="width: 100%; height: 30px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1">Size</label>
                                    <div>
                                        <select id="sizeAttr_${loop_count}" name="attr_size[]" style="width: 100%; height: 30px;">
                                            ${size_html}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1">Size Qty</label>
                                    <div>
                                        <input id="attr_qty" name="attr_qty[]" type="text" style="width: 100%; height: 30px;">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1">Size Price</label>
                                    <div>
                                    <input id="attr_price" name="attr_price[]" type="price" style="width: 100%; height: 30px;">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1">Color</label>
                                    <div>
                                        <select id="colorAttr_${loop_count}" name="attr_color[]" style="width: 100%; height: 30px;">
                                            ${color_html}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label mb-1" style="height: 20px;"></label>
                                    <div style="display:flex; height: 37px; align-items: center; justify-content: center;">
                                        <button type="button" class="close_attr_${loop_count}" onclick="remove_more(${loop_count})"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                jQuery('.product_attr_data').append(html);

                $("#colorAttr_"+loop_count).on('change', function() {
                    var count = parseInt(loop_count) - 1;
                    console.log(loop_count);
                    $("#colorAttr_"+count).css({"background-color": $("#colorAttr_"+count).val()});

                    for(k=0; k<all_style.length; k++) {
                        if(all_style[k].color == $("#colorAttr_"+count).val()) {
                            all_style[k].images_array[0].setAttribute('name', 'attr_imgs_'+count+'[]');

                            all_style[k].data.append("<input id='imgColor"+count+"' value='"+count+"' name='count[]'>");
                        }
                    }
                });
            }
            else {
                if($("#attr_sku").val() == '') {
                    if($("#attr_sku").val() === $("#attr_sku"+loop_count).val()) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            width: 500,
                            text: 'SKU must be unique !',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                              hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        width: 500,
                        text: 'Please fill Sku value',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                          hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                }
                else if($("#colorAttr").val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        width: 500,
                        text: 'Please select color value',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                          hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                }
                else if($("#attr_qty").val() =='') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        width: 500,
                        text: 'Please define qty',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                          hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                }
            }

            loop_count++;
        }

        function remove_more(loop_count) {

            for(m=0; m<all_style.length; m++) {
                if($("#colorAttr_"+loop_count).val() == all_style[m].color){
                    all_style[m].images_array[0].setAttribute('name', '');
                }
            }

            jQuery("#product_attr_div_"+loop_count).remove();
            jQuery("#product_style_"+loop_count).remove();
            var colorData = $("#colorAttr_"+loop_count).val();
        }


    </script>

<!---- for product attribute and attribute gallery delete purpose ----->
    <script>
        var appdiv = document.querySelector("#titlenew");
        var productdiv = document.querySelector(".product_attr_data");
        function removeImg(id){
            var close_button = document.querySelector('.close_imgs_'+id);
            close_button.parentElement.remove();

            // it is use for remove image for
            var inpdiv = document.createElement("input");
            inpdiv.setAttribute('name', 'removeimg[]');
            inpdiv.setAttribute('type', 'hidden');
            inpdiv.setAttribute('value', id);
            appdiv.appendChild(inpdiv);

            console.log(appdiv);
        }

        function removeProduct(e){
            // var getdeletecount = $('#attr_delete_get_');
            var id = e.target.parentElement.getAttribute('data');
            e.target.parentElement.parentElement.parentElement.parentElement.parentElement.childNodes[1].remove();
            e.target.parentElement.parentElement.parentElement.parentElement.parentElement.childNodes[2].remove();
            var close_product = document.querySelector('#product_attr_div_'+id);
            close_product.remove();

            var getdeletecount = e.target.parentElement.parentElement.parentElement.parentElement.getAttribute('id');
            
            $('.prescriptionModel_'+getdeletecount).remove();
            
            var attrdiv = document.createElement("input");
            attrdiv.setAttribute('name', 'removeattr[]');
            attrdiv.setAttribute('type', 'hidden');
            attrdiv.setAttribute('value', id);
            productdiv.appendChild(attrdiv);
        }
        
        function showDelete(data){
            var imgButton = document.querySelector('.close_imgs_'+data);
            imgButton.style.opacity = 1;
        }
        
        function hideDelete(data){
            var imgButton = document.querySelector('.close_imgs_'+data);
            imgButton.style.opacity = 0;
        }
    </script>
    <script>

        var product_attr_count = $("#product_attr_count").val();
        // var product_attr_count_dec_by_one = product_attr_count - 1;

        var mainButton = document.querySelector('#submit-form-button');
        var imgField = document.querySelector('.hdtuto');
        var colorButton = document.querySelector('.color_add_more');


        var overLayWindow = document.querySelector('.modelShaddow');
        var productattrForm = document.querySelector('#product_attr_box');
        var sizeattrForm = document.querySelector('#size_attr_box');
        // var discountattrForm = document.querySelector('#product_sell_box');

        for(let i=0; i<product_attr_count; i++){
            var showPresButton = document.querySelector('.showPrescription'+(i > 0 ? '_'+i : ''));
            var getPresModel = document.querySelector('.prescriptionModel'+(i > 0 ? '_'+i : ''));
            var closeModelButton = document.querySelector('.close'+(i > 0 ? '_'+i : ''));

            showPresButton.addEventListener('click', function(e) {
                var specificImageAttrData = e.target.parentElement.parentElement.parentElement.parentElement.getAttribute('data');
                var getPresModel = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.pres-model').querySelector('.prescriptionModel'+(specificImageAttrData > 0 ? '_'+specificImageAttrData : ''))

                overLayWindow.style.display = 'block';
                overLayWindow.style.overflowX = 'hidden';
                getPresModel.style.display = 'block';
                mainButton.style.display = 'none';
                imgField.style.display = 'none';
                colorButton.style.display = 'none';
                productattrForm.style.display = 'none';
                sizeattrForm.style.display = 'none';
                // discountattrForm.style.display = 'none';
            });

            closeModelButton.addEventListener('click', function(e) {
                var getPres = e.target.parentElement.parentElement.parentElement.parentElement;
                overLayWindow.style.display = 'none';
                getPres.style.display = 'none';
                mainButton.style.display = 'block';
                imgField.style.display = 'block';
                colorButton.style.display = 'block';
                productattrForm.style.display = 'block';
                sizeattrForm.style.display = 'block';
                // discountattrForm.style.display = 'block';
            });
        }
    </script>

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
                    // $('#adminvideo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
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
 $('.slide button').on('click',function(){
  $(this).parent('.slide').remove();
});
</script>

<script type="text/javascript">

   $(document).ready(function() {
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
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#usagesnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#usagesdurationnew').hide();
        $('#lensmaterialtypenew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#framedimension').hide()
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#gendernew').show();
        $('#warrentytypenew').show();
        $('#frametypenew').show();

        $('#leanscoatingnew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#framematerialnew').show();
        $('#frameshape').show();
        $('#sellername').show();
        $('#framestylenew').hide();
        $('#gendernew').show();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#productdimensionnew').show();

    } else if(categoryname == "Contact Lenses") {

        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#framewidthnew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#coatingnew').hide();

        $('#visioneffectnew').hide();
        $('#lenstypenew').show();
        $('#usagesdurationnew').show();

        var lensValue = $("#lenstype option")[0].value;
        
        if(lensValue == 'Single Vision'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }
        else if(lensValue == 'MultiFocal'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').show();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }
        else if(lensValue == 'toric and Astigmatism'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').show();
            $('#cylinderneww').show();
        }
        else if(lensValue == 'Plano'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
        }

        $('#lenstype').on('change', function() {
            if($('#lenstype').val() == 'Single Vision'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
            else if($('#lenstype').val() == 'MultiFocal'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').show();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
            else if($('#lenstype').val() == 'toric and Astigmatism'){
                console.log("hellow");
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').show();
                $('#cylinderneww').show();
            }
            else if($('#lenstype').val() == 'Plano'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
            }
        });

    }else if(categoryname == "Sunglasses"){

        $('#usagesnew').hide();
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
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#framestylenew').hide();
        $('#addpowernew').hide();
        $('#usagesdurationnew').hide();
        $('#coatingnew').hide();

        $('#lenstechnologynew').show();
        $('#gendernew').show();
        $('#shapenew').show();
        $('#colornew').show();

    }else if(categoryname == "Lenses"){

        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#usagesnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
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
        $('#framewidthnew').hide();
        $('#heightnew').hide();
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();
        $('#netquntitynew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').show();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#lenstechnologynew').show();
        $('#coatingnew').show();


    }else if(categoryname == "Accessories"){

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
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#productdimnew').hide();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();
        $('#gendernew').hide();

        $('#productdimensionnew').show();

    }else if(categoryname == "Premium Brands"){

        $('#usagesnew').hide();
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
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
         // $('#frametypenew').show();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#frametypenew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#framestylenew').hide();
        $('#usagesdurationnew').hide();

        $('#gendernew').show();
        $('#lenstechnologynew').show();

    }
    else{

    }

});

</script>

<script type="text/javascript">

    //
     if($("#maincats option:selected").text() == 'Frames'){
         $("#sizeCheck").attr('disabled', false);
     }else if($("#maincats option:selected").text() == 'Contact Lenses'){
         console.log("jfjf");
        $("#sizeCheck").attr('disabled', true);
         $("#sizeAttr").attr('disabled', true);
         
     }else if($("#maincats option:selected").text() == 'Sunglasses'){
         $("#sizeCheck").attr('disabled', false);
         
     }else if($("#maincats option:selected").text() == 'Lenses'){
        $("#sizeCheck").attr('disabled', true);
         $("#sizeAttr").attr('disabled', true);
         
     }else if($("#maincats option:selected").text() == 'Accessories'){
         $("#sizeCheck").attr('disabled', false);
         
     }else if($("#maincats option:selected").text() == 'Premium Brands'){
         $("#sizeCheck").attr('disabled', false);
         
     }

   $('#maincats').on('change', function() {
    var select_status = document.getElementById("maincats");
    var categoryname = select_status.options[select_status.selectedIndex].text;
    // alert(strUser);
    if( categoryname == "Frames" ) {
         $("#sizeCheck").attr('disabled', false);
        $('#diameternew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#basecurvenew').hide();
        $('#watercontentnew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
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
        $('#framestylenew').show();
        $('#framematerialnew').show();
        $('#templematerialnew').show();
        $('#templecolornew').show();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#warrentytypenew').show();
        $('#productdimensionnew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#frametypenew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#gendernew').show();

 }

    else if(categoryname == "Contact Lenses") {
        $("#sizeCheck").attr('disabled', true);
         $("#sizeAttr").attr('disabled', true);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#colornew').hide();
        $('#gendernew').hide();
        $('#framestylenew').hide();
        $('#framematerialnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#lenstechnologynew').show();
        $('#lensindexnew').hide();
        $('#focallengthnew').hide();
        $('#shelflifenew').hide();
        $('#formnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#warrentytypenew').hide();
        $('#productdimensionnew').hide();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#usagesnew').hide();
        $('#frametypenew').hide();
        $('#diameternew').show();
        $('#contactlensmaterialtypenew').show();
        $('#basecurvenew').show();
        $('#watercontentnew').show();
        $('#powernewmin').show();
        $('#powernewmax').show();
        $('#disposabilitynew').show();
        $('#packagingnew').show();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').show();

        $('#modelnonew').show();
        $('#usagesdurationnew').show();
        $('#framewidthnew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').show();
        $('#cylinderneww').show();
        $('#axisneww').show();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').show();
        $('#addpowernew').show();
        $('#visioneffectnew').hide();


    }else if(categoryname == "Sunglasses"){
         $("#sizeCheck").attr('disabled', false);
         $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show();
         $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show();
        $('#packageweightnew').show();
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

        $('#framewidthnew').show();
        $('#modelnonew').show();
        $('#heightnew').show();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

         $('#lenstypenew').hide();
         $('#visioneffectnew').hide();
         $('#powernewmin').hide();
        $('#powernewmax').hide();
         $('#coatingnew').hide();
         $('#gendernew').show();
         $('#framecolornew')
         $('#shapenew').show();
         $('#addpowernew').hide();
    }else if(categoryname == "Lenses"){
        $("#sizeAttr").attr('disabled', true);
        $("#sizeCheck").attr('disabled', true);

        $('#lensmaterialtypenew').show();
        $('#diameternew').show();
        $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').show();
        $('#lensindexnew').show();
        $('#focallengthnew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#catetwonew').hide();
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
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#shelflifenew').hide();
        $('#gendernew').hide();
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

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').show();
        $('#powernewmax').show();
        $('#visioneffectnew').show();
        $('#coatingnew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').show();

    }else if(categoryname == "Accessories"){
        $("#sizeCheck").attr('disabled', false);

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
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
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
        $('#packageweightnew').show();

        $('#usagesdurationnew').hide();

        $('#framewidthnew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();

        $('#netquntitynew').show();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#gendernew').hide();
        $('#manufracturer').show();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();

    }else if(categoryname == "Premium Brands"){
        $("#sizeCheck").attr('disabled', false);


         $('#catetwonew').show();
         $('#shapenew').show();
         $('#colornew').show();
         $('#framestylenew').hide();
         $('#framematerialnew').show();
         $('#templematerialnew').show();
         $('#templecolornew').show();
         $('#lenscolornew').show();
        $('#contactlenscolornew').hide();
         $('#lenstechnologynew').show();
         $('#warrentytypenew').show();
         $('#productdimensionnew').show();
         $('#weightnew').show();
        $('#packageweightnew').show();
         $('#frametypenew').hide();
         $('#usagesnew').hide();
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

        $('#centerthiknessnew').hide();
        $('#cylinderneww').hide();
        $('#axisneww').hide();

        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#visioneffectnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#gendernew').show();

    }
    else{

    }

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
  $('#subs').select2({
    width: '100%',
    placeholder: "Select Sub Category",
    allowClear: true

  });


  $('#lenstechnology').select2({
    width: '100%',
    placeholder: "Select lenstechnology ",
    allowClear: true

  });


  $('#coating').select2({
    width: '100%',
    placeholder: "Select Coating ",
    allowClear: true

  });
   $('#gender').select2({
    width: '100%',
    placeholder: "Select gender ",
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
  $('#addpower').select2({
    width: '100%',
    placeholder: "Select  Power",
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
  $('#powermin').select2({
    width: '100%',
    placeholder: "Select Power",
    allowClear: true
  });

  $('#powermax').select2({
    width: '100%',
    placeholder: "Select Power",
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
  $('#diameter').select2({
    width: '100%',
    placeholder: "Select Diameter",
    allowClear: true
  });
 </script>
 <script>
  $('#cylindernew').select2({
    width: '100%',
    placeholder: "Select Diameter",
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

<script type="text/javascript">

        $(document).ready(function() {

    $(document).on('change',".imagevalidation",function(){
        // alert("sadsad");
    // $('.imagevalidation').bind('change', function() {
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
                    // myImgRemove(serial);
                }
            }
            // else if (img=="PNG","jpg","jpeg","gif") {
            //     myImgRemove(serial);
            //     $("#image"+serial).find("span>strong").text("Gallary Image "+serial+ " size should be jpeg,png image ");
            // }

            else {
                // myImgRemove(serial);
                $("#image"+serial).find("span>strong").text("Gallery Image "+serial+ " size should be 1300px and 1160px");
            }

        }
        // var fileExtension = ['png','jpg','jpeg','gif'

    });

      var test = 2;
      $("#addimg").click(function(){
          $(".clone").find("input[type='file']").attr("data-image_val",test);
          var lsthmtl = $(".clone").html();


           lsthmtl += "<div id='image"+test+"' class='error'>"+
                                       "<span class='help-block'>"+
                                        "<strong style='color: red;'></strong>"+
                                        "</span>"+
                            "</div>";

          $(".increment").after(lsthmtl);
          test++;
      });

      $("body").on("click","#removeimg",function(){

          $(this).parents(".hdtuto").remove();

      });

    });
    </script>

@stop