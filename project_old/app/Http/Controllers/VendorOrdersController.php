<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;
use DateTime;
use Dompdf\Dompdf;

class VendorOrdersController extends Controller
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
        $totalorders = OrderedProducts::where('vendorid',Auth::user()->id)->orderBy('id','desc')->get();
        // new added code for seller order module
        $totalpending = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','pending')->orderBy('id','desc')->get();
        $totalprocessing = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','processing')->orderBy('id','desc')->get();
        $totalconfirm = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','picked')->orderBy('id','desc')->get();
        $totalintransit = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','InTransit')->orderBy('id','desc')->get();
        $totalcompleted = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','completed')->orderBy('id','desc')->get();
        // end of new added code for seller order module
        return view('vendor.orderlist',compact('totalorders','totalpending','totalprocessing','totalconfirm','totalintransit','totalcompleted'));
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

    public function status($id,$status)
    {
        $order = OrderedProducts::findOrFail($id);
        $stat['status'] = $status;
        $order->update($stat);
        return redirect('vendor/orders')->with('message','Order Status Updated Successfully');
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

// new code for seller order module 

     public function changeallselectedsts(Request $request)
        {

            $ids = $request->ids;
            $date = date('Y-m-d');

            OrderedProducts::whereIn('id',$ids)->update(['status' => 'processing','order_accept_date' => $date]);

            return redirect('vendor/orders')->with('message','Order Status Updated Successfully...!');


        }


    public function confirmallselectedorders(Request $request)
        {

         $ids = $request->ids;
         $date = date('Y-m-d');

         OrderedProducts::whereIn('id',$ids)->update(['status' => 'picked','order_confirm_date'=> $date ]);

         return redirect('vendor/orders')->with('message','Order Status Updated Successfully...!');



        }


        public function vendorbookslot(Request $request,$id) 
        {

              $bookslot = OrderedProducts::findOrFail($id);
              $dateforslot = $request->input('dateforslot');
              $timeforslot = $request->input('timeforslot');
              $sts['book_slot_date'] = $dateforslot;
              $sts['book_slot_time'] = $timeforslot;
              $bookslot->update($sts);
              return redirect('vendor/orders')->with('message','Slot is Booked');
         }


      public function generatePDF($id)
            {
                // $order = Order::findOrFail($id);

                // new added code for new order functionlity
                 $order = OrderedProducts::findOrFail($id);
                // end new added code for new order functionlity

                $data = ['title' => 'Invoice'];
                $pdf = PDF::loadView('invoice', compact('order'), $data);
                return $pdf->download('Invoice.pdf');

                // return $pdf->stream('Invoice.pdf');
            }


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
            
        public function returnorder()
        {
            $Accept = DB::table('ordered_products')->where('status','=','return')->where('vendorid',Auth::user()->id)->where('return_status','=','accept')->orderBy('id','desc')->get();
           $Intransit = DB::table('ordered_products')->where('status','=','return')->where('vendorid',Auth::user()->id)->where('return_status','=','intransit')->orderBy('id','desc')->get();
           $Completed = DB::table('ordered_products')->where('status','=','return')->where('vendorid',Auth::user()->id)->where('return_status','=','completed')->orderBy('id','desc')->get();
            return view('vendor.returnorderlist',compact('Accept','Intransit','Completed'));
        }

        public function cancelorder()
        {

            $cancelorderlist = OrderedProducts::where('vendorid',Auth::user()->id)->where('status','=','cancelled')->orderBy('id','desc')->get();
            return view('vendor.cancelorderlist',compact('cancelorderlist'));
        }

        public function returnorderdetails($id){

            $allcanceldata = OrderedProducts::findOrFail($id);
            return view('vendor.vendorreturnorderdetails',compact('allcanceldata'));
        }

        public function cancelorderdetails($id){

            $allcanceldata = OrderedProducts::findOrFail($id);
            return view('vendor.vendorcancelorderdetails',compact('allcanceldata'));

        }


     //end new code for seller order module 

}
