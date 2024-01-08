
<!-- Lens Prescription -->
<div class="modal fade" id="prescriptionModal" role="dialog" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Lense Prescription</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="LensePrescription" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body" style="padding:10px; display: flex; justify-content: center; align-items: center;">
                    <div class="col-lg-12" style="overflow-y:scroll; overflow-x:hidden; height: 320px">
                        <div class="form-group">
                            <input type="hidden" id="lenseType" name="visioneffect" value="{{$productdata->visioneffect}}">
                        </div>
                        <table class="table table-bordered" id="pre_table" >
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" class="text-center" id="addPower" style="opacity: 0;">ADD</th>
                                    <th colspan="4" class="text-center"><input type="checkbox" id="lecheckbox">&nbsp;LE</th>
                                    <th colspan="4" class="text-center"><input type="checkbox" id="recheckbox">&nbsp;RE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="leaddPowerField" style="opacity: 0;" class="form-group">
                                        <select id="leAddPowers" name="Lpower" class="form-control leAddPower" value="<?php if(!empty($search_type['ladd'])){ echo $search_type['ladd'];} ?>">
                                            <option value="0">0.00</option>
                                        <?php
                                            $lensepower = explode(",", $productdata->addpowerlens);
                                            for($i=0; $i<count($lensepower); $i++){
                                        ?>
                                            <option value="{{$lensepower[$i]}}"  <?php old('Lpower') == "{{$lensepower[$i]}}" ? 'selected' : '' ?> >{{$lensepower[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td id="readdPowerField" style="opacity: 0;" class="form-group">
                                        <select id="ReAddPowers" name="rpower" class="form-control ReAddPower" value="<?php if(!empty($search_type['radd'])){echo $search_type['radd'];} ?>">
                                            <option value="0">0.00</option>
                                        <?php
                                            $lensepower = explode(",", $productdata->addpowerlens);
                                            for($i=0; $i<count($lensepower); $i++){
                                        ?>
                                            <option value="{{$lensepower[$i]}}">{{$lensepower[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td id="leSphere">SPH</i></td>
                                    <td id="leCylinder">CYL</td>
                                    <td id="leAxis">AXIS</td>
                                    <td id="leAxis">VA</td>
                                    <td id="reSphere">SPH</td>
                                    <td id="reCylinder">CYL</td>
                                    <td id="reAxis">AXIS</td>
                                    <td id="reAxis">VA</td>
                                </tr>
                                <tr class="distance">
                                    <td colspan="2" class="text-center">Distance</td>
                                    <td class="text-center" class="form-group">
                                        <select id="leSpheres" name="Lsphere" class="form-control leSphere" value="<?php if(!empty($search_type['lsph'])){ echo $search_type['lsph'];} ?>" style="width: 70px;">
                                            <option value="0">0.00</option>
                                        <?php
                                            $lenseshp = explode(",", $productdata->sphere);
                                            for($i=0; $i<count($lenseshp); $i++){
                                        ?>
                                            <option value="{{$lenseshp[$i]}}">{{$lenseshp[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select id="leCyls" name="Lcyle" class="form-control leCyl" value="<?php if(!empty($search_type['lcyl'])){ echo $search_type['lcyl'];} ?>" style="width: 70px;">
                                            <option value="0">0.00</option>
                                        <?php
                                            $cylinderlens = explode(",", $productdata->cylinderlens);
                                            for($i=0; $i<count($cylinderlens); $i++){
                                        ?>
                                            <option value="{{$cylinderlens[$i]}}">{{$cylinderlens[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select id="leAxiss" name="Laxis" class="form-control leAxis" value="<?php if(!empty($search_type['laxis'])){ echo $search_type['laxis'];} ?>" style="width: 70px;">
                                            <option value="">--</option>
                                        <?php
                                            $axisnlens = explode(",", $productdata->axisnlens);
                                            for($i=0; $i<count($axisnlens); $i++){
                                        ?>
                                            <option value="{{$axisnlens[$i]}}">{{$axisnlens[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select type="text" id="levas" name="lva" class="form-control leva" value="" style="width: 70px;">
                                            <option value="">--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select id="reSpheres" name="rsphere" class="form-control reSphere" value="<?php if(!empty($search_type['rsph'])){ echo $search_type['rsph'];} ?>" style="width: 70px;">
                                            <option value="0">0.00</option>
                                        <?php
                                            for($i=0; $i<count($lenseshp); $i++){
                                        ?>
                                            <option value="{{$lenseshp[$i]}}">{{$lenseshp[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select id="reCyls" name="rcyl" class="form-control reCyl" value="<?php if(!empty($search_type['rcyl'])){ echo $search_type['rcyl'];} ?>" style="width: 70px;">
                                            <option value="0">0.00</option>
                                        <?php
                                            for($i=0; $i<count($cylinderlens); $i++){
                                        ?>
                                            <option value="{{$cylinderlens[$i]}}">{{$cylinderlens[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select id="reAxiss" name="Raxis" class="form-control reAxis" value="<?php if(!empty($search_type['raxis'])){ echo $search_type['raxis'];} ?>" style="width: 70px;">
                                            <option value="--">--</option>
                                        <?php
                                            for($i=0; $i<count($axisnlens); $i++){
                                        ?>
                                            <option value="{{$axisnlens[$i]}}">{{$axisnlens[$i]}}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="text-center" class="form-group">
                                        <select type="text" id="revas" name="rva" class="form-control reva" value="" style="width: 70px;">
                                            <option value="">--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr class="reading form-group">
                                    <td colspan="2" class="text-center readingText">Reading</td>
                                    <td class="text-center">
                                        <input type="text" class="form-control lsph" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control lcyl" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control laxis" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control readinglva" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control rsph" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control rcyl" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control raxis" style="width: 60px;" readonly="readonly">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control readingrva" style="width: 60px;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr id="addPowerField" style="opacity: 0;" class="form-group">
                                    <td colspan="4" class="text-center">
                                        <label for="" class="control-label col-md-6 col-sm-6 col-xs-12">Total PD</label>
                                        <input type="text" name="totalPd" class="form-control col-md-6 col-sm-6 col-xs-12 totalPd" style="width: 70px">
                                    </td>
                                    <td colspan="3" class="text-center">
                                        <!--<input type="text" name="lePd" class="lePd" style="width: 70px">-->
                                        <select id="lePds" type="text" name="Lepd" class="form-control lePd" style="width: 70px">
                                            <option value="0" >Left PD<option/>
                                            @foreach($left_pd as $pd)
                                                <option value="{{$pd->left_pd}}">{{$pd->left_pd}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="3" class="text-center">
                                        <select id="rePds" type="text" name="Repd" class="form-control rePd" style="width: 70px">
                                            <option value="0" >Right PD<option/>
                                            @foreach($left_pd as $pd)
                                                <option value="{{$pd->right_pd}}">{{$pd->right_pd}}</option>
                                            @endforeach
                                        </select>
                                        <!--<input type="text" name="rePd" class="rePd" style="width: 70px">-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="checkbox" name="parameter" {{ (old('parameter') == '1') ? 'checked' : ''}} value="1" class="parameter_checkbox" onclick="addParamete(event)"> ADD PARAMETER
                        <br>
                        <br>
                        <table class="table table-bordered" id="parameter_table">
                            <tbody>
                                <tr>
                                    <th colspan="2" class="text-center">A Size</th>
                                    <th colspan="2" class="text-center">B Size</th>
                                    <th colspan="2" class="text-center">DBL</th>
                                    <th colspan="2" class="text-center">R-DIAMETER</th>
                                    <th colspan="2" class="text-center">L-DIAMETER</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <input class="form-control" type="text" name="a_size" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="b_size" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="dbl" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="r_dia" class="" style="width: 138px">
                                    </td> 
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="l_dia" class="" style="width: 138px">
                                    </td> 
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">R-FITTING HEIGHT</th>
                                    <th colspan="2" class="text-center">L-FITTING HEIGHT</th>
                                    <th colspan="2" class="text-center">BVD</th>
                                    <th colspan="2" class="text-center">R-ED</th>
                                    <th colspan="2" class="text-center">L-ED</th>
                                </tr>
                                <tr>
                                   <td colspan="2" class="text-center">
                                        <input class="form-control" type="text" name="r_fitting" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="l_fitting" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="bvd" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="r_ed" class="" style="width: 138px">
                                    </td> 
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="l_ed" class="" style="width: 138px">
                                    </td> 
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">MATERIALS</th>
                                    <th colspan="2" class="text-center">SHAPE CODE</th>
                                    <th colspan="2" class="text-center">PANTASCOPIC TINT</th>
                                    <th colspan="2" class="text-center">TEMPLE SIZE</th>
                                    <th colspan="2" class="text-center">NEARWORK DISTANCE</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="materials" class="" style="width: 138px">
                                    </td> 
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="shape_code" class="" style="width: 138px">
                                    </td> 
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="pantascopic" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="temple_size" class="" style="width: 138px">
                                    </td> 
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="network_distance" class="" style="width: 138px">
                                    </td> 
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">FRAME FIT</th>
                                    <th colspan="2" class="text-center">BOW ANGLE</th>
                                    <th colspan="4" class="text-center">FRAME TYPE - FULL/HALF/RIMLESS</th>
                                    <th colspan="2" class="text-center">BASE CURVE</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <input class="form-control" type="text" name="frame_fit" class="" style="width: 138px">
                                    </td>
                                    <td colspan="2" class="text-center">
                                        <input class="form-control" type="text" name="bow_angle" class="" style="width: 138px">
                                    </td>
                                    <td colspan="4" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="frame_type" class="" style="width: 264px">
                                    </td>
                                    <td colspan="2" class="text-center" style="width: 138px">
                                        <input class="form-control" type="text" name="base_curve" class="" style="width: 138px">
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: baseline;">
                    <button type="submit" class="btn btn-success" id="getPrescription" style="outline:none; width: 80px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
