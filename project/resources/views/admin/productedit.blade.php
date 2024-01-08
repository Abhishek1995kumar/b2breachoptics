@extends('admin.includes.master-admin')
<style type="text/css">
    .error{
        padding-left: 310px;
    }
</style>

<style>
    /* Popup Window CSS Start */
    .delete_color {
        color: red;
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

    .show-prescription {
        width: 100%;
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
        width: 100px !important;
        /*display:none;*/
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
<!-- loader  Start here -->
    	<div id='loader' style='display:none;'>
    		<svg class="ip" viewBox="0 0 256 128"  xmlns="http://www.w3.org/2000/svg" >
    			<defs>
    				<linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
    					<stop offset="0%" stop-color="#5ebd3e" />
    					<stop offset="33%" stop-color="#ffb900" />
    					<stop offset="67%" stop-color="#f78200" />
    					<stop offset="100%" stop-color="#e23838" />
    				</linearGradient>
    				<linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
    					<stop offset="0%" stop-color="#e23838" />
    					<stop offset="33%" stop-color="#973999" />
    					<stop offset="67%" stop-color="#009cdf" />
    					<stop offset="100%" stop-color="#5ebd3e" />
    				</linearGradient>
    			</defs>
    			<g fill="none" stroke-linecap="round" stroke-width="16">
    				<g class="ip__track" stroke="#ddd">
    					<path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
    					<path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
    				</g>
    				<g stroke-dasharray="180 656">
    					<path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56"/>
    					<path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64"/>
    				</g>
    			</g>
    		</svg>
    	</div>
	<!-- loader End -->


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
                        <form method="POST" id="productFormSubmit"  class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <!--<form method="POST" action="{!! action('ProductController@update',['id' => $product->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">-->
                            {{csrf_field()}}
                            <input type="hidden" name='id' id="id" value="<?php echo $product->id ?>">
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name <span style="color:red;">*</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category <span style="color:red;">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" required >
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Premium Brands Type  <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="premiumtype" id="premiumtype" >
                                        <option value="{{$product->premiumtype}}">{{$product->premiumtype}}</option>
                                        <option value="Frames">Frames</option>
                                        <option value="Sunglasses">Sunglasses</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category <span style="color:red;">*</span>

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category <span style="color:red;">*</span>

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="shape" id="shape" >
                                        <option value="{{$product->shape}}">{{$product->shape}}</option>
                                        @foreach($frame_shape as $type)
                                            <option value="{{$type->name}}" <?php if($type->name == $product->shape){ echo "selected";} ?> >{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="framecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framecolor">Frame Color <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framecolor" id="framecolor" >
                                        <option value="{{$product->framecolor}}">{{$product->framecolor}}</option>
                                        @foreach($frame_color as $type)
                                            <option value="{{$type->name}}" <?php if($type->name == $product->framecolor){ echo "selected";} ?> >{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandname">Brand Name <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname" >
                                        <option value="{{$product->brandname}}">{{$product->brandname}}</option>
                                        @foreach($brand_data as $brand)
                                            <option value="{{$brand->name}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <!-- Start new input fields added as per category  -->

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Contact Lens Type <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                        @foreach($contact_lens_type as $type)
                                            <option value="{{$type->name}}" <?php if($type->name == $product->lenstype){ echo "selected";} ?> >{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="colorcodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colorcode">Color Code <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="colorcode" value="{{$product->colorcode}}" class="form-control col-md-7 col-xs-12" name="colorcode" placeholder="Color Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth"> Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framewidth" value="{{$product->framewidth}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="frameheight" value="{{$product->height}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Enter Height" type="text">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowerlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityadd = explode(',',$product->addpowerlens);
                                    ?>
                                    
                                     <select class="form-control" multiple="multiple" name="addpowerlens[]" id="addpowerlens">
                                        @foreach($lenses_data as $value)
                                        
                                            @if (in_array($value->add_power, $arrSpecialityadd) )
                                                
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
                                        $arrSpecialityadd = array_filter(explode(',',$product->diameterlens));
                                    ?>
                                    <select class="form-control" multiple="multiple" name="diameterlens[]" id="diameterlens">
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->diameter, $arrSpecialityadd) )
                                            
                                                <option value="{{ $value->diameter }}" selected>{{ $value->diameter }}</option>
                                            @else
                                                <option value="{{ $value->diameter }}">{{ $value->diameter }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="item form-group" id="spheres">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">Sphere <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitysphere = explode(',',$product->sphere);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="sphere[]" id="spherelens">
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->sphere, $arrSpecialitysphere) )
                                                <option value="{{ $value->sphere }}" selected>{{ $value->sphere }}</option>
                                            @else
                                                <option value="{{ $value->sphere }}">{{ $value->sphere }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="axisnlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpeciality = array_filter(explode(',',$product->axisnlens));
                                    ?>
                                    <select class="form-control" multiple="multiple" name="axisnlens[]" id="axisnlens" >
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->axis, $arrSpeciality))
                                                <option value="{{ $value->axis }}" selected>{{ $value->axis }}</option>
                                            @else
                                                <option value="{{ $value->axis }}">{{ $value->axis }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="cylinderlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinderlens">Cylinder <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylinders = array_filter(explode(',',$product->cylinderlens));
                                        
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

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial" >
                                        <option value="{{$product->framematerial}}">{{$product->framematerial}}</option>
                                        @foreach($frame_material as $frame)
                                            <option value="{{$frame->name}}">{{$frame->name}}</option>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control"  name="lensmaterialtype" id="lensmaterialtype" >
                                        <option value="{{$product->lensmaterialtype}}">{{$product->lensmaterialtype}}</option>
                                        @foreach($lens_material as $material)
                                                <option value="{{$material->name}}">{{$material->name}}</option>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "(" ?><i class="fa fa-minus"></i> <?php echo ")" ?> <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMinspere = explode(',',$product->powermin);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="powermin[]" id="powermin">
                                        <option  <?=(in_array("0.00", $arrMinspere)  ? 'selected' : '');?> value="0.00">0.00</option>
                                        <option  <?=(in_array("-0.25", $arrMinspere)  ? 'selected' : '');?> value="-0.25">-0.25</option>
                                        <option <?=(in_array("-0.50", $arrMinspere)  ? 'selected' : '');?> value="-0.50">-0.50</option>
                                        <option  <?=(in_array("-0.75", $arrMinspere)  ? 'selected' : '');?> value="-0.75">-0.75</option>
                                        <option  <?=(in_array("-1.00", $arrMinspere)  ? 'selected' : '');?> value="-1.00">-1.00</option>
                                        <option  <?=(in_array("-1.25", $arrMinspere)  ? 'selected' : '');?> value="-1.25">-1.25</option>
                                        <option  <?=(in_array("-1.50", $arrMinspere)  ? 'selected' : '');?> value="-1.50">-1.50</option>
                                        <option  <?=(in_array("-1.75", $arrMinspere)  ? 'selected' : '');?> value="-1.75">-1.75</option>
                                        <option  <?=(in_array("-2.00", $arrMinspere)  ? 'selected' : '');?> value="-2.00">-2.00</option>
                                        <option  <?=(in_array("-2.25", $arrMinspere)  ? 'selected' : '');?> value="-2.25">-2.25</option>
                                        <option  <?=(in_array("-2.50", $arrMinspere)  ? 'selected' : '');?> value="-2.50">-2.50</option>
                                        <option  <?=(in_array("-2.75", $arrMinspere)  ? 'selected' : '');?> value="-2.75">-2.75</option>
                                        <option  <?=(in_array("-3.00", $arrMinspere)  ? 'selected' : '');?> value="-3.00">-3.00</option>
                                        <option  <?=(in_array("-3.25", $arrMinspere)  ? 'selected' : '');?> value="-3.25">-3.25</option>
                                        <option  <?=(in_array("-3.50", $arrMinspere)  ? 'selected' : '');?> value="-3.50">-3.50</option>
                                        <option  <?=(in_array("-3.75", $arrMinspere)  ? 'selected' : '');?> value="-3.75">-3.75</option>
                                        <option  <?=(in_array("-4.00", $arrMinspere)  ? 'selected' : '');?> value="-4.00">-4.00</option>
                                        <option  <?=(in_array("-4.25", $arrMinspere)  ? 'selected' : '');?> value="-4.25">-4.25</option>
                                        <option  <?=(in_array("-4.50", $arrMinspere)  ? 'selected' : '');?> value="-4.50">-4.50</option>
                                        <option  <?=(in_array("-4.75", $arrMinspere)  ? 'selected' : '');?> value="-4.75">-4.75</option>
                                        <option  <?=(in_array("-5.00", $arrMinspere)  ? 'selected' : '');?> value="-5.00">-5.00</option>
                                        <option <?=(in_array("-5.25", $arrMinspere)  ? 'selected' : '');?> value="-5.25">-5.25</option>
                                        <option  <?=(in_array("-5.50", $arrMinspere)  ? 'selected' : '');?> value="-5.50">-5.50</option>
                                        <option  <?=(in_array("-5.75", $arrMinspere)  ? 'selected' : '');?> value="-5.75">-5.75</option>
                                        <option  <?=(in_array("-6.00", $arrMinspere)  ? 'selected' : '');?> value="-6.00">-6.00</option>
                                        <option <?=(in_array("-6.25", $arrMinspere)  ? 'selected' : '');?> value="-6.25">-6.25</option>
                                        <option  <?=(in_array("-6.50", $arrMinspere)  ? 'selected' : '');?> value="-6.50">-6.50</option>
                                        <option  <?=(in_array("-6.75", $arrMinspere)  ? 'selected' : '');?> value="-6.75">-6.75</option>
                                        <option  <?=(in_array("-7.00", $arrMinspere)  ? 'selected' : '');?> value="-7.00">-7.00</option>
                                        <option <?=(in_array("-7.25", $arrMinspere)  ? 'selected' : '');?> value="-7.25">-7.25</option>
                                        <option  <?=(in_array("-7.50", $arrMinspere)  ? 'selected' : '');?> value="-7.50">-7.50</option>
                                        <option  <?=(in_array("-7.75", $arrMinspere)  ? 'selected' : '');?> value="-7.75">-7.75</option>
                                        <option  <?=(in_array("-8.00", $arrMinspere)  ? 'selected' : '');?> value="-8.00">-8.00</option>
                                        <option  <?=(in_array("-8.25", $arrMinspere)  ? 'selected' : '');?> value="-8.25">-8.25</option>
                                        <option  <?=(in_array("-8.50", $arrMinspere)  ? 'selected' : '');?> value="-8.50">-8.50</option>
                                        <option  <?=(in_array("-8.75", $arrMinspere)  ? 'selected' : '');?> value="-8.75">-8.75</option>
                                        <option  <?=(in_array("-9.00", $arrMinspere)  ? 'selected' : '');?> value="-9">-9</option>
                                        <option  <?=(in_array("-9.25", $arrMinspere)  ? 'selected' : '');?> value="-9.25">-9.25</option>
                                        <option  <?=(in_array("-9.50", $arrMinspere)  ? 'selected' : '');?> value="-9.50">-9.50</option>
                                        <option  <?=(in_array("-9.75", $arrMinspere)  ? 'selected' : '');?> value="-9.75">-9.75</option>
                                        <option  <?=(in_array("-10.00", $arrMinspere)  ? 'selected' : '');?> value="-10.00">-10.00</option>
                                        <option  <?=(in_array("-10.25", $arrMinspere)  ? 'selected' : '');?> value="-10.25">-10.25</option>
                                        <option <?=(in_array("-10.50", $arrMinspere)  ? 'selected' : '');?> value="-10.50">-10.50</option>
                                        <option  <?=(in_array("-10.75", $arrMinspere)  ? 'selected' : '');?> value="-10.75">-10.75</option>
                                        <option  <?=(in_array("-11.00", $arrMinspere)  ? 'selected' : '');?> value="-11.00">-11.00</option>
                                        <option  <?=(in_array("-11.25", $arrMinspere)  ? 'selected' : '');?> value="-11.25">-11.25</option>
                                        <option  <?=(in_array("-11.50", $arrMinspere)  ? 'selected' : '');?> value="-11.50">-11.50</option>
                                        <option  <?=(in_array("-11.75", $arrMinspere)  ? 'selected' : '');?> value="-11.75">-11.75</option>

                                        <option  <?=(in_array("-12.00", $arrMinspere)  ? 'selected' : '');?> value="-12.00">-12.00</option>
                                        <option  <?=(in_array("-12.25", $arrMinspere)  ? 'selected' : '');?> value="-12.25">-12.25</option>
                                        <option  <?=(in_array("-12.50", $arrMinspere)  ? 'selected' : '');?> value="-12.50">-12.50</option>
                                        <option  <?=(in_array("-12.75", $arrMinspere)  ? 'selected' : '');?> value="-12.75">-12.75</option>

                                        <option  <?=(in_array("-13.00", $arrMinspere)  ? 'selected' : '');?> value="-13.00">-13.00</option>
                                        <option  <?=(in_array("-13.25", $arrMinspere)  ? 'selected' : '');?> value="-13.25">-13.25</option>
                                        <option  <?=(in_array("-13.50", $arrMinspere)  ? 'selected' : '');?> value="-13.50">-13.50</option>
                                        <option  <?=(in_array("-13.75", $arrMinspere)  ? 'selected' : '');?> value="-13.75">-13.75</option>

                                        <option  <?=(in_array("-14.00", $arrMinspere)  ? 'selected' : '');?> value="-14.00">-14.00</option>
                                        <option  <?=(in_array("-14.25", $arrMinspere)  ? 'selected' : '');?> value="-14.25">-14.25</option>
                                        <option  <?=(in_array("-14.50", $arrMinspere)  ? 'selected' : '');?> value="-14.50">-14.50</option>
                                        <option  <?=(in_array("-14.75", $arrMinspere)  ? 'selected' : '');?> value="-14.75">-14.75</option>

                                        <option  <?=(in_array("-15.00", $arrMinspere)  ? 'selected' : '');?> value="-15.00">-15.00</option>
                                        <option  <?=(in_array("-15.25", $arrMinspere)  ? 'selected' : '');?> value="-15.25">-15.25</option>
                                        <option  <?=(in_array("-15.50", $arrMinspere)  ? 'selected' : '');?> value="-15.50">-15.50</option>
                                        <option  <?=(in_array("-15.75", $arrMinspere)  ? 'selected' : '');?> value="-15.75">-15.75</option>

                                        <option  <?=(in_array("-16.00", $arrMinspere)  ? 'selected' : '');?> value="-16.00">-16.00</option>
                                        <option  <?=(in_array("-16.25", $arrMinspere)  ? 'selected' : '');?> value="-16.25">-16.25</option>
                                        <option  <?=(in_array("-16.50", $arrMinspere)  ? 'selected' : '');?> value="-16.50">-16.50</option>
                                        <option  <?=(in_array("-16.75", $arrMinspere)  ? 'selected' : '');?> value="-16.75">-16.75</option>

                                        <option  <?=(in_array("-17.00", $arrMinspere)  ? 'selected' : '');?> value="-17.00">-17.00</option>
                                        <option  <?=(in_array("-17.25", $arrMinspere)  ? 'selected' : '');?> value="-17.25">-17.25</option>
                                        <option  <?=(in_array("-17.50", $arrMinspere)  ? 'selected' : '');?> value="-17.50">-17.50</option>
                                        <option  <?=(in_array("-17.75", $arrMinspere)  ? 'selected' : '');?> value="-17.75">-17.75</option>

                                        <option  <?=(in_array("-18.00", $arrMinspere)  ? 'selected' : '');?> value="-18.00">-18.00</option>
                                        <option  <?=(in_array("-18.25", $arrMinspere)  ? 'selected' : '');?> value="-18.25">-18.25</option>
                                        <option  <?=(in_array("-18.50", $arrMinspere)  ? 'selected' : '');?> value="-18.50">-18.50</option>
                                        <option  <?=(in_array("-18.75", $arrMinspere)  ? 'selected' : '');?> value="-18.75">-18.75</option>

                                        <option  <?=(in_array("-19.00", $arrMinspere)  ? 'selected' : '');?> value="-19.00">-19.00</option>
                                        <option  <?=(in_array("-19.25", $arrMinspere)  ? 'selected' : '');?> value="-19.25">-19.25</option>
                                        <option  <?=(in_array("-19.50", $arrMinspere)  ? 'selected' : '');?> value="-19.50">-19.50</option>
                                        <option  <?=(in_array("-19.75", $arrMinspere)  ? 'selected' : '');?> value="-19.75">-19.75</option>
                                        <option  <?=(in_array("-20.00", $arrMinspere)  ? 'selected' : '');?> value="-20.00">-20.00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "(" ?><i class="fa fa-plus"></i> <?php echo ")" ?> <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMaxspere = explode(',',$product->powermax);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="powermax[]" id="powermax">
                                        <option  <?=(in_array("0.00", $arrMaxspere)  ? 'selected' : '');?> value="0.00">0.00</option>
                                        <option  <?=(in_array("0.25", $arrMaxspere)  ? 'selected' : '');?> value="0.25">0.25</option>
                                        <option  <?=(in_array("0.50", $arrMaxspere)  ? 'selected' : '');?> value="0.50">0.50</option>
                                        <option  <?=(in_array("0.75", $arrMaxspere)  ? 'selected' : '');?> value="0.75">0.75</option>
                                        <option  <?=(in_array("1.00", $arrMaxspere)  ? 'selected' : '');?> value="1.00">1.00</option>
                                        <option  <?=(in_array("1.25", $arrMaxspere)  ? 'selected' : '');?> value="1.25">1.25</option>
                                        <option  <?=(in_array("1.50", $arrMaxspere)  ? 'selected' : '');?> value="1.50">1.50</option>
                                        <option  <?=(in_array("1.75", $arrMaxspere)  ? 'selected' : '');?> value="1.75">1.75</option>
                                        <option  <?=(in_array("2.00", $arrMaxspere)  ? 'selected' : '');?> value="2.00">2.00</option>
                                        <option  <?=(in_array("2.25", $arrMaxspere)  ? 'selected' : '');?> value="2.25">2.25</option>
                                        <option  <?=(in_array("2.50", $arrMaxspere)  ? 'selected' : '');?> value="2.50">2.50</option>
                                        <option  <?=(in_array("2.75", $arrMaxspere)  ? 'selected' : '');?> value="2.75">2.75</option>
                                        <option  <?=(in_array("3.00", $arrMaxspere)  ? 'selected' : '');?> value="3.00">3.00</option>
                                        <option  <?=(in_array("3.25", $arrMaxspere)  ? 'selected' : '');?> value="3.25">3.25</option>
                                        <option  <?=(in_array("3.50", $arrMaxspere)  ? 'selected' : '');?> value="3.50">3.50</option>
                                        <option  <?=(in_array("3.75", $arrMaxspere)  ? 'selected' : '');?> value="3.75">3.75</option>
                                        <option  <?=(in_array("4.00", $arrMaxspere)  ? 'selected' : '');?> value="4.00">4.00</option>
                                        <option  <?=(in_array("4.25", $arrMaxspere)  ? 'selected' : '');?> value="4.25">4.25</option>
                                        <option  <?=(in_array("4.50", $arrMaxspere)  ? 'selected' : '');?> value="4.50">4.50</option>
                                        <option  <?=(in_array("4.75", $arrMaxspere)  ? 'selected' : '');?> value="4.75">4.75</option>
                                        <option  <?=(in_array("5.00", $arrMaxspere)  ? 'selected' : '');?> value="5.00">5.00</option>
                                        <option  <?=(in_array("5.25", $arrMaxspere)  ? 'selected' : '');?> value="5.25">5.25</option>
                                        <option  <?=(in_array("5.50", $arrMaxspere)  ? 'selected' : '');?> value="5.50">5.50</option>
                                        <option  <?=(in_array("5.75", $arrMaxspere)  ? 'selected' : '');?> value="5.75">5.75</option>
                                        <option  <?=(in_array("6.00", $arrMaxspere)  ? 'selected' : '');?> value="6.00">6.00</option>
                                        <option  <?=(in_array("6.25", $arrMaxspere)  ? 'selected' : '');?> value="6.25">6.25</option>
                                        <option  <?=(in_array("6.50", $arrMaxspere)  ? 'selected' : '');?> value="6.50">6.50</option>
                                        <option  <?=(in_array("6.75", $arrMaxspere)  ? 'selected' : '');?> value="6.75">6.75</option>
                                        <option  <?=(in_array("7.00", $arrMaxspere)  ? 'selected' : '');?> value="7.00">7.00</option>
                                        <option  <?=(in_array("7.25", $arrMaxspere)  ? 'selected' : '');?> value="7.25">7.25</option>
                                        <option  <?=(in_array("7.50", $arrMaxspere)  ? 'selected' : '');?> value="7.50">7.50</option>
                                        <option  <?=(in_array("7.75", $arrMaxspere)  ? 'selected' : '');?> value="7.75">7.75</option>
                                        <option  <?=(in_array("8.00", $arrMaxspere)  ? 'selected' : '');?> value="8.00">8.00</option>
                                        <option  <?=(in_array("8.25", $arrMaxspere)  ? 'selected' : '');?> value="8.25">8.25</option>
                                        <option  <?=(in_array("8.50", $arrMaxspere)  ? 'selected' : '');?> value="8.50">8.50</option>
                                        <option  <?=(in_array("8.75", $arrMaxspere)  ? 'selected' : '');?> value="8.75">8.75</option>
                                        <option  <?=(in_array("9.00", $arrMaxspere)  ? 'selected' : '');?> value="9.00">9.00</option>
                                        <option  <?=(in_array("9.25", $arrMaxspere)  ? 'selected' : '');?> value="9.25">9.25</option>
                                        <option  <?=(in_array("9.50", $arrMaxspere)  ? 'selected' : '');?> value="9.50">9.50</option>
                                        <option  <?=(in_array("9.75", $arrMaxspere)  ? 'selected' : '');?> value="9.75">9.75</option>

                                        <option  <?=(in_array("10.00", $arrMaxspere)  ? 'selected' : '');?> value="10.00">10.00</option>
                                        <option  <?=(in_array("10.25", $arrMaxspere)  ? 'selected' : '');?> value="10.25">10.25</option>
                                        <option  <?=(in_array("10.50", $arrMaxspere)  ? 'selected' : '');?> value="10.50">10.50</option>
                                        <option  <?=(in_array("10.75", $arrMaxspere)  ? 'selected' : '');?> value="10.75">10.75</option>

                                        <option  <?=(in_array("11.00", $arrMaxspere)  ? 'selected' : '');?> value="11.00">11.00</option>
                                        <option  <?=(in_array("11.25", $arrMaxspere)  ? 'selected' : '');?> value="11.25">11.25</option>
                                        <option  <?=(in_array("11.50", $arrMaxspere)  ? 'selected' : '');?> value="11.50">11.50</option>
                                        <option  <?=(in_array("11.75", $arrMaxspere)  ? 'selected' : '');?> value="11.75">11.75</option>

                                        <option  <?=(in_array("12.00", $arrMaxspere)  ? 'selected' : '');?> value="12.00">12.00</option>
                                        <option  <?=(in_array("12.25", $arrMaxspere)  ? 'selected' : '');?> value="12.25">12.25</option>
                                        <option  <?=(in_array("12.50", $arrMaxspere)  ? 'selected' : '');?> value="12.50">12.50</option>
                                        <option  <?=(in_array("12.75", $arrMaxspere)  ? 'selected' : '');?> value="12.75">12.75</option>

                                        <option  <?=(in_array("13.00", $arrMaxspere)  ? 'selected' : '');?> value="13.00">13.00</option>
                                        <option  <?=(in_array("13.25", $arrMaxspere)  ? 'selected' : '');?> value="13.25">13.25</option>
                                        <option  <?=(in_array("13.50", $arrMaxspere)  ? 'selected' : '');?> value="13.50">13.50</option>
                                        <option  <?=(in_array("13.75", $arrMaxspere)  ? 'selected' : '');?> value="13.75">13.75</option>

                                        <option  <?=(in_array("14.00", $arrMaxspere)  ? 'selected' : '');?> value="14.00">14.00</option>
                                        <option  <?=(in_array("14.25", $arrMaxspere)  ? 'selected' : '');?> value="14.25">14.25</option>
                                        <option  <?=(in_array("14.50", $arrMaxspere)  ? 'selected' : '');?> value="14.50">14.50</option>
                                        <option  <?=(in_array("14.75", $arrMaxspere)  ? 'selected' : '');?> value="14.75">14.75</option>

                                        <option  <?=(in_array("15.00", $arrMaxspere)  ? 'selected' : '');?> value="15.00">15.00</option>
                                        <option  <?=(in_array("15.25", $arrMaxspere)  ? 'selected' : '');?> value="15.25">15.25</option>
                                        <option  <?=(in_array("15.50", $arrMaxspere)  ? 'selected' : '');?> value="15.50">15.50</option>
                                        <option  <?=(in_array("15.75", $arrMaxspere)  ? 'selected' : '');?> value="15.75">15.75</option>

                                        <option  <?=(in_array("16.00", $arrMaxspere)  ? 'selected' : '');?> value="16.00">16.00</option>
                                        <option  <?=(in_array("16.25", $arrMaxspere)  ? 'selected' : '');?> value="16.25">16.25</option>
                                        <option  <?=(in_array("16.50", $arrMaxspere)  ? 'selected' : '');?> value="16.50">16.50</option>
                                        <option  <?=(in_array("16.75", $arrMaxspere)  ? 'selected' : '');?> value="16.75">16.75</option>

                                        <option  <?=(in_array("17.00", $arrMaxspere)  ? 'selected' : '');?> value="17.00">17.00</option>
                                        <option  <?=(in_array("17.25", $arrMaxspere)  ? 'selected' : '');?> value="17.25">17.25</option>
                                        <option  <?=(in_array("17.50", $arrMaxspere)  ? 'selected' : '');?> value="17.50">17.50</option>
                                        <option  <?=(in_array("17.75", $arrMaxspere)  ? 'selected' : '');?> value="17.75">17.75</option>

                                        <option  <?=(in_array("18.00", $arrMaxspere)  ? 'selected' : '');?> value="18.00">18.00</option>
                                        <option  <?=(in_array("18.25", $arrMaxspere)  ? 'selected' : '');?> value="18.25">18.25</option>
                                        <option  <?=(in_array("18.50", $arrMaxspere)  ? 'selected' : '');?> value="18.50">18.50</option>
                                        <option  <?=(in_array("18.75", $arrMaxspere)  ? 'selected' : '');?> value="18.75">18.75</option>

                                        <option  <?=(in_array("19.00", $arrMaxspere)  ? 'selected' : '');?> value="19.00">19.00</option>
                                        <option  <?=(in_array("19.25", $arrMaxspere)  ? 'selected' : '');?> value="19.25">19.25</option>
                                        <option  <?=(in_array("19.50", $arrMaxspere)  ? 'selected' : '');?> value="19.50">19.50</option>
                                        <option  <?=(in_array("19.75", $arrMaxspere)  ? 'selected' : '');?> value="19.75">19.75</option>
                                        <option  <?=(in_array("20.00", $arrMaxspere)  ? 'selected' : '');?> value="20.00">20.00</option>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylinder = explode(',',$product->cylindernew);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="cylindernew[]" id="cylindernew" >
                                        @foreach($contact_lens_data as $data)
                                            <option  <?=(in_array($data->cylinder, $arrSpecialitycylinder)  ? 'selected' : '');?> value="{{$data->cylinder}}">{{$data->cylinder}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpeciality = explode(',',$product->axisnew);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="axisnew[]" id="axisnew" >
                                        @foreach($contact_lens_data as $data)
                                            <option <?=(in_array($data->axis, $arrSpeciality)  ? 'selected' : '');?> value="{{$data->axis}}">{{$data->axis}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging" >
                                        <?php $contactpakage = explode(',',$product->packaging); ?>
                                        @foreach($contactlens_packaging as $package)
                                            @if (in_array($package->name, $contactpakage))
                                                <option value="{{ $package->name }}" selected>{{$package->name}}</option>
                                            @else
                                                <option value="{{ $package->name }}">{{ $package->name }}</option>
                                            @endif
                                        @endforeach</select>
                                    </select>
                                </div>
                            </div>

                            @if($product->category[0] == 58 || $product->category[0] == 63 || $product->category[0] == 82)
                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Lens Color <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
                                        @foreach($lens_color as $color)
                                            <option value="{{$color->name}}" <?php if($color->name == $product->color){ echo "selected";} ?> >{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($product->category[0] == 72)
                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Contact Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrContactLensColor = explode(',',$product->lenscolor);
                                    ?>
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        @foreach($contact_lens_color as $color)
                                            @if (in_array($color->name, $arrContactLensColor))
                                                <option value="{{ $color->name }}" selected>{{ $color->name }}</option>
                                            @else
                                                <option value="{{$color->name}}">{{$color->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            
                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php 
                                        $arrlenstechnology = explode(',',$product->lenstechnology);
                                    ?>
                                    <select class="form-control" multiple="multiple" name="lenstechnology[]" id="lenstechnology" >
                                        @foreach($lenstechnology as $material)
                                            @if(in_array($material->name, $arrlenstechnology) || in_array($material->name, $arrlenstechnology))
                                                <option value="{{$material->name}}" selected>{{$material->name}}</option>
                                            @else
                                                <option value="{{$material->name}}">{{$material->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens Index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex" >
                                        @foreach($lens_index as $index)
                                            <option value="{{$index->name}}" <?php if($index->name == $product->lensindex){ echo "selected";} ?> >{{$index->name}}</option>
                                        @endforeach
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
                                        @foreach($lens_type as $type)
                                            <option value="{{$type->name}}" <?php if($type->name == $product->visioneffect){ echo "selected";} ?> >{{$type->name}}</option>
                                        @endforeach
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
                                        @foreach($lenscoating as $coating)
                                            @if(in_array($coating->name, $arrSpecialitycoating) || in_array($coating->name, $arrSpecialitycoating))
                                                <option value="{{$coating->name}}" selected>{{$coating->name}}</option>
                                            @else
                                                <option value="{{$coating->name}}">{{$coating->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <!--<input id="coating" value="{{$product->coating}}" class="form-control col-md-7 col-xs-12" name="coating" placeholder="Enter Coating" type="text">-->
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" name="productdimension" placeholder="Product Dimension"  type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" class="form-control col-md-7 col-xs-12" value="{{$product->weight}}" name="weight" placeholder="Product Weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageweightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packweight">Package Weight <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packweight" value="{{$product->packweight}}" class="form-control col-md-7 col-xs-12" name="packweight" placeholder="Package weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{$product->packwidth}}" class="form-control col-md-7 col-xs-12" name="packwidth" placeholder="Package width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packheight">Package Height <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packheight" value="{{$product->packheight}}" class="form-control col-md-7 col-xs-12" name="packheight" placeholder="Package Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packagelengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packlength">Package Length <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packlength" value="{{$product->packlength}}" class="form-control col-md-7 col-xs-12" name="packlength" placeholder="Package Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" value="{{$product->hsncode}}" placeholder="Hsn Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFile"> Current Featured Image <span style="color:red;">*</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Product Gallery Images <span style="color:red;">*</span>
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

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description <span style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="editor" class="form-control" rows="6">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <!--<div class="error">-->
                            <!--    @if ($errors->has('description'))-->
                            <!--        <span class="help-block">-->
                            <!--            <strong style="color: red;">{{ $errors->first('description') }}</strong>-->
                            <!--        </span>-->
                            <!--    @endif-->
                            <!--</div>-->

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="selling-price" class="form-control col-md-7 col-xs-12" name="price" value="{{$product->price}}" placeholder="e.g 20"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP <span style="color:red;">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pre_mrp" name="previous_price" value="{{$product->previous_price}}" placeholder="e.g 25"
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock <span style="color:red;">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_stock" name="stock" value="{{$product->stock}}" placeholder="e.g 15" pattern="[0-9]{1,10}" type="number">
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

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy <span style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="" class="form-control" rows="6">{{$product->policy}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags
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
                                                 Featured Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="featured" value="1" autocomplete="off">
                                                 Featured Product
                                            </label>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        @if($product->tranding == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="tranding" value="1" autocomplete="off" checked>
                                                Tranding Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="tranding" value="1" autocomplete="off">
                                                Tranding Product
                                            </label>
                                        @endif
                                    </div>

                                </div>
                            </div>

                         
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-6">
                                        @if($product->latest == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="latest" value="1" autocomplete="off" checked>
                                                 Latest Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="latest" value="1" autocomplete="off">
                                                 Latest Product
                                            </label>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        @if($product->selected == 1)
                                            <label class="btn btn-default active">
                                                <input type="checkbox" name="selected" value="1" autocomplete="off" checked>
                                               
                                                Selected Product
                                            </label>
                                        @else
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="selected" value="1" autocomplete="off">
                                                
                                                Selected Product
                                            </label>
                                        @endif
                                    </div>
                                </div>
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
                                                    <input type="text" class="form-control att_pro_sku" name="att_pro_sku[]" value="{{ $attr->attr_sku != '' ? $attr->attr_sku : '' }}" placeholder="Attr SKU No" / >
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
                                                    <input type="number" placeholder="CP" class="form-control attr_pro_price" name="attr_pro_price[]" value="{{ $attr->attr_price != '' ? $attr->attr_price : '' }}" placeholder="Attr Size Price" />
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
                                                    <input type="number" placeholder="CP" class="form-control attr_pro_price" name="attr_pro_price[]" placeholder="Attr CP Price" />
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
                                    <button id="add_ads" type="submit" class="btn btn-success btn-block" style="width:136px;">Update Product</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
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
    var product_id = $('#productsku').val();
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
                'url'  : "{{url('fetch_attr_color_list')}}",
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
        console.log(result);
        // $('#result').html( 'Event result:<br>'+result );
    } );

    function updateDataTable() {
        console.log('dfs');
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
    
    
    //kishori//
         $(document).on('click', '.edit_color', function(e){  
        var id = $(this).attr("data-id");
        var pro_id = $(this).attr("pro_id");
        //console.log(id);
        var colorName = $(e.target).parent().parent().find('#colorName').val();
        var attr_color_codes = $(e.target).parent().parent().find('#attr_color_codes').val();
     //console.log(attr_color_codes);
        if(confirm("Are you sure you want to update this?"))  
        {  

        let url = "{{url('update_attr_color_list')}}";
        $.ajax({  
                url:url,  
                method:"POST",  
                data:{id:id,colorName:colorName,attr_color_codes:attr_color_codes, '_token' : '{{ csrf_token() }}'}, 
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

    //kishori//

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
                    text: 'Fill Attribute CP !',
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

<script type="text/javascript">

   $(document).ready(function() {
      let main_cat = $('#maincats').val();
      if(main_cat == '58')
      {
        $('#spheres').show();
        $('#axisnlenss').show();
        $('#cylinderlenss').show();
        $('#addpowerlenss').hide();
      }else{
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();  
      }
        let lens_type = $('#visioneffect').val();
     
            if(lens_type == 'Single Vision')
            {
                $('#addpowerlenss').hide();
            }else if(lens_type == 'Zero Power'){
                $('#addpowerlenss').hide();
            }else if(lens_type == 'Biofocal'){
                $('#addpowerlenss').show();
            }else if(lens_type == 'Progressive'){
                $('#addpowerlenss').show();
            }
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
        $('#framecolornew').show();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#diameterlenss').hide();

    } else if(categoryname == "Contact Lenses") {

        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
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
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spherelens').hide();
        $('#axisnlens').hide();
        $('#cylinderlens').hide();

        var lensValue = $("#lenstype option")[0].value;
        
        if(lensValue == 'Single Vision'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
            $('#spherelens').hide();
            $('#axisnlens').hide();
            $('#cylinderlens').hide();
        }
        else if(lensValue == 'MultiFocal'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').show();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
            $('#spherelens').hide();
            $('#axisnlens').hide();
            $('#cylinderlens').hide();
        }
        else if(lensValue == 'toric and Astigmatism'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').show();
            $('#cylinderneww').show();
            $('#spherelens').hide();
            $('#axisnlens').hide();
            $('#cylinderlens').hide();
        }
        else if(lensValue == 'Plano'){
            $('#basecurvenew').show();
            $('#diameternew').show();
            $('#powernewmin').show();
            $('#powernewmax').show();
            $('#addpowernew').hide();
            $('#axisneww').hide();
            $('#cylinderneww').hide();
            $('#spherelens').hide();
            $('#axisnlens').hide();
            $('#cylinderlens').hide();
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
                $('#spherelens').hide();
                $('#axisnlens').hide();
                $('#cylinderlens').hide();
            }
            else if($('#lenstype').val() == 'MultiFocal'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').show();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
                $('#spherelens').hide();
                $('#axisnlens').hide();
                $('#cylinderlens').hide();
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
                $('#spherelens').hide();
                $('#axisnlens').hide();
                $('#cylinderlens').hide();
            }
            else if($('#lenstype').val() == 'Plano'){
                $('#basecurvenew').show();
                $('#diameternew').show();
                $('#powernewmin').show();
                $('#powernewmax').show();
                $('#addpowernew').hide();
                $('#axisneww').hide();
                $('#cylinderneww').hide();
                $('#spherelens').hide();
                $('#axisnlens').hide();
                $('#cylinderlens').hide();
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
        $('#framecolornew').show();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
    }else if(categoryname == "Lenses"){

        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
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
        $('#premiumtypenew').hide();
        // $('#addpowerlenss').show();
        $('#diameternew').hide();
        $('#diameterlenss').show();
        $('#visioneffect').on('change', function() {
            let lens_type = $('#visioneffect').val();
            if(lens_type == 'Single Vision')
            {
                $('#addpowerlenss').hide();
                // $('#diameterlenss').show();
            }else if(lens_type == 'Zero Power'){
                $('#addpowerlenss').hide();
                //  $('#diameterlenss').show();
            }else if(lens_type == 'Biofocal'){
                $('#addpowerlenss').show();
                //  $('#diameterlenss').show();
            }else if(lens_type == 'Progressive'){
                $('#addpowerlenss').show();
                //  $('#diameterlenss').show();
            }
        });  
        
    }else if(categoryname == "Accessories"){

        $('#frametypenew').hide();
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
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
        $('#productdimnew').show();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();
        $('#gendernew').hide();
        $('#premiumtypenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#productdimensionnew').show();
        $('#usagesnew').hide();

    }else if(categoryname == "Premium Brands"){

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
        $('#frametypenew').show();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#framestylenew').hide();
        $('#usagesdurationnew').hide();
        $('#diameterlenss').hide();
        $('#gendernew').show();
        $('#lenstechnologynew').show();
        $('#premiumtypenew').show();
        $('#addpowerlenss').hide();

    }
    else if(categoryname == 'Contact Lens Solutions'){
        $('#productskunew').show();
        $('#titlenew').show();
        $('#brandnamenew').show();
        $('#shelflifenew').show();
        $('#manufracturernew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#countryoforiginnew').show();
        $('#hsncodenew').show();
        $('#descriptionnew').show();
        $('#productcolornew').show();
        $('#netquntitynew').show();
        $('#warrentytypenew').show();
        $('#stocknew').show();
        $('#policynew').show();
        
        $('#centerthiknessneww').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
        $('#gendernew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#modelnonew').hide();
        $('#sellernamenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#framematerialnew').hide();
        $('#framewidthnew').hide();
        $('#usagesnew').hide();
        $('#usagesdurationnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#watercontentnew').hide();
        $('#diameternew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#addpowernew').hide();
        $('#axisneww').hide();
        $('#centerthiknessneww').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#gravitynew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#premiumtypenew').hide();
        $('#focallengthnew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#frametypenew').hide();
        $('#productdimensionnew').hide();
        $('#heightnew').hide();
        $('#colorcodenew').hide();
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
        $('#usagesnew').hide();
        $('#productcolornew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#catetwonew').show();
        $('#shapenew').show();
        $('#framecolornew').show();
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

 }else if(categoryname == "Contact Lenses") {
        $("#sizeCheck").attr('disabled', true);
        $("#sizeAttr").attr('disabled', true);
        $('#catetwonew').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
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
        $('#spherelens').hide();
        $('#axisnlens').hide();
        $('#cylinderlens').hide();
    }else if(categoryname == "Sunglasses"){
         $("#sizeCheck").attr('disabled', false);
         $('#catetwonew').show();
         $('#shapenew').show();
         $('#framecolornew').show();
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
         $('#framecolornew').show();
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
        $('#framecolornew').hide();
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
        $('#framecolornew').hide();
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
        $('#productcolornew').show();
        $('#productdimnew').show();
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

         $('#premiumtypenew').show();
         $('#catetwonew').show();
         $('#shapenew').show();
         $('#framecolornew').show();
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
    else if(categoryname == 'Contact Lens Solutation'){
        $('#productskunew').show();
        $('#titlenew').show();
        $('#brandnamenew').show();
        $('#shelflifenew').show();
        $('#manufracturernew').show();
        $('#weightnew').show();
        $('#packageweightnew').show();
        $('#packagewidthnew').show();
        $('#packageheightnew').show();
        $('#packagelengthnew').show();
        $('#countryoforiginnew').show();
        $('#hsncodenew').show();
        $('#descriptionnew').show();
        $('#productcolornew').show();
        $('#netquntitynew').show();
        $('#warrentytypenew').show();
        $('#stocknew').show();
        $('#policynew').show();
        
        $('#centerthiknessneww').hide();
        $('#shapenew').hide();
        $('#framecolornew').hide();
        $('#gendernew').hide();
        $('#lenstypenew').hide();
        $('#visioneffectnew').hide();
        $('#modelnonew').hide();
        $('#sellernamenew').hide();
        $('#addpowerlenss').hide();
        $('#diameterlenss').hide();
        $('#spheres').hide();
        $('#axisnlenss').hide();
        $('#cylinderlenss').hide();
        $('#framematerialnew').hide();
        $('#framewidthnew').hide();
        $('#usagesnew').hide();
        $('#usagesdurationnew').hide();
        $('#templematerialnew').hide();
        $('#templecolornew').hide();
        $('#lensmaterialtypenew').hide();
        $('#leanscoatingnew').hide();
        $('#contactlensmaterialtypenew').hide();
        $('#watercontentnew').hide();
        $('#diameternew').hide();
        $('#basecurvenew').hide();
        $('#powernewmin').hide();
        $('#powernewmax').hide();
        $('#cylinderneww').hide();
        $('#addpowernew').hide();
        $('#axisneww').hide();
        $('#centerthiknessneww').hide();
        $('#disposabilitynew').hide();
        $('#packagingnew').hide();
        $('#lenscolornew').hide();
        $('#contactlenscolornew').hide();
        $('#lenstechnologynew').hide();
        $('#lensindexnew').hide();
        $('#gravitynew').hide();
        $('#coatingnew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#premiumtypenew').hide();
        $('#focallengthnew').hide();
        $('#productdimnew').hide();
        $('#materialnew').hide();
        $('#frametypenew').hide();
        $('#productdimensionnew').hide();
        $('#heightnew').hide();
        $('#colorcodenew').hide();
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
    // placeholder: "Select Coating ",
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
  $('#addpowerlens').select2({
    width: '100%',
    placeholder: "Select Add Power",
    allowClear: true
  });
   $('#diameterlens').select2({
    width: '100%',
    placeholder: "Select Add Power",
    allowClear: true
  });
</script>

 <script>
  $('#axisnlens').select2({
    width: '100%',
    placeholder: "Select Axis",
    allowClear: true
  });
</script>

 <script>
  $('#spherelens').select2({
    width: '100%',
    placeholder: "Select Sphere",
    allowClear: true
  });
</script>

 <script>
    $('#cylinderlens').select2({
        width: '100%',
        placeholder: "Select Cylinder",
        allowClear: true
    });
    $('#lenscolor').select2({
        width: '100%',
        placeholder: "Select Contact Lens color",
        allowClear: true,
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
                    "subid" : $(this).val()
            },
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
    <!-- Here start to ajax to pass data into controller -->
<script>
    $("#productFormSubmit").on("submit", function(e){
        e.preventDefault();
        let formData = new FormData(this);
        if(validate()){
            $.ajax({
                method: 'POST',
                url: "{{url('admin/products/update/')}}",
                data: formData,
                processData: false, // Preventing default data parse behavior
                contentType: false, //Preventing content type data eg:- application/json
                beforeSend: function(){
                    $("#loader").show();
                    productFormSubmit.classList.add("load");
                    $("#page-wrapper").hide();
                },
                complete: function(){
                    $("#loader").hide();
                    productFormSubmit.classList.remove("load");
                    $("#page-wrapper").show();
                },
                dataType: 'JSON',
                success: function(resp){
                    if(resp.status == "success"){
        		        Swal.fire({
                            title: 'Message!',
                            text: resp.message,
                            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "{{url('admin/products/')}}";
                            }
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status == 422)
                    {
                        let text = xhr.responseText
                        const value = text.split('"');
                        Swal.fire({
                            title: 'Message!',
                            text: value[3],
                            imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                return false;
                            }
                        });
                    }
                }
            });  
        }

    });
	const validate = ()=>{
		if($('#productsku').val() == ''){
		    Swal.fire({
                    title: 'Message!',
                    text: 'Please Enter Product Sku',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#productsku').focus();
		    return false
		}
		
		if($('#name').val() == ''){
		    Swal.fire({
                title: 'Message!',
                text: 'Please Enter Product Name',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#name').focus();
		    return false
		}
		
		if($('#maincats').val() == ''){
		   
		    Swal.fire({
                title: 'Message!',
                text: 'Please Select Main Category',
                imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
            $('#maincats').focus();
		    return false
		}
		
		if($('#maincats').val() != ''){
		    //frame
		    if($('#maincats').val() == 53)
		    { 
		        if(frameValidation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		    //sunglass
		    if($('#maincats').val() == 63)
		    {  
		        if(SunglassValidation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		    //Contact Lens
		    if($('#maincats').val() == 72)
		    {  
		        if(ContaclensValidation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		  //  Premium Brands
		    if($('#maincats').val() == 82)
		    {  
		        if(premiumbrandsValidation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		  //  lenses
		    if($('#maincats').val() == 58)
		    {  
		        if(lensesValidation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		  // lenses solution
		  
		   if($('#maincats').val() == 87)
		    {  
		        if(lenses_solution_Validation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		    
		  // Accessories
		  
		   if($('#maincats').val() == 445)
		    {  
		        if(accessories_Validation())
		        {
		            return true;
		        }else{
		            return false;
		        }
		    }
		    
		}
	}
	
	function lenses_solution_Validation()
	{
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	     return true;
	}
	
	function accessories_Validation()
	{
	    if($('#subs').val().length == 0)
	    {
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	     return true;
	}
	
	
	
    function lensesValidation()
	{
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	    if($('#childs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One ChildCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#childs').focus();
	        return false;
	    }
	    if($('#pre_mrp').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill MRP Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pre_mrp').focus();
	        return false;
	    }
	     return true;
	}
	
	function frameValidation()
	{
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	    if($('#childs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One ChildCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#childs').focus();
	        return false;
	    }
	    if($('#shape').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Shape',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#shape').focus();
	        return false;
	    }
	    if($('#color').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Color',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#color').focus();
	        return false;
	    }
	    if($('#gender').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Gender',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#gender').focus();
	        return false;
	    }
	    if($('#brandname').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Brand Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#brandname').focus();
	        return false;
	    }
	    if($('#modelno').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Model No',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#modelno').focus();
	        return false;
	    }
	    if($('#sellername').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Seller Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#sellername').focus();
	        return false;
	    }
	    if($('#framematerial').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Material',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#framematerial').focus();
	        return false;
	    }
	    if($('#frametype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Type',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#frametype').focus();
	        return false;
	    }
	    if($('#manufracturer').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Manufracturer Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#manufracturer').focus();
	        return false;
	    }
	    if($('#productdimension').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Frame Dimension Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#productdimension').focus();
	        return false;
	    }
	    if($('#weight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#weight').focus();
	        return false;
	    }
	    if($('#packweight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packweight').focus();
	        return false;
	    }
	    if($('#packwidth').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Width Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packwidth').focus();
	        return false;
	    }
	    if($('#packheight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Height Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packheight').focus();
	        return false;
	    }
	    if($('#packlength').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Length Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#countryoforigin').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Country Of Origin Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#hsncode').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Hsn Code Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#hsncode').focus();
	        return false;
	    }
	    if($('#pre_mrp').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill MRP Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pre_mrp').focus();
	        return false;
	    }
	    if($('#pro_costprice').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Cost Price Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_costprice').focus();
	        return false;
	    }
	    if($('#pro_stock').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Stock Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_stock').focus();
	        return false;
	    }
	    if($('textarea#policy').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Buy/Return Policy Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('textarea#policy').focus();
	        return false;
	    }
	    return true;
	}
	
	function SunglassValidation()
	{
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	    if($('#childs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One ChildCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#childs').focus();
	        return false;
	    }
	    if($('#shape').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Shape',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#shape').focus();
	        return false;
	    }
	    if($('#color').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Color',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#color').focus();
	        return false;
	    }
	    if($('#gender').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Gender',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#gender').focus();
	        return false;
	    }
	    if($('#brandname').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Brand Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#brandname').focus();
	        return false;
	    }
	    if($('#modelno').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Model No Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#modelno').focus();
	        return false;
	    }
	    if($('#lensmaterialtype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Lens Material Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lensmaterialtype').focus();
	        return false;
	    }
	    if($('#lenscolor').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Lens Color Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lenscolor').focus();
	        return false;
	    }
	    if($('#sellername').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Seller Name Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#sellername').focus();
	        return false;
	    }
	    if($('#framematerial').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Material',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#framematerial').focus();
	        return false;
	    }
	    if($('#frametype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Type',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#frametype').focus();
	        return false;
	    }
	    if($('#manufracturer').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Manufracturer Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#manufracturer').focus();
	        return false;
	    }
	    if($('#productdimension').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Frame Dimension Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#productdimension').focus();
	        return false;
	    }
	    if($('#weight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#weight').focus();
	        return false;
	    }
	    if($('#packeageweight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packeageweight').focus();
	        return false;
	    }
	    if($('#packwidth').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Width Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packwidth').focus();
	        return false;
	    }
	    if($('#packheight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Height Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packheight').focus();
	        return false;
	    }
	    if($('#packlength').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Length Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#countryoforigin').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Country Of Origin Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#countryoforigin').focus();
	        return false;
	    }
	    if($('#hsncode').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Hsn Code Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#hsncode').focus();
	        return false;
	    }
	    if($('#pre_mrp').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill MRP Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pre_mrp').focus();
	        return false;
	    }
	    if($('#pro_costprice').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Cost Price Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_costprice').focus();
	        return false;
	    }
	    if($('#pro_stock').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Stock Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_stock').focus();
	        return false;
	    }
	    if($('textarea#policy').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Buy/Return Policy Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('textarea#policy').focus();
	        return false;
	    }
	    return true;
	}
	
	function ContaclensValidation()
	{
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	    if($('#childs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One ChildCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#childs').focus();
	        return false;
	    }
	    if($('#brandname').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Brand Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#brandname').focus();
	        return false;
	    }
	    if($('#lenstype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Contact Lens Type',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lenstype').focus();
	        return false;
	    }else if($('#lenstype').val() == 'Single Vision'){
	        
	        if($('#diameter').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Diameter',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#diameter').focus();
    	        return false;
    	    }
    	    if($('#basecurve').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Basecurve',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#basecurve').focus();
    	        return false;
    	    }
    	    if($('#powermin').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (-)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermin').focus();
    	        return false;
    	    }
    	    if($('#powermax').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (+)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermax').focus();
    	        return false;
    	    }
	    }  // herer condition 
	    else if($('#lenstype').val() == 'MultiFocal'){
	        
	        if($('#diameter').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Diameter',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#diameter').focus();
    	        return false;
    	    }
    	    if($('#basecurve').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Basecurve',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#basecurve').focus();
    	        return false;
    	    }
    	    if($('#powermin').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (-)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermin').focus();
    	        return false;
    	    }
    	    if($('#powermax').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (+)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermax').focus();
    	        return false;
    	    }
    	    if($('#addpower').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Add Power',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#addpower').focus();
    	        return false;
    	    }
	    }else if($('#lenstype').val() == 'toric and Astigmatism'){
	        
	        if($('#diameter').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Diameter',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#diameter').focus();
    	        return false;
    	    }
    	    if($('#basecurve').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Basecurve',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#basecurve').focus();
    	        return false;
    	    }
    	    if($('#powermin').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (-)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermin').focus();
    	        return false;
    	    }
    	    if($('#powermax').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (+)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermax').focus();
    	        return false;
    	    }
    	    if($('#cylindernew').val() == '')
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Cylinder Lens Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#cylindernew').focus();
    	        return false;
    	    }
    	    if($('#axisnew').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Axis',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#axisnew').focus();
    	        return false;
    	    }
	    }else if($('#lenstype').val() == 'Single Vision'){
	        
	        if($('#diameter').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Diameter',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#diameter').focus();
    	        return false;
    	    }
    	    if($('#basecurve').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Basecurve',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#basecurve').focus();
    	        return false;
    	    }
    	    if($('#powermin').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (-)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermin').focus();
    	        return false;
    	    }
    	    if($('#powermax').val().length == 0)
    	    {
    	       
    	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One Sphere Power (+)',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
                $('#powermax').focus();
    	        return false;
    	    }
	    }  
	    if($('#modelno').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Model No Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#modelno').focus();
	        return false;
	    }
	    if($('#sellername').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Seller Name Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#sellername').focus();
	        return false;
	    }
	    if($('#lenscolor').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Lens Color Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lenscolor').focus();
	        return false;
	    }
	    if($('#manufracturer').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Manufracturer Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#manufracturer').focus();
	        return false;
	    }
	    if($('#weight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#weight').focus();
	        return false;
	    }
	    if($('#packeageweight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packeageweight').focus();
	        return false;
	    }
	    if($('#packwidth').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Width Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packwidth').focus();
	        return false;
	    }
	    if($('#packheight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Height Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packheight').focus();
	        return false;
	    }
	    if($('#packlength').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Length Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#countryoforigin').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Country Of Origin Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#hsncode').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Hsn Code Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#hsncode').focus();
	        return false;
	    }
	   // if($('#uploadFile').val() == '')
	   // {
	   //     alert("Please Fill Current Featured Image Filed");
	 // $('#uploadFile').focus();     
      
	   //     return false;
	   // }
	   // if($('#file-ip-1').val() == '')
	   // {
	   //     alert("Please Fill Product Gallery Images Filed(At Least One)");
	   //$('#file-ip-1').focus();     
       
	   //     return false;
	   // }
	   // if($('textarea#description').val() == '')
	   // {
	   //     alert("Please Fill Product Descriptio Filed");
	   //$('textarea#description').focus();     
       
	   //     return false;
	   // }
	    if($('#pre_mrp').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill MRP Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pre_mrp').focus();
	        return false;
	    }
	    if($('#pro_costprice').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Cost Price Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_costprice').focus();
	        return false;
	    }
	    if($('#pro_stock').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Stock Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_stock').focus();
	        return false;
	    }
	    if($('textarea#policy').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Buy/Return Policy Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('textarea#policy').focus();
	        return false;
	    }
	    
	    if($('#packaging').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packaging Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packaging').focus();
	        return false;
	    }
	    return true;
	}
	
	function premiumbrandsValidation()
	{
	    if($('#premiumtype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Premium Type Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#premiumtype').focus();
	        return false;
	    }
	    if($('#subs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One SubCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#subs').focus();
	        return false;
	    }
	    if($('#childs').val().length == 0)
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select At Least One ChildCategory',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#childs').focus();
	        return false;
	    }
	    if($('#shape').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Frame Shape Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#shape').focus();
	        return false;
	    }
	    if($('#color').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Frame Color Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#color').focus();
	        return false;
	    }
	    if($('#gender').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Gender',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#gender').focus();
	        return false;
	    }
	    if($('#brandname').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Brand Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#brandname').focus();
	        return false;
	    }
	    if($('#modelno').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Model No',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#modelno').focus();
	        return false;
	    }
	    if($('#sellername').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Seller Name',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#sellername').focus();
	        return false;
	    }
	    if($('#framematerial').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Material',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#framematerial').focus();
	        return false;
	    }
	    if($('#lensmaterialtype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Lens Material Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lensmaterialtype').focus();
	        return false;
	    }
	    if($('#lenscolor').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Lens Color Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#lenscolor').focus();
	        return false;
	    }
	    if($('#frametype').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Select Frame Type',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#frametype').focus();
	        return false;
	    }
	    if($('#manufracturer').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Manufracturer Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#manufracturer').focus();
	        return false;
	    }
	    if($('#productdimension').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Frame Dimension Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#productdimension').focus();
	        return false;
	    }
	    if($('#weight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#weight').focus();
	        return false;
	    }
	   // if($('#frameheight').val() == '')
	   // {
	   //     alert("Please Fill Frame Height Filed");
	   //$('#frameheight').focus();     
       
	   //     return false;
	   // }
	    if($('#packeageweight').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Weight Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packeageweight').focus();
	        return false;
	    }
	    if($('#packwidth').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Width Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packwidth').focus();
	        return false;
	    }
	    if($('#height').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Height Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#height').focus();
	        return false;
	    }
	    if($('#packlength').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Packeage Length Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#packlength').focus();
	        return false;
	    }
	    if($('#countryoforigin').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Country Of Origin Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#countryoforigin').focus();
	        return false;
	    }
	    if($('#hsncode').val() == '')
	    {
	       
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Hsn Code Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#hsncode').focus();
	        return false;
	    }
	   // if($('#uploadFile').val() == '')
	   // {
	   //     alert("Please Fill Current Featured Image Filed");
	  //$('#uploadFile').focus();     
       
	   //     return false;
	   // }
	   // if($('#file-ip-1').val() == '')
	   // {
	   //     alert("Please Fill Product Gallery Images Filed(At Least One)");
	   //$('#file-ip-1').focus();     
       
	   //     return false;
	   //// }
	   // if($('textarea#description').val() == '')
	   // {
	   //     alert("Please Fill Product Descriptio Filed");
	   //      $('textarea#description').focus();
      
	   //     return false;
	   // }
	    if($('#pre_mrp').val() == '')
	    {
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill MRP Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pre_mrp').focus();
	        return false;
	    }
	    if($('#pro_costprice').val() == '')
	    {
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Cost Price Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_costprice').focus();
	        return false;
	    }
	    if($('#pro_stock').val() == '')
	    {
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Stock Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('#pro_stock').focus();
	        return false;
	    }
	    if($('textarea#policy').val() == '')
	    {
	        Swal.fire({
                    title: 'Message!',
                    text: 'Please Fill Product Buy/Return Policy Filed',
                    imageUrl: 'https://ci3.googleusercontent.com/proxy/eR2Wo8Rz--CKyxFOPCz0Jq3g-IxKwTSD3G9GJxyNO_2KkmBWqxDKfB8n8vfhhcB3AX0AUHmwGu3YjJy_PVL39aGY2_3l-0-OnUz5V6UA=s0-d-e1-ft#http://eyevam.in/userfiles/company/16202938661299798774.png',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            $('textarea#policy').focus();
	        return false;
	    }
	    return true;
	}
</script>

@stop