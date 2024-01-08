<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Vendors;
use App\NewBusinessDetail;
use App\NewBankDetail;
use App\Businessdetali;
use App\Bankdetali;
use App\Narration;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function index() {
        $vendor = Vendors::find(Auth::user()->id);
        // $BankDetails = NewBankDetail::where('vendorid', Auth::user()->id)->first();
        // $BusinessDetails = NewBusinessDetail::where('vendorid', Auth::user()->id)->first();
        
        $city = DB::table("b2b_citymaster")->where('Active',1)->get();
        $state = DB::table("b2b_statemaster")->where('Active',1)->get();
        $country = DB::table("b2b_countrymaster")->where('Active',1)->get();
        $BankDetails = DB::table("bankdetalis")->where('vendorid', Auth::user()->id)->first();
        $BusinessDetails = DB::table("businessdetalis")->where('vendorid', Auth::user()->id)->first();
        return view('vendor.vendorprofile' , compact('vendor','BankDetails','BusinessDetails', 'city', 'state', 'country'));
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

    // Abhishek
    public function update(Request $request, $id) {
        $user = Vendors::findOrFail($id);
        $input = $request->all();
        
        
        if($user->status == 1){
            if($file = $request->file('addressproof')) {
                DB::table("vendor_profiles")->where("id", $id)->update(['status'=>0, 'narration'=>'addressproof changes']);
            }
            else{
                DB::table("vendor_profiles")->where("id", $id)->update(['status'=>1, 'narration'=>$input->narration]);
            }
        }
        else if($user->status == 2 || $user->status == 5){
            DB::table("vendor_profiles")->where("id", $id)->update(['status'=>3]);
        }
        
        if ($file = $request->file('photo')){
            $photo = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/vendor',$photo);
            $input['photo'] = $photo;
        }

        if($file = $request->file('addressproof')) {
            $addressproof = time().$request->file('addressproof')->getClientOriginalName();
            $file->move('assets/images/vendor/addressproof',$addressproof);
            $input['addressproof']= $addressproof ;
            //print_r($file );die();
        };

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
        $user->update($input);
        Auth::logout('message','Please contact to admin !!');
        return redirect("/vendor");
    }
    

    public function changepass(Request $request, $id)  {
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

    public function deletemyvendor() {
        //dd(Auth::user()->toArray());
        $vendorId = Auth::user()->id;
        $vendors = Vendors::findOrFail($vendorId);
        Product::where('vendorid',$vendorId)->delete();
        Auth::logout();
        $vendors->delete();
        return redirect('/home')->with('message','Vendor Delete Successfully.');
    }

    // Abhishek
    public function AddBusinessDetails(Request $request){
        $vendorId = Auth::user()->id;
        
        $businessStatus = Auth::user()->status;
        $businessdetails = new Businessdetali();
        $businessdetails->vendorid = $vendorId;
        $businessdetails->vendor_status = $businessStatus;
        $businessdetails->businessname = $request->get('businessname');
        $businessdetails->companytype = $request->get('companytype');
        $businessdetails->businesstype = $request->get('businesstype');
        $businessdetails->gst = $request->get('gst');
        $businessdetails->pan = $request->get('pan');
        $businessdetails->adhar = $request->get('adhar');
        $businessdetails->tan = $request->get('tan');
        $businessdetails->status = 0;

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
        };

        $businessdetails->save();
        $lastBusinessId = $businessdetails->id;
        Session::flash('message', 'Businessdetails Add Successfully');
        return response()->json(['status'=>'success', 'message'=>'Businessdetails Add Successfully']);
    }



    // Abhishek
    public function AddBankDetails(Request $request) {
        $vendorId = Auth::user()->id;
        
        // $bank_query = DB::table("bankdetalis")->where('vendorid', '=', $vendorId)->get();
        // $count = $bank_query->count();
        
        // if($count > 0){ // update
        //     $input = $request->all();
        //     if($file = $request->file('cancelcheck')) {
        //         $cancelcheck = time().$request->file('cancelcheck')->getClientOriginalName();
        //         $file->move('assets/images/VendorDoc',$cancelcheck);
        //         $BankDetails->cancelcheck = $cancelcheck ;
        //     }
    
        //     if($file = $request->file('passbook')) {
        //         $passbook = time().$request->file('passbook')->getClientOriginalName();
        //         $file->move('assets/images/VendorDoc',$passbook);
        //         $BankDetails->passbook = $passbook ;
        //     }
        //     $bank_query->update($input);
        //     Session::flash('message', 'Bankdetails Add Successfully');
        // }
        // else{  // insert
            // $vendorStatus = Auth::user()->status;
            // $BankDetails = new Bankdetali;
            // $BankDetails->vendorid = $vendorId;
            // $BankDetails->vendor_status = $vendorStatus;
            // $BankDetails->accountholdername = $request->get('accountholdername');
            // $BankDetails->accountnumber = $request->get('accountnumber');
            // $BankDetails->bankname = $request->get('bankname');
            // $BankDetails->ifsccode = $request->get('ifsccode');
            // $BankDetails->accounttype = $request->get('accounttype');
            // $BankDetails->status = 0;
            // $BankDetails->save();
            // if($file = $request->file('cancelcheck')) {
            //     $cancelcheck = time().$request->file('cancelcheck')->getClientOriginalName();
            //     $file->move('assets/images/VendorDoc',$cancelcheck);
            //     $BankDetails->cancelcheck = $cancelcheck ;
            // }
    
            // if($file = $request->file('passbook')) {
            //     $passbook = time().$request->file('passbook')->getClientOriginalName();
            //     $file->move('assets/images/VendorDoc',$passbook);
            //     $BankDetails->passbook = $passbook ;
            // }
        // }
        
        $vendorStatus = Auth::user()->status;
        $BankDetails = new Bankdetali;
        $BankDetails->vendorid = $vendorId;
        $BankDetails->vendor_status = $vendorStatus;
        $BankDetails->accountholdername = $request->get('accountholdername');
        $BankDetails->accountnumber = $request->get('accountnumber');
        $BankDetails->bankname = $request->get('bankname');
        $BankDetails->ifsccode = $request->get('ifsccode');
        $BankDetails->accounttype = $request->get('accounttype');
        $BankDetails->status = 0;
        
        if($file = $request->file('cancelcheck')) {            
            $cancelcheck = time().$request->file('cancelcheck')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$cancelcheck);
            $BankDetails->cancelcheck = $cancelcheck ;
        };

        if($file = $request->file('passbook')) {            
            $passbook = time().$request->file('passbook')->getClientOriginalName();
            $file->move('assets/images/VendorDoc',$passbook);
            $BankDetails->passbook = $passbook ;
        };
        
        $BankDetails->save();
        Session::flash('message', 'Bankdetails Add Successfully');
        return response()->json(['status'=>'success', 'message'=>'Bankdetails Add Successfully']);
    }

}
