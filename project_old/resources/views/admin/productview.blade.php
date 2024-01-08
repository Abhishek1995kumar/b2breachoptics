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
                        <div class="form-horizontal form-label-left">
                            <div class="item form-group" id="productskunew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productsku" value="{{$product->productsku}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="titlenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" value="{{$product->title}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="titledescriptionnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titledescription">Product Name Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="titledescription" class="form-control col-md-7 col-xs-12" value="{{$product->titledescription}}" placeholder="Product Description" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="maincats" class="form-control col-md-7 col-xs-12" value="{{$categories[0]['name']}}" type="text" readonly>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="premiumtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Premium Brands Type </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="premiumtype" class="form-control col-md-7 col-xs-12" value="{{$product->premiumtype}}" type="text" readonly>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="subs">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="childs">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shape" class="form-control col-md-7 col-xs-12" name="titledescription" value="{{$product->shape}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="colornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Frame Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framecolor" class="form-control col-md-7 col-xs-12" value="{{$product->framecolor}}" type="text" readonly>
                                </div>
                            </div>

                             <div class="item form-group" id="gendernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gender" class="form-control col-md-7 col-xs-12" value="{{$product->gender}}" type="text" readonly>
                                </div>
                            </div>


                            <div class="item form-group" id="brandnamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandname">Brand Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="brandname" value="{{$product->brandname}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <hr>
                            <!-- Start new input fields added as per category  -->

                            <div class="item form-group" id="lenstypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Lens Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lenstype" class="form-control col-md-7 col-xs-12" value="{{$product->lenstype}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="modelnonew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="modelno" value="{{$product->modelno}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="framewidthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth">Frame Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="display:flex;">
                                    <input id="framewidth" value="{{$product->framewidth}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="heightnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="height" value="{{$product->height}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="usagesdurationnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usagesduration"> Usages Duration</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usagesduration" value="{{$product->usagesduration}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="colorcodenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colorcode">Color Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="colorcode" value="{{$product->colorcode}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="sellernamenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="sellername" value="{{$product->sellername}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="addpowerlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityaddpowerlens = $product->addpowerlens ? explode(',',$product->addpowerlens) : array();
                                    ?>
                                     <select class="form-control" id="addpowerlens" readonly>
                                        <?php for($i=0; $i< count($arrSpecialityaddpowerlens); $i++){ ?>
                                            <option value="{{ $arrSpecialityaddpowerlens[$i] }}">{{ $arrSpecialityaddpowerlens[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="diameterlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameterlens">Lens DIA</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitydiameterlens = $product->diameterlens ? explode(',',$product->diameterlens) : array();
                                    ?>
                                     <select class="form-control" id="diameterlens" readonly>
                                        <?php for($i=0; $i< count($arrSpecialitydiameterlens); $i++){ ?>
                                            <option value="{{ $arrSpecialitydiameterlens[$i] }}">{{ $arrSpecialitydiameterlens[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group" id="spheres">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">sphere**</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitysphere = $product->sphere ? explode(',',$product->sphere) : array();
                                    ?>
                                     <select class="form-control" id="sphere" readonly>
                                        <?php for($i=0; $i< count($arrSpecialitysphere); $i++){ ?>
                                            <option value="{{ $arrSpecialitysphere[$i] }}">{{ $arrSpecialitysphere[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="axisnlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityaxisnlens = $product->axisnlens ? explode(',',$product->axisnlens) : array();
                                    ?>
                                     <select class="form-control" id="axisnlens" readonly>
                                        <?php for($i=0; $i< count($arrSpecialityaxisnlens); $i++){ ?>
                                            <option value="{{ $arrSpecialityaxisnlens[$i] }}">{{ $arrSpecialityaxisnlens[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group" id="cylinderlenss">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinderlens">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylinders = $product->cylinderlens ? explode(',',$product->cylinderlens) : array();
                                        
                                    ?>
                                     <select class="form-control" id="cylinderlens" readonly>
                                        <?php for($i=0; $i< count($arrSpecialitycylinders); $i++){ ?>
                                            <option value="{{ $arrSpecialitycylinders[$i] }}">{{ $arrSpecialitycylinders[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="framematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framematerial">Frame Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="framematerial" class="form-control col-md-7 col-xs-12" value="{{$product->framematerial}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="templematerialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templematerial">Temple Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templematerial" value="{{$product->templematerial}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="templecolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="templecolor">Temple Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="templecolor" value="{{$product->templecolor}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="lensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensmaterialtype">Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lensmaterialtype" value="{{$product->lensmaterialtype}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="diameternew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameter">Diameter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrdiam = $product->diameter ? explode(',',$product->diameter) : array();
                                    ?>
                                     <select class="form-control" id="diameter" readonly>
                                        <?php for($i=0; $i< count($arrdiam); $i++){ ?>
                                            <option value="{{ $arrdiam[$i] }}">{{ $arrdiam[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="contactlensmaterialtypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contactlensmaterialtype">Contact Lens Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="contactlensmaterialtype" value="{{$product->contactlensmaterialtype}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="basecurvenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basecurve">Base Curve</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrBCcurve = $product->basecurve ? explode(',',$product->basecurve) : array();
                                    ?>
                                     <select class="form-control" id="basecurve" readonly>
                                        <?php for($i=0; $i< count($arrBCcurve); $i++){ ?>
                                            <option value="{{ $arrBCcurve[$i] }}">{{ $arrBCcurve[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="watercontentnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="watercontent">water content</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="watercontent" value="{{$product->watercontent}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmin">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermin">Sphere Power <?php echo "(" ?><i class="fa fa-minus"></i> <?php echo ")" ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMinspere = $product->powermin ? explode(',',$product->powermin) : array();
                                    ?>
                                     <select class="form-control" id="powermin" readonly>
                                        <?php for($i=0; $i< count($arrMinspere); $i++){ ?>
                                            <option value="{{ $arrMinspere[$i] }}">{{ $arrMinspere[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="powernewmax">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="powermax">Sphere Power <?php echo "(" ?><i class="fa fa-plus"></i> <?php echo ")" ?> <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrMaxspere = $product->powermax ? explode(',',$product->powermax) : array();
                                    ?>
                                     <select class="form-control" id="powermax" readonly>
                                        <?php for($i=0; $i< count($arrMaxspere); $i++){ ?>
                                            <option value="{{ $arrMaxspere[$i] }}">{{ $arrMaxspere[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- new field for contactcare -->
                            <div class="item form-group" id="centerthiknessnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="centerthikness">Center Thikness</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="centerthikness" value="{{$product->centerthiknessnew}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="cylinderneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylindernew">Cylinder</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycylindernew = $product->cylindernew ? explode(',',$product->cylindernew) : array();
                                    ?>
                                     <select class="form-control" id="cylindernew" readonly>
                                        <?php for($i=0; $i< count($arrSpecialitycylindernew); $i++){ ?>
                                            <option value="{{ $arrSpecialitycylindernew[$i] }}">{{ $arrSpecialitycylindernew[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="axisneww">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnew">Axis <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityaxisnew = $product->axisnew ? explode(',',$product->axisnew) : array();
                                    ?>
                                     <select class="form-control" id="axisnew" readonly>
                                        <?php for($i=0; $i< count($arrSpecialityaxisnew); $i++){ ?>
                                            <option value="{{ $arrSpecialityaxisnew[$i] }}">{{ $arrSpecialityaxisnew[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- end of new field for contactcare -->

                            <div class="item form-group" id="disposabilitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposability">Disposability</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="disposability" class="form-control col-md-7 col-xs-12" value="{{$product->disposability}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="packagingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packaging">Packaging</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packaging" class="form-control col-md-7 col-xs-12" value="{{$product->packaging}}" type="text" readonly>
                                </div>
                            </div>

                            @if($product->category[0] == 58 || $product->category[0] == 63 || $product->category[0] == 82)
                            <div class="item form-group" id="lenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Lens Color <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lenscolor" class="form-control col-md-7 col-xs-12" value="{{$product->color}}" type="text" readonly>
                                </div>
                            </div>
                            @endif

                            @if($product->category[0] == 72)
                            <div class="item form-group" id="contactlenscolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenscolor">Contact Lens Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lenscolor" class="form-control col-md-7 col-xs-12" value="{{$product->lenscolor}}" type="text" readonly>
                                </div>
                            </div>
                            @endif

                            <div class="item form-group" id="lenstechnologynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstechnology">Lens Technology </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"id="lenstechnology"  placeholder="Lens Technology" class="form-control attr_pro_price" value="{{ $product->lenstechnology != '' ? $product->lenstechnology : '' }}" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="lensindexnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lensindex">Lens index</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lensindex" class="form-control col-md-7 col-xs-12" value="{{$product->lensindex}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="gravitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gravity">Gravity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gravity" class="form-control col-md-7 col-xs-12" value="{{$product->gravity}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="visioneffectnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="visioneffect">Lens Type </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="visioneffect" value="{{$product->visioneffect}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="coatingnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coating">Coating</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialitycoating = $product->coating ? explode(',',$product->coating) : array();
                                    ?>
                                    <select class="form-control" id="coating" readonly>
                                        <?php for($i=0; $i< count($arrSpecialitycoating); $i++){ ?>
                                            <option value="{{ $arrSpecialitycoating[$i] }}">{{ $arrSpecialitycoating[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="addpowernew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpower">Add Power <span class="required" style="color:red;">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arrSpecialityadd = $product->addpower ? explode(',',$product->addpower) : array();
                                    ?>
                                    <select class="form-control" id="addpower" readonly>
                                        <?php for($i=0; $i< count($arrSpecialityadd); $i++){ ?>
                                            <option value="{{ $arrSpecialityadd[$i] }}">{{ $arrSpecialityadd[$i] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group" id="coatingcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coatingcolor">Coating Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="coatingcolor" class="form-control col-md-7 col-xs-12" value="{{$product->coatingcolor}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="abbevaluenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="abbevalue">Abbe Value</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="abbevalue" class="form-control col-md-7 col-xs-12" value="{{$product->abbevalue}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="netquntitynew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="netquntity">Net Quantity</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="netquntity" class="form-control col-md-7 col-xs-12" value="{{$product->netquntity}}" type="text" readonly>
                                </div>
                            </div>


                            <div class="item form-group" id="focallengthnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="focallength">Focal Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="focallength" value="{{$product->focallength}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="shelflifenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shelflife">Expiry Date</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="shelflife" value="{{$product->shelflife}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="productcolornew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productcolor">Product Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productcolor" value="{{$product->productcolor}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="productdimnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdim">Product Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdim" value="{{$product->productdim}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="materialnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material">Material</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="material" value="{{$product->material}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="frametypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frametype">Frame Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="frametype" value="{{$product->frametype}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>


                            <!-- End new input fields added as per category -->
                            <hr>

                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manufracturer">Manufracturer</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="manufracturer" class="form-control col-md-7 col-xs-12" value="{{$product->manufracturer}}" type="text" readonly>
                                </div>
                            </div>

                             <div class="item form-group" id="warrentytypenew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warrentytype">Warrenty Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="warrentytype" class="form-control col-md-7 col-xs-12" value="{{$product->warrentytype}}" type="text" readonly>
                                </div>
                            </div>

                             <div class="item form-group" id="productdimensionnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productdimension">Frame Dimension</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="productdimension" class="form-control col-md-7 col-xs-12" value="{{$product->productdimension}}" type="text" readonly>
                                </div>
                            </div>

                             <div class="item form-group" id="weightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">Product Weight</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="weight" class="form-control col-md-7 col-xs-12" value="{{$product->weight}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="packageweightnew"><span class="required">GRM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packweight">Package Weight</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packweight" value="{{$product->packweight}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="packagewidthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packwidth">Package Width</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packwidth" value="{{$product->packwidth}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="packageheightnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packheight">Package Height</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packheight" value="{{$product->packheight}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="packagelengthnew"><span class="required">MM</span>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="packlength">Package Length</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packlength" value="{{$product->packlength}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group" id="countryoforiginnew">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="countryoforigin">Country Of Origin</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="countryoforigin" value="{{$product->countryoforigin}}" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                </div>
                            </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hsncode">HSN Code</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="hsncode" class="form-control col-md-7 col-xs-12" value="{{$product->hsncode}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFile"> Current Featured Image</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="{{url('assets/images/products')}}/{{$product->feature_image}}" id="adminimg" alt="No Featured Image Added">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo1">Upload Video1</label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video}}" id="adminvideo"  type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadFilevideo2"> Upload Video2
                                </label>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                    <video width="200" height="200" controls>
                                        <source src="{{url('assets/images/products')}}/{{$product->video1}}" id="adminvideo1"  type="video/mp4">
                                    </video>
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
                            </div>

                         
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""> Product Gallery Images
                                <p class="small-label">(1300 × 1160)(Size:100kb)(Type:jpeg,png)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="slide">
                                        @foreach ($gallery as $num)
                                            <img width="30%" style="padding: 10px;" src="{{ url('assets/images/gallery/' . $num->image) }}">
                                        @endforeach
                                    </div>
                                    <div id="thumb-output"></div>
                                    <p class="small-label">Multiple Image Allowed</p>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description <span class="required" style="color:red;">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="description" class="form-control" rows="6">{{$product->description}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">MRP
                                    <p class="small-label">(In INR, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="{{$product->previous_price}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Selling Price</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_costprice" value="{{$product->costprice}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="pro_stock" value="{{$product->stock}}" type="text" readonly>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="policy" class="form-control" rows="6" readonly>{{$product->policy}}</textarea>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                            </div>

                         
                            <div class="item form-group">
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
                                                    <table id="color_table" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Color Name</th>
                                                                <th>Color Code</th>
                                                                <th>Image</th>
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
                                                <input type="text" id="ranegnameone" value="{{ $product->ranegnameone != '' ? $product->ranegnameone : '' }}" placeholder="e.g 11-50" readonly>    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" id="discount_one" value="{{ $product->discount_one != '' ? $product->discount_one : '' }}" placeholder="e.g. 10" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" id="rangenametwo" value="{{ $product->rangenametwo != '' ? $product->rangenametwo : '' }}" placeholder="e.g 51-100" readonly>    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" id="discount_two" value="{{ $product->discount_two != '' ? $product->discount_two : '' }}" placeholder="e.g. 20" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="text" id="rangenamethree" value="{{ $product->rangenamethree != '' ? $product->rangenamethree : '' }}" placeholder="e.g 101-150" readonly>    
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #a9a5a5;">
                                            <div class="form-group">
                                                <input type="number" id="discount_three" value="{{ $product->discount_three != '' ? $product->discount_three : '' }}" placeholder="e.g. 30" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>

                                <div>
                                    <label><span class="required"><input type="checkbox" id="manage_pro_attr">&nbsp; Manage Product Attribute</span>
                                    </label>
                                </div>

                                <div id="manage_pro_attr_div" style="margin: -1px -1px 5px; border: 1px solid rgb(235, 225, 225); padding: 25px; display:none;">
                                    <table id="manage_attr_table" style="width: 100%;" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Attr Sku</th>
                                                <th>Attr Size</th>
                                                <th>Attr Qty</th>
                                                <th>Attr MRP</th>
                                                <th>Attr CP</th>
                                                <th>Attr Color</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($attrData->isNotEmpty())
                                                @foreach($attrData as $attr)
                                                    <tr class="items form-group">
                                                        <td>
                                                            <input type="text" class="form-control att_pro_sku" value="{{ $attr->attr_sku != '' ? $attr->attr_sku : '' }}" placeholder="Attr SKU No" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control attr_pro_size" value="{{ $attr->attr_size != '' ? $attr->attr_size : '' }}" placeholder="Size" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" placeholder="Qty" class="form-control attr_pro_qty" value="{{ $attr->attr_qty != '' ? $attr->attr_qty : '' }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" placeholder="MRP" class="form-control attr_mrp" value="{{ $attr->attr_mrp != '' ? $attr->attr_mrp : '' }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" placeholder="SP" class="form-control attr_pro_price" value="{{ $attr->attr_price != '' ? $attr->attr_price : '' }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control attr_pro_price" value="{{ $attr->attr_color != '' ? $attr->attr_color : '' }}" placeholder="Color" readonly>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="6"><h5>Records Not Found</h5></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Product Attribute form end here -->
                        </div>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
<style type="text/css" src="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></style>

<script src="{{ URL::asset('assets/js/admin/productview.js') }}"></script>

<!------------ JavaScript code by Prashant Start here ----------->

<!---- for product attribute and attribute gallery delete purpose ----->

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
                'url'  : "{{url('/admin/fetch_attr_color_list_view')}}",
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
        // $('#result').html( 'Event result:<br>'+result );
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

@stop