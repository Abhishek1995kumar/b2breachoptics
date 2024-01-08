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
        
        $order_category_per = count(session()->get('role')['order_category_per']) > 0 ? session()->get('role')['order_category_per'] : [];
        
        $categoriesmanual = DB::table('categories')->where('role', 'main')->get();

        return view('admin.manualorderlist', compact('order_category_per', 'categoriesmanual'));
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
        

        $data = ['title' => 'Invoice'];
        // $dompdf->set_option('enable_html5_parser', TRUE);
        $pdf = PDF::loadView('invoice', compact('orders', 'array', 'tax', 'subtotal', 'emi'), $data);
        return $pdf->download('Invoice.pdf');
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
            $nestedData[] = $vals->modelno;
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
                ->select('op.*', 'p.modelno')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->leftJoin('products as p', 'op.productid', '=', 'p.id')
                ->where('op.owner','=','admin')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('op.orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                    });
                })
                ->where(function($query){
                    $query->whereIn('op.status','=',['cancelled', 'declined']);
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
                        ->leftJoin('products as p', 'op.productid', '=', 'p.id')
                        ->select('op.*', 'p.modelno')
                        ->where('op.owner','=','admin')
                        ->whereIn('op.status', ['cancelled', 'declined'])
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
            $nestedData[] = $vals->modelno;
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
                ->select('op.*', 'p.modelno')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->leftJoin('products as p', 'op.productid', '=', 'p.id')
                ->where('op.owner','=','vendor')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('orderid', $search_term);
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                    });
                })
                ->where(function($query){
                    $query->whereIn('op.status','=',['cancelled', 'declined']);
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
                        ->leftjoin('orders as o', 'op.orderid', 'o.id')
                        ->leftJoin('products as p', 'op.productid', '=', 'p.id')
                        ->select('op.*', 'p.modelno')
                        ->where('op.owner', 'vendor')
                        ->whereIn('op.status', ['cancelled', 'declined'])
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
        
        $category = $request->category_id;
        
        
        $order_details_total = $this->get_order_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_order_data(true, $search_term, $other_configs, $category);
      
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
    
    public function get_order_data($count, $search_term = '', $other_configs, $category)
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
                ->where('op.categoryID', $category)
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
                    ->where('op.categoryID', $category)
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
        
        $category = $request->category_id;
        
        $order_details_total = $this->get_order_process_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_order_process_data(true, $search_term, $other_configs, $category);
        
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
                
                if($vals->invoice_number){
                    $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='orderConfirm(".$vals->id.", event)'  class='btn btn-success'>Confirm</a>";
                }
                else
                {
                    $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='alertmassege()'  class='btn btn-success'>Confirm</a>";
                }
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
    
    public function get_order_process_data($count, $search_term = '', $other_configs, $category)
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
                ->where('op.categoryID', $category)
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
                        ->where('op.categoryID', $category)
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
        
        $category = $request->category_id;

        $order_details_total = $this->get_total_order_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_total_order_data(true, $search_term, $other_configs, $category);
        
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

    public function get_total_order_data($count, $search_term = '', $other_configs, $category){
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
            ->where('op.categoryID', $category)
            ->where('op.status','=','processing')
            ->orderBy('op.order_accept_date','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products as op')
                    ->leftjoin('prescription as pres', 'op.orderid', '=', 'pres.order_id')
                    ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                    ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
                    ->select('op.*','pro.previous_price','pro.modelno as modelno','pres.order_id', 'pres.category', 'pres.minus_left_eye', 'pres.minus_right_eye', 'pres.main_price', 'pres.cartcolor',
                    'pres.maincolor', 'pres.rangenameone', 'pres.rangenametwo', 'pres.rangenamethree', 'pres.price as presPrice', 'pres.presc_image', 'pres.lefteyequantity',
                    'pres.righeyequantity', 'pres.base_curv', 'pres.dia', 'pres.Lsphere', 'pres.Lpower', 'pres.LDia', 'pres.LBc', 'pres.Laxis', 'pres.Lcyle', 'pres.lva',
                    'pres.same_rx_both', 'pres.rsphere', 'pres.rpower', 'pres.rbc', 'pres.rdia', 'pres.Raxis', 'pres.rcyl', 'pres.rva', 'pres.bsphere', 'pres.bpower', 'pres.botheyequantity',
                    'pres.Bbc', 'pres.Bdia', 'pres.Bcyle', 'pres.Baxis', 'pres.totalPd', 'pres.Lepd', 'pres.Repd',  'o.customer_zip', 'o.cost as cost_price', 'o.pay_amount')
                    ->where('op.categoryID', $category)
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
        $category = $request->category_id;

        $order_details_total = $this->get_ready_for_pickup_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_ready_for_pickup_data(true, $search_term, $other_configs, $category);
        
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';

            if(in_array('V', session()->get('role')['role_actions']['rfp'])) {
                $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";
            }

            if(in_array('U', session()->get('role')['role_actions']['rfp'])){
                $actionButton = "<a onclick='pickupModelShow(".$vals->id.")'><button class='btn btn-primary' >Pickup</button></a>";
            }

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

    public function get_ready_for_pickup_data($count, $search_term = '', $other_configs, $category){
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
            ->where('categoryID', $category)
            ->where('status','=','picked')
            ->orderBy('pickup_date','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')
                ->select('*')
                ->where('categoryID', $category)
                ->where('status','=','picked')
                ->orderBy('pickup_date','desc');

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
        $category = $request->category_id;

        $order_details_total = $this->get_in_transit_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_in_transit_data(true, $search_term, $other_configs, $category);
        
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

    public function get_in_transit_data($count, $search_term = '', $other_configs, $category){
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
            ->where('categoryID', $category)
            ->where('status','=','InTransit')
            ->orderBy('id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')
                ->where('categoryID', $category)
                ->where('status','=','InTransit')
                ->orderBy('id','desc');

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
        $category = $request->category_id;

        $order_details_total = $this->get_delivered_data(false, $search_term, $other_configs, $category);
        $order_details_count = $this->get_delivered_data(true, $search_term, $other_configs, $category);
            
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

    public function get_delivered_data($count, $search_term = '', $other_configs, $category)
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
            ->where('categoryID', $category)
            ->where('status','=','completed')
            ->orderBy('id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products')
                ->select('*')
                ->where('categoryID', $category)
                ->where('status','=','completed')
                ->orderBy('id','desc');

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
        ->select('op.*','pro.previous_price','pro.modelno as modelno', 'pro.producttat', 'pro.visioneffect', 'pro.lenstype', 'pres.order_id', 'pres.category', 'pres.minus_left_eye', 'pres.minus_right_eye', 'pres.main_price',
            'pres.rangenameone', 'pres.rangenametwo', 'pres.rangenamethree', 'pres.price as presPrice', 'pres.presc_image', 'pres.lefteyequantity',
            'pres.righeyequantity', 'pres.base_curv', 'pres.dia', 'pres.Lsphere', 'pres.Lpower', 'pres.LDia', 'pres.LBc', 'pres.Laxis', 'pres.Lcyle', 'pres.lva',
            'pres.same_rx_both', 'pres.rsphere', 'pres.rpower', 'pres.rbc', 'pres.rdia', 'pres.Raxis', 'pres.rcyl', 'pres.rva', 'pres.bsphere', 'pres.bpower', 'pres.botheyequantity',
            'pres.Bbc', 'pres.Bdia', 'pres.Bcyle','pres.frame_fit as frame_fit' ,'pres.Baxis', 'pres.totalPd', 'pres.Lepd', 'pres.Repd', 'o.customer_zip', 'o.cost as cost_price', 'o.pay_amount', 'cy.Name as cname',
            'st.Name as sname', 'pres.a_size', 'pres.b_size', 'pres.dbl', 'pres.r_dia', 'pres.l_dia', 'pres.r_pd', 'pres.l_pd',
            'pres.bvd', 'pres.r_ed', 'pres.l_ed', 'pres.r_fitting', 'pres.l_fitting', 'pres.pantascopic', 'pres.temple_size',
            'pres.network_distance', 'pres.bow_angle', 'pres.frame_type', 'pres.materials', 'pres.shape_code', 'o.couponAmount', 'o.order_note', 'o.buyer_order_id', 'o.seller_order_id')
        ->orderBy('op.id','desc')
        ->get();
        
        return response()->json(['status'=> true, 'msg'=>'Order fetch', 'order_pro_details'=>$order_pro_details]);
    }
    
    // Nik
    public function combine_details_fetch(Request $request)
    {
        $order_id = isset($request->all()['order_id']) ? $request->all()['order_id'] : '';
        if(!$order_id){
            return response()->json(['status'=> false, 'msg'=>'Order id not Found']);
        }

        $orderproduct = OrderedProducts::whereNotNull('invoice_number')
                        ->orderBy('invoice_number', 'desc')
                        ->limit(1)
                        ->get()->toArray();
        
        $invoicedate = explode('/', $orderproduct[0]['invoice_number']);
            
        $dateextyy = substr(date('Y'), -2);
        $dateextmm = date('m');
        $dateextdd = date('d');
        
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
        ->leftjoin('b2b_citymaster as sbc','o.shipping_city','=','sbc.Id')
        ->leftjoin('b2b_statemaster as sbs','o.shipping_state','=','sbs.id')
        ->select('user_profiles.*','op.*','o.customer_name as buyer_name','b2b_statemaster.Name as buyer_state',
        'b2b_citymaster.Name as buyer_city','o.customer_Address as address','o.customer_zip as pincode','k.tax as tax1',
        'o.customer_email as cus_email','pro.modelno as modelno','pro.hsncode as hsn_code','pro.costprice as cost_price',
        'o.pay_amount as pay_amount', 'o.shipping_name', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_address2', 'o.shipping_city', 
        'o.shipping_state', 'o.shipping_country', 'o.shipping_zip', 'categories.tax as tax', 'sbc.Name as Ship_city', 'sbs.Name as Ship_state')
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

}
