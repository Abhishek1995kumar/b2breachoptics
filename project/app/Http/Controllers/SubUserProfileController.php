<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use App\Review;
use App\Settings;
use App\OrderedProducts;
use App\SubUserProfile;
use App\PickUpLocations;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class SubUserProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:subuser',['except' => 'checkout','cashondelivery']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = SubUserProfile::find(Auth::user()->id);
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('id','desc')->take(15)->get();
        return view('account',compact('user','orders'));
    }

    public function accinfo()
    {
        $user = SubUserProfile::find(Auth::user()->id);
        return view('accountedit',compact('user'));
    }

    public function userchangepass()
    {
        $user = SubUserProfile::find(Auth::user()->id);
        return view('userchangepass',compact('user'));
    }

    public function userorders()
    {
        $user = SubUserProfile::find(Auth::user()->id);
        // $orders = Order::where('customerid', Auth::user()->id)->orderBy('id','desc')->get();
        $orders = OrderedProducts::where('customer_id_new', Auth::user()->id)->orderBy('id','desc')->get();
        // echo "<pre>";
        // print_r($orders);
        // die();
        return view('userorders',compact('user','orders'));
    }

    public function userorderdetails($id)
    {
        $user = SubUserProfile::find(Auth::user()->id);
        // $order = Order::findOrFail($id);
        $orders = DB::table('ordered_products as o')
                    ->select('o.*', 'ap.status as API_stataus', 'ap.status_code', 'ap.pickup_scheduled_date', 'ap.rtn_shipment_id')
                    ->join('api_temp_resp as ap', 'o.orderid', '=', 'ap.order_id')
                    ->where('o.id', $id)
                    ->get()->toArray();
                    
        if(isset($orders)){
            $order = $orders[0];
        }
                    
                    // echo "<pre>";
                    // print_r($order);
                    // die();
        // $tax = Settings::select('tax')->where('id','$id')->first();
        return view('orderdetails',compact('user','order'));
    }

    public function trackorder($id){
        $user = SubUserProfile::find(Auth::user()->id);
        // $order = Order::findOrFail($id);
        $order = OrderedProducts::findOrFail($id);
        // $tax = Settings::select('tax')->where('id','$id')->first();
        return view('orderdetails',compact('user','order'));
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


    //Submit Review
    public function checkout()
    {
    	    $pickups = PickUpLocations::all();
            $product = 0;
            $quantity = 0;
            $sizes = 0;
            $settings = Settings::findOrFail(1);
            $carts = Cart::where('uniqueid',Session::get('uniqueid'));
            $cartdata = $carts->get();
            if($carts->count() > 0){
                $discountAmount = ($settings->fixed_commission/100)*$carts->sum('cost');
                
                $taxAmount = ($settings->tax/100)*$carts->sum('cost');
                
                $total = $carts->sum('cost') + $settings->shipping_cost - $discountAmount + $taxAmount ;
                foreach ($carts->get() as $cart){
                    if ($product==0 && $quantity==0){
                        $product = $cart->product;
                        $quantity = $cart->quantity;
                        $sizes = $cart->size;
                    }else{
                        $product = $product.",".$cart->product;
                        $quantity = $quantity.",".$cart->quantity;
                        $sizes = $sizes.",".$cart->size;
                    }
                }
                return view('checkout',compact('product','sizes','quantity','total','cartdata','user','pickups'));
            }

        return redirect()->route('user.cart')->with('message','You don\'t have any product to checkout.');
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


   public function deleteuser()
    {
        $customer = SubUserProfile::findOrFail(Auth::user()->id);
        Auth::logout();
        $customer->delete();
        return redirect('/home')->with('message','Customer Delete Successfully.');
    }

    public function deleteuserpage()
    {
        return view('deletepage');
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
        $user = SubUserProfile::findOrFail($id);
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->with('message','Account Information Updated Successfully.');

    }

    public function passchange(Request $request, $id)
    {
        $user = SubUserProfile::findOrFail($id);
        $input = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect()->back();
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect()->back();
            }
        }
        $user->update($input);
        return redirect()->back()->with('message','Account Password Updated Successfully.');

    }

    public function returnorder(Request $request, $id){
        // $order = Order::find($id);
        $order = OrderedProducts::find($id);
        $order->status = "return";
        $order->return_status = "accept";
        $order->return_reason = $request->input('reason');
        $order->return_comment = $request->input('comment');
        $order->return_pickupaddress = $request->input('address');
        $order->return_replaceorrefund = $request->input('replaceorrefund');
        $order->returnorder_date = date('Y-m-d');
        $order->update();
        return redirect()->back()->with('message','Your Order Has Been Return');
    }

    public function cancelreturnorder($id){

        // $order = Order::find($id);
        $order = OrderedProducts::find($id);
        
        $order->return_reason = null;
        $order->return_comment = null;
        $order->return_pickupaddress = null;
        $order->return_replaceorrefund = null;
        $order->returnorder_date = null;
        
        $order->returnorder_date = date('Y-m-d');
        $order->status = "completed";
        $order->return_status = "pending";
        $order->update();
        return redirect()->back()->with('message','Order return request has been cancelled!');

    }

      public function ordercancel(Request $request, $id){
        // $order = Order::find($id);
        $order = OrderedProducts::find($id);
        $order->canceled_date = date('Y-m-d');
        $order->canceled_reason = $request->input('cancelreason');
        $order->comment_cancel = $request->input('cancelcomment');
        $order->status = "cancelled";
        // $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->update();
        // session()->flash('order_message','Order has been Canceled!');
        return redirect()->back()->with('message','Order has been cancelled!');
    }


            public function download_invoice($id)
            {
                
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
                    'address1' => "1st Floor 102/103 Vinayak Chember",
                    'address2' => "Opp Tambe Hospital Gokhale Road, Naupada",
                    'city' => "Thane",
                    'state' => "Maharashtra",
                    'country' => "India",
                    'zip' => "400605",
                    'phone' => "8091213809",
                    'email' => "it.elricaglobal@gmail.com",
                ];
                
                // echo "<pre>";
                // print_r($orders);
                // echo "</pre>";
                // die();
                // end new added code for new order functionlity

                $data = ['title' => 'Invoice'];
                // $dompdf->set_option('enable_html5_parser', TRUE);
                $pdf = PDF::loadView('user_invoice', compact('orders', 'array', 'tax', 'subtotal'), $data);
                return $pdf->download('Invoice.pdf');
                
                // $order = OrderedProducts::findOrFail($id);
                // $data = ['title' => 'Invoice'];
                // $pdf = PDF::loadView('user_invoice', compact('order'),$data);
                // return $pdf->stream('Invoice.pdf');
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
}
