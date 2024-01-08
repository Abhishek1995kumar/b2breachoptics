<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\OrderedProducts;
use DB;
use Carbon\Carbon;
use App\Product;
use App\Category;
use App\UserProfile;
use App\Vendors;
use App\Order;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = Report::find(Auth::user()->id);
        return view('admin.report' , compact('admin'));
    }

    public function report_list(Request $request)
    {
        $categories = Category::where('role','main')->get();
        $brandname = DB::table('brand_name')->where('status',1)->get();
        $filtter_report = "53";
        return view('admin.report_list',compact('categories','brandname','filtter_report'));
    }
    
    public function listPurchase(Request $request)
    {
        $category_id = $_POST['mainid'];
        $filtter_report = DB::table('products')->select('*')->where('category',$category_id)->get();
        return $filtter_report;
    }

    public function Export()
    {
        
    }

    public function sales_report_list()
    {
        $categories = Category::where('role','main')->get();
        $buyers = UserProfile::where('status', "1")->get();
        $countries = DB::table('b2b_countrymaster')->where('Active', 1)->get();
        return view('admin.salesreport',compact('categories', 'buyers', 'countries'));
    }
    
    public function getState(Request $request)
    {
        $states = DB::table('b2b_statemaster')->where('CountryId', $request->id)->where('Active', 1)->get();
        return $states;
    }

    public function getSalesOrder(Request $request)
    {
        $date = Carbon::parse($request->form['tdate'])->addDays(1);
        $tdate = $date->toDateString();
        
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        $salesorder = $_POST['form'];
        $salesorder['nextdate'] = $tdate;
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        
        $product_details_total = $this->get_list_data(false, $search_term, $other_configs, $salesorder);
        $product_details_count = $this->get_list_data(true, $search_term, $other_configs, $salesorder);

        
        $data = array();
        $count = 0;
        foreach($product_details_total as $row => $vals) {
            $count++;
            $nestedData = array();

            $sgst = '';
            $cgst = '';
            $igst = '';
            $gstamount = '';
            $subtotal = '';
            
            if($vals->tax != "")
            {
                if($vals->buyer_state == "22")
                {
                    $sgst = $vals->tax/2;
                    $cgst = $vals->tax/2;
                    $igst = '--';
                    $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                }
                else
                {
                    $sgst = '--';
                    $cgst = '--';
                    $igst = $vals->tax;
                    $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                }
            }
            else
            {
                if($vals->buyer_state == "22")
                {
                    if($vals->premiumtype != ""){
                        if($vals->premiumtype == "Sunglasses")
                        {
                            $sgst = 18/2;
                            $cgst = 18/2;
                            $igst = '--';
                            $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                        }
                        else if($vals->premiumtype == "Frames")
                        {
                            $sgst = 12/2;
                            $cgst = 12/2;
                            $igst = '--';
                            $gstamount = 12 * ($vals->costprice * $vals->quantity)/100;
                        }
                    }
                }
                else
                {
                    if($vals->premiumtype != ""){
                        if($vals->premiumtype == "Sunglasses")
                        {
                            $sgst = '--';
                            $cgst = '--';
                            $igst = 18;
                            $gstamount = 18 * ($vals->costprice * $vals->quantity)/100;
                        }
                        else if($vals->premiumtype == "Frames")
                        {
                            $sgst = '--';
                            $cgst = '--';
                            $igst = 12;
                            $gstamount = 12 * ($vals->costprice * $vals->quantity)/100;
                        }
                    }
                }
            }
            
            $nestedData[] = $count;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->invoice_number;
            $nestedData[] = $vals->seller_order_id;
            $nestedData[] = $vals->buyer_order_id;
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->buyer_phone;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->Sname;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->categoryID == 82 ? $vals->cname : $vals->cname;
            $nestedData[] = $vals->hsncode;
            $nestedData[] = $vals->gst_no;
            $nestedData[] = $vals->cost;
            $nestedData[] = 0;
            $nestedData[] = $sgst;
            $nestedData[] = $cgst;
            $nestedData[] = $igst;
            $nestedData[] = $gstamount;
            $nestedData[] = (float)$vals->cost * $vals->quantity + (float)$gstamount;
            $nestedData[] = 0;
            $nestedData[] = (float)$vals->cost * $vals->quantity + (float)$gstamount;
            $nestedData[] = $vals->status;
            
            $data[] = $nestedData;
        }
      
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_details_count,
            'recordsFiltered' => $product_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_list_data($count, $search_term = '', $other_configs, $salesorder = array(), $condition = false)
    {
        DB::enableQueryLog();
        $owner = $salesorder['owner'];
        $product = [];
        if(isset($search_term) && $search_term!="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.status', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term, $other_configs)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                        $join->orwhere('bs.Name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'oo.buyer_order_id','oo.seller_order_id', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$salesorder['fdate'], $salesorder['nextdate']])
                ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                ->orderBy('op.created_at', 'desc');

                
                if($owner != "" && $owner != 'all'){
                    $data->where('op.owner', $owner);
                }
                if($salesorder['buyer_name'] != "" && $salesorder['buyer_name'] != 'all'){
                    $data->where('buyer_name', 'like', '%' . $salesorder['buyer_name'] . '%');
                }
                if($salesorder['category'] != "" && $salesorder['category'] != 'all'){
                    $data->where('categoryID', $salesorder['category']);
                }
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $product = $data->get();
        }
        else{
            
            // DB::enableQueryLog();
            
            $data = DB::table('ordered_products as op')
                    ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'oo.buyer_order_id','oo.seller_order_id', 'up.gst_no')
                    ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                    ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                    ->leftjoin('products as p', 'op.productid', 'p.id')
                    ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                    ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                    ->whereBetween('op.created_at', [$salesorder['fdate'], $salesorder['nextdate']])
                    ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                    ->orderBy('op.created_at', 'desc');
                    
                
                    if($owner != "" && $owner != 'all'){
                        $data->where('op.owner', $owner);
                    }
                    if($salesorder['buyer_name'] != "" && $salesorder['buyer_name'] != 'all'){
                        $data->where('buyer_name', 'like', '%' . $salesorder['buyer_name'] . '%');
                    }
                    if($salesorder['category'] != "" && $salesorder['category'] != 'all'){
                        $data->where('categoryID', $salesorder['category']);
                    }
                
                    if(!$count && $other_configs['length']){
                        $data->limit($other_configs['length']);
                        $data->offset($other_configs['offset']);
                    }
                        
                    $product = $data->get();
        }

        if($count){
            return count($product);
        }
        else {
            return $product;
        }
        
    }

    public function exportExcel(Request $request)
    {
        $date = Carbon::parse($request['tdate'])->addDays(1);
        $tdate = $date->toDateString();
        
        $search_term = $request['search'];
        $owner = $request['owner'];
        
        $product = [];
        if($request['search'] != "")
        {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term){
                    $query->where('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.status', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                        $join->orwhere('bs.Name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$request['fdate'], $tdate])
                ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                ->orderBy('op.created_at', 'desc');

                if($request->buyer != "" && $request->buyer != 'all'){
                    $data->where('buyer_name', 'like', '%' . $request->buyer . '%');
                }
                if($request['category'] != "" && $request['category'] != 'all'){
                    $data->where('categoryID', $request['category']);
                }
                
                $product = $data->get();
            return $product;
        }
        else
        {
            $data = DB::table('ordered_products as op')
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$request['fdate'], $tdate])
                ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                ->orderBy('op.created_at', 'desc');
                
                
                if($owner != "" && $owner != 'all'){
                    $data->where('op.owner', $owner);
                }
                if($request->buyer != "" && $request->buyer != 'all'){
                    $data->where('buyer_name', 'like', '%' . $request->buyer . '%');
                }
                if($request['category'] != "" && $request['category'] != 'all'){
                    $data->where('categoryID', $request['category']);
                }
                    
                $product = $data->get();
            return $product;
        }
        
    }
    
    public function cancilReportList(Request $request){
        $categories = Category::where('role','main')->get();
        $buyers = UserProfile::where('status', "1")->get();
        $countries = DB::table('b2b_countrymaster')->where('Active', 1)->get();
        $vendors = Vendors::all();
        return view('admin.cancilreport', compact('categories', 'buyers', 'vendors'));
    }
    
    public function getCancilOrder(Request $request)
    {
        $to_date = Carbon::parse($request->form['to_date'])->addDays(1);
        
        $cancils_order = $_POST['form'];
        $next_date = $to_date->toDateString();
        $cancils_order['to_date'] = $next_date;
        
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        
        $product_details_total = $this->get_cancel_list_data(false, $search_term, $other_configs, $cancils_order);
        $product_details_count = $this->get_cancel_list_data(true, $search_term, $other_configs, $cancils_order);
        
        $data = array();
        $count = 0;
        foreach($product_details_total as $row => $vals) {
            $count++;
            $nestedData = array();

            $sgst = '';
            $cgst = '';
            $igst = '';
            $gstamount = '';
            $subtotal = '';
            
            if($vals->tax != "")
            {
                if($vals->buyer_state == "22")
                {
                    $sgst = $vals->tax/2;
                    $cgst = $vals->tax/2;
                    $igst = '--';
                    $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                }
                else
                {
                    $sgst = '--';
                    $cgst = '--';
                    $igst = $vals->tax;
                    $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                }
            }
            else
            {
                if($vals->buyer_state == "22")
                {
                    if($vals->premiumtype != ""){
                        if($vals->premiumtype == "Sunglasses")
                        {
                            $sgst = 18/2;
                            $cgst = 18/2;
                            $igst = '--';
                            $gstamount = $vals->tax * ($vals->costprice * $vals->quantity)/100;
                        }
                        else if($vals->premiumtype == "Frames")
                        {
                            $sgst = 12/2;
                            $cgst = 12/2;
                            $igst = '--';
                            $gstamount = 12 * ($vals->costprice * $vals->quantity)/100;
                        }
                    }
                }
                else
                {
                    if($vals->premiumtype != ""){
                        if($vals->premiumtype == "Sunglasses")
                        {
                            $sgst = '--';
                            $cgst = '--';
                            $igst = 18;
                            $gstamount = 18 * ($vals->costprice * $vals->quantity)/100;
                        }
                        else if($vals->premiumtype == "Frames")
                        {
                            $sgst = '--';
                            $cgst = '--';
                            $igst = 12;
                            $gstamount = 12 * ($vals->costprice * $vals->quantity)/100;
                        }
                    }
                }
            }
            
            $nestedData[] = $count;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->owner;
            $nestedData[] = $vals->order_payment_method;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->canceled_date;
            $nestedData[] = $vals->canceled_reason;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->previous_price;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->vendorname != "" ? $vals->vendorname : "Reach";
            $nestedData[] = $vals->buyer_name;
            // $nestedData[] = $vals->categoryID == 82 ? $vals->cname : $vals->cname;
            // $nestedData[] = 0;
            // $nestedData[] = $sgst;
            // $nestedData[] = $cgst;
            // $nestedData[] = $igst;
            // $nestedData[] = $gstamount;
            // $nestedData[] = (float)$vals->cost * $vals->quantity + (float)$gstamount;
            // $nestedData[] = 0;
            // $nestedData[] = (float)$vals->cost * $vals->quantity + (float)$gstamount;
            if($vals->status == 'declined')
            {
                $nestedData[] = Str::limit($vals->buyer_name, 20, ' ...');
            }
            else if($vals->status == 'cancelled')
            {
                $nestedData[] = 'Admin';
            }
            $nestedData[] = $vals->gst_no;
            
            $data[] = $nestedData;
        }
      
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_details_count,
            'recordsFiltered' => $product_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_cancel_list_data($count, $search_term = '', $other_configs, $cancils_order = array(), $condition = false)
    {
        $from_date = $cancils_order['from_date'];
        $next_date = $cancils_order['to_date'];
        $categoryID = $cancils_order['categories'];
        $buyerName = $cancils_order['buyer_name'];
        $vendorName = $cancils_order['vendor_name'];
        $owner = $cancils_order['owner'];
        
        $product = [];
        if(isset($search_term) && $search_term!="")
        {
            $data = DB::table('ordered_products as op')
            ->where(function($query) use ($search_term){
                $query->where('op.buyer_name', 'like', '%' . $search_term . '%');
                $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                $query->orwhere('op.owner', 'like', '%' . $search_term . '%');
                $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.status', 'like', '%' . $search_term . '%');
                $query->orwhere(function($join) use ($search_term)
                {
                    $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                    $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                    $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                    $join->orwhere('bs.Name', 'like', '%' . $search_term . '%');
                });
            })
            ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.previous_price', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
            ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
            ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
            ->leftjoin('products as p', 'op.productid', 'p.id')
            ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
            ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
            ->whereBetween('op.created_at',  [$from_date, $next_date])
            ->whereIn('op.status', ['cancelled', 'declined'])
            ->orderBy('op.created_at', 'desc');

            if($owner != "" && $owner != 'all'){
                $data->where(op.'owner', $owner);
            }
            if($categoryID != "" && $categoryID != 'all'){
                $data->where('op.categoryID', $categoryID);
            }
            if($buyerName != "" && $buyerName != 'all'){
                $data->where('op.buyer_name', 'like', '%' . $buyerName . '%');
            }
            if($vendorName != "" && $vendorName != 'all'){
                $data->where('op.seller_name', 'like', '%' . $vendorName . '%');
            }
                
            if(!$count && $other_configs['length']){
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }
            
            $product = $data->get();
        }
        else
        {
            $data = DB::table('ordered_products as op')
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.previous_price', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$from_date, $next_date])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');
                
                if($owner != "" && $owner != 'all'){
                    $data->where('op.owner', $owner);
                }
                if($categoryID != "" && $categoryID != 'all'){
                    $data->where('op.categoryID', $categoryID);
                }
                if($buyerName != "" && $buyerName != 'all'){
                    $data->where('op.buyer_name', 'like', '%' . $buyerName . '%');
                }
                if($vendorName != "" && $vendorName != 'all'){
                    $data->where('op.seller_name', 'like', '%' . $vendorName . '%');
                }
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
             
            $product = $data->get();
            
        }
        
        if($count){
            return count($product);
        }
        else {
            return $product;
        }
    }

    public function exportCancelExcel(Request $request)
    {
        $date = Carbon::parse($request['to_date'])->addDays(1);
        $tdate = $date->toDateString();
        
        $from_date = $request['fdate'];
        $categoryID = $request['category'];
        $buyerName = $request['buyer'];
        $vendorName = $request['vendor'];
        $owner = $request['owner'];
        
        $search_term = $request['search'];
        
        $product = [];
        if($request['search'] != "")
        {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term){
                    $query->where('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.owner', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.status', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                        $join->orwhere('bs.Name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'p.previous_price', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$from_date, $tdate])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');

                if($owner != "" && $owner != 'all'){
                    $data->where('op.owner', $owner);
                }
                if($categoryID != "" && $categoryID != 'all'){
                    $data->where('op.categoryID', $categoryID);
                }
                if($buyerName != "" && $buyerName != 'all'){
                    $data->where('op.buyer_name', 'like', '%' . $buyerName . '%');
                }
                if($vendorName != "" && $vendorName != 'all'){
                    $data->where('op.seller_name', 'like', '%' . $vendorName . '%');
                }
                
                $product = $data->get();
            return $product;
        }
        else
        {
            $data = DB::table('ordered_products as op')
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'p.previous_price', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->whereBetween('op.created_at', [$from_date, $tdate])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');
                
                if($owner != "" && $owner != 'all'){
                    $data->where('op.owner', $owner);
                }
                if($categoryID != "" && $categoryID != 'all'){
                    $data->where('op.categoryID', $categoryID);
                }
                if($buyerName != "" && $buyerName != 'all'){
                    $data->where('op.buyer_name', 'like', '%' . $buyerName . '%');
                }
                if($vendorName != "" && $vendorName != 'all'){
                    $data->where('op.seller_name', 'like', '%' . $vendorName . '%');
                }
                
                $product = $data->get();
            return $product;
        }
        
    }
    
    
    // Abhishek Return Order Details Code Start from here --
    public function returnOrderList(){
        $category = Category::where('role','main')->select("name")->get();
        $buyer_name = DB::table("ordered_products")->select("buyer_name")->get();
        $vendor_name = DB::table("businessdetalis")->select("businessname")->get();
        $countries = DB::table('b2b_countrymaster')->where('Active', 1)->get();
        DB::enableQueryLog();
        $owner_name = DB::table("ordered_products")->select("owner")
                    ->groupBy('ordered_products.owner')
                    ->get()->toArray();
        return view("admin.returnOrder", compact("category", "buyer_name", "vendor_name","owner_name"));
    }

    public function getReturnOrderDetails(Request $request){
        $filter_data = $_POST['returnOrderDetails'];
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_item = $request['search']['value'];
        $other_configs['length'] = $start;
        $other_configs['offset'] = $length;

        $total_return_order_value = $this->retrive_return_order_data(false, $search_item, $other_configs, $filter_data);
        $count_return_order_value = $this->retrive_return_order_data(true, $search_item, $other_configs, $filter_data);
        $data = array();
        foreach($total_return_order_value as $key=>$val){
            $start++;
            $loopData = array();
            $loopData[] = $val->orderid ? $val->orderid : " -- ";
            $loopData[] = $val->category ? $val->category : " -- ";
            $loopData[] = $val->owner ? $val->owner : " -- ";
            $loopData[] = substr($val->created_at, 0, 11) ? substr($val->created_at, 0, 11) : " -- ";
            $loopData[] = $val->order_payment_method ? $val->order_payment_method : " -- ";
            $loopData[] = substr($val->returnorder_date, 0, 11) ? substr($val->returnorder_date, 0, 11) : " -- ";
            $loopData[] = $val->return_reason ? $val->return_reason : " -- ";
            $loopData[] = $val->return_status ? $val->return_status : " -- ";
            $loopData[] = $val->return_completed_date ? $val->return_completed_date : " -- ";
            $loopData[] = $val->quantity ? $val->quantity : " -- ";
            $loopData[] = $val->cost ? $val->cost : " -- ";
            $loopData[] = substr($val->product_title, 0, 20) ? substr($val->product_title, 0, 20) . '..' : "--";
            $loopData[] = $val->product_sku ? $val->product_sku : " -- ";
            $loopData[] = $val->modelno ? $val->modelno : " -- ";
            $loopData[] = $val->previous_price ? $val->previous_price : " -- ";
            $loopData[] = $val->businessname ? $val->businessname : " -- ";
            $loopData[] = $val->gst ? $val->gst : " -- ";
            $loopData[] = $val->buyer_name ? $val->buyer_name : " -- ";
            $loopData[] = $val->gst_no ? $val->gst_no : " -- ";

            $data[] = $loopData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $count_return_order_value,
            'recordsFiltered' => $count_return_order_value,
            'data' => $data,
        );
        echo json_encode($output);
    }

    public function retrive_return_order_data($count, $search_item, $other_configs, $filter_data){
        $fromdate = $filter_data['fromDate'];
        $todate = $filter_data['toDate'];
        $mainCategory = $filter_data['mainCategory'];
        $buyerName = $filter_data['buyerName'];
        $ownerName = $filter_data['ownerName'];
        $vendorName = $filter_data['vendorName'];
        $value = [];
        if(isset($search_item) && $search_item !=""){
            $retriveReturnOrderDetails = DB::table("ordered_products as op")
                                        ->where(function($query) use ($search_item){
                                            $query->where('op.orderid', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.owner', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.created_at', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.order_payment_method', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.returnorder_date', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.return_reason', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.return_status', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.return_completed_date', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.quantity', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.cost', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.product_title', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.product_sku', 'like', '%' . $search_item . '%');
                                            $query->orwhere('op.buyer_name', 'like', '%' . $search_item . '%');
                                            $query->orwhere(function($join) use ($search_item){
                                                $join->orwhere('p.modelno', 'like', '%' . $search_item . '%');
                                                $join->orwhere('p.previous_price', 'like', '%' . $search_item . '%');
                                                $join->orwhere('b.businessname', 'like', '%' . $search_item . '%');
                                                $join->orwhere('category', 'like', '%' . $search_item . '%');
                                                $join->orwhere('b.gst', 'like', '%' . $search_item . '%');
                                                $join->orwhere("us.gst_no", 'like', '%' . $search_item . '%');
                                            });
                                        })
                                        ->select("op.orderid","ct.name as category", "op.owner", "op.created_at", "op.order_payment_method", "op.returnorder_date", 
                                                    "op.return_reason", "op.return_status", "op.return_completed_date", "op.quantity",  "op.cost", "op.product_title", 
                                                    "op.product_sku", "p.modelno", "p.previous_price", "b.businessname", "b.gst", "op.buyer_name", "us.gst_no" 
                                                    )
                                        ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                                        ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                                        ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                                        ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                                        ->whereBetween("op.created_at", [$fromdate, $todate])
                                        ->where('op.status', 'return')
                                        ->orderBy('op.created_at', 'desc');

                                        if($mainCategory != "all" && $mainCategory !=""){
                                            $retriveReturnOrderDetails->where('op.categoryID', 'like', '%' .$mainCategory. '%');
                                        }
                                        if($buyerName != "all" && $buyerName !=""){
                                            $retriveReturnOrderDetails->where('op.buyer_name', 'like', '%' .$buyerName. '%');
                                        }
                                        if($ownerName != "all" && $ownerName !=""){
                                            $retriveReturnOrderDetails->where('op.owner', 'like', '%' .$ownerName. '%');
                                        }
                                        if($vendorName != "all" && $vendorName !=""){
                                            $retriveReturnOrderDetails->where('op.shop_name', 'like', '%' .$vendorName. '%');
                                        }
                                        if(!$count && $other_configs['length']){
                                            $data->limit($other_configs['length']);
                                            $data->offset($other_configs['offset']);
                                        }

            $value = $retriveReturnOrderDetails->get();
        }else{
            DB::enableQueryLog();
            $retriveReturnOrderDetails = DB::table("ordered_products as op")
                                        ->select("op.orderid","ct.name as category", "op.owner", "op.created_at", "op.order_payment_method", "op.returnorder_date", 
                                                    "op.return_reason", "op.return_status", "op.return_completed_date", "op.quantity",  "op.cost", "op.product_title", 
                                                    "op.product_sku", "p.modelno", "p.previous_price", "b.businessname", "b.gst", "op.buyer_name", "us.gst_no" 
                                                    )
                                        ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                                        ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                                        ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                                        ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                                        ->whereBetween("op.created_at", [$fromdate, $todate])
                                        ->where('op.status', 'return')
                                        ->orderBy('op.created_at', 'desc');
                                        if($mainCategory !="" && $mainCategory !="all"){
                                            $retriveReturnOrderDetails->where('op.categoryID', $mainCategory);
                                        }
                                        if($buyerName !="" && $buyerName !="all"){
                                            $retriveReturnOrderDetails->where('op.buyer_name', $buyerName);
                                        }
                                        if($ownerName !="" && $ownerName !="all"){
                                            $retriveReturnOrderDetails->where('p.owner',$ownerName);
                                        }
                                        if($vendorName !="" && $vendorName !="all"){
                                            $retriveReturnOrderDetails->where('b.businessname',$vendorName);
                                        }
            $value = $retriveReturnOrderDetails->get();
        }
        if($count){
            return count($value);
        }
        else {
            return $value;
        }
    }

    public function getExportExcel(Request $request){
        $filter_excel_data = $_POST['data'];
        $fromDate = $filter_excel_data['fromDate'];
        $toDate = $filter_excel_data['toDate'];
        $mainCategory = $filter_excel_data['mainCategory'];
        $buyerName = $filter_excel_data['buyerName'];
        $ownerName = $filter_excel_data['ownerName'];
        $vendorName = $filter_excel_data['vendorName'];
        $search_item = $request['search'];
        $value = array();
        if($search_item !="" ){
            $exportData = DB::table("ordered_products as op")
                            ->where(function($query) use ($search_item){
                                $query->where('op.orderid', 'like', '%' . $search_item . '%');
                                $query->where('op.category', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.owner', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.created_at', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.order_payment_method', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.returnorder_date', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.return_reason', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.return_status', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.return_completed_date', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.quantity', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.cost', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.product_title', 'like', '%' . $search_item . '%');
                                $query->orwhere('op.product_sku', 'like', '%' . $search_item . '%');
                                $query->orwhere(function($join) use ($search_item){
                                    $join->orwhere('p.modelno', 'like', '%' . $search_item . '%');
                                    $join->orwhere('p.previous_price', 'like', '%' . $search_item . '%');
                                    $join->orwhere('b.businessname', 'like', '%' . $search_item . '%');
                                    $join->orwhere('b.gst', 'like', '%' . $search_item . '%');
                                    $join->orwhere('us.gst_no', 'like', '%' . $search_item . '%');
                                });
                                $query->orwhere('op.buyer_name', 'like', '%' . $search_item . '%');
                            })
                            ->select("op.orderid","ct.name as category", "op.owner", "op.created_at", "op.order_payment_method", "op.returnorder_date", 
                                        "op.return_reason", "op.return_status", "op.return_completed_date", "op.quantity",  "op.cost", "op.product_title", 
                                        "op.product_sku", "p.modelno", "p.previous_price", "b.businessname", "b.gst", "op.buyer_name", "us.gst_no" 
                                        )
                            ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                            ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                            ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                            ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                            ->whereBetween("op.created_at", [$fromDate, $toDate])
                            ->where('op.status', 'return')
                            ->orderBy('op.created_at', 'desc');

                            if($mainCategory !="" && $mainCategory !="all"){
                                $exportData->where('op.categoryID', 'like', '%' .$mainCategory. '%');
                            }
                            if($buyerName !="" && $buyerName !="all"){
                                $exportData->where('op.categoryID', 'like', '%' .$buyerName. '%');
                            }
                            if($ownerName != "all" && $ownerName !=""){
                                $exportData->where('op.owner', 'like', '%' .$ownerName. '%');
                            }
                            if($vendorName != "all" && $vendorName !=""){
                                $exportData->where('op.shop_name', 'like', '%' .$vendorName. '%');
                            }
                        $value = $exportData->get();
                        return $value;
        }else{
            $exportData = DB::table("ordered_products as op")
                            ->select("op.orderid","ct.name as category", "op.owner", "op.created_at", "op.order_payment_method", "op.returnorder_date", 
                            "op.return_reason", "op.return_status", "op.return_completed_date", "op.quantity",  "op.cost", "op.product_title", "op.product_sku",
                            "p.modelno", "p.previous_price", "b.businessname", "b.gst", "op.buyer_name", "us.gst_no" )
                            ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                            ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                            ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                            ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                            ->whereBetween("op.created_at", [$fromDate, $toDate])
                            ->where('op.status', 'return')
                            ->orderBy('op.created_at', 'desc');
                            if($mainCategory !="" && $mainCategory !="all"){
                                $exportData->where('op.categoryID', $mainCategory);
                            }
                            if($buyerName !="" && $buyerName !="all"){
                                $exportData->where('op.buyer_name', $buyerName);
                            }
                            if($ownerName !="" && $ownerName !="all"){
                                $exportData->where('p.owner',$ownerName);
                            }
                            if($vendorName !="" && $vendorName !="all"){
                                $exportData->where('b.businessname',$vendorName);
                            }
                    $value = $exportData->get();
                    return $value;
        }
    }
}
