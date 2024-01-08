<?php

namespace App\Http\Controllers;

use App\Counter;
use App\OrderedProducts;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // Cache::flush();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = "";
        $sales = "";
        for($i = 0; $i < 30; $i++) {
            $days .= "'".date("d M", strtotime('-'. $i .' days'))."',";

            $sales .=  "'".OrderedProducts::whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $i .' days')))->sum('quantity')."',";
        }

        $referrals = Counter::where('type','referral')->orderBy('total_count','desc')->take(5)->get();
        $browsers = Counter::where('type','browser')->orderBy('total_count','desc')->take(5)->get();

        $orders = Order::all()->count();
        $codorders = Order::where('method', 'COD')->count();
        $razororders = Order::where('method', 'Razorpay')->count();
        $cedit90DaysOrders = Order::where('method', 'Payment Terms with in 90 Days Credit Period')->count();

        $totalOrders = OrderedProducts::all()->count();
        $cancelOrders = OrderedProducts::whereIn('status', ['declined', 'cancelled'])->count();
        $returnOrders = OrderedProducts::where('status', 'return')->count();
        $pendingOrders = OrderedProducts::whereIn('status', ['pending', 'processing', 'picked', 'intransit'])->count();
        $completedOrders = OrderedProducts::where('status', 'completed')->count();

        DB::enableQueryLog();
        $monthOrders = OrderedProducts::select(DB::raw('count(*) as total'), DB::raw('MONTHNAME(created_at) as month'))
                                        ->whereYear('created_at', date('Y'))
                                        ->groupby('month')
                                        ->get()->toArray();
        return view('admin.dashboard',compact('referrals','browsers','days','sales', 'orders', 'codorders', 'razororders', 'cedit90DaysOrders', 'totalOrders', 'cancelOrders', 'returnOrders', 'pendingOrders', 'completedOrders'));
    }

    public function test(){
        echo "test";
    }
}
