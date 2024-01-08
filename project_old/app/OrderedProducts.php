<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedProducts extends Model
{
    public $table = "ordered_products";
    protected $fillable = [
        'orderid', 'owner', 'courier_boy', 'order_confirm_date', 'categoryID', 'entry_by', 'vendorid','book_slot_time','book_slot_date', 'intransit_date', 'pickup_date', 'productid','paid','payment', 'quantity', 'cost', 'created_at', 'updated_at', 'size', 'status','order_number_new','product_title','product_sku','seller_name','order_accept_date','book_slot_date','book_slot_time','tomorrow_date','after_tomorrow_date','customer_id_new','canceled_date','canceled_reason','comment_cancel','unique_id','buyer_name','buyer_phone','buyer_address','buyer_city','buyer_state', 'buyer_country','product_image','vendorname',
        'invoice_number', 'gstAmount'
    ];
//    public static $withoutAppends = false;
//
//    public function getProductidAttribute($productid)
//    {
//        if(self::$withoutAppends){
//            return $productid;
//        }
//        return Product::findOrFail($productid);
//    }



    public static function pushOrder($id){
    	$orderdetails = OrderedProducts::where('id',$id)->first()->toArray();
    	// dd($orderdetails);die;
    	$orderdetails['id'] = $orderdetails['id'];
    	$orderdetails['created_at'] = $orderdetails['created_at'];

    	// echo "<pre>"; print_r(json_encode($orderdetails));die;

    	$data_json = json_encode($orderdetails);

    	// genrate access token
    	$timestamp = time();
	    $appID = 8915	;
	    $key = 'SZA/XAWJWa8=';
	    $secret = '3j+D10HJcIyNF3ck2Wr+xrURGRevBxAEm+GZilRcr/pP1TQ6/O66JR4RliwSIeTUdRPoB0u5EYGne9ROVLkZFg==';

	    $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
	    $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));

    	$header = array(
        "x-appid: $appID",
        "x-sellerid:123948",
        "x-timestamp: $timestamp",
        "x-version:3", // for auth version 3.0 only
        "Authorization: $authtoken",
        "Content-Type: application/json",
        "Content-Length: ".strlen($data_json)
    );

    	$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/order?method=sku');
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response  = curl_exec($ch);
	    // var_dump($response);
	    // exit;
	    curl_close($ch);
	    // $server_output = json_encode($response,true);
	    echo"<pre>"; print_r($response);die; 


    }



}
