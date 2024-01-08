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
            $nestedData[] = $vals->orderid;
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->buyer_phone;
            $nestedData[] = $vals->product_title;
            $nestedData[] = DB::table('b2b_statemaster')->where('id', $vals->buyer_state)->get()[0]->Name;
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->where('op.vendorid', Auth::user()->id)
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
                    ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax')
                    ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                    ->leftjoin('products as p', 'op.productid', 'p.id')
                    ->where('op.vendorid', Auth::user()->id)
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->where('op.vendorid', Auth::user()->id)
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
                ->where('op.vendorid', Auth::user()->id)
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
        // dd($product_details_total);
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
            $nestedData[] = $vals->order_payment_method;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->modelno != "" ? $vals->modelno : "N/A";
            $nestedData[] = $vals->canceled_date;
            $nestedData[] = $vals->canceled_reason;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
                ->where('op.vendorid', Auth::user()->id)
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
                ->where('op.vendorid', Auth::user()->id)
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
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
                ->select('op.*', 'cat.name as cname', 'p.modelno', 'p.hsncode', 'p.costprice', 'cat.tax', 'bs.Name as Sname')
                ->leftjoin('categories as cat', 'op.categoryID', 'cat.id')
                ->leftjoin('products as p', 'op.productid', 'p.id')
                ->leftjoin('b2b_statemaster as bs', 'op.buyer_state', 'bs.id')
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
}
