<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use App\Product;
use App\Vendors;
use App\Category;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use DateTime;
use Dompdf\Dompdf;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $nowdate = '2013-01-23';
        // $datetime = new DateTime($nowdate);
        // $datetime->modify('+2 day');
        // echo $datetime->format('Y-m-d H:i:s');
        // die();
        

        // echo "<pre>";
        // print_r($seller);
        // die();

        $vendorname = Vendors::all();

        Order::$withoutAppends = true;

        // $data = DB::table('ordered_products')->get();

          // $data['data'] = DB::table('ordered_products')->join('orders','orders.id','=','ordered_products.orderid')->join('products','products.id','=','ordered_products.productid')->select('ordered_products.*','orders.booking_date','orders.order_number','products.productsku','products.title')->orderBy('ordered_products.id','desc')->get();

        // dd($data);


        // $silver = DB::table("orders")->select('orders.id','orders.order_number','orders.booking_date');

        // $gold = DB::table("products")->select('products.title','products.productsku')->unionAll($silver)->get();

        // print_r($gold);
        // die();

        // new added code for new order functionlity
        $apiData = DB::table('api_temp_resp as ap')
                    ->select('ap.*', 'op.status as P_Status')
                    ->leftjoin('ordered_products as op', 'ap.order_id', '=', 'op.orderid')
                    ->where('ap.status', '!=', 'cancelled')
                    ->where('ap.status', '!=', 'NEW')
                    ->where('op.status', '!=', 'completed')
                    ->orderBy('ap.id', 'desc')
                    ->get();
                    
                    // echo "<pre>";
                    // print_r($apiData);
                    // die();
        
        $trackingData = DB::table('api_temp_resp as ap')
                        ->select('ap.*', 'o.buyer_name', 'o.buyer_address', 'o.buyer_city', 'o.buyer_state', 'o.buyer_phone', 'o.product_image', 'o.book_slot_date', 'o.product_title')
                        ->leftjoin('ordered_products as o', 'ap.order_id', '=', 'o.orderid')
                        ->orderBy('id', 'desc')
                        ->get();
                        
                        // echo "<pre>";
                        // print_r($trackingData);
                        // die();
        
     
        $totalorders = DB::table('ordered_products')
                        ->select('ordered_products.*', 'ap.pickup_scheduled_date', 'ap.shipment_id', 'ap.courier_id', 'ap.manifest_url', 'ap.awb_code')
                        ->leftjoin('api_temp_resp as ap', 'ordered_products.orderid', 'ap.order_id')
                        ->orderBy('id','desc')
                        ->get();
                        
       

        $totalpending = DB::table('ordered_products as op')
                        ->select('op.*', 'ap.shipment_id')
                        ->leftjoin('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
                        ->where('op.status','=','pending')
                        ->orderBy('id','desc')
                        ->get();
                        
                        // echo "<pre>";
                        // print_r($totalpending);
                        // die();

            // $totalprocessing = DB::table('ordered_products as op')
            //                     ->join('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
            //                     ->where('op.status', '=', 'processing')
            //                     ->orderBy('op.id','desc')
            //                     ->get();
                                
            //                     echo "<pre>";
            //                     print_r($totalprocessing);
            //                     die();
            
            $totalprocessing = DB::table('ordered_products as op')
                        ->select('op.*', 'ap.shipment_id')
                        ->leftjoin('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
                        ->where('op.status','=','processing')
                        ->orderBy('id','desc')
                        ->get();
        
        // $totalprocessing = DB::table('ordered_products as op')
        //                     ->select('op.*', 'ap.awb_code', 'ap.rtn_order_id', 'ap.order_id', 'ap.shipment_id')
        //                     ->join('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
        //                     ->where('op.status','=','processing')
        //                     ->orderBy('op.id','desc')
        //                     ->get();
                        
        // $totalconfirm = DB::table('ordered_products')->where('status','=','picked')->orderBy('id','desc')->get();
        
        $totalconfirm = DB::table('ordered_products')
                        ->select('ordered_products.*', 'ap.pickup_scheduled_date', 'ap.manifest_url', 'ap.shipment_id', 'ap.awb_code', 'ap.rtn_order_id', 'ap.order_id')
                        ->join('api_temp_resp as ap', 'ordered_products.orderid', 'ap.order_id')
                        ->where('ordered_products.status','=','picked')
                        ->orderBy('ordered_products.id','desc')
                        ->get();
                        
                        // echo "<pre>";
                        // print_r($totalconfirm[1]->orderid);
                        // die();

        $totalintransit = DB::table('ordered_products')->where('status','=','InTransit')->orderBy('id','desc')->get();

        $totalcompleted = DB::table('ordered_products')->where('status','=','completed')->orderBy('id','desc')->get();




    // end new added code for new order functionlity


        $seller = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->orderBy('id','desc')
                    ->get();


        $orders = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','products.productsku','products.sellername')
                    ->orderBy('id','desc')
                    ->get();
        // echo "<pre>";
        // print_r($orders);
        // die();


        $pending = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','products.productsku','products.sellername')
                    ->where('orders.status','=','pending')
                    ->orderBy('id','desc')
                    ->get();

                    // dd($pending);

        $confirmed = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','products.productsku','products.sellername')
                    ->where('orders.status','=','processing')
                    ->orderBy('id','desc')
                    ->get();

        $picked = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','picked')
                    ->orderBy('id','desc')
                    ->get();

        $shipped = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','InTransit')
                    ->orderBy('id','desc')
                    ->get();

        $delivered = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','completed')
                    ->orderBy('id','desc')
                    ->get();



        // $orders = DB::table('ordered_products')
        //              ->join('orders', 'ordered_products.orderid', '=' , 'orders.id')
        //              ->join('products','ordered_products.productid', '=', 'products.id')
        //              ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
        //              ->select('ordered_products.*','orders.order_number','orders.booking_date','orders.customer_name','orders.customer_email','products.title','products.feature_image','products.price','vendor_profiles.name')
        //              ->orderBy('id','desc')
        //              ->get();
        //              dd($orders);

        $products = OrderedProducts::get();
        // $orders = Order::where('payment_status',"Completed")->orderBy('id','desc')->get();
        return view('admin.orderlist',compact('orders','products','pending','confirmed','picked','shipped','delivered','seller','vendorname','totalorders','totalpending','totalprocessing','totalconfirm','totalintransit','totalcompleted', 'apiData', 'trackingData', 'erp_pro_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    public function generatePDF($id)
    {
      
        // $order = Order::findOrFail($id);

        // new added code for new order functionlity
         $order = DB::table('ordered_products as op')
         ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
         ->leftjoin('admin', 'admin.username', '=', 'op.owner')
         ->select('op.*', 'o.shipping', 'o.pickup_location', 'o.txnid', 'o.charge_id', 'o.booking_date', 'o.order_number', 'o.customer_zip', 'o.customer_country', 'o.customer_alt_phone', 'o.shipping_address',
         'o.shipping_name', 'o.shipping_email', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_city', 'o.shipping_zip', 'o.shipping_country', 'o.shipping_state', 'o.shipping_alternate_phone', 'o.pay_amount',
         'admin.name as A_Name', 'admin.email as A_Email', 'admin.phone as A_Phone')
         ->where('op.id', $id)
         ->orderBy('id','desc')
         ->get()->toArray();
        
        // $orders = json_decode( json_encode($order[0]), true);
         $orders = $order[0];
         
        $tax = $orders->cost/100*18;
        $subtotal = $orders->cost*$orders->quantity+$tax;
         
         $array = [
            'main' => "B2B Reachoptic Pvt. Ltd.",
            'url' => "http://b2b.reachoptic.com/",
            'address1' => "102 vinayak chember",
            'address2' => "opposite tambe hospital , naupada road ",
            'city' => "Thane",
            'state' => "Maharashtra",
            'country' => "India",
            'zip' => "400605"
        ];
        // echo "<pre>";
        // print_r($orders);
        // echo "</pre>";
        // die();
        // end new added code for new order functionlity

        $data = ['title' => 'Invoice'];
        // $dompdf->set_option('enable_html5_parser', TRUE);
        $pdf = PDF::loadView('invoice', compact('orders', 'array', 'tax', 'subtotal'), $data);
        return $pdf->download('Invoice.pdf');

        // return $pdf->stream('Invoice.pdf');
    }
    
    // new code for create acknowladgeslip and pick up slip
    
    public function acknowladgeslip($id)
    {
        $order = DB::table('ordered_products as op')
        ->leftjoin('orders as o','o.id', '=', 'op.orderid')
        ->leftjoin('products', 'products.id', '=', 'op.productid')
        ->leftjoin('vendor_profiles as vp', 'vp.id', '=', 'op.vendorid')
        ->leftjoin('admin', 'admin.username', '=', 'op.owner')
        ->select('op.*', 'vp.email as V_Email', 'vp.name as V_Name', 'vp.shop_name as V_Shop', 'vp.phone as V_Contact',
        'admin.name as A_Name', 'admin.email as A_Email', 'admin.phone as A_Phone', 'o.booking_date', 'o.order_number',
        'o.shipping_name', 'o.shipping_email', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_city', 'o.shipping_state',
        'o.shipping_country', 'o.shipping_zip', 'o.shipping_alternate_phone', 'o.customer_country', 'o.customer_zip', 'o.customer_alt_phone')
        ->where('op.id', $id)
        ->get()->toArray()[0];
        
        $tax = $order->cost/100*18;
        $subtotal = $order->cost*$order->quantity+$tax;

        $array = [
            'main' => "B2B Reachoptic Pvt. Ltd.",
            'url' => "http://b2b.reachoptic.com/",
            'address1' => "102 vinayak chember",
            'address2' => "opposite tambe hospital , naupada road ",
            'city' => "Thane",
            'state' => "Maharashtra",
            'country' => "India",
            'zip' => "400605"
        ];
        $data = ['title' => 'AcknowledgementSlip'];
        $pdf = PDF::loadView('acknowledgementslip', compact('array', 'order', 'tax', 'subtotal'), $data);
        return $pdf->download('AcknowledgementSlip.pdf');
    }
    
    public function downloadpickupslip($id)
    {
        $order = OrderedProducts::findOrFail($id);
        $data = ['title' => 'DownloadPickupSlip'];
        $pdf = PDF::loadView('pickupslip',compact('order'),$data);
        return $pdf->stream('PickUpSlip.pdf');
    }
    
    public function changeallselectedsts(Request $request)
    {

        $ids = $request->ids;
        $date = date('Y-m-d');

        OrderedProducts::whereIn('id',$ids)->update(['status' => 'processing','order_accept_date' => $date]);

        // OrderedProducts::whereIn('id',$ids)->delete();
        // return response()->json(['success'=>"deleted Successfully"]);

        return redirect('admin/orders')->with('message','Order Status Updated Successfully...!');
    }


    public function confirmallselectedorders(Request $request){

        $ids = $request->ids;
        $date = date('Y-m-d');

        OrderedProducts::whereIn('id',$ids)->update(['status' => 'picked','order_confirm_date'=> $date ]);
    
        $total_count = [];
        $processing_total = DB::table('ordered_products')->where('status','=','processing')->count();
        $picked_total = DB::table('ordered_products')->where('status','=','picked')->count();
    
        $total_count['processing_total'] = $processing_total;
        $total_count['picked_total'] = $picked_total;
    
        return response()->json(['status'=>'success', 'msg'=>'Selected Orders Are Confirm...!', 'data'=>$total_count]);
    }



    //end of new code for create acknowladgeslip and pickup slip 


    // functions for return and cancel modules

    public function returnorderview()
    {
        $adminorderreturn = DB::table('ordered_products')->where('status','=','return')->where('owner','=','admin')->orderBy('id','desc')->get();
        $vendororderreturn = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->orderBy('id','desc')->get();
        return view('admin.returnorderlist',compact('adminorderreturn','vendororderreturn'));
    }

    public function cancelorderview()
    {
        return view('admin.cancelorderlist');
    }
    
    public function returnorderdetails($id)
    {
        $allcanceldata = OrderedProducts::findOrFail($id);
        return view('admin.returnorderdetails',compact('allcanceldata'));
    }
    
    public function cancelorderdetails($id)
    {
        $allcanceldata = OrderedProducts::findOrFail($id);
        
        $allcancelTax = Category::findOrFail($allcanceldata->categoryID);
        return view('admin.cancelorderdetails',compact('allcanceldata', 'allcancelTax'));

    }
    
    public function loadvendorlist()
    {   
       $Accept = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','accept')->orderBy('id','desc')->get();
       $Intransit = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','intransit')->orderBy('id','desc')->get();
       $Completed = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','completed')->orderBy('id','desc')->get();
        return view('admin.returnvendorlist',compact('Accept','Intransit','Completed'));
    }
    
    public function loadadminlist()
    {
        $Accept = DB::table('ordered_products as op')
            ->select('op.*', 'ap.order_id', 'ap.rtn_shipment_id')
            ->leftjoin('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
            ->where('op.status','=','return')
            ->where('op.owner','=','admin')
            ->where('op.return_status','=','accept')
            ->orderBy('op.id','desc')
            ->get();
        
        $Intransit = DB::table('ordered_products')->where('status','=','return')->where('owner','=','admin')->where('return_status','=','intransit')->orderBy('id','desc')->get();

        $Completed = DB::table('ordered_products')->where('status','=','return')->where('owner','=','admin')->where('return_status','=','completed')->orderBy('id','desc')->get();
        return view('admin.retunradminlist',compact('Accept','Intransit','Completed'));
    }


    // end functions for return and cancel modules



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products = OrderedProducts::where('orderid',$id)->get();
        return view('admin.orderdetails',compact('order','products'));
    }

    public function status($id,$status)
    {
        // $mainorder = Order::findOrFail($id);

        // new added code for order
            $mainorder = OrderedProducts::findOrFail($id);
        // end new added code for order 

        // $settings = Settings::findOrFail(1);
        if ($mainorder->status == "completed"){
            return redirect('admin/orders')->with('message','This Order is Already Completed');
        }else{
            $stat['status'] = $status;

            // new added code for order module

            $ordersnew = OrderedProducts::where('orderid',$id)->get();

            foreach ($ordersnew as $statusnew){

                $ordernew = OrderedProducts::findOrFail($statusnew->id);

                $upsta['status'] = $status;

                $ordernew->update($upsta);
            }

            // end new added code for order module

            if($status == "completed"){
                $orders = OrderedProducts::where('orderid',$id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
    
                    if ($order->owner == "vendor"){
                        $vendor = Vendors::findOrFail($payee->vendorid);
                        $balance['current_balance'] = $vendor->current_balance + $payee->cost;
                        $vendor->update($balance);
                    }
                    $sts['paid'] = "yes";
                    $sts['status'] = "completed";
                    $order->update($sts);
                }
            }
            
            $mainorder->update($stat);
            
            // for mail notification
            $to = $mainorder->customer_email;
            $subject = "Your Order Status Is Change!!";
            $msg = "Hello ".$mainorder->customer_name."!\nYour Order Status Is : ".$mainorder->status. "&nbsp;&nbsp;Please wait for your delivery. \nThank you."."\n Order Number:".$mainorder->order_number."\n Order Total Amount:". $mainorder->pay_amount."\n Payment Method:".$mainorder->method;
            $headers = "From:XXXXXXXXXX ";
            $attach="your attach";
            mail($to,$subject,$msg,$headers);
            return redirect('admin/orders')->with('message','Order Status Updated Successfully');
        }
    }

    public function email($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.sendmail', compact('order'));
    }

    public function sendemail(Request $request)
    {
        mail($request->to,$request->subject,$request->message);
        return redirect('admin/orders')->with('message','Email Send Successfully');
    }
    
    public function bookslot(Request $request,$id)
    {
        $bookslot = OrderedProducts::findOrFail($id);
        
        $dateforslot = $request->input('dateforslot');
        $timeforslot = $request->input('timeforslot');
        
        $sts['book_slot_date'] = $dateforslot;
        $sts['book_slot_time'] = $timeforslot;
        
        $bookslot->update($sts);
        return redirect('admin/orders')->with('message','Slot is Booked');
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function serach(Request $request)
    {
        $fromdate =$request->fromdate;
        $todate = $request->todate;
        
        $vendorname = Vendors::all();
        
        $orders = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.booking_date','>=', $fromdate)
                    ->where('orders.booking_date','<=', $todate)
                    ->orderBy('id','desc')
                    ->get();
        
        $fromdateforpending =$request->fromdate;
        $todateforpending = $request->todate;
        
        $pending = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','pending')
                    ->where('orders.booking_date','>=', $fromdateforpending)
                    ->where('orders.booking_date','<=', $todateforpending)
                    ->orderBy('id','desc')
                    ->get();
        
        $fromdateforconfirmed =$request->fromdate;
        $todateforconfirmed = $request->todate;
        
        $confirmed = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','processing')
                    ->where('orders.booking_date','>=', $fromdateforconfirmed)
                    ->where('orders.booking_date','<=', $todateforconfirmed)
                    ->orderBy('id','desc')
                    ->get();
        
        $fromdateforpicked =$request->fromdate;
        $todateforpicked = $request->todate;
        
        $picked = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','picked')
                    ->where('orders.booking_date','>=', $fromdateforpicked)
                    ->where('orders.booking_date','<=', $todateforpicked)
                    ->orderBy('id','desc')
                    ->get();
        
        $fromdateforshipped =$request->fromdate;
        $todateforshipped = $request->todate;
        
        $shipped = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','InTransit')
                    ->where('orders.booking_date','>=', $fromdateforshipped)
                    ->where('orders.booking_date','<=', $todateforshipped)
                    ->orderBy('id','desc')
                    ->get();
        
        $fromdatefordelivered =$request->fromdate;
        $todatefordelivered= $request->todate;
       

        $delivered = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->where('orders.status','=','completed')
                    ->where('orders.booking_date','>=', $fromdatefordelivered)
                    ->where('orders.booking_date','<=', $todatefordelivered)
                    ->orderBy('id','desc')
                    ->get();

        $fromdateforseller =$request->fromdate;
        $todateforseller= $request->todate;  

        $seller = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.booking_date','>=', $fromdateforshipped)
                    ->where('orders.booking_date','<=', $todateforshipped)
                    ->orderBy('id','desc')
                    ->get();
        
        $products = OrderedProducts::get();
        return view('admin.orderlist',compact('orders','products','pending','confirmed','picked','shipped','delivered','seller','vendorname'));
    }


    public function searchvendor(Request $request)
    {
        $vendorname = Vendors::all();

        $searchvendor =$request->searchvendor;

        $seller = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('vendor_profiles.id','=', $searchvendor)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendororders =$request->searchvendor;

        $orders = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('vendor_profiles.id','=', $searchvendororders)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendorpending =$request->searchvendor;

        $pending = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.status','=', 'pending')
                    ->where('vendor_profiles.id','=', $searchvendorpending)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendorconfirmed =$request->searchvendor;

        $confirmed = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.status','=', 'processing')
                    ->where('vendor_profiles.id','=', $searchvendorconfirmed)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendorpicked =$request->searchvendor;

        $picked = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.status','=', 'picked')
                    ->where('vendor_profiles.id','=', $searchvendorpicked)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendorshipped =$request->searchvendor;

        $shipped = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.status','=', 'InTransit')
                    ->where('vendor_profiles.id','=', $searchvendorshipped)
                    ->orderBy('id','desc')
                    ->get();

        $searchvendordelivered =$request->searchvendor;

        $delivered = DB::table('ordered_products')
                    ->join('orders', 'ordered_products.orderid', '=', 'orders.id')
                    ->join('products', 'ordered_products.productid', '=', 'products.id')
                    ->join('vendor_profiles','ordered_products.vendorid','=','vendor_profiles.id')
                    ->select('orders.*','products.title','products.feature_image','products.price','vendor_profiles.name')
                    ->where('orders.status','=', 'completed')
                    ->where('vendor_profiles.id','=', $searchvendordelivered)
                    ->orderBy('id','desc')
                    ->get();
        
        $products = OrderedProducts::get();
        return view('admin.orderlist',compact('orders','products','pending','confirmed','picked','shipped','delivered','seller','vendorname'));
    }

    // export all data
    
    public function exportCsv(Request $request)
    {
       $fileName = 'allstatus.csv';
       $orders = DB::table('orders')
                    ->join('products', 'orders.products', '=', 'products.id')
                    ->select('orders.*','products.title','products.feature_image','products.price')
                    ->orderBy('id','desc')
                    ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;
                
                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    // export picked data


    public function exportpickedCsv(Request $request)
    {
        $fileName = 'picked.csv';
        $picked = DB::table('orders')
                ->join('products', 'orders.products', '=', 'products.id')
                ->select('orders.*','products.title','products.feature_image','products.price')
                ->where('orders.status','=','picked')
                ->orderBy('id','desc')
                ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($picked, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($picked as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;


                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }

    // export pending data

    public function exportpendingCsv(Request $request)
    {
        $fileName = 'pending.csv';
        $pending = DB::table('orders')
                ->join('products', 'orders.products', '=', 'products.id')
                ->select('orders.*','products.title','products.feature_image','products.price')
                ->where('orders.status','=','pending')
                ->orderBy('id','desc')
                ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($pending, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pending as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;


                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);


    }

    // export confirmed data

    public function exportconfirmedCsv(Request $request)
    {
        $fileName = 'confirmed.csv';
        $confirmed = DB::table('orders')
                ->join('products', 'orders.products', '=', 'products.id')
                ->select('orders.*','products.title','products.feature_image','products.price')
                ->where('orders.status','=','processing')
                ->orderBy('id','desc')
                ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($confirmed, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($confirmed as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;
                
                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    //export shipped data 

    public function exportshippedCsv(Request $request)
    {
        $fileName = 'shipped.csv';
        $shipped = DB::table('orders')
                ->join('products', 'orders.products', '=', 'products.id')
                ->select('orders.*','products.title','products.feature_image','products.price')
                ->where('orders.status','=','InTransit')
                ->orderBy('id','desc')
                ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($shipped, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($shipped as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;
                
                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    //     function generateShipRocketToken(){
    //     date_default_timezone_set('Asia/Kolkata');
        
    //     $param = array(
    //         CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS =>"{\n    \"email\": \"kaushik.elrica@gmail.com\",\n    \"password\": \"Goodday@1\"\n}",
    //         CURLOPT_HTTPHEADER => array(
    //             "Content-Type: application/json"
    //         ),
    //     );
                
    //     $curl = curl_init();
        
    //     curl_setopt_array($curl, $param);
        
    //     $SR_login_Response = curl_exec($curl);
        
    //     curl_close($curl);
        
    //     $SR_login_Response_out = json_decode($SR_login_Response);

    //     // echo"<pre>";
    //     // print_r($SR_login_Response_out);
    //     // echo "</pre>";
    //     // die();
    //     if($SR_login_Response_out) {
    //         $token = $SR_login_Response_out->{'token'};
    //     }

    //     dd($token);

    //     $added_on=date('Y-m-d h:i:s');
    //          DB::update("update shiprocket_token set token = $token , added_on='$added_on' where id=1");
        
    //     return $token;
    // }




//  function placeShipRocketOrder(){
//             $token = $this->generateShipRocketToken();
//             $id = $_POST['id'];
                
//             // $row_order=mysqli_fetch_assoc(mysqli_query($con,"select * from orders where id=$id"));

//             $row_order = DB::table('orders')
//                             ->select(DB::raw('*'))
//                             ->where('id', '=', $id)
//                             // ->groupBy('status')
//                             ->get();
//             dd($row_order);
//                 $order_date=$row_order['added_on'];
//                 $order_date_str=strtotime($order_date_str);
//                 $order_date=date('y-m-d h:i',$order_date_str);
//                 $customer_name=$row_order['customer_name'];
//                 $shipping_email=$row_order['shipping_email'];
//                 $customer_phone=$row_order['customer_phone'];
//                 $customer_address=$row_order['customer_address'];
//                 $customer_zip=$row_order['customer_zip'];
//                 $customer_city	=$row_order['customer_city'];
//                 $customer_country=$row_order['customer_country'];
//                 $customer_state=$row_order['customer_state'];
//                 $pay_amount=$row_order['pay_amount'];
                
//                 $html='';
//                 while($row=mysqli_fetch_assoc($res)){
//                     $html.='{
//                         "name": "'.$row['products'].'",
//                         "sku": "'.$row['quantities'].'",
//                         "units": '.$row['quantities'].',
//                         "selling_price": "'.$row['pay_amount'].'",
//                         "discount": "",
//                         "tax": "",
//                         "hsn": ""
//                     },';
//                 }
//                 $html=rtrim($html,",");

//                 $curl = curl_init();
//             curl_setopt_array($curl, array(
//                 CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => "",
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
//                 CURLOPT_POSTFIELDS =>'{"order_id": "'.$id.'",
//             "order_date": "order_date",
//             "pickup_location": "Delhi",
//             "billing_customer_name": "'.$customer_name.'",
//             "billing_last_name": "",
//             "billing_address": "'.$customer_address.'",
//             "billing_address_2": "Near Hokage House",
//             "billing_city": "'.$customer_city.'",
//             "billing_pincode": "'.$customer_zip.'",
//             "billing_state": "'.$customer_state.'",
//             "billing_country": "'.$customer_country.'",
//             "billing_email": "'.$shipping_email.'",
//             "billing_phone": "'.$customer_phone.'",
//             "shipping_is_billing": true,
//             "shipping_customer_name": "",
//             "shipping_last_name": "",
//             "shipping_address": "",
//             "shipping_address_2": "",
//             "shipping_city": "",
//             "shipping_pincode": "",
//             "shipping_country": "",
//             "shipping_state": "",
//             "shipping_email": "",
//             "shipping_phone": "",
//             "order_items": [
//                 {
//                     $html
//                 }
//             ],
//             "payment_method": "Prepaid",
//             "shipping_charges": 0,
//             "giftwrap_charges": 0,
//             "transaction_charges": 0,
//             "total_discount": 0,
//             "sub_total":"'.$pay_amount.'",,
//             "length": 10,
//             "breadth": 15,
//             "height": 20,
//             "weight": 2.5
//                 }',
//                 CURLOPT_HTTPHEADER => array(
//                 "Content-Type: application/json",
//                 "Authorization: Bearer $token"
//                 ),
//             ));
//             $SR_login_Response = curl_exec($curl);
//             curl_close($curl);
//             //$SR_login_Response_out = json_decode($SR_login_Response);
//             echo '<pre>';
//             print_r($SR_login_Response);
//             }

    public function exportdeliverdCsv(Request $request)
    {
        $fileName = 'delivered.csv';
        $delivered = DB::table('orders')
                ->join('products', 'orders.products', '=', 'products.id')
                ->select('orders.*','products.title','products.feature_image','products.price')
                ->where('orders.status','=','completed')
                ->orderBy('id','desc')
                ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Id', 'Date & Time', 'Customer Name', 'Customer Details', 'Billing Address','Shipping Address');

        $callback = function() use($delivered, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($delivered as $order) {
                $row['Order Id']  = $order->order_number;
                $row['Date & Time']    = $order->booking_date;
                $row['Customer Name']    = $order->customer_name;
                $row['Customer Details']  = $order->customer_email;
                $row['Billing Address']  = $order->customer_address;
                $row['Shipping Address']  = $order->shipping_address;


                fputcsv($file, array($row['Order Id'], $row['Date & Time'], $row['Customer Name'], $row['Customer Details'], $row['Billing Address'], $row['Shipping Address']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }
    
    public function show_order($order_id)
    {
        $neworder = DB::table('api_temp_resp')->where('id', '=', $order_id)->get();
    }

}
