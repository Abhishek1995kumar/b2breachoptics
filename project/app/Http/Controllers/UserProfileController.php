<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use App\ProductAttr;
use App\Review;
use App\Settings;
use App\OrderedProducts;
use App\UserProfile;
use App\PickUpLocations;
use App\Coupan;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Country;
use App\State;
use App\City;
use DB;
use DateTime;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:profile',['except' => 'checkout','cashondelivery']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('user_profiles')
            ->select('user_profiles.*','c.Name as country','b2b_statemaster.Name as state','b2b_citymaster.Name as city')
            ->leftjoin('b2b_countrymaster as c', 'user_profiles.country', 'c.id')
            ->leftjoin('b2b_statemaster', 'user_profiles.state', 'b2b_statemaster.id')
            ->leftjoin('b2b_citymaster', 'user_profiles.city', 'b2b_citymaster.id')
            ->where('user_profiles.id', Auth::user()->id)
            ->get();
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('id','desc')->take(15)->get();
        return view('account',compact('user','orders'));
    }

    public function accinfo()
    {
        $countries = Country::get(["Name", "id"]);
        $user = UserProfile::find(Auth::user()->id);
        return view('accountedit',compact('user','countries'));
    }

    public function userchangepass()
    {
        $user = UserProfile::find(Auth::user()->id);
        return view('userchangepass',compact('user'));
    }

    public function userorders()
    {
        $user = UserProfile::find(Auth::user()->id);
        // $child = UserProfile::where('user_id', Auth::user()->id);
        $orders = DB::table('ordered_products as op')
            ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
            ->leftjoin('orders as o', 'op.orderid', 'o.id')
            ->leftjoin('products',  'products.id','op.productid')
            ->where('op.customer_id_new', Auth::user()->id)
            ->orderBy('op.id', 'desc')
            ->get();
     
        // $orders = OrderedProducts::where('customer_id_new', Auth::user()->id)->orderBy('id','desc')->get();
        // $childorders = OrderedProducts::where('customer_id_new', $child->id)->orderBy('id','desc')->get();
        
        // if(count($child)>0){
        //     $childorders = DB::table('ordered_products as op')
        //             ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
        //             ->leftjoin('orders as o', 'op.orderid', 'o.id')
        //             ->leftjoin('products',  'products.id','op.productid')
        //             ->where('op.customer_id_new', $child->id)
        //             ->orderBy('op.id', 'desc')
        //             ->get();
        // }
        
        if(isset($user->user_id)){
            return view('subuserorders',compact('user','orders'));
        }
        else{
            return view('userorders',compact('user','orders'));
        }
    }

    public function userorderdetails($id)
    {
        // DB::enableQueryLog();
        $user = UserProfile::find(Auth::user()->id);
        // $order = Order::findOrFail($id);
        $orders = DB::table('ordered_products as op')
                    ->select('op.*', 'ap.status as API_stataus', 'ap.status_code', 'ap.pickup_scheduled_date', 'ap.rtn_shipment_id', 'oo.cost as unite_price', 'oo.pay_amount', 'oo.order_number', 'po.color as p_color', 'po.lenscolor', 'po.producttat', 'ca.tax', 'oo.order_note')
                    ->leftjoin('api_temp_resp as ap', 'op.orderid', '=', 'ap.order_id')
                    ->leftjoin('orders as oo', 'op.orderid', '=', 'oo.id')
                    ->leftjoin('products as po', 'op.productid', '=', 'po.id')
                    ->leftjoin('categories as ca', 'op.categoryID', '=', 'ca.id')
                    ->where('op.id', $id)
                    ->get()->toArray();
        if(isset($orders)){
            $order = $orders[0];
        }
        
        $pid = $order->productid;
        
        if(isset($orders)){
            foreach($orders as $order){
                $allorder = DB::table('ordered_products')->where('orderid', $order->orderid)->get();
            }
        }
        
        $extraorder = array();
        if(count($allorder)>0){
            for($i=0; $i<count($allorder); $i++){
                if($order->id != $allorder[$i]->id){
                    $otherorder[$i] = DB::table('ordered_products as o')
                                            ->select('o.*', 'po.producttat')
                                            ->leftjoin('products as po', 'o.productid', '=', 'po.id')
                                            ->where('o.id', $allorder[$i]->id)
                                            ->get();
                    array_push($extraorder, $otherorder[$i]);
                }
            }
        }
                    
        // $tax = Settings::select('tax')->where('id','$id')->first();
        return view('orderdetails',compact('user','order','allorder', 'extraorder', 'pid'));
    }
    
    public function prescriptionDetailsOrder(Request $request, $id){
        $pre = DB::table('prescription as pres')
            ->leftjoin('products as p', 'p.id', 'pres.product_id')
            ->where('pres.ordered_id', '=', $id)
            ->select('pres.*', 'p.visioneffect', 'p.lenstype')->get();
        
        $cart = $pre[0];
        $data = '';
        $data2 = '';
        $data3 = '';
        if(isset($cart)){
            if($cart->category == 58){
                $data .= '<a data-toggle="modal" data-target="#viewparameter_'.$cart->id.'" >Parameter &nbsp; <i class="fa fa-eye"></i></a><br><br>';
            }
            $data .= '<table class="table table-bordered" style="width:100%"><thead>';
                            if($cart->category == 72){
                                if($cart->presc_image == null){
                                    if($cart->visioneffect == 'MultiFocal'){
            $data .=                    '<tr>
                                        <th style="width:2%"scope="col"></th>
                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                        <th style="width:2%"scope="col"><center>BC</center></th>
                                        <th style="width:2%"scope="col"><center>DIA</center></th>
                                        <th style="width:2%"scope="col"><center>Add Power</center></th>
                                        </tr>';
                                    }elseif($cart->visioneffect == 'toric and Astigmatism' ){
            $data .=                    '<tr>
                                        <th style="width:2%"scope="col"></th>
                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                        <th style="width:2%"scope="col"><center>BC</center></th>
                                        <th style="width:2%"scope="col"><center>DIA</center></th>
                                        <th style="width:2%"scope="col"><center>CYL</center></th>
                                        <th style="width:2%"scope="col"><center>AXIS</center></th>
                                        </tr>';
                                    }else{
            $data .=                    '<tr>
                                        <th style="width:2%"scope="col"></th>
                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                        <th style="width:2%"scope="col"><center>BC</center></th>
                                        <th style="width:2%"scope="col"><center>DIA</center></th>
                                        </tr>';
                                    }
                                }else{
            $data .=                '<tr>
                                        <th style="width:2%" scope="col"><center>IMAGE</center></th>
                                    </tr>';
                                }
                            }elseif($cart->category == 58){
                                if($cart->visioneffect == 'Progressive' || $cart->visioneffect == 'Biofocal'){
            $data .=                '<tr>
                                    <th style="width:2%"scope="col"></th>
                                    <th style="width:2%" scope="col"><center>SPH</center></th>
                                    <th style="width:2%"scope="col"><center>CYL</center></th>
                                    <th style="width:2%"scope="col"><center>AXIS</center></th>
                                    <th style="width:2%"scope="col"><center>Add Power</center></th>
                                    </tr>';
                                }else{
            $data .=                '<tr>
                                        <th style="width:2%"scope="col"></th>
                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                        <th style="width:2%"scope="col"><center>CYL</center></th>
                                        <th style="width:2%"scope="col"><center>AXIS</center></th>
                                    </tr>';
                                }
                            }else{
                                //
                            }
            $data .=    '</thead>
                        <tbody>';
                            if($cart->category == 72){
                                if($cart->presc_image == null){
                                    if($cart->same_rx_both != null){
                                        if($cart->visioneffect == 'MultiFocal'){
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Both(OD & OS)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                                <td><center>' . $cart->rpower . '</center></td>
                                            </tr>';
                                        }elseif($cart->visioneffect == 'toric and Astigmatism'){
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Both(OD & OS)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                                <td><center>' . $cart->rcyl . '</center></td>
                                                <td><center>' . $cart->Raxis . '</center></td>
                                            </tr>';
                                        }else
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Both(OD & OS)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                            </tr>';
                                        }
                                    else{
                                        if($cart->visioneffect == 'MultiFocal'){
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Right(OD)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                                <td><center>' . $cart->rpower . '</center></td>
                                            </tr>
                                        
                                            <tr>
                                                <th scope="row">Left(OS)</th>
                                                <td><center>' . $cart->Lsphere . '</center></td>
                                                <td><center>' . $cart->LBc . '</center></td>
                                                <td><center>' . $cart->LDia . '</center></td>
                                                <td><center>' . $cart->Lpower . '</center></td>
                                            </tr>';
                                        }elseif($cart->visioneffect == 'toric and Astigmatism'){
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Right(OD)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                                <td><center>' . $cart->rcyl . '</center></td>
                                                <td><center>' . $cart->Raxis . '</center></td>
                                            </tr>
                                        
                                            <tr>
                                                <th scope="row">Left(OS)</th>
                                                <td><center>' . $cart->Lsphere . '</center></td>
                                                <td><center>' . $cart->LBc . '</center></td>
                                                <td><center>' . $cart->LDia . '</center></td>
                                                <td><center>' . $cart->Lcyle . '</center></td>
                                                <td><center>' . $cart->Laxis . '</center></td>
                                            </tr>';
                                        }else{
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Right(OD)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                            </tr>
                                        
                                            <tr>
                                                <th scope="row">Left(OS)</th>
                                                <td><center>' . $cart->Lsphere . '</center></td>
                                                <td><center>' . $cart->LBc . '</center></td>
                                                <td><center>' . $cart->LDia . '</center></td>
                                            </tr>';
                                        }
                                    }
                                }else{
            $data .=                '<tr>
                                        <td><center><a href="' . url('assets/prescription') . '/' . $cart->presc_image . '" target="_blank"><img style="height: 250px" src="' . url('assets/prescription') . '/' . $cart->presc_image . '" alt=""></a></center></td>
                                    </tr>';
                                }
                            }elseif($cart->category == 58){
                                if($cart->visioneffect == 'Progressive' || $cart->visioneffect == 'Biofocal'){
            $data .=                '<tr>
                                        <th style="width:2%" scope="row">RE</th>
                                        <td><center>' . $cart->rsphere . '</center></td>
                                        <td><center>' . $cart->rcyl . '</center></td>
                                        <td><center>' . $cart->Raxis . '</center></td>
                                        <td><center>' . $cart->rpower . '</center></td>
                                    </tr>
                                    <tr>
                                        <th style="width:2%" scope="row">LE</th>
                                        <td><center>' . $cart->Lsphere . '</center></td>
                                        <td><center>' . $cart->Lcyle . '</center></td>
                                        <td><center>' . $cart->Laxis . '</center></td>
                                        <td><center>' . $cart->Lpower . '</center></td>
                                    </tr>';
                                }else{
            $data .=                '<tr>
                                        <th style="width:2%" scope="row">LE</th>
                                        <td><center>' . $cart->Lsphere . '</center></td>
                                        <td><center>' . $cart->Lcyle . '</center></td>
                                        <td><center>' . $cart->Laxis . '</center></td>
                                    </tr>
                                    <tr>
                                        <th style="width:2%" scope="row">RE</th>
                                        <td><center>' . $cart->rsphere . '</center></td>
                                        <td><center>' . $cart->rcyl . '</center></td>
                                        <td><center>' . $cart->Raxis . '</center></td>
                                    </tr>';
                                    
                                }
                            }else{
                                //
                            }
            $data .=    '</tbody></table>';
            
            if($cart->category == 58){
                $data2 =    '
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="width:6%" scope="col"><center>Right PD</center></th>
                                    <th style="width:6%"scope="col"><center>Left PD</center></th>
                                    <th style="width:6%"scope="col"><center>Total PD</center></th>
                                </tr>
                                <tr>
                                    <td><center>' . $cart->Repd . '</center></td>
                                    <td><center>' . $cart->Lepd . '</center></td>
                                    <td><center>' . $cart->totalPd . '</center></td>
                                </tr>
                            </table>';
            }
            
            if($cart->category == 72){
                $data2 =    '<h5>Context Conversion</h5>                                                         
                <p style="font-weight:500">Right Eye(sph/syl) :-  <span style="font-weight: bold;">' . $cart->minus_right_eye . '</span></p>
                <p style="font-weight:500">Left Eye(sph/syl) :- <span style="font-weight: bold;">' . $cart->minus_left_eye . '</span></p>';                                                          
            }
            
            
            if($cart->category == 58){           
                $data3 .= '
                    <div class="modal fade" id="viewparameter_'.$cart->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Prescription Parameter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="text-align:center;">
                                    <table class"table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>A Size</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>B Size</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>DBL</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>R-DIA</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>L-DIA</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td  style="border: 1px solid lightgrey"><center>' . ( $cart->a_size != "" ? $cart->a_size : "--" ) .'</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ( $cart->b_size != "" ? $cart->b_size : "--" ) . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ( $cart->dbl != "" ? $cart->dbl : "--" ) . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ( $cart->r_dia != "" ? $cart->r_dia : "--" ) . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ( $cart->l_dia != "" ? $cart->l_dia : "--" ) . '</center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <table class"table table-bordered" style="width:100%">
                                        <thead>
                                            <tr">
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>RF HEIGHT</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>LF HEIGHT</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>BVD</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>R-ED</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>L-ED</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->r_fitting != "" ? $cart->r_fitting : "--") .'</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->l_fitting != "" ? $cart->l_fitting : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->bvd != "" ? $cart->bvd : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->r_ed != "" ? $cart->r_ed : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->l_ed != "" ? $cart->l_ed : "--") . '</center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <table class"table table-bordered" style="width:100%">
                                        <thead>
                                            <tr">
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>CORRIDOR</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>SHAPE CODE</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>PANTASCOPIC TINT</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>TEMPLE SIZE</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>NEARWORK DISTANCE</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td  style="border: 1px solid lightgrey "><center>' . ($cart->materials != "" ? $cart->materials : "--") .'</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->shape_code != "" ? $cart->shape_code : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->pantascopic != "" ? $cart->pantascopic : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->temple_size != "" ? $cart->temple_size : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->network_distance != "" ? $cart->network_distance : "--") . '</center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <table class"table table-bordered" style="width:100%">
                                        <thead>
                                            <tr">
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>FRAME FIT</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>BOW ANGLE</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>FRAME TYPE - FULL/HALF/RIMLESS</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center>BASE CURVE</center></th>
                                                <th style="width:2%; border: 1px solid lightgrey" scope="col"><center></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->frame_fit != "" ? $cart->frame_fit : "--") .'</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->bow_angle != "" ? $cart->bow_angle : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->frame_type != "" ? $cart->frame_type : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->base_curv != "" ? $cart->base_curv : "--") . '</center></td>
                                                <td  style="border: 1px solid lightgrey"><center></center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                              </div>
                              <div class="modal-footer text-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        
        $result = [
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3
            ];
        return $result;
    }

    public function trackorder($id){
        $user = UserProfile::find(Auth::user()->id);
        // $order = Order::findOrFail($id);
        $order = OrderedProducts::findOrFail($id);
        // $tax = Settings::select('tax')->where('id','$id')->first();
        return view('orderdetails',compact('user','order'));
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


    //Submit Review
    public function checkout(Request $request)
    {
        $countries = DB::table('b2b_countrymaster')->where('Active', 1)->get();
        $buyerdetail = array();
        if(Auth::guard('profile')->check())
        {
            $buyerdetail = UserProfile::where('email', Auth::guard('profile')->user()->email)->get();
        }
        
	    $pickups = PickUpLocations::all();
        $product = 0;
        $quantity = 0;
        $sizes = 0;
        $taxAmount = 0;
        $gstAmount = 0;
        $settings = Settings::findOrFail(1);
        
        $carts = Cart::where('uniqueid',Session::get('uniqueid'));
        $cartdata = $carts->get();
        
        $cartdata1 = $carts->get()->toArray();
        
        
        $cate_ids = array();
        for($i=0; $i<count($cartdata); $i++){
            $tax = DB::table('categories')->select('tax')->where('id', $cartdata[$i]['category'])->get()->toArray();
           
            if($tax[0]->tax > 0){
                $cartdata[$i]['tax_rate'] = $tax[0]->tax;
            }else if($tax[0]->tax == 0 && $cartdata1[$i]['precat'] == 'Frames'){
                 $cartdata[$i]['tax_rate'] = 12;
            }else if($tax[0]->tax == 0 && $cartdata1[$i]['precat'] == 'Sunglasses'){
                 $cartdata[$i]['tax_rate'] = 18;
            }
            
        }
        
        
        if($carts->count() > 0){
            $discountAmount = ($settings->fixed_commission/100)*$carts->sum('cost');
         
            // $total = $carts->sum('cost') + $settings->shipping_cost - $discountAmount + $taxAmount ;
            foreach ($cartdata as $cart){
                $taxAmount += ($cart['tax_rate']/100)*$cart->cost;
                if ($product==0 && $quantity==0){
                    $product = $cart->product;
                    $quantity = $cart->quantity;
                    $sizes = $cart->size;
                    $color = $cart->cartcolor;
                    $maincolor = $cart->maincolor;
                    $category = $cart->category;
                    $mainprice = $cart->main_price;
                    $productImage = $cart->productImage;
                    $premiumtype = $cart->precat;
                    $attrid = $cart->productAttrId;
                    $colorcode = $cart->colorcode;
                    $gstAmount = ($cart['tax_rate']/100)*$cart->cost;
                }else{
                    $product = $product.",".$cart->product;
                    $quantity = $quantity.",".$cart->quantity;
                    $sizes = $sizes.",".$cart->size;
                    $productImage = $productImage.",".$cart->productImage;
                    $mainprice = $mainprice.",".$cart->main_price;
                    $color = $color.",".$cart->cartcolor;
                    $maincolor = $maincolor.",".$cart->maincolor;
                    $premiumtype = $premiumtype.",".$cart->precat;
                    $category = $category.",".$cart->category;
                    $attrid = $attrid.",".$cart->productAttrId;
                    $colorcode = $colorcode.",".$cart->colorcode;
                    $gstAmount = $gstAmount.",".($cart['tax_rate']/100)*$cart->cost;
                }
            }
            $total = $carts->sum('cost') +  $taxAmount + $settings->shipping_cost - $discountAmount;
            return view('checkout',compact('product', 'productImage','sizes','quantity','total','cartdata','pickups', 'color', 'category', 'mainprice', 'maincolor', 'productImage', 'premiumtype', 'attrid', 'countries', 'buyerdetail', 'gstAmount', 'colorcode'));
        }

        return redirect()->route('user.cart')->with('message','You don\'t have any product to checkout.');
    }
    
    public function getState(Request $request)
    {
        $states = DB::table('b2b_statemaster')->where('CountryId', $request->id)->where('Active', 1)->get();
        return $states;
    }
    
    public function getCity(Request $request)
    {
        $states = DB::table('b2b_citymaster')->where('StateId', $request->id)->where('Active', 1)->get();
        return $states;
    }
    
    public function getCoupon(Request $request)
    {
        $coupon = Coupan::whereIn('coupan_code', $request->items)->get();
        return $coupon;
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


   public function deleteuser()
    {
        $customer = UserProfile::findOrFail(Auth::user()->id);
        Auth::logout();
        $customer->delete();
        return redirect('/home')->with('message','Customer Delete Successfully.');
    }

    public function deleteuserpage()
    {
        return view('deletepage');
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
        // print_r($_POST);die();
        // Nik New Functionality 
        $base_path = explode("/", base_path());
        $base_path[count($base_path)-1] = 'assets';
        $base_path = implode("/", $base_path);
        $users = DB::table('user_profiles')
                ->selectRaw('id_proof,shop_act_lic,udyam_cert,aadhar_card')
                ->where('id',$id)
                ->get();
        $user1 = UserProfile::find($id);
        
        $updateData = [
            'name'              => $_POST['name'],
            'mname'             => $_POST['mname'],
            'lname'             => $_POST['lname'],
            'bussiness_name'    => $_POST['bussiness_name'],
            'gender'            => isset($_POST['gender']) ? $_POST['gender'] : '',
            'email'             => isset($_POST['email']) ? $_POST['email'] : '',
            'phone'             => isset($_POST['phone']) ? $_POST['phone'] : '',
            'fax'               => isset($_POST['fax']) ? $_POST['fax'] : '',
            'address'           => isset($_POST['address']) ? $_POST['address'] : '',
            'address2'          => isset($_POST['address2']) ? $_POST['address2'] : '',
            'state'             => isset($_POST['state']) ? $_POST['state'] : '',
            'country'           => isset($_POST['country']) ? $_POST['country'] : '',
            'gst_no'            => isset($_POST['gst_no']) ? $_POST['gst_no'] : '',
            'alternate_phone'   => isset($_POST['alternate_phone']) ? $_POST['alternate_phone'] : '',
            'city'              => isset($_POST['city']) ? $_POST['city'] : '',
            'zip'               => isset($_POST['zip']) ? $_POST['zip'] : '',
            'status'            =>'0',
        ];
        
        if(!empty($_FILES['photo']['name']) || !empty($_FILES['shop_lice']['name']) || !empty($_FILES['udyam_cert']['name']) || !empty($_FILES['aadhar_card']['name'])){
            $target_path = $base_path."/images/customer_document/";
            if(!empty($_FILES['photo']['name'])){
                if(!empty($users[0]->id_proof))
                {
                    unlink($base_path.'/images/customer_document/id_proof/'.$users[0]->id_proof);
                }
               
                if($request->file('photo'))
                {
                    $file= $request->file('photo');
                    $filename= $file->getClientOriginalName();
                    $_FILES['photo']['name'] = $filename;
                    $file-> move($target_path."id_proof", $filename);
                }
                $updateData['id_proof'] = $_FILES['photo']['name'];
            }

            if(!empty($_FILES['shop_lice']['name'])){
                if(!empty($users[0]->shop_act_lic)){
                    unlink($base_path.'/images/customer_document/shop_act_licence/'.$users[0]->shop_act_lic);

                }
                if($request->file('shop_lice')){
                    $file= $request->file('shop_lice');
                    $filename= $file->getClientOriginalName();
                    $_FILES['shop_lice']['name'] = $filename;
                    $file-> move($target_path."shop_act_licence", $filename);
                }
                $updateData['shop_act_lic'] = $_FILES['shop_lice']['name'];
            }

            if(!empty($_FILES['udyam_cert']['name'])){
                if(!empty($users[0]->udyam_cert))
                {
                    unlink($base_path.'/images/customer_document/udyam_certificate/'.$users[0]->udyam_cert);
                }
               
                if($request->file('udyam_cert'))
                {
                    $file= $request->file('udyam_cert');
                    $filename= $file->getClientOriginalName();
                    $_FILES['udyam_cert']['name'] = $filename;
                    $file-> move($target_path."udyam_certificate", $filename);
                }
                $updateData['udyam_cert'] = $_FILES['udyam_cert']['name'];
            }

            if(!empty($_FILES['aadhar_card']['name'])){
                if(!empty($users[0]->aadhar_card))
                {
                    unlink($base_path.'/images/customer_document/aadhar_card/'.$users[0]->aadhar_card);
                }
               
                if($request->file('aadhar_card'))
                {
                    $file= $request->file('aadhar_card');
                    $filename= $file->getClientOriginalName();
                    $_FILES['aadhar_card']['name'] = $filename;
                    $file-> move($target_path."aadhar_card", $filename);
                }
                $updateData['aadhar_card'] = $_FILES['aadhar_card']['name'];
            }
            $user1->update($updateData);

        }else{
            $user1->update($updateData);
        }
            $request->session()->invalidate();
            return redirect('homepage')->with('message','Account Information Updated Successfully.');
       
        //Old Function
        
        // $user = UserProfile::findOrFail($id);
        // $input = $request->all();
        // $user->update($input);
        // return redirect()->back()->with('message','Account Information Updated Successfully.');
    }

    public function passchange(Request $request, $id)
    {
        $user = UserProfile::findOrFail($id);
        $input = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect()->back();
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect()->back();
            }
        }
        $user->update($input);
        return redirect()->back()->with('message','Account Password Updated Successfully.');

    }

    public function returnorder(Request $request, $id){
        // $order = Order::find($id);
        $order = OrderedProducts::find($id);
        $order->status = "return";
        $order->return_status = "accept";
        $order->return_reason = $request->input('reason');
        $order->return_comment = $request->input('comment');
        $order->return_pickupaddress = $request->input('address');
        $order->return_replaceorrefund = $request->input('replaceorrefund');
        $order->returnorder_date = date('Y-m-d');
        $order->update();
        return redirect()->back()->with('message','Your Order Has Been Return');
    }

    public function cancelreturnorder($id){
        $order = OrderedProducts::find($id);
        
        $order->return_reason = null;
        $order->return_comment = null;
        $order->return_pickupaddress = null;
        $order->return_replaceorrefund = null;
        $order->returnorder_date = null;
        
        $order->returnorder_date = date('Y-m-d');
        $order->status = "completed";
        $order->return_status = "pending";
        $order->update();
        return redirect()->back()->with('message','Order return request has been cancelled!');

    }

      public function ordercancel(Request $request, $id){
        // $order = Order::find($id);
        $order = OrderedProducts::find($id);

        if($order->productAttrId != ""){
            $attrdata = ProductAttr::findOrFail($order->productAttrId);
            $update['attr_qty'] = $attrdata->attr_qty + $order->quantity;
            $attrdata->update($update);
        }
        else{
            $data = Product::findOrFail($order->productid);
            $update['stock'] = $data->stock + $order->quantity;
            $data->update($update);
        }
        
        $order->canceled_date = new DateTime();
        $order->canceled_reason = $request->input('cancelreason');
        $order->comment_cancel = $request->input('cancelcomment');
        $order->status = "declined";
        $order->entry_by = Auth::user()->name;
       
        // $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->update();
        // session()->flash('order_message','Order has been Canceled!');
        return redirect()->back()->with('message','Order has been cancelled!');
    }


    public function download_invoice($id)
    {
        
         $order = DB::table('ordered_products as op')
         ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
         ->leftjoin('admin', 'admin.username', '=', 'op.owner')
         ->select('op.*', 'o.shipping', 'o.pickup_location', 'o.txnid', 'o.charge_id', 'o.booking_date', 'o.order_number', 'o.customer_zip', 'o.customer_country', 'o.customer_alt_phone', 'o.shipping_address',
         'o.shipping_name', 'o.shipping_email', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_city', 'o.shipping_zip', 'o.shipping_country', 'o.shipping_state', 'o.shipping_alternate_phone', 'o.pay_amount',
         'admin.name as A_Name', 'admin.email as A_Email', 'admin.phone as A_Phone')
         ->where('op.id', $id)
         ->orderBy('id','desc')
         ->get()->toArray();
        
        // $orders = json_decode( json_encode($order[0]), true);
         $orders = $order[0];
         
        $tax = $orders->cost/100*18;
        $subtotal = $orders->cost*$orders->quantity+$tax;
         
         $array = [
            'main' => "B2B Reachoptic Pvt. Ltd.",
            'url' => "http://b2b.reachoptic.com/",
            'address1' => "1st Floor 102/103 Vinayak Chember",
            'address2' => "Opp Tambe Hospital Gokhale Road, Naupada",
            'city' => "Thane",
            'state' => "Maharashtra",
            'country' => "India",
            'zip' => "400605",
            'phone' => "8091213809",
            'email' => "it.elricaglobal@gmail.com",
        ];

        $data = ['title' => 'Invoice'];
        // $dompdf->set_option('enable_html5_parser', TRUE);
        $pdf = PDF::loadView('user_invoice', compact('orders', 'array', 'tax', 'subtotal'), $data);
        return $pdf->download('Invoice.pdf');
        
        // $order = OrderedProducts::findOrFail($id);
        // $data = ['title' => 'Invoice'];
        // $pdf = PDF::loadView('user_invoice', compact('order'),$data);
        // return $pdf->stream('Invoice.pdf');
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
    
    public function childuser(){
        $childuser = UserProfile::where('user_id', Auth::user()->id)->get();
        return view('childusers', compact('childuser'));
    }
    
    public function childdelete($id)
    {
        $user = UserProfile::findOrFail($id);
        try
        {
            unlink('assets/images/customer_document/aadhar_card/'.$user->aadhar_card);
            unlink('assets/images/customer_document/udyam_certificate/'.$user->udyam_cert);
            unlink('assets/images/customer_document/shop_act_licence/'.$user->shop_act_lic);
            unlink('assets/images/customer_document/id_proof/'.$user->id_proof);
        }
        catch(\Exception $e)
        {
            //
        }
        $user->delete();
        return redirect()->back()->with('message','Child User Data Delete Successfully..');
    }
    
    public function childCostPrice(Request $request)
    {
        $id = $request->id;
        $user = UserProfile::findOrFail($id);
        $user->update(['costpriceshow'=>$request->costview]);
        
        $msg = "Cost View Permission Update Successfully ..!!";
        
        Session::flash('message', $msg);
        return response()->json(['status'=>'success', 'msg'=>$msg]);
    }


    public function get_active_userorder_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_active_userordeer_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_active_userordeer_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($order_details_total as $row => $vals) {

            // echo "<pre>";
            // print_r($vals);
            // $start++;
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            // $nestedData[] = $start;
            
            if($vals->categoryID == 87)
            {
                $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
            }
            else
            {
                if($vals->color != $vals->maincolor){
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/product_attr') . '/' . $vals->product_image . '" /></td>';
                }
                else{
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
                }
            }
            $actionButton = "<a href='javascript:void(0)' onclick='viewOrder(" . $vals->id . ")'>View Order</a>";
            
            $nestedData[] = $vals->orderid;
            $nestedData[] = $image;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->color;
            $nestedData[] = $vals->size;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
    
    public function get_active_userordeer_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.color', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.size', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                })
                ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
                ->leftjoin('orders as o', 'op.orderid', 'o.id')
                ->leftjoin('products',  'products.id','op.productid')
                ->where('op.customer_id_new', Auth::user()->id)
                ->orderBy('op.id','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                        ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
                        ->leftjoin('orders as o', 'op.orderid', 'o.id')
                        ->leftjoin('products',  'products.id','op.productid')
                        ->where('op.customer_id_new', Auth::user()->id)
                        ->orderBy('op.id','desc');
                        
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }

    public function get_active_subuserorder_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_active_subuserordeer_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_active_subuserordeer_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($order_details_total as $row => $vals) {

            // echo "<pre>";
            // print_r($vals);
            // $start++;
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            // $nestedData[] = $start;
            
            if($vals->categoryID == 87)
            {
                $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
            }
            else
            {
                if($vals->color != $vals->maincolor){
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/product_attr') . '/' . $vals->product_image . '" /></td>';
                }
                else{
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
                }
            }
            $actionButton = "<a href='javascript:void(0)' onclick='viewOrder(" . $vals->id . ")'>View Order</a>";
            
            $nestedData[] = $vals->orderid;
            $nestedData[] = $image;
            $nestedData[] = $vals->buyer_name;
            $nestedData[] = $vals->buyer_address;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->color;
            $nestedData[] = $vals->size;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
    
    public function get_active_subuserordeer_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        $child = UserProfile::where('user_id', Auth::user()->id)->select('id')->get()->toArray();
        
        $data = DB::table('ordered_products as op')
                    ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
                    ->leftjoin('orders as o', 'op.orderid', 'o.id')
                    ->leftjoin('products',  'products.id','op.productid')
                    ->whereIn('customer_id_new', $child)
                    ->orderBy('op.id','desc');
                    
        if(isset($search_term) && $search_term !="") {
            $data->where(function($query) use ($search_term, $other_configs){
                $query->where('op.product_title', 'like', '%' . $search_term . '%');
                $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                $query->orwhere('op.color', 'like', '%' . $search_term . '%');
                $query->orwhere('op.size', 'like', '%' . $search_term . '%');
                $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
            });
        }      
        
        if(!$count && $other_configs['length']){
            $data->limit($other_configs['length']);
            $data->offset($other_configs['offset']);
        }
        
        $result = $data->get();

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }
    
    
    public function get_active_childuserorder_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $order_details_total = $this->get_active_childuserorder_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_active_childuserorder_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($order_details_total as $row => $vals) {

            // echo "<pre>";
            // print_r($vals);
            // $start++;
            $nestedData = array();
            $actionButton = '';
            $eyeButton = '';
            $checkButton = '';
            // $nestedData[] = $start;
            
            if($vals->categoryID == 87)
            {
                $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
            }
            else
            {
                if($vals->color != $vals->maincolor){
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/product_attr') . '/' . $vals->product_image . '" /></td>';
                }
                else{
                    $image = '<td><img width="80px" height="80px" src="' . url('/assets/images/products') . '/' . $vals->product_image . '" /></td>';
                }
            }
            $actionButton = "<a href='javascript:void(0)' onclick='viewOrder(" . $vals->id . ")'>View Order</a>";
            
            $nestedData[] = $vals->orderid;
            $nestedData[] = $image;
            $nestedData[] = Str::limit($vals->product_title, 20, ' ...');
            $nestedData[] = $vals->product_sku;
            $nestedData[] = $vals->color;
            $nestedData[] = $vals->size;
            $nestedData[] = $vals->created_at;
            $nestedData[] = $vals->quantity;
            $nestedData[] = $vals->cost;
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
    
    public function get_active_childuserorder_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        if(isset($search_term) && $search_term !="") {
            $data = DB::table('ordered_products as op')
                ->where(function($query) use ($search_term, $other_configs){
                    $query->where('op.product_title', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.color', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.size', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.created_at', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
                    $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
                })
                ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
                ->leftjoin('orders as o', 'op.orderid', 'o.id')
                ->leftjoin('products',  'products.id','op.productid')
                ->where('op.customer_id_new', Auth::user()->id)
                ->orderBy('op.id','desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('ordered_products as op')
                        ->select('op.*', 'o.cost as unite_price', 'o.pay_amount', 'o.order_number','products.costprice as cost_price')
                        ->leftjoin('orders as o', 'op.orderid', 'o.id')
                        ->leftjoin('products',  'products.id','op.productid')
                        ->where('op.customer_id_new', Auth::user()->id)
                        ->orderBy('op.id','desc');
                        
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }
    
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("CountryId", $request->country_id)
                                ->get(["Name", "id"]);
        return response()->json($data);
    }
    
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("StateId", $request->state_id)
                                    ->get(["Name", "id"]);                
        return response()->json($data);
    }
    

    public function buyer_invoice(Request $request)
    {
        $order_id = isset($request->all()['orderid']) ? $request->all()['orderid'] : '';
        if(!$order_id){
            return response()->json(['status'=> false, 'msg'=>'Buyer Order id not Found']);
        }

        $user = UserProfile::find(Auth::user()->id);

        $orders = DB::table('ordered_products as op')
                ->where('op.orderid', $order_id)
                ->where('op.status', 'completed')
                ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
                ->leftjoin('categories', 'categories.id', '=', 'op.categoryID')
                ->leftjoin('categories as k','k.name', '=', 'op.premiumtype')
                ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
                ->leftjoin('user_profiles','o.customer_phone', '=', 'user_profiles.phone')
                ->leftjoin('b2b_citymaster','op.buyer_city','=','b2b_citymaster.id')
                ->leftjoin('b2b_statemaster','op.buyer_state','=','b2b_statemaster.id')
                ->leftjoin('b2b_citymaster as sbc','o.shipping_city','=','sbc.Id')
                ->leftjoin('b2b_statemaster as sbs','o.shipping_state','=','sbs.id')
                ->select('user_profiles.*','op.*','o.customer_name as buyer_name','b2b_statemaster.Name as buyer_state',
                    'b2b_citymaster.Name as buyer_city','o.customer_Address as address','o.customer_zip as pincode','k.tax as tax1',
                    'o.customer_email as cus_email','pro.modelno as modelno','pro.hsncode as hsn_code','pro.costprice as cost_price',
                    'o.pay_amount as pay_amount', 'o.shipping_name', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_address2', 'o.shipping_city', 
                    'o.shipping_state', 'o.shipping_country', 'o.shipping_zip', 'categories.tax as tax', 'sbc.Name as Ship_city', 'sbs.Name as Ship_state')
                ->orderBy('op.orderid','desc')
                ->get();

            return response()->json(['status'=> true, 'msg'=>'Order fetch', 'order_details'=>$orders]);
    }
}
