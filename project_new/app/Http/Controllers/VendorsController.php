<?php

namespace App\Http\Controllers;

use App\Product;
use App\UserProfile;
use App\Vendors;
use DB;
use App\Businessdetali;
use App\Bankdetali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NewBusinessDetail;
use App\NewBankDetail;
use Illuminate\Support\Facades\Session;


class VendorsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    
    // Abhishek
    public function index() {
        $vendors = DB::table('vendor_profiles')->whereIn('status', [1,2,3,4,5])->get();
        return view('admin.vendors',compact('vendors'));
    }
    
    // Abhishek
    public function pending() {
        $vendors = DB::table('vendor_profiles')->where('status', 0)->orderBy('id','desc')->get();
        return view('admin.vendorspending',compact('vendors'));
    }

    // Abhishek 
    public function pendingdoc(){
        $vendors = Vendors::where('status', 1)->get();
        return view('admin.vendorspendingdoc',compact('vendors'));
    }

    // Abhishek 
    public function uploadeddoc(){
        $bankdetail = Bankdetali::where('status', 0)->get();
        $vendors = array();
        if(count($bankdetail)>0)
        {
            for($i=0; $i<count($bankdetail); $i++)
            {
                $data[$i] = Vendors::where('status', 1)->where('id', $bankdetail[$i]->vendorid)->get();
                array_push($vendors, $data[$i]);
            }
        }
        return view('admin.uploadedvendordov', compact('vendors'));
    }

    public function accept($id)
    {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 1;
        $vendor->update($status);
        mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');
        return redirect('admin/vendors')->with('message','Vendor Accepted Successfully');
    }

    // Abhishek
    public function reject($id)
    {
        $vendor = Vendors::findOrFail($id);
        mail($vendor->email,'Your Vendor Registration Rejected','Your Vendor Account Registration Rejected. Please Contact Admin for further details.');
        $vendor->delete();
        return redirect('admin/vendors')->with('message','Vendor Rejected Successfully');
    }
    

    // Abhishek
    public function Correctiondoc(){
        $vendors = DB::table('vendor_profiles')
                ->where('status', 3)
                ->get();
        return view('admin.vendorscorrectiondoc',compact('vendors'));
    }


    public function waitingdoc($id) {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 3;
        $vendor->update($status);
        // mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');
        return redirect('admin/vendors')->with('message','Send Document Correction Request Successfully');
    }

    public function acceptdoc($id) {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 2;
        $status['narration'] = NULL;
        $status['note'] = NULL;
        Bankdetali::where('vendorid', $id)->update(['status' => 1]);
        Businessdetali::where('vendorid', $id)->update(['status' => 1]);
        $vendor->update($status);
        mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');
        Session::flash('message', 'Vendor Approve Successfully');
        return response()->json(['status'=>'success', 'message'=>'Vendor Approve Successfully']);
    }


    // Abhishek
    public function rejectdoc($id) {
        $vendor = Vendors::findOrFail($id);
        $businessdeta = Businessdetali::where('vendorid', $id)->get();
        $bankdet = Bankdetali::where('vendorid', $id)->get();
        
        if($vendor->status == 1){
            try {
                unlink('assets/images/VendorDoc/'.$businessdeta[0]->adharimg);
                unlink('assets/images/VendorDoc/'.$businessdeta[0]->trademarkimg);
                unlink('assets/images/VendorDoc/'.$businessdeta[0]->udyamimg);
                unlink('assets/images/VendorDoc/'.$businessdeta[0]->companylogo);
                
                unlink('assets/images/VendorDoc/'.$bankdet[0]->cancelcheck);
                unlink('assets/images/VendorDoc/'.$bankdet[0]->passbook);
                
            } catch (\Exception $e) {
                //
            }
            $businessdeta[0]->delete();
            $bankdet[0]->delete();
            $vendor->update(['status'=>1, 'note'=>'Your Document Rejected Please Resubmit Document']);
        }
        else
        {
            $vendor->update(['status'=>5, 'note'=>'Your Document Rejected Please Resubmit Document', 'narration'=>NULL]);
        }
        mail($vendor->email,'Your Vendor Bank & Business Details are Rejected','Your Vendor Bank & Business Details are Rejected. Please Contact Admin for further details.');
        Session::flash('message', 'Vendor Bank & Business Details are Rejected');
        return response()->json(['status'=>'success', 'message'=>'Vendor Bank & Business Details are Rejected']);
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
    public function show($id) {
        $vendor = DB::table('vendor_profiles as vp')
                    ->leftjoin('bankdetalis as bk', 'bk.vendorid', '=', 'vp.id')
                    ->leftjoin('businessdetalis as bss', 'bss.vendorid', '=', 'vp.id')
                    ->select('vp.*', 'bk.accountholdername', 'bk.accountnumber', 'bk.bankname', 'bk.ifsccode', 'bk.accounttype', 'bk.cancelcheck', 'bk.passbook',
                    'bss.businessname', 'bss.addressone', 'bss.addresstwo', 'bss.companytype', 'bss.businesstype', 'bss.gst', 'bss.pan', 'bss.adhar', 'bss.adharimg',
                    'bss.trademarkimg', 'bss.udyamimg', 'bss.companylogo')
                    ->where('vp.id', $id)->get();
        return view('admin.vendordetails',compact('vendor'));
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

    public function email($id)
    {
        $vendor = Vendors::findOrFail($id);
        return view('admin.vensendemail', compact('vendor'));
    }

    public function sendemail(Request $request)
    {
        mail($request->to,$request->subject,$request->message);
        return redirect('admin/vendors')->with('message','Email Send Successfully');
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
     * Remove the specified resource from storage.x
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendors = Vendors::findOrFail($id);
        Product::where('vendorid',$id)->delete();

        $vendors->delete();
        return redirect('admin/vendors')->with('message','Vendor Delete Successfully.');
    }
    
    public function active($id)
    {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 2;
        $vendor->update($status);
        Session::flash('message', 'Vendor Activate Successfully...!!');
        return response()->json(['status'=>'success', 'message'=>'Vendor Activate Successfully...!!']);
    }
    
    public function deactive($id)
    {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 4;
        $vendor->update($status);
        Session::flash('message', 'Vendor Deactive Successfully...!!');
        return response()->json(['status'=>'success', 'message'=>'Vendor Deactivate Successfully...!!']);
    }

    public function vendorexportExcel(){
        //print_r("helo");die();
        $result = [];
        $vendors = DB::table('vendor_profiles')->whereIn('status', [1,2,3,4,5]);
        $result = $vendors->get();
        return $result;
        //print_r($result);die();
    }

}
