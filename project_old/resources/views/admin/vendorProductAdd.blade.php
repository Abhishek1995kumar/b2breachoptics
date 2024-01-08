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
  
	#loader{
        display: flex;
        justify-content: center;
        background: transparent;
        position: fixed;
        cursor: wait;
        pointer-events: all;
        z-index: 99999999999;
        top: 50%;
        left: 50%;
        border: none;
        width: 100px !important;
        /*display:none;*/
    }
    
    .load{
        cursor: wait !important;
    }

    :root {
	--hue: 223;
	--bg: hsl(var(--hue),90%,95%);
	--fg: hsl(var(--hue),90%,5%);
	--trans-dur: 0.3s;
	font-size: calc(16px + (24 - 16) * (100vw - 320px) / (1280 - 320));
    }
    /* body {
    	background-color: var(--bg);
    	color: var(--fg);
    	font: 1em/1.5 sans-serif;
    	height: 100vh;
    	display: grid;
    	place-items: center;
    	transition: background-color var(--trans-dur);
    } */
    /* main {
    	padding: 1.5em 0;
    } */
    .ip {
    	width: 16em;
    	height: 8em;
    }
    .ip__track {
    	stroke: hsl(var(--hue),90%,90%);
    	transition: stroke var(--trans-dur);
    }
    .ip__worm1,
    .ip__worm2 {
    	animation: worm1 2s linear infinite;
    }
    .ip__worm2 {
    	animation-name: worm2;
    }
    
    /* Dark theme */
    @media (prefers-color-scheme: dark) {
    	:root {
    		--bg: hsl(var(--hue),90%,5%);
    		--fg: hsl(var(--hue),90%,95%);
    	}
    	.ip__track {
    		stroke: hsl(var(--hue),90%,15%);
    	}
    }
    
    /* Animation */
    @keyframes worm1 {
    	from {
    		stroke-dashoffset: 0;
    	}
    	50% {
    		animation-timing-function: steps(1);
    		stroke-dashoffset: -358;
    	}
    	50.01% {
    		animation-timing-function: linear;
    		stroke-dashoffset: 358;
    	}
    	to {
    		stroke-dashoffset: 0;
    	}
    }
    @keyframes worm2 {
    	from {
    		stroke-dashoffset: 358;
    	}
    	50% {
    		stroke-dashoffset: 0;
    	}
    	to {
    		stroke-dashoffset: -358;
    	}
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
                    <h3>Add Vendor Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <form action="{{url('admin/products/vendoradd')}}" onsubmit="vendorProductData(event)" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Vendor Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="vendor_name" class="form-control col-md-7 col-xs-12" name="vendor_name" placeholder="e.g Atractive Stylish Jeans For Women" value="" type="text">
                                </div>
                            </div>
                            <div class="error">
                                 @if ($errors->has('title'))
                                        <span class="help-block">
                                             <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            
                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" placeholder="e.g Atractive Stylish Jeans For Women" value="" type="text">
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
                                    <select class="form-control" name="mainid" id="maincats" >
                                        <option value="">Select Main Category</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="subid" id="subs" disabled>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="childid" id="childs" disabled>
                                        <option value="">Select Child Category</option>
                                    </select>
                                </div>
                            </div>
                            
                               <div class="item form-group" id="shapenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Shape </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="shape" id="shape" >
                                        <option value="">Select Shape</option>
                                        <!--<option value="Round" {{ old('shape') == "Round" ? 'selected' : '' }}>Round</option>-->
                                        <!--<option value="Square" {{ old('shape') == "Square" ? 'selected' : '' }}>Square</option>-->
                                        <!--<option value="Oval" {{ old('shape') == "Oval" ? 'selected' : '' }}>Oval</option>-->
                                        <!--<option value="Rectangle" {{ old('shape') == "Rectangle" ? 'selected' : '' }}>Rectangle</option>-->
                                        <!--<option value="Cat eye" {{ old('framestyle') == "Cat eye" ? 'selected' : '' }}>Cat eye</option>-->
                                        <!--<option value="Geometric" {{ old('framestyle') == "Geometric" ? 'selected' : '' }}>Geometric</option>-->
                                        <!--<option value="Brow line" {{ old('framestyle') == "Brow line" ? 'selected' : '' }}>Brow line</option>-->
                                        <!--<option value="Aviator" {{ old('framestyle') == "Aviator" ? 'selected' : '' }}>Aviator</option>-->
                                        <!--<option value="Wayfarer" {{ old('framestyle') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>-->
                                        <!--<option value="Pilot" {{ old('framestyle') == "Pilot" ? 'selected' : '' }}>Pilot</option>-->
                                        <!--<option value="Wrap" {{ old('framestyle') == "Wrap" ? 'selected' : '' }}>Wrap</option>-->
                                        <!--<option value="Wayfarer" {{ old('framestyle') == "Wayfarer" ? 'selected' : '' }}>Wayfarer</option>-->
                                        <!--<option value="Oversized" {{ old('framestyle') == "Oversized" ? 'selected' : '' }}>Oversized</option>-->
                                    </select>
                                </div>
                            </div>
                            
                               <div class="item form-group" id="colornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Color </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
                                        <option value="">Select Color</option>
                                        <!--<option value="BLACK" {{ old('color') == "BLACK" ? 'selected' : '' }}>BLACK</option>-->
                                        <!--<option value="GOLDEN" {{ old('color') == "GOLDEN" ? 'selected' : '' }}>GOLDEN</option>-->
                                        <!--<option value="WHITE" {{ old('color') == "WHITE" ? 'selected' : '' }}>WHITE</option>-->
                                        <!--<option value="BROWN" {{ old('color') == "BROWN" ? 'selected' : '' }}>BROWN</option>-->
                                        <!--<option value="RED" {{ old('color') == "RED" ? 'selected' : '' }}>RED</option>-->
                                        <!--<option value="Tortoise" {{ old('color') == "Tortoise" ? 'selected' : '' }}>Tortoise</option>-->
                                        <!--<option value="Blue" {{ old('color') == "Blue" ? 'selected' : '' }}>Blue</option>-->
                                        <!--<option value="Silver" {{ old('color') == "Silver" ? 'selected' : '' }}>Silver</option>-->
                                        <!--<option value="Grey" {{ old('color') == "Grey" ? 'selected' : '' }}>Grey</option>-->
                                        <!--<option value="Gunmetal" {{ old('color') == "Gunmetal" ? 'selected' : '' }}>Gunmetal</option>-->
                                        <!--<option value="Pink" {{ old('color') == "Pink" ? 'selected' : '' }}>Pink</option>-->
                                        <!--<option value="Beige" {{ old('color') == "Beige" ? 'selected' : '' }}>Beige</option>-->
                                        <!--<option value="green" {{ old('color') == "green" ? 'selected' : '' }}>green</option>-->
                                        <!--<option value="Purple" {{ old('color') == "Purple" ? 'selected' : '' }}>Purple</option>-->
                                        <!--<option value="Multicolor" {{ old('color') == "Multicolor" ? 'selected' : '' }}>Multicolor</option>-->
                                        <!--<option value="Rose Gold" {{ old('color') == "Rose Gold" ? 'selected' : '' }}>Rose Gold</option>-->
                                        <!--<option value="yellow" {{ old('color') == "yellow" ? 'selected' : '' }}>yellow</option>-->
                                        <!--<option value="Orange" {{ old('color') == "Orange" ? 'selected' : '' }}>Orange</option>-->
                                        <!--<option value="Glitter" {{ old('color') == "Glitter" ? 'selected' : '' }}>Glitter</option>-->
                                        <!--<option value="Maroon" {{ old('color') == "Maroon" ? 'selected' : '' }}>Maroon</option>-->
                                        <!--<option value="Transparent" {{ old('color') == "Transparent" ? 'selected' : '' }}>Transparent</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="gender" id="gender">
                                        <!--<option value="">Select Gender</option>-->
                                        <!--<option value="MEN" {{ old('gender') == "MEN" ? 'selected' : '' }} >Male</option>-->
                                        <!--<option value="WOMEN" {{ old('gender') == "WOMEN" ? 'selected' : '' }}>Female</option>-->
                                        <!--<option value="KIDS" {{ old('gender') == "KIDS" ? 'selected' : '' }}>Kids</option>-->
                                        <!--<option value="Unisex" {{ old('gender') == "Unisex" ? 'selected' : '' }}>Unisex</option>-->
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname">
                                        <option value="">Select Brand</option>
                                        <!--<option value="Alcon" {{ old('brandname') == "Alcon" ? 'selected' : '' }} >Alcon</option>-->
                                        <!--<option value="johnson and johnson" {{ old('brandname') == "johnson and johnson" ? 'selected' : '' }}>Johnson And Johnson</option>-->
                                        <!--<option value="bausch and lomb" {{ old('brandname') == "bausch and lomb" ? 'selected' : '' }}>Bausch And Lomb</option>-->
                                        <!--<option value="cooper vision" {{ old('brandname') == "Cooper Vision" ? 'selected' : '' }}>Cooper Vision</option>-->
                                        <!--<option value="CL India" {{ old('brandname') == "CL India" ? 'selected' : '' }}>CL India</option>-->
                                        <!--<option value="Asian Eyewear" {{ old('brandname') == " Asian Eyewear" ? 'selected' : '' }}> Asian Eyewear</option>-->
                                        <!--<option value="Vision Care Lab" {{ old('brandname') == "Vision Care Lab" ? 'selected' : '' }}>Vision Care Lab</option>-->
                                        <!--<option value="Zeiss" {{ old('brandname') == "Zeiss" ? 'selected' : '' }}>Zeiss</option>-->
                                        <!--<option value="Hoya" {{ old('brandname') == "Hoya" ? 'selected' : '' }}>Hoya</option>-->
                                        <!--<option value="Purvesh" {{ old('brandname') == "Purvesh" ? 'selected' : '' }}>Purvesh</option>-->
                                        <!--<option value="Prime" {{ old('brandname') == "Prime" ? 'selected' : '' }}>Prime</option>-->
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <!-- Start new input fields added as per category  -->

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Model No</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
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

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial" >
                                        <option value="">Select Frame Material</option>
                                        <!--<option value="Plastic" {{ old('framematerial') == "Plastic" ? 'selected' : '' }}>Plastic</option>-->
                                        <!--<option value="Acetate" {{ old('framematerial') == "Acetate" ? 'selected' : '' }}>Acetate</option>-->
                                        <!--<option value="Metal" {{ old('framematerial') == "Metal" ? 'selected' : '' }}>Metal</option>-->
                                        <!--<option value="Stainless Steel" {{ old('framematerial') == "Stainless Steel" ? 'selected' : '' }}>Stainless Steel</option>-->
                                        <!--<option value="Titanium" {{ old('framematerial') == "Titanium" ? 'selected' : '' }}>Titanium</option>-->
                                        <!--<option value="TR90" {{ old('framematerial') == "TR90" ? 'selected' : '' }}>TR90</option>-->
                                        <!--<option value="Ultem" {{ old('framematerial') == "Ultem" ? 'selected' : '' }}>Ultem</option>-->
                                        <!--<option value="Wood" {{ old('framematerial') == "Wood" ? 'selected' : '' }}>Wood</option>-->
                                        <!--<option value="Monel" {{ old('framematerial') == "Monel" ? 'selected' : '' }}>Monel</option>-->
                                        <!--<option value="Aluminium" {{ old('framematerial') == "Aluminium" ? 'selected' : '' }}>Aluminium</option>-->
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
                                    <input id="height" value="" class="form-control col-md-7 col-xs-12" name="height" placeholder="Enter Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usages" value="" class="form-control col-md-7 col-xs-12" name="usages" placeholder="Enter Usages" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="" class="form-control col-md-7 col-xs-12" name="usagesduration" placeholder="Enter Usages Duration" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="" class="form-control col-md-7 col-xs-12" name="templematerial" placeholder="Temple Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="" class="form-control col-md-7 col-xs-12" name="templecolor" placeholder="Temple Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype" >
                                        <option value="">Select Lens Material</option>
                                        <!--<option value="CR-39" {{ old('lensmaterialtype') == "CR-39" ? 'selected' : '' }}>CR-39</option>-->
                                        <!--<option value="MR-8" {{ old('lensmaterialtype') == "MR-8" ? 'selected' : '' }}>MR-8</option>-->
                                        <!--<option value="PNX" {{ old('lensmaterialtype') == "PNX" ? 'selected' : '' }}>PNX</option>-->
                                        <!--<option value="Trivex" {{ old('lensmaterialtype') == "Trivex" ? 'selected' : '' }}>Trivex</option>-->
                                        <!--<option value="Blue Cantrol" {{ old('lensmaterialtype') == "Blue Cantrol" ? 'selected' : '' }}>Blue Cantrol</option>-->
                                        <!--<option value="Tribrid" {{ old('lensmaterialtype') == "Tribrid" ? 'selected' : '' }}>Tribrid</option>-->
                                        <!--<option value="High Index Plastic" {{ old('lensmaterialtype') == "High Index Plastic" ? 'selected' : '' }}>High Index Plastic</option>-->
                                        <!--<option value="Polycarbonate" {{ old('lensmaterialtype') == "Polycarbonate" ? 'selected' : '' }}>Polycarbonate</option>-->
                                        <!--<option value="Crown Glass" {{ old('lensmaterialtype') == "Crown Glass" ? 'selected' : '' }}>Crown Glass</option>-->
                                        <!--<option value="MR-7" {{ old('lensmaterialtype') == "MR-7" ? 'selected' : '' }}>MR-7</option>-->
                                        <!--<option value="PGX" {{ old('lensmaterialtype') == "PGX" ? 'selected' : '' }}>PGX</option>-->
                                        <!--<option value="PBX" {{ old('lensmaterialtype') == "PBX" ? 'selected' : '' }}>PBX</option>-->
                                        <!--<option value="Mid Index" {{ old('lensmaterialtype') == "Mid Index" ? 'selected' : '' }}>Mid Index</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="leanscoatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="leanscoating" value="" class="form-control col-md-7 col-xs-12" name="leanscoating" placeholder="Lens coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Diameter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="diameter" value="" class="form-control col-md-7 col-xs-12" name="diameter" placeholder="Enter Diameter" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="" class="form-control col-md-7 col-xs-12" name="contactlensmaterialtype" placeholder="Contact Lens Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Base Curve</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="basecurve" value="" class="form-control col-md-7 col-xs-12" name="basecurve" placeholder="Base Curve" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Min Sphere Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="powermin" value="" class="form-control col-md-7 col-xs-12" name="powermin" placeholder="Enter Sphere Power" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="powernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Max Sphere Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="powermax" value="" class="form-control col-md-7 col-xs-12" name="powermax" placeholder="Enter Sphere Power" type="text">
                                </div>
                            </div>
                          
                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" class="form-control col-md-7 col-xs-12" value="" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="cylindernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cylinder" value="" class="form-control col-md-7 col-xs-12" name="cylindernew" placeholder="Enter Cylinder" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="axisnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="axis" value="" class="form-control col-md-7 col-xs-12" name="axisnew" placeholder="Enter Axis" type="text">
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Disposability</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability" >
                                        <option value="">Select Disposability</option>
                                        <!--<option value="Daily" {{ old('disposability') == "Daily" ? 'selected' : '' }}>Daily</option>-->
                                        <!--<option value="Weekly" {{ old('disposability') == "Weekly" ? 'selected' : '' }}>Weekly</option>-->
                                        <!--<option value="Monthly" {{ old('disposability') == "Monthly" ? 'selected' : '' }}>Monthly</option>-->
                                        <!--<option value="Yearly" {{ old('disposability') == "Yearly" ? 'selected' : '' }}>Yearly</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Packaging</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging" >
                                        <option value="">Select Packaging</option>
                                        <!--<option value="1 Lens Per Box" {{ old('packaging') == "1 Lens Per Box" ? 'selected' : '' }}>1 Lens Per Box</option>-->
                                        <!--<option value="2 Lens Per Box" {{ old('packaging') == "2 Lens Per Box" ? 'selected' : '' }}>2 Lens Per Box</option>-->
                                        <!--<option value="3 Lens Per Box" {{ old('packaging') == "3 Lens Per Box" ? 'selected' : '' }}>3 Lens Per Box</option>-->
                                        <!--<option value="5 Lens Per Box" {{ old('packaging') == "5 Lens Per Box" ? 'selected' : '' }}>5 Lens Per Box</option>-->
                                        <!--<option value="6 Lens Per Box" {{ old('packaging') == "6 Lens Per Box" ? 'selected' : '' }}>6 Lens Per Box</option>-->
                                        <!--<option value="10 Lens Per Box" {{ old('packaging') == "10 Lens Per Box" ? 'selected' : '' }}>10 Lens Per Box</option>-->
                                        <!--<option value="12 Lens Per box" {{ old('packaging') == "12 Lens Per Box" ? 'selected' : '' }}>12 Lens Per box</option>-->
                                        <!--<option value="30 Lens Per Box" {{ old('packaging') == "30 Lens Per Box" ? 'selected' : '' }}>30 Lens Per Box</option>-->
                                        <!--<option value="60 Lens Per Box" {{ old('packaging') == "60 Lens Per Box" ? 'selected' : '' }}>60 Lens Per Box</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="">Select Color</option>
                                        <!--<option value="grey" {{ old('lenscolor') == "grey" ? 'selected' : '' }}>Grey</option>-->
                                        <!--<option value="blue" {{ old('lenscolor') == "blue" ? 'selected' : '' }}>Blue</option>-->
                                        <!--<option value="green" {{ old('lenscolor') == "green" ? 'selected' : '' }}>Green</option>-->
                                        <!--<option value="brown" {{ old('lenscolor') == "brown" ? 'selected' : '' }}>Brown</option>-->
                                        <!--<option value="yellow" {{ old('lenscolor') == "yellow" ? 'selected' : '' }}>Yellow</option>-->
                                        <!--<option value="pink" {{ old('lenscolor') == "pink" ? 'selected' : '' }}>Pink</option>-->
                                        <!--<option value="black" {{ old('lenscolor') == "black" ? 'selected' : '' }}>Black</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="conditionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Conditions</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="condition" value="" class="form-control col-md-7 col-xs-12" name="conditionsnew" placeholder="Conditions" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstechnology" id="lenstechnology" >
                                        <option value="">Select Lens Technology</option>
                                        <!--<option value="Mirror Coating" {{ old('lenstechnology') == "Mirror Coating" ? 'selected' : '' }}>Mirror Coating</option>-->
                                        <!--<option value="Scratch Resistant Coating" {{ old('lenstechnology') == "Scratch Resistant Coating" ? 'selected' : '' }}>Scratch Resistant Coating</option>-->
                                        <!--<option value="Anti-Fog Coating" {{ old('lenstechnology') == "Anti-Fog Coating" ? 'selected' : '' }}>Anti-Fog Coating</option>-->
                                        <!--<option value="Anti-Reflective Coating" {{ old('lenstechnology') == "Anti-Reflective Coating" ? 'selected' : '' }}>Anti-Reflective Coating</option>-->
                                        <!--<option value="Water Resistant Coating" {{ old('lenstechnology') == "Water Resistant Coating" ? 'selected' : '' }}>Water Resistant Coating</option>-->
                                        <!--<option value="UV Protection Coating" {{ old('lenstechnology') == "UV Protection Coating" ? 'selected' : '' }}>UV Protection Coating</option>-->
                                        <!--<option value="Blue Control Coating" {{ old('lenstechnology') == "Blue Control Coating" ? 'selected' : '' }}>Blue Control Coating</option>-->
                                        <!--<option value="Polarized" {{ old('lenstechnology') == "Polarized" ? 'selected' : '' }}>Polarized</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex" >
                                        <option value="">Select Lens Index</option>
                                        <!--<option value="1.49" {{ old('lensindex') == "1.49" ? 'selected' : '' }}>1.49</option>-->
                                        <!--<option value="1.5" {{ old('lensindex') == "1.5" ? 'selected' : '' }}>1.5</option>-->
                                        <!--<option value="1.53" {{ old('lensindex') == "1.53" ? 'selected' : '' }}>1.53</option>-->
                                        <!--<option value="1.55" {{ old('lensindex') == "1.55" ? 'selected' : '' }}>1.55</option>-->
                                        <!--<option value="1.56" {{ old('lensindex') == "1.56" ? 'selected' : '' }}>1.56</option>-->
                                        <!--<option value="1.59" {{ old('lensindex') == "1.59" ? 'selected' : '' }}>1.59</option>-->
                                        <!--<option value="1.6" {{ old('lensindex') == "1.6" ? 'selected' : '' }}>1.6</option>-->
                                        <!--<option value="1.61" {{ old('lensindex') == "1.61" ? 'selected' : '' }}>1.61</option>-->
                                        <!--<option value="1.67" {{ old('lensindex') == "1.67" ? 'selected' : '' }}>1.67</option>-->
                                        <!--<option value="1.7" {{ old('lensindex') == "1.7" ? 'selected' : '' }}>1.7</option>-->
                                        <!--<option value="1.74" {{ old('lensindex') == "1.74" ? 'selected' : '' }}>1.74</option>-->
                                        <!--<option value="1.8" {{ old('lensindex') == "1.8" ? 'selected' : '' }}>1.8</option>-->
                                    </select>
                                </div>
                            </div>
                           
                            <div class="item form-group" id="gravitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" value="" class="form-control col-md-7 col-xs-12" name="gravity" placeholder="Enter Gravity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powerrangenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Power Range</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="powerange" value="" class="form-control col-md-7 col-xs-12" name="powerrange" placeholder="Enter Power Range" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect">
                                        <option value="">Select Lens Type</option>
                                        <!--<option value="Biofocal" {{ old('visioneffect') == "Biofocal" ? 'selected' : '' }}>Biofocal</option>-->
                                        <!--<option value="Progressive" {{ old('visioneffect') == "Progressive" ? 'selected' : '' }}>Progressive</option>-->
                                        <!--<option value="Zero Power" {{ old('visioneffect') == "Zero Power" ? 'selected' : '' }}>Zero Power</option>-->
                                        <!--<option value="single Vision" {{ old('visioneffect') == "single Vision" ? 'selected' : '' }}>single Vision</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coating" value="" class="form-control col-md-7 col-xs-12" name="coating" placeholder="Enter Coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                        <option value="">Select Lens Type</option>
                                        <!--<option value="Spherical" {{ old('lenstype') == "Spherical" ? 'selected' : '' }}>Single Vision</option>-->
                                        <!--<option value="MultiFocal" {{ old('lenstype') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>-->
                                        <!--<option value="toric & Astigmatism" {{ old('lenstype') == "toric & Astigmatism" ? 'selected' : '' }}>toric & Astigmatism</option>-->
                                        <!--<option value="No Power" {{ old('lenstype') == "No Power" ? 'selected' : '' }}>No Power</option>-->
                                        <!--<option value="Color Lenses" {{ old('lenstype') == "Color Lenses" ? 'selected' : '' }}>Color Lenses</option>-->
                                        <!--<option value="ColorWithPower" {{ old('lenstype') == "ColorWithPower" ? 'selected' : '' }}>ColorWithPower</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="addpower" value="" class="form-control col-md-7 col-xs-12" name="addpower" placeholder="Enter Power" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" value="" class="form-control col-md-7 col-xs-12" name="coatingcolor" placeholder="Enter Coating Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" value="" class="form-control col-md-7 col-xs-12" name="abbevalue" placeholder="Enter Abbe Value" type="text">
                                </div>
                            </div> 

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" value="" class="form-control col-md-7 col-xs-12" name="netquntity" placeholder="Enter Net Quantity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="" class="form-control col-md-7 col-xs-12" name="focallength" placeholder="Enter Focal Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pack Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packtype" value="" class="form-control col-md-7 col-xs-12" name="packtype" placeholder="Enter Pack Type" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Shelf Life</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="" class="form-control col-md-7 col-xs-12" name="shelflife" placeholder="Enter Shelf Life" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="formnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Form</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="form" value="" class="form-control col-md-7 col-xs-12" name="form" placeholder="Enter Form" type="text">
                                </div>
                            </div>

                            
                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="" class="form-control col-md-7 col-xs-12" name="productcolor" placeholder="Enter Product Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="" class="form-control col-md-7 col-xs-12" name="productdim" placeholder="Enter Product Dimension" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="" class="form-control col-md-7 col-xs-12" name="material" placeholder="Enter Product Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="frametype" id="frametype" >
                                        <option value="">Select Frame Type</option>
                                        <!--<option value="fullrim" {{ old('frametype') == "Full Rim" ? 'selected' : '' }}>Full Rim</option>-->
                                        <!--<option value="halfrim" {{ old('frametype') == "Half Rim" ? 'selected' : '' }}>Half Rim</option>-->
                                        <!--<option value="rimless" {{ old('frametype') == "Rimless" ? 'selected' : '' }}>Rimless</option>-->
                                    </select>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>
                             <div class="item form-group" id="manufracturernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" value="" class="form-control col-md-7 col-xs-12" name="manufracturer" placeholder=" Enter Manufracturer" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" value="" class="form-control col-md-7 col-xs-12" name="warrentytype" placeholder="Warrenty Type" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew"> 
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" value="" class="form-control col-md-7 col-xs-12" name="productdimension" placeholder="Frame Dimension"  type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Weight</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" value="" class="form-control col-md-7 col-xs-12" name="weight" placeholder="weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country Of Origin</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="countryoforigin" id="countryoforigin" >
                                        <option value="">Select Country Of Origin</option>
                                        
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="hsncodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value=""  id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" placeholder="Hsn Code" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                  <p class="small-label">(700 × 560)(Size:400kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="photo" type="file" >
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video1 </label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video2 </label>
                           
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video1" type="file" >
                                </div>
                            </div>
                            <br>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video3 label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile" accept="video/*" name="video2" type="file" >
                                </div>
                            </div>
                            <br>
                            

                            <label class="control-label col-md-1 col-sm-1 col-xs-10" for="number"> Product Gallery Images <span class="required">*</span><p class="small-label">(700 × 560)(Size:400kb)(Type:jpeg,png)</p></label>
                            <div class="image-upload-container">
                                  <div class="image-upload-one">
                                    <div class="center">
                                      <div class="form-input">
                                        <label for="file-ip-1">
                                          <img id="file-ip-1-preview" src="https://i.ibb.co/ZVFsg37/default.png">
                                          <button type="button" class="imgRemove" onclick="myImgRemove(1)"></button>
                                        </label>
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-1" accept="image/*" onchange="showPreview(event, 1);">
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
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-2" accept="image/*" onchange="showPreview(event, 2);">
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
                                        <input type="file" style="display: none;" name="gallery[]" id="file-ip-3" accept="image/*" onchange="showPreview(event, 3);">
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
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-4" accept="image/*" onchange="showPreview(event, 4);">
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
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-5" accept="image/*" onchange="showPreview(event, 5);">
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
                                          <input type="file" style="display: none;" name="gallery[]" id="file-ip-6" accept="image/*" onchange="showPreview(event, 6);">
                                        </div>
                                      </div>
                                    </div>

                                  <!-- ************************************************************************************************************** -->
                                </div><br>
    
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
                                    <textarea name="description" id="description" class="form-control" rows="6"></textarea>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Current Price<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" value="" name="price" placeholder="e.g 20" 
                                           title="Price must be a numeric or up to 2 decimal places."  type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Previous Price<span class="required">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="" name="previous_price" placeholder="e.g 25" 
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Product Cost Price<span class="required">*</span>
                                    
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value=" " name="costprice" placeholder="e.g 25"
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
                                       
                                      </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="item form-group" id="stocknew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock<span class="required">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value=" " name="stock" placeholder="e.g 15" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="policynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                            <input type="checkbox"  name="featured" value="1" autocomplete="off" >
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                             Featured Product
                                        </label>
                                    </div>

                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="tranding"  value="1" autocomplete="off">
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
                                            <input type="checkbox" name="latest" value="1" autocomplete="off">
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                            Latest Product
                                        </label> 
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="selected"  value="1" autocomplete="off">
                                            <!-- <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span> -->
                                             Selected Product
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags<span class="required">*</span>
                                    <p class="small-label">(Write your product tags Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="tags" value=" "  data-role="tagsinput"/>
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

@stop

@section('footer')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
        function vendorProductData(e){
            let data = [];
            data[1] = document.getElementById("title");
            data[2] = document.getElementById("mainid");
            data[3] = document.getElementById("subid");
            data[4] = document.getElementById("childid");
            data[5] = document.getElementById("shape");
            data[6] = document.getElementById("color");
            data[7] = document.getElementById("gender");
            data[8] = document.getElementById("brandname");
            data[9] = document.getElementById("modelno");
            data[10] = document.getElementById("sellername");
            data[11] = document.getElementById("productsku");
            data[12] = document.getElementById("framematerial");
            data[13] = document.getElementById("framewidth");
            data[14] = document.getElementById("prescriptiontype");
            data[15] = document.getElementById("height");
            data[16] = document.getElementById("usages");
            data[17] = document.getElementById("usagesduration");
            data[18] = document.getElementById("templematerial");
            data[19] = document.getElementById("templecolor");
            data[20] = document.getElementById("lensmaterialtype");
            data[21] = document.getElementById("leanscoating");
            data[22] = document.getElementById("diameter");
            data[23] = document.getElementById("contactlensmaterialtype");
            data[24] = document.getElementById("basecurve");
            data[25] = document.getElementById("watercontent");
            data[26] = document.getElementById("powermin");
            data[27] = document.getElementById("vpowermax");
            data[28] = document.getElementById("centerthikness");
            data[29] = document.getElementById("cylinder");
            data[30] = document.getElementById("axis");
            data[31] = document.getElementById("disposability");
            data[32] = document.getElementById("packaging");
            data[33] = document.getElementById("lenscolor");
            data[34] = document.getElementById("condition");
            data[35] = document.getElementById("lenstechnology");
            data[36] = document.getElementById("lensindex");
            data[37] = document.getElementById("gravity");
            data[38] = document.getElementById("powerange");
            data[39] = document.getElementById("visioneffect");
            data[40] = document.getElementById("coating");
            data[41] = document.getElementById("lenstype");
            data[42] = document.getElementById("addpower");
            data[43] = document.getElementById("coatingcolor");
            data[44] = document.getElementById("abbevalue");
            data[45] = document.getElementById("netquntity");
            data[46] = document.getElementById("focallength");
            data[47] = document.getElementById("packtype");
            data[48] = document.getElementById("shelflife");
            data[49] = document.getElementById("productcolor");
            data[50] = document.getElementById("productdim");
            data[51] = document.getElementById("material");
            
            for(let x=0; x<data.lenght; x++){
                if(!data){
                    Swal.fire({
                        title: "Please " + data[x].placeholder,
                        imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'OK',
                    });
                    break;
                }
            }
                        // console.log("{{url('admin/products/vendoradd')}}");
            e.preventDefault();
        }
        
    </script>

@stop





