<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\OrderedProducts;
use DB;
use Carbon\Carbon;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        //$this->userid = Auth::user()->id;
    }

    public function index()
    {
        $admin = User::find(Auth::user()->id);
        return view('admin.adminprofile' , compact('admin'));
    }

    public function password()
    {
        $admin = User::find(Auth::user()->id);
        return view('admin.adminchangepass' , compact('admin'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')){
            $photo = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/admin',$photo);
            $input['photo'] = $photo;
        }

        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Doesnot match.');
                    return redirect('admin/adminprofile');
                }
            }else{
                Session::flash('error', 'Admin Profile Updated Successfully.');
                return redirect('admin/adminprofile');
            }
        }
        //return $request->cpass;
        //return "Not..";
        $user->update($input);
        Session::flash('message', 'Admin Profile Updated Successfully.');
        return redirect('admin/adminprofile');
    }

    public function changepass(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input['password'] = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect('admin/adminpassword');
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect('admin/adminpassword');
            }
        }

        $user->update($input);
        Session::flash('message', 'Admin Password Updated Successfully.');
        return redirect('admin/adminpassword');
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


    // Functions for admin payment overview


    public function Paymentview(){


        $list = DB::table('vendor_profiles')->get();
        return view('admin.paymentoverviewfrontpage',compact('list'));
    }


    public function Paymentoverview(){

        $todayDate = Carbon::now()->format('d');
             $todayMonth = Carbon::now()->format('M');
             $fulldate = Carbon::now()->format('Y-m-d');

             // new code for payment overview

                 $CODtotal = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','pending')->sum('cost');
                 $CODlist = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','pending')->get();

                 $Onlinetotal = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','pending')->sum('cost');
                 $Onlinelist = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','pending')->get();

                 $OrderTotalCost = $CODtotal + $Onlinetotal;

                 $CancelCODOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','cancelled')->sum('cost');
                 $CancelCODOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','cancelled')->get();

                 $CanceOnlineOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','cancelled')->sum('cost');
                 $CancelOnlineOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','cancelled')->get();

                 $CancelOrderTotalCost = $CancelCODOrdertotal + $CanceOnlineOrdertotal;


                 $ReturnCODOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','return')->sum('cost');
                 $ReturnCODOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','return')->get();

                 $ReturnOnlineOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','return')->sum('cost');
                 $ReturnOnlineOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','return')->get();

                 $ReturnOrderTotalCost = $ReturnCODOrdertotal + $ReturnOnlineOrdertotal;

                 $completedCODOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedCODOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->get();
                 // dd($completedCODOrderlist);

                 $completedOnlineOrdertotal = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedOnlineOrderlist = OrderedProducts::where('owner','admin')->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->get();

                 $completedOrderTotalCost = $completedCODOrdertotal + $completedOnlineOrdertotal;

             // end of new code for payment overview



        return view('admin.paymentoverview',compact('todayDate','todayMonth','CODlist','CODtotal','Onlinetotal','Onlinelist','OrderTotalCost','CancelCODOrdertotal','CancelCODOrderlist','CanceOnlineOrdertotal','CancelOnlineOrderlist','CancelOrderTotalCost','ReturnCODOrdertotal','ReturnCODOrderlist','ReturnOnlineOrdertotal','ReturnOnlineOrderlist','ReturnOrderTotalCost','completedCODOrdertotal','completedCODOrderlist','completedOnlineOrdertotal','completedOnlineOrderlist','completedOrderTotalCost'));
    }





     // functions for payment overview order details

    public function getview($id){
        $pendingdata = OrderedProducts::findOrFail($id);
        return view('admin.pendingpaymentoverview',compact('pendingdata'));
    }

    public function pendingpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('admin.pendingpaymentoverview',compact('pendingdata'));
    }


    public function cancelpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('admin.cancelpaymentoverview',compact('pendingdata'));
    }


    public function returnpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('admin.returnpaymentoverview',compact('pendingdata'));

    }

    public function todayssettlement($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('admin.completedpaymentoverview',compact('pendingdata'));

    }

    // End Funtions for payment overview order details


   public function vendorsview($id){

             $todayDate = Carbon::now()->format('d');
             $todayMonth = Carbon::now()->format('M');
             $fulldate = Carbon::now()->format('Y-m-d');

             // new code for payment overview

                 $CODtotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','pending')->sum('cost');
                 $CODlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','pending')->get();

                 $Onlinetotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','pending')->sum('cost');
                 $Onlinelist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','pending')->get();

                 $OrderTotalCost = $CODtotal + $Onlinetotal;

                 $CancelCODOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','cancelled')->sum('cost');
                 $CancelCODOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','cancelled')->get();

                 $CanceOnlineOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','cancelled')->sum('cost');
                 $CancelOnlineOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','cancelled')->get();

                 $CancelOrderTotalCost = $CancelCODOrdertotal + $CanceOnlineOrdertotal;


                 $ReturnCODOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','return')->sum('cost');
                 $ReturnCODOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','return')->get();

                 $ReturnOnlineOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','return')->sum('cost');
                 $ReturnOnlineOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','return')->get();

                 $ReturnOrderTotalCost = $ReturnCODOrdertotal + $ReturnOnlineOrdertotal;

                 $completedCODOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedCODOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->get();
                 // dd($completedCODOrderlist);

                 $completedOnlineOrdertotal = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedOnlineOrderlist = OrderedProducts::where('vendorid',$id)->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->get();

                 $completedOrderTotalCost = $completedCODOrdertotal + $completedOnlineOrdertotal;

                return view('admin.VendorsPaymentOverview',compact('todayDate','todayMonth','CODlist','CODtotal','Onlinetotal','Onlinelist','OrderTotalCost','CancelCODOrdertotal','CancelCODOrderlist','CanceOnlineOrdertotal','CancelOnlineOrderlist','CancelOrderTotalCost','ReturnCODOrdertotal','ReturnCODOrderlist','ReturnOnlineOrdertotal','ReturnOnlineOrderlist','ReturnOrderTotalCost','completedCODOrdertotal','completedCODOrderlist','completedOnlineOrdertotal','completedOnlineOrderlist','completedOrderTotalCost'));

   }


// end of Functions for admin payment overview




}
