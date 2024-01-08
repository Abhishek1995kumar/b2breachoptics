<?php

namespace App\Http\Controllers;

use App\Blog;
use App\OurOfferings;
use App\Brand;
use App\Cart;
use App\Category;
use App\Counter;
use App\FAQ;
use App\Gallery;
use App\Order;
use App\OrderedProducts;
use App\PageSettings;
use App\Product;
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
class FrontEndController extends Controller
{

    public function __construct()
    {
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
       
        return view('index', compact('banners','brands','blogs','fcategories','fcategory','features','latests','tops','testimonials','languages','newsliders','mainslider','smallbox','tranding','new','bottomslider','OurOfferings'));
      
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

    public function cartupdate(Request $request)
    {
        $this->validate($request, [
            'lefteyequantity' => 'required',
            'righeyequantity' => 'required',
        ]);

        if ($request->isMethod('post')){
            
            $stockCheck = Product::select('stock')->where('id',$request->product)->where('status',1)->first();
            if($stockCheck->stock < $request->quantity){
                return response()->json(['response' => 'Sorry, You have reached the stock limit!','product' => $request->product,'error'=>true]);
            }
            
            if($request->checkQty){
                return response()->json(['response'=> $stockCheck->stock,'product' => $request->product,'success'=>true]);
            }
            

            if (empty(Session::get('uniqueid'))){

                $cart = new Cart;
                $cart->fill($request->all());
                
                if($file = $cart['presc_image']) {
                    $destination = 'assets/prescription';
                    $filename = time().$request->file('presc_image')->getClientOriginalName();
                    $file->move($destination, $filename);
                    $cart->presc_image = $filename; 
                }
                
                Session::put('uniqueid', $request->uniqueid);
                $cart->save();

            }else{

                $cart = Cart::where('uniqueid',$request->uniqueid)
                    ->where('product',$request->product)->first();
                //$carts = Cart::where('uniqueid',$request->uniqueid)
                        //->where('product',$request->product)->count();
                if (count($cart) > 0 ){
                    $data =  $request->all();
                    $cart->update($data);
                }else{
                    $cart = new Cart;
                    $cart->fill($request->all());
                    
                    if($file = $carts['presc_image']) {
                        $destination = 'assets/prescription';
                        $filename = $request->file('presc_image')->getClientOriginalName();
                        $file->move($destination, $filename);
                        $carts->presc_image = $filename;
                    }
                    
                    $cart->save();
                }

            }
            return response()->json(['response' => 'Successfully Added to Cart.','product' => $request->product]);
        }

        $getcart = Cart::where('uniqueid',Session::get('uniqueid'))->get();

        return response()->json(['response' => $getcart]);
    }

    
    public function cartdelete($id)
    {
        $cartproduct = Cart::where('uniqueid',Session::get('uniqueid'))
            ->where('product',$id)->first();
        $cartproduct->delete();

        $getcart = Cart::where('uniqueid',Session::get('uniqueid'))->get();
        return response()->json(['response' => $getcart]);
    }

    //Submit Review
    public function reviewsubmit(Request $request)
    {
        $review = new Review;
        $review->fill($request->all());
        $review['review_date'] = date('Y-m-d H:i:s');
        $review->save();
        return redirect()->back()->with('message','Your Review Submitted Successfully.');
    }

    //Product Data
    public function productdetails($id,$title)
    {
        $productdata = Product::findOrFail($id);
        $data['views'] = $productdata->views + 1;
        $productdata->update($data);
        $relateds = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$productdata->category[0]])
            ->take(8)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $features = Product::with('gallery_images')->where('featured','1')->where('status','1')->orderBy('id','desc')->take(8)->get();

        $selected = Product::with('gallery_images')->where('selected','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $tranding = Product::with('gallery_images')->where('tranding','1')->where('status','1')->orderBy('id','desc')->take(50)->get();

        $category = Category::all();
        // dd($category);
        // $cart = DB::table('cart')->select('*')->where('product',$id)->first();

        $reviews = Review::where('productid',$id)->get();
        return view('product', compact('productdata','gallery','reviews','relateds','features','selected','tranding','category'));
    }
    
    public function productshoww($id)
    {  
        DB::enableQueryLog();
         $productdata = Product::findOrFail($id);
         
        //  echo "<pre>";
        //  print_r($productdata);
        //  die();
          //dd($productdata);
        $data['views'] = $productdata->views + 1;
        $productdata->update($data);
        $relateds = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$productdata->category[0]])
            ->take(8)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $productdat = DB::table('products')->select('*')->where('id',$id)->first();

        // echo "<pre>";
        // print_r($productdata);
        // die;


        $features = Product::with('gallery_images')->where('featured','1')->where('status','1')->orderBy('id','desc')->take(8)->get();

        $selected = Product::with('gallery_images')->where('selected','1')->where('status','1')->orderBy('id','desc')->take(50)->get();
        $tranding = Product::with('gallery_images')->where('tranding','1')->where('status','1')->orderBy('id','desc')->take(50)->get();

        $category = Category::all();
        //dd($category);
        //  $cart = DB::table('products')->select('*')->where('id',$id)->get();
        // dd($cart);
        $reviews = Review::where('productid',$id)->get();
         return view('productshow', compact('productdata','gallery','productdat','reviews','relateds','features','selected','tranding','category'));
      
    }

    //Category Products
    public function catproduct($slug)
    {
        $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = "";
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
        if ($category === null) {
            $category['name'] = "Nothing Found";
            $products = new \stdClass();
        }else{
            if ($sort=="old") {  
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('created_at','asc');
            }elseif ($sort=="new") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('created_at','desc');
            }elseif ($sort=="low") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','asc');
            }elseif ($sort=="high") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->orderBy('price','desc');
            }elseif ($sort=="price") {
                $products = Product::where('status','1')
                    ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                    ->whereBetween('price', [$min, $max])
                    ->orderBy('price','asc');
            }else{
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
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
            // echo "<pre>";
            // print_r($products->toSql());
            // die(); 
           
            $products= $products->take(9)->get();
            // echo "<pre>";
            // print_r($products->toArray());
            // die();
        }
           
       return view('categoryproduct', compact('products','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect'));
    

  }
    public function catproductnew($id){
    //   dd($id);
    $sort = $colors = $shapes = $makes = $gender = "";
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
    // dd($category);
    if ($category === null) {
        $category['name'] = "Nothing Found";
        $products = new \stdClass();
    }else{
        
        if ($sort=="old") {  
            $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
            ->orderBy('created_at','asc');
        }elseif ($sort=="new") {
            $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
            ->orderBy('created_at','desc');
        }elseif ($sort=="low") {
            $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
            ->orderBy('price','asc');
        }elseif ($sort=="high") {
            $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])
            ->orderBy('price','desc');
        }elseif ($sort=="price") {
            $products = Product::where('status','1')
                ->whereRaw('FIND_IN_SET(?,category)', [$category->id])
                ->whereBetween('price', [$min, $max])
                ->orderBy('price','asc');
        }else{
            // DB::enableQueryLog();
            $products = Product::select('*')
                ->where('childid','LIKE','%'.$id.'%')
                ->get();
            // dd(DB::getQueryLog());
            // dd($products);
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
    }
    
    
           
       return view('categoryproduct', compact('products','category','sort','mins','maxs','maxvalue','colors','shapes','makes','gender','frametype','framematerial','lenscolor','size','brandname','lenstype','disposability','packaging','lensmaterialtype','lenstechnology','lensindex','visioneffect'));
    

  }
  

    //Load More Category Products
    public function loadcatproduct($slug,$page)
    {
        $language = SiteLanguage::find(1);
        $settings = Settings::find(1);
        $res = "";
        $min = "0";
        $max = "500";
        $mins = "0";
        $maxs = "500";
        $skip = ($page-1)*9;

        $sort = $colors = $shapes = $makes = $gender = $frametype = $framematerial = $lenscolor = $size = $brandname = $lenstype = $disposability = $packaging = $lensmaterialtype = $lenstechnology = $lensindex = $visioneffect = "";

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
            $makes = request()->gender;
        }
        if (!empty(trim(request()->frametype))) {
            $frametype = request()->frametype;
        }
        if (!empty(trim(request()->framematerial))) {
            $framematerial = request()->framematerial;
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
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('created_at','asc');
            }elseif ($sort=="new") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('created_at','desc');
            }elseif ($sort=="low") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','asc');
            }elseif ($sort=="high") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('price','desc');
            }elseif ($sort=="price") {
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->whereBetween('price', [$min, $max])->orderBy('price','asc');
            }else{
                $products = Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$category->id])->orderBy('created_at','desc');
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

            $products = $products->skip($skip)->take(9)->get();

            foreach($products as $product) {
                $res .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="single-product-carousel-item text-center">
                                <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '"> <img src="' . url('/assets/images/products') . '/' . $product->feature_image . '" alt="Product Image" /> </a>
                                <div class="product-carousel-text">
                                    <a href="' . url('/product') . '/' . $product->id . '/' . str_replace(' ', '-', strtolower($product->title)) . '">
                                        <h4 class="product-title">' . $product->title . '</h4>
                                    </a>
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:'.Review::ratings($product->id).'%"></div>
                                    </div>
                                    <div class="product-price"><del class="offer-pricenewone"><i  title ="Add to My site"class=" fa fa-share-alt" style="font-size:15px"></i></del>';
                                    if ($product->previous_price != "") {
                                        $res .= '<span class="original-price">' .$settings->currency_sign. $product->previous_price . '</span>';
                                    }
                                    $res .= '
                                       
                                        <del class="offer-price">' .$settings->currency_sign. Product::Cost($product->id) . '</del>
                                        <del class="offer-pricenew"><a data-toggle="modal" data-target="#view_{{$product->id}}" > <i class="fa fa-eye" aria-hidden="true"></i> </a></del>
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
                                    // if ($product->stock != 0){
                                    //     $res .='<button type="button" onclick="toCart(this)" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>'.$language->add_to_cart.'</span></button>';
                                    // }else{
                                    //     $res .='<button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>'.$language->out_of_stock.'</button>';
                                    // }
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
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:'.Review::ratings($product->id).'%"></div>
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
    public function searchproduct($search)
    {
       $products = Product::where('status','1')->where('title', 'like', '%' . $search . '%')
                ->get();
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
        $customer_id_new = $order->customerid;
        $payment_method = $order->method;

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

        Cart::where('uniqueid',Session::get('uniqueid'))->delete();
        
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
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:' . Review::ratings($profiledata->id) . '%"></div>
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
  public function do_login_into_ci(){
        $user = UserProfile::find(Auth::guard('profile')->user()->id);
        $user->login_token = str_random(32);
        $user->save();
        $data = ['token' => $user->login_token, 'ci_id' => $user->ci_id];
        //   app('App\Http\Controllers\Auth\ProfileLoginController')->updateErpCiToken($data);
        // //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        // return redirect('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
         if($user->logindetailsstatus=="ERP")
            {
                
                 app('App\Http\Controllers\Auth\ProfileLoginController')->updateErpCiToken($data);
        //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        return redirect('https://eyevam.in/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
            }
            
            if($user->logindetailsstatus=="Joshua")
            {
                
                app('App\Http\Controllers\Auth\ProfileLoginController')->updatejoshCiToken($data);
        //dd('https://b2berp.optical-hut.com/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
        return redirect('https://joshuainternational/api/handleLaravelLogin?id='.$user->ci_id.'&token='.$user->login_token);
            }
           
       
    }
}
