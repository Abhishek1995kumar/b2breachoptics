<?php

namespace App\Http\Controllers;

use App\Blog;
use App\OurOfferings;   
use App\Brand;
use App\Cart;
use App\ProductGallery;
use App\LenseCart;
use App\Category;
use App\Counter;
use App\FAQ;
use App\Gallery;
use App\Order;
use App\OrderedProducts;
use App\PageSettings;
use App\Product;
use App\ProductAttr;
use App\Review;
use App\SectionTitles;
use App\Service;
use App\ServiceSection;
use App\Settings;
use App\SiteLanguage;
use App\Subscribers;
use App\Testimonial;
use App\UserProfile;
use App\Vendors;
use App\policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PDF;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use View;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class FrontEndController extends Controller
{

    public function __construct()
    {
        Cache::flush();
        // $this->middleware('web');
        // $this->middleware('auth:profile');
        // $referral_url = "";
        if(isset($_SERVER['HTTP_REFERER'])){
            $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if ($referral != $_SERVER['SERVER_NAME']){

                $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
                if($brwsr->count() > 0){
                    $brwsr = $brwsr->first();
                    $tbrwsr['total_count']= $brwsr->total_count + 1;
                    $brwsr->update($tbrwsr);
                }else{
                    $newbrws = new Counter();
                    $newbrws['referral']= $this->getOS();
                    $newbrws['type']= "browser";
                    $newbrws['total_count']= 1;
                    $newbrws->save();
                }

                $count = Counter::where('referral',$referral);
                if($count->count() > 0){
                    $counts = $count->first();
                    $tcount['total_count']= $counts->total_count + 1;
                    $counts->update($tcount);
                }else{
                    $newcount = new Counter();
                    $newcount['referral']= $referral;
                    $newcount['total_count']= 1;
                    $newcount->save();
                }
            }
        }else{
            $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
            if($brwsr->count() > 0){
                $brwsr = $brwsr->first();
                $tbrwsr['total_count']= $brwsr->total_count + 1;
                $brwsr->update($tbrwsr);
            }else{
                $newbrws = new Counter();
                $newbrws['referral']= $this->getOS();
                $newbrws['type']= "browser";
                $newbrws['total_count']= 1;
                $newbrws->save();
            }
        }
    }



    function getOS() {

        $user_agent     =   !empty($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }

        }
        return $os_platform;
    }


    public function homepage()
    {
        
    $ourofferings = OurOfferings::all();
    // dd($ourofferings);

     return view('newlanding',compact('ourofferings'));
    }

    public function videoplay()
    {
     return view('videoplay');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = SectionTitles::findOrFail(1);
        $services = ServiceSection::all();
        $brands = Brand::where('type','brand')->get();
        $banners = Brand::where('type','banner')->get();
        $newsliders = Brand::where('type','newslider')->get();
        $mainslider = Brand::where('type','newmainslider')->get();
        $smallbox = Brand::where('type','smallbox')->get();
        $bottomslider = Brand::where('type','bottomslider')->get();
        $ourofferings = Brand::where('type','OurOfferings')->get();
        $blogs = Blog::orderBy('id','desc')->take(8)->get();
        $features = Product::with('gallery_images')->where('featured','1')->where('status','1')->orderBy('id','desc')->take(8)->get();

        $tranding = Product::with('gallery_images')->where('tranding','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $new = Product::with('gallery_images')->where('latest','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        // $selected = Product::with('gallery_images')->where('selected','1')->where('status','1')->orderBy('id','desc')->take(20)->get();

        $tops = Product::where('status','1')->orderBy('views','desc')->take(8)->get();
        $latests = Product::where('status','1')->orderBy('id','desc')->take(8)->get();
        $fcategory = Category::where('featured','1')->orderBy('id','desc')->first();
        $fcategories = Category::where('featured','1')->orderBy('id','desc')->skip(1)->take(4)->get();
        $testimonials = Testimonial::all();
       
        return view('index', compact('banners','brands','blogs','fcategories','fcategory','features','latests','tops','testimonials','languages','newsliders','mainslider','smallbox','tranding','new','bottomslider','ourofferings'));
      
    }
    
    // public function homepage()
    // {
    //      return view('newlanding');
    // }

    // public function videoplay()
    // {
    //     return view('videoplay');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendorproduct($id)
    {
        $vendor = Vendors::findOrFail($id);
        $products = Product::where('vendorid',$id)->where('status','1')->take(12)->get();
        return view('vendorproduct', compact('products','vendor'));
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

    //Blog Details
    public function blogdetails($id)
    {
        $blog = Blog::findOrFail($id);
        $input['views'] = $blog->views + 1;
        $blog->update($input);
        $recents = Blog::orderBy('id','desc')->take(5)->get();
        return view('blogdetails',compact('blog','recents'));
    }

    //All Blogs
    public function allblog()
    {
        $blogs = Blog::all();
        return view('blogs',compact('blogs'));
    }
    
    public function spectacleLense(Request $request){
        if ($request->isMethod('post')){
            
            $lense = new LenseCart;
            
            $lense->fill($request->all());
            
            if($file = $lense['pres_img']) {
                $destination = 'assets/prescription';
                $filename = Str::random(2).time().$request->file('pres_img')->getClientOriginalName();
                
                $file->move($destination, $filename);
                $lense->pres_img = $filename;
            }
            
            $lense->save();
        }
    }
    
     //vishal
    public function fetchConversionRight(Request $request){
        $sphere = $_POST['sphere'];
        if($sphere <= 0){
            $num_in_word = $this->convertNumber($_POST['cylinder']);
            $query = DB::select(DB::raw("select $num_in_word from minus_toric_conversion where spheres = '$sphere'"));
            if($query){
                return response()->json(['ststus'=>"success"   ,'data' => $query[0]->$num_in_word]);
            }
        }
        
    }

    public function cartupdate(Request $request)
    {
        if ($request->isMethod('post')){
            if($request->productAttrId == ''){
                $stockCheck = Product::select('stock')->where('id',$request->product)->where('status',1)->first();
                if($stockCheck->stock < $request->quantity){
                    return response()->json(['response' => 'Sorry, You have reached the stock limit!','product' => $request->product,'error'=>true]);
                }
                if($request->checkQty){
                    return response()->json(['response'=> $stockCheck->stock,'product' => $request->product,'success'=>true]);
                }
            }
            else{
                $stockCheck = ProductAttr::select('attr_qty')->where('id', $request->productAttrId)->first();
                if($stockCheck->attr_qty < $request->quantity){
                    return response()->json(['response' => 'Sorry, You have reached the stock limit!','product' => $request->product,'error'=>true]);
                }
                if($request->checkQty){
                    return response()->json(['response'=> $stockCheck->attr_qty,'product' => $request->productAttrId,'success'=>true]);
                }
            }
            

            if (empty(Session::get('uniqueid'))){
                $cart = new Cart;
                $cart->fill($request->all());
                if($file = $cart['presc_image']) {
                    $destination = 'assets/prescription';
                    $filename = Str::random(2).time().$request->file('presc_image')->getClientOriginalName();
                    $file->move($destination, $filename);
                    $cart->presc_image = $filename; 
                    $total_qty = (int)$request->lefteyequantity + (int)$request->righeyequantity;
                    $cart->quantity = $total_qty;
                }
                
                if($request->category == '72') {
                    if($request->botheyequantity != ''){
                        $total_qty = (int)$request->botheyequantity;
                        $cart->quantity = $total_qty;
                    }
                    else{
                        $total_qty = (int)$request->lefteyequantity + (int)$request->righeyequantity;
                        $cart->quantity = $total_qty;
                    }
                }
                
                Session::put('uniqueid', $request->uniqueid);
                $cart->save();

            }else{
                $cart = Cart::where('uniqueid',$request->uniqueid)
                    ->where('product',$request->product)
                    ->where('cartcolor',$request->cartcolor)
                    ->first();
                $carts = Cart::where('uniqueid',$request->uniqueid)
                        ->where('product',$request->product)
                        ->where('cartcolor',$request->cartcolor)
                        ->count();
                if ($carts > 0 ){
                    $data =  $request->all();
                    $cart->update($data);
                }else{
                    $carts = new Cart;
                    $carts->fill($request->all());
                    
                    if($file = $carts['presc_image']) {
                        $destination = 'assets/prescription';
                        $filename = time().$request->file('presc_image')->getClientOriginalName();
                        $file->move($destination, $filename);
                        $carts->presc_image = $filename;
                        $total_qty = (int)$request->lefteyequantity + (int)$request->righeyequantity;
                        $carts->quantity = $total_qty;
                    }
                    
                    if($request->category == '72') {
                        if($request->botheyequantity != ''){
                            $total_qty = (int)$request->botheyequantity;
                        }
                        else{
                            $total_qty = (int)$request->lefteyequantity + (int)$request->righeyequantity;
                        }
                        $carts->quantity = $total_qty;
                    }
                    
                    $carts->save();
                    
                    $cid = $carts->id;
                    
                    $lensTyp = $carts->lenseType;
                    
                    if($lensTyp != ''){
                        $lens = LenseCart::orderBy('id', 'desc')->first();
                        $lens->update(['cid'=>$cid]);
                    }
                }

            }
            return response()->json(['response' => 'Successfully Added to Cart.', 'status' => '200', 'product' => $request->product]);
        }

        $getcart = Cart::where('uniqueid',Session::get('uniqueid'))->get();

        return response()->json(['response' => $getcart]);
    }

    
    public function cartdelete($id, $color=null)
    {
        if($color == null){
            $cartproduct = Cart::where('uniqueid',Session::get('uniqueid'))
                ->where('product',$id)->first();
            $cartproduct->delete();
        }
        else{
            $cartproduct = Cart::where('uniqueid',Session::get('uniqueid'))
                ->where('product',$id)->where('cartcolor',$color)->first();
            $cartproduct->delete();
        }

        $getcart = Cart::where('uniqueid',Session::get('uniqueid'))->get();
        return response()->json(['response' => $getcart]);
    }

    //Submit Review
    public function reviewsubmit(Request $request)
    {
        if(Auth::guard('profile')->check()){
            $reviewdata = DB::table('reviews')->select('*')->where('email', Auth::guard('profile')->user()->email)->where('productid', $request->id)->get();
        }
        if(count($reviewdata)>0){
            $review = Review::findorFail($reviewdata[0]->id);

            $update['productid'] = $request->id;
            $update['review'] = $request->review;
            $update['rating'] = $request->rating;
            $update['review_date'] = date('Y-m-d H:i:s');
            $review->update($update);
            // return response()->json(['message' => 'Your Review Submitted Successfully.']);
        }
        else{
            $review = new Review;
            $review['productid'] = $request->id;
            $review['name'] = Auth::guard('profile')->user()->name;
            $review['email'] = Auth::guard('profile')->user()->email;
            $review['review'] = $request->review;
            $review['rating'] = $request->rating;
            $review['review_date'] = date('Y-m-d H:i:s');
            $review->save();
            // return response()->json(['message' => 'Your Review Submitted Successfully.']);
        }
        return response()->json(['message' => 'Your Review Submitted Successfully.']);
    }

    //Product Data
    public function productdetails($id,$title)
    {
        $productdata = Product::findOrFail($id);
        $product_baner = DB::table('product_baner')->get();
        $data['views'] = $productdata->views + 1;
        $productdata->update($data);
        $relateds = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$productdata->category[0]])
            ->take(8)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $features = Product::with('gallery_images')->where('featured','1')->where('status','1')->orderBy('id','desc')->take(8)->get();

        $selected = Product::with('gallery_images')->where('selected','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $tranding = Product::with('gallery_images')->where('tranding','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $reviews = Review::where('productid',$id)->orderBy('review_date', 'desc')->get();
        $category = Category::all();
        
        //kishori start code review button//
        if(Auth::guard('profile')->check()){
            $orderprod = DB::table('ordered_products')
                        ->where('customer_id_new', Auth::guard('profile')->user()->id)
                        ->where('productid', $id)
                        ->where("status","completed")
                        ->orderBy('created_at', 'desc')
                        ->get();
            
            $is_reviews_avaible = $orderprod->count();
        }
        
        //kishori end code//
        
        $left_pd = DB::table('pd_table')->get();

        $color_data = DB::table('product_attrs')
                        ->select('attr_color', 'product_id', 'product_sku')
                        ->distinct()
                        ->where('product_id', $id)
                        ->get();

        $allyear = [];
        $allmonth = [];
        $alldays = [];
        if(count($reviews)>0){
            for($i=0; $i<count($reviews); $i++){
                $date = $reviews[$i]->review_date;
                
                $today = Carbon::now();
                $year = date('Y');
                $leap = date('L', mktime(0, 0, 0, 1, 1, $year));

                // if $leap == 1 then leap year, else $year = 0 thean not leap year
                if($leap){
                    $days = $today->diffInDays($date);

                    $ryear = $days/366;
                    $month = $days/7;

                    $remainsday = ($ryear > 0 ? $ryear*366 : 0) + ($month > 0 ? $month * 7 : 0);
                    print_r($remainsday);
                }
                else{
                    $days = $today->diffInDays($date);

                    if($days >= 365){
                        $allyear[$i] = (int)($days/365);
                        $rday1 = fmod($days, 365);
                        $allmonth[$i] = (int)($rday1/7);
                        $alldays[$i] = $days > 0 ? fmod($rday1, 7) : 1;
                    }
                    else{
                        $allyear[$i] = 0;
                        $allmonth[$i] = (int)($days/7);
                        $alldays[$i] = fmod($days, 7);
                    }
                }
            }

            $reviews1 = Review::where('productid',$id)->where('rating', 1)->get()->count('productid');
            $reviews2 = Review::where('productid',$id)->where('rating', 2)->get()->count('productid');
            $reviews3 = Review::where('productid',$id)->where('rating', 3)->get()->count('productid');
            $reviews4 = Review::where('productid',$id)->where('rating', 4)->get()->count('productid');
            $reviews5 = Review::where('productid',$id)->where('rating', 5)->get()->count('productid');

            $sumreviews1 = Review::where('productid',$id)->where('rating', 1)->get()->sum('rating');
            $sumreviews2 = Review::where('productid',$id)->where('rating', 2)->get()->sum('rating');
            $sumreviews3 = Review::where('productid',$id)->where('rating', 3)->get()->sum('rating');
            $sumreviews4 = Review::where('productid',$id)->where('rating', 4)->get()->sum('rating');
            $sumreviews5 = Review::where('productid',$id)->where('rating', 5)->get()->sum('rating');

            $allsum = $sumreviews1 + $sumreviews2 + $sumreviews3 + $sumreviews4 + $sumreviews5;
            $allreview = $reviews1 + $reviews2 + $reviews3 + $reviews4 + $reviews5;

            $averagerate = $allsum/$allreview;

            $prog1 = $reviews1/$allreview;
            $prog2 = $reviews2/$allreview;
            $prog3 = $reviews3/$allreview;
            $prog4 = $reviews4/$allreview;
            $prog5 = $reviews5/$allreview;
        }
        else{
            $reviews1 = $reviews2 = $reviews3 = $reviews4 = $reviews5 = $allsum = 0;
            $allreview = 0;
            $averagerate = 0;
            $prog1 = $prog2 = $prog3 = $prog4 = $prog5 = 0;
        }

        $product_gallery = array();
        $product_attr = array();

        if(count($color_data) > 0) {
            foreach($color_data as $attr) {
                $product_sku = $attr->product_sku;
                $color = $attr->attr_color;
                $gallary = DB::table('product_attr_gallery')->distinct()->where('pid', $product_sku)->where('color', $color)->orderBy('id', 'asc')->get()->first();
                $product_gallery[] = $gallary;
            }
        }
        
        $cartsmain = Cart::where('uniqueid',Session::get('uniqueid'))
                ->where('product',$id)
                ->whereNull('productAttrId')
                ->count();
                
        $pid = $productdata->id;
    
        return view('product', compact('cartsmain', 'pid', 'productdata','product_baner','gallery','reviews','relateds','features','selected','tranding','category', 'user_profiles','product_gallery', 'averagerate', 'reviews1', 'reviews2', 'reviews3', 'reviews4', 'reviews5', 'prog1', 'prog2', 'prog3', 'prog4', 'prog5', 'allyear', 'allmonth', 'alldays', 'left_pd', 'is_reviews_avaible', 'orderprod'));
    }
    
    public function getImageData(Request $request)
    {
        $mid = $request->mainid;
        $cost_price = '';
        $main_pro_size = array();
        if($mid != '') {
            // $cost_price = Product::Cost($mid);
            $main_pro_size = DB::table('product_attrs')
            ->select('attr_size', 'product_id')
            ->distinct()
            ->where('product_id', $mid)
            ->get();
        }
        $id = $request->id;
        $color = $request->color;

        // print_r($request->all()); die();
        
        $mainImg = DB::table('products')->select('feature_image', 'id' , 'color', 'framecolor', 'colorcode', 'price', 'costprice', 'lenscolor', 'category', 'stock', 'productsku', 'previous_price')->where('id', $mid)->get();

        $galleryImg = DB::table('product_gallery')->select('image', 'id')->where('productid', $mid)->get();
        
        $productData = DB::table('product_attrs')->where('product_sku', $id)->where('attr_color', $color)->get();
            
        $attr_gallery = DB::table('product_attr_gallery as pag')
            ->select('pag.*')
            ->where('pid', $id)
            ->where('color', $color)
            ->get();
            
        $size_data = DB::table('product_attrs')
            ->select('attr_size', 'product_id', 'attr_sku', 'attr_price', 'attr_color', 'attr_mrp', 'attr_qty', 'id')
            ->where('attr_color', $color)
            ->where('product_sku', $id)
            ->get();
            
        $cart = Cart::where('uniqueid',Session::get('uniqueid'))
                ->where('product',$mid)
                ->where('cartcolor',$color);
        
        $carts = $cart->count();

        $data = [
                'gallery'=>$attr_gallery,
                'sizes' => $size_data,
                'main_pro_size' => $main_pro_size,
                'gallImg' => $galleryImg,
                'mainImg' => $mainImg,
                'cost_price' => $cost_price,
                'cart' => $carts
            ];
        
        
        return $data;
    }
    
    public function productshoww(Request $request, $id, $color)
    {
        DB::enableQueryLog();
        $productdata = Product::findOrFail($id);
        $data['views'] = $productdata->views + 1;
        $productdata->update($data);
        
        $relateds = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$productdata->category[0]])
            ->take(8)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $productdat = DB::table('products')->select('*')->where('id',$id)->first();
      
        $attr = DB::table('product_attrs')->where('product_id', $id)->where('attr_color', $color)->get();
        
        $features = Product::with('gallery_images')->where('featured','1')->where('status','1')->orderBy('id','desc')->take(8)->get();

        $selected = Product::with('gallery_images')->where('selected','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $tranding = Product::with('gallery_images')->where('tranding','1')->where('status','1')->orderBy('id','desc')->take(50)->get();

        $category = Category::all();
        $reviews = Review::where('productid',$id)->get();
        
        $cate = Category::where('id', $productdata->category)->get();
        
        $main = $color;

        $attrgallery = DB::table('product_attr_gallery')->select('attr_imgs')->where('pid', $productdata->productsku)->where('color', $main)->orderBy('id','asc')->first();

        return view('productshow', compact('productdata','gallery','productdat','reviews','relateds','features','selected','tranding','category', 'cate', 'attrgallery', 'main', 'attr'));
      
    }

    // stock alert for contact lens product ------------------
    public function checkProductQty(Request $request)
    {
        $id = $request->id;
        $paid = $request->paid;
        $color = $request->color;
        $quantity = $request->qty;
        if(!$paid){
            $product = Product::findorFail($id);
            if($product->stock < $quantity)
            {
                return response()->json(['response' => 'Sorry, You have reached the stock limit!','product' => $request->id,'error'=>true]);
            }
            else
            {
                return response()->json(['response'=> $product->stock,'product' => $request->id,'success'=>true]);
            }
        }
        else
        {
            $productattr = ProductAttr::findorFail($paid);
            if($productattr->attr_qty < $quantity)
            {
                return response()->json(['response' => 'Sorry, You have reached the stock limit!.. Available stock :- '. $productattr->attr_qty .'','product' => $request->paid,'error'=>true]);
            }
            else
            {
                return response()->json(['response'=> $productattr->attr_qty,'product' => $request->paid,'success'=>true]);
            }
        }
    }

    //Category Products
    // public function catproduct($slug) {
    //     $user_profiles = '';
    //     if(Auth::guard('profile')->check()){
    //         $user = UserProfile::find(Auth::guard('profile')->user()->id);
    //         $user1=$user->id;
    //         $user_profiles= DB::table('user_profiles')->select('*')->where('id',$user1)->first();
    //     }
       
    //     DB::enableQueryLog();
    //     $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $lensestype = $radd = $rsph = $raxis = $rcyl = $ladd = $lsph = $laxis = $lcyl = $ldia = $rdia = $netquntity = "";
    //     $min = "0";
    //     $max = "500";
    //     $mins = "0";
    //     $maxs = "500";
        
    //     $lensmaterial = DB::table('lens_material')->where('status', 1)->get();
    //     $frame_color = DB::table('frame_color')->where('status', 1)->get();
    //     $frame_material = DB::table('frame_material')->get();
    //     $frame_shape = DB::table('frame_shape')->get();
     
    //     if (!empty(trim(request()->colors))) {
    //         $colors = request()->colors;
    //     }
    //     if (!empty(trim(request()->shapes))) {
    //         $shapes = request()->shapes;
    //     }
    //     if (!empty(trim(request()->makes))) {
    //         $makes = request()->makes;
    //     }
    //     if (!empty(trim(request()->gender))) {
    //         $gender = request()->gender;
    //     }
    //     if (!empty(trim(request()->frametype))) {
    //         $frametype = request()->frametype;
    //     }
    //     if (!empty(trim(request()->framematerial))) {
    //         $framematerial = request()->framematerial;
    //     }
    //     if (!empty(trim(request()->lenscolor))) {
    //         $lenscolor = request()->lenscolor;
    //     }
    //     if (!empty(trim(request()->size))) {
    //         $size = request()->size;
    //     } 
    //     if (!empty(trim(request()->brandname))) {
    //         $brandname = request()->brandname;
    //     }
    //     if (!empty(trim(request()->lenstype))) {
    //         $lenstype = request()->lenstype;
    //     }
    //     if (!empty(trim(request()->disposability))) {
    //         $disposability = request()->disposability;
    //     }
    //     if (!empty(trim(request()->packaging))) {
    //         $packaging = request()->packaging;
    //     }

    //      if (!empty(trim(request()->lensmaterialtype))) {
    //         $lensmaterialtype = request()->lensmaterialtype;
    //     }

    //      if (!empty(trim(request()->lenstechnology))) {
    //         $lenstechnology = request()->lenstechnology;
    //     }

    //      if (!empty(trim(request()->lensindex))) {
    //         $lensindex = request()->lensindex;
    //     }

    //     if (!empty(trim(request()->visioneffect))) {
    //         $visioneffect = request()->visioneffect;
    //     }

    //     if (!empty(trim(request()->netquntity))) {
    //         $netquntity = request()->netquntity;
    //     }

    //     if (!empty(trim(request()->lensestype))) {
    //         $lensestype = request()->lensestype;
    //     }


    //     if (!empty(trim(request()->radd))) {
    //         $radd = request()->radd;
    //     }

    //     if (!empty(trim(request()->rsph))) {
    //         $rsph = (float) request()->rsph;
    //     }

    //     if (!empty(trim(request()->rcyl))) {
    //         $rcyl = (float) request()->rcyl;
    //     }

    //     if (!empty(trim(request()->raxis))) {
    //         $raxis = request()->raxis;
    //     }

    //     if (!empty(trim(request()->ladd))) {
    //         $ladd = request()->ladd;
            
    //     }

    //     if (!empty(trim(request()->lsph))) {
    //         $lsph = (float) request()->lsph;
    //     }

    //     if (!empty(trim(request()->lcyl))) {
    //         $lcyl = (float) request()->lcyl;
    //     }

    //     if (!empty(trim(request()->laxis))) {
    //         $laxis = request()->laxis;
    //     }

    //     if (!empty(trim(request()->ldia))) {
    //         $ldia = request()->ldia;
    //     }

    //     if (!empty(trim(request()->rdia))) {
    //         $rdia = request()->rdia;
    //     }

    //     if (Input::get('sort') != "") {
    //         $sort = Input::get('sort');
    //     }
    //     if (Input::get('min') != "") {
    //         $min = Product::Filter(Input::get('min'));
    //         $mins = Input::get('min');
    //         $sort = "price";
    //     }
    //     if (Input::get('max') != "") {
    //         $max = Product::Filter(Input::get('max'));
    //         $maxs = Input::get('max');
    //         $sort = "price";
    //     }
    //     $maxvalue = $products = Product::where('status','1')->max('price');
        
    //     $category = Category::where('slug',$slug)->first();
        
    //     $cat = '';
    //     if($category->role == 'main'){
    //         $brands = DB::table('brand_name')->where('category_id', $category->id)->where('status', 1)->get();
    //         $cat = $category->id;
    //     }
    //     else{
    //         $brands = DB::table('brand_name')->where('category_id', $category->mainid->id)->where('status', 1)->get();
    //         $cat = $category->mainid->id;
    //     }
        
    //     $left_pd = DB::table('pd_table')->get();
    //     if ($category === null) {
    //         $category['name'] = "Nothing Found";
    //         $products = new \stdClass();
    //     }else{
    //         if ($sort=="old") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('created_at','desc');
    //         }elseif ($sort=="new") {
    //             // $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
    //             // ->orderBy('created_at','desc');
    //             if($category->role=='sub'){
    //                 $products = Product::where('status','1')
    //                                     ->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
    //                                     ->orderBy('created_at','desc');
    //             }else{
    //                 $products = Product::where('status','1')
    //                                     ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                                     ->orderBy('created_at','desc');
    //             }
    //         }elseif ($sort=="low") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('price','desc');
    //         }elseif ($sort=="high") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('price','desc');
    //         }elseif ($sort=="price") {
    //             $products = Product::where('status','1')
    //                 ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                 ->whereBetween('price', [$min, $max])
    //                 ->orderBy('price','desc');
    //         }else{
    //             if($category->mainid != ''){
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //             else{
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //         }
    //         if(!empty($colors)) {
    //             $colorSql = '';
    //             $tempcolors = explode(',', strtoupper($colors));
    //             for($x=0;$x<count($tempcolors);$x++){
    //                 if($x>0){$colorSql .=" OR ";}
    //                 $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
    //             }
    //             $products->whereRaw('('.$colorSql.')');
    //         }

    //         if(!empty($shapes)) {
    //             $shapeSql = '';
    //             $tempshapes= explode(',', strtoupper($shapes));
    //             for($x=0;$x<count($tempshapes);$x++){
    //                 if($x>0){$shapeSql .=" OR ";}
    //                 $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
    //             }
    //             $products->whereRaw('('.$shapeSql.')');
    //         }

    //         if(!empty($makes)) {
    //             $makeSql = '';
    //             $tempmakes= explode(',', strtoupper($makes));
    //             for($x=0;$x<count($tempmakes);$x++){
    //                 if($x>0){$makeSql .=" OR ";}
    //                 $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
    //             }
    //             $products->whereRaw('('.$makeSql.')');
    //         }

    //         if(!empty($gender)) {
    //             $genderSql = '';
    //             $tempgender= explode(',', strtoupper($gender));
    //             for($x=0;$x<count($tempgender);$x++){
    //                 if($x>0){$genderSql .=" OR ";}
    //                 $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
    //             }
    //             $products->whereRaw('('.$genderSql.')');
    //         }

    //         if(!empty($frametype)) {
    //             $frametypeSql = '';
    //             $tempframetype= explode(',', strtoupper($frametype));
    //             for($x=0;$x<count($tempframetype);$x++){
    //                 if($x>0){$frametypeSql .=" OR ";}
    //                 $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
    //             }
    //             $products->whereRaw('('.$frametypeSql.')');
    //         }

    //         if(!empty($framematerial)) {
    //             $framematerialSql = '';
    //             $tempframematerial= explode(',', strtoupper($framematerial));
    //             for($x=0;$x<count($tempframematerial);$x++){
    //                 if($x>0){$framematerialSql .=" OR ";}
    //                 $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
    //             }
    //             $products->whereRaw('('.$framematerialSql.')');
    //         }
    //         if(!empty($lenscolor)) {
    //             $lenscolorSql = '';
    //             $templenscolor= explode(',', strtoupper($lenscolor));
    //             for($x=0;$x<count($templenscolor);$x++){
    //                 if($x>0){$lenscolorSql .=" OR ";}
    //                 $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
    //             }
    //             $products->whereRaw('('.$lenscolorSql.')');
    //         }
    //         if(!empty($size)) {
    //             $sizeSql = '';
    //             $tempsize= explode(',', strtoupper($size));
    //             for($x=0;$x<count($tempsize);$x++){
    //                 if($x>0){$sizeSql .=" OR ";}
    //                 $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
    //             }
    //             $products->whereRaw('('.$sizeSql.')');
    //         }

    //         if(!empty($brandname)) {
    //             $brandnameSql = '';
    //             $tempbrandname= explode(',', strtoupper($brandname));
    //             for($x=0;$x<count($tempbrandname);$x++){
    //                 if($x>0){$brandnameSql .=" OR ";}
    //                 $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
    //             }
    //             $products->whereRaw('('.$brandnameSql.')');
    //         }

    //         if(!empty($lenstype)) {
    //             $lenstypeSql = '';
    //             $templenstype= explode(',', strtoupper($lenstype));
    //             for($x=0;$x<count($templenstype);$x++){
    //                 if($x>0){$lenstypeSql .=" OR ";}
    //                 $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
    //             }
    //             $products->whereRaw('('.$lenstypeSql.')');
    //         }

    //         if(!empty($disposability)) {
    //             $disposabilitySql = '';
    //             $tempdisposability= explode(',', strtoupper($disposability));
    //             for($x=0;$x<count($tempdisposability);$x++){
    //                 if($x>0){$disposabilitySql .=" OR ";}
    //                 $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
    //             }
    //             $products->whereRaw('('.$disposabilitySql.')');
    //         }

    //         if(!empty($packaging)) {
    //             $packagingSql = '';
    //             $temppackaging= explode(',', strtoupper($packaging));
    //             for($x=0;$x<count($temppackaging);$x++){
    //                 if($x>0){$packagingSql .=" OR ";}
    //                 $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
    //             }
    //             $products->whereRaw('('.$packagingSql.')');
    //         }

    //         if(!empty($lensmaterialtype)) {
    //             $lensmaterialtypeSql = '';
    //             $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
    //             for($x=0;$x<count($templensmaterialtype);$x++){
    //                 if($x>0){$lensmaterialtypeSql .=" OR ";}
    //                 $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
    //             }
    //             $products->whereRaw('('.$lensmaterialtypeSql.')');
    //         }

    //         if(!empty($lenstechnology)) {
    //             $lenstechnologySql = '';
    //             $templenstechnology= explode(',', strtoupper($lenstechnology));
    //             for($x=0;$x<count($templenstechnology);$x++){
    //                 if($x>0){$lenstechnologySql .=" OR ";}
    //                 $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
    //             }
    //             $products->whereRaw('('.$lenstechnologySql.')');
    //         }

    //         if(!empty($lensindex)) {
    //             $lensindexSql = '';
    //             $templensindex= explode(',', strtoupper($lensindex));
    //             for($x=0;$x<count($templensindex);$x++){
    //                 if($x>0){$lensindexSql .=" OR ";}
    //                 $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
    //             }
    //             $products->whereRaw('('.$lensindexSql.')');
    //         }

    //         if(!empty($visioneffect)) {
    //             $visioneffectSql = '';
    //             $tempvisioneffect= explode(',', strtoupper($visioneffect));
    //             for($x=0;$x<count($tempvisioneffect);$x++){
    //                 if($x>0){$visioneffectSql .=" OR ";}
    //                 $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
    //             }
    //             $products->whereRaw('('.$visioneffectSql.')');
    //         }

    //         if(!empty($netquntity)) {
    //             $netquntitySql = '';
    //             $tempnetquntity= explode(',', strtoupper($netquntity));
    //             for($x=0;$x<count($tempnetquntity);$x++){
    //                 if($x>0){$netquntitySql .=" OR ";}
    //                 $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
    //             }
    //             $products->whereRaw('('.$netquntitySql.')');
    //         }

    //         if(!empty($lensestype)) {
    //             $lensestypeSql = " FIND_IN_SET('".$lensestype."',visioneffect)";
    //             $products->whereRaw('('.$lensestypeSql.')');
    //         }
            
    //         if(!empty($radd)) {
    //             $raddSql = " FIND_IN_SET('".$radd."',addpowerlens)";
    //             $products->whereRaw('('.$raddSql.')');
    //         }
            
    //         if(!empty($rsph)) {
    //             $rsphSql = " FIND_IN_SET('".$rsph."',sphere)";
    //             $products->whereRaw('('.$rsphSql.')');
    //         }
            
    //         if(!empty($raxis)) {
    //             $raxisSql = " FIND_IN_SET('".$raxis."',axisnlens)";
    //             $products->whereRaw('('.$raxisSql.')');
    //         }
            
    //         if(!empty($rcyl)) {
    //             $rcylSql = " FIND_IN_SET('".$rcyl."',cylinderlens)";
    //             $products->whereRaw('('.$rcylSql.')');
    //         }
            
    //         if(!empty($rdia)) {
    //             $rdiaSql = " FIND_IN_SET('".$rdia."',diameterlens)";
    //             $products->whereRaw('('.$rdiaSql.')');
    //         }
            
    //         if(!empty($ldia)) {
    //             $ldiaSql = " FIND_IN_SET('".$ladd."',diameterlens)";
    //             $products->whereRaw('('.$ldiaSql.')');
    //         }
            
    //         if(!empty($lsph)) {
    //             $lsphSql = " FIND_IN_SET('".$lsph."',sphere)";
    //             $products->whereRaw('('.$lsphSql.')');
    //         }
            
    //         if(!empty($laxis)) {
    //             $laxisSql = " FIND_IN_SET('".$laxis."',axisnlens)";
    //             $products->whereRaw('('.$laxisSql.')');
    //         }
            
    //         if(!empty($lcyl)) {
    //             $lcylSql = " FIND_IN_SET('".$lcyl."',cylinderlens)";
    //             $products->whereRaw('('.$lcylSql.')');
    //         } 
           
    //         $products= $products->take(9)->get();
    //     }
        
    //     if(isset($_GET) && !empty($_GET)){
    //         $search_type = $_GET;   
    //         return view('categoryproduct', compact('products', 'user_profiles', 'lensmaterial', 'left_pd','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'search_type', 'frame_shape', 'frame_material', 'frame_color', 'brands', 'cat'));
    //     }else{   
    //     return view('categoryproduct', compact('products', 'user_profiles','lensmaterial', 'left_pd','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'frame_shape', 'frame_material', 'frame_color', 'brands', 'cat'));
    //     }
    // }
    
    
    // public function catproductnew($id) {
    //     $user_profiles = '';
    //     if(Auth::guard('profile')->check()){
    //         $user = UserProfile::find(Auth::guard('profile')->user()->id);
    //         $user1=$user->id;
    //         $user_profiles= DB::table('user_profiles')->select('*')->where('id',$user1)->first();
    //     }
        
    //     DB::enableQueryLog();
    //     $left_pd = DB::table('pd_table')->get();
    //     $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $lensestype = $radd = $rsph = $raxis = $rcyl = $ladd = $lsph = $laxis = $lcyl = $ldia = $rdia = $netquntity = "";
    //     $min = "0";
    //     $max = "500";
    //     $mins = "0";
    //     $maxs = "500";
        
    //     $lensmaterial = DB::table('lens_material')->where('status', 1)->get();
    //     $frame_color = DB::table('frame_color')->where('status', 1)->get();
    //     $frame_material = DB::table('frame_material')->get();
    //     $frame_shape = DB::table('frame_shape')->get();
        
    //     if (!empty(trim(request()->colors))) {
    //         $colors = request()->colors;
    //     }
    //     if (!empty(trim(request()->shapes))) {
    //         $shapes = request()->shapes;
    //     }
    //     if (!empty(trim(request()->makes))) {
    //         $makes = request()->makes;
    //     }
    //     if (!empty(trim(request()->gender))) {
    //         $gender = request()->gender;
    //     }
        
    //     if (!empty(trim(request()->frametype))) {
    //         $frametype = request()->frametype;
    //     }
    //     if (!empty(trim(request()->framematerial))) {
    //         $framematerial = request()->framematerial;
    //     }
    //     if (!empty(trim(request()->lenscolor))) {
    //         $lenscolor = request()->lenscolor;
    //     }
    //     if (!empty(trim(request()->size))) {
    //         $size = request()->size;
    //     } 
    //     if (!empty(trim(request()->brandname))) {
    //         $brandname = request()->brandname;
    //     }
    //     if (!empty(trim(request()->lenstype))) {
    //         $lenstype = request()->lenstype;
    //     }
    //     if (!empty(trim(request()->disposability))) {
    //         $disposability = request()->disposability;
    //     }
    //     if (!empty(trim(request()->packaging))) {
    //         $packaging = request()->packaging;
    //     }

    //      if (!empty(trim(request()->lensmaterialtype))) {
    //         $lensmaterialtype = request()->lensmaterialtype;
    //     }

    //      if (!empty(trim(request()->lenstechnology))) {
    //         $lenstechnology = request()->lenstechnology;
    //     }

    //      if (!empty(trim(request()->lensindex))) {
    //         $lensindex = request()->lensindex;
    //     }

    //     if (!empty(trim(request()->visioneffect))) {
    //         $visioneffect = request()->visioneffect;
    //     }

    //     if (!empty(trim(request()->netquntity))) {
    //         $netquntity = request()->netquntity;
    //     }

    //     if (!empty(trim(request()->lensestype))) {
    //         $lensestype = request()->lensestype;
    //     }

    //     if (!empty(trim(request()->radd))) {
    //         $radd = request()->radd;
    //     }

    //     if (!empty(trim(request()->rsph))) {
    //         $rsph = (float) request()->rsph;
    //     }

    //     if (!empty(trim(request()->rcyl))) {
    //         $rcyl = (float) request()->rcyl;
    //     }

    //     if (!empty(trim(request()->raxis))) {
    //         $raxis = request()->raxis;
    //     }

    //     if (!empty(trim(request()->ladd))) {
    //         $ladd = request()->ladd;
            
    //     }

    //     if (!empty(trim(request()->lsph))) {
    //         $lsph = (float) request()->lsph;
    //     }

    //     if (!empty(trim(request()->lcyl))) {
    //         $lcyl = (float) request()->lcyl;
    //     }

    //     if (!empty(trim(request()->laxis))) {
    //         $laxis = request()->laxis;
    //     }

    //     if (!empty(trim(request()->ldia))) {
    //         $ldia = request()->ldia;
    //     }

    //     if (!empty(trim(request()->rdia))) {
    //         $rdia = request()->rdia;
    //     }
    
    //     if (Input::get('sort') != "") {
    //         $sort = Input::get('sort');
    //     }
    //     if (Input::get('min') != "") {
    //         $min = Product::Filter(Input::get('min'));
    //         $mins = Input::get('min');
    //         $sort = "price";
    //     }
    //     if (Input::get('max') != "") {
    //         $max = Product::Filter(Input::get('max'));
    //         $maxs = Input::get('max');
    //         $sort = "price";
    //     }
    //     $maxvalue = $products = Product::where('status','1')->max('price');
    //     $category = Category::where('id',$id)->first();
        
    //     $cat = $category->mainid->id;

    //     $brands = DB::table('brand_name')->where('category_id', $category->mainid->id)->where('status', 1)->get();
        
    //     $lensmaterial  = DB::table('lens_material')->where('status','1')->orderBy('id','desc')->get();
        
    //     if ($category === null) {
    //         $category['name'] = "Nothing Found";
    //         $products = new \stdClass();
    //     }else{
    //         if ($sort=="old") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('created_at','desc');
    //         }elseif ($sort=="new") {
    //             $products = Product::where('status','1')->where('category', $category->mainid->id)->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
    //             ->orderBy('created_at','desc');
                
    //         }elseif ($sort=="low") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('price','desc');
    //         }elseif ($sort=="high") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //             ->orderBy('price','desc');
    //         }elseif ($sort=="price") {
    //             $products = Product::where('status','1')
    //                 ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                 ->whereBetween('price', [$min, $max])
    //                 ->orderBy('price','desc');
    //         }else{
    //             $products = Product::select('*')
    //                 ->where('category', $category->mainid->id)
    //                 ->where('childid','LIKE','%'.$id.'%')
    //                 ->where('status', 1)
    //                 ->orderBy('created_at','desc');
    //         }
    //         if(!empty($colors)) {
    //             $colorSql = '';
    //             $tempcolors = explode(',', strtoupper($colors));
    //             for($x=0;$x<count($tempcolors);$x++){
    //                 if($x>0){$colorSql .=" OR ";}
    //                 $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
    //             }
    //             $products->whereRaw('('.$colorSql.')');
    //         }
    
    //         if(!empty($shapes)) {
    //             $shapeSql = '';
    //             $tempshapes= explode(',', strtoupper($shapes));
    //             for($x=0;$x<count($tempshapes);$x++){
    //                 if($x>0){$shapeSql .=" OR ";}
    //                 $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
    //             }
    //             $products->whereRaw('('.$shapeSql.')');
    //         }
    
    //         if(!empty($makes)) {
    //             $makeSql = '';
    //             $tempmakes= explode(',', strtoupper($makes));
    //             for($x=0;$x<count($tempmakes);$x++){
    //                 if($x>0){$makeSql .=" OR ";}
    //                 $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
    //             }
    //             $products->whereRaw('('.$makeSql.')');
    //         }
    
    //         if(!empty($gender)) {
    //             $genderSql = '';
    //             $tempgender= explode(',', strtoupper($gender));
    //             for($x=0;$x<count($tempgender);$x++){
    //                 if($x>0){$genderSql .=" OR ";}
    //                 $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
    //             }
    //             $products->whereRaw('('.$genderSql.')');
    //         }

    //         if(!empty($frametype)) {
    //             $frametypeSql = '';
    //             $tempframetype= explode(',', strtoupper($frametype));
    //             for($x=0;$x<count($tempframetype);$x++){
    //                 if($x>0){$frametypeSql .=" OR ";}
    //                 $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
    //             }
    //             $products->whereRaw('('.$frametypeSql.')');
    //         }

    //         if(!empty($framematerial)) {
    //             $framematerialSql = '';
    //             $tempframematerial= explode(',', strtoupper($framematerial));
    //             for($x=0;$x<count($tempframematerial);$x++){
    //                 if($x>0){$framematerialSql .=" OR ";}
    //                 $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
    //             }
    //             $products->whereRaw('('.$framematerialSql.')');
    //         }
    //         if(!empty($lenscolor)) {
    //             $lenscolorSql = '';
    //             $templenscolor= explode(',', strtoupper($lenscolor));
    //             for($x=0;$x<count($templenscolor);$x++){
    //                 if($x>0){$lenscolorSql .=" OR ";}
    //                 $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
    //             }
    //             $products->whereRaw('('.$lenscolorSql.')');
    //         }
    //         if(!empty($size)) {
    //             $sizeSql = '';
    //             $tempsize= explode(',', strtoupper($size));
    //             for($x=0;$x<count($tempsize);$x++){
    //                 if($x>0){$sizeSql .=" OR ";}
    //                 $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
    //             }
    //             $products->whereRaw('('.$sizeSql.')');
    //         }

    //         if(!empty($brandname)) {
    //             $brandnameSql = '';
    //             $tempbrandname= explode(',', strtoupper($brandname));
    //             for($x=0;$x<count($tempbrandname);$x++){
    //                 if($x>0){$brandnameSql .=" OR ";}
    //                 $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
    //             }
    //             $products->whereRaw('('.$brandnameSql.')');
    //         }

    //         if(!empty($lenstype)) {
    //             $lenstypeSql = '';
    //             $templenstype= explode(',', strtoupper($lenstype));
    //             for($x=0;$x<count($templenstype);$x++){
    //                 if($x>0){$lenstypeSql .=" OR ";}
    //                 $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
    //             }
    //             $products->whereRaw('('.$lenstypeSql.')');
    //         }

    //         if(!empty($disposability)) {
    //             $disposabilitySql = '';
    //             $tempdisposability= explode(',', strtoupper($disposability));
    //             for($x=0;$x<count($tempdisposability);$x++){
    //                 if($x>0){$disposabilitySql .=" OR ";}
    //                 $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
    //             }
    //             $products->whereRaw('('.$disposabilitySql.')');
    //         }

    //         if(!empty($packaging)) {
    //             $packagingSql = '';
    //             $temppackaging= explode(',', strtoupper($packaging));
    //             for($x=0;$x<count($temppackaging);$x++){
    //                 if($x>0){$packagingSql .=" OR ";}
    //                 $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
    //             }
    //             $products->whereRaw('('.$packagingSql.')');
    //         }

    //         if(!empty($lensmaterialtype)) {
    //             $lensmaterialtypeSql = '';
    //             $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
    //             for($x=0;$x<count($templensmaterialtype);$x++){
    //                 if($x>0){$lensmaterialtypeSql .=" OR ";}
    //                 $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
    //             }
    //             $products->whereRaw('('.$lensmaterialtypeSql.')');
    //         }

    //         if(!empty($lenstechnology)) {
    //             $lenstechnologySql = '';
    //             $templenstechnology= explode(',', strtoupper($lenstechnology));
    //             for($x=0;$x<count($templenstechnology);$x++){
    //                 if($x>0){$lenstechnologySql .=" OR ";}
    //                 $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
    //             }
    //             $products->whereRaw('('.$lenstechnologySql.')');
    //         }

    //         if(!empty($lensindex)) {
    //             $lensindexSql = '';
    //             $templensindex= explode(',', strtoupper($lensindex));
    //             for($x=0;$x<count($templensindex);$x++){
    //                 if($x>0){$lensindexSql .=" OR ";}
    //                 $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
    //             }
    //             $products->whereRaw('('.$lensindexSql.')');
    //         }

    //         if(!empty($visioneffect)) {
    //             $visioneffectSql = '';
    //             $tempvisioneffect= explode(',', strtoupper($visioneffect));
    //             for($x=0;$x<count($tempvisioneffect);$x++){
    //                 if($x>0){$visioneffectSql .=" OR ";}
    //                 $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
    //             }
    //             $products->whereRaw('('.$visioneffectSql.')');
    //         }

    //         if(!empty($netquntity)) {
    //             $netquntitySql = '';
    //             $tempnetquntity= explode(',', strtoupper($netquntity));
    //             for($x=0;$x<count($tempnetquntity);$x++){
    //                 if($x>0){$netquntitySql .=" OR ";}
    //                 $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
    //             }
    //             $products->whereRaw('('.$netquntitySql.')');
    //         }

    //         if(!empty($lensestype)) {
    //             $lensestypeSql = " FIND_IN_SET('".$lensestype."',visioneffect)";
    //             $products->whereRaw('('.$lensestypeSql.')');
    //         }
            
    //         if(!empty($radd)) {
    //             $raddSql = " FIND_IN_SET('".$radd."',addpowerlens)";
    //             $products->whereRaw('('.$raddSql.')');
    //         }
            
    //         if(!empty($rsph)) {
    //             $rsphSql = " FIND_IN_SET('".$rsph."',sphere)";
    //             $products->whereRaw('('.$rsphSql.')');
    //         }
            
    //         if(!empty($raxis)) {
    //             $raxisSql = " FIND_IN_SET('".$raxis."',axisnlens)";
    //             $products->whereRaw('('.$raxisSql.')');
    //         }
            
    //         if(!empty($rcyl)) {
    //             $rcylSql = " FIND_IN_SET('".$rcyl."',cylinderlens)";
    //             $products->whereRaw('('.$rcylSql.')');
    //         }
            
    //         if(!empty($rdia)) {
    //             $rdiaSql = " FIND_IN_SET('".$rdia."',diameterlens)";
    //             $products->whereRaw('('.$rdiaSql.')');
    //         }
            
    //         if(!empty($ldia)) {
    //             $ldiaSql = " FIND_IN_SET('".$ladd."',diameterlens)";
    //             $products->whereRaw('('.$ldiaSql.')');
    //         }
            
    //         if(!empty($lsph)) {
    //             $lsphSql = " FIND_IN_SET('".$lsph."',sphere)";
    //             $products->whereRaw('('.$lsphSql.')');
    //         }
            
    //         if(!empty($laxis)) {
    //             $laxisSql = " FIND_IN_SET('".$laxis."',axisnlens)";
    //             $products->whereRaw('('.$laxisSql.')');
    //         }
            
    //         if(!empty($lcyl)) {
    //             $lcylSql = " FIND_IN_SET('".$lcyl."',cylinderlens)";
    //             $products->whereRaw('('.$lcylSql.')');
    //         }
           
    //         $products = $products->take(9)->get();
             
    //     }

    //     if(isset($_GET) && !empty($_GET)){
    //         $search_type = $_GET;  
    //         return view('categoryproduct', compact('products','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'search_type' , 'frame_shape', 'frame_material', 'frame_color', 'brands', 'cat'));
    //     }else{
    //         return view('categoryproduct', compact('products','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity' , 'frame_shape', 'frame_material', 'frame_color', 'brands', 'cat'));
    //     }
        
    //     // return view('categoryproduct', compact('products','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect'));
    // }
  

    // //Load More Category Products
    // public function loadcatproduct($slug,$page) {
    //     $language = SiteLanguage::find(1);
    //     $settings = Settings::find(1);
    //     $res = "";
    //     $min = "0";
    //     $max = "500";
    //     $mins = "0";
    //     $maxs = "500";
    //     $skip = ($page-1)*9;

    //     $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $netquntity = "";

    //     if (!empty(trim(request()->colors))) {
    //         $colors = request()->colors;
    //     }
    //     if (!empty(trim(request()->shapes))) {
    //         $shapes = request()->shapes;
    //     }
    //     if (!empty(trim(request()->makes))) {
    //         $makes = request()->makes;
    //     }
    //     if (!empty(trim(request()->gender))) {
    //         $makes = request()->gender;
    //     }
    //     if (!empty(trim(request()->frametype))) {
    //         $frametype = request()->frametype;
    //     }
    //     if (!empty(trim(request()->framematerial))) {
    //         $framematerial = request()->framematerial;
    //     }
    //     if (!empty(trim(request()->lenscolor))) {
    //         $lenscolor = request()->lenscolor;
    //     }
    //     if (!empty(trim(request()->size))) {
    //         $size = request()->size;
    //     }
    //     if (!empty(trim(request()->brandname))) {
    //         $brandname = request()->brandname;
    //     }
    //     if (!empty(trim(request()->lenstype))) {
    //         $lenstype = request()->lenstype;
    //     }
    //     if (!empty(trim(request()->disposability))) {
    //         $disposability = request()->disposability;
    //     }
    //     if (!empty(trim(request()->packaging))) {
    //         $packaging = request()->packaging;
    //     }

    //     if (!empty(trim(request()->lensmaterialtype))) {
    //         $lensmaterialtype = request()->lensmaterialtype;
    //     }

    //     if (!empty(trim(request()->lenstechnology))) {
    //         $lenstechnology = request()->lenstechnology;
    //     }

    //     if (!empty(trim(request()->lensindex))) {
    //         $lensindex = request()->lensindex;
    //     }

    //     if (!empty(trim(request()->visioneffect))) {
    //         $visioneffect = request()->visioneffect;
    //     }

    //     if (!empty(trim(request()->netquntity))) {
    //         $netquntity = request()->netquntity;
    //     }

    //     if (Input::get('sort') != "") {
    //         $sort = Input::get('sort');
    //     }

    //     if (Input::get('min') != "") {
    //         $min = Product::Filter(Input::get('min'));
    //         $mins = Input::get('min');
    //         $sort = "price";
    //     }
    //     if (Input::get('max') != "") {
    //         $max = Product::Filter(Input::get('max'));
    //         $maxs = Input::get('max');
    //         $sort = "price";
    //     }
    //     $category = Category::where('slug',$slug)->first();
        
    //     if ($category === null) {
    //         $category['name'] = "Nothing Found";
    //         $products = new \stdClass();
    //     }else{
    //         if ($sort=="old") {                
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('created_at','desc');
    //         }elseif ($sort=="new") {
    //             if($category->role == 'sub'){
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //             elseif($category->role == 'child'){
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //             else{
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //         }elseif ($sort=="low") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','desc');
    //         }elseif ($sort=="high") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','desc');
    //         }elseif ($sort=="price") {
    //             $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->whereBetween('price', [$min, $max])->orderBy('price','desc');
    //         }else{
    //             if($category->role == 'sub'){
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //             else{
    //                 $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
    //                 ->orderBy('created_at','desc');
    //             }
    //         }
    //         if(!empty($colors)) {
    //             $colorSql = '';
    //             $tempcolors = explode(',', strtoupper($colors));
    //             for($x=0;$x<count($tempcolors);$x++){
    //                 if($x>0){$colorSql .=" OR ";}
    //                 $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
    //             }
    //             $products->whereRaw('('.$colorSql.')');
    //         }

    //         if(!empty($shapes)) {
    //             $shapeSql = '';
    //             $tempshapes= explode(',', strtoupper($shapes));
    //             for($x=0;$x<count($tempshapes);$x++){
    //                 if($x>0){$shapeSql .=" OR ";}
    //                 $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
    //             }
    //             $products->whereRaw('('.$shapeSql.')');
    //         }

    //         if(!empty($makes)) {
    //             $makeSql = '';
    //             $tempmakes= explode(',', strtoupper($makes));
    //             for($x=0;$x<count($tempmakes);$x++){
    //                 if($x>0){$makeSql .=" OR ";}
    //                 $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
    //             }
    //             $products->whereRaw('('.$makeSql.')');
    //         }

    //         if(!empty($gender)) {
    //             $genderSql = '';
    //             $tempgender= explode(',', strtoupper($gender));
    //             for($x=0;$x<count($tempgender);$x++){
    //                 if($x>0){$genderSql .=" OR ";}
    //                 $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
    //             }
    //             $products->whereRaw('('.$genderSql.')');
    //         }

    //         if(!empty($frametype)) {
    //             $frametypeSql = '';
    //             $tempframetype= explode(',', strtoupper($frametype));
    //             for($x=0;$x<count($tempframetype);$x++){
    //                 if($x>0){$frametypeSql .=" OR ";}
    //                 $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
    //             }
    //             $products->whereRaw('('.$frametypeSql.')');
    //         }

    //         if(!empty($framematerial)) {
    //             $framematerialSql = '';
    //             $tempframematerial= explode(',', strtoupper($framematerial));
    //             for($x=0;$x<count($tempframematerial);$x++){
    //                 if($x>0){$framematerialSql .=" OR ";}
    //                 $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
    //             }
    //             $products->whereRaw('('.$framematerialSql.')');
    //         }
            
    //         if(!empty($lenscolor)) {
    //             $lenscolorSql = '';
    //             $templenscolor= explode(',', strtoupper($lenscolor));
    //             for($x=0;$x<count($templenscolor);$x++){
    //                 if($x>0){$lenscolorSql .=" OR ";}
    //                 $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
    //             }
    //             $products->whereRaw('('.$lenscolorSql.')');
    //         }

    //         if(!empty($size)) {
    //             $sizeSql = '';
    //             $tempsize= explode(',', strtoupper($size));
    //             for($x=0;$x<count($tempsize);$x++){
    //                 if($x>0){$sizeSql .=" OR ";}
    //                 $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
    //             }
    //             $products->whereRaw('('.$sizeSql.')');
    //         }

    //         if(!empty($brandname)) {
    //             $brandnameSql = '';
    //             $tempbrandname= explode(',', strtoupper($brandname));
    //             for($x=0;$x<count($tempbrandname);$x++){
    //                 if($x>0){$brandnameSql .=" OR ";}
    //                 $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
    //             }
    //             $products->whereRaw('('.$brandnameSql.')');
    //         }

    //         if(!empty($lenstype)) {
    //             $lenstypeSql = '';
    //             $templenstype= explode(',', strtoupper($lenstype));
    //             for($x=0;$x<count($templenstype);$x++){
    //                 if($x>0){$lenstypeSql .=" OR ";}
    //                 $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
    //             }
    //             $products->whereRaw('('.$lenstypeSql.')');
    //         }

    //         if(!empty($disposability)) {
    //             $disposabilitySql = '';
    //             $tempdisposability= explode(',', strtoupper($disposability));
    //             for($x=0;$x<count($tempdisposability);$x++){
    //                 if($x>0){$disposabilitySql .=" OR ";}
    //                 $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
    //             }
    //             $products->whereRaw('('.$disposabilitySql.')');
    //         }

    //         if(!empty($packaging)) {
    //             $packagingSql = '';
    //             $temppackaging= explode(',', strtoupper($packaging));
    //             for($x=0;$x<count($temppackaging);$x++){
    //                 if($x>0){$packagingSql .=" OR ";}
    //                 $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
    //             }
    //             $products->whereRaw('('.$packagingSql.')');
    //         }

    //          if(!empty($lensmaterialtype)) {
    //             $lensmaterialtypeSql = '';
    //             $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
    //             for($x=0;$x<count($templensmaterialtype);$x++){
    //                 if($x>0){$lensmaterialtypeSql .=" OR ";}
    //                 $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
    //             }
    //             $products->whereRaw('('.$lensmaterialtypeSql.')');
    //         }

    //         if(!empty($lenstechnology)) {
    //             $lenstechnologySql = '';
    //             $templenstechnology= explode(',', strtoupper($lenstechnology));
    //             for($x=0;$x<count($templenstechnology);$x++){
    //                 if($x>0){$lenstechnologySql .=" OR ";}
    //                 $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
    //             }
    //             $products->whereRaw('('.$lenstechnologySql.')');
    //         }

    //         if(!empty($lensindex)) {
    //             $lensindexSql = '';
    //             $templensindex= explode(',', strtoupper($lensindex));
    //             for($x=0;$x<count($templensindex);$x++){
    //                 if($x>0){$lensindexSql .=" OR ";}
    //                 $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
    //             }
    //             $products->whereRaw('('.$lensindexSql.')');
    //         }

    //         if(!empty($visioneffect)) {
    //             $visioneffectSql = '';
    //             $tempvisioneffect= explode(',', strtoupper($visioneffect));
    //             for($x=0;$x<count($tempvisioneffect);$x++){
    //                 if($x>0){$visioneffectSql .=" OR ";}
    //                 $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
    //             }
    //             $products->whereRaw('('.$visioneffectSql.')');
    //         }

    //         if(!empty($netquntity)) {
    //             $netquntitySql = '';
    //             $tempnetquntity= explode(',', strtoupper($netquntity));
    //             for($x=0;$x<count($tempnetquntity);$x++){
    //                 if($x>0){$netquntitySql .=" OR ";}
    //                 $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
    //             }
    //             $products->whereRaw('('.$netquntitySql.')');
    //         }

    //         $products = $products->skip($skip)->take(9)->get();

    //         foreach($products as $product) {
    //             $res .= '
    //                     <style>
    //                         .image_latest_product_shubh {
    //                             text-align: center;
    //                             vertical-align: middle;
    //                             position: relative;
    //                             display: inline;
    //                             display: table-cell;
    //                             transition: transform 0.4s ease;
    //                         }
    //                         .image_latest_product_shubh .img-top {
    //                             /*padding : 40px 0px;*/
    //                             /*background : center center #fff;*/
    //                             display: none;
    //                             position: absolute;
    //                             /*display: table-cell;*/
    //                             vertical-align: middle;
    //                             top: 40px;
    //                             left: 0;
    //                             right : 0;
    //                             left : 0;
    //                             z-index: 9;
    //                         }
                        
    //                         .image_latest_product_shubh:hover .img-top {
    //                             display: flex;
    //                             margin : auto;
    //                             top: 0px;
    //                         }
    //                     </style>
    //                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 single_product">
    //                         <div class="single-product-carousel-item">
    //                             <div class="image_latest_product_shubh">
    //                                 <a href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank"> <img src="' . url('/assets/images/products') . '/' . $product->feature_image . '" alt="Product Image" /> </a>';
    //                                 $gallery = $product->gallery_images->toArray();
    //                         $res .= '<a class="img-top" href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank"> <img src="' . url('/assets/images/gallery') . '/' . $gallery[0]['image'] . '" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>
    //                             </div>
    //                             <div class="product-carousel-text">
    //                                 <a href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank">
    //                                     <h4 class="product-title">' . $product->title . '</h4>
    //                                 </a>
                                    
    //                                 <div class="ratings">
    //                                     <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="empty-stars"></div></a>
    //                                     <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="full-stars" style="width:'.Review::ratings($product->id).'%"></div></a>
    //                                 </div>
                                    
    //                                 <div class="product-price">
    //                                 <del class="offer-pricenewone"><i  title ="Add to My site"class=" fa fa-share-alt" style="font-size:15px"></i></del>';
    //                                 if ($product->previous_price != "")
    //                                 {
    //                                     $res .= '<span class="original-price">' .$settings->currency_sign. $product->previous_price . '</span>';
    //                                 }
    //                                 if(Auth::guard('profile')->check())
    //                                 {
    //                                     if(Auth::guard('profile')->user()->costpriceshow == 'Yes'){
    //                                         $res .= '<del class="offer-pricenew"><a data-toggle="modal" data-target="#view_'.$product->id.'" ><i class="fa fa-eye" aria-hidden="true"></i> </a></del>';
    //                                     }
    //                                 }
    //                         $res .= '</div>
    //                                 <div class="product-meta-area">
    //                                     <a  href="javascript:;" class="wish-list" onclick="getQuickView('.$product->id.')" data-toggle="modal" data-target="#myModal">
    //                                         <i class="fa fa-eye"></i>
    //                                     </a>
    //                                 </div>
                                    
    //                             </div>
    //                         </div>
    //                     </div>';
    //                     $res .= '
    //                         <div class="modal fade" id="view_'.$product->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    //                             <div class="modal-dialog modal-dialog-centered" role="document">
    //                                 <div class="modal-content">
    //                                   <div class="modal-header">
    //                                     <h5 class="modal-title" id="exampleModalLongTitle">Product Cost Price</h5>
    //                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //                                       <span aria-hidden="true">&times;</span>
    //                                     </button>
    //                                   </div>
    //                                   <div class="modal-body" style="text-align:center;">';
    //                                     if($product->costprice == ''){
    //                                       $res .= '<h5>Product Cost Price:- 0</h5>';
    //                                     }else{
    //                                         $res .= '<h5>Product Cost Price:- '.$product->costprice.'</h5>';
    //                                     }
    //                                   $res .= '</div>
    //                                   <div class="modal-footer text-center">
    //                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    //                                   </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     ';
    //         }

    //     }
    //     return $res;
    // }
    
    //Category Products
    public function catproduct($slug) {
        $user_profiles = '';
        if(Auth::guard('profile')->check()){
            $user = UserProfile::find(Auth::guard('profile')->user()->id);
            $user1=$user->id;
            $user_profiles= DB::table('user_profiles')->select('*')->where('id',$user1)->first();
        }
        $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $framecolor = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $coating = $radd = $rsph = $raxis = $rcyl = $ladd = $lsph = $laxis = $lcyl = $ldia = $rdia = $netquntity = $premiumtype = "";
        $min = "0";
        $max = "500";
        $mins = "0";
        $maxs = "500";
        
        $lensmaterial = DB::table('lens_material')->where('status', 1)->get();
        $lenscolors = DB::table('lens_color')->where('status', 1)->get();
        $frame_color = DB::table('frame_color')->where('status', 1)->get();
        $frame_material = DB::table('frame_material')->get();
        $frame_shape = DB::table('frame_shape')->where('status', 1)->get();
        $netQuentities = DB::table('net_quantity')->where('status', 1)->get();
        $lens_coating = DB::table('lens_coating')->where('status', 1)->get();
        $disposabilities = DB::table('disposability')->where('status', 1)->get();
        $contactlens_packaging= DB::table('contactlens_packeging')->get()->toarray();
     
        if (!empty(trim(request()->colors))) {
            $colors = request()->colors;
        }
        if (!empty(trim(request()->shapes))) {
            $shapes = request()->shapes;
        }
        if (!empty(trim(request()->makes))) {
            $makes = request()->makes;
        }
        if (!empty(trim(request()->gender))) {
            $gender = request()->gender;
        }
        if (!empty(trim(request()->frametype))) {
            $frametype = request()->frametype;
        }
        if (!empty(trim(request()->framematerial))) {
            $framematerial = request()->framematerial;
        }
        if (!empty(trim(request()->framecolor))) {
            $framecolor = request()->framecolor;
        }
        if (!empty(trim(request()->lenscolor))) {
            $lenscolor = request()->lenscolor;
        }
        if (!empty(trim(request()->size))) {
            $size = request()->size;
        } 
        if (!empty(trim(request()->brandname))) {
            $brandname = request()->brandname;
        }
        if (!empty(trim(request()->lenstype))) {
            $lenstype = request()->lenstype;
        }
        if (!empty(trim(request()->disposability))) {
            $disposability = request()->disposability;
        }
        if (!empty(trim(request()->packaging))) {
            $packaging = request()->packaging;
        }
        if (!empty(trim(request()->lensmaterialtype))) {
            $lensmaterialtype = request()->lensmaterialtype;
        }
        if (!empty(trim(request()->lenstechnology))) {
            $lenstechnology = request()->lenstechnology;
        }
        if (!empty(trim(request()->lensindex))) {
            $lensindex = request()->lensindex;
        }
        if (!empty(trim(request()->visioneffect))) {
            $visioneffect = request()->visioneffect;
        }
        if (!empty(trim(request()->netquntity))) {
            $netquntity = request()->netquntity;
        }
        if (!empty(trim(request()->premiumtype))) {
            $premiumtype = request()->premiumtype;
        }
        if (!empty(trim(request()->coating))) {
            $coating = request()->coating;
        }
        if (!empty(trim(request()->radd))) {
            $radd = request()->radd;
        }
        if (!empty(trim(request()->rsph))) {
            $rsph = (float) request()->rsph;
        }
        if (!empty(trim(request()->rcyl))) {
            $rcyl = (float) request()->rcyl;
        }
        if (!empty(trim(request()->raxis))) {
            $raxis = request()->raxis;
        }
        if (!empty(trim(request()->ladd))) {
            $ladd = request()->ladd;
        }
        if (!empty(trim(request()->lsph))) {
            $lsph = (float) request()->lsph;
        }
        if (!empty(trim(request()->lcyl))) {
            $lcyl = (float) request()->lcyl;
        }
        if (!empty(trim(request()->laxis))) {
            $laxis = request()->laxis;
        }
        if (!empty(trim(request()->ldia))) {
            $ldia = request()->ldia;
        }
        if (!empty(trim(request()->rdia))) {
            $rdia = request()->rdia;
        }
        if (Input::get('sort') != "") {
            $sort = Input::get('sort');
        }
        if (Input::get('min') != "") {
            $min = Product::Filter(Input::get('min'));
            $mins = Input::get('min');
            $sort = "price";
        }
        if (Input::get('max') != "") {
            $max = Product::Filter(Input::get('max'));
            $maxs = Input::get('max');
            $sort = "price";
        }
        $maxvalue = $products = Product::where('status','1')->max('price');
        
        $category = Category::where('slug',$slug)->first();
        
        $cat = '';
        if($category->role == 'main'){
            $brands = DB::table('brand_name')->where('category_id', $category->id)->where('status', 1)->get();
            $cat = $category->id;
        }
        else{
            $brands = DB::table('brand_name')->where('category_id', $category->mainid->id)->where('status', 1)->get();
            $cat = $category->mainid->id;
        }
        
        $left_pd = DB::table('pd_table')->get();
        
        if ($category === null) {
            $category['name'] = "Nothing Found";
            $products = new \stdClass();
        }else{
            if ($sort=="old") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('created_at','desc');
            }elseif ($sort=="new") {
                // $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                // ->orderBy('created_at','desc');
                if($category->role=='sub'){
                    $products = Product::where('status','1')
                                        ->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
                                        ->orderBy('created_at','desc');
                }else{
                    $products = Product::where('status','1')
                                        ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                                        ->orderBy('created_at','desc');
                }
            }elseif ($sort=="low") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','desc');
            }elseif ($sort=="high") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','desc');
            }elseif ($sort=="price") {
                $products = Product::where('status','1')
                    ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->whereBetween('price', [$min, $max])
                    ->orderBy('price','desc');
            }else{
                if($category->mainid != ''){
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
                    ->orderBy('created_at','desc');
                }
                else{
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->orderBy('created_at','desc');
                }
            }
            if(!empty($colors)) {
                $colorSql = '';
                $tempcolors = explode(',', strtoupper($colors));
                for($x=0;$x<count($tempcolors);$x++){
                    if($x>0){$colorSql .=" OR ";}
                    $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
                }
                $products->whereRaw('('.$colorSql.')');
            }

            if(!empty($shapes)) {
                $shapeSql = '';
                $tempshapes= explode(',', strtoupper($shapes));
                for($x=0;$x<count($tempshapes);$x++){
                    if($x>0){$shapeSql .=" OR ";}
                    $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
                }
                $products->whereRaw('('.$shapeSql.')');
            }

            if(!empty($makes)) {
                $makeSql = '';
                $tempmakes= explode(',', strtoupper($makes));
                for($x=0;$x<count($tempmakes);$x++){
                    if($x>0){$makeSql .=" OR ";}
                    $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
                }
                $products->whereRaw('('.$makeSql.')');
            }

            if(!empty($gender)) {
                $genderSql = '';
                $tempgender= explode(',', strtoupper($gender));
                for($x=0;$x<count($tempgender);$x++){
                    if($x>0){$genderSql .=" OR ";}
                    $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
                }
                $products->whereRaw('('.$genderSql.')');
            }

            if(!empty($frametype)) {
                $frametypeSql = '';
                $tempframetype= explode(',', strtoupper($frametype));
                for($x=0;$x<count($tempframetype);$x++){
                    if($x>0){$frametypeSql .=" OR ";}
                    $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
                }
                $products->whereRaw('('.$frametypeSql.')');
            }
            if(!empty($framematerial)) {
                $framematerialSql = '';
                $tempframematerial= explode(',', strtoupper($framematerial));
                for($x=0;$x<count($tempframematerial);$x++){
                    if($x>0){$framematerialSql .=" OR ";}
                    $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
                }
                $products->whereRaw('('.$framematerialSql.')');
            }
            if(!empty($framecolor)) {
                $framecolorSql = '';
                $tempframecolor= explode(',', strtoupper($framecolor));
                for($x=0;$x<count($tempframecolor);$x++){
                    if($x>0){$framecolorSql .=" OR ";}
                    $framecolorSql .=" FIND_IN_SET('".$tempframecolor[$x]."',framecolor)";
                }
                $products->whereRaw('('.$framecolorSql.')');
            }
            if(!empty($lenscolor)) {
                $lenscolorSql = '';
                $templenscolor= explode(',', strtoupper($lenscolor));
                for($x=0;$x<count($templenscolor);$x++){
                    if($x>0){$lenscolorSql .=" OR ";}
                    $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
                }
                $products->whereRaw('('.$lenscolorSql.')');
            }
            if(!empty($size)) {
                $sizeSql = '';
                $tempsize= explode(',', strtoupper($size));
                for($x=0;$x<count($tempsize);$x++){
                    if($x>0){$sizeSql .=" OR ";}
                    $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
                }
                $products->whereRaw('('.$sizeSql.')');
            }

            if(!empty($brandname)) {
                $brandnameSql = '';
                $tempbrandname= explode(',', strtoupper($brandname));
                for($x=0;$x<count($tempbrandname);$x++){
                    if($x>0){$brandnameSql .=" OR ";}
                    $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
                }
                $products->whereRaw('('.$brandnameSql.')');
            }

            if(!empty($lenstype)) {
                $lenstypeSql = '';
                $templenstype= explode(',', strtoupper($lenstype));
                for($x=0;$x<count($templenstype);$x++){
                    if($x>0){$lenstypeSql .=" OR ";}
                    $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
                }
                $products->whereRaw('('.$lenstypeSql.')');
            }

            if(!empty($disposability)) {
                $disposabilitySql = '';
                $tempdisposability= explode(',', strtoupper($disposability));
                for($x=0;$x<count($tempdisposability);$x++){
                    if($x>0){$disposabilitySql .=" OR ";}
                    $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
                }
                $products->whereRaw('('.$disposabilitySql.')');
            }

            if(!empty($packaging)) {
                $packagingSql = '';
                $temppackaging= explode(',', strtoupper($packaging));
                for($x=0;$x<count($temppackaging);$x++){
                    if($x>0){$packagingSql .=" OR ";}
                    $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
                }
                $products->whereRaw('('.$packagingSql.')');
            }

            if(!empty($lensmaterialtype)) {
                $lensmaterialtypeSql = '';
                $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
                for($x=0;$x<count($templensmaterialtype);$x++){
                    if($x>0){$lensmaterialtypeSql .=" OR ";}
                    $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
                }
                $products->whereRaw('('.$lensmaterialtypeSql.')');
            }

            if(!empty($lenstechnology)) {
                $lenstechnologySql = '';
                $templenstechnology= explode(',', strtoupper($lenstechnology));
                for($x=0;$x<count($templenstechnology);$x++){
                    if($x>0){$lenstechnologySql .=" OR ";}
                    $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
                }
                $products->whereRaw('('.$lenstechnologySql.')');
            }

            if(!empty($lensindex)) {
                $lensindexSql = '';
                $templensindex= explode(',', strtoupper($lensindex));
                for($x=0;$x<count($templensindex);$x++){
                    if($x>0){$lensindexSql .=" OR ";}
                    $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
                }
                $products->whereRaw('('.$lensindexSql.')');
            }

            if(!empty($visioneffect)) {
                $visioneffectSql = '';
                $tempvisioneffect= explode(',', strtoupper($visioneffect));
                for($x=0;$x<count($tempvisioneffect);$x++){
                    if($x>0){$visioneffectSql .=" OR ";}
                    $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
                }
                $products->whereRaw('('.$visioneffectSql.')');
            }

            if(!empty($netquntity)) {
                $netquntitySql = '';
                $tempnetquntity= explode(',', strtoupper($netquntity));
                for($x=0;$x<count($tempnetquntity);$x++){
                    if($x>0){$netquntitySql .=" OR ";}
                    $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
                }
                $products->whereRaw('('.$netquntitySql.')');
            }

            if(!empty($premiumtype)) {
                $premiumtypeSql = '';
                $temppremiumtype= explode(',', strtoupper($premiumtype));
                for($x=0;$x<count($temppremiumtype);$x++){
                    if($x>0){$premiumtypeSql .=" OR ";}
                    $premiumtypeSql .=" FIND_IN_SET('".$temppremiumtype[$x]."',premiumtype)";
                }
                $products->whereRaw('('.$premiumtypeSql.')');
            }

            if(!empty($coating)) {
                $coatingSql = '';
                $tempcoating = explode(',', strtoupper($coating));
                for($x=0;$x<count($tempcoating);$x++){
                    if($x>0){$coatingSql .=" OR ";}
                    $coatingSql .=" FIND_IN_SET('".$tempcoating[$x]."',coating)";
                }
                $products->whereRaw('('.$coatingSql.')');
            }
            
            if(!empty($radd)) {
                $raddSql = " FIND_IN_SET('".$radd."',addpowerlens)";
                $products->whereRaw('('.$raddSql.')');
            }
            
            if(!empty($rsph)) {
                $rsphSql = " FIND_IN_SET('".$rsph."',sphere)";
                $products->whereRaw('('.$rsphSql.')');
            }
            
            if(!empty($raxis)) {
                $raxisSql = " FIND_IN_SET('".$raxis."',axisnlens)";
                $products->whereRaw('('.$raxisSql.')');
            }
            
            if(!empty($rcyl)) {
                $rcylSql = " FIND_IN_SET('".$rcyl."',cylinderlens)";
                $products->whereRaw('('.$rcylSql.')');
            }
            
            if(!empty($rdia)) {
                $rdiaSql = " FIND_IN_SET('".$rdia."',diameterlens)";
                $products->whereRaw('('.$rdiaSql.')');
            }
            
            if(!empty($ldia)) {
                $ldiaSql = " FIND_IN_SET('".$ladd."',diameterlens)";
                $products->whereRaw('('.$ldiaSql.')');
            }
            
            if(!empty($lsph)) {
                $lsphSql = " FIND_IN_SET('".$lsph."',sphere)";
                $products->whereRaw('('.$lsphSql.')');
            }
            
            if(!empty($laxis)) {
                $laxisSql = " FIND_IN_SET('".$laxis."',axisnlens)";
                $products->whereRaw('('.$laxisSql.')');
            }
            
            if(!empty($lcyl)) {
                $lcylSql = " FIND_IN_SET('".$lcyl."',cylinderlens)";
                $products->whereRaw('('.$lcylSql.')');
            }
           
            $products= $products->take(9)->get();
        }
        
        if(isset($_GET) && !empty($_GET)){
            $search_type = $_GET;   
        return view('categoryproduct', compact('cat', 'products', 'frame_color', 'frame_material', 'frame_shape', 'user_profiles', 'lensmaterial', 'left_pd','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial', 'framecolor', 'lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'premiumtype', 'coating', 'search_type', 'brands', 'netQuentities', 'lenscolors', 'lens_coating', 'disposabilities', 'contactlens_packaging'));
        }else{   
        return view('categoryproduct', compact('cat', 'products', 'frame_color', 'frame_material', 'frame_shape', 'user_profiles','lensmaterial', 'left_pd','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial', 'framecolor', 'lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'premiumtype', 'coating', 'brands', 'netQuentities', 'lenscolors', 'lens_coating', 'disposabilities', 'contactlens_packaging'));
        }
    }
    
    public function catproductnew($id) {
        $user_profiles = '';
        if(Auth::guard('profile')->check()){
            $user = UserProfile::find(Auth::guard('profile')->user()->id);
            $user1=$user->id;
            $user_profiles= DB::table('user_profiles')->select('*')->where('id',$user1)->first();
        }
        DB::enableQueryLog();
        $left_pd = DB::table('pd_table')->get();
        $frame_color = DB::table('frame_color')->where('status', 1)->get();
        $frame_material = DB::table('frame_material')->get();
        $frame_shape = DB::table('frame_shape')->get();
        $netQuentities = DB::table('net_quantity')->where('status', 1)->get();
        $lenscolors = DB::table('lens_color')->where('status', 1)->get();
        $lensmaterial  = DB::table('lens_material')->where('status','1')->orderBy('id','desc')->get();
        $lens_coating  = DB::table('lens_coating')->where('status','1')->get();
        $disposabilities  = DB::table('disposability')->where('status','1')->get();
        $contactlens_packaging= DB::table('contactlens_packeging')->get()->toarray();
        
        $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $coating = $framecolor = $radd = $rsph = $raxis = $rcyl = $ladd = $lsph = $laxis = $lcyl = $ldia = $rdia = $netquntity = $premiumtype = "";
        $min = "0";
        $max = "500";
        $mins = "0";
        $maxs = "500";
        
        if (!empty(trim(request()->colors))) {
            $colors = request()->colors;
        }
        if (!empty(trim(request()->shapes))) {
            $shapes = request()->shapes;
        }
        if (!empty(trim(request()->makes))) {
            $makes = request()->makes;
        }
        if (!empty(trim(request()->gender))) {
            $gender = request()->gender;
        }
        
        if (!empty(trim(request()->frametype))) {
            $frametype = request()->frametype;
        }
        if (!empty(trim(request()->framematerial))) {
            $framematerial = request()->framematerial;
        }
        if (!empty(trim(request()->framecolor))) {
            $framecolor = request()->framecolor;
        }
        if (!empty(trim(request()->lenscolor))) {
            $lenscolor = request()->lenscolor;
        }
        if (!empty(trim(request()->size))) {
            $size = request()->size;
        } 
        if (!empty(trim(request()->brandname))) {
            $brandname = request()->brandname;
        }
        if (!empty(trim(request()->lenstype))) {
            $lenstype = request()->lenstype;
        }
        if (!empty(trim(request()->disposability))) {
            $disposability = request()->disposability;
        }
        if (!empty(trim(request()->packaging))) {
            $packaging = request()->packaging;
        }

         if (!empty(trim(request()->lensmaterialtype))) {
            $lensmaterialtype = request()->lensmaterialtype;
        }

         if (!empty(trim(request()->lenstechnology))) {
            $lenstechnology = request()->lenstechnology;
        }

         if (!empty(trim(request()->lensindex))) {
            $lensindex = request()->lensindex;
        }

        if (!empty(trim(request()->visioneffect))) {
            $visioneffect = request()->visioneffect;
        }

        if (!empty(trim(request()->netquntity))) {
            $netquntity = request()->netquntity;
        }

        if (!empty(trim(request()->premiumtype))) {
            $premiumtype = request()->premiumtype;
        }

        if (!empty(trim(request()->coating))) {
            $coating = request()->coating;
        }

        if (!empty(trim(request()->radd))) {
            $radd = request()->radd;
        }

        if (!empty(trim(request()->rsph))) {
            $rsph = (float) request()->rsph;
        }

        if (!empty(trim(request()->rcyl))) {
            $rcyl = (float) request()->rcyl;
        }

        if (!empty(trim(request()->raxis))) {
            $raxis = request()->raxis;
        }

        if (!empty(trim(request()->ladd))) {
            $ladd = request()->ladd;
            
        }

        if (!empty(trim(request()->lsph))) {
            $lsph = (float) request()->lsph;
        }

        if (!empty(trim(request()->lcyl))) {
            $lcyl = (float) request()->lcyl;
        }

        if (!empty(trim(request()->laxis))) {
            $laxis = request()->laxis;
        }

        if (!empty(trim(request()->ldia))) {
            $ldia = request()->ldia;
        }

        if (!empty(trim(request()->rdia))) {
            $rdia = request()->rdia;
        }
    
        if (Input::get('sort') != "") {
            $sort = Input::get('sort');
        }
        if (Input::get('min') != "") {
            $min = Product::Filter(Input::get('min'));
            $mins = Input::get('min');
            $sort = "price";
        }
        if (Input::get('max') != "") {
            $max = Product::Filter(Input::get('max'));
            $maxs = Input::get('max');
            $sort = "price";
        }
        $maxvalue = $products = Product::where('status','1')->max('price');
        $category = Category::where('id',$id)->first();

        $cat = $category->mainid->id;

        $brands = DB::table('brand_name')->where('category_id', $category->mainid->id)->where('status', 1)->get();
        
        if ($category === null) {
            $category['name'] = "Nothing Found";
            $products = new \stdClass();
        }else{
            if ($sort=="old") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('created_at','desc');
            }elseif ($sort=="new") {
                $products = Product::where('status','1')->where('category', $category->mainid->id)->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
                ->orderBy('created_at','desc');
            }elseif ($sort=="low") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','desc');
            }elseif ($sort=="high") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','desc');
            }elseif ($sort=="price") {
                $products = Product::where('status','1')
                    ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->whereBetween('price', [$min, $max])
                    ->orderBy('price','desc');
            }else{
                $products = Product::select('*')
                    ->where('category', $category->mainid->id)
                    ->where('childid','LIKE','%'.$id.'%')
                    ->where('status', 1)
                    ->orderBy('created_at','desc');
            }
            if(!empty($colors)) {
                $colorSql = '';
                $tempcolors = explode(',', strtoupper($colors));
                for($x=0;$x<count($tempcolors);$x++){
                    if($x>0){$colorSql .=" OR ";}
                    $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
                }
                $products->whereRaw('('.$colorSql.')');
            }
    
            if(!empty($shapes)) {
                $shapeSql = '';
                $tempshapes= explode(',', strtoupper($shapes));
                for($x=0;$x<count($tempshapes);$x++){
                    if($x>0){$shapeSql .=" OR ";}
                    $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
                }
                $products->whereRaw('('.$shapeSql.')');
            }
    
            if(!empty($makes)) {
                $makeSql = '';
                $tempmakes= explode(',', strtoupper($makes));
                for($x=0;$x<count($tempmakes);$x++){
                    if($x>0){$makeSql .=" OR ";}
                    $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
                }
                $products->whereRaw('('.$makeSql.')');
            }
    
            if(!empty($gender)) {
                $genderSql = '';
                $tempgender= explode(',', strtoupper($gender));
                for($x=0;$x<count($tempgender);$x++){
                    if($x>0){$genderSql .=" OR ";}
                    $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
                }
                $products->whereRaw('('.$genderSql.')');
            }

            if(!empty($frametype)) {
                $frametypeSql = '';
                $tempframetype= explode(',', strtoupper($frametype));
                for($x=0;$x<count($tempframetype);$x++){
                    if($x>0){$frametypeSql .=" OR ";}
                    $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
                }
                $products->whereRaw('('.$frametypeSql.')');
            }

            if(!empty($framematerial)) {
                $framematerialSql = '';
                $tempframematerial= explode(',', strtoupper($framematerial));
                for($x=0;$x<count($tempframematerial);$x++){
                    if($x>0){$framematerialSql .=" OR ";}
                    $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
                }
                $products->whereRaw('('.$framematerialSql.')');
            }

            if(!empty($framecolor)) {
                $framecolorSql = '';
                $tempframecolor= explode(',', strtoupper($framecolor));
                for($x=0;$x<count($tempframecolor);$x++){
                    if($x>0){$framecolorSql .=" OR ";}
                    $framecolorSql .=" FIND_IN_SET('".$tempframecolor[$x]."',framecolor)";
                }
                $products->whereRaw('('.$framecolorSql.')');
            }

            if(!empty($lenscolor)) {
                $lenscolorSql = '';
                $templenscolor= explode(',', strtoupper($lenscolor));
                for($x=0;$x<count($templenscolor);$x++){
                    if($x>0){$lenscolorSql .=" OR ";}
                    $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
                }
                $products->whereRaw('('.$lenscolorSql.')');
            }

            if(!empty($size)) {
                $sizeSql = '';
                $tempsize= explode(',', strtoupper($size));
                for($x=0;$x<count($tempsize);$x++){
                    if($x>0){$sizeSql .=" OR ";}
                    $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
                }
                $products->whereRaw('('.$sizeSql.')');
            }

            if(!empty($brandname)) {
                $brandnameSql = '';
                $tempbrandname= explode(',', strtoupper($brandname));
                for($x=0;$x<count($tempbrandname);$x++){
                    if($x>0){$brandnameSql .=" OR ";}
                    $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
                }
                $products->whereRaw('('.$brandnameSql.')');
            }

            if(!empty($lenstype)) {
                $lenstypeSql = '';
                $templenstype= explode(',', strtoupper($lenstype));
                for($x=0;$x<count($templenstype);$x++){
                    if($x>0){$lenstypeSql .=" OR ";}
                    $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
                }
                $products->whereRaw('('.$lenstypeSql.')');
            }

            if(!empty($disposability)) {
                $disposabilitySql = '';
                $tempdisposability= explode(',', strtoupper($disposability));
                for($x=0;$x<count($tempdisposability);$x++){
                    if($x>0){$disposabilitySql .=" OR ";}
                    $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
                }
                $products->whereRaw('('.$disposabilitySql.')');
            }

            if(!empty($packaging)) {
                $packagingSql = '';
                $temppackaging= explode(',', strtoupper($packaging));
                for($x=0;$x<count($temppackaging);$x++){
                    if($x>0){$packagingSql .=" OR ";}
                    $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
                }
                $products->whereRaw('('.$packagingSql.')');
            }

            if(!empty($lensmaterialtype)) {
                $lensmaterialtypeSql = '';
                $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
                for($x=0;$x<count($templensmaterialtype);$x++){
                    if($x>0){$lensmaterialtypeSql .=" OR ";}
                    $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
                }
                $products->whereRaw('('.$lensmaterialtypeSql.')');
            }

            if(!empty($lenstechnology)) {
                $lenstechnologySql = '';
                $templenstechnology= explode(',', strtoupper($lenstechnology));
                for($x=0;$x<count($templenstechnology);$x++){
                    if($x>0){$lenstechnologySql .=" OR ";}
                    $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
                }
                $products->whereRaw('('.$lenstechnologySql.')');
            }

            if(!empty($lensindex)) {
                $lensindexSql = '';
                $templensindex= explode(',', strtoupper($lensindex));
                for($x=0;$x<count($templensindex);$x++){
                    if($x>0){$lensindexSql .=" OR ";}
                    $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
                }
                $products->whereRaw('('.$lensindexSql.')');
            }

            if(!empty($visioneffect)) {
                $visioneffectSql = '';
                $tempvisioneffect= explode(',', strtoupper($visioneffect));
                for($x=0;$x<count($tempvisioneffect);$x++){
                    if($x>0){$visioneffectSql .=" OR ";}
                    $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
                }
                $products->whereRaw('('.$visioneffectSql.')');
            }

            if(!empty($netquntity)) {
                $netquntitySql = '';
                $tempnetquntity= explode(',', strtoupper($netquntity));
                for($x=0;$x<count($tempnetquntity);$x++){
                    if($x>0){$netquntitySql .=" OR ";}
                    $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
                }
                $products->whereRaw('('.$netquntitySql.')');
            }

            if(!empty($premiumtype)) {
                $premiumtypeSql = '';
                $temppremiumtype= explode(',', strtoupper($premiumtype));
                for($x=0;$x<count($temppremiumtype);$x++){
                    if($x>0){$premiumtypeSql .=" OR ";}
                    $premiumtypeSql .=" FIND_IN_SET('".$temppremiumtype[$x]."',premiumtype)";
                }
                $products->whereRaw('('.$premiumtypeSql.')');
            }

            if(!empty($coating)) {
                $coatingSql = '';
                $tempcoating= explode(',', strtoupper($coating));
                for($x=0;$x<count($tempcoating);$x++){
                    if($x>0){$coatingSql .=" OR ";}
                    $coatingSql .=" FIND_IN_SET('".$tempcoating[$x]."',coating)";
                }
                $products->whereRaw('('.$coatingSql.')');
            }
            
            if(!empty($radd)) {
                $raddSql = " FIND_IN_SET('".$radd."',addpowerlens)";
                $products->whereRaw('('.$raddSql.')');
            }
            
            if(!empty($rsph)) {
                $rsphSql = " FIND_IN_SET('".$rsph."',sphere)";
                $products->whereRaw('('.$rsphSql.')');
            }
            
            if(!empty($raxis)) {
                $raxisSql = " FIND_IN_SET('".$raxis."',axisnlens)";
                $products->whereRaw('('.$raxisSql.')');
            }
            
            if(!empty($rcyl)) {
                $rcylSql = " FIND_IN_SET('".$rcyl."',cylinderlens)";
                $products->whereRaw('('.$rcylSql.')');
            }
            
            if(!empty($rdia)) {
                $rdiaSql = " FIND_IN_SET('".$rdia."',diameterlens)";
                $products->whereRaw('('.$rdiaSql.')');
            }
            
            if(!empty($ldia)) {
                $ldiaSql = " FIND_IN_SET('".$ladd."',diameterlens)";
                $products->whereRaw('('.$ldiaSql.')');
            }
            
            if(!empty($lsph)) {
                $lsphSql = " FIND_IN_SET('".$lsph."',sphere)";
                $products->whereRaw('('.$lsphSql.')');
            }
            
            if(!empty($laxis)) {
                $laxisSql = " FIND_IN_SET('".$laxis."',axisnlens)";
                $products->whereRaw('('.$laxisSql.')');
            }
            
            if(!empty($lcyl)) {
                $lcylSql = " FIND_IN_SET('".$lcyl."',cylinderlens)";
                $products->whereRaw('('.$lcylSql.')');
            }
           
            $products = $products->take(9)->get();
        }

        if(isset($_GET) && !empty($_GET)){
            $search_type = $_GET;  
            return view('categoryproduct', compact('cat', 'products', 'framecolor', 'frame_color','frame_material','frame_shape','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'premiumtype', 'coating', 'search_type', 'brands', 'netQuentities', 'lenscolors', 'lens_coating', 'disposabilities', 'contactlens_packaging'));
        }else{
            return view('categoryproduct', compact('cat', 'products', 'framecolor', 'frame_color','frame_material','frame_shape','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect', 'netquntity', 'premiumtype', 'coating', 'brands', 'netQuentities', 'lenscolors', 'lens_coating', 'disposabilities', 'contactlens_packaging'));
        }
        
        // return view('categoryproduct', compact('products','lensmaterial','left_pd','category','sort','mins','user_profiles','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect'));
    }
  
    //Load More Category Products
    public function loadcatproduct($slug,$page) {
        DB::enableQueryLog();
        $language = SiteLanguage::find(1);
        $settings = Settings::find(1);
        $res = "";
        $min = "0";
        $max = "500";
        $mins = "0";
        $maxs = "500";
        $skip = ($page-1)*9;

        $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = $framecolor = $coating = $radd = $rsph = $raxis = $rcyl = $ladd = $lsph = $laxis = $lcyl = $ldia = $rdia = $netquntity = $premiumtype = "";
        
        if (!empty(trim(request()->colors))) {
            $colors = request()->colors;
        }
        if (!empty(trim(request()->shapes))) {
            $shapes = request()->shapes;
        }
        if (!empty(trim(request()->makes))) {
            $makes = request()->makes;
        }
        if (!empty(trim(request()->gender))) {
            $gender = request()->gender;
        }
        if (!empty(trim(request()->frametype))) {
            $frametype = request()->frametype;
        }
        if (!empty(trim(request()->framematerial))) {
            $framematerial = request()->framematerial;
        }
        if (!empty(trim(request()->framecolor))) {
            $framecolor = request()->framecolor;
        }
        if (!empty(trim(request()->lenscolor))) {
            $lenscolor = request()->lenscolor;
        }
        if (!empty(trim(request()->size))) {
            $size = request()->size;
        }
        if (!empty(trim(request()->brandname))) {
            $brandname = request()->brandname;
        }
        if (!empty(trim(request()->lenstype))) {
            $lenstype = request()->lenstype;
        }
        if (!empty(trim(request()->disposability))) {
            $disposability = request()->disposability;
        }
        if (!empty(trim(request()->packaging))) {
            $packaging = request()->packaging;
        }

        if (!empty(trim(request()->lensmaterialtype))) {
            $lensmaterialtype = request()->lensmaterialtype;
        }

        if (!empty(trim(request()->lenstechnology))) {
            $lenstechnology = request()->lenstechnology;
        }

        if (!empty(trim(request()->lensindex))) {
            $lensindex = request()->lensindex;
        }

        if (!empty(trim(request()->visioneffect))) {
            $visioneffect = request()->visioneffect;
        }

        if (!empty(trim(request()->netquntity))) {
            $netquntity = request()->netquntity;
        }

        if (!empty(trim(request()->premiumtype))) {
            $premiumtype = request()->premiumtype;
        }

        if (!empty(trim(request()->coating))) {
            $coating = request()->coating;
        }

        if (!empty(trim(request()->radd))) {
            $radd = request()->radd;
        }

        if (!empty(trim(request()->rsph))) {
            $rsph = (float) request()->rsph;
        }

        if (!empty(trim(request()->rcyl))) {
            $rcyl = (float) request()->rcyl;
        }

        if (!empty(trim(request()->raxis))) {
            $raxis = request()->raxis;
        }

        if (!empty(trim(request()->ladd))) {
            $ladd = request()->ladd;
            
        }

        if (!empty(trim(request()->lsph))) {
            $lsph = (float) request()->lsph;
        }

        if (!empty(trim(request()->lcyl))) {
            $lcyl = (float) request()->lcyl;
        }

        if (!empty(trim(request()->laxis))) {
            $laxis = request()->laxis;
        }

        if (!empty(trim(request()->ldia))) {
            $ldia = request()->ldia;
        }

        if (!empty(trim(request()->rdia))) {
            $rdia = request()->rdia;
        }

        if (Input::get('sort') != "") {
            $sort = Input::get('sort');
        }

        if (Input::get('min') != "") {
            $min = Product::Filter(Input::get('min'));
            $mins = Input::get('min');
            $sort = "price";
        }
        if (Input::get('max') != "") {
            $max = Product::Filter(Input::get('max'));
            $maxs = Input::get('max');
            $sort = "price";
        }
        $category = Category::where('slug',$slug)->first();
        
        if ($category === null) {
            $category['name'] = "Nothing Found";
            $products = new \stdClass();
        }else{
            if ($sort=="old") {                
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('created_at','desc');
            }elseif ($sort=="new") {
                if($category->role == 'sub'){
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
                    ->orderBy('created_at','desc');
                }
                elseif($category->role == 'child'){
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
                    ->orderBy('created_at','desc');
                }
                else{
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->orderBy('created_at','desc');
                }
            }elseif ($sort=="low") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','desc');
            }elseif ($sort=="high") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','desc');
            }elseif ($sort=="price") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->whereBetween('price', [$min, $max])->orderBy('price','desc');
            }else{
                if($category->role == 'sub'){
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,subid)', [$category->id])
                    ->orderBy('created_at','desc');
                }
                elseif($category->role == 'child'){
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,childid)', [$category->id])
                    ->orderBy('created_at','desc');
                }
                else{
                    $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->orderBy('created_at','desc');
                }
            }
            if(!empty($colors)) {
                $colorSql = '';
                $tempcolors = explode(',', strtoupper($colors));
                for($x=0;$x<count($tempcolors);$x++){
                    if($x>0){$colorSql .=" OR ";}
                    $colorSql .=" FIND_IN_SET('".$tempcolors[$x]."',color)";
                }
                $products->whereRaw('('.$colorSql.')');
            }

            if(!empty($shapes)) {
                $shapeSql = '';
                $tempshapes= explode(',', strtoupper($shapes));
                for($x=0;$x<count($tempshapes);$x++){
                    if($x>0){$shapeSql .=" OR ";}
                    $shapeSql .=" FIND_IN_SET('".$tempshapes[$x]."',shape)";
                }
                $products->whereRaw('('.$shapeSql.')');
            }

            if(!empty($makes)) {
                $makeSql = '';
                $tempmakes= explode(',', strtoupper($makes));
                for($x=0;$x<count($tempmakes);$x++){
                    if($x>0){$makeSql .=" OR ";}
                    $makeSql .=" FIND_IN_SET('".$tempmakes[$x]."',make)";
                }
                $products->whereRaw('('.$makeSql.')');
            }

            if(!empty($gender)) {
                $genderSql = '';
                $tempgender= explode(',', strtoupper($gender));
                for($x=0;$x<count($tempgender);$x++){
                    if($x>0){$genderSql .=" OR ";}
                    $genderSql .=" FIND_IN_SET('".$tempgender[$x]."',gender)";
                }
                $products->whereRaw('('.$genderSql.')');
            }

            if(!empty($frametype)) {
                $frametypeSql = '';
                $tempframetype= explode(',', strtoupper($frametype));
                for($x=0;$x<count($tempframetype);$x++){
                    if($x>0){$frametypeSql .=" OR ";}
                    $frametypeSql .=" FIND_IN_SET('".$tempframetype[$x]."',frametype)";
                }
                $products->whereRaw('('.$frametypeSql.')');
            }

            if(!empty($framematerial)) {
                $framematerialSql = '';
                $tempframematerial= explode(',', strtoupper($framematerial));
                for($x=0;$x<count($tempframematerial);$x++){
                    if($x>0){$framematerialSql .=" OR ";}
                    $framematerialSql .=" FIND_IN_SET('".$tempframematerial[$x]."',framematerial)";
                }
                $products->whereRaw('('.$framematerialSql.')');
            }

            if(!empty($framecolor)) {
                $framecolorSql = '';
                $tempframecolor= explode(',', strtoupper($framecolor));
                for($x=0;$x<count($tempframecolor);$x++){
                    if($x>0){$framecolorSql .=" OR ";}
                    $framecolorSql .=" FIND_IN_SET('".$tempframecolor[$x]."',framecolor)";
                }
                $products->whereRaw('('.$framecolorSql.')');
            }
            
            if(!empty($lenscolor)) {
                $lenscolorSql = '';
                $templenscolor= explode(',', strtoupper($lenscolor));
                for($x=0;$x<count($templenscolor);$x++){
                    if($x>0){$lenscolorSql .=" OR ";}
                    $lenscolorSql .=" FIND_IN_SET('".$templenscolor[$x]."',lenscolor)";
                }
                $products->whereRaw('('.$lenscolorSql.')');
            }

            if(!empty($size)) {
                $sizeSql = '';
                $tempsize= explode(',', strtoupper($size));
                for($x=0;$x<count($tempsize);$x++){
                    if($x>0){$sizeSql .=" OR ";}
                    $sizeSql .=" FIND_IN_SET('".$tempsize[$x]."',sizes)";
                }
                $products->whereRaw('('.$sizeSql.')');
            }

            if(!empty($brandname)) {
                $brandnameSql = '';
                $tempbrandname= explode(',', strtoupper($brandname));
                for($x=0;$x<count($tempbrandname);$x++){
                    if($x>0){$brandnameSql .=" OR ";}
                    $brandnameSql .=" FIND_IN_SET('".$tempbrandname[$x]."',brandname)";
                }
                $products->whereRaw('('.$brandnameSql.')');
            }

            if(!empty($lenstype)) {
                $lenstypeSql = '';
                $templenstype= explode(',', strtoupper($lenstype));
                for($x=0;$x<count($templenstype);$x++){
                    if($x>0){$lenstypeSql .=" OR ";}
                    $lenstypeSql .=" FIND_IN_SET('".$templenstype[$x]."',lenstype)";
                }
                $products->whereRaw('('.$lenstypeSql.')');
            }

            if(!empty($disposability)) {
                $disposabilitySql = '';
                $tempdisposability= explode(',', strtoupper($disposability));
                for($x=0;$x<count($tempdisposability);$x++){
                    if($x>0){$disposabilitySql .=" OR ";}
                    $disposabilitySql .=" FIND_IN_SET('".$tempdisposability[$x]."',disposability)";
                }
                $products->whereRaw('('.$disposabilitySql.')');
            }

            if(!empty($packaging)) {
                $packagingSql = '';
                $temppackaging= explode(',', strtoupper($packaging));
                for($x=0;$x<count($temppackaging);$x++){
                    if($x>0){$packagingSql .=" OR ";}
                    $packagingSql .=" FIND_IN_SET('".$temppackaging[$x]."',packaging)";
                }
                $products->whereRaw('('.$packagingSql.')');
            }

             if(!empty($lensmaterialtype)) {
                $lensmaterialtypeSql = '';
                $templensmaterialtype= explode(',', strtoupper($lensmaterialtype));
                for($x=0;$x<count($templensmaterialtype);$x++){
                    if($x>0){$lensmaterialtypeSql .=" OR ";}
                    $lensmaterialtypeSql .=" FIND_IN_SET('".$templensmaterialtype[$x]."',lensmaterialtype)";
                }
                $products->whereRaw('('.$lensmaterialtypeSql.')');
            }

            if(!empty($lenstechnology)) {
                $lenstechnologySql = '';
                $templenstechnology= explode(',', strtoupper($lenstechnology));
                for($x=0;$x<count($templenstechnology);$x++){
                    if($x>0){$lenstechnologySql .=" OR ";}
                    $lenstechnologySql .=" FIND_IN_SET('".$templenstechnology[$x]."',lenstechnology)";
                }
                $products->whereRaw('('.$lenstechnologySql.')');
            }

            if(!empty($lensindex)) {
                $lensindexSql = '';
                $templensindex= explode(',', strtoupper($lensindex));
                for($x=0;$x<count($templensindex);$x++){
                    if($x>0){$lensindexSql .=" OR ";}
                    $lensindexSql .=" FIND_IN_SET('".$templensindex[$x]."',lensindex)";
                }
                $products->whereRaw('('.$lensindexSql.')');
            }

            if(!empty($visioneffect)) {
                $visioneffectSql = '';
                $tempvisioneffect= explode(',', strtoupper($visioneffect));
                for($x=0;$x<count($tempvisioneffect);$x++){
                    if($x>0){$visioneffectSql .=" OR ";}
                    $visioneffectSql .=" FIND_IN_SET('".$tempvisioneffect[$x]."',visioneffect)";
                }
                $products->whereRaw('('.$visioneffectSql.')');
            }

            if(!empty($netquntity)) {
                $netquntitySql = '';
                $tempnetquntity= explode(',', strtoupper($netquntity));
                for($x=0;$x<count($tempnetquntity);$x++){
                    if($x>0){$netquntitySql .=" OR ";}
                    $netquntitySql .=" FIND_IN_SET('".$tempnetquntity[$x]."',netquntity)";
                }
                $products->whereRaw('('.$netquntitySql.')');
            }

            if(!empty($premiumtype)) {
                $premiumtypeSql = '';
                $temppremiumtype= explode(',', strtoupper($premiumtype));
                for($x=0;$x<count($temppremiumtype);$x++){
                    if($x>0){$premiumtypeSql .=" OR ";}
                    $premiumtypeSql .=" FIND_IN_SET('".$temppremiumtype[$x]."',premiumtype)";
                }
                $products->whereRaw('('.$premiumtypeSql.')');
            }

            if(!empty($coating)) {
                $coatingSql = '';
                $tempcoating= explode(',', strtoupper($coating));
                for($x=0;$x<count($tempcoating);$x++){
                    if($x>0){$coatingSql .=" OR ";}
                    $coatingSql .=" FIND_IN_SET('".$tempcoating[$x]."',coating)";
                }
                $products->whereRaw('('.$coatingSql.')');
            }
            
            if(!empty($radd)) {
                $raddSql = " FIND_IN_SET('".$radd."',addpowerlens)";
                $products->whereRaw('('.$raddSql.')');
            }
            
            if(!empty($rsph)) {
                $rsphSql = " FIND_IN_SET('".$rsph."',sphere)";
                $products->whereRaw('('.$rsphSql.')');
            }
            
            if(!empty($raxis)) {
                $raxisSql = " FIND_IN_SET('".$raxis."',axisnlens)";
                $products->whereRaw('('.$raxisSql.')');
            }
            
            if(!empty($rcyl)) {
                $rcylSql = " FIND_IN_SET('".$rcyl."',cylinderlens)";
                $products->whereRaw('('.$rcylSql.')');
            }
            
            if(!empty($rdia)) {
                $rdiaSql = " FIND_IN_SET('".$rdia."',diameterlens)";
                $products->whereRaw('('.$rdiaSql.')');
            }
            
            if(!empty($ldia)) {
                $ldiaSql = " FIND_IN_SET('".$ladd."',diameterlens)";
                $products->whereRaw('('.$ldiaSql.')');
            }
            
            if(!empty($lsph)) {
                $lsphSql = " FIND_IN_SET('".$lsph."',sphere)";
                $products->whereRaw('('.$lsphSql.')');
            }
            
            if(!empty($laxis)) {
                $laxisSql = " FIND_IN_SET('".$laxis."',axisnlens)";
                $products->whereRaw('('.$laxisSql.')');
            }
            
            if(!empty($lcyl)) {
                $lcylSql = " FIND_IN_SET('".$lcyl."',cylinderlens)";
                $products->whereRaw('('.$lcylSql.')');
            }

            $products = $products->skip($skip)->take(9)->get();
            

            foreach($products as $product) {
                $res .= '
                        <style>
                            .image_latest_product_shubh {
                                text-align: center;
                                vertical-align: middle;
                                position: relative;
                                display: inline;
                                display: table-cell;
                                transition: transform 0.4s ease;
                            }
                            .image_latest_product_shubh .img-top {
                                /*padding : 40px 0px;*/
                                /*background : center center #fff;*/
                                display: none;
                                position: absolute;
                                /*display: table-cell;*/
                                vertical-align: middle;
                                top: 40px;
                                left: 0;
                                right : 0;
                                left : 0;
                                z-index: 9;
                            }
                        
                            .image_latest_product_shubh:hover .img-top {
                                display: flex;
                                margin : auto;
                                top: 0px;
                            }
                        </style>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 single_product">
                            <div class="single-product-carousel-item">
                                <div class="image_latest_product_shubh">
                                    <a href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank"> <img src="' . url('/assets/images/products') . '/' . $product->feature_image . '" alt="Product Image" /> </a>';
                                    $gallery = $product->gallery_images->toArray();
                                    if($gallery){
                                        $res .= '<a class="img-top" href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank"> <img src="' . url('/assets/images/gallery') . '/' . $gallery[0]['image'] . '" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>';
                                    }
                                    else
                                    {
                                       $res .= '<a class="img-top" href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank"> <img src="" src1="assets/images/subscription-form/subscibe_image.jpg" alt="Product Image" /> </a>';
                                    }
                        $res .= '</div>
                                <div class="product-carousel-text">
                                    <a href="' . url('/product') . '/' . $product->id . '/' . str_replace('/', '-', strtolower($product->title)) . '" target="_blank">
                                        <h4 class="product-title">' . $product->title . '</h4>
                                    </a>
                                    
                                    <div class="ratings">
                                        <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '" target="_blank"><div class="empty-stars"></div></a>
                                        <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '" target="_blank"><div class="full-stars" style="width:'.Review::ratings($product->id).'%"></div></a>
                                    </div>
                                    
                                    <div class="product-price"><del class="offer-pricenewone"><i  title ="Add to My site"class=" fa fa-share-alt" style="font-size:15px"></i></del>';
                                        if ($product->previous_price != "") {
                                            $res .= '<span class="original-price">' .$settings->currency_sign. $product->previous_price . '</span>';
                                        }
                                        if(Auth::guard('profile')->check()){
                                            if(Auth::guard('profile')->user()->costpriceshow == 'Yes'){
                                                $res .= '<del class="offer-pricenew"><a data-toggle="modal" data-target="#view_'.$product->id.'" ><i class="fa fa-eye" aria-hidden="true"></i> </a></del>';
                                            }
                                        }
                            $res .= '</div>
                                    <div class="product-meta-area">
                                        <a  href="javascript:;" class="wish-list" onclick="getQuickView('.$product->id.')" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>';
                        $res .= '
                            <div class="modal fade" id="view_'.$product->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Product Cost Price</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body" style="text-align:center;">';
                                        if($product->costprice == ''){
                                           $res .= '<h5>Product Cost Price:- 0</h5>';
                                        }else{
                                            $res .= '<h5>Product Cost Price:- '.$product->costprice.'</h5>';
                                        }
                                      $res .= '</div>
                                      <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        ';
            }

        }
        return $res;
    }
    
    //Load More Vendor Products
    public function loadvendproduct($id,$page)
    {
        $language = SiteLanguage::find(1);
        $settings = Settings::find(1);
        $res = "";
        $skip = ($page-1)*12;


        $products = Product::where('vendorid',$id)->where('status','1')
        ->orderBy('created_at','asc')
        ->skip($skip)
        ->take(12)
        ->get();

            foreach($products as $product) {
                $res .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="single-product-carousel-item text-center">
                                <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"> <img src="' . url('/assets/images/products') . '/' . $product->feature_image . '" alt="Product Image" /> </a>
                                <div class="product-carousel-text">
                                    <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '">
                                        <h4 class="product-title">' . $product->title . '</h4>
                                    </a>
                                    <div class="ratings">
                                        <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="empty-stars"></div></a>
                                        <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="full-stars" style="width:'.Review::ratings($product->id).'%"></div></a>
                                    </div>
                                    <div class="product-price">';
                if ($product->previous_price != "") {
                    $res .= '<span class="original-price">' .$settings->currency_sign. $product->previous_price . '</span>';
                }
                $res .= '
                                       
                                        <del class="offer-price">' .$settings->currency_sign. Product::Cost($product->id) . '</del>
                                    </div>
                                    <div class="product-meta-area">
                                        <form class="addtocart-form">';
                if (Session::has('uniqueid')) {
                    $res .= '<input type="hidden" name="uniqueid" value="' . Session::get('uniqueid') . '">';
                } else {
                    $res .= '<input type="hidden" name="uniqueid" value="' . str_random(7) . '">';
                }

                $res .= '
                                                            <input name="title" value="' . $product->title . '" type="hidden">
                                                            <input name="product" value="' . $product->id . '" type="hidden">
                                                            <input id="cost" name="cost" value="' . Product::Cost($product->id) . '" type="hidden">
                                                            <input id="quantity" name="quantity" value="1" type="hidden">';
                if ($product->stock != 0){
                    $res .='<button type="button" onclick="toCart(this)" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>'.$language->add_to_cart.'</span></button>';
                }else{
                    $res .='<button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>'.$language->out_of_stock.'</button>';
                }
                $res .=' 
                                            
                                        </form>
                                        <a  href="javascript:;" class="wish-list" onclick="getQuickView('.$product->id.')" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        return $res;
    }

    //Search Products
    public function searchproduct(Request $request, $search)
    {
        // print_r("Hello");die();
        $products = DB::table('products')
                ->select('*')
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('productsku',  $search)
                ->orWhere('modelno',  $search);
                })
            ->get();
            // echo "<pre>";
            // print_r($products);die();
        return view('searchproduct', compact('products','search'));
    }


    //Tags Products
    public function tagproduct($tag)
    {
       $products = Product::where('status','1')->where('tags', 'like', '%' . $tag . '%')
                ->get();
       return view('tagsproduct', compact('products','tag'));
    }


    public function cashondelivery(Request $request)
    {
        $settings = Settings::findOrFail(1);
        $order = new Order;
        $success_url = action('PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;

        $order['customerid'] = $request->customer;
        $order['cost'] = $request->cost;
    	$order['products'] = $request->products;
    	$order['quantities'] = $request->quantities;
    	$order['sizes'] = $request->sizes;
    	$order['pay_amount'] = $item_amount;
    	if($request->method == "Razorpay"){
    	    $order['method'] = "Razorpay";
    	}
    	else if($request->method == "Payment"){
    	    $order['method'] = "Payment Terms with in 90 Days Credit Period";
    	}
    	else{
    	    $order['method'] = "COD";
    	}
    	$order['booking_date'] = date('Y-m-d H:i:s');
    	$order['order_number'] = $item_number;
    	$order['shipping'] = $request->shipping;
    	$order['pickup_location'] = $request->pickup_location;
    	$order['customer_email'] = $request->email;
    	$order['customer_name'] = $request->name;
    	$order['customer_phone'] = $request->phone;
    	$order['customer_address'] = $request->address;
    	$order['customer_address2'] = $request->address2;
    	$order['customer_city'] = $request->city;
    	$order['customer_state'] = $request->state;
    	$order['customer_country'] = $request->country;
    	$order['customer_alt_phone'] = $request->alternate_phone;
    	$order['customer_zip'] = $request->zip;
    	$order['shipping_email'] = $request->shipping_email;
    	$order['shipping_name'] = $request->shipping_name;
    	$order['shipping_phone'] = $request->shipping_phone;
    	$order['shipping_address'] = $request->shipping_address;
    	$order['shipping_address2'] = $request->shipping_address2;
    	$order['shipping_city'] = $request->shipping_city;
    	$order['shipping_state'] = $request->shipping_state;
    	$order['shipping_country'] = $request->shipping_country;
    	$order['shipping_alternate_phone'] = $request->shipping_alternate_phone;
    	$order['shipping_zip'] = $request->shipping_zip;
    	$order['order_note'] = $request->order_note;
    	$order['couponAmount'] = $request->couponAmount;
    	$order['payment_status'] = "Pending";
        $order['buyer_order_id'] = $request->buyer_order_id;
        $order['seller_order_id'] = $request->seller_order_id;
    	
   
        $order->save();
        $orderid = $order->id;
        // new added code
        $ordernumber = $order->order_number;
        $buyer_name = $order->customer_name;
        $buyer_phone = $order->customer_phone;
        $buyer_address = $order->customer_address;
        $buyer_address2 = $order->customer_address2;
        $buyer_city = $order->customer_city;
        $buyer_state = $order->customer_state;
        $tomorrow = $order->booking_date;
        $tomorrownew = $order->booking_date;
        $customer_id_new = $order->customerid;
        $payment_method = $order->method;
	    $order_color = $request->color;

        $tomorrowdate = new DateTime($tomorrow);
        $datetomorrow = $tomorrowdate->modify('+1 day');

        $settelmentdate = $tomorrowdate->modify('+25 day');

        $aftertomorrow = new DateTime($tomorrownew);

        $dateaftertomorrow = $aftertomorrow->modify('+2 day');

        // end new added code
        $pdata = explode(',',$request->products);
        $qdata = explode(',',$request->quantities);
        $sdata = explode(',',$request->sizes);
        $color_data = explode(',',$request->color);
        $colorcode = explode(',',$request->colorcode);
        $maincolor_data = explode(',',$request->maincolor);
        $img_data = explode(',',$request->productImage);
        $cost_prc = explode(',', $request->cost);
        $premiumtype = explode(',', $request->premiumtype);
	    $categoryid = explode(',', $request->categoryID);
	    $productAttrId = explode(',', $request->productAttrId);
	    $gstAmount = explode(',', $request->gstAmount);
	    
        foreach ($pdata as $data => $product){
            $proorders = new OrderedProducts();
            if($productAttrId[$data] != ""){
                $productdata = ProductAttr::findOrFail($productAttrId[$data]);
                $stocks = $productdata->attr_qty - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['attr_qty'] = $stocks;
                $productdata->update($quant);
            }else{
                $productdat = Product::findOrFail($product);
                $stocks = $productdat->stock - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['stock'] = $stocks;
                $productdat->update($quant);
            }

            $productdet = Product::findOrFail($product);

            $proorders['orderid'] = $orderid;
            // new added code
            $proorders['order_number_new'] = $ordernumber;
            $proorders['categoryID'] = $categoryid[$data];
            $proorders['product_title'] = $productdet->title;
            $proorders['product_sku'] = $productdet->productsku;
            $proorders['seller_name'] = $productdet->sellername;
            $proorders['product_image'] = $img_data[$data];
            $proorders['unique_id'] = str_random(4).time();
            $proorders['buyer_name'] = $buyer_name;
            $proorders['buyer_phone'] = $buyer_phone;
            $proorders['buyer_address'] = $buyer_address;
            $proorders['buyer_address2'] = $buyer_address2;
	        $proorders['color'] = $color_data[$data] != "" ? $color_data[$data] : NULL;
            $proorders['maincolor'] = $maincolor_data[$data] != "" ? $maincolor_data[$data] : NULL;
            $proorders['productAttrId'] = $productAttrId[$data] != "" ? $productAttrId[$data] : NULL;
            $proorders['gstAmount'] = $gstAmount[$data] != "" ? $gstAmount[$data] : NULL;
            $proorders['colorcode'] = $colorcode[$data] != "" ? $colorcode[$data] : NULL;
            $proorders['buyer_city'] = $buyer_city;
            $proorders['buyer_state'] = $buyer_state;
            $proorders['tomorrow_date'] = $datetomorrow;
            $proorders['after_tomorrow_date'] = $dateaftertomorrow;
            $proorders['customer_id_new'] = $customer_id_new;
            $proorders['vendorname'] = $productdet->vendor_name;
            $proorders['order_payment_method'] = $payment_method;
            $proorders['Settelment_date'] = $settelmentdate;
            // end of new added code
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            $proorders['size'] = $sdata[$data];
            
            $proorders['premiumtype'] = $categoryid[$data] == 82 ? $premiumtype[$data] : NULL;
            $proorders['cost'] = $cost_prc[$data];
            $proorders->save();

            $orderedid = $proorders->id;

            $carts = Cart::where('uniqueid',Session::get('uniqueid'))
                    ->where('category', (int)$categoryid[$data])
                    ->where('product', $product);
                    if($productAttrId[$data] != ""){
                        $carts->where('productAttrId', $productAttrId[$data]);
                    }

                $cart = $carts->get();
            
            if($categoryid[$data] == "72" || $categoryid[$data] == "58")
            {
                $pres['order_id'] = $orderid;
                $pres['ordered_id'] = $orderedid;
                $pres['title'] = $cart[0]->title;
                $pres['category'] = $cart[0]->category;
                $pres['product_id'] = $cart[0]->product;
                $pres['quantity'] = $cart[0]->quantity;
                $pres['cartcolor'] = $cart[0]->cartcolor;
                $pres['maincolor'] = $cart[0]->maincolor;
                $pres['size'] = $cart[0]->size;
                $pres['cost'] = $cart[0]->cost;
                $pres['rangenameone'] = $cart[0]->rangenameone;
                $pres['rangenametwo'] = $cart[0]->rangenametwo;
                $pres['rangenamethree'] = $cart[0]->rangenamethree;
                $pres['discount_one'] = $cart[0]->discount_one;
                $pres['discount_two'] = $cart[0]->discount_two;
                $pres['discount_three'] = $cart[0]->discount_three;
                $pres['price'] = $cart[0]->price;
                $pres['main_price'] = $cart[0]->main_price;
                $pres['base_curv'] = $cart[0]->base_curv;
                $pres['presc_image'] = $cart[0]->presc_image;
                $pres['lefteyequantity'] = $cart[0]->lefteyequantity;
                $pres['righeyequantity'] = $cart[0]->righeyequantity;
                $pres['botheyequantity'] = $cart[0]->botheyequantity;
                $pres['dia'] = $cart[0]->dia;
                $pres['Lsphere'] = $cart[0]->Lsphere;
                $pres['Lpower'] = $cart[0]->Lpower;
                $pres['LDia'] = $cart[0]->LDia;
                $pres['LBc'] = $cart[0]->LBc;
                $pres['Laxis'] = $cart[0]->Laxis;
                $pres['Lcyle'] = $cart[0]->Lcyle;
                $pres['lva'] = $cart[0]->lva;
                $pres['same_rx_both'] = $cart[0]->same_rx_both;
                $pres['rsphere'] = $cart[0]->rsphere;
                $pres['rpower'] = $cart[0]->rpower;
                $pres['rbc'] = $cart[0]->rbc;
                $pres['rdia'] = $cart[0]->rdia;
                $pres['Raxis'] = $cart[0]->Raxis;
                $pres['rcyl'] = $cart[0]->rcyl;
                $pres['rva'] = $cart[0]->rva;
                $pres['bsphere'] = $cart[0]->bsphere;
                $pres['bpower'] = $cart[0]->bpower;
                $pres['Bbc'] = $cart[0]->Bbc;
                $pres['Bdia'] = $cart[0]->Bdia;
                $pres['Bcyle'] = $cart[0]->Bcyle;
                $pres['Baxis'] = $cart[0]->Baxis;
                $pres['totalPd'] = $cart[0]->totalPd;
                $pres['Lepd'] = $cart[0]->Lepd;
                $pres['Repd'] = $cart[0]->Repd;
                
                $pres['frame_fit'] = $cart[0]->frame_fit;
                $pres['a_size'] = $cart[0]->a_size;
                $pres['b_size'] = $cart[0]->b_size;
                $pres['dbl'] = $cart[0]->dbl;
                $pres['r_dia'] = $cart[0]->r_dia;
                $pres['l_dia'] = $cart[0]->l_dia;
                $pres['r_pd'] = $cart[0]->r_pd;
                $pres['l_pd'] = $cart[0]->l_pd;
                $pres['bvd'] = $cart[0]->bvd;
                $pres['r_ed'] = $cart[0]->r_ed;
                $pres['l_ed'] = $cart[0]->l_ed;
                $pres['r_fitting'] = $cart[0]->r_fitting;
                $pres['l_fitting'] = $cart[0]->l_fitting;
                $pres['pantascopic'] = $cart[0]->pantascopic;
                $pres['temple_size'] = $cart[0]->temple_size;
                $pres['network_distance'] = $cart[0]->network_distance;
                $pres['bow_angle'] = $cart[0]->bow_angle;
                $pres['frame_type'] = $cart[0]->frame_type;
                $pres['materials'] = $cart[0]->materials;
                $pres['shape_code'] = $cart[0]->shape_code;
                
                DB::table('prescription')->insert($pres);
            }
            
            if($productdet->owner != "admin"){
    	 	    $vendordet = Vendors::findOrFail($productdet->vendorid);
    	            //Sending Email To Seller
            	$to = $vendordet->email;
    			$subject = "New Order Recieved!!";
    			$msg = "Hello ".$vendordet->name."!\nYou have recieved a new order. Please login to your panel to check. \nThank you.";
    			$headers = "From: ".$settings->title."<".$settings->email.">";
    			mail($to,$subject,$msg,$headers);
            }
        }
        Cart::where('uniqueid',Session::get('uniqueid'))->delete();
        
	    $coupons = explode(',', $request->coupons);
        foreach ($coupons as $data => $coupon)
        {
            $couponsorder['order_id'] = $orderid;
            $couponsorder['coupon_code'] = $coupon;
            DB::table('order_coupon')->insert($couponsorder);
        }
        
        //Sending Email To Buyer
        $to = $request->email;
		$subject = "Your Order Placed!!";
		$msg = "Hello ".$request->name."!\nYou have placed a new order. Please wait for your delivery. \nThank you."."\n Order Number:".$order->order_number."\n Order Total Amount:". $order->pay_amount."\n Payment Method:".$order->method;
		$headers = "From: ".$settings->title."<".$settings->email.">";
		$attach="your attach";
		mail($to,$subject,$msg,$headers);   
		     
        //Sending Email To Admin
        $to = $settings->email;
		$subject = "New Order Recieved!!";
		$msg = "Hello Admin!\nYour store has recieved a new order. Please login to your panel to check. \nThank you.";
		$headers = "From: ".$settings->title."<".$settings->email.">";
		mail($to,$subject,$msg,$headers);

        return redirect($success_url);
    }
    
    public function generateInvoice($id){
        //dd(Auth::guard('profile'));
        $user = UserProfile::find(Auth::guard('profile')->user()->id);
        $order = Order::findOrFail($id);
        //dd($order->toArray());
        $downloadPath = base_path('../assets/invoice/invoice_'.time().'.pdf');
        $viewhtml = View::make('invoice',compact('user','order'))->render();
        $pdf = PDF::loadHtml($viewhtml);
        return $pdf->save($downloadPath)->stream('download.pdf');
    }

    public function mobilemoney(Request $request)
    {
        $settings = Settings::findOrFail(1);
        $order = new Order;
        $success_url = action('PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;

        $order['customerid'] = $request->customer;
        $order['cost'] = $request->cost;
    	$order['products'] = $request->products;
    	$order['quantities'] = $request->quantities;
    	$order['sizes'] = $request->sizes;
    	$order['pay_amount'] = $item_amount;
    	$order['method'] = ($request->method == "Razorpay")?"Razorpay":"COD";
    	$order['booking_date'] = date('Y-m-d H:i:s');
    	$order['order_number'] = $item_number;
    	$order['shipping'] = $request->shipping;
    	$order['pickup_location'] = $request->pickup_location;
    	$order['customer_email'] = $request->email;
    	$order['customer_name'] = $request->name;
    	$order['customer_phone'] = $request->phone;
    	$order['customer_address'] = $request->address;
    	$order['customer_address2'] = $request->address2;
    	$order['customer_city'] = $request->city;
    	$order['customer_state'] = $request->state;
    	$order['customer_country'] = $request->country;
    	$order['customer_alt_phone'] = $request->alternate_phone;
    	$order['customer_zip'] = $request->zip;
    	$order['shipping_email'] = $request->shipping_email;
    	$order['shipping_name'] = $request->shipping_name;
    	$order['shipping_phone'] = $request->shipping_phone;
    	$order['shipping_address'] = $request->shipping_address;
    	$order['shipping_address2'] = $request->shipping_address2;
    	$order['shipping_city'] = $request->shipping_city;
    	$order['shipping_state'] = $request->shipping_state;
    	$order['shipping_country'] = $request->shipping_country;
    	$order['shipping_alternate_phone'] = $request->shipping_alternate_phone;
    	$order['shipping_zip'] = $request->shipping_zip;
    	$order['order_note'] = $request->order_note;
    	$order['payment_status'] = "Pending";
        $order['buyer_order_id'] = $request->buyer_order_id;
        $order['seller_order_id'] = $request->seller_order_id;
        
        $order->save();
        $orderid = $order->id;
         // new added code
        $ordernumber = $order->order_number;
        $buyer_name = $order->customer_name;
        $buyer_phone = $order->customer_phone;
        $buyer_address = $order->customer_address;
        $buyer_city = $order->customer_city;
        $buyer_state = $order->customer_state;
        $tomorrow = $order->booking_date;
        $tomorrownew = $order->booking_date;
        $payment_method = $order->method;
    	$categoryid = $request->categoryID;

        $tomorrowdate = new DateTime($tomorrow);
        $datetomorrow = $tomorrowdate->modify('+1 day');

        $settelmentdate = $tomorrowdate->modify('+25 day');

        $aftertomorrow = new DateTime($tomorrownew);

        $dateaftertomorrow = $aftertomorrow->modify('+2 day');

        // end new added code
        $pdata = explode(',',$request->products);
        $qdata = explode(',',$request->quantities);
        $sdata = explode(',',$request->sizes);
        $color_data = explode(',',$request->color);
        $maincolor_data = explode(',',$request->maincolor);
        $img_data = explode(',',$request->productImage);
        $cost_prc = explode(',', $request->cost);
        $premiumtype = explode(',', $request->premiumtype);
	    $categoryid = explode(',', $request->categoryID);
	    $productAttrId = explode(',', $request->productAttrId);

        foreach ($pdata as $data => $product){
            $proorders = new OrderedProducts();
            if($productAttrId[$data] != ""){
                $productdata = ProductAttr::findOrFail($productAttrId[$data]);
                $stocks = $productdata->attr_qty - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['attr_qty'] = $stocks;
                $productdata->update($quant);
            }else{
                $productdat = Product::findOrFail($product);
                $stocks = $productdat->stock - $qdata[$data];
                if ($stocks < 0){
                    $stocks = 0;
                }
                $quant['stock'] = $stocks;
                $productdat->update($quant);
            }

            $productdet = Product::findOrFail($product);

            $proorders['orderid'] = $orderid;
            // new added code
            $proorders['order_number_new'] = $ordernumber;
            $proorders['categoryID'] = $categoryid[$data];
            $proorders['product_title'] = $productdet->title;
            $proorders['product_sku'] = $productdet->productsku;
            $proorders['seller_name'] = $productdet->sellername;
            $proorders['product_image'] = $img_data[$data];
            $proorders['unique_id'] = str_random(4).time();
            $proorders['buyer_name'] = $buyer_name;
            $proorders['buyer_phone'] = $buyer_phone;
            $proorders['buyer_address'] = $buyer_address;
            $proorders['buyer_address2'] = $buyer_address2;
	        $proorders['color'] = $color_data[$data] != "" ? $color_data[$data] : NULL;
            $proorders['maincolor'] = $maincolor_data[$data] != "" ? $maincolor_data[$data] : NULL;
            $proorders['productAttrId'] = $productAttrId[$data] != "" ? $productAttrId[$data] : NULL;
            $proorders['buyer_city'] = $buyer_city;
            $proorders['buyer_state'] = $buyer_state;
            $proorders['tomorrow_date'] = $datetomorrow;
            $proorders['after_tomorrow_date'] = $dateaftertomorrow;
            $proorders['customer_id_new'] = $customer_id_new;
            $proorders['vendorname'] = $productdet->vendor_name;
            $proorders['order_payment_method'] = $payment_method;
            $proorders['Settelment_date'] = $settelmentdate;
            // end of new added code
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            $proorders['size'] = $sdata[$data];
            
            $proorders['premiumtype'] = $categoryid[$data] == 82 ? $premiumtype[$data] : NULL;
            $proorders['cost'] = $cost_prc[$data];
            $proorders->save();

            $orderedid = $proorders->id;

            $carts = Cart::where('uniqueid',Session::get('uniqueid'))
                    ->where('category', (int)$categoryid[$data])
                    ->where('product', $product);
                    if($productAttrId[$data] != ""){
                        $carts->where('productAttrId', $productAttrId[$data]);
                    }

                $cart = $carts->get();
            
            if($categoryid[$data] == "72" || $categoryid[$data] == "58")
            {
                $pres['order_id'] = $orderid;
                $pres['ordered_id'] = $orderedid;
                $pres['title'] = $cart[0]->title;
                $pres['category'] = $cart[0]->category;
                $pres['product_id'] = $cart[0]->product;
                $pres['quantity'] = $cart[0]->quantity;
                $pres['cartcolor'] = $cart[0]->cartcolor;
                $pres['maincolor'] = $cart[0]->maincolor;
                $pres['size'] = $cart[0]->size;
                $pres['cost'] = $cart[0]->cost;
                $pres['rangenameone'] = $cart[0]->rangenameone;
                $pres['rangenametwo'] = $cart[0]->rangenametwo;
                $pres['rangenamethree'] = $cart[0]->rangenamethree;
                $pres['discount_one'] = $cart[0]->discount_one;
                $pres['discount_two'] = $cart[0]->discount_two;
                $pres['discount_three'] = $cart[0]->discount_three;
                $pres['price'] = $cart[0]->price;
                $pres['main_price'] = $cart[0]->main_price;
                $pres['base_curv'] = $cart[0]->base_curv;
                $pres['presc_image'] = $cart[0]->presc_image;
                $pres['lefteyequantity'] = $cart[0]->lefteyequantity;
                $pres['righeyequantity'] = $cart[0]->righeyequantity;
                $pres['dia'] = $cart[0]->dia;
                $pres['Lsphere'] = $cart[0]->Lsphere;
                $pres['Lpower'] = $cart[0]->Lpower;
                $pres['LDia'] = $cart[0]->LDia;
                $pres['LBc'] = $cart[0]->LBc;
                $pres['Laxis'] = $cart[0]->Laxis;
                $pres['Lcyle'] = $cart[0]->Lcyle;
                $pres['lva'] = $cart[0]->lva;
                $pres['same_rx_both'] = $cart[0]->same_rx_both;
                $pres['rsphere'] = $cart[0]->rsphere;
                $pres['rpower'] = $cart[0]->rpower;
                $pres['rbc'] = $cart[0]->rbc;
                $pres['rdia'] = $cart[0]->rdia;
                $pres['Raxis'] = $cart[0]->Raxis;
                $pres['rcyl'] = $cart[0]->rcyl;
                $pres['rva'] = $cart[0]->rva;
                $pres['bsphere'] = $cart[0]->bsphere;
                $pres['bpower'] = $cart[0]->bpower;
                $pres['Bbc'] = $cart[0]->Bbc;
                $pres['Bdia'] = $cart[0]->Bdia;
                $pres['Bcyle'] = $cart[0]->Bcyle;
                $pres['Baxis'] = $cart[0]->Baxis;
                $pres['totalPd'] = $cart[0]->totalPd;
                $pres['Lepd'] = $cart[0]->Lepd;
                $pres['Repd'] = $cart[0]->Repd;
                DB::table('prescription')->insert($pres);
            }
                    
            if($productdet->owner != "admin"){
	 	    $vendordet = Vendors::findOrFail($productdet->vendorid);
	            //Sending Email To Seller
	            	$to = $vendordet->email;
			$subject = "New Order Recieved!!";
			$msg = "Hello ".$vendordet->name."!\nYou have recieved a new order. Please login to your panel to check. \nThank you.";
			$headers = "From: ".$settings->title."<".$settings->email.">";
			mail($to,$subject,$msg,$headers);
            }
            
            
        }

        Cart::where('uniqueid',Session::get('uniqueid'))->delete();
        
        //Sending Email To Buyer
    	$to = $request->email;
		$subject = "Your Order Placed!!";
		$msg = "Hello ".$request->name."!\nYou have placed a new order. Please wait for your delivery. \nThank you.";
		$headers = "From: ".$settings->title."<".$settings->email.">";
		mail($to,$subject,$msg,$headers);   
		     
        //Sending Email To Admin
    	$to = $settings->email;
		$subject = "New Order Recieved!!";
		$msg = "Hello Admin!\nYour store has recieved a new order. Please login to your panel to check. \nThank you.";
		$headers = "From: ".$settings->title."<".$settings->email.">";
		mail($to,$subject,$msg,$headers);
		
        return redirect($success_url);
    }

    public function bankwire(Request $request)
    {
        $settings = Settings::findOrFail(1);
        $order = new Order;
        $success_url = action('PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;

        $order['customerid'] = $request->customer;
    	$order['products'] = $request->products;
    	$order['quantities'] = $request->quantities;
    	$order['sizes'] = $request->sizes;
    	$order['pay_amount'] = $item_amount;
    	$order['method'] = ($request->method == "Razorpay")?"Razorpay":"COD";
    	$order['booking_date'] = date('Y-m-d H:i:s');
    	$order['order_number'] = $item_number;
    	$order['shipping'] = $request->shipping;
    	$order['pickup_location'] = $request->pickup_location;
    	$order['customer_email'] = $request->email;
    	$order['customer_name'] = $request->name;
    	$order['customer_phone'] = $request->phone;
    	$order['customer_address'] = $request->address;
    	$order['customer_address2'] = $request->address2;
    	$order['customer_city'] = $request->city;
    	$order['customer_state'] = $request->state;
    	$order['customer_country'] = $request->country;
    	$order['customer_alt_phone'] = $request->alternate_phone;
    	$order['customer_zip'] = $request->zip;
    	$order['shipping_email'] = $request->shipping_email;
    	$order['shipping_name'] = $request->shipping_name;
    	$order['shipping_phone'] = $request->shipping_phone;
    	$order['shipping_address'] = $request->shipping_address;
    	$order['shipping_address2'] = $request->shipping_address2;
    	$order['shipping_city'] = $request->shipping_city;
    	$order['shipping_state'] = $request->shipping_state;
    	$order['shipping_country'] = $request->shipping_country;
    	$order['shipping_alternate_phone'] = $request->shipping_alternate_phone;
    	$order['shipping_zip'] = $request->shipping_zip;
    	$order['order_note'] = $request->order_note;
    	$order['payment_status'] = "Pending";
        $order['buyer_order_id'] = $request->buyer_order_id;
        $order['seller_order_id'] = $request->seller_order_id;
        
        $order->save();
        $orderid = $order->id;
        // new added code
        $ordernumber = $order->order_number;
        $buyer_name = $order->customer_name;
        $buyer_phone = $order->customer_phone;
        $buyer_address = $order->customer_address;
        $buyer_city = $order->customer_city;
        $buyer_state = $order->customer_state;
        $tomorrow = $order->booking_date;
        $tomorrownew = $order->booking_date;
        $payment_method = $order->method;
        $categoryid = $request->categoryID;

        $tomorrowdate = new DateTime($tomorrow);
        $datetomorrow = $tomorrowdate->modify('+1 day');
        $settelmentdate = $tomorrowdate->modify('+25 day');
        $aftertomorrow = new DateTime($tomorrownew);

        $dateaftertomorrow = $aftertomorrow->modify('+2 day');

        // end new added code

        $pdata = explode(',',$request->products);
        $qdata = explode(',',$request->quantities);
        $sdata = explode(',',$request->sizes);

        foreach ($pdata as $data => $product){
            $proorders = new OrderedProducts();

            $productdet = Product::findOrFail($product);

            $proorders['orderid'] = $orderid;
            // new added code
            $proorders['order_number_new'] = $ordernumber;
            $proorders['categoryID'] = $categoryid;
            $proorders['product_title'] = $productdet->title;
            $proorders['product_sku'] = $productdet->productsku;
            $proorders['seller_name'] = $productdet->sellername;
            $proorders['product_image'] = $productdet->feature_image;
            $proorders['unique_id'] = str_random(4).time();
            $proorders['buyer_name'] = $buyer_name;
            $proorders['buyer_phone'] = $buyer_phone;
            $proorders['buyer_address'] = $buyer_address;
            $proorders['buyer_city'] = $buyer_city;
            $proorders['buyer_state'] = $buyer_state;
            $proorders['tomorrow_date'] = $datetomorrow;
            $proorders['after_tomorrow_date'] = $dateaftertomorrow;
            $proorders['vendorname'] = $productdet->vendor_name;
            $proorders['order_payment_method'] = $payment_method;
            $proorders['Settelment_date'] = $settelmentdate;
            // end of new added code
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            $proorders['size'] = $sdata[$data];
            $proorders['cost'] = $productdet->price * $qdata[$data];
            $proorders->save();

            $stocks = $productdet->stock - $qdata[$data];
            if ($stocks < 0){
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $productdet->update($quant);
                    
            if($productdet->owner != "admin"){
	 	    $vendordet = Vendors::findOrFail($productdet->vendorid);
	            //Sending Email To Seller
	            	$to = $vendordet->email;
			$subject = "New Order Recieved!!";
			$msg = "Hello ".$vendordet->name."!\nYou have recieved a new order. Please login to your panel to check. \nThank you.";
			$headers = "From: ".$settings->title."<".$settings->email.">";
			mail($to,$subject,$msg,$headers);
            }
            
        }

        $carts = Cart::where('uniqueid',Session::get('uniqueid'))->get();
        
        foreach($carts as $cart){
            if($cart->category == 72){
                $pres['order_id'] = $orderid;
                $pres['title'] = $cart->title;
                $pres['category'] = $cart->category;
                $pres['product_id'] = $cart->product;
                $pres['quantity'] = $cart->quantity;
                $pres['cartcolor'] = $cart->cartcolor;
                $pres['maincolor'] = $cart->maincolor;
                $pres['size'] = $cart->size;
                $pres['cost'] = $cart->cost;
                $pres['rangenameone'] = $cart->rangenameone;
                $pres['rangenametwo'] = $cart->rangenametwo;
                $pres['rangenamethree'] = $cart->rangenamethree;
                $pres['discount_one'] = $cart->discount_one;
                $pres['discount_two'] = $cart->discount_two;
                $pres['discount_three'] = $cart->discount_three;
                $pres['price'] = $cart->price;
                $pres['main_price'] = $cart->main_price;
                $pres['base_curv'] = $cart->base_curv;
                $pres['presc_image'] = $cart->presc_image;
                $pres['lefteyequantity'] = $cart->lefteyequantity;
                $pres['righeyequantity'] = $cart->righeyequantity;
                $pres['dia'] = $cart->dia;
                $pres['Lsphere'] = $cart->Lsphere;
                $pres['Lpower'] = $cart->Lpower;
                $pres['LDia'] = $cart->LDia;
                $pres['LBc'] = $cart->LBc;
                $pres['Laxis'] = $cart->Laxis;
                $pres['Lcyle'] = $cart->Lcyle;
                $pres['lva'] = $cart->lva;
                $pres['same_rx_both'] = $cart->same_rx_both;
                $pres['rsphere'] = $cart->rsphere;
                $pres['rpower'] = $cart->rpower;
                $pres['rbc'] = $cart->rbc;
                $pres['rdia'] = $cart->rdia;
                $pres['Raxis'] = $cart->Raxis;
                $pres['rcyl'] = $cart->rcyl;
                $pres['rva'] = $cart->rva;
                $pres['bsphere'] = $cart->bsphere;
                $pres['bpower'] = $cart->bpower;
                $pres['Bbc'] = $cart->Bbc;
                $pres['Bdia'] = $cart->Bdia;
                $pres['Bcyle'] = $cart->Bcyle;
                $pres['Baxis'] = $cart->Baxis;
                $pres['totalPd'] = $cart->totalPd;
                $pres['Lepd'] = $cart->Lepd;
                $pres['Repd'] = $cart->Repd;
            
                DB::table('prescription')->insert($pres);
            }
        }

        Cart::where('uniqueid',Session::get('uniqueid'))->delete();
        
        //Sending Email To Buyer
        $to = $request->email;
		$subject = "Your Order Placed!!";
		$msg = "Hello ".$request->name."!\nYou have placed a new order. Please wait for your delivery. \nThank you.";
		$headers = "From: ".$settings->title."<".$settings->email.">";
		mail($to,$subject,$msg,$headers);   
		     
        //Sending Email To Admin
        $to = $settings->email;
		$subject = "New Order Recieved!!";
		$msg = "Hello Admin!\nYour store has recieved a new order. Please login to your panel to check. \nThank you.";
		$headers = "From: ".$settings->title."<".$settings->email.">";
		mail($to,$subject,$msg,$headers);
		
        return redirect($success_url);
    }

    //Product Quick View
    public function getProduct($id)
    {
        $language = SiteLanguage::find(1);
        $profiledata = Product::findOrFail($id);
        $data = '<div class="col-md-3 col-sm-12">
                    <div class="product-review-details-img">
                        <img src="' . url('/') . '/assets/images/products/' . $profiledata->feature_image . '" alt="">
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="product-review-details-description">
                        <h3>' . $profiledata->title . '</h3>
                        <div class="ratings">
                            <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="empty-stars"></div></a>
                            <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"><div class="full-stars" style="width:' . Review::ratings($profiledata->id) . '%"></div></a>
                        </div>
                        <div class="product-price">
                            <div class="single-product-price">
                                $' . $profiledata->price . '
                            </div>
                            <div class="product-availability">';
        if ($profiledata->stock != 0 || $profiledata->stock === null) {
            $data .= '<span class="available">
                            <i class="fa fa-check-square-o"></i>
                            <span>' . $language->available . '</span>
                        </span>';
        }else{
            $data .= '<span class="not-available">
                    <i class="fa fa-times-circle-o"></i>
                    <span>' . $language->out_of_stock.'</span>
                    </span>';
                }
                            $data .='</div>
                        </div>
                        <div class="product-review-description">
                            <h4>'.$language->quick_review.'</h4>
                            <p>'.$profiledata->description.'</p>
                        </div>
                        <div class="product-quantity">
                            <a href="'.url('/').'/product/'.$profiledata->id.'/'.str_replace(' ','-',strtolower($profiledata->title)).'" class="addToCart-btn">'.$language->view_details.'</a>
                        </div>
                    </div>
                </div>';
        return $data;
    }

    //Profile Data
    public function account()
    {
        //$profiledata = UserProfile::findOrFail($id);
        return view('account');
    }

    //Contact Page Data
    public function contact()
    {
        $pagedata = PageSettings::find(1);
        return view('contact', compact('pagedata'));
    }

    //About Page Data
    public function about()
    {
        $pagedata = PageSettings::find(1);
        return view('about', compact('pagedata'));
    }

    //FAQ Page Data
    public function faq()
    {
        $pagedata = PageSettings::find(1);
        $faqs = FAQ::all();
        return view('faq', compact('pagedata','faqs'));
    }

    //Show Category Users
    public function category($category)
    {
        $categories = Category::where('slug', $category)->first();
        $services = Service::where('status', 1)
            ->where('category', $categories->id)
            ->get();
        $pagename = "All Sevices in: ".ucwords($categories->name);
        return view('services', compact('services','pagename','categories'));
    }


    //Show Cart
    public function cart()
    {
        $sum = 0.00;
        $carts = new \stdClass();
        if (Session::has('uniqueid')){
            $carts = Cart::where('uniqueid', Session::get('uniqueid'))->get();
            $sum = Cart::where('uniqueid', Session::get('uniqueid'))->sum('cost');
        }
        return view('cart', compact('carts','sum'));
    }
    
    public function showprescription($id)
    {
        $cart = Cart::findOrFail($id);
        
        $data = '';
        $data2 = '';
        $data3 = '';
        if(isset($cart)){
            if($cart->parameter != ''){
                $data .= '<a data-toggle="modal" data-target="#viewparameter_'.$cart->id.'" >Parameter &nbsp; <i class="fa fa-eye"></i></a><br><br>';
            }
            $data .= '<table class="table table-bordered" style="width:100%"><thead>';
                            if($cart->category == 72){
                                if($cart->presc_image == null){
                                    if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null){
            $data .=                    '<tr>
                                        <th style="width:2%"scope="col"></th>
                                        <th style="width:2%" scope="col"><center>SPH</center></th>
                                        <th style="width:2%"scope="col"><center>BC</center></th>
                                        <th style="width:2%"scope="col"><center>DIA</center></th>
                                        <th style="width:2%"scope="col"><center>Add Power</center></th>
                                        </tr>';
                                    }elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null){
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
                                if($cart->rpower != null || $cart->Lpower != null){
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
                                        <!--<th style="width:2%"scope="col"><center>DIA</center></th>-->
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
                                        if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null){
            $data .=                        '<tr>
                                                <th style="width:2%" scope="row">Both(OD & OS)</th>
                                                <td><center>' . $cart->rsphere . '</center></td>
                                                <td><center>' . $cart->rbc . '</center></td>
                                                <td><center>' . $cart->rdia . '</center></td>
                                                <td><center>' . $cart->rpower . '</center></td>
                                            </tr>';
                                        }elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null){
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
                                        if($cart->rpower != null || $cart->Lpower != null || $cart->bpower != null){
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
                                        }elseif($cart->Raxis != null || $cart->Laxis != null || $cart->Baxis != null){
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
                                        <td><center><a href="' . url('assets/prescription') . '/' . $cart->presc_image . '" target="_blank"><img src="' . url('assets/prescription') . '/' . $cart->presc_image . '" alt=""></a></center></td>
                                    </tr>';
                                }
                            }elseif($cart->category == 58){
                                if($cart->rpower != null || $cart->Lpower != null){
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
                                        <!--<td><center>' . $cart->LDia . '</center></td>-->
                                        <td><center>' . $cart->Laxis . '</center></td>
                                    </tr>
                                    <tr>
                                        <th style="width:2%" scope="row">RE</th>
                                        <td><center>' . $cart->rsphere . '</center></td>
                                        <td><center>' . $cart->rcyl . '</center></td>
                                        <!--<td><center>' . $cart->rdia . '</center></td>-->
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
                                                <td  style="border: 1px solid lightgrey"><center>' . ($cart->base_curve != "" ? $cart->base_curve : "--") . '</center></td>
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

    //User Subscription
    public function subscribe(Request $request)
    {
        $exist = Subscribers::where('email',$request->email);

        if ($exist->count() > 0){

            return "<span style=\"color:#F90600;\">You are already Subscribed.</span>";
        }else{
            $subscribe = new Subscribers;
            $subscribe->fill($request->all());
            $subscribe->save();
            return "<span style=\"color:#00C708;\">You are subscribed Successfully.</span>";
        }
    }

    //Send email to Admin
    public function contactmail(Request $request)
    {
        $pagedata = PageSettings::findOrFail(1);
        $setting = Settings::findOrFail(1);
        $subject = "Contact From Of ".$setting->title;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$request->phone."\nMessage: ".$request->message;

        mail($to,$subject,$msg);

        Session::flash('cmail', $pagedata->contact);
        return redirect('/contact');
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

    public function language()
    {
        return view('languagedesclaimer');
    }

    public function track()
    {
        return view('track');
    }


    public function subcategory()
    {
        $subcategory = 'rayban';
  
        return view('categoryproduct', compact('rayban'));
    }

// pranali's code for policydetails
    public function policydetails($id)
    {
        $blog=policy::findOrFail($id);
         return view('policydetails',compact('blog'));
    }
// end pranali's code for policydetails

     //vishal
    //number convert
    public function convertNumber($number){
      
        if(str_contains($number, '.') ){
            list($integer, $fraction) = explode(".", (string) $number);
        }else{
            list($integer, $fraction) = explode(".", (string) $number.".00");
        }
        $output = "";

        if ($integer[0] == "-")
        {
            $output = "minus_";
            $integer    = ltrim($integer, "-");
        }
        else if ($integer[0] == "+")
        {
            $output = "positive_";
            $integer    = ltrim($integer, "+");
        }

        if ($integer[0] == "0")
        {
            $output .= "zero";
        }
        else
        {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g)
            {
                $groups2[] = $this->convertThreeDigit($g[0], $g[1], $g[2]);
            }

            for ($z = 0; $z < count($groups2); $z++)
            {
                if ($groups2[$z] != "")
                {
                    $output .= $groups2[$z] . $this->convertGroup(11 - $z) . (
                            $z < 11
                            && !array_search('', array_slice($groups2, $z + 1, -1))
                            && $groups2[11] != ''
                            && $groups[11][0] == '0'
                                ? " and "
                                : ", "
                        );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0)
        {
            $output .= "_point";
            for ($i = 0; $i < strlen($fraction); $i++)
            {
                $output .= "_" . $this->convertDigit($fraction[$i]);
            }
        }

        return $output;
    }

    public function convertGroup($index){
        switch ($index)
        {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    public function convertThreeDigit($digit1, $digit2, $digit3){
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
        {
            return "";
        }

        if ($digit1 != "0")
        {
            $buffer .= $this->convertDigit($digit1) . "_hundred";
            if ($digit2 != "0" || $digit3 != "0")
            {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0")
        {
            $buffer .= $this->convertTwoDigit($digit2, $digit3);
        }
        else if ($digit3 != "0")
        {
            $buffer .= $this->convertDigit($digit3);
        }

        return $buffer;
    }

    public function convertTwoDigit($digit1, $digit2){
        if ($digit2 == "0")
        {
            switch ($digit1)
            {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1")
        {
            switch ($digit2)
            {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else
        {
            $temp = $this->convertDigit($digit2);
            switch ($digit1)
            {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    public function convertDigit($digit){
        switch ($digit)
        {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }
    
      public function do_login_into_ci(){
        $user = UserProfile::find(Auth::guard('profile')->user()->id);
        $user->login_token = str_random(32);
        $user->save();
        $data = ['token' => $user->login_token, 'ci_id' => $user->ci_id];
        //   app('App\Http\Controllers\Auth\ProfileLoginController')->updateErpCiToken($data);
        // //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        // return redirect('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
         if($user->logindetailsstatus=="Eyevam")
            {
                
                 app('App\Http\Controllers\Auth\ProfileLoginController')->updateErpCiToken($data);
        //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        return redirect('http://eyevam.in/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
            }
            
            if($user->logindetailsstatus=="Joshua")
            {
                
                app('App\Http\Controllers\Auth\ProfileLoginController')->updatejoshCiToken($data);
        //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        return redirect('http://joshuainternational.in/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
            }
              if($user->logindetailsstatus=="Optical Hut")
            {
                
                app('App\Http\Controllers\Auth\ProfileLoginController')->updateopticalCiToken($data);
        //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        return redirect('http://erp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
            }
            
            if($user->logindetailsstatus==null)
            {
                
          
        return redirect('https://reachoptic.com/home');
            }
       
    }


}
