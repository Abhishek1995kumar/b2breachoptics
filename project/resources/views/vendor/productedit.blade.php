@extends('vendor.includes.master-vendor')
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
        font-size: 12px;
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
                        <a href="{!! url('vendor/products') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Update Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <form method="POST" id="productFormSubmit"  class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <!--<form method="POST" action="{!! action('VendorProductsController@update',['id' => $product->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">-->
                            {{csrf_field()}}
                            <input type="hidden" name='id' id="id" value="<?php echo $product->id ?>">
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name <span class="required" style="color:red;">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" value="{{$product->title}}" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category <span class="required" style="color:red;">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" onchange="mainCategoryEdit(event)" onmousedown="return false" onkeydown="return false">
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
                            
                            <div class="item form-group" id="premiumtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Premium Brands Type </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="premiumtype" id="premiumtype" >
                                        <option value="{{$product->premiumtype}}">{{$product->premiumtype}}</option>
                                        <option value="Frames">Frames</option>
                                        <option value="Sunglasses">Sunglasses</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category <span class="required" style="color:red;">*</span>

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category <span class="required" style="color:red;">*</span>

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

                            <div class="item form-group" id="shapenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityshape = $product->shape ? explode(',',$product->shape) : array();
                                    ?>
                                     <select class="form-control" name="shape" id="shape">
                                        @foreach($frame_shape as $value)
                                            @if (in_array($value->name, $arrSpecialityshape))
                                                <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                            @else
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="framecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framecolor">Frame Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityframecolor = $product->framecolor ? explode(',',$product->framecolor) : array();
                                    ?>
                                     <select class="form-control" name="framecolor" id="framecolor">
                                        @foreach($frame_color as $value)
                                            @if (in_array($value->name, $arrSpecialityframecolor))
                                                <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                            @else
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandname">Brand Name <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname" >
                                        <option id="selected" value="{{$product->brandname}}">{{$product->brandname}}</option>
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
                                    
                                    <!-- <select class="form-control" name="lenstype" id="lenstype" >-->
                                    <!--     <option value="Spherical" <?php $product->lenstype == "Spherical" ? 'selected' : '' ?> >Single Vision</option>-->
                                    <!--     <option value="MultiFocal" <?php $product->lenstype == "MultiFocal" ? 'selected' : '' ?> >MultiFocal</option>-->
                                    <!--     <option value="toric & Astigmatism" <?php $product->lenstype == "toric & Astigmatism" ? 'selected' : '' ?> >toric & Astigmatism</option>-->
                                    <!-- </select>-->
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth">Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="display:flex;">
                                    <input id="framewidth" value="{{$product->framewidth}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
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

                            <div class="item form-group" id="colorcodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colorcode">Color Code <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="colorcode" value="{{$product->colorcode}}" class="form-control col-md-7 col-xs-12" name="colorcode" placeholder="Color Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowerlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityaddpowerlens = $product->addpowerlens ? explode(',',$product->addpowerlens) : array();
                                    ?>
                                     <select class="form-control" multiple="multiple" name="addpowerlens[]" id="addpowerlens">
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->add_power, $arrSpecialityaddpowerlens))
                                                <option value="{{ $value->add_power }}" selected>{{ $value->add_power }}</option>
                                            @else
                                                <option value="{{ $value->add_power }}">{{ $value->add_power }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="diameterlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameterlens">Lens DIA</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitydiameterlens = $product->diameterlens ? explode(',',$product->diameterlens) : array();
                                    ?>
                                    <select class="form-control" multiple="multiple" name="diameterlens[]" id="diameterlens">
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->diameter, $arrSpecialitydiameterlens))
                                                <option selected value="{{ $value->diameter }}">{{ $value->diameter }}</option>
                                            @else
                                                <option value="{{ $value->diameter }}">{{ $value->diameter }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="spheres">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">sphere**</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitysphere = $product->sphere ? explode(',',$product->sphere) : array();
                                    ?>
                                    <select class="form-control" multiple="multiple" name="sphere[]" id="spherelens">
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->sphere, $arrSpecialitysphere))
                                                <option value="{{ $value->sphere }}" selected>{{ $value->sphere }}</option>
                                            @else
                                                <option value="{{ $value->sphere }}">{{ $value->sphere }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="axisnlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis**</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityaxislens = $product->axisnlens ? explode(',', $product->axisnlens) : array();
                                    ?>
                                    <select class="form-control" multiple="multiple" name="axisnlens[]" id="axisnlens" >
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->axis, $arrSpecialityaxislens))
                                                <option  selected value="{{ $value->axis }}">{{ $value->axis }}</option>
                                            @else
                                                <option value="{{ $value->axis }}">{{ $value->axis }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="cylinderlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinderlens">Cylinder <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylinders = $product->cylinderlens ? explode(',', $product->cylinderlens) : array();
                                    ?>
                                    <select class="form-control" multiple="multiple" name="cylinderlens[]" id="cylinderlens" >
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->cylinder, $arrSpecialitycylinders))
                                                <option value="{{ $value->cylinder }}" selected>{{ $value->cylinder }}</option>
                                            @else
                                                <option value="{{ $value->cylinder }}">{{ $value->cylinder }}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityframematerial = $product->framematerial ? explode(',', $product->framematerial) : array();
                                    ?>
                                     <select class="form-control" name="framematerial" id="framematerial" >
                                        @foreach($frame_material as $frame)
                                            @if (in_array($frame->name, $arrSpecialityframematerial))
                                                <option selected value="{{ $frame->name }}">{{ $frame->name }}</option>
                                            @else
                                                <option value="{{ $frame->name }}">{{ $frame->name }}</option>
                                            @endif
                                        @endforeach
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material Type<span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitylensmaterialtype = $product->lensmaterialtype ? explode(',', $product->lensmaterialtype) : array();
                                    ?>
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype" >
                                    	@foreach($lens_material as $material)
                                            @if (in_array($material->name, $arrSpecialitylensmaterialtype))
                                    		    <option value="{{ $material->name }}" selected>{{$material->name}}</option>
                                            @else
                                                <option value="{{ $material->name }}">{{ $material->name }}</option>
                                            @endif
                                    	@endforeach
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve <span class="required" style="color:red;">*</span></label>
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
                                        <option  <?=(in_array("9.9", $arrBCcurve)  ? 'selected' : '');?> value="9.9">9.9</option>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "(" ?><i class="fa fa-minus"></i> <?php echo ")" ?> <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "(" ?><i class="fa fa-plus"></i> <?php echo ")" ?> <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability" >
                                        <option value="{{$product->disposability}}">{{$product->disposability}}</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quarterly">Quarterly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $contactpakage = explode(',',$product->packaging); ?>
                                    <select class="form-control" name="packaging" id="packaging" >
                                        @foreach($contactlens_packaging as $package)
                                            @if (in_array($package->name, $contactpakage))
                                                <option value="{{ $package->name }}" selected>{{$package->name}}</option>
                                            @else
                                                <option value="{{ $package->name }}">{{ $package->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if($product->category[0] == 58 || $product->category[0] == 63 || $product->category[0] == 82)
                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Lens Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitylenscolor = $product->color ? explode(',', $product->color) : array();
                                    ?>
                                    <select class="form-control" name="color" id="lenscolor" >
                                    	@foreach($lens_color as $color)
                                            @if (in_array($color->name, $arrSpecialitylenscolor))
                                    		    <option value="{{ $color->name }}" selected>{{$color->name}}</option>
                                            @else
                                                <option value="{{ $color->name }}">{{ $color->name }}</option>
                                            @endif
                                    	@endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($product->category[0] == 72)
                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactlenscolor">Contact Lens Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="contactlenscolor" >
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
                                        <option value="Burgandi">Burgandi</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitylenstechnology = $product->lenstechnology ? explode(',', $product->lenstechnology) : array();
                                    ?>
                                    <select class="form-control" name="lenstechnology" id="lenstechnology" >
                                    	@foreach($lenstechnology as $material)
                                    	    @if(in_array($material->name, $arrSpecialitylenstechnology))
                    		                    <option value="{{$material->name}}" selected>{{$material->name}}</option>
                                    	    @else
                    		                    <option value="{{$material->name}}">{{$material->name}}</option>
                                    		@endif
                                    	@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex" >
                                        <option value="{{$product->lensindex}}">{{$product->lensindex}}</option>
                                        <option value="1.49">1.49</option>
                                        <option value="1.50">1.50</option>
                                        <option value="1.53">1.53</option>
                                        <option value="1.55">1.55</option>
                                        <option value="1.56">1.56</option>
                                        <option value="1.59">1.59</option>
                                        <option value="1.60">1.60</option>
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
                                    <?php
                                        $arrSpecialitycoating = explode(',',$product->coating);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="coating[]" id="coating" >
                                        <option  <?=(in_array("hardcoat", $arrSpecialitycoating)  ? 'selected' : '');?> value="hardcoat">hardcoat</option>
                                        <option  <?=(in_array("Anti Reflection coating", $arrSpecialitycoating)  ? 'selected' : '');?> value="Anti Reflection coating">Anti Reflection coating</option>
                                        <option  <?=(in_array("Blue Cantrol", $arrSpecialitycoating)  ? 'selected' : '');?> value="Blue Cantrol">Blue Cantrol</option>
                                        <option  <?=(in_array("Anti fog", $arrSpecialitycoating)  ? 'selected' : '');?> value="Anti fog">Anti fog</option>
                                        <option  <?=(in_array("Photochromatic", $arrSpecialitycoating)  ? 'selected' : '');?> value="Photochromatic">Photochromatic</option>
                                        <option  <?=(in_array("POLARISED", $arrSpecialitycoating)  ? 'selected' : '');?> value="POLARISED ">POLARISED</option>
                                        <option  <?=(in_array("TRANSITION ", $arrSpecialitycoating)  ? 'selected' : '');?> value="TRANSITION">TRANSITION</option>
                                        <option  <?=(in_array("DAYNITE", $arrSpecialitycoating)  ? 'selected' : '');?> value="DAYNITE">DAYNITE</option>
                                        <option  <?=(in_array("UNCOAT", $arrSpecialitycoating)  ? 'selected' : '');?> value="UNCOAT">UNCOAT</option>
                                        <option  <?=(in_array("LENTICULAR", $arrSpecialitycoating)  ? 'selected' : '');?> value="LENTICULAR">LENTICULAR</option>
                                    </select>
                                    <!--<input id="coating" value="{{$product->coating}}" class="form-control col-md-7 col-xs-12" name="coating" placeholder="Enter Coating" type="text">-->
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power <span class="required" style="color:red;">*</span></label>
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

                            <div class="item form-group" id="productdimnew"><span class="required">MM</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type <span class="required" style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer <span class="required" style="color:red;">*</span></label>
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

                             <div class="item form-group" id="productdimensionnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" name="productdimension" placeholder="Product Dimension"  type="text" >
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" class="form-control col-md-7 col-xs-12" value="{{$product->weight}}" name="weight" placeholder="Product Weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageweightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packweight">Package Weight <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packweight" value="{{$product->packweight}}" class="form-control col-md-7 col-xs-12" name="packweight" placeholder="Package weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagewidthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{$product->packwidth}}" class="form-control col-md-7 col-xs-12" name="packwidth" placeholder="Package width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packheight">Package Height <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packheight" value="{{$product->packheight}}" class="form-control col-md-7 col-xs-12" name="packheight" placeholder="Package Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagelengthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packlength">Package Length <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packlength" value="{{$product->packlength}}" class="form-control col-md-7 col-xs-12" name="packlength" placeholder="Package Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <?php
                                        $arrSpecialitycountryoforigin = $product->countryoforigin ? explode(',',$product->countryoforigin) : array();
                                    ?>
                                    <select class="form-control" name="countryoforigin" id="countryoforigin">
                                        @foreach($countryoforigin as $value)
                                            @if (in_array($value->name, $arrSpecialitycountryoforigin))
                                                <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                            @else
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" value="{{$product->hsncode}}" placeholder="Hsn Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFile"> Current Featured Image <span class="required" style="color:red;">*</span>
                                <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="{{url('assets/images/products')}}/{{$product->feature_image}}" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" name="photo" value="{{$product->feature_image}}" type="file">
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
                                 </label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video}}" id="adminvideo"  type="video/mp4">
                                    </video>
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
                                </label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video1}}" id="adminvideo1"  type="video/mp4">
                                    </video>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo2" accept="video/*" name="video1" type="file">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo3"> Upload Video3
                                 </label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video2}}" id="adminvideo2"  type="video/mp4">
                                    </video>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo3" accept="video/*" name="video2" type="file">
                                </div>
                            </div>

                         
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Product Gallery Images <span class="required" style="color:red;">*</span>
                                <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
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

                            <div class="item form-group" id="descriptionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description <span class="required" style="color:red;">*</span>
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

                            <!--<div class="item form-group">-->
                            <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price<span class="required">*</span>-->
                            <!--        <p class="small-label">(In INR)</p>-->
                            <!--    </label>-->
                            <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--        <input id="selling-price" class="form-control col-md-7 col-xs-12" name="price" value="{{$product->price}}" placeholder="e.g 20"-->
                            <!--               title="Price must be a numeric or up to 2 decimal places." type="text">-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="selling-price" name="price" value="{{$product->price}}" placeholder="e.g 25"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP <span class="required" style="color:red;">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="previous_price" value="{{$product->previous_price}}" placeholder="e.g 25"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Cost Price <span style="color:red;">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_costprice" name="costprice" value="{{$product->costprice}}" placeholder="e.g 25"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock <span class="required" style="color:red;">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_stock" name="stock" value="{{$product->stock}}" placeholder="e.g 15" pattern="[0-9]{1,10}" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Tat <span style="color:red;">*</span>
                                    <p class="small-label">(Expected Delivery Time)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_producttat" name="producttat" value="{{$product->producttat}}" placeholder="e.g 15" pattern="[0-9]{1,10}" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="policynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy <span class="required" style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="policy" class="form-control" rows="6">{{$product->policy}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags<span class="required">*</span>-->
                                <!--    <p class="small-label">(Write your product tags Separated by Comma[,])</p>-->
                                <!--</label>-->
                                <!--<div class="col-md-6 col-sm-6 col-xs-12">-->
                                <!--    <input class="form-control col-md-7 col-xs-12" name="tags" value="{{$product->tags}}" data-role="tagsinput"/>-->
                                <!--</div>-->
                            </div>
                            <div class="error">
                                 <!--@if ($errors->has('featured'))-->
                                 <!--       <span class="help-block">-->
                                 <!--            <strong style="color: red;">{{ $errors->first('featured') }}</strong>-->
                                 <!--       </span>-->
                                 <!--   @endif-->
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                <!--    <div class="col-md-3 col-sm-2 col-xs-6">-->
                                <!--        @if($product->featured == 1)-->
                                <!--            <label class="btn btn-default active">-->
                                <!--                <input type="checkbox" name="featured" value="1" autocomplete="off" checked>-->
                                <!--                 Featured Product-->
                                <!--            </label>-->
                                <!--        @else-->
                                <!--            <label class="btn btn-default">-->
                                <!--                <input type="checkbox" name="featured" value="1" autocomplete="off">-->
                                <!--                 Featured Product-->
                                <!--            </label>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--    <div class="col-md-4 col-sm-2 col-xs-6">-->
                                <!--         @if($product->tranding == 1)-->
                                <!--            <label class="btn btn-default active">-->
                                <!--                <input type="checkbox" name="tranding" value="1" autocomplete="off" checked>-->
                                <!--                Tranding Product-->
                                <!--            </label>-->
                                <!--        @else-->
                                <!--            <label class="btn btn-default">-->
                                <!--                <input type="checkbox" name="tranding" value="1" autocomplete="off">-->
                                <!--                Tranding Product-->
                                <!--            </label>-->
                                <!--        @endif-->
                                <!--    </div>-->

                                <!--</div>-->
                            </div>

                         
                            <div class="item form-group">
                                <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">-->
                                <!--</label>-->
                                <!--<div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">-->
                                <!--    <div class="col-md-3 col-sm-2 col-xs-6">-->
                                <!--        @if($product->latest == 1)-->
                                <!--            <label class="btn btn-default active">-->
                                <!--                <input type="checkbox" name="latest" value="1" autocomplete="off" checked>-->
                                <!--                 Latest Product-->
                                <!--            </label>-->
                                <!--        @else-->
                                <!--            <label class="btn btn-default">-->
                                <!--                <input type="checkbox" name="latest" value="1" autocomplete="off">-->
                                <!--                 Latest Product-->
                                <!--            </label>-->
                                <!--        @endif-->
                                <!--    </div>-->

                                <!--    <div class="col-md-4 col-sm-2 col-xs-6">-->
                                <!--        @if($product->selected == 1)-->
                                <!--            <label class="btn btn-default active">-->
                                <!--                <input type="checkbox" name="selected" value="1" autocomplete="off" checked>-->
                                               
                                <!--                Selected Product-->
                                <!--            </label>-->
                                <!--        @else-->
                                <!--            <label class="btn btn-default">-->
                                <!--                <input type="checkbox" name="selected" value="1" autocomplete="off">-->
                                                
                                <!--                Selected Product-->
                                <!--            </label>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>

                            <!-- Product Attribute form start here -->
                            <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                
                                <!--Add color Attribute-->
                                <div>
                                    <label><span class="required"><input type="checkbox" id="available_pro_color">&nbsp; Allow Product Color</span>
                                    </label>
                                </div>

                                <div class="col-lg-12" id="product_color_div" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group color_image" id="row-box">
                                                <div id="product_attr">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="attr_color" class="form-control"  id="attr_color" >
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="attr_color_code" class="form-control"  id="attr_color_code" placeholder="Color Code">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input name="color_file[]" id="color_file" type="file" multiple class="form-control" aria-required="true" aria-invalid="false" value="" >
                                                        </div>

                                                        <div class="col-md-3">
                                                           <button type="button" class="btn btn-success " id="add_product_color" value="Add">Add</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="color_table" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Color Name</th>
                                                                <th>Color Code</th>
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
                                                <input type="text" name="ranegnameone" id="ranegnameone" value="{{ $product->ranegnameone != '' ? $product->ranegnameone : '' }}" placeholder="e.g 11-50">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_one" id="discount_one" value="{{ $product->discount_one != '' ? $product->discount_one : '' }}" placeholder="e.g. 10">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" name="rangenametwo" id="rangenametwo" value="{{ $product->rangenametwo != '' ? $product->rangenametwo : '' }}" placeholder="e.g 51-100">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_two" id="discount_two" value="{{ $product->discount_two != '' ? $product->discount_two : '' }}" placeholder="e.g. 20">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" name="rangenamethree" id="rangenamethree" value="{{ $product->rangenamethree != '' ? $product->rangenamethree : '' }}" placeholder="e.g 101-150">    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" name="discount_three" id="discount_three" value="{{ $product->discount_three != '' ? $product->discount_three : '' }}" placeholder="e.g. 30">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>

                                <div>
                                    <label><span class="required"><input type="checkbox" id="manage_pro_attr">&nbsp; Manage Product Attribute</span>
                                    </label>
                                </div>

                                <div id="manage_pro_attr_div" style="margin:-2px; display:none; margin-bottom: 10px; ">
                                    <table id="manage_attr_table" style="width: 100%;">
                                        <tbody>
                                            <div id="product_attr_data">
                                                
                                            </div>
                                            
                                            @php 
                                                $count_row = 1;
                                            @endphp
                                            @foreach($attrData as $attr)
                                            <tr id="{{$count_row}}" class="form-group"> 
                                                <td class="col-md-2">
                                                    <input type="text" class="form-control att_pro_sku" name="att_pro_sku[]" value="{{ $attr->attr_sku != '' ? $attr->attr_sku : '' }}" placeholder="Attr SKU No" />
                                                </td>
                                                <td class="col-md-2">
                                                    <input type="text" class="form-control attr_pro_size" name="attr_pro_size[]"  value="{{ $attr->attr_size != '' ? $attr->attr_size : '' }}" placeholder="Size"/>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type="number" placeholder="Qty" class="form-control attr_pro_qty" name="attr_pro_qty[]" value="{{ $attr->attr_qty != '' ? $attr->attr_qty : '' }}" placeholder="Attr Qty" />
                                                </td>
                                                <td class="col-md-2">
                                                    <input type="number" placeholder="MRP" class="form-control attr_mrp" name="attr_mrp[]" value="{{ $attr->attr_mrp != '' ? $attr->attr_mrp : '' }}" />
                                                </td>
                                                <td class="col-md-2">
                                                    <input type="number" placeholder="SP" class="form-control attr_pro_price" name="attr_pro_price[]" value="{{ $attr->attr_price != '' ? $attr->attr_price : '' }}" placeholder="Attr Size Price" />
                                                </td>
                                                <td class="col-md-3">
                                                    <select class="form-control attr_pro_color" name="attr_pro_color[]">
                                                        @foreach($attrColor as $a)
                                                        @if($a->color == $attr->attr_color)
                                                            <option value="{{$a->color}}" selected>{{$a->color}}</option>
                                                        @else
                                                            <option value="{{$a->color}}" >{{$a->color}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="col-md-1">
                                                        <button type="button" class="btn btn-default" style="padding: 0.5rem 0.75rem !important;"><i class="fa fa-plus" onclick="replicateManageTable('manage_attr_table')" ></i>
                                                    </button>
                                                </td>
                                                <td class="col-md-1">
                                                    <button type="button" class="btn btn-defualt" style="padding: 0.5rem 0.75rem !important;">
                                                        <i class="fa fa-minus" onclick="removereplicateManageTable({{$attr->id}}, event)" ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            
                                            @php
                                                $count_row++;
                                            @endphp
                                            @endforeach
                                            
                                            <tr id="{{$count_row}}" class="form-group"> 
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
                                                    <input type="number" placeholder="MRP" class="form-control attr_mrp" name="attr_mrp[]" placeholder="Attr MRP Price" />
                                                </td>
                                                <td class="col-md-2">
                                                    <input type="number" placeholder="SP" class="form-control attr_pro_price" name="attr_pro_price[]" placeholder="Attr SP Price" />
                                                </td>
                                                <td class="col-md-3">
                                                    <select class="form-control attr_pro_color" name="attr_pro_color[]">
                                                        <option value="">Select Color</option>
                                                        @foreach($attrColor as $a)
                                                            <option value="{{$a->color}}">{{$a->color}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="col-md-1">
                                                        <button type="button" class="btn btn-default" style="padding: 0.5rem 0.75rem !important;"><i class="fa fa-plus" onclick="replicateManageTable('manage_attr_table')" ></i>
                                                    </button>
                                                </td>
                                                <td class="col-md-1">
                                                    <button type="button" class="btn btn-defualt" style="padding: 0.5rem 0.75rem !important;">
                                                        <i class="fa fa-minus" onclick="removereplicateManageTable('manage_attr_table')" ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <br>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        
                            <!-- Product Attribute form end here -->

                            <div class="form-group" id="submit-form-button">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="add_ads" style="width:136px;" type="submit" class="btn btn-success btn-block">Update Product</button>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{!! url('admin/products') !!}" class="btn btn-danger" style="margin-left: 142px; margin-top: -33px;width: 135px;">Back</a>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ URL::asset('assets/js/vendor/product/editproduct.js') }}"></script>
<script src="{{ URL::asset('assets/js/vendor/product/select2query.js') }}"></script>

<!------------ JavaScript code by Prashant Start here ----------->

<!---- for product attribute and attribute gallery delete purpose ----->

<script>
    var productdiv = document.querySelector("#product_attr_data");
    function removereplicateManageTable(id, e){
        var id = id;
        e.target.parentElement.parentElement.parentElement.remove();
        
        var attrdiv = document.createElement("input");
        attrdiv.setAttribute('name', 'removeattr[]');
        attrdiv.setAttribute('type', 'hidden');
        attrdiv.setAttribute('value', id);
        productdiv.appendChild(attrdiv);
    }
</script>
<script type="text/javascript">
    var color_datatable;
    $(document).on('click', '#available_pro_color', function(){ 
    var product_id = '{{$product->productsku}}';
    if($(this).is(':checked')) {
         $('#color_table').dataTable({
            'serverSide': true,
            'bProcessing': true,
            'searching' : false,
            'ordering' : false,
            'paging' : false,
           
            'scrollY': '300px',
            'scrollCollapse': true,
            'info' : false,
            'bDestroy' : true,
            'order': [], 
            'ajax' : {
            'url'  : "{{url('/vendor/fetch_attr_color_list')}}",
            'data' : {product_id : product_id , '_token' : '{{ csrf_token() }}'},
            'type' : 'POST',
            },
            
            "columns": [
            { data: [0] },
            { data: [1] },
            { data: [2] },
            { data: [3] },
            { data: [4] },
            
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
        // $('#result').html( 'Event result:<br>'+result );
    } );

    function updateDataTable() 
    {
      
    }


     $(document).on('click', "#add_product_color", function(e){
        e.preventDefault();
        let product_id = '{{$product->productsku}}';
        let fileInput = $('#color_file')[0];
        let add_attr_color = $('#attr_color').val();
        let add_attr_color_code = $('#attr_color_code').val();

        if(product_id != '' && add_attr_color != '') {
             if( fileInput.files.length > 0 ){
                let formData = new FormData();
                $.each(fileInput.files, function(k,file){
                    formData.append('images[]', file);
                });

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('color', add_attr_color);
                formData.append('attr_color_code', add_attr_color_code);
                formData.append('product_id', product_id);
                let url = "{{url('/vendor/add_product_color')}}";
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
                            $('#attr_color_code').val('');
                            $('#color_file').val('');
                            fetch_attr_color_dropdown();
                            $('#color_table').DataTable().ajax.reload();
                        }else {
                            alert(resp.msg);
                        }
                    }
                });
            }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'SELECT IMAGES FIRST !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        }else {
            if(product_id == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'PRODUCT SKU REQUIRED !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(add_attr_color == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute Color !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(add_attr_color_code == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute Color code !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        }
    });

     function fetch_attr_color_dropdown() {
        let id = '{{$product->productsku}}';
        let url = "{{url('/vendor/fetch_attr_color_dropdown')}}";
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

        let url = "{{url('/vendor/delete_attr_color')}}";
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

    function replicateManageTable(tbl_name) {
        var tbl = '#'+tbl_name;
        let att_pro_sku =  $(tbl).find('tr:last .att_pro_sku').val();
        let attr_pro_size =  $(tbl).find('tr:last .attr_pro_size').val();
        let attr_pro_qty =  $(tbl).find('tr:last .attr_pro_qty').val();
        let attr_mrp =  $(tbl).find('tr:last .attr_mrp').val();
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
            myRow.find('.attr_mrp').val("");
            myRow.find('.attr_pro_price').val("");
            myRow.find('.attr_pro_color').val("");
            $('#manage_attr_table tr:last').after(myRow);
        }else {
            if(att_pro_sku == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute SKU !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(attr_pro_qty == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute QTY !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(attr_mrp == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute MRP !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(attr_pro_price == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill Attribute SP !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else if(attr_pro_color == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Select Attribute Color !',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Fill All data !',
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


<script type="text/javascript">
 $('.slide button').on('click',function(){
  $(this).parent('.slide').remove();
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
                $('#childs').append(s);
               }
        },
        })
    })
</script>

<script type="text/javascript">

$(document).ready(function() {

    $(document).on('change',".imagevalidation",function(){
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
    <!-- Here start to ajax to pass data into controller -->

@stop