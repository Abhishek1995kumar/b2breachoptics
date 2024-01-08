<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use App\Product;
use App\ProductAttr;
use App\Vendors;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use DateTime;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Auth;
use stdClass;
use Illuminate\Support\Facades\Cache;

class ManualOrderController extends Controller
{

    public function __construct()
    {
        Cache::flush();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(session()->get('role')['s_role'] != 'r_1') exit("Manual Orders Not Access");

        if(count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['to'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['oo'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['op'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['rfp'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['it'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['delv'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }

        return view('admin.manualorderlist');
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
            $order = DB::table('ordered_products as op')
             ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
             ->leftjoin('admin', 'admin.username', '=', 'op.owner')
             ->leftjoin('user_profiles as up', 'up.email', '=', 'o.customer_email')
             ->leftjoin('products', 'products.id', '=', 'op.productid')
             ->select('op.*', 'o.shipping', 'up.bussiness_name', 'o.pickup_location', 'o.txnid', 'o.charge_id', 'o.booking_date', 'o.order_number', 'o.customer_zip', 'o.customer_country', 'o.customer_alt_phone', 'o.shipping_address',
             'o.shipping_name', 'o.shipping_email', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_city', 'o.shipping_zip', 'o.shipping_country', 'o.shipping_state', 'o.shipping_alternate_phone', 'o.pay_amount',
             'admin.name as A_Name', 'admin.email as A_Email', 'admin.phone as A_Phone', 'products.costprice as cost_price')
             ->where('op.id', $id)
             ->orderBy('id','desc')
             ->get()->toArray();
            // $orders = json_decode( json_encode($order[0]), true);
            $orders = $order[0];
            
            // echo "<pre>";
            // print_r($orders);
            // die();
            
            $tax = '';
            if($orders->categoryID == 63 || $orders->categoryID == 87 || $orders->premiumtype == "Sunglasses"){
                $tax += $orders->cost/100*18;
            }
            elseif($orders->categoryID == 72 || $orders->categoryID == 53 || $orders->premiumtype == 'Frames'){
                $tax += $orders->cost/100*12;
            }
            else{
                // $tax += '';
            }
            
            $emi = $tax*$orders->quantity;
            $subtotal = ($orders->cost*$orders->quantity)+$emi;
             
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
            // print_r($orders->cost);
            // print_r("\n");
            // print_r($orders);
            // die();
            // end new added code for new order functionlity

            $data = ['title' => 'Invoice'];
            // $dompdf->set_option('enable_html5_parser', TRUE);
            $pdf = PDF::loadView('invoice', compact('orders', 'array', 'tax', 'subtotal', 'emi'), $data);
            return $pdf->download('Invoice.pdf');

            // return $pdf->stream('Invoice.pdf');
        }


    // new code for create acknowladgeslip and pick up slip 


            public function acknowladgeslip($id)
            {
                $order = OrderedProducts::findOrFail($id);
                $data = ['title' => 'AcknowledgementSlip'];
                $pdf = PDF::loadView('acknowledgementslip', compact('order'),$data);
                return $pdf->stream('AcknowledgementSlip.pdf');
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
        $entry = Auth::user()->name;

        $i = 0;
        $var = "RCH";
        $year = Carbon::now();
        $cyear = substr($year->year, 2,4);
        $syear = Carbon::now();
        $nextyear = substr($syear->addYear(1)->year, 2,4);

        $invoice = $var . "/" . $cyear . "-" . $nextyear . "/" . $i;

        OrderedProducts::whereIn('id',$ids)->update(['status' => 'processing', 'order_accept_date' => $date, 'entry_by' => $entry]);

        $total_count = [];
        $processing_total = DB::table('ordered_products')->where('status','=','processing')->count();
        $pending_total = DB::table('ordered_products')->where('status','=','pending')->count();
        
        $total_count['processing_total'] = $processing_total;
        $total_count['pending_total'] = $pending_total;
        
        return response()->json(['status'=>'success', 'msg'=>'Selected Orders Are Accepted...!', 'data'=>$total_count]);
    }


            public function confirmallselectedorders(Request $request){

                 $ids = $request->ids;
                 $date = date('Y-m-d');

                 OrderedProducts::whereIn('id',$ids)->update(['status' => 'picked','order_confirm_date'=> $date ]);

                 return redirect('admin/manualorders')->with('message','Order Status Updated Successfully...!');



            }




    //end of new code for create acknowladgeslip and pickup slip


    // functions for return and cancel modules

        public function returnorderview(){
            if(count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['rro'])) == 0 &&
                count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['vro'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
            }

            $adminorderreturn = DB::table('ordered_products')->where('status','=','return')->where('owner','=','admin')->orderBy('id','desc')->get();
            $vendororderreturn = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->orderBy('id','desc')->get();
            return view('admin.returnorderlist',compact('adminorderreturn','vendororderreturn'));


        }

        public function cancelorderview(){
            if(count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['rco'])) == 0 &&
                count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['vco'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
            }
            $adminordercancel = DB::table('ordered_products')->where('status','=','cancelled')->where('owner','=','admin')->orderBy('id','desc')->get();
            
            $vendorordercancel = DB::table('ordered_products')->where('status','=','cancelled')->where('owner','=','vendor')->orderBy('id','desc')->get();
            return view('admin.cancelorderlist',compact('adminordercancel','vendorordercancel'));

        }

        public function returnorderdetails($id){
            if(count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['rro'])) == 0 &&
                count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['vro'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
            }

            $allcanceldata = OrderedProducts::findOrFail($id);
            return view('admin.returnorderdetails',compact('allcanceldata'));
        }


        public function cancelorderdetails($id){
            if(count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['rco'])) == 0 &&
                count(array_intersect(['V', 'P'], session()->get('role')['role_actions']['vco'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
            }

            $allcanceldata = OrderedProducts::findOrFail($id);
            $allcancelTax = Category::findOrFail($allcanceldata->categoryID);
            
            return view('admin.cancelorderdetails',compact('allcanceldata', 'allcancelTax'));

        }


        public function loadvendorlist()
        {   
            if(count(array_intersect(['V', 'U', 'A', 'C'], session()->get('role')['role_actions']['pv'])) == 0 &&
                count(array_intersect(['V', 'U', 'A', 'C'], session()->get('role')['role_actions']['pvd'])) == 0 &&
                count(array_intersect(['V', 'U', 'A', 'C'], session()->get('role')['role_actions']['pvdc'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
            }
           $Accept = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','accept')->orderBy('id','desc')->get();
           $Intransit = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','intransit')->orderBy('id','desc')->get();
           $Completed = DB::table('ordered_products')->where('status','=','return')->where('owner','=','vendor')->where('return_status','=','completed')->orderBy('id','desc')->get();
            return view('admin.returnvendorlist',compact('Accept','Intransit','Completed'));
        }

        public function loadadminlist(){
            $Accept = DB::table('ordered_products')->where('status','=','return')->where('owner','=','admin')->where('return_status','=','accept')->orderBy('id','desc')->get();

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
        return view('admin.manualorderdetails',compact('order','products'));
    }

    public function returnOrder($id, $status)
    {
        $order = OrderedProducts::findOrFail($id);
        $upsta['return_status'] = $status;

        if($status == 'completed'){
            if($order->productAttrId != ""){
                $attrdata = ProductAttr::findOrFail($order->productAttrId);

                $update['attr_qty'] = $attrdata->attr_qty + $order->quantity;
                $attrdata->update($update);
            }
            else{
                $data = Product::findOrFail($order->productid);

                $update['stock'] = $data->stock + $order->quantity;
                $data->update($update);
            }
        }

        if ($order->return_status == "completed"){
            return redirect('admin/manualorders')->with('message','This Order is Already Completed');
        }else{
            if($upsta['return_status'] == 'intransit'){
                // print_r("hiiii");
                $data = new DateTime();
                $upsta['return_intransit_date'] = $data;
                $upsta['entry_by'] = Auth::user()->name;
            }
            else if($upsta['return_status'] == 'completed'){
                $data = new DateTime();
                $upsta['return_completed_date'] = $data;
                $upsta['entry_by'] = Auth::user()->name;
            }
        }
        DB::table('ordered_products')->where('id', $id)->update($upsta);
        return redirect('admin/return/order/adminlist')->with('message','Order Status Updated Successfully');
    }

    public function status(Request $request)
    {
        // print_r($_POST);die();
        $id = $request->all()['id'];
        $status = $request->all()['status'];
       
        if(count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['oo'])) == 0 &&
            count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['op'])) == 0 &&
            count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['rfp'])) == 0 &&
            count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['it'])) == 0)
        {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        
        $mainorder = OrderedProducts::findOrFail($id);
        
        if($status == 'cancelled'){
            if($mainorder->productAttrId != ""){
                $attrdata = ProductAttr::findOrFail($mainorder->productAttrId);

                $update['attr_qty'] = $attrdata->attr_qty + $mainorder->quantity;
                $attrdata->update($update);
            }
            else{
                $data = Product::findOrFail($mainorder->productid);

                $update['stock'] = $data->stock + $mainorder->quantity;
                $data->update($update);
            }
        }
        
        if ($mainorder->status == "completed"){
            return response()->json(['status'=>true, 'msg'=>'This Order is Already Completed']);
        }else{
            $stat['status'] = $status;

            $ordersnew = OrderedProducts::where('orderid',$id)->get();
           
            foreach ($ordersnew as $statusnew){

                $ordernew = OrderedProducts::findOrFail($statusnew->id);

                $upsta['status'] = $status;
                    
                if($upsta['status'] == 'processing'){
                    $data = new DateTime();
                    $upsta['order_accept_date'] = $data;
                    $upsta['entry_by'] = Auth::user()->name;
                }
                else if($upsta['status'] == 'picked'){
                    $data = new DateTime();
                    $upsta['pickup_date'] = $data;
                    $upsta['entry_by'] = Auth::user()->name;
                }
                else if($upsta['status'] == 'cancelled'){
                    $data = new DateTime();
                    $upsta['canceled_date'] = $data;
                    $upsta['entry_by'] = Auth::user()->name;
                }
                
                $ordernew->update($upsta);


            }

        // end new added code for order module

        if ($status == "completed"){
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
                $date = new DateTime();
                $sts['order_confirm_date'] = $date;
                $sts['entry_by'] = Auth::user()->name;
                
                $order->update($sts);
            }
        }
        
        if($stat['status'] == 'processing'){
            $data = new DateTime();
            $stat['order_accept_date'] = $data;
            $stat['entry_by'] = Auth::user()->name;
        }
        else if($stat['status'] == 'picked'){
            $data = new DateTime();
            $stat['pickup_date'] = $data;
            $stat['entry_by'] = Auth::user()->name;
             // Nik 07/08/2023
            $this->create_order_shiprocket($id,$status);
        }
        else if($stat['status'] == 'cancelled'){
            $data = new DateTime();
            $stat['canceled_date'] = $data;
            $stat['entry_by'] = Auth::user()->name;
        }

        $mainorder->update($stat);
        
        $total_count = [];
        $processing_total = DB::table('ordered_products')->where('status','=','processing')->count();
        $picked_total = DB::table('ordered_products')->where('status','=','picked')->count();
        $intransit_total = DB::table('ordered_products')->where('status','=','InTransit')->count();
        $completed_total = DB::table('ordered_products')->where('status','=','completed')->count();
        $pending_total = DB::table('ordered_products')->where('status','=','pending')->count();

        $total_count['processing_total'] = $processing_total;
        $total_count['picked_total'] = $picked_total;
        $total_count['intransit_total'] = $intransit_total;
        $total_count['completed_total'] = $completed_total;
        $total_count['pending_total'] = $pending_total;
        
        // for mail notification
        // $to = $mainorder->customer_email;
        // $subject = "Your Order Status Is Change!!";
        // $msg = "Hello ".$mainorder->customer_name."!\nYour Order Status Is : ".$mainorder->status. "&nbsp;&nbsp;Please wait for your delivery. \nThank you."."\n Order Number:".$mainorder->order_number."\n Order Total Amount:". $mainorder->pay_amount."\n Payment Method:".$mainorder->method;
        // $headers = "From:XXXXXXXXXX ";
        // $attach="your attach";
        // mail($to,$subject,$msg,$headers);
        return response()->json(['status'=> true, 'msg'=>'Order Status Updated Successfully', 'data'=>$total_count]);
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
        return redirect('admin/manualorders')->with('message','Email Send Successfully');
    }


    public function courier_boy(Request $request) {
        if(count(array_intersect(['V', 'U', 'A', 'C', 'N', 'D'], session()->get('role')['role_actions']['rro'])) == 0) {
                exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        
        $bookslot = OrderedProducts::findOrFail($request['id']);
        
        $status = $request['status'];
        $cpurierboy = $request['courier_boy'];

        $sts['status'] = $status;
        $sts['courier_boy'] = $cpurierboy;
        $sts['intransit_date'] = new DateTime();
        $sts['entry_by'] = Auth::user()->name;
        
        $bookslot->update($sts);
        
        $total_count = [];
        $picked_total = DB::table('ordered_products')->where('status','=','picked')->count();
        $intransit_total = DB::table('ordered_products')->where('status','=','InTransit')->count();
        $total_count['picked_total'] = $picked_total;
        $total_count['intransit_total'] = $intransit_total;
        
        return response()->json(['status'=> true, 'msg'=>'Slot is Booked', 'data'=>$total_count]);
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


    public function serach(Request $request){
        if(count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['to'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['oo'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['op'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['rfp'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['it'])) == 0 && 
            count(array_intersect(['V', 'U', 'A', 'C', 'P', 'N'], session()->get('role')['role_actions']['delv'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }

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
        return view('admin.manualorderlist',compact('orders','products','pending','confirmed','picked','shipped','delivered','seller','vendorname'));


    }


    public function searchvendor(Request $request){

        $vendorname = Vendors::all();

        $searchvendor =$request->searchvendor;

        // dd($searchvendor);
        
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
        return view('admin.manualorderlist',compact('orders','products','pending','confirmed','picked','shipped','delivered','seller','vendorname'));
    }

    // export all data
    public function exportCsv(Request $request)
    {
        if(!in_array('P', session()->get('role')['role_actions']['to']) && !in_array('P', session()->get('role')['role_actions']['op'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
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


        public function exportpickedCsv(Request $request){

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

        public function exportpendingCsv(Request $request){

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
        public function exportconfirmedCsv(Request $request){
            
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

            $callback = function() use($confirmed, $columns) {
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

        public function exportshippedCsv(Request $request){

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

        public function exportdeliverdCsv(Request $request){

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
            
    public function get_reach_cancel_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_reach_cancel_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_reach_cancel_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($order_details_total as $row => $vals) {

            // $start++;
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            // $nestedData[] = $start;
            
            
            $actionButton .= "<a href='manualorders/status/" . $vals->id . "/picked' class='btn btn-success'>Confirm</a>";
            
            $eyeButton = "<td class='text-center' style='font-size: 15px;'><a href='cancel/order/view/". $vals->id ."'><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            
            if($vals->status == 'cancelled'){
                $status = "<td class='text-center' style='font-size: 15px;color:red'>Admin Cancelled</td>";
            }
            else{
                $status = "<td class='text-center'>User Cancelled</td>";
            }

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->canceled_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            if($vals->vendorname != ""){
                $nestedData[] = $vals->vendorname;
            }
            else{
                $nestedData[] = "REACH";
            }
            $nestedData[] = $eyeButton;
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $status;
            
            $data[] = $nestedData;
        }
        
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
            
        );

        echo json_encode($output);
    }
    
    public function get_reach_cancel_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        // DB::enableQueryLog();
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where(function($query){
                    $query->where('op.status','=','cancelled');
                    $query->orwhere('op.status','=','declined');
                })
                ->orderBy('op.order_accept_date','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                        ->select('op.*')
                        ->where('op.status','=','cancelled')
                        ->orwhere('op.status','=','declined')
                        ->orderBy('op.updated_at','desc');
                        
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }

            
    public function get_vendor_cancel_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_vendor_cancel_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_vendor_cancel_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($order_details_total as $row => $vals) {

            // $start++;
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            // $nestedData[] = $start;
            
            
            $actionButton .= "<a href='manualorders/status/" . $vals->id . "/picked' class='btn btn-success'>Confirm</a>";
            
            $eyeButton = "<td class='text-center' style='font-size: 15px;'><a href='cancel/order/view/". $vals->id ."'><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            
            if($vals->status == 'cancelled'){
                $status = "<td class='text-center' style='font-size:15px; color:red'>Admin Cancelled</td>";
            }
            else{
                $status = "<td class='text-center' style='font-size: 15px; color:red'>User Cancelled</td>";
            }

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->canceled_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            if($vals->vendorname != ""){
                $nestedData[] = $vals->vendorname;
            }
            else{
                $nestedData[] = "REACH";
            }
            $nestedData[] = $eyeButton;
            
            $data[] = $nestedData;
        }
        
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_vendor_cancel_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where(function($query){
                    $query->where('op.status','=','cancelled');
                    $query->orwhere('op.status','=','declined');
                })
                ->orderBy('op.order_accept_date','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                        ->select('op.*')
                        ->where('op.status','=','cancelled')
                        ->orwhere('op.status','=','declined')
                        ->orderBy('op.order_accept_date','desc');
                        
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }
    
    public function get_order_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_order_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_order_data(true, $search_term, $other_configs);
      
        $data = array();
      
        foreach($order_details_total as $row => $vals) {

            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            
            if(in_array('A', session()->get('role')['role_actions']['oo'])) {
                $checkButton = "<td class='text-center' style='font-size: 15px;'><input type='checkbox'  name='ids' value='" . $vals->id . "' class='checkBoxClass'></td>";
            
                $actionButton = "<div class='pull-left'><a href='javascript:void(0)' style='padding: 0;' action='processing' onclick='orderAcceptAndReject(".$vals->id.", event)' class='btn btn-xs btn-success'><i style='padding: 3px 5px;' class='fa fa-check-square' style='font-size:15px'></i></a></div>";
            }
            
            if(in_array('C', session()->get('role')['role_actions']['oo'])) {
                $actionButton .= "<div class='pull-right'><a href='javascript:void(0)' style='padding: 0;' action='cancelled' onclick='orderAcceptAndReject(".$vals->id.", event)' class='btn btn-xs btn-danger'><i style='padding: 3px 5px;' class='fa fa-close' style='font-size:15px'></i></a></div>";
            }
            
            if(in_array('V', session()->get('role')['role_actions']['oo'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            }
            
            $nestedData[] = $checkButton;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $eyeButton;
            $nestedData[] = $actionButton;
            
            $data[] = $nestedData;
        }
        
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_order_data($count, $search_term = '', $other_configs)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where('op.status','=','pending')
                ->orderBy('op.created_at','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                    ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                    ->select('op.*')
                    ->where('op.status','=','pending')
                    ->orderBy('op.created_at','desc');
                        
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

            
    public function get_order_process_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_order_process_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_order_process_data(true, $search_term, $other_configs);
        
        $data = array();
      
        foreach($order_details_total as $row => $vals) {

            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            $invoice = json_encode($vals->invoice_number);
            $status = "processing";
            if(in_array('U', session()->get('role')['role_actions']['op'])) {
                $checkButton = "<td class='text-center' style='font-size: 15px;'><input type='checkbox'  name='idsnew' value='" . $vals->id . "' class='checkBoxClass'></td>";
                
                $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='orderConfirm(".$vals->id.", event)'  class='btn btn-success'>Confirm</a>";
                
                // Nik commit this point
                
                // if($vals->invoice_number){
                //     $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='orderConfirm(".$vals->id.", event)'  class='btn btn-success'>Confirm</a>";
                // }
                // else
                // {
                //     $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='alertmassege()'  class='btn btn-success'>Confirm</a>";
                // }
                    
            }

            if(in_array('V', session()->get('role')['role_actions']['op'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px; color:#1ca24c;'></i></a></td>";
            }

            if(in_array('P', session()->get('role')['role_actions']['op'])) {
            $eyeButton .= "<br><a href='javascript:void(0)' id='combine_order' data-status=".$status." onclick='view_combine_order(".$vals->id.", ".$vals->orderid.", ".$invoice.", event)' style='color: #0f110e;'><i class='fa fa-print' aria-hidden='true'></i></a>";
            }

            if(in_array('P', session()->get('role')['role_actions']['op'])) {
                if($vals->invoice_number != ""){
                    $pdfBtn = url('manualgeneratePDF/'.$vals->id);
                    $eyeButton .= "<br><a href='$pdfBtn' style='color: red;'><i class='fa fa-arrow-down' aria-hidden='true'></i></a>";
                }
                else
                {
                    $eyeButton .= "<br><a href='javascript:void(0)' onclick='invoiceDowload()' style='color: red;'><i class='fa fa-arrow-down' aria-hidden='true'></i></a>";
                }
                    
            }
            
            $nestedData[] = $checkButton;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->order_accept_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $eyeButton;
            $nestedData[] = $actionButton;
            
            $data[] = $nestedData;
        }
     
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_order_process_data($count, $search_term = '', $other_configs)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.order_accept_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where('op.status','=','processing')
                ->orderBy('op.order_accept_date','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                        ->select('op.*')
                        ->where('op.status','=','processing')
                        ->orderBy('op.order_accept_date','desc');
                        
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

    public function get_total_order_details(Request $request){
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $order_details_total = $this->get_total_order_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_total_order_data(true, $search_term, $other_configs);
        
        $data = array();
        foreach($order_details_total as $row => $vals) {

            $nestedData = array();

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->order_accept_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $vals->status;
            
            $data[] = $nestedData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }

    public function get_total_order_data($count, $search_term = '', $other_configs){
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('orderid', $search_term);
                $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.order_accept_date', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('op.*')
            ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
            ->where('op.status','=','processing')
            ->orderBy('op.order_accept_date','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products as op')
                    ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                    ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
                    ->select('op.*','pro.previous_price','pro.modelno as modelno', 'o.customer_zip', 'o.cost as cost_price', 'o.pay_amount')
                    ->orderBy('op.id','desc');

            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }

        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

    public function get_ready_for_pickup_details(Request $request){
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $order_details_total = $this->get_ready_for_pickup_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_ready_for_pickup_data(true, $search_term, $other_configs);
        
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';

            if(in_array('V', session()->get('role')['role_actions']['rfp'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            }
            
            if(in_array('U', session()->get('role')['role_actions']['rfp'])){
                $shipButton = "<a onclick='shipnow_modal(".$vals->id.")'><button class='btn btn-success' >Ship Now</button></a><br><br>
                                <a onclick='cancel_order_modal(".$vals->id.")'><button class='btn btn-primary' >Cancel Order</button></a>";
            }
            
            if(in_array('U', session()->get('role')['role_actions']['rfp']))
            {
                $actionButton = "<a onclick='list_manifest(".$vals->id.")'><button class='btn btn-primary' > List Manifest</button></a>";
                
            }

            // if(in_array('U', session()->get('role')['role_actions']['rfp'])){
            //     $actionButton = "<a onclick='pickupModelShow(".$vals->id.")'><button class='btn btn-primary' >Pickup</button></a>";
            // }

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->pickup_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $eyeButton;
            $nestedData[] = $shipButton;
            $nestedData[] = $actionButton;
            $data[] = $nestedData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }

    public function get_ready_for_pickup_data($count, $search_term = '', $other_configs){
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('orderid', $search_term);
                $query->orwhere('product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('order_accept_date', 'like', '%' . $search_term . '%');
                $query->orwhere('quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('cost', 'like', '%' . $search_term . '%');
                $query->orwhere('vendorname', 'like', '%' . $search_term . '%');
                $query->orwhere('buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('*')
            ->where('status','=','picked')
            ->orderBy('pickup_date','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')->where('status','=','picked')->orderBy('pickup_date','desc');

            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

    public function get_in_transit_details(Request $request){
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $order_details_total = $this->get_in_transit_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_in_transit_data(true, $search_term, $other_configs);
        
        
         //get all ready for pickup data SHIPROCKET API
        $all_picked_data = DB::select(DB::raw("select * from ordered_products where status = 'picked'"));

        $this->intransit_check_shiprocket($all_picked_data);

        
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';

            if(in_array('V', session()->get('role')['role_actions']['it'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            }

            if(in_array('U', session()->get('role')['role_actions']['it'])){
                $actionButton = "<button action='completed' onclick='orderDelivered(".$vals->id.", event)' class='btn btn-primary' >Delivered</button>";
            }

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->intransit_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->courier_boy;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $eyeButton;
            $nestedData[] = $actionButton;
            
            $data[] = $nestedData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }

    public function get_in_transit_data($count, $search_term = '', $other_configs){
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('orderid', $search_term);
                $query->orwhere('product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('order_accept_date', 'like', '%' . $search_term . '%');
                $query->orwhere('quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('cost', 'like', '%' . $search_term . '%');
                $query->orwhere('courier_boy', 'like', '%' . $search_term . '%');
                $query->orwhere('vendorname', 'like', '%' . $search_term . '%');
                $query->orwhere('buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('*')
            ->where('status','=','InTransit')
            ->orderBy('id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')->where('status','=','InTransit')->orderBy('id','desc');

            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

    public function get_delivered_details(Request $request){
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $order_details_total = $this->get_delivered_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_delivered_data(true, $search_term, $other_configs);
            
        $all_intranshit_data = DB::select(DB::raw("select * from ordered_products where status = 'intransit'"));

        $this->delivered_check_shiprocket($all_intranshit_data); 
            
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $eyeButton = '';
        
            $invoice = json_encode($vals->invoice_number);
            $status = "completed";

            if(in_array('V', session()->get('role')['role_actions']['delv'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            }
            
            if(in_array('V', session()->get('role')['role_actions']['delv'])) {
                $eyeButton .= "<br><a href='javascript:void(0)' data-status=".$status." onclick='view_combine_order(".$vals->id.", ".$vals->orderid.", ".$invoice.", event)' style='color: #0f110e;'><i class='fa fa-print' aria-hidden='true'></i></a>";
            }
            
             if(in_array('V', session()->get('role')['role_actions']['delv'])) {
                $return_order = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='return_order_shiprocket(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-rotate-right' style='color:red'>Return Order</i></a></td>";
            }

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->order_confirm_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "REACH";
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $eyeButton;
            $nestedData[] = $return_order;
            
            $data[] = $nestedData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }

    public function get_delivered_data($count, $search_term = '', $other_configs)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('orderid', $search_term);
                $query->orwhere('product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('created_at', 'like', '%' . $search_term . '%');
                $query->orwhere('order_confirm_date', 'like', '%' . $search_term . '%');
                $query->orwhere('quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('cost', 'like', '%' . $search_term . '%');
                $query->orwhere('vendorname', 'like', '%' . $search_term . '%');
                $query->orwhere('buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('*')
            ->where('status','=','completed')
            ->orderBy('id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')->where('status','=','completed')->orderBy('id','desc');

            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
    }

    public function order_details_fetch(Request $request)
    {
        $order_pro_id = isset($request->all()['order_pro_id']) ? $request->all()['order_pro_id'] : '';
        
        if(!$order_pro_id){
            return response()->json(['status'=> false, 'msg'=>'Order id not Found']);
        }

        $order_pro_details = DB::table('ordered_products as op')
        ->leftjoin('prescription as pres', 'op.id', '=', 'pres.ordered_id')
        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
        ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
        ->leftjoin('b2b_citymaster as cy', 'op.buyer_city', '=', 'cy.id')
        ->leftjoin('b2b_statemaster as st', 'op.buyer_state', '=', 'st.id')
        ->where('op.id', '=', $order_pro_id)
        ->select('op.*','pro.previous_price','pro.modelno as modelno', 'pro.producttat', 'pres.order_id', 'pres.category', 'pres.minus_left_eye', 'pres.minus_right_eye', 'pres.main_price',
        'pres.rangenameone', 'pres.rangenametwo', 'pres.rangenamethree', 'pres.price as presPrice', 'pres.presc_image', 'pres.lefteyequantity',
        'pres.righeyequantity', 'pres.base_curv', 'pres.dia', 'pres.Lsphere', 'pres.Lpower', 'pres.LDia', 'pres.LBc', 'pres.Laxis', 'pres.Lcyle', 'pres.lva',
        'pres.same_rx_both', 'pres.rsphere', 'pres.rpower', 'pres.rbc', 'pres.rdia', 'pres.Raxis', 'pres.rcyl', 'pres.rva', 'pres.bsphere', 'pres.bpower', 'pres.botheyequantity',
        'pres.Bbc', 'pres.Bdia', 'pres.Bcyle','pres.frame_fit as frame_fit' ,'pres.Baxis', 'pres.totalPd', 'pres.Lepd', 'pres.Repd', 'o.customer_zip', 'o.cost as cost_price', 'o.pay_amount', 'cy.Name as cname',
        'st.Name as sname', 'pres.a_size', 'pres.b_size', 'pres.dbl', 'pres.r_dia', 'pres.r_pd', 'pres.l_pd',
        'pres.bvd', 'pres.r_ed', 'pres.l_ed', 'pres.r_fitting', 'pres.l_fitting', 'pres.pantascopic', 'pres.temple_size',
        'pres.network_distance', 'pres.bow_angle', 'pres.frame_type', 'pres.materials', 'pres.shape_code', 'o.couponAmount', 'o.order_note')
        ->orderBy('op.id','desc')
        ->get();
        
        return response()->json(['status'=> true, 'msg'=>'Order fetch', 'order_pro_details'=>$order_pro_details]);
    }
    
    // Prashant
    public function combine_details_fetch(Request $request)
    {
        $order_id = isset($request->all()['order_id']) ? $request->all()['order_id'] : '';
        if(!$order_id){
            return response()->json(['status'=> false, 'msg'=>'Order id not Found']);
        }

        $orderproduct = OrderedProducts::whereNotNull('invoice_number')
                        ->orderBy('updated_at', 'desc')
                        ->limit(1)
                        ->get()->toArray();
        
        $invoice = "";
        if(count($orderproduct) > 0)
        {
            $value = $orderproduct[0]['invoice_number'];
            $data = explode('/', $value);
            $num = (int)$data[2];
            $invoice_series = $num+1;
            
            $date = date('Y-m-d');
            $entry = Auth::user()->name;
    
            $last = str_pad($invoice_series,6,"0",STR_PAD_LEFT);
            $var = "RCH";
            $year = Carbon::now();
            $cyear = substr($year->year, 2,4);
            $syear = Carbon::now();
            $nextyear = substr($syear->addYear(1)->year, 2,4);
    
            $invoice = $var . "/" . $cyear . "-" . $nextyear . "/" . $last;
    
            OrderedProducts::where('orderid',$order_id)
                            ->where('status', '=','processing')
                            ->whereNull('invoice_number')
                            ->update(['invoice_number' => $invoice]);
        }
        else
        {
            $invoice_series = 1;
            $date = date('Y-m-d');
            $entry = Auth::user()->name;
    
            $last = str_pad($incvalue,6,"0",STR_PAD_LEFT);
            $var = "RCH";
            $year = Carbon::now();
            $cyear = substr($year->year, 2,4);
            $syear = Carbon::now();
            $nextyear = substr($syear->addYear(1)->year, 2,4);
    
            $invoice = $var . "/" . $cyear . "-" . $nextyear . "/" . $invoice_series;
    
            OrderedProducts::where('orderid',$order_id)
                            ->where('status', '=','processing')
                            ->whereNull('invoice_number')
                            ->update(['invoice_number' => $invoice]);
        }
        
        DB::enableQueryLog();
        $datas = DB::table('ordered_products as op')
        ->where('op.orderid', '=', $order_id)
        ->where('op.status', '=',$request->status)
        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
        ->leftjoin('categories', 'categories.id', '=', 'op.categoryID')
        ->leftjoin('categories as k','k.name', '=', 'op.premiumtype')
        ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
        ->leftjoin('user_profiles','o.customer_phone', '=', 'user_profiles.phone')
        ->leftjoin('b2b_citymaster','op.buyer_city','=','b2b_citymaster.id')
        ->leftjoin('b2b_statemaster','op.buyer_state','=','b2b_statemaster.id')
        ->select('user_profiles.*','op.*','o.customer_name as buyer_name','b2b_statemaster.Name as buyer_state','b2b_citymaster.Name as buyer_city','o.customer_Address as address','o.customer_zip as pincode','k.tax as tax1','o.customer_email as cus_email','pro.modelno as modelno','pro.hsncode as hsn_code','pro.costprice as cost_price','o.pay_amount as pay_amount','categories.tax as tax')
        ->orderBy('op.orderid','desc');

        if($request->invoice != ""){
            $datas->where('op.invoice_number', '=', $request->invoice);
        }
        else{
            $datas->where('op.invoice_number', '=', $invoice);
        }
        $order_details = $datas->get();
        return response()->json(['status'=> true, 'msg'=>'Order fetch', 'order_details'=>$order_details]);
    }
    
    // Nik 07/08/2023
     
    // step 1  ShipRocket
    public function Authenticate_shiprocket()
    {
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
            CURLOPT_POSTFIELDS =>"{\n    \"email\": \"nikhil.jamztudioz@gmail.com\",\n    \"password\": \"123456\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        );

        $curl = curl_init();
        curl_setopt_array($curl, $param);
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);
        if($SR_login_Response_out) 
        {
            $token = $SR_login_Response_out->{'token'};
        }
        return $token;
    }
    
   // step 2  ShipRocket 
   
    public $manage_pickup_address = 'Primary';
   
    public function create_order_shiprocket($id,$status)
    {
        $token_no = $this->Authenticate_shiprocket();
        
        $order_id = DB::table('ordered_products as oo')
                ->select('oo.orderid')
                ->where('oo.id',$id)->get();
       
        $order_id = $order_id[0]->orderid;
       
        $get_order_data = DB::table('orders as o')
                            ->select('o.*', 'op.cost', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock','country.Name as customer_country','state.Name as customer_state','city.Name as customer_city')
                            ->leftjoin('ordered_products as op', 'o.id', '=', 'op.orderid')
                            ->leftjoin('products as p', 'p.id', '=', 'op.productid')
                            ->leftjoin('b2b_countrymaster as country','country.id', '=', 'o.customer_country')
                            ->leftjoin('b2b_statemaster as state','state.id', '=', 'o.customer_state')
                            ->leftjoin('b2b_citymaster as city','city.id', '=', 'o.customer_city')
                            ->where('op.orderid', $order_id)->get();
                            
        // if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        // else {
            foreach($get_order_data as $rows => $val) {
                $product_id_array = explode(",", $val->products);
                $product_index = array_search($status, $product_id_array);
                $data['order_id'] = $val->id;
                $data['order_date'] = $val->booking_date;
                $data['pickup_location'] = $this->manage_pickup_address;
                $data["channel_id"] =  "";
                $data["comment"] = "Reseller: M/s Goku";
                if($val->customer_name != '') 
                {
                    if(str_contains($val->customer_name, ' ') === true) 
                    {
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
                $data['billing_last_name'] = $val->customer_name;

                if( isset($val->shipping_is_billing) && ($val->shipping_is_billing != ''))
                {
                    $data['shipping_is_billing'] = $val->shipping_is_billing;
                }
                else $data['shipping_is_billing'] = true;
                
                if($val->shipping_name == '') 
                {
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
                    $data["shipping_phone"] = $val->customer_phone;
                }
                $data['order_items'][] = [
                    "name" => $val->title,
                    "sku" => (($val->productsku != '') ? $val->productsku : 'chakra123'),
                    "units" => explode(",", $val->quantities)[$product_index], //here issue
                    "selling_price" => isset($val->price) ? $val->price : 10,
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
                $data['length'] = isset($val->length) ? $val->length : 10;
                $data['breadth'] = isset($val->breadth) ? $val->breadth : 10;
                $data['height'] = isset($val->height) ? $val->height : 10;
                
                if($val->weight != '') {
                    $data['weight'] = $val->weight/1000;
                } else $data['weight'] = '';
            }
            
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
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
           
            if(!isset($SR_generate_order_out->errors)) 
            {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'order_product_id'=>$id,
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
            DB::table('api_temp_resp')->insert($insert_data);
            return back()->with('message', 'Shiprocket order create successfully.');
        // }
    }

    // step 3  ShipRocket
    
    public function shipnow_courier_patner(Request $request)
    {
        $token_no = $this->Authenticate_shiprocket();
        $order_product_id = $_POST['id'];
        $result = DB::table('api_temp_resp')
                ->leftjoin('orders', 'orders.id', '=', 'api_temp_resp.order_id')
                ->leftjoin('products','products.id', '=', 'orders.products')
                ->select('api_temp_resp.*','orders.customer_zip as delivery_postcode','products.weight as weight')
                ->where('order_product_id',$order_product_id)
                ->get()
                ->toArray();

        $Pickup_location_Address = $this->Pickup_location_Address();

        $shipping_address_name = $Pickup_location_Address->data->shipping_address;
        $pickup_pincode = 0;
        
        foreach($shipping_address_name as $val)
        {
            if($val->pickup_location == $this->manage_pickup_address)
            {
                $pickup_pincode = $val->pin_code;   
            }
        }

        if(count($result) <= 0){
            return response()->json(['status'=>'error', 'msg'=>'Courier Partner Not Found']);

        }
        // $data['shipment_id'] = $result[0]->shipment_id;
        $data['pickup_postcode'] = $pickup_pincode;
        $data['delivery_postcode'] = $result[0]->delivery_postcode ? $result[0]->delivery_postcode : 0;
        $data['weight'] = $result[0]->weight;
        $data['cod'] = 1;
        $data['order_id'] = $result[0]->api_order_id;

        $param = array(
            CURLOPT_URL =>"https://apiv2.shiprocket.in/v1/external/courier/serviceability/",
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
        $ship_courier_patner = curl_exec($curl);
        curl_close($curl);
        $list_courier_patner = json_decode($ship_courier_patner);
        
        // print_r($list_courier_patner);die()
        return response()->json(['status'=>'success', 'msg'=>'Courier Partner Found', 'data'=>$list_courier_patner]);
    }
    
    // Step 4
    public function Pickup_location_Address()
    {
        $token_no = $this->Authenticate_shiprocket();
        $param = array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/settings/company/pickup",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token_no,
            ),
        );
        $curl = curl_init();
        curl_setopt_array($curl, $param);
        $Pickup_location_Address = curl_exec($curl);
        curl_close($curl);
        $Pickup_location_Address = json_decode($Pickup_location_Address);
        return $Pickup_location_Address;
    }
    
    // step 5 
    public function AWB()
    {
        $id = $_POST['id'];
        $courier_id = $_POST['courier_id'];
        
        $data = DB::table('api_temp_resp')->select('*')->where('order_product_id', $id)->get();
        $awb_code = $data[0]->awb_code;
        
        if($awb_code != "")
        {
            return response()->json(['status'=>'error', 'msg'=>'Awb code already generate Error']);
        }
        
        $shipment_id = $data[0]->shipment_id;
        $data['shipment_id'] = $shipment_id;
        $data['courier_id'] = $courier_id;
       
        $token_no = $this->Authenticate_shiprocket();

        $param = array(
            CURLOPT_URL =>"https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
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
        $generate_awb = curl_exec($curl);
        curl_close($curl);
        $generate_awb = json_decode($generate_awb);
        
        
        $order_product_id = $data[0]->order_product_id;

// print_r($generate_awb);die();
        //AWB IS Generate then show messsage  status_code  400
           
        $awb_code = $generate_awb->response->data->awb_code;
        $courier_name = $generate_awb->response->data->courier_name;
        
        // shipper_address_1 shipper_city shipper_state shipper_country shipper_postcode shipper_phone
        $shiper_company_name = $generate_awb->response->data->shipped_by->shipper_company_name;
        $shipper_address_1 = $generate_awb->response->data->shipped_by->shipper_address_1;
        $shipper_address_2 = $generate_awb->response->data->shipped_by->shipper_address_2;
        $shipper_city = $generate_awb->response->data->shipped_by->shipper_city;
        $shipper_state = $generate_awb->response->data->shipped_by->shipper_state;
        $shipper_postcode = $generate_awb->response->data->shipped_by->shipper_postcode;
        $shipper_phone = $generate_awb->response->data->shipped_by->shipper_phone;
        
        $pickup_full_address = $shiper_company_name .' '.$shipper_address_1.' '.$shipper_address_2.' '.$shipper_city .' '.$shipper_state.' '.$shipper_postcode;
        
        // print_r($shipper_full_address);die();
        
        //Save AWB CODE in Database
        DB::statement("update `api_temp_resp` set `awb_code` = '$awb_code', `courier_name` = '$courier_name', `pickup_address` = '$pickup_full_address' where `order_product_id` = $order_product_id");
        
        // print_r($data);die();
        return response()->json(['status'=>'success', 'msg'=>'Courier Partner Found', 'data'=>$generate_awb]);
    }
    
    public function pickup_date_update()
    {
        $token_no = $this->Authenticate_shiprocket();
        $update_pickup_dates = $_POST['pickup_dates'];
        $order_product_id = $_POST['schedule_pickup_id'];
        
        $data = DB::table('ordered_products')
            ->where('id', $order_product_id)  
            ->update(array('pickup_date' => $update_pickup_dates));

        $getData = DB::table('api_temp_resp as atr')
                    ->select('atr.*', 'op.pickup_date as pickup_date', 'op.book_slot_time')
                    ->leftjoin('ordered_products as op', 'atr.order_id', '=', 'op.orderid')
                    ->where('atr.order_product_id', $order_product_id)
                    ->get()
                    ->toArray();                                                                                                                                                                                                                     

                    if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
                    else{
                        $data = array();
                        
                        foreach ($getData as $rows => $val) 
                        {
                            $data['shipment_id'][] = $val->shipment_id;
                            $data['pickup_date'][] = "$val->pickup_date";
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
                        return response()->json(['status'=>'success', 'msg'=>'Order Schedule', 'data'=>$data]);
                    }       
    }
    
    public function list_manifest()
    {   
        $token_no = $this->Authenticate_shiprocket();
        $order_product_id = $_POST['id'];

        $result = DB::table('api_temp_resp')
                ->select('api_temp_resp.*')
                ->where('order_product_id',$order_product_id)
                ->get()
                ->toArray();
        return response()->json(['status'=>'success', 'msg'=>'Manifest Download List', 'data'=>$result]);
    }  
    
    public function manifest_print(Request $request)
    {
        $order_id = $_POST['id'];
        // print_r($order_id);die();
        $token_no = $this->Authenticate_shiprocket();
        $getData = DB::table('api_temp_resp')
                    ->select('*')
                    ->where('order_id', $order_id)
                    ->get()->toArray();
                     
                    //  print_r($getData);die();
        $id = $getData[0]->order_id;
        
        foreach($getData as $rows => $val) 
        {
            $data['shipment_id'] = $val->shipment_id;
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
        $generate_manifest_url = curl_exec($curl);
        curl_close($curl);
        $generate_manifest_url_success = json_decode($generate_manifest_url, true);
        
        // print_r($generate_manifest_url_success);die();
        if(!isset($generate_manifest_url_success->errors)) 
        {
            //Here Show Error if condition   
            if($generate_manifest_url_success['status'] == 1) 
            {
                $insert_data = array
                (
                    'manifest_url' => $generate_manifest_url_success['manifest_url'],
                );
            }
            // else {
            //     return response()->json(['status'=>'error', 'msg'=>'Generate Manifest Unsuccessfully']);
            // }
        } else {
            $insert_data = array(
                'order_id' => $data['order_id'],
                'status_code' => $generate_manifest_url_success->status_code,
                'error' => json_encode($generate_manifest_url_success->errors),
            );
        }
        $insert_resp = DB::table('api_temp_resp')->where('order_id',$id)->update(['manifest_url' => $insert_data['manifest_url']]);
        $data = DB::table('api_temp_resp')->select('manifest_url')->where('order_id', $order_id)->get();
        return $data;
    }

    public function generate_label(Request $request)
    {
        $token_no = $this->Authenticate_shiprocket();
        $order_id = $_POST['id'];
    // print_r($order_id);die();
        $getData = DB::table('api_temp_resp')
        ->select('*')
        ->where('order_id', $order_id)
        ->get();
       
        if(!$getData) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            $data['channel'] = "2023611";
            foreach($getData as $rows => $val) 
            {
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
            
            // print_r($SR_generate_order_out);die();
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
                    
                    return response()->json(['status'=>'success', 'msg'=>'Generate Label Unsuccessfully']);
                }
            } else {
                $insert_data = array(
                    'order_id' => $data['order_id'],
                    'status_code' => $SR_generate_order_out->status_code,
                    'error' => json_encode($SR_generate_order_out->errors),
                );
            }
           
            $insert_resp = DB::table('api_temp_resp')->where('order_id',$order_id)->update(['label_created'=>$insert_data['label_created'], 'label_url'=>$insert_data['label_url']]);   
        }

        $data = DB::table('api_temp_resp')->select('label_url')->where('order_id', $order_id)->get();

        // print_r($data);die();
        return $data;
    }
    
    public function intransit_check_shiprocket($order_details_total)
    {
        foreach($order_details_total as $data){
            $order_id  = $data->orderid;
            $getData = DB::table('api_temp_resp as atr')
                        ->select('atr.*')
                        ->where('atr.order_id', $order_id)
                        ->get();
            
            if($getData->count() <= 0){
                continue;
            }

            $api_conform_order_id = $getData[0]->api_order_id;
            
            if(!$api_conform_order_id){
                continue;
            }

            $token_no = $this->Authenticate_shiprocket();

            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/show/$api_conform_order_id",
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
            $generate_status = curl_exec($curl);
            curl_close($curl);
            $generate_status = json_decode($generate_status, true);
           
            if(isset($generate_status['data']) && $generate_status['data']['status_code'] == 18){   
                $data = DB::table('ordered_products')
                        ->where('orderid', $order_id)  
                        ->update(array('status' => 'intransit'));       
            } 
        }
        return response()->json(['status'=>'success', 'msg'=>'Update Intranshit Order']);            
    }
    
    public function delivered_check_shiprocket($all_intranshit_data)
    {
        foreach($all_intranshit_data as $data){
            $order_id  = $data->orderid;
            $getData = DB::table('api_temp_resp as atr')
                        ->select('atr.*')
                        ->where('atr.order_id', $order_id)
                        ->get();
           
            if($getData->count() <= 0){
                continue;
            }

            $api_conform_order_id = $getData[0]->api_order_id;
            if(!$api_conform_order_id){
                continue;
            }

            $token_no = $this->Authenticate_shiprocket();
            
            $param = array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/show/$api_conform_order_id",
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
            $generate_status = curl_exec($curl);
            curl_close($curl);
            $generate_status = json_decode($generate_status, true);
            if(isset($generate_status['data']) && $generate_status['data']['status_code'] == 7){   
                $data = DB::table('ordered_products')
                        ->where('orderid', $order_id)  
                        ->update(array('status' => 'completed'));       
            } 
        }
        return response()->json(['status'=>'success', 'msg'=>'Update Order']);        
    }
    
    public function cancel_shipment_details(Request $request)
    {
        $token_no = $this->Authenticate_shiprocket();
        $order_product_id = $_POST['id'];
    
        $get_order_data = DB::table('api_temp_resp')
                        ->select('*')
                        ->where('order_product_id', $order_product_id)
                        ->get();
        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) 
            {
                $data['awbs'][] = $val->awb_code;
            }

            $param = array(
                CURLOPT_URL =>"https://apiv2.shiprocket.in/v1/external/orders/cancel/shipment/awbs",
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
            $generate_cancel_shipment = curl_exec($curl);
            curl_close($curl);
            $generate_cancel_shipment = json_decode($generate_cancel_shipment);
           
            if(!isset($SR_generate_order_out->errors)) 
            {
                $update_data = [
                        'awb_code' => '',
                        'courier_name' => '',
                        'awb_assign_status' => '',
                        'courier_company_id' => '',
                        'status_code' => '',
                    ];
               
                $insert_resp = DB::table('api_temp_resp')->where('order_product_id', $order_product_id)->update($update_data);
            } 

            //Here Update order_products table status coloum query 
            
            
            return response()->json(['status'=>'success', 'msg'=>'Bulk Shipment cancellation is in progress. Please wait for some time']);
        } 
    }

    public function cancel_orders_details(Request $request)
    {
        $order_id = $_POST['id'];
        $token_no = $this->Authenticate_shiprocket();
        $get_order_data = DB::table('api_temp_resp')
                            ->select('*')
                            ->where('order_product_id', $order_id)
                            ->get();

        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) {
                $data['ids'] = [
                        $val->api_order_id,
                    ];   
            }

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
           
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $SR_generate_order = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($SR_generate_order);
            
            if(isset($SR_generate_order_out)) 
            {
                $insert_data = array(
                        'reason' => $request->reason,
                        // 'status_code' => $SR_generate_order_out->status,
                        'status_code' => '',
                        'status' => "cancelled",
                        'date' => new DateTime(),
                    );
            } 
            // else {

            //     echo "<pre>";
            //     print_r("hhhhh");
            //     die();
            //     return back()->with('error', $SR_generate_order_out->message);
            // }
            $insert_resp = DB::table('api_temp_resp') ->where('order_product_id',$order_id)->update(['status'=>$insert_data['status'], 'status_code'=>$insert_data['status_code'], 'cancel_reason' => $insert_data['reason'], 'cancel_date' => $insert_data['date']]);

            $data = DB::table('ordered_products')
                ->where('id', $order_id)  
                ->update(array('status' => 'cancelled'));  
            
            return response()->json(['status'=>'success', 'msg'=>'orders cancellation is in progress. Please wait for some time']);
        }
    }
    
    public function return_order_shiprocket(Request $request)
    {
        $token_no = $this->Authenticate_shiprocket();
        $order_product_id = $_POST['id'];
        
        $order_id = DB::table('ordered_products as oo')
                ->select('oo.orderid')
                ->where('id',$order_product_id)->get();
        $order_id = $order_id[0]->orderid;
     
        $get_order_data = DB::table('orders as o')
                        ->select('o.*', 'p.title', 'p.price', 'p.weight', 'p.hsncode', 'p.height', 'p.productsku', 'p.stock', 'p.owner', 'ap.api_order_id', 'ap.shipment_id', 'vp.shop_name',
                                'vp.email as V_Email', 'vp.phone as V_Phone', 'vp.city as V_City', 'vp.zip as V_Zip', 'vp.country as V_Countty', 'vp.state as V_State', 'oo.created_at', 
                                'oo.buyer_name', 'oo.order_payment_method', 'oo.cost')
                        ->leftjoin('products as p', 'o.products', '=', 'p.id')
                        ->leftjoin('ordered_products as oo', 'o.id', '=', 'oo.orderid')
                        ->leftjoin('vendor_profiles as vp', 'p.vendorid', '=', 'vp.id')
                        ->leftjoin('api_temp_resp as ap', 'o.id', '=', 'ap.order_id')
                        ->where('o.id', $order_id)->get();

        if(!$get_order_data) return json_encode(array('statusCode' => 500, 'error' => 'No Orders Found'));
        else {
            foreach($get_order_data as $rows => $val) 
            {
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
                
                // unit,name,sku ,selling_price
                $data['productsku'] = $val->productsku;
                $data['units'] = $val->quantities;
                $data['selling_price'] = $val->pay_amount;
                $data['name'] = $val->title;


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
                        "sku" => $data['productsku'],
                        "name" => $data['name'],
                        "units" => $data['units'],
                        "selling_price" => $data['selling_price'],
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
                
                if($val->height != '')
                {
                    if(str_contains($val->height, ' ') === true)
                    {
                        $height = explode(' ', $val->height);
                        $data['height'] = $height[0];
                    }else $data['height'] = $val->height;
                }else $data['height'] = 11;
                
               
                if($val->weight != '') 
                {
                    $data['weight'] = $val->weight;
                    if(str_contains($val->weight, ' ') === true) 
                    {
                        $weight = explode(' ', $val->weight);
                        $data['weight'] = $weight[0]/1000;
                    }    
                }else{
                    $data['weight'] = '0.02';
                }
            }
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
            
            $curl = curl_init();
            curl_setopt_array($curl, $param);
            $generate_awb = curl_exec($curl);
            curl_close($curl);
            $SR_generate_order_out = json_decode($generate_awb);

            // print_r($SR_generate_order_out);die();

            if(!isset($SR_generate_order_out->errors)) 
            {
              
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
            
            // show user message order return and other functionality are pending 
            
            $insert_resp = DB::table('api_temp_resp')->where('order_id', $order_id)->update($insert_data);

            return back()->with('message', 'Shiprocket return order create successfully.');
        }
        
    }

}
