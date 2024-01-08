<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\PricingTable;
use App\Product;
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


    public function store(Request $request){

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
    	}
    	
    	else{
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
    	$order['payment_status'] = "Pending";
    	$order->save();
    	$orderid = $order->id;
    
        // new added code
        $ordernumber = $order->order_number;
        $buyer_name = $order->customer_name;
        $buyer_phone = $order->customer_phone;
        $buyer_address = $order->customer_address;
        $buyer_city = $order->customer_city;
        $buyer_state = $order->customer_state;
        $tomorrow = $order->booking_date;
        $tomorrownew = $order->booking_date;
        $customer_id_new = $order->customerid;
        $payment_method = $order->method;

        $tomorrowdate = new DateTime($tomorrow);
        $datetomorrow = $tomorrowdate->modify('+1 day');

        $settelmentdate = $tomorrowdate->modify('+25 day');

        $aftertomorrow = new DateTime($tomorrownew);

        $dateaftertomorrow = $aftertomorrow->modify('+2 day');

        // end new added code
    
    	$pdata = explode(',',$request->products);
    	$qdata = explode(',',$request->quantities);
    	$sdata = explode(',',$request->sizes);
    
        foreach ($pdata as $data => $product){
            $proorders = new OrderedProducts();
            $productdet = Product::findOrFail($product);
    
            $proorders['orderid'] = $orderid;
            // new added code
            $proorders['order_number_new'] = $ordernumber;
            $proorders['product_title'] = $productdet->title;
            $proorders['product_sku'] = $productdet->productsku;
            $proorders['seller_name'] = $productdet->sellername;
            $proorders['product_image'] = $productdet->feature_image;
            $proorders['unique_id'] = str_random(4).time();
            $proorders['buyer_name'] = $buyer_name;
            $proorders['buyer_phone'] = $buyer_phone;
            $proorders['buyer_address'] = $buyer_address;
            $proorders['buyer_city'] = $buyer_city;
            $proorders['buyer_state'] = $buyer_state;
            $proorders['tomorrow_date'] = $datetomorrow;
            $proorders['after_tomorrow_date'] = $dateaftertomorrow;
            $proorders['customer_id_new'] = $customer_id_new;
            $proorders['vendorname'] = $productdet->vendor_name;
            $proorders['order_payment_method'] = $payment_method;
            $proorders['Settelment_date'] = $settelmentdate;
            // end of new added code
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            $proorders['size'] = $sdata[$data];
            $proorders['payment'] = "pending";
            $proorders['cost'] = $productdet->price * $qdata[$data];
            $proorders->save();
    
            $stocks = $productdet->stock - $qdata[$data];
            if ($stocks < 0){
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $productdet->update($quant);
        }
    
    	Cart::where('uniqueid',Session::get('uniqueid'))->delete();
    
        if($request->method == 'Razorpay'){
            return view('razorpay',compact('response'));
    	}else{
    		// Redirect to paypal IPN
    		header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
    		exit();
    	}
    	
    	if($request->method == 'Razorpay'){
    	    if($order->payment_status == 'Pending'){
    	        $orderDelete = $this->deletePendingPayment($orderid);
    	    }
    	}
    }


    public function deletePendingPayment($id){
        Order::findOrfail($id)->delete();
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
    private function SignatureVerify($_signature,$_paymentId,$_orderId) {
        try {
    	    $settings = Settings::findOrFail(1);
            // Create an object of razorpay class
            $api = new Api($settings->razorpay_key, $settings->razorpay_secret);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e) {
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
