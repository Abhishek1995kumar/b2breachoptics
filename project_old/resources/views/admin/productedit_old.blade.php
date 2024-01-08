@extends('admin.includes.master-admin')
<style type="text/css">
    .error{
        padding-left: 310px;
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Shape </label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Color </label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control" multiple="multiple" name="gender[]" id="gender">
                                        <option value="MEN" @if(in_array('MEN', $gender_new)) selected @endif>MEN</option>
                                        <option value="WOMEN" @if(in_array('WOMEN', $gender_new)) selected @endif>WOMEN</option>
                                        <option value="KIDS" @if(in_array('KIDS', $gender_new)) selected @endif>KIDS</option>
                                        <option value="Unisex" @if(in_array('Unisex', $gender_new)) selected @endif>Unisex</option>
                                    </select>
                                </div>
                            </div>


                            <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname" >
                                        <option value="{{$product->brandname}}">{{$product->brandname}}</option>
                                        <option value="Alcon">Alcon</option>
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
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <!-- Start new input fields added as per category  -->
                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Model No</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framewidth" value="{{$product->framewidth}}" class="form-control col-md-7 col-xs-12" name="framewidth" placeholder="Enter Frame Width" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="prescriptiontypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Prescription Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="prescriptiontype" value="{{$product->prescriptiontype}}" class="form-control col-md-7 col-xs-12" name="prescriptiontype" placeholder="Enter Prescription Type" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{$product->height}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Enter Height" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="{{$product->usagesduration}}" class="form-control col-md-7 col-xs-12" name="usagesduration" placeholder="Enter Usages Duration" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="conditionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Conditions</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="condition" value="{{$product->conditionsnew}}" class="form-control col-md-7 col-xs-12" name="conditionsnew" placeholder="Conditions" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Seller Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Product Sku</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" name="productsku" placeholder=" Enter Product Sku" type="text">
                                </div>
                            </div>

                           <!--  <div class="item form-group" id="framestylenew">
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
                            </div>
 -->
                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Material</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Usages</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usages" value="{{$product->usages}}"  class="form-control col-md-7 col-xs-12" name="usages" placeholder="Enter Usages" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="{{$product->templematerial}}" class="form-control col-md-7 col-xs-12" name="templematerial" placeholder="Temple Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="{{$product->templecolor}}" class="form-control col-md-7 col-xs-12" name="templecolor" placeholder="Temple Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Material</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="leanscoating" value="{{$product->leanscoating}}" class="form-control col-md-7 col-xs-12" name="leanscoating" placeholder="Lens coating" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Diameter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="diameter" value="{{$product->diameter}}" class="form-control col-md-7 col-xs-12" name="diameter" placeholder="Enter Diameter" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="{{$product->contactlensmaterialtype}}" class="form-control col-md-7 col-xs-12" name="contactlensmaterialtype" placeholder="Contact Lens Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Base Curve</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="basecurve" value="{{$product->basecurve}}" class="form-control col-md-7 col-xs-12" name="basecurve" placeholder="Base Curve" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{$product->watercontent}}" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Min Sphere Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="power" value="{{$product->powermin}}" class="form-control col-md-7 col-xs-12" name="powermin" placeholder="Enter Power" type="text">
                                </div>
                            </div>

                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" value="{{$product->centerthiknessnew}}" class="form-control col-md-7 col-xs-12" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="cylindernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cylinder" value="{{$product->cylindernew}}" class="form-control col-md-7 col-xs-12" name="cylindernew" placeholder="Enter Cylinder" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="axisnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="axis" value="{{$product->axisnew}}" class="form-control col-md-7 col-xs-12" name="axisnew" placeholder="Enter Axis" type="text">
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Disposability</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Packaging</label>
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
                            

                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="lenscolor" >
                                        <option value="{{$product->lenscolor}}">{{$product->lenscolor}}</option>
                                        <option value="grey">Grey</option>
                                        <option value="blue" >Blue</option>
                                        <option value="green" >Green</option>
                                        <option value="brown" >Brown</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="pink" >Pink</option>
                                        <option value="black">Black</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="lenstechnology[]" id="lenstechnology">
                                        <option value="Mirror Coating" @if(in_array('Mirror Coating',$lens_new)) selected @endif>Mirror Coating</option>
                                        <option value="Scratch Resistant Coating" @if(in_array('Scratch Resistant Coating',$lens_new)) selected @endif >Scratch Resistant Coating</option>
                                        <option value="Anti-Fog Coating" @if(in_array('Anti-Fog Coating',$lens_new)) selected @endif>Anti-Fog Coating</option>
                                        <option value="Anti-Reflective Coating" @if(in_array('Anti-Reflective Coating',$lens_new)) selected @endif>Anti-Reflective Coating</option>
                                        <option value="Water Resistant Coating" @if(in_array('Water Resistant Coating',$lens_new)) selected @endif>Water Resistant Coating</option>
                                        <option value="UV Protection Coating" @if(in_array('UV Protection Coating',$lens_new)) selected @endif>UV Protection Coating</option>
                                        <option value="Blue Control Coating" @if(in_array('Blue Control Coating',$lens_new)) selected @endif>Blue Control Coating</option>
                                        <option value="Polarized" @if(in_array('Polarized',$lens_new)) selected @endif>Polarized</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens index</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" class="form-control col-md-7 col-xs-12" value="{{$product->gravity}}" name="gravity" placeholder="Enter Gravity" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="powerrangenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Power Range</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="powerange" value="{{$product->powerrange}}" class="form-control col-md-7 col-xs-12" name="powerrange" placeholder="Enter Power Range" type="text">
                                </div>
                            </div>

                            <!-- <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" >
                                        <option value="{{$product->visioneffect}}">{{$product->visioneffect}}</option>
                                        <option value="Biofocal">Biofocal</option>
                                        <option value="Progressive">Progressive</option>
                                        <option value="Zero Power">Zero Power</option>
                                        <option value="single Vision">single Vision</option>
                                    </select>
                                </div>
                            </div> -->

                            
                                    
                               
                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="coating[]" id="coating" >
                                    
                                    <option value="hardcoat" @if(in_array('hardcoat',$coat_new)) selected @endif >hardcoat</option>
                                    <option value="Anti Reflection coating" @if(in_array('Anti Reflection coating',$coat_new)) selected @endif >Anti Reflection coating</option>
                                    <option value="Blue Cantrol" @if(in_array('Blue Cantrol',$coat_new)) selected @endif >Blue Cantrol</option>
                                    <option value="Anti fog" @if(in_array('Anti fog',$coat_new)) selected @endif >Anti fog</option>
                                    <option value="Photochromatic" @if(in_array('Photochromatic',$coat_new)) selected @endif>Photochromatic</option>
                                  </select>
                                </div>
                            </div>


                            
 
                              <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype" >
                                      
                                         <option value="{{$product->lenstype}}">{{$product->lenstype}} </option>
                                        <option value="Biofocal" {{ old('lenstype') == "Biofocal" ? 'selected' : '' }}>Biofocal
                                        </option>
                                        <option value="Progressive" {{ old('lenstype') == "Progressive" ? 'selected' : '' }}>Progressive</option>
                                        <option value="Zero Power" {{ old('lenstype') == "Zero Power" ? 'selected' : '' }}>Zero Power</option>
                                        <option value="single Vision" {{ old('lenstype') == "single Vision" ? 'selected' : '' }}>single Vision</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Contact Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" required>
                                        <option value="">Select contact lense type </option>
                                        <option value="Spherical" {{ old('visioneffect') == "Spherical" ? 'selected' : '' }}>Spherical</option>
                                        <option value="MultiFocal" {{ old('visioneffect') == "MultiFocal" ? 'selected' : '' }}>MultiFocal</option>
                                        <option value="toric & Astigmatism" {{ old('visioneffect') == "toric & Astigmatism" ? 'selected' : '' }}>toric & Astigmatism</option>
                                        <option value="No Power" {{ old('visioneffect') == "No Power" ? 'selected' : '' }}>No Power</option>
                                        <option value="Color Lenses" {{ old('visioneffect') == "Color Lenses" ? 'selected' : '' }}>Color Lenses</option>
                                        <option value="ColorWithPower" {{ old('visioneffect') == "ColorWithPower" ? 'selected' : '' }}>ColorWithPower</option>

                                    </select>
                                </div>
                            </div> -->
                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Contact Lense Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect" >
                                        <option value="{{$product->visioneffect}}">{{$product->visioneffect}} </option>
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
                                    <input id="addpower" value="{{$product->addpower}}" class="form-control col-md-7 col-xs-12" name="addpower" placeholder="Enter Power" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" class="form-control col-md-7 col-xs-12" value="{{$product->coatingcolor}}" name="coatingcolor" placeholder="Enter Coating Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" class="form-control col-md-7 col-xs-12" value="{{$product->abbevalue}}" name="abbevalue" placeholder="Enter Abbe Value" type="text">
                                </div>
                            </div> 

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" class="form-control col-md-7 col-xs-12" value="{{$product->netquntity}}" name="netquntity" placeholder="Enter Net Quantity" type="text">
                                </div>
                            </div>

                            
                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="{{$product->focallength}}" class="form-control col-md-7 col-xs-12" name="focallength" placeholder="Enter Focal Length" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="packtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pack Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packtype" value="{{$product->packtype}}" class="form-control col-md-7 col-xs-12" name="packtype" placeholder="Enter Pack Type" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Shelf Life</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="{{$product->shelflife}}" class="form-control col-md-7 col-xs-12" name="shelflife" placeholder="Enter Shelf Life" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="formnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Form</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="form" value="{{$product->form}}" class="form-control col-md-7 col-xs-12" name="form" placeholder="Enter Form" type="text">
                                </div>
                            </div>

                            
                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="{{$product->productcolor}}" class="form-control col-md-7 col-xs-12" name="productcolor" placeholder="Enter Product Color" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="{{$product->productdim}}" class="form-control col-md-7 col-xs-12" name="productdim" placeholder="Enter Product Dimension" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="{{$product->material}}" class="form-control col-md-7 col-xs-12" name="material" placeholder="Enter Product Material" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Type</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" class="form-control col-md-7 col-xs-12" value="{{$product->manufracturer}}" name="manufracturer" placeholder=" Enter Manufracturer" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" class="form-control col-md-7 col-xs-12" value="{{$product->warrentytype}}" name="warrentytype" placeholder="Warrenty Type" type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" name="productdimension" placeholder="Product Dimension"  type="text">
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Weight</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" class="form-control col-md-7 col-xs-12" value="{{$product->weight}}" name="weight" placeholder="weight" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country Of Origin</label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" value="{{$product->hsncode}}" placeholder="Hsn Code" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video1
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video2
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Upload Video3
                                  <!-- <p class="small-label">(250 × 500)(Size:400kb)(Type:jpeg,png)</p> --></label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video2}}" id="adminvideo2"  type="video/mp4">
                                    </video>
                                    <!-- <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added"> -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFilevideo" accept="video/*" name="video2" type="file">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Product Gallery Images <span class="required">*</span>
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

                            @if($product->sizes != null)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="pallow" id="allow" value="1" checked><strong>Allow Product Sizes</strong></label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group" id="pSizes">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>
                                    <p class="small-label">(Write your own size Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="sizes" value="{{$product->sizes}}" data-role="tagsinput"/>
                                </div>
                            </div>
                            @else
                                <div class="item form-group">
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
                            @endif
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Current Price<span class="required">*</span>
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="price" value="{{$product->price}}" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Previous Price<span class="required">*</span>
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
                                        <label><input type="checkbox" name="bulkrange" id="bulkrange" value="1" checked><strong>Allow Bulk Size</strong></label>
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
                                          <th scope="col">Price</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><input type="text" value="{{$product->ranegnameone}}" name="ranegnameone"></td>
                                          <td><input type="number" value="{{$product->p40pieces}}" name="p40pieces"></td>
                                          
                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{$product->rangenametwo}}" name="rangenametwo"></td>
                                          <td><input type="number" value="{{$product->p51pieces}}" name="p51pieces"></td>
                                         
                                        </tr>
                                        <tr>
                                          <td><input type="text" value="{{$product->rangenamethree}}" name="rangenamethree"></td>
                                          <td><input type="number" value="{{$product->p5000pieces}}" name="p5000pieces"></td>
                                          
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
                                          <td><input type="text"  name="ranegnameone"></td>
                                          <td><input type="number"  name="p40pieces"></td>
                                          
                                        </tr>
                                        <tr>
                                          <td><input type="text"  name="rangenametwo"></td>
                                          <td><input type="number"  name="p51pieces"></td>
                                         
                                        </tr>
                                        <tr>
                                          <td><input type="text"  name="rangenamethree"></td>
                                          <td><input type="number"  name="p5000pieces"></td>
                                          
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
                            <div class="form-group">
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
        $('#prescriptiontypenew').hide();
        $('#usagesdurationnew').hide();
        $('#lensmaterialtypenew').hide();
        $('#gendernew').show();
        $('#warrentytypenew').show();
        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#frametypenew').show();
        $('#framedimension').hide()
        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

         $('#leanscoatingnew').hide();
         $('#powerrangenew').hide();
         $('#visioneffectnew').hide();
         $('#coatingnew').hide();
         $('#lenstypenew').hide();
         $('#addpowernew').hide();
         $('#framematerialnew').show();
         $('#frameshape').show();
         $('#sellername').show();
         $('#framestylenew').hide();
         $('#gendernew').show();
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
        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();

        $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#powerrangenew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#visioneffectnew').show();
        $('#lenstypenew').hide();
        $('#usagesdurationnew').show();
        $('#addpowernew').show();


    }else if(categoryname == "Sunglasses"){

         $('#usagesnew').hide();
        
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
         $('#prescriptiontypenew').hide();

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
        $('#lenstechnologynew').show();
        $('#coatingnew').show();
        $('#gendernew').show();
        $('#framestylenew').hide();
        $('#shapenew').show();
        $('#colornew').show();
        $('#addpowernew').hide();
        $('#usagesdurationnew').hide();
        $('#coatingnew').hide();




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
        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();


        $('#netquntitynew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#lenstypenew').show();
        $('#addpowernew').show();
        $('#lenstechnologynew').show();
        $('#coatingnew').show();
        $('#visioneffectnew').hide();


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
        $('#modelnonew').hide();
        $('#usagesdurationnew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();
        $('#framewidthnew').hide();
        $('#prescriptiontypenew').hide();
        $('#modelnonew').hide();
        $('#heightnew').hide();
        $('#conditionnew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#lenstypenew').hide();
        $('#addpowernew').hide();

        $('#powerrangenew').hide();
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#productdimnew').hide();
        // $('#productdimensionnew').show();
        $('#framedimensionnew').hide();
        $('#gendernew').hide();

    }else if(categoryname == "Premium Brands"){

        $('#usagesnew').hide();
         $('#lensmaterialtypenew').hide();
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
         $('#prescriptiontypenew').hide();
         // $('#frametypenew').show();

         $('#netquntitynew').hide();
        $('#gravitynew').hide();
        $('#coatingcolornew').hide();
        $('#abbevaluenew').hide();

        $('#centerthiknessnew').hide();
        $('#cylindernew').hide();
        $('#axisnew').hide();

        $('#powerrangenew').hide();
        $('#visioneffectnew').hide();
        $('#frametypenew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').hide();
        $('#coatingnew').hide();
        $('#lenstechnologynew').show();
        $('#framestylenew').hide();
        $('#usagesdurationnew').hide();
        $('#gendernew').show();
        
    }
    else{

    }

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
        $('#framestylenew').show();
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
        $('#gendernew').show();

 }

    else if(categoryname == "Contact Lenses") { 
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
        $('#visioneffectnew').hide();
        $('#coatingnew').hide();
        $('#lenstypenew').hide();
        $('#addpowernew').show();
        $('#visioneffectnew').show();


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
         $('#framecolornew')
         $('#shapenew').show();
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
        $('#gendernew').hide();
        $('#manufracturer').show();
        // $('#productdimensionnew').show();
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
         $('#lensmaterialtypenew').hide();
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