@extends('admin.includes.master-admin')
<link href="{{ URL::asset('assets/css/admin/adminVendorProductAdd.css') }}" rel="stylesheet"/>
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
                    <h3>Update Vendor Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <form id="productFormSubmit"  class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name='id' id="id" value="{{$product->id}}" />
                            <input type="hidden" id="vendorid" value="{{ $product->vendorid }}"  name="vendorid" />
                            <input type="hidden" id="owner" value="{{ $product->owner }}"  name="owner" />
                            <div class="item form-group" id="vendor_name_id">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Vendor Name <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="vendor_name" value="{{ $vendor_shop_name[0]->shop_name }}" class="form-control col-md-7 col-xs-12" name="vendor_name" placeholder="Vendor Shop Name" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name <span style="color:red;">*</span><p class="small-label">(In Any Language)</p></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" value="{{$product->title}}" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="maincats" name="mainid" class="form-control col-md-7 col-xs-12"  placeholder=" Enter Product Sku" type="text" > 
                                        @foreach($maincategory as $maind)
                                            <option selected value="{{$maind->id}}">{{$maind->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="subid[]" id="subs" >
                                        <option value="">select sub category</option>
                                        <?php 
                                            foreach($subs as $sub=>$key){
                                                if(in_array($key->id,$demo_new)){
                                                    echo "<option selected value=". $key->id. ">".$key->name."</option>";
                                                }else{
                                                    echo "<option value=". $key->id. ">".$key->name."</option>";
                                                };
                                            };
                                        ?>
                                    </select>
                                </div>
                            </div>

                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category <span style="color:red;">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="childid[]" id="childs">
                                        <option value="">Select Child Category</option>
                                        <?php foreach($child as $child => $key) {
                                            if(in_array($key->id, $dd)) {
                                                echo "<option value=".$key->id." selected>".$key->name."</option>";
                                            } else {
                                                echo "<option value=".$key->id.">".$key->name."</option>";
                                            }
                                        } ?>
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
                            
                            <div class="item form-group" id="colorcodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colorcode">Color Code <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="colorcode" value="{{old('colorcode')}}" class="form-control col-md-7 col-xs-12" name="colorcode" placeholder="Color Code" type="text">
                                </div>
                            </div>
                            <hr>
                            <!-- Start new input fields added as per category  -->

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

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="modelno" id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" placeholder="Enter Model No" type="text">
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

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Contact Lens Type <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                        <option selected value="{{$product->lenstype}}">{{$product->lenstype}}</option>
                                        <option value="Spherical" {{ old('lenstype') == "Spherical" ? 'selected' : '' }}>Single Vision</option>
                                        <option value="MultiFocal" {{ old('lenstype') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>
                                        <option value="toric & Astigmatism" {{ old('lenstype') == "toric & Astigmatism" ? 'selected' : '' }}>toric & Astigmatism</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="shapenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape <span style="color:red;">*</span></label>
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
                                        <option value="Butterfly">Butterfly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="framecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framecolor">Frame Color <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framecolor" id="framecolor" >
                                        <option value="{{$product->framecolor}}">{{$product->framecolor}}</option>
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
                                        <option value="HVN">HVN</option>
                                        <option value="Print">Print</option>
                                        <option value="Carving">Carving</option>
                                    </select>
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

                            <div class="item form-group" id="addpowerlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="addpowerlens[]" id="addpowerlens">
                                        <?php $addpowerlensData = explode(',', $product->addpowerlens);?>
                                        @foreach($lenses_data as $lens)
                                            @if(in_array($lens->add_power,$addpowerlensData))
                                                <option selected value="{{ $lens->add_power }}">
                                            @else
                                                <option value="{{ $lens->add_power }}">
                                            @endif
                                            {{ $lens->add_power }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $addpowernewData = explode(',', $product->addpower); ?>
                                    <select class="form-control" multiple="multiple" name="addpower[]" id="addpower">
                                        <option  <?=(in_array("0.75", $addpowernewData)  ? 'selected' : '');?> value="0.75">0.75</option>
                                        <option  <?=(in_array("1", $addpowernewData)  ? 'selected' : '');?> value="1">1</option>
                                        <option  <?=(in_array("1.25", $addpowernewData)  ? 'selected' : '');?> value="1.25">1.25</option>
                                        <option  <?=(in_array("1.5", $addpowernewData)  ? 'selected' : '');?> value="1.5">1.5</option>
                                        <option  <?=(in_array("1.75", $addpowernewData)  ? 'selected' : '');?> value="1.75">1.75</option>
                                        <option  <?=(in_array("2", $addpowernewData)  ? 'selected' : '');?> value="2">2</option>
                                        <option  <?=(in_array("2.25", $addpowernewData)  ? 'selected' : '');?> value="2.25">2.25</option>
                                        <option  <?=(in_array("2.75", $addpowernewData)  ? 'selected' : '');?> value="2.75">2.75</option>
                                        <option  <?=(in_array("3", $addpowernewData)  ? 'selected' : '');?> value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="diameterlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameterlens">Lens DIA</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="diameterlens[]" id="diameterlens">
                                        <?php $diameterlenssData = explode(',', $product->diameterlens); ?>
                                        @foreach($lenses_data as $lens)
                                            @if(in_array($lens->diameter, $diameterlenssData))
                                                <option selected value="{{$lens->diameter}}">
                                            @else
                                                <option value="{{$lens->diameter}}">
                                            @endif
                                            {{$lens->diameter}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="spheres">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">sphere <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="sphere[]" id="spherelens">
                                        <?php $sphereData = array_filter(explode(',', $product->sphere)); ?>
                                        @foreach($lenses_data as $sph)
                                            @if(in_array($sph->sphere, $sphereData))
                                                <option selected value="{{$sph->sphere}}">
                                            @else
                                                <option value="{{$sph->sphere}}">
                                            @endif
                                            {{$sph->sphere}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="axisnlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="axisnlens[]" id="axisnlens" >
                                        <?php $axisnlensData = array_filter(explode(',',$product->axisnlens)); ?>
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->axis, $axisnlensData))
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
                                    <?php $cylinderData = array_filter(explode(',',$product->cylinderlens));?>
                                    <select class="form-control" multiple="multiple" name="cylinderlens[]" id="cylinderlens" >
                                        @foreach($lenses_data as $value)
                                            @if (in_array($value->cylinder, $cylinderData))
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
                                        
                                    </select>
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

                            <div class="item form-group" id="productdimensionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" name="productdimension" placeholder="Frame Dimension"  type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="productdimensionAccessories">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Product Dimension <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimensiondata" class="form-control col-md-7 col-xs-12" value="" name="productdimension" placeholder="Product Dimension"  type="text">
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
                                        @foreach($lens_material as $mat)
                                            <option value="{{$mat->name}}">{{$mat->name}}</option>
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
                                    <?php $arrdiam = array_filter(explode(',',$product->diameter)); ?>
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
                                    <?php $arrBCcurve = array_filter(explode(',',$product->basecurve));?>
                                    <select class="form-control" multiple="multiple" name="basecurve[]" id="basecurve">
                                        @foreach($contact_lens as $clens)
                                            @if(in_array($clens->base_curv, $arrBCcurve))
                                                <option selected value="{{$clens->base_curv}}">{{$clens->base_curv}}</option>
                                            @else
                                                <option value="{{$clens->base_curv}}">{{$clens->base_curv}}</option>
                                            @endif
                                        @endforeach
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
                                    <?php $powerminData = array_filter(explode(',', $product->powermin)) ?>
                                    <select class="form-control" multiple="multiple" name="powermin[]" id="powermin">
                                        @foreach($contact_lens as $pMin)
                                            @if(in_array($pMin->minus_sphere, $powerminData))
                                                <option selected value="{{ $pMin->minus_sphere }}">{{ $pMin->minus_sphere }}</option>
                                            @else
                                                <option value="{{ $pMin->minus_sphere }}">{{ $pMin->minus_sphere }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "(" ?><i class="fa fa-plus"></i> <?php echo ")" ?> <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $powermaxData = array_filter(explode(',', $product->powermin)) ?>
                                    <select class="form-control" multiple="multiple" name="powermax[]" id="powermax">
                                        @foreach($contact_lens as $pMax)
                                            @if(in_array($pMax->minus_sphere, $powermaxData))
                                                <option selected value="{{ $pMax->minus_sphere }}">{{ $pMax->plus_sphere }}</option>
                                            @else
                                                <option value="{{ $pMax->minus_sphere }}">{{ $pMax->plus_sphere }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="centerthikness">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" value="{{$product->centerthiknessnew}}" class="form-control col-md-7 col-xs-12" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="cylinderneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $cylindernewData = array_filter(explode(',', $product->cylindernew)); ?>
                                    <select class="form-control" multiple="multiple" name="cylindernew[]" id="cylindernew" >
                                        @foreach($contact_lens as $contactCyl)
                                            @if(in_array($contactCyl->minus_sphere, $cylindernewData))
                                                <option selected value="{{ $contactCyl->cylinder }}">{{ $contactCyl->cylinder }}</option>
                                            @else
                                                <option value="{{ $contactCyl->cylinder }}">{{ $contactCyl->cylinder }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $axisnewData = array_filter(explode(',', $product->axisnew)); ?>
                                    <select class="form-control" multiple="multiple" name="axisnew[]" id="axisnew" >
                                        @foreach($contact_lens as $conAxis)
                                            @if(in_array($conAxis->minus_sphere, $axisnewData))
                                                <option selected value="{{ $conAxis->axis }}">{{ $conAxis->axis }}</option>
                                            @else
                                                <option value="{{ $conAxis->axis }}">{{ $conAxis->axis }}</option>
                                            @endif
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Lens Color <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="color" >
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
                                        <option value="Burgandi">Burgandi</option>
                                        <option value="Clear">Clear</option>
                                        <option value="PFX Pioneer">PFX Pioneer</option>
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
                                        <option value="Burgandi">Burgandi</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            
                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $arrlenstechnology = explode(',',$product->lenstechnology); ?>
                                    <select class="form-control" multiple="multiple" name="lenstechnology[]" id="lenstechnology" >
                                        @foreach($lenstechnology as $material)
                                            @if(in_array($material->name, $arrlenstechnology) || in_array($material->name, $arrlenstechnology))
                                                <option selected value="{{$material->name}}" >{{$material->name}}</option>
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

                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coating">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $arrSpecialitycoating = explode(',',$product->coating); ?>
                                    <select class="form-control" multiple="multiple" name="coating[]" id="coating" >
                                        @foreach($lenscoating as $coating)
                                            @if(in_array($coating->name, $arrSpecialitycoating) || in_array($coating->name, $arrSpecialitycoating))
                                                <option value="{{$coating->name}}" selected>{{$coating->name}}</option>
                                            @else
                                                <option value="{{$coating->name}}">{{$coating->name}}</option>
                                            @endif
                                        @endforeach
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


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description <span style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="editor" class="form-control" rows="6">{{$product->description}}</textarea>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price
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
                                    <label><span class="required"><input type="checkbox" id="available_pro_color">&nbsp; Allow Product Color</span></label>
                                </div>
                                <div class="col-lg-12" id="product_color_div" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group color_image" id="row-box">
                                                <div id="product_attr">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="attr_color" class="form-control"  id="attr_color" placeholder="Please Enter Color Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="attr_color_code" class="form-control"  id="attr_color_code" placeholder="Please Enter Color Code" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input name="color_file[]" id="color_file" type="file" placeholder="Please Select Image" multiple class="form-control" aria-required="true" aria-invalid="false" value="" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="hidden" id="main_product_sku" value="<?php echo $product->productsku; ?>" >
                                                           <button type="button" class="btn btn-success " id="product_color_attr" value="Add">Add</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="color_table" class="table table-striped table-hover table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Color Name</th>          
                                                                <th class="text-center">Color Code</th>
                                                                <th class="text-center">Image</th>
                                                                <th class="text-center">Action</th>
                                                                <th hidden ></th>
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
                                <div> <label><span class="required"><input type="checkbox" id="available_pro_whole">&nbsp; Available Product whole sell</span></label> </div>
                                <div id="product_whole_div" style="margin:-2px; display:none; border: 1px solid #ebe1e1; margin-bottom: 10px; padding: 25px;">
                                    <table class="table table-striped table-bordered text-center" style="width: 100%;" id="test_Tables">
                                        <tr>
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

                                <div><label><span class="required"><input type="checkbox" id="manage_pro_attr">&nbsp; Manage Product Attribute</span></label></div>
                                <div id="manage_pro_attr_div" style="margin:-2px; display:none; margin-bottom: 10px; ">
                                    <table id="manage_attr_table" style="width: 100%;">
                                        <tbody>
                                            <div id="product_attr_data"></div>
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
                                                <td class="col-md-1"><button type="button" class="btn btn-default" style="padding: 0.5rem 0.75rem !important;"><i class="fa fa-plus" onclick="replicateManageTable('manage_attr_table')" ></i></button></td>
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

<script src="{{ URL::asset('assets/js/admin/adminVendorProductEdit.js') }}"></script>
@stop