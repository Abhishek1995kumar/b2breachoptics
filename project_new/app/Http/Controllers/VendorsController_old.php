<?php

namespace App\Http\Controllers;

use App\Product;
use App\UserProfile;
use App\Vendors;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VendorsController extends Controller
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
        $vendors = Vendors::where('status','2')->get();
        return view('admin.vendors',compact('vendors'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {   
        
        $vendors = Vendors::where('status', 0)->get();
        return view('admin.vendorspending',compact('vendors'));
    }

    public function pendingdoc(){

        $vendors = DB::table('vendor_profiles')
                ->join('new_bank_details', 'vendor_profiles.id', '=', 'new_bank_details.vendorid')
                ->join('new_business_details', 'vendor_profiles.id', '=', 'new_business_details.vendorid')
                ->where('vendor_profiles.status', 1)
                ->get();
        // dd($vendors);
        return view('admin.vendorspendingdoc',compact('vendors'));
    }

    public function Correctiondoc(){

        $vendors = DB::table('vendor_profiles')
                ->join('new_bank_details', 'vendor_profiles.id', '=', 'new_bank_details.vendorid')
                ->join('new_business_details', 'vendor_profiles.id', '=', 'new_business_details.vendorid')
                ->where('vendor_profiles.status', 3)
                ->get();
        // dd($vendors);
        return view('admin.vendorscorrectiondoc',compact('vendors'));
    }

    public function accept($id)
    {
        // print_r($id);die();
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 1;

        // mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');

        $vendor->update($status);
        return redirect('admin/vendors/pending')->with('message','Vendor Accepted Successfully');
    }

    public function reject($id)
    {
        $vendor = Vendors::findOrFail($id);
        // mail($vendor->email,'Your Vendor Registration Rejected','Your Vendor Account Registration Rejected. Please Contact Admin for further details.');

        $vendor->delete();
        return redirect('admin/vendors/pending')->with('message','Vendor Rejected Successfully');
    }

    public function acceptdoc($id)
    {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 2;

        // mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');

        $vendor->update($status);
        return redirect('admin/vendors/pending')->with('message','Vendor Approve Successfully');
    }

    public function waitingdoc($id)
    {
        $vendor = Vendors::findOrFail($id);
        $status['status'] = 3;

        // mail($vendor->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');

        $vendor->update($status);
        return redirect('admin/vendors/pending')->with('message','Send Document Correction Request Successfully');
    }

    public function rejectdoc($id)
    {
        $vendor = Vendors::findOrFail($id);
        // mail($vendor->email,'Your Vendor Registration Rejected','Your Vendor Account Registration Rejected. Please Contact Admin for further details.');

        $vendor->delete();
        return redirect('admin/vendors/pending')->with('message','Vendor Rejected Successfully');
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
        $vendor = DB::table('vendor_profiles')
                ->join('new_bank_details', 'new_bank_details.vendorid', '=', 'vendor_profiles.id')
                ->join('new_business_details', 'new_business_details.vendorid', '=', 'vendor_profiles.id')
                ->where('new_business_details.vendorid', '=', $id)
                ->first();
        // dd($vendor);

        // $vendor = Vendors::findOrFail($id);
        // $bankdetails = DB::table('new_bank_details')->where('vendorid',$id)->first();
        // $businessdetails = DB::table('new_business_details')->where('vendorid',$id)->first();
        // dd($businessdetails);
        // dd($bankdetails);
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
        // mail($request->to,$request->subject,$request->message);
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

 

   


}
