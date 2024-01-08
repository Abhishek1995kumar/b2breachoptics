<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Vendors;
use App\Order;
use App\Withdraw;
use App\OrderedProducts;
use App\NewBankDetail;
use App\NewBusinessDetail;
use App\Businessdetali;
use App\Bankdetali;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demo = Vendors::where('id',Auth::user()->id)->first();
        // dd($demo);

        return view('vendor.dashboard',compact('demo'));
    }


    public function withdraw()
    {
        //$countries = Country::all();
        $user = Vendors::findOrFail(Auth::user()->id);
        return view('vendor.withdrawmoney',compact('user','countries'));
    }


    public function withdraws()
    {
        $withdraws = Withdraw::where('vendorid',Auth::user()->id)->orderBy('id','desc')->get();
        return view('vendor.withdraws',compact('withdraws'));
    }


    // payment overview

        public function paymentoverview()
        {
            
             $todayDate = Carbon::now()->format('d');
             $todayMonth = Carbon::now()->format('M');
             $fulldate = Carbon::now()->format('Y-m-d');

             // new code for payment overview

                 $CODtotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','pending')->sum('cost');
                 $CODlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','pending')->get();

                 $Onlinetotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','pending')->sum('cost');
                 $Onlinelist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','pending')->get();

                 $OrderTotalCost = $CODtotal + $Onlinetotal;

                 $CancelCODOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','cancelled')->sum('cost');
                 $CancelCODOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','cancelled')->get();

                 $CanceOnlineOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','cancelled')->sum('cost');
                 $CancelOnlineOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','cancelled')->get();

                 $CancelOrderTotalCost = $CancelCODOrdertotal + $CanceOnlineOrdertotal;


                 $ReturnCODOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','return')->sum('cost');
                 $ReturnCODOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','return')->get();

                 $ReturnOnlineOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','return')->sum('cost');
                 $ReturnOnlineOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','return')->get();

                 $ReturnOrderTotalCost = $ReturnCODOrdertotal + $ReturnOnlineOrdertotal;

                 $completedCODOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedCODOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','COD')->where('status','completed')->where('Settelment_date',$fulldate)->get();
                 // dd($completedCODOrderlist);

                 $completedOnlineOrdertotal = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->sum('cost');
                 $completedOnlineOrderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('order_payment_method','Razorpay')->where('status','completed')->where('Settelment_date',$fulldate)->get();

                 $completedOrderTotalCost = $completedCODOrdertotal + $completedOnlineOrdertotal;

             // end of new code for payment overview


            return view('vendor.paymentoverview',compact('todayDate','todayMonth','CODlist','CODtotal','Onlinetotal','Onlinelist','OrderTotalCost','CancelCODOrdertotal','CancelCODOrderlist','CanceOnlineOrdertotal','CancelOnlineOrderlist','CancelOrderTotalCost','ReturnCODOrdertotal','ReturnCODOrderlist','ReturnOnlineOrdertotal','ReturnOnlineOrderlist','ReturnOrderTotalCost','completedCODOrdertotal','completedCODOrderlist','completedOnlineOrdertotal','completedOnlineOrderlist','completedOrderTotalCost'));
        }


    public function withdrawsubmit(Request $request) {
        $from = Vendors::findOrFail(Auth::user()->id);

        $withdrawcharge = Settings::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fee;

        if($request->amount > 0){

            $amount = $request->amount;

            if ($from->current_balance >= $amount){
                $fee = (($withdrawcharge->withdraw_charge / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
                $finalamount = number_format((float)$finalamount,2,'.','');

                $balance1['current_balance'] = $from->current_balance - $amount;
                $from->update($balance1);

                $newwithdraw = new Withdraw();
                $newwithdraw['vendorid'] = Auth::user()->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['acc_email'] = $request->acc_email;
                $newwithdraw['iban'] = $request->iban;
                $newwithdraw['country'] = $request->acc_country;
                $newwithdraw['acc_name'] = $request->acc_name;
                $newwithdraw['address'] = $request->address;
                $newwithdraw['swift'] = $request->swift;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;
                $newwithdraw->save();

                return redirect()->back()->with('message','Withdraw Request Sent Successfully.');

            }else{
                return redirect()->back()->with('error','Insufficient Balance.')->withInput();
            }
        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();
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

    // functions for payment overview order details

    public function pendingpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('vendor.pendingpaymentoverview',compact('pendingdata'));
    }


    public function cancelpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('vendor.cancelpaymentoverview',compact('pendingdata'));
    }


    public function returnpaymentoverview($id){

        $pendingdata = OrderedProducts::findOrFail($id);
        return view('vendor.returnpaymentoverview',compact('pendingdata'));

    }

    public function todayssettlement($id){
        $pendingdata = OrderedProducts::findOrFail($id);
        return view('vendor.completedpaymentoverview',compact('pendingdata'));

    }

    // End Funtions for payment overview order details


    // Abhishek --- Bank Details And Business Details
    public function bankdetails() {   
        // $data = NewBankDetail::where('vendorid', Auth::user()->id)->first();
        $vendorId = Auth::user()->id;
        $data = Bankdetali::where('vendorid', $vendorId)->first();
        return view('vendor.updatebankdetails',compact('data'));
    }


    public function UpdateBankDetails(Request $request) {
        $vendorId = Auth::user()->id;
        // $status = DB::table('vendor_profiles')->where('id',$vendorId)->update(["status" => 0]);

        $this->validate($request, [
            'accountholdername' => 'required|max:255',
            // 'cancelcheck' => 'mimes:jpeg,png,pdf|max:400|dimensions:max_width=250,max_height=500',
            // 'passbook' => 'mimes:jpeg,png,pdf|max:400|dimensions:max_width=250,max_height=500',
            'cancelcheck' => 'mimes:jpeg,png,pdf',
            'passbook' => 'mimes:jpeg,png,pdf',
        ]);
        
        if ($file = $request->file('cancelcheck'))
        {
            // $employee = NewBankDetail::where('vendorid', Auth::user()->id)->first();
            $employee = DB::table("bankdetalis")->where('vendorid', $vendorId)->first();
            $cancelcheck = time().$request->file('cancelcheck')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$cancelcheck);
            $employee->update(['cancelcheck' => $cancelcheck]);
        }

        if ($file = $request->file('passbook'))
        {
            // $employee = NewBankDetail::where('vendorid', Auth::user()->id)->first();
            $employee = DB::table("bankdetalis")->where('vendorid', $vendorId)->first();
            $passbook = time().$request->file('passbook')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$passbook);
            $employee->update(['passbook' => $passbook]);
        }

        // NewBankDetail->where('vendorid',Auth::user()->id)->update(['accountholdername' => request('accountholdername'), 'accountnumber' => request('accountnumber'), 'bankname' => request('bankname'), 'ifsccode' => request('ifsccode'), 'accounttype' => request('accounttype') ]);
        $data = Bankdetali::where('vendorid', $vendorId)->update(['accountholdername' => request('accountholdername'), 'accountnumber' => request('accountnumber'), 'bankname' => request('bankname'), 'ifsccode' => request('ifsccode'), 'accounttype' => request('accounttype') ]);
        Session::flash('message','Bank Detail Updated Successfully');
        return redirect('vendor/vendorprofile');
        
        // Auth::logout('message','Please contact to admin !!');
        // return redirect("/vendor");
    }
    

    public function businessdetails() {
        $vendorId = Auth::user()->id;
        // $data = NewBusinessDetail::where('vendorid', Auth::user()->id)->first();
        $data = DB::table("businessdetalis")->where('vendorid', $vendorId)->first();
        return view('vendor.updatebusinessdetails',compact('data'));
    }
    
    public function UpdatebusinessDetails(Request $request) {
        $vendorId = Auth::user()->id;  // current vendor id
        // DB::table("businessdetalis")->where('id', $vendorId)->update(['status' => 0]);
        $this->validate($request, [
         'businessname' => 'required|max:255',
            // 'adharimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=250,max_height=500',
            // 'trademarkimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=250,max_height=500',
            // 'udyamimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=250,max_height=500',
            // 'companylogo' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=250,max_height=500',
            
            'adharimg' => 'mimes:jpeg,png,pdf',
            'trademarkimg' => 'mimes:jpeg,png,pdf',
            'udyamimg' => 'mimes:jpeg,png,pdf',
            'companylogo' => 'mimes:jpeg,png,pdf',
        ]);

        if($file = $request->file('adharimg'))  {
            // $employee = NewBusinessDetail::where('vendorid',Auth::user()->id)->first();
            $employee = DB::table("businessdetalis")->where("vendorid", $vendorId)->first();
            $adharimg = time().$request->file('adharimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$adharimg);
            $employee->adharimg = $adharimg;
            $employee->update();
        }

         if($file = $request->file('trademarkimg')) 
         {
            // $employee = NewBusinessDetail::where('vendorid',Auth::user()->id)->first();
            $employee = DB::table("businessdetalis")->where("vendorid",$vendorId)->first();
            $trademarkimg = time().$request->file('trademarkimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$trademarkimg);
            $employee->trademarkimg = $trademarkimg;
            $employee->update();
        }

         if($file = $request->file('udyamimg')) 
         {
            // $employee = NewBusinessDetail::where('vendorid',Auth::user()->id)->first();
            $employee = DB::table("businessdetalis")->where("vendorid",$vendorId)->first();
            $udyamimg = time().$request->file('udyamimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$udyamimg);
            $employee->udyamimg = $udyamimg;
            $employee->update();
        }

         if($file = $request->file('companylogo')) 
         {
            // $employee = NewBusinessDetail::where('vendorid',Auth::user()->id)->first();
            $employee = DB::table("businessdetalis")->where("vendorid",$vendorId)->first();
            $companylogo = time().$request->file('companylogo')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$companylogo);
            $employee->companylogo = $companylogo;
            $employee->update();
        }

        // NewBusinessDetail::where('vendorid',Auth::user()->id)->update(['businessname' => request('businessname'), 'addressone' => request('addressone'), 'addresstwo' => request('addresstwo'), 'landmark' => request('landmark'), 'city' => request('city'),'state' => request('state'),'country' => request('country'),'pincode' => request('pincode'),'companytype' => request('companytype'),'businesstype' => request('businesstype'),'yoe' => request('yoe'),'ppoyc' => request('ppoyc'),'gst' => request('gst'),'pan' => request('pan'),'adhar' => request('adhar'),'tan' => request('tan') ]);
        // Businessdetali::where("vendorid",$vendorId)->update(['businessname' => request('businessname'), 'addressone' => request('addressone'), 'addresstwo' => request('addresstwo'), 'landmark' => request('landmark'), 'city' => request('city'),'state' => request('state'),'country' => request('country'),'pincode' => request('pincode'),'companytype' => request('companytype'),'businesstype' => request('businesstype'),'yoe' => request('yoe'),'ppoyc' => request('ppoyc'),'gst' => request('gst'),'pan' => request('pan'),'adhar' => request('adhar'),'tan' => request('tan') ]);
        Businessdetali::where("vendorid",$vendorId)->update(['businessname' => request('businessname'),'companytype' => request('companytype'),'businesstype' => request('businesstype'), 'gst' => request('gst'),'pan' => request('pan'),'adhar' => request('adhar') ]);
       
        Session::flash('message','Business Detail Updated Successfully');
        return redirect('vendor/vendorprofile');
        
        // Auth::logout('message','Please contact to admin !!');
        // return redirect("/vendor");

    }
    // Abhishek --- End Bank Details And Business Details 


}
