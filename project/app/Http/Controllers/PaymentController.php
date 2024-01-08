<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\PricingTable;
use App\Product;
use App\ProductAttr;
use App\Settings;
use App\OrderedProducts;
use Illuminate\Http\Request;
use Session;
use Razorpay\Api\Api;
use DateTime;
use DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{


    public function store(Request $request)
    {
    	$settings = Settings::findOrFail(1);
    	$item_name = $settings->title." Order";
    	$item_number = str_random(4).time();
    	$item_amount = $request->total;
    	
    	$order = new Order;
    	if($request->method != 'Razorpay'){
    		$paypal_email = $settings->paypal_business;
    		$return_url = action('PaymentController@payreturn');
    		$cancel_url = action('PaymentController@paycancle');
    		$notify_url = action('PaymentController@notify');
    
    
    		$querystring = '';
    
    		// Firstly Append paypal account to querystring
    		$querystring .= "?business=".urlencode($paypal_email)."&";
    
    		// Append amount& currency (£) to quersytring so it cannot be edited in html
    
    		//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
    		$querystring .= "item_name=".urlencode($item_name)."&";
    		$querystring .= "amount=".urlencode($item_amount)."&";
    		$querystring .= "item_number=".urlencode($item_number)."&";
    
    		$querystring .= "cmd=".urlencode(stripslashes($request->cmd))."&";
    		$querystring .= "bn=".urlencode(stripslashes($request->bn))."&";
    		$querystring .= "lc=".urlencode(stripslashes($request->lc))."&";
    		$querystring .= "currency_code=".urlencode(stripslashes($request->currency_code))."&";
    
    		// Append paypal return addresses
    		$querystring .= "return=".urlencode(stripslashes($return_url))."&";
    		$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
    		$querystring .= "notify_url=".urlencode($notify_url)."&";
    
    		$querystring .= "custom=".$request->customer;
    		
    	    $order['order_number'] = $item_number;
    	}else{
    	    $api = new Api($settings->razorpay_key, $settings->razorpay_secret);
    	    $receiptId = Str::random(20);
    	    
            $razorOrder = $api->order->create(array(
                'receipt' => $receiptId,
                'amount' => $request->total*100,
                'currency' => 'INR'
                )
            );
            
            $response = [
                'orderId' => $razorOrder['id'],
                'razorpayId' => $settings->razorpay_key,
                'amount' => $request->total * 100,
                'name' => $request->name,
                'currency' => 'INR',
                'email' => $request->email,
                'contactNumber' => $request->phone,
                'address' => $request->address,
                'description' => $request->order_notes,
                'image' => url('assets/images/logo/'.$settings->logo),
            ];
           
    	    $order['order_number'] = $response['orderId'];
    	}
        
    	$order['customerid'] = $request->customer;
    	$order['products'] = $request->products;
    	$order['quantities'] = $request->quantities;
    	$order['sizes'] = $request->sizes;
    	$order['pay_amount'] = $item_amount;
    	$order['method'] = ($request->method == "Razorpay")?"Razorpay":"COD";
    	$order['booking_date'] = date('Y-m-d H:i:s');
    	$order['shipping'] = $request->shipping;
    	$order['pickup_location'] = $request->pickup_location;
    	$order['customer_email'] = $request->email;
    	$order['customer_name'] = $request->name;
    	$order['customer_phone'] = $request->phone;
    	$order['customer_address'] = $request->address;
    	$order['customer_address2'] = $request->address2;
    	$order['customer_city'] = $request->city;
    	$order['customer_state'] = $request->state;
    	$order['customer_country'] = $request->country;
    	$order['customer_alt_phone'] = $request->alternate_phone;
    	$order['customer_zip'] = $request->zip;
    	$order['shipping_email'] = $request->shipping_email;
    	$order['shipping_name'] = $request->shipping_name;
    	$order['shipping_phone'] = $request->shipping_phone;
    	$order['shipping_address'] = $request->shipping_address;
    	$order['shipping_address2'] = $request->shipping_address2;
    	$order['shipping_city'] = $request->shipping_city;
    	$order['shipping_state'] = $request->shipping_state;
    	$order['shipping_country'] = $request->shipping_country;
    	$order['shipping_alternate_phone'] = $request->shipping_alternate_phone;
    	$order['shipping_zip'] = $request->shipping_zip;
    	$order['order_note'] = $request->order_note;
    	$order['couponAmount'] = $request->couponAmount;
    	$order['payment_status'] = "Pending";
        $order['buyer_order_id'] = $request->buyer_order_id;
        $order['seller_order_id'] = $request->seller_order_id;
        
    	$order->save();
    	$orderid = $order->id;
    
        // new added code
            $ordernumber = $order->order_number;
            $buyer_name = $order->customer_name;
            $buyer_phone = $order->customer_phone;
            $buyer_address = $order->customer_address;
            $buyer_address2 = $order->customer_address2;
            $buyer_city = $order->customer_city;
            $buyer_state = $order->customer_state;
            $tomorrow = $order->booking_date;
            $tomorrownew = $order->booking_date;
            $customer_id_new = $order->customerid;
            $payment_method = $order->method;
    	    $order_color = $request->color;
    
            $tomorrowdate = new DateTime($tomorrow);
            $datetomorrow = $tomorrowdate->modify('+1 day');
    
            $settelmentdate = $tomorrowdate->modify('+25 day');
    
            $aftertomorrow = new DateTime($tomorrownew);
    
            $dateaftertomorrow = $aftertomorrow->modify('+2 day');
    
            // end new added code
    
    	$pdata = explode(',',$request->products);
    	$qdata = explode(',',$request->quantities);
    	$sdata = explode(',',$request->sizes);
        $color_data = explode(',',$request->color);
        $colorcode = explode(',',$request->colorcode);
        $maincolor_data = explode(',',$request->maincolor);
        $img_data = explode(',',$request->productImage);
        $cost_prc = explode(',', $request->cost);
        $premiumtype = explode(',', $request->premiumtype);
        $categoryid = explode(',', $request->categoryID);
        $productAttrId = explode(',', $request->productAttrId);
        $gstAmount = explode(',', $request->gstAmount);
    
        foreach ($pdata as $data => $product){
            $proorders = new OrderedProducts();
            if($productAttrId[$data] != ""){
                $productdata = ProductAttr::findOrFail($productAttrId[$data]);
                $stocks = $productdata->attr_qty - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['attr_qty'] = $stocks;
                $productdata->update($quant);
            }else{
                $productdat = Product::findOrFail($product);
                $stocks = $productdat->stock - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['stock'] = $stocks;
                $productdat->update($quant);
            }
    
            $productdet = Product::findOrFail($product);
    
            $proorders['orderid'] = $orderid;
            $proorders['order_number_new'] = $ordernumber;
            $proorders['categoryID'] = $categoryid[$data];
            $proorders['product_title'] = $productdet->title;
            $proorders['product_sku'] = $productdet->productsku;
            $proorders['seller_name'] = $productdet->sellername;
            $proorders['product_image'] = $img_data[$data];
            $proorders['unique_id'] = str_random(4).time();
            $proorders['buyer_name'] = $buyer_name;
            $proorders['buyer_phone'] = $buyer_phone;
            $proorders['buyer_address'] = $buyer_address;
            $proorders['buyer_address2'] = $buyer_address2;
            $proorders['color'] = $color_data[$data] != "" ? $color_data[$data] : NULL;
            $proorders['maincolor'] = $maincolor_data[$data] != "" ? $maincolor_data[$data] : NULL;
            $proorders['productAttrId'] = $productAttrId[$data] != "" ? $productAttrId[$data] : NULL;
            $proorders['gstAmount'] = $gstAmount[$data] != "" ? $gstAmount[$data] : NULL;
            $proorders['colorcode'] = $colorcode[$data] != "" ? $colorcode[$data] : NULL;
            $proorders['buyer_city'] = $buyer_city;
            $proorders['buyer_state'] = $buyer_state;
            $proorders['tomorrow_date'] = $datetomorrow;
            $proorders['after_tomorrow_date'] = $dateaftertomorrow;
            $proorders['customer_id_new'] = $customer_id_new;
            $proorders['vendorname'] = $productdet->vendor_name;
            $proorders['order_payment_method'] = $payment_method;
            $proorders['Settelment_date'] = $settelmentdate;
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            $proorders['size'] = $sdata[$data];
            $proorders['payment'] = "pending";
            $proorders['premiumtype'] = $categoryid[$data] == 82 ? $premiumtype[$data] : NULL;
            $proorders['cost'] = $cost_prc[$data];
            $proorders->save();
    
            $orderedid = $proorders->id;
    
            $carts = Cart::where('uniqueid',Session::get('uniqueid'))
                    ->where('category', (int)$categoryid[$data])
                    ->where('product', $product);
                    if($productAttrId[$data] != ""){
                        $carts->where('productAttrId', $productAttrId[$data]);
                    }
    
                $cart = $carts->get();
            
            if($categoryid[$data] == "72" || $categoryid[$data] == "58")
            {
                $pres['order_id'] = $orderid;
                $pres['ordered_id'] = $orderedid;
                $pres['title'] = $cart[0]->title;
                $pres['category'] = $cart[0]->category;
                $pres['product_id'] = $cart[0]->product;
                $pres['quantity'] = $cart[0]->quantity;
                $pres['cartcolor'] = $cart[0]->cartcolor;
                $pres['maincolor'] = $cart[0]->maincolor;
                $pres['size'] = $cart[0]->size;
                $pres['cost'] = $cart[0]->cost;
                $pres['rangenameone'] = $cart[0]->rangenameone;
                $pres['rangenametwo'] = $cart[0]->rangenametwo;
                $pres['rangenamethree'] = $cart[0]->rangenamethree;
                $pres['discount_one'] = $cart[0]->discount_one;
                $pres['discount_two'] = $cart[0]->discount_two;
                $pres['discount_three'] = $cart[0]->discount_three;
                $pres['price'] = $cart[0]->price;
                $pres['main_price'] = $cart[0]->main_price;
                $pres['base_curv'] = $cart[0]->base_curv;
                $pres['presc_image'] = $cart[0]->presc_image;
                $pres['lefteyequantity'] = $cart[0]->lefteyequantity;
                $pres['righeyequantity'] = $cart[0]->righeyequantity;
                $pres['botheyequantity'] = $cart[0]->botheyequantity;
                $pres['dia'] = $cart[0]->dia;
                $pres['Lsphere'] = $cart[0]->Lsphere;
                $pres['Lpower'] = $cart[0]->Lpower;
                $pres['LDia'] = $cart[0]->LDia;
                $pres['LBc'] = $cart[0]->LBc;
                $pres['Laxis'] = $cart[0]->Laxis;
                $pres['Lcyle'] = $cart[0]->Lcyle;
                $pres['lva'] = $cart[0]->lva;
                $pres['same_rx_both'] = $cart[0]->same_rx_both;
                $pres['rsphere'] = $cart[0]->rsphere;
                $pres['rpower'] = $cart[0]->rpower;
                $pres['rbc'] = $cart[0]->rbc;
                $pres['rdia'] = $cart[0]->rdia;
                $pres['Raxis'] = $cart[0]->Raxis;
                $pres['rcyl'] = $cart[0]->rcyl;
                $pres['rva'] = $cart[0]->rva;
                $pres['bsphere'] = $cart[0]->bsphere;
                $pres['bpower'] = $cart[0]->bpower;
                $pres['Bbc'] = $cart[0]->Bbc;
                $pres['Bdia'] = $cart[0]->Bdia;
                $pres['Bcyle'] = $cart[0]->Bcyle;
                $pres['Baxis'] = $cart[0]->Baxis;
                $pres['totalPd'] = $cart[0]->totalPd;
                $pres['Lepd'] = $cart[0]->Lepd;
                $pres['Repd'] = $cart[0]->Repd;
                
                $pres['frame_fit'] = $cart[0]->frame_fit;
                $pres['a_size'] = $cart[0]->a_size;
                $pres['b_size'] = $cart[0]->b_size;
                $pres['dbl'] = $cart[0]->dbl;
                $pres['r_dia'] = $cart[0]->r_dia;
                $pres['l_dia'] = $cart[0]->l_dia;
                $pres['r_pd'] = $cart[0]->r_pd;
                $pres['l_pd'] = $cart[0]->l_pd;
                $pres['bvd'] = $cart[0]->bvd;
                $pres['r_ed'] = $cart[0]->r_ed;
                $pres['l_ed'] = $cart[0]->l_ed;
                $pres['r_fitting'] = $cart[0]->r_fitting;
                $pres['l_fitting'] = $cart[0]->l_fitting;
                $pres['pantascopic'] = $cart[0]->pantascopic;
                $pres['temple_size'] = $cart[0]->temple_size;
                $pres['network_distance'] = $cart[0]->network_distance;
                $pres['bow_angle'] = $cart[0]->bow_angle;
                $pres['frame_type'] = $cart[0]->frame_type;
                $pres['materials'] = $cart[0]->materials;
                $pres['shape_code'] = $cart[0]->shape_code;
                
                DB::table('prescription')->insert($pres);
            }
        }
        
        $coupons = explode(',', $request->coupons);
        foreach ($coupons as $data => $coupon)
        {
            $couponsorder['order_id'] = $orderid;
            $couponsorder['coupon_code'] = $coupon;
            DB::table('order_coupon')->insert($couponsorder);
        }
    
        if($request->method == 'Razorpay'){
            return view('razorpay',compact('response'));
    	}else{
    		// Redirect to paypal IPN
    		header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
    		exit();
    	}
    }

    public function paymentfailed($id){
        // $input = $request->all();
        // if(count($input) && !empty($input['razorpay_payment_id'])){
        //     try{
        //         $payment->capture(array('amount'=>$payment['amount']));
        //     }
        //     catch(Exception $e){
        //         return $e->getMessage();
        //         return redirect()->back();
        //     }
        // }

        // $payDetails = [
        //     'payment_id' => request('razorpay_payment_id'),
        //     'order_id' => $orderid,
        //     'amount' => request('amount'),
        //     'payment_status' => 'failed'
        // ]; 
        
        // DB::table('payment')->insertGetId($payDetails);
        // \Session::put('msg',"Payment Failed");

        Order::findOrFail($id)->delete();
        // OrderedProducts::where('orderid', $id)->delete();

        return ['msg'=>"Order Deleted from User Site"];
    }
    
public function razorpaySuccess(Request $request){
    /*echo "<pre>";
    print_r($request->all());
    die();*/
    // Now verify the signature is correct . We create the private function for verify the signature
    $signatureStatus = $this->SignatureVerify(
        $request->all()['rzp_signature'],
        $request->all()['rzp_paymentid'],
        $request->all()['rzp_orderid']
    );
    
    if($signatureStatus == true){
        $order = Order::where('order_number', $request->rzp_orderid)->first();
        $order->txnid = $request->rzp_paymentid;
        $order->payment_status = 'Completed';
        $order->status = 'completed';
        $order->save();
        
        $updateOrderedProduct = OrderedProducts::where('orderid',$order->id)->update(['payment'=>'completed', 'paid'=>'yes']);
    }

    // If Signature status is true We will save the payment response in our database
    // In this tutorial we send the response to Success page if payment successfully made

    return view('payreturn', compact('signatureStatus'));
    
}

// In this function we return boolean if signature is correct
private function SignatureVerify($_signature,$_paymentId,$_orderId)
{
    try
    {
	
    	$settings = Settings::findOrFail(1);
        // Create an object of razorpay class
        $api = new Api($settings->razorpay_key, $settings->razorpay_secret);
        $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
        $order  = $api->utility->verifyPaymentSignature($attributes);
        return true;
    }
    catch(\Exception $e)
    {
        // If Signature is not correct its give a excetption so we use try catch
        return false;
    }
}

 public function paycancle(){
     return redirect()->back();
 }

public function payreturn(){
     return view('payreturn');
 }

public function notify(Request $request){
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }

// Read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }

    /*
     * Post IPN data back to PayPal to validate the IPN data is genuine
     * Without this step anyone can fake IPN data
     */
    $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);

    /*
     * Inspect IPN validation result and act accordingly
     * Split response headers and payload, a better way for strcmp
     */
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));
    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

        $order = Order::where('customerid',$_POST['custom'])
            ->where('order_number',$_POST['item_number'])->first();
        $data['txnid'] = $_POST['txn_id'];
        $data['payment_status'] = $_POST['payment_status'];
        $order->update($data);

	$proorders = OrderedProducts::where('orderid',$order->id);
    $datas['payment'] = "completed";
    $proorders->update($datas);
    Cart::where('uniqueid',Session::get('uniqueid'))->delete();


//
//        $fh = fopen('paymentLaravel.txt', 'w');
//        fwrite($fh, $req);
//        fclose($fh);
//
//
//        $fs = fopen('paymentstatus.txt', 'w');
//        fwrite($fs, $_POST['payment_status']);
//        fclose($fs);
//        //return "yes";

    }else{

        $fh = fopen('newresag.txt', 'w');
        fwrite($fh, $req);
        fclose($fh);
    }

}



}
