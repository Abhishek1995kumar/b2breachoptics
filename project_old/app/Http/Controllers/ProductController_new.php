<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use App\Product;
use App\ProductAttr;
use App\ProductGallery;
use App\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class ProductController extends Controller
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
    public function index() {
        $products = Product::orderBy('id','desc')->get();

        // $products = DB::table('products') 
        //     ->join('vendor_profiles', 'vendor_profiles.id', '=', 'products.vendorid') 
        //     ->select('products.*', 'vendor_profiles.shop_name') 
        //     ->get();

        //  dd($products);

            // echo '<pre>';
            // print_r($products);
            // die();

       return view('admin.productlist',compact('products'));
    }

            // public function getData(){
            //     $shopname = DB::table('vendor_profiles')->select('shop_name')->get();
            //     return view('admin.productlist',compact('$shopname'));
            // }


   public function pending()
   {
       // $products = Product::where('status','2')->where('approved','no')->orderBy('id','desc')->get();
        $products = Product::where('status','2')->where('approved','no')->orWhere('status', '=', 3)->orderBy('id','desc')->get();
       return view('admin.pendingproduct',compact('products'));
   }

   public function pendingdetails($id)
   {
       $product = Product::findOrFail($id);
       return view('admin.pendingdetails',compact('product'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        // dd($countryoforigin);
        return view('admin.productadd',compact('categories','countryoforigin'));
    }

    // test push codenew
    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'photo' => 'max:400',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'max:400',
            'video' => 'required|mimes:mp4|max:50000',
            'featured'=>'required',
            'attr_sku' => 'required|unique:product_attrs,attr_sku'
        ]);
        
        $form_data = $request->all();   // save form data in a variable
        
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
        
        $child = $request->input('childid');
        $childnew = implode(',',$child);
        
        $dia = $request->input('diameter');
        $dianew = implode(',',$dia);
        
        $powermin = $request->input('powermin');
        $powernewmin = implode(',',$powermin);
        
        $powermax = $request->input('powermax');
        $powernewmax = implode(',',$powermax);
        
        if($request->input('axisnew') != '') {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }
        else {
            $axisneww = '';
        }
        
        if($request->input('cylindernew') != '') {
            $cylinder = $request->input('cylindernew');
            $cylinderneww = implode(',',$cylinder);
        }
        else {
            $cylinderneww = '';
        }
        
        if($request->input('basecurve') != '') {
            $base = $request->input('basecurve');
            $basecurvenew = implode(',',$base);
        }
        else {
            $basecurvenew = '';
        }
        
        if($request->input('addpower') != '') {
            $addpowerr = $request->input('addpower');
            $addnew = implode(',',$addpowerr);
        }
        else {
            $addnew = '';
        }
        
        $data = new Product();
        
        
        $data->fill($form_data);
        
        
        $category = $request->mainid;
        $cat_val = $category;
        
        $data['category'] = $cat_val;
        
        $data['subid'] = $sub_new;
        
        $data['childid'] = $childnew;
        
        $data['diameter'] = $dianew;
        
        $data['powermin'] = $powernewmin;
        
        $data['powermax'] = $powernewmax;
        
        $data['axisnew'] = $axisneww;
        
        $data['cylindernew'] = $cylinderneww;
        
        $data['basecurve'] = $basecurvenew;
        
        $data['addpower'] = $addnew;
        
        if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/products',$photo_name);
            $data['feature_image'] = $photo_name;
        }

        if ($request->featured == 1){
            $data->featured = 1;
        }

        if ($request->tranding == 1){
            $data->tranding = 1;
        }

        if ($request->latest == 1){
            $data->latest = 1;
        }

        if ($request->selected == 1){
            $data->selected = 1;
        }

        if ($request->pallow == ""){
            $data->sizes = null;
        }
        if ($file = $request->file('video')){
            $video_name = time().$request->file('video')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video'] = $video_name;
        }
        if ($file = $request->file('video1')){
            $video_name = time().$request->file('video1')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video1'] = $video_name;
        }
        if ($file = $request->file('video2')){
            $video_name = time().$request->file('video2')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video2'] = $video_name;
        }
        
        // dd($data);
        
        $data->save();
        
        $lastid = $data->id;

        if ($files = $request->file('gallery')){
            foreach ($files as $file){
                $gallery = new Gallery;
                $image_name = str_random(2).time().$file->getClientOriginalName();
                $file->move('assets/images/gallery',$image_name);
                $gallery['image'] = $image_name;
                $gallery['productid'] = $lastid;
                $gallery->save();
            }
        }
        
        // Product Attribute Start here --------------------

        $attSku = $request->input('attr_sku');
        $attrSize = $request->input('attr_size');
        $attrQty = $request->input('attr_qty');
        $attrPrice = $request->input('attr_price');
        $attrColor = $request->input('attr_color');

        foreach($attSku as $key=>$val) {
            
            $subdata = new ProductAttr();

            $subdata['product_id'] = $lastid;
            $subdata['attr_sku'] = $attSku[$key];

            if($attrSize[$key] == ''){
                $subdata['attr_size'] = '';
            }
            else {
                $subdata['attr_size'] = $attrSize[$key];
            }

            if($attrQty[$key] == ''){
                $subdata['attr_qty'] = '';
            }
            else {
                $subdata['attr_qty'] = $attrQty[$key];
            }

            if($attrColor[$key] == ''){
                $subdata['attr_color'] = '';
            }
            else {
                $subdata['attr_color'] = $attrColor[$key];
            }
            
            $subdata['attr_price'] = $attrPrice[$key];

            $subdata->save();
            
            $attr_lastid = $subdata->id;

            if ($files = $request->file('attr_imgs')){

                foreach ($files as $file){

                    $gelleryData = new ProductGallery();
                    $image_name = time().$file->getClientOriginalName();
                    $file->move('assets/images/product_attr',$image_name);
                    $gelleryData['attr_imgs'] = $image_name;
                    $gelleryData['pid'] = $lastid;
                    $gelleryData['paid'] = $attr_lastid;

                    $gelleryData->save();
                }
            }
        }
        
        
        
        Session::flash('message', 'New Product Added Successfully.');
        return redirect('admin/products');
    }



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
    public function edit($id) {
        $product = Product::findOrFail($id);
        $demo = $product->subid;
     
        $demo_new = explode(',',$demo);
        // dd($demo);
   
        $d = $product->childid;
    
        $dd = explode(',',$d);
      
        $subs = Category::where('role','sub')->where('mainid', $product->category[0])->get();
        // dd($subs);
       
        $child = Category::where('role','child')->whereIn('subid',$demo_new)->get();
        
        $attr_data = DB::table('product_attrs')->where('product_id', $product->id)->get();
        
        $attr_images = DB::table('product_attr_gallery')->where('pid', $product->id)->get();


       
        $gallery = Gallery::where('productid',$id)->get();
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        
        return view('admin.productedit',compact('product','categories','child','subs','gallery','countryoforigin','dd','demo_new', 'attr_data', 'attr_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'photo' => 'max:400',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'max:400',
            'video' => 'mimes:mp4|max:50000',
            'featured'=>'required'
        ]);
        $product = Product::findOrFail($id);
        $input = $request->all();
        
      
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
      
        $child = $request->input('childid');
        // dd($child);
        $childnew = implode(',', $child);
        
        $dia = $request->input('diameter');
        $dianew = implode(',',$dia);
        
        $powermin = $request->input('powermin');
        $powerminnew = implode(',',$powermin);
        
        $powermax = $request->input('powermax');
        $powermaxnew = implode(',',$powermax);
        
        $axis= $request->input('axisnew');
        $axisneww = implode(',',$axis);
        $cylinder = $request->input('cylindernew');
        $cylinderneww = implode(',',$cylinder);
        $base = $request->input('basecurve');
        $basecurvenew = implode(',',$base);
        $addpowerr = $request->input('addpower');
        $addnew = implode(',',$addpowerr);
       

        $input['category'] = $request->mainid;
        $input['subid'] =  $sub_new;
        $input['childid'] = $childnew;
        
        $input['axisnew'] = $axisneww;
         $input['diameter'] = $dianew;
         $input['powermin'] = $powerminnew;
         $input['powermax'] = $powermaxnew;
        $input['cylindernew'] = $cylinderneww;
        $input['basecurve'] = $basecurvenew;
        $input['addpower'] = $addnew;
        
        if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/products',$photo_name);
            $input['feature_image'] = $photo_name;
        }

        if ($request->galdel == 1){
            $gal = Gallery::where('productid',$id);
            $gal->delete();
        }

        if ($request->pallow == ""){
            $input['sizes'] = null;
        }

        // bulkrange
        if ($request->bulkrange == "") {
            
            $input['ranegnameone'] = null;
            $input['p40pieces'] = null;
            $input['rangenametwo'] = null;
            $input['p51pieces'] = null;
            $input['rangenamethree'] = null;
            $input['p5000pieces'] = null;
        }

        if ($request->featured == 1){
            $input['featured'] = 1;
        }else{
            $input['featured'] = 0;
        }

        if ($request->latest == 1){
            $input['latest'] = 1;
        }else{
            $input['latest'] = 0;
        }

        if ($request->tranding == 1){
            $input['tranding'] = 1;
        }else{
            $input['tranding'] = 0;
        }

        if ($request->selected == 1){
            $input['selected'] = 1;
        }else{
            $input['selected'] = 0;
        }

        if ($file = $request->file('video')){
            $video_name = time().$request->file('video')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video'] = $video_name;
        }

        if ($file = $request->file('video1')){
            $video_name = time().$request->file('video1')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video1'] = $video_name;
        }

        if ($file = $request->file('video2')){
            $video_name = time().$request->file('video2')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video2'] = $video_name;
        }
        // DB::enableQueryLog();
        // print_r($input);
        // dd($input);
        $product->update($input);
         // dd(DB::getQueryLog());

        if ($files = $request->file('gallery')){
            foreach ($files as $file){
                $gallery = new Gallery;
                $image_name = str_random(2).time().$file->getClientOriginalName();
                $file->move('assets/images/gallery',$image_name);
                $gallery['image'] = $image_name;
                $gallery['productid'] = $id;
                $gallery->save();
            }
        }

        Session::flash('message', 'Product Updated Successfully.');
        return redirect('admin/products');
    }


    public function status($id , $status)
    {
        $product = Product::findOrFail($id);
        $input['status'] = $status;

        $product->update($input);
        Session::flash('message', 'Product Status Updated Successfully.');
        return redirect('admin/products');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink('assets/images/products/'.$product->feature_image);
        $product->delete();
        return redirect('admin/products')->with('message','Product Delete Successfully.');
    }

    public function deleteimg($id){
        $img = Gallery::findOrFail($id);
        unlink('assets/images/gallery/'.$img->image);
        $img->delete();
        return redirect()->back();

    }
    
    
    public function accept($id) {   
        // $vendor = Vendors::findOrFail($id);
        $product = Product::findOrFail($id);
        $approved['approved'] = 'yes';
        $approved['status']=1;

        // mail($vendor->email,'Your Product is approved','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');

        $product->update($approved);
        return redirect('admin/products')->with('message','Product Accepted Successfully');
    }

    public function reject($id) {
        // $vendor = Vendors::findOrFail($id);
        $product = Product::findOrFail($id);
        // $newnote= new Product();
        // $newnote->note = request('note');
        $approved['status']=3;
        // mail($vendor->email,'Your Vendor Registration Rejected','Your Vendor Account Registration Rejected. Please Contact Admin for further details.');

        // unlink('assets/images/products/'.$product->feature_image);
        // $product->delete();
         // $newnote->save();
         $product->update($approved);
        return redirect('admin/products/pending')->with('message','Product Rejected Successfully');
        // return redirect('admin/vendors/pending')->with('message','Vendor Rejected Successfully');
    }

    public function storenote(Request $request,$id) {
    
     $product = Product::findOrFail($id);
      $product->note = $request->input('note');
      $product->save();
       return redirect('admin/products/pending')->with('message','Rejection Note Send to Vendor');
    }
    
    
    
    
    
    
    
    // Abhishek Vendor Product Add or Updated Code 
    public function createVendorProduct(Request $request){
        
    }
}






















