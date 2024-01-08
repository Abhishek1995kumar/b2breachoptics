<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use DB;


trait PermissionSetController {
    public function loginPermission($id)
    {
        DB::enableQueryLog();
        if($id != '' && $id){
            $perm_detail = DB::table('role_permissions as rp')
                        ->select('rp.*', 'rpl.*')
                        ->leftjoin('role_permissions_list as rpl', 'rp.id', 'rpl.rol_perm_id')
                        ->where('role_id', $id)
                        ->get();
                        
            $get_category_ids =  DB::table('product_list_cat_permission')->select('category_id', 'maincat')->where('role_id','=',$id)->get();
        }

        $order_category_per = array();
        $order_category_per_main = array();
        $pro_category_per = array();
        $pro_category_per_main = array();
        
        foreach($get_category_ids as $value){
            if($value->maincat == 'product'){
                $pro_category_per[] = $value->category_id;
                $pro_category_per_main[] = $value->maincat;
            }
            if($value->maincat == 'order'){
                $order_category_per[] = $value->category_id;
                $order_category_per_main[] = $value->maincat;
            }
        }
        
        if(isset($perm_detail)){
            foreach($perm_detail[0] as $val => $key){
                if(strpos($val, 'actions') !== false){
                    
                    $title = array();
                    if($val != '') $title = explode('_actions', $val);
                    else unset($title);

                    if($title[0] != '') {
                        $action[$title[0]] = ( ($key != '') ? explode(',',$key) :  '');
                    }
                }
            }
        }

        $session_data['role_actions'] = ( (!empty($action)) ? $action : '' );
        
        $session_data['order_category_per'] = ( (!empty($order_category_per)) ? $order_category_per : '' );
        $session_data['order_category_per_main'] = ( (!empty($order_category_per_main)) ? $order_category_per_main : '' );
        
        $session_data['pro_category_per'] = ( (!empty($pro_category_per)) ? $pro_category_per : '' );
        $session_data['pro_category_per_main'] = ( (!empty($pro_category_per_main)) ? $pro_category_per_main : '' );

        $session_data['manual_orders'] = ( (!empty($perm_detail[0]->manual_orders)) ? $perm_detail[0]->manual_orders : '' );
        $session_data['return_orders'] = ( (!empty($perm_detail[0]->return_orders)) ? $perm_detail[0]->return_orders : '' );
        $session_data['cancelled_orders'] = ( (!empty($perm_detail[0]->cancelled_orders)) ? $perm_detail[0]->cancelled_orders : '' );
        $session_data['products'] = ( (!empty($perm_detail[0]->products)) ? $perm_detail[0]->products : '' );
        $session_data['vendors'] = ( (!empty($perm_detail[0]->vendors)) ? $perm_detail[0]->vendors : '' );
        $session_data['customers'] = ( (!empty($perm_detail[0]->customers)) ? $perm_detail[0]->customers : '' );
        $session_data['manage_category'] = ( (!empty($perm_detail[0]->manage_category)) ? $perm_detail[0]->manage_category : '' );
        $session_data['blog'] = ( (!empty($perm_detail[0]->blog)) ? $perm_detail[0]->blog : '' );
        $session_data['slider_settings'] = ( (!empty($perm_detail[0]->slider_settings)) ? $perm_detail[0]->slider_settings : '' );
        $session_data['page_settings'] = ( (!empty($perm_detail[0]->page_settings)) ? $perm_detail[0]->page_settings : '' );
        $session_data['social_settings'] = ( (!empty($perm_detail[0]->social_settings)) ? $perm_detail[0]->social_settings : '' );
        $session_data['general_settings'] = ( (!empty($perm_detail[0]->general_settings)) ? $perm_detail[0]->general_settings : '' );
        $session_data['subscribers'] = ( (!empty($perm_detail[0]->subscribers)) ? $perm_detail[0]->subscribers : '' );
        $session_data['manage_roles'] = ( (!empty($perm_detail[0]->manage_roles)) ? $perm_detail[0]->manage_roles : '' );
        $session_data['payment_overview'] = ( (!empty($perm_detail[0]->payment_overview)) ? $perm_detail[0]->payment_overview : '' );
        $session_data['report'] = ( (!empty($perm_detail[0]->report)) ? $perm_detail[0]->report : '' );
        
        $id = Auth::user()->id;
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        $role = Auth::user()->role;

        $data = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            's_role' => 'r_'.$role,
            'order_category_per' => $order_category_per,
            'order_category_per_main' => $order_category_per_main,
            'pro_category_per' => $pro_category_per,
            'pro_category_per_main' => $pro_category_per_main,
            'role_actions' =>$session_data['role_actions'],
            'manual_orders' => $session_data['manual_orders'],
            'return_orders' => $session_data['return_orders'],
            'cancelled_orders' => $session_data['cancelled_orders'],
            'products' => $session_data['products'],
            'vendors' => $session_data['vendors'],
            'customers' => $session_data['customers'],
            'manage_category' => $session_data['manage_category'],
            'blog' => $session_data['blog'],
            'slider_settings' => $session_data['slider_settings'],
            'page_settings' => $session_data['page_settings'],
            'social_settings' => $session_data['social_settings'],
            'general_settings' => $session_data['general_settings'],
            'subscribers' => $session_data['subscribers'],
            'manage_roles' => $session_data['manage_roles'],
            'payment_overview' => $session_data['payment_overview'],
            'report' => $session_data['report'],

            'loggedin' => TRUE
        );
        return $data;
    }
}