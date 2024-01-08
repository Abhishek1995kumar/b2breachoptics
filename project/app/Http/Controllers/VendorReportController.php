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

class VendorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        return view('vendor.report');
    }

    public function report_list(Request $request)
    {
        $categories = Category::where('role','main')->get();
        $brandname = DB::table('brand_name')->where('status',1)->get();
        $filtter_report = "53";
        return view('vendor.report_list',compact('categories','brandname','filtter_report'));
    }
    
    public function listPurchase(Request $request)
    {
        $category_id = $_POST['mainid'];
        $filtter_report = DB::table('products')->select('*')->where('category',$category_id)->get();
        return $filtter_report;
    }

    public function sales_report_list()
    {
        $categories = Category::where('role','main')->get();
        $buyers = UserProfile::where('status', "1")->get();
        return view('vendor.salesreport',compact('categories', 'buyers'));
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
            if($vals->tax != "")
            {
                if($vals->buyer_state == "maharashtra" || $vals->buyer_state == "Maharashtra" || $vals->buyer_state == "MAHARASHTRA")
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
                if($vals->buyer_state == "maharashtra" || $vals->buyer_state == "Maharashtra" || $vals->buyer_state == "MAHARASHTRA")
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
            $nestedData[] = $vals->id;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->invoice_number;
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->buyer_phone;
            $nestedData[] = $vals->product_title;
            $nestedData[] = $vals->Sname;
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cname;
            $nestedData[] = $vals->hsncode;
            $nestedData[] = $vals->costprice;
            $nestedData[] = 0;
            $nestedData[] = $sgst;
            $nestedData[] = $cgst;
            $nestedData[] = $igst;
            $nestedData[] = $gstamount;
            $nestedData[] = (float)$vals->costprice * $vals->quantity + (float)$gstamount;
            $nestedData[] = 0;
            $nestedData[] = (float)$vals->costprice * $vals->quantity + (float)$gstamount;
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
                    $query->orwhere(function($join) use ($search_term, $other_configs)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'state.name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as state', 'op.buyer_state', 'state.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->where('p.vendorid', Auth::guard('vendor')->user()->id)
                ->whereBetween('op.created_at', [$salesorder['fdate'], $salesorder['nextdate']])
                ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                ->orderBy('op.created_at', 'desc');

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
            
            $data = DB::table('ordered_products as op')
                    ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'state.name as Sname', 'oo.order_number', 'up.gst_no')
                    ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                    ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                    ->leftjoin('products as p', 'op.productid', 'p.id')
                    ->leftjoin('b2b_statemaster as state', 'op.buyer_state', 'state.id')
                    ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                    ->where('p.vendorid', Auth::guard('vendor')->user()->id)
                    ->whereBetween('op.created_at', [$salesorder['fdate'], $salesorder['nextdate']])
                    ->whereNotIn('op.status', ['cancelled', 'declined', 'return'])
                    ->orderBy('op.created_at', 'desc');

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
                    $query->orwhere('op.buyer_state', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term)
                    {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('p.hsncode', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->where('p.vendorid', Auth::guard('vendor')->user()->id)
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->where('p.vendorid', Auth::guard('vendor')->user()->id)
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
    }
    
    public function vendorcancilReportList()
    {
        $categories = Category::where('role', 'main')->get();
        $buyers = UserProfile::where('status', "1")->get();
        return view('vendor.cancelreport', compact('categories', 'buyers'));
    }
    
    public function getCancilOrder(Request $request)
    {
        $date = Carbon::parse($request->form['to_date'])->addDays(1);
        $to_date = $date->toDateString();

        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        $cancilsorder = $_POST['form'];

        $cancilsorder['nextdate'] = $to_date;

        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $product_details_total = $this->get_cancil_list_data(false, $search_term, $other_configs, $cancilsorder);
        $product_details_count = $this->get_cancil_list_data(true, $search_term, $other_configs, $cancilsorder);
        
        $data = array();
        $count = 0;
        $cancil_by = "";
        foreach ($product_details_total as $vals) {

            $count++;
            $nestedData = array();
            $nestedData[] = $count;
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->owner;
            $nestedData[] = $vals->order_payment_method;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->modelno != "" ? $vals->modelno : "N/A";
            $nestedData[] = $vals->canceled_date;
            $nestedData[] = $vals->canceled_reason;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
            $nestedData[] = $vals->seller_name != "" ? $vals->seller_name : "Reach";
            $nestedData[] = $vals->buyer_name;

            

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

    public function get_cancil_list_data($count, $search_term = '', $other_configs, $cancilsorder = array(), $condition = false)
    {
        DB::enableQueryLog();
        $product = [];
        if (isset($search_term) && $search_term != "") {
        
            $data = DB::table('ordered_products as op')
                ->where(function ($query) use ($search_term, $other_configs) {
                    $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.owner', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.order_payment_method', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_reason', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.seller_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    $query->orwhere(function ($join) use ($search_term, $other_configs) {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->where('op.vendorid', Auth::guard('vendor')->user()->id)
                ->whereBetween('op.created_at', [$cancilsorder['from_date'], $cancilsorder['nextdate']])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');

            if ($cancilsorder['buyer_name'] != "" && $cancilsorder['buyer_name'] != 'all') {
                $data->where('buyer_name', 'like', '%' . $cancilsorder['buyer_name'] . '%');
            }
            if ($cancilsorder['category'] != "" && $cancilsorder['category'] != 'all') {
                $data->where('categoryID', $cancilsorder['category']);
            }

            if (!$count && $other_configs['length']) {
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }

            $product = $data->get();
        } else {
            $data = DB::table('ordered_products as op')
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->where('op.vendorid', Auth::guard('vendor')->user()->id)
                ->whereBetween('op.created_at', [$cancilsorder['from_date'], $cancilsorder['nextdate']])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');

            if ($cancilsorder['buyer_name'] != "" && $cancilsorder['buyer_name'] != 'all') {
                $data->where('buyer_name', 'like', '%' . $cancilsorder['buyer_name'] . '%');
            }
            if ($cancilsorder['category'] != "" && $cancilsorder['category'] != 'all') {
                $data->where('categoryID', $cancilsorder['category']);
            }

            if (!$count && $other_configs['length']) {
                $data->limit($other_configs['length']);
                $data->offset($other_configs['offset']);
            }

            $product = $data->get();
        }

        if ($count) {
            return count($product);
        } else {
            return $product;
        }
    }


    public function getExportCancilOrder(Request $request)
    {
        $date = Carbon::parse($request['to_date'])->addDays(1);
        $tdate = $date->toDateString();

        $search_term = $request['search'];

        $product = [];
        if ($request['search'] != "") {
            $data = DB::table('ordered_products as op')
                ->where(function ($query) use ($search_term) {
                    $query->orwhere('op.id', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.orderid', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.owner', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.order_payment_method', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_date', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.canceled_reason', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.seller_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
                    
                    $query->orwhere(function ($join) use ($search_term) {
                        $join->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                        $join->orwhere('cat.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->where('op.vendorid', Auth::user()->id)
                ->whereBetween('op.created_at', [$request['from_date'], $tdate])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');

            if ($request->buyer != "" && $request->buyer != 'all') {
                $data->where('buyer_name', 'like', '%' . $request->buyer . '%');
            }
            if ($request['category'] != "" && $request['category'] != 'all') {
                $data->where('categoryID', $request['category']);
            }

            $product = $data->get();
            return $product;
        } else {
            $data = DB::table('ordered_products as op')
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname', 'oo.order_number', 'up.gst_no')
                ->leftjoin('orders as oo', 'op.orderid', 'oo.id')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->leftjoin('user_profiles as up', 'oo.customerid', 'up.id')
                ->where('op.vendorid', Auth::user()->id)
                ->whereBetween('op.created_at', [$request['from_date'], $tdate])
                ->whereIn('op.status', ['cancelled', 'declined'])
                ->orderBy('op.created_at', 'desc');
            if ($request->buyer != "" && $request->buyer != 'all') {
                $data->where('buyer_name', 'like', '%' . $request->buyer . '%');
            }
            if ($request['category'] != "" && $request['category'] != 'all') {
                $data->where('categoryID', $request['category']);
            }

            $product = $data->get();
            return $product;
        }
    }
    
    // Abhishek
    public function return_order_details(){
        $category = DB::select("SELECT * FROM categories where role like 'main'");
        $buyer_name = DB::select("SELECT * from user_profiles where status = '1' ORDER BY id DESC");
        return view('vendor.returnOrder', compact('category', 'buyer_name'));
    }
    
    public function return_order_data_from_database(Request $request){
        $filter_data = $_POST['data'];
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
            $loopData[] = substr($val->created_at, 0, 11) ? substr($val->created_at, 0, 11) : "---";
            $loopData[] = $val->order_payment_method ? $val->order_payment_method : " -- ";
            $loopData[] = $val->returnorder_date ? $val->returnorder_date : " -- ";
            $loopData[] = $val->return_reason ? $val->return_reason : " -- ";
            $loopData[] = $val->return_status ? $val->return_status : " -- ";
            $loopData[] = $val->return_completed_date ? $val->return_completed_date : " -- ";
            $loopData[] = $val->quantity ? $val->quantity : " -- ";
            $loopData[] = $val->cost ? $val->cost : " -- ";
            $loopData[] = substr($val->product_title, 0, 20) ? substr($val->product_title, 0, 20) . '..' : "---";
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
        $mainCategory = $filter_data['category_name'];
        $buyerName = $filter_data['buyer'];
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
                                        ->where("op.vendorid", Auth::user()->id)
                                        ->orderBy('op.created_at', 'desc');
                                        
                                        if($mainCategory != "all" && $mainCategory !=""){
                                            $retriveReturnOrderDetails->where('op.categoryID', 'like', '%' .$mainCategory. '%');
                                        }
                                        if($buyerName != "all" && $buyerName !=""){
                                            $retriveReturnOrderDetails->where('op.buyer_name', 'like', '%' .$buyerName. '%');
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
                                        ->where("op.vendorid", Auth::user()->id)
                                        ->where('op.status', 'return')
                                        ->orderBy('op.created_at', 'desc');
                                        if($mainCategory !="" && $mainCategory !="all"){
                                            $retriveReturnOrderDetails->where('op.categoryID', $mainCategory);
                                        }
                                        if($buyerName !="" && $buyerName !="all"){
                                            $retriveReturnOrderDetails->where('op.buyer_name', $buyerName);
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
    
    public function export_return_order_data(Request $request){
        $export_data = $_POST['data'];
        $fromdate      = $request['data']['fromDate'];
        $todate        = $request['data']['toDate'];
        $category_name = $request['data']['category_name'];
        $buyer_name         = $request['data']['buyer_name'];
        $search_item = $request['search'];
        
        $value = array();
        if($search_item !="" ){
            $exportData = DB::table("ordered_products as op")
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
                            ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                            ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                            ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                            ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                            ->whereBetween("op.created_at", [$fromdate, $todate])
                            ->where("op.vendorid", Auth::user()->id)
                            ->where('op.status', 'return')
                            ->orderBy('op.created_at', 'desc');
                            
                if($category_name !="all" && $category_name !=''){
                    $exportData->where("op.categoryID", $category_name);
                }
                if($buyer_name !="" && $buyer_name !="all"){
                    $exportData->where("op.buyer_name", $buyer_name);
                }
                $value = $exportData->get();
                return $value;
        }else{ 
            $exportData = DB::table("ordered_products as op")
                        ->select("op.orderid","ct.name as category", "op.owner", "op.created_at", "op.order_payment_method", "op.returnorder_date", 
                                    "op.return_reason", "op.return_status", "op.return_completed_date", "op.quantity",  "op.cost", "op.product_title", 
                                    "op.product_sku", "p.modelno", "p.previous_price", "b.businessname", "b.gst", "op.buyer_name", "us.gst_no" 
                                    )
                        ->leftjoin("user_profiles as us", "us.id" ,"=", "op.customer_id_new")
                        ->leftjoin("products as p", "p.id" ,"=", "op.productid")
                        ->leftjoin("categories as ct", "ct.id" ,"=", "op.categoryID")
                        ->leftjoin("businessdetalis as b", "b.vendorid" ,"=", "op.vendorid")
                        ->whereBetween("op.created_at", [$fromdate, $todate])
                        ->where("op.vendorid", Auth::user()->id)
                        ->where('op.status', 'return')
                        ->orderBy('op.created_at', 'desc');
            
                if($category_name !="all" && $category_name !=''){
                    $exportData->where("op.categoryID", $category_name);
                }
                if($buyer_name !="" && $buyer_name !="all"){
                    $exportData->where("op.buyer_name", $buyer_name);
                }
                $value = $exportData->get();
                
                return $value;
                echo"<pre>";print_r($exportData);die();
        }
        
    }
}
