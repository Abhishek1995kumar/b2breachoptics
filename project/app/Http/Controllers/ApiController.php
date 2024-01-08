<?php

namespace App\Http\Controllers;
use App\UserProfile;
use Illuminate\Http\Request;
use DB;
use Hash;
use Mail;
use Auth;
use Session;
use validate;
use Sentinel;
use Response;
use Validator;
use DataTables;

use App\Category;
use GuzzleHttp\Client;
use App\Gallery;
use App\ProductAttr;
use App\ProductGallery;
use App\OrderedProducts;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    protected $authentication_keys = ['jam', 'jamz1591'];
    protected $eyevam_api_base_url = "http://b2berp.optical-hut.com/api/";
    protected $opticalhut_erp_url = "http://b2berp.optical-hut.com/api/";
    protected $eyevam_erp_url = "https://eyevam.in/api/";
  // protected $erp_site_url = 'http://localhost/eyevam_git';
 

    public function __construct()
    {
    }
    // For getting ProductDetails by ID
    public function getProductDetails($id)
    {
        $apifunctionname = "getProductDetails";
        $form_data = ['id' => $id];
        $response = $this->get_api_data($apifunctionname, $form_data);
        return $response;
    }

    // ERP B2B API Common Connection 
    public function get_api_data($apifunctionname=true, $api_data=true)
    {
        $client = new Client();
        $api_type = "POST"; // $api_type = "POST"; // API Types : POST , GET
        $api_url = $this->eyevam_api_base_url.$apifunctionname;  // ERP API URL
        $response = $client->request($api_type, $api_url, [
            'auth' => $this->authentication_keys,
            'form_params' => $api_data
        ]);
        $response = json_decode($response->getBody()->getContents());
        return $response;
    }
    
    // for opticalhut - b2b- erp api start
    public function get_erp_api_data($apifunctionname=true, $api_type=true, $api_data=true) {
        print_r($api_data); die();
      $client = new Client();
      $api_url = $this->eyevam_erp_url.$apifunctionname;
      $response = $client->request($api_type, $api_url, [
        'auth' => $this->authentication_keys,
        'form_params' => $api_data
      ]);
      
      $response = json_decode($response->getBody()->getContents(), true);
      return $response;
    }
    
    public function get_opticalhut_api_data($apifunctionname=true, $api_type=true, $api_data=true) {
        $client = new Client();
        $api_url = $this->opticalhut_erp_url.$apifunctionname;
        $response = $client->request($api_type, $api_url, [
          'auth' => $this->authentication_keys,
          'form_params' => $api_data
        ]);
        $response = json_decode($response->getBody()->getContents(), true);
        return $response;
    }
    // for opticalhut - b2b- erp api end

    // For getting Home page Product
    public function getHomePageProduct($fieldname)
    {
        $apifunctionname = "getHomePageProduct";
        $form_data = ['fieldname' => $fieldname];
        $response = $this->get_api_data($apifunctionname, $form_data);

        return $response;
    }

    public function getPrescription($id, $color)
    {
        $apifunctionname = "getPrescription";
        $form_data = ['id' => $id, 'color' => $color];
        $response = $this->get_api_data($apifunctionname, $form_data);

        return $response;
    }

    public function getonlyattr($id, $color)
    {
        $apifunctionname = "getonlyattr";
        $form_data = ['id' => $id, 'color' => $color];
        $response = $this->get_api_data($apifunctionname, $form_data);

        return $response;
    }
    
    public function getCategory($id, $subid)
    {
        $apifunctionname = "getCategory";
        $form_data = ['id' => $id, 'subid' => $subid];
        $response = $this->get_api_data($apifunctionname, $form_data);
        return $response;
    }
    
    public function category_filter($colors, $frametype, $frame_shap, $make, $gender)
    {
        $apifunctionname = "category_filter";
        $form_data = ['color' => $colors, 'frametype' => $frametype, 'frame_shap' => $frame_shap, 'make' => $make, 'gender' => $gender];
        $response = $this->get_api_data($apifunctionname, $form_data);
        return $response;
    }
    
    public function getNewCategory($id, $child)
    {
        $apifunctionname = "getNewCategory";
        $form_data = ['id' => $id, 'child' => $child];
        $response = $this->get_api_data($apifunctionname, $form_data);
        return $response;
    }

    public function loadCategory($id, $subid, $child, $skip)
    {
        $apifunctionname = "loadCategory";
        $form_data = ['id' => $id, 'subid' => $subid, 'child' => $child, 'skip' => $skip];

        // echo "<pre>";
        // print_r($form_data);
        // die();
        $response = $this->get_api_data($apifunctionname, $form_data);
        return $response;
    }
    
    
    // start getting optical hut sales and saving on b2b 
    public function getOpticalHubSales(Request $request) {
        // print_r($request->all()); die();
        $response = array("status" => "0", "register" => "Validation error");
        $rules = [
                    'id' => 'required'                
                ];                    
        $messages = array(
                    'id.required' => "id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
              $message = '';
              $messages_l = json_decode(json_encode($validator->messages()), true);
              foreach ($messages_l as $msg) {
                     $message .= $msg[0] . ", ";
              }
              $response['msg'] = $message;
        } else {
                $ins_arr = array(
                    "salesorderid" => $request->get("id"),
                    "salesorderdate" => $request->get("salesorderdate"),
                    "customer_name" => $request->get("customer_name"),
                    "customer_phone" => $request->get("customer_phone"),
                    "txtTotalQuantity" => $request->get("txtTotalQuantity"),
                    "txtMRPGrossTotal" => $request->get("txtMRPGrossTotal")
                );

                DB::table('opticalhutsalesorders')->insert($ins_arr);
                $response = array("status" =>1, "msg" => "Order Added");
       }
       return Response::json($response);
    }
    
    // end getting optical hut sales and saving on b2b 



    
}
