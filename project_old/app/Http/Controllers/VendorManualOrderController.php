<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;
use App\Product;
use App\ProductAttr;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;
use DateTime;
use Dompdf\Dompdf;
use stdClass;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class VendorManualOrderController extends Controller
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
        return view('vendor.manualorderlist');
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
            $processing_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','processing')->count();
            $picked_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','picked')->count();
            $intransit_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','InTransit')->count();
            $completed_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','completed')->count();
            $pending_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','pending')->count();
    
            $total_count['processing_total'] = $processing_total;
            $total_count['picked_total'] = $picked_total;
            $total_count['intransit_total'] = $intransit_total;
            $total_count['completed_total'] = $completed_total;
            $total_count['pending_total'] = $pending_total;
            return response()->json(['status'=> true, 'msg'=>'Order Status Updated Successfully', 'data'=>$total_count]);
        }
    }
    
    public function courier_boy(Request $request) {
        $bookslot = OrderedProducts::findOrFail($request['id']);
        
        $status = $request['status'];
        $cpurierboy = $request['courier_boy'];

        $sts['status'] = $status;
        $sts['courier_boy'] = $cpurierboy;
        $sts['intransit_date'] = new DateTime();
        $sts['entry_by'] = Auth::user()->name;
        
        $bookslot->update($sts);
        
        $total_count = [];
        $picked_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','picked')->count();
        $intransit_total = DB::table('ordered_products')->where('vendorid', Auth::guard('vendor')->user()->id)->where('status','=','InTransit')->count();
        $total_count['picked_total'] = $picked_total;
        $total_count['intransit_total'] = $intransit_total;
        
        return response()->json(['status'=> true, 'msg'=>'Slot is Booked', 'data'=>$total_count]);
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
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


    public function generateVendorPDF($id)
    {
        // $order = Order::findOrFail($id);

        // new added code for new order functionlity
         $order = OrderedProducts::findOrFail($id);
        // end new added code for new order functionlity

        $data = ['title' => 'Invoice'];
        $pdf = PDF::loadView('vendor.invoice', compact('order'), $data);
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
    
    public function cancelorder(Request $request)
    {
        $cancelorderlist = OrderedProducts::where('vendorid', Auth::guard('vendor')->user()->id)->whereIn('status', ['cancelled', 'declined'])->where('owner','=','vendor')->orderBy('id','desc')->get();
        
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
            $status = 'processing';
            
            $checkButton = "<td class='text-center' style='font-size: 15px;'><input type='checkbox'  name='ids' value='" . $vals->id . "' class='checkBoxClass'></td>";
        
            $actionButton = "<div class='pull-left'><a href='javascript:void(0)' style='padding: 0;' action='processing' onclick='orderAcceptAndReject(".$vals->id.", event)' class='btn btn-xs btn-success'><i style='padding: 3px 5px;' class='fa fa-check-square' style='font-size:15px'></i></a></div>";

            $actionButton .= "<div class='pull-right'><a href='javascript:void(0)' style='padding: 0;' action='cancelled' onclick='orderAcceptAndReject(".$vals->id.", event)' class='btn btn-xs btn-danger'><i style='padding: 3px 5px;' class='fa fa-close' style='font-size:15px'></i></a></div>";

            $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";

            $nestedData[] = $checkButton;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
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
                    ->where('op.vendorid','=',Auth::user()->id)
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
            
            $checkButton = "<td class='text-center' style='font-size: 15px;'><input type='checkbox'  name='idsnew' value='" . $vals->id . "' class='checkBoxClass'></td>";
            
            if($vals->invoice_number != ""){
                $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='orderConfirm(".$vals->id.", event)'  class='btn btn-success'>Confirm</a>";
            }
            else
            {
                $actionButton .= "<a href='javascript:void(0)' action='picked' onclick='alertmassege(event)'  class='btn btn-success'>Confirm</a>";
            }

            $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px; color:#1ca24c;'></i></a></td>";

            $eyeButton .= "<br><a href='javascript:void(0)' id='combine_order' data-status=".$status." onclick='view_combine_order(".$vals->id.", ".$vals->orderid.", ".$invoice.", event)' style='color: #0f110e;'><i class='fa fa-print' aria-hidden='true'></i></a>";
            
            if($vals->invoice_number != ""){
                $pdfBtn = url('vendormanualgeneratePDF/'.$vals->id);
                $eyeButton .= "<br><a href='$pdfBtn' style='color: red;'><i class='fa fa-arrow-down' aria-hidden='true'></i></a>";
            }
            else
            {
                $eyeButton .= "<br><a href='javascript:void(0)' onclick='invoiceDowload()' style='color: red;'><i class='fa fa-arrow-down' aria-hidden='true'></i></a>";
            }
            
            $nestedData[] = $checkButton;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->order_accept_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
                })
                ->select('op.*')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
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
                        ->where('op.vendorid','=',Auth::user()->id)
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
                $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('op.*')
            ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
            ->where('op.vendorid','=', Auth::guard('vendor')->user()->id)
            ->orderBy('op.created_at','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            DB::enableQueryLog();
            $data = DB::table('ordered_products as op')
                    ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                    ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
                    ->select('op.*','pro.previous_price','pro.modelno as modelno', 'o.customer_zip', 'o.cost as cost_price', 'o.pay_amount')
                    ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
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

            $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";

            $actionButton = "<a onclick='pickupModelShow(".$vals->id.")'><button class='btn btn-primary' >Pickup</button></a>";

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->pickup_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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

    public function get_ready_for_pickup_data($count, $search_term = '', $other_configs){
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('op.orderid', $search_term);
                $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.order_accept_date', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('op.*')
            ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
            ->where('op.status','=','picked')
            ->orderBy('op.pickup_date','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products as op')
                    ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
                    ->where('op.status','=','picked')
                    ->orderBy('op.pickup_date','desc');

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
        
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';

            $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";

            $actionButton = "<button action='completed' onclick='orderDelivered(".$vals->id.", event)' class='btn btn-primary' >Delivered</button>";

            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->intransit_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->courier_boy;
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
            $data = DB::table('ordered_products as op')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('orderid', $search_term);
                $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.order_accept_date', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                $query->orwhere('op.courier_boy', 'like', '%' . $search_term . '%');
                $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('op.*')
            ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
            ->where('op.status','=','InTransit')
            ->orderBy('op.id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products as op')
                        ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
                        ->where('op.status','=','InTransit')
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

    public function get_delivered_details(Request $request){
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $order_details_total = $this->get_delivered_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_delivered_data(true, $search_term, $other_configs);
            
        $data = array();
        foreach($order_details_total as $row => $vals) {
            $nestedData = array();
            $eyeButton = '';
        
            $invoice = json_encode($vals->invoice_number);
            $status = "completed";

            $eyeButton = "<td class='text-center' style='font-size: 15px;cursor: pointer;'><a onclick='checkEyesOrder(".$vals->id.")' data-toggle='modal' href='javascript:void(0)'  class='eye-btn' ><i class='fa fa-eye' style='font-size:15px'></i></a></td>";

            $eyeButton .= "<br><a href='javascript:void(0)' data-status=".$status." onclick='view_combine_order(".$vals->id.", ".$vals->orderid.", ".$invoice.", event)' style='color: #0f110e;'><i class='fa fa-print' aria-hidden='true'></i></a>";
            
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->order_confirm_date;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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

    public function get_delivered_data($count, $search_term = '', $other_configs)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
            ->where(function($query) use ($search_term, $other_configs){
                $query->where('op.orderid', $search_term);
                $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                $query->orwhere('op.order_confirm_date', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            })
            ->select('*')
            ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
            ->where('op.status','=','completed')
            ->orderBy('op.id','desc');
            
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $result = $data->get();
        }else{
            $data = DB::table('ordered_products as op')
                    ->where('op.vendorid','=',Auth::guard('vendor')->user()->id)
                    ->where('op.status','=','completed')
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
            $entry = Auth::guard('vendor')->user()->name;
    
            $last = str_pad($invoice_series,6,"0",STR_PAD_LEFT);
            $var = "RCH";
            $year = Carbon::now();
            $cyear = substr($year->year, 2,4);
            $syear = Carbon::now();
            $nextyear = substr($syear->addYear(1)->year, 2,4);
    
            $invoice = $var . "/" . $cyear . "-" . $nextyear . "/" . $last;
    
            OrderedProducts::where('orderid',$order_id)
                            ->where('vendorid', Auth::guard('vendor')->user()->id)
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
                            ->where('vendorid', Auth::guard('vendor')->user()->id)
                            ->where('status', '=','processing')
                            ->whereNull('invoice_number')
                            ->update(['invoice_number' => $invoice]);
        }
        
        DB::enableQueryLog();
        $datas = DB::table('ordered_products as op')
        ->where('op.vendorid', Auth::guard('vendor')->user()->id)
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
     //end new code for seller order module 

}
