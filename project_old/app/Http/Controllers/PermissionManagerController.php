<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Session;
use DB;


class PermissionManagerController extends Controller
{
    public function permissionCreateform(Request $request, $id)
    {
        if(!in_array('N', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        $role = Role::findOrfail($id);
        $role_id = $id;
        $role_details = $this->fetch_pre_permission($role_id);
        $role_data_list = $this->fetch_pre_permission_list($role_id);
        $data['per_list'] = $this->role_per_list();

        
        $data['actions'] = '';
        $data['manual_orders'] = '';
        $data['return_orders'] = '';
        $data['cancelled_orders'] = '';
        $data['products'] = '';
        $data['vendors'] = '';
        $data['customers'] = '';
        $data['manage_category'] = '';
        $data['blog'] = '';
        $data['slider_settings'] = '';
        $data['page_settings'] = '';
        $data['general_settings'] = '';
        $data['subscribers'] = '';
        $data['payment_overview'] = '';
        $data['report'] = '';

        if($role_details && $role_data_list){
            foreach($role_data_list as $row => $val) {
                $actions = array();
                // manual order --
                $actions['to'] = ( ($val->to_actions != '') ? explode(',', $val->to_actions) : '');
                $actions['oo'] = ( ($val->oo_actions != '') ? explode(',', $val->oo_actions) : '');
                $actions['op'] = ( ($val->op_actions != '') ? explode(',', $val->op_actions) : '');
                $actions['rfp'] = ( ($val->rfp_actions != '') ? explode(',', $val->rfp_actions) : '');
                $actions['it'] = ( ($val->it_actions != '') ? explode(',', $val->it_actions) : '');
                $actions['delv'] = ( ($val->delv_actions != '') ? explode(',', $val->delv_actions) : '');

                // return order -------
                $actions['rro'] = ( ($val->rro_actions != '') ? explode(',', $val->rro_actions) : '');
                $actions['vro'] = ( ($val->vro_actions != '') ? explode(',', $val->vro_actions) : '');

                // cancelled order ------
                $actions['rco'] = ( ($val->rco_actions != '') ? explode(',', $val->rco_actions) : '');
                $actions['vco'] = ( ($val->vco_actions != '') ? explode(',', $val->vco_actions) : '');

                // product ---------
                $actions['pl'] = ( ($val->pl_actions != '') ? explode(',', $val->pl_actions) : '');

                // vendor ------
                $actions['pv'] = ( ($val->pv_actions != '') ? explode(',', $val->pv_actions) : '');
                $actions['pvd'] = ( ($val->pvd_actions != '') ? explode(',', $val->pvd_actions) : '');
                $actions['pvdc'] = ( ($val->pvdc_actions != '') ? explode(',', $val->pvdc_actions) : '');

                // Customer ---
                $actions['pc'] = ( ($val->pc_actions != '') ? explode(',', $val->pc_actions) : '');
                $actions['ac'] = ( ($val->ac_actions != '') ? explode(',', $val->ac_actions) : '');

                // Manage Category ----------
                $actions['mc'] = ( ($val->mc_actions != '') ? explode(',', $val->mc_actions) : '');
                $actions['sc'] = ( ($val->sc_actions != '') ? explode(',', $val->sc_actions) : '');
                $actions['cc'] = ( ($val->cc_actions != '') ? explode(',', $val->cc_actions) : '');

                // Blog ---------
                $actions['bsc'] = ( ($val->bsc_actions != '') ? explode(',', $val->bsc_actions) : '');
                $actions['bst'] = ( ($val->bst_actions != '') ? explode(',', $val->bst_actions) : '');
                $actions['poli'] = ( ($val->poli_actions != '') ? explode(',', $val->poli_actions) : '');
                $actions['ooff'] = ( ($val->ooff_actions != '') ? explode(',', $val->ooff_actions) : '');

                // Slider settings ---
                $actions['ssl'] = ( ($val->ssl_actions != '') ? explode(',', $val->ssl_actions) : '');

                // Page Settings ---------
                $actions['faqpage'] = ( ($val->faqpage_actions != '') ? explode(',', $val->faqpage_actions) : '');
                $actions['blpage'] = ( ($val->blpage_actions != '') ? explode(',', $val->blpage_actions) : '');
                $actions['hbpage'] = ( ($val->hbpage_actions != '') ? explode(',', $val->hbpage_actions) : '');
                $actions['nhspage'] = ( ($val->nhpage_actions != '') ? explode(',', $val->nhpage_actions) : '');
                $actions['nmspage'] = ( ($val->nmpage_actions != '') ? explode(',', $val->nmpage_actions) : '');
                $actions['bspage'] = ( ($val->bspage_actions != '') ? explode(',', $val->bspage_actions) : '');
                $actions['nsbpage'] = ( ($val->nsbpage_actions != '') ? explode(',', $val->nsbpage_actions) : '');
                $actions['lhbpage'] = ( ($val->lhbpage_actions != '') ? explode(',', $val->lhbpage_actions) : '');
                $actions['aupage'] = ( ($val->aupage_actions != '') ? explode(',', $val->aupage_actions) : '');
                $actions['cupage'] = ( ($val->cupage_actions != '') ? explode(',', $val->cupage_actions) : '');

                // Social Settings ---------
                $actions['sslink'] = ( ($val->sslink_actions != '') ? explode(',', $val->sslink_actions) : '');

                // General Settings -------
                $actions['logo'] = ( ($val->logo_actions != '') ? explode(',', $val->logo_actions) : '');
                $actions['favicon'] = ( ($val->favicon_actions != '') ? explode(',', $val->favicon_actions) : '');
                $actions['wcgeneral'] = ( ($val->wcgeneral_actions != '') ? explode(',', $val->wcgeneral_actions) : '');
                $actions['psgeneral'] = ( ($val->psgeneral_actions != '') ? explode(',', $val->psgeneral_actions) : '');
                $actions['plgeneral'] = ( ($val->plgeneral_actions != '') ? explode(',', $val->plgeneral_actions) : '');
                $actions['sigeneral'] = ( ($val->sigeneral_actions != '') ? explode(',', $val->sigeneral_actions) : '');
                $actions['augeneral'] = ( ($val->augeneral_actions != '') ? explode(',', $val->augeneral_actions) : '');
                $actions['offageneral'] = ( ($val->offageneral_actions != '') ? explode(',', $val->offageneral_actions) : '');
                $actions['footer'] = ( ($val->footer_actions != '') ? explode(',', $val->footer_actions) : '');

                // Subscribers -------
                $actions['subslist'] = ( ($val->subslist_actions != '') ? explode(',', $val->subslist_actions) : '');

                // Manage Roles --------
                $actions['mrlrole'] = ( ($val->mrlrole_actions != '') ? explode(',', $val->mrlrole_actions) : '');

                
                // Payment Overview ---------
                $actions['apov'] = ( ($val->apov_actions != '') ? explode(',', $val->apov_actions) : '');
                $actions['vpov'] = ( ($val->vpov_actions != '') ? explode(',', $val->vpov_actions) : '');
                
                // Report Overview ---------
                $actions['psreport'] = ( ($val->psreport_actions != '') ? explode(',', $val->psreport_actions) : '');
                $actions['soreport'] = ( ($val->soreport_actions != '') ? explode(',', $val->soreport_actions) : '');
            }

            $data['id'] = $role_details[0]->id;
            $data['role_id'] = $role_details[0]->role_id;
            $data['actions'] = $actions;
            $data['manual_orders'] = ( ($role_details[0]->manual_orders != '') ? explode(',', $role_details[0]->manual_orders) : '' );
            $data['return_orders'] = ( ($role_details[0]->return_orders != '') ? explode(',', $role_details[0]->return_orders) : '' );
            $data['cancelled_orders'] = ( ($role_details[0]->cancelled_orders != '') ? explode(',', $role_details[0]->cancelled_orders) : '' );
            $data['products'] = ( ($role_details[0]->products != '') ? explode(',', $role_details[0]->products) : '' );
            $data['vendors'] = ( ($role_details[0]->vendors != '') ? explode(',', $role_details[0]->vendors) : '' );
            $data['customers'] = ( ($role_details[0]->customers != '') ? explode(',', $role_details[0]->customers) : '' );
            $data['manage_category'] = ( ($role_details[0]->manage_category != '') ? explode(',', $role_details[0]->manage_category) : '' );
            $data['blog'] = ( ($role_details[0]->blog != '') ? explode(',', $role_details[0]->blog) : '' );
            $data['slider_settings'] = ( ($role_details[0]->slider_settings != '') ? explode(',', $role_details[0]->slider_settings) : '' );
            $data['page_settings'] = ( ($role_details[0]->page_settings != '') ? explode(',', $role_details[0]->page_settings) : '' );
            $data['social_settings'] = ( ($role_details[0]->social_settings != '') ? explode(',', $role_details[0]->social_settings) : '' );
            $data['general_settings'] = ( ($role_details[0]->general_settings != '') ? explode(',', $role_details[0]->general_settings) : '' );
            $data['subscribers'] = ( ($role_details[0]->subscribers != '') ? explode(',', $role_details[0]->subscribers) : '' );
            $data['manage_roles'] = ( ($role_details[0]->manage_roles != '') ? explode(',', $role_details[0]->manage_roles) : '' );
            $data['payment_overview'] = ( ($role_details[0]->payment_overview != '') ? explode(',', $role_details[0]->payment_overview) : '' );
            $data['report'] = ( ($role_details[0]->report != '') ? explode(',', $role_details[0]->report) : '' );
        }

        
        return view('admin.permissioncreateform', compact('role', 'data', 'role_details', 'role_data_list'));
    }

    public function fetch_pre_permission($role_id){
        $result = DB::table('role_permissions')->select('*')->where('role_id', $role_id)->get()->toArray();
        return $result;
    }

    public function fetch_pre_permission_list($role_id) {
        $result = DB::table('role_permissions as rp')
                ->select('l.to_actions', 'l.oo_actions', 'l.op_actions', 'l.rfp_actions', 'l.it_actions', 'l.delv_actions', 'l.rro_actions',
                        'l.vro_actions', 'l.rco_actions', 'l.vco_actions', 'l.pl_actions', 'l.pv_actions', 'l.pvd_actions', 'l.pvdc_actions',
                        'l.pc_actions', 'l.ac_actions', 'l.mc_actions', 'l.sc_actions', 'l.cc_actions', 'l.bsc_actions', 'l.bst_actions',
                        'l.poli_actions', 'l.ooff_actions', 'l.ssl_actions', 'l.faqpage_actions', 'l.blpage_actions', 'l.hbpage_actions',
                        'l.nhpage_actions', 'l.nmpage_actions', 'l.bspage_actions', 'l.nsbpage_actions', 'l.lhbpage_actions', 'l.aupage_actions',
                        'l.cupage_actions', 'l.sslink_actions', 'l.logo_actions', 'l.favicon_actions', 'l.wcgeneral_actions', 'l.psgeneral_actions',
                        'l.plgeneral_actions', 'l.sigeneral_actions', 'l.augeneral_actions', 'l.offageneral_actions', 'l.footer_actions',
                        'l.subslist_actions', 'l.mrlrole_actions', 'l.apov_actions', 'l.vpov_actions', 'l.psreport_actions', 'l.soreport_actions')
                ->leftjoin('role_permissions_list as l', 'rp.id', 'l.rol_perm_id')
                ->where('rp.role_id', $role_id)
                ->get()->toArray();
        return $result;
    }

    public function role_per_list()
    {
        $result = DB::table('role_permission_master')->get()->toArray();
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    public function storerole(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles,role',
        ]);

        $input = $request->all();
        $role = new Role();
        $role->role = $input['role'];
        $role->status = $input['status'];
        $role->save();

        return redirect('admin/manageroles')->with('message', 'New Role Added Successfully.');
    }

    public function allot_actions($array, $id) {
        $action = array();
        
        // print_r($array);die();
        foreach($array as $row => $val) {
            $actions = explode('_', $val);
            if($actions[0] == $id) {
                foreach($actions as $rows => $r_act) {
                    $action[] = ( (!is_numeric($r_act)) ? $r_act : '');
                }
            }
        }
       
        $action_data = array_filter($action);

        if(!empty($action_data)) return implode(',',$action_data);
        else return false;
    }

    public function permissionStore(Request $request) {

        $role_list_details = DB::table('role_permission_master')->orderBy('id', 'asc')->get();

        if( (isset($_POST['is_admin'])) && ($_POST['is_admin'] != '') ) $is_admin = ( ($_POST['is_admin'] == 'Admin') ? 'Y' : 'N' );
        else $is_admin = 'N';

        // echo "<pre>";
        // print_r($actions['to_actions']);
        // die();
        
        $manual_orders_list = array();
        $return_orders_list = array();
        $cancel_orders_list = array();
        $product_list = array();
        $vendor_product_list = array();
        $customers_list = array();
        $manage_category_list = array();
        $blog_list = array();
        $slider_settings_list = array();
        $page_settings_list = array();
        $social_settings_list = array();
        $general_settings_list = array();
        $subscribers_list = array();
        $manage_roles_list = array();
        $payment_overview_list = array();
        $report_list = array();
        
        foreach($role_list_details as $row => $key) {
            if($key->module_name == 'Manual Orders')  {
                if($key->short_name == 'to') {
                    // print_r($actions);die();
                    $actions['to_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['to_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'oo') {
                    $actions['oo_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['oo_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'op') {
                    $actions['op_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['op_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'rfp') {
                    $actions['rfp_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['rfp_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'it') {
                    $actions['it_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['it_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'delv') {
                    $actions['delv_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manual_orders_list[] = ( (!empty($actions['delv_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Return Orders')  {
                if($key->short_name == 'rro') {
                    $actions['rro_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $return_orders_list[] = ( (!empty($actions['rro_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'vro') {
                    $actions['vro_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $return_orders_list[] = ( (!empty($actions['vro_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Cancelled Orders')  {
                if($key->short_name == 'rco') {
                    $actions['rco_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $cancel_orders_list[] = ( (!empty($actions['rco_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'vco') {
                    $actions['vco_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $cancel_orders_list[] = ( (!empty($actions['vco_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Products')  {
                if($key->short_name == 'pl') {
                    $actions['pl_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $product_list[] = ( (!empty($actions['pl_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Vendors')  {
                if($key->short_name == 'pv') {
                    $actions['pv_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $vendor_product_list[] = ( (!empty($actions['pv_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'pvd') {
                    $actions['pvd_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $vendor_product_list[] = ( (!empty($actions['pvd_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'pvdc') {
                    $actions['pvdc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $vendor_product_list[] = ( (!empty($actions['pvdc_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Customers')  {
                if($key->short_name == 'pc') {
                    $actions['pc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $customers_list[] = ( (!empty($actions['pc_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'ac') {
                    $actions['ac_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $customers_list[] = ( (!empty($actions['ac_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Manage Category')  {
                if($key->short_name == 'mc') {
                    $actions['mc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manage_category_list[] = ( (!empty($actions['mc_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'sc') {
                    $actions['sc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manage_category_list[] = ( (!empty($actions['sc_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'cc') {
                    $actions['cc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manage_category_list[] = ( (!empty($actions['cc_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Blog')  {
                if($key->short_name == 'bsc') {
                    $actions['bsc_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $blog_list[] = ( (!empty($actions['bsc_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'bst') {
                    $actions['bst_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $blog_list[] = ( (!empty($actions['bst_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'poli') {
                    $actions['poli_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $blog_list[] = ( (!empty($actions['poli_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'ooff') {
                    $actions['ooff_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $blog_list[] = ( (!empty($actions['ooff_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Slider Settings')  {
                if($key->short_name == 'ssl') {
                    $actions['ssl_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $slider_settings_list[] = ( (!empty($actions['ssl_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Page Settings')  {
                if($key->short_name == 'faqpage') {
                    $actions['faqpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['faqpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'blpage') {
                    $actions['blpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['blpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'hbpage') {
                    $actions['hbpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['hbpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'nhspage') {
                    $actions['nhpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['nhpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'nmspage') {
                    $actions['nmpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['nmpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'bspage') {
                    $actions['bspage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['bspage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'nsbpage') {
                    $actions['nsbpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['nsbpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'lhbpage') {
                    $actions['lhbpage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['lhbpage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'aupage') {
                    $actions['aupage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['aupage_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'cupage') {
                    $actions['cupage_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $page_settings_list[] = ( (!empty($actions['cupage_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Social Settings')  {
                if($key->short_name == 'sslink') {
                    $actions['sslink_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $social_settings_list[] = ( (!empty($actions['sslink_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'General Settings')  {
                if($key->short_name == 'logo') {
                    $actions['logo_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['logo_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'favicon') {
                    $actions['favicon_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['favicon_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'wcgeneral') {
                    $actions['wcgeneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['wcgeneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'psgeneral') {
                    $actions['psgeneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['psgeneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'plgeneral') {
                    $actions['plgeneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['plgeneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'sigeneral') {
                    $actions['sigeneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['sigeneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'augeneral') {
                    $actions['augeneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['augeneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'offageneral') {
                    $actions['offageneral_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['offageneral_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'footer') {
                    $actions['footer_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $general_settings_list[] = ( (!empty($actions['footer_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Subscribers')  {
                if($key->short_name == 'subslist') {
                    $actions['subslist_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $subscribers_list[] = ( (!empty($actions['subslist_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Manage Roles')  {
                if($key->short_name == 'mrlrole') {
                    $actions['mrlrole_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $manage_roles_list[] = ( (!empty($actions['mrlrole_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Payment Overview')  {
                if($key->short_name == 'apov') {
                    $actions['apov_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $payment_overview_list[] = ( (!empty($actions['apov_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'vpov') {
                    $actions['vpov_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $payment_overview_list[] = ( (!empty($actions['vpov_actions'])) ? strtoupper($key->short_name) : '');
                }
            }

            if($key->module_name == 'Report')  {
                if($key->short_name == 'psreport') {
                    $actions['psreport_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $report_list[] = ( (!empty($actions['psreport_actions'])) ? strtoupper($key->short_name) : '');
                }
                if($key->short_name == 'soreport') {
                    $actions['soreport_actions'] = $this->allot_actions($_POST['actions'], $key->id);
                    $report_list[] = ( (!empty($actions['soreport_actions'])) ? strtoupper($key->short_name) : '');
                }
            }
        }

        $manual_orders_list = ((!empty($manual_orders_list)) ? implode(',', array_filter($manual_orders_list)) : '');
        $return_orders_list = ( (!empty($return_orders_list)) ? implode(',', array_filter($return_orders_list)) : '');
        $cancel_orders_list = ( (!empty($cancel_orders_list)) ? implode(',', array_filter($cancel_orders_list)) : '');
        $product_list = ((!empty($product_list)) ? implode(',', array_filter($product_list)) : '');
        $vendor_product_list = ( (!empty($vendor_product_list)) ? implode(',', array_filter($vendor_product_list)) : '');
        $customers_list = ((!empty($customers_list)) ? implode(',', array_filter($customers_list)) : '');
        $manage_category_list = ((!empty($manage_category_list)) ? implode(',', array_filter($manage_category_list)) : '');
        $blog_list = ((!empty($blog_list)) ? implode(',', array_filter($blog_list)) : '');
        $slider_settings_list = ((!empty($slider_settings_list)) ? implode(',', array_filter($slider_settings_list)) : '');
        $page_settings_list = ((!empty($page_settings_list)) ? implode(',', array_filter($page_settings_list)) : '');
        $social_settings_list = ((!empty($social_settings_list)) ? implode(',', array_filter($social_settings_list)) : '');
        $general_settings_list = ((!empty($general_settings_list)) ? implode(',', array_filter($general_settings_list)) : '');
        $subscribers_list = ((!empty($subscribers_list)) ? implode(',', array_filter($subscribers_list)) : '');
        $manage_roles_list = ((!empty($manage_roles_list)) ? implode(',', array_filter($manage_roles_list)) : '');
        $payment_overview_list = ((!empty($payment_overview_list)) ? implode(',', array_filter($payment_overview_list)) : '');
        $report_list = ((!empty($report_list)) ? implode(',', array_filter($report_list)) : '');
        
        $insert_data = array(
            'role_id' => $_POST['role'],
            'is_admin' => $is_admin,
            'manual_orders' => $manual_orders_list,
            'return_orders' => $return_orders_list,
            'cancelled_orders' => $cancel_orders_list,
            'products' => $product_list,
            'vendors' => $vendor_product_list,
            'customers' => $customers_list,
            'manage_category' => $manage_category_list,
            'blog' => $blog_list,
            'slider_settings' => $slider_settings_list,
            'page_settings' => $page_settings_list,
            'social_settings' => $social_settings_list,
            'general_settings' => $general_settings_list,
            'subscribers' => $subscribers_list,
            'manage_roles' => $manage_roles_list,
            'payment_overview' => $payment_overview_list,
            'report' => $report_list,
        );

        $insert_data_list = array(
            'action' => $actions
        );

        $chck_data = $this->check_permission_exit($_POST['role']);
        if($chck_data) {
            $result = $this->update_permission($insert_data, $insert_data_list['action'], $chck_data);
            if($result) {
                return redirect('admin/manageroles')->with('message','Permission Update Successfully !!!');
            }
            else{
                return redirect()->back()->with('error','Server error, cannot set permission !!!');
            }
        } else {
            $result = $this->insert_permission($insert_data, $insert_data_list['action']);
            if($result){
                return redirect('admin/manageroles')->with('message','Permission Added Successfully !!!');
            }
            else{
                return redirect()->back()->with('error','Server error, cannot set permission !!!');
            }
        }
    }

    public function check_permission_exit($role) {
        $result = DB::table('role_permissions')->where('role_id', $role)->get();

        $query = count($result);
        if($query > 0) {
            return $result[0]->id;
        }else {
            return false;
        }
    }

    public function update_permission($data, $action_data, $id)
    {
        try{
            $result = DB::table('role_permissions')->where('id', $id)->update($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return false;
        }
        
        $table = DB::table('role_permissions_list')->where('rol_perm_id', $id)->update($action_data);
        if($table) return true;
        else return false;
    }

    function insert_permission($data , $action_data)
    {
        $result = DB::table('role_permissions')->insert($data);
        if($result){
            $table = DB::table('role_permissions')->select('id')->orderBy('id', 'DESC')->limit(1)->get()->toArray();
            if($table[0]->id != ''){
                $action_data['rol_perm_id'] = $table[0]->id;
                $result2 = DB::table('role_permissions_list')->insert($action_data);
                if($result2) return true;
                else return false;
            }
        }
    }
}