@extends('admin.includes.master-admin')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <!-- Page Heading -->
            <div class="go-title">
                <h3>Role Manage</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div class="tab-pane active" id="product_list">
                                    <div class="go-title" style="margin-left :0px">
                                        <div class="pull-right">
                                            <a href="{!! route('manageroles') !!}" class="btn btn-primary btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                        <div class="pull-left" style="display:flex; justify-content: center; align-items:center; gap:5px;">
                                            <p class="lead">ADD NEW ROLE</p>
                                            <div>
                                                <a onclick="open_modal_category_permission()"><button class="btn btn-success">Category Permission</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div  class="col-sm-12">
                                        <form action="{{route('permission.store')}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="col-sm-12 d-flex">
                                                <div class="form-group col-sm-6 p-2">
                                                    <div class="col-sm-1">
                                                        <label for="exampleInputEmail1"><h4>Role</h4></label>
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <input type="hidden" class="form-control" value="{{$role->id}}" name="role">
                                                        <input type="text" class="form-control" value="{{$role->role}}" id="rolemanage" aria-describedby="emailHelp" placeholder="Enter role" readonly>
                                                        <small id="emailHelp" class="form-text text-muted">Define Role by which handle admin panel.</small>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                   
                                                    <div class="col-sm-1">
                                                        <?php if(!empty($role_details)){?>
                                                        <input type="checkbox" <?php echo $role_details[0]->is_admin == 'Y' ?  'checked' : '';?> class="form-check-input" onchange="checkAll(this)"  name="is_admin" value="Admin" id="exampleCheck1">
                                                        <?php } else { ?>
                                                        <input type="checkbox"  class="form-check-input" onchange="checkAll(this)"  name="is_admin" value="Admin" id="exampleCheck1">
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    <label class="form-check-label" for="exampleCheck1">Is Admin</label>
                                                </div>
                                                <div class="col-sm-1 text-right">
                                                    <i class="fa fa-info-circle" style="font-size: 20px; cursor: pointer;" aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php 
                                                    // print_r($data['actions']);
                                                    ?>
                                                <table id="datatable_list" class="table table-striped zero-configuration permission_table" cellspacing="0" cellpadding="0" 
                                                    width="100%">
                                                    <thead id="header">
                                                        <tr>
                                                            <th width="25%">Sub Module Name</th>
                                                            <th width="25%">Module Name</th>
                                                            <th>View</th>
                                                            <th>Add</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                            <th>Print</th>
                                                            <th>Approve</th>
                                                            <th>Cancel</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="edited_tbody">
                                                        <?php 
                                                            foreach($data['per_list'] as $row => $val) {
                                                                $chckd = array();
                                                                $id = $val->id;
                                                                $title = $val->sub_module_name;
                                                                $type = $val->module_name;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $title; ?></td>
                                                            <td><?php echo $type; ?></td>

                                                            
                                                            <!---- Manual Orders---->
                                                            <?php 
                                                                if($type == 'Manual Orders') {
                                                                    $chckd['V'] = '';
                                                                    $chckd['A'] = '';
                                                                    $chckd['U'] = '';
                                                                    $chckd['D'] = '';
                                                                    $chckd['P'] = '';
                                                                    $chckd['C'] = '';
                                                                    $chckd['N'] = '';
                                                                    if(!empty($data['manual_orders'])) {
                                                                        for($i=0; $i < count($data['manual_orders']); $i++) {
                                                                            $shrt_frm;
                                                                            if($data['manual_orders'][$i] != '') $shrt_frm = strtolower($data['manual_orders'][$i]);

                                                                            if($val->short_name == $shrt_frm) {

                                                                                foreach($data['actions'] as $rows => $keys) {
                                                                                    if($rows == $shrt_frm) {
                                                                                        $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                        $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                        $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                        $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                        $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                        $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                        $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                    <?php
                                                                    }else{
                                                                    ?>
                                                                        <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                        <td>- </td>
                                                                        <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                        <td>- </td>
                                                                        <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                        <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                        <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                    <?php
                                                                    }
                                                                }
                                                            ?>

                                                            <!---- Return Orders---->
                                                            <?php 
                                                            if($type == 'Return Orders') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['return_orders'])) {
                                                                    for($i=0; $i < count($data['return_orders']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['return_orders'][$i] != '') $shrt_frm = strtolower($data['return_orders'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Cancelled Orders---->
                                                            <?php 
                                                            if($type == 'Cancelled Orders') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['cancelled_orders'])) {
                                                                    for($i=0; $i < count($data['cancelled_orders']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['cancelled_orders'][$i] != '') $shrt_frm = strtolower($data['cancelled_orders'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Products---->
                                                            <?php 
                                                            if($type == 'Products') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['products'])) {
                                                                    for($i=0; $i < count($data['products']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['products'][$i] != '') $shrt_frm = strtolower($data['products'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>"  <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>"  <?php echo $chckd['D'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Vendors---->
                                                            <?php 
                                                            if($type == 'Vendors') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['vendors'])) {
                                                                    for($i=0; $i < count($data['vendors']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['vendors'][$i] != '') $shrt_frm = strtolower($data['vendors'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Customers---->
                                                            <?php 
                                                            if($type == 'Customers') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['customers'])) {
                                                                    for($i=0; $i < count($data['customers']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['customers'][$i] != '') $shrt_frm = strtolower($data['customers'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Manage Category---->
                                                            <?php 
                                                            if($type == 'Manage Category') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['manage_category'])) {
                                                                    for($i=0; $i < count($data['manage_category']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['manage_category'][$i] != '') $shrt_frm = strtolower($data['manage_category'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Blog---->
                                                            <?php 
                                                            if($type == 'Blog') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['blog'])) {
                                                                    for($i=0; $i < count($data['blog']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['blog'][$i] != '') $shrt_frm = strtolower($data['blog'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Slider Settings---->
                                                            <?php 
                                                            if($type == 'Slider Settings') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['slider_settings'])) {
                                                                    for($i=0; $i < count($data['slider_settings']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['slider_settings'][$i] != '') $shrt_frm = strtolower($data['slider_settings'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Page Settings---->
                                                            <?php 
                                                            if($type == 'Page Settings') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['page_settings'])) {
                                                                    for($i=0; $i < count($data['page_settings']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['page_settings'][$i] != '') $shrt_frm = strtolower($data['page_settings'][$i]);

                                                                        if($val->short_name == $shrt_frm) {
                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>

                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  ></td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Social Settings---->
                                                            <?php 
                                                            if($type == 'Social Settings') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['social_settings'])) {
                                                                    for($i=0; $i < count($data['social_settings']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['social_settings'][$i] != '') $shrt_frm = strtolower($data['social_settings'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- General Settings---->
                                                            <?php 
                                                            if($type == 'General Settings') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['general_settings'])) {
                                                                    for($i=0; $i < count($data['general_settings']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['general_settings'][$i] != '') $shrt_frm = strtolower($data['general_settings'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Subscribers---->
                                                            <?php 
                                                            if($type == 'Subscribers') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['subscribers'])) {
                                                                    for($i=0; $i < count($data['subscribers']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['subscribers'][$i] != '') $shrt_frm = strtolower($data['subscribers'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Manage Roles---->
                                                            <?php 
                                                            if($type == 'Manage Roles') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['manage_roles'])) {
                                                                    for($i=0; $i < count($data['manage_roles']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['manage_roles'][$i] != '') $shrt_frm = strtolower($data['manage_roles'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" <?php echo $chckd['N'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" <?php echo $chckd['U'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" <?php echo $chckd['D'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" <?php echo $chckd['A'];?>> </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" <?php echo $chckd['C'];?>> </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_N';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_U';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_D';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_A';?>" > </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_C';?>" > </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Payment Overview---->
                                                            <?php 
                                                            if($type == 'Payment Overview') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['payment_overview'])) {
                                                                    for($i=0; $i < count($data['payment_overview']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['payment_overview'][$i] != '') $shrt_frm = strtolower($data['payment_overview'][$i]);

                                                                        if($val->short_name == $shrt_frm) {

                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td>- </td>
                                                                <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>> </td>
                                                                <td>- </td>
                                                                <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                            <!---- Report Settings---->
                                                            <?php 
                                                            if($type == 'Report') {
                                                                $chckd['V'] = '';
                                                                $chckd['A'] = '';
                                                                $chckd['U'] = '';
                                                                $chckd['D'] = '';
                                                                $chckd['P'] = '';
                                                                $chckd['C'] = '';
                                                                $chckd['N'] = '';
                                                                if(!empty($data['report'])) {
                                                                    for($i=0; $i < count($data['report']); $i++) {
                                                                        $shrt_frm;
                                                                        if($data['report'][$i] != '') $shrt_frm = strtolower($data['report'][$i]);

                                                                        if($val->short_name == $shrt_frm) {
                                                                            foreach($data['actions'] as $rows => &$keys) {
                                                                                if($rows == $shrt_frm) {
                                                                                    $chckd['V'] = ( (in_array('V',$keys)) ? 'checked' : '');
                                                                                    $chckd['N'] = ( (in_array('N',$keys)) ? 'checked' : '');
                                                                                    $chckd['U'] = ( (in_array('U',$keys)) ? 'checked' : '');
                                                                                    $chckd['D'] = ( (in_array('D',$keys)) ? 'checked' : '');
                                                                                    $chckd['P'] = ( (in_array('P',$keys)) ? 'checked' : '');
                                                                                    $chckd['A'] = ( (in_array('A',$keys)) ? 'checked' : '');
                                                                                    $chckd['C'] = ( (in_array('C',$keys)) ? 'checked' : '');
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  <?php echo $chckd['V'];?>> </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" <?php echo $chckd['P'];?>>  </td>
                                                                    <td>- </td>
                                                                    <td>- </td>

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_V';?>"  ></td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                    <td><input type="checkbox" name="actions[]" value="<?php echo $id.'_P';?>" > </td>
                                                                    <td>- </td>
                                                                    <td>- </td>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php        
                                                            }    
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12 lg-3 mx-auto" style="display: flex; justify-content: center;">
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
                                                </div>
                                            </div>
                                        </form>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Permission Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">View :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Page View only</span>
                    </div>
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">Add :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Add New Data in Table</span>
                    </div>
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">Edit :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Update Data from Table</span>
                    </div>
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">Delete :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Delete Data from Table</span>
                    </div>
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">Approve :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Accept Order / Product Active / Role User Active</span>
                    </div>
                    <div class="col-sm-12" style="display: flex; align-items: center;">
                        <h5 class="col-sm-2" style="text-align:left;">Cancel :- </h5>
                        <span class="col-sm-10" style="text-align:left;">Reject Order / Product Deactive / Role User Deactive</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--Category Permission-->
<div class="modal fade" id="category_permission_role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Category Role Manual Order:</b> </h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="cat_role">
                        {{ csrf_field() }}
                        <input type="hidden" name="role_id" value="<?php echo $data['role_id']; ?>">
                        <table id="datatable_list" class="table table-striped zero-configuration permission_table" cellspacing="0" cellpadding="0" 
                                                    width="100%">
                            <thead id="header">
                                <tr>
                                    <th>Sub Module Name</th>
                                    <th>Module Name</th>
                                    @foreach($categories as $cat)
                                        <th>{{$cat->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="edited_tbody">
                                <td>Product List</td>
                                <td>Products</td>
                                @foreach($categories as $cat)
                                    <td><input type="checkbox" <?php echo in_array($cat->id, $role_wise_cat_prod) ? "checked" : ""; ?> name="pcategory[]" value="{{$cat->id}}"></td>
                                @endforeach
                            </tbody>
                            <tbody>
                                <td>Order Process</td>
                                <td>Manual Order</td>
                                @foreach($categories as $cat)
                                    <td><input type="checkbox" <?php echo in_array($cat->id, $role_wise_cate_per) ? "checked" : ""; ?> name="ordercategory[]" value="{{$cat->id}}"></td>
                                @endforeach
                            </tbody>
                        </table>
                        <table id="datatable_list" class="table table-striped zero-configuration permission_table" cellspacing="0" cellpadding="0" 
                                                    width="100%">
                            <thead id="header">
                            </thead>
                            
                            <!--kishori start code-->
                            <tbody id="edited_tbody">
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger">Category Permission</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
<!--kishori end code -->

@stop

@section('footer')

<script>
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    function checkAll(mycheckbox) {
        if (mycheckbox.checked == true){
            checkboxes.forEach(function(checkbox){
                checkbox.checked = true;
                console.log(checkbox.value);
            });
        }
        else{
            checkboxes.forEach(function(checkbox){
                checkbox.checked = false;
            });
        }
    }
    
    function open_modal_category_permission()
    {
      $('#category_permission_role').modal('show');
      
    }
    
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#cat_role').submit(function(e){
            var formData = new FormData(this);
            e.preventDefault();
            var url = "{{url('/admin/category_permission')}}";
            
            $.ajax({
                    type: 'POST',
                    url: url,
                    cache: false,
                    processData: false,
                    contentType: false,
                    data:formData,
                    success: function(response) 
                    {
                       if(response.status == "success"){
                           window.location.reload();
                       }
                    }
                });
        })
    })
</script>

@stop