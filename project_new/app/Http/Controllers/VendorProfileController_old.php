<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Vendors;
use App\NewBusinessDetail;
use App\NewBankDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class VendorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:vendor');
        //$this->userid = Auth::user()->id;
    }

    public function index()
    {
        //
        $vendor = Vendors::find(Auth::user()->id);
        
        $BankDetails = NewBankDetail::where('vendorid', Auth::user()->id)->first();
        // echo"<pre>";
        //  print_r($BankDetails);die();
        $BusinessDetails = NewBusinessDetail::where('vendorid', Auth::user()->id)->first();
        // dd($BankDetails);
        return view('vendor.vendorprofile' , compact('vendor','BankDetails','BusinessDetails'));
    }

    public function password()
    {
        $vendor = Vendors::find(Auth::user()->id);
        return view('vendor.vendorchangepass' , compact('vendor'));
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

    // TEST
    // test new

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // print_r($request->all());die();
        $user = Vendors::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')){
            $photo = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/vendor',$photo);
            $input['photo'] = $photo;
            // $input['status'] = 3;
        }

        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Doesnot match.');
                    return redirect('vendor/vendorprofile');
                }
            }else{
                Session::flash('error', 'Vendor Profile Updated Successfully.');
                return redirect('vendor/vendorprofile');
            }
        }
        //return $request->cpass;
        //return "Not..";
        
        //  DB::enableQueryLog();
        $user->update($input);
        // print_r(DB::getQueryLog());die();
        Session::flash('message', 'Your Vendor Profile Updated Successfully.');
        return redirect('vendor/vendorprofile');
    }

    public function changepass(Request $request, $id)
    {
        $user = Vendors::findOrFail($id);
        $input['password'] = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect('vendor/vendorpassword');
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect('vendor/vendorpassword');
            }
        }

        $user->update($input);
        Session::flash('message', 'Your Vendor Password Updated Successfully.');
        return redirect('vendor/vendorpassword');
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

    public function deletemyvendor()
    {
        //dd(Auth::user()->toArray());
        $vendorId = Auth::user()->id;
        $vendors = Vendors::findOrFail($vendorId);
        Product::where('vendorid',$vendorId)->delete();
        Auth::logout();
        $vendors->delete();
        return redirect('/home')->with('message','Vendor Delete Successfully.');
    }


    public function AddBusinessDetails(Request $request){

        // $this->validate($request, [
        //  'businessname' => 'required|max:255',
        //     'adharimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=500,max_height=500',
        //     'trademarkimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=500,max_height=500',
        //     'udyamimg' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=500,max_height=500',
        //     'companylogo' => 'mimes:jpeg,png,pdf|max:400kb|dimensions:max_width=500,max_height=500',
        // ]);

        $vendorId = Auth::user()->id;
        $businessdetails = new NewBusinessDetail();
        $businessdetails->vendorid = $vendorId;
        $businessdetails->businessname = request('businessname');
        $businessdetails->addressone = request('addressone');
        $businessdetails->addresstwo = request('addresstwo');
        $businessdetails->landmark = request('landmark');
        $businessdetails->city = request('city');
        $businessdetails->state = request('state');
        $businessdetails->country = request('country');
        $businessdetails->pincode = request('pincode');
        $businessdetails->companytype = request('companytype');
        $businessdetails->businesstype = request('businesstype');
        $businessdetails->yoe = request('yoe');
        $businessdetails->ppoyc = request('ppoyc');
        $businessdetails->gst = request('gst');
        $businessdetails->pan = request('pan');
        $businessdetails->adhar = request('adhar');
        $businessdetails->tan = request('tan');

         if($file = $request->file('adharimg')) {
            
            $adharimg = time().$request->file('adharimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$adharimg);
            $businessdetails->adharimg = $adharimg ;
        }

         if($file = $request->file('trademarkimg')) {
            
            $trademarkimg = time().$request->file('trademarkimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$trademarkimg);
            $businessdetails->trademarkimg = $trademarkimg ;
        }

         if($file = $request->file('udyamimg')) {
            
            $udyamimg = time().$request->file('udyamimg')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$udyamimg);
            $businessdetails->udyamimg = $udyamimg ;
        }

         if($file = $request->file('companylogo')) {
            
            $companylogo = time().$request->file('companylogo')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$companylogo);
            $businessdetails->companylogo = $companylogo ;
        }

        $businessdetails->save();
        Session::flash('message', 'Businessdetails Add Successfully.');

        return redirect('vendor/vendorprofile');
    }


    public function AddBankDetails(Request $request){
        // print_r("Heloo");die();

        // $this->validate($request, [
        //     'accountholdername' => 'required|max:255',
        //     'cancelcheck' => 'mimes:jpeg,png,pdf|max:400|dimensions:max_width=500,max_height=500',
        //     'passbook' => 'mimes:jpeg,png,pdf|max:400|dimensions:max_width=500,max_height=500',
        // ]);

        $vendorId = Auth::user()->id;
        $BankDetails = new NewBankDetail();
        $BankDetails->vendorid = $vendorId;
        $BankDetails->accountholdername = request('accountholdername');
        $BankDetails->accountnumber = request('accountnumber');
        $BankDetails->bankname = request('bankname');
        $BankDetails->ifsccode = request('ifsccode');
        $BankDetails->accounttype = request('accounttype');

         if($file = $request->file('cancelcheck')) {
            
            $cancelcheck = time().$request->file('cancelcheck')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$cancelcheck);
            $BankDetails->cancelcheck = $cancelcheck ;
        }

        if($file = $request->file('passbook')) {
            
            $passbook = time().$request->file('passbook')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$passbook);
            $BankDetails->passbook = $passbook ;
        }
        
        $BankDetails->save();
        Session::flash('message','Bank Detail Add Successfully');
        return redirect('vendor/vendorprofile');


    }







}
