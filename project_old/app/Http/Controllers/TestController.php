<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use App\Product;
use App\Vendors;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Http;


class TestController extends Controller {

    public function __construct()
    {
        
    }

    function generateShipRocketToken(){
        date_default_timezone_set('Asia/Kolkata');
        $param = array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"email\": \"kaushik.elrica@gmail.com\",\n    \"password\": \"Goodday@1\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        );
        $curl = curl_init();
        curl_setopt_array($curl, $param);
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);

        if($SR_login_Response_out) {
            $token = $SR_login_Response_out->{'token'};
        }
        
        // echo "<pre>";
        // print_r($token);
        // die();
        
        return $token;
    }
    
    
    public function create_order($id) {
        $token_no = $this->generateShipRocketToken();
        
        $order_id = DB::table('ordered_products as oo')
                ->select('oo.orderid')
                ->where('id',$id)->get();
                
        $order_id = $order_id[0]->orderid;
             
        $get_order_data = DB::table('orders as o')
            ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock', 'op.cost')
            ->leftjoin('products as p', 'o.products', '=', 'p.id')
            ->leftjoin('ordered_products as op', 'o.id', '=', 'op.orderid')
            ->where('o.id', $order_id)->get();
            
        // echo "<pre>";
        // print_r($get_order_data);
        // die();
        
        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) {
                $data['order_id'] = $val->id;
                $data['order_date'] = $val->booking_date;
                $data['pickup_location'] = 'Primary';
                $data["channel_id"] =  "";
                $data["comment"] = "Reseller: M/s Goku";
                if($val->customer_name != '') {
                    if(str_contains($val->customer_name, ' ') === true) {
                    // print_r($val->customer_name);die();
                        $name = explode(' ', $val->customer_name);
                        $data['billing_customer_name'] = $name[0];
                        $data['billing_last_name'] = $name[1];
                    } else {
                        $data['billing_customer_name'] = $val->customer_name;
                    }
                } else $data['billing_last_name'] = '';

                $data['billing_address']  = $val->customer_address;
                $data['billing_address2'] = $val->customer_address2;
                $data['billing_city']     = $val->customer_city;
                $data['billing_pincode']  = $val->customer_zip;
                $data['billing_state']    = $val->customer_state;
                $data['billing_country']  = $val->customer_country;
                $data['billing_email']    = $val->customer_email;
                $data['billing_phone']    = $val->customer_phone;

                if( isset($val->shipping_is_billing) && ($val->shipping_is_billing != '')) {
                    $data['shipping_is_billing'] = $val->shipping_is_billing;
                }
                else $data['shipping_is_billing'] = true;
                
                if($val->shipping_name == '') {
                    $data["shipping_customer_name"] = $data["shipping_last_name"] = $data["shipping_address"] = $data["shipping_address_2"] = $data["shipping_city"] = $data["shipping_pincode"] = '';
                    $data["shipping_country"] = $data["shipping_state"] = $data["shipping_email"] = $data["shipping_phone"] = '';
                } else {
                    if($val->shipping_name != '') {
                        if(str_contains($val->shipping_name, ' ') === true) {
                            $name = explode(' ', $val->shipping_name);
                            $data['shipping_customer_name'] = $name[0];
                            $data['shipping_last_name'] = $name[1];
                        } else $data['shipping_customer_name'] = $val->shipping_name;
                    }else $data['shipping_last_name'] = '';

                    $data["shipping_address"] = $val->shipping_address;
                    $data["shipping_address_2"] = $val->shipping_address2;
                    $data["shipping_city"] = $val->shipping_city;
                    $data["shipping_pincode"] = $val->shipping_zip;
                    $data["shipping_country"] = $val->shipping_country;
                    $data["shipping_state"] = $val->shipping_state;
                    $data["shipping_email"] = $val->shipping_email;
                    $data["shipping_phone"] = $val->shipping_phone;
                }

                $data['order_items'][] = [
                    "name" => $val->title,
                    "sku" => (($val->productsku != '') ? $val->productsku : 'chakra123'),
                    "units" => $val->quantities,
                    "selling_price" => $val->price,
                    "discount" => '',
                    "tax" => '',
                    "hsn" => $val->hsncode,
                ];

                $data['payment_method'] = 'Prepaid'; //$val->method;
                $data['shipping_charges'] = ((is_numeric($val->shipping)) ? $val->shipping : '0');
                $data['giftwrap_charges'] = '0';
                $data['transaction_charges'] = '0';
                $data['total_discount'] = '0';
                $data['sub_total'] = $val->pay_amount;
                $data['length'] = '10';//$val->length;
                $data['breadth'] = '10';//$val->breadth;
                $data['height'] = '6'; //$val->height;
                
                if($val->weight != '') {
                    $data['weight'] = $val->weight/1000;
                } else $data['weight'] = '';
            }
            
            // echo "<pre>";
            // print_r($data);
            // die();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            // echo "<pre>";
            // print_r($param);
            // die();

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(!isset($SR_generate_order_out->errors)) {
                
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'api_order_id' => $SR_generate_order_out->order_id,
                    'shipment_id' => $SR_generate_order_out->shipment_id,
                    'status' => $SR_generate_order_out->status,
                    'status_code' => $SR_generate_order_out->status_code,
                    'onboarding_completed_now' => $SR_generate_order_out->onboarding_completed_now,
                    'awb_code' => $SR_generate_order_out->awb_code,
                    'courier_company_id' => $SR_generate_order_out->courier_company_id,
                    'courier_name' => $SR_generate_order_out->courier_name,
                );
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->insert($insert_data);

            return back()->with('message', 'Shiprocket order create successfully.');
        }
    }
    
    // courier serviceability check function by Prashant --------------------------------
    
    public function check_courier_serviceability($order_id) {
        $token_no = $this->generateShipRocketToken();
        
        if($token_no == '') {
            echo json_encode(array('status' => 500, 'msg' => "Error Generating Token"));
            return false;
        }    
        
        // DB::enableQueryLog();
        $chck_api_order_id = DB::table('api_temp_resp')->where('order_id', $request->order_no)->get();

        if($che_api_order_id) {
            $get_order_data = DB::table('orders as o')
            ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock','a.status', 'a.status_code', 'a.created_at','a.awb_code', 'vp.zip')
            ->leftjoin('products as p', 'o.products', '=', 'p.id')
            ->leftjoin('api_temp_resp as a', 'o.id', '=', 'a.order_id')
            ->leftjoin('vendor_profiles as vp', 'o.vendorid', '=', 'vp.id')
            ->where('o.id', $order_id)
            ->get();

            if(!$get_order_data) {
                echo json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
                return false;
            } else {
                foreach($get_order_data as $rows => $val) {
                    $data['pickup_postcode'] = $val->zip;
                    $data['delivery_postcode'] = $val->customer_zip;
                    $data['weight'] = $val->weight;
                    if($val->order_payment_method == 'COD'){
                        $data['cod'] = 0;
                    }else $data['cod'] = 1;

                }

                $param = array(
                    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer ".$token_no,
                    ),
                );

                $curl = curl_init();
                curl_setopt_array($curl, $param);

                $SR_generate_order = curl_exec($curl);
                curl_close($curl);
                
                $SR_generate_order_out = json_decode($SR_generate_order);

                return $SR_generate_order_out;
            }
        }

    }
    
    // courier_order code start by Prashant ---------------------------------------------
    
    public function courier_order(Request $request, $order_id) {
        $token_no = $this->generateShipRocketToken();
                    
                
        // echo "<pre>";
        // print_r($order_id);
        // die();

    //   DB::enableQueryLog();
        
        $get_order_dataa = DB::table('api_temp_resp as ap')
            ->select('ap.*', 'o.customer_phone', 'o.customer_zip')
            ->leftjoin('orders as o', 'ap.order_id', 'o.id')
            ->where('order_id', $order_id)->get()->toArray();
        
        $id = ($get_order_dataa[0]->order_id);
        
        if(!$get_order_dataa) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            $data['courier_id'] = $request->courier_id;
            foreach($get_order_dataa as $rows => $val) {
                $data['shipment_id']=$val->shipment_id;
                $data['delivery_postcode'] = $val->customer_zip;
            }
            

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order, true);
            print_r($SR_generate_order_out);die();
            if(isset($SR_generate_order_out['status_code']) == 400){
                return back()->with('error', $SR_generate_order_out['message']);
            }else {
                if(!isset($SR_generate_order_out->errors)) {
                    if($SR_generate_order_out['awb_assign_status'] == 1){
                        
                        foreach($SR_generate_order_out['response'] as $value){
                               
                            $insert_data = array(
                                    'courier_company_id' => $value['courier_company_id'],
                                    'awb_code' => $value['awb_code'],
                                    'status' => "READY TO SHIP",
                                    'courier_name' => $value['courier_name'],
                                    'invoice_number' => $value['invoice_no'],
                                );
                            
                        }
                        
                    }else {
                        foreach($SR_generate_order_out['response'] as $key=>$value){
                            $insert_data = array(
                                    'awb_assign_error' => $value['awb_assign_error'],
                                );
                            
                        }
                        return back()->with('error', $insert_data['awb_assign_error']);
                    }
    
                } else {
                    $insert_data = array(
                        'order_id' => $data['order_id'],
                        'status_code' => $SR_generate_order_out->status_code,
                        'error' => json_encode($SR_generate_order_out->errors),
                    );
                    
                    return back()->with('error', $insert_data['error']);
                }
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update(['courier_company_id'=>$insert_data['courier_company_id'], 'awb_code'=>$insert_data['awb_code'], 'invoice_number'=>$insert_data['invoice_number'], 'courier_name'=>$insert_data['courier_name'], 'status'=>$insert_data['status']]);
            
            return back()->with('message', 'Shiprocket courier selection successfully.');
        }
    }
    
    
    // generate pickups date code start by Prashant ---------------------------------------------
    
    public function pickup_date($order_id){
        $token_no = $this->generateShipRocketToken();
        
        $getData = DB::table('api_temp_resp as atr')
        ->select('atr.*', 'op.book_slot_date', 'op.book_slot_time')
        ->leftjoin('ordered_products as op', 'atr.order_id', '=', 'op.orderid')
        ->where('atr.order_id', $order_id)
        ->get()->toArray();
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            
            foreach($getData as $rows => $val) {
                $data['shipment_id'][] = $val->shipment_id;
                $data['pickup_date'][] = $val->book_slot_date;
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/generate/pickup",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order, true);
            
            if(!isset($SR_generate_order_out->errors)) {
                if($SR_generate_order_out['pickup_status'] == 1) {
                    foreach($SR_generate_order_out as $value){
                        $insert_data = array(
                            'pickup_scheduled_date' => $value['pickup_scheduled_date'],
                            'pickup_token_number' => $value['pickup_token_number'],
                            'status' => $value['status'],
                        );
                    }
                    
                }else {
                    foreach($SR_generate_order_out as $value){
                        $insert_data = array(
                            'pickup_message' => $value['message'],
                        );
                    }
                    
                    $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update(['pickup_message'=>$insert_data['pickup_message'], 'status'=>$insert_data['status']]);
                
                    return back()->with('error', $insert_data['pickup_message']);
                }
                
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update(['pickup_scheduled_date'=>$insert_data['pickup_scheduled_date']]);
            
            
            return back()->with('message', 'Pickups Schedule generate successfully.');
        }
    }
    
    // generate manifest code start by Prashant ---------------------------------------------
    
    public function generate_manifest($order_id) {
        $token_no = $this->generateShipRocketToken();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get()->toArray();
        
        $id = $getData[0]->order_id;
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            
            foreach($getData as $rows => $val) {
                $data['shipment_id'][] = $val->shipment_id;
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/manifests/generate",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order, true);
            
            if(!isset($SR_generate_order_out->errors)) {
                if($SR_generate_order_out['status'] == 1) {
                    $insert_data = array(
                        'manifest_url' => $SR_generate_order_out['manifest_url'],
                    );
                }else {
                    return back()->with('error', $SR_generate_order_out['message']);
                }
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id',$id)->update(['manifest_url' => $insert_data['manifest_url']]);
            
            return back()->with('message', 'Manifest generate successfully.');
            
        }
    }
    
    // print manifest code start by Prashant ---------------------------------------------
    
    public function print_manifest($order_id) {
        $token_no = $this->generateShipRocketToken();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
        
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            
            foreach($getData as $rows => $val) {
                $data['order_ids'][] = [
                        "order_id"=>$val->order_id,
                    ];
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/manifests/print",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(!isset($SR_generate_order_out->errors)) {

                $insert_data = array(
                    'manifest_url' => $SR_generate_order_out->manifest_url,
                );
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id',$order_id)->update(['print_manifest' => $insert_data['manifest_url']]);
            
        }
    }
    
    // create_label code start by Prashant ---------------------------------------------
    
    public function create_label($order_id){
        $token_no = $this->generateShipRocketToken();
        
        DB::enableQueryLog();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            $data['channel'] = "2023611";
            foreach($getData as $rows => $val) {
                $data['order_id'] = $val->order_id;
                $data['awb_code'] = $val->awb_code;
                $data['shipment_id'][] = $val->shipment_id;
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/generate/label",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order, true);
            
            if(!isset($SR_generate_order_out->errors)) {
                if($SR_generate_order_out['label_created'] == 1) {
                    
                    $insert_data = array(
                        
                        "label_created" => $SR_generate_order_out['label_created'],
                        "label_url" => $SR_generate_order_out['label_url'],
                    );
                }else {
                    $insert_data = array(
                        
                        "label_error" => $SR_generate_order_out['message'],
                        
                    );
                    
                    $insert_resp = DB::table('api_temp_resp')->where('order_id',$order_id)->update(['label_error'=>$insert_data['label_error']]);
                    
                    return back()->with('error', $insert_data[label_error]);
                }
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id',$order_id)->update(['label_created'=>$insert_data['label_created'], 'label_url'=>$insert_data['label_url']]);
            
            return back()->with('message', $SR_generate_order_out['response']);
        }
    }
    
    // create invoice functionality by Prashant ---------------------------
    
    public function create_invoice($order_id){
        $token_no = $this->generateShipRocketToken();
        
        DB::enableQueryLog();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($getData as $rows => $val) {
                $data['ids'] = [
                        $val->api_order_id,
                    ];
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/print/invoice",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(!isset($SR_generate_order_out->errors)) {
                if($SR_generate_order_out->is_invoice_created == true) {
                    
                    $insert_data = array(
                        
                        "invoice_url" => $SR_generate_order_out->invoice_url,
                        
                    );
                }else {
                        
                    return back()->with('error', 'Invoice not generated');
                    
                }
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id',$order_id)->update(['invoice_url'=>$insert_data['invoice_url']]);
            
            return back()->with('message', 'Invoice Generate Successfully');
        }
    }
    
    // get specific order detail functionality by Prashant ----------------
    
    public function order_detail($api_order_id){
        $token_no = $this->generateShipRocketToken();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('api_order_id', $api_order_id)
        ->get();
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($getData as $rows => $val) {
            
                $param = array(
                    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/show/".$rows->api_order_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer ".$token_no,
                    ),
                );
                
                $curl = curl_init();
                curl_setopt_array($curl, $param);
                $SR_generate_order = curl_exec($curl);
                curl_close($curl);
                $SR_generate_order_out = json_decode($SR_generate_order);
                
                return $SR_generate_order_out;
            }
            
        }
    }
    
    // create invoice functionality by Prashant ---------------------------
    
    public function track_product($order_id){
        $token_no = $this->generateShipRocketToken();
        
        DB::enableQueryLog();
        
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
        
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($getData as $rows => $val) {
                $data['awbs'] = [
                        $val->awb_code,
                    ];
            }
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/awbs",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            foreach($SR_generate_order_out as $trackData){
                foreach($trackData as $track){
                
                    // echo "<pre>";
                    // print_r($track);
                    // die();
                
                    return redirect($track->track_url);
                }
            }
        }
    }
    
    
    public function Get_all_shippment($order_id) {
        $token_no = $this->generateShipRocketToken();

        DB::enableQueryLog();
        
        $get_order_data = DB::table('orders as o')
            ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock','a.status','a.created_at','a.awb_code')
            ->leftjoin('products as p', 'o.products', '=', 'p.id')
             ->leftjoin('api_temp_resp as a', 'o.products', '=', 'p.id')
             ->where('o.id', $order_id)
            ->get();        
        // dd(DB::getQueryLog());
        // dd( $get_order_data);
        
        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) {
                $data['order_id'] = $val->id;
                //$data[""] =  "";
                $data["courier"] =  "";
                $data["sr_courier"] =  "";
                $data["channel_id"] =  "";
              
                $data['invoice_number']    = $val->invoice_number;
                $data['invoice_date']    = $val->invoice_date;
                
                
                
                $data['awb_assign_date'] = "";
                $data['awb_code'] = $val->awb_code;
                $data['pickup_generated_date'] = "";
                $data['pickup_token_number'] = "";
                $data['method'] =  "Standard";
                $data['weight'] = "";
                $data['dimensions'] = '';
                $data['quantity'] = $val->quantities;
                $data['cost'] = '';
                $data['tax'] = "";
                $data['cod_charges'] = '';
                $data['total'] = $val->pay_amount;
                      
               
               
               
               
               


                $data['shipping_address'][] = [
               
                    "city" => $val->customer_city,
                    "state" => $val->customer_state,
                    "address" => $val->customer_address,
                    "country" => $val->customer_country,
                    "pincode"=> $val->customer_zip,
                    "address_2" => $val->customer_address2,
                    "company_name" => '',
                ];
      
                $data['customer_details'][] = [
               
                    "shipped_date" => '',
                    "status" => '',
                    "delivered_date" => '',
                    "returned_date" => '',
                    "label_url"=> '',
                    "manifest_url" => '',
                    "manifest_url" => '',
                    "created_at" => '',
                    "updated_at" => '',
                    
                          
                ];
      
                $data['created_at'][] = [
               
                 
                    "created_at" => '$val->created_at',
                    "timezone_type"=> 3,
                   "timezone"=> "Asia/Kolkata",
                    
                          
                ];
                
                 $data['updated_at'][] = [
               
                 
                    "updated_at" => '$val->updated_at',
                    "timezone_type"=> 3,
                   "timezone"=> "Asia/Kolkata",
                    
                          
                ];
      
                $data['payment_method'] = 'Prepaid'; //$val->method;
                //$data['status'] = $val->status;
                //$data['channel_id'] = '';
                //$data['base_channel_code'] = '';
                //$data['channel_name'] = '';
                //$data['awb_code'] = $val->awb_code;
                //$data['invoice_number']    = $val->invoice_number;
                //$data['invoice_date']    = $val->invoice_date;
                //$data['billing_phone']    = $val->customer_phone;
                //$data['shipping_charges'] = ((is_numeric($val->shipping)) ? $val->shipping : '0');
                //$data['giftwrap_charges'] = '0';
                //$data['transaction_charges'] = '0';
                //$data['total_discount'] = '0';
                //$data['sub_total'] = $val->pay_amount;
                //$data['length'] = '10';//$val->length;
                //$data['breadth'] = '15';//$val->breadth;
                //$data['height'] = '20'; //$val->height;
                
            //     if($val->weight != '') {
            //         if(str_contains($val->weight, ' ') === true) {
            //             $weight = explode(' ', $val->weight);
            //             $data['weight'] = $weight[0];
            //         }
            //     } else $data['weight'] = '10';
            }

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";die();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/shipments",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(!isset($SR_generate_order_out->errors)) {

                $insert_data = array(
                    
                    'status_code' => $SR_generate_order_out->status_code,
                    
                );
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            // $insert_resp = DB::table('api_temp_resp')->insert($insert_data);
            echo "<script>";
            echo "alert('sucessful');";
            echo "</script>";
               // alert("hi");
            // return $insert_data;
        }
    }
    
    public function update_order($order_id) {
        $token_no = $this->generateShipRocketToken();

        DB::enableQueryLog();
        
        $get_order = DB::table('orders as o')
            ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock')
            ->leftjoin('products as p', 'o.products', '=', 'p.id')
            ->where('o.id', $order_id)->get();        
        // dd(DB::getQueryLog());
        // dd( $get_order_data);
        
        if(!$get_order) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order as $rows => $val) {
                $data['order_id'] = $val->id;
                $data['order_date'] = $val->booking_date;
                $data['pickup_location'] = 'Primary';
                $data["channel_id"] =  "";
                $data["comment"] = "Reseller: M/s Goku";
                if($val->customer_name != '') {
                    if(str_contains($val->customer_name, ' ') === true) {
                        $name = explode(' ', $val->customer_name);
                        $data['billing_customer_name'] = $name[0];
                        $data['billing_last_name'] = $name[1];
                    } else {
                        $data['billing_customer_name'] = $val->customer_name;
                    }
                } else $data['billing_last_name'] = '';

                $data['billing_address']  = $val->customer_address;
                $data['billing_address2'] = $val->customer_address2;
                $data['billing_city']     = $val->customer_city;
                $data['billing_pincode']  = $val->customer_zip;
                $data['billing_state']    = $val->customer_state;
                $data['billing_country']  = $val->customer_country;
                $data['billing_email']    = $val->customer_email;
                $data['billing_phone']    = $val->customer_phone;

                if( isset($val->shipping_is_billing) && ($val->shipping_is_billing != '')) {
                    $data['shipping_is_billing'] = $val->shipping_is_billing;
                }
                else $data['shipping_is_billing'] = true;
                
                if($val->shipping_name == '') {
                    $data["shipping_customer_name"] = $data["shipping_last_name"] = $data["shipping_address"] = $data["shipping_address_2"] = $data["shipping_city"] = $data["shipping_pincode"] = '';
                    $data["shipping_country"] = $data["shipping_state"] = $data["shipping_email"] = $data["shipping_phone"] = '';
                } else {
                    if($val->shipping_name != '') {
                        if(str_contains($val->shipping_name, ' ') === true) {
                            $name = explode(' ', $val->shipping_name);
                            $data['shipping_customer_name'] = $name[0];
                            $data['shipping_last_name'] = $name[1];
                        } else $data['shipping_customer_name'] = $val->shipping_name;
                    }else $data['shipping_last_name'] = '';

                    $data["shipping_address"] = $val->shipping_address;
                    $data["shipping_address_2"] = $val->shipping_address2;
                    $data["shipping_city"] = $val->shipping_city;
                    $data["shipping_pincode"] = $val->shipping_zip;
                    $data["shipping_country"] = $val->shipping_country;
                    $data["shipping_state"] = $val->shipping_state;
                    $data["shipping_email"] = $val->shipping_email;
                    $data["shipping_phone"] = $val->shipping_phone;
                }

                $data['order_items'][] = [
                    "name" => $val->title,
                    "sku" => (($val->productsku != '') ? $val->productsku : 'chakra123'),
                    "units" => $val->quantities,
                    "selling_price" => $val->price,
                    "discount" => '',
                    "tax" => '',
                    "hsn" => $val->hsncode,
                ];

                $data['payment_method'] = 'Prepaid'; //$val->method;
                $data['shipping_charges'] = ((is_numeric($val->shipping)) ? $val->shipping : '0');
                $data['giftwrap_charges'] = '0';
                $data['transaction_charges'] = '0';
                $data['total_discount'] = '0';
                $data['sub_total'] = $val->pay_amount;
                $data['length'] = '10';//$val->length;
                $data['breadth'] = '15';//$val->breadth;
                $data['height'] = '20'; //$val->height;
                
                if($val->weight != '') {
                    if(str_contains($val->weight, ' ') === true) {
                        $weight = explode(' ', $val->weight);
                        $data['weight'] = $weight[0]/1000;
                    }
                } else $data['weight'] = '10';
            }

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";die();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/update/adhoc",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(!isset($SR_generate_order_out->errors)) {

                $update_data = array(
                    'order_id' => $data['order_id'],
                    'api_order_id' => $SR_generate_order_out->order_id,
                    'shipment_id' => $SR_generate_order_out->shipment_id,
                    'status' => $SR_generate_order_out->status,
                    'status_code' => $SR_generate_order_out->status_code,
                    'onboarding_completed_now' => $SR_generate_order_out->onboarding_completed_now,
                    'awb_code' => $SR_generate_order_out->awb_code,
                    'courier_company_id' => $SR_generate_order_out->courier_company_id,
                    'courier_name' => $SR_generate_order_out->courier_name,
                );
            } else {
                $update_data = array(
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id')->update($update_data);
            dd(DB::getQueryLog());
             dd($insert_resp);
            return $update_data;
        }
    }


    public function cancel_shipment($order_id) {
        $token_no = $this->generateShipRocketToken();

       // DB::enableQueryLog();
        
        $get_order_dataa = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
            
            
            
        // dd(DB::getQueryLog());
        // dd( $get_order_data);
        
        
        if(!$get_order_dataa) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_dataa as $rows => $val) {
                $data['awbs'][] = $val->awb_code;
               
            }

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel/shipment/awbs",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            // echo "<pre>";
            // print_r($param);
            // die();

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
             //$insert_data="hi";
            if(!isset($SR_generate_order_out->errors)) {
                foreach($get_order_dataa as $rows => $val){
                    $update_data = [
                            $val->awb_code = '',
                            $val->courier_name = '',
                            $val->awb_assign_status = '',
                            $val->courier_company_id = '',
                            $val->status_code = '',
                        ];
                }
                
                // echo "<pre>";
                // print_r($update_data);
                // die();
                
                $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update($update_data);

                return 'Bulk Shipment cancellation is in progress. Please wait for some time';
        // return redirect()->back();
                
            } else {
                $insert_data = 'Bulk Shipment cancellation is in progress. Please wait for some time';
                    echo "<script>";
                echo "alert('$insert_data);";
                echo "</script>"; 
            // return redirect()->back();
            }
            


          //  $insert_resp = DB::table('api_temp_resp')-> where->('order_id',$order_id)->(update(array('order_status'=>$insert_data));
            $insert_resp = DB::table('api_temp_resp') ->where('order_id',$order_id)->update(array('shippment_cancel' => $insert_data));




    
 
            return $insert_data;
            
        }
    }

    // cancel order functionality by Prashant ---
    
    public function cancel_order(Request $request, $order_id) {
        $token_no = $this->generateShipRocketToken();
            
        $get_order_dataa = DB::table('api_temp_resp')
                            ->select('*')
                            ->where('order_id', $order_id)
                            ->get();
        
        echo "<pre>";
        print_r($get_order_dataa);
        die();
        
        if(!$get_order_dataa) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_dataa as $rows => $val) {
                $data['ids'] = [
                        $val->api_order_id,
                    ];
              
               
            }

            echo "<pre>";
            print_r($data);
            // die();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            echo "<pre>";
            print_r($param);
            // die();

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            echo "<pre>";
            print_r($SR_generate_order);
            // die();
            
            if(!isset($SR_generate_order_out->errors)) {

                $insert_data = array(
                        'reason' => $request->reason,
                        'status_code' => $SR_generate_order_out->status,
                        'status' => "cancelled",
                        'date' => new DateTime(),
                    );
                   
                
            } else {
                return back()->with('error', $SR_generate_order_out->message);
            }
            
            // $insert_resp = DB::table('api_temp_resp')-> where->('order_id',$order_id)->(update(array('order_status'=>$insert_data));
            $insert_resp = DB::table('api_temp_resp') ->where('order_id',$order_id)->update(['status'=>$insert_data['status'], 'status_code'=>$insert_data['status_code'], 'cancel_reason' => $insert_data['reason'], 'cancel_date' => $insert_data['date']]);
            
            return back()->with('message', $SR_generate_order_out->message);
        }
    }
    
    // return create order functionality by Prashant -------------------------
    
    public function return_order($id){
        $token_no = $this->generateShipRocketToken();
        $order_id = DB::table('ordered_products as oo')
                ->select('oo.orderid')
                ->where('id',$id)->get();
        $order_id = $order_id[0]->orderid;
                
            // $query = $this->db->get('ordered_product', $id);
            // return $query->row();  
            // DB::enableQueryLog();
            
            // echo "<pre>";
            // print_r($order_id);
            // echo "</pre>";
            // die();
              
        $get_order_data = DB::table('orders as o')
            ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock', 'p.owner', 'ap.api_order_id', 'ap.shipment_id', 'vp.shop_name',
                    'vp.email as V_Email', 'vp.phone as V_Phone', 'vp.city as V_City', 'vp.zip as V_Zip', 'vp.country as V_Countty', 'vp.state as V_State', 'oo.created_at', 
                    'oo.buyer_name', 'oo.order_payment_method', 'oo.cost')
            ->leftjoin('products as p', 'o.products', '=', 'p.id')
            ->leftjoin('ordered_products as oo', 'o.id', '=', 'oo.orderid')
            ->leftjoin('vendor_profiles as vp', 'p.vendorid', '=', 'vp.id')
            ->leftjoin('api_temp_resp as ap', 'o.id', '=', 'ap.order_id')
            ->where('o.id', $order_id)->get(); 
            
            // echo "<pre>";
            // print_r($get_order_data);
            // echo "</pre>";
            // die();
        
        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) {
                $data['order_id'] = $val->id;
                $data['order_date'] = $val->created_at;
                $data['channel_id'] = "3038633";
                $data['pickup_customer_name'] = $val->buyer_name;
                $data['pickup_last_name'] = "";
                $data['company_name'] = "";
                $data['pickup_address'] = $val->customer_address;
                $data['pickup_address_2'] = $val->customer_address2;
                $data['pickup_city'] = $val->customer_city;
                
                $data['pickup_state'] = $val->customer_state;
                $data['pickup_country'] = $val->customer_country;
                $data['pickup_pincode'] = $val->customer_zip;
                $data['pickup_email'] = $val->customer_email;
                $data['pickup_phone'] = $val->customer_phone;
                
                $data['pickup_isd_code'] = "91";
                
                if($val->owner == 'vendor'){
                    $data['shipping_customer_name'] = $val->shop_name;
                    $data['shipping_last_name'] = "";
                    $data['shipping_address'] = $val->pickupaddress;
                    $data['shipping_address_2'] = "";
                    $data['shipping_city'] = $val->V_City;
                    $data['shipping_country'] = $val->V_Countty;
                    $data['shipping_pincode'] = $val->V_Zip;
                    $data['shipping_state'] = $val->V_State;
                    $data['shipping_email'] = $val->V_Email;
                    $data['shipping_isd_code'] = "91";
                    $data['shipping_phone'] = $val->V_Phone;
                }
                else{
                    $data['shipping_customer_name'] = "ELRICA GLOBAL ENTERPRISES PRIVATE LIMITED";
                    $data['shipping_last_name'] = "";
                    $data['shipping_address'] = "1st Floor 102/103 Vinayak Chember Opp Tambe Hospital Gokhale Road Naupada";
                    $data['shipping_address_2'] = "";
                    $data['shipping_city'] = "Thane";
                    $data['shipping_country'] = "India";
                    $data['shipping_pincode'] = "400602";
                    $data['shipping_state'] = "Maharashtra";
                    $data['shipping_email'] = "it.elricaglobal@gmail.com";
                    $data['shipping_isd_code'] = "91";
                    $data['shipping_phone'] = "7977806916";
                }
                
                
                $data['order_items'][] = [
                        "sku" => "",
                        "name" => "",
                        "units" => "",
                        "selling_price" => "",
                        "discount" => "",
                        "qc_enable" => "",
                        "hsn" => "",
                        "brand" => "",
                        "qc_size" => "",
                    ];
                
                
                $data['payment_method'] = "PREPAID";
                $data['total_discount'] = "";
                $data['sub_total'] = $val->cost;
                $data['length'] = 11;
                $data['breadth'] = 11;
                
                if($val->height != ''){
                    if(str_contains($val->height, ' ') === true){
                        $height = explode(' ', $val->height);
                        $data['height'] = $height[0];
                    }else $data['height'] = $val->height;
                }else $data['height'] = 11;
                
                if($val->weight != '') {
                    if(str_contains($val->weight, ' ') === true) {
                        $weight = explode(' ', $val->weight);
                        $data['weight'] = $weight[0]/1000;
                    }
                } else $data['weight'] = '0.02';
            }
            
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die();
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/return",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            echo "<pre>";
            print_r($param);
            echo "</pre>";
            die();
            
            if(!isset($SR_generate_order_out->errors)) {
                
                $insert_data = array(
                    'rtn_order_id' => $SR_generate_order_out->order_id,
                    'rtn_shipment_id' => $SR_generate_order_out->shipment_id,
                    'status' => $SR_generate_order_out->status,
                    'status_code' => $SR_generate_order_out->status_code,
                    'rtn_courier_name' => $SR_generate_order_out->company_name,
                );
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update($insert_data);

            return back()->with('message', 'Shiprocket return order create successfully.');
        }
    }
    
    // return check serviceability functionality by Prashant --------------------------------
    
    public function return_check_serviceability($order_id){
        $token_no = $this->generateShipRocketToken();
                        
        if($token_no == '') {
            echo json_encode(array('status' => 500, 'msg' => "Error Generating Token"));
            return false;
        }

        $get_order_data = DB::table('orders as o')
        ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock','a.status', 'p.owner', 'a.status_code', 'a.created_at','a.awb_code', 'vp.zip', 'a.rtn_order_id', 'op.order_payment_method')
        ->leftjoin('products as p', 'o.products', '=', 'p.id')
        ->leftjoin('ordered_products as op', 'o.id', '=', 'op.orderid')
        ->leftjoin('api_temp_resp as a', 'o.id', '=', 'a.order_id')
        ->leftjoin('vendor_profiles as vp', 'p.vendorid', '=', 'vp.id')
        ->where('o.id', $order_id)
        ->get();
        
        // echo "<pre>";
        // print_r($get_order_data);
        // die();

        if(!$get_order_data) {
            echo json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
            return false;
        } else {
            foreach($get_order_data as $rows => $val) {
                $data['pickup_postcode'] = $val->customer_zip;
                if($val->owner == 'vendor'){
                    $data['delivery_postcode'] = $val->zip;
                }
                else {
                    $data['delivery_postcode'] = "400602";
                }
                $data['weight'] = $val->rtn_order_id;
                
                if($val->weight != '') {
                    if(str_contains($val->weight, ' ') === true) {
                        $weight = explode(' ', $val->weight);
                        $data['weight'] = $weight[0]/1000;
                    }
                } else $data['weight'] = '0.02';
                
                if($val->order_payment_method == 'COD'){
                    $data['cod'] = 0;
                }else $data['cod'] = 1;

            }
            
            // echo "<pre>";
            // print_r($data);
            // die();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );

            $curl = curl_init();
            curl_setopt_array($curl, $param);

            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            
            $SR_generate_order_out = json_decode($SR_generate_order);

            // return $SR_generate_order_out;
            
            echo "<pre>";
            print_r($SR_generate_order_out);
            die();
        }
    }
    
    // Return Courier order functionality create by Prashant -----------------
    
    public function return_courier_order(Request $request, $order_id) {
        $token_no = $this->generateShipRocketToken();

       DB::enableQueryLog();
        
        $get_order_dataa = DB::table('api_temp_resp')
            ->select('*')
            ->where('order_id', $order_id)->get()->toArray(); 
        
        $id = ($get_order_dataa[0]->order_id);
        
        if(!$get_order_dataa) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            $data['courier_id'] = $request->courier_id;
            foreach($get_order_dataa as $rows => $val) {
                $data['shipment_id']=$val->shipment_id;
            }
            

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token_no,
                ),
            );
            
            echo "<pre>";
            print_r($param);
            echo "</pre>";
            die();

            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order, true);
            
            // echo "<pre>";
            // print_r($SR_generate_order_out);
            // echo "</pre>";
            // die();
            
            if(!isset($SR_generate_order_out->errors)) {
                if($SR_generate_order_out['awb_assign_status'] == 1){
                    
                    foreach($SR_generate_order_out['response'] as $value){
                           
                        $insert_data = array(
                                'rtn_courier_id' => $value['courier_company_id'],
                                'awb_code' => $value['awb_code'],
                                'status' => "READY TO SHIP",
                                'rtn_courier_name' => $value['courier_name'],
                                'invoice_number' => $value['invoice_no'],
                            );
                        
                    }
                    
                }else {
                    foreach($SR_generate_order_out['response'] as $key=>$value){
                        $insert_data = array(
                                'awb_assign_error' => $value['awb_assign_error'],
                            );
                        
                    }
                    
                    $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update(['awb_assign_error'=>$insert_data['awb_assign_error']]);
                    
                    return back()->with('error', $insert_data['awb_assign_error']);
                }

            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
                
                return back()->with('error', $insert_data['error']);
            }
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update(['courier_company_id'=>$insert_data['courier_company_id'], 'awb_code'=>$insert_data['awb_code'], 'invoice_number'=>$insert_data['invoice_number'], 'courier_name'=>$insert_data['courier_name'], 'status'=>$insert_data['status']]);
            
            return back()->with('message', 'Shiprocket courier selection successfully.');
        }
    }
    
}

