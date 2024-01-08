@extends('admin.includes.master-admin')
<link href="{{ URL::asset('assets/css/admin/adminVendorProductAdd.css') }}" rel="stylesheet"/>
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
                    <form id="productFormSubmit"  class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Shop Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="vendorid" id="vendorid" placeholder="Select Vendor Name">
                                        <option selected disabled >Select Vendor Name</option>
                                        @foreach($vendor_na as $vname)
                                            <option value="{{ $vname->id }}">{{ $vname->shop_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="error">
                                @if ($errors->has('vname'))
                                    <span class="help-block">
                                         <strong style="color: red;">{{ $errors->first('vname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku" >Product Sku <span style="color:red;">*</span></label>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name <span class="required" style="color:red;">*</span>
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
                                <label for="maincats" class="control-label col-md-3 col-sm-3 col-xs-12">Main Category <span style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" required>
                                        <option  selected disabled>Select Main Category</option>
                                        @foreach($category as $category)
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
                                <label for="subs" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category <span class="required" style="color:red;">*

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="subid[]" id="subs" disabled>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="childs" class="control-label col-md-3 col-sm-3 col-xs-12">Child Category <span class="required" style="color:red;">*
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="childid[]" id="childs" disabled>
                                        <option value="">Select Child Category</option>
                                    </select>
                                </div>
                            </div>
                            
                             <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand Name <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="brandname" id="brandname">
                                        <option  selected disabled>Select Brand</option>
                                        @foreach($brand_na as $brand)
                                            <option value="{{$brand->name}}" <?php old('brandname') == "{{$brand->name}}" ? 'selected' : '' ?> >{{$brand->name}}</option>
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
                                                        
                            <div class="item form-group" id="shapenew">
                                <label for="shape" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Shape <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="shape" id="shape" >
                                        <option selected disabled>Select Shape</option>
                                        @foreach($frame_shap as $data)
                                            <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                                        
                            <div class="item form-group" id="premiumtypenew">
                                <label for="shape" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Premium Brand Type <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="premiumtype" id="premiumtype">
                                        <option  selected disabled >-- Select Premium Brand Type --</option>
                                        <option value="Frames" {{ old('premiumtype') == "Frames" ? 'selected' : '' }}>Frames</option>
                                        <option value="Sunglasses" {{ old('premiumtype') == "Sunglasses" ? 'selected' : '' }}>Sunglasses</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="colornew">
                                <label for="color" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Frame Color <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framecolor" id="framecolor">
                                        <option  selected disabled >Select Frame Color</option>
                                        @foreach($frame_col as $data)
                                            <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="gendernew">
                                <label for="gender"  class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control" multiple="multiple" name="gender[]" id="gender" >
                                        <option >Select Gender</option>
                                        @foreach($gender as $gen)
                                            <option value="{{ $gen->gender }}">{{ $gen->gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Contact Lens Type <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenstype" id="lenstype">
                                        <option selected disabled >Select Lens Type</option>
                                        @foreach($new_lens_tp as $nLType)
                                            <option value="{{ $nLType->name }}" >{{ $nLType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="visioneffect">Lens Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="visioneffect" id="visioneffect">
                                        <option selected disabled>Select Lens Power</option>
                                        @foreach($len_typ as $lType)
                                            <option value="{{ $lType->name }}" >{{ $lType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{old('modelno')}}" class="form-control col-md-7 col-xs-12" name="modelno" placeholder="Enter Model No" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12"> 
                                    <input id="sellername" value="{{old('sellername')}}" class="form-control col-md-7 col-xs-12" name="sellername" placeholder="Seller Name" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowerlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="addpowerlens[]" id="addpowerlens">
                                        <option >Select Power</option>
                                        @foreach($lenses_data as $lens)
                                            <option value="{{ $lens->add_power }}">{{ $lens->add_power }}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                            
                            <div class="item form-group" id="diameterlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameterlens">Lens DIA <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control" multiple="multiple" name="diameterlens[]" id="diameterlens">
                                        @foreach($lenses_data as $lens)
                                            <option value="{{ $lens->diameter }}">{{ $lens->diameter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="spheres">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">Sphere*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="sphere[]" id="sphere">
                                        <option>Select Sphere</option>
                                        @foreach($lenses_data as $data)
                                            <option value="{{$data->sphere}}">{{$data->sphere}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--Commit on 30/01/2023-->
                            <!--<div class="item form-group" id="single_pds">-->
                            <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="single_pd">Single PD*</label>-->
                            <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--        <input id="single_pd" value="{{old('single_pd')}}" class="form-control col-md-7 col-xs-12" name="single_pd" placeholder="single Pd" type="text">-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="item form-group" id="double_pds">-->
                            <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="double_pd">Double PD*</label>-->
                            <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                            <!--        <input id="double_pd" value="{{old('double_pd')}}" class="form-control col-md-7 col-xs-12" name="double_pd" placeholder="Double pd" type="text">-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="item form-group" id="axisnlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis <span class="required" style="color:red;"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="axisnlens[]" id="axisnlens">
                                        <option >Select Axis</option>
                                        @foreach($lenses_data as $data)
                                            <option value="{{$data->axis}}">{{$data->axis}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="cylinderlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinderlens">Cylinderd <span class="required" style="color:red;"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="cylinderlens[]" id="cylinderlens">
                                        <option >Select cylinder</option>
                                        @foreach($lenses_data as $data)
                                            <option value="{{$data->cylinder}}">{{$data->cylinder}}</option>
                                        @endforeach
                                    </select>                              
                                </div>
                            </div>

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="framematerial" id="framematerial">
                                        <option selected disabled>Select Frame Material</option>
                                        @foreach($frame_materi as $frame)
                                            <option value="{{$frame->name}}" <?php old('framematerial') == "{{$frame->name}}" ? 'selected' : '' ?>>{{$frame->name}}</option>
                                        @endforeach
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensmaterialtype" id="lensmaterialtype">
                                        <option selected disabled>Select Material</option>
                                        @foreach($lens_mate as $material)
                                            <option value="{{$material->name}}" <?php old('name') == "{{$material->name}}" ? 'selected' : '' ?> >{{$material->name}}</option>
                                        @endforeach
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

                            <div class="item form-group" id="watercontentnew"><span class="required">%</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="watercontent">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{old('watercontent')}}" class="form-control col-md-7 col-xs-12" name="watercontent" placeholder="water content" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control" multiple="multiple" name="diameter[]" id="diameter">
                                        <option >-- Select Diameter --</option>
                                        @foreach($contact_lens as $diameter)
                                            <option value="{{ $diameter->diameter }}" <?php old('diameter') == "{{ $diameter->diameter }}" ? 'selected' : '' ?>>{{ $diameter->diameter }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="basecurve[]" id="basecurve">
                                        <option >Select Base Curve</option>
                                        @foreach($contact_lens as $basecurve)
                                            <option value="{{ $basecurve->base_curv }}" <?php old('base_curv') == "{{ $basecurve->base_curv }}" ? 'selected' : '' ?>>{{ $basecurve->base_curv }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmin">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "( " ?> <i class="fa fa-minus"></i> <?php echo " )" ?> <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <select class="form-control" name="powermin[]" id="powermin" multiple>
                                        <option >Select Min Power</option>
                                        @foreach($contact_lens as $minpower)
                                            <option value="{{ $minpower->minus_sphere }}" <?php old('minus_sphere') == "{{ $minpower->minus_sphere }}" ? 'selected' : '' ?>>{{ $minpower->minus_sphere }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
            
            
                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "( " ?> <i class="fa fa-plus"></i> <?php echo " )" ?> <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <select class="form-control" name="powermax[]" id="powermax" multiple>
                                        @foreach($contact_lens as $maxpower)
                                            <option value="{{ $maxpower->plus_sphere }}" <?php old('plus_sphere') == "{{ $maxpower->plus_sphere }}" ? 'selected' : '' ?>>{{ $maxpower->plus_sphere }}</option>
                                        @endforeach                     
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="cylinderneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="cylindernew[]" id="cylindernew">
                                        <option>Select Contact Lens Cylinder</option>
                                        @foreach($contact_lens as $clens)
                                            <option value="{{ $clens->cylinder }}" <?php old('cylinder') == "{{ $clens->cylinder }}" ? 'selected' : '' ?>>{{ $clens->cylinder }}</option>
                                        @endforeach
                                    </select>                              
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="addpower[]" id="addpower">
                                        <option>Select Power</option>
                                        @foreach($contact_lens as $power)
                                            <option value="{{ $power->addpower }}" <?php old('addpower') == "{{ $power->addpower }}" ? 'selected' : '' ?>>{{ $power->addpower }}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                            
                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="axisnew[]" id="axisnew">
                                        <option>Select Axis</option>
                                        @foreach($lenses_data as $axis)
                                            <option value="{{ $axis->axis }}" <?php old('axis') == "{{ $axis->axis }}" ? 'selected' : '' ?>>{{ $axis->axis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessneww"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="centerthikness">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" class="form-control col-md-7 col-xs-12" value="{{old('centerthiknessnew')}}" name="centerthiknessnew" placeholder="Enter Center Thikness" type="text">
                                </div>
                            </div>

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="disposability" id="disposability">
                                        <option  selected disabled>Select Disposability</option>
                                        @foreach($disposability as $disp)
                                            <option value="{{ $disp->name }}" <?php old('name') == "{{ $disp->name }}" ? 'selected' : '' ?> >{{ $disp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="packaging" id="packaging">
                                        <option selected disabled>Select Packaging</option>
                                        @foreach($package as $pack)
                                            <option value="{{$pack->name}}" <?php old('name') == "{{$pack->name}}" ? 'selected' : '' ?> >{{$pack->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Lens Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="color" id="lenscolor" >
                                        <option  selected disabled>Select Color</option>
                                        @foreach($lens_color as $lensColor)
                                            <option value="{{ $lensColor->name }}" <?php old('name') == "{{ $lensColor->name }}" ? 'selected' : '' ?> >{{ $lensColor->name }}</option>
                                        @endforeach
                                     </select>
                                </div>
                            </div>

                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Contact Lens Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lenscolor" id="contact_lenscolor" >
                                        <option selected disabled>Select Color</option>
                                        @foreach($contact_lens_color as $clColor)
                                            <option value="{{$clColor->name}}" <?php old('name') == "{{$clColor->name}}" ? 'selected' : '' ?> >{{$clColor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="lenstechnology[]" id="lenstechnology" >
                                    	<option >Select Lens Technology</option>
                                        @foreach($lens_tech as $material)
                                            <option value="{{$material->name}}" <?php old('name') == "{{$material->name}}" ? 'selected' : '' ?> >{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="lensindex" id="lensindex">
                                        <option  selected disabled>Select Lens Index</option>
                                        @foreach($lens_ind as $lIndex)
                                            <option value="{{$lIndex->name}}" <?php old('name') == "{{$lIndex->name}}" ? 'selected' : '' ?>>{{$lIndex->name}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="gravitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gravity">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" value="{{old('gravity')}}" class="form-control col-md-7 col-xs-12" name="gravity" placeholder="Enter Gravity" type="text">
                                </div>
                            </div>

                            <!-- coating area -->
                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coating">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" multiple="multiple" name="coating[]" id="coating" >
                                        <option >Select Coating</option>
                                		@foreach($lenscoating as $coating)
                                            <option value="{{$coating->name}}" <?php old('coating') == "{{$coating->name}}" ? 'selected' : '' ?>>{{$coating->name}}</option>
                                        @endforeach
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

                            <div class="item form-group" id="productdimnew"><span class="required">MM</span>
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
                            
                            <div class="item form-group" id="heightnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="frameheight" value="{{old('height')}}" class="form-control col-md-7 col-xs-12" name="height" placeholder="Product Height in cm" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="productdimensionnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" value="{{old('productdimension')}}" class="form-control col-md-7 col-xs-12" name="productdimension" placeholder="Frame Dimension in cm"  type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="productdimensionAccessories">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Product Dimension <span style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="" name="productdimension" placeholder="Product Dimension"  type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12"> 
                                    <select class="form-control" name="frametype" id="frametype">
                                        <option  selected disabled>Select Frame Type</option>
                                        @foreach($frame_rim_t as $frameRim)
                                            <option value="{{ $frameRim->name }}" <?php old('name') == "{{ $frameRim->name }}" ? 'selected' : '' ?> >{{ $frameRim->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>
                             <div class="item form-group" id="manufracturernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer <span class="required" style="color:red;">*</label> 
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

                            <div class="item form-group" id="weightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" value="{{old('weight')}}" class="form-control col-md-7 col-xs-12" name="weight" placeholder="Product weight in gm" type="number" required>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packageweightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Package Weight <span class="required" style="color:red;">*</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packeageweight" value="{{old('packweight')}}" class="form-control col-md-7 col-xs-12" name="packweight" placeholder="Package weight in gm" type="number" required>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packagewidthnew"><span class="required">CM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width <span class="required" style="color:red;">*</span></label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{old('packwidth')}}" class="form-control col-md-7 col-xs-12" name="packwidth" placeholder="Package width in cm" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew"><span class="required">CM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Package Height <span class="required" style="color:red;">*</label> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{old('packheight')}}" class="form-control col-md-7 col-xs-12" name="packheight" placeholder="Package Height in cm" type="number">
                                </div>
                            </div>
                            
                            <div class="item form-group" id="packagelengthnew"><span class="required">CM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Package Length <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packlength" value="{{old('packlength')}}" class="form-control col-md-7 col-xs-12" name="packlength" placeholder="Package Length in cm" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="countryoforigin" id="countryoforigin" required>
                                        <option  selected disabled>Select Country Of Origin</option>
                                        @foreach($countryorigin as $item)
                                            @if(old('countryorigin') == $item->name)
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="{{old('hsncode')}}"  id="hsncode" class="form-control col-md-7 col-xs-12" name="hsncode" placeholder="Hsn Code" type="number">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adminimg"> Current Featured Image <span class="" style="color:red;">*</span>
                                  <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="photo" type="file" >
                                </div>
                            </div>
                            
                            <label class="control-label col-md-1 col-sm-1 col-xs-10" for="number"> Product Gallery Images <span class="" style="color:red;">*</span>
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
                                            <input type="file" style="display: none;" name="gallery[]" id="file-ip-1" accept="image/*" class="imagevalidation" data-image_val="1"  onchange="showPreview(event, 1);" >
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
                                <p class="small-label">(Size:8mb)</p>
                                <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added">
                                </div> -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile1" accept="video/*" name="video" type="file" >
                                    <div hidden style="display: flex;justify-content: space-evenly; display: none; align-items: center;flex-direction: row; /* padding: 10px; */ align-content: stretch;">
                                        <span class="btn btn-danger" style="margin-right: 33px;" onclick="remove_firstvideo(event);">Remove Video</span>
                                        <video width="270" height="150" controls style="margin-top: 10px; border: 1px solid black;">
                                            <source src="" type="video/mp4">
                                        </video>
                                    </div>
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
                                    <!--<div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <img style="max-width: 250px;" src="" id="adminvideo" alt="No Featured Video Added">
                                </div> -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input  id="uploadFile2" accept="video/*" name="video1" type="file" >
                                    <div hidden style="display: flex;justify-content: space-evenly; display: none; align-items: center;flex-direction: row; /* padding: 10px; */ align-content: stretch;">
                                        <span class="btn btn-danger" style="margin-right: 33px;" onclick="remove_secondvideo(event);">Remove Video</span>
                                        <video width="270" height="150" controls style="margin-top: 10px; border: 1px solid black;">
                                            <source src="" type="video/mp4">
                                        </video>
                                    </div>
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
                                    <input  id="uploadFile3" accept="video/*" name="video2" type="file" >
                                    <div hidden style="display: flex;justify-content: space-evenly; display: none; align-items: center;flex-direction: row; /* padding: 10px; */ align-content: stretch;">
                                        <span class="btn btn-danger" style="margin-right: 33px;" onclick="remove_thirdvideo(event);">Remove Video</span>
                                        <video width="270" height="150" controls style="margin-top: 10px; border: 1px solid black;">
                                            <source src="" type="video/mp4">
                                        </video>
                                    </div>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description <span class="required" style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="editor" class="form-control" rows="6">{{old('description')}}</textarea>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price
                                    <p class="small-label">(In INR)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('price')}}" name="price" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="number" id="selling-price">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP <span class="required" style="color:red;">*</span>
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pre_mrp" class="form-control col-md-7 col-xs-12" value="{{old('previous_price')}}" name="previous_price" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Product Cost Price <span class="required" style="color:red;">*</span>
                                    
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pro_costprice" class="form-control col-md-7 col-xs-12" value="{{old('costprice')}}" name="costprice" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="number">
                                </div>
                            </div>

                            <!-- end bulk product -->
                            <div class="item form-group" id="stocknew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock <span class="required" style="color:red;">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pro_stock" class="form-control col-md-7 col-xs-12" value="{{old('stock')}}" name="stock" placeholder="e.g 15" pattern="[0-9]{1,10}" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="producttat">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Tat<span class="required">*</span>
                                    <p class="small-label">(Expected Delivery Time)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{old('producttat')}}" name="producttat" placeholder="e.g 5" pattern="[0-9]{1,10}" type="number">
                                </div>
                            </div>

                            <div class="item form-group" id="policynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy <span class="required" style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="" class="form-control" rows="6">{{old('policy')}}</textarea>
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
                                             Featured Product
                                        </label>
                                    </div>

                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="tranding" {{ (old('tranding') == '1') ? 'checked' : ''}} value="1" autocomplete="off">
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
                                            Latest Product
                                        </label> 
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-xs-6">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="selected" {{ (old('selected') == '1') ? 'checked' : ''}} value="1" autocomplete="off">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Product Tags
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
                                                        <div class="col-md-3">
                                                            <input type="text" name="attr_color" id="attr_color" class="form-control" placeholder="Enter Color Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input id="attr_color_code" name="attr_color_code" placeholder="Enter Color Code" type="text" class="form-control" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input name="attr_imgs[]" id="color_file" type="file" multiple class="form-control" aria-required="true" aria-invalid="false" value="" >
                                                        </div>
                                                        <div class="col-md-3 ">
                                                           <button type="button" class="btn btn-success " id="product_color_attr" value="Add">Add</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="color_table" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Color Name</th>
                                                                <th class="text-center">Color Code</th>
                                                                <th class="text-center">Image</th>
                                                                <th class="text-center">Action</th>
                                                                <th hidden></th>
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
                                                    <input type="number" placeholder="MRP" class="form-control attr_mrp" name="attr_mrp[]" placeholder="Attr MRP Price" />
                                            </td>

                                            <td class="col-md-2">
                                                    <input type="number" placeholder="CP" class="form-control attr_pro_price" name="attr_pro_price[]" placeholder="Attr CP Price" />
                                            </td>
                                            <td class="col-md-3">
                                                <select class="form-control attr_pro_color" name="attr_pro_color[]">
                                                    <option value="0" selected >Select Color</option>
                                                </select>
                                            </td>
                                            <td class="col-md-1">
                                                <button type="button" class="btn btn-default replicaClass" style="padding: 0.5rem 0.75rem !important;"><i class="fa fa-plus" onclick="replicateManageTable('manage_attr_table')" ></i>
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
                                    <button id="add_ads" type="submit" style="width:136px;" class="btn btn-success btn-block">Add New Product</button>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{!! url('admin/products') !!}" class="btn btn-danger" style="margin-left: 142px; margin-top: -33px;width: 135px;">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<style type="text/css" src="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

<!------------ JavaScript code by Abhishek Start here ----------->
<script src="{{ URL::asset('assets/js/admin/adminVendorProductAdd.js') }}"></script>
@stop
